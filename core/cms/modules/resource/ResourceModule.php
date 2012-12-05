<?php

class ResourceModule extends CWebModule
{
		
	public $baseUrl = '/resource';		
	public $appLayout = 'cms.modules.admin.views.layouts.main';
	public $data_folder = 'common.storages';

	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application		
		$this->setImport(array(
			'resource.models.*',
			'resource.components.*',			
		));
	}
	
}

