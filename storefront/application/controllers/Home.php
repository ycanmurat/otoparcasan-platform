<?defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
        $this->load->model('Home_model','HM');
		$this->load->model('Service_model','SM');
		$this->getUserRememberCheck();
        /*
        if (is_null($this->session->userdata('userInfo')) || is_null(@get_cookie('selectedCar'))) {
            $this->output->cache(10);
        }
        */
	}

	public function index()
	{
		$this->load->model('Dat_model','dat');

		$data = new StdClass;
		
		$data = $this->Global_model->getAllInsert();
		$data->dat = new StdClass;

		$data->dat->types = $this->SM->getCarTypes();

		if (null !== ($this->input->cookie('selectedCar'))) {
			$selectedCar = json_decode($this->input->cookie('selectedCar'));
			$data->carDetail = $this->dat->getCarDetail($selectedCar);
		}

		$data->mobileSliders = $this->HM->getMobileSlider();
		$data->verySellers 	= $this->HM->getVerySellers();
		$data->commentsAndReviews = $this->HM->getCommentsAndReviews();
		$data->sliders = $this->HM->getSlider();
		$data->video = $this->HM->getCorporateVideoAndInformation();
		$data->carBrands = $this->HM->getCarBrands();
		$data->pieceBrands = $this->HM->getPieceBrands();
		$data->content = $this->HM->getContent();
		$data->otoparcasan = $this->HM->getOtoparcasan();

		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('home');
		$this->load->view('footer');
		
	}

    public function info()
    {
        $this->load->model('Dat_model','dat');
        $d = $this->dat->getImage('011301427430001','ANGULARFRONT');
        prex($d);
    }

	public function getBannerTime()
	{
	 	$bannerInformation = $this->Global_model->getBanner();
	 	print $bannerInformation->date;
	}

    public function my_404()
    {
        $data = new StdClass;
        
        $data = $this->Global_model->getAllInsert();

        $this->output->set_status_header('404');
        $this->load->view('head',$data);
        $this->load->view('header');
        $this->load->view('404');
        $this->load->view('footer');
    }
}