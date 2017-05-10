<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Student extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		echo "Hello their iam the controller for student";
	}

}

/* End of file Student.php */
/* Location: ./application/controllers/Student.php */