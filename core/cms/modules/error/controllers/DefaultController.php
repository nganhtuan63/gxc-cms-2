<?php
/**
 * Error Controller.
 * 
 * @author Tuan Nguyen <nganhtuan63@gmail.com>
 * @version 1.0
 * @package cms.modules.error.controllers
 *
 */
class DefaultController extends CController{
	
	
	public function init(){
		$this->layout=Yii::app()->getModule('error')->appLayout;
	}
	public function actionIndex(){
	 	if($error=Yii::app()->errorHandler->error)
        {
            
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else{            	
                $this->render('index',array('error'=>$error));
            }            
        }
	}
}
