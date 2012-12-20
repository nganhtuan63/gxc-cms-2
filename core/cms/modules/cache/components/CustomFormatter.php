<?php
/*
* This is CustomFormatter cache from apcinfo Module 
* Author: http://www.yiiframework.com/user/20488/ Da:Sourcerer
*
*/

class CustomFormatter extends CFormatter
{
	const PHP_INI_USER=1;
	const PHP_INI_PERDIR=6;
	const PHP_INI_SYSTEM=4;
	const PHP_INI_ALL=7;
	
	public $suffixes=array(
		'B', 'KB', 'MB', 'GB', 'TB', 'PB',
	);
		
	public function formatAccess($value)
	{
		switch($value)
		{
			case self::PHP_INI_USER:
				$value='scripts';
				break;
			case self::PHP_INI_PERDIR:
				$value='directory';
				break;
			case self::PHP_INI_SYSTEM:
				$value='system';
				break;
			case self::PHP_INI_ALL:
				$value='all';
				break;
		}
		return $value;
	}
	
	public function formatDatasize($value)
	{
		$e=(int)floor(log($value, 1024));
		if($e > 0 && array_key_exists($e, $this->suffixes))
			return sprintf('%.2f', $value/pow(1024, $e)).$this->suffixes[$e];
		else
			return $this->formatNumber($value).'B';
	}
	
	public function formatRate($value)
	{
		return round($value, 3) . '/s';
	}
	
	public function formatDuration($value)
	{
		$years = (int)((($_SERVER['REQUEST_TIME'] - $value)/(7*86400))/52.177457);
		$rem = (int)(($_SERVER['REQUEST_TIME'] - $value)-($years * 52.177457 * 7 * 86400));
		$weeks = (int)(($rem)/(7*86400));
		$days = (int)(($rem)/86400) - $weeks*7;
		$hours = (int)(($rem)/3600) - $days*24 - $weeks*7*24;
		$mins = (int)(($rem)/60) - $hours*60 - $days*24*60 - $weeks*7*24*60;
		$str = '';
		if($years==1) $str .= "$years year, ";
		if($years>1) $str .= "$years years, ";
		if($weeks==1) $str .= "$weeks week, ";
		if($weeks>1) $str .= "$weeks weeks, ";
		if($days==1) $str .= "$days day,";
		if($days>1) $str .= "$days days,";
		if($hours == 1) $str .= " $hours hour and";
		if($hours>1) $str .= " $hours hours and";
		if($mins == 1) $str .= " 1 minute";
		else $str .= " $mins minutes";
		return $str;
	}
}