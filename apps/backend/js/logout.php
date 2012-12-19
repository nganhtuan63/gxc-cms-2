<?php

//Logout action

class Logout extends CAction {
 
    public function run() {
    	$controller = $this->getController();        
        Yii::app()->user->logout();
		$controller->redirect(Yii::app()->homeUrl);
           
    }
 
}	