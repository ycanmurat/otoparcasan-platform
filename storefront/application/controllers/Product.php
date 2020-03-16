<?defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->getUserRememberCheck();
		//$this->load->model('Product_model');
		$this->load->model('Api_model','Api');
	}

	public function details($slug = "")
	{
		$slug = str_replace("%20", " ", $slug);
		//prex($slug);
		$data = new stdClass();
		$data = $this->Global_model->getAllInsert();

		$data->product = $this->Api_model->getProductsDetailByKod($slug);

		//prex($data->product);

		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('product-detail');
		$this->load->view('footer');
	}	

}