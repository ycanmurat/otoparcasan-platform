<?php
/**
* Author: Muhammet Ateş
*/
class Slider extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->checkLogin();
		$this->load->model('Admin/Slider_model');
		$this->load->model('Admin/Language_model');
		if ($this->session->userdata('user')->auth != 0) 
		{
			redirect(site_url('Admin'));
		}
	}

	public function index()
	{
		$header_data = new StdClass;
		$data = new StdClass;
		$header_data->mainMenu = 'Slider';
		$header_data->subMenu  = 'SliderList';

		$sayfa = $this->input->get('s', true);
		if ($sayfa == "" || $sayfa < 1) {
			redirect(site_url('Admin/Slider?s=1'));
		}

		$q = $this->Slider_model->getList($sayfa);
		if ($q!=false) {
			if ($sayfa < 2) {
				$data->prevPage = 1;
			}else{
				$data->prevPage = $sayfa-1;
			}

			if ($sayfa >= ceil($q->pageCount)) {
				$data->nextPage = ceil($q->pageCount);
			}else{
				$data->nextPage = ceil($sayfa+1);
			}

			$data->list = $q->list;
			$data->selectedPage = $sayfa;
			$data->pageCount 	= $q->pageCount;
			$data->totalCount 	= $q->totalCount;
		}else{
			$data->prevPage 	= 1;
			$data->nextPage 	= 1;
			$data->list 		= array();
			$data->selectedPage = 1;
			$data->pageCount 	= 1;
			$data->totalCount 	= 0;
		}

		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/slider', $data);
		$this->load->view('Admin/footer');
	}

	public function Add()
	{
		$header_data = new StdClass;
		$header_data->mainMenu = 'Slider';
		$header_data->subMenu  = 'SliderAdd';


		if ($this->input->post()) {
			$lang = $this->input->post('lang', true);
			$sort = $this->input->post('sort', true);
			$link = $this->input->post('link', true);
			$file = $this->session->flashdata('sliderImage');
			if ($this->Slider_model->AddSlider($lang, $sort, $link, $file)) {
				$this->session->set_flashdata('slider_result1', 'Slider eklendi.');
				$this->session->set_flashdata('slider_result2', 'success');
				redirect(admin_url('Slider/Add'));
			} else {
				$this->session->set_flashdata('slider_result1', 'Bir hata oluştu.');
				$this->session->set_flashdata('slider_result2', 'danger');
				redirect(admin_url('Slider/Add'));
			}
		}

		$data['langs'] = $this->Language_model->GetLangListStatus();
		$data['sonuc'] = array($this->session->flashdata('slider_result1'), $this->session->flashdata('slider_result2'));


		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/slider_add', $data);
		$this->load->view('Admin/footer');
	}

	public function ImageUpload()
	{	
		$sonuc = $this->Slider_model->SliderImageUpload();
		if ($sonuc != false) {
			$this->session->set_flashdata('sliderImage', $sonuc);
		}
	}

	public function SetStatus($id = 0, $new = 0)
	{
		if ($id == 0 || ($new != 0 && $new != 1)) {
			redirect(admin_url('Slider'));
		}
		$this->Slider_model->SetStatus($id, $new);
		try {
			$this->Slider_model->SetStatus($id, $new);
			redirect($_SERVER['HTTP_REFERER']);
		} catch (Exception $e) {
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function Delete($id = 0)
	{
		if ((int)$id == 0) {
			redirect(admin_url('Slider'));
		}
		if ($this->Slider_model->DeleteSlider($id)) {
			$this->session->set_flashdata('slider_result1', 'Slider silindi.');
			$this->session->set_flashdata('slider_result2', 'success');
			redirect(admin_url('Slider'));
		} else {
			$this->session->set_flashdata('slider_result1', 'Bir hata oluştu.');
			$this->session->set_flashdata('slider_result2', 'danger');
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function popUpAdd()
	{
		$header_data 			= new StdClass;
		$data 					= new StdClass;
		$header_data->mainMenu 	= 'Slider';
		$header_data->subMenu  	= 'SliderList';

		if ($this->input->post()) 
		{
			$postInfo			= new StdClass;
			$postInfo->link		= NULL;
			$postInfo->link 	= $this->input->post('link',true);
			$postInfo->picture 	= $this->session->flashdata('sliderImage');
			if ($this->Slider_model->uploadPopUp($postInfo)) 
			{
				$this->session->set_flashdata('bilgi',1);
			}
			else
			{
				$this->session->set_flashdata('bilgi',2);
			}
		}
		$data->popQuery = $this->Slider_model->pop();
		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/popUp', $data);
		$this->load->view('Admin/footer');
	}
	public function popStatus($Id = 0, $new = 0)
	{
		if ($Id == 0 || ($new != 0 && $new != 1)) 
		{
			redirect(admin_url('Slider/popUpAdd'));
		}
		$this->Slider_model->pStatus($Id, $new);
		try 
		{
			$this->Slider_model->pStatus($Id, $new);
			redirect($_SERVER['HTTP_REFERER']);
		} 
		catch (Exception $e) 
		{
			redirect($_SERVER['HTTP_REFERER']);
		}
	}


	public function ProductBannerStatus($Id, $new)
	{
		if ($this->Slider_model->pStatus($Id,$new)) {
			redirect(admin_url('Slider/ProductSlider'));
		} else {
			redirect(admin_url('Slider/ProductSlider'));
		}
	}


	public function ProductSlider()
	{
		$data 				= new StdClass;
		$data->mainMenu 	= 'Slider';
		$data->subMenu  	= 'SliderProduct';
		$data->Banner = $this->Slider_model->productBanner();
		if ($this->input->post()) {
			$getAllPost = $this->getAllPosts();
			if (empty($this->session->flashdata('sliderImage'))) {
				$getAllPost->banner_url = $data->Banner->banner_url;
			} else {
				$getAllPost->banner_url = $this->session->flashdata('sliderImage');
			}
			if ($this->Slider_model->updateHomeBanner($getAllPost)) {
				$this->session->set_flashdata('bilgi',1);
				redirect(admin_url('Slider/ProductSlider'));
			} else {
				$this->session->set_flashdata('bilgi',2);
				redirect(admin_url('Slider/ProductSlider'));
			}
		}
		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/sliderproduct', $data);
		$this->load->view('Admin/footer');
	}

	public function sliderImage()
	{
		$header_data 			= new StdClass;
		$data  					= new StdClass;
		$header_data->mainMenu 	= 'Slider';
		$header_data->subMenu  	= 'sliderImage';
		if ($this->input->post()) {
			$getAllPost = $this->getAllPosts();
			$getAllPost->slider_url = $this->session->flashdata('sliderImage');
			if($this->Slider_model->imgUpload($getAllPost)){
				$this->session->set_flashdata('onay',1);
			} else {
				$this->session->set_flashdata('hata',1);
			}
		}
		$data->Rimage = $this->Slider_model->getPic();
		$data->langs = $this->Language_model->GetLangListStatus();
		$this->load->view('Admin/header',$header_data);
		$this->load->view('Admin/slider_image',$data);
		$this->load->view('Admin/footer');
	}
	public function SetStatusImg($Id = 0, $st = 0)
	{
		if ($Id == 0 || ($st != 0 && $st != 1)) 
		{
			redirect(admin_url('Slider/sliderImage'));
		}
		$this->Slider_model->addStatus($Id, $st);
		try 
		{
			$this->Slider_model->addStatus($Id, $st);
			redirect($_SERVER['HTTP_REFERER']);
		}
		catch (Exception $e)
		{
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	public function imageMust()
	{
		$sort = $this->input->post('sort',true);
		$this->Slider_model->SetVariantSort($sort);
		redirect(site_url('Admin/Slider'));
	}

	public function MobileimageMust()
	{
		$sort = $this->input->post('sort',true);
		$this->Slider_model->MobileSetVariantSort($sort);
		redirect(site_url('Admin/Slider/sliderImage'));
	}

	public function DeleteImg($Id)
	{
		if ($this->Slider_model->dImage($Id)) {
			redirect(admin_url('Slider/sliderImage'));
		}
	}

	public function editSlider($Id)
	{
		$header_data 			= new StdClass;
		$data  					= new StdClass;
		$header_data->mainMenu 	= 'Slider';
		$header_data->subMenu  	= 'SliderAdd';
		$data->langs 			= $this->Language_model->GetLangListStatus();
		if (!empty($Id) && is_numeric($Id)) {
			if($data->sliderInfo = $this->Slider_model->getSliderInfo($Id)){
				if ($this->input->post()) {
					$getAllPost = $this->getAllPosts();
					$getAllPost->slider_url = $this->session->flashdata('sliderImage');
					if (empty($getAllPost->slider_url)) {
						$getAllPost->slider_url = $data->sliderInfo->slider_url;
						if ($this->Slider_model->updateSlider($Id,$getAllPost)) {
							$this->session->set_flashdata('slider_result1', 'Slider Güncellendi.');
							$this->session->set_flashdata('slider_result2', 'success');
							redirect(admin_url('Slider/editSlider/'.$Id));
						} else {
							$this->session->set_flashdata('slider_result1', 'Bir Hata Oluştu.');
							$this->session->set_flashdata('slider_result2', 'danger');
							redirect(admin_url('Slider'));
						}
					} else {
						if ($this->Slider_model->updateSlider($Id,$getAllPost)) {
							$this->session->set_flashdata('slider_result1', 'Slider Güncellendi.');
							$this->session->set_flashdata('slider_result2', 'success');
							redirect(admin_url('Slider/editSlider/'.$Id));
						} else {
							$this->session->set_flashdata('slider_result1', 'Bir Hata Oluştu.');
							$this->session->set_flashdata('slider_result2', 'danger');
							redirect(admin_url('Slider'));
						}
					}
				}
			} else {
				redirect(admin_url('Slider'));
			}
		} else {
			redirect(admin_url('Slider'));
		}
		$data->sliderInfo = $this->Slider_model->getSliderInfo($Id);
		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/slideredit', $data);
		$this->load->view('Admin/footer');
	}

	public function editMobileSlider($Id)
	{
		$header_data 			= new StdClass;
		$data  					= new StdClass;
		$header_data->mainMenu 	= 'Slider';
		$header_data->subMenu  	= 'sliderImage';
		$data->langs 			= $this->Language_model->GetLangListStatus();
		if (!empty($Id) && is_numeric($Id)) {
			if($data->mobileSliderInfo = $this->Slider_model->getMobileSliderInfo($Id)){
				if ($this->input->post()) {
					$getAllPost = $this->getAllPosts();
					$getAllPost->slider_url = $this->session->flashdata('sliderImage');
					if (empty($getAllPost->slider_url)) {
						$getAllPost->slider_url = $data->mobileSliderInfo->slider_url;
						if ($this->Slider_model->updateMobileSlider($Id,$getAllPost)) {
							$this->session->set_flashdata('onay',1);
							redirect(admin_url('Slider/editMobileSlider/'.$Id));
						} else {
							$this->session->set_flashdata('hata',1);
							redirect(admin_url('Slider/editMobileSlider/'.$Id));
						}
					} else {
						if ($this->Slider_model->updateMobileSlider($Id,$getAllPost)) {
							$this->session->set_flashdata('onay',1);
							redirect(admin_url('Slider/editMobileSlider/'.$Id));
						} else {
							$this->session->set_flashdata('hata',1);
							redirect(admin_url('Slider/editMobileSlider/'.$Id));
						}
					}
				}
			} else {
				redirect(admin_url('sliderImage'));
			}
		} else {
			redirect(admin_url('sliderImage'));
		}
		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/mobile_slider_edit', $data);
		$this->load->view('Admin/footer');
	}
}
?>