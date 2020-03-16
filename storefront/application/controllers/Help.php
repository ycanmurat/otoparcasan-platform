<?defined('BASEPATH') OR exit('No direct script access allowed');

class Help extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->getUserRememberCheck();
		$this->load->model('Help_model','HM');
	}

	public function index()
	{
		$data = new stdClass();
		$data = $this->Global_model->getAllInsert();
		$data->helps = $this->HM->getAllHelps();
		$data->content = $this->HM->getMinumumIdByContent();
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('help');
		$this->load->view('footer');
	}

	public function detail($slug)
	{
		$data = new stdClass();
		$data = $this->Global_model->getAllInsert();
		if (!empty($slug)) {
			if ($data->slugByContent = $this->HM->getSlugByContent($slug)) {
				$data->helps = $this->HM->getAllHelps();
				$data->activeMenu = $data->slugByContent->slug;
				$this->load->view('head',$data);
				$this->load->view('header');
				$this->load->view('help_detail');
				$this->load->view('footer');
			} else {
				redirect(site_url());
			}
		} else {
			redirect(site_url());
		}
	}
}

