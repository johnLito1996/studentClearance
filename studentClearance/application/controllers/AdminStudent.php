<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminStudent extends CI_Controller {

	private $studTbl = 'tbstudent';
	public function __construct()
	{
		parent::__construct();
		$this->load->library('AdminLib');
		$this->load->model('Admin/SettingModel', 'setting');
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
		$data['scPic'] = $this->setting->schoolPic();
		$this->load->view('Admin/studentPane', $data);
	}

	//admin data
	public function AdminDat(){
		echo json_encode(['data' => $this->adminlib->getAdminDat()]);
	}

	public function saveStudent($method)
	{
		$crntLRN = $_POST['LRN_Number'];
		$crntsecCode = $_POST['Section_Code'];

// getting subjects 
					  $this->db->select('Subject_Code');
					  $this->db->order_by('Subject_Code', 'DESC');
			$SecSub = $this->db->get_where('tbsubject_section', array('Section_code' => $_POST['Section_Code'])); // put a index to insert that the remarks is SUBJECT

			$secSub = $SecSub->result_array();
			for ($i=0; $i < count($secSub) ; $i++) { 
				//$secSub[$i]['Category'] => 'SUBJECT';

				if(!array_key_exists('Category', $secSub[$i]))
				{
				    $secSub[$i]['Category'] = 'SUBJECT';
				}
			}

// getting assignatory
							 $this->db->select('Signatory_code');
							 ini_set('memory_limit', '-1');
			$SignatoryList = $this->db->get('tbsignatory');
			$sigNatoryList = $SignatoryList->result_array();

			for ($i=0; $i < count($sigNatoryList) ; $i++) { 
				//$secSub[$i]['Category'] => 'SUBJECT';

				if(!array_key_exists('Category', $sigNatoryList[$i]))
				{
				    $sigNatoryList[$i]['Category'] = 'OTHER';
				}
			}



		if ($method == 'add') {
//tbstudent
			$stud_DAT = array(
				'LRN_Number' => $crntLRN,
				'First_Name' => $_POST['First_Name'],
				'Last_Name' => $_POST['Last_Name'],
				'Initial' => $_POST['Initial'],
				'Gender' => $_POST['Gender'],
				'Password' => $_POST['Password'],

				);
			$saveStudent = $this->db->insert($this->studTbl, $stud_DAT);

			for ($i=0; $i < count($secSub) ; $i++) { 
				$crntsubCode = $secSub[$i]['Subject_Code'];
				$crntsubCategory = $secSub[$i]['Category'];

				$sQL = "INSERT INTO `tbstudent_subject`(`Section_Code`, `LRN_Number`, `Subject_Signatory_Code`, `Status`, `Category`) VALUES ((?), (?), (?), (?),(?))";

//tbsubject_stud
				$addSubjects = $this->db->query($sQL, [$crntsecCode, $crntLRN, $crntsubCode, '', $crntsubCategory]);
			}
			//$this->chkData($secSub);

			//$this->chkData($sigNatoryList);
			for ($i=0; $i < count($sigNatoryList) ; $i++) { 
				$crntSignatory = $sigNatoryList[$i]['Signatory_code'];
				$crntsigCategory = $sigNatoryList[$i]['Category'];

				$sQL = "INSERT INTO `tbstudent_subject`(`Section_Code`, `LRN_Number`, `Subject_Signatory_Code`, `Status`, `Category`) VALUES ((?), (?), (?), (?),(?))";

//tbsubject_stud
				$addSignatory = $this->db->query($sQL, [$crntsecCode, $crntLRN, $crntSignatory, '', $crntsigCategory]);
			}
			//$this->chkData($sigNatoryList);

//enroll student
			$studentEnrollDat = array(
				'LRN_number' => $crntLRN,
				'Section_Code' => $crntsecCode,
				'Status' => 'Enrolled'
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
		else{
			echo "This is the post Array for Edit new Student";
			$this->chkData($_POST);
		}
			/*1. get the POST data from the view
			//2. validate the input data
			3. save the new student in the following table base on the section
			(tbstudent_subject => kaiba na dapat si mga assgignatory na listed,
			 tbstudent => create the password will be the last 4 digit of LRN Number,
			  tbenrolled =>  )

			  * tbstudent
			  * tbenrolled 
			  * tbstudent_subject


			  return Type BOOL
		*/
	}

	public function editStudentDat($LRNNumber)
	{
		/*
			1. get the current student Dat
			2. change the tbstudent table with the new student data
		*/
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