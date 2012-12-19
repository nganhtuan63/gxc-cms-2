<?php

/**
 * Class of parent Controller for Front end of GXC CMS, extends from RController
 * 
 * 
 * @author Tuan Nguyen <nganhtuan63@gmail.com>
 * @version 1.0
 * @package cms.components
 */

class FeController extends CController
{

		public $description;
		public $keywords;			
		public $change_title=false;
        
        public function __construct($id,$module=null)
		{
			 parent::__construct($id,$module);		 	            
		}
        
       
        /**
         * List of allowd default Actions for the user
         * @return type 
         */
        public function allowedActions()
        {
               return 'login,logout,error';
        }               
        
        public function renderPageSlug($slug){   

            $connection=Yii::app()->db;
            $command=$connection->createCommand('SELECT * FROM {{page}} WHERE slug=:slug limit 1');
            $command->bindValue(':slug',$slug,PDO::PARAM_STR); 
            $page=$command->queryRow();                                          
            if($page){
                $this->layout='main';
				$this->pageTitle=$page['title'];
				$this->description=$page['description'];
				$this->keywords=$page['keywords'];	    
                //depend on the layout of the page, use the corresponding file to render  
                
                $this->renderPage('common.layouts.'.$page['layout'].'.'.$page['display_type'],array('page'=>$page));  

                
            } else {            	  
                  throw new CHttpException('404',t('cms','Oops! Page not found!'));
            }
        }
       		
        public function renderPage($view,$data=null,$return=false)
        {
            
            if($this->beforeRender($view))
            {           
                                   
                if(($layoutFile=$this->getLayoutFile($view))!==false){                    
                    $output=$this->renderFile($layoutFile,array('page'=>$data['page']),true);     
                }

                $this->afterRender($view,$output);       

                $output=$this->processOutput($output);   

                if($return)
                    return $output;
                else
                    echo $output;
            }            
        }
      
		public function afterRender($view,&$output)
	    {
			Yii::app()->clientScript->registerMetaTag($this->description, 'description');
			Yii::app()->clientScript->registerMetaTag($this->keywords, 'keywords');
			//Check if change Title, we will replace content in <title> with new Title
			if($this->change_title){				
				$output=replaceTags('<title>', '</title>', $this->pageTitle.' | '.SITE_NAME, $output);								
			}	
	    }       
}