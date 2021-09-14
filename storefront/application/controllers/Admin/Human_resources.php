<?

class Human_resources extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->checkLogin();
		$this->load->model('Admin/Human_resources_model');
		if ($this->session->userdata('user')->auth != 0) 
		{
			redirect(site_url('Admin'));
		}
	}

	public function index()
	{
		$header_data = new StdClass;
		$data = new StdClass;
		$header_data->mainMenu 	 = 'FeedBack';
		$header_data->subMenu = 'list';
		$header_data->lowerMenu = 'Human_resources';

		$data->application = $this->Human_resources_model->getApplication();

		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/human_resources_list',$data);
		$this->load->view('Admin/footer');
	}

	public function delete($id)
	{
		if ($this->Brand_model->delete($id)) {
			redirect(admin_url('Human_resources'));
		} else {
			redirect(admin_url('Human_resources'));
		}
	}
	
}