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

	public function getBPHTBService($value='')
	{
		$post = json_decode(file_get_contents('php://input'), true);
		$cek_ntpd = $this->db->query('select count(id) jml from sspd where no_sspd = "'.$post['NTPD'].'"')->row();
		$cek_nop = $this->db->query('select count(id) jml from sspd where nop = "'.$post['NOP'].'"')->row();
		$data = $this->api->get_bphtb($post);
		if ($cek_ntpd->jml == 0) {
			$result = array('respon_code'=>'NTPD tidak ditemukan');
		}elseif ($cek_nop->jml == 0) {
			$result = array('respon_code'=>'NOP tidak ditemukan');
		}elseif (empty($data) ) {
			$result = array('respon_code'=>'Data tidak ditemukan');
		}else{
			
			$res = array(
				'NOP'=> $data->nop,
				'NIK'=> $data->nik,
				'NAMA'=> $data->nama,
				'ALAMAT'=> $data->alamat,
				'KELURAHAN_OP'=> $data->kelurahan_op,
				'KECAMATAN_OP'=> $data->kecamatan_op,
				'KOTA_OP'=> $data->kabupaten_op,
				'LUASTANAH'=> $data->luas_tanah,
				'LUASBANGUNAN'=> $data->luas_bangunan,
				'STATUS'=> 'Y',
				'TANGGAL_PEMBAYARAN'=> date_format(date_create($data->tgl_bayar),'d/m/Y'),
				'NTPD'=> $data->no_sspd,
				'JENISBAYAR'=> 'L'

			);
			header('Content-Type: application/json');
			$respon = array('respon_code'=>'OK');
			$result['result'] =$res;
			$result['respon_code'] ='OK';
		}
		
		echo json_encode($result);



	}

	public function getPBBService($value='')
	{
		$post = json_decode(file_get_contents('php://input'), true);
		$data = $this->api->get_bphtb($post);
		if (empty($data) ) {
			$result = array('respon_code'=>'Data tidak ditemukan');
		}else{
			
			$res = array(
				'NOP'=> $data->nop,
				'NIK'=> $data->nik,
				'NAMA'=> $data->nama,
				'ALAMAT_OP'=> $data->alamat_op,
				'KECAMATAN_OP'=> $data->kecamatan_op,
				'KELURAHAN_OP'=> $data->kelurahan_op,
				'KOTA_OP'=> $data->kabupaten_op,
				'LUASTANAH_OP'=> intVal($data->luas_tanah),
				'LUASBANGUNAN_OP'=> intVal($data->luas_bangunan),
				"NJOP_TANAH_OP" => intVal($data->njop_tanah),
				"NJOP_BANGUNAN_OP" => intVal($data->njop_bangunan),
				"STATUS_TUNGGAKAN" => '100% lUNAS'

			);
			header('Content-Type: application/json');
			$respon = array('respon_code'=>'OK');
			$result['result'] =$res;
			$result['respon_code'] ='OK';
		}
		
		echo json_encode($result);



	}
	public function getPBBService2($value='')
	{
		$post = json_decode(file_get_contents('php://input'), true);
		$data = $this->api->get_pbb($post);

		if (empty($data)) {
			$res = array('respon_code' => 'Data tidak ditemukan');
		}else{
			$res = array(
					"NOP" => $data->NOP, 
					"NIK" => "",
					"NAMA_WP" => $data->WP_NAMA,
					"ALAMAT_OP" => $data->OP_ALAMAT,
					"KECAMATAN_OP" => $data->OP_KECAMATAN,
					"KELURAHAN_OP" => $data->OP_KELURAHAN,
					"KOTA_OP" => $data->OP_KOTAKAB,
					"LUASTANAH_OP" => intVal($data->OP_LUAS_BUMI),
					"LUASBANGUNAN_OP" => intVal($data->OP_LUAS_BANGUNAN),
					"NJOP_TANAH_OP" => intVal($data->OP_NJOP_BUMI),
					"NJOP_BANGUNAN_OP" => intVal($data->OP_NJOP_BANGUNAN),
					"STATUS_TUNGGAKAN" => '100% lUNAS'
					);
		}
		header('Content-Type: application/json');
		echo json_encode($res);

	}
}

/* End of file Api.php */
/* Location: ./application/controllers/Api.php */