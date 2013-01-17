<?php
/**
 * Helpers Class for whole CMS
 * 
 * 
 * @author Tuan Nguyen <nganhtuan63@gmail.com>
 * @version 1.0
 * @package backend.components
 */
class GxcHelpers {
    
	/**
	* Function to Help Load Model Detail
	**/
    public static function loadDetailModel($model_name,$id){    
            $model=call_user_func(array($model_name, 'model'))->findByPk((int)$id);
            if($model===null)
                    throw new CHttpException(404,t('cms','The requested page does not exist.'));
            return $model;	
    }

	/**
	* Function to Help Delete Model Detail
	**/    
    public static function deleteModel($model_name,$id){
            if(Yii::app()->request->isPostRequest){
                    // we only allow deletion via POST request
                   GxcHelpers::loadDetailModel($model_name, $id)->delete();
                    // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                    if(!isset($_GET['ajax']))
                            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            } else
                    throw new CHttpException(400,t('cms','Invalid request. Please do not repeat this request again.'));
    }

     
    /**
	* Function to Render Admin Model
	**/ 
    public static function renderManageModel($model_name=''){       
	    if($model_name!=''){
	        
	        $model=new $model_name('search');            
	        $model->unsetAttributes();  // clear any default values
	        if(isset($_GET[$model_name]))
	                $model->attributes=$_GET[$model_name];                               
	        Yii::app()->controller->render(strtolower($model_name).'_admin',array('model'=>$model));
	    } else {
	        throw new CHttpException(404,t('cms','The requested page does not exist.'));
	    }
	}

	/**
	* Function to Render View Model
	**/ 
	public static  function renderViewModel($model_name=''){     
	    if($model_name!=''){
	        $id=isset($_GET['id']) ? (int)$_GET['id'] : 0 ;       
	        $model=GxcHelpers::loadDetailModel($model_name, $id);
	        Yii::app()->controller->render(strtolower($model_name).'_view',array('model'=>$model));
	    } else {
	        throw new CHttpException(404,t('cms','The requested page does not exist.'));
	    }
	}

	/**
	* Function to Get Available Layouts 
	**/    
    public static function getAvailableLayouts($render_view=false){
    	
			$cache_id= $render_view ? 'gxchelpers-available-layouts' : 'gxchelpers-available-layouts-false';
    		$layouts=Yii::app()->cache->get($cache_id);	    		 		
			
			if($layouts===false)
			{
			    //Need to implement Cache HERE                    
	            $layouts = array();            
	            $folders = get_subfolders_name(Yii::getPathOfAlias('common.layouts')) ;    
	            foreach($folders as $folder){
	                $temp=parse_ini_file(Yii::getPathOfAlias('common.layouts.'.$folder.'').DIRECTORY_SEPARATOR.'info.ini');
	                 if($render_view)
	                    $layouts[$temp['id']]=$temp['name'];
	                 else 
	                    $layouts[$temp['id']]=$temp;
	            }  
			    Yii::app()->cache->set($cache_id,$layouts,7200);
			}
			                             
            return $layouts;            
    }

   
	/**
	* Function to Get Available Settings
	**/    
    public static function getAvailableSettings($render_view=false){
    	
			$cache_id= $render_view ? 'gxchelpers-available-settings' : 'gxchelpers-available-settings-false';
    		$settings=Yii::app()->cache->get($cache_id);	    		 		
			
			if($settings===false)
			{
			                
	            $layouts = array();            
	            $folders = get_subfolders_name(Yii::getPathOfAlias('common.settings')) ;    
	            foreach($folders as $folder){
	                $temp=parse_ini_file(Yii::getPathOfAlias('common.settings.'.$folder.'').DIRECTORY_SEPARATOR.'info.ini');
	                 if($render_view)
	                    $settings[$temp['id']]=$temp['name'];
	                 else 
	                    $settings[$temp['id']]=$temp;
	            }  
			    Yii::app()->cache->set($cache_id,$settings,7200);
			}
			                             
            return $settings;            
    }	
	
