<?php

/**
 * Class for handle File from external
 * 
 * 
 * @author Tuan Nguyen <nganhtuan63@gmail.com>
 * @version 1.0
 * @package common.storages
 */

 //This is a must Have Resource Class - Don't Delete this
class ExternalStorage
{
	  public $max_file_size=ConstantDefine::UPLOAD_MAX_SIZE;
	  public $min_file_size=ConstantDefine::UPLOAD_MIN_SIZE;
	  public $allow_types=array();
	  
	  public function __construct($max_file_size=ConstantDefine::UPLOAD_MAX_SIZE,$min_file_size=ConstantDefine::UPLOAD_MIN_SIZE,$allow_types=array()) {
	  		$this->max_file_size=$max_file_size;
			$this->min_file_size=$min_file_size;
			$this->allow_types=$allow_types;
	  }
	   	  	  	  	 
	  public function UploadFile(){
	  		return true;
	  }
	  
	  public function getFilePath($file){
	  		return $file;
	  }
	  
	  public function deleteResource($resource){	  		
			return;
	  }
	   	
}
