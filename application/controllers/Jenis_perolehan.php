<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jenis_perolehan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Jenis_perolehan_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->skin->dashboard('jenis_perolehan/jenis_perolehan_list',null);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Jenis_perolehan_model->json();
    }


    public function get_data()
    {   

        $cari =[
        		'kode'=>@$_POST['kode_search_name'],
				'npoptkp'=>@$_POST['npoptkp_search_name'],
				'nama'=>@$_POST['nama_search_name'],
				'active'=> @$_POST['active_search_name']

                ];
            $dataq = $this->Jenis_perolehan_model->get_all($cari);
        $judul=[];
        $data['isi']=[];
        foreach ($dataq as $key => $v) {
            foreach ($v as $k => $val) {
                  array_push($judul, $k);
            }            
            $a= [$key+1,$v->nama,$v->npoptkp,
                 '<a href="'. site_url("jenis_perolehan/read/").$v->id.'" class="btn-xs btn-primary"> Lihat</a>
                 <a href="'. site_url("jenis_perolehan/update/").$v->id.'" class="btn-xs btn-info"> Ubah</a>

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

        $row = $this->Jenis_perolehan_model->get_all();
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
        $row = $this->Jenis_perolehan_model->get_by_id($id);
        if ($row) {
            $data = array(
        'id' => $row->id,
        'kode' => $row->kode,
        'npoptkp' => $row->npoptkp,
        'nama' => $row->nama,
        'active' => $row->active,
        );
            $this->skin->dashboard('jenis_perolehan/jenis_perolehan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jenis_perolehan'));
        }
    }

    public function lampiran($id) 
    {
        $row = $this->Jenis_perolehan_model->get_by_id($id);
        $lampiran = $this->Jenis_perolehan_model->get_lampiran();

        if (!empty($row->lampiran)) {
            $lampirans= explode(',',$row->lampiran);
        }else{
            $lampirans = array();
        }
        if ($row) {
            $data = array(
        'button' => 'Simpan',
        'action' => site_url('jenis_perolehan/lampiran_action'),
		'id' => $row->id,
		'kode' => $row->kode,
		'npoptkp' => $row->npoptkp,
        'nama' => $row->nama,
		'lampiran' => $lampirans,
        'active' => $row->active,
		'list_lampiran' => $lampiran,
	    );
            $this->skin->dashboard('jenis_perolehan/jenis_perolehan_lampiran', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jenis_perolehan'));
        }
    }

    public function create() 
    {
        $lampiran = $this->Jenis_perolehan_model->get_lampiran();

        $data = array(
            'button' => 'Simpan',
            'action' => site_url('jenis_perolehan/create_action'),
	    'id' => set_value('id'),
	    'kode' => set_value('kode'),
	    'npoptkp' => set_value('npoptkp'),
	    'nama' => set_value('nama'),
        'active' => set_value('active'),
        'list_lampiran' => $lampiran,
	    'lampiran' => array(),
	);
        $this->skin->dashboard('jenis_perolehan/jenis_perolehan_form', $data);
    }
    
    public function create_action() 
    {   
        $lampiran = '';
        if (is_array(@$_POST['lam'])) {
            
            foreach (@$_POST['lam'] as $key => $value) {
                $lampiran .= $key.',';
            }
            $lampiran = substr($lampiran, 0, -1);
        }
        
            $data = array(
        'kode' => $this->input->post('kode'),
        'npoptkp' => $this->input->post('npoptkp'),
        'nama' => $this->input->post('nama'),
        'active' => 1,
        'lampiran' => $lampiran,
        );

            $acc = $this->Jenis_perolehan_model->insert($data);
            echo $acc;
    }
        
    public function lampiran_action() 
    {
        
        $data = array(
		'kode' => $this->input->post('kode'),
		'npoptkp' => $this->input->post('npoptkp'),
		'nama' => $this->input->post('nama'),
		'active' => 1,
	    );

            $acc = $this->Jenis_perolehan_model->insert($data);
            echo $acc;
    }
    
    public function update($id) 
    {
        $row = $this->Jenis_perolehan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('jenis_perolehan/update_action'),
		'id' => set_value('id', $row->id),
		'kode' => set_value('kode', $row->kode),
		'npoptkp' => set_value('npoptkp', $row->npoptkp),
		'nama' => set_value('nama', $row->nama),
		'active' => set_value('active', $row->active),
	    );
            $this->skin->dashboard('jenis_perolehan/jenis_perolehan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jenis_perolehan'));
        }
    }
    
    public function update_action() 
    {
        
            $data = array(
		'kode' => $this->input->post('kode'),
		'npoptkp' => $this->input->post('npoptkp'),
		'nama' => $this->input->post('nama'),
		'active' => $this->input->post('active'),
	    );

            $acc = $this->Jenis_perolehan_model->update($this->input->post('id', TRUE), $data);
            echo $acc;
        
    }
    
    public function delete($id) 
    {
        $row = $this->Jenis_perolehan_model->get_by_id($id);

        if ($row) {
           $acc = $this->Jenis_perolehan_model->delete($id);
            echo $acc;

        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            echo 0;
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kode', 'kode', 'trim|required');
	$this->form_validation->set_rules('npoptkp', 'npoptkp', 'trim|required');
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('active', 'active', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Jenis_perolehan.php */
/* Location: ./application/controllers/Jenis_perolehan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-11-14 09:46:18 */
/* http://harviacode.com */