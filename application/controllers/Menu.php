<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menu extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->skin->dashboard('menu/menu_list',null);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Menu_model->json();
    }


    public function get_data()
    {   

        $cari =[
        		'menu'=>@$_POST['menu_search_name'],
				'controller'=>@$_POST['controller_search_name'],
				'parent'=>@$_POST['parent_search_name'],
				'active'=> @$_POST['active_search_name']

                ];
            $dataq = $this->Menu_model->get_all($cari);
        $judul=[];
        $data['isi']=[];
        foreach ($dataq as $key => $v) {
            foreach ($v as $k => $val) {
                  array_push($judul, $k);
            }            
            $a= [$key+1,$v->menu,$v->controller,
                 '<a href="'. site_url("menu/read/").$v->id_menu.'" class="btn-xs btn-primary"> Lihat</a>
                 <a href="'. site_url("menu/update/").$v->id_menu.'" class="btn-xs btn-info"> Ubah</a>

                  <a href="#" class="btn-xs btn-danger" onclick="hapus('.$v->id_menu.',event)"> Hapus</a>
                 '];
            // <button  class="btn-sm btn-danger" onclick="hapus('.$v->id_menu.',event)"><i class="fas fa-trash"></i> hapus</button>
            array_push($data['isi'], $a);
        }
        $data['judul']=$judul;

        echo json_encode($data);
    }

       public function show()
    {

        $row = $this->Menu_model->get_all();
        if ($row) {
            $row=$row[0];
            $data = array(
                    'id_id_menu' => $row->id_menu,
                    'judul' => $row->judul,
                    'isi' => $row->isi,
                    'tanggal' => $row->tanggal,
                    'user_id' => $row->id_user,
            );
            //$da['a']=$dataq;
            $this->skin->view('data_show', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            $this->load->view('error404');
            
        }
    }
        public function do_upload(){
    
        $path = $_FILES['file']['name'];
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $nama = str_replace(' ', '', $this->input->post('judul')).'.'.$ext;
    
            $config['upload_path']          = './image/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['file_name']            = $nama;
            // echo $config['file_name'];exit();
            // $config['file_name']            = 'anu';
            // $config['max_size']             = 1000000;
            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;
  
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('file'))
            {
                    $error = array('error' => $this->upload->display_errors());
                    echo json_encode($error);
                    // $this->skin->dashboard('upload_form', $error);
            }
            else
            {
                    $data = array('upload_data' => $this->upload->data());
                    echo base_url().'image/'.$data['upload_data']['file_name'];
            }
        }


        public function upload_summernote()
    {

        $config['upload_path']          = './image/summernote/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['file_name']            = date('YmdHis');
        // echo $config['file_name'];exit();
        // $config['file_name']            = 'anu';
        // $config['max_size']             = 1000000;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;
        
        $this->load->library('upload', $config);
        // echo json_encode($_FILES);exit();
        if ( ! $this->upload->do_upload('image'))
        {
                $error = array('error' => $this->upload->display_errors());
                echo json_encode($error);
        }
        else
        {
                $data = array('upload_data' => $this->upload->data());
                echo base_url().'image/summernote/'.$data['upload_data']['file_name'];
        }
    }

    

    public function read($id) 
    {
        $row = $this->Menu_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_menu' => $row->id_menu,
		'menu' => $row->menu,
		'controller' => $row->controller,
		'parent' => $row->parent,
		'active' => $row->active,
	    );
            $this->skin->dashboard('menu/menu_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('menu'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Simpan',
            'action' => site_url('menu/create_action'),
	    'id_menu' => set_value('id_menu'),
	    'menu' => set_value('menu'),
	    'controller' => set_value('controller'),
	    'parent' => set_value('parent'),
	    'active' => set_value('active'),
	);
        $this->skin->dashboard('menu/menu_form', $data);
    }
    
    public function create_action() 
    {
        
            $data = array(
		'menu' => $this->input->post('menu'),
		'controller' => $this->input->post('controller'),
		'parent' => $this->input->post('parent'),
		'active' => $this->input->post('active'),
	    );

            $acc = $this->Menu_model->insert($data);
            echo $acc;
    }
    
    public function update($id) 
    {
        $row = $this->Menu_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('menu/update_action'),
		'id_menu' => set_value('id_menu', $row->id_menu),
		'menu' => set_value('menu', $row->menu),
		'controller' => set_value('controller', $row->controller),
		'parent' => set_value('parent', $row->parent),
		'active' => set_value('active', $row->active),
	    );
            $this->skin->dashboard('menu/menu_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('menu'));
        }
    }
    
    public function update_action() 
    {
        
            $data = array(
		'menu' => $this->input->post('menu'),
		'controller' => $this->input->post('controller'),
		'parent' => $this->input->post('parent'),
		'active' => $this->input->post('active'),
	    );

            $acc = $this->Menu_model->update($this->input->post('id_menu', TRUE), $data);
            echo $acc;
        
    }
    
    public function delete($id) 
    {
        $row = $this->Menu_model->get_by_id($id);

        if ($row) {
           $acc = $this->Menu_model->delete($id);
            echo $acc;

        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            echo 0;
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('menu', 'menu', 'trim|required');
	$this->form_validation->set_rules('controller', 'controller', 'trim|required');
	$this->form_validation->set_rules('parent', 'parent', 'trim|required');
	$this->form_validation->set_rules('active', 'active', 'trim|required');

	$this->form_validation->set_rules('id_menu', 'id_menu', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Menu.php */
/* Location: ./application/controllers/Menu.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-11-14 04:01:38 */
/* http://harviacode.com */