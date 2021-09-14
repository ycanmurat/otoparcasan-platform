<?php
class Tatil extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->checkLogin();
		$this->load->model('Admin/Tatil_model');
		if ($this->session->userdata('user')->auth != 0) 
		{
			redirect(site_url('Admin'));
		}
	}

	public function index()
	{
		$data 				= new StdClass;
		$data->mainMenu 	= 'Kargo';
		$data->subMenu  	= 'TatilList';

		$data->breaks 		= $this->Tatil_model->getBreakDays();

		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/break_days');
		$this->load->view('Admin/footer');
	}

	public function add()
	{
		$data 				= new StdClass;
		$data->mainMenu 	= 'Kargo';
		$data->subMenu  	= 'TatilList';

		if ($this->input->post()) {
			$postData = new StdClass;
			$postData->break_day 	= $this->input->post('break_day',true);
			$postData->break_reason = $this->input->post('break_reason',true);
			$this->Tatil_model->add($postData);
			redirect(admin_url('Tatil'));
		}

		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/break_days_add');
		$this->load->view('Admin/footer');
	}

	public function deleted($id)
	{
		$this->Tatil_model->deleted($id);
		redirect(admin_url('Tatil'));
	}

}

?>