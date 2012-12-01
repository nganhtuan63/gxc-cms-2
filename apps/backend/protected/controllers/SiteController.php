<?php

class SiteController extends BeController
{
	
	public function actions(){
	   return array(
	      'index'=>'admin.components.actions.index',
	      'login'=>'user.components.actions.login',
	      'logout'=>'user.components.actions.logout',
	   );
	}
		

}