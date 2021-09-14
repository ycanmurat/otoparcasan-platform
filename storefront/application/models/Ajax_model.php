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
            if ($getAllPosts->email_permission == 1) {
                $permision = 1;
            }else{
                $permision = 0;
            }
			$notifications = array(
				'user_id' => $insert_id,
				'campaign_email' => $permision,
				'campaign_sms' => $permision,
				'basket_email' => 1,
				'cargo_sms' => 1,
				'favorites_product_email' => 1,
				'marketing_call' => $permision);
			if ($this->db->insert('notification_settings',$notifications)) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

    public function checkMailValid($mail)
    {
        $ch = curl_init();
        $curlConfig = array(
            CURLOPT_URL            => 'https://api.debounce.io/v1/?api='.getenv('DEBOUNCE_API_KEY').'&email='.$mail,
            CURLOPT_RETURNTRANSFER => true,
        );

        curl_setopt_array($ch, $curlConfig);
        $result = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($result);
        if ($result->success == 1) {
            if ($result->debounce->send_transactional == 1) {
                return true;
            }
        }
        return false;
    }

	public function login($getAllPosts)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where(array('email' => $getAllPosts->email,'deleted' => 0));
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
		$this->db->select('name,surname,email,remember_key');
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

    public function getProductRealPrice($data)
    {
        $this->load->model('Category_model','CM');
        
        $marka[] = $data->GRUP_KODU;
        $tedarik[] = $data->CARI_KOD;

        $markaTedarik = $this->CM->getMarkaTedarik($marka,$tedarik);

        foreach ($markaTedarik->marka as $key3 => $val3) {
            if ($data->GRUP_KODU == $val3->grup_kod) {
                $data->yerli = $val3->yerli;
                $data->markaImage = $val3->image;
            }
        }
        foreach ($markaTedarik->tedarikci as $key3 => $val3) {
            if ($data->CARI_KOD == $val3->cari_kod) {
                $data->kar_orani = $val3->oran;
            }
        }

        $komisyonlu = (($data->fiyatTL/100*$data->kar_orani)+$data->fiyatTL);
        $data->fiyatTL = (($komisyonlu/100*$data->KDV_ORANI)+$komisyonlu);

        $data->discount =  $this->CM->getDiscountByProduct(array('marka'=>$data->GRUP_KODU,'cari'=>$data->CARI_KOD,'ustKategori'=>$data->KOD_1,'anaKategori'=>$data->KOD_2,'altKategori'=>$data->KOD_3));
        //adet takım
        if ($data->OLCU_BR1 == 'AD') {
            $data->birimAdet = (int)$data->PAYDA_1;
        }elseif ($data->OLCU_BR1 == 'TK') {
            $data->birimAdet = (int)$data->PAY_1;
        }elseif ($data->OLCU_BR1 == 'ad') {
            $data->birimAdet = (int)$data->PAYDA_1;
        }elseif ($data->OLCU_BR1 == 'tk') {
            $data->birimAdet = (int)$data->PAY_1;
        }

        if ($data->KULL1S == 0 AND $data->KULL2N == 1 AND $data->fiyatTL > 0) {
            $data->satis = 1;
        }else{
            $data->satis = 0;
        }

        return $data;
    }

    public function getCargoPrice($price = 0)
    {
        $this->db->where('id',1);
        $q = $this->db->get('cargo');
        if ($q->num_rows()>0) {
            $q = $q->row();
            if ($price >= $q->min_price) {
                return 0;
            }else{
                return $q->price;
            }
        }else{
            return 5;
        }
    }

    public function getMinCargo()
    {
        $this->db->where('id',1);
        $q = $this->db->get('cargo');
        if ($q->num_rows()>0) {
            $q = $q->row();
            return $q->min_price;
        }else{
            return 150;
        }
    }

    public function doTempOrder($data)
    {
        $this->db->trans_start();
            $this->db->where('user_id',$data['user_id']);
            $this->db->delete('temp_orders');
            $this->db->where('user_id',$data['user_id']);
            $this->db->delete('temp_order_line');
            $this->db->set(array('user_id' => $data['user_id']
                                ,'shipping_price' => $data['cargo']
                                ,'order_note' => $data['order_note']
                                ,'check_id' => $data['giftCheck']
                                ));
            $this->db->insert('temp_orders');
            $order_id = $this->db->insert_id();

            $order_line = array();
            foreach ($data['products'] as $key => $val) {
                $order_line[] = (object)array('stok_id' => $val['stok_kodu']
                                     ,'cari_id' => $val['cari_kod']
                                     ,'name'    => $val['name']
                                     ,'price'   => $val['price']
                                     ,'user_id' => $data['user_id']
                                     ,'count'   => $val['count']
                                     ,'url'     => $val['url']
                                     ,'kod3'    => $val['kod3']
                                     ,'order_id'=> $order_id);
            }

            $this->db->insert_batch('temp_order_line',$order_line);


        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            return false;
        }else{
            $this->db->trans_commit();
            return true;
        }

    }

    public function addressRemove($id,$user_id)
    {
        $this->db->where(array('id' => $id, 'user_id' => $user_id));
        $this->db->set('deleted',1);
        $this->db->update('address');
        if ($this->db->affected_rows()>0) {
            return true;
        }else{
            return false;
        }
    }

    public function addAddressOrder($data)
    {
        $return = new StdClass;
        if ($data->invoceAddressId == 0) {
            $this->db->where(array('user_id' => $data->user_id,'id' => $data->adresId));
            $q = $this->db->get('address');
            if ($q->num_rows()>0) {
                $address = $q->row();
                unset($address->Id);
                $this->db->set($address);
                $this->db->insert('order_addresses');
                $return->address_id = $this->db->insert_id();
                $return->invoice_address_id = $return->address_id;
            }else{
                return false;
            }
        }else{
            $this->db->where(array('user_id' => $data->user_id,'id' => $data->adresId));
            $q = $this->db->get('address');
            if ($q->num_rows()>0) {
                $address = $q->row();
                unset($address->Id);
                $this->db->set($address);
                $this->db->insert('order_addresses');
                $return->address_id = $this->db->insert_id();
                    $this->db->where(array('user_id' => $data->user_id,'id' => $data->invoceAddressId));
                    $q = $this->db->get('address');
                    if ($q->num_rows()>0) {
                        $address = $q->row();
                        unset($address->Id);
                        $this->db->set($address);
                        $this->db->insert('order_addresses');
                        $return->invoice_address_id = $this->db->insert_id();
                    }else{
                        return false;
                    }
            }else{
                return false;
            }
        }

        $this->db->where(array('user_id' => $data->user_id));
        $this->db->set($return);
        $this->db->update('temp_orders');
        return true;
    }

    public function addComment($getAllPosts)
    {
    	$this->db->set($getAllPosts)->insert('comments');
    	if ($this->db->affected_rows() > 0) {
    		return true;
    	} else {
    		return false;
    	}
    }

    public function addQuestion($getAllPosts)
    {
    	$this->db->set($getAllPosts)->insert('questions');
    	if ($this->db->affected_rows() > 0) {
    		return true;
    	} else {
    		return false;
    	}
    }

    public function changeCarName($data,$user)
    {
        $this->db->where(array('user_id' => $user->id,'id'=>$data->id));
        $this->db->set(array('name' => $data->name));
        $this->db->update('user_garage');
        if ($this->db->affected_rows()>0) {
            return true;
        }else{
            return false;
        }
    }

    public function getOemFromCar($category_id,$car_id,$consTime,$oemler)
    {
        $this->load->model('Dat_model','dat');

        $this->db->select('dvn');
        $this->db->where(array('kod3' => $category_id));
        $this->db->from('datDvnKod3');
        $q = $this->db->get();
        if ($q->num_rows()>0) {
            $ary = [];
            $q = $q->result();
            foreach ($q as $key => $val) {
                if (!empty($val->dvn)) {
                    $ary[] = $val->dvn;
                }
            }

            $q = $this->dat->getOem($ary,$car_id,$consTime);
            //prex($q);
            if ($q != false) {
                if (is_array($q->Dossiers->Dossier)) {
                    foreach ($q->Dossiers->Dossier as $key => $val) {
                        if (is_array($val->SparePartPositions->SparePartPosition)) {
                            foreach ($val->SparePartPositions->SparePartPosition as $key2 => $val2) {
                                $oems[] = trim($val2->PartNumber);
                                $aciklama[trim($val2->PartNumber)] = $val2->Description;
                            }
                        }else{
                            $oems[] = trim($val->SparePartPositions->SparePartPosition->PartNumber);
                            $aciklama[trim($val->SparePartPositions->SparePartPosition->PartNumber)] = $val->SparePartPositions->SparePartPosition->Description;
                        }
                    }
                }else{
                    if (is_array($q->Dossiers->Dossier->SparePartPositions->SparePartPosition)) {
                        foreach ($q->Dossiers->Dossier->SparePartPositions->SparePartPosition as $key => $val) {
                            $oems[] = trim($val->PartNumber);
                            $aciklama[trim($val->PartNumber)] = $val->Description;
                        }
                    }else{
                        $oems[] = trim($q->Dossiers->Dossier->SparePartPositions->SparePartPosition->PartNumber);
                        $aciklama[trim($q->Dossiers->Dossier->SparePartPositions->SparePartPosition->PartNumber)] = $q->Dossiers->Dossier->SparePartPositions->SparePartPosition->Description;
                    }
                }

                function del0($val)
                {
                    if ($val[0] == '0') {
                        $val = ltrim($val, '0');
                        return $val;
                    }else{
                        return $val;
                    }
                }
                
                foreach ($oems as $key => $val) {
                    $val = str_replace(' ','',str_replace('.','',str_replace('-','',str_replace(',','', trim($val)))));
                    $oems[$key] = del0($val);
                }

                $oems = array_unique($oems);
                if (count($oems)>0) {
                    foreach ($oems as $key => $val) {
                        if (strstr($oemler, $val)) {
                            return 1;
                        }
                    }
                    return 2;
                }else{
                    return 0;
                }
            }else{
                return 0;
            }
        }else{
            return 0;
        }
    }

    public function addReminding($url,$user_id)
    {
        $this->db->where(array('product_slug' => $url
                              ,'user_id'      => $user_id));
        $q = $this->db->count_all_results('user_reminding');
        
        if ($q > 0) {
            $this->db->where(array('product_slug'     => $url
                                  ,'user_id' => $user_id));
            $this->db->delete('user_reminding');
            return 1;
        }else{
            $this->db->set(array('product_slug'     => $url
                                  ,'user_id' => $user_id));
            $this->db->insert('user_reminding');
            return 2;
        }
    }

    public function addFavorite($url,$user_id)
    {
        $this->db->where(array('product_slug'     => $url
                              ,'user_id' => $user_id));
        $q = $this->db->count_all_results('user_favorite');
        if ($q > 0) {
            $this->db->where(array('product_slug'     => $url
                                  ,'user_id' => $user_id));
            $this->db->delete('user_favorite');
            return 1;
        }else{
            $this->db->set(array('product_slug'     => $url
                                  ,'user_id' => $user_id));
            $this->db->insert('user_favorite');
            return 2;
        }
    }

    public function orderCancelByUser($id,$user_id)
    {
        $this->db->where(array('id'      => $id
                              ,'user_id' => $user_id));
        $this->db->where('order_status <',3);
        $this->db->set(array('order_status'         => 4
                            ,'order_status_inside'  => 7));

        $this->db->update('orders');
        if ($this->db->affected_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }
}