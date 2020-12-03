<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model {

    public $table_sw ='CPPMOD_PBB_SPPT_CURRENT';
    public $table_gw ='PBB_SPPT';

    function __construct()
        
    {
        parent::__construct();
        $this->sw_pbb = $this->load->database('sw_pbb', TRUE);
        $this->gw_pbb = $this->load->database('gw_pbb', TRUE);
        $this->ses = $this->session->userdata('user');

    }
	public function get_by_billing($value='')
	{
		$this->db->where('id_billing', $value);
		$this->db->join('nik', 'nik.id = sspd.id_nik');		
		$data = $this->db->get('sspd');
		return $data->row();
	}

	public function get_bphtb($value='')
	{

		$this->db->where('no_sspd', $value['NTPD']);
		$this->db->where('nop', $value['NOP']);
		$this->db->join('nik', 'sspd.id_nik = nik.id', 'left');
		$data = $this->db->get('sspd')->row();
		return $data;
	}	

	public function get_pbb($value='')
	{
		
		$this->sw_pbb->where('nop', $value['NOP']);
        return $this->sw_pbb->get($this->table_sw)->row();

	}


		

}

/* End of file Api_model.php */
/* Location: ./application/models/Api_model.php */