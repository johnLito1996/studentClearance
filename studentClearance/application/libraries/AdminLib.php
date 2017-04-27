<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class AdminLib
{
	protected $CI;
	function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->model('Admin/AdminModel', 'thismodel');
	}

	public function getAdminDat(){
		return $this->CI->thismodel->getAdminDat();
	}
}