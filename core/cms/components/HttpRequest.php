<?php 

class HttpRequest extends CHttpRequest  {
       	
       public $noCsrfValidationRoutes = array();

       private $_csrfToken;

       public $_session;
 
	   public function init()
	   {
		    parent::init();		    
	   }
	   public function getCsrfToken()
		{
			$url=Yii::app()->getUrlManager()->parseUrl($this);
            foreach($this->noCsrfValidationRoutes as $route)
            {                    	    	
                if(strpos($url,$route)===0)
                {
                	return 'nocsrf_check';
                	exit;
                }
            }
		    if($this->_csrfToken===null)
		    {
		        $session = Yii::app()->session;
		        //var_dump($session->sessionName);
		        $csrfToken=$session->itemAt($this->csrfTokenName);
		        if($csrfToken===null)
		        {
		            $csrfToken = sha1(uniqid(mt_rand(),true));
		            $session->add($this->csrfTokenName, $csrfToken);
		        }
		        $this->_csrfToken = $csrfToken;
		    }
		 
		    return $this->_csrfToken;
		}

		public function validateCsrfToken($event)
		{
		    if($this->getIsPostRequest())
		    {
		        // only validate POST requests
		        $session= Yii::app()->session;		        
		        if($session->contains($this->csrfTokenName) && isset($_POST[$this->csrfTokenName]))
		        {
		            $tokenFromSession=$session->itemAt($this->csrfTokenName);
		            $tokenFromPost=$_POST[$this->csrfTokenName];		            
		            $valid=$tokenFromSession===$tokenFromPost;
		        }
		        else
		            $valid=false;
		        if(!$valid)
		            throw new CHttpException(400,Yii::t('yii','The CSRF token could not be verified.'));
		    }
		}

       protected function normalizeRequest()
		{
		        parent::normalizeRequest();
		        if($this->enableCsrfValidation)
		        {
		                $url=Yii::app()->getUrlManager()->parseUrl($this);
		                foreach($this->noCsrfValidationRoutes as $route)
		                {		 		                	            	
		                    if(strpos($url,$route)===0)
		                        Yii::app()->detachEventHandler('onBeginRequest',array($this,'validateCsrfToken'));
		                }
		        }
		}
}
?>