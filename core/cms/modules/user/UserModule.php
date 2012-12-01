<?php

class UserModule extends CWebModule
{
		
	public $baseUrl = '/user';	
	public $appLayout  = 'cms.modules.user.views.layouts.main';

	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application		
		$this->setImport(array(
			'user.models.*',
			'user.components.*',			
		));
	}
	
}

