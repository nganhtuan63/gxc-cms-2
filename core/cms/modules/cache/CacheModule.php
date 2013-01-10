<?php

class CacheModule extends CWebModule
{

	public $password;	
	private $_assetsUrl;

	/**
	 * Initializes the gii module.
	 */
	public function init()
	{
		parent::init();

		
		Yii::app()->setComponents(array(
			'errorHandler'=>array(
				'class'=>'CErrorHandler',
				'errorAction'=>$this->getId().'/default/error',
			),
			'user'=>array(
				'class'=>'CWebUser',
				'stateKeyPrefix'=>'cache',
				'loginUrl'=>Yii::app()->createUrl($this->getId().'/default/login'),
			),
		), false);

		
	}

	/**
	 * @return string the base URL that contains all published asset files of gii.
	 */
	public function getAssetsUrl()
	{
		if($this->_assetsUrl===null)
			$this->_assetsUrl=Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('cache.assets'));
		return $this->_assetsUrl;
	}

	/**
	 * @param string $value the base URL that contains all published asset files of gii.
	 */
	public function setAssetsUrl($value)
	{
		$this->_assetsUrl=$value;
	}

	/**
	 * Performs access check to cache.
	 * This method will check to see if user IP and password are correct if they attempt
	 * to access actions other than "default/login" and "default/error".
	 * @param CController $controller the controller to be accessed.
	 * @param CAction $action the action to be accessed.
	 * @return boolean whether the action should be executed.
	 */
	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			$route=$controller->id.'/'.$action->id;
			$publicPages=array(
				'default/login',
				'default/error',
			);				
			
			if($this->password!==false && Yii::app()->user->isGuest && !in_array($route,$publicPages)){								
				Yii::app()->user->loginRequired();				
			}				
			else{															
				return true;
			}
				
		}
		return false;
	}

		
}