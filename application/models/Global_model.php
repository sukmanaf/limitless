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
            $this->db->where('sspd.status like "PP%" or sspd.status like "MP%" or sspd.status like "LN001%"   ');
            }
            $this->db->select('count(id) as jml');
        	return $this->db->get('sspd')->row();
    }
       // get data by id
    function get_user($id)
    {
        $this->db->where('user.id', $id);
        $user = $this->db->get('user')->row();
        if (!empty($user) && $user->jenis == 'PM') {
            $pm = $this->db->query('select * from pemda where id_user ='.$user->id)->row();
            foreach ($pm as $key => $value) {
                
                $user->$key = $value;
            }
        
        }else if (!empty($user) && $user->jenis == 'PP') {
            $pm = $this->db->query('select * from ppat where id_user ='.$user->id)->row();
            foreach ($pm as $key => $value) {
                
                $user->$key = $value;
            }
        }
        
        return $user;
    }
    
	

}

/* End of file Global_model.php */
/* Location: ./application/models/Global_model.php */