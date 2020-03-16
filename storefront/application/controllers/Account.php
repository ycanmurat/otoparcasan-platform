<?defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Account_model','AM');
		$this->getUserRememberCheck();
		$this->checkUserLogin();
	}

	public function index()
	{
		$data = new stdClass();
		$data = $this->Global_model->getAllInsert();
		$data->accountInformation = $this->AM->getAccountInformation($data->userInfo->id);
		$data->city = $this->AM->getCity();
		$data->town = $this->AM->getTown($data->accountInformation->city);
		$data->notification = $this->AM->getNotifications($data->userInfo->id);
		$data->tabPanel = "account";
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('account');
		$this->load->view('footer');
	}

	public function password()
	{
		$data = new stdClass();
		$data = $this->Global_model->getAllInsert();
		$data->tabPanel = "password";
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('password');
		$this->load->view('footer');
	}

	public function orders()
	{
		$data = new stdClass();
		$data = $this->Global_model->getAllInsert();
		$data->tabPanel = "orders";
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('orders');
		$this->load->view('footer');
	}

	public function returns()
	{
		$data = new stdClass();
		$data = $this->Global_model->getAllInsert();
		$data->tabPanel = "returns";
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('returns');
		$this->load->view('footer');
	}

	public function iban()
	{
		$data = new stdClass();
		$data = $this->Global_model->getAllInsert();
		$data->tabPanel = "iban";
		$data->ibanInformation = $this->AM->getIbanInformation();
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('iban');
		$this->load->view('footer');
	}
		public function coupon()
	{
		$data = new stdClass();
		$data = $this->Global_model->getAllInsert();
		$data->tabPanel = "coupon";
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('coupon');
		$this->load->view('footer');
	}

	public function transfer()
	{
		$data = new stdClass();
		$data = $this->Global_model->getAllInsert();
		$data->tabPanel = "transfer";
		$data->transferInformation = $this->AM->getTransferInformation();
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('transfer');
		$this->load->view('footer');
	}

	public function questions()
	{
		$data = new stdClass();
		$data = $this->Global_model->getAllInsert();
		$data->tabPanel = "questions";
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('product_question');
		$this->load->view('footer');
	}


	public function address()
	{
		$data = new stdClass();
		$data = $this->Global_model->getAllInsert();
		$data->country = $this->AM->getCountries();
		$data->address = $this->AM->getUserByAddress($data->userInfo->id);
		$data->cities = $this->AM->getCities();
		$data->counties = $this->AM->getCounties();
		$data->tabPanel = "address";
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('address');
		$this->load->view('footer');
	}

	public function favorite()
	{
		$data = new stdClass();
		$data = $this->Global_model->getAllInsert();
		$data->tabPanel = "favorite";
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('favorites');
		$this->load->view('footer');
	}

	public function garage()
	{
		$this->load->model('Garage_model');
		$data = new stdClass();
		$data = $this->Global_model->getAllInsert();
		$data->cars = $this->Garage_model->getGarageCars();

		//prex($data->cars);

		if ($data->cars != false) {
			foreach ($data->cars as $key => $val) {
				$data->cars[$key]->image = $this->Garage_model->getCarImage($val->detail->Vehicle->VehicleType,$val->detail->Vehicle->Manufacturer,$val->detail->Vehicle->BaseModel);
			}
		}

		//prex($data->cars);
		
		$data->tabPanel = "garage";
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('garage');
		$this->load->view('footer');
	}

	public function deleteAddress($deleted_id = '')
	{
		if (!empty($deleted_id) && ctype_digit($deleted_id)) {
			$userInfo = $this->session->userdata('userInfo');
			if ($this->AM->deleteAddress((int)$deleted_id,$userInfo->id)) {
				redirect(site_url('Account/address'));
			} else {
				redirect(site_url('Account/address'));
			}
		} else {
			redirect(site_url('Account/address'));
		}
	}

	public function addDefaultAddress($id)
	{
		if (!empty($id) && ctype_digit($id)) {
			$userInfo = $this->session->userdata('userInfo');
			if ($this->AM->addDefaultAddress((int)$id,$userInfo->id)) {
				redirect(site_url('Account/address'));
			} else {
				redirect(site_url('Account/address'));
			}
		} else {
			redirect(site_url('Account/address'));
		}
	}

	public function deleteIbanInformation($id)
	{
		if (!empty($id) && ctype_digit($id)) {
			$userInfo = $this->session->userdata('userInfo');
			if ($this->AM->deleteIbanInformation((int)$id,$userInfo->id)) {
				redirect(site_url('Account/iban'));
			} else {
				redirect(site_url('Account/iban'));
			}
		} else {
			redirect(site_url('Account/iban'));
		}
	}

	public function deleteTransfer($id)
	{
		if (!empty($id) && ctype_digit($id)) {
			$userInfo = $this->session->userdata('userInfo');
			if ($this->AM->deleteTransfer((int)$id,$userInfo->id)) {
				redirect(site_url('Account/transfer'));
			} else {
				redirect(site_url('Account/transfer'));
			}
		} else {
			redirect(site_url('Account/transfer'));
		}
	}
	
}