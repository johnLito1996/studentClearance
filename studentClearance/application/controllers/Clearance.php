<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// class for the clearance process
class Clearance extends CI_Controller {

	private $tbl = "tbstudent_subject";
	private $secSub = "tbsubject_section_query";
	//private $secSub = "tbsubject_section";

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

// checking data
	private function chkData($dat){

		echo "<pre>";
		print_r($dat);
		echo "</pre>";
	}

//utf symbol Decoding
	private function decodeData($wrongChar){

		return utf8_decode($wrongChar);
	}

//get student list using secCOde
	public function getStudentList($secCode)
	{
		$fsecCode = urldecode($secCode);
		$sql = "call getSectionStudents(?)";

		$Q = $this->db->query($sql, $fsecCode);


		if ($Q->num_rows() > 0) {
			$secStuds = '<select name="sectionStudents" id="secStuds">';
				$secStuds .= "<option selected disabled> -Choose Student- </option>";

            	       	foreach ($Q->result() as $obj) {
							$name = $this->decodeData($obj->stud_fulname);

							$secStuds .= "<option value=". $obj->LRN_Number.">".ucfirst(utf8_decode($obj->stud_fulname))."</option>";

							/* student number => student full Name*/
						}

        	$secStuds .= '</select>';

        	echo $secStuds;
		}
		else{

			$noSecStudents = '<select name="sectionStudents" id="secStuds">';
				$noSecStudents .= "<option selected disabled> No Student Enrolled </option>";
			$noSecStudents .= '</select>';
			echo $noSecStudents;
		}
		
	}

// get the current remarks of student @sec, @LRN
	public function getStudRemarks($secCode, $studId)
	{
        $codition = array(
        		'section_code' => $secCode,
        		'LRN_number' => $studId
        	);
		$Q = $this->db->get_where('tbstudent_subject', $codition);                            
		echo json_encode(['data' => $Q->result()]);
	}

// Student NAme | Category | Remarks // get all the student that currently listed in 
// this subject in this section
	public function getSubRemarks($secCode, $subCode)
	{
		$sql = "call getSectionSubjectStuds(?, ?)";
		$Q = $this->db->query($sql, [$secCode, $subCode]);
		echo json_encode(['response' => $Q->result()]);

	}

//getting subject of the sec
	public function getSubSec($secCode)
	{
		$fsecCode = urldecode($secCode);
		$Q = $this->db->get_where($this->secSub, array('Section_code' => $fsecCode));
		echo json_encode(['data' => $Q->result()]);
	}

// saving the data clearance
	public function saveStudRemarks($secCode, $LRN_Number, $Subject_Signatory_Code, $newStatus)
	{
		// update the tbstudent_subject with the data of the parameters 
		$conditon = array(
				'Section_Code' => $secCode,
				'LRN_Number' => $LRN_Number,
				'Subject_Signatory_Code' => $Subject_Signatory_Code,
			);

		$Status = array(
				'Status' => $newStatus
			);
			$this->db->where($conditon);
			$qStudRemarks = $this->db->replace($this->tbl, $Status); // update Section
	}

// change the student remarks
	public function getJStatusRemarks($mthod)
	{
		
		//remarks using student LRN 
		if ($mthod == "student") {

			$dataStudSUb = json_decode(array_shift($_POST));

			$subCode = $_POST['RemarksCode'];

			for ($i=0; $i < count($subCode) ; $i++) { 

				$sQL = "UPDATE tbstudent_subject SET Status = (?) WHERE LRN_Number = (?) AND Section_Code = (?) AND Subject_Signatory_Code = (?)";

				$Q = $this->db->query($sQL, [$dataStudSUb->$subCode[$i], $_POST['LRN_Number'],$_POST['Section_Code'], $subCode[$i]]);
			}
			
			if ($Q) {
				echo "Student Subject Clearance Updated";
			}
			else{
				echo "No process done error logic";
			}
			
		}
		else{
			// remarks clearance using subjects
			//echo $mthod;
			//$this->chkData($_POST);
			$dataStud = json_decode(array_shift($_POST));
			$studLrn = $_POST['StudLRN'];
			
			for ($i=0; $i < count($studLrn) ; $i++) {

				$sql = "UPDATE tbstudent_subject SET Status = (?) WHERE LRN_Number = (?) AND Section_Code = (?) AND Subject_Signatory_Code = (?)";
				$Q = $this->db->query($sql, [$dataStud->$studLrn[$i], $studLrn[$i], $_POST['Section_Code'], $_POST['Subject_Signatory_Code']]);
				
			}

			if ($Q) {
				echo "Subject Student Updated";
			}
			else{
				echo "Subject Student not updated";
			}

		}

		$_POST = array(); // empty the $_POST array
		
	}

}

/* End of file Clearance.php */
/* Location: ./application/controllers/Clearance.php */

