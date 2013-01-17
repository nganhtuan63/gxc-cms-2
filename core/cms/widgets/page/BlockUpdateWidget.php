<?php

/**
 * This is the Widget for Updating a Block
 * 
 * @author Tuan Nguyen <nganhtuan63@gmail.com>
 * @version 1.0
 * @package  cmswidgets.page
 *
 */
class BlockUpdateWidget extends CWidget
{
    
    public $visible=true;     
 
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
            $block_id=isset($_GET['id']) ? (int)$_GET['id'] : 0;     
            $model=GxcHelpers::loadDetailModel('Block', $block_id);                
            // if it is ajax validation request
            if(isset($_POST['ajax']) && $_POST['ajax']==='block-form')
            {
                    echo CActiveForm::validate($model);
                    Yii::app()->end();
            }
            
            $current_type=$model->type;
            
            $block_ini=parse_ini_file(Yii::getPathOfAlias('common.blocks.'.$current_type).DIRECTORY_SEPARATOR.'info.ini');            

            
            //Include the class            
            Yii::import('common.blocks.'.$current_type.'.'.$block_ini['class']);
            $block_model=new $block_ini['class'](); 
            
            //We re-init the params of the attributes
            $block_model->setParams(b64_unserialize($model->params));
            
            
            // collect user input data
            if(isset($_POST['Block']))
            {
                    $model->attributes=$_POST['Block'];        
                    $model->type=$_POST['Block']['type'];                    
                    
                    $params=$block_model->params();
                    $block_params=array();


                    foreach($params as $key=>$param){
                       $block_params[$key]=$block_model->$key=isset($_POST['Block'][$key]) ? $_POST['Block'][$key] : null;

                    }                    
                    if($model->validate()){
                         if(!$block_model->validate()){
                             foreach($block_model->errors as $key=>$message){
                                 $model->addError($key,$message);
                             }                             
                         } else {
                                $block_model->beforeBlockSave();                               
                                //Re-set params if needed
                                foreach($params as $key=>$param){
                                    $block_params[$key]=$block_model->$key;                                    
                                }                                                                                                
                                $model->params=b64_serialize($block_params);
                                
                                if($model->save()){
                                        $block_model->afterBlockSave();
                                        user()->setFlash('success',t('cms','Update Block Successfully!'));                                                              
                                       
                                }
                         }
                    }
                   
                   
            }           
            Yii::app()->controller->layout=isset($_GET['embed']) ? 'clean' : 'main';
            $this->render('cmswidgets.views.block.block_form_widget',array('model'=>$model,'type'=>$current_type,'block_model'=>$block_model));   
    }   
    
    
}
