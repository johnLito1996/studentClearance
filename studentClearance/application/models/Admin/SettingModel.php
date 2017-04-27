<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SettingModel extends CI_Model {

	private $tbl = 'tbsetting';

	public function __construct()
	{
		parent::__construct();
		
	}

	public function schoolPic(){

		$Q = $this->db->get_where($this->tbl, array('id' => 1));
		$res = $Q->result_array()[0]['schoolImg'];
		return $res;
	}
}

/* End of file SettingModel.php */
/* Location: ./application/models/SettingModel.php */