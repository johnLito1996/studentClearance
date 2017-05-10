<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class StudentModel extends CI_Model{

		var $students;
		//$t_name, $t_order, $col_search, $order
		function __construct(){

			parent::__construct();
			$this->load->library("Datatables");

			#@param tab_name, col_order[], col_search[], order_by[]
		$this->students = new Datatables(); 
		$this->students->setVar("tbenrolled_query", array("LRN_number", "Last_Name", "First_Name", "Initial", "Gender", "Status", "Section_Code"), array("Last_Name", "First_Name", "Status", "Section_Code"), array("Last_Name" => "desc"));
		}

		public function get_dTables_list_students(){

			return $this->students->get_data();
		}


		public function count_all_students(){

			return $this->students->count_data();
		}


		public function count_filtered_students(){

			return $this->students->filtered_data();
		}

		public function get_data_id($uid){

			return $this->students->get_id_data($uid);
		}

		public function update_user($where, $data){

			return $this->students->update_row_data($where, $data);
		}

		public function delete_user($uid){

			return $this->students->delete_row_data($uid);
		}
	}