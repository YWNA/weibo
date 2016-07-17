<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function session_conf($key, $value = NULL)
{
	if ( !empty($_SESSION[$key]) ) {
		if ( !empty($value) ) {
			$_SESSION[$key] = $value;
			return TRUE;
		} else {
			return $_SESSION[$key];
		}
	} elseif(!empty($value)) {
		$_SESSION[$key] = $value;
		return TRUE;
	} else {
		return FALSE;
	}
}
function p($data){
	echo "<pre>";
	print_r($data);
	echo "</pre>";
	exit();
}
function get_guid($pw_length = 3){
	$randpwd = '';
	for ($i = 0; $i < $pw_length; $i++) {
		$randpwd .= chr(mt_rand(65, 90));
	}
	return mt_rand(00000000, 99999999);
}
function timeto($startdate, $enddate)
{
  $date   = floor((strtotime($enddate)-strtotime($startdate))/86400);
  $hour   = floor((strtotime($enddate)-strtotime($startdate))%86400/3600);
  $minute = floor((strtotime($enddate)-strtotime($startdate))%86400/60);
  $second = floor((strtotime($enddate)-strtotime($startdate))%86400%60);
  return $date."天".$hour."小时";
}