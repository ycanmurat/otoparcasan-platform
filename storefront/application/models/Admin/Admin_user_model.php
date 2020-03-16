<?
	class Admin_user_model extends Core_Model
	{
		function __construct()
		{
			parent::__construct();
		}
		public function AllUserQuery()
		{
			$this->db->select('Id, user_name, user_mail, status, user_gsm, auth');
			$this->db->from('admin_users');
			$user_result_info = $this->db->get();
			if ($user_result_info->num_rows()>0) {
				return $user_result_info->result();
			} else {
				return false;
			}
		}
		public function StatusEditM($Id, $NowStatus) 
		{
			return $this->db->set('status', $NowStatus)->where('Id', $Id)->update('admin_users');
		}
		public function AutEditM($Auth, $Id) {
			return $this->db->set('auth', $Auth)->where('Id', $Id)->update('admin_users');
		}
		public function is_there($adminInfo){
			$this->db->select('user_mail');
			$this->db->from('admin_users');
			$this->db->where(array('user_mail' => $adminInfo->user_mail));
			$info = $this->db->get();
			if ($info->num_rows() < 1) {
				return true;
			} else {
				return false;
			}
		}
		public function adminAdd($adminInfo)
		{
			$this->db->set($adminInfo);
			if ($this->db->insert('admin_users')) {
				return true;
			} else {
				return false;
			}
		}
		public function DeleteUser($Id)
		{
			if ($this->db->delete('admin_users', array('Id' => $Id))) {
				return true;
			} else {
				return false;
			}
		}
		public function userInfo($Id)
		{
			$query = $this->db->select('Id,user_name,user_mail,password,user_gsm')->from('admin_users')->where('Id',$Id)->get();
			if ($query->num_rows()>0) {
				return $query->row();
			} else {
				return false;
			}
		}
		public function UpdateNewInfo($Id, $getUserInfo)
		{
			if (!empty($Id) || !empty($getUserInfo) || ctype_digit($Id)) {
				$updateNewIn = $this->db->set($getUserInfo)->where(array('Id' => $Id))->update('admin_users');
				if ($updateNewIn) {
					return true;
				} else {
					return false;
				}
			}
			else {
				return false;
			}
		}

		public function updateAdminUser($Id,$getAllPosts)
		{
			return $this->db->set($getAllPosts)->where(array('Id'=>$Id))->update('admin_users');
		}

		public function updateInfo($Id,$getAllPosts)
		{
			return $this->db->set($getAllPosts)->where(array('Id'=>$Id))->update('admin_users');
		}
	}

?>