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
		$header_data->subMenu = 'notificationList';
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

    public function sms()
    {
        $header_data = new StdClass;
        $data = new StdClass;
        $header_data->mainMenu = 'Notification';
        $header_data->subMenu = 'sms';

        $this->load->view('Admin/header', $header_data);
        $this->load->view('Admin/notification_sms',$data);
        $this->load->view('Admin/footer');
    }

    public function email()
    {
        $header_data = new StdClass;
        $data = new StdClass;
        $header_data->mainMenu = 'Notification';
        $header_data->subMenu = 'email';

        $this->load->view('Admin/header', $header_data);
        $this->load->view('Admin/notification_email',$data);
        $this->load->view('Admin/footer');
    }

    public function sendSms()
    {
        try {
            $data = new StdClass;
            $data->gsm = array();
            $gsm = $this->Notification_model->getSmsDatas();

            foreach ($gsm as $key => $val) {
                $gsm = '9'.str_replace(' ','',str_replace(')','',str_replace('(','',$val->phone)));
                if (strlen($gsm) == 12) {
                    $data->gsm[] = $gsm;
                }
            }

            $data->gsm = array_unique($data->gsm);
            $data->gsm = implode(',',$data->gsm);
            
            $smsData = new StdClass;
            $smsData->receivers = $data->gsm;
            $smsData->text = $this->input->post('content',true);
            $this->load->library('sms');
            $this->sms->NetGsmSend($smsData);

            $this->session->flashdata('onay',1);
        } catch (Exception $e) {
            $this->session->flashdata('hata',1);
        }
        
        redirect(admin_url('Notification/sms'));


        prex($this->input->post());
    }
}