<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminTeacher extends CI_Controller
{
	private $tbteacher = 'tbteacher';
	function __construct()
	{
		parent::__construct();

		//admin Library
		$this->load->library('AdminLib');
		// Setting of the App
		$this->load->model('Admin/SettingModel', 'setting');
		// load the database()
		$this->load->database();

	}

	public function index(){

		$data['scPic'] = $this->setting->schoolPic();
		$data['imgPath'] = base_url();
		$this->load->view('Admin/teacherPane', $data);

	}

	//admin data
	public function AdminDat(){
		echo json_encode(['data' => $this->adminlib->getAdminDat()]);
	}

	//new teachID
	public function newTeachId(){
		//$res = $out[0]['Teacher_ID'];		

		$sql = "call TeachlastTID()"; 
		$Q = $this->db->query($sql);
		$Q->result_array();

		$res = $Q->result_array()[0]['Teacher_ID'];

		$prt1 = substr($res, 0, 4);
		$prt2 = (int)substr($res, 4,2);
		$out = $prt1. ($prt2 + 1);

		echo json_encode(['id' => $out]);
	}

	//teacherList
	public function ajax_teach_list(){
		
		$this->db->order_by("Teacher_Last_Name", "ASC");
		$Q = $this->db->get_where($this->tbteacher, array('Status'=> 'Active'));

		echo json_encode(['data' => $Q->result()]);
	}

	//savenewTeach
	public function saveTeach($method){

		$userPass = $this->input->post('Teacher_First_Name').'_'.$this->input->post('Teacher_Last_Name');

		$arrUser = array(
			'Username' => str_replace(' ', '_', $userPass),
			'Password' => str_replace(' ', '_', $userPass)
			);

		// mergeng array POST and userDat
		$data = array_merge($_POST, $arrUser);

		$X = $this->db->insert($this->tbteacher, $data);
		if ($X) {
			$X = true;
		}
		else{
			$X = false;
		}
		
		echo json_encode(['status' => $X, 'method' => $method]);
		//echo json_encode(['status' => true]);
	}

	public function delTeachList($id){

		$this->db->set(array('Status' => 'Non-Active'));
		$this->db->where('Teacher_ID', $id);
		$Q = $this->db->update($this->tbteacher);

		if ($Q) {
			$Q = true;
		}
		else{
			$Q = false;
		}

		echo json_encode(['status'=> $Q]);
	}
}