<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminStudent extends CI_Controller {

	private $studTbl = 'tbstudent';
	private $crntAdmin;
	public function __construct()
	{
		parent::__construct();
		$this->load->library('AdminLib');
		$this->load->model('Admin/SettingModel', 'setting');
		$this->load->model('student/StudentModel', 'studentModel');
	}

	// checking the data
	private function chkData($Q){

		echo "<pre>";
		print_r($Q);
		echo "</pre>";
	}

	// decoding utf-encoded data
	private function decodeData($wrongChar){

		return utf8_decode($wrongChar);
	}

	//index function
	public function index()
	{
		$adminID = $this->session->userdata('adminUserNameCrnt');
		$this->crntAdmin = $adminID;

		if (empty($this->crntAdmin)) {
			show_404();
		}
		else{
			$data['scPic'] = $this->setting->schoolPic();
			$this->load->view('Admin/studentPane', $data);
		}
		
	}

	//admin data
	public function AdminDat(){
		echo json_encode(['data' => $this->adminlib->getAdminDat()]);
	}

// datatable students
	public function getStudentList()
	{
		//studentModel
		$list = $this->studentModel->get_dTables_list_students();
		$data = array();
/*		$no = $_POST['start'];
*/
		$no = 0;
			/*
'Section_code', 'Track', 'Strand', 'Adviser', 'Room_Number'
			*/
		foreach ($list as $students) {

			//decodeData
			$no = $no + 1;

			$row = array();

			$LRN = $students->LRN_number;
			$row[] = $LRN;
			$row[] = $this->decodeData(ucfirst($students->Last_Name));
			$row[] = ucfirst($students->First_Name);
			$row[] = ucfirst($students->Initial);
			$row[] = $students->Gender;
			$row[] = $students->Status;
			$row[] = $students->Section_Code;
			$row[] = '<button type="button" class="btn btn-sm btn-warning" title="View Details" onclick="editStudent('."'".$LRN."'".')" ><span class="fa fa-pencil-square-o"></span> Edit </button>&nbsp';
			
			$data[] = $row;

		}//e_f_each

		$output = array(

				"draw" => $_POST['draw'],//key at the array POST name draw
				"recordsTotal" => $this->studentModel->count_all_students(),
				"recordsFiltered" => $this->studentModel->count_filtered_students(),
				"data" => $data
			);

		echo json_encode($output);
		
	}


// fetching student data to be editid
	public function getStudentdata($LRN)
	{
		$Q = $this->db->get_where("tbenrolled_query", array('LRN_number' => $LRN));

		echo json_encode(['dat' => $Q->result()]);
	}


// saving and editing student
	public function saveStudent($method)
	{
		if ($method == 'add') {

			$status = $_POST['Status'];
		unset($_POST['Status']); // remove the status in post

		$crntLRN = $_POST['LRN_Number'];
		$crntsecCode = $_POST['Section_Code'];

// getting subjects 
					  $this->db->select('Subject_Code');
					  $this->db->order_by('Subject_Code', 'DESC');
			$SecSub = $this->db->get_where('tbsubject_section', array('Section_code' => $crntsecCode)); // put a index to insert that the remarks is SUBJECT

			$secSub = $SecSub->result_array();
			for ($i=0; $i < count($secSub) ; $i++) { 

				if(!array_key_exists('Category', $secSub[$i]))
				{
				    $secSub[$i]['Category'] = 'SUBJECT';
				}
			}

// getting assignatory
							 $this->db->select('Signatory_code');
/*							 ini_set('memory_limit', '-1');
*/			$SignatoryList = $this->db->get('tbsignatory');
			$sigNatoryList = $SignatoryList->result_array();

			for ($i=0; $i < count($sigNatoryList) ; $i++) { 

				if(!array_key_exists('Category', $sigNatoryList[$i]))
				{
				    $sigNatoryList[$i]['Category'] = 'OTHER';
				}
			}

//tbstudent
			$usrname = $_POST['First_Name']."_".$_POST['Last_Name'];

			$stud_DAT = array(
				'LRN_Number' => $crntLRN,
				'First_Name' => $_POST['First_Name'],
				'Last_Name' => $_POST['Last_Name'],
				'Initial' => $_POST['Initial'],
				'Gender' => $_POST['Gender'],
				'Password' => $_POST['Password'],
				'Username' => str_replace(' ', '_', strtolower($usrname))
				);
			
			$saveStudent = $this->db->insert($this->studTbl, $stud_DAT);

			for ($i=0; $i < count($secSub) ; $i++) { 
				$crntsubCode = $secSub[$i]['Subject_Code'];
				$crntsubCategory = $secSub[$i]['Category'];

				$sQL = "INSERT INTO `tbstudent_subject`(`Section_Code`, `LRN_Number`, `Subject_Signatory_Code`, `Status`, `Category`) VALUES ((?), (?), (?), (?),(?))";

//tbsubject_stud
				$addSubjects = $this->db->query($sQL, [$crntsecCode, $crntLRN, $crntsubCode, 'INC', $crntsubCategory]);
			}
			//$this->chkData($secSub);

			//$this->chkData($sigNatoryList);
			for ($i=0; $i < count($sigNatoryList) ; $i++) { 
				$crntSignatory = $sigNatoryList[$i]['Signatory_code'];
				$crntsigCategory = $sigNatoryList[$i]['Category'];

				$sQL = "INSERT INTO `tbstudent_subject`(`Section_Code`, `LRN_Number`, `Subject_Signatory_Code`, `Status`, `Category`) VALUES ((?), (?), (?), (?),(?))";

//tbsubject_stud
				$addSignatory = $this->db->query($sQL, [$crntsecCode, $crntLRN, $crntSignatory, 'INC', $crntsigCategory]);
			}
			//$this->chkData($sigNatoryList);

//enroll student
			$studentEnrollDat = array(
				'LRN_number' => $crntLRN,
				'Section_Code' => $crntsecCode,
				'Status' => $status
				);
			$enrollStud = $this->db->insert('tbenrolled', $studentEnrollDat);

			//$saveStudent
			if (($saveStudent) && ($addSubjects) && ($addSignatory) && ($enrollStud)) {
				echo json_encode(['status' => true]);
			}
			else{
				echo json_encode(['status' => false]);
			}

		}
		else{ // edit only the student data will be change

			$secCode = array_pop($_POST); // remove the section prt

			$editLRN = array_shift($_POST);

			$editSQl = "UPDATE `tbstudent` SET `First_Name`=(?),`Last_Name`=(?),`Initial`=(?),`Gender`=(?) WHERE `LRN_Number`= (?)";

			$editStudQ = $this->db->query($editSQl, [$_POST['First_Name'], $_POST['Last_Name'], $_POST['Initial'], $_POST['Gender'], $editLRN]);

			$editEnrolledSQL = "UPDATE `tbenrolled` SET `Status`=(?) WHERE `LRN_number`=(?) AND `Section_Code`=(?)";

			$editEnrolledQ = $this->db->query($editEnrolledSQL, [$status, $editLRN, $secCode]);

			if (($editStudQ) && ($editEnrolledQ)) {
				echo json_encode(['status' => true]);
			}
			else{
				echo json_encode(['status' => false]);
			}
		}
		
	}

	public function getClassMates($secCode)
	{
		$tbl = 'tbenrolled_query';

			 $this->db->order_by('Last_Name', 'ASC');
		$Q = $this->db->get_where($tbl, array('Section_Code' => $secCode));
		
		//$this->chkData($Q->result());
		$result = $Q->result();
		// different li here to be appended in the classmates ul for the student

		$outLi = '';

		foreach ($result as $row) {
			$studName = $row->Last_Name. ", ". $row->First_Name. " ". $row->Initial;

			$crntGender = $row->Gender;
			if ($crntGender == 'Male') {
				$outLi .= '<li>'.strtolower($this->decodeData($studName)).'<span style="color:blue;">&nbsp M</span></li> <hr>';
			}
			else{
				$outLi .= '<li>'.strtolower($this->decodeData($studName)).'<span style="color:#E39595;">&nbsp F</span></li> <hr>';
			}
		}

		echo $outLi;
	}

}

/* End of file AdminStudent.php */
/* Location: ./application/controllers/AdminStudent.php */