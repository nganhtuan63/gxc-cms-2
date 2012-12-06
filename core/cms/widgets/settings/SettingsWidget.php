<?php

/**
 * This is the Widget for Managing  Settings
 * 
 * @author Tuan Nguyen <nganhtuan63@gmail.com>
 * @version 1.0
 * @package cmswidgets.settings
 *
 */
class SettingsWidget extends CWidget
{
    
    public $visible=true; 
    public $type='general';
 
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
        
        $settings=GxcHelpers::getAvailableSettings();
        $type=isset($_GET['type']) ? strtolower(plaintext($_GET['type'])) : 'general';
        
        if(array_key_exists($type, $settings)){
            //Import the Setting Class
            Yii::import('common.settings.'.$type.'.'.$settings[$type]['class']);
            $model=new $settings[$type]['class'];            
            foreach($model->attributes as $attr=>$value){
                $model->$attr=Yii::app()->settings->get($type, $attr);
            }
            settings()->deleteCache();               
            // if it is ajax validation request
            if(isset($_POST['ajax']) && $_POST['ajax']===$type.'-settings-form')
            {
                    echo CActiveForm::validate($model);
                    Yii::app()->end();
            }

            // collect user input data
            if(isset($_POST[$settings[$type]['class']]))
            {
                    settings()->deleteCache();
                    $model->attributes=$_POST[$settings[$type]['class']];                  
                    if($model->validate()){
                            foreach($model->attributes as $key=>$value){
                                Yii::app()->settings->set($type, $key, $value);
                            }                                                 
                            user()->setFlash('success',t('cms','Settings Updated Successfully!'));                                                                                            
                    }
            }
            $this->render('common.settings.'.$type.'.'.$settings[$type]['layout'],array('model'=>$model));
        } else {
            throw new CHttpException(404,t('cms','The requested page does not exist.'));
        }
        
    }  
    
}
