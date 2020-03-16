<?defined('BASEPATH') OR exit('No direct script access allowed');

class Listing_accessory extends Core_Controller
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
		$this->load->view('listing_aksesuar');
		$this->load->view('footer');
	}	
}