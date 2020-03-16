<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
		$this->load->library('mailler');
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
		$this->form_validation->set_rules('register_password', 'Şifre', 'required|min_length[5]|max_length[250]');
		$this->form_validation->set_rules('register_password_again','Şifre Tekrar','required|min_length[5]|max_length[250]|matches[register_password]');
		if ($this->form_validation->run() == FALSE){
			$this->result->error = validation_errors();
		} else {
			$getAllPosts = $this->GetAllPosts();
			if (!empty($getAllPosts->register_phone)) {
				$getAllPosts->phone = $getAllPosts->register_phone;
			}
			$getAllPosts->token = md5(date('Y-m-d').$getAllPosts->register_name.$getAllPosts->register_password);
			$getAllPosts->name = $getAllPosts->register_name;
			$getAllPosts->surname = $getAllPosts->register_last_name;
			$getAllPosts->email = $getAllPosts->register_email;
			$getAllPosts->password = password_hash($getAllPosts->register_password, PASSWORD_DEFAULT);
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
		$this->form_validation->set_rules('phone', 'Cep Telefonu', 'required|min_length[17]|max_length[17]');
		$this->form_validation->set_rules('email', 'E-Mail Adresi', 'required|min_length[5]|max_length[250]|valid_email');
		$this->form_validation->set_rules('city', 'İl', 'required');
		$this->form_validation->set_rules('town', 'İlçe', 'required');
		$this->form_validation->set_rules('date_of_birth', 'Doğum Tarihi', 'required|min_length[10]|max_length[10]');
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
								$this->result->status = true;
								$this->result->redirect_url = site_url('Account');
							} else {
								$this->result->error = 'Şuanda İşlem Sağlayamıyoruz Lütfen Tekrar Deneyin.';
							}
						}
					} else {
						if ($this->AM->updateAccount($getAllPosts,$userInfo->id)) {
							$this->result->status = true;
							$this->result->redirect_url = site_url('Account');
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
								$this->result->status = true;
								$this->result->redirect_url = site_url('Account');
							} else {
								$this->result->error = 'Şuanda İşlem Sağlayamıyoruz Lütfen Tekrar Deneyin.';
							}
						}
					} else {
						if ($this->AM->updateAccount($getAllPosts,$userInfo->id)) {
							$this->result->status = true;
							$this->result->redirect_url = site_url('Account');
						} else {
							$this->result->error = 'Şuanda İşlem Sağlayamıyoruz Lütfen Tekrar Deneyin.';
						}
					}
				}
			} else{
				if ($this->AM->updateAccount($getAllPosts,$userInfo->id)) {
					$this->result->status = true;
					$this->result->redirect_url = site_url('Account');
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
						$this->result->redirect_url = site_url('Account/password');
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
		$this->form_validation->set_rules('definition', 'Başlık', 'required|min_length[2]|max_length[250]');
		$this->form_validation->set_rules('name', 'Ad Soyad', 'required|min_length[5]|max_length[250]');
		$this->form_validation->set_rules('gsm', 'Cep Telefonu', 'required|min_length[17]|max_length[17]');
		$this->form_validation->set_rules('post_code', 'Posta Kodu', 'required|min_length[3]|max_length[11]|numeric');
		$this->form_validation->set_rules('country', 'Ülke', 'required');
		$this->form_validation->set_rules('city', 'Şehir', 'required');
		$this->form_validation->set_rules('town', 'İlçe', 'required');
		$this->form_validation->set_rules('identity_number', 'T.C. Kimlik No', 'min_length[11]|max_length[11]|numeric');
		$this->form_validation->set_rules('content', 'Adres Bilgileri', 'required|min_length[5]');
		if ($this->form_validation->run() == FALSE){
			$this->result->error = validation_errors();
		} else {
			$getAllPosts = $this->GetAllPosts();
			$getAllPosts->user_id = $userInfo->id;
			if ($this->AM->addAddress($getAllPosts)) {
				$this->result->status = true;
				$this->result->redirect_url = site_url('Account/address');
			} else {
				$this->result->error = 'Şuanda İşlem Sağlayamıyoruz, Lütfen Daha Sonra Tekrar Deneyin.';
			}
		}
		$this->response();
	}

	public function updateAddress()
	{
		$userInfo = $this->session->userdata('userInfo');
		$this->form_validation->set_rules('definition', 'Başlık', 'required|min_length[2]|max_length[250]');
		$this->form_validation->set_rules('name', 'Ad Soyad', 'required|min_length[5]|max_length[250]');
		$this->form_validation->set_rules('gsm', 'Cep Telefonu', 'required|min_length[10]|max_length[14]');
		$this->form_validation->set_rules('post_code', 'Posta Kodu', 'required|min_length[3]|max_length[11]|numeric');
		$this->form_validation->set_rules('country', 'Ülke', 'required');
		$this->form_validation->set_rules('city', 'Şehir', 'required');
		$this->form_validation->set_rules('town', 'İlçe', 'required');
		$this->form_validation->set_rules('identity_number', 'T.C. Kimlik No', 'min_length[11]|max_length[11]|numeric');
		$this->form_validation->set_rules('content', 'Adres Bilgileri', 'required|min_length[5]');
		if ($this->form_validation->run() == FALSE){
			$this->result->error = validation_errors();
		} else {
			$getAllPosts = $this->GetAllPosts();
			$getAllPosts->user_id = $userInfo->id;
			if ($this->AM->updateAddress($getAllPosts)) {
				$this->result->status = true;
				$this->result->redirect_url = site_url('Account/address');
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
					$data->kimdenName = 'Şifrenizi Sıfırlayın';
		            $data->kime = array(array('email' => $information->resetInformation->email, 'name' => $information->resetInformation->name));
		            $data->yanitEmail = 'noreply@otoparcasan.com';
		            $data->konu =  'Şifre Sıfırlama Linki Ekte';
		            $data->icerik = 'Şifre Sıfırlama Linki <br><br> <a href='.site_url('User/password_refresh/'.$information->resetInformation->remember_key).'>Tıklayın</a>';
					/*----------- E-Mail Send -------------*/
					if($this->mailler->Send($data)){
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
						$this->result->redirect_url = site_url('User');
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
				$this->result->status = true;
				$this->result->redirect_url = site_url('Account');
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
						$this->result->status = true;
						$this->result->redirect_url = site_url('Reviews');
					} else {
						$this->result->error = 'Şuanda İşlem Sağlayamıyoruz, Lütfen Daha Sonra Tekrar Deneyin.';
					}
				} else {
					$getAllPosts->status = 0;
					$getAllPosts->seen = 0;
					if ($this->AM->reviewUpdate($getAllPosts,$userInfo->id)) {
						$this->result->status = true;
						$this->result->redirect_url = site_url('Reviews');
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
					$this->result->redirect_url = site_url('Account/iban');
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
				$this->result->redirect_url = site_url('Account/transfer');
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
				$this->result->redirect_url = site_url('Corporate/contact');
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
						$this->result->redirect_url = site_url('Corporate/destek');
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
}