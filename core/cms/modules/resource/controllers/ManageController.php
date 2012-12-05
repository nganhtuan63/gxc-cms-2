<?php
/**
 * Backend Resource Manage Controller.
 * 
 * @author Tuan Nguyen <nganhtuan63@gmail.com>
 * @version 1.0
 * @package cms.modules.resource.controllers
 *
 */

class ManageController extends BeController{      

	public function __construct($id,$module=null)
	{
		 parent::__construct($id,$module);
                 $this->menu=array(
                        array('label'=>t('cms','Manage Resource'), 'url'=>array('admin'),'linkOptions'=>array('class'=>'button')),
                        array('label'=>t('cms','Add Resource'), 'url'=>array('create'),'linkOptions'=>array('class'=>'button')),
                );
		 
	}
                 
    /**
	 * The function that do Create new Resource
	 * 
	 */
	public function actionCreate()
	{		                
		$model=new ResourceUploadForm;
 		$is_new=true;     
		$process=true;   
		$types_array=ConstantDefine::fileTypes();
        // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='resource-form')
        {
                echo CActiveForm::validate($model);
                Yii::app()->end();
        }

        // collect user input data
        if(isset($_POST['ResourceUploadForm']))
        {                
				$model->attributes=$_POST['ResourceUploadForm'];												
            	$model->upload=CUploadedFile::getInstance($model,'upload');		
				$allow_types=array();		
				$max_size=UPLOAD_MAX_SIZE;
				$min_size=UPLOAD_MIN_SIZE;
                
				$resource = new Resource;        
               
			   //Is it has content type and resource type params?			   			    			   
                $content_type_param=isset($_GET['content_type']) ? trim($_GET['content_type']) : '';
				$resource_type_param=isset($_GET['type']) ? trim($_GET['type']) : '';

				if(($content_type_param!='')&&($resource_type_param!='')){  
					//Get content type	
					$types=GxcHelpers::getAvailableContentType();
					if(isset($types[$content_type_param])){						
						Yii::import('common.content_type.'.$content_type_param.'.'.$types[$content_type_param]['class']);
						//Init content type class
						$typeClassObj = new $types[$content_type_param]['class'];
						//Get Resource lists
						$resources=$typeClassObj->Resources();						
						if(isset($resources[$resource_type_param])){
							$allow_types=$resources[$resource_type_param]['allow'];
							$max_size=$resources[$resource_type_param]['maxSize'];
							$min_size=$resources[$resource_type_param]['minSize'];
						}  
					}					

				}
			    $resource->resource_type=$model->type;                                               
                if($model->link!=''){
                    $temp_ext=strtolower(substr($model->link, -4));
                    if($temp_ext[0]!='.'){
                       $model->addError('link',  t('cms','File not valid'));
                       $process=false;
                    } else {
                        //Need to check if Image File Type
                        $ext=substr($temp_ext,-3);
                        if($model->type=='image'){ //It is Image                        
                        	//Get Images array                        
                            if(!in_array(strtolower($ext),$types_array['image'] )){
                                $model->addError('link',  t('cms','Not valid Image'));
                                $process=false;
                            } else {
                                //Start to Save to the Remote File
                                                                
                                if(!GxcHelpers::getRemoteFile($resource,$model,$process,$message,$model->link,$ext,true,$max_size,$min_size,$allow_types)){
                                    $model->addError('link',  t('cms','Error while saving Image'));
                                    $process=false;
                                }
                            }
                            
                        } else {
                            $explode_name=explode('/',$model->link);
                            $resource->resource_name=$explode_name[count($explode_name)-1];
                            $resource->resource_path=trim($model->link);         
														
							//Implement to check types of the external resource here
							$resource->resource_type='file';
							$resource->where='external';
										                   
                            $process=true;
                        }                       
                    }                    
                } else {
                	
                    if($model->upload!=null){
                    		
                    	$storages=GxcHelpers::getStorages(true);
						//We won't allow external storage for Upload File
						//Unless we use Amazon S3							
						if($model->where=='external'){
							$model->where='local';
						}																		
						//First we need to check if the file size is allowed?
						$upload_handle=new $storages[$model->where]($max_size,$min_size,$allow_types);											
						if(!$upload_handle->uploadFile($resource,$model,$process,$message)){
							$model->addError('upload', $message);
							$process=false;
						}
											                       
                     } else {
                        $model->addError('upload', 'Choose File before Upload');
						$process=false;
                     }                     
                }
                if($process){
                    if($model->name!=''){
                        $resource->resource_name=trim($model->name);						
                    }
					$resource->where=$model->where;					
					$resource->resource_type=$model->type;
                    $resource->resource_body=trim($model->body);  										                  
                    if($resource->save()){
                    	if((isset($_GET['parent_call']))){
                    		$this->render('resource_upload_iframe_return',array('resource'=>$resource));
							Yii::app()->end();
                    	} else {
                    		user()->setFlash('success',t('cms','Create new Resource Successfully!'));
							Yii::app()->controller->redirect(array('create'));
                    		}                                 
                    	}
                    	
					
                }
				
				
        }

        $this->render('resource_create',array('model'=>$model,'is_new'=>$is_new,'types_array'=>$types_array));
	}
        
		
	/**
	 * The function that do Create new Resource
	 * 
	 */
	public function actionCreateFrame()
	{
		$this->layout='clean';		                
		$this->actionCreate();
	}
        	
       
        
