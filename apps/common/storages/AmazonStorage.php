<?php

/**
 * Class for handle Upload to Amazon S3 Storage
 * 
 * 
 * @author Tuan Nguyen <nganhtuan63@gmail.com>
 * @version 1.0
 * @package common.storages
 */

class AmazonStorage
{
	  public $max_file_size=UPLOAD_MAX_SIZE;
	  public $min_file_size=UPLOAD_MIN_SIZE;
	  public $allow_types=array();
	  
	  public function __construct($max_file_size=UPLOAD_MAX_SIZE,$min_file_size=UPLOAD_MIN_SIZE,$allow_types=array()) {
	  		$this->max_file_size=$max_file_size;
			$this->min_file_size=$min_file_size;
			$this->allow_types=$allow_types;
	  }   
	  
	  public function UploadFile(&$resouce,$model,&$process,&$message){
	  	
			//Implement later
	  		/*
	  		$file=$model->upload->tempName;
			$resouce->resource_name=$model->upload->name;
			$pvars   = array('remote'=>false,'my_file' => "@$file", 'key' => $es_key,
				 'upload'=>'upload',
				 'type'=>$model->type,
				 'name'=>trim($model->name)!='' ? trim($model->name) : $model->upload->name,
				 'body'=>trim($model->body),
				 'ext'=>strtolower(CFileHelper::getExtension($model->upload->name)));
				$timeout = 30;
				$curl    = curl_init();
		        $es_url = $model->type == 1 ? Yii::app()->getModule('mresource')->es_url_upload : Yii::app()->getModule('mresource')->video_es_url_upload;
				curl_setopt($curl, CURLOPT_URL, $es_url);
				curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
				curl_setopt($curl, CURLOPT_POST, 1);
				curl_setopt ($curl, CURLOPT_FOLLOWLOCATION, 1);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);    
				$res_upload = curl_exec($curl);
				curl_close ($curl);
				if($res_upload=='0'){
				    $process=false;
				    $message=t('Error while Uploading. Try again later.');			
				    return false;
				} else{
				    $resouce->resource_path=$res_upload;		    		    
				    $process=true;
				    return true;
				}
			 * 
			 */
			$process=false;
		    $message=t('Amazon S3 Upload is currently not supported. Try again later!');			
		    return false;
	  }
	  
	  public function getRemoteFile(&$resouce,$model,&$process,&$message,$path,$ext,$changeresname=true){
	  		$process=false;
		    $message=t('Amazon S3 Upload is currently not supported. Try again later!');			
		    return false;
	  }
	  
	  
	  public function getFilePath($file){
	  		return '';
	  }
	  
	  public function deleteResource($resource){	  		
			return;
	  }
	   	
}
