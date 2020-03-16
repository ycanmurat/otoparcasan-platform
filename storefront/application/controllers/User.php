<?defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('User_model','UM');
	}

	public function index()
	{
		if (!empty($this->session->userdata('userInfo'))) {
			redirect(site_url('Home'));
		}
		$data = new stdClass();
		$data->cache_password_refresh_email = $this->session->userdata('cache_password_refresh_email');
		$this->load->view('head',$data);
		$this->load->view('login');
	}

	public function register()
	{
		if (!empty($this->session->userdata('userInfo'))) {
			redirect(site_url('Home'));
		}
		$this->load->view('head');
		$this->load->view('register');
	}

	public function forgot_password()
	{
		if (!empty($this->session->userdata('userInfo'))) {
			redirect(site_url('Home'));
		}
		$this->load->view('head');
		$this->load->view('forgot');
	}

	public function logout()
	{
		if (empty($this->session->userdata('userInfo'))) {
			redirect(site_url('Home'));
		}
		$this->session->unset_userdata('userInfo');
		delete_cookie('remember_me');
		redirect(site_url());
	}

	public function password_refresh($remember_key = '')
	{
		$data = new StdClass();
		if (!empty($remember_key) && strlen($remember_key) == 32) {
			if ($data->passwordInformation = $this->UM->getPasswordInformation($remember_key)) {
				if (getFunctionTime($data->passwordInformation->remember_added,3)) {
					$this->load->view('head',$data);
					$this->load->view('renew_password');
				} else {
					$this->load->view('head');
					$this->load->view('renew_password_false');
				}
			} else {
				$this->load->view('head');
				$this->load->view('renew_password_false');
			}
		} else {
			$this->load->view('head');
			$this->load->view('renew_password_false');
		}
	}
}