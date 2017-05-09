<?php 
// currently in use
defined('BASEPATH') OR exit('No direct script access allowed');

	class Acad_sections extends CI_Model{

		/* global variables */
		/* class instance var */
		/* var kailangan para gumana ang mga member variable sa baba :)*/
		var $tab_name = 'tbsection';
		var $col_order = array('Section_code', 'Track', 'Strand', 'Adviser', 'Room_Number', 'Grade_level');
		var $col_search = array('Section_code', 'Track', 'Strand', 'Adviser', 'Room_Number', 'Grade_level');
		var $order = array("Section_code" => "desc");

		function __construct(){

			parent::__construct();
		}

		private function get_dataTable_q(){
			$ctr = 0; 
			$this->db->from($this->tab_name);
			
			/* yung mga nakalagay sa POST[key][value] chenicheck lang kung true yung laman nun*/
			foreach ($this->col_search as $key) {
				
				/*input type = [key_search][ele_value] in the POST Array*/
				if ($_POST['search']['value']) {
					
					/* strictly equal including the data type*/
					if ($ctr === 0) {
						
						$this->db->group_start(); // grouping_start

						$this->db->like($key, $_POST['search']['value']);
					}
					else{

						$this->db->or_like($key, $_POST['search']['value']);
					}

					//last loop
							// lenght - 1
					if (count($this->col_search) - 1 == $ctr) {
						
						$this->db->group_end(); // grouping_endded
					}
				}
				$ctr = $ctr + 1; // $ctr++

				/*ordering the data*/
				if (isset($_POST['order'])) {
					
					/* 
					col_oder[key][value][?]= inserting
					
					order_by('odr', 'str_pos');
					*/
					$this->db->order_by($this->col_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);

				}
				else if(isset($this->col_order)){

					$order = $this->order;

					/*key() - return the key of the array*/
					$this->db->order_by(key($order), $order[key($order)]);
				}

			}//e_foreach

		}//e()


		/* getting data to output in the dtable */
		function get_dTables_sec(){

			/* execute the dtable query */
			$this->get_dataTable_q();

			if ($_POST['length'] != -1) {
									
									// dropbox lenght, 1
				$this->db->limit($_POST['length'], $_POST['start']);

				/*select all the data being ask*/
				$Q = $this->db->get();

				return $Q->result();// return the result with its method result() whose gonna give the data (array of object) can be fitch using the foreach
			}
		}//e()


		/* getting * data from the table*/
		function count_filtered_sec(){

			/* mga list of Q*/
			$this->get_dataTable_q();

			/*taga select nung mga Q*/
			$Q = $this->db->get();
			return $Q->num_rows();
		}


		/* counting all the row in the section_tbl*/
		public function count_all_sec(){

			$this->db->from($this->tab_name);

			return $this->db->count_all_results();
		}


		/* getting a specific row by its id*/
		public function get_by_id_sec($section_id){

			$this->db->from($this->tab_name); //from
			$this->db->where('section_id', $section_id); //where

			$Q = $this->db->get();// select *

			return $Q->row(); // returbn the specific row
		}


		/* saving the new section data */
		public function save_sec($data){ // parameter of array

			$this->db->insert($this->tab_name, $data);
			return $this->db->insert_id(); // get the last id generated from the table
		}


		/* updating a certain row at the table using the where=id, data is an array*/
		public function update_sec($where, $data){

			/*('tab_name', 'arr:data', 'where', 'lmt')*/
			$this->db->update($this->tab_name, $data, $where);

			return $this->db->affected_rows(); // returns the int of affected row by the query
		}


		/* deleting a row using its id*/
		public function del_by_id_sec($section_id){

			$this->db->where('section_id', $section_id);

			$this->db->delete($this->tab_name);
		}
	}//e_class