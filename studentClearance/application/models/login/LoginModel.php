<?php 
/* not in use from the system */
/* validation of account of the user */
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginModel extends CI_Model
{
	private $tbl = ['tbadmin', 'tbteacher', 'tbstudent'];
	private $usrName;
	private $usrPass;
	private $usrType;
	private $condition;
	function __construct()
	{
		#parent constructor
		parent::__construct();
		//$this->load->library('MyUtility');
	}

	public function validateAcc(){

		$this->usrName = $this->input->post('Username');
		$this->usrPass = $this->input->post('Password');
		$this->usrType = $this->input->post('usrType');

		$this->condition = array(
				'UserName' => $this->usrName,
				'Password' => $this->usrPass
				);

		if ($this->usrType === 'admin') {

			$Q = $this->db->get_where($this->tbl[0], $this->condition);
			if ($Q->num_rows() == 1) {
				echo 'Admin';
			}
			else{
				echo 'NotAdmin';
			}
		}
		elseif($this->usrType === 'teacher'){

			$Q = $this->db->get_where($this->tbl[1], $this->condition);
			if ($Q->num_rows() == 1) {
				echo 'Teacher';
			}
			else{
				echo 'NotTeacher';
			}
		}
		else{

			$Q = $this->db->get_where($this->tbl[2], $this->condition);
			if ($Q->num_rows() == 1) {
				echo 'Student';
			}
			else{
				echo 'NotStudent';
			}
		}
	}

}