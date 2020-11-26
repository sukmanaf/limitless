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
}

/* End of file Logs.php */
/* Location: ./application/libraries/Logs.php */
