<?php
/**
 * Manage Cache Controller.
 * 
 * @author Tuan Nguyen <nganhtuan63@gmail.com>
 * @version 1.0
 * @package cms.modules.cache.controllers
 *
 */
class ManageController extends BeController{
	
	
	public $defaultAction='clear';

	public function init(){
		
	}

	public function actionClear(){
	 	$type=isset($_REQUEST['type']) ? (int)$_REQUEST['type'] : 0;
        $key=isset($_REQUEST['key']) ? $_REQUEST['key'] : '';        
		if($_POST['key']==CLEAR_CACHE_KEY){
			 switch ($type) {
	        	case 0:
	        		if (Yii::app()->$cache instanceof CApcCache)
					{
						// Not support Cache for APC Cache
						echo -1;
					}
					else if (Yii::app()->$cache->flush())
					{
						echo 1;
					}
					else
					{
						echo 0;
					}
	        		break;
	        	case 1:
	        		# Clear Asset Cache
	        		$path=Yii::setPathOfAlias('webroot.assets');
	        		$get_sub_folders=get_subfolders_name($path);
					foreach($get_sub_folders as $folder){
						recursive_remove_directory($path.DIRECTORY_SEPARATOR.$folder);
					}															
	        		echo 1;	        	       	        	
	        		break;
	        }									
		}										              		            	 
		else{
			echo '0';										
		}
		Yii::app()->end();
	}
}
