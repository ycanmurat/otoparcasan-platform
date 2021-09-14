<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Carbon\Carbon;

class Ajax extends Core_Controller 
{
	
	private $result;

	function __construct()
    {
        parent::__construct();
        header('Content-Type: application/json');
		$this->result = new StdClass();
		$this->result->status = false;
        $this->load->model('Ajax_model','AM');
        $this->load->model('Api_model','api');
    }

    private function response()
    {
    	echo json_encode($this->result);
    }

	public function register()
	{
		$loginInformation = new stdClass();
		$this->form_validation->set_rules('register_name', 'Ad', 'required|min_length[2]|max_length[60]');
		$this->form_validation->set_rules('register_last_name', 'Soyad', 'required|min_length[2]|max_length[60]');
		$this->form_validation->set_rules('register_email', 'E-Posta', 'required|min_length[5]|max_length[250]|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('register_phone', 'Cep Telefonu', 'min_length[17]|max_length[17]|is_unique[users.phone]');
        $this->form_validation->set_rules('register_phone', 'Cep Telefonu', 'required|regex_match[([0-9]{1}[ ]{1}[(]{1}[0-9]{0,4}[)]{1}[ ]{1}[0-9]{1,3}[ ]{1}[0-9]{1,2}[ ]{1}[0-9]{1}[0-9]{1})]|min_length[17]|max_length[17]');
		$this->form_validation->set_rules('register_password', 'Şifre', 'required|min_length[5]|max_length[250]');
		$this->form_validation->set_rules('register_password_again','Şifre Tekrar','required|min_length[5]|max_length[250]|matches[register_password]');
		if ($this->form_validation->run() == FALSE){
			$this->result->error = validation_errors();
		} else {
			$getAllPosts = $this->GetAllPosts();

            if ($this->AM->checkMailValid($getAllPosts->register_email)) {
                if (!empty($getAllPosts->register_phone)) {
                    $getAllPosts->phone = $getAllPosts->register_phone;
                }
                $getAllPosts->token = md5(date('Y-m-d').$getAllPosts->register_name.$getAllPosts->register_password);
                $getAllPosts->name = ucwords(strtolower($getAllPosts->register_name));
                $getAllPosts->surname = ucwords(strtolower($getAllPosts->register_last_name));
                $getAllPosts->email = $getAllPosts->register_email;
                $getAllPosts->password = password_hash($getAllPosts->register_password, PASSWORD_DEFAULT);
                $getAllPosts->added_time = Carbon::now()->setTimezone('Europe/Istanbul')->toDateTimeString();
                $getAllPosts->email_permission = $getAllPosts->campaign_notification;
                $loginInformation->email = $getAllPosts->register_email;
                $loginInformation->password = $getAllPosts->register_password;
                $loginInformation->remember_me = 1;
                unset($getAllPosts->register_name,
                        $getAllPosts->register_last_name,
                            $getAllPosts->register_email,
                                $getAllPosts->register_phone,
                                    $getAllPosts->register_password,
                                        $getAllPosts->register_password_again,
                                            $getAllPosts->membership_agreement,
                                                $getAllPosts->campaign_notification);
                if ($this->AM->addUser($getAllPosts)) {
                    if ($this->AM->login($loginInformation)) {
                        $this->result->status = true;
                        $this->result->redirect_url = site_url();
                    } else {
                        $this->result->redirect_url = site_url();
                    }
                } else{
                    $this->result->error = 'Girdiğiniz Bilgilerde Hala Sorun Var Gibi Duruyor, Lütfen Daha Sonra Tekrar Deneyin.';
                }
            }else{
                $this->result->error = '<p>Lütfen Gerçek Bir E-posta Adresi Girin</p>';
            }
		}
		$this->response();
	}

	public function login()
	{
		$this->form_validation->set_rules('login_email', 'E-Posta', 'required|min_length[8]|max_length[250]|valid_email');
		$this->form_validation->set_rules('login_password', 'Şifre', 'required|min_length[5]|max_length[250]');
		if ($this->form_validation->run() == FALSE){
			$this->result->error = validation_errors();
		} else {
			$getAllPosts = $this->GetAllPosts();
			$getAllPosts->email = $getAllPosts->login_email;
			$getAllPosts->password = $getAllPosts->login_password;
			unset($getAllPosts->login_email,$getAllPosts->login_password);
			if ($this->AM->login($getAllPosts)) {
				$this->result->status = true;
				$this->result->redirect_url = site_url();
			} else {
				$this->result->error = 'Girdiğiniz Bilgiler, Eksik Yada Yanlış Lütfen Tekrar Deneyin.';
			}
		}
		$this->response();
	}

	public function updateAccount()
	{
		$userInfo = $this->session->userdata('userInfo');
		$this->form_validation->set_rules('name', 'Adı', 'required|min_length[2]|max_length[250]');
		$this->form_validation->set_rules('surname', 'Soyadı', 'required|min_length[2]|max_length[250]');
		$this->form_validation->set_rules('email', 'E-Mail Adresi', 'required|min_length[5]|max_length[250]|valid_email');
		$this->form_validation->set_rules('city', 'İl', 'required|callback_val0');
		$this->form_validation->set_rules('town', 'İlçe', 'required|callback_val0');
        $this->form_validation->set_rules('phone', 'Cep Telefonu', 'required|regex_match[([0-9]{1}[ ]{1}[(]{1}[0-9]{0,4}[)]{1}[ ]{1}[0-9]{1,3}[ ]{1}[0-9]{1,2}[ ]{1}[0-9]{1}[0-9]{1})]|min_length[17]|max_length[17]');
		//$this->form_validation->set_rules('date_of_birth', 'Doğum Tarihi', 'required|min_length[10]|max_length[10]');
		$this->form_validation->set_rules('gender', 'Cinsiyet', 'required|min_length[5]|max_length[5]');
		if ($this->form_validation->run() == FALSE){
			$this->result->error = validation_errors();
		} else {
			$getAllPosts = $this->GetAllPosts();
			if ($userInfo->email != $getAllPosts->email) {
				if ($this->AM->emailCheck($getAllPosts->email)) {
					$this->result->error = 'Girdiğiniz E-Mail Adresi Sistemimizde Bulunuyor, Farklı Bir E-Mail Deneyin.';
				} else {
					if ($userInfo->phone != $getAllPosts->phone) {
						if ($this->AM->phoneCheck($getAllPosts->phone)) {
							$this->result->error = 'Girdiğiniz Telefon Numarası Sistemimizde Bulunuyor, Farklı Bir Telefon Deneyin.';
						} else {
							if ($this->AM->updateAccount($getAllPosts,$userInfo->id)) {
                                $this->session->set_flashdata('userAccountUpdates',1);
								$this->result->status = true;
								$this->result->redirect_url = site_url('hesabim');
							} else {
								$this->result->error = 'Şuanda İşlem Sağlayamıyoruz Lütfen Tekrar Deneyin.';
							}
						}
					} else {
						if ($this->AM->updateAccount($getAllPosts,$userInfo->id)) {
                            $this->session->set_flashdata('userAccountUpdates',1);
							$this->result->status = true;
							$this->result->redirect_url = site_url('hesabim');
						} else {
							$this->result->error = 'Şuanda İşlem Sağlayamıyoruz Lütfen Tekrar Deneyin.';
						}
					}
				}
			} else if($userInfo->phone != $getAllPosts->phone) {
				if ($this->AM->phoneCheck($getAllPosts->phone)) {
					$this->result->error = 'Girdiğiniz Telefon Numarası Sistemimizde Bulunuyor, Farklı Bir Telefon Deneyin.';
				} else {
					if ($userInfo->email != $getAllPosts->email) {
						if ($this->AM->emailCheck($getAllPosts->email)) {
							$this->result->error = 'Girdiğiniz E-Mail Adresi Sistemimizde Bulunuyor, Farklı Bir E-Mail Deneyin.';
						} else {
							if ($this->AM->updateAccount($getAllPosts,$userInfo->id)) {
                                $this->session->set_flashdata('userAccountUpdates',1);
								$this->result->status = true;
								$this->result->redirect_url = site_url('hesabim');
							} else {
								$this->result->error = 'Şuanda İşlem Sağlayamıyoruz Lütfen Tekrar Deneyin.';
							}
						}
					} else {
						if ($this->AM->updateAccount($getAllPosts,$userInfo->id)) {
                            $this->session->set_flashdata('userAccountUpdates',1);
							$this->result->status = true;
							$this->result->redirect_url = site_url('hesabim');
						} else {
							$this->result->error = 'Şuanda İşlem Sağlayamıyoruz Lütfen Tekrar Deneyin.';
						}
					}
				}
			} else{
				if ($this->AM->updateAccount($getAllPosts,$userInfo->id)) {
                    $this->session->set_flashdata('userAccountUpdates',1);
					$this->result->status = true;
					$this->result->redirect_url = site_url('hesabim');
				} else {
					$this->result->error = 'Şuanda İşlem Sağlayamıyoruz Lütfen Tekrar Deneyin.';
				}
			}
		}
		$this->response();
	}

	public function updatePassword()
	{
		$userInfo = $this->session->userdata('userInfo');
		$this->form_validation->set_rules('currentPassword', 'Mevcut Şifre', 'required|min_length[5]|max_length[250]');
		$this->form_validation->set_rules('newPassword', 'Yeni Şifre', 'required|min_length[5]|max_length[250]');
		$this->form_validation->set_rules('newPasswordRepeat', 'Yeni Şifre Tekrar', 'required|min_length[5]|max_length[250]');
		if ($this->form_validation->run() == FALSE){
			$this->result->error = validation_errors();
		} else {
			$getAllPosts = $this->GetAllPosts();
			if ($getAllPosts->newPassword == $getAllPosts->newPasswordRepeat) {
				if (password_verify($getAllPosts->currentPassword, $userInfo->password)) {
					$getAllPosts->password = password_hash($getAllPosts->newPassword, PASSWORD_DEFAULT);
					unset($getAllPosts->currentPassword,$getAllPosts->newPassword,$getAllPosts->newPasswordRepeat);
					if ($this->AM->updatePassword($getAllPosts,$userInfo->id)) {
						$this->result->status = true;
						$this->result->redirect_url = site_url('hesabim/sifre');
					} else {
						$this->result->error = 'Şuanda İşlem Sağlayamıyoruz, Lütfen Daha Sonra Tekrar Deneyin.';
					}
				} else {
					$this->result->error = 'Girdiğini Mevcut Şifre, Sistemimizdeki İle Eşleşmiyor.';
				}
			} else {
				$this->result->error = 'Girdiğiniz Yeni Şifre İle, Yeni Şifre Tekrar Eşleşmiyor.';
			}
		}
		$this->response();
	}

	public function getCitiesByCountry($countryID)
	{
		if ($responseCities = $this->AM->getCitiesByCountry($countryID)) {
			$this->result->status = true;
			$this->result->array = $responseCities;
		} else {
			$this->result->array = 'Lütfen Seçiniz';
		}
		$this->response();
	}

	public function getCountiesByCities($CityID)
	{
		if ($responseCities = $this->AM->getCountiesByCities($CityID)) {
			$this->result->status = true;
			$this->result->array = $responseCities;
		} else {
			$this->result->array = 'Lütfen Seçiniz';
		}
		$this->response();
	}

	public function getCountiesByArea($AreaID)
	{
		if ($responseAreas = $this->AM->getCountiesByArea($AreaID)) {
			$this->result->status = true;
			$this->result->array = $responseAreas;
		} else {
			$this->result->array = 'Lütfen Seçiniz';
		}
		$this->response();
	}

	public function addAddress()
	{
		$userInfo = $this->session->userdata('userInfo');
		$getAllPosts = $this->GetAllPosts();
		$this->form_validation->set_rules('definition', 'Başlık', 'required|min_length[2]|max_length[250]');
		$this->form_validation->set_rules('name', 'Ad Soyad', 'required|min_length[5]|max_length[250]');
        $this->form_validation->set_rules('gsm', 'Cep Telefonu', 'required|regex_match[([0-9]{1}[ ]{1}[(]{1}[0-9]{0,4}[)]{1}[ ]{1}[0-9]{1,3}[ ]{1}[0-9]{1,2}[ ]{1}[0-9]{1}[0-9]{1})]|min_length[17]|max_length[17]');
		$this->form_validation->set_rules('country', 'Ülke', 'required|callback_val0');
		$this->form_validation->set_rules('city', 'Şehir', 'required|callback_val0');
		$this->form_validation->set_rules('town', 'İlçe', 'required|callback_val0');
		$this->form_validation->set_rules('identity_number', 'T.C. Kimlik No', 'min_length[11]|max_length[11]|numeric');
		$this->form_validation->set_rules('content', 'Adres Bilgileri', 'required|min_length[5]');
		if (isset($getAllPosts->corporate) && $getAllPosts->corporate == 1) {
			$this->form_validation->set_rules('firm_name', 'Firma', 'required|min_length[1]|max_length[250]');
			$this->form_validation->set_rules('tax_no', 'Vergi No', 'required|min_length[10]|max_length[10]|numeric');
			$this->form_validation->set_rules('tax_admin', 'Vergi Dairesi', 'required|min_length[3]|max_length[250]');
		}
		if ($this->form_validation->run() == FALSE){
			$this->result->error = validation_errors();
		} else {
			$getAllPosts->user_id = $userInfo->id;
			if ($this->AM->addAddress($getAllPosts)) {
				$this->result->status = true;
				$this->result->redirect_url = site_url('hesabim/adreslerim');
			} else {
				$this->result->error = 'Şuanda İşlem Sağlayamıyoruz, Lütfen Daha Sonra Tekrar Deneyin.';
			}
		}
		$this->response();
	}

    public function val0($val)
    {
        if ($val < 1) {
            $this->form_validation->set_message('val0', 'İl Ve İlçe Alanları Seçilmelidir.');
            return false;
        }else{
            return true;
        }
    }

    public function genelSelect($val)
    {
        if ($val < 1) {
            $this->form_validation->set_message('genelSelect', '{field} Alanında Seçim Yapmalısınız.');
            return false;
        }else{
            return true;
        }
    }

    public function addressRemove($id)
    {
        try {
            $user_id = $this->session->userdata('userInfo')->id;
            if ($this->AM->addressRemove($id,$user_id) == false) {
                $this->result->error = 'Silme İşlemi Gerçekleştirilemedi';
            }else{
                $this->result->status = true;
            }

        } catch (Exception $e) {
            $this->result->error = 'Şuanda İşlem Sağlayamıyoruz, Lütfen Daha Sonra Tekrar Deneyin.';
        }

        $this->response();
    }

	public function updateAddress()
	{
		$userInfo = $this->session->userdata('userInfo');
		$getAllPosts = $this->GetAllPosts();
        $this->form_validation->set_rules('definition', 'Başlık', 'required|min_length[2]|max_length[250]');
        $this->form_validation->set_rules('name', 'Ad Soyad', 'required|min_length[5]|max_length[250]');
        $this->form_validation->set_rules('gsm', 'Cep Telefonu', 'required|regex_match[([0-9]{1}[ ]{1}[(]{1}[0-9]{0,4}[)]{1}[ ]{1}[0-9]{1,3}[ ]{1}[0-9]{1,2}[ ]{1}[0-9]{1}[0-9]{1})]|min_length[17]|max_length[17]');
        $this->form_validation->set_rules('country', 'Ülke', 'required|callback_val0');
        $this->form_validation->set_rules('city', 'Şehir', 'required|callback_val0');
        $this->form_validation->set_rules('town', 'İlçe', 'required|callback_val0');
        $this->form_validation->set_rules('identity_number', 'T.C. Kimlik No', 'min_length[11]|max_length[11]|numeric');
        $this->form_validation->set_rules('content', 'Adres Bilgileri', 'required|min_length[5]');
		if (isset($getAllPosts->corporate) && $getAllPosts->corporate == 1) {
			$this->form_validation->set_rules('firm_name', 'Firma', 'required|min_length[1]|max_length[250]');
			$this->form_validation->set_rules('tax_no', 'Vergi No', 'required|min_length[10]|max_length[10]|numeric');
			$this->form_validation->set_rules('tax_admin', 'Vergi Dairesi', 'required|min_length[3]|max_length[250]');
		}
		if ($this->form_validation->run() == FALSE){
			$this->result->error = validation_errors();
		} else {
			if (!isset($getAllPosts->corporate)) {
				$getAllPosts->corporate = 0;
			}
			$getAllPosts->user_id = $userInfo->id;
			if ($this->AM->updateAddress($getAllPosts)) {
				$this->result->status = true;
				$this->result->redirect_url = site_url('hesabim/adreslerim');
			} else {
				$this->result->error = 'Şuanda İşlem Sağlayamıyoruz, Lütfen Daha Sonra Tekrar Deneyin.';
			}
		}
		$this->response();
	}

	public function renewPassword()
	{
		$information = new StdClass();
		$data = new StdClass();
		$this->form_validation->set_rules('email', 'E-Posta', 'required|min_length[5]|max_length[250]|valid_email|is_similar[users.email]');
		if ($this->form_validation->run() == FALSE){
			$this->result->error = validation_errors();
		} else {
			$getAllPosts = $this->GetAllPosts();
			$updateRememberAndAdded = array(
				'remember_key' => md5(date('Y-m-d H:i:s').$getAllPosts->email.create_random_key(10)),
				'remember_added' => date('d.m.Y H:i:s')
			);
			if ($this->AM->updateRenewPassword($updateRememberAndAdded,$getAllPosts->email)) {
				if ($information->resetInformation = $this->AM->resetInformation($getAllPosts->email)) {
		            $data->to = $information->resetInformation->email;
		            $data->name =  $information->resetInformation->name.' '.$information->resetInformation->surname;
		            $data->url = site_url('sifre-yenileme/'.$information->resetInformation->remember_key);
					/*----------- E-Mail Send -------------*/
                    $this->load->library('mailgunapi');
					if($this->mailgunapi->password_ren($data)){
						$this->result->status = true;
						$this->result->redirect_url = site_url();
					} else {
						$this->result->error = 'Şuanda İşlem Sağlayamıyoruz, Lütfen Daha Sonra Tekrar Deneyin.';
					}
				} else {
					$this->result->error = 'Şuanda İşlem Sağlayamıyoruz, Lütfen Daha Sonra Tekrar Deneyin.';
				}
			} else {
				$this->result->error = 'Şuanda İşlem Sağlayamıyoruz, Lütfen Daha Sonra Tekrar Deneyin.';
			}
		}
		$this->response();
	}

	public function refreshPassword()
	{
		$this->form_validation->set_rules('email', 'E-Posta', 'required|min_length[5]|max_length[250]|valid_email|is_similar[users.email]');
		$this->form_validation->set_rules('password', 'Yeni Şifre', 'required|min_length[5]|max_length[250]');
		$this->form_validation->set_rules('password_repeat', 'Yeni Şifre Tekrar', 'required|min_length[5]|max_length[250]');
		$this->form_validation->set_rules('remember_key', 'Remember Key', 'required|min_length[32]|max_length[32]|is_similar[users.remember_key]');
		if ($this->form_validation->run() == FALSE){
			$this->result->error = validation_errors();
		} else {
			$getAllPosts = $this->GetAllPosts();
			if ($getAllPosts->password == $getAllPosts->password_repeat) {
				if ($this->AM->rememberAndMailCheck($getAllPosts->email,$getAllPosts->remember_key)) {
					$updateInformation = array(
						'remember_key' => '', 
						'remember_added' => '',
						'password' => password_hash($getAllPosts->password, PASSWORD_DEFAULT)
					);
					if ($this->AM->updateNewPassword($updateInformation,$getAllPosts->remember_key)) {
						$this->session->set_userdata('cache_password_refresh_email',$getAllPosts->email);
						$this->result->status = true;
						$this->result->redirect_url = site_url('giris-yap');
					} else {
						$this->result->error = 'Şuanda İşlem Sağlayamıyoruz, Lütfen Daha Sonra Tekrar Deneyin.';
					}
				} else {
					$this->result->error = 'Gönderdiğiniz Bilgiler Eksik Yada Yanlış Lütfen Tekrar Şifrenizi Yenileyin.';
				}
			} else {
				$this->result->error = 'Girdiğiniz Şifre İle Şifre Tekrar Eşleşmiyor.';
			}
		}
		$this->response();
	}

	public function chasisSearch()
	{
		$this->form_validation->set_rules('chasisNo', 'ŞASE NO', 'required|min_length[17]|max_length[17]');
		if ($this->form_validation->run() == FALSE){
			$this->result->error = validation_errors();
		} else {
			$getAllPosts = $this->GetAllPosts();
			$this->result->status = true;
		}
		$this->response();
	}

	public function updateNotification()
	{
		$userInfo = $this->session->userdata('userInfo');
		$this->form_validation->set_rules('campaign_email', 'Kampanyalardan E-Posta Yoluyla Haberdar Olmak istiyorum.', 'min_length[1]|max_length[1]');
		$this->form_validation->set_rules('campaign_sms', 'Kampanyalardan SMS Yoluyla Haberdar Olmak İstiyorum.', 'min_length[1]|max_length[1]');
		$this->form_validation->set_rules('basket_email', 'Sepetimdeki Ürünlerin E-Posta Yoluyla Hatırlatılmasını İstiyorum.', 'min_length[1]|max_length[1]');
		$this->form_validation->set_rules('cargo_sms', 'Kargo Bilgilerimi SMS Yoluyla Almak İstiyorum.', 'min_length[1]|max_length[1]');
		$this->form_validation->set_rules('favorites_product_email', 'İzlediğim Ürünlerle İlgili E-Posta Almak İstiyorum.', 'min_length[1]|max_length[1]');
		$this->form_validation->set_rules('marketing_call', 'Pazarlama Faaliyetlerinin Telefon Yoluyla Yapılmasını İstiyorum.', 'min_length[1]|max_length[1]');
		if ($this->form_validation->run() == FALSE){
			$this->result->error = validation_errors();
		} else {
			$getAllPosts = $this->GetAllPosts();
			if ($this->AM->updateNotification($getAllPosts,$userInfo->id)) {
                $this->session->set_flashdata('userCampaignUpdates',1);
				$this->result->status = true;
				$this->result->redirect_url = site_url('hesabim');
			} else {
				$this->result->error = 'Şuanda İşlem Sağlayamıyoruz, Lütfen Daha Sonra Tekrar Deneyin.';
			}
		}
		$this->response();
	}

	public function sendReview()
	{
		$userInfo = $this->session->userdata('userInfo');
		if (!empty($userInfo)) {
			$this->form_validation->set_rules('star', 'Yıldız', 'required|min_length[1]|max_length[1]');
			$this->form_validation->set_rules('product_quality', 'Ürün Kalitesi', 'required|min_length[1]|max_length[1]');
			$this->form_validation->set_rules('ease_of_use', 'Kullanım Kolaylığı', 'required|min_length[1]|max_length[1]');
			$this->form_validation->set_rules('fast_shipping', 'Hızlı Kargo', 'required|min_length[1]|max_length[1]');
			$this->form_validation->set_rules('price_range', 'Fiyat Aralığı', 'required|min_length[1]|max_length[1]');
			$this->form_validation->set_rules('product_packaging', 'Ürün Paketleme', 'required|min_length[1]|max_length[1]');
			$this->form_validation->set_rules('message', 'Mesaj', 'min_length[5]');
			if ($this->form_validation->run() == FALSE){
				$this->result->error = validation_errors();
			} else {
				$getAllPosts = $this->GetAllPosts();
				if ($this->AM->reviewStatus($userInfo->id)) {
					$getAllPosts->user_id = $userInfo->id;
					if ($this->AM->reviewAdd($getAllPosts)) {
                        $this->sendBildirim(4);
						$this->result->status = true;
						$this->result->redirect_url = site_url('yorumlar');
					} else {
						$this->result->error = 'Şuanda İşlem Sağlayamıyoruz, Lütfen Daha Sonra Tekrar Deneyin.';
					}
				} else {
					$getAllPosts->status = 0;
					$getAllPosts->seen = 0;
					if ($this->AM->reviewUpdate($getAllPosts,$userInfo->id)) {
                        $this->sendBildirim(4);
						$this->result->status = true;
						$this->result->redirect_url = site_url('yorumlar');
					} else {
						$this->result->error = 'Şuanda İşlem Sağlayamıyoruz, Lütfen Daha Sonra Tekrar Deneyin.';
					}
				}
			}
		} else {
			$this->result->error = 'Değerlendirme veya Yorum Yapabilmeniz İçin Lütfen Giriş Yapın.';
		}
		$this->response();
	}

	public function getBannerTime()
	{
	 	if($bannerInformation = $this->AM->getBanner()){
	 		$this->result->status = true;
	 		$this->result->information = $bannerInformation;
		} else {
			$this->result->status = false;
		} 
		$this->response();
	}
	
	public function addIbanInformation()
	{
		$userInfo = $this->session->userdata('userInfo');
		$this->form_validation->set_rules('ibanNumber', 'IBAN', 'required|min_length[25]|max_length[25]');
		$this->form_validation->set_rules('ibanNameSurname', 'Hesap Sahibi', 'required|min_length[4]|max_length[250]');
		$this->form_validation->set_rules('ibanBank', 'Banka', 'required|min_length[3]|max_length[250]');
		if ($this->form_validation->run() == FALSE){
			$this->result->error = validation_errors();
		} else {
			$getAllPosts = $this->GetAllPosts();
			$getAllPosts->user_id = $userInfo->id;
			$getAllPosts->ibanNumber = clear_empty($getAllPosts->ibanNumber);
			if (!ctype_digit($getAllPosts->ibanNumber)) {
				$this->result->error = 'Girdiğiniz İban Numarası Sadece Sayılardan Oluşmalıdır.';
			} else {
				$getAllPosts->iban = $getAllPosts->ibanNumber;
				$getAllPosts->name_surname = $getAllPosts->ibanNameSurname;
				$getAllPosts->bank = $getAllPosts->ibanBank;
				unset($getAllPosts->ibanNameSurname,
						$getAllPosts->ibanNumber,
							$getAllPosts->ibanBank);
				if ($this->AM->addIbanNumber($getAllPosts)) {
					$this->result->status = true;
					$this->result->redirect_url = site_url('hesabim/iban-bilgilerim');
				} else {
					$this->result->error = 'Şuanda İşlem Sağlayamıyoruz, Lütfen Daha Sonra Tekrar Deneyin.';
				}
			}
		}
		$this->response();
	}

	public function transferInformationAdd()
	{
		$userInfo = $this->session->userdata('userInfo');
		$this->form_validation->set_rules('transferNameSurname', 'Ad Soyad', 'required|min_length[4]|max_length[250]');
		$this->form_validation->set_rules('transferEmail', 'E-Posta', 'required|min_length[4]|max_length[250]|valid_email');
		$this->form_validation->set_rules('transferPhone', 'Telefon', 'required|min_length[17]|max_length[17]');
		$this->form_validation->set_rules('transferOrderNumber', 'Sipariş Numarası', 'required|min_length[4]|numeric');
		$this->form_validation->set_rules('transferBankId', 'Banka', 'required|min_length[1]');
		$this->form_validation->set_rules('transferAmount', 'Havale-EFT Tutarı', 'required|min_length[1]');
		$this->form_validation->set_rules('transferMessage', 'Mesajınız', 'required|min_length[5]');
		if ($this->form_validation->run() == FALSE){
			$this->result->error = validation_errors();
		} else {
			$getAllPosts = $this->GetAllPosts();
			$getAllPosts->user_id = $userInfo->id;
			$getAllPosts->name_surname = $getAllPosts->transferNameSurname;
			$getAllPosts->email = $getAllPosts->transferEmail;
			$getAllPosts->phone = $getAllPosts->transferPhone;
			$getAllPosts->order_number = $getAllPosts->transferOrderNumber;
			$getAllPosts->bank_id = $getAllPosts->transferBankId;
			$getAllPosts->amount = $getAllPosts->transferAmount;
			$getAllPosts->message = $getAllPosts->transferMessage;
			unset($getAllPosts->transferNameSurname,
					$getAllPosts->transferEmail,
						$getAllPosts->transferPhone,
							$getAllPosts->transferOrderNumber,
								$getAllPosts->transferBankId,
									$getAllPosts->transferAmount,
										$getAllPosts->transferMessage);
			if ($this->AM->addTransferInformation($getAllPosts)) {
				$this->result->status = true;
				$this->result->redirect_url = site_url('hesabim/havale-bildirimi');
			} else {
				$this->result->error = 'Şuanda İşlem Sağlayamıyoruz, Lütfen Daha Sonra Tekrar Deneyin.';
			}
		}
		$this->response();
	}

	public function modalReviewInformationAdd()
	{
		$userInfo = $this->session->userdata('userInfo');
		$this->form_validation->set_rules('deviceType', '"Cihaz Deneyimi"', 'required|min_length[1]|max_length[1]|numeric');
		$this->form_validation->set_rules('generalpageRate', 'Düşünceniz', 'required|min_length[1]|max_length[1]|numeric');
		$this->form_validation->set_rules('modalReviewMessage', 'Mesajınız', 'required|min_length[5]');
		if ($this->form_validation->run() == FALSE){
			$this->result->error = validation_errors();
		} else {
			$getAllPosts = $this->GetAllPosts();
			$getAllPosts->user_id = $userInfo->id;
			$getAllPosts->device = $getAllPosts->deviceType;
			$getAllPosts->experience = $getAllPosts->generalpageRate;
			$getAllPosts->message = $getAllPosts->modalReviewMessage;
			unset($getAllPosts->deviceType,$getAllPosts->generalpageRate,$getAllPosts->modalReviewMessage);
			if ($this->AM->addModalReviewInformation($getAllPosts)) {
				$this->result->status = true;
			} else {
				$this->result->error = 'Şuanda İşlem Sağlayamıyoruz, Lütfen Daha Sonra Tekrar Deneyin.';
			}
		}
		$this->response();
	}

	public function newsletterMailSend()
	{
		$this->form_validation->set_rules('newsletterEMail', 'E-Mail Adresiniz', 'required|min_length[4]|max_length[250]|valid_email|is_unique[bulletin.user_email]');
		if ($this->form_validation->run() == FALSE){
			$this->result->error = validation_errors();
		} else {
			$getAllPosts = $this->GetAllPosts();
			$getAllPosts->user_email = $getAllPosts->newsletterEMail;
			$getAllPosts->user_ip = $this->input->ip_address();
			unset($getAllPosts->newsletterEMail);
			if ($this->AM->addNewsletterEmail($getAllPosts)) {
				$this->result->status = true;
			} else {
				$this->result->error = 'Şuanda İşlem Sağlayamıyoruz, Lütfen Daha Sonra Tekrar Deneyin.';
			}
		}
		$this->response();		
	}

	public function getCountiesByHumanResources($CityID)
	{
		if ($responseCounties = $this->AM->getCountiesByHumanResources($CityID)) {
			$this->result->status = true;
			$this->result->array = $responseCounties;
		} else {
			$this->result->array = 'Lütfen Seçiniz';
		}
		$this->response();
	}

	public function sendContactForm()
	{
		$this->form_validation->set_rules('contactNameSurname', 'Ad Soyad', 'required|min_length[4]|max_length[250]');
		$this->form_validation->set_rules('contactMail', 'E-Posta', 'required|min_length[4]|max_length[250]|valid_email');
		$this->form_validation->set_rules('contactPhone', 'Telefon', 'required|min_length[10]|max_length[12]|numeric');
		$this->form_validation->set_rules('contactSubject', 'Konu', 'required|min_length[4]|max_length[250]');
		$this->form_validation->set_rules('contactMessage', 'Mesajınız', 'required|min_length[5]');
		if ($this->form_validation->run() == FALSE){
			$this->result->error = validation_errors();
		} else {
			$getAllPosts = $this->GetAllPosts();
			$getAllPosts->name_surname = $getAllPosts->contactNameSurname;
			$getAllPosts->email = $getAllPosts->contactMail;
			$getAllPosts->phone = $getAllPosts->contactPhone;
			$getAllPosts->Subject = $getAllPosts->contactSubject;
			$getAllPosts->message = $getAllPosts->contactMessage;
			$getAllPosts->ip_address = $this->input->ip_address();
			unset($getAllPosts->contactNameSurname,
					$getAllPosts->contactMail,
						$getAllPosts->contactPhone,
							$getAllPosts->contactSubject,
								$getAllPosts->contactMessage);
			if ($this->AM->sendContactForm($getAllPosts)) {
				$this->result->status = true;
				$this->result->redirect_url = site_url('iletisim');
			} else {
				$this->result->error = 'Şuanda İşlem Sağlayamıyoruz, Lütfen Daha Sonra Tekrar Deneyin.';
			}
		}
		$this->response();	
	}

	public function sendSupportRequests()
	{
		$userInfo = $this->session->userdata('userInfo');
		$info = new StdClass();
		$data = new StdClass();
		$this->form_validation->set_rules('supportSection', 'Bölüm', 'required|min_length[1]|max_length[2]');
		$this->form_validation->set_rules('supportSubject', 'Konu', 'required|min_length[4]|max_length[250]');
		$this->form_validation->set_rules('supportMessage', 'Mesajınız', 'required|min_length[10]');
		if ($this->form_validation->run() == FALSE){
			$this->result->error = validation_errors();
		} else {
			$getAllPosts = $this->GetAllPosts();
			$getAllPosts->user_id = $userInfo->id;
			$getAllPosts->section_id = $getAllPosts->supportSection;
			$getAllPosts->subject = $getAllPosts->supportSubject;
			$getAllPosts->message = $getAllPosts->supportMessage;
			unset($getAllPosts->supportSection,$getAllPosts->supportSubject,$getAllPosts->supportMessage);
			if ($sectionInfo = $this->AM->getSupportSection($getAllPosts->section_id)) {
				$data->kimdenName = 'Yeni Destek Talebi';
	            $data->kime = array(array('email' => $sectionInfo->email, 'name' => $sectionInfo->title));
	            $data->yanitEmail = 'noreply@otoparcasan.com';
	            $data->konu =  'Yeni Destek Talebi';
	            $data->icerik = 'Talebin Ulaşacağı Bölüm : '.$sectionInfo->title.'
	            				<br><br>
	            				Talebin Konusu : '.$getAllPosts->subject.'
	            				<br><br>
	            				İçerik : 
	            				<br><br>
	            				'.$getAllPosts->message;
				if ($this->mailler->Send($data)) {
					if ($this->AM->sendSupportRequest($getAllPosts)) {
						$this->result->status = true;
						$this->result->redirect_url = site_url('iletisim');
					} else {
						$this->result->error = 'Şuanda İşlem Sağlayamıyoruz, Lütfen Daha Sonra Tekrar Deneyin.';
					}
				} else {
					$this->result->error = 'Şuanda İşlem Sağlayamıyoruz, Lütfen Daha Sonra Tekrar Deneyin.';
				}
			} else {
				$this->result->error = 'Şuanda İşlem Sağlayamıyoruz, Lütfen Daha Sonra Tekrar Deneyin.';
			}
			
		}
		$this->response();	
	}

    public function addToCart()
    {
        //prex(1);
        $data = $this->getAllPosts();
        $return = $this->api->issetProduduct($data);
        //prex($return);
        if ($return === 0) {
            $this->result->error = 'Ürün Stokta Olmadığından Sepete Eklenemedi';
        }else{
            $return = $this->AM->getProductRealPrice($return);

            $this->result->product  = array('stok_kodu' => $return->STOK_KODU
                ,'name'     => mb_ucwords(replaceStringProblemsReverse($return->marka.' '.$return->montaj.' '.$return->STOK_ADI),'UTF-8')
                ,'cari_kod' => $return->CARI_KOD, 'url' => $return->url
                ,'oldPrice' => number_format($return->fiyatTL,2)
                ,'price'    => number_format($return->fiyatTL-($return->fiyatTL*$return->discount/100),2)
                ,'birimAdet'=> $return->birimAdet
                ,'count'    => $data->count
                ,'kod3'     => $return->KOD_3
            );
            $this->result->status   = 1;
        }
        $this->response();
    }

    public function getToCart()
    {
        if ($this->input->post('data')) {
            $data = $this->input->post('data',true);
            $data = $this->api->refreshCart($data);
            $price = 0;
            foreach ($data as $key => $return) {
                $return = $this->AM->getProductRealPrice($return);
                //prex($return);
                $p = $return->fiyatTL-($return->fiyatTL*$return->discount/100);
                $data[$key] = array('stok_kodu' => $return->STOK_KODU
                    ,'name'     => mb_ucwords(replaceStringProblemsReverse($return->marka.' '.$return->montaj.' '.$return->STOK_ADI),'UTF-8')
                    ,'cari_kod' => $return->CARI_KOD, 'url' => $return->url
                    ,'oldPrice' => number_format($return->fiyatTL,2)
                    ,'price'    => number_format($p,2)
                    ,'birimAdet'    => $return->birimAdet
                    ,'count'    => $return->count
                    ,'artis'    => $return->birimAdet
                    ,'kod3'     => $return->KOD_3
                    ,'status'   => $return->satis);
                $price += ($return->count*$p);
            }

            $this->result->cargo = $this->AM->getCargoPrice($price);
            $this->result->minCargo = $this->AM->getMinCargo();

            $this->result->data = $data;
            $this->result->status = 1;
        }
        $this->response();
    }

    public function goToAdress()
    {
        $sess = $this->session->userdata('userInfo');
        if (!isset($sess) || trim($sess == '') ) {
            $this->result->message = 'Bu İşlem İçin Üye Girişi Yapmalısınız';
            $this->result->errCode = 2;
        }else{
            $data = $this->input->post('data',true);
            $data['giftCheck'] = $this->input->post('giftCheck',true);
            $data['order_note'] = $this->input->post('order_note',true);
            $data['user_id'] = $this->session->userdata('userInfo')->id;
            if ($this->AM->doTempOrder($data)) {
                $this->result->status = 1;
            }else{
                $this->result->message = 'Teknik Aksaklıklar nedeni ile işlem gerçekleştirilemiyor';
                $this->result->errCode = 3;
            }
        }
        $this->response();
    }

    public function goToCardPage($adresId,$invoceAddressId)
    {
        $sess = $this->session->userdata('userInfo');
        if (!isset($sess) || trim($sess == '') ) {
            $this->result->message = 'Bu İşlem İçin Üye Girişi Yapmalısınız';
            $this->result->errCode = 2;
        }else{
            $data = new StdClass;
            $data->user_id          = $this->session->userdata('userInfo')->id;
            $data->adresId          = $adresId;
            $data->invoceAddressId  = $invoceAddressId;

            if ($this->AM->addAddressOrder($data)) {
                $this->load->model('Cart_model','CM');
                if ($this->CM->doRealOrder($this->session->userdata('userInfo')->id)) {
                    $this->result->status = 1;
                }else{
                    $this->result->message = 'Teknik Aksaklıklar nedeni ile işlem gerçekleştirilemiyor';
                    $this->result->errCode = 3;
                }
            }else{
                $this->result->message = 'Teknik Aksaklıklar nedeni ile işlem gerçekleştirilemiyor';
                $this->result->errCode = 3;
            }
        }
        $this->response();
    }

    public function commentAdd()
    {
    	$userInfo = $this->session->userdata('userInfo');
    	if (!empty($userInfo)) {
    		$this->form_validation->set_rules('comment', 'Yorum', 'required|min_length[3]');
			$this->form_validation->set_rules('slug', 'Ürün Bilgisi', 'required|min_length[3]|max_length[250]');
			if ($this->form_validation->run() == FALSE){
				$this->result->error = validation_errors();
			} else {
				$getAllPosts = $this->GetAllPosts();
				$getAllPosts->user_id = $userInfo->id;
				$getAllPosts->added_time = Carbon::now()->setTimezone('Europe/Istanbul')->toDateTimeString();
				if ($this->AM->addComment($getAllPosts)) {
					$this->result->status = true;
                    $this->sendBildirim(2);
				} else {
					$this->result->error = 'Yorum Yapma İsteğinize Şuan Cevap Veremiyoruz, Lütfen Daha Sonra Tekrar Deneyin';
				}
			}
    	} else {
    		$this->result->error = 'Lütfen Giriş Yaptıktan Sonra Yorum Yapmayı Deneyin';
    	}
		$this->response();
    }

    public function questionAdd()
    {
    	$userInfo = $this->session->userdata('userInfo');
    	if (!empty($userInfo)) {
    		$this->form_validation->set_rules('question', 'Soru', 'required|min_length[3]');
			$this->form_validation->set_rules('slug', 'Ürün Bilgisi', 'required|min_length[3]|max_length[250]');
            $this->form_validation->set_rules('question_category','Soru Kategorisi','required|callback_genelSelect');
			if ($this->form_validation->run() == FALSE){
				$this->result->error = validation_errors();
			}else{
				$getAllPosts = $this->GetAllPosts();
				$getAllPosts->user_id = $userInfo->id;
				$getAllPosts->added_time = Carbon::now()->setTimezone('Europe/Istanbul')->toDateTimeString();
				if ($this->AM->addQuestion($getAllPosts)) {
					$this->result->status = true;
                    $this->sendBildirim(1);
				}else{
					$this->result->error = 'Soru Sorma İsteğinize Şuan Cevap Veremiyoruz, Lütfen Daha Sonra Tekrar Deneyin';
				}
			}
    	} else {
    		$this->result->error = 'Lütfen Giriş Yaptıktan Sonra Soru Sormayı Deneyin';
    	}
		$this->response();
    }

    public function changeCarNameOnGaragge()
    {
        $userInfo = $this->session->userdata('userInfo');
        if (!empty($userInfo)) {
            $data = $this->getAllPosts();
            if ($this->AM->changeCarName($data,$userInfo)) {
                $this->result->status = 1;
            }else{
                $this->result->error = 'Kayıt Sırasında Hata Oluştu';
            }
        } else {
            $this->result->error = 'Araç size Ait Görünmüyor.';
        }
        $this->response();
    }

    public function getSearchPage($page)
    {
        $data = new StdClass;
        $this->load->model('Category_model','CM');
        $data->filterData = $this->getAllPosts();
        $data->filterData->p = $page;

        if (!isset($data->filterData->y)) {
            $data->filterData->y = array();
        }

        if (!isset($data->filterData->m)) {
            $data->filterData->m = array();
        }

        if (!isset($data->filterData->k)) {
            $data->filterData->k = array();
        }

        $products = $this->api->getProductsSearch($data->filterData);
        $data->products = $products;

        $marka = [];
        $tedarik = [];
        foreach ($data->products as $key => $val) {
            $marka[] = $val->GRUP_KODU;
            $tedarik[] = $val->CARI_KOD;
        }

        if ($marka != array() AND $tedarik != array()) {
            $markaTedarik = $this->CM->getMarkaTedarik(array_unique($marka),array_unique($tedarik));

            foreach ($data->products as $key => $val) {
                $i = 0;
                foreach ($markaTedarik->marka as $key3 => $val3) {
                    if ($val->GRUP_KODU == $val3->grup_kod) {
                        $data->products[$key]->yerli = $val3->yerli;
                        $data->products[$key]->markaImage = $val3->image;
                        $i++;
                    }
                }
                if ($i == 0) {
                        $data->products[$key]->yerli = 0;
                        $data->products[$key]->markaImage = '';
                }
                $i = 0;
                foreach ($markaTedarik->tedarikci as $key3 => $val3) {
                    if ($val->CARI_KOD == $val3->cari_kod) {
                        $data->products[$key]->kar_orani = $val3->oran;
                        $i++;
                    }
                }
                if ($i == 0) {
                    $data->products[$key]->kar_orani = 50;
                }
            }


            foreach ($data->products as $key => $val) {
                if (empty($val->KULL2S)) {
                    $data->products[$key]->teslimatGun = 5;
                    $teslimat = 5;
                }else{
                    if ($val->KULL2S == $val->hKULL1S) {
                        $data->products[$key]->teslimatGun = (int)$val->hKULL1N;
                        $teslimat = (int)$val->hKULL1N;
                    }elseif ($val->KULL2S == $val->hKULL2S) {
                        $data->products[$key]->teslimatGun = (int)$val->hKULL2N;
                        $teslimat = (int)$val->hKULL2N;
                    }elseif ($val->KULL2S == $val->hKULL3S) {
                        $data->products[$key]->teslimatGun = (int)$val->hKULL3N;
                        $teslimat = (int)$val->hKULL3N;
                    }elseif ($val->KULL2S == $val->hKULL4S) {
                        $data->products[$key]->teslimatGun = (int)$val->hKULL4N;
                        $teslimat = (int)$val->hKULL4N;
                    }elseif ($val->KULL2S == $val->hKULL5S) {
                        $data->products[$key]->teslimatGun = (int)$val->hKULL5N;
                        $teslimat = (int)$val->hKULL5N;
                    }elseif ($val->KULL2S == $val->hKULL6S) {
                        $data->products[$key]->teslimatGun = (int)$val->hKULL6N;
                        $teslimat = (int)$val->hKULL6N;
                    }elseif ($val->KULL2S == $val->hKULL7S) {
                        $data->products[$key]->teslimatGun = (int)$val->hKULL7N;
                        $teslimat = (int)$val->hKULL7N;
                    }elseif ($val->KULL2S == $val->hKULL8S) {
                        $data->products[$key]->teslimatGun = (int)$val->hKULL8N;
                        $teslimat = (int)$val->hKULL8N;
                    }else{
                        $data->products[$key]->teslimatGun = 5;
                        $teslimat = 99;
                    }
                }
                
                if (date('H')+3 >= 14) {
                    $teslimat++;
                }
                
                $data->products[$key]->kargoGunu = $this->CM->getTelimatDate($teslimat);

                //adet takım
                if ($val->OLCU_BR1 == 'AD') {
                    $data->products[$key]->birimAdet = (int)$val->PAYDA_1;
                }elseif ($val->OLCU_BR1 == 'TK') {
                    $data->products[$key]->birimAdet = (int)$val->PAY_1;
                }elseif ($val->OLCU_BR1 == 'ad') {
                    $data->products[$key]->birimAdet = (int)$val->PAYDA_1;
                }elseif ($val->OLCU_BR1 == 'tk') {
                    $data->products[$key]->birimAdet = (int)$val->PAY_1;
                }

                //indirim
                $data->products[$key]->discount =  $this->CM->getDiscountByProduct(array('marka'=>$val->GRUP_KODU,'cari'=>$val->CARI_KOD,'ustKategori'=>$val->KOD_1,'anaKategori'=>$val->KOD_2,'altKategori'=>$val->KOD_3));


                //yorum yıldız
                $data->products[$key]->comments = $this->CM->getStars($val->url);
            }

            //fiyat
            foreach ($data->products as $key => $val) {
                $komisyonlu = (($val->fiyatTL/100*$val->kar_orani)+$val->fiyatTL);
                $data->products[$key]->fiyatTL = (($komisyonlu/100*$val->KDV_ORANI)+$komisyonlu);
            }

            if ($data->filterData->o == 'p') {
                $var = array();
                $yok = array();
                foreach ($data->products as $key => $val) {
                    if ($val->stok > 0) {
                        $var[] = $val;
                    }else{
                        $yok[] = $val;
                    }
                }

                usort($var, function($a, $b) {
                    return $a->fiyatTL <=> $b->fiyatTL;
                });
                usort($yok, function($a, $b) {
                    return $a->fiyatTL <=> $b->fiyatTL;
                });

                $data->products = array_merge($var,$yok);
            }else{
                $var = array();
                $yok = array();

                foreach ($data->products as $key => $val) {
                    if ($val->stok == 1) {
                        $var[$val->teslimatGun][] = $val;
                    }else{
                        $yok[] = $val;
                    }
                }
                ksort($var);

                foreach ($var as $key2 => $val2) {
                    usort($val2, function($a, $b) {
                        return $a->fiyatTL <=> $b->fiyatTL;
                    });
                    $var[$key2] = $val2;
                }

                $aryNew = array();
                foreach ($var as $key2 => $val2) {
                    foreach ($val2 as $key3 => $val3) {
                        $aryNew[] = $val3;
                    }
                }

                usort($yok, function($a, $b) {
                    return $a->fiyatTL <=> $b->fiyatTL;
                });

                $data->products = array_merge($aryNew,$yok);
            }

            foreach ($data->products as $key => $val) {
                if (trim($val->STOK_KODU) == trim($data->filterData->s)) {
                    $tempArray = $val;
                    unset($data->products[$key]);
                    array_unshift($data->products,$tempArray);
                }
            }
        }

        $data->products = array_values($data->products);
        foreach ($data->products as $key => $val) {
            $data->products[$key]->STOK_ADI = mb_ucwords(replaceStringProblemsReverse($val->STOK_ADI),'UTF-8');
            $data->products[$key]->montaj   = mb_ucwords(replaceStringProblemsReverse($val->montaj),'UTF-8');
            $data->products[$key]->newPrice = number_format($val->fiyatTL-($val->fiyatTL*$val->discount/100),2,',','.');
            $data->products[$key]->oldPrice = number_format($val->fiyatTL,2,',','.');
        }


        $this->result->data = $data->products;
        $this->result->status = true;
        $this->response();
    }

    public function getListingPage($page)
    {
        $data = new StdClass;
        $this->load->model('Category_model','CM');
        $filterData = $this->getAllPosts();

        $kod3 = $filterData->kod3;
        $data->filterData = (object)$filterData->filter;
        $data->filterData->p = $page;


        if (!isset($data->filterData->y)) {
            $data->filterData->y = array();
        }

        if (!isset($data->filterData->m)) {
            $data->filterData->m = array();
        }

        $data->products = $this->api->getProductsByKod3Filter($kod3,$data->filterData);

        $marka = [];
        $tedarik = [];
        foreach ($data->products as $key => $val) {
            $marka[] = $val->GRUP_KODU;
            $tedarik[] = $val->CARI_KOD;
        }

        if ($marka != array() AND $tedarik != array()) {
            $markaTedarik = $this->CM->getMarkaTedarik(array_unique($marka),array_unique($tedarik));

            foreach ($data->products as $key => $val) {
                $i = 0;
                foreach ($markaTedarik->marka as $key3 => $val3) {
                    if ($val->GRUP_KODU == $val3->grup_kod) {
                        $data->products[$key]->yerli = $val3->yerli;
                        $data->products[$key]->markaImage = $val3->image;
                        $i++;
                    }
                }
                if ($i == 0) {
                        $data->products[$key]->yerli = 0;
                        $data->products[$key]->markaImage = '';
                }
                $i = 0;
                foreach ($markaTedarik->tedarikci as $key3 => $val3) {
                    if ($val->CARI_KOD == $val3->cari_kod) {
                        $data->products[$key]->kar_orani = $val3->oran;
                        $i++;
                    }
                }
                if ($i == 0) {
                    $data->products[$key]->kar_orani = 50;
                }
            }


            foreach ($data->products as $key => $val) {
                if (empty($val->KULL2S)) {
                    $data->products[$key]->teslimatGun = 5;
                    $teslimat = 5;
                }else{
                    if ($val->KULL2S == $val->hKULL1S) {
                        $data->products[$key]->teslimatGun = (int)$val->hKULL1N;
                        $teslimat = (int)$val->hKULL1N;
                    }elseif ($val->KULL2S == $val->hKULL2S) {
                        $data->products[$key]->teslimatGun = (int)$val->hKULL2N;
                        $teslimat = (int)$val->hKULL2N;
                    }elseif ($val->KULL2S == $val->hKULL3S) {
                        $data->products[$key]->teslimatGun = (int)$val->hKULL3N;
                        $teslimat = (int)$val->hKULL3N;
                    }elseif ($val->KULL2S == $val->hKULL4S) {
                        $data->products[$key]->teslimatGun = (int)$val->hKULL4N;
                        $teslimat = (int)$val->hKULL4N;
                    }elseif ($val->KULL2S == $val->hKULL5S) {
                        $data->products[$key]->teslimatGun = (int)$val->hKULL5N;
                        $teslimat = (int)$val->hKULL5N;
                    }elseif ($val->KULL2S == $val->hKULL6S) {
                        $data->products[$key]->teslimatGun = (int)$val->hKULL6N;
                        $teslimat = (int)$val->hKULL6N;
                    }elseif ($val->KULL2S == $val->hKULL7S) {
                        $data->products[$key]->teslimatGun = (int)$val->hKULL7N;
                        $teslimat = (int)$val->hKULL7N;
                    }elseif ($val->KULL2S == $val->hKULL8S) {
                        $data->products[$key]->teslimatGun = (int)$val->hKULL8N;
                        $teslimat = (int)$val->hKULL8N;
                    }else{
                        $data->products[$key]->teslimatGun = 5;
                        $teslimat = 99;
                    }
                }
                
                if (date('H')+3 >= 14) {
                    $teslimat++;
                }
                
                $data->products[$key]->kargoGunu = $this->CM->getTelimatDate($teslimat);

                //adet takım
                if ($val->OLCU_BR1 == 'AD') {
                    $data->products[$key]->birimAdet = (int)$val->PAYDA_1;
                }elseif ($val->OLCU_BR1 == 'TK') {
                    $data->products[$key]->birimAdet = (int)$val->PAY_1;
                }elseif ($val->OLCU_BR1 == 'ad') {
                    $data->products[$key]->birimAdet = (int)$val->PAYDA_1;
                }elseif ($val->OLCU_BR1 == 'tk') {
                    $data->products[$key]->birimAdet = (int)$val->PAY_1;
                }

                //indirim
                $data->products[$key]->discount =  $this->CM->getDiscountByProduct(array('marka'=>$val->GRUP_KODU,'cari'=>$val->CARI_KOD,'ustKategori'=>$val->KOD_1,'anaKategori'=>$val->KOD_2,'altKategori'=>$val->KOD_3));

                //yorum yıldız
                $data->products[$key]->comments = $this->CM->getStars($val->url);
            }

            //fiyat
            foreach ($data->products as $key => $val) {
                $komisyonlu = (($val->fiyatTL/100*$val->kar_orani)+$val->fiyatTL);
                $data->products[$key]->fiyatTL = (($komisyonlu/100*$val->KDV_ORANI)+$komisyonlu);
            }

            if ($data->filterData->o == 'p') {
                $var = array();
                $yok = array();
                foreach ($data->products as $key => $val) {
                    if ($val->stok > 0) {
                        $var[] = $val;
                    }else{
                        $yok[] = $val;
                    }
                }

                usort($var, function($a, $b) {
                    return $a->fiyatTL <=> $b->fiyatTL;
                });
                usort($yok, function($a, $b) {
                    return $a->fiyatTL <=> $b->fiyatTL;
                });

                $data->products = array_merge($var,$yok);
            }else{
                $var = array();
                $yok = array();

                foreach ($data->products as $key => $val) {
                    if ($val->stok == 1) {
                        $var[$val->teslimatGun][] = $val;
                    }else{
                        $yok[] = $val;
                    }
                }
                ksort($var);

                foreach ($var as $key2 => $val2) {
                    usort($val2, function($a, $b) {
                        return $a->fiyatTL <=> $b->fiyatTL;
                    });
                    $var[$key2] = $val2;
                }

                $aryNew = array();
                foreach ($var as $key2 => $val2) {
                    foreach ($val2 as $key3 => $val3) {
                        $aryNew[] = $val3;
                    }
                }

                usort($yok, function($a, $b) {
                    return $a->fiyatTL <=> $b->fiyatTL;
                });

                $data->products = array_merge($aryNew,$yok);
            }
        }

        $data->products = array_values($data->products);
        foreach ($data->products as $key => $val) {
            $data->products[$key]->STOK_ADI = mb_ucwords(replaceStringProblemsReverse($val->STOK_ADI),'UTF-8');
            $data->products[$key]->montaj   = mb_ucwords(replaceStringProblemsReverse($val->montaj),'UTF-8');
            $data->products[$key]->newPrice = number_format($val->fiyatTL-($val->fiyatTL*$val->discount/100),2,',','.');
            $data->products[$key]->oldPrice = number_format($val->fiyatTL,2,',','.');
        }


        $this->result->data = $data->products;
        $this->result->status = true;
        $this->response();
    }

    public function getOemFromCar()
    {
        if ($this->input->post('key')) {
            $data = json_decode($this->input->post('key'));
            $this->result->data = $this->AM->getOemFromCar($data->category_id,$data->car_id,$data->consTime,$data->oemler);
            $this->result->status = true;
        }
        $this->response();
    }

    public function addFavorite()
    {
        if ($this->input->post('url')) {
            $data = $this->input->post('url');

            $userInfo = $this->session->userdata('userInfo');
            if (!empty($userInfo)) {
                $fvRt = $this->AM->addFavorite($data,$userInfo->id);
                if ($fvRt == 1) {
                    $this->result->status = 1;
                    $this->result->error = 0;
                }else{
                    $this->result->status = 2;
                    $this->result->error = 0;
                }
            } else {
                $this->result->error = 2;
            }
        }else{
            $this->result->error = 1;
        }
        $this->response();
    }

    public function addReminding()
    {
        if ($this->input->post('url')) {
            $data = $this->input->post('url');

            $userInfo = $this->session->userdata('userInfo');
            if (!empty($userInfo)) {
                $fvRt = $this->AM->addReminding($data,$userInfo->id);
                if ($fvRt == 1) {
                    $this->result->status = 1;
                    $this->result->error = 0;
                }else{
                    $this->result->status = 2;
                    $this->result->error = 0;
                }
            } else {
                $this->result->error = 2;
            }
        }else{
            $this->result->error = 1;
        }
        $this->response();
    }

    public function cancelOrder($id)
    {
        $userInfo = $this->session->userdata('userInfo');
        if (!empty($userInfo)) {
            if ($this->AM->orderCancelByUser($id,$userInfo->id)) {
                $this->result->status = true;
            }else{
                $this->result->status = false;
            }
        }else{
            $this->result->status = false;
        }

        $this->response();
    }
}