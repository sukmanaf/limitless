<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{
		$data['ses'] = $this->session->userdata('user');
		$this->skin->dashboard('dashboard', $data, FALSE);		
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */