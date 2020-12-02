<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun extends CI_Controller {
function __construct()
    {
        parent::__construct();
        $this->load->model('Global_model','global');
        $this->load->model('Ppat_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
        $this->load->library('pdf');

        $this->ses = $this->session->userdata('user');
        $this->setting = $this->session->userdata('setting');
    }
	public function index()
	{
		
	}
	public function get($id) 
    {
        $row = $this->global->get_user($id);
        // echo "<pre>";
        // print_r ($row);
        // echo "</pre>";exit();
        $data = array(
            'tipe' => 'update',
            'button' => 'Simpan',
            'action' => site_url('akun/update_action'),
	        'id' => $row->id,
	        'id_user' => $row->id_user,
	        'username' => $row->username,
	        'password' => $row->password,
	        'nama' => $row->nama,
	        'jabatan' => $row->jabatan,
	    	);
        $this->skin->dashboard('akun', $data);
    }

     public function update($id) 
    {
        $row = $this->Ppat_model->get_by_id($id);

            $data = array(
            'jenis' => 'update',
            'button' => 'Update',
            'action' => site_url('ppat/update_action'),
    		'id' => set_value('id', $row->id_user),
    		'nama' => set_value('nama', $row->nama),
    		'id_user' => set_value('id_user', $row->id_user),
            'id_ppat' => set_value('id_ppat', $row->id_ppat),
            'username' => set_value('username', $row->username),
            'password' => set_value('password', $row->password),
            'blokir' => set_value('blokir', $row->blokir),
       		);
       		echo "<pre>";
       		print_r ($data);
       		echo "</pre>";
            $this->skin->dashboard('akun', $data);
       
    }
}

/* End of file Akun.php */
/* Location: ./application/controllers/Akun.php */