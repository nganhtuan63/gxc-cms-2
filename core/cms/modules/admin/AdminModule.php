<?php

class AdminModule extends CWebModule
{

	/**
	* @property string the base url to Admin. Override when module is nested.
	*/
	public $baseUrl = '/admin';
	
	/**
	* @property string the path to the layout file to use for displaying Admin CMS
	*/
	public $appLayout='admin.views.layouts.main';

	/**
	* @property string menu for Admin
	*/
	public $menu='admin.views.layouts.menu';
	
	/**
	* @property string the custom style sheet files to use for Admin
	*/
	public $css_files=array();

	/**
	* @property string the custom javascript files to use for Admin
	*/
	public $js_files=array();

	private $_assetsUrl;

	

	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'admin.models.*',
			'admin.components.*',
						
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

	/**
	* Publishes the module assets path.
	* @return string the base URL that contains all published asset files of Rights.
	*/
	public function getAssetsUrl()
	{
		if( $this->_assetsUrl===null )
		{			
			$this->_assetsUrl=GxcHelpers::publishAsset(Yii::getPathOfAlias('admin.assets'),false,-1,YII_DEBUG);
		}

		return $this->_assetsUrl;
	}

	/**
	* Registers the necessary scripts.
	*/
	public function registerScripts()
	{
		// Register the necessary scripts		
		if(count($this->css_files)>0){
			foreach($this->css_files as $css){
				$css=Yii::app()->request->baseUrl.'/'.$css;
				Yii::app()->getClientScript()->registerCssFile($css);
			}
		}
		if(count($this->js_files)>0){
			foreach($this->js_files as $js){
				$js=Yii::app()->request->baseUrl.'/'.$js;
				Yii::app()->getClientScript()->registerScriptFile($js);
			}
		}
	}
}

