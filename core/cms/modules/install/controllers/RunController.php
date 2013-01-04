<?php
/**
 * Run Install Controller.
 * 
 * @author Tuan Nguyen <nganhtuan63@gmail.com>
 * @version 1.0
 * @package cms.modules.install.controllers
 *
 */
class RunController extends CController{
	
	
	public function init(){
		$this->layout=Yii::app()->getModule('install')->appLayout;
	}
	
	public function actionIndex(){
		
		//First need to check has_install or not ? 
		if(file_exists(COMMON_FOLDER.DIRECTORY_SEPARATOR.'.locked')){			
			echo t('cms','Website installed! Please remove .locked file in common folder');			
		} else {
			$model=new InstallForm;
			$model->app_name='New Application';
			$model->site_title='New Application - Site Title';
			$model->site_description='New Application - Site Description';
			$model->db_host='localhost';						
			$path=Yii::app()->getbaseUrl(true);
			$new_path=str_replace('/backend', '', $path);			
			$backend_path=$new_path.'/backend'.'/';
			$web_path=$new_path.'/web'.'/';

			$model->url_path=$path;
			$model->url_resource_path=$new_path.'/resources';
			$model->admin_email='admin@localhost.com';

			if(isset($_POST['InstallForm'])){

				$model->attributes=$_POST['InstallForm'];                        
				$string_connection='mysql:host='.$model->db_host.';dbname='.$model->db_name;
				$connection=new CDbConnection($string_connection,$model->db_username,$model->db_password);

				// Get SQL Script		
				$sql = file_get_contents(CMS_FOLDER.DIRECTORY_SEPARATOR.'_DATABASE'.DIRECTORY_SEPARATOR.'data.sql', true);

				if($sql){

					//Replace some default attributes
					$command=$connection->createCommand($sql);

					if($command->execute()!==false){
										

						//Modify Settings Values																				
						$command=$connection->createCommand("UPDATE gxc_settings SET `value` = :v where `category` = :c and `key` = :k ");
                        $command->bindValue(':c','general',PDO::PARAM_STR);
                        $command->bindValue(':k','site_name',PDO::PARAM_STR);
                        $command->bindValue(':v',b64_serialize($model->app_name),PDO::PARAM_STR);                                                
                        $command->execute();

						$command=$connection->createCommand("UPDATE gxc_settings SET `value` = :v where `category` = :c and `key` = :k ");
                        $command->bindValue(':c','general',PDO::PARAM_STR);
                        $command->bindValue(':k','site_title',PDO::PARAM_STR);
                        $command->bindValue(':v',b64_serialize($model->site_title),PDO::PARAM_STR);                                                
                        $command->execute();


                      	$command=$connection->createCommand("UPDATE gxc_settings SET `value` = :v where `category` = :c and `key` = :k ");
                        $command->bindValue(':c','general',PDO::PARAM_STR);
                        $command->bindValue(':k','site_description',PDO::PARAM_STR);
                        $command->bindValue(':v',b64_serialize($model->site_description),PDO::PARAM_STR);                                                
                        $command->execute();

						$command=$connection->createCommand("UPDATE gxc_settings SET `value` = :v where `category` = :c and `key` = :k ");
                        $command->bindValue(':c','system',PDO::PARAM_STR);
                        $command->bindValue(':k','support_email',PDO::PARAM_STR);
                        $command->bindValue(':v',b64_serialize($model->admin_email),PDO::PARAM_STR);                                                
                        $command->execute();

                        $command=$connection->createCommand("UPDATE gxc_settings SET `value` = :v where `category` = :c and `key` = :k ");
                        $command->bindValue(':c','system',PDO::PARAM_STR);
                        $command->bindValue(':k','page_size',PDO::PARAM_STR);
                        $command->bindValue(':v',b64_serialize('10'),PDO::PARAM_STR);                                                
                        $command->execute();

                        $command=$connection->createCommand("UPDATE gxc_settings SET `value` = :v where `category` = :c and `key` = :k ");
                        $command->bindValue(':c','general',PDO::PARAM_STR);
                        $command->bindValue(':k','homepage',PDO::PARAM_STR);
                        $command->bindValue(':v',b64_serialize('home'),PDO::PARAM_STR);                                                
                        $command->execute();

                        $command=$connection->createCommand("UPDATE gxc_settings SET `value` = :v where `category` = :c and `key` = :k ");
                        $command->bindValue(':c','system',PDO::PARAM_STR);
                        $command->bindValue(':k','keep_file_name_upload',PDO::PARAM_STR);
                        $command->bindValue(':v',b64_serialize('0'),PDO::PARAM_STR);                                                
                        $command->execute();         

                        $command=$connection->createCommand("UPDATE gxc_user SET `password` = :p where `username` = :n ");
                        $command->bindValue(':p',PassHash::hash('123456'),PDO::PARAM_STR);
                        $command->bindValue(':n','admin',PDO::PARAM_STR);                        
                        $command->execute(); 

                        $command=$connection->createCommand("UPDATE gxc_user SET `password` = :p where `username` = :n ");
                        $command->bindValue(':p',PassHash::hash('123456'),PDO::PARAM_STR);
                        $command->bindValue(':n','reporter',PDO::PARAM_STR);                        
                        $command->execute();                                       


						// Modify Environments						
						$apps=GxcHelpers::getAllApps(true);

						foreach($apps as $app){
							$env=file_get_contents($app.DIRECTORY_SEPARATOR.'protected'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'environment.php');
							if(strpos($app,'backend')!==false){
								//Backend, Apply its environment
								$env=str_replace('{{site_path}}',$backend_path,$env);

							}
							if(strpos($app,'web')!==false){
								//Web, Apply its environment
								$env=str_replace('{{site_path}}',$web_path,$env);
							}
							$env=str_replace('{{site_name}}',$model->app_name,$env);
							$env=str_replace('{{resource_url}}',$model->url_resource_path,$env);
							$env=str_replace('{{timezone}}',$model->timezone,$env);
							$env=str_replace('{{admin_email}}',$model->admin_email,$env);
							$env=str_replace('{{db_connect_string}}',$string_connection,$env);
							$env=str_replace('{{db_username}}',$model->db_username,$env);
							$env=str_replace('{{db_password}}',$model->db_password,$env);

							file_put_contents($app.DIRECTORY_SEPARATOR.'protected'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'environment.php',$env);
						}
								
						//Create lock file in COMMON folder
						if(!file_put_contents(COMMON_FOLDER.DIRECTORY_SEPARATOR.'.locked', 'installed')){
							echo "Error while creating locking install file!";
						} else {
							$this->redirect($path);							
						}

					} else {
						echo "Error while installing! Please check config file and try again";					
					}									
				} else {
					echo "Can't file data.sql file in COMMON FOLDER";
				}				
			}
			$this->render('index',array('model'=>$model));			
		}
		Yii::app()->end();

	}

}
