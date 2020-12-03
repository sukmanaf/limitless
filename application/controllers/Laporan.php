<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('Laporan_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
        $this->load->library('pdf');

        $this->ses = $this->session->userdata('user');
        $this->setting = $this->session->userdata('setting');
    }
	public function index()
	{
        $this->skin->dashboard('laporan/laporan_list',null);
				
	}


    public function get_data()
    {   

        $cari =[
        		'awal'=>@$_POST['tanggal_awal'],
				'akhir'=>@$_POST['tanggal_akhir'],

                ];
            $dataq = $this->Laporan_model->get_laporan($cari);
            // echo $this->db->last_query();
         $judul=[];
        $data['isi']=[];
        $total_harga_transaksi=0;
        $total_bphtb=0;

        foreach ($dataq as $key => $v) {
            $a= [$key+1,
            	$v->no_sspd,
            	$v->nama,
            	$v->alamat,
            	$v->nop,
            	$v->alamat_op,
            	$v->rtrw_op,
            	$v->kelurahan_op,
            	$v->kecamatan_op,
            	$v->luas_tanah,
            	$v->luas_bangunan,
            	rupiah($v->njop_tanah),
            	rupiah($v->njop_bangunan),
            	rupiah($v->njop_total),
            	rupiah($v->harga_transaksi),
            	rupiah($v->npop),
            	rupiah($v->npoptkp),
            	rupiah($v->npopkp),
            	rupiah($v->bphtb),
            	tanggal_indonesia_jam($v->tgl_validasi_berkas),
                 ];
                $total_harga_transaksi =$total_harga_transaksi+ $v->harga_transaksi;
                $total_bphtb =$total_bphtb+ $v->bphtb;
            // <button  class="btn-sm btn-danger" onclick="hapus('.$v->id.',event)"><i class="fas fa-trash"></i> hapus</button>
            array_push($data['isi'], $a);

        };
        $total = [	'',
            			'Total',
        				'',
        				'',
        				'',
        				'',
        				'',
        				'',
        				'',
        				'',
        				'',
        				'',
        				'',
        				'',
        				rupiah($total_harga_transaksi),
        				'',
        				'',
        				'',
        				rupiah($total_bphtb),
        				''
        			];
            // array_push($data['isi'], $total);


        echo json_encode($data);
    }

}

/* End of file Laporan.php */
/* Location: ./application/controllers/Laporan.php */