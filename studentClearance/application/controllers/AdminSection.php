<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminSection extends CI_Controller {

  //table
  private $tbl = 'tbsection';

	public function __construct()
	{
		parent::__construct();
		$this->load->library('AdminLib');
    $this->load->library('MyUtility');

    // combined the model and controller here
    $this->load->database();
	}

  // checking the output Data
  private function functionChkData($dataIN){

    echo "<pre>";
    print_r($dataIN);
    echo "</pre>";
  }

	public function index()
	{
		$this->load->view('Admin/sectionPane');
	}

	//adminData
	public function AdminDat(){
		echo json_encode(['data' => $this->adminlib->getAdminDat()]);
	}

  //, 
  public function getTeacher($teacherID, $secCode)
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

  // 1. get the id and fullName of each teacher that have a section
  // search in that array
  public function TableSec($limit = 5)
  {
    $rowTbl = '';
         $this->db->limit($limit);
    $Q = $this->db->get($this->tbl);

   // $this->functionChkData($Q->result());

    $result = $Q->result();
    
    //border="1"
    echo '<table class="table table-hover">';
    $rowTbl .= <<<EOD
          <tr>
            <th> <b>Section ID</b> </th>
            <th> <b>Track</b> </th>
            <th> <b>Strand</b> </th>
            <th> <b>Adviser</b> </th>
            <th> <b>Room</b> </th>
            <th> <b>Semester</b> </th>
            <th> <b>Action</b> </th>
          </tr>
EOD;
    foreach ($result as $index) {
      $secCode = $index->Section_code;
      //echo $teacherName = $this->getTeacher($index->Adviser, $index->Section_code);
      $teacherName = $this->getTeacher($index->Adviser, $index->Section_code);

      $rowTbl .= '<tr>';
      $rowTbl .= '<td>'.$secCode.'</td>';
      $rowTbl .= '<td>'.$index->Track.'</td>';
      $rowTbl .= '<td>'.$index->Strand.'</td>';
      /*$rowTbl .= '<td id="teachName" data-TID ="'.$index->Adviser.'"> cID2Name AJX </td>';*/
      $rowTbl .= '<td>'.$teacherName.'</td>';
      $rowTbl .= '<td>'.$index->Room_Number.'</td>';
      $rowTbl .= '<td>'.$index->Semestral_code.'</td>';
      $rowTbl .= '<td>';
        $rowTbl .= '<button type="button" class="btn btn-sm btn-success" title="View Subjects" data-secCode="'.$secCode.'"><span class="fa fa-eye"></span> Subjects</button>&nbsp';

        $rowTbl .= '<button type="button" class="btn btn-sm btn-primary" title="Full Section Details" data-secCode="'.$secCode.'"> <span class="fa fa-info"></span> Details </button>&nbsp';

        $rowTbl .= '<button type="button" class="btn btn-sm btn-danger" title="Delete Section" data-secCode="'.$secCode.'"> <span class="fa fa-trash"></span> Delete </button>&nbsp';
      $rowTbl .= '</td>';
      $rowTbl .= '</tr>';
    }
    echo $rowTbl;
    echo '</table>';
    
    }

    
/*  }*/
























}// class

/* End of file AdminSection.php */
/* Location: ./application/controllers/AdminSection.php */