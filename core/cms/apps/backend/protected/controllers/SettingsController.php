<?php
/**
 * Backend Settings Controller.
 * 
 * @author Tuan Nguyen <nganhtuan63@gmail.com>
 * @version 1.0
 * @package backend.controllers
 *
 */
class SettingsController extends BeController{
    
       
    public function __construct($id,$module=null)
	{
		 parent::__construct($id,$module);
                 $this->menu=array(
                        
                );
		 
	}

	/**
	 * The function that do Manage Settings
	 * 
	 */
	public function actionIndex()
	{                

		$this->render('index');
	}              
        
        
                    
}