<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminSection extends CI_Controller {

	// section tbl 
	private $tblSection = 'tbsection';
	private $tblSecSubjects = 'tbsubject_section';
	public function __construct()
	{
		parent::__construct();
		// conModel
	    $this->load->database();

		$this->load->library('AdminLib');
	    $this->load->library('MyUtility');

	    $this->load->model('Admin/SettingModel', 'setting');
		
		//sectionModel
		$this->load->model('section/SectionModel', 'thisModel');
		$this->load->model('section/Acad_sections', 'thisModel2');
	}

	public function index()
	{
    	$data['scPic'] = $this->setting->schoolPic();
		$this->load->view('Admin/sectionPane', $data);
	}

	// get the name of teacher using his/ her ID
	private function getTeacher($teacherID, $secCode)
	  {
	    $tblSecTeachV = 'tbteachersec';

	        $sql = "SELECT fullName FROM tbteachersec WHERE  (Teacher_ID = ?) AND (Section_code = ?)";

	        $teacherID = $this->myutility->clean($teacherID);
	        $secCode = $this->myutility->clean($secCode);

	        $Q = $this->db->query($sql, [$teacherID, $secCode]);

	        if ($Q) {
	           //$this->functionChkData($Q->result());
	          return $Q->result()[0]->fullName;
	        }
	        else{
	          return "No data Found";
	        }
	  }

//datatables section list
	public function ajax_sec_list(){

		$list = $this->thisModel2->get_dTables_sec();
		$data = array();
/*		$no = $_POST['start'];
*/
		$no = 0;
			/*
'Section_code', 'Track', 'Strand', 'Adviser', 'Room_Number'
			*/
		foreach ($list as $section) {
			
			$secCode = $section->Section_code;
	       //echo $teacherName = $this->getTeacher($index->Adviser, $index->Section_code);
	       $teachId = $section->Adviser;
	       $teacherName = $this->getTeacher($section->Adviser, $section->Section_code);

			$no = $no + 1;

			$row = array();

			$row[] = strtoupper($secCode);
			$row[] = $section->Track;
			$row[] = strtoupper($section->Strand);
			$row[] = $teacherName;
			$row[] = $section->Room_Number;
			$row[] = $section->Grade_level;
			$row[] = '<button type="button" class="btn btn-sm btn-info" title="View Details" onclick="editSec('."'".$secCode."'".', '."'".$teachId."'".')" ><span class="fa fa-pencil-square-o"></span> Edit </button>&nbsp
				
				<button type="button" class="btn btn-sm btn-danger" title="Delete Section Record" onclick="delSec('."'".$secCode."'".', '."'".$teachId."'".')" ><span class="fa fa-warning fa-sm"></span> Delete </button>&nbsp

				<button type="button" class="btn btn-sm btn-primary" title="Proceed to clearance" onclick="secClearance('."'".$secCode."'".', '."'".$teachId."'".')" > <span class="fa fa-info"></span> Clearance </button>&nbsp
			';
			

			$data[] = $row;

		}//e_f_each

		$output = array(

				"draw" => $_POST['draw'],//key at the array POST name draw
				"recordsTotal" => $this->thisModel2->count_all_sec(),
				"recordsFiltered" => $this->thisModel2->count_filtered_sec(),
				"data" => $data
			);

		echo json_encode($output); // encode the given array to JSON formatted String
	}//e()
	

// get the current subjects of the section in now
//list priority
	public function subjectList()
	{ 	$tblSubjects = 'tbsubject_list';

		$this->db->order_by("Subject_Code", "ASC");
		$Q = $this->db->get($tblSubjects);
		echo json_encode(['data' => $Q->result()]);
	}


	//thats for now bukas naman happy coding :) EZ
	public function getSectionSubjects($secCode, $teachID)
	{
		//sectionDat
		$QSec = $this->db->get_where('tbsection_query', array('Section_code'=> $secCode, 'Adviser' => $teachID), 1);

		//secSub
		$QSecSub = $this->db->get_where('tbsubject_section', array('Section_code'=> $secCode, 'Teacher_ID'=> $teachID));

		$output = array_merge($QSec->result(), $QSecSub->result());
		
		
		//echo "<pre>";
		echo json_encode($output);
		//$this->chkData($output);
		//echo "</pre>";

		// section data 

			// the different subjects  
	}

	private function chkData($Q)
	{
		
		print_r($Q);
		echo count($Q);
		echo "</pre>";	
	}

	// saving section edit or add new one
	public function saveSection($method)
	{

		$this->form_validation->set_rules('Section_code', 'Section Code', 'is_unique[tbsection.Section_code]');
			if ($this->form_validation->run() == false) {
				//echo 'Duplicate Section Code';
				echo json_encode(['status' => 'duplicate']);
				exit();
			}

		if ($method == 'add') {
			
			$subjects = explode(',', $_POST['subjects'][0]);

			$Q_SecSub;
			for ($i=0; $i < count($subjects); $i++) { 
				//echo "Index:".$i." = ". $subjects[$i]."<br>"; // each subjects

				// insert the each index in the tbsubject_section
				$tbSecSubjectsDat = array(
						'Section_code' => strtoupper($_POST['Section_code']),
						'Teacher_ID' => $_POST['Adviser'],
						'Subject_Code' => $subjects[$i]

					);
				$Q_SecSub = $this->db->insert($this->tblSecSubjects, $tbSecSubjectsDat);
			}

			array_pop($_POST);
			// pop the subjects part
			//insert data's to tbsection
			$QSec = $this->db->insert($this->tblSection, $_POST);

			if (($QSec) && ($Q_SecSub)) {
				echo json_encode(['status'=>true]);
			}
			else{
				echo json_encode(['status'=>false]);
			}

		}
		else{
			// do this in edit

			$subjects = array_pop($_POST);//getPOST and POST the last

						$this->db->where('Section_code', $_POST['Section_code']);
			$qSecUpdate = $this->db->update($this->tblSection, $_POST); // update Section

			$newSubj = explode(',', $subjects[0]); // make array of new subjects

			if(!empty($newSubj)){
				
				for ($i=0; $i < count($newSubj); $i++) { 
					
					$tbSecSubjectsDat = array(
									'Section_code' => $_POST['Section_code'],
									'Teacher_ID' => $_POST['Adviser'],
									'Subject_Code' => $newSubj[$i]

								);
					$Q_NewSecSub = $this->db->insert($this->tblSecSubjects, $tbSecSubjectsDat);
					// put the new subjects
				}

				//echo var_dump($Q_NewSecSub);
			}
			
		}
	}

	public function deleteSec($secCode, $teachId)
	{
		$sql = "call deleteSection(?, ?)";
		$Q = $this->db->query($sql, array($secCode, $teachId));

		if ($Q) {
			echo json_encode(['status' => true]);
		}
		else{
			echo json_encode(['status' => false]);
		}
	}


	// additional functions
	public function currentSecList($selectName)
	{
		$this->db->select('Section_code');
		$this->db->order_by('Section_code', 'DESC');
		$Q = $this->db->get($this->tblSection);
		$result = $Q->result();

		// create a select to be replace when quing the section list for the system
		$selectSecList = '<select name="Section_Code" id="'.$selectName.'">';
		$selectSecList .= '<option value="" style="color:#B3A6A6;">-Choose Section-</option>';
		//echo "<br>";
		foreach ($result as $row) {
			$crntSecCode = strtoupper($row->Section_code);
			// concatinate the select portion
			$selectSecList .= '<option value="'.$crntSecCode.'">'.$crntSecCode.'</option>';
		}

		$selectSecList .= '</select>';
		echo $selectSecList;

	}
}

/* End of file AdminSection.php */
/* Location: ./application/controllers/AdminSection.php */