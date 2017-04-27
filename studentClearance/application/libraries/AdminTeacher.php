<?php 
//not in use
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminTeacher
{
	protected $CI;
	//protected $modelT;
	function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->model('teacher/TeacherModel', 'thismodel');
		//$this->model = new thismodel();
	}

	// list teacher
	public function ajax_teach_list(){

		//output all the teacher data as an array of object
		$list = $this->CI->thismodel->teachList();
		return $list;
	}

	//get the last ID and increment it by one
	public function newTeachId(){
		$out = $this->CI->thismodel->lastID();
		$res = $out[0]['Teacher_ID'];		

		$prt1 = substr($res, 0, 4);
		$prt2 = (int)substr($res, 4,2);
		return $prt1. ($prt2 + 1);
	}

	public function saveTeach($method){

		return $this->CI->thismodel->saveTeacher($method);
	}

	public function getTeachDat($id){

		return $Q = $this->CI->thismodel->getTeachDat($id);
	}

	public function delTeach($id){
		return $Q = $this->CI->thismodel->deleteTeacher($id);
	}


}