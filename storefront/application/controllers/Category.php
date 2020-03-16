<?php 
/**
 * 
 */
class Category extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Category_model','CM');
		$this->load->model('Dat_model','dat');
		$this->load->model('Api_model','Api');
	}

	public function index($slug = '',$slug2 = '') // ilk aşama
	{
		$data = $this->Global_model->getAllInsert();


		if ($slug == '' AND $slug2 == '') {

			if (null !== ($this->input->cookie('selectedCar'))) {
				$data->selectedCar = true;
				$selectedCar = json_decode($this->input->cookie('selectedCar'));
				$data->carDetail = $this->dat->getCarDetail($selectedCar);
				$data->carImage = $this->getCarImage($data->carDetail->Vehicle->VehicleType,$data->carDetail->Vehicle->Manufacturer,$data->carDetail->Vehicle->BaseModel);
			}else{
				$data->selectedCar = false;
			}

			$data->userData = $this->getUserData();
			if ($data->userData != false) {
				$data->garagge = $this->CM->getUserGarrage($data->userData->id);
			}


			//prex($data->garagge);

			$data->title = 'Yedek Parçalar | Otoparçasan.com';
			$data->desc = 'Yedek Parçalar';

			//prex($data);

			$this->load->view('head',$data);
			$this->load->view('header');
			$this->load->view('yedekpart');
			$this->load->view('footer');

		}elseif($slug2 == '' AND $slug != ''){// 2. aşama

			if (null !== ($this->input->cookie('selectedCar'))) {
				$data->selectedCar = true;
				$selectedCar = json_decode($this->input->cookie('selectedCar'));
				$data->carDetail = $this->dat->getCarDetail($selectedCar);
				$data->carImage = $this->getCarImage($data->carDetail->Vehicle->VehicleType,$data->carDetail->Vehicle->Manufacturer,$data->carDetail->Vehicle->BaseModel);
			}else{
				$data->selectedCar = false;
			}


			$data->userData = $this->getUserData();
			if ($data->userData != false) {
				$data->garagge = $this->CM->getUserGarrage($data->userData->id);
			}


			$data->detail = $this->CM->getCategoryBySlug($slug,$data->categoryDetails);

			$data->title = replaceStringProblemsReverse($data->detail->topGroup->GRUP_ISIM).' | Otoparçasan.com';
			$data->desc = $data->detail->topDetail->desc;
			//prex($data->detail);

			$this->load->view('head',$data);
			$this->load->view('header');
			$this->load->view('altpartpage');
			$this->load->view('footer');

		}else{// 3. aşama
			$data->menu1 = $slug;
			$data->menu2 = $slug2;

			$data->categories = $this->CM->getCategoryName($slug,$slug2);
			if (null !== ($this->input->cookie('selectedCar'))) {
				$data->selectedCar = true;
				$selectedCar = json_decode($this->input->cookie('selectedCar'));
				$data->carDetail = $this->dat->getCarDetail($selectedCar);
				$data->carImage = $this->getCarImage($data->carDetail->Vehicle->VehicleType,$data->carDetail->Vehicle->Manufacturer,$data->carDetail->Vehicle->BaseModel);
			}else{
				$data->selectedCar = false;
			}

			
			$data->userData = $this->getUserData();
			if ($data->userData != false) {
				$data->garagge = $this->CM->getUserGarrage($data->userData->id);
			}

			$oems = $this->CM->getProductByCategories($slug2,$selectedCar->carId,$selectedCar->consTime);
			//prex($oems);
			if ($oems != false) {
				$products = $this->Api->getProductsByOem($oems);
				$data->products = array();
				//prex($products);
				$data->oems = $oems;


				//gelen ürünlerden muadil grubu oluşturma
				foreach ($oems as $key => $val) {
					$val = trim($val);
					$data->products[$key] = array();
					foreach ($products as $key2 => $val2) {
						if ($val == $val2->KULL1S || $val == $val2->KULL2S || $val == $val2->KULL3S || $val == $val2->KULL4S || $val == $val2->KULL5S || $val == $val2->KULL6S || $val == $val2->KULL7S || $val == $val2->KULL8S) {
							$data->products[$key][] = $val2;
						}
					}
				}

				foreach ($data->products as $key => $val) {
					if ($val == array()) {
						unset($data->products[$key]);
					}
				}

				
			}else{
				$data->oems = array();
				$data->products = array();
			}

			foreach ($data->categories as $key => $val) {
				if ($val->slug == $slug2) {
					$data->selectedCategori = (object)array_merge((array)$val,(array)$this->Api->getSubCategoriDetailById($val->category_id));
				}else{
					$data->otherCategori = (object)array_merge((array)$val,(array)$this->Api->getTopCategoriDetailById($val->category_id));
				}
			}
			

			//prex($data->selectedCategori);
			$data->title = replaceStringProblemsReverse($data->selectedCategori->GRUP_ISIM).' | Otoparçasan.com';
			$data->desc = $data->selectedCategori->desc;
			
			//prex($data->selectedCategori);
			

			//prex($data->products);

			//$this->output->enable_profiler(TRUE);

			$this->load->view('head',$data);
			$this->load->view('header');
			$this->load->view('listing_full');
			$this->load->view('footer');
		}
	}
}
?>