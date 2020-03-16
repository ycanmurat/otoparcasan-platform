<?php 
/**
* 
*/
class Package extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->checkLogin();
		$this->load->model('Admin/Package_model');
		if ($this->session->userdata('user')->auth != 0) 
		{
			redirect(site_url('Admin'));
		}
	}


	//
	public function index()
	{
		$data = new StdClass;
		$data->mainMenu = 'Package';
		$data->subMenu  = 'PackageList';

		$data->list = $this->Package_model->GetPackageAll();
		$data->paketsonuc = $this->session->flashdata('paketsonuc');
		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/package_list', $data);
		$this->load->view('Admin/footer');
	}

	//
	public function Add()
	{
		$this->load->model('Language_model');

		$data = new StdClass;

		$data->mainMenu = 'Package';
		$data->subMenu  = 'PackageAdd';

		$data->Langs = $this->Language_model->GetLangListShortId();

		$this->load->view('Admin/header',$data);
		$this->load->view('Admin/package_add', $data);
		$this->load->view('Admin/footer');
	}

	//
	public function SetStatus($id,$status)
	{
		$this->Package_model->SetStatus($id,$status);
		redirect(site_url('Admin/Package'));
	}

	//
	public function Delete($id)
	{
		$this->Package_model->delete($id);
		redirect(site_url('Admin/Package'));
	}

	//
	public function UploadPackageImages($lang_id,$type)
	{
		$this->load->model('Admin/ImageUpload');
		$this->ImageUpload->UploadPackageImages($lang_id,$type);
		echo $this->session->userdata('banner_img_'.$lang_id.'_'.$type);
		echo '<br> banner_img_'.$lang_id.'_'.$type;
	}

	//
	public function SetAdd()
	{
		$data = new StdClass;
		if ($this->input->post()) {
			$data->title = $this->input->post('title', true);
			$lang = reverseArray($this->input->post());
			foreach ($lang as $key => $val) {
				$lang[$key]['package_slug'] = url_seo($val['name']);
				if ($this->Package_model->PackageSlugControl($lang[$key]['package_slug']) == false) {
					$this->session->set_flashdata('tekrarhata',1);
					redirect(site_url('Admin/Package/Add'));
				}
				$lang[$key]['square_image'] = $this->session->userdata('banner_img_'.$key.'_2');
				$this->session->unset_userdata('banner_img_'.$key.'_2');
			}

			if ($this->Package_model->SetAddPackage($data,$lang)) {
				$this->session->set_flashdata('okey',1);
			}else{
				$this->session->set_flashdata('hata',1);
			}
		}

		redirect(site_url('Admin/Package/Add'));
	}

	//
	public function Update($id)
	{

		$this->load->model('Language_model');

		$data = new StdClass;

		$data->mainMenu = 'Package';
		$data->subMenu  = 'PackageList';

		$data->Langs = $this->Language_model->GetLangListShortId();
		$data->values = $this->Package_model->GetFullPackage($id);

		$this->load->view('Admin/header',$data);
		$this->load->view('Admin/package_update', $data);
		$this->load->view('Admin/footer');
	}

	//
	public function SetUpdate($id)
	{
		$data = new StdClass;
		if ($this->input->post()) {
			$data->title = $this->input->post('title', true);

			$lang = reverseArray($this->input->post());
			foreach ($lang as $key => $val) {
				$lang[$key]['package_slug'] = url_seo($val['name']);
				$lang[$key]['square_image'] = $this->session->userdata('banner_img_'.$key.'_2');
				$this->session->unset_userdata('banner_img_'.$key.'_2');
			}

			if ($this->Package_model->UpdatePackage($data,$lang,$id)) {
				$this->session->set_flashdata('okey',1);
			}else{
				$this->session->set_flashdata('hata',1);
			}
		}
		redirect(site_url('Admin/Package/Update/'.$id));
	}

	public function Product($id)
	{
		$data = new StdClass;
		$data->mainMenu = 'Package';
		$data->subMenu  = 'PackageList';
		$data->package_sub_id = $id;

		$data->list = $this->Package_model->GetPackageProductsAll($id);

		//prex($data->list);

		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/package_product_list', $data);
		$this->load->view('Admin/footer');
		
	}

	public function ProductAdd($id)
	{
		$this->load->model('Admin/Product_model');

		$data = new StdClass;

		$data->mainMenu = 'Package';
		$data->subMenu  = 'PackageList';

		$data->package_sub_id = $id;
		$data->products = $this->Product_model->GetProductAll();

		$this->load->view('Admin/header',$data);
		$this->load->view('Admin/package_product_add', $data);
		$this->load->view('Admin/footer');
	}

	public function ProductSetAdd($id)
	{
		
		$array = $this->input->post();
		$a = array();
		$product_id = $array['Product_id'];
		unset($array['Product_id']);
		unset($array['price']);

		foreach ($array as $key => $val) {
			$a[] = $val;
		}

		if ($this->Package_model->PackageProductAdd($id,$a,$product_id)) {
			$this->session->set_flashdata('okey',1);
		}else{
			$this->session->set_flashdata('hata',1);
		}
		redirect(site_url('Admin/Package/Product/'.$id));
		
		//prex($this->input->post());
	}

	public function Productdelete($package_product_id,$redirect)
	{
		$this->Package_model->Productdelete($package_product_id);
		redirect(site_url('Admin/Package/Product/'.$redirect));
	}

	public function GetProductVariants($id)
	{
		$this->load->model('Admin/Product_model');
		$q = $this->Product_model->GetProductVariants($id);
		echo json_encode($q);
	}

	//
	public function Sub($id)
	{
		
		$data = new StdClass;
		$data->mainMenu = 'Package';
		$data->subMenu  = 'PackageList';
		$data->package_id = $id;
		$data->list = $this->Package_model->GetPackageSubs($id);

		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/package_sub_list', $data);
		$this->load->view('Admin/footer');
	}

	public function SubAdd($id)
	{
		$this->load->model('Language_model');

		$data = new StdClass;

		$data->mainMenu = 'Package';
		$data->subMenu  = 'PackageAdd';

		$data->package_id = $id;

		$data->Langs = $this->Language_model->GetLangListShortId();

		$this->load->view('Admin/header',$data);
		$this->load->view('Admin/package_sub_add');
		$this->load->view('Admin/footer');
	}

	public function SubSetAdd($id)
	{
		$data = new StdClass;

		if ($this->input->post()) {
			$data->title 		= $this->input->post('title', true);
			$data->old_price 	= $this->input->post('old_price', true);
			$data->price 		= $this->input->post('price', true);
			$data->design_price	= $this->input->post('design_price', true);
			$lang 				= reverseArray($this->input->post());

			foreach ($lang as $key => $val) {
				$lang[$key]['slug'] = url_seo($val['name']);

				$lang[$key]['banner'] = $this->session->userdata('banner_img_'.$key.'_1');
				$this->session->unset_userdata('banner_img_'.$key.'_1');

				$lang[$key]['mainImage'] = $this->session->userdata('banner_img_'.$key.'_3');
				$this->session->unset_userdata('banner_img_'.$key.'_3');
			}

			$data->package_id = $id;
			if ($this->Package_model->SetAddSubPackage($data,$lang)) {
				$this->session->set_flashdata('okey',1);
			}else{
				$this->session->set_flashdata('hata',1);
			}
		}
		redirect(site_url('Admin/Package/Sub/'.$id));
	}

	public function SubDelete($id,$package_id)
	{
		$this->Package_model->subDelete($id);
		redirect(site_url('Admin/Package/Sub/'.$package_id));

	}

	public function SubUpdate($id)
	{
		$this->load->model('Language_model');

		$data = new StdClass;

		$data->mainMenu = 'Package';
		$data->subMenu  = 'PackageList';

		$data->values = $this->Package_model->GetSubPackageById($id);

		//prex($data->values);

		$this->load->view('Admin/header',$data);
		$this->load->view('Admin/package_sub_update', $data);
		$this->load->view('Admin/footer');
	}

	public function SubSetUpdate($id,$redirect)
	{

		$data = new StdClass;
		if ($this->input->post()) {
			$data->title 		= $this->input->post('title', true);
			$data->old_price 	= $this->input->post('old_price', true);
			$data->price 		= $this->input->post('price', true);
			$data->design_price	= $this->input->post('design_price', true);

			$lang = reverseArray($this->input->post());
			foreach ($lang as $key => $val) {
				$lang[$key]['slug'] = url_seo($val['name']);
				$lang[$key]['banner'] = $this->session->userdata('banner_img_'.$key.'_1');
				$this->session->unset_userdata('banner_img_'.$key.'_1');

				$lang[$key]['mainImage'] = $this->session->userdata('banner_img_'.$key.'_3');
				$this->session->unset_userdata('banner_img_'.$key.'_3');
			}

			//prex($lang);
			//prex($data);

			if ($this->Package_model->UpdateSubPackage($data,$lang,$id)) {
				$this->session->set_flashdata('okey',1);
			}else{
				$this->session->set_flashdata('hata',1);
			}
		}
		redirect(site_url('Admin/Package/Sub/'.$redirect));

	}
}
?>