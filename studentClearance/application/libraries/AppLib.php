<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
	Library function is to eliminate the following process in the model

	# Searching of records in different tables result in a well form assoc Array
	# The Clearance Process of the Admin and the Teacher
*/

class AppLib extends CI_Model
{
	protected $ci;

	public function __construct()
	{
        $this->ci =& get_instance();
	}
	
	// return a assoc array waiting to be converted in the model

	/*
		fear nothing
	*/
	private function searchSecTable($tblName, $dataSearch){
		$returnArr = [];

		/* get the tbCol OK */
		/* search data in section code */
		
		/* process the tbl here*/
		$this->db->get($tblName);
		$this->db->where();



		return $returnArr;		
	}

}

/* End of file AppLib.php */
/* Location: ./application/libraries/AppLib.php */
