<?

class Content extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->checkLogin();
		$this->load->model('Admin/Content_model');
		if ($this->session->userdata('user')->auth != 0) 
		{
			redirect(site_url('Admin'));
		}
	}

	public function index()
	{
		$header_data = new StdClass;
		$data = new StdClass;
		$header_data->mainMenu = 'Content';
		$header_data->subMenu = 'contentEdit';
		$data->content = $this->Content_model->getContent();
		if ($this->input->post()) {
			$getAllPosts = $this->getAllPosts();
			if (empty($this->session->flashdata('image'))) {
				$getAllPosts->image = $data->content->image;
			} else {
				$getAllPosts->image = $this->session->flashdata('image');
			}
			if ($this->Content_model->updateContent($getAllPosts)) {
				$this->session->set_flashdata('onay',1);
				redirect(admin_url('Content'));
			} else {
				$this->session->set_flashdata('hata',1);
				redirect(admin_url('Content'));
			}
		}
		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/content_list',$data);
		$this->load->view('Admin/footer');
	}

	public function contentOtoparcasan()
	{
		$header_data = new StdClass;
		$data = new StdClass;
		$header_data->mainMenu = 'Content';
		$header_data->subMenu = 'contentAdd';
		$data->otoparcasan = $this->Content_model->getOtoparcasan();
		if ($this->input->post()) {
			$getAllPosts = $this->getAllPosts();
			if ($this->Content_model->updateOtoparcasan($getAllPosts)) {
				$this->session->set_flashdata('onay',1);
				redirect(admin_url('Content/contentOtoparcasan'));
			} else {
				$this->session->set_flashdata('hata',1);
				redirect(admin_url('Content/contentOtoparcasan'));
			}
		}
		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/content_otoparcasan',$data);
		$this->load->view('Admin/footer');
	}

	public function imageUpload()
	{	
		$result = $this->Content_model->imageUpload();
		if ($result != false) {
			$this->session->set_flashdata('image', $result);
		}
	}
	
	
}