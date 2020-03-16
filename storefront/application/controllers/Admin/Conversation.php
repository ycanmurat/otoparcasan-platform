<?php 
/**
* Login Module Build By Uğur Yetkil
*/
class Conversation extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->checkLogin();
		$this->load->model('Admin/Conversation_model');
		$this->load->model('Admin/Language_model','Lang');
		$this->load->model('Admin/ImageUpload');
		if ($this->session->userdata('user')->auth != 0 && $this->session->userdata('user')->auth != 2) 
		{
			redirect(site_url('Admin'));
		}
	}

	public function index()
	{

		$data = new StdClass;

		$sayfa = $this->input->get('s', true);
		if ($sayfa == "" || $sayfa < 1) {
			redirect(site_url('Admin/Conversation?s=1'));
		}

		$q = $this->Conversation_model->getList($sayfa);
		if ($q) {
			if ($sayfa < 2) {
				$data->prevPage = 1;
			}else{
				$data->prevPage = $sayfa-1;
			}

			if ($sayfa >= ceil($q->pageCount)) {
				$data->nextPage = ceil($q->pageCount);
			}else{
				$data->nextPage = ceil($sayfa+1);
			}

			$data->list = $q->list;
			$data->selectedPage = $sayfa;
			$data->pageCount 	= $q->pageCount;
			$data->totalCount 	= $q->totalCount;

		}
		
		$data->mainMenu = 'Conversation';
		$data->subMenu  = 'ConversationList';

		$this->load->view('Admin/header',$data);
		$this->load->view('Admin/conversation', $data);
		$this->load->view('Admin/footer');
	}
	
	public function Talk($id = 0)
	{
		$this->session->set_flashdata('conversationImage', "");
		$data = new StdClass;
		$header_data = new StdClass;

		if ($id == 0) {
			redirect(admin_url('Conversation'));
		}
		
		$data->conversation = $this->Conversation_model->getConversationById($id);
		$data->lines = $this->Conversation_model->getLinesByConversationId($id);

		$data->conversation_id = $id;

		$header_data->mainMenu = 'Conversation';
		$header_data->subMenu  = 'ConversationList';

		//prex($data);
		$data->sonuc = array($this->session->flashdata('conv_result1'), $this->session->flashdata('conv_result2'));

		//prex($data);
		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/conversation_talk', $data);
		$this->load->view('Admin/footer');
	}

	public function AddLine($id)
	{
		if ($id == 0) {
			redirect(admin_url('Conversation'));
		}
		$text = $this->input->post('text', true);
		$file = $this->session->flashdata('conversationImage');
		if ($text != "" || $file != "") {
			if ($this->Conversation_model->AddLine($id, $text, $file)) {

				$userinfo = $this->Conversation_model->getUserInfoByConversationId($id);

				$adsoyad 	= $userinfo->name;
				$eposta 	= $userinfo->email;
				$link 		= base_url("Conversation/View/".$userinfo->order_line_id);
				// prex("Ad Soyad: ".$adsoyad."<br>E-Posta: ".$eposta."<br>Link: ".$link);
				//Mail Gönderme Alanı
					$email_template 		= $this->Conversation_model->getEmail($Id=4);
					$parse 					= explode("{{{",$email_template->template);
					$emailBody 				= $parse[0].$link.$parse[2];
					$data->to 				= $eposta; //Gönderilecek Kişinin Email Adresi
					$data->toName 			= $adsoyad; //Gönderilecek Kişinin İsmi ve Soyismi
					$data->Subject 			= 'Tasarım Sohbetinizden Bir Cevap Var'; //Email Konu Başlığı
					$data->AddAttachment 	= "";
					$data->Body 			= $emailBody; // Email İçeriği
					$this->load->library('mailler'); // Kütüphane
					$this->mailler->sendSingle($data); // Tamamlama
				//Mail Gönderme Alanı
				$this->session->set_flashdata('conv_result1', 'Tasarım gönderildi.');
				$this->session->set_flashdata('conv_result2', 'success');
				redirect(admin_url('Conversation/Talk/'.$id));
			} else {
				$this->session->set_flashdata('conv_result1', 'Bir hata oluştu.');
				$this->session->set_flashdata('conv_result2', 'danger');
				redirect(admin_url('Conversation/Talk/'.$id));
			}
		} else {
			$this->session->set_flashdata('conv_result1', 'Açıklama alanı ile resim alanlarından en az birini doldurmalısınız.');
			$this->session->set_flashdata('conv_result2', 'danger');
			redirect(admin_url('Conversation/Talk/'.$id));
		}
	}

	public function ImageUpload()
	{	
		$sonuc = $this->Conversation_model->ConversationImageUpload();
		if ($sonuc != false) {
			$this->session->set_flashdata('conversationImage', $sonuc);
		}
	}

	public function ConfirmStatus($id = 0)
	{
		if ($id == 0) {
			redirect('Conversation');
		}
		if ($this->Conversation_model->SetStatusById($id)) {
			$emailInfo = new StdClass;
			$emailInfo->conversation = $this->Conversation_model->getConversationById($id);
			$this->session->set_flashdata('conv_result1', 'Tasarım onaylandı.');
			$this->session->set_flashdata('conv_result2', 'success');
			//email template
				$email_template 		= $this->Conversation_model->getEmail($Id=3);
				$data->to 				= $emailInfo->conversation->email; //Gönderilecek Kişinin Email Adresi
				$data->toName 			= $emailInfo->conversation->name; //Gönderilecek Kişinin İsmi ve Soyismi
				$data->AddAttachment 	= "";
				$emailBody				= $email_template->template;
				$data->Subject 			= 'Tasarımınız Onaylandı'; //Email Konu Başlığı
				$data->Body 			= $emailBody; // Email İçeriği
				$this->load->library('mailler'); // Kütüphane
				$this->mailler->sendSingle($data); // Tamamlama
			//email template
			redirect(admin_url('Conversation/Talk/'.$id));
		} else {
			$this->session->set_flashdata('conv_result1', 'Bir hata oluştu.');
			$this->session->set_flashdata('conv_result2', 'danger');
			redirect(admin_url('Conversation/Talk/'.$id));
		}
	}

}

?>