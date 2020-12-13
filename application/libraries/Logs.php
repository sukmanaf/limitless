<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logs
{
	protected $ci;

	public function __construct()
	{
        $this->ci =& get_instance();

	}

	
		public function proses($value='')
	{
		$this->ci->db->insert('log_proses', $value);
	}

		public function create($value='')
	{
		$this->ci->db->insert('log_sspd', $value);
	}
		public function update($value='')
	{
		$this->ci->db->insert('log_sspd', $value);
	}
		public function payment($value='')
	{
		$this->ci->db->insert('log_payment', $value);
	}
}

/* End of file Logs.php */
/* Location: ./application/libraries/Logs.php */
