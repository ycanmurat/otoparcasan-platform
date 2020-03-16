<?
	class Corporate extends Core_Controller
	{
		function __construct()
		{
			parent::__construct();
			$this->checkLogin();
			$this->load->model('Admin/Corporate_model');
		}
		
		public function index()
		{
			$data = new StdClass();
			$header_data = new StdClass();
			$header_data->mainMenu = 'homeVideo';
			$header_data->subMenu  = 'videoEdit';

			$this->load->view('Admin/header', $header_data);
			$this->load->view('Admin/home_video', $data);
			$this->load->view('Admin/footer');
		}


		public function ImageUpload()
		{	
			$result = $this->Corporate_model->imageUpload();
			if ($result != false) {
				$this->session->set_flashdata('image', $result);
			}
		}
	}
?>