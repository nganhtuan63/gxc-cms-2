<?php

/**
 * Hashing class
 * 
 * 
 * @author tuanmaster2002@yahoo.com
 * @version 1.0
 * @package cms.components
 */
class VieHashing {
	
	
	function __construct()
	{
		
	}
	
	/**
	 * Function used to hash password and secret string to secure password
	 *
	 * @param string $input : password
	 * @param boolean $full : if $full == true : create full hashing string: used to create password; if $full == false: only return password hashing prefix (used for remember me to save cookie)
	 * @return unknown
	 */
	 public static function hash($input, $full = true)
	 {
			if($full)
			{
				return md5($input . SALT) . SALT_SEPERATOR . base64_encode(md5(SECURITY_STRING) . SALT);
			}
			else 
			{
				return md5($input . SALT);
			}
	 }
	
	/**
	 *  encode 1 string by base64_encode
	 *  - apply some techniques to secure result
	 *
	 * @param string $input
	 */
	public static function superBase64Encode($input)
	{
		$output = $input;
		$output = base64_encode($output);
		$output = strrev($output);
		$output = base64_encode($output);
		$output = base64_encode($output);
		$output = strrev($output);
		return $output;
	}
	
	/**
	 * Decode for superBase64Encode
	 *
	 * @param unknown_type $input
	 * @return unknown
	 */
	public static function superBase64Decode($input)
	{
		$output = $input;
		$output = strrev($output);
		$output = base64_decode($output);
		$output = base64_decode($output);
		$output = strrev($output);
		$output = base64_decode($output);
		return $output;
	}
	
	/**
	 * Dung de authenticate password
	 * 
	 *
	 * @param string $source : password needed to be authenticated
	 * @param string $dest : password stored in db, format; {HASH}{SALT_SEPERATOR}{ENCODEDSALT} (HASH = MD5({password}{SALT}), ENCODEDSALT = BASE64ENCODE(MD5(SECRETSTRING).{SALT}))
	 */
	public static function authenticate($source, $dest)
	{
		//get salt from destination
		$group = explode(SALT_SEPERATOR, $dest);
		$hash = $group[0];
		
		$oldSalt = substr(base64_decode($group[1]), 32);
		return $hash == md5($source . $oldSalt);
	}

}