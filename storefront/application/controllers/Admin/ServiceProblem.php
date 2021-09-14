<?

class ServiceProblem extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->checkLogin();
        $this->load->model('Api_model','api');
		$this->load->model('Admin/ServiceProblem_model','SM');
		if ($this->session->userdata('user')->auth != 0) {
			redirect(site_url('Admin'));
		}
	}
	public function index()
	{
		$data 				= new StdClass;
		$data->mainMenu 	= 'Product';
		$data->subMenu  	= 'ServiceProblem';

		$data->list 		= $this->SM->getCarTypes();
        //prex($data->list);
		
		$this->load->view('Admin/header', $data);
        $this->load->view('Admin/oemFault');
		//$this->load->view('Admin/service_problem_list');
		$this->load->view('Admin/footer');
	}

    public function oemFaultDelete($id)
    {
        $this->SM->oemFaultDelete($id);
        redirect(site_url('Admin/ServiceProblem'));
    }
}

?>