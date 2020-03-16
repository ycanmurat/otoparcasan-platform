<?php 
/**
* Login Module Build By Patates Kızartması
*/
class Login_model extends Core_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function SetLogin($user_mail, $password)
	{
		$this->db->select('*');
		$this->db->from('admin_users');
		$this->db->where(array('user_mail'=>$user_mail,'status'=>1));
		$getQuery = $this->db->get();
		if ($getQuery->num_rows()>0) {
			$userInformation = $getQuery->row();
			if (password_verify($password, $userInformation->password)) {
				$this->session->sess_expiration = '1440000';
				$this->session->set_userdata('user',$userInformation);
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}

		/*
		Eski Sistem Md5
		$this->db->select('id,user_mail,user_name,auth');
		$this->db->where(array('user_mail' => $mail,'pass' => md5($pass),'status' => 1));
		$q = $this->db->get('admin_users');

		if ($q->num_rows()>0) 
		{
			$this->session->sess_expiration = '1440000';
			$this->session->set_userdata('user',$q->row());		
			return true;
		}
		else{
			return false;
		}
		*/
	}

}
?>