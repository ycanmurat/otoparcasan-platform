<?defined('BASEPATH') OR exit('No direct script access allowed');

class Account_model extends Core_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function getAccountInformation($id)
	{
		$this->db->select('name,surname,email,phone,email,city,town,date_of_birth,gender');
		$this->db->from('users');
		$this->db->where(array('id'=>$id,'deleted'=>0));
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->row();
		} else {
			return false;
		}
	}

	public function getCountries()
	{
		$this->db->select('CountryID,CountryName');
		$this->db->from('location_countries');
		$this->db->order_by('CountryID','DESC');
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->result();
		} else {
			return array();
		}
	}

	public function getCity()
	{
		$this->db->select('CityID,CityName');
		$this->db->from('location_cities');
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->result();
		} else {
			return array();
		}
	}

	public function getTown($CityID)
	{
		$this->db->select('*');
		$this->db->from('location_counties');
		$this->db->where(array('CityID'=>$CityID));
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->result();
		} else {
			return array();
		}
	}

	public function getUserByAddress($user_id)
	{
		$this->db->select('
				a.*,
					lcu.CountryID country_id,
						lcu.CountryName,
							lcs.CityID city_id,
								lcs.CityName,
									lci.CountyID county_id,
										lci.CountyName
		');
		$this->db->from('address a');
		$this->db->join('location_countries lcu','lcu.CountryID = a.country');
		$this->db->join('location_cities lcs','lcs.CityID = a.city');
		$this->db->join('location_counties lci','lci.CountyID = a.town');
		$this->db->where(array('a.deleted'=>0,'a.user_id'=>$user_id));
		$this->db->order_by('a.Id','DESC');
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->result();
		} else {
			return array();
		}
	}

    public function getFavorites()
    {
        $userInfo = $this->session->userdata('userInfo');
        $this->db->where(array('user_id'=>$userInfo->id));
        $q = $this->db->get('user_favorite');
        if ($q->num_rows() > 0) {
            return $q->result();
        } else {
            return false;
        }
    }

	public function getCities()
	{
		$this->db->select('CityID,CityName');
		$this->db->from('location_cities');
		$this->db->where(array('CountryID'=>212));
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->result();
		} else {
			return array();
		}
	}

	public function getCounties()
	{
		$this->db->select('*');
		$this->db->from('location_counties');
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->result();
		} else {
			return array();
		}
	}

	public function deleteAddress($delete_id,$user_id)
	{
		$this->db->select('user_id,Id');
		$this->db->from('address');
		$this->db->where(array('Id'=>$delete_id));
		$returnSecurity = $this->db->get();
		if ($returnSecurity->num_rows() > 0) {
			$returnSecurityRow = $returnSecurity->row();
			if ($returnSecurityRow->user_id == $user_id) {
				return $this->db->set(array('deleted'=>1))->where(array('Id'=>$delete_id))->update('address');
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function addDefaultAddress($id,$user_id)
	{
		$this->db->select('user_id,Id');
		$this->db->from('address');
		$this->db->where(array('Id'=>$id));
		$returnSecurity = $this->db->get();
		if ($returnSecurity->num_rows() > 0) {
			$returnSecurityRow = $returnSecurity->row();
			if ($returnSecurityRow->user_id == $user_id) {
				if ($this->db->set(array('default'=>0))->where(array('user_id'=>$user_id))->update('address')) {
					if ($this->db->set(array('default'=>1))->where(array('Id'=>$id))->update('address')) {
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
		} else {
			return false;
		}
	}

	public function getNotifications($id)
	{
		$this->db->from('notification_settings');
		$this->db->where(array('user_id'=>$id));
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->row();
		} else {
			return array();
		}
	}

	public function getIbanInformation()
	{
		$userInfo = $this->session->userdata('userInfo');
		$this->db->from('iban_list');
		$this->db->where(array('deleted'=>0,'user_id'=>$userInfo->id));
		$this->db->order_by('id','ASC');
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->result();
		} else {
			return array();
		}
	}

	public function deleteIbanInformation($id,$user_id)
	{
		$this->db->select('user_id,id');
		$this->db->from('iban_list');
		$this->db->where(array('id'=>$id));
		$ibanInformation = $this->db->get();
		if ($ibanInformation->num_rows() > 0) {
			$ibanInfo = $ibanInformation->row();
			if ($ibanInfo->user_id == $user_id) {
				return $this->db->set(array('deleted'=>1))->where(array('id'=>$id))->update('iban_list');
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function getTransferInformation()
	{
		$userInfo = $this->session->userdata('userInfo');
		$this->db->from('remittance_payment_notice');
		$this->db->where(array('deleted'=>0,'user_id'=>$userInfo->id));
		$this->db->order_by('id','DESC');
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->result();
		} else {
			return array();
		}
	}

	public function deleteTransfer($id,$user_id)
	{
		$this->db->select('user_id,id');
		$this->db->from('iban_list');
		$this->db->where(array('id'=>$id));
		$transferInformation = $this->db->get();
		if ($transferInformation->num_rows() > 0) {
			$transferInfo = $transferInformation->row();
			if ($transferInfo->user_id == $user_id) {
				return $this->db->set(array('deleted'=>1))->where(array('id'=>$id))->update('remittance_payment_notice');
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function getOrders()
    {
        $this->db->select('*,(SELECT SUM(price*count) FROM order_line WHERE order_id = orders.id) product_price');
        $this->db->where(array('paytrStatus' => 1,'user_id'=> $this->session->userdata('userInfo')->id));
        $this->db->order_by('id','DESC');
        $q = $this->db->get('orders');
        if ($q->num_rows()>0) {
            return $q->result();
        }else{
            return array();
        }
    }

    public function getOrderId($id)
    {
        $this->db->select('*,(SELECT SUM(price*count) FROM order_line WHERE order_id = orders.id) product_price');
        $this->db->where(array('paytrStatus' => 1,'user_id'=> $this->session->userdata('userInfo')->id,'id' => $id));
        $q = $this->db->get('orders');
        if ($q->num_rows()>0) {
            $order = $q->row();
            $order->address = false;
            $order->invoice_address = false;
            if ($order->address_id == $order->invoice_address_id) {
                $this->db->select('o.*
                                ,(SELECT CityName city FROM location_cities WHERE cityid = o.city) city_name
                                ,(SELECT CountyName FROM location_counties WHERE countyid = o.town) town_name');
                $this->db->where('o.id',$order->address_id);
                $q = $this->db->get('order_addresses o');
                if ($q->num_rows()>0) {
                    $address = $q->row();
                    $order->address = $address;
                    $order->invoice_address = $address;
                }
            }else{
                $this->db->select('o.*
                                ,(SELECT CityName city FROM location_cities WHERE cityid = o.city) city_name
                                ,(SELECT CountyName FROM location_counties WHERE countyid = o.town) town_name');
                $this->db->where('o.id',$order->address_id);
                $q = $this->db->get('order_addresses o');
                if ($q->num_rows()>0) {
                    $address = $q->row();
                    $order->address = $address;
                }
                $this->db->select('o.*
                                ,(SELECT CityName city FROM location_cities WHERE cityid = o.city) city_name
                                ,(SELECT CountyName FROM location_counties WHERE countyid = o.town) town_name');
                $this->db->where('o.id',$order->invoice_address_id);
                $q = $this->db->get('order_addresses o');
                if ($q->num_rows()>0) {
                    $address = $q->row();
                    $order->invoice_address = $address;
                }
            }

            $this->db->where(array('order_id' => $order->id));
            $q = $this->db->get('order_line');
            if ($q->num_rows()>0) {
                $order->lines = $q->result();
            }else{
                $order->lines = array();
            }
            return $order;
        }else{
            return false;
        }
    }

    public function getQuestions()
    {
        $userInfo = $this->session->userdata('userInfo');
        $this->db->from('questions');
        $this->db->where(array('deleted'=>0,'user_id'=>$userInfo->id));
        $this->db->order_by('id','DESC');
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            return $q->result();
        } else {
            return false;
        }
    }
}