<?php
/**
 * Backend Manage Settings Controller.
 * 
 * @author Tuan Nguyen <nganhtuan63@gmail.com>
 * @version 1.0
 * @package cms.modules.setting.controllers
 *
 */
class ManageController extends BeController{
    
       
    public function __construct($id,$module=null)
	{
		parent::__construct($id,$module);
        $this->menu=array();		 
	}

	/**
	 * The function that do Manage Settings
	 * 
	 */
	public function actionIndex()
	{          

		$this->pageTitle=t('cms','Manage Settings');
		$this->pageHint=t('cms','Here you can manage all Site Settings'); 

		$settings=GxcHelpers::getAvailableSettings();
        $type=isset($_GET['type']) ? strtolower(GxcHelpers::plaintext($_GET['type'])) : 'general';
        
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
            $this->render(Yii::app()->getModule('setting')->data_folder.'.'.$type.'.'.$settings[$type]['layout'],array('model'=>$model));
        } else {
            throw new CHttpException(404,t('cms','The requested page does not exist.'));
        }
        
	}              
        
        
                    
}