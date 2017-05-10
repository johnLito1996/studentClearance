<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminUtility extends CI_Controller {

	private $tblAdmin = 'tbadmin';
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Admin/SettingModel', 'setting');

	}

	private function chkData($Q){

		echo "<pre>";
		print_r($Q);
		echo "</pre>";
	}

	public function index()
	{
		$data['scPic'] = $this->setting->schoolPic();
		$this->load->view('Admin/adminUtility', $data);
	}

	public function getAdminAccount()
	{
		
		$Q = $this->db->get($this->tblAdmin);
		$result = $Q->result_array();

		//$this->chkData($result);
		//exit();
		$outTR = '';
		for ($i=0; $i < count($result); $i++) { 
			$pass = $result[$i]['Password'];
			$passMask = str_repeat("*", strlen($pass));
		$outTR .= '<tr>';
			$outTR .= '<td>'.($i + 1).'</td>';
			$outTR .= '<td>'.$result[$i]['UserName'].'</td>';
			$outTR .= '<td>'.$passMask.'</td>';
		$outTR .= '</tr>';
		}

		echo $outTR;
	}

	public function saveAdmin()
	{
		$Q = $this->db->insert($this->tblAdmin, $_POST);

		if ($Q) {
			echo json_encode(['status' => true]);
		}
		else{
			echo json_encode(['status' => false]);
		}
	}
}

/* End of file AdminUtility.php */
/* Location: ./application/controllers/AdminUtility.php */