<?php 
/**
* Login Module Build By Patates Kızartması
*/
class Login extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Admin/Login_model');
	}

	public function index()
	{
		$this->form_validation->set_rules('user_mail', 'E-Mail', 'required|min_length[5]|valid_email');
		$this->form_validation->set_rules('password', 'Şifre', 'required|min_length[5]');
		if (!$this->form_validation->run() == FALSE){
			$getAllPosts = $this->getAllPosts();
			$postUrl = "https://www.google.com/recaptcha/api/siteverify";
			$secretCode = getenv('RECAPTCHA_SECRET');
			$response = file_get_contents($postUrl."?secret=".$secretCode."&response=".$getAllPosts->{'g-recaptcha-response'}."&remoteip=".$_SERVER['REMOTE_ADDR']);
			$responseInformation = json_decode($response);
			if ($responseInformation->success && $responseInformation->success == "true") {
				if($this->Login_model->SetLogin($getAllPosts->user_mail,$getAllPosts->password)){
					redirect(site_url('Admin'));
				} else {
					$this->session->set_flashdata('login_error',1);
					redirect(site_url('Admin/Login'));
				}
			} else {
				$this->session->set_flashdata('captcha_error',1);
				redirect(site_url('Admin/Login'));
			}
		}
		$this->load->view('Admin/login');
	}
}