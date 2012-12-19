<?php

class ErrorController extends BeController
{
	public function actionIndex()
	{
		
		if($error=Yii::app()->errorHandler->error)
	    {
			$this->layout = $this->module->error_layout;
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('index',array('error'=>$error));			
	    }
	}
}