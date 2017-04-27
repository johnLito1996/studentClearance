<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 class MyUtility
 {
 	
 	function __construct()
 	{
 		//constructor
 	}

 	/* viewinf specific set of data*/
	public function dieView($args){

		echo "<pre>";
		print_r($args);
		echo "</pre>";
	}


	public function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}

 }