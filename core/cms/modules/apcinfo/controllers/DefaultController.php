<?php

class DefaultController extends CController
{
	public function actionIndex()
	{
		$this->redirect(array('apc/index'));
	}
}