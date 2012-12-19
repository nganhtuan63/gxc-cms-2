<?php

/**
 * Class of parent Controller of GXC CMS, extends from CController
 * 
 */

class BeController extends RController
{
		
		public $pageHint='';
        public $titleImage='';
		public $menu=array();
	                 
        
        public function init(){            
            // Register the scripts            
        }

        public function __construct($id,$module=null)
		{				      	
		 		parent::__construct($id,$module);		 		
		}


    	/**
         * Filter by using Modules Rights
         * 
         * @return type 
         */
        public function filters()
        {
               return array(
                   'rights',
               );
        }
           
        /**
         * List of allowd default Actions for the user
         * @return type 
         */
        public function allowedActions()
        {
               return 'login,logout,error';
        }

		

}