<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tampilan extends CI_Controller {

	public function index()
	{
		// $this->skin->view('home', null, FALSE);
		$this->load->view('home', null, FALSE);
	}

	public function drop($value='')
	{
		$this->load->view('drop', null, FALSE);
	}

}

/* End of file Tampilan.php */
/* Location: ./application/controllers/Tampilan.php */