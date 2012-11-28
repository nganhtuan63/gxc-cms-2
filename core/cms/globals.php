<?php

/**
 * This is the shortcut to DIRECTORY_SEPARATOR
 */
defined('DS') or define('DS',DIRECTORY_SEPARATOR);
 
/**
 * This is the shortcut to Yii::app()
 */
function app()
{
    return Yii::app();
}
 
/**
 * This is the shortcut to Yii::app()->clientScript
 */
function cs()
{
    // You could also call the client script instance via Yii::app()->clientScript
    // But this is faster
    return Yii::app()->getClientScript();
}
 
/**
 * This is the shortcut to Yii::app()->user.
 */
function user() 
{
    return Yii::app()->getUser();
}
 
/**
 * This is the shortcut to Yii::app()->createUrl()
 */
function url($route,$params=array(),$ampersand='&')
{
    return Yii::app()->createUrl($route,$params,$ampersand);
}
 
/**
 * This is the shortcut to CHtml::encode
 */
function h($text)
{
    return htmlspecialchars($text,ENT_QUOTES,Yii::app()->charset);
}

/**
 * Set the key, value in Session
 * @param object $key
 * @param object $value
 * @return boolean 
 */
function setSession($key,$value){
    return Yii::app()->getSession()->add($key, $value);
}

/**
 * Get the value from key in Session
 * @param object $key
 *
 * @return object
 */
function getSession($key){
    return Yii::app()->getSession()->get($key);
}
 
/**
 * This is the shortcut to CHtml::link()
 */
function l($text, $url = '#', $htmlOptions = array()) 
{
    return CHtml::link($text, $url, $htmlOptions);
}

/**
 * This is the shortcut to Yii::t() with default category = 'stay'
 */
function t($category = 'cms', $message, $params = array(), $source = null, $language = null) 
{
    return Yii::t($category, $message, $params, $source, $language);
}


/**
 * This is the shortcut to Yii::app()->request->baseUrl
 * If the parameter is given, it will be returned and prefixed with the app baseUrl.
 */
function bu($url=null) 
{
    static $baseUrl;
    if ($baseUrl===null)
        $baseUrl=Yii::app()->getRequest()->getBaseUrl();
    return $url===null ? $baseUrl : $baseUrl.'/'.ltrim($url,'/');
}



/**
 * Returns the named application parameter.
 * This is the shortcut to Yii::app()->params[$name].
 */
function param($name) 
{
    return Yii::app()->params[$name];
}


/**
 * var_dump($varialbe) and exit
 * 
 */
function dump($a){
    var_dump($a);
    exit;
}

/**
 * Convert local timestamp to GMT
 * 
 */
function local_to_gmt($time = '')
{
if ($time == '')
$time = time();
return mktime( gmdate("H", $time), gmdate("i", $time), gmdate("s", $time), gmdate("m", $time), gmdate("d", $time), gmdate("Y", $time));
}

/**
 * Return the settings Component
 * @return type 
 */
function settings()
{
    return Yii::app()->settings;
}


/**
 * Get extension of a file
 * 
 */
function getExt($filename){
    return strtolower(substr(strrchr($fileName, '.'), 1));
}

/**
 * Get the current IP of the connection
 * 
 */
