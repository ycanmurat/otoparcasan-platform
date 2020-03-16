<?php
/**
* Author: Muhammet Ateş
*/
class User extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->checkLogin();
		$this->load->model('Admin/User_model');
		if ($this->session->userdata('user')->auth != 0) 
		{
			redirect(site_url('Admin'));
		}
	}

	public function index()
	{
		$header_data = new StdClass;
		$header_data->mainMenu = 'User';
		$header_data->subMenu  = 'UserList';

		$sayfa = $this->input->get('s', true);
		if ($sayfa == "" || $sayfa < 1) {
			redirect(site_url('Admin/User?s=1'));
		}

		$q = $this->User_model->getList($sayfa);
		if ($sayfa < 2) {
			$data['prevPage'] = 1;
		}else{
			$data['prevPage'] = $sayfa-1;
		}

		if ($sayfa >= ceil($q->pageCount)) {
			$data['nextPage'] = ceil($q->pageCount);
		}else{
			$data['nextPage'] = ceil($sayfa+1);
		}

		$data['users'] = $q->list;
		$data['selectedPage'] = $sayfa;
		$data['pageCount'] 	= $q->pageCount;
		$data['totalCount'] 	= $q->totalCount;


		$data['sonuc'] = array($this->session->flashdata('user_result1'), $this->session->flashdata('user_result2'));

		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/user', $data);
		$this->load->view('Admin/footer');
	}

	public function Update($id)
	{
		if ($id == 0) { redirect(admin_url('User')); }
		$header_data = new StdClass;
		$header_data->mainMenu = 'User';
		$header_data->subMenu  = 'UserList';

		if ($_POST) {
			if ($this->User_model->Update($id)) {
				$this->session->set_flashdata('user_result1', 'Bilgiler güncellendi.');
				$this->session->set_flashdata('user_result2', 'success');
				redirect(admin_url('User/Update/'.$id));
			} else {
				$this->session->set_flashdata('user_result1', 'Bir hata oluştu.');
				$this->session->set_flashdata('user_result2', 'danger');
			}
		}

		$data['user'] = $this->User_model->getUserById($id);
		$data['sonuc'] = array($this->session->flashdata('user_result1'), $this->session->flashdata('user_result2'));

		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/user_update', $data);
		$this->load->view('Admin/footer');
	}

	public function Delete($id = 0)
	{
		if ($id == 0) {
			//redirect(site_url('Admin/User'));
		}
		$page = (int)$this->input->get('s', true);

		if ($this->User_model->deleteById($id)) {
			$this->session->set_flashdata('user_result1', 'Üye silindi.');
			$this->session->set_flashdata('user_result2', 'success');
			redirect(site_url('Admin/User?s='.$page));
		} else {
			$this->session->set_flashdata('user_result1', 'Bir hata oluştu.');
			$this->session->set_flashdata('user_result2', 'danger');
			redirect(site_url('Admin/User?s='.$page));
		}
		
	}

	public function Address($userid = 0)
	{
		if ($userid == 0) {
			redirect(admin_url('User'));
		}
		$data = array();
		$header_data = new StdClass;
		$header_data->mainMenu = 'User';
		$header_data->subMenu  = 'UserList';

		$data['user'] = $this->User_model->getUserById($userid);
		$data['address'] = $this->User_model->getAddressByUserId($userid);
		$data['sonuc'] = array($this->session->flashdata('user_result1'), $this->session->flashdata('user_result2'));

		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/user_address', $data);
		$this->load->view('Admin/footer');
	}

	public function AddAddress($userid = 0)
	{
		if ($userid == 0) {
			redirect(admin_url('User'));
		}
		$data = array();
		$header_data = new StdClass;
		$header_data->mainMenu = 'User';
		$header_data->subMenu  = 'UserList';

		if ($_POST) {
			$definition = $this->input->post('definition', true);
			$name = $this->input->post('name', true);
			$content = $this->input->post('content', true);
			$country = $this->input->post('country', true);
			$city = $this->input->post('city', true);
			$town = $this->input->post('town', true);
			$post_code = $this->input->post('post_code', true);
			$gsm = $this->input->post('gsm', true);
			if ($this->User_model->AddAddress($userid, $definition, $name, $content, $country, $city, $town, $post_code, $gsm)) {
				$this->session->set_flashdata('user_result1', 'Adres eklendi.');
				$this->session->set_flashdata('user_result2', 'success');
				redirect(admin_url('User/AddAddress/'.$userid));
			} else {
				$this->session->set_flashdata('user_result1', 'Bir hata oluştu.');
				$this->session->set_flashdata('user_result2', 'danger');
			}
		}

		$data['user'] = $this->User_model->getUserById($userid);
		$data['sonuc'] = array($this->session->flashdata('user_result1'), $this->session->flashdata('user_result2'));

		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/user_address_add', $data);
		$this->load->view('Admin/footer');

	}

	public function UpdateAddress($userid = 0, $id = 0)
	{
		if ($userid == 0 || $id == 0) {
			redirect(admin_url('User'));
		}
		$data = array();
		$header_data = new StdClass;
		$header_data->mainMenu = 'User';
		$header_data->subMenu  = 'UserList';

		if ($_POST) {
			$definition = $this->input->post('definition', true);
			$name = $this->input->post('name', true);
			$content = $this->input->post('content', true);
			$country = $this->input->post('country', true);
			$city = $this->input->post('city', true);
			$town = $this->input->post('town', true);
			$post_code = $this->input->post('post_code', true);
			$gsm = $this->input->post('gsm', true);
			if ($this->User_model->UpdateAddress($id, $definition, $name, $content, $country, $city, $town, $post_code, $gsm)) {
				$this->session->set_flashdata('user_result1', 'Bilgiler güncellendi.');
				$this->session->set_flashdata('user_result2', 'success');
				redirect(admin_url('User/UpdateAddress/'.$userid.'/'.$id));
			} else {
				$this->session->set_flashdata('user_result1', 'Bir hata oluştu.');
				$this->session->set_flashdata('user_result2', 'danger');
			}
		}

		$data['user'] = $this->User_model->getUserById($userid);
		$data['address'] = $this->User_model->getAddressId($id);
		$data['sonuc'] = array($this->session->flashdata('user_result1'), $this->session->flashdata('user_result2'));

		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/user_address_update', $data);
		$this->load->view('Admin/footer');

	}

	public function DeleteAddress($userid = 0, $id = 0)
	{
		if ($userid == 0 || $id == 0) {
			redirect(admin_url('User'));
		}

		if ($this->User_model->DeleteAddressById($id)) {
			$this->session->set_flashdata('user_result1', 'Adres silindi.');
			$this->session->set_flashdata('user_result2', 'success');
			redirect(admin_url('User/Address/'.$userid));
		} else {
			$this->session->set_flashdata('user_result1', 'Bir hata oluştu.');
			$this->session->set_flashdata('user_result2', 'danger');
			redirect(admin_url('User/Address/'.$userid));
		}

	}

}
?>