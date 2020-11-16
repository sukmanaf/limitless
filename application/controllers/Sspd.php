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
        		'id_ppat'=>@$_POST['id_ppat_search_name'],
				'nik'=>@$_POST['nik_search_name'],
				'nop'=>@$_POST['nop_search_name'],
				'alamat_op'=> @$_POST['alamat_op_search_name']

                ];
            $dataq = $this->Sspd_model->get_all($cari);
        $judul=[];
        $data['isi']=[];
        foreach ($dataq as $key => $v) {
            foreach ($v as $k => $val) {
                  array_push($judul, $k);
            }            
            $a= [$key+1,$v->id_ppat,$v->nik,
                 '<a href="'. site_url("sspd/read/").$v->id.'" class="btn-xs btn-primary"> Lihat</a>
                 <a href="'. site_url("sspd/update/").$v->id.'" class="btn-xs btn-info"> Ubah</a>

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
        $row = $this->Sspd_model->get_by_id($id);

        if ($row) {
            $data = array(
		'id' => $row->id,
		'id_ppat' => $row->id_ppat,
		'nik' => $row->nik,
		'nop' => $row->nop,
		'alamat_op' => $row->alamat_op,
		'propinsi_op' => $row->propinsi_op,
		'kabupaten_op' => $row->kabupaten_op,
		'kecamatan_op' => $row->kecamatan_op,
		'kelurahan_op' => $row->kelurahan_op,
		'luas_tanah' => $row->luas_tanah,
		'luas_bangunan' => $row->luas_bangunan,
		'njop_tanah' => $row->njop_tanah,
		'njop_bangunan' => $row->njop_bangunan,
		'njop_total' => $row->njop_total,
		'harga_transaksi' => $row->harga_transaksi,
		'jenis_perolehan' => $row->jenis_perolehan,
		'nomor_sertifikat' => $row->nomor_sertifikat,
		'npop' => $row->npop,
		'npoptkp' => $row->npoptkp,
		'bphtb' => $row->bphtb,
		'total_bayar' => $row->total_bayar,
		'status_bayar' => $row->status_bayar,
		'tgl_bayar' => $row->tgl_bayar,
		'validasi_bank' => $row->validasi_bank,
		'tgl_validasi_berkas' => $row->tgl_validasi_berkas,
		'status' => $row->status,
		'rtrw' => $row->rtrw,
	    );
            $this->skin->dashboard('sspd/sspd_read', $data);
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
            'button' => 'Simpan',
            'action' => site_url('sspd/create_action'),
	    'id' => set_value('id'),
	    'id_ppat' => set_value('id_ppat'),
	    'nik' => set_value('nik'),
	    'nop' => set_value('nop'),
	    'alamat_op' => set_value('alamat_op'),
	    'propinsi_op' => set_value('propinsi_op'),
	    'kabupaten_op' => set_value('kabupaten_op'),
	    'kecamatan_op' => set_value('kecamatan_op'),
	    'kelurahan_op' => set_value('kelurahan_op'),
	    'luas_tanah' => set_value('luas_tanah'),
	    'luas_bangunan' => set_value('luas_bangunan'),
	    'njop_tanah' => set_value('njop_tanah'),
	    'njop_bangunan' => set_value('njop_bangunan'),
	    'njop_total' => set_value('njop_total'),
	    'harga_transaksi' => set_value('harga_transaksi'),
	    'jenis_perolehan' => set_value('jenis_perolehan'),
	    'nomor_sertifikat' => set_value('nomor_sertifikat'),
	    'npop' => set_value('npop'),
        'npoptkp' => set_value('npoptkp'),
	    'npopkp' => set_value('npopkp'),
	    'bphtb' => set_value('bphtb'),
	    'total_bayar' => set_value('total_bayar'),
	    'status_bayar' => set_value('status_bayar'),
	    'tgl_bayar' => set_value('tgl_bayar'),
	    'validasi_bank' => set_value('validasi_bank'),
	    'tgl_validasi_berkas' => set_value('tgl_validasi_berkas'),
	    'status' => set_value('status'),
	    'rtrw' => set_value('rtrw'),
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
        }else{
            $ins_nik = $this->Sspd_model->update_nik($data['id_nik'], $data_nik);
        
        }

        if ($ins_nik == 1) {
            
            $nopen = 'PD'.date('ymdHis');
            $data['id_ppat'] = '1';
            $data_sspd = array(
              'id_ppat' => $data['id_ppat'],
              'nik' => $data['nik'],
              'nop' => $data['nop'],
              'alamat_op' => $data['alamat_op'],
              'kabupaten_op' => $data['kabupaten_op'],
              'kecamatan_op' => $data['kecamatan_op'],
              'kelurahan_op' => $data['kelurahan_op'],
              'rtrw_op' => $data['rtrw_op'],
              'luas_tanah' => $data['luas_tanah'],
              'luas_bangunan' => $data['luas_bangunan'],
              'njop_tanah' => $data['njop_tanah'],
              'njop_bangunan' => $data['njop_bangunan'],
              'njop_total' => $data['njop_total'],
              'harga_transaksi' => $data['harga_transaksi'],
              'jenis_perolehan' => $data['jenis_perolehan'],
              'nomor_sertifikat' => $data['nomor_sertifikat'],
              'npop' => $data['npop'],
              'npoptkp' => $data['npoptkp'],
              'npopkp' => $data['npopkp'],
              'bphtb' => $data['bphtb'],
              'status' => 'PM001',
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
        
            $data = array(
		'id_ppat' => $this->input->post('id_ppat'),
		'nik' => $this->input->post('nik'),
		'nop' => $this->input->post('nop'),
		'alamat_op' => $this->input->post('alamat_op'),
		'propinsi_op' => $this->input->post('propinsi_op'),
		'kabupaten_op' => $this->input->post('kabupaten_op'),
		'kecamatan_op' => $this->input->post('kecamatan_op'),
		'kelurahan_op' => $this->input->post('kelurahan_op'),
		'luas_tanah' => $this->input->post('luas_tanah'),
		'luas_bangunan' => $this->input->post('luas_bangunan'),
		'njop_tanah' => $this->input->post('njop_tanah'),
		'njop_bangunan' => $this->input->post('njop_bangunan'),
		'njop_total' => $this->input->post('njop_total'),
		'harga_transaksi' => $this->input->post('harga_transaksi'),
		'jenis_perolehan' => $this->input->post('jenis_perolehan'),
		'nomor_sertifikat' => $this->input->post('nomor_sertifikat'),
		'npop' => $this->input->post('npop'),
		'npoptkp' => $this->input->post('npoptkp'),
		'bphtb' => $this->input->post('bphtb'),
		'total_bayar' => $this->input->post('total_bayar'),
		'status_bayar' => $this->input->post('status_bayar'),
		'tgl_bayar' => $this->input->post('tgl_bayar'),
		'validasi_bank' => $this->input->post('validasi_bank'),
		'tgl_validasi_berkas' => $this->input->post('tgl_validasi_berkas'),
		'status' => $this->input->post('status'),
		'rtrw' => $this->input->post('rtrw'),
	    );

            $acc = $this->Sspd_model->update($this->input->post('id', TRUE), $data);
            echo $acc;
        
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
}

/* End of file Sspd.php */
/* Location: ./application/controllers/Sspd.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-11-10 04:46:18 */
/* http://harviacode.com */