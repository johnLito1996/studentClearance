<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminAssignatory extends CI_Controller {

	private $tbl = 'tbsignatory';
	public function __construct()
	{
		parent::__construct();
		$this->load->library('AdminLib');

		//load the database
		$this->load->database();

		$this->load->model('Admin/SettingModel', 'setting');
	}

	private function dieRet($arr){

		echo "<pre>";
		print_r($arr);
		echo "</pre>";
	}

	private function retBool($Q){

		if($Q){
			$Q = true;
		}
		else{
			$Q = false;
		}

		echo json_encode(['data' => $Q]);

	}
	public function index()
	{
		//load the view here in these controller	
		$data['title'] = "Admin | Assignatory";
		$data['scPic'] = $this->setting->schoolPic();
		$this->load->view('Admin/signatoryPane',$data);
	}

	//admin data
	public function AdminDat(){
		echo json_encode(['data' => $this->adminlib->getAdminDat()]);
	}

	//create new assignatory
	public function createAssig(){

		$this->load->database();
		//get the data
		$Q = $this->db->insert($this->tbl, $_POST);
		
		$this->retBool($Q);
		// creating the table prt here waiting to be html() in view 2ndOption

	}

	//delete assignatory
	public function delAssig($code){

		$this->db->where('Signatory_code', $code);
		$Q = $this->db->delete($this->tbl);
		$this->retBool($Q);
	}

	//get the all data from the tbl
	public function getAssigDat(){

		//ASC a-Z
		//DESC Z-a
		$this->db->order_by("Signatory_code", "ASC");
		$Q = $this->db->get($this->tbl);

		echo json_encode(['data' => $Q->result()]);
	}
}

/* End of file AdminAssignatory.php */
/* Location: ./application/controllers/AdminAssignatory.php */