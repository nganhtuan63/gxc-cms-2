<?php
/**
 * Backend User Manage Controller.
 * 
 * @author Tuan Nguyen <nganhtuan63@gmail.com>
 * @version 1.0
 * @package cms.modules.user.controllers
 *
 */
class ManageController extends BeController{       

	public function __construct($id,$module=null)
	{
	 	parent::__construct($id,$module);
                $this->menu=array(
                      
					   array('label'=>t('cms','Manage User'), 'url'=>array('admin'),'linkOptions'=>array('class'=>'button')),
                       array('label'=>t('cms','Create User'), 'url'=>array('create'),'linkOptions'=>array('class'=>'button')),
               );
	 
	}
         /**
	 * The function that do Change Password
	 * 
	 */
	public function actionChangePass()
	{                
        $this->menu=array();      
        if(!user()->isGuest) {
            $model=new UserChangePassForm;		
            // if it is ajax validation request
            if(isset($_POST['ajax']) && $_POST['ajax']==='userchangepass-form')
            {
                    echo CActiveForm::validate($model);
                    Yii::app()->end();
            }
    
            // collect user input data
            if(isset($_POST['UserChangePassForm']))
            {
                    $model->attributes=$_POST['UserChangePassForm'];
                    
                    // validate user input password
                    if($model->validate()){
                            $u=User::model()->findbyPk(user()->id);
                            if($u!==null){
                                    $u->password=$u->hashPassword($model->new_password_1,  USER_SALT);
                                    $u->salt=USER_SALT;
                                    if($u->save()){               
                                        user()->setFlash('success',t('cms','Changed Password Successfully!'));                                        
                                    }
                            }
                            $model=new UserChangePassForm;

                    }
            }
            
            $this->render('user_change_pass',array('model'=>$model));
        } else {
             Yii::app()->request->redirect(user()->returnUrl);
                
        }
                  
        
	}
        
        /**
	 * The function that do Update Settings 
	 * 
	 */
	public function actionUpdateSettings()
	{        
        $this->menu=array();                        

        if(!user()->isGuest) {
            
            $user=User::model()->findbyPk(user()->id);                       
            $model=new UserSettingsForm;
           
            //Bind Value from User to
            $model->display_name=$user->display_name;
            $model->email=$user->email;
            
            // if it is ajax validation request
            if(isset($_POST['ajax']) && $_POST['ajax']==='userupdatesettings-form')
            {
                    echo CActiveForm::validate($model);
                    Yii::app()->end();
            }
    
            // collect user input data
            if(isset($_POST['UserSettingsForm']))
            {
                    $model->attributes=$_POST['UserSettingsForm'];
                    
                    // validate user input password
                    if($model->validate()){
                            $u=User::model()->findbyPk(user()->id);
                            $u->scenario='update';
                            if($u!==null){                                   
                                    $u->display_name=$model->display_name;
                                    $u->email=$model->email;
                                    if($u->save()){               
                                        user()->setFlash('success',t('cms','Updated Successfully!'));                                        
                                    }
                            }
                            $model->display_name=$u->display_name;
                            $model->email=$u->email;
            
                    }
            }
            
            $this->render('user_update_settings',array('model'=>$model));
        } else {
             Yii::app()->request->redirect(user()->returnUrl);                
        }		
	}
        
        /**
	 * The function that do Create new User
	 * 
	 */
	public function actionCreate()
	{                
		$model=new UserCreateForm;

        // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='usercreate-form')
        {
                echo CActiveForm::validate($model);
                Yii::app()->end();
        }

        // collect user input data
        if(isset($_POST['UserCreateForm']))
        {
                $model->attributes=$_POST['UserCreateForm'];

                // validate user input password
                if($model->validate()){
                    
                        $new_user = new User;
                        $new_user->scenario='create';
                        $new_user->username=$model->username;
                        $new_user->email=$model->email;
                        $new_user->display_name=$model->display_name;
                        $new_user->password=$model->password;                        
                        if($new_user->save()){
                            user()->setFlash('success',t('cms','Create new User Successfully!'));                                        
                        }
                        
                        $model= new UserCreateForm;
                        Yii::app()->controller->redirect(array('create'));

                }
        }

        $this->render('user_create',array('model'=>$model));		
	}
        
        /**
	 * The function that do Manage User
	 * 
	 */
	public function actionAdmin()
	{                
		$this->render('user_admin');
	}
        
        /**
	 * The function that do View User
	 * 
	 */
	public function actionView()
	{         
              $id=isset($_GET['id']) ? (int) ($_GET['id']) : 0 ;
              $this->menu=array_merge($this->menu,                       
                        array(
                            array('label'=>t('cms','Update this user'), 'url'=>array('update','id'=>$id),'linkOptions'=>array('class'=>'button')),
                            array('label'=>t('cms','View this user'), 'url'=>array('view','id'=>$id),'linkOptions'=>array('class'=>'button'))
                        )
                    );
		$this->render('user_view');
	}
        
        /**
	 * The function that do Update User
	 * 
	 */
	public function actionUpdate()
	{                
        $id=isset($_GET['id']) ? (int) ($_GET['id']) : 0 ;        
        $this->menu=array_merge($this->menu,                       
                array(
                    array('label'=>t('cms','Update this user'), 'url'=>array('update','id'=>$id),'linkOptions'=>array('class'=>'button')),
                    array('label'=>t('cms','View this user'), 'url'=>array('view','id'=>$id),'linkOptions'=>array('class'=>'button'))
                )
            );
        $user_id=$id;        
        if($user_id!==0) {            
            $model=User::model()->findbyPk($user_id);    
            $old_pass=(string)$model->password;
            // if it is ajax validation request
            if(isset($_POST['ajax']) && $_POST['ajax']==='userupdate-form')
            {
                    echo CActiveForm::validate($model);
                    Yii::app()->end();
            }    
            // collect user input data
            if(isset($_POST['User']))
            {
                    $model->attributes=$_POST['User'];
                    if($model->password!=$old_pass){
			$model->password=$model->hashPassword($model->password, USER_SALT);
                    }
                    $model->scenario='update';
		    if($model->save()){
                        user()->setFlash('success',t('cms','Updated Successfully!'));                                        
                    }			
                   
            }
            
            $this->render('user_update',array('model'=>$model));
        } else {
            throw new CHttpException(404,t('cms','The requested page does not exist.'));
        }
		
	}
        
        /**
	 * The function is to Delete a User
	 * 
	 */
	public function actionDelete($id)
	{                            
        GxcHelpers::deleteModel('User', $id);
	}
}