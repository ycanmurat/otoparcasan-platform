<?
class Help extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->checkLogin();
		$this->load->model('Admin/Help_model','HM');
		if ($this->session->userdata('user')->auth != 0) 
		{
			redirect(site_url('Admin'));
		}
	}

	public function index()
	{
		$header_data = new StdClass;
		$data = new StdClass;
		$header_data->mainMenu = 'Help';
		$header_data->subMenu = 'helpList';
		$data->helps = $this->HM->getHelpList();
		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/help_list',$data);
		$this->load->view('Admin/footer');
	}

	public function add()
	{
		$header_data 			 = new StdClass;
		$data 					 = new StdClass;
		$header_data->mainMenu 	 = 'Help';
		$header_data->subMenu  	 = 'helpAdd';
		if ($this->input->post()) {
			$getAllPosts = $this->getAllPosts();
			$getAllPosts->slug = url_seo($getAllPosts->menu);
			if ($this->HM->addHelp($getAllPosts)) {
				$this->session->set_flashdata('onay',1);
				redirect(admin_url('Help/add'));
			} else {
				$this->session->set_flashdata('hata',1);
				redirect(admin_url('Help/add'));
			}
		}
		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/help_add',$data);
		$this->load->view('Admin/footer');
	}

	public function SetStatus($id,$new)
	{
		if ($this->HM->SetStatus($id,$new)) {
			redirect(admin_url('Help'));
		} else {
			redirect(admin_url('Help'));
		}
	}

	public function delete($id)
	{
		if ($this->HM->delete($id)) {
			redirect(admin_url('Help'));
		} else {
			redirect(admin_url('Help'));
		}
	}

	public function edit($id)
	{
		$header_data 			 = new StdClass;
		$data 					 = new StdClass;
		$header_data->mainMenu 	 = 'Help';
		$header_data->subMenu  	 = 'helpList';
		$data->help = $this->HM->getHelpById($id);
		if ($this->input->post()) {
			$getAllPosts = $this->getAllPosts();
			$getAllPosts->slug = url_seo($getAllPosts->menu);
			if ($this->HM->updateHelp($getAllPosts,$id)) {
				$this->session->set_flashdata('onay',1);
				redirect(admin_url('Help/edit/'.$id));
			} else {
				$this->session->set_flashdata('hata',1);
				redirect(admin_url('Help/edit/'.$id));
			}
		}
		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/help_edit',$data);
		$this->load->view('Admin/footer');
	}

	public function sortPost()
	{
		$sort = $this->input->post('sort',true);
		$this->HM->sort($sort);
		redirect(admin_url('Help'));
	}
}