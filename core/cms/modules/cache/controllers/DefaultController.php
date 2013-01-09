<?php
/**
 * Manage Cache Controller.
 * 
 * @author Tuan Nguyen <nganhtuan63@gmail.com>
 * @version 1.0
 * @package cms.modules.cache.controllers
 *
 */
class DefaultController extends CController{
	
	public $layout='cache.views.layouts.main';
	
	public function actionIndex()
	{							
		$this->render('index');
	}

	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=Yii::createComponent('cache.models.LoginForm');

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()){															
				$this->redirect(Yii::app()->createUrl('cache/default/index'));				
			}
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout(false);
		$this->redirect(Yii::app()->createUrl('cache/default/index'));
	}

	public function actionClear(){
	 	$type=isset($_REQUEST['type']) ? $_REQUEST['type'] : 'cache';             		
		switch ($type) {
        	case 'cache':
        		if (Yii::app()->cache instanceof CApcCache)
				{
					// Not support Cache for APC Cache
					user()->setFlash('error',t('cms','Not support for APC Cache!'));   
				}
				else if (Yii::app()->cache->flush())
				{
					user()->setFlash('success',t('cms','Cache cleared!'));   
				}
				else
				{
					user()->setFlash('error',t('cms','Error whilte clearing cache!'));   
				}
        		break;
        	case 'asset':
        		# Clear Asset Cache
        		$path=Yii::getPathOfAlias('webroot.assets');
        		$get_sub_folders=get_subfolders_name($path);
				foreach($get_sub_folders as $folder){
					recursive_remove_directory($path.DIRECTORY_SEPARATOR.$folder);
				}															
        		user()->setFlash('success',t('cms','Assets cleared!'));   
        		break;
        }									
		
		$this->redirect(Yii::app()->createUrl('cache/default/index'));
	}
}
