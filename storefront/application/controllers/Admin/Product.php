<?php 
/**
* Product Module Build By Uğur Yetkil
*/
class Product extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Admin/Product_model');
		$this->load->model('Admin/Language_model','Lang');
		$this->load->model('Admin/ImageUpload');
	}

	public function index()
	{

		$this->checkLogin();
		if ($this->session->userdata('user')->auth != 0 && $this->session->userdata('user')->auth != 2 && $this->session->userdata('user')->auth !=3) 
		{
				redirect(site_url('Admin'));
		}

		$data = new StdClass;
		$data->mainMenu = 'Product';
		$data->subMenu  = 'ProductList';
		$sayfa = $this->input->get('s', true);

		if ($sayfa == "" || $sayfa < 1) 
		{
			redirect(site_url('Admin/Product?s=1'));
		}
		
		$q = $this->Product_model->getList($sayfa);
		if ($q!=false) 
		{
			if ($sayfa < 2) 
			{
				$data->prevPage = 1;
			}
			else
			{
				$data->prevPage = $sayfa-1;
			}
			if ($sayfa >= ceil($q->pageCount)) 
			{
				$data->nextPage = ceil($q->pageCount);
			}
			else
			{
				$data->nextPage = ceil($sayfa+1);
			}
			$data->list 		= $q->list;
			$data->selectedPage = $sayfa;
			$data->pageCount 	= $q->pageCount;
		}
		else
		{
			$data->prevPage 	= 1;
			$data->nextPage 	= 1;
			$data->list 		= array();
			$data->selectedPage = 1;
			$data->pageCount 	= 1;
		}
		$data->data_get_url = get_url("Admin/Product");
		$this->load->view('Admin/header',$data);
		$this->load->view('Admin/product_list', $data);
		$this->load->view('Admin/footer');
	}
	
	public function add()
	{

		$this->checkLogin();
		if ($this->session->userdata('user')->auth != 0 && $this->session->userdata('user')->auth != 2 && $this->session->userdata('user')->auth !=3) 
		{
				redirect(site_url('Admin'));
		}

		$this->session->unset_userdata('theme_img');
		$this->session->unset_userdata('productImage');

		$data = new StdClass;

		$data->mainMenu = 'Product';
		$data->subMenu  = 'ProductAdd';

		$data->Langs = $this->Lang->GetLangListShortId();

		$this->load->view('Admin/header',$data);
		$this->load->view('Admin/product_add', $data);
		$this->load->view('Admin/footer');
	}
	
	public function update($id)
	{

		$this->checkLogin();
		if ($this->session->userdata('user')->auth != 0 && $this->session->userdata('user')->auth != 2 && $this->session->userdata('user')->auth !=3) 
		{
				redirect(site_url('Admin'));
		}

		$this->session->unset_userdata('theme_img');
		$this->session->unset_userdata('productImage');

		$data 	= new StdClass;
		$return = $this->Product_model->getAllFieldById($id);

		if ($return == false) {
			redirect(site_url('Admin/Product'));
		}

		$data->products = $return['data'];
		$data->images = $return['images'];
		$data->theme_img = $return['theme_img'];

		$data->mainMenu = 'Product';
		$data->subMenu  = 'ProductList';

		$data->Langs = $this->Lang->GetLangListShortId();

		$this->load->view('Admin/header',$data);
		$this->load->view('Admin/product_update', $data);
		$this->load->view('Admin/footer');
	}

	
	public function deleteProduct($id)
	{
		$this->checkLogin();
		if ($this->session->userdata('user')->auth != 0 && $this->session->userdata('user')->auth != 2 && $this->session->userdata('user')->auth !=3) 
		{
				redirect(site_url('Admin'));
		}
		$this->Product_model->delete($id);
		redirect(site_url('Admin/Product'));
	}

	public function SetStatus($id,$status,$page)
	{

		$this->checkLogin();
		if ($this->session->userdata('user')->auth != 0 && $this->session->userdata('user')->auth != 2 && $this->session->userdata('user')->auth !=3) 
		{
				redirect(site_url('Admin'));
		}
		try {
			$this->Product_model->SetStatusById($id,$status);
			redirect(site_url('Admin/Product?s='.$page));
		} catch (Exception $e) {
			redirect(site_url('Admin/Product?s='.$page));
		}
	}

	public function SetUpdate($id)
	{
		$this->checkLogin();
		if ($this->session->userdata('user')->auth != 0 && $this->session->userdata('user')->auth != 2 && $this->session->userdata('user')->auth !=3) 
		{
				redirect(site_url('Admin'));
		}
		if ($this->input->post()) {
			$data = new StdClass;

			$data->product_title 	= $this->input->post('title',true);
			$data->product_price 	= $this->input->post('price',true);
			$data->creative_price 	= $this->input->post('tasarim_price',true);
			$data->payment_type	 	= $this->input->post('payment_type',true);
			$data->validTemplate 	= $this->input->post('tepmlate_name',true);


			$q = $this->input->post();
			unset($q['tepmlate_name']);
			$data->langdata = reverseArray($q);

			$q = $this->Product_model->setUpdate($data,$id);

			if ($q) {
				$this->session->set_flashdata('okey',1);
			}else{
				$this->session->set_flashdata('hata',1);
			}
		}

		redirect(site_url('Admin/Product/update/'.$id));
	}

	public function FileUpload($is_id)
	{	
		$this->checkLogin();
		if ($this->session->userdata('user')->auth != 0 && $this->session->userdata('user')->auth != 2 && $this->session->userdata('user')->auth !=3) 
		{
				redirect(site_url('Admin'));
		}
		echo $this->ImageUpload->UploadProductImages($is_id);
	}

	public function SetAdd()
	{
		$this->checkLogin();
		if ($this->session->userdata('user')->auth != 0 && $this->session->userdata('user')->auth != 2 && $this->session->userdata('user')->auth !=3) 
		{
			redirect(site_url('Admin'));
		}
		if ($this->input->post()) {
			$data = new StdClass;
			
			$data->product_title 	= $this->input->post('title',true);
			$data->product_price 	= $this->input->post('price',true);
			$data->creative_price 	= $this->input->post('tasarim_price',true);
			$data->payment_type	 	= $this->input->post('payment_type',true);

			$langdata = reverseArray($this->input->post());

			if ($this->Product_model->addProduct($data,$langdata)) {
				$this->session->set_flashdata('okey',1);
			}else{
				$this->session->set_flashdata('hata',1);
			}
		}
		redirect(site_url('Admin/Product/Add'));
	}

	public function deleteimg($id)
	{
		$this->checkLogin();
		if ($this->session->userdata('user')->auth != 0 && $this->session->userdata('user')->auth != 2 && $this->session->userdata('user')->auth !=3) 
		{
				redirect(site_url('Admin'));
		}
		$q = $this->Product_model->deleteImg($id);
		
		if ($q == 1) {
			echo 1;
		}elseif($q == 2){
			echo 2;
		}else{
			echo 0;
		}
	}

	public function deleteTemplateImg($id)
	{
		$this->checkLogin();
		if ($this->session->userdata('user')->auth != 0 && $this->session->userdata('user')->auth != 2 && $this->session->userdata('user')->auth !=3) 
		{
				redirect(site_url('Admin'));
		}
		$q = $this->Product_model->deleteTemplateImg($id);
		if ($q == 1) {
			echo 1;
		}else{
			echo 0;
		}
	}

	public function defaultImg($id)
	{
		$this->checkLogin();
		if ($this->session->userdata('user')->auth != 0 && $this->session->userdata('user')->auth != 2 && $this->session->userdata('user')->auth !=3) 
		{
				redirect(site_url('Admin'));
		}
		$q = $this->Product_model->SetDefault($id);
		if ($q) {
			echo 1;
		}else{
			echo 0;
		}
	}

	public function kategori($id)
	{
		$this->checkLogin();
		if ($this->session->userdata('user')->auth != 0 && $this->session->userdata('user')->auth != 2 && $this->session->userdata('user')->auth !=3) 
		{
				redirect(site_url('Admin'));
		}
		$data = new StdClass;

		$data->mainMenu = 'Product';
		$data->subMenu  = 'ProductList';


		$data->product_id = $id;
		$data->list = $this->Product_model->getCategoryByProduct($id);

		$this->load->view('Admin/header',$data);
		$this->load->view('Admin/product_category', $data);
		$this->load->view('Admin/footer');
	}


	public function fiyatlama($id)
	{
		$this->checkLogin();
		if ($this->session->userdata('user')->auth != 0 && $this->session->userdata('user')->auth != 2 && $this->session->userdata('user')->auth !=3) 
		{
				redirect(site_url('Admin'));
		}
		$data = new StdClass;
		$a = array();
		$all = array();

		$data->mainMenu = 'Product';
		$data->subMenu  = 'ProductList';

		$data->product_id 	= $id;
		$data->productName 	= $this->Product_model->getProductName($id);
		$allProductsVariants = $this->Product_model->GetProductVariants($id);

		foreach ($allProductsVariants as $key => $val) {
			foreach ($val->childs as $key2 => $val2) {
				$a[] = $val2;
			}
			$all[] = $a;
			$a = array();
		}

		$data->validatePrice = $this->Product_model->GetProductPrice($id);

		$data->list = generate_combinations($all);
		$this->load->view('Admin/header',$data);
		$this->load->view('Admin/product_price');
		$this->load->view('Admin/footer');
	}

	public function fiyatlamaKaydet($id)
	{
		$a = array();
		$q = json_decode($this->input->post('jsondata',true));
		foreach ($q as $key => $val) {
			if ($key == 0) {
				$name = 'price';
			}else if($key == 1){
				$name = 'key';
			}else{
				$name = 'product_id';
			}

			foreach ($val as $key2 => $val2) {
				foreach ($val2 as $key3 => $val3) {
					$a[$name][$key3] = $val3;   
				}
			}
		}
		$q = reverseArray($a);
		foreach ($q as $key => $val) {
			if ($val['price'] > 1) {
				$q[$key]['price'] = ($val['price']*1.2)+(($val['price']*1.2)*0.0285+0.25)+((($val['price']*1.2)-$val['price'])*0.18);
			}
		}

		$this->Product_model->SetProductPrice($q,$id);
		redirect('Admin/Product/fiyatlama/'.$id);
	}

	public function deleteFromCategory($id,$product_id)
	{
		$this->checkLogin();
		if ($this->session->userdata('user')->auth != 0 && $this->session->userdata('user')->auth != 2 && $this->session->userdata('user')->auth !=3) 
		{
				redirect(site_url('Admin'));
		}
		$this->Product_model->deleteFromCategory($id);
		redirect(site_url('Admin/Product/kategori/'.$product_id));
	}

	public function kategoriEkle($id)
	{
		$this->checkLogin();
		if ($this->session->userdata('user')->auth != 0 && $this->session->userdata('user')->auth != 2 && $this->session->userdata('user')->auth !=3) 
		{
				redirect(site_url('Admin'));
		}
		$this->load->model('Admin/Category_model', 'CM');

		$data = new StdClass;

		$data->mainMenu = 'Product';
		$data->subMenu  = 'ProductList';

		$data->product_id = $id;

		$categories 		= $this->CM->getCategoryAll();
		$selectedCategories = $this->Product_model->getCategoryByProductGetCategoryId($id);

	 	foreach ($categories as $key => $val) { 
			$i =0;
			foreach ($selectedCategories as $key2 => $val2) {
				if ($val2->id == $val->id) {
					$i++;
				}
			}
			if ($i == 0) { 
				$a[] = '<option value="'.$val->id.'">'.$val->name.'</option>';
			}
		}
		if (empty($a)) {
			redirect(site_url('Admin/Product/kategori/'.$id));
		}else{
			$data->categories = $a;
		}
		$this->load->view('Admin/header',$data);
		$this->load->view('Admin/product_category_add', $data);
		$this->load->view('Admin/footer');
	}

	public function SetKategoriEkle($id)
	{
		$this->checkLogin();
		if ($this->session->userdata('user')->auth != 0 && $this->session->userdata('user')->auth != 2 && $this->session->userdata('user')->auth !=3) 
		{
				redirect(site_url('Admin'));
		}
		if ($this->input->post('category')) {
			$category = $this->input->post('category');
			if ($this->Product_model->addProductCategory($id,$category)) {
				$this->session->set_flashdata('okey',1);
			}else{
				$this->session->set_flashdata('hata',1);
			}
		}else{
			$this->session->set_flashdata('hata',1);
		}

		redirect(site_url('Admin/Product/kategori/'.$id));
	}

	public function Variant($id)
	{
		$this->checkLogin();
		if ($this->session->userdata('user')->auth != 0 && $this->session->userdata('user')->auth != 2 && $this->session->userdata('user')->auth !=3) 
		{
				redirect(site_url('Admin'));
		}
		$data = new StdClass;

		$data->mainMenu = 'Product';
		$data->subMenu  = 'ProductList';


		$data->product_id = $id;
		$data->list = $this->Product_model->getVaryantByProduct($id);

		$this->load->view('Admin/header',$data);
		$this->load->view('Admin/product_variant', $data);
		$this->load->view('Admin/footer');
	}

	public function deleteFromVaryant($id,$product_id)
	{
		$this->checkLogin();
		if ($this->session->userdata('user')->auth != 0 && $this->session->userdata('user')->auth != 2 && $this->session->userdata('user')->auth !=3) 
		{
				redirect(site_url('Admin'));
		}
		$this->Product_model->deleteFromVaryant($id);
		redirect(site_url('Admin/Product/Variant/'.$product_id));
	}

	public function VariantEkle($id)
	{
		$this->checkLogin();
		if ($this->session->userdata('user')->auth != 0 && $this->session->userdata('user')->auth != 2 && $this->session->userdata('user')->auth !=3) 
		{
				redirect(site_url('Admin'));
		}
		$this->load->model('Admin/Variant_model', 'VM');

		$data = new StdClass;

		$data->mainMenu = 'Product';
		$data->subMenu  = 'ProductList';

		$data->product_id = $id;

		$varyants 			= $this->VM->getVaryantAll();
		$selectedVaryants 	= $this->Product_model->getVaryantByProductGetVaryantId($id);
	 	foreach ($varyants as $key => $val) { 
			$i =0;
			foreach ($selectedVaryants as $key2 => $val2) {
				if ($val2->id == $val->id) {
					$i++;
				}
			}
			if ($i == 0) { 
				$a[] = '<option value="'.$val->id.'">'.$val->name.'</option>';
			}
		}

		if (empty($a)) {
			redirect(site_url('Admin/Product/Variant/'.$id));
		}else{
			$data->varyant = $a;
		}
		$this->load->view('Admin/header',$data);
		$this->load->view('Admin/product_variant_add', $data);
		$this->load->view('Admin/footer');
	}

	public function SetVariantEkle($id)
	{
		$this->checkLogin();
		if ($this->session->userdata('user')->auth != 0 && $this->session->userdata('user')->auth != 2 && $this->session->userdata('user')->auth !=3) 
		{
				redirect(site_url('Admin'));
		}
		if ($this->input->post('variant')) {
			$variant 	= $this->input->post('variant');
			$type 		= $this->input->post('type');
			if ($this->Product_model->addProductVariant($id,$variant,$type)) {
				$this->session->set_flashdata('okey',1);
			}else{
				$this->session->set_flashdata('hata',1);
			}
		}else{
			$this->session->set_flashdata('hata',1);
		}

		redirect(site_url('Admin/Product/Variant/'.$id));
	}

	public function VariantChilds($id)
	{
		$this->checkLogin();
		if ($this->session->userdata('user')->auth != 0 && $this->session->userdata('user')->auth != 2 && $this->session->userdata('user')->auth !=3) 
		{
				redirect(site_url('Admin'));
		}
		$data = new StdClass;

		$data->mainMenu = 'Product';
		$data->subMenu  = 'ProductList';

		$data->product_variant = $id;
		$data->list = $this->Product_model->getSubVariants($id);

		$this->load->view('Admin/header',$data);
		$this->load->view('Admin/product_variant_sub', $data);
		$this->load->view('Admin/footer');
	}

	public function deleteFromSubVariant($id,$return_id)
	{
		$this->checkLogin();
		if ($this->session->userdata('user')->auth != 0 && $this->session->userdata('user')->auth != 2 && $this->session->userdata('user')->auth !=3) 
		{
				redirect(site_url('Admin'));
		}
		$this->Product_model->deleteFromSubVariant($id);
		redirect(site_url('Admin/Product/VariantChilds/'.$return_id.'?urun='.$_GET['urun']));
	}

	public function VariantChildAdd($id)
	{
		$this->checkLogin();
		if ($this->session->userdata('user')->auth != 0 && $this->session->userdata('user')->auth != 2 && $this->session->userdata('user')->auth !=3) 
		{
				redirect(site_url('Admin'));
		}
		$data = new StdClass;

		$data->mainMenu = 'Product';
		$data->subMenu  = 'ProductList';

		//product id değil ama değişştirimeye üşendiğimden dolayı  öyle yazıyo
		$data->product_id = $id;

		$SubVaryants 			= $this->Product_model->getVaryantChildAll($id);

		$selectedSubVaryants 	= $this->Product_model->getSubVaryantByProductGetSubVaryantId($id);


	 	foreach ($SubVaryants as $key => $val) { 
			$i =0;
			foreach ($selectedSubVaryants as $key2 => $val2) {
				if ($val2->id == $val->id) {
					$i++;
				}
			}
			if ($i == 0) { 
				$a[] = '<option value="'.$val->id.'">'.$val->name.'</option>';
			}
		}

		if (empty($a)) {
			redirect(site_url('Admin/Product/VariantChilds/'.$id));
		}else{
			$data->SubVariant = $a;
		}
		$this->load->view('Admin/header',$data);
		$this->load->view('Admin/product_variant_child_add', $data);
		$this->load->view('Admin/footer');
	}

	public function SetVariantChildEkle($id)
	{
		$this->checkLogin();
		if ($this->session->userdata('user')->auth != 0 && $this->session->userdata('user')->auth != 2 && $this->session->userdata('user')->auth !=3) 
		{
				redirect(site_url('Admin'));
		}
		if ($this->input->post('altvaryant')) {
			$altvaryant = $this->input->post('altvaryant');
			if ($this->Product_model->addSubVariant($id,$altvaryant)) {
				$this->session->set_flashdata('okey',1);
			}else{
				$this->session->set_flashdata('hata',1);
			}
		}else{
			$this->session->set_flashdata('hata',1);
		}
		$ustvaryantid = (int)$_GET['urun'];
		redirect(site_url('Admin/Product/VariantChilds/'.$id.'?urun='.$ustvaryantid));
	}

	public function SetVariantSort($id)
	{
		$this->checkLogin();
		if ($this->session->userdata('user')->auth != 0 && $this->session->userdata('user')->auth != 2 && $this->session->userdata('user')->auth !=3) 
		{
				redirect(site_url('Admin'));
		}
		$sort = $this->input->post('sort',true);
		$this->Product_model->SetVariantSort($sort);
		redirect(site_url('Admin/Product/Variant/'.$id));
	}

	public function SetVariantSubSort($id,$ustvariant)
	{
		$this->checkLogin();
		if ($this->session->userdata('user')->auth != 0 && $this->session->userdata('user')->auth != 2 && $this->session->userdata('user')->auth !=3) 
		{
				redirect(site_url('Admin'));
		}
		$sort = $this->input->post('sort',true);
		$this->Product_model->SetVariantSubSort($sort);
		redirect(site_url('Admin/Product/VariantChilds/'.$id.'?urun='.$ustvariant));
	}
}

?>