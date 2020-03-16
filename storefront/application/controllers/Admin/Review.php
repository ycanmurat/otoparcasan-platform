<?
	class Review extends Core_Controller
	{
		function __construct()
		{
			parent::__construct();
			$this->checkLogin();
			$this->load->model('Admin/Review_model','RM');
		}

		public function index()
		{
			$header_data = new StdClass;
			$data = new StdClass;
			$header_data->mainMenu = "Review";
			$header_data->subMenu = "reviewList";	
			
			$data->reviewInformation = $this->RM->getModalReview();

			$this->load->view('Admin/header',$header_data);
			$this->load->view('Admin/review_list_modal',$data);
			$this->load->view('Admin/footer');
		}
	}
?>