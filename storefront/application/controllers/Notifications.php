<?defined('BASEPATH') OR exit('No direct script access allowed');

class Notifications extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->getUserRememberCheck();
		$this->checkUserLogin();
		$this->load->model('Notifications_model','NM');
	}

	public function index()
	{
		$data = new stdClass();
		$data = $this->Global_model->getAllInsert();
		$data->notificationVerify = $this->NM->notificationVerify();
		$data->notifications = $this->NM->getNotifications();
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('notifications');
		$this->load->view('footer');
	}	

}