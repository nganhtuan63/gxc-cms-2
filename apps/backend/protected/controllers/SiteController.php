<?php

class SiteController extends BeController
{
	
	public function actions(){
	   return array(
	      'index'=>'admin.components.actions.index',
	      'login'=>'admin.components.actions.login',
	      'logout'=>'admin.components.actions.logout',
	   );
	}
		

}