<?php
/**
 * Backend Install Controller.
 * 
 * @author Tuan Nguyen <nganhtuan63@gmail.com>
 * @version 1.0
 * @package backend.controllers
 *
 */
class InstallController extends CController
{
		
		
	public function actionRun(){
				
		//First need to check has_install or not ? 
		if(file_exists(COMMON_FOLDER.DIRECTORY_SEPARATOR.'.locked')){			
			echo 'Remove locked file for install first bro!';
			Yii::app()->end();
		} else {
			//Start working with Yii Database Components
			$connection=Yii::app()->db;   // assuming you have configured a "db" connection
			// If not, you may explicitly create a connection:
			// $connection=new CDbConnection($dsn,$username,$password);
			
			// Get SQL Script		
			$sql = file_get_contents(COMMON_FOLDER.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'data.sql', true);
										
			if($sql){
				//Replace some default attributes
				
				$sql=str_replace("{{SITE_NAME}}", serialize(SITE_NAME), $sql);
				$sql=str_replace("{{SUPPORT_EMAIL}}", serialize(SUPPORT_EMAIL), $sql);
				$sql=str_replace("{{SLOGAN}}", serialize(SLOGAN), $sql);		
				$sql=str_replace("{{time}}", time(), $sql);
				$sql=str_replace("{{password_salt}}", USER_SALT, $sql);
				
				//Generate password 123456
				$password=hashPassword('123456',USER_SALT);
				$sql=str_replace("{{password}}", $password, $sql);
																					
				$command=$connection->createCommand($sql);
				
				if($command->execute()!==false){
					echo "Install successfully";										
					//Create lock file in COMMON folder
					if(!file_put_contents(COMMON_FOLDER.DIRECTORY_SEPARATOR.'.locked', 'installed')){
						echo "Error while creating locking install file!";
					} 
				} else {
					echo "Error while installing! Please check config file and try again";					
				}									
			} else {
				echo "Can't file data.sql file in COMMON FOLDER";
				
			}
			Yii::app()->end();
		}
					
	}
	
}
	