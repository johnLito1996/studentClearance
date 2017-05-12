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

		$usrname = $this->session->userdata('adminUserNameCrnt');

			 $this->db->where('UserName', $usrname);
		$Q = $this->db->get($this->tbl);

		return $this->retObj($Q);
	}

}

/* End of file AdminModel.php */
/* Location: ./application/models/AdminModel.php */