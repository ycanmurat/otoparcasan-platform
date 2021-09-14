<?

class Bank_account extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->checkLogin();
		$this->load->model('Admin/Bank_account_model','BM');
		if ($this->session->userdata('user')->auth != 0) 
		{
			redirect(site_url('Admin'));
		}
	}

	public function index()
	{
		$header_data = new StdClass;
		$data = new StdClass;
		$header_data->mainMenu 	 = 'Content';
		$header_data->subMenu = 'bankList';
		$header_data->lowerMenu = 'CorporateContent';
		$data->accounts = $this->BM->getAccounts();
		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/bank_list',$data);
		$this->load->view('Admin/footer');
	}

	public function add()
	{
		$header_data 			 = new StdClass;
		$data 					 = new StdClass;
		$header_data->mainMenu 	 = 'Content';
		$header_data->subMenu = 'bankList';
		$header_data->lowerMenu = 'CorporateContent';
		if ($this->input->post()) {
			$getAllPosts = $this->getAllPosts();
			$getAllPosts->image = $this->session->flashdata('image');
			if ($this->BM->addAccount($getAllPosts)) {
				$this->session->set_flashdata('onay',1);
				redirect(admin_url('Bank_account/add'));
			} else {
				$this->session->set_flashdata('hata',1);
				redirect(admin_url('Bank_account/add'));
			}
		}
		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/bank_add',$data);
		$this->load->view('Admin/footer');
	}

	public function ImageUpload()
	{	
		$result = $this->BM->imageUpload();
		if ($result != false) {
			$this->session->set_flashdata('image', $result);
		}
	}

	public function SetStatus($id,$new)
	{
		if ($this->BM->SetStatus($id,$new)) {
			redirect(admin_url('Bank_account'));
		} else {
			redirect(admin_url('Bank_account'));
		}
	}

	public function delete($id)
	{
		if ($this->BM->delete($id)) {
			redirect(admin_url('Bank_account'));
		} else {
			redirect(admin_url('Bank_account'));
		}
	}
	
	public function edit($id)
	{
		$header_data 			 = new StdClass;
		$data 					 = new StdClass;
		$header_data->mainMenu 	 = 'Content';
		$header_data->subMenu = 'bankList';
		$header_data->lowerMenu = 'CorporateContent';
		$data->account = $this->BM->getAccountById($id);
		if ($this->input->post()) {
			$getAllPosts = $this->getAllPosts();
			if (empty($this->session->flashdata('image'))) {
				$getAllPosts->image = $data->account->image;
			} else {
				$getAllPosts->image = $this->session->flashdata('image');
			}
			if ($this->BM->updateAccount($getAllPosts,$id)) {
				$this->session->set_flashdata('onay',1);
				redirect(admin_url('Bank_account/edit/'.$id));
			} else {
				$this->session->set_flashdata('hata',1);
				redirect(admin_url('Bank_account/edit/'.$id));
			}
		}
		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/bank_edit',$data);
		$this->load->view('Admin/footer');
	}
}