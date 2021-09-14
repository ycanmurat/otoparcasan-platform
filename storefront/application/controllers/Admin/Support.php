<?
class Support extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->checkLogin();
		$this->load->model('Admin/Support_model','SM');
		if ($this->session->userdata('user')->auth != 0) 
		{
			redirect(site_url('Admin'));
		}
	}

	public function index()
	{
		$header_data = new StdClass;
		$data = new StdClass;
		$header_data->mainMenu = 'FeedBack';
		$header_data->subMenu = 'supportSectionList';
		$header_data->lowerMenu = 'supportAndHelp';
		$data->supportSections = $this->SM->getSupportSections();
		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/suppor_section_list',$data);
		$this->load->view('Admin/footer');
	}

	public function add()
	{
		$header_data 			 = new StdClass;
		$data 					 = new StdClass;
		$header_data->mainMenu 	 = 'FeedBack';
		$header_data->subMenu  	 = 'supportSectionList';
		$header_data->lowerMenu = 'supportAndHelp';
		if ($this->input->post()) {
			$getAllPosts = $this->getAllPosts();
			if ($this->SM->addSupportSection($getAllPosts)) {
				$this->session->set_flashdata('onay',1);
				redirect(admin_url('Support/add'));
			} else {
				$this->session->set_flashdata('hata',1);
				redirect(admin_url('Support/add'));
			}
		}
		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/support_section_add',$data);
		$this->load->view('Admin/footer');
	}

	public function supportStatusEdit($id,$new)
	{
		if ($this->SM->supportStatusEdit($id,$new)) {
			redirect(admin_url('Support'));
		} else {
			redirect(admin_url('Support'));
		}
	}

	public function deleteSection($id)
	{
		if ($this->SM->deleteSection($id)) {
			redirect(admin_url('Support'));
		} else {
			redirect(admin_url('Support'));
		}
	}

	public function deleteRequest($id)
	{
		if ($this->SM->deleteRequest($id)) {
			redirect(admin_url('Support/support_requests'));
		} else {
			redirect(admin_url('Support/support_requests'));
		}
	}
	
	public function editSection($id)
	{
		$header_data 			 = new StdClass;
		$data 					 = new StdClass;
		$header_data->mainMenu = 'FeedBack';
		$header_data->subMenu = 'supportSectionList';
		$header_data->lowerMenu = 'supportAndHelp';
		$data->section = $this->SM->getSectionById($id);
		if ($this->input->post()) {
			$getAllPosts = $this->getAllPosts();
			if ($this->SM->updateSection($getAllPosts,$id)) {
				$this->session->set_flashdata('onay',1);
				redirect(admin_url('Support/editSection/'.$id));
			} else {
				$this->session->set_flashdata('hata',1);
				redirect(admin_url('Support/editSection/'.$id));
			}
		}
		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/support_section_edit',$data);
		$this->load->view('Admin/footer');
	}

	public function support_requests()
	{
		$header_data = new StdClass;
		$data = new StdClass;
		$header_data->mainMenu 	 = 'FeedBack';
		$header_data->subMenu = 'supportRequests';
		$header_data->lowerMenu = 'supportAndHelp';
		$data->supportRequests = $this->SM->getsupportRequests();
		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/support_requests',$data);
		$this->load->view('Admin/footer');
	}
}