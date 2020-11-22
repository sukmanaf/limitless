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
    	$time = strtotime($_POST['tanggal']);

		$tanggal = date('Y-m-d',$time);
		$data=array(
					'tgl_bayar' => $tanggal,
					'validasi_bank' => 'Verifikasi via aplikasi',
					'status' => 'LN001',
					);
		$this->db->where('no_pendaftaran', $_POST['nopen']);
        $acc = $this->db->update('sspd', $data);
        echo json_encode(array('sts' => $acc));


    }
}

/* End of file Pelunasan.php */
/* Location: ./application/controllers/Pelunasan.php */