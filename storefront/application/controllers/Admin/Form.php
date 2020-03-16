<?defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->checkLogin();
		$this->load->model('Admin/Form_model','FM');
	}

	public function index()
	{
		$data = new StdClass;
		$data->mainMenu = 'Form';
		$data->subMenu = 'formList';
		$data->contacts = $this->FM->getContacts();
		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/form_list', $data);
		$this->load->view('Admin/footer');
	}

	public function seenStatus($id,$seen)
	{
		if ($this->FM->seenStatus($id,$seen)) {
			redirect(admin_url('Form'));
		} else {
			redirect(admin_url('Form'));
		}
	}

	public function delete($id)
	{
		if ($this->FM->delete($id)) {
			redirect(admin_url('Form'));
		} else {
			redirect(admin_url('Form'));
		}
	}

	public function bulletin()
	{
		$data = new StdClass;
		$data->mainMenu = 'Form';
		$data->subMenu = 'bulletinList';
		$data->bulletin = $this->FM->getBulletin();
		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/bulletin_list', $data);
		$this->load->view('Admin/footer');
	}

	public function seenStatusBulletin($id,$seen)
	{
		if ($this->FM->seenStatusBulletin($id,$seen)) {
			redirect(admin_url('Form/bulletin'));
		} else {
			redirect(admin_url('Form/bulletin'));
		}
	}

	public function deleteBulletin($id)
	{
		if ($this->FM->deleteBulletin($id)) {
			redirect(admin_url('Form/bulletin'));
		} else {
			redirect(admin_url('Form/bulletin'));
		}
	}

	public function formPositionAdd()
	{
		$data 					= new stdClass;
		$header_data 			= new stdClass;
		$header_data->mainMenu 	= 'Human_resources';
		$header_data->subMenu 	= 'formPositionAdd';
		if ($this->input->post()) {
			$postData = $this->getAllPosts();
			if ($this->FM->addPosition($postData)) {
				$this->session->set_flashdata('onay',1);
				redirect(admin_url('Form/formPositionAdd'));
			} else {
				$this->session->set_flashdata('hata',1);
				redirect(admin_url('Form/formPositionAdd'));
			}
		}
		$this->load->view('Admin/header',$header_data);
		$this->load->view('Admin/form_position',$data);
		$this->load->view('Admin/footer');
	}

	public function positionList()
	{
		$data 					= new stdClass;
		$header_data 			= new stdClass;
		$header_data->mainMenu 	= 'Human_resources';
		$header_data->subMenu 	= 'positionList';
		$data->positions = $this->FM->getPositions();
		$this->load->view('Admin/header',$header_data);
		$this->load->view('Admin/positions',$data);
		$this->load->view('Admin/footer');
	}

	public function positionStatusUpdate($id,$newInfo)
	{
		if ($this->FM->positionStatusUpdate($id,$newInfo)) {
			redirect(admin_url('Form/positionList'));
		} else {
			redirect(admin_url('Form/positionList'));
		}
	}

	public function deletePosition($id)
	{
		if ($this->FM->deletePosition($id)) {
			redirect(admin_url('Form/positionList'));
		} else {
			redirect(admin_url('Form/positionList'));
		}
	}
	

}