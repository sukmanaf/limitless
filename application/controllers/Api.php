<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		header('Access-Control-Allow-Origin: *');  
		$this->load->model('Api_model', 'api');
	}
	public function index()
	{
	}

	public function inquiry()
	{
		
		$data = $this->api->get_by_billing($_POST['billing']);
		if(empty($data)){
			echo json_encode(array('sts' => 201, 'result' => 'Data Tidak ditemukan'));
		}else if ($data->exp_id_billing < date('Y-m-d')) {
			echo json_encode(array('sts' => 201, 'result' => 'Id Billing Kadaluarsa'));
		}else if ($data->status != 'MP001') {
			echo json_encode(array('sts' => 201, 'result' => 'Data Belum Terverifikasi'));
		}else{
			$datas = array(
							'NAMA' => $data->nama,
							'NO_PENDAFTARAN' => $data->no_pendaftaran,
							'NOP' => $data->nop,
							'JUMLAH_SETOR' => $data->total_bayar,
							);
			echo json_encode($datas);
		}
	}

}

/* End of file Api.php */
/* Location: ./application/controllers/Api.php */