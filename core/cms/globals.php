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


/**
 * Encode the text into a string which all white spaces will be replaced by $rplChar
 * @param string $text  text to be encoded
 * @param Char $rplChar character to replace all the white spaces
 * @param boolean upWords   set True to uppercase the first character of each word, set False otherwise
 */
function encode($text, $rplChar='', $upWords=true)
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

// Query Filter String from Litpi.com   
 function queryFilterString($str)
{
    //Use RegEx for complex pattern
    $filterPattern = array(
                            '/select.*(from|if|into)/i',  // select table query, 
                            '/0x[0-9a-f]*/i',               // hexa character
                            '/\(.*\)/',                     // call a sql function
                            '/union.*select/i',             // UNION query
                            '/insert.*values/i',        // INSERT query
                            '/order.*by/i'              // ORDER BY injection
                            );
    $str = preg_replace($filterPattern, '', $str);

    //Use normal replace for simple replacement
    $filterHaystack = array(
                            '--',   // query comment
                            '||',   // OR operator
                            '\*',   // OR operator
                            );

    $str = str_replace($filterHaystack, '', $str);
    return $str;
}


//XSS Clean Data Input from Litpi.com
 function xss_clean($data)
{
    return $data;
    // Fix &entity\n;
    $data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
    $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
    $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
    $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

    // Remove any attribute starting with "on" or xmlns
    $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

    // Remove javascript: and vbscript: protocols
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

    // Only works in IE: <span style="width: expression(alert('cms','Ping!'));"></span>
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

    // Remove namespaced elements (we do not need them)
    $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

    do
    {
        // Remove really unwanted tags
        $old_data = $data;
        $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
    }
    while ($old_data !== $data);

    // we are done...
    return $data;
}

 

 function curl_post_async($url, $params)
{
   foreach ($params as $key => &$val) {
     if (is_array($val)) $val = implode(',', $val);
       $post_params[] = $key.'='.urlencode($val);
   }
   $post_string = implode('&', $post_params);

   $parts=parse_url($url);

   $fp = fsockopen($parts['host'],
       isset($parts['port'])?$parts['port']:80,
       $errno, $errstr, 30);

   $out = "POST ".$parts['path']." HTTP/1.1\r\n";
   $out.= "Host: ".$parts['host']."\r\n";
   $out.= "Content-Type: application/x-www-form-urlencoded\r\n";
   $out.= "Content-Length: ".strlen($post_string)."\r\n";
   $out.= "Connection: Close\r\n\r\n";
   if (isset($post_string)) $out.= $post_string;

   fwrite($fp, $out);
   fclose($fp);
}
    
 function curl_get_async($url, $params)
{
    foreach ($params as $key => &$val) {
      if (is_array($val)) $val = implode(',', $val);
        $post_params[] = $key.'='.urlencode($val);
    }
    $post_string = implode('&', $post_params);

    $parts=parse_url($url);

    $fp = fsockopen($parts['host'],
        isset($parts['port'])?$parts['port']:80,
        $errno, $errstr, 30);

    $out = "GET ".$parts['path']." HTTP/1.1\r\n";
    $out.= "Host: ".$parts['host']."\r\n";
    $out.= "Content-Type: application/x-www-form-urlencoded\r\n";
    $out.= "Content-Length: ".strlen($post_string)."\r\n";
    $out.= "Connection: Close\r\n\r\n";
    if (isset($post_string)) $out.= $post_string;

    fwrite($fp, $out);
    fclose($fp);
}
    
 function plaintext($s)
{
    $s = strip_tags($s);
    $s = xss_clean($s);
    return $s;
}

 function isValidURL($url)
{
    return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
}
        

/**
* Generate a random number between floor and ceiling
*
* @param int $floor
* @param int $ceiling
* @return int
*/
 function RandomNumber($floor, $ceiling) 
{
    srand((double)microtime() * 1000000);
    return rand($floor, $ceiling);
}

