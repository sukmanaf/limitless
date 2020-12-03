<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sspd_model extends CI_Model
{

    public $table = 'sspd';
    public $id = 'id';
    public $order = 'DESC';
    public $table_sw ='CPPMOD_PBB_SPPT_CURRENT';
    public $table_gw ='PBB_SPPT';


    function __construct()
        
    {
        parent::__construct();
        $this->sw_pbb = $this->load->database('sw_pbb', TRUE);
        $this->gw_pbb = $this->load->database('gw_pbb', TRUE);
        $this->ses = $this->session->userdata('user');

    }

    // datatables
    function json() {
        $this->datatables->select('id,id_ppat,nik,nop,alamat_op,propinsi_op,kabupaten_op,kecamatan_op,kelurahan_op,luas_tanah,luas_bangunan,njop_tanah,njop_bangunan,njop_total,harga_transaksi,jenis_perolehan,nomor_sertifikat,npop,npoptkp,bphtb,total_bayar,status_bayar,tgl_bayar,validasi_bank,tgl_validasi_berkas,status,rtrw');
        $this->datatables->from('sspd');
        //add this line for join
        //$this->datatables->join('table2', 'sspd.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('sspd/read/$1'),'Read')." | ".anchor(site_url('sspd/update/$1'),'Update')." | ".anchor(site_url('sspd/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id');
        return $this->datatables->generate();
    }

    // get all
    function get_all($param='')
    {
        $cek = '';
        if(!empty($param['nik']) && !empty($param['nopen']) && !empty($param['nama'])){

        //     foreach ($param as $key => $value) {
        //         if($key == 'nik'){
        //         }if($key == 'nama'){
        //         $this->db->where('nik.nama like "%'.$value.'%"');
        //         }if($key == 'nopen'){
        //         $this->db->where('sspd.no_pendaftaran like "%'.$value.'%"');
        //         }
        //     }
                $cek .= 'cari';
                $this->db->where('nik.nik like "%'.$param['nik'].'%" or nik.nama like "%'.$param['nama'].'%" or sspd.no_pendaftaran like "%'.$param['nopen'].'%"  ');
        }
       
        $tipe = $this->ses['jenis'];
        
        if (empty($cek)) {
            if ($tipe =='PM') {
            $jabatan = $this->ses['jabatan'];
            $this->db->where('sspd.status', $jabatan);
            }
            if ($tipe =='PP') {
            $id_ppat = $this->ses['id_ppat'];
            $this->db->where('sspd.status like "PP%" or sspd.status like "MP%" or (sspd.status like "LN001%" and DATE_FORMAT(sspd.update,"%Y-%m-%d") = DATE_FORMAT(NOW(),"%Y-%m-%d"))');
            $this->db->where('sspd.id_ppat = '.$id_ppat);

            }
        }
            $this->db->select('sspd.*,nik.nama,ppat.nama as nama_ppat,ppat.alamat as alamat_ppat,status.text,status.status,status.class,jenis_perolehan.nama as jenis_perolehan_text');
            $this->db->join('status', 'status.status = sspd.status', 'left');
            $this->db->join('jenis_perolehan', 'jenis_perolehan.kode = sspd.jenis_perolehan', 'left');
            $this->db->join('ppat', 'ppat.id = sspd.id_ppat', 'left');
            $this->db->join('nik', 'nik.id = sspd.id_nik', 'left');
       		$this->db->order_by('sspd.update','asc');
            $data = $this->db->get($this->table)->result();
            // echo $this->db->last_query();
            return $data;
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
   
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
	$this->db->or_like('id_ppat', $q);
	$this->db->or_like('nik', $q);
	$this->db->or_like('nop', $q);
	$this->db->or_like('alamat_op', $q);
	$this->db->or_like('propinsi_op', $q);
	$this->db->or_like('kabupaten_op', $q);
	$this->db->or_like('kecamatan_op', $q);
	$this->db->or_like('kelurahan_op', $q);
	$this->db->or_like('luas_tanah', $q);
	$this->db->or_like('luas_bangunan', $q);
	$this->db->or_like('njop_tanah', $q);
	$this->db->or_like('njop_bangunan', $q);
	$this->db->or_like('njop_total', $q);
	$this->db->or_like('harga_transaksi', $q);
	$this->db->or_like('jenis_perolehan', $q);
	$this->db->or_like('nomor_sertifikat', $q);
	$this->db->or_like('npop', $q);
	$this->db->or_like('npoptkp', $q);
	$this->db->or_like('bphtb', $q);
	$this->db->or_like('total_bayar', $q);
	$this->db->or_like('status_bayar', $q);
	$this->db->or_like('tgl_bayar', $q);
	$this->db->or_like('validasi_bank', $q);
	$this->db->or_like('tgl_validasi_berkas', $q);
	$this->db->or_like('status', $q);
	$this->db->or_like('rtrw', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('id_ppat', $q);
	$this->db->or_like('nik', $q);
	$this->db->or_like('nop', $q);
	$this->db->or_like('alamat_op', $q);
	$this->db->or_like('propinsi_op', $q);
	$this->db->or_like('kabupaten_op', $q);
	$this->db->or_like('kecamatan_op', $q);
	$this->db->or_like('kelurahan_op', $q);
	$this->db->or_like('luas_tanah', $q);
	$this->db->or_like('luas_bangunan', $q);
	$this->db->or_like('njop_tanah', $q);
	$this->db->or_like('njop_bangunan', $q);
	$this->db->or_like('njop_total', $q);
	$this->db->or_like('harga_transaksi', $q);
	$this->db->or_like('jenis_perolehan', $q);
	$this->db->or_like('nomor_sertifikat', $q);
	$this->db->or_like('npop', $q);
	$this->db->or_like('npoptkp', $q);
	$this->db->or_like('bphtb', $q);
	$this->db->or_like('total_bayar', $q);
	$this->db->or_like('status_bayar', $q);
	$this->db->or_like('tgl_bayar', $q);
	$this->db->or_like('validasi_bank', $q);
	$this->db->or_like('tgl_validasi_berkas', $q);
	$this->db->or_like('status', $q);
	$this->db->or_like('rtrw', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
       $acc = $this->db->insert($this->table, $data);
       return $acc;

    }  
    function insert_nik($data)
    {
       $acc = $this->db->insert('nik', $data);
       $insert_id = $this->db->insert_id();

   return  $insert_id.'.'.$acc;

    }
    function insert_komen($data)
    {
       $acc = $this->db->insert('komen', $data);
       $insertId = $this->db->insert_id();
       return $acc;

    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
       $acc = $this->db->update($this->table, $data);
       return $acc;

    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $acc = $this->db->delete($this->table);
       return $acc;

    }


    public function get_propinsi($value='')
    {
        return $this->db->get('propinsi')->result();
        
    }

        // get data by id
    function get_kabupaten($id)
    {
        $this->db->where('propinsi_id', $id);
        return $this->db->get('kabupaten')->result();
    }
        // get data by id
    function get_kecamatan($id)
    {
        $this->db->where('kabupaten_id', $id);
        return $this->db->get('kecamatan')->result();
    }
        // get data by id
    function get_kelurahan($id)
    {
        $this->db->where('kecamatan_id', $id);
        return $this->db->get('kelurahan')->result();
    }   function get_nama_kelurahan($id)
    {
        $this->db->where('kecamatan_id', $id);
        return $this->db->get('kelurahan')->result();
    }


    // get data by id
    function get_nop($nop)
    {
        $this->sw_pbb->where('nop', $nop);
        return $this->sw_pbb->get($this->table_sw)->row();
    }    // get data by id

    function get_nik($nik)
    {
        $this->db->where('nik', $nik);
        return $this->db->get('nik')->row();
    }

    function get_history_nop($nop)
    {
        $this->gw_pbb->where('nop', $nop);
        $this->gw_pbb->limit(5);
        $this->gw_pbb->order_by('SPPT_TAHUN_PAJAK', 'desc');
        $this->gw_pbb->select('SPPT_TAHUN_PAJAK,PAYMENT_FLAG');
        return $this->gw_pbb->get($this->table_gw)->result();
    }


    function get_jns_perolehan()
    {
        return $this->db->get('jenis_perolehan')->result();
    }

    function cek_nik($nik)
    {
        $this->db->where('nik', $nik);
        $this->db->select('count(nik) as jml');
        return $this->db->get('nik')->row();
    }

    function update_nik($id, $data)
    {
        $this->db->where($this->id, $id);
       $acc = $this->db->update('nik', $data);
       return $acc;

    }

     // get data by id
    function get_by_nopen($nopen)
    {
        $this->db->where('no_pendaftaran', $nopen);
        $this->db->join('jenis_perolehan', 'jenis_perolehan.kode = sspd.jenis_perolehan', 'left');

        return $this->db->get($this->table)->row();
    }     // get data by id
    function get_all_by_nopen($nopen)
    {
        $this->db->where('no_pendaftaran', $nopen);
        $this->db->join('ppat', 'ppat.id = sspd.id_ppat', 'left');
        $this->db->join('nik', 'nik.id = sspd.id_nik', 'left');
        $this->db->join('jenis_perolehan', 'jenis_perolehan.kode = sspd.jenis_perolehan', 'left');
        $this->db->select('sspd.*,ppat.*,nik.*,jenis_perolehan.nama as jenis_perolehan_text,sspd.id as id_sspd');
        return $this->db->get($this->table)->row();
    }   // get data by id
    function get_files($nopen)
    {
        $this->db->where('nopen', $nopen);
        return $this->db->get('files')->result();
    }
     // get data by id
    function get_jenis_perolehan($kode)
    {
        $this->db->where('kode', $kode);
        return $this->db->get('jenis_perolehan')->row();
    }
     // get data by id
    function get_lampiran($lam)
    {
        $this->db->where_in('id', $lam);

        return $this->db->get('lampiran')->result();
    }

    function get_approve($status,$acc,$nopen)
    {

        if ($status == 'PM003') {
            $cek = $this->db->query('select total_bayar from sspd where no_pendaftaran= "'.$nopen.'"')->row();
            if ($cek->total_bayar == 0) {
                $this->db->order_by('alur.id', 'desc');
            }
        }
        $this->db->where('alur.status', $acc);
        $this->db->where('sd.status', $status);
        $this->db->join('status sd', 'sd.id = alur.dari', 'left');
        $this->db->join('status sk', 'sk.id = alur.ke', 'left');
        $this->db->select('alur.*,sk.status as status_ke,sd.status as status_dari');
        
        $data = $this->db->get('alur')->row();
        $data['total_bayar'] = $cek->total_bayar;
        return $data;

    }


    function get_status_edit($status)
    {

        
        $this->db->where('alur.status', 'edit');
        $this->db->where('sd.status', $status);
        $this->db->join('status sd', 'sd.id = alur.dari', 'left');
        $this->db->join('status sk', 'sk.id = alur.ke', 'left');
        $this->db->select('alur.*,sk.status as status_ke,sd.status as status_dari');
        
         return $this->db->get('alur')->row();
         
    }

     // get all
    function get_sspd_notif($param='')
    {
        
        $tipe = $this->ses['jenis'];
        
        if (empty($cek)) {
            if ($tipe =='PM') {
            $jabatan = $this->ses['jabatan'];
            $this->db->where('sspd.status', $jabatan);
            }
            if ($tipe =='PP') {
            $this->db->where('sspd.status like "PP%"');
            }
        }
            $this->db->select('count(id) as jml');
        return $this->db->get($this->table)->row();
    }

      // get data by id
    function get_komen($nopen)
    {
        $this->db->where('nopen', $nopen);
        $this->db->join('user', 'user.id = komen.send', 'left');
        $this->db->order_by('date', 'asc');
        return $this->db->get('komen')->result();
    }
      // get data by id
    function get_ttd($jenis)
    {
        $this->db->where('jenis', $jenis);
        return $this->db->get('ttd')->row();
    }
}

/* End of file Sspd_model.php */
/* Location: ./application/models/Sspd_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-11-10 04:46:18 */
/* http://harviacode.com */