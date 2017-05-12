<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Student extends CI_Controller {

	private $tblStudent = 'tbenrolled_query';
	private $crntStudentID;
	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->model('Admin/SettingModel', 'setting');
	}

//'studentHome'
	public function index()
	{
		$this->crntStudentID = $this->session->userdata('studentLoginID');
		if (empty($this->crntStudentID)) {
			show_404();
		}else{
			$data['scPic'] = $this->setting->schoolPic();
			$this->load->view('studentHome', $data);
		}
	}

// checking Data
	private function chkData($Q)
	{
		echo "<pre>";
		print_r($Q);
		echo "</pre>";
	}

// get student Dat
	public function crntStudDat($LRN)
	{
			 $this->db->select(['Section_Code', 'Last_Name', 'First_Name']);
		$Q = $this->db->get_where($this->tblStudent, array('LRN_Number' => $LRN));
	
		echo json_encode(['studDat' => $Q->result()]);
	}

// getSubjects Remarks By
	public function getSub_Remarks($LRN, $secCode)
	{
		$remarksTBl = 'tbstudent_subject';
		$Q = $this->db->get_where($remarksTBl, array('LRN_Number' => $LRN, 'Section_Code' => $secCode));

		echo json_encode(['remarks' => $Q->result()]);
	}

}

/* End of file Student.php */
/* Location: ./application/controllers/Student.php */