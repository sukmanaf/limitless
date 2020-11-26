<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model {


	public function get_by_billing($value='')
	{
		$this->db->where('id_billing', $value);
		$this->db->join('nik', 'nik.id = sspd.id_nik');		
		$data = $this->db->get('sspd');
		return $data->row();
	}
		

}

/* End of file Api_model.php */
/* Location: ./application/models/Api_model.php */