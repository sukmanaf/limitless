<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skin
{
	protected $ci;

	public function __construct()
	{
        $this->ci =& get_instance();
        // $this->load->model('m_main','main');
        $this->ci->load->model('Global_model');

	}


	public function dashboard($name,$val)
	{
		// echo $name;
		$ses = $this->ci->session->userdata('user');
		
		if (!empty($ses) && @$ses['jenis'] != 'AD') {
			
		$roles= $this->ci->db->query('select * from role where jenis ="'.$ses['jenis'].'"')->row();
		$role = $roles->role;
		}else{
			$role='6';
		}
	
		$data['parent']= $this->ci->db->query('select * from menu where parent = 0 and active = 1')->result();
		$data['child']= $this->ci->db->query('select * from menu where parent != 0 and active = 1')->result();
		if (@$ses['jenis'] != 'AD' && !empty($ses)) {
		$data['parent']= $this->ci->db->query('select * from menu where parent = 0 and active = 1 and id_menu in ('.$role.')')->result();
		$data['child']= $this->ci->db->query('select * from menu where parent != 0 and active = 1 and id_menu in ('.$role.')')->result();
		}
		$data['setting']= $this->ci->db->query('select * from setting')->row();
   		$val['session']=$this->ci->session->userdata('user');

        $ses=$this->ci->session->userdata('user');
        $data['sspd_notif'] = $this->ci->Global_model->get_sspd_notif(@$ses['jenis'],@$ses['jabatan'])->jml;

		$val['setting']= $data['setting'];

		$data['body']=$this->ci->load->view($name, $val, true);
		// echo $data['body'];exit();
		$this->ci->load->view('limitless', $data);
	}




}

/* End of file Skin.php */
/* Location: ./application/libraries/Skin.php */
