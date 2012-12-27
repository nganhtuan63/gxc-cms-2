<?php

/**
 * Class for render Logo and Info Block
 * 
 * 
 * @author Tuan Nguyen <nganhtuan63@gmail.com>
 * @version 1.0
 * @package common.blocks.logo_info
 */

class LogoInfoBlock extends CWidget
{
    
    //Do not delete these attr block, page and errors
    public $id='logo_info';
    public $block=null;     
    public $errors=array();
    public $page=null;
    public $layout_asset='';           
    
    
    public function setParams($params){
	   return;
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
            );
    }
    
    public function beforeBlockSave(){
		return true;
    }
    
    public function afterBlockSave(){
		return true;
    }
}

?>