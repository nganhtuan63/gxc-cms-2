<?php

class PageController extends CController
{
	public $defaultAction='render';

	public function allowedActions()
    {
       	return 'render';
    }               

	public function actionRender()
	{				
		
	}		
	
}