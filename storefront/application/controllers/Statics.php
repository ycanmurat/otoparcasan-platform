<?defined('BASEPATH') OR exit('No direct script access allowed');

class Statics extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
        $this->load->model('Statics_model');
	}

	public function index($url = '')
	{
		$data = new stdClass();
		$data = $this->Global_model->getAllInsert();

        $data->page = $this->Statics_model->getStatikBySlug($url);
        //prex($data->page);

		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('static_page');
		$this->load->view('footer');
	}
}