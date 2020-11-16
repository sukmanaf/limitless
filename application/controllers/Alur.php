<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Alur extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Alur_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->skin->dashboard('alur/alur_list',null);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Alur_model->json();
    }


    public function get_data()
    {   

        $cari =[
        		'dari'=>@$_POST['dari_search_name'],
				'ke'=>@$_POST['ke_search_name'],
				'status'=>@$_POST['status_search_name'],

                ];
            $dataq = $this->Alur_model->get_all($cari);
        $judul=[];
        $data['isi']=[];
        foreach ($dataq as $key => $v) {
            foreach ($v as $k => $val) {
                  array_push($judul, $k);
            }            
            $a= [$key+1,$v->status_dari,$v->status_ke,$v->status,
                 '
                 <a href="'. site_url("alur/read/").$v->id.'" style="margin-top:5 px"  class="btn-xs btn-primary"> Lihat</a>
                 <a href="'. site_url("alur/update/").$v->id.'" style="margin-top:5 px" class="btn-xs btn-info"> Ubah</a>

                  <a href="#" class="btn-xs btn-danger" style="margin-top:25 px" onclick="hapus('.$v->id.',event)"> Hapus</a>
                 '];
            // <button  class="btn-sm btn-danger" onclick="hapus('.$v->id.',event)"><i class="fas fa-trash"></i> hapus</button>
            array_push($data['isi'], $a);
        }
        $data['judul']=$judul;

        echo json_encode($data);
    }

       public function show()
    {

        $row = $this->Alur_model->get_all();
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
        $row = $this->Alur_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'dari' => $row->dari,
		'ke' => $row->ke,
		'status' => $row->status,
	    );
            $this->skin->dashboard('alur/alur_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('alur'));
        }
    }

    public function create() 
    {
        $get_status = $this->Alur_model->get_status();

        $data = array(
            'button' => 'Simpan',
            'action' => site_url('alur/create_action'),
	    'id' => set_value('id'),
	    'dari' => set_value('dari'),
	    'ke' => set_value('ke'),
        'status' => set_value('status'),
	    'get_status' => $get_status,
	);
        $this->skin->dashboard('alur/alur_form', $data);
    }
    
    public function create_action() 
    {
        
            $data = array(
		'dari' => $this->input->post('dari'),
		'ke' => $this->input->post('ke'),
		'status' => $this->input->post('status'),
	    );

            $acc = $this->Alur_model->insert($data);
            echo $acc;
    }
    
    public function update($id) 
    {
        $row = $this->Alur_model->get_by_id($id);
        $get_status = $this->Alur_model->get_status();


        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('alur/update_action'),
		'id' => set_value('id', $row->id),
		'dari' => set_value('dari', $row->dari),
		'ke' => set_value('ke', $row->ke),
        'status' => set_value('status', $row->status),
		'get_status' => $get_status,
	    );
            $this->skin->dashboard('alur/alur_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('alur'));
        }
    }
    
    public function update_action() 
    {
        
            $data = array(
		'dari' => $this->input->post('dari'),
		'ke' => $this->input->post('ke'),
		'status' => $this->input->post('status'),
	    );

            $acc = $this->Alur_model->update($this->input->post('id', TRUE), $data);
            echo $acc;
        
    }
    
    public function delete($id) 
    {
        $row = $this->Alur_model->get_by_id($id);

        if ($row) {
           $acc = $this->Alur_model->delete($id);
            echo $acc;

        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            echo 0;
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('dari', 'dari', 'trim|required');
	$this->form_validation->set_rules('ke', 'ke', 'trim|required');
	$this->form_validation->set_rules('status', 'status', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Alur.php */
/* Location: ./application/controllers/Alur.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-11-14 03:29:57 */
/* http://harviacode.com */