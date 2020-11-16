<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_main extends CI_Model {

	public function get_all_result($table='')
		{
			$data = $this->db->get($table);
			return $data->result();
		}

	public function get_all_row($table='')
		{
			$data = $this->db->get($table);
			return $data->row_array();
		}	
	public function get_all_numbrow($table='')
		{
			$data = $this->db->get($table);
			return $data->num_rows();
		}	

	public function get_detail($table='',$where='')
		{

			$sql="select * from ".$table." where ".$where;
			$data = $this->db->query($sql);  
			return $data->row_array();
		}	
	public function get_all_where($table='',$where='')
		{

			$sql="select * from ".$table." where ".$where;
			$data = $this->db->query($sql);  
			return $data->result();
		}	

		public function insert_batch($data='')
		{


			$ins = $this->db->insert_batch('jenis_mobil', $data);
			if ($ins) {
			return 1;
			}else{
				return 0;
			}
		}
		

}

/* End of file m_main.php */
/* Location: ./application/models/m_main.php */