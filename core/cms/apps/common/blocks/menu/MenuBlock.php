<?php

/**
 * Class for render Menu * 
 * 
 * @author Tuan Nguyen <nganhtuan63@gmail.com>
 * @version 1.0
 * @package common.blocks.menu */

class MenuBlock extends CWidget
{
    
    //Do not delete these attr block, page and errors
    public $id='menu';
    public $block=null;     
    public $errors=array();
    public $page=null;
    public $layout_asset='';

    public $menu_id;
        
    
    public function setParams($params){
          $this->menu_id=isset($params['menu_id']) ? $params['menu_id'] : null;
    }
    
    public function run()
    {                 
           $this->renderContent();         
    }       
 
 
    protected function renderContent()
    {     
       if (isset($this->block) && ($this->block!=null)) {           
                $params=b64_unserialize($this->block['params']);
                $this->setParams($params);                   
                
                $menu_r0_items=Yii::app()->cache->get('menu_r0_'.$this->menu_id);                                
                
                if($menu_r0_items===false){
                    $menu_r0_items = self::getMenuItems(0,$this->menu_id);      
                    Yii::app()->cache->set('menu_r0_'.$this->menu_id,$menu_r0_items,7200);  
                }            
                    
                $this->render(BlockRenderWidget::setRenderOutput($this),array('menus'=>$menu_r0_items,
                    ));
        } else {
            echo '';
        } 
			  
       
    }
    
    public function validate(){ 
        if($this->menu_id==""){
        $this->errors['menu_id']=t('site','Please select a Menu');
                return false ;
    }
    else
        return true ;
    }
    
    public function params()
    {
         return array(
                    'menu_id' => t('site','Menu'),                    
            );
    }
    
    public function beforeBlockSave(){
	   return true;
    }
    
    public function afterBlockSave(){
	   return true;
    }

    public static function getMenuItems($parent_id,$menu_id){
        $menu_items = MenuItem::model()->findAll(
                        array(
                              'condition'=>'parent=:pid AND menu_id=:mid',
                              'params'=>array(':pid'=>$parent_id, ':mid'=>$menu_id),
                              'order'=>' t.order ASC ')
                        );
        
        $result = array();
        foreach ($menu_items as $menu_item) {
            $result[] = array('name'=>$menu_item->name, 'link'=>self::buildLink($menu_item),'id'=>$menu_item->menu_item_id);
        }       
        return $result;
    }
    
    public static function findMenu(){    
        $result=array();
        $menus=Menu::model()->findAll();
        if($menus){
            foreach($menus as $menu){
                $result[$menu->menu_id]=$menu->menu_name;
            }
        }       

    return $result;
    }
    
    public static function buildLink($item){
        
        switch ($item->type) {
             case ConstantDefine::MENU_TYPE_HOME:
                return SITE_PATH; 
                break;
            case ConstantDefine::MENU_TYPE_URL:
                return $item->value; 
                break;
            case ConstantDefine::MENU_TYPE_PAGE:
                $page = Page::model()->findByPk(array($item->value));
                if ($page)
                    return SITE_PATH.'page?slug='.$page->slug;
                else {
                    return 'javascript:void(0);';   
                    }
                break;
            case ConstantDefine::MENU_TYPE_CONTENT:
                $content = Object::model()->findByPk($item->value);
                if ($content)
                    return $content->getObjectLink();
                else {
                    return 'javascript:void(0);';   
                    }
                break;
            case ConstantDefine::MENU_TYPE_TERM:
                break;
            case ConstantDefine::MENU_TYPE_STRING:  
                return $item->value;
                break;                          
            default :
                return $item->value;
                break;
        }
    }
	
	
}

?>