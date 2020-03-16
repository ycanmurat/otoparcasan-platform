<?php 
/**
* 
*/
class Offer extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->checkLogin();
		$this->load->model('Admin/Offer_model');
		if ($this->session->userdata('user')->auth != 0 && $this->session->userdata('user')->auth != 3) 
		{
			redirect(site_url('Admin'));
		}
	}

	public function index()
	{
		$data = new StdClass;
		$data->mainMenu = 'Offer';
		$data->subMenu  = 'OfferList';

		$sayfa = $this->input->get('s', true);
		if ($sayfa == "" || $sayfa < 1) {
			redirect(site_url('Admin/Offer?s=1'));
		}

		$q = $this->Offer_model->getList($sayfa);

		if ($q!=false) {
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

			$data->list 		= $q->list;
			$data->selectedPage = $sayfa;
			$data->pageCount 	= $q->pageCount;
			$data->totalCount 	= $q->totalCount;
		}else{
			$data->prevPage 	= 1;
			$data->nextPage 	= 1;
			$data->list 		= array();
			$data->selectedPage = 1;
			$data->pageCount 	= 1;
			$data->totalCount 	= 0;
		}
		//prex($data->list);
		$this->load->view('Admin/header',$data);
		$this->load->view('Admin/offer_list', $data);
		$this->load->view('Admin/footer');
	}
	public function ImageUpload()
	{
		$sonuc = $this->Offer_model->OfferImageUpload();
		if ($sonuc != false) 
		{
			$this->session->set_flashdata('offerpdf', $sonuc);
		}
	}
	public function OfferReturn($id)
	{
		$offer = new StdClass;
		if ($this->input->post()) {
			$offer->offer_price 	= $this->input->post('offerTutar',true);
			$offer->offer_msg 		= $this->input->post('offerMsg',true);
			$offer->user_name 		= $this->input->post('user_name',true);
			$offer->user_mail 		= $this->input->post('user_mail',true);
			$offer->user_back_file	= $this->session->flashdata('offerpdf');
			$offer->offer_status 	= 1;
			$offer->status_time 	= date('Y-m-d H:i:s');
		//Mail Gönderme Alanı
			$email_template = $this->Offer_model->getEmail($Id=10);
			$parse 			= explode("{{{",$email_template->template);
			$emailBody 		= $parse[0].$offer->offer_msg.$parse[2];
			$data->to 		= $offer->user_mail; //Gönderilecek Kişinin Email Adresi
			$data->toName 	= $offer->user_name; //Gönderilecek Kişinin İsmi ve Soyismi
			$data->Subject 	= 'Teklifinize Cevap Verildi - Ebaskim.com'; //Email Konu Başlığı
			$data->AddAttachment = $offer->user_back_file;
			$data->Body 	= $emailBody; // Email İçeriği
			$this->load->library('mailler'); // Kütüphane
			$this->mailler->sendSingle($data); // Tamamlama
		//Mail Gönderme Alanı
			$this->Offer_model->SetOffer($id,$offer);	
		}
		return redirect(site_url('Admin/Offer'));
	}
}
?>