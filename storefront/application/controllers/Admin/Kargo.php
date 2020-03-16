<?php 
/**
* 
*/
class Kargo extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->checkLogin();
		$this->load->model('Admin/Kargo_model');
	}

	public function index()
	{
		$data = new StdClass;

		$data->mainMenu = 'Kargo';
		$data->subMenu  = 'Kargo';

		$data->cargo = $this->Kargo_model->getPrice();

		//prex($cargo);

		$this->load->view('Admin/header',$data);
		$this->load->view('Admin/kargo');
		$this->load->view('Admin/footer');
	}

	public function add()
	{
		$data = $this->getAllPosts($this->input->post());

		if ($this->Kargo_model->update($data)) {
			$this->session->set_flashdata('okey',1);
		}else{
			$this->session->set_flashdata('hata',1);
		}

		redirect(site_url('Admin/Kargo'));
	}
}

?>