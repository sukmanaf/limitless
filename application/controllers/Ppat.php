<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ppat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Ppat_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->skin->dashboard('ppat/ppat_list',null);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Ppat_model->json();
    }


    public function get_data()
    {   

        $cari =[
        		'nama'=>@$_POST['nama_search_name'],
				'alamat'=>@$_POST['alamat_search_name'],

                ];
            $dataq = $this->Ppat_model->get_all($cari);
        $judul=[];
        $data['isi']=[];
        foreach ($dataq as $key => $v) {
            foreach ($v as $k => $val) {
                  array_push($judul, $k);
            }            
            $a= [$key+1,$v->nama,$v->alamat,
                 '<a href="'. site_url("ppat/read/").$v->id.'" class="btn-xs btn-primary"> Lihat</a>
                 <a href="'. site_url("ppat/update/").$v->id.'" class="btn-xs btn-info"> Ubah</a>

                  <a href="#" class="btn-xs btn-danger" onclick="hapus('.$v->id.',event)"> Hapus</a>
                 '];
            // <button  class="btn-sm btn-danger" onclick="hapus('.$v->id.',event)"><i class="fas fa-trash"></i> hapus</button>
            array_push($data['isi'], $a);
        }
        $data['judul']=$judul;

        echo json_encode($data);
    }

       public function show()
    {

        $row = $this->Ppat_model->get_all();
        if ($row) {
            $row=$row[0];
            $data = array(
                    'id_id' => $row->id,
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
        $row = $this->Ppat_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'nama' => $row->nama,
		'alamat' => $row->alamat,
		'id_user' => $row->id_user,
	    );
            $this->skin->dashboard('ppat/ppat_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ppat'));
        }
    }

    public function create() 
    {
        $data = array(
            'jenis' => 'add',
            'button' => 'Simpan',
            'action' => site_url('ppat/create_action'),
	    'id' => set_value('id'),
	    'nama' => set_value('nama'),
	    'alamat' => set_value('alamat'),
	    'id_user' => set_value('id_user'),
        'username' => set_value('username'),
        'password' => set_value('password'),
	);
        $this->skin->dashboard('ppat/ppat_form', $data);
    }
    
    public function create_action() 
    {
        
            $user = array(
		'nama' => $this->input->post('nama'),
		'username' => $this->input->post('username'),
		'password' => $this->input->post('password'),
        'jenis' => 'PP',
        'blokir' => 0,
	    );
            $ins_user = $this->Ppat_model->insert_user($user);
            $ins = explode('.',$ins_user);

        
        if ($ins[0] == 1) {
            
            $ppat = array(
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'id_user' => $ins[1],
            );

            $acc = $this->Ppat_model->insert($ppat);
            if ($acc) {
                $result = json_encode(array('sts' => 1 ));
            }
        }else{

                $result = json_encode(array('sts' => 0 ));
        }

            echo $result;
    }
    
    public function update($id) 
    {
        $row = $this->Ppat_model->get_by_id($id);

        if ($row) {
            $data = array(
            'jenis' => 'update',
            'button' => 'Update',
            'action' => site_url('ppat/update_action'),
    		'id' => set_value('id', $row->id),
    		'nama' => set_value('nama', $row->nama),
    		'alamat' => set_value('alamat', $row->alamat),
    		'id_user' => set_value('id_user', $row->id_user),
            'id_ppat' => set_value('id_ppat', $row->id_ppat),
            'username' => set_value('username', $row->username),
            'password' => set_value('password', $row->password),
            'blokir' => set_value('blokir', $row->blokir),
	    );
            $this->skin->dashboard('ppat/ppat_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ppat'));
        }
    }
    
    public function update_action() 
    {
        
         $user = array(
        'nama' => $this->input->post('nama'),
        'username' => $this->input->post('username'),
        'password' => $this->input->post('password'),
        'jenis' => 'PP',
        'blokir' => 0,
        );
            $up = $this->Ppat_model->update_user($this->input->post('id_user', TRUE), $user);
        if ($up) {
             $ppat = array(
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            );

            $acc = $this->Ppat_model->update($this->input->post('id_ppat', TRUE), $ppat);
            if ($acc) {
            
                $result = json_encode(array('sts' => 1 ));
            }else{
                $result = json_encode(array('sts' => 0 ));

            }

        }else{

                $result = json_encode(array('sts' => 2 ));
        }
            echo $result;
        
    }
    
    public function delete($id) 
    {
        $row = $this->Ppat_model->get_by_id($id);

        if ($row) {
           $acc = $this->Ppat_model->delete($id);
            echo $acc;

        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            echo 0;
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('id_user', 'id user', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Ppat.php */
/* Location: ./application/controllers/Ppat.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-11-26 22:45:37 */
/* http://harviacode.com */