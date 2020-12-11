<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelunasan extends CI_Controller {


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
    	
		$data=array(
					'tgl_bayar' => date('Y-m-d H:i:s'),
					'validasi_bank' => 'Verifikasi via aplikasi',
					'status' => 'LN001',
					'no_sspd' => 'SD'.date('ymdHis').'1372',
            		'tgl_validasi_berkas' => date('Y-m-d H:i:s'),

					);
		$this->db->where('no_pendaftaran', $_POST['nopen']);
        $acc = $this->db->update('sspd', $data);
        echo json_encode(array('sts' => $acc));


    }
}

/* End of file Pelunasan.php */
/* Location: ./application/controllers/Pelunasan.php */