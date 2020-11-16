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
								'id' => $sql->id,
								'jenis' => $sql->jenis,
							  );

				 $user_data = $this->session->all_userdata();
			    foreach ($user_data as $key => $value) {
			        if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
			            $this->session->unset_userdata($key);
			        }
			    }
				$_SESSION['user'] = $data;
				// $this->session->userdataa($sql[0]);

				
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