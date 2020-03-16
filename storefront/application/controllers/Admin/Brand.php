<?

class Brand extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->checkLogin();
		$this->load->model('Admin/Brand_model');
		if ($this->session->userdata('user')->auth != 0) 
		{
			redirect(site_url('Admin'));
		}
	}

	public function index()
	{
		$header_data = new StdClass;
		$data = new StdClass;
		$header_data->mainMenu = 'Brand';
		$header_data->subMenu = 'brandList';
		$data->brands = $this->Brand_model->getBrands();
		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/brand_list',$data);
		$this->load->view('Admin/footer');
	}

	public function add()
	{
		$header_data 			 = new StdClass;
		$data 					 = new StdClass;
		$header_data->mainMenu 	 = 'Brand';
		$header_data->subMenu  	 = 'brandAdd';
		if ($this->input->post()) {
			$getAllPosts = $this->getAllPosts();
			$getAllPosts->image = $this->session->flashdata('image');
			if ($this->Brand_model->addBrand($getAllPosts)) {
				$this->session->set_flashdata('onay',1);
				redirect(admin_url('Brand/add'));
			} else {
				$this->session->set_flashdata('hata',1);
				redirect(admin_url('Brand/add'));
			}
		}
		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/brand_add',$data);
		$this->load->view('Admin/footer');
	}

	public function ImageUpload()
	{	
		$result = $this->Brand_model->imageUpload();
		if ($result != false) {
			$this->session->set_flashdata('image', $result);
		}
	}

	public function SetStatus($id,$new)
	{
		if ($this->Brand_model->SetStatus($id,$new)) {
			redirect(admin_url('Brand'));
		} else {
			redirect(admin_url('Brand'));
		}
	}

	public function delete($id)
	{
		if ($this->Brand_model->delete($id)) {
			redirect(admin_url('Brand'));
		} else {
			redirect(admin_url('Brand'));
		}
	}

	public function edit($id)
	{
		$header_data 			 = new StdClass;
		$data 					 = new StdClass;
		$header_data->mainMenu 	 = 'Brand';
		$header_data->subMenu  	 = 'brandList';
		$data->brand = $this->Brand_model->getBrandById($id);
		if ($this->input->post()) {
			$getAllPosts = $this->getAllPosts();
			if (empty($this->session->flashdata('image'))) {
				$getAllPosts->image = $data->brand->image;
			} else {
				$getAllPosts->image = $this->session->flashdata('image');
			}
			if ($this->Brand_model->updateBrand($getAllPosts,$id)) {
				$this->session->set_flashdata('onay',1);
				redirect(admin_url('Brand/edit/'.$id));
			} else {
				$this->session->set_flashdata('hata',1);
				redirect(admin_url('Brand/edit/'.$id));
			}
		}
		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/brand_edit',$data);
		$this->load->view('Admin/footer');
	}
}