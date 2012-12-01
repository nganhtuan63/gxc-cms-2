<?php

class DefaultController extends BeController
{
	public function actions(){
	   return array(
	      'index'=>'admin.components.actions.index',
	   );
	}
		
}