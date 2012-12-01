<?php
/**
 * Class of parent Controller of GXC CMS, extends from RController
 * 
 */
class BeController extends RController
{
		
		public $pageHint='';
        public $titleImage='';
		public $menu=array();
	                 
        
        public function init(){
        
            // BeController works only when Admin module is enable in config
            if(!isset(Yii::app()->modules['admin'])){
                throw new CHttpException(404,t('cms','The requested page does not exist.'));
            } else {
                $this->layout = Yii::app()->getModule('admin')->appLayout;    
                // Register the scripts
                Yii::app()->getModule('admin')->registerScripts();    
            }

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
               return 'login,logout';
        }


        

		

}