/**
* Format string of filesize
*
* @param string $s
* @return string
*/
 function formatFileSize($s) 
{
    if($s >= "1073741824")
    { 
        $s = number_format($s / 1073741824, 2) . " GB"; 
    }
    elseif($s >= "1048576") 
    { 
        $s  = number_format($s / 1048576, 2) . " MB"; 
    }
    elseif($s >= "1024") 
    { 
        $s = number_format($s / 1024, 2) . " KB"; 
    }
    elseif($s >= "1") 
    {  
        $s = $s . " bytes"; 
    }
    else 
    { 
        $s = "-"; 
    }

return $s;
}

 function stripslashes_deep($value)
{
       $value = is_array($value) ?
                   array_map('stripslashes_deep', $value) :
                   stripslashes($value);

       return $value;
}


/**
* Fix back button on IE6 (stupid) browser
* @author khanhdn
*/
 function fixBackButtonOnIE() 
{
    //drupal_set_header("Expires: Sat, 27 Oct 1984 08:52:00 GMT GMT");  // Always expired (1)
    //drupal_set_header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified (2)
    header("Cache-Control: no-store, no-cache, must-revalidate");   // HTTP/1.1 (3)
    header("Cache-Control: public");    //(4)
    header("Pragma: no-cache"); // HTTP/1.0   (5)
    ini_set('cms','session.cache_limiter', 'private');   // (6)
}


/**
* Get Alphabet only
*/
function alphabetonly($string = '')
{
        $output = $string;
        //replace no alphabet character
        $output = preg_replace("/[^a-zA-Z0-9]/","-", $output);   
        $output = preg_replace("/-+/","-", $output);   
        $output = trim($output, '-');

        return $output;
}

/**
* Convert date string in format 'dd/mm/yyyy' and time string in format 'hh:mm'to timestamp                      
* @param string $datestring
* @param string $timestring  
*/
function datedmyToTimestamp($datestring = '01/01/1970', $timestring = '00:01')
{
    $timegroup = explode(':', $timestring); 
    $dategroup = explode('/', $datestring);
    return mktime((int)trim($timegroup[0]), (int)trim($timegroup[1]), 1, (int)trim($dategroup[1]), (int)trim($dategroup[0]), (int)trim($dategroup[2]));
}

function truncate($phrase, $max_words)
{
        $phrase_array = explode(' ',$phrase);
        if(count($phrase_array) > $max_words && $max_words > 0)
            $phrase = implode(' ',array_slice($phrase_array, 0, $max_words)).'...';

        return $phrase;
}

function recursive_remove_directory($directory, $empty=FALSE)
{
    // if the path has a slash at the end we remove it here
    if(substr($directory,-1) == '/')
    {
        $directory = substr($directory,0,-1);
    }

    // if the path is not valid or is not a directory ...
    if(!file_exists($directory) || !is_dir($directory))
    {
        // ... we return false and exit the function
        return FALSE;

    // ... if the path is not readable
    }elseif(!is_readable($directory))
    {
        // ... we return false and exit the function
        return FALSE;

    // ... else if the path is readable
    }else{

        // we open the directory
        $handle = opendir($directory);

        // and scan through the items inside
        while (FALSE !== ($item = readdir($handle)))
        {
            // if the filepointer is not the current directory
            // or the parent directory
            if($item != '.' && $item != '..')
            {
                // we build the new path to delete
                $path = $directory.'/'.$item;

                // if the new path is a directory
                if(is_dir($path)) 
                {
                    // we call this function with the new path
                    recursive_remove_directory($path);

                // if the new path is a file
                }else{
                    // we remove the file
                    unlink($path);
                }
            }
        }
        // close the directory
        closedir($handle);

        // if the option to empty is not set to true
        if($empty == FALSE)
        {
            // try to delete the now empty directory
            if(!rmdir($directory))
            {
                // return false if not possible
                return FALSE;
            }
        }
        // return success
        return TRUE;
    }   


}

function b64_serialize($data){
    return base64_encode(serialize($data));
}

function b64_unserialize($data){
    return unserialize(base64_decode($data));          
}