function ip() {
    if (isset($_SERVER)) {
    if(isset($_SERVER['HTTP_CLIENT_IP'])){
    $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    elseif(isset($_SERVER['HTTP_FORWARDED_FOR'])){
    $ip = $_SERVER['HTTP_FORWARDED_FOR'];
    }
    elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else{
    $ip = $_SERVER['REMOTE_ADDR'];
    }
    }
    else
    {
    if (getenv( 'HTTP_CLIENT_IP')) {
    $ip = getenv( 'HTTP_CLIENT_IP' );
    }
    elseif (getenv('HTTP_FORWARDED_FOR')) {
    $ip = getenv('HTTP_FORWARDED_FOR');
    }
    elseif (getenv('HTTP_X_FORWARDED_FOR')) {
    $ip = getenv('HTTP_X_FORWARDED_FOR');
    }
    else {
    $ip = getenv('REMOTE_ADDR');
    }
    }
    return $ip;
}

/**
 * Generate Unique File Name for the File Upload
 * 
 */
function gen_uuid($len=8) {

    $hex = md5(param('salt-file') . uniqid("", true));

    $pack = pack('H*', $hex);
    $tmp =  base64_encode($pack);

    $uid = preg_replace("/[^A-Za-z0-9]/", "", $tmp);

    $len = max(4, min(128, $len));

    while (strlen($uid) < $len)
        $uid .= gen_uuid(22);

    $res=substr($uid, 0, $len);
    return $res;
}

/**
* Get array of subfolders name
*/
function get_subfolders_name($path,$file=false){
    
    $list=array();    
    $results = scandir($path);
    foreach ($results as $result) {     
        if ($result === '.' or $result === '..' or $result === '.svn') continue;
        if(!$file) {
            if (is_dir($path . '/' . $result)) {
                $list[]=trim($result);
            }
        }
        else {          
            if (is_file($path . '/' . $result)) {
                $list[]=trim($result);
            }
        }
    }
    
    return $list;
}



/**
* Return Combine Url
*/
function InternetCombineUrl($absolute, $relative) {
 		if(substr($absolute, strlen($absolute)-1)!='/'){        		        		
        		$absolute.='/';
        	}
        $p = parse_url($relative);
        if(isset($p["scheme"]))return $relative;
        
        extract(parse_url($absolute));
        
        //$path = dirname($path); 
    	    	
        if($relative{0} == '/') {
            $cparts = array_filter(explode("/", $relative));
        }
        else {
            $aparts = array_filter(explode("/", $path));
            $rparts = array_filter(explode("/", $relative));
            $cparts = array_merge($aparts, $rparts);
            foreach($cparts as $i => $part) {
                if($part == '.') {
                    $cparts[$i] = null;
                }
                if($part == '..') {
                    $cparts[$i - 1] = null;
                    $cparts[$i] = null;
                }
            }
            $cparts = array_filter($cparts);
        }
        
        $path = implode("/", $cparts);
        $url = "";
        if(isset($scheme)) {
            $url = "$scheme://";
        }
      
        if(isset($host)) {
            $url .= "$host/";
        }
        $url .= $path;
        return $url;
}


/**
* Strip Vietnamese string
*/
function stripVietnamese($str){
        $unicode = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd'=>'đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i'=>'í|ì|ỉ|ĩ|ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
            'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D'=>'Đ',
            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ứ|Ữ|Ự',
            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        );
        
       foreach($unicode as $nonUnicode=>$uni){
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
       }
		return $str;
}


/**
* Convert a string to slug-type
*/
function toSlug($string, $force_lowercase = true, $anal = false) {
    $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
                   "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
                   "â€”", "â€“", ",", "<", ".", ">", "/", "?");
    $clean = trim(str_replace($strip, "", strip_tags($string)));
    $clean = preg_replace('/\s+/', "-", $clean);
    $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean ;
    return ($force_lowercase) ?
        (function_exists('mb_strtolower')) ?
            mb_strtolower($clean, 'UTF-8') :
            strtolower($clean) :
        $clean;
}

/**
* Get youtube video id
*/
function get_youtube_id($url,$need_curl=true) {
   $url_modified=strtolower(str_replace('www.', '', $url));
   if(strpos($url_modified,'http://youtube.com')!==false) {
   		parse_str(parse_url($url,PHP_URL_QUERY));
	
	    /** end split the query string into an array**/
	    if(! isset($v)) return false; //fast fail for links with no v attrib - youtube only
	
		if($need_curl){
		    $checklink = 'http://gdata.youtube.com/feeds/api/videos/'. $v;
			
			
		    //** curl the check link ***//
		    $ch = curl_init();
		    curl_setopt($ch, CURLOPT_URL,$checklink);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
		    $result = curl_exec($ch);
		    curl_close($ch);
		
		    $return = $v;
		    if(trim($result)=="Invalid id") $return = false; //you tube response
		    return $return; //the stream is a valid youtube id.
		}		
		return $v;   
   }  
   	return false;   		
}

/**
* Check current app is console or not
*/
function isConsoleApp() {
    return get_class(Yii::app())=='CConsoleApplication';
}

/**
* Replace Tags
*/
function replaceTags($startPoint, $endPoint, $newText, $source) {
    return preg_replace('#('.preg_quote($startPoint).')(.*)('.preg_quote($endPoint).')#si', '${1}'.$newText.'${3}', $source);
}

