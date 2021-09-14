<?defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->checkLogin();
		$this->load->model('Admin/Category_model');
		if ($this->session->userdata('user')->auth != 0 && $this->session->userdata('user')->auth != 2) 
		{
			redirect(site_url('Admin'));
		}
	}

	public function index()
	{
		$data = new StdClass();
		$header_data = new StdClass();
		$header_data->mainMenu = 'Product';
		$header_data->subMenu  = 'CatList';
		$data->categories = $this->Api_model->getCategories();
        $data->categoryDetails = $this->Global_model->getAllCategoryDetail();
        $data->categories = $this->Global_model->getCategoryDetail($data->categories,$data->categoryDetails);
		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/category', $data);
		$this->load->view('Admin/footer');
	}


	public function editCategory($id = '')
	{
		if (empty($id) || !ctype_digit($id)) {
			redirect(admin_url('Category'));
		}
		$adminInfo = $this->session->userdata('user');
		$data = new StdClass();

		if (strlen($id)>2) {
			$data->isKod3 = true;
		}else{
			$data->isKod3 = false;
		}

		if (strlen($id) == 1) {
			$data->isUstCat = true;
		}else{
			$data->isUstCat = false;
		}

		$data->categories = $this->Api_model->getCategories();
		$data->id = $id;
		$data->mainMenu = 'Product';
		$data->subMenu  = 'CatList';
		$data->categoryInfo = $this->Category_model->getCategoryInfoById($id);
		if ($this->input->post() || !empty($this->session->flashdata('image'))) {
			$getAllPosts = $this->getAllPosts();

			$getAllPosts->administrator_id = $adminInfo->Id;

			foreach ($data->categories as $key => $value) {
				if ($value->GRUP_KOD == $id) {
					$getAllPosts->slug = url_seo(replaceStringProblemsReverse($value->GRUP_ISIM));
				} else {
					foreach ($value->sub as $key => $lowerCategoryInfo) {
						if ($lowerCategoryInfo->GRUP_KOD == $id) {
							$getAllPosts->slug = url_seo(replaceStringProblemsReverse($lowerCategoryInfo->GRUP_ISIM));
						} else {
							foreach ($lowerCategoryInfo->sub as $key => $contentInfo) {
								if ($contentInfo->GRUP_KOD == $id) {
									$getAllPosts->slug = url_seo(replaceStringProblemsReverse($contentInfo->GRUP_ISIM));
								}
							}
						}
					}
				}
			}

			if (empty($this->session->flashdata('image'))) {
				$getAllPosts->image = $data->categoryInfo->image;
			} else {
				$getAllPosts->image = $this->session->flashdata('image');
			}
			if ($this->Category_model->updateCategoryAndId($getAllPosts,$id)) {
				$this->session->set_flashdata('onay',1);
			} else {
				$this->session->set_flashdata('hata',1);
			}
            redirect(site_url('Admin/Category/editCategory/'.$id));
		}

		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/edit_category');
		$this->load->view('Admin/footer');
	}

	public function ImageUpload()
	{	
		$sonuc = $this->Category_model->imageUpload();
		if ($sonuc != false) {
			$this->session->set_flashdata('image', $sonuc);
		}
	}

	public function favoritesProduct()
	{
		$data = new StdClass();
		$header_data = new StdClass();
		$header_data->mainMenu = 'Product';
		$header_data->subMenu  = 'favList';
		$data->categories = $this->Api_model->getCategories();
		prex($data->categories);
		if ($this->input->post()) {
			$getAllPosts = $this->getAllPosts();
			if (count($getAllPosts->product_id) < 9) {
				$updateProductArray = array();
				foreach ($getAllPosts->product_id as $key => $val) {
					$updateProductArray[$key]['product_id'] = $val;
				}
				if ($this->Category_model->updateFavorites($updateProductArray)) {
					$this->session->set_flashdata('onay',1);
					redirect(admin_url('Category/favoritesProduct'));
				} else {
					$this->session->set_flashdata('hata',1);
					redirect(admin_url('Category/favoritesProduct'));
				}
			} else {
				$this->session->set_flashdata('uyari',1);
				redirect(admin_url('Category/favoritesProduct'));
			}
		}
		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/favorites_list', $data);
		$this->load->view('Admin/footer');	
	}

	/* Alt Taraf Tamamıyla Eski Sistemin Silinebilir*/
	public function Add()
	{
		$header_data = new StdClass;
		$header_data->mainMenu = 'Product';
		$header_data->subMenu  = 'CatAdd';

		if ($_POST) {
			$tag = $this->input->post('tag', true);
			$sort = $this->input->post('sort', true);
			$menu = $this->input->post('menu', true);
			$lang = $this->input->post('lang', true);
			$exp  = $this->input->post('exp',true);
			$category_slug = $this->input->post('category_slug', true);
			if ($this->Category_model->addCategory($sort, $menu, $tag, $lang, $category_slug, $exp)) {
				$this->session->set_flashdata('category_result1', 'Kategori eklendi.');
				$this->session->set_flashdata('category_result2', 'success');
				redirect(admin_url('Category/add'));
			} else {
				$this->session->set_flashdata('category_result1', 'Bir hata oluştu.');
				$this->session->set_flashdata('category_result2', 'danger');
			}
		}

		$data['sonuc'] = array($this->session->flashdata('category_result1'), $this->session->flashdata('category_result2'));
		$data['langs'] = $this->Category_model->GetLangListForCategory();

		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/category_add', $data);
		$this->load->view('Admin/footer');
	}

	public function Update($catid = 0)
	{
		$catid = (int)$catid;
		if ($catid == 0) {
			redirect(admin_url('Category'));
		}
		$header_data = new StdClass;
		$header_data->mainMenu = 'Product';
		$header_data->subMenu  = 'CatList';

		$this->load->view('Admin/header', $header_data);
		if ($_POST) {
			$tag = $this->input->post('tag', true);
			$sort = $this->input->post('sort', true);
			$menu = $this->input->post('menu', true);
			$lang = $this->input->post('lang', true);
			$exp = $this->input->post('exp', true);
			$newlang = $this->input->post('newlang', true);
			$category_slug = $this->input->post('category_slug', true);
			if ($this->Category_model->updateCategory($catid, $sort, $menu, $tag, $lang, $category_slug, $newlang,$exp)) {
				$this->session->set_flashdata('category_result1', 'Kategori güncellendi.');
				$this->session->set_flashdata('category_result2', 'success');
				redirect(admin_url('Category/update/'.$catid));
			} else {
				$this->session->set_flashdata('category_result1', 'Bir hata oluştu.');
				$this->session->set_flashdata('category_result2', 'danger');
			}
		}
		$data['sonuc'] = array($this->session->flashdata('category_result1'), $this->session->flashdata('category_result2'));
		$data['categories'] = $this->Category_model->getCategoriesById($catid);
		$this->load->view('Admin/category_update', $data);
		$this->load->view('Admin/footer');
	}

	public function SetStatus($id, $new)
	{
		try {
			$this->Category_model->updateStatusById($id,$new);
			redirect(site_url('Admin/Category'));
		} catch (Exception $e) {
			redirect(site_url('Admin/Category'));
		}
	}

	public function Delete($id = 0)
	{
		if ($id == 0) {
			redirect(site_url('Admin/Category'));
		}
		if ($this->Category_model->deleteById($id)) {
			$this->session->set_flashdata('category_result1', 'Kategori silindi.');
			$this->session->set_flashdata('category_result2', 'success');
			redirect(site_url('Admin/Category'));
		} else {
			$this->session->set_flashdata('category_result1', 'Bir hata oluştu.');
			$this->session->set_flashdata('category_result2', 'danger');
			redirect(site_url('Admin/Category'));
		}
		
	}
	public function productMust()
	{
		$header_data = new StdClass;
		$header_data->mainMenu = 'Product';
		$header_data->subMenu  = 'productMust';
		
		$data['categories'] = $this->Category_model->getAllCategories();

		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/product_must', $data);
		$this->load->view('Admin/footer');
	}
	public function productGet($Id)
	{
		$header_data = new StdClass;
		$data 		 = new StdClass;
		$header_data->mainMenu = 'Product';
		$header_data->subMenu  = 'productMust';
		
		$data->category_info = $this->Category_model->getCat($Id);
		$data->product_info  = $this->Category_model->getProduct($Id);
		$data->backId 		 = $Id;
		
		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/category_must',$data);
		$this->load->view('Admin/footer');
	}
	public function SetVariantSort($backId)
	{
		$sort = $this->input->post('sort',true);
		$this->Category_model->SetVariantSort($sort);
		redirect(site_url('Admin/Category/productGet/'.$backId));
	}

}
?>