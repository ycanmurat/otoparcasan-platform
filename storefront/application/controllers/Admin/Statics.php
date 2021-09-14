<?php 
/**
* 
*/
class Statics extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->checkLogin();
		$this->load->model('Admin/Statics_model');
		if ($this->session->userdata('user')->auth != 0 && $this->session->userdata('user')->auth != 2) 
		{
			redirect(site_url('Admin'));
		}
	}

	public function index()
	{
		$data = new StdClass;
		$header_data = new stdClass();
		$header_data->mainMenu 	 = 'Content';
		$header_data->subMenu = 'StaticsList';
		$header_data->lowerMenu = 'CorporateContent';

		$data->list = $this->Statics_model->GetStaticPagesAll();

		$this->load->view('Admin/header',$header_data);
		$this->load->view('Admin/statics_list', $data);
		$this->load->view('Admin/footer');
	}

	public function SetStatus($id,$new)
	{
		try {
			$this->Statics_model->SetStatusById($id,$new);
			redirect(site_url('Admin/Statics'));
		} catch (Exception $e) {
			redirect(site_url('Admin/Statics'));
		}
	}

	public function delete($id)
	{
		if ($this->Statics_model->delete($id)) {
			$this->session->set_flashdata('okey',1);
		}else{
			$this->session->set_flashdata('hata',1);
		}
		redirect(site_url('Admin/Statics'));
	}

	public function update($static_id)
	{
		$data = new StdClass;
		
		$data->mainMenu 	 = 'Content';
		$data->subMenu = 'StaticsList';
		$data->lowerMenu = 'CorporateContent';
		$data->id 		= $static_id;

		$data->List = $this->Statics_model->GetAllStatics($static_id);
		if ($data->List == false) {
			redirect(site_url('Admin/Statics'));
		}

		$this->load->view('Admin/header',$data);
		$this->load->view('Admin/statics_update');
		$this->load->view('Admin/footer');
	}

	public function SetUpdate($id)
	{
		$q = $this->input->post();

		$title = $this->input->post('title',true);

		unset($q['title']);

		$q = reverseArray($q);

		if ($this->Statics_model->Update($id,$title,$q)) {
			$this->session->set_flashdata('okey',1);
		}else{
			$this->session->set_flashdata('hata',1);
		}

		redirect(site_url('Admin/Statics/update/'.$id));
	}

	public function Add()
	{
		$this->load->model('Admin/Language_model','Lang');

		$data = new StdClass;
		$data->mainMenu 	 = 'Content';
		$data->subMenu = 'StaticsList';
		$data->lowerMenu = 'CorporateContent';

		$data->Langs = $this->Lang->GetLangListShortId();

		$this->load->view('Admin/header',$data);
		$this->load->view('Admin/statics_add');
		$this->load->view('Admin/footer');
	}

	public function SetAdd()
	{
		$q = $this->input->post();

		$title = $this->input->post('title',true);
		unset($q['title']);
		$q = reverseArray($q);
		if ($this->Statics_model->Add($title,$q)) {
			$this->session->set_flashdata('okey',1);
		}else{
			$this->session->set_flashdata('hata',1);
		}

		redirect(site_url('Admin/Statics/Add'));
	}
}

?>