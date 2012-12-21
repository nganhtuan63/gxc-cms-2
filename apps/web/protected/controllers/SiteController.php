<?php

class SiteController extends FeController
{
	
	public function actionIndex()
	{						
		$slug=Yii::app()->settings->get('general', 'homepage');                      
        parent::renderPageSlug($slug);  	
	}		

    public function allowedActions()
    {
           return 'index,logout';
    }               

	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}