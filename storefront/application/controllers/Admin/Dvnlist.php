<?php 
/**
 * 
 */
class Dvnlist extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
			$this->checkLogin();
		$this->load->model('Admin/Dvn_model');
		$this->load->model('Dat_model','dat');
	}

	public function index()
	{
		
		$data = new StdClass;
		$data->mainMenu = 'Dvnlist';
		$data->subMenu = 'havuz';

		$data->types = $this->dat->getCarMarks();
		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/dvnList');
		$this->load->view('Admin/footer');
	}

	public function DvnInstall()
	{
		if (!$this->input->cookie('selectedCarAdmin')) {
			redirect(site_url('Admin'));
		}

		$data = new StdClass;

		$data->carKeys = json_decode($this->input->cookie('selectedCarAdmin'));
		$data->carDetail = $this->dat->getCarDetail($data->carKeys);
		$data->carMainGroup = $this->dat->getAssemblyGroups($data->carDetail->Vehicle->VehicleType,
															$data->carDetail->Vehicle->Manufacturer,
															$data->carDetail->Vehicle->BaseModel);
		foreach ($data->carMainGroup as $key => $val) {
			$this->dat->getDvns($data->carDetail->Vehicle->VehicleType,
															$data->carDetail->Vehicle->Manufacturer,
															$data->carDetail->Vehicle->BaseModel,
															$val->assemblyGroupId);
		}

		redirect(site_url('Admin/Dvnlist'));
	}

	public function dvnAdd($page = 1)
	{
		if ($page < 1 OR $page > 10) {
			$page = 1;
		}
		$page = $page - 1;
		$data = new StdClass;
		$data->mainMenu = 'Dvnlist';
		$data->subMenu = 'dvn';

		$data->dvns = $this->Dvn_model->getAllDvns();

		$p = new StdClass;

		$p->count 		= count($data->dvns);
		$p->pageBy 		= ceil($p->count/10);
		$p->pageFirst 	= $p->pageBy*$page;
		$p->pageLast  	= $p->pageBy*($page+1);

		$p->dvns 		= $data->dvns;

		$data->p = $p;
		$data->page = $page+1;

		$data->dvns = arrayExplode($data->dvns,$p->pageFirst,$p->pageLast);

		//prex($data->dvns);

		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/dvnMarge');
		$this->load->view('Admin/footer');
	}

	public function add()
	{
		$dvn 	= $this->input->post('dvn',true);
		$value 	= $this->input->post('value',true);
		if ($this->Dvn_model->addDvn($dvn,$value)) {
			echo 'OK';
		}else{
			echo 'Err';
		}

	}
}
?>