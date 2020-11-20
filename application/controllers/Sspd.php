<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sspd extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Sspd_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
        $this->load->library('pdf');
    }

    public function index()
    {
        $this->skin->dashboard('sspd/sspd_list',null);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Sspd_model->json();
    }


    public function get_data()
    {   

        $cari =[
        		'nama'=>@$_POST['nama_search_name'],
				'nik'=>@$_POST['nik_search_name'],
				'nopen'=>@$_POST['nopen_search_name'],

                ];
            $dataq = $this->Sspd_model->get_all($cari);

         $judul=[];
        $data['isi']=[];
        foreach ($dataq as $key => $v) {
            foreach ($v as $k => $val) {
                  array_push($judul, $k);
            }            
            $a= [$key+1,$v->no_pendaftaran,$v->nama,'<span class="badge badge-'.$v->class.'">'.$v->text.'</span>',
                 '<a href="'. site_url("sspd/read/").$v->no_pendaftaran.'" class="btn-xl btn-primary" style="border-radius:5px;;padding: 2% 6%;"> Lihat</a>
                 <a href="'. site_url("sspd/update/").$v->no_pendaftaran.'" class="btn-xl btn-info" style="border-radius:5px;;padding: 2% 6%;"> Ubah</a>

                  <a href="#" class="btn-xl btn-danger"  style="border-radius:5px;padding: 2% 6%;" onclick="hapus('.$v->id.',event)"> Hapus </a>
                 '];
            // <button  class="btn-sm btn-danger" onclick="hapus('.$v->id.',event)"><i class="fas fa-trash"></i> hapus</button>
            array_push($data['isi'], $a);
        }
        $data['judul']=$judul;

        echo json_encode($data);
    }

       public function show()
    {

        $row = $this->Sspd_model->get_all();
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

                $nopen = $_POST['nopen'];
            if ($_POST['submit'] == 0) {
              
                $folder = 'assets/files/sspd/'.$nopen;

                if (!is_dir($folder)) {

                    $oldmask = umask(0);
                    mkdir($folder, 0777, true);
                    umask($oldmask);
                }

             

                foreach ($_FILES as $key => $value) {
                    if ($value['name'] != '') {
                       
                        $_FILES[0] = $value;
                        $_FILES[0]['key'] = $key;
                    
                    }
                }


                $path = $_FILES[0]['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $nama = $_FILES[0]['key'].'_'.date('ymdHis').'.'.$ext;
        
                $config['upload_path']          = $folder;
                $config['allowed_types']        = 'gif|jpg|png';
                $config['file_name']            = $nama;
       
      
                $this->load->library('upload', $config);
                if ( ! $this->upload->do_upload($_FILES[0]['key']))
                {
                        $error = array('error' => $this->upload->display_errors());
                        echo json_encode($error);
                        // $this->skin->dashboard('upload_form', $error);
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
                        $data = array(
                                        'lokasi' => $folder.'/'.$nama,
                                        'nopen' =>$nopen,
                                        'id_lampiran' => $_FILES[0]['key']
                                    );
                        $ins = $this->db->insert('files', $data);
                        echo json_encode(array('msg' => $ins,'jns' => 'img'));

                }
            }else{
                $data= array('status' => 'PM001');
                $this->db->where('no_pendaftaran', $nopen);
                $acc = $this->db->update('sspd', $data);
                echo json_encode(array('msg' => $acc,'jns' => 'data'));
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

    

    public function read($nopen) 
    {
        $propinsi = $this->Sspd_model->get_propinsi();
        $jns_perolehan = $this->Sspd_model->get_jns_perolehan();
        $row = $this->Sspd_model->get_all_by_nopen($nopen);
        $perolehan = $this->Sspd_model->get_jenis_perolehan($row->jenis_perolehan);
        $lampiran = $this->Sspd_model->get_lampiran($nopen);
        $files = $this->Sspd_model->get_files($nopen);

        $lam = array();
        if (!empty($perolehan->lampiran)) {
            $lam=explode(',',$perolehan->lampiran);
        }
        $lampiran = $this->Sspd_model->get_lampiran($lam);

        if ($row) {
           
        
        $data = array(
            'tipe' => 'update',
            'button' => 'Simpan',
            'action' => site_url('sspd/update_action'),
            'sspd' => $row,
            'propinsi' => $propinsi,
            'jns_perolehan' => $jns_perolehan,
            'lampiran' => $lampiran,
            'files' => $files,
        );
            
            $this->skin->dashboard('sspd/sspd_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sspd'));
        }
    }
    

    public function upload_lampiran($nopen) 
    {


        $row = $this->Sspd_model->get_by_nopen($nopen);
        $files = $this->Sspd_model->get_files($nopen);
        $perolehan = $this->Sspd_model->get_jenis_perolehan($row->jenis_perolehan);
        $cek_files = array();

        if (!empty($files)) {
            foreach ($files as $key => $value) {
                array_push($cek_files, $value->id_lampiran);
            }
        }
        
        $lam = array();
        if (!empty($perolehan->lampiran)) {
            $lam=explode(',',$perolehan->lampiran);
        }
        $lampiran = $this->Sspd_model->get_lampiran($lam);
        
        $cek_lampiran = $lam;
        rsort($cek_lampiran);
        unset($cek_lampiran[0]);
        $hasil_cek_file = array_diff($cek_lampiran, $cek_files);
        $hasil_cek_file = empty($hasil_cek_file) ? 0:1;
        

        if ($row) {
            $data = array(
        'button' => 'Simpan',
		'jenis_perolehan' => $row->jenis_perolehan,
        'lampiran' => $lampiran,
        'nopen' => $nopen,
		'files' => $files,
        'hasil_cek_files' => $hasil_cek_file,
	    );
            $this->skin->dashboard('sspd/sspd_form_lampiran', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sspd'));
        }
    }

    public function create() 
    {
        $propinsi = $this->Sspd_model->get_propinsi();
        $jns_perolehan = $this->Sspd_model->get_jns_perolehan();

        $data = array(
            'tipe' => 'add',
            'button' => 'Simpan',
            'action' => site_url('sspd/create_action'),
        'propinsi' => $propinsi,
		'jns_perolehan' => $jns_perolehan,

	);
        $this->skin->dashboard('sspd/sspd_form', $data);
    }
    public function update($nopen) 
    {
        $propinsi = $this->Sspd_model->get_propinsi();
        $jns_perolehan = $this->Sspd_model->get_jns_perolehan();
        $row = $this->Sspd_model->get_all_by_nopen($nopen);

        $data = array(
            'tipe' => 'update',
            'button' => 'Simpan',
            'action' => site_url('sspd/update_action'),
        'sspd' => $row,
        
        'propinsi' => $propinsi,
        'jns_perolehan' => $jns_perolehan,

    );
        $this->skin->dashboard('sspd/sspd_form', $data);
    }
    
    public function create_action() 
    {
        
        $data = json_decode(file_get_contents('php://input'), true);
        $data_nik = array(
          'nik' => $data['nik'],
          'nama' => $data['nama'],
          'alamat' => $data['alamat'],
          'kd_propinsi' => $data['kd_propinsi'],
          'kd_kabupaten' => $data['kd_kabupaten'],
          'kd_kecamatan' => $data['kd_kecamatan'],
          'kd_kelurahan' => $data['kd_kelurahan'],
		  'rtrw' => $data['rtrw'],
          'nm_propinsi' => $data['nm_propinsi'],
          'nm_kabupaten' => $data['nm_kabupaten'],
          'nm_kecamatan' => $data['nm_kecamatan'],
          'nm_kelurahan' => $data['nm_kelurahan'],
	    );

        $cek_nik = $this->Sspd_model->cek_nik($data['nik'])->jml;
        if ($cek_nik ==0) {
            $ins_nik = $this->Sspd_model->insert_nik($data_nik);
            $exp = explode('.', $ins);
            $ins_nik = $exp[0];
            $id_nik = $exp[1];
        }else{
            $up_nik = $this->Sspd_model->update_nik($data['id_nik'], $data_nik);
            $id_nik = $data['id_nik'];
        
        }


        if (@$ins_nik == 1 || @$up_nik == 1) {
            
            $nopen = 'PD'.date('ymdHis');
            $data['id_ppat'] = '1';
            $data_sspd = array(
              'id_ppat' => $data['id_ppat'],
              'id_nik' => $id_nik,
              'nop' => $data['nop'],
              'alamat_op' => $data['alamat_op'],
              'kabupaten_op' => $data['kabupaten_op'],
              'kecamatan_op' => $data['kecamatan_op'],
              'kelurahan_op' => $data['kelurahan_op'],
              'rtrw_op' => $data['rtrw_op'],
              'luas_tanah' => str_replace('.','',$data['luas_tanah']),
              'luas_bangunan' => str_replace('.', '',$data['luas_bangunan']),
              'njop_tanah' => str_replace('.', '',$data['njop_tanah']),
              'njop_bangunan' => str_replace('.', '',$data['njop_bangunan']),
              'njop_total' => str_replace('.', '',$data['njop_total']),
              'harga_transaksi' => str_replace('.', '',$data['harga_transaksi']),
              'jenis_perolehan' => $data['jenis_perolehan'],
              'nomor_sertifikat' => $data['nomor_sertifikat'],
              'npop' => str_replace('.', '',$data['npop']),
              'npoptkp' => str_replace('.', '',$data['npoptkp']),
              'npopkp' => str_replace('.', '',$data['npopkp']),
              'bphtb' => str_replace('.', '',$data['bphtb']),
              'status' => 'DR001',
              'no_pendaftaran' => $nopen,
            );
            $ins_sspd = $this->Sspd_model->insert($data_sspd);
                if ($ins_sspd==1) {
                    
                    $result = array('sts_sspd' =>1,'nopen' => $nopen);
                }else{
                    $result = array('sts_sspd' =>0);

                }
        }else{

                $result = array('sts_nik' =>0);
        }

            echo json_encode($result);

        //  echo "<pre>";
        //  print_r ($data);
        //  echo "</pre>";
        // echo "<pre>";
        // print_r ($data_nik);
        // echo "</pre>";exit();
    }
    
    public function update_nop($id) 
    {
        $row = $this->Sspd_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('sspd/update_action'),
		'id' => set_value('id', $row->id),
		'id_ppat' => set_value('id_ppat', $row->id_ppat),
		'nik' => set_value('nik', $row->nik),
		'nop' => set_value('nop', $row->nop),
		'alamat_op' => set_value('alamat_op', $row->alamat_op),
		'propinsi_op' => set_value('propinsi_op', $row->propinsi_op),
		'kabupaten_op' => set_value('kabupaten_op', $row->kabupaten_op),
		'kecamatan_op' => set_value('kecamatan_op', $row->kecamatan_op),
		'kelurahan_op' => set_value('kelurahan_op', $row->kelurahan_op),
		'luas_tanah' => set_value('luas_tanah', $row->luas_tanah),
		'luas_bangunan' => set_value('luas_bangunan', $row->luas_bangunan),
		'njop_tanah' => set_value('njop_tanah', $row->njop_tanah),
		'njop_bangunan' => set_value('njop_bangunan', $row->njop_bangunan),
		'njop_total' => set_value('njop_total', $row->njop_total),
		'harga_transaksi' => set_value('harga_transaksi', $row->harga_transaksi),
		'jenis_perolehan' => set_value('jenis_perolehan', $row->jenis_perolehan),
		'nomor_sertifikat' => set_value('nomor_sertifikat', $row->nomor_sertifikat),
		'npop' => set_value('npop', $row->npop),
		'npoptkp' => set_value('npoptkp', $row->npoptkp),
		'bphtb' => set_value('bphtb', $row->bphtb),
		'total_bayar' => set_value('total_bayar', $row->total_bayar),
		'status_bayar' => set_value('status_bayar', $row->status_bayar),
		'tgl_bayar' => set_value('tgl_bayar', $row->tgl_bayar),
		'validasi_bank' => set_value('validasi_bank', $row->validasi_bank),
		'tgl_validasi_berkas' => set_value('tgl_validasi_berkas', $row->tgl_validasi_berkas),
		'status' => set_value('status', $row->status),
		'rtrw' => set_value('rtrw', $row->rtrw),
		'no_pendaftaran' => set_value('no_pendaftaran', $row->no_pendaftaran),
		'no_sspd' => set_value('no_sspd', $row->no_sspd),
	    );
            $this->skin->dashboard('sspd/sspd_form_nop', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sspd'));
        }
    }
    
    public function update_action() 
    {
        
        $data = json_decode(file_get_contents('php://input'), true);
        $nopen = $data['nopen'];
        $data_nik = array(
          'nik' => $data['nik'],
          'nama' => $data['nama'],
          'alamat' => $data['alamat'],
          'kd_propinsi' => $data['kd_propinsi'],
          'kd_kabupaten' => $data['kd_kabupaten'],
          'kd_kecamatan' => $data['kd_kecamatan'],
          'kd_kelurahan' => $data['kd_kelurahan'],
          'rtrw' => $data['rtrw'],
          'nm_propinsi' => $data['nm_propinsi'],
          'nm_kabupaten' => $data['nm_kabupaten'],
          'nm_kecamatan' => $data['nm_kecamatan'],
          'nm_kelurahan' => $data['nm_kelurahan'],
        );

        $cek_nik = $this->Sspd_model->cek_nik($data['nik'])->jml;
        if ($cek_nik ==0) {
            $ins_nik = $this->Sspd_model->insert_nik($data_nik);
            $exp = explode('.', $ins);
            $ins_nik = $exp[0];
            $id_nik = $exp[1];
        }else{
            $up_nik = $this->Sspd_model->update_nik($data['id_nik'], $data_nik);
            $id_nik = $data['id_nik'];
        
        }


        if (@$ins_nik == 1 || @$up_nik == 1) {
            
            $data['id_ppat'] = '1';
            $data_sspd = array(
              'id_ppat' => $data['id_ppat'],
              'id_nik' => $id_nik,
              'nop' => $data['nop'],
              'alamat_op' => $data['alamat_op'],
              'kabupaten_op' => $data['kabupaten_op'],
              'kecamatan_op' => $data['kecamatan_op'],
              'kelurahan_op' => $data['kelurahan_op'],
              'rtrw_op' => $data['rtrw_op'],
              'luas_tanah' => str_replace('.','',$data['luas_tanah']),
              'luas_bangunan' => str_replace('.', '',$data['luas_bangunan']),
              'njop_tanah' => str_replace('.', '',$data['njop_tanah']),
              'njop_bangunan' => str_replace('.', '',$data['njop_bangunan']),
              'njop_total' => str_replace('.', '',$data['njop_total']),
              'harga_transaksi' => str_replace('.', '',$data['harga_transaksi']),
              'jenis_perolehan' => $data['jenis_perolehan'],
              'nomor_sertifikat' => $data['nomor_sertifikat'],
              'npop' => str_replace('.', '',$data['npop']),
              'npoptkp' => str_replace('.', '',$data['npoptkp']),
              'npopkp' => str_replace('.', '',$data['npopkp']),
              'bphtb' => str_replace('.', '',$data['bphtb']),
            );
            $up_sspd = $this->Sspd_model->update($data['id_sspd'], $data_sspd);
                if ($up_sspd==1) {
                    $result = array('sts_sspd' =>1,'nopen' => $nopen);
                }else{
                    $result = array('sts_sspd' =>0);

                }
        }else{

                $result = array('sts_nik' =>0);
        }

            echo json_encode($result);
            
        
    }
    
    public function delete($id) 
    {
        $row = $this->Sspd_model->get_by_id($id);

        if ($row) {
           $acc = $this->Sspd_model->delete($id);
            echo $acc;

        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            echo 0;
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_ppat', 'id ppat', 'trim|required');
	$this->form_validation->set_rules('nik', 'nik', 'trim|required');
	$this->form_validation->set_rules('nop', 'nop', 'trim|required');
	$this->form_validation->set_rules('alamat_op', 'alamat op', 'trim|required');
	$this->form_validation->set_rules('propinsi_op', 'propinsi op', 'trim|required');
	$this->form_validation->set_rules('kabupaten_op', 'kabupaten op', 'trim|required');
	$this->form_validation->set_rules('kecamatan_op', 'kecamatan op', 'trim|required');
	$this->form_validation->set_rules('kelurahan_op', 'kelurahan op', 'trim|required');
	$this->form_validation->set_rules('luas_tanah', 'luas tanah', 'trim|required');
	$this->form_validation->set_rules('luas_bangunan', 'luas bangunan', 'trim|required');
	$this->form_validation->set_rules('njop_tanah', 'njop tanah', 'trim|required');
	$this->form_validation->set_rules('njop_bangunan', 'njop bangunan', 'trim|required');
	$this->form_validation->set_rules('njop_total', 'njop total', 'trim|required');
	$this->form_validation->set_rules('harga_transaksi', 'harga transaksi', 'trim|required');
	$this->form_validation->set_rules('jenis_perolehan', 'jenis perolehan', 'trim|required');
	$this->form_validation->set_rules('nomor_sertifikat', 'nomor sertifikat', 'trim|required');
	$this->form_validation->set_rules('npop', 'npop', 'trim|required');
	$this->form_validation->set_rules('npoptkp', 'npoptkp', 'trim|required');
	$this->form_validation->set_rules('bphtb', 'bphtb', 'trim|required');
	$this->form_validation->set_rules('total_bayar', 'total bayar', 'trim|required');
	$this->form_validation->set_rules('status_bayar', 'status bayar', 'trim|required');
	$this->form_validation->set_rules('tgl_bayar', 'tgl bayar', 'trim|required');
	$this->form_validation->set_rules('validasi_bank', 'validasi bank', 'trim|required');
	$this->form_validation->set_rules('tgl_validasi_berkas', 'tgl validasi berkas', 'trim|required');
	$this->form_validation->set_rules('status', 'status', 'trim|required');
	$this->form_validation->set_rules('rtrw', 'rtrw', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }


     function get_propinsi($v='')
    {
        $kabupaten = $this->Sspd_model->get_propinsi();
        $str='<option value="0">Pilih Kota/Kabupaten</option>';
        
        if (!empty($kabupaten)) {
            foreach ($kabupaten as $key => $value) {
                                    
                    $str.='<option value="'.$value->id.'">'.$value->nama.'</option>';
            }
        }

        echo $str;

    }    

     function get_kabupaten($v='')
    {
        $kabupaten = $this->Sspd_model->get_kabupaten($v);
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
        $kecamatan = $this->Sspd_model->get_kecamatan($v);
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
        $kelurahan = $this->Sspd_model->get_kelurahan($v);
        $str='<option value="0">Pilih Kelurahan</option>';
        
        if (!empty($kelurahan)) {
            foreach ($kelurahan as $key => $value) {
                                    
                    $str.='<option value="'.$value->id.'">'.$value->nama.'</option>';
            }
        }

        echo $str;

    } 



       function get_propinsi_selected($v='')
    {
        $kelurahan = $this->Sspd_model->get_propinsi($v);
        $str='<option value="0">Pilih Propinsi</option>';
        
        if (!empty($kelurahan)) {
            foreach ($kelurahan as $key => $value) {
                    $sel = $v == $value->id ? 'selected':'';    
                    $str.='<option '.$sel.' value="'.$value->id.'">'.$value->nama.'</option>';
            }
        }

        echo $str;

    }


     function get_kabupaten_selected($kab='')
    {
        $pro = substr($kab,0, 2);
        $kabupaten = $this->Sspd_model->get_kabupaten($pro);
        $str='<option value="0">Pilih Kota/Kabupaten</option>';
 
        if (!empty($kabupaten)) {
            foreach ($kabupaten as $key => $value) {
                    $sel = $kab == $value->id ? 'selected':'';    
                    $str.='<option '.$sel.' value="'.$value->id.'">'.$value->nama.'</option>';
            }
        }

        echo $str;

    }    
     function get_kecamatan_selected($kec='')
    {
        $kab = substr($kec,0, 4);
        $kecamatan = $this->Sspd_model->get_kecamatan($kab);
        $str='<option value="0">Pilih Kecamatan</option>';
        
        if (!empty($kecamatan)) {
            foreach ($kecamatan as $key => $value) {
                    $sel = $kec == $value->id ? 'selected':'';    
                    $str.='<option '.$sel.' value="'.$value->id.'">'.$value->nama.'</option>';
            }
        }

        echo $str;

    }  
       function get_kelurahan_selected($kel='')
    {
        $kec = substr($kel,0, 7);
        $kelurahan = $this->Sspd_model->get_kelurahan($kec);
        $str='<option value="0">Pilih Kelurahan</option>';
        
        if (!empty($kelurahan)) {
            foreach ($kelurahan as $key => $value) {
                    $sel = $kel == $value->id ? 'selected':'';    
                    $str.='<option '.$sel.' value="'.$value->id.'">'.$value->nama.'</option>';
            }
        }

        echo $str;

    } 
    



    public function get_nop($nop) 
    {
        $row = $this->Sspd_model->get_nop($nop);
        $njop_tanah_meter = $row->OP_NJOP_BUMI /$row->OP_LUAS_BUMI;
        $row->OP_NJOP_TANAH_PERMETER=$njop_tanah_meter;

        if ($row->OP_NJOP_BANGUNAN != 0) {
            $njop_bangunan_meter = $row->OP_NJOP_BANGUNAN /$row->OP_LUAS_BANGUNAN;
            $row->OP_NJOP_BANGUNAN_PERMETER=$njop_bangunan_meter;
        }else{
            $row->OP_NJOP_BANGUNAN_PERMETER=0;

        }
        
        if ($row) {
           
            $ret = array('sts'=> 1,'datas' => $row);
            
        } else {
            $ret = array('sts'=> 0);
            // $this->session->set_flashdata('message', 'Record Not Found');
            // redirect(site_url('sspd'));
        }
            echo json_encode($ret);
    }

    public function get_history_nop($nop) 
    {
        $row = $this->Sspd_model->get_history_nop($nop);

        $lunas ='Tahun ';
        if (!empty($row)) {
            
            foreach ($row as $key => $value) {
                if ($value->PAYMENT_FLAG == 0) {
                   $lunas.= $value->SPPT_TAHUN_PAJAK.', ';
                }
            }
        }

        if ($lunas == 'Tahun ') {
            $lunas = 'PBB Lima Tahun Lunas';
            $lunas = '<span class="badge badge-success" style="margin-top:5%">'.$lunas.'</span>';
            $angka = 1;

        }else{
            $lunas = rtrim($lunas, ", ");
            $lunas .=' Belum Lunas ';
            $lunas = '<span class="badge badge-danger" style="margin-top:5%">'.$lunas.'</span>';
            $angka = 0;
        }

      
        
        if ($row) {
           
            $ret = array('sts'=> 1,'datas' => $lunas,'lunas' => $angka);
            
        } else {
            $ret = array('sts'=> 0);
            // $this->session->set_flashdata('message', 'Record Not Found');
            // redirect(site_url('sspd'));
        }
            echo json_encode($ret);
    }

    public function get_nik($nik) 
    {
        $row = $this->Sspd_model->get_nik($nik);
        if ($row) {
           
            $ret = array('sts'=> 1,'datas' => $row);
            
        } else {
            $ret = array('sts'=> 0);
            // $this->session->set_flashdata('message', 'Record Not Found');
            // redirect(site_url('sspd'));
        }
            echo json_encode($ret);
    }

    public function approve($status,$acc,$nopen)
    {
        $row = $this->Sspd_model->get_approve($status,$acc);
        $data = array('status' => $row->status_ke,
                        'update' =>date('Y-m-d H:i:s'),
                        );
        $this->db->where('no_pendaftaran', $nopen);
        $app = $this->db->update('sspd', $data);
        if ($app) {
            echo json_encode(array('sts' => 1,'jns' => $acc));
        }
    }


    function prints(){
        
        $pdf = new FPDF('P','mm','A4');
        // membuat halaman baru
        $pdf->SetMargins(10, 5);
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',11);
        // header

        $image = 'assets/files/image/logo.png';
        $pdf->Image($image,16,11,22,27,'PNG');

        $pdf->Cell(35,3,'','LT',0,'C');
        $pdf->Cell(120,3,'','LTR',0,'C');
        $pdf->Cell(35,3,'','TR',1,'C');

        $pdf->Cell(35,5,'','L',0,'C');
        $pdf->Cell(120,5,'SURAT SETORAN PAJAK DAERAH','LR',0,'C');
        $pdf->Cell(35,5,'','R',1,'C');
        $pdf->Cell(35,5,'','L',0,'C');
        $pdf->Cell(120,5,'BEA PEROLEHAN HAK ATAS TANAH DAN BANGUNAN','LR',0,'C');
        $pdf->Cell(35,5,'LEMBAR','R',1,'C');
        $pdf->Cell(35,5,'','L',0,'C');
        $pdf->Cell(120,5,'(SSPD-BPHTB)','LRB',0,'C');
        $pdf->Cell(35,5,'','R',1,'C');

        $pdf->SetFont('Arial','',11);
        $pdf->Cell(35,2,'','L',0,'C');
        $pdf->Cell(120,2,'','LR',0,'C');
        $pdf->Cell(35,2,'','R',1,'C');
        $pdf->Cell(35,5,'','L',0,'C');
        $pdf->Cell(120,5,'BERFUNGSI SEBAGAI SURAT PEMBERITAHUAN OBJEK PAJAK','LR',0,'C');
        $pdf->Cell(35,5,'','R',1,'C');
        $pdf->Cell(35,5,'','LB',0,'C');
        $pdf->Cell(120,5,'PAJAK BUMI DAN BANGUNAN (SPOP PBB)','LRB',0,'C');
        $pdf->Cell(35,5,'','RB',1,'C');

        //bawah header
        $pdf->SetFont('Arial','',11);
        $pdf->Cell(190,7,'BADAN KEUANGAN DAERAH (BKD) KOTA ','LTRB',1,'');


        // Data NIK
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(190,3,'','LR',1,'C');

        $pdf->Cell(10,5,'A.','L',0,'C');
        $pdf->Cell(37,5,'1.Nama WajibPajak','',0,'');
        $pdf->Cell(143,5,':','R',1,'');
        
        $pdf->Cell(10,5,'','L',0,'');
        $pdf->Cell(37,5,'2.NIK','',0,'');
        $pdf->Cell(143,5,':','R',1,'');

        $pdf->Cell(10,5,'','L',0,'');
        $pdf->Cell(37,5,'3.Alamat Wajib Pajak','',0,'');
        $pdf->Cell(143,5,':','R',1,'');

        $pdf->Cell(10,5,'','L',0,'');
        $pdf->Cell(37,5,'Kelurahan / Desa','',0,'');
        $pdf->Cell(43,5,':','',0,'');
        $pdf->Cell(15,5,'RT/RW','',0,'');
        $pdf->Cell(20,5,': 001/001','',0,'');
        $pdf->Cell(20,5,'Kecamatan','',0,'');
        $pdf->Cell(45,5,':','R',1,'');

        $pdf->Cell(10,5,'','L',0,'');
        $pdf->Cell(37,5,'Kabupaten / Kota','',0,'');
        $pdf->Cell(143,5,':','R',1,'');
       
        $pdf->Cell(190,3,':','LBR',1,'');
        

        //data NOP
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(190,3,'','LR',1,'C');

        $pdf->Cell(10,5,'B.','L',0,'C');
        $pdf->Cell(55,5,'1.Nomor Objek Pajak (NOP)PBB','',0,'');
        $pdf->Cell(125,5,':','R',1,'');
        
        $pdf->Cell(10,5,'','L',0,'');
        $pdf->Cell(55,5,'2.Letak Tanah dan Bangunan','',0,'');
        $pdf->Cell(125,5,':','R',1,'');

        $pdf->Cell(10,5,'','L',0,'');
        $pdf->Cell(37,5,'3.Kelurahan / Desa','',0,'');
        $pdf->Cell(68,5,':','',0,'');
        $pdf->Cell(30,5,'4.RT/RW','',0,'');
        $pdf->Cell(45,5,':','R',1,'');

        $pdf->Cell(10,5,'','L',0,'');
        $pdf->Cell(37,5,'5.Kecamatan','',0,'');
        $pdf->Cell(68,5,':','',0,'');
        $pdf->Cell(30,5,'6.Kabupaten/Kota','',0,'');
        $pdf->Cell(45,5,':','R',1,'');

        $pdf->Cell(190,3,'','LR',1,'');
        $pdf->Cell(10,5,'','L',0,'');
        $pdf->Cell(180,5,'Perhitungan NJOP PBB','R',1,'');
        

        //tabel NJOP
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(10,9,'','L',0,'C');
        $pdf->Cell(37,9,'Uraian','LTB',0,'C');
        $pdf->Cell(45,9,'Luas','LTB',0,'C');
        $pdf->Cell(45,9,'NJOP PBB/m2','LTB',0,'C');
        $pdf->Cell(50,9,'Luas x NJOP PBB/m2','LTRB',0,'C');
        $pdf->Cell(3,9,'','R',1,'');

        $pdf->SetFont('Arial','',10);
        $pdf->Cell(10,8,'','L',0,'C');
        $pdf->Cell(37,8,'Tanah (Bumi)','LTB',0,'C');
        $pdf->Cell(8,8,'7','LTB',0,'C');
        $pdf->Cell(37,8,'140','LTB',0,'R');
        $pdf->Cell(8,8,'9','LTB',0,'C');
        $pdf->Cell(37,8,'123','LTB',0,'R');
        $pdf->Cell(8,8,'11','LTB',0,'C');
        $pdf->Cell(42,8,'Rp.20.000.000','LTRB',0,'R');
        $pdf->Cell(3,8,'','R',1,'');

        $pdf->Cell(10,8,'','L',0,'C');
        $pdf->Cell(37,8,'Bangunan','LTB',0,'C');
        $pdf->Cell(8,8,'8','LTB',0,'C');
        $pdf->Cell(37,8,'140','LTB',0,'R');
        $pdf->Cell(8,8,'10','LTB',0,'C');
        $pdf->Cell(37,8,'123','LTB',0,'R');
        $pdf->Cell(8,8,'12','LTB',0,'C');
        $pdf->Cell(42,8,'Rp.20.000.000','LTRB',0,'R');
        $pdf->Cell(3,8,'','R',1,'');

        $pdf->Cell(10,8,'','L',0,'C');
        $pdf->Cell(127,8,'NJOP PBB','',0,'R');
        $pdf->Cell(8,8,'13','LTB',0,'C');
        $pdf->Cell(42,8,'Rp.20.000.000','LTRB',0,'R');
        $pdf->Cell(3,8,'','R',1,'');


        $pdf->Cell(190,1,'','LR',1,'');

        $pdf->Cell(10,8,'','L',0,'C');
        $pdf->Cell(127,8,'Harga Transaksi','',0,'R');
        $pdf->Cell(8,8,'14','LTB',0,'C');
        $pdf->Cell(42,8,'Rp.20.000.000','LTRB',0,'R');
        $pdf->Cell(3,8,'','R',1,'');

        $pdf->Cell(10,5,'','L',0,'C');
        $pdf->Cell(32,5,'14.Jenis Perolehan','',0,'');
        $pdf->Cell(145,5,': 01 - Jual - beli','',0,'L');
        $pdf->Cell(3,5,'','R',1,'');

        $pdf->Cell(10,5,'','L',0,'C');
        $pdf->Cell(32,5,'15.NomorSertifikat','',0,'');
        $pdf->Cell(145,5,': SHM 0001928','',0,'L');
        $pdf->Cell(3,5,'','R',1,'');

        $pdf->Cell(190,3,'','LBR',1,'');
        //perhitungan BPHTB

        $pdf->Cell(190,7,'C. Perhitungan BPHTB (hanya diisi berdasarkan penghitungan Wajib Pajak)','LBR',1,'');
        
        $pdf->Cell(10,5,'','LB',0,'L');
        $pdf->Cell(127,5,'1.Nilai Perolehan Objek Pajak (NPOP) ','RB',0,'');
        $pdf->Cell(8,5,'1','RB',0,'C');
        $pdf->Cell(45,5,'','RB',1,'');
        
        $pdf->Cell(10,5,'','LB',0,'L');
        $pdf->Cell(127,5,'2.Nilai Perolehan Objek Pajak Tidak Kena Pajak (NPOPTKP) ','RB',0,'');
        $pdf->Cell(8,5,'2','RB',0,'C');
        $pdf->Cell(45,5,'','RB',1,'');
      
        $pdf->Cell(10,5,'','LB',0,'L');
        $pdf->Cell(127,5,'3.Nilai Perolehan Objek Pajak Kena Pajak (NPOPKP) ','RB',0,'');
        $pdf->Cell(8,5,'3','RB',0,'C');
        $pdf->Cell(45,5,'','RB',1,'');

        $pdf->Cell(10,5,'','LB',0,'L');
        $pdf->Cell(127,5,'4.Bea Perolehan Hak Atas Tanah dan Bangunan (BPHTB) ','RB',0,'');
        $pdf->Cell(8,5,'4','RB',0,'C');
        $pdf->Cell(45,5,'','RB',1,'');


        $pdf->Cell(190,3,'','LBR',1,'');

        //Jumlah Setoran Berdasarkan

        $pdf->Cell(10,5,'D','L',0,'L');
        $pdf->Cell(180,5,'Jumlah SetoranBerdasarkan ','R',1,'');

        $pdf->Cell(11,5,'','L',0,'L');
        $pdf->Cell(5,5,'O',1,0,'L');
        $pdf->Cell(174,5,'c. Perhitungan Wajib Pajak ','R',1,'');
        $pdf->Cell(190,1,'','LR',1,'');

        $pdf->Cell(11,5,'','L',0,'L');
        $pdf->Cell(5,5,'','LRT',0,'L');
        $pdf->Cell(174,5,'c. STPD BPHTB / SKPDPB KURANG BAYAR /SKPDB ','R',1,'');

        $pdf->Cell(11,5,'','L',0,'L');
        $pdf->Cell(5,5,'','LBR',0,'L');
        $pdf->Cell(70,5,'  KURANG BAYAR TAMBAHAN *) ','',0,'');
        $pdf->Cell(50,5,'  Nomor :','',0,'L');
        $pdf->Cell(50,5,'  Tanggal: ','B',0,'');
        $pdf->Cell(4,5,'','R',1,'');

        $pdf->Cell(190,1,'','LR',1,'');

        $pdf->Cell(11,5,'','L',0,'L');
        $pdf->Cell(5,5,'',1,0,'L');
        $pdf->Cell(65,5,'c.Pengurang dihitung Sendiri menjadi :','',0,'');
        $pdf->Cell(5,5,'',1,0,'L');
        $pdf->Cell(5,5,'',1,0,'L');
        $pdf->Cell(50,5,'% Berdasarkan Peraturan KDH Nomor:','',0,'');
        $pdf->Cell(49,5,'   ','R',1,'');
        $pdf->Cell(190,1,'','LR',1,'');
        
        $pdf->Cell(11,5,'','L',0,'L');
        $pdf->Cell(5,5,'',1,0,'L');
        $pdf->Cell(174,5,'d. ........................................................','LR',1,'');

        $pdf->Cell(190,1,'','LRB',1,'');

        //Jumlah Setor
        $pdf->Cell(190,3,'','LR',1,'');

        $pdf->Cell(11,5,'','L',0,'L');
        $pdf->Cell(75,5,'JUMLAH YANG DISETOR (Dengan Angka)','',0,'L');
        $pdf->Cell(104,5,'(Dengan Huruf)','R',1,'');
        $pdf->Cell(11,5,'','L',0,'L');
        $pdf->Cell(55,5,'Rp. 1000.000',1,0,'L');
        $pdf->Cell(20,5,'','',0,'L');
        $pdf->Cell(104,5,'Empat puluh Lima Juta Lima ratus tiga puluh lima ribu rupiah','R',1,'L');

        $pdf->Cell(190,3,'','LBR',1,'');


        //tanda tangan
        $pdf->Cell(45,2,'','LR',0,'C');
        $pdf->Cell(55,2,'','R',0,'C');
        $pdf->Cell(40,2,'','R',0,'C');
        $pdf->Cell(50,2,'','R',1,'C');

        $pdf->Cell(45,5,'12 November 2020','LR',0,'C');
        $pdf->Cell(55,5,'MENGETAHUI :','R',0,'C');
        $pdf->Cell(40,5,'QR CODE','R',0,'C');
        $pdf->Cell(50,5,'Telah Diverivikasi','R',1,'C');

        $pdf->Cell(45,15,'','LR',0,'C');
        $pdf->Cell(55,15,'','R',0,'C');
        $pdf->Cell(40,15,'','R',0,'C');
        $pdf->Cell(50,15,'','R',1,'C');

        $len_wp =strlen('Muhammad Robby Santoso');
        if ($len_wp > 30) {
        $pdf->SetFont('Arial','U',9);

        }else{
        $pdf->SetFont('Arial','U',10);

        }
        $pdf->Cell(45,5,'Muhammad Robby Santoso','LR',0,'C');

        $len_pp =strlen('Abdul Aziz Murtadlo, S.kom ,M.Kom');
        if ($len_pp > 30) {
        $pdf->SetFont('Arial','U',9);
        }else{
        $pdf->SetFont('Arial','U',10);
        }

        $pdf->Cell(55,5,'Abdul Aziz Murtadlo, S.kom ,M.Kom','R','','C');

        $pdf->Cell(40,5,'','R',0,'C');
        $len_pm =strlen('Faris Purnomo, S.Kom');
        if ($len_pm > 30) {
        $pdf->SetFont('Arial','U',9);
        }else{
        $pdf->SetFont('Arial','U',10);
        }
        $pdf->Cell(50,5,'Faris Purnomo, S.Kom','R',1,'C');

        $pdf->SetFont('Arial','',10);
        $pdf->Cell(45,5,'','LR',0,'C');
        $pdf->Cell(55,5,'','R',0,'C');
        $pdf->Cell(40,5,'','R',0,'C');
        $pdf->Cell(50,5,'Nip.79878986875596576','R',1,'C');


        $pdf->Cell(45,3,'','LBR',0,'C');
        $pdf->Cell(55,3,'','BR',0,'C');
        $pdf->Cell(40,3,'','BR',0,'C');
        $pdf->Cell(50,3,'','BR',1,'C');
        $pdf->Output();
    }
    function print(){
        
        $pdf = new FPDF('P','mm','A4');
        // membuat halaman baru
        $pdf->SetMargins(10, 5);
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',11);
        // header

        $pdf->AutoPrint(true);
        $pdf->Output();
    }
}

/* End of file Sspd.php */
/* Location: ./application/controllers/Sspd.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-11-10 04:46:18 */
/* http://harviacode.com */