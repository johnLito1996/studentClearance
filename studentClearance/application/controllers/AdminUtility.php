<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adminutility extends CI_Controller {

	private $tblAdmin = 'tbadmin';
	private $crntAdmin;
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Admin/SettingModel', 'setting');

	}

//checking data
	private function chkData($Q){

		echo "<pre>";
		print_r($Q);
		echo "</pre>";
	}

//returning bool
	public function retBool($Q)
	{
		if ($Q) {
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

// index page
	public function index()
	{
		$adminID = $this->session->userdata('adminUserNameCrnt');
		$this->crntAdmin = $adminID;

		if (empty($this->crntAdmin)) {
			show_404();
		}
		else{
			$data['scPic'] = $this->setting->schoolPic();
			$this->load->view('Admin/adminUtility', $data);
		}
	}

//custom button active and inactive
	public function labelcodition($status)
	{
		if ($status === 'active') {
			return '<center><span class="badge bg-green">Active</span></center>';
		}
		else{
			return '<center><span class="badge bg-red">In Active</span></center>';
		}
	}

//get AdminAccount
	public function getadminaccount()
	{
		$Q = $this->db->get($this->tblAdmin);
		$result = $Q->result_array();

		$outTR = '';
		for ($i=0; $i < count($result); $i++) { 
			$pass = $result[$i]['Password'];
			$passMask = str_repeat("*", strlen($pass));

			$crntStatus = $result[$i]['status'];

			$usrName = $result[$i]['UserName'];

			$tblIndx = ($i + 1);
		$outTR .= '<tr>';
			$outTR .= '<td>'.$tblIndx .'</td>';
			$outTR .= '<td>'.$usrName.'</td>';
			$outTR .= '<td>'.$passMask.'</td>';
			$outTR .= '<td>'.$this->labelCodition($crntStatus, $tblIndx).'</td>';

			//
			if (($i + 1) > 1) {

				if ($crntStatus == 'active') {
					$outTR .= '<td> <center><button class="btn btn-sm btn-danger" id="btnDeactivate" data-crntstatus='."'".$crntStatus."'".' data-crntusrname='."'".$usrName."'".'>
						<span clas="fa fa-sm fa-times"></span>
						Diactivate Account</button></center></td>';
				}
				else{
					$outTR .= '<td> <center><button class="btn btn-sm btn-success" id="btnDeactivate" data-crntstatus='."'".$crntStatus."'".' data-crntusrname='."'".$usrName."'".'>
						<span clas="fa fa-sm fa-times"></span>
						Activate </button></center></td>';
				}
				
			}
			else{
				$outTR .= '<td>
				<center><span clas="fa fa-sm fa-times"> Can\'t be diactivated </span></center>
				</td>';
			}


		$outTR .= '</tr>';
		}

		echo $outTR;
	}

//save Admin
	public function saveadmin()
	{
		$Q = $this->db->insert($this->tblAdmin, $_POST);

		if ($Q) {
			echo json_encode(['status' => true]);
		}
		else{
			echo json_encode(['status' => false]);
		}
	}

// changing the status of admin
	public function changestatusadmin($adminusrname, $crntstat)
	{
		if ($crntstat == 'active') {
			 $sqlUpdateStatus = "UPDATE `tbadmin` SET `status`=(?) WHERE `UserName`=(?)";
			 $Q = $this->db->query($sqlUpdateStatus, ['inactive', $adminusrname]);
			 echo json_encode(['updated' => $this->retBool($Q)]);
		}
		else{
			$sqlUpdateStatus = "UPDATE `tbadmin` SET `status`=(?) WHERE `UserName`=(?)";
			$Q = $this->db->query($sqlUpdateStatus, ['active', $adminusrname]);
			echo json_encode(['updated' => $this->retBool($Q)]);
		}
		
	}



	public function changeadminpass($usrname, $newPass)
	{
		$updatePassAdmin = "UPDATE `tbadmin` SET `Password`=(?) WHERE `UserName` = (?)";

		$Q = $this->db->query($updatePassAdmin, [$newPass, $usrname]);
		
		echo json_encode(['status' => $this->retBool($Q)]);
	}
}

/* End of file AdminUtility.php */
/* Location: ./application/controllers/AdminUtility.php */