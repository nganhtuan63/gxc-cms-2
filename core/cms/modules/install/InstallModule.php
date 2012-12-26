<?php

class InstallModule extends CWebModule
{
		
	public $baseUrl = '/install';	
	public $appLayout  = 'cms.modules.install.views.layouts.main';

	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application		
		// Set required classes for import.
		$this->setImport(array(			
			'install.models.*'
		));
	}
	
}

