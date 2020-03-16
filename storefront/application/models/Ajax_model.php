<?defined('BASEPATH') OR exit('No direct script access allowed');
	
class Ajax_model extends Core_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function addUser($getAllPosts)
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
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function login($getAllPosts)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where(array('email' => $getAllPosts->email));
		$getQuery = $this->db->get();
		if ($getQuery->num_rows()>0) {
			$userInformation = $getQuery->row();
			if (password_verify($getAllPosts->password, $userInformation->password)) {
				$token = md5($getAllPosts->email.date("Y-m-d H:i:s"));
				if ($this->db->set(array('token'=>$token))->where(array('email'=>$getAllPosts->email))->update('users')) {
					if ($getAllPosts->remember_me == 1) {
						$cookie = array(
					        'name'   => 'remember_me',
					        'value'  => $token,
					        'expire' => '31536000',
					        'path'   => '/'
					    );
					    $this->input->set_cookie($cookie);
					    $this->session->set_userdata('userInfo',$userInformation);
					    return true;     
					} else {
						$this->session->set_userdata('userInfo',$userInformation);
						return true;
					}	
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

	public function emailCheck($email)
	{
		$this->db->select('email');
		$this->db->from('users');
		$this->db->where(array('email'=>$email));
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows()>0) {
			return true;
		} else {
			return false;
		}
	}

	public function phoneCheck($phone)
	{
		$this->db->select('phone');
		$this->db->from('users');
		$this->db->where(array('phone'=>$phone));
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows()>0) {
			return true;
		} else {
			return false;
		}
	}

	public function updateAccount($getAllPosts,$id)
	{
		if ($this->db->set($getAllPosts)->where(array('id'=>$id))->update('users')) {
			$this->session->unset_userdata('userInfo');
			$this->db->from('users');
			$this->db->where(array('id'=>$id));
			$returnQuery = $this->db->get();
			if ($returnQuery->num_rows()> 0) {
				$this->session->set_userdata('userInfo',$returnQuery->row());
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function updatePassword($getAllPosts,$id)
	{
		return $this->db->set($getAllPosts)->where(array('id'=>$id))->update('users');
	}

	public function getCitiesByCountry($countryID)
	{
		$this->db->select('CityID,CountryID,CityName');
		$this->db->from('location_cities');
		$this->db->where(array('CountryID'=>$countryID));
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->result();
		} else {
			return false;
		}
	}

	public function getCountiesByCities($CityID)
	{
		$this->db->select('*');
		$this->db->from('location_counties');
		$this->db->where(array('CityID'=>$CityID));
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->result();
		} else {
			return false;
		}
	}

	public function getCountiesByArea($AreaID)
	{
		$this->db->select('*');
		$this->db->from('location_area');
		$this->db->where(array('CountyID'=>$AreaID));
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->result();
		} else {
			return false;
		}
	}

	public function addAddress($getAllPosts)
	{
		return $this->db->insert('address',$getAllPosts);
	}

	public function updateAddress($getAllPosts)
	{
		$this->db->select('user_id,Id');
		$this->db->from('address');
		$this->db->where(array('Id'=>$getAllPosts->update_id));
		$returnSecurity = $this->db->get();
		if ($returnSecurity->num_rows() > 0) {
			$returnSecurityRow = $returnSecurity->row();
			if ($returnSecurityRow->user_id == $getAllPosts->user_id) {
				$update_id = $getAllPosts->update_id;
				unset($getAllPosts->update_id,$getAllPosts->user_id);
				return $this->db->set($getAllPosts)->where(array('Id'=>$update_id))->update('address');
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function updateRenewPassword($updateRememberAndAdded,$email)
	{
		return $this->db->set($updateRememberAndAdded)->where(array('email'=>$email))->update('users');
	}

	public function resetInformation($email)
	{
		$this->db->select('name,email,remember_key');
		$this->db->from('users');
		$this->db->where(array('deleted'=>0,'email'=>$email));
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->row();
		} else {
			return false;
		}
	}

	public function rememberAndMailCheck($email,$remember_key)
	{
		$this->db->select('email,remember_key,deleted');
		$this->db->from('users');
		$this->db->where(array('email'=>$email,'remember_key'=>$remember_key,'deleted'=>0));
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() == 1) {
			return true;
		} else {
			return false;
		}
	}

	public function updateNewPassword($updateInformation,$remember_key)
	{
		return $this->db->set($updateInformation)->where(array('remember_key'=>$remember_key))->update('users');
	}

	public function updateNotification($getAllPosts,$user_id)
	{
		return $this->db->set($getAllPosts)->where(array('user_id'=>$user_id))->update('notification_settings');
	}

	public function reviewStatus($user_id)
	{
		$this->db->select('user_id');
		$this->db->from('reviews');
		$this->db->where(array('user_id'=>$user_id));
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return false;
		} else {
			return true;
		}
	}

	public function reviewAdd($getAllPosts)
	{
		return $this->db->insert('reviews',$getAllPosts);
	}

	public function reviewUpdate($getAllPosts,$id)
	{
		return $this->db->set($getAllPosts)->where(array('user_id'=>$id))->update('reviews');
	}

	public function getBanner()
	{
		$this->db->select('*');
		$this->db->from('product_banner');
		$this->db->where(array('Id'=>1,'status'=>1));
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows()>0) {
			return $returnQuery->row();
		} else {
			return array();
		}
	}

	public function addIbanNumber($getAllPosts)
	{
		return $this->db->insert('iban_list',$getAllPosts);
	}

	public function addTransferInformation($getAllPosts)
	{
		return $this->db->insert('remittance_payment_notice',$getAllPosts);
	}

	public function addModalReviewInformation($getAllPosts)
	{
		return $this->db->insert('general_evaluation',$getAllPosts);
	}

	public function addNewsletterEmail($getAllPosts)
	{
		return $this->db->insert('bulletin',$getAllPosts);
	}

	public function getCountiesByHumanResources($CityID)
	{
		$this->db->from('location_counties');
		$this->db->where(array('CityID'=>$CityID));
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->result();
		} else {
			return false;
		}
	}

	public function sendContactForm($getAllPosts)
	{
		return $this->db->insert('contact',$getAllPosts);
	}

	public function sendSupportRequest($getAllPosts)
	{
		return $this->db->insert('support_requests',$getAllPosts);
	}

	public function getSupportSection($id)
	{
		$this->db->from('support_sections');
		$this->db->where(array('id'=>$id,'deleted'=>0,'status'=>1));
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->row();
		} else {
			return false;
		}
	}
}