<?php 
// currently not use
defined('BASEPATH') OR exit('No direct script access allowed');

	class TeacherDashBoard extends CI_Model{

	var $tab_name = 'tbsection';
	var $col_order = array('Section_code', 'Track', 'Strand', 'Room_Number', 'Grade_level');
	var $col_search = array('Section_code', 'Track', 'Strand', 'Room_Number', 'Grade_level');
	var $order = array("Section_code" => "desc");

	function __construct(){

		parent::__construct();
	}

//private function
	private function get_dataTable_q(){
		$ctr = 0; 
		$this->db->from($this->tab_name);
		
		foreach ($this->col_search as $key) {
			
			if ($_POST['search']['value']) {
				
				if ($ctr === 0) {
					
					$this->db->group_start();
					$this->db->like($key, $_POST['search']['value']);
				}
				else{

					$this->db->or_like($key, $_POST['search']['value']);
				}

				if (count($this->col_search) - 1 == $ctr) {
					
					$this->db->group_end(); // grouping_endded
				}
			}
			$ctr = $ctr + 1; // $ctr++

			if (isset($_POST['order'])) {
				
				$this->db->order_by($this->col_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);

			}
			else if(isset($this->col_order)){

				$order = $this->order;
				$this->db->order_by(key($order), $order[key($order)]);
			}

		}

	}


/* getting data to output in the dtable */
	function get_dTables_secByTeach(){

		$crntTeacherID = $this->session->userdata('teacherLoginID');

		$this->get_dataTable_q();

		if ($_POST['length'] != -1) {
								
			$this->db->limit($_POST['length'], $_POST['start']);

			$Q = $this->db->get_where($this->tab_name, array('Adviser' => $crntTeacherID));

			return $Q->result();
		}

	}

}//e_class