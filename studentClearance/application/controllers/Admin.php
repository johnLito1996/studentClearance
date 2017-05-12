<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	private $adminTbl = 'tbadmin';

	public function __construct()
	{
		parent::__construct();
		$this->load->databse();
	}

	private function returnBool($Q){
		if ($Q) {
			echo json_encode(['status' => true]);
		}
		else{
			echo json_encode(['status' => true]);
		}
	}

// identify the super admin account
	public function isSuperAdmin($adminAcc)
	{
		$where = array(
			'UserName' => $adminAcc['UserName'],
			'Password' => $adminAcc['Password']
			);

			 $this->db->select('admintype');
		$Q = $this->db->get_where($this->adminTbl, $where);

		$adminType = $Q->result()[0]->admintype;
		if ($adminType === 'super') {
			
			echo json_encode(['status' => true]);
		}
		else{
			echo json_encode(['status' => false]);
		}
	}

// delete admin account
	public function removeAdmin($adminAcc)
	{
		$where = array(
			'UserName' => $adminAcc['UserName'],
			'Password' => $adminAcc['Password']
			);

		$Q = $this->db->delete($this->adminTbl, $where);
		
		$this->returnBool($Q);
	}

// get admin data
	public function getAdminDat($adminAcc)
	{
		$where = array(
			'UserName' => $adminAcc['UserName'],
			'Password' => $adminAcc['Password']
			);

		$Q = $this->db->get_where($this->adminTbl, $where);
	
		echo json_encode(['crntAdminDat' => $Q->rseult()]);
	}
}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */