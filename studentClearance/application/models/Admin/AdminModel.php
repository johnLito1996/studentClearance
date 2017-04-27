<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminModel extends CI_Model {

	private $tbl = 'tbadmin';
	public function __construct()
	{
		parent::__construct();
		
	}

	private function retObj($obj){
		if ($obj) {
			return $obj->result();		
		}
		else{
			return NULL;
		}
	}

	private function retBool($obj){

		if ($obj) {
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	public function getAdminDat(){

		$usrname = 'CesOrogo';
		$pass = '100';

			 $this->db->where('UserName', $usrname);
			 $this->db->where('Password', $pass);
		$Q = $this->db->get_where($this->tbl);

		return $this->retObj($Q);
	}

/*	public function updateProfile(){

	}

	public function changePass(){

	}

	public function addAdmin(){

	}

	public function delAdmin(){

	}*/
}

/* End of file AdminModel.php */
/* Location: ./application/models/AdminModel.php */