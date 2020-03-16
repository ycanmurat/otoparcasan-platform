<?
	class Campaign extends Core_Controller
	{
		function __construct()
		{
			parent::__construct();
			$this->checkLogin();
			$this->load->model('Admin/Campaigns_model');
		}
		public function campaignAdd()
		{
			$header_data 						= new StdClass;
			$data 								= new StdClass;
			$dataArray							= new StdClass;
			$header_data->mainMenu				= "Campaign";
			$header_data->subMenu				= "campaignAdd";	
			$data->a = "";
			if ($this->input->post()) 
			{

				$dataArray->campaign_picture 	= $this->session->flashdata('campaignImage');
				$dataArray->campaign_link 		= $this->input->post('campaign_link',	true);
				$dataArray->campaign_title 		= $this->input->post('campaign_title',true);
				$dataArray->campaign_start 		= $this->input->post('campaign_start',true);
				$dataArray->campaign_end 		= $this->input->post('campaign_end',	true);
				$dataArray->campaign_info 		= $this->input->post('campaign_info',	true);
				if ($this->Campaigns_model->CampaignAdd($dataArray)) 
				{
					$this->session->set_flashdata("onay", 1);
				}
				else
				{
					$this->session->set_flashdata('red', 1);
				}
			}
			$this->load->view('Admin/header',$header_data);
			$this->load->view('Admin/campaign_add',$data);
			$this->load->view('Admin/footer');
		}
		public function ImageUpload()
		{	
			$imageLocUp			 = $this->Campaigns_model->CampaignsImageUpload();
			if ($imageLocUp != false) 
			{
				$this->session->set_flashdata('campaignImage', $imageLocUp);
			}
		}
		public function index()
		{
			$header_data 			 = new StdClass;
			$data 		 			 = new StdClass;
			$header_data->subMenu 	 = "campaignList";
			$header_data->mainMenu	 = "Campaign";
			$data->campaigns_info = $this->Campaigns_model->Camp();
			$this->load->view('Admin/header', $header_data);
			$this->load->view('Admin/campaigns', $data);
			$this->load->view('Admin/footer');
		}
		public function StatusEdit($Id = 0, $NowStatus = 0)
		{
			if ($Id == 0 || ($NowStatus != 0 && $NowStatus != 1)) 
			{
				redirect(admin_url('Campaign'));
			}
			$this->Campaigns_model->StatusEditM($Id, $NowStatus);
			try 
			{
				$this->Campaigns_model->StatusEditM($Id, $NowStatus);
				redirect($_SERVER['HTTP_REFERER']);
			} 
			catch (Exception $e) 
			{
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
		public function deleteCampaign($Id)
		{
			$this->Campaigns_model->delete($Id);
			redirect(admin_url('Campaign'));
		}
		public function editCampaign($Id)
		{
			$header_data 						= new StdClass;
			$data  								= new StdClass;
			$postData							= new StdClass;
			$data->h 							= "";
			$header_data->subMenu 				= "campaignList";
			$header_data->mainMenu 				= "Campaign";
			if (empty($Id)) 
			{
				redirect(admin_url('Campaign'));
			}
			if($this->input->post())
			{
				$postData->campaign_link 		= $this->input->post('campaign_link',true);
				$postData->campaign_title 		= $this->input->post('campaign_title',true);
				$postData->campaign_start 		= $this->input->post('campaign_start',true);
				$postData->campaign_end 		= $this->input->post('campaign_end',true);
				$postData->campaign_info 		= $this->input->post('campaign_info',true);
				$postData->campaign_picture 	= $this->session->flashdata('campaignImage');
				$Id 							= $this->input->post('Id',true);
				$updateCampaign 				= $this->Campaigns_model->updateCampaign($Id, $postData);
				if ($updateCampaign == true) 
				{
					$this->session->set_flashdata('true',1);
				}
				else
				{
					$this->session->set_flashdata('false',1);
				}
			}
			$data->editCampaignAllData 			= $this->Campaigns_model->editCampaignResult($Id);
			$this->load->view('Admin/header', $header_data);
			$this->load->view('Admin/campaign_edit', $data);
			$this->load->view('Admin/footer');

		}
	}
?>