<?defined('BASEPATH') OR exit('No direct script access allowed');

class Statics extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	public function gizlilik_politikasi()
	{
		$data = new stdClass();
		$data = $this->Global_model->getAllInsert();
		$data->menus = $this->Api_model->getCategories();
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('editorPage');
		$this->load->view('footer');
	}
}