<?defined('BASEPATH') OR exit('No direct script access allowed');

class Basket extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->getUserRememberCheck();
	}

	public function index()
	{
		$data = new stdClass();
		$data = $this->Global_model->getAllInsert();
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('cart');
		$this->load->view('footer');
	}	
	
	public function address()
	{
		//Sadece Head çekilecek Header Çekilmeyecek
		$data = new stdClass();
		$data = $this->Global_model->getAllInsert();
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('cart_address');
		$this->load->view('footer');
	}

	public function pay()
	{
		//Sadece Head çekilecek Header Çekilmeyecek
		$data = new stdClass();
		$data = $this->Global_model->getAllInsert();
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('cart_pay');
		$this->load->view('footer');
	}

	public function success()
	{
		//Sadece Head çekilecek Header Çekilmeyecek
		$data = new stdClass();
		$data = $this->Global_model->getAllInsert();
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('cart_success');
		$this->load->view('footer');
	}
}