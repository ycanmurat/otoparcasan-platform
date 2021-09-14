<?defined('BASEPATH') OR exit('No direct script access allowed');

class Maintenance_robot extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->getUserRememberCheck();
        $this->load->model('Service_model','SM');
        $this->load->model('Dat_model','dat');
        $this->load->model('Category_model','CM');
	}

	public function index()
	{
		$data = new stdClass();
		$data = $this->Global_model->getAllInsert();

        $data->dat = new StdClass;

        $data->dat->types = $this->SM->getCarTypes();

        if (null !== ($this->input->cookie('selectedCar'))) {
            $data->selectedCar = true;
            $selectedCar = json_decode($this->input->cookie('selectedCar'));
            $data->carDetail = $this->dat->getCarDetail($selectedCar);
            $data->carDetailDb = $this->CM->getCarDetail($selectedCar);
            $data->carImage = $this->getCarImage($data->carDetail->Vehicle->VehicleType,$data->carDetail->Vehicle->Manufacturer,$data->carDetail->Vehicle->BaseModel);
            $data->carImage = json_decode($data->carImage,true);
            if ($data->carImage == '') {
                $data->carImage = array('','','');
            }else{
                ksort($data->carImage);
            }

            $data->carName = $data->carDetail->Vehicle->ManufacturerName.' '.carNameExplode($data->carDetail->Vehicle->BaseModelName) ?? '';
        }else{
            $data->selectedCar = false;
            $data->carName = '';
        }

        $data->userData = $this->getUserData();
        if ($data->userData != false) {
            $data->garagge = $this->CM->getUserGarrage($data->userData->id);

            if ($data->garagge != false) {
                usort($data->garagge, function($a, $b) {
                    return $a->detail <=> $b->detail;
                });
            }
        }
        
        //seçili araç garajdamı
        $data->garrageUnVisible = 0;
        if ((null !== ($this->input->cookie('selectedCar'))) && $data->userData != false) {
            $carInGarrrage = 0;
            foreach ($data->garagge as $key => $val) {
                if ($val->car_id == $selectedCar->carId && $val->construction_time == $selectedCar->consTime) {
                    $carInGarrrage++;
                }
            }
            if ($carInGarrrage>0) {
                $data->garrageUnVisible = 1;
            }
        }
        
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('bakimrobotu');
		$this->load->view('footer');
	}	
}