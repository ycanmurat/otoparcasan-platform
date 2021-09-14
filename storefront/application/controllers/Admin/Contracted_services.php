<?defined('BASEPATH') OR exit('No direct script access allowed');

class Contracted_services extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->checkLogin();
		$this->load->model('Admin/Contracted_services_model','CM');
		if ($this->session->userdata('user')->auth != 0 && $this->session->userdata('user')->auth != 2) 
		{
			redirect(site_url('Admin'));
		}
	}

	public function index()
	{
		$data = new StdClass();
		$header_data = new StdClass();
		$header_data->mainMenu 	 = 'Content';
		$header_data->subMenu = 'servicesList';
		$header_data->lowerMenu = 'CorporateContent';
		if ($this->input->post()) {
			$postData = $this->getAllPosts();
			if ($this->CM->addServices($postData)) {
				$this->session->set_flashdata('onay',1);
				redirect(admin_url('Contracted_services'));
			} else {
				$this->session->set_flashdata('red',1);
				redirect(admin_url('Contracted_services'));
			}
		}
		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/contracted_services_add', $data);
		$this->load->view('Admin/footer');
	}

	public function list()
	{
		$data = new StdClass();
		$header_data = new StdClass();

		$header_data->mainMenu 	 = 'Content';
		$header_data->subMenu = 'servicesList';
		$header_data->lowerMenu = 'CorporateContent';

		$data->list = $this->CM->getServices();

		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/contracted_services_list', $data);
		$this->load->view('Admin/footer');
	}

	public function setStatus($id,$status)
	{
		if ($this->CM->setStatus($id,$status)) {
			redirect(admin_url('Contracted_services/list'));
		} else {
			redirect(admin_url('Contracted_services/list'));
		}
	}

	public function delete($id)
	{
		if ($this->CM->delete($id)) {
			redirect(admin_url('Contracted_services/list'));
		} else {
			redirect(admin_url('Contracted_services/list'));
		}
	}

	public function edit($id)
	{
		$data = new StdClass();
		$header_data = new StdClass();
		$header_data->mainMenu 	 = 'Content';
		$header_data->subMenu = 'servicesList';
		$header_data->lowerMenu = 'CorporateContent';
		if ($this->input->post()) {
			$postData = $this->getAllPosts();
			if ($this->CM->updateServices($postData,$id)) {
				$this->session->set_flashdata('onay',1);
				redirect(admin_url('Contracted_services/edit/'.$id));
			} else {
				$this->session->set_flashdata('red',1);
				redirect(admin_url('Contracted_services/edit/'.$id));
			}
		}
		$data->list = $this->CM->getServicesById($id);
		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/contracted_services_edit', $data);
		$this->load->view('Admin/footer');
	}

}