        /**
	 * The function that do Manage Resource
	 * 
	 */
	public function actionAdmin()
	{                
		GxcHelpers::renderManageModel('Resource');
	}
        
        /**
	 * The function that view Resource details
	 * 
	 */
	public function actionView()
	{         
              $id=isset($_GET['id']) ? (int) ($_GET['id']) : 0 ;
              $this->menu=array_merge($this->menu,                       
                        array(
                            array('label'=>t('cms','Update this Resource'), 'url'=>array('update','id'=>$id),'linkOptions'=>array('class'=>'button')),
                            array('label'=>t('cms','View this Resource'), 'url'=>array('view','id'=>$id),'linkOptions'=>array('class'=>'button'))
                        )
                    );
		GxcHelpers::renderViewModel('Resource');
	}
        
     /**
	 * The function that update Resrouce
	 * 
	 */
	public function actionUpdate()
	{                
        $id=isset($_GET['id']) ? (int) ($_GET['id']) : 0 ;                
        $this->menu=array_merge($this->menu,                       
                        array(
                            array('label'=>t('cms','Update this Resource'), 'url'=>array('update','id'=>$id),'linkOptions'=>array('class'=>'button')),
                            array('label'=>t('cms','View this Resource'), 'url'=>array('view','id'=>$id),'linkOptions'=>array('class'=>'button'))
                        )
                    );
                $model=new ResourceUploadForm;
 		$is_new=false;     
		$process=true;   
		$types_array=ConstantDefine::fileTypes();
		
		$id=isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $resource= GxcHelpers::loadDetailModel('Resource', $id);
		
		if($resource){
			$model->name=$resource->resource_name;
			$model->body=$resource->resource_body;
			$model->where=$resource->where;
			$model->type=$resource->resource_type;    
		}
        // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='resource-form')
        {
                echo CActiveForm::validate($model);
                Yii::app()->end();
        }
        // collect user input data
        if(isset($_POST['ResourceUploadForm']))
        {                
				$model->attributes=$_POST['ResourceUploadForm'];	
				$resource->resource_name=$model->name;															            
				$resource->resource_body=$model->body;
				$resource->resource_type=$model->type;
				if($resource->save()){
					user()->setFlash('success',t('cms','Update Resource Successfully!'));
				}
				
        }

        $this->render('resource_update',array('model'=>$model,'is_new'=>$is_new,'types_array'=>$types_array));
	}
        
        
        /**
	 * The function is to Delete Menu
	 * 
	 */
	public function actionDelete($id)
	{                            
          GxcHelpers::deleteModel('Resource', $id);          
	}
}