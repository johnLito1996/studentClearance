<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// not in use currently
class SectionModel extends CI_Model {

	protected $section;

	private $tbl = 'tbsection';

	public function __construct()
	{


	    /* 
			@param tab_name, col_order[], col_search[], order_by[]  
		*/

		parent::__construct();
		
	    $this->load->library('Datatables');
	    $this->section = new Datatables();

	    $colOrder = ['Section_code', 'Track', 'Strand', 'Adviser', 'Room_Number', 'Grade_level'];
		$colSearch = ['Section_code', 'Track', 'Strand', 'Adviser', 'Room_Number', 'Grade_level'];
	    $this->section->setVar($this->tbl, $colOrder, $colSearch, array("Section_code" => "desc"));

	}


	public function get_dTables_list_section(){

		return $this->section->get_data();
	}


	public function count_all_section(){

		return $this->section->count_data();
	}


	public function count_filtered_section(){

		return $this->section->filtered_data();
	}

	// currently not in use
	public function get_data_id($uid){

		return $this->section->get_id_data($uid);
	}

	public function update_user($where, $data){

		return $this->section->update_row_data($where, $data);
	}

	public function delete_user($uid){

		return $this->section->delete_row_data($uid);
	}

}

/* End of file SectionModel.php */
/* Location: ./application/models/SectionModel.php */