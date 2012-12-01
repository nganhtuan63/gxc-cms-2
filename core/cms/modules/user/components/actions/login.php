<?php

//Login action

class Login extends CAction {
 
    public function run() {
        $controller = $this->getController();        
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
				$controller->redirect(Yii::app()->user->returnUrl);
		}
		$controller->layout=Yii::app()->getModule('user')->appLayout;
		// display the login form
		$controller->render('cms.modules.user.views.login',array('model'=>$model));
           
    }
 
}	