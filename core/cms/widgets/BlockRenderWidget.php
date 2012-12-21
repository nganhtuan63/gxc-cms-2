<?php

/**
 * This is the Widget for Render Blocks of a Region
 * 
 * @author Tuan Nguyen <nganhtuan63@gmail.com>
 * @version 1.0
 * @package cmswidgets
 *
 */
class BlockRenderWidget extends CWidget
{
    
    public $visible=true; 
    public $page = null;
    public $region = '0';
    public $layout_asset='';
	public $data=null;

    public function init()
    {
        
    }
 
    public function run()
    {
        if($this->visible)
        {
            $this->renderContent();
        }
    }
 
    protected function renderContent()
    {       
        if (isset($this->page)) {                               	
			$blocks=Yii::app()->cache->get('pb-'.$this->page['page_id'].'-'.$this->region);					
			if($blocks===false){												   
		            $connection=Yii::app()->db;
		            $command=$connection->createCommand('SELECT b.block_id,b.name,b.type,b.params FROM 
		            	{{page_block}} pb INNER JOIN {{block}} b ON
		            	pb.block_id=b.block_id  
		            	WHERE page_id=:paramId and pb.region=:regionId and pb.status=:status 
		            	order by pb.block_order ASC limit 20');
		            $command->bindValue(':paramId',$this->page['page_id'],PDO::PARAM_INT); 
		            $command->bindValue(':regionId',$this->region,PDO::PARAM_INT); 
		            $command->bindValue(':status',ConstantDefine::PAGE_BLOCK_ACTIVE,PDO::PARAM_INT); 		            
		            $blocks=$command->queryAll();          		            		            		            		            
					if($blocks!==false){						
						Yii::app()->cache->set('pb-'.$this->page['page_id'].'-'.$this->region,$blocks,1800);						
						$this->workWithBlocks($blocks);
					} else {
						echo '';
					}
			} else {
				$this->workWithBlocks($blocks);
			}                            	                	   	 
        }       
    }   

	public function workWithBlocks($blocks){		
		foreach($blocks as $block) {			
			$this->blockRender($block);                               	                        
		}
	}
	
	public function blockRender($block){		
		$block_ini=parse_ini_file(Yii::getPathOfAlias('common.blocks.'.$block['type']).DIRECTORY_SEPARATOR.'info.ini');                                                   		
        //Include the class            
        Yii::import('common.blocks.'.$block['type'].'.'.$block_ini['class']);                                        					        
        $this->widget('common.blocks.'.$block['type'].'.'.$block_ini['class'], array('block'=>$block,'page'=>$this->page,'layout_asset'=>$this->layout_asset));		
	}
    
    public static function setRenderOutput($obj){                     
            // We will render the layout based on the 
            // layout                
        	$name=(strpos($obj->id,'.')===false) ? $obj->id : substr($obj->id, strrpos($obj->id, '.' )+1);	
            $render='common.blocks.'.$obj->id.'.'.$name.'_block_output';
			/*Delete for optimize		
			if(file_exists(Yii::getPathOfAlias('common.front_layouts.'.$obj->page->layout.'.blocks').'/'.$obj->id.'_block_output.php')){                
                $render='common.front_layouts.'.$obj->page->layout.'.blocks.'.$obj->id.'_block_output';                
            }            
			Delete for optimize */
            return $render;
    }
}
