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
        if(!empty($param)){
         foreach ($param as $key => $value) {
        
        $this->db->where($key.' like "%'.$value.'%"');
            
        }
    }
       		$this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
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

    }  function insert_nik($data)
    {
       $acc = $this->db->insert('nik', $data);
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

}

/* End of file Sspd_model.php */
/* Location: ./application/models/Sspd_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-11-10 04:46:18 */
/* http://harviacode.com */