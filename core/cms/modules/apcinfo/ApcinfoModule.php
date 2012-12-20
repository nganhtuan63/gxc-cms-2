<?php

class ApcinfoModule extends CWebModule
{
	private $_assets;
	
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'apcinfo.models.*',
			'apcinfo.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}

	public function getAssetsUrl()
	{
		if($this->_assets === null)
		$this->_assets = Yii::app()->getAssetManager()->publish(dirname(__FILE__) . '/assets/css/');
		return $this->_assets;
	}
	
}
