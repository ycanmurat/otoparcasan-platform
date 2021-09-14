<?defined('BASEPATH') OR exit('No direct script access allowed');

class Sellers extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->checkLogin();
		$this->load->model('Admin/Sellers_model','SM');
	}
	
	public function index()
	{
		$header_data = new StdClass();
		$data = new StdClass();
		$header_data->mainMenu = 'Content';
		$header_data->subMenu  = 'sellerList';
		$header_data->lowerMenu = 'HomePageContent';
		$data->sellers = $this->SM->getSellers();
		$this->load->view('Admin/header',$header_data);
		$this->load->view('Admin/seller',$data);
		$this->load->view('Admin/footer');
	}

	public function add()
	{
		$header_data = new StdClass();
		$data = new StdClass();
		$header_data->mainMenu = 'Content';
		$header_data->subMenu  = 'sellerList';
		$header_data->lowerMenu = 'HomePageContent';
		
		if ($this->input->post()) {
			$allPost = $this->GetAllPosts();
			$allPost->title = strtoupper($allPost->title);
			$allPost->link = url_seo($allPost->link);
			$allPost->image = $this->session->flashdata('image');
			if ($this->SM->addSeller($allPost)) {
				$this->session->set_flashdata('onay',1);
				redirect(admin_url('Sellers/Add'));
			} else {
				$this->session->set_flashdata('hata',1);
				redirect(admin_url('Sellers/Add'));
			}
		}

		$this->load->view('Admin/header',$header_data);
		$this->load->view('Admin/seller_add',$data);
		$this->load->view('Admin/footer');
	}

	public function editSellers($id)
	{
		$header_data = new StdClass();
		$data = new StdClass();
		$header_data->mainMenu = 'Content';
		$header_data->subMenu  = 'sellerList';
		$header_data->lowerMenu = 'HomePageContent';
		$data->sellerInfo = $this->SM->getSellersById($id);
		if ($this->input->post()) {
			$allPost = $this->GetAllPosts();
			$allPost->title = strtoupper($allPost->title);
			$allPost->link = url_seo($allPost->link);
			if (empty($this->session->flashdata('image'))) {
				$allPost->image = $data->sellerInfo->image;
			} else {
				$allPost->image = $this->session->flashdata('image');
			}
			if ($this->SM->updateSeller($allPost,$id)) {
				$this->session->set_flashdata('onay',1);
				redirect(admin_url('Sellers/editSellers/'.$id));
			} else {
				$this->session->set_flashdata('hata',1);
				redirect(admin_url('Sellers/editSellers/'.$id));
			}
		}
		$data->sellerInfo = $this->SM->getSellersById($id);
		$this->load->view('Admin/header',$header_data);
		$this->load->view('Admin/seller_edit',$data);
		$this->load->view('Admin/footer');	
	}

	public function deleteSellers($id)
	{
		if ($this->SM->deleteSellers($id)) {
			redirect(admin_url('Sellers'));
		} else {
			redirect(admin_url('Sellers'));
		}
	}

	public function imageMust()
	{
		$sort = $this->input->post('sort',true);
		$this->SM->SetVariantSort($sort);
		redirect(admin_url('Sellers'));
	}

	public function statusUpdate($id,$status)
	{
		if ($this->SM->statusUpdate($id,$status)) {
			redirect(admin_url('Sellers'));
		} else {
			redirect(admin_url('Sellers'));
		}
	}

	public function ImageUpload()
	{	
		$result = $this->SM->ImageUpload();
		if ($result != false) {
			$this->session->set_flashdata('image', $result);
		}
	}
}