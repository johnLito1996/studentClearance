<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	/* always check if the function is within the class dec */
	class Login extends CI_Controller
	{
		private $tbl = ['tbadmin', 'tbteacher', 'tbstudent'];
		private $usrName;
		private $usrPass;
		private $usrType;
		private $condition;

		function __construct()
		{
			parent::__construct();
			$this->load->model('login/LoginModel', 'thismodel');
			$this->load->model('Admin/SettingModel', 'setting');
		}

		public function index(){

			//$this->load->view('loginview');
			/*echo "<pre>";
			print_r($Res);
			echo "</pre>";*/
			$data['scPic'] = $this->setting->schoolPic();
			$this->load->view('login', $data);
		}

		public function validate(){
			echo $Q = $this->thismodel->validateAcc();
			//$Q = $this->thismodel->validateAcc();

		}
	}

	