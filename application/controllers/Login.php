<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$this->load->view('login');	
	}

	public function logins($value='')
	{

		$username = $this->input->post('user');
		$password = $this->input->post('pass');

		$sql = $this->db->query('select count(id) as jml,user.* from user where username ="'.$username.'"')->row();

		// echo $this->db->last_query();

		$jml = $sql->jml;
		if ( $jml == 1) {
			if ($password == $sql->password) {
				// echo 'benar';
				$data = array(
								'username' => $sql->username,
								'id_user' => $sql->id,
								'jenis' => $sql->jenis,
							  );

				if ($sql->jenis == 'PM') {
					$row = $this->db->query('select pemda.* from pemda join user on user.id = pemda.id_user where user.id ='.$sql->id)->row();
					// $data->
					$data['id_pemda'] = $row->id;
					$data['jabatan'] = $row->jabatan;
					$data['nip'] = $row->nip;
					$data['nama'] = $row->nama;
					
				}
				if ($sql->jenis == 'PP') {
					$row = $this->db->query('select ppat.* from ppat join user on user.id = ppat.id_user where user.id ='.$sql->id)->row();
					// $data->
					$data['id_ppat'] = $row->id;
					$data['alamat'] = $row->alamat;
					$data['nama'] = $row->nama;

				}				

				$user_data = $this->session->all_userdata();
			    foreach ($user_data as $key => $value) {
			        if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
			            $this->session->unset_userdata($key);
			        }
			    }
				$_SESSION['user'] = $data;
				// $this->session->userdataa($sql[0]);
				$setting = $this->db->query('select * from setting')->row();

				$_SESSION['setting'] = $setting;


				
				echo 1;
			}else{
				echo 0;
			}
		}else{
				echo 0;
		}


	}

	public function log_out()
	{
 		$user_data = $this->session->all_userdata();
	    foreach ($user_data as $key => $value) {
	        if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
	            $this->session->unset_userdata($key);
	        }
	    }
	    redirect( site_url('login'));
	}

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */