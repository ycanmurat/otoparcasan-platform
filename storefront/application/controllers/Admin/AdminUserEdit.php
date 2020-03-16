<?php
	class AdminUserEdit extends Core_Controller
	{
		function __construct()
		{
			parent::__construct();
			$this->checkLogin();
			$this->load->model('Admin/Admin_user_model');
			if ($this->session->userdata('user')->auth != 0) 
			{
				redirect(site_url('Admin'));
			}
		}
		public function index()
		{
			$header_data 			 = new StdClass;
			$data 					 = new StdClass;
			$header_data->mainMenu 	 = 'AdminEdit';
			$header_data->subMenu  	 = 'AdminUserEdit';
			$data->all_user_info	 = "";
			$data->auth_info		 = "";
			$data->delete_info       = "";
			$data->all_user_info 	 = $this->Admin_user_model->AllUserQuery();
			if ($data->all_user_info == false) {
				$data->all_user_info = 0;
			}
			$this->load->view('Admin/header', $header_data);
			$this->load->view('Admin/admin_user_edit',$data);
			$this->load->view('Admin/footer');
		}
		public function StatusEdit($Id = 0, $NowStatus = 0)
		{
			if ($Id == 0 || ($NowStatus != 0 && $NowStatus != 1)) {
				redirect(admin_url('AdminUserEdit'));
			}
			$this->Admin_user_model->StatusEditM($Id, $NowStatus);
			try {
				$this->Admin_user_model->StatusEditM($Id, $NowStatus);
				redirect($_SERVER['HTTP_REFERER']);
			} catch (Exception $e) {
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
		public function AuthEdit($Auth = 0, $Id = 0)
		{
			if (!empty($Id) || !empty($Auth))  {
				$data->auth_info = $this->Admin_user_model->AutEditM($Auth, $Id);
				if (!$auth_info == false){
					$this->session->set_flashdata('true',1);
				} else {
					redirect(admin_url('AdminUserEdit'));
				}
			}
			else {
				redirect(admin_url('AdminUserEdit'));
			}
		}
		public function newAdminAdd()
		{
			$header_data 			= new StdClass;
			$data 					= new StdClass;
			$header_data->mainMenu 	= 'AdminEdit';
			$header_data->subMenu  	= 'newAdminAdd';
			$adminInfo 				= new StdClass;
			$data->is_there 		= "1";
			$data->admin_add_true	= "3";

			if ($this->input->post()) 
			{
				$adminInfo->user_name = $this->input->post('user_name', true);
				$adminInfo->user_mail = $this->input->post('user_mail', true);
				$adminInfo->password  = password_hash($this->input->post('pass', true), PASSWORD_DEFAULT);
				$adminInfo->user_gsm  = $this->input->post('user_gsm', true);
				$adminInfo->auth 	  = $this->input->post('auth',true);
				$adminInfo->status    = 1;
				$admin_is_there       = $this->Admin_user_model->is_there($adminInfo);
				if ($admin_is_there == true) {
					$data->is_there = 1;
					$admin_add 		= $this->Admin_user_model->adminAdd($adminInfo);
					if ($admin_add 	== true) {
						$data->admin_add_true = 1;
					} else {
						$data->admin_add_true = 0;
					}
				} else {
					$data->is_there = 0;
				}
			}
			$this->load->view('Admin/header', $header_data);
			$this->load->view('Admin/new_admin_add',$data);
			$this->load->view('Admin/footer');
		}
		public function DeleteUser($Id)
		{	
			if (!empty($Id) || ctype_digit($Id)){
				$data->delete_info = $this->Admin_user_model->DeleteUser($Id);
				if (!$delete_info == false) {
					$this->session->set_flashdata('delete',1);
				} else {
					redirect(admin_url('AdminUserEdit'));
				}
			}
			else {
				redirect(admin_url('Admin'));
			}
		}
		public function UpdateUser($Id)
		{
			$header_data 			= new StdClass;
			$data 					= new StdClass;
			$header_data->mainMenu 	= 'AdminEdit';
			$header_data->subMenu  	= 'AdminUserEdit';
			$data->UserInfo = $this->Admin_user_model->userInfo($Id);
			if (!empty($Id) && is_numeric($Id) && !empty($data->UserInfo)){
				if ($this->input->post()) {
					$getAllPosts = $this->GetAllPosts();
					if (empty($getAllPosts->old_password) && empty($getAllPosts->password)) {
						unset($getAllPosts->old_password,$getAllPosts->password);
						if ($this->Admin_user_model->updateInfo($Id,$getAllPosts)) {
							$this->session->set_flashdata('kutu', 'success');
							$this->session->set_flashdata('baslik', 'Başarılı.');
							$this->session->set_flashdata('icerik', 'Girdiğiniz Bilgiler Başarıyla Güncellendi.');
							redirect(admin_url('AdminUserEdit/UpdateUser/'.$Id));
						} else {
							$this->session->set_flashdata('kutu', 'danger');
							$this->session->set_flashdata('baslik', 'Başarısız.');
							$this->session->set_flashdata('icerik', 'Bilgiler Güncellenemiyor Lütfen Geliştiricinize Başvurun.');
						}
					} else {
						if(password_verify($getAllPosts->old_password, $data->UserInfo->password)) {
							unset($getAllPosts->old_password);
							$getAllPosts->password = password_hash($getAllPosts->password,PASSWORD_DEFAULT);
							if ($this->Admin_user_model->updateAdminUser($Id,$getAllPosts)) {
								$this->session->set_flashdata('kutu', 'success');
								$this->session->set_flashdata('baslik', 'Başarılı.');
								$this->session->set_flashdata('icerik', 'Girdiğiniz Bilgiler Başarıyla Güncellendi.');
								redirect(admin_url('AdminUserEdit/UpdateUser/'.$Id));
							} else {
								$this->session->set_flashdata('kutu', 'danger');
								$this->session->set_flashdata('baslik', 'Başarısız.');
								$this->session->set_flashdata('icerik', 'Bilgiler Güncellenemiyor Lütfen Geliştiricinize Başvurun.');
							}
						} else {
							$this->session->set_flashdata('kutu', 'danger');
							$this->session->set_flashdata('baslik', 'Başarısız.');
							$this->session->set_flashdata('icerik', 'Girdiğiniz Eski Şifre, Kayıtlarımızdaki İle Uyuşmuyor.');
						}
					}
				}
			$data->UserInfo = $this->Admin_user_model->userInfo($Id);
			} else {
				redirect(admin_url('AdminUserEdit'));
			}
			$this->load->view('Admin/header',$header_data);
			$this->load->view('Admin/admin_user_update',$data);
			$this->load->view('Admin/footer');
		}
	}

?>