<?

class Notification extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->checkLogin();
		$this->load->model('Admin/Notification_model');
		if ($this->session->userdata('user')->auth != 0) 
		{
			redirect(site_url('Admin'));
		}
	}

	public function index()
	{
		$header_data = new StdClass;
		$data = new StdClass;
		$header_data->mainMenu = 'Notification';
		$header_data->subMenu = 'notificationList';
		$data->notifications = $this->Notification_model->getNotification();
		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/notification_list',$data);
		$this->load->view('Admin/footer');
	}

	public function add()
	{
		$header_data = new StdClass;
		$data = new StdClass;
		$header_data->mainMenu = 'Notification';
		$header_data->subMenu = 'NotificationAdd';
		if ($this->input->post()) {
			$getAllPosts = $this->getAllPosts();
			$getAllPosts->user_id = 0;
			if ($this->Notification_model->addNotification($getAllPosts)) {
				$this->session->set_flashdata('onay',1);
				redirect(admin_url('Notification/add'));
			} else {
				$this->session->set_flashdata('hata',1);
				redirect(admin_url('Notification/add'));
			}
		}
		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/notification_add',$data);
		$this->load->view('Admin/footer');
	}

	public function StatusEdit($id,$status)
	{
		if ($this->Notification_model->StatusEdit($id,$status)) {
			redirect(admin_url('Notification'));
		} else {
			redirect(admin_url('Notification'));
		}
	}

	public function deleteNotification($id)
	{
		if ($this->Notification_model->deleteNotification($id)) {
			redirect(admin_url('Notification'));
		} else {
			redirect(admin_url('Notification'));
		}
	}

	public function editNotification($id)
	{
		$header_data = new StdClass;
		$data = new StdClass;
		$header_data->mainMenu = 'Notification';
		$header_data->subMenu = 'notificationList';
		$data->notifications = $this->Notification_model->getNotificationById($id);
		if ($this->input->post()) {
			$getAllPosts = $this->getAllPosts();
			if ($this->Notification_model->updateNotification($getAllPosts,$id)) {
				$this->session->set_flashdata('onay',1);
				redirect(admin_url('Notification'));
			} else {
				$this->session->set_flashdata('hata',1);
				redirect(admin_url('Notification/editNotification/'.$id));
			}
		}
		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/notification_update',$data);
		$this->load->view('Admin/footer');
	}
}