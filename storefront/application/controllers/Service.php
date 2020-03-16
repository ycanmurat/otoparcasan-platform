<?php 
/**
 * 
 */
class Service extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Dat_model','dat');
	}

	public function getTypes()
	{
		echo json_encode($this->dat->getCarMarks());
	}

	public function getBrands($type = '',$year = '')
	{
		if ($type>0 AND $type<6) {
			echo json_encode($this->dat->getBrands($type,$year));
		}else{
			echo 'error';
		}

	}

	public function getModels($type = '',$brand = '',$year = '')
	{
		if ($type>0 AND $type<6) {
			echo json_encode($this->dat->getModels($type,$brand,$year));
		}else{
			echo 'error';
		}

	}

	public function getSubModels($type = '',$brand = '',$model = '',$year ='')
	{
		if ($type>0 AND $type<6 AND $brand != '' AND $model != '') {
			echo json_encode($this->dat->getSubModels($type,$brand,$model,$year));
		}else{
			echo 'error';
		}
	}

	public function getEngine($type = '',$brand = '',$model = '',$subModel = '')
	{
		if ($type>0 AND $type<6 AND $brand != '' AND $model != '') {
			$this->dat->getEngine($type,$brand,$model,$subModel);
		}else{
			echo 'error';
		}
	}

	public function getOptions($type,$brand,$model,$subModel,$year = '')
	{
		$data = $this->dat->getOptions($type,$brand,$model,$subModel,$year);
		echo json_encode($data);
	}

	public function getCarId()
	{
		if ($this->input->post()) {
			$data = $this->getAllPosts();
			$data = $this->dat->getCarId($data);
			echo json_encode($data);
		}
	}

	public function getConsTime($carId)
	{
		$data = $this->dat->getConsTime($carId);
		echo json_encode($data);
	}

	public function getChangedOptions()
	{
		$posts = $this->getAllPosts();

		$data = $this->dat->getChangedOptions($posts);
		echo json_encode($data);
	}

	public function addGarrage()
	{
		$posts = $this->getAllPosts();
		$this->load->model('Garage_model');

		if ($this->Garage_model->addGarrage($posts)) {
			echo 'OK';
		}else{
			echo 'Err';
		}
	}

	public function deleteGarageCar($id = '')
	{
		$this->load->model('Garage_model');
		if ($id == '') {
			echo 'ERR';
		}else{
			if ($this->Garage_model->deleteGarageCar($id)) {
				echo 'OK';
			}else{
				echo 'ERR';
			}
		}
	}

	public function getVinSearch($vin)
	{
		$this->load->model('Garage_model');

		$data = $this->dat->getVinRequest($vin);
		//prex($data->result[0]);

		if (is_array($data->result[0])) {
			$data->image 	=  $this->Garage_model->getCarImage($data->result[0]['ns1VehicleType'],$data->result[0]['ns1Manufacturer'],$data->result[0]['ns1BaseModel']);
		}else{
			$data->image 	=  $this->Garage_model->getCarImage($data->result[0]->ns1VehicleType,$data->result[0]->ns1Manufacturer,$data->result[0]->ns1BaseModel);
		}
		echo json_encode($data);
	}
}
?>