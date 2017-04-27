<?php
//not in use 
defined('BASEPATH') OR exit('No direct script access allowed');

class TeacherModel extends CI_Model
{
	private $tbl = 'tbteacher';
	function __construct()
	{
		parent::__construct();
	}

	/* returning  data */
	private function retTurn($obj){
		if ($obj) {
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	public function saveTeacher($method){

		$userPass = $this->input->post('Teacher_First_Name').'_'.$this->input->post('Teacher_Last_Name');
		//echo $this->input->post('Teacher_First_Name');
		$arrUser = array(
			'Username' => str_replace(' ', '_', $userPass),
			'Password' => str_replace(' ', '_', $userPass)
			);

		// mergeng array POST and userDat
		$data = array_merge($_POST, $arrUser);

		/*$Q = $this->db->insert($this->tbl, $data);

		return $this->retTurn($Q);*/

		if ($method == 'edit') {
			//$id = $this->input->post('Teacher_ID');
			//return $this->editTeacher($data);
			$X = $this->db->replace($this->tbl, $data);
			$this->retTurn($X);
		}
		else{
			$Q =$this->db->insert($this->tbl, $data);
			return $this->retTurn($Q);
		}

	}

	public function editTeacher($teachId, $data){

		//$Q = $this->db->update($this->tbl, $data, $where);
		//return $this->deleteTeacher($teachId);
		$Q = $this->db->replace($this->tbl, $data);

		//return $this->retTurn($Q);

	}

	public function deleteTeacher($teachID){

		// just set the status to be non-active
		//$this->db->where('Teacher_ID', $teachID);
		//$Q = $this->db->delete($this->tbl);

		$this->db->set(array('Status' => 'Non-Active'));
		$this->db->where('Teacher_ID', $teachID);
		$Q = $this->db->update($this->tbl); // gives UPDATE mytable SET field = field+1 WHERE id = 2

		return $this->retTurn($Q);
	}

	//tbl lastID
	public function lastID(){
		//call the stored procedure in mysql for last ID in Teach
		$sql = "call TeachlastTID()"; 
		$Q = $this->db->query($sql);
		return $Q->result_array();
	}

	//tbl * list
	public function teachList(){
		// return the teacher tbl as array of object
		$this->db->order_by("Teacher_First_Name", "ASC");
		$Q = $this->db->get_where($this->tbl, array('Status'=> 'Active'));

		if ($Q) {
			return $Q->result();
		}
		else{
			return 'No available Record';
		}
	}

	public function getTeachDat($id){

		$Q = $this->db->get_where($this->tbl, array('Teacher_ID' => $id));

			if ($Q) {
				return $Q->result();
			}
			else{
				return 'No record found';
			}
		
	}

	// 
/*	public function getTeachFname($teachID)
	{
		$sql = "call getTeachFname(?)";

		$Q = $this->db->query($sql, $teachID);
		
		if ($Q) {
			return $Q->result();
		}
		else{
			return NULL;
		}
	}*/

}