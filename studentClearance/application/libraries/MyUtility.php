<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 class MyUtility
 {
 	
 	function __construct()
 	{
 		// ANy constructor
 	}

 	/* viewinf specific set of data*/
	public function dieView($args){

		echo "<pre>";
		print_r($args);
		echo "</pre>";
	}

	// donot url_encode data in URL
	public function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}

 }