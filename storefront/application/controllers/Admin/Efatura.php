<?php 
/**
*
*/
class Efatura extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->checkLogin();
		if ($this->session->userdata('user')->auth != 0 && $this->session->userdata('user')->auth != 3) 
		{
			redirect(site_url('Admin'));
		}
		$this->load->model('Admin/Efatura_Model');
	}

	public function index()
	{

		$data = new StdClass;

		$sayfa = $this->input->get('s', true);
		if ($sayfa == "" || $sayfa < 1) {
			redirect(site_url('Admin/Efatura?s=1'));
		}

		$q = $this->Efatura_Model->getList($sayfa);
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
		
		$data->mainMenu = 'Efatura';
		$data->subMenu  = 'EfaturaList';

		$this->load->view('Admin/header',$data);
		$this->load->view('Admin/efatura', $data);
		$this->load->view('Admin/footer');
	}

	public function Send($id = 0)
	{
		if ((int)$id == 0) {
			redirect(site_url("Admin"));
		}
		$sonuc = "boş";
		if ($this->Efatura_Model->SiparisKontrol($id) == true) {
			if ($this->Efatura_Model->EfaturaKontrol($id)) {
				$sonuc = $this->Efatura_Model->SendInvoice($id);
				if ($sonuc == false) {
					$this->session->set_flashdata('efaturasonuc1', "danger");
					$this->session->set_flashdata('efaturasonuc2', "Sipariş No: #".$id." - Hata oluştu. Lütfen yazılım ekibiyle iletişime geçin.");
				} else {
					$this->session->set_flashdata('efaturasonuc1', "success");
					$this->session->set_flashdata('efaturasonuc2', $sonuc);
				}
			} else {
				$this->session->set_flashdata('efaturasonuc1', "danger");
				$this->session->set_flashdata('efaturasonuc2', "Sipariş No: #".$id." - Bu siparişin E-Fatura dökümanı zaten alınmış.");
			}
		} else {
			$this->session->set_flashdata('efaturasonuc1', "danger");
			$this->session->set_flashdata('efaturasonuc2', "Sipariş No: #".$id." - Bu siparişin durumu E-Fatura oluşturmak için uygun değil.");
		}
		if (isset($_SERVER['HTTP_REFERER'])) {
			header("location: ".$_SERVER['HTTP_REFERER']."");
		} else {
			echo "<b>Sonuç:</b><br><br>".$sonuc;
			//$result = $this->db->get_where('efatura', array('invoice_id' => $sonuc))->row();
			//prex($result);
		}
	}

	public function View($faturaid = 0)
	{
		if ($faturaid == 0) {
			echo "Fatura bulunamadı.";
			exit;
		}
		$fatura = $this->Efatura_Model->GetEfaturaById($faturaid);
		if ($fatura == false) {
			echo "Fatura bulunamadı.";
		} else {
			echo $fatura->html;
		}

	}

	public function EtiketGetir($kimlik) {
		//$this->Efatura_Model->EtiketGetir($kimlik);
	}

	public function SiparisKontrol($id) {
		//$this->Efatura_Model->SiparisKontrol($id);
	}
	
}

?>