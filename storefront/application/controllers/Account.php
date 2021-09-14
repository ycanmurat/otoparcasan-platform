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
        if ($data->accountInformation == false) {
            redirect(site_url('cikis-yap'));
        }
		$data->city = $this->AM->getCity();
		$data->town = $this->AM->getTown($data->accountInformation->city);
		$data->notification = $this->AM->getNotifications($data->userInfo->id);
		$data->tabPanel = "account";
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('account_info');
		$this->load->view('footer');
	}

	public function password()
	{
		$data = new stdClass();
		$data = $this->Global_model->getAllInsert();
		$data->tabPanel = "password";
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('account_password');
		$this->load->view('footer');
	}

	public function orders()
	{
		$data = new stdClass();
		$data = $this->Global_model->getAllInsert();
		$data->tabPanel = "orders";

        $data->orders = $this->AM->getOrders();

		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('account_orders');
		$this->load->view('footer');
	}

	public function returns()
	{
		$data = new stdClass();
		$data = $this->Global_model->getAllInsert();
		$data->tabPanel = "returns";
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('account_returns');
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
		$this->load->view('account_iban');
		$this->load->view('footer');
	}
		public function coupon()
	{
		$data = new stdClass();
		$data = $this->Global_model->getAllInsert();
		$data->tabPanel = "coupon";
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('account_coupon');
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
		$this->load->view('account_transfer');
		$this->load->view('footer');
	}

	public function questions()
	{
		$data = new stdClass();
		$data = $this->Global_model->getAllInsert();

        $data->questions = $this->AM->getQuestions();
        //prex($data->questions);
		$data->tabPanel = "questions";
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('account_product_question');
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
		$this->load->view('account_address');
		$this->load->view('footer');
	}

	public function favorite()
	{
		$data = new stdClass();
		$data = $this->Global_model->getAllInsert();

        $data->favorites = $this->AM->getFavorites();

        //prex($data->favorites);

		$data->tabPanel = "favorite";
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('account_favorite');
		$this->load->view('footer');
	}

	public function garage()
	{
		$this->load->model('Garage_model');
		$data = new stdClass();
		$data = $this->Global_model->getAllInsert();
		$data->cars = $this->Garage_model->getGarageCars();
        $this->load->model('Service_model','SM');
        $data->dat = new stdClass;
        $data->dat->types = $this->SM->getCarTypes();
		
		$data->tabPanel = "garage";
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('account_garage');
		$this->load->view('footer');
	}

    public function order_detail($id = '')
    {
        //burada kaldım veri geldi ekrana bastım view e bascam yan menüyü oraya da koymayı unutma
        $data = new stdClass();
        $data = $this->Global_model->getAllInsert();
        $data->tabPanel = "orders";

        $data->order = $this->AM->getOrderId($id);
        if ($data->order == false) {
            $this->output->set_status_header('404');
            $this->load->view('head',$data);
            $this->load->view('header');
            $this->load->view('404');
            $this->load->view('footer');
        }else{
            //prex($data->order);
            $this->load->view('head',$data);
            $this->load->view('header');
            $this->load->view('account_order_detail');
            $this->load->view('footer');
        }
    }

    public function notifications()
    {
        $data = new stdClass();
        $this->load->model('Notifications_model','NM');
        $data = $this->Global_model->getAllInsert();
        $data->notificationVerify = $this->NM->notificationVerify();
        $data->notifications = $this->NM->getNotifications();

        $this->load->view('head',$data);
        $this->load->view('header');
        $this->load->view('account_notifications');
        $this->load->view('footer');
    }

	public function deleteAddress($deleted_id = '')
	{
		if (!empty($deleted_id) && ctype_digit($deleted_id)) {
			$userInfo = $this->session->userdata('userInfo');
			if ($this->AM->deleteAddress((int)$deleted_id,$userInfo->id)) {
				redirect(site_url('hesabim/adreslerim'));
			} else {
				redirect(site_url('hesabim/adreslerim'));
			}
		} else {
			redirect(site_url('hesabim/adreslerim'));
		}
	}

	public function addDefaultAddress($id)
	{
		if (!empty($id) && ctype_digit($id)) {
			$userInfo = $this->session->userdata('userInfo');
			if ($this->AM->addDefaultAddress((int)$id,$userInfo->id)) {
				redirect(site_url('hesabim/adreslerim'));
			} else {
				redirect(site_url('hesabim/adreslerim'));
			}
		} else {
			redirect(site_url('hesabim/adreslerim'));
		}
	}

	public function deleteIbanInformation($id)
	{
		if (!empty($id) && ctype_digit($id)) {
			$userInfo = $this->session->userdata('userInfo');
			if ($this->AM->deleteIbanInformation((int)$id,$userInfo->id)) {
				redirect(site_url('hesabim/iban-bilgilerim'));
			} else {
				redirect(site_url('hesabim/iban-bilgilerim'));
			}
		} else {
			redirect(site_url('hesabim/iban-bilgilerim'));
		}
	}

	public function deleteTransfer($id)
	{
		if (!empty($id) && ctype_digit($id)) {
			$userInfo = $this->session->userdata('userInfo');
			if ($this->AM->deleteTransfer((int)$id,$userInfo->id)) {
				redirect(site_url('hesabim/havale-bildirimi'));
			} else {
				redirect(site_url('hesabim/havale-bildirimi'));
			}
		} else {
			redirect(site_url('hesabim/havale-bildirimi'));
		}
	}
	
}