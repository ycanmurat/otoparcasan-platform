<?if(!defined('BASEPATH'))exit('No direct script access allowed');

class Faq extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Admin/Faq_model');
		$this->checkLogin();
	}

	public function index()
	{
		$header_data = new StdClass;
		$data = new StdClass;
		$header_data->mainMenu = 'Faq';
		$header_data->subMenu = 'faqList';
		$data->getFaq = $this->Faq_model->getFaq();
		$this->load->view('Admin/header',$header_data);
		$this->load->view('Admin/faq',$data);
		$this->load->view('Admin/footer');
	}

	public function add()
	{
		$header_data 			= new StdClass;
		$data 		 			= new StdClass;
		$header_data->mainMenu 	= 'Faq';
		$header_data->subMenu 	= 'faqAdd';
		if ($this->input->post()) {
			$getAllPosts = $this->getAllPosts();
			if ($this->Faq_model->insertQuestion($getAllPosts)) {
				$this->session->set_flashdata('onay','1');
			} else {
				$this->session->set_flashdata('hata','1');
			}
		}
		$this->load->view('Admin/header',$header_data);
		$this->load->view('Admin/faq_add',$data);
		$this->load->view('Admin/footer');
	}

	public function faqStatusUpdate($id,$newInfo)
	{
		if($this->Faq_model->faqStatusUpdate($id,$newInfo)){
			redirect(admin_url('Faq'));
		}else{
			redirect(admin_url('Faq'));
		}
	}

	public function deleteFaq($id)
	{
		if($this->Faq_model->deleteFaq($id)){
			redirect(admin_url('Faq'));
		}else{
			redirect(admin_url('Faq'));
		}
	}

	public function faqSort()
	{
		$sort = $this->input->post('sort',true);
		$this->Faq_model->SetSort($sort);
		redirect(admin_url('Faq'));
	}

	public function updateFaq($id)
	{
		$header_data 			= new StdClass;
		$data 		 			= new StdClass;
		$header_data->mainMenu 	= 'Faq';
		$header_data->subMenu 	= 'FaqList';
		if ($this->input->post()) {
			$getAllPosts = $this->getAllPosts();
			if ($this->Faq_model->updateQuestion($id,$getAllPosts)) {
				$this->session->set_flashdata('onay','1');
			}else{
				$this->session->set_flashdata('hata','1');
			}
		}
		$data->Question = $this->Faq_model->getQuery($id);
		$this->load->view('Admin/header',$header_data);
		$this->load->view('Admin/faq_edit',$data);
		$this->load->view('Admin/footer');
	}
}
?>