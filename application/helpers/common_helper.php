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