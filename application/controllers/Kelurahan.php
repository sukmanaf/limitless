<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kelurahan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Kelurahan_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->skin->dashboard('kelurahan/kelurahan_list',null);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Kelurahan_model->json();
    }


    public function get_data()
    {   

        $cari =[
        		'kecamatan_id'=>@$_POST['kecamatan_id_search_name'],
				'nama'=>@$_POST['nama_search_name'],

                ];
            $dataq = $this->Kelurahan_model->get_all($cari);
        $judul=[];
        $data['isi']=[];
        foreach ($dataq as $key => $v) {
            foreach ($v as $k => $val) {
                  array_push($judul, $k);
            }            
            $a= [$key+1,$v->kecamatan_id,$v->nama,
                 '<a href="'. site_url("kelurahan/read/").$v->id.'" class="btn-xs btn-primary"> Lihat</a>
                 <a href="'. site_url("kelurahan/update/").$v->id.'" class="btn-xs btn-info"> Ubah</a>

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

        $row = $this->Kelurahan_model->get_all();
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
        $row = $this->Kelurahan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'kecamatan_id' => $row->kecamatan_id,
		'nama' => $row->nama,
	    );
            $this->skin->dashboard('kelurahan/kelurahan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kelurahan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Simpan',
            'action' => site_url('kelurahan/create_action'),
	    'id' => set_value('id'),
	    'kecamatan_id' => set_value('kecamatan_id'),
	    'nama' => set_value('nama'),
	);
        $this->skin->dashboard('kelurahan/kelurahan_form', $data);
    }
    
    public function create_action() 
    {
        
            $data = array(
		'kecamatan_id' => $this->input->post('kecamatan_id'),
		'nama' => $this->input->post('nama'),
	    );

            $acc = $this->Kelurahan_model->insert($data);
            echo $acc;
    }
    
    public function update($id) 
    {
        $row = $this->Kelurahan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kelurahan/update_action'),
		'id' => set_value('id', $row->id),
		'kecamatan_id' => set_value('kecamatan_id', $row->kecamatan_id),
		'nama' => set_value('nama', $row->nama),
	    );
            $this->skin->dashboard('kelurahan/kelurahan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kelurahan'));
        }
    }
    
    public function update_action() 
    {
        
            $data = array(
		'kecamatan_id' => $this->input->post('kecamatan_id'),
		'nama' => $this->input->post('nama'),
	    );

            $acc = $this->Kelurahan_model->update($this->input->post('id', TRUE), $data);
            echo $acc;
        
    }
    
    public function delete($id) 
    {
        $row = $this->Kelurahan_model->get_by_id($id);

        if ($row) {
           $acc = $this->Kelurahan_model->delete($id);
            echo $acc;

        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            echo 0;
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kecamatan_id', 'kecamatan id', 'trim|required');
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Kelurahan.php */
/* Location: ./application/controllers/Kelurahan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-11-20 10:04:40 */
/* http://harviacode.com */