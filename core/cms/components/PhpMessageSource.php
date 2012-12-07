<?php

/**
 * Class of PhpMessage
 * 
 */

class PhpMessageSource extends CPhpMessageSource {

	public $basePath;
	/**
	 * Initializes the application component.
	 * This method overrides the parent implementation by preprocessing
	 * the user request data.
	 */
	public function init()
	{
		$this->basePath=Yii::getPathOfAlias('common.messages');
		parent::init();				
	}
	
}