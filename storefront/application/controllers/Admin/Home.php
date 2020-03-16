<?defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->checkLogin();
		$this->load->model('Admin/Home_model');
	}
	public function index()
	{
		$data 							= new StdClass;
		$data->mainMenu 				= 'Home';
		$data->subMenu  				= 'Home';
		
		$data->getUserInfoPermission 	= $this->Home_model->getUserPermission();
		$data->getUsers    				= $this->Home_model->getUsers();
		$data->getOrders   				= $this->Home_model->getAllOrders();
		$data->getLastOrders			= $this->Home_model->getOrders();
		$data->getOrderWait				= $this->Home_model->getWaitOrders();
		$data->getCampaigns				= $this->Home_model->getAllCampaings();
		$data->getAllPrice				= $this->Home_model->getPriceAll();
		$data->getContactInfo			= $this->Home_model->getContactInfo();
		$data->getOffer 				= $this->Home_model->getOfferInfo();

		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/home', $data);
		$this->load->view('Admin/footer');
	}
}