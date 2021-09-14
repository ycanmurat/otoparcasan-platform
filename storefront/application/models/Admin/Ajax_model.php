<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_model extends Core_Model
{
	function __construct()
    {
        parent::__construct();
    }

    public function login($getAllPosts)
    {
		$this->db->from('admin_users');
		$this->db->where(array('user_mail'=>$getAllPosts->m_login_signin_username,'status'=>1));
		$getQuery = $this->db->get();
		if ($getQuery->num_rows()>0) {
			$userInformation = $getQuery->row();
			if (password_verify($getAllPosts->m_login_signin_password, $userInformation->password)) {
				$this->session->sess_expiration = '1440000';
				$this->session->set_userdata('user',$userInformation);
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
    }
}