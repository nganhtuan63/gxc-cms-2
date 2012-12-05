<?php

class SettingModule extends CWebModule
{
		
	public $baseUrl = '/setting';
	public $appLayout = 'cms.modules.admin.views.layouts.main';
	public $data_folder = 'common.settings';

	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'setting.models.*',
			'setting.extensions.*',					
		));		

	}
	
}

