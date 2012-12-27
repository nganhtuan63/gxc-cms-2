<?php

/**
 * Class for render Content based on Content list
 * 
 * 
 * @author Tuan Nguyen <nganhtuan63@gmail.com>
 * @version 1.0
 * @package common.blocks.html
 */

class ListViewBlock extends CWidget
{
    
    //Do not delete these attr block, page and errors
    public $id='listview';
    public $block=null;    
    public $errors=array();
    public $page=null;
    public $layout_asset='';
    
    //Content list attribute
    public $content_list;    
	public $display_type;	
	
	//Display types for the list view render 
	const DISPLAY_TYPE_HOMEPAGE=0;
	  	
    const DISPLAY_TYPE_CATEGORY=1;
    
    
    public function setParams($params){
	    $this->content_list=isset($params['content_list']) ? $params['content_list'] : null;
		$this->display_type=isset($params['display_type']) ? $params['display_type'] : self::DISPLAY_TYPE_HOMEPAGE;
    }
    public function run()
    {
            $this->renderContent();
    }       
 
 
    protected function renderContent()
    {
		if(isset($this->block) && ($this->block!=null)){	    
	            //Set Params from Block Params
	            $params=b64_unserialize($this->block['params']);
		    	$this->setParams($params);            	                                        
	            $this->render(BlockRenderWidget::setRenderOutput($this),array());
		} else {
		    echo '';
		}
       
    }
    
    public function validate(){
	return true;
    }
    
    public function params()
    {
            return array(
                    'content_list' => t('site','Content list'),                   
                    'display_type' => t('site','Display type'),
            );
    }
    
    public function beforeBlockSave(){
	return true;
    }
    
    public function afterBlockSave(){
	return true;
    }
	
	public static function getDisplayTypes(){
        return array(
           self::DISPLAY_TYPE_HOMEPAGE=>t("cms","Display in Homepage"),	  	
           self::DISPLAY_TYPE_CATEGORY=>t("cms","Display in Category page"));
    }
	
	public static function getContentList($content_list_id, $max=null, $pagination=null, $return_type=ConstantDefine::CONTENT_LIST_RETURN_ACTIVE_RECORD) {        		
			return GxcHelpers::getContentList($content_list_id, $max, $pagination, $return_type);                
    }
}

?>