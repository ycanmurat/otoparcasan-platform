<?defined('BASEPATH') OR exit('No direct script access allowed');

class Facebook_model extends Core_Model
{
	public function userControl($email)
	{
		$this->db->select('email');
		$this->db->from('users');
		$this->db->where(array('email' => $email));
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function loginUser($email)
	{
		$this->db->from('users');
		$this->db->where(array('email' => $email));
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			$this->session->set_userdata('userInfo',$returnQuery->row());
			return true;
		} else {
			return false;
		}
	}

	public function addSocialUser($getAllPosts)
	{
		if ($this->db->insert('users',$getAllPosts)) {
			$insert_id = $this->db->insert_id();
			$notifications = array(
				'user_id' => $insert_id,
				'campaign_email' => 1,
				'campaign_sms' => 1,
				'basket_email' => 1,
				'cargo_sms' => 1,
				'favorites_product_email' => 1,
				'marketing_call' => 1);
			if ($this->db->insert('notification_settings',$notifications)) {
				$this->db->from('users');
				$this->db->where(array('email' => $getAllPosts->email));
				$returnQuery = $this->db->get();
				if ($returnQuery->num_rows() > 0) {
					$this->session->set_userdata('userInfo',$returnQuery->row());
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
}