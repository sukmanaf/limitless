<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model {

	public function get_laporan($post)
		{
    		$time_awal = strtotime($post['awal']);
			$tanggal_awal = date('Y-m-d',$time_awal);

    		$time_akhir = strtotime($post['akhir']);
			$tanggal_akhir = date('Y-m-d',$time_akhir);

			// echo "<pre>";
			// print_r ($tanggal_akhir.$tanggal_awal);
			// echo "</pre>";exit();
			$this->db->where('DATE_FORMAT(tgl_validasi_berkas,"%Y-%m-%d") >= "'.$tanggal_awal.'"');
			$this->db->where('DATE_FORMAT(tgl_validasi_berkas,"%Y-%m-%d") <= "'.$tanggal_akhir.'"');
			$this->db->join('nik', 'sspd.id_nik = nik.id', 'left');
			$data = $this->db->get('sspd')->result();
			// echo $this->db->last_query();
			return $data;
		}	

}

/* End of file Laporan_model.php */
/* Location: ./application/models/Laporan_model.php */