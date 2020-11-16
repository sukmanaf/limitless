<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Barang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Barang_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->skin->dashboard('barang/barang_list',null);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Barang_model->json();
    }


    public function get_data()
    {   

        $cari =[
        		'nama'=>@$_POST['nama_search_name'],
				'harga'=>@$_POST['harga_search_name'],
				'updated_at'=>@$_POST['updated_at_search_name'],
				'keterangan'=> @$_POST['keterangan_search_name']

                ];
            $dataq = $this->Barang_model->get_all($cari);
        $judul=[];
        $data['isi']=[];
        foreach ($dataq as $key => $v) {
            foreach ($v as $k => $val) {
                  array_push($judul, $k);
            }            
            $a= [$key+1,$v->nama,$v->harga,
                 '<a href="'. site_url("barang/read/").$v->id.'" class="btn-xs btn-primary"> Lihat</a>
                 <a href="'. site_url("barang/update/").$v->id.'" class="btn-xs btn-info"> Ubah</a>

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

        $row = $this->Barang_model->get_all();
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
        $row = $this->Barang_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'nama' => $row->nama,
		'harga' => $row->harga,
		'updated_at' => $row->updated_at,
		'keterangan' => $row->keterangan,
		'created_at' => $row->created_at,
		'datetim' => $row->datetim,
	    );
            $this->skin->dashboard('barang/barang_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('barang'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Simpan',
            'action' => site_url('barang/create_action'),
	    'id' => set_value('id'),
	    'nama' => set_value('nama'),
	    'harga' => set_value('harga'),
	    'updated_at' => set_value('updated_at'),
	    'keterangan' => set_value('keterangan'),
	    'created_at' => set_value('created_at'),
	    'datetim' => set_value('datetim'),
	);
        $this->skin->dashboard('barang/barang_form', $data);
    }
    
    public function create_action() 
    {
        
            $data = array(
		'nama' => $this->input->post('nama'),
		'harga' => $this->input->post('harga'),
		'updated_at' => $this->input->post('updated_at'),
		'keterangan' => $this->input->post('keterangan'),
		'created_at' => $this->input->post('created_at'),
		'datetim' => $this->input->post('datetim'),
	    );

            $acc = $this->Barang_model->insert($data);
            echo $acc;
    }
    
    public function update($id) 
    {
        $row = $this->Barang_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('barang/update_action'),
		'id' => set_value('id', $row->id),
		'nama' => set_value('nama', $row->nama),
		'harga' => set_value('harga', $row->harga),
		'updated_at' => set_value('updated_at', $row->updated_at),
		'keterangan' => set_value('keterangan', $row->keterangan),
		'created_at' => set_value('created_at', $row->created_at),
		'datetim' => set_value('datetim', $row->datetim),
	    );
            $this->skin->dashboard('barang/barang_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('barang'));
        }
    }
    
    public function update_action() 
    {
        
            $data = array(
		'nama' => $this->input->post('nama'),
		'harga' => $this->input->post('harga'),
		'updated_at' => $this->input->post('updated_at'),
		'keterangan' => $this->input->post('keterangan'),
		'created_at' => $this->input->post('created_at'),
		'datetim' => $this->input->post('datetim'),
	    );

            $acc = $this->Barang_model->update($this->input->post('id', TRUE), $data);
            echo $acc;
        
    }
    
    public function delete($id) 
    {
        $row = $this->Barang_model->get_by_id($id);

        if ($row) {
           $acc = $this->Barang_model->delete($id);
            echo $acc;

        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            echo 0;
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('harga', 'harga', 'trim|required|numeric');
	$this->form_validation->set_rules('updated_at', 'updated at', 'trim|required');
	$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
	$this->form_validation->set_rules('created_at', 'created at', 'trim|required');
	$this->form_validation->set_rules('datetim', 'datetim', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Barang.php */
/* Location: ./application/controllers/Barang.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-11-10 09:37:40 */
/* http://harviacode.com */