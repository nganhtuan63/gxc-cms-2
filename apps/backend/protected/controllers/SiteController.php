<?php

class SiteController extends BeController
{
	
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{		
		$this->render('cms.modules.admin.views.default.index');
	}

	
}