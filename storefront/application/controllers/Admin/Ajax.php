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
		$this->load->model('Admin/Ajax_model','AM');
    }

    private function response()
    {
    	echo json_encode($this->result);
    }

	public function login()
	{
		$this->form_validation->set_rules('m_login_signin_username', 'E-Mail', 'required|min_length[5]');
		$this->form_validation->set_rules('m_login_signin_password', 'Şifre', 'required|min_length[5]');
		if ($this->form_validation->run() == FALSE){
			$this->result->error = validation_errors();
		} else {
			$getAllPosts = $this->getAllPosts();
			if (!$getAllPosts->token) {
				$this->result->error = "Token Sistemimizde Görünmüyor Lütfen Tarayıcınızı Kapatıp, Tekrar Açın";
			} else {
				$recaptcha_url = "https://www.google.com/recaptcha/api/siteverify";
				$recaptcha_secret = getenv('RECAPTCHA_SECRET');
				$verifyCatptcha = file_get_contents($recaptcha_url."?secret=".$recaptcha_secret."&response=".$getAllPosts->token."&remoteip=".$this->input->ip_address());
				$responseData = json_decode($verifyCatptcha);
				if ($responseData->score >=	0.5) {
					if ($responseData->success && $responseData->success=="true") {
						if($this->AM->login($getAllPosts)){
							$this->result->status = true;
							$this->result->redirect_url = admin_url();
						} else {
							$this->result->error = "Girdiğiniz Bilgiler, Sistemimizde Kayıtlı Değil, Lütfen Kontrol Edin.";
						}
					} else {
						$this->result->error = "Lütfen Robot Olmadığınızı, Onaylayıp Tekrar Deneyin.";
					}
				} else {
					$this->result->captcha_error = true;
				}
			}
		}
		$this->response();
	}
}