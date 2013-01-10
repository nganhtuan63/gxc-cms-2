<?php
/**
 * Class User of GXC CMS, extends from CWebUser
 * 
 * 
 * @author Tuan Nguyen  <nganhtuan63@gmail.com>
 * @version 1.0
 * @package cms.components.user
 */
class GxcUser extends CWebUser{
  		
        /**
         * Get the Model from the session of Current User
         * @return Object from Session of Current User
         */
        public function getModel($attr='')
        {
            $user=$this->getState('current_user');
            if($attr=='')                        
                return $user;
            else {              
                return $user[$attr];
            }
        }
        
		/**
         * Function to check from Before Login if it is from Cookie
         * @param type $id
         * @param type $states
         * @param type $fromCookie
         * @return type 
         */
        public function beforeLogin($id, $states, $fromCookie)
        {
                if($fromCookie)
                {
                    if(empty($states['autoLoginToken']))
                    {
                        return false;
                    }
                    $autoLoginKey=$states['autoLoginToken'];
                    $connection=Yii::app()->db;
                    $command=$connection->createCommand('SELECT * FROM {{autologin_tokens}} WHERE user_id=:user_id');
                    $command->bindValue(':user_id',$id,PDO::PARAM_STR);
                    $row=$command->queryRow();      

                    //Re-generate Autologin Token
                    if(!empty($row) && $row['token']===$autoLoginKey){
                        $autoLoginToken=sha1(uniqid(mt_rand(),true));
                        $this->setState('autoLoginToken',$autoLoginToken);                        
                        $connection=Yii::app()->db;                       
                        //delete old keys
                        $command=$connection->createCommand('DELETE FROM {{autologin_tokens}} WHERE user_id=:user_id');
                        $command->bindValue(':user_id',$id,PDO::PARAM_STR);
                        $command->execute();                        
                        //set new
                        $command=$connection->createCommand('INSERT INTO {{autologin_tokens}}(user_id,token) VALUES(:user_id,:token)');
                        $command->bindValue(':user_id',$id,PDO::PARAM_STR);
                        $command->bindValue(':token',$autoLoginToken,PDO::PARAM_STR);
                        $command->execute();
                        return true;
                    } else {
                        return false;
                    }
                    
                }
                return true;
        } 	 

        /**
        * Actions to be taken after logging in.
        * Overloads the parent method in order to mark superusers.
        * @param boolean $fromCookie whether the login is based on cookie.
        */
        public function afterLogin($fromCookie)
        {
            parent::afterLogin($fromCookie);
            
            $command = Yii::app()->db->createCommand();
            $command->select('username,user_url,display_name,email,fbuid,status,recent_login,avatar')->from('{{user}} u')
            ->where('user_id='.(int)$this->getId())     
            ->limit(1);                             
            $user=$command->queryRow();                 
            //Add only some neccessary field
            if($user){             
                // Set User States here
                $this->setState('current_user', $user);                                

                // Set User Roles here
                $this->setState('current_roles', User::getArrayRoles($this->getId()));


                if( Rights::getAuthorizer()->isSuperuser($this->getId())===true )
                    $this->isSuperuser = true;                         
            } else {
                 throw new CHttpException(503,t('cms','Error while Logging into your account. Please try again later.'));
            }
        
            
        }


        /**
        * Implement to store autoLoginToken Key only, 
        * not other State Information
        **/
        public function saveIdentityStates() 
        { 
            $states=array(); 
            foreach($this->getState(self::STATES_VAR,array()) as $name=>$dummy) 
            {
                if($name=='autoLoginToken')
                    $states[$name]=$this->getState($name); 
            }
            return $states; 
        }

	    public function getisAdmin(){
	        return $this->getState('Rights_isSuperuser');
	    }

        /**
        * Performs access check for this user.
        * Overloads the parent method in order to allow superusers access implicitly.
        * @param string $operation the name of the operation that need access check.
        * @param array $params name-value pairs that would be passed to business rules associated
        * with the tasks and roles assigned to the user.
        * @param boolean $allowCaching whether to allow caching the result of access checki.
        * This parameter has been available since version 1.0.5. When this parameter
        * is true (default), if the access check of an operation was performed before,
        * its result will be directly returned when calling this method to check the same operation.
        * If this parameter is false, this method will always call {@link CAuthManager::checkAccess}
        * to obtain the up-to-date access result. Note that this caching is effective
        * only within the same request.
        * @return boolean whether the operations can be performed by this user.
        */
        public function checkAccess($operation, $params=array(), $allowCaching=true)
        {                           
            return $this->isSuperuser===true ? true : $this->checkAccessWithCache($operation, $params, $allowCaching);                         
        }

        public function checkAccessWithCache($operation, $params=array(), $allowCaching=true){
            
            $permissions=Yii::app()->cache->get('permission-cache');                                 

            if($permissions!==false){                
                if(!array_key_exists($operation,$permissions)){
                    return false;
                }                
                if($this->executeBizRule($permissions[$operation]['bizrule'],$params,$permissions[$operation]['data']))
                {

                    //Check with default Roles
                    if(in_array(app()->authManager->defaultRoles, $permissions[$operation]['roles'])){
                        return true;
                    }
                    //Check if allow user id for current operation                
                    if(array_key_exists($this->getId(), $permissions[$operation]['users'])){                    
                        $uid=$this->getId();
                        if($this->executeBizRule($permissions[$operation]['users'][$uid]['bizrule'],$params,$permissions[$operation]['users'][$uid]['data']))
                            return true;
                    } 
                    if($this->getState('current_roles')){
                        //Check if allow user id for current operation  
                        $check_roles = array_intersect($this->getState('current_roles'),$permissions[$operation]['roles']);                   
                        return count($check_roles)>0;    
                    } else {
                        return false;
                    }
                    
                    
                    
                }
            } else {
                parent::checkAccess($operation, $params, $allowCaching);    
            }
            
        }

        public function executeBizRule($bizRule,$params,$data) 
        { 
            return $bizRule==='' || $bizRule===null || ($this->showErrors ? eval($bizRule)!=0 : @eval($bizRule)!=0); 
        }

        /**
        * @param boolean $value whether the user is a superuser.
        */
        public function setIsSuperuser($value)
        {
            $this->setState('Rights_isSuperuser', $value);
        }

        /**
        * @return boolean whether the user is a superuser.
        */
        public function getIsSuperuser()
        {
            return $this->getState('Rights_isSuperuser');
        }
        
        /**
         * @param array $value return url.
         */
        public function setRightsReturnUrl($value)
        {
            $this->setState('Rights_returnUrl', $value);
        }
        
        /**
         * Returns the URL that the user should be redirected to 
         * after updating an authorization item.
         * @param string $defaultUrl the default return URL in case it was not set previously. If this is null,
         * the application entry URL will be considered as the default return URL.
         * @return string the URL that the user should be redirected to 
         * after updating an authorization item.
         */
        public function getRightsReturnUrl($defaultUrl=null)
        {
            if( ($returnUrl = $this->getState('Rights_returnUrl'))!==null )
                $this->returnUrl = null;
            
            return $returnUrl!==null ? CHtml::normalizeUrl($returnUrl) : CHtml::normalizeUrl($defaultUrl);
        }


}
?>
