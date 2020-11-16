<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skin
{
	protected $ci;

	public function __construct()
	{
        $this->ci =& get_instance();
        // $this->load->model('m_main','main');
	}

	public function view($name,$val)
	{
		// echo $name;

		$data['profil']= $this->ci->db->query('select * from profil')->row_array();
		$data['sosmed']= $this->ci->db->query('select * from sosmed')->row_array();
		$data['body']=$this->ci->load->view($name, $val, true);
		// echo $data['body'];exit();
		$this->ci->load->view('skin', $data);
	}
	public function dashboard($name,$val)
	{
		// echo $name;

		$data['parent']= $this->ci->db->query('select * from menu where parent = 0 and active = 1')->result();
		$data['child']= $this->ci->db->query('select * from menu where parent != 0 and active = 1')->result();
		// echo "<pre>";
		// print_r ($data);
		// echo "</pre>";exit();
		
		$data['body']=$this->ci->load->view($name, $val, true);
		// echo $data['body'];exit();
		$this->ci->load->view('limitless', $data);
	}


	

}

/* End of file Skin.php */
/* Location: ./application/libraries/Skin.php */
