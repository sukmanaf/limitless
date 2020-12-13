<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelunasan extends CI_Controller {

  function __construct()
    {
        parent::__construct();
        $this->load->model('Sspd_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
        $this->load->library('pdf');

        $this->ses = $this->session->userdata('user');
        $this->setting = $this->session->userdata('setting');
    }
    public function index()
    {
    	
        $this->skin->dashboard('pelunasan/pelunasan',null);


    } 

    public function get_data($value='')
    {
    	// echo "<pre>";
    	// print_r ($_POST);
    	// echo "</pre>";
    	$idbilling = $_POST['billing'];
    	$data = $this->db->query('select * from sspd join  nik on sspd.id_nik = nik.id where sspd.id_billing ="'.$idbilling.'"')->row();

    	if (!empty($data)) {
    		$result = json_encode(array('sts' => 1 ,'data' => $data));
    	}else{
    		$result = json_encode(array('sts' => 0));
    	}

    	echo $result;
    }

    public function validasi($value='')
    {
    	// echo "<pre>";
    	// print_r ($_POST);
    	// echo "</pre>";exit();
		$data=array(
					'tgl_bayar' => date('Y-m-d H:i:s'),
					'validasi_bank' => 'Verifikasi via aplikasi',
					'status' => 'LN001',
					'no_sspd' => 'SD'.date('ymdHis').'1372',
            		'tgl_validasi_berkas' => date('Y-m-d H:i:s'),

					);
		$this->db->where('no_pendaftaran', $_POST['nopen']);
        $acc = $this->db->update('sspd', $data);
        if ($acc == 1) {
             $log = array('idbilling' => $_POST['billing'],
                'data' =>json_encode($data),
                'ip' =>$this->ses['ip'],
                'jenis' =>'Payment Sukses',
                );
                    $this->logs->payment($log);
        	echo json_encode(array('sts' => $acc));
        	
        }else{
        	  $log = array('idbilling' => $_POST['billing'],
                'data' =>json_encode($data),
                'ip' =>$this->ses['ip'],
                'jenis' =>'Payment Gagal',
                );
                    $this->logs->payment($log);
        	echo json_encode(array('sts' => $acc));
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
}

/* End of file Pelunasan.php */
/* Location: ./application/controllers/Pelunasan.php */