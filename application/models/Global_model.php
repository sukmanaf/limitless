<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Global_model extends CI_Model {
function __construct()
        
    {
        parent::__construct();
        $this->sw_pbb = $this->load->database('sw_pbb', TRUE);
        $this->gw_pbb = $this->load->database('gw_pbb', TRUE);

    }


     // get all
    function get_sspd_notif($tipe='',$jabatan='')
    {
        
        
            if ($tipe =='PM') {
            $this->db->where('sspd.status', $jabatan);
            }
            if ($tipe =='PP') {
            $this->db->where('sspd.status like "PP%"');
            }
            $this->db->select('count(id) as jml');
        	return $this->db->get('sspd')->row();
    }

	

}

/* End of file Global_model.php */
/* Location: ./application/models/Global_model.php */