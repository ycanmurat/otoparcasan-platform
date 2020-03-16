<?php 
/**
* Language Module Build By Uğur Yetkil
*/
class Language extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->checkLogin();
		$this->load->model('Language_model');
		if ($this->session->userdata('user')->auth != 0 && $this->session->userdata('user')->auth != 2) 
		{
			redirect(site_url('Admin'));
		}
	}
	
	public function index()
	{
		$data = new StdClass;

		$data->mainMenu = 'Language';
		$data->subMenu  = 'LangList';

		$data->list = $this->Language_model->GetLangList();
		if ($data->list == '') {
			$data->list = array();
		}
		$this->load->view('Admin/header',$data);
		$this->load->view('Admin/language_list', $data);
		$this->load->view('Admin/footer');
	}

	public function add()
	{
		$data = new StdClass;
		$data->mainMenu = 'Language';
		$data->subMenu  = 'LangAdd';

		$this->load->view('Admin/header',$data);
		$this->load->view('Admin/language_add');
		$this->load->view('Admin/footer');
	}

	public function update($lang_id = 0)
	{
		$data = new StdClass;

		$data->mainMenu = 'Language';
		$data->subMenu  = 'LangList';

		if ($lang_id == 0) {
			redirect(site_url('Admin/Language'));
		}else{
			$veri = $this->Language_model->GetLangById($lang_id);
			if ($data == false) {
				redirect(site_url('Admin/Language'));
			}else{
				$this->load->view('Admin/header', $data);
				$this->load->view('Admin/language_update',$veri);
				$this->load->view('Admin/footer');
			}
		}
	}

	public function Statics($id)
	{
		$data = new StdClass;
		$data->mainMenu = 'Language';
		$data->subMenu  = 'LangList';

		$data->dil_id	= $id;
		$data->dil_name = $this->Language_model->GetLangNameById($id);

		$q 		= $this->Language_model->GetStaticsById($id);
		$trq 	= $this->Language_model->GetStaticsById(1);

		if ($q != false) {
			$data->jsons = json_decode($q);
			$data->tr_json = json_decode($trq);
		}else{
			redirect(site_url('Admin/Language'));
		}

		$this->load->view('Admin/header',$data);
		$this->load->view('Admin/language_statics',$data);
		$this->load->view('Admin/footer');
	}

	public function delete($id)
	{
		if ($this->Language_model->delete($id)) {
			$this->session->set_flashdata('okey',1);
		}else{
			$this->session->set_flashdata('hata',1);
		}
		redirect(site_url('Admin/Language/update'));
	}

	public function SetStatus($id,$new)
	{
		try {
			$this->Language_model->SetStatusById($id,$new);
			redirect(site_url('Admin/Language'));
		} catch (Exception $e) {
			redirect(site_url('Admin/Language'));
		}
	}

	public function StaticsUpdate($dil_id)
	{
		$q = $this->input->post('Lang',True);
		$q = json_encode((object)$q);

		//prex($q);

		if ($this->Language_model->StaticsUpdate($dil_id,$q)) {

			$fname = 'assets/lang/'.$dil_id.'.json';
			$file = fopen($fname,"w");
			fwrite($file, $q);
			$this->session->set_flashdata('okey',1);
			redirect(site_url('Admin/Language/statics/'.$dil_id));
		}else{
			$this->session->set_flashdata('hata',1);
			redirect(site_url('Admin/Language/statics/'.$dil_id));
		}
		
	}

	public function SetAdd()
	{
		$data = new StdClass();

		$data->short_code 	= trim($this->input->post('kisa_kod',true));
		$data->lang_name 	= trim($this->input->post('lang_name',true));
		$data->lang_class 	= trim($this->input->post('lang_class',true));

		if (empty($data->short_code) or empty($data->lang_name) or empty($data->lang_class)) {
			$this->session->set_flashdata('hata',1);
		}

		if ($this->Language_model->addLang($data) ) {
			$this->session->set_flashdata('okey',1);
			redirect(site_url('Admin/Language/add'));
		}else{
			$this->session->set_flashdata('hata',1);
			redirect(site_url('Admin/Language/add'));
		}
	}

	public function SetUpdate($lang_id = 0)
	{
		$data = new StdClass();

		$data->short_code 	= trim($this->input->post('kisa_kod',true));
		$data->lang_name 	= trim($this->input->post('lang_name',true));
		$data->lang_class 	= trim($this->input->post('lang_class',true));
		$data->status 		= trim($this->input->post('yayin',true));

		if (empty($data->short_code) or empty($data->lang_name) or empty($data->lang_class)) {
			$this->session->set_flashdata('hata',1);
			redirect(site_url('Admin/Language/update/'.$lang_id));
		}

		if ($data->status == "on") {
			$data->status = 1;
		}else{
			$data->status = 0;
		}

		if($lang_id == 0) {
			redirect(site_url('Admin/Language'));
		}else{
			if ($this->Language_model->Update($data,$lang_id)) {
				$this->session->set_flashdata('okey',1);
				redirect(site_url('Admin/Language/update/'.$lang_id));
			}else{
				$this->session->set_flashdata('hata',1);
				redirect(site_url('Admin/Language/update/'.$lang_id));
			}
		}
	}

	public function LangUpdate()//Çalıştığı zaman aktif dillerin json dosyasını günceller
	{
		$this->Language_model->AllLangFileUpdate();
		echo 'OK';
	}
}
?>