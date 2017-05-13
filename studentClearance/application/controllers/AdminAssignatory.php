<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adminassignatory extends CI_Controller {

	private $tbl = 'tbsignatory';
	private $crntAdmin;

	public function __construct()
	{
		parent::__construct();
		$this->load->library('AdminLib');
		$this->load->model('Admin/SettingModel', 'setting');
		$this->load->database();
	}

//checking data
	private function dieRet($arr){

		echo "<pre>";
		print_r($arr);
		echo "</pre>";
	}

// return BOl
	private function retBool($Q){

		if($Q){
			$Q = true;
		}
		else{
			$Q = false;
		}

		echo json_encode(['data' => $Q]);

	}

//index page
	public function index()
	{
		$adminID = $this->session->userdata('adminUserNameCrnt');
		$this->crntAdmin = $adminID;

		if (empty($this->crntAdmin)) {
			show_404();
		}
		else{
			$data['title'] = "Admin | Assignatory";
			$data['scPic'] = $this->setting->schoolPic();
			$this->load->view('Admin/signatoryPane',$data);
		}
		
	}

//admin data
	public function admindat(){
		echo json_encode(['data' => $this->adminlib->getAdminDat()]);
	}

//create new assignatory
	public function createassig(){
		$this->load->database();
		//get the data
		$Q = $this->db->insert($this->tbl, $_POST);
		$this->retBool($Q);
		// creating the table prt here waiting to be html() in view 2ndOption
	}

//delete assignatory
	public function delassig($code){

		$this->db->where('Signatory_code', $code);
		$Q = $this->db->delete($this->tbl);
		$this->retBool($Q);
	}

//get the all assignatory datas from the tbl
	public function getassigdat(){
		//ASC a-Z
		//DESC Z-a
		$this->db->order_by("Signatory_code", "ASC");
		$Q = $this->db->get($this->tbl);

		echo json_encode(['data' => $Q->result()]);
	}
}

/* End of file AdminAssignatory.php */
/* Location: ./application/controllers/AdminAssignatory.php */