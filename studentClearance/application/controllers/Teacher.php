<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Teacher extends CI_Controller {

	private $teachTBL = 'tbteacher';

	private $crntTID;
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('Admin/SettingModel', 'setting');
	}

//load the view for teacherHome
	public function index()
	{
		$crntTeacherID = $this->session->userdata('teacherLoginID');
		$this->crntTID = $crntTeacherID;

		if (empty($crntTeacherID)) {
			show_404();
		}else{
			$data['scPic'] = $this->setting->schoolPic();
			$this->load->view('Teacher/teacherHome', $data);
			//echo "view teacher not open";
		}

	}

//getThe Data of teacher Currently Login
	public function crntLoginTeachDAt($teacherID)
	{
		$teachDAT = $this->db->get_where($this->teachTBL, array('Teacher_ID' => $teacherID));

		$teachDAT = $teachDAT->result_array();

		echo json_encode(['teacherDAt' => $teachDAT]);
	}

// checking data
	private function chkData($Q)
	{
		echo "<pre>";
		print_r($Q);
		echo "</pre>";
	}

// datatable for section by teacher
	public function ajax_sec_list_byTeach($tID){

		$this->db->select(array('Section_code', 'Track', 'Strand', 'Room_Number', 'Grade_level', 'Shift_Sched'));
			 $this->db->order_by('Section_code', 'DESC');
		$Q = $this->db->get_where('tbsection_query', array('Adviser' => $tID)); 
		//$Q = $this->db->get('tbsection_query'); 
		$result = $Q->result();
		
		$data;
		if ($Q->num_rows != 0) {
			foreach ($result as $row) {
			$secCode = $row->Section_code; 
			$teachId = $tID;
			$btnEdit = '
			<button type="button" class="btn btn-sm btn-primary" title="Proceed to clearance" onclick="secClearance('."'".$secCode."'".', '."'".$teachId."'".')"> <span class="fa fa-info"></span> Clearance </button>&nbsp
			';

                $row->Action = $btnEdit;
                //$row->Action = 'sample';
                $data[] = $row;
             }
			echo json_encode(['data' => $data]);
		}
		else{
			echo '{
			    "sEcho": 1,
			    "iTotalRecords": "0",
			    "iTotalDisplayRecords": "0",
			    "aaData": []
			}';
		}
		
		
		
	}//e()

//teacherProfile
	public function teacherProfile()
	{
		$data['scPic'] = $this->setting->schoolPic();
		$data['teacherLoginID'] = $this->crntTID;
		$this->load->view('Teacher/teacherChangeProfile', $data);
	}

// saveChangeTeacher Acc
	public function saveChangeTeacherProfile($TID)
	{
		//$this->chkData($_POST);
		// change the (1) password and the (2)picture of the teacher
		$sQL = "UPDATE `tbteacher` SET `Password`=(?) WHERE `Teacher_ID`= (?)";

		$Q = $this->db->query($sQL, [$_POST['Password'],$TID]);

		if ($Q) {
			echo json_encode(['status' => $Q]);
		}

	}
}

/* End of file Teacher.php */
/* Location: ./application/controllers/Student.php */