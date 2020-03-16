<?

class Corporate extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->checkLogin();
		$this->load->model('Admin/Corporate_model');
		if ($this->session->userdata('user')->auth != 0) {
			redirect(site_url('Admin'));
		}
	}
	public function index()
	{
		$header_data 			 = new StdClass;
		$data 					 = new StdClass;
		$header_data->mainMenu 	 = 'homeVideo';
		$header_data->subMenu  	 = 'videoEdit';
		$data->info = $this->Corporate_model->getHomeVideo();
		if ($this->input->post()) {
			$getAllPosts = $this->getAllPosts();
			if (empty($this->session->flashdata('image'))) {
				$getAllPosts->image = $data->info->image;
			} else {
				$getAllPosts->image = $this->session->flashdata('image');
			}
			if ($this->Corporate_model->updateCorporate($getAllPosts)) {
				$this->session->set_flashdata('onay',1);
				redirect(admin_url('Corporate'));
			} else {
				$this->session->set_flashdata('hata',1);
				redirect(admin_url('Corporate'));
			}
		}
		$data->info = $this->Corporate_model->getHomeVideo();
		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/home_video',$data);
		$this->load->view('Admin/footer');
	}

	public function ImageUpload()
	{	
		$sonuc = $this->Corporate_model->imageUpload();
		if ($sonuc != false) {
			$this->session->set_flashdata('image', $sonuc);
		}
	}
}

?>