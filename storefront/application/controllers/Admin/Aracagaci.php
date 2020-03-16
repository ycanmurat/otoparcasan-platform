<?php 
/**
 * 
 */
class Aracagaci extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Dat_model','dat');
		$this->load->model('Admin/Agac_model');
	}

	public function index()
	{
		$data = new StdClass;
		$data->mainMenu = 'Aracagaci';
		$data->subMenu = 'aracagaci';

		$data->types = $this->dat->getCarMarks();

		//prex($data->types);
		$ifdata = $data->types;
		$ifdata = (array)$ifdata[0];
		//prex($ifdata);
		if (count($ifdata) == 2) {
			$data->first = true;
		}else{
			$data->first = false;
		}

		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/aracagaci');
		$this->load->view('Admin/footer');
	}

	public function list()
	{
		$data = new StdClass;
		$data->mainMenu = 'Aracagaci';
		$data->subMenu = 'aracagaci';
		$postData = $this->getAllPosts();


		if (isset($postData->carType) && $postData->carType == 0) {
			$data->list = $this->dat->getCarMarks();
		}elseif (isset($postData->carBrands) && $postData->carBrands == 0) {
			$data->brand = 1;
			$data->list = $this->dat->getBrands($postData->carType);
		}elseif (isset($postData->carModels) && $postData->carModels == 0) {
			$data->image = 1;
			$data->images = $this->Agac_model->getCarImagesByBrand($postData->carType,$postData->carBrands);
			$data->list = $this->dat->getModels($postData->carType,$postData->carBrands);
		}else{
			$data->list = $this->dat->getSubModels($postData->carType,$postData->carBrands,$postData->carModels);
		}


		//prex($data->list);
		$ifdata = $data->list;
		$ifdata = (array)$ifdata[0];
		//prex($ifdata);
		if (count($ifdata) == 2) {
			$data->first = true;
		}else{
			$data->first = false;
		}

		$data->selects = $postData;
		//prex($data->selects);
		//prex($data);

		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/aracagaciEdit');
		$this->load->view('Admin/footer');
	}

	
	public function image($type = '',$brand = '',$model = '')
	{
		$data = new StdClass;
		$data->type 	= $type;
		$data->brand 	= $brand;
		$data->model 	= $model;

		if ($type != '' && $brand != '' && $model != '') {
			$data->img = $this->uploadImage($_FILES['file']);
			if ($this->Agac_model->addImage($data)) {
				echo 'OK';
			}else{
				echo 'Nop';
			}
		}else{
			echo 'Nop';
		}
	}
	

	public function add()
	{
		$data = new StdClass;
		$data->mainMenu = 'Aracagaci';
		$data->subMenu = 'aracagaci';
		$postData = $this->getAllPosts();

		//prex($postData);
		if (isset($postData->popilar)) {
			$reverseData = array('name'=>$postData->list,'status' => $postData->status,'popilar' => $postData->popilar);
		}else{
			$reverseData = array('name'=>$postData->list,'status' => $postData->status);
		}

		$rarray = reverseArray($reverseData);
		$ary = array();
		foreach ($rarray as $key => $val) {
			if (isset($val['status'])) {
				$val['status'] = 1;
 			}else{
 				$val['status'] = 0;
 			}

 			if (isset($val['popilar'])) {
				$val['popilar'] = 1;
 			}else{
 				$val['popilar'] = 0;
 			}
 			$val['key'] = $key;
 			$ary[] = $val;
		}

		unset($postData->list);
		unset($postData->popilar);
		unset($postData->status);
		$postData->list = json_encode($ary);

		$this->Agac_model->addEditData($postData);

		redirect(admin_url('Aracagaci'));
	}
}
?>