<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Niks extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Niks_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->skin->dashboard('niks/niks_list',null);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Niks_model->json();
    }


    public function get_data()
    {   

        $cari =[
        		'nik'=>@$_POST['nik_search_name'],
				'nama'=>@$_POST['nama_search_name'],

                ];
            $dataq = $this->Niks_model->get_all($cari);
        $judul=[];
        $data['isi']=[];
        foreach ($dataq as $key => $v) {
            foreach ($v as $k => $val) {
                  array_push($judul, $k);
            }            
            $a= [$key+1,$v->nik,$v->nama,
                 '<a href="'. site_url("niks/read/").$v->nik.'" class="btn-xs btn-primary"> Lihat</a>
                 <a href="'. site_url("niks/update/").$v->nik.'" class="btn-xs btn-info"> Ubah</a>

                  <a href="#" class="btn-xs btn-danger" onclick="hapus('.$v->nik.',event)"> Hapus</a>
                 '];
            // <button  class="btn-sm btn-danger" onclick="hapus('.$v->id.',event)"><i class="fas fa-trash"></i> hapus</button>
            array_push($data['isi'], $a);
        }
        $data['judul']=$judul;

        echo json_encode($data);
    }

       public function show()
    {

        $row = $this->Niks_model->get_all();
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
        $row = $this->Niks_model->get_by_id($id);
        if ($row) {
            $data = array(
		'nik' => $row->nik,
		'nama' => $row->nama,
		'alamat' => $row->alamat,
		'kd_propinsi' => $row->kd_propinsi,
		'kd_kabupaten' => $row->kd_kabupaten,
		'kd_kecamatan' => $row->kd_kecamatan,
		'kd_kelurahan' => $row->kd_kelurahan,
		'rtrw' => $row->rtrw,
		'nm_propinsi' => $row->nm_propinsi,
		'nm_kabupaten' => $row->nm_kabupaten,
		'nm_kecamatan' => $row->nm_kecamatan,
		'nm_kelurahan' => $row->nm_kelurahan,
	    );
            $this->skin->dashboard('niks/niks_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('niks'));
        }
    }

    public function create() 
    {
        $propinsi = $this->Niks_model->get_propinsi();
        
        $data = array(
            'button' => 'Simpan',
            'action' => site_url('niks/create_action'),
	    'nik' => set_value('nik'),
	    'nama' => set_value('nama'),
	    'alamat' => set_value('alamat'),
	    'kd_propinsi' => set_value('kd_propinsi'),
	    'kd_kabupaten' => set_value('kd_kabupaten'),
	    'kd_kecamatan' => set_value('kd_kecamatan'),
	    'kd_kelurahan' => set_value('kd_kelurahan'),
	    'rtrw' => set_value('rtrw'),
	    'nm_propinsi' => set_value('nm_propinsi'),
	    'nm_kabupaten' => set_value('nm_kabupaten'),
	    'nm_kecamatan' => set_value('nm_kecamatan'),
	    'nm_kelurahan' => set_value('nm_kelurahan'),
        'propinsi' => $propinsi,
	       );

        $this->skin->dashboard('niks/niks_form', $data);
    }
    
    public function create_action() 
    {
        
            $data = array(
		'nik' => $this->input->post('nik'),
		'nama' => strtoupper($this->input->post('nama')),
		'alamat' => strtoupper($this->input->post('alamat')),
		'kd_propinsi' => $this->input->post('kd_propinsi'),
		'kd_kabupaten' => $this->input->post('kd_kabupaten'),
		'kd_kecamatan' => $this->input->post('kd_kecamatan'),
		'kd_kelurahan' => $this->input->post('kd_kelurahan'),
		'rtrw' => $this->input->post('rtrw'),
		'nm_propinsi' => $this->input->post('nm_propinsi'),
		'nm_kabupaten' => $this->input->post('nm_kabupaten'),
		'nm_kecamatan' => $this->input->post('nm_kecamatan'),
		'nm_kelurahan' => $this->input->post('nm_kelurahan'),
	    );

            $acc = $this->Niks_model->insert($data);
            echo $acc;
    }
    
    public function update($id) 
    {
        $row = $this->Niks_model->get_by_id($id);
        $propinsi = $this->Niks_model->get_propinsi();
        $kabupaten = $this->Niks_model->get_kabupaten($row->kd_propinsi);
        $kecamatan = $this->Niks_model->get_kecamatan($row->kd_kabupaten);
        $kelurahan = $this->Niks_model->get_kelurahan($row->kd_kecamatan);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('niks/update_action'),
		'nik' => set_value('nik', $row->nik),
		'nama' => set_value('nama', $row->nama),
		'alamat' => set_value('alamat', $row->alamat),
		'kd_propinsi' => set_value('kd_propinsi', $row->kd_propinsi),
		'kd_kabupaten' => set_value('kd_kabupaten', $row->kd_kabupaten),
		'kd_kecamatan' => set_value('kd_kecamatan', $row->kd_kecamatan),
		'kd_kelurahan' => set_value('kd_kelurahan', $row->kd_kelurahan),
		'rtrw' => set_value('rtrw', $row->rtrw),
		'nm_propinsi' => set_value('nm_propinsi', $row->nm_propinsi),
		'nm_kabupaten' => set_value('nm_kabupaten', $row->nm_kabupaten),
		'nm_kecamatan' => set_value('nm_kecamatan', $row->nm_kecamatan),
		'nm_kelurahan' => set_value('nm_kelurahan', $row->nm_kelurahan),
        'propinsi' => $propinsi,
        'kabupaten' => $kabupaten,
        'kecamatan' => $kecamatan,
        'kelurahan' => $kelurahan,
	    );
            $this->skin->dashboard('niks/niks_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('niks'));
        }
    }
    
    public function update_action() 
    {
        
            $data = array(
		'nik' => $this->input->post('nik'),
		'nama' => strtoupper($this->input->post('nama')),
		'alamat' => strtoupper($this->input->post('alamat')),
		'kd_propinsi' => $this->input->post('kd_propinsi'),
		'kd_kabupaten' => $this->input->post('kd_kabupaten'),
		'kd_kecamatan' => $this->input->post('kd_kecamatan'),
		'kd_kelurahan' => $this->input->post('kd_kelurahan'),
		'rtrw' => $this->input->post('rtrw'),
		'nm_propinsi' => $this->input->post('nm_propinsi'),
		'nm_kabupaten' => $this->input->post('nm_kabupaten'),
		'nm_kecamatan' => $this->input->post('nm_kecamatan'),
		'nm_kelurahan' => $this->input->post('nm_kelurahan'),
	    );

            $acc = $this->Niks_model->update($this->input->post('id', TRUE), $data);
            echo $acc;
        
    }
    
    public function delete($id) 
    {
        $row = $this->Niks_model->get_by_id($id);

        if ($row) {
           $acc = $this->Niks_model->delete($id);
            echo $acc;

        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            echo 0;
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nik', 'nik', 'trim|required');
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('kd_propinsi', 'kd propinsi', 'trim|required');
	$this->form_validation->set_rules('kd_kabupaten', 'kd kabupaten', 'trim|required');
	$this->form_validation->set_rules('kd_kecamatan', 'kd kecamatan', 'trim|required');
	$this->form_validation->set_rules('kd_kelurahan', 'kd kelurahan', 'trim|required');
	$this->form_validation->set_rules('rtrw', 'rtrw', 'trim|required');
	$this->form_validation->set_rules('nm_propinsi', 'nm propinsi', 'trim|required');
	$this->form_validation->set_rules('nm_kabupaten', 'nm kabupaten', 'trim|required');
	$this->form_validation->set_rules('nm_kecamatan', 'nm kecamatan', 'trim|required');
	$this->form_validation->set_rules('nm_kelurahan', 'nm kelurahan', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

     function get_kabupaten($v='')
    {
        $kabupaten = $this->Niks_model->get_kabupaten($v);
        $str='<option value="0">Pilih Kota/Kabupaten</option>';
        
        if (!empty($kabupaten)) {
            foreach ($kabupaten as $key => $value) {
                                    
                    $str.='<option value="'.$value->id.'">'.$value->nama.'</option>';
            }
        }

        echo $str;

    }    
     function get_kecamatan($v='')
    {
        $kecamatan = $this->Niks_model->get_kecamatan($v);
        $str='<option value="0">Pilih Kecamatan</option>';
        
        if (!empty($kecamatan)) {
            foreach ($kecamatan as $key => $value) {
                                    
                    $str.='<option value="'.$value->id.'">'.$value->nama.'</option>';
            }
        }

        echo $str;

    }  
       function get_kelurahan($v='')
    {
        $kelurahan = $this->Niks_model->get_kelurahan($v);
        $str='<option value="0">Pilih Kelurahan</option>';
        
        if (!empty($kelurahan)) {
            foreach ($kelurahan as $key => $value) {
                                    
                    $str.='<option value="'.$value->id.'">'.$value->nama.'</option>';
            }
        }

        echo $str;

    }

}

/* End of file Niks.php */
/* Location: ./application/controllers/Niks.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-11-10 09:55:40 */
/* http://harviacode.com */