	/**
	* Function to Get Available Blocks
	**/    
    public static function getAvailableBlocks($render_view=false){
	
	
    		$cache_id= $render_view ? 'gxchelpers-available-blocks' : 'gxchelpers-available-blocks-false';
    		$blocks=Yii::app()->cache->get($cache_id);	
						
			if($blocks===false){				                  
	            $blocks = array();      
				$rootpath = Yii::getPathOfAlias('common.blocks');      
				$fileinfos = new RecursiveIteratorIterator(
				    new RecursiveDirectoryIterator($rootpath)
				);	        
	    		foreach($fileinfos as $pathname => $fileinfo) {								
					 if ((!$fileinfo->isFile())) continue;			
						$type=substr($pathname,-3);
					if($type=='ini'){							
						$temp=parse_ini_file($pathname);
						if($render_view){
							$blocks[$temp['id']]=$temp['name'];								
						}		                    
		                 else 
		                    $blocks[$temp['id']]=$temp;
					}					    
				}					
				Yii::app()->cache->set($cache_id,$blocks,7200);   
			}
			            
            return $blocks;
    }

	/**
	* Function to Get Available Storages
	**/
	
	public static function getStorages($get_class=false){		
		$cache_id= $get_class ? 'gxchelpers-storages' : 'gxchelpers-storages-false';
    	$types=Yii::app()->cache->get($cache_id);		
		if($types===false){
			$temp=parse_ini_file(Yii::getPathOfAlias('common.storages.'.'').DIRECTORY_SEPARATOR.'info.ini');								
			$types=array();		
			foreach ($temp['storages'] as $key=>$value){
				if(!$get_class)				
					$types[$key]=trim(ucfirst($key));
				else {
					$types[$key]=trim($value);
				}		
			}
			Yii::app()->cache->set($cache_id,$types,7200);
		}
				
		return $types;
	}

	/**
	* Function to Get All Apps Available
	**/
	
	public static function getAllApps($return_path=false){		
		$cache_id='gxchelpers-apps';
    	$apps=Yii::app()->cache->get($cache_id);		
		if($apps===false){
			$apps=array();
			$folders_app = get_subfolders_name(Yii::getPathOfAlias('common').DIRECTORY_SEPARATOR.'..') ;    
	        foreach($folders_app as $folder){	 	        	
	        	if(file_exists(Yii::getPathOfAlias('common').DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.$folder.DIRECTORY_SEPARATOR.'protected'
	        		.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'environment.php')){
	        		if(!$return_path) $apps[]=$folder; 
	        		else
	        			$apps[]=realpath(Yii::getPathOfAlias('common').DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.$folder); 
	        	}
	        		         	        	
	        }  	        
			Yii::app()->cache->set($cache_id,$apps,7200);
		}
				
		return $apps;
	}
	
	/**
	 * Publish Assets with cache support
	 * 
	 */
	public static function publishAsset($path,$hashByName=false,$level=-1) 
	{
		
		$cache_id= YII_DEBUG ? false : 'asset'.$path.'-1';						
		if($cache_id && file_exists($cache_id)){
			$cache=Yii::app()->cache->get($cache_id);
			if($cache===false){

				$cache=Yii::app()->assetManager->publish($path,$hashByName,-1,YII_DEBUG);			
				Yii::app()->cache->set($cache_id,$cache,7200);
			} 

		} else {			
			$cache=Yii::app()->assetManager->publish($path,$hashByName,-1,YII_DEBUG);			
		}
		
		return $cache;				
	}
       
 	/**
	* Function to Get Content Type
	**/
   
    public static function getAvailableContentType($render_view=false){
    		$cache_id= $render_view ? 'gxchelpers-content-types' : 'gxchelpers-content-types-false';
    		$types=Yii::app()->cache->get($cache_id);				
			if($types===false){
				$types = array();        				
	            $folders = get_subfolders_name(Yii::getPathOfAlias('common.content_type')) ;   						 
	            foreach($folders as $folder){
	                $temp=parse_ini_file(Yii::getPathOfAlias('common.content_type.'.$folder.'').DIRECTORY_SEPARATOR.'info.ini');
	                 if($render_view)
	                    $types[$temp['id']]=$temp['name'];
	                 else 
	                    $types[$temp['id']]=$temp;
	            }   
				Yii::app()->cache->set($cache_id,$types,7200);
			}                    
                
            			
            return $types;
    }
	
	/**
	* Function to Get Content Class
	**/

	public static function getClassOfContent($type){
			$cache_id='class-of-content-type'.$type;
			$class_name=Yii::app()->cache->get($cache_id);
			if($class_name===false){
				$types=self::getAvailableContentType();
				if(isset($types[$type])){
					$class_name=$types[$type]['class'];
					Yii::app()->cache->set($cache_id,$class_name,7200);
				} else {
					$class_name='Object';
				}	
			}
			
			return $class_name;
			
			
	}
	
	/**
	* Function to Get Remote File
	**/
	
