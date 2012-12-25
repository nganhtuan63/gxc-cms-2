<?php

class SiteController extends BeController
{
	public function actionIndex()
	{		
		$this->render('index');
	}
	
	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		
		$model=new UserLoginForm;
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}		                   
		// collect user input data
		if(isset($_POST['UserLoginForm']))
		{
                       
			$model->attributes=$_POST['UserLoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}                 
		// display the login form
        $this->layout='login';
		$this->render('login',array('model'=>$model));
	}
	
	
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	
}