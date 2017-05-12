<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Login extends CI_Controller
	{
		private $tbl = ['tbadmin', 'tbteacher', 'tbstudent'];

		function __construct()
		{
			parent::__construct();
			$this->load->model('Admin/SettingModel', 'setting');
			$this->load->database();
		}

		private function chkData($Q)
		{
			echo "<pre>";
				print_r($Q);
			echo "</pre>";
		}

// login and logout Page
		public function index(){

			$this->session->sess_destroy();// destroying all the session variable
			$data['scPic'] = $this->setting->schoolPic();
			$this->load->view('login', $data);
		}

// validation of 3 account
		public function validateAccount($usrType)
		{
			// if admin account Que
			if ($usrType == 'admin') {
				array_pop($_POST);
				$adminDat = $_POST;
				//$this->chkData($adminDat);
				$Q = $this->db->get_where($this->tbl[0], $adminDat);
				if ($Q->num_rows() == 1) {

					if ($Q->result()[0]->status === 'active') {
						$crntAdminUSrname = $Q->result()[0]->UserName;
						$this->session->set_userdata('adminUserNameCrnt',$crntAdminUSrname);
						echo json_encode(['admin' => true]);

					}else{
						echo json_encode(['admin' => false]);
					}
					
				}
				else{
					echo json_encode(['admin' => false]);
				}

			}
			elseif($usrType == 'teacher'){
				// if teacher acc Que
				array_pop($_POST);
				$teachDat = $_POST;
				$teachSql = "SELECT * FROM `tbteacher` WHERE `Username` = (?) AND `Password` = (?)";
				
				$Q = $this->db->query($teachSql, [$_POST['Username'], $_POST['Password']]);
				
				$resultRow = $Q->num_rows();

				//exit();
				if ($resultRow > 0) {

					$crntTeachID = $Q->result()[0]->Teacher_ID;
					$this->session->set_userdata('teacherLoginID',$crntTeachID);
					echo json_encode(['teacher' => true]);
				}
				else{
					echo json_encode(['teacher' => false]);
				}
			}
			else{
				// if Student Pass Que
				//array_shift($_POST);[$studDat]
				array_pop($_POST);
				/*$studDat = $_POST;*/
				$SQL = "SELECT * FROM `tbstudent` WHERE `Password` = (?) AND `Username` = (?)";
				$Q = $this->db->query($SQL, [$_POST['Password'], $_POST['Username']]);

				//$this->chkData($Q->result());
				if ($Q->num_rows() == 1) {
					$crntStudID = $Q->result()[0]->LRN_Number;
					$this->session->set_userdata('studentLoginID',$crntStudID);
					echo json_encode(['student' => true]);
				}
				else{
					echo json_encode(['student' => false]);
				}

			}

		}
	}

	