	public static function getRemoteFile(&$resource,$model,&$process,&$message,$path,$ext,$changeresname=true,$max_size,$min_size,$allow=array()){
				
		if(GxcHelpers::remoteFileExists($path)){
			$storages=GxcHelpers::getStorages(true);		
			$upload_handle=new $storages[$model->where]($max_size,$min_size,$allow);									
			if(!$upload_handle->getRemoteFile($resource,$model,$process,$message,$path,$ext,true)){
				$model->addError('upload', $message);
			} else {
				$process=true;
				return true;
			} 
			
		} else {
			$process=false;
			$message=t('cms','Remote file not exist');
			return false;
		}

	}

	/**
	* Check Remote File exists
	**/
	public static function remoteFileExists($url) {
		$curl = curl_init($url);
	    
		//don't fetch the actual page, you only want to check the connection is ok
		curl_setopt($curl, CURLOPT_NOBODY, true);
	    
		//do request
		$result = curl_exec($curl);
	    
		$ret = false;
	    
		//if request did not fail
		if ($result !== false) {
		    //if request was ok, check response code
		    $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);  
	    
		    if ($statusCode == 200) {
			$ret = true;   
		    }
		}
	    
		curl_close($curl);
	    
		return $ret;
	}
		
	
	/**
	* Function to Render TextBox of Resource CGridView
	**/
	public static function renderTextBoxResourcePath($data){
		return '<input type="text" class="pathResource" onClick="return selectAllText(this);" value="'.$data->getFullPath().'" />';
	}
	
	/**
	* Function to Render Link Preview Resource
	**/
	public static function renderLinkPreviewResource($data){
		switch($data->resource_type){
			case 'image':
				return '<a href="'.$data->getFullPath().'" rel="prettyPhoto" title="'.$data->resource_name.'">'.t('cms','View').'</a>';
				break;
			case 'video':
				return '<a href="'.bu().'/js/jwplayer/player.swf?width=470&amp;height=320&flashvars=file='.$data->getFullPath().'" title="'.$data->resource_name.'" rel="prettyPhoto">'.t('cms','View').'</a>';
				break;
			default:
				return '<a href="'.$data->getFullPath().'">'.t('cms','View').'</a>';
				break;
				
		}
		
	}
	
	/**
	* Function to get Array Resource Object Binding
	**/
	public static function getArrayResourceObjectBinding($ownid){
		       
			   
        $upload_files=array();
		
		
		if(!isset($_POST['upload_id_'.$ownid.'_link'])){
			$arr_file_link=array();						
			return $upload_files;
		} 
		if(!isset($_POST['upload_id_'.$ownid.'_resid'])){
			$arr_file_resid=array();
			return $upload_files;
		}
		
		if(!isset($_POST['upload_id_'.$ownid.'_type'])){
			$arr_file_type=array();
			return $upload_files;
		}
		
		$arr_file_link=isset($_POST['upload_id_'.$ownid.'_link']) ? $_POST['upload_id_'.$ownid.'_link'] : array() ;
		$arr_file_resid=isset($_POST['upload_id_'.$ownid.'_resid']) ? $_POST['upload_id_'.$ownid.'_resid'] : array() ;
		$arr_file_type=isset($_POST['upload_id_'.$ownid.'_type']) ? $_POST['upload_id_'.$ownid.'_type'] : array() ;
		if(count($arr_file_link)>0){
            for($i=0; $i<count($arr_file_link);$i++){
                $file=array();
                $file['link']=$arr_file_link[$i];                
                $file['resid']=$arr_file_resid[$i];
				$file['type']=$arr_file_type[$i];
                $upload_files[]=$file;
            }
    	} 			            	
		
		return $upload_files;   
	}
	
	/**
	* Function to get Resource Object From Database
	**/
	public static function getResourceObjectFromDatabase($model,$key){
		$upload_files=array();		
		$resources=ObjectResource::model()->findAll(array(
									    'condition'=>'object_id = :obj and type = :type',
									    'order' =>'resource_id ASC',
									    'limit'=>$model->total_number_resource > 0 ? $model->total_number_resource : 1 ,
									    'params'=> array(':obj'=>$model->object_id,':type'=>$key)));
		if($resources & count($resources)>0){
			foreach($resources as $res) {
				if($find_resource=Resource::model()->findByPk($res->resource_id)){
					$file=array();
	                $file['link']=$find_resource->getFullPath();                
	                $file['resid']=$find_resource->resource_id;
					$file['type']=$find_resource->resource_type;
	                $upload_files[]=$file;
				}
				
			}
		}								
										
										
		return $upload_files;
		
	}
	
	/**
	* Function to get Object Meta
	**/
	
	public static function getObjectMeta($id,$meta){
		$object_meta=ObjectMeta::model()->find('(meta_object_id = :id) and (meta_key=:meta_key)',array(':id'=>$id,':meta_key'=>$meta));
		if($object_meta){
			return $object_meta->meta_value;
		} else {
			return null;
		}
	}

	/**
	* Function to Get Available Settings
	**/    
    public static function getAvailableLanguages($render_view=false){
    	
			$cache_id= $render_view ? 'gxchelpers-available-languages' : 'gxchelpers-available-languages-false';
    		$langs=Yii::app()->cache->get($cache_id);	    		 		
			
			if($langs===false)
			{			                
	            $layouts = array();            
	            $folders = get_subfolders_name(Yii::getPathOfAlias('common.messages')) ;    
	            foreach($folders as $folder){
	                $temp=parse_ini_file(Yii::getPathOfAlias('common.messages.'.$folder.'').DIRECTORY_SEPARATOR.'info.ini');
	                 if($render_view)
	                    $langs[$temp['id']]=$temp['name'];	                	
	                 else 
	                    $langs[$temp['id']]=$temp;
	            }  
			    Yii::app()->cache->set($cache_id,$langs,7200);
			}
            return $langs;            
    }	

	/**
	 * Encode the text into a string which all white spaces will be replaced by $rplChar
	 * @param string $text	text to be encoded
	 * @param Char $rplChar character to replace all the white spaces
	 * @param boolean upWords	set True to uppercase the first character of each word, set False otherwise
	 */
	public static function encode($text, $rplChar='', $upWords=true)
	{
		$encodedText = null;
		if($upWords)
		{
			$encodedText = ucwords($text);
		}
		else 
		{
			$encodedText = strtolower($text);
		}
		
		if($rplChar=='')
		{
			$encodedText = preg_replace('/\s[\s]+/','',$encodedText);    // Strip off multiple spaces
			$encodedText = preg_replace('/[\s\W]+/','',$encodedText);    // Strip off spaces and non-alpha-numeric
		}
		else
		{
			$encodedText = preg_replace('/\s[\s]+/',$rplChar, $encodedText);    // Strip off multiple spaces
			$encodedText = preg_replace('/[\s\W]+/',$rplChar, $encodedText);    // Strip off spaces and non-alpha-numeric
			$encodedText = preg_replace('/^[\\'.$rplChar.']+/','', $encodedText); // Strip off the starting $rplChar
			$encodedText = preg_replace('/[\\'.$rplChar.']+$/','',$encodedText); // // Strip off the ending $rplChar
		}
		return $encodedText;
		
	}

	/**
     * Load Items Language
     * @param type $exclude 
     */
	public static function loadLanguageItems($exclude=array(),$desc=true)
	{

		$langs=self::getAvailableLanguages();
		if(count($exclude)>0){
			foreach ($exclude as $e) {
				if (isset($langs[$e])) unset($langs[$e]);
			}
		} 				
		if(count($langs)>0){
			$items=array();
			foreach ($langs as $key => $value) {
				if($desc)
					$items[$key]=$value['name'];
				else
					$items[$key]=$value['lang'];
			}		
			return $items;
		} else {
			Yii::app()->getController()->redirect('admin');				
		}	    	 	    	   
		
	}
    

    public static function mainLanguage()
	{
		// We return the first language ID
		$langs=self::getAvailableLanguages();				
		return $langs[key($langs)]['id'];		
	}
        
    public static function convertLanguage($id){
    	$langs=self::getAvailableLanguages();
    	if(isset($langs[$id]))
    		return $langs[$id]['name'];
    	else 
    		return '';
    }
	/**
	* Function to get Object Content List
	**/
	public static function getContentList($cl_id, $max=null, $paging=null, $return_type=ConstantDefine::CONTENT_LIST_RETURN_ACTIVE_RECORD) {
        	$model=ContentList::model()->findByPk($cl_id);
			//Find the content list model first	
        	$condition = 't.object_status = :status and t.object_date < :time';
			$params = array(':status'=>ConstantDefine::OBJECT_STATUS_PUBLISHED, ':time'=>time()) ;
			if($paging == 0) $page_number = 1;
			else $page_number = $model->paging;

				if (isset($model)) {
					if ($model->type == ConstantDefine::CONTENT_LIST_TYPE_AUTO) {    //auto

						$criteria_field = 'object_date DESC';                                                                         

						//object_type
						if (isset($model->content_type)) {
							$content_types = $model->content_type;

							if ($content_types[0] != 'all') {	                        
								$condition .= ' AND (0';
								foreach ($content_types as $type) {
									$condition .= ' or object_type="'.$type.'"';
								}
								$condition .= ')';    
							}                         
						}

						//terms
						if (isset($model->terms)) {
							$content_terms = $model->terms;
							if ($content_terms[0] != '0') {	                        
								$condition .= ' AND (0';
								foreach ($content_terms as $term) {
									$condition .= ' or (object_id in (select object_id from `{{object_term}}` where term_id='.$term.'))';
								}
								$condition .= ')';    
							}    
						}

						//tags
						if (isset($model->tags) && $model->tags != '') {
							$tags = $model->tags;
							$tag_list = explode(',', $tags);
                                                
							$tag_id_list = '';
							foreach ($tag_list as $k => $tag_name) {
								if ($tag_name == ' ') {
									unset($tag_list[$k]);
								}
							}
                                                
							foreach ($tag_list as $k => $tag_name) {
								if ($tag_name != ' ') {
									$id = Yii::app()->db->createCommand()->select('id')->from('gxc_tag')->where('name=:name', array(':name'=>trim($tag_name)))->queryRow();
									$tag_id_list .= $id['id'];

									if ($k != sizeof($tag_list) - 1) {
										$tag_id_list .= ',';
									}
								}
							}
							
							$condition .= ' or (object_id in (select object_id from `{{tag_relationships}}` where tag_id in (' . $tag_id_list . ')))';
						}
                                                
						//criteria not newest
						if ($model->criteria != ConstantDefine::CONTENT_LIST_CRITERIA_NEWEST) {
							$criteria_field = 'object_view DESC';                                             
						}      

						if ($return_type == ConstantDefine::CONTENT_LIST_RETURN_DATA_PROVIDER && $model->number >=1) { 

							$sort = new CSort('Object');
							$sort->defaultOrder='t.object_date DESC';
							$sort->attributes = array('object_view' => array('asc'=>'object_view ASC',
													  						 'desc'=>'object_view DESC',
																			),
													  'object_date'=>array('asc'=>'t.object_date ASC',
                                                                    	   'desc'=>'t.object_date DESC',
                                                            			  ),
                                                    );                    

							return new CActiveDataProvider('Object',array('criteria'=>array('condition'=>$condition,
                                                                          					'order'=>$criteria_field,
                                                                          					'params'=>$params,
                                                                          					'limit'=>isset($max)?$max:$model->number,                                
                                                                		 				   ),
			                                                               'pagination'=>array('pageSize'=>isset($max)?$max:$model->number*$page_number, 
			                                                                        		   'pageVar'=>'page'
			                                                                				  ),
																		   'sort'=>$sort,));                
						}

						return Object::model()->findAll(array('condition'=>$condition,
                                                              'params'=>$params,
                                                              'order'=>$criteria_field,
                                                              'limit'=>isset($max)?$max:$model->number));
					}
					else {
						//manual

						if (isset($model->manual_list)) {							
							$condition = '';
							$manual_list = $model->manual_list;
							$count = 0;
							$max=count($manual_list);

							foreach ($manual_list as $manual_id) {	                    
								if ($count == 0) {
									$condition_string = $manual_id;
								} else 
								$condition_string .= ','.$manual_id;

								if (isset($max) && $count == $max)
									break;
									$count++;
								}

								$condition = 'object_id IN ('.$condition_string.')';

								if ($return_type == ConstantDefine::CONTENT_LIST_RETURN_DATA_PROVIDER && count($manual_list)>=1) { 
									
																			return new CActiveDataProvider('Object',array('criteria'=>array('condition'=>$condition,
                                                                       				  					'params'=>$params,
                                                                       				  					'order'=>'FIELD(t.object_id, '.$condition_string.')'
                                                               						 				   ),
                                                               		   				  'pagination'=>array('pageSize'=>isset($max)?$max:$model->number*$page_number, 
                                                                       					   'pageVar'=>'page'

                                                               							  			),
                                                           							 )
																	 );
								} 

								return Object::model()->findAll(array('condition'=>$condition,                                        
                                                                      'params'=>$params,
                                                                      'order'=>'FIELD(t.object_id, '.$condition_string.')'
                                                                     ));
						}
					}
				}
				return null;              
		}
   


}
	