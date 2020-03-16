<?defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Home_model','HM');
		$this->getUserRememberCheck();
	}

	public function index()
	{
		$this->load->model('Dat_model','dat');

		$data = new StdClass;
		
		$data = $this->Global_model->getAllInsert();
		$data->dat = new StdClass;

		$data->dat->types = $this->dat->getCarMarks();

		//prex($data->dat);
		if (count((array)$data->dat->types[0]) == 2) {
			$data->dat->first = true;
		}else{
			$data->dat->first = false;
		}

		if (null !== ($this->input->cookie('selectedCar'))) {
			$selectedCar = json_decode($this->input->cookie('selectedCar'));
			$data->carDetail = $this->dat->getCarDetail($selectedCar);
			//$data->carImage = $this->getCarImage($data->carDetail->Vehicle->VehicleType,$data->carDetail->Vehicle->Manufacturer,$data->carDetail->Vehicle->BaseModel);
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

	public function getBannerTime()
	{
	 	$bannerInformation = $this->Global_model->getBanner();
	 	print $bannerInformation->date;
	}

	public function test($vin)
	{
		$this->load->model('Dat_model','dat');
		$data = $this->dat->getVinRequest($vin);
		prex($data);
	}
}