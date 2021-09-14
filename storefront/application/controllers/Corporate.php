<?defined('BASEPATH') OR exit('No direct script access allowed');

class Corporate extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->getUserRememberCheck();
		$this->load->model('Corporate_model','CM');
	}	

	public function contact()
	{
		$data = new stdClass();
		$data = $this->Global_model->getAllInsert();
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('corporate_contact');
		$this->load->view('footer');
	}

	public function contracted()
	{
		$data = new stdClass();
		$data = $this->Global_model->getAllInsert();
		$data->services = $this->CM->getContractedServices();
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('corporate_contracted');
		$this->load->view('footer');
	}
	
	public function insankaynaklari()
	{
		$data = new stdClass();
		$data = $this->Global_model->getAllInsert();
		$data->city = $this->CM->getCity();
		$data->positions = $this->CM->getPositions();
		if ($this->input->post()) {
			$config['upload_path'] = './assets/uploads/';
			$config['allowed_types'] = 'bmp|gif|jpeg|jpg|jpe|jp2|png|tiff|tif';
			$config['encrypt_name'] = TRUE;
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('user_file')) {
				$this->session->set_flashdata('image_error',$this->upload->display_errors());
			}
			else {
				//Kişisel Bilgiler
				$this->form_validation->set_rules('name_surname', 'Ad Soyad', 'required|min_length[4]|max_length[250]');
				$this->form_validation->set_rules('identification_number', 'T.C Kimlik No', 'required|min_length[11]|max_length[11]|numeric');
				$this->form_validation->set_rules('email', 'E-Posta', 'required|min_length[4]|max_length[250]|valid_email');
				$this->form_validation->set_rules('phone', 'Telefon', 'required|min_length[10]|max_length[11]|numeric');
				$this->form_validation->set_rules('gender', 'Cinsiyetiniz', 'required|min_length[1]|max_length[1]|numeric');
				$this->form_validation->set_rules('marital_status', 'Medeni Durumu', 'required|min_length[1]|max_length[1]|numeric');
				$this->form_validation->set_rules('military_status', 'Askerlik Durumu', 'required|min_length[1]|max_length[1]|numeric');
				$this->form_validation->set_rules('educational_status', 'Eğitim Durumu', 'required|min_length[1]|max_length[1]|numeric');
				$this->form_validation->set_rules('city_id', 'Yaşadığınız Şehir', 'required|min_length[1]|max_length[2]|numeric');
				//Doğum Tarihi ve Yeri
				$this->form_validation->set_rules('birth_date', 'Doğum Tarihi', 'required|min_length[10]|max_length[10]');
				$this->form_validation->set_rules('town_id', 'Yaşadığınız İlçe', 'required|min_length[1]|max_length[3]|numeric');
				$this->form_validation->set_rules('address', 'Ev Adresiniz', 'required|min_length[5]|max_length[250]');	
				//Eğitim Geçmişi
				$this->form_validation->set_rules('education_school', 'Okul', 'required|min_length[3]|max_length[250]');	
				$this->form_validation->set_rules('education_department', 'Bölüm', 'required|min_length[3]|max_length[250]');	
				$this->form_validation->set_rules('education_start_date', 'Başlangıç', 'required|min_length[10]|max_length[10]');	
				$this->form_validation->set_rules('education_end_date', 'Bitiş', 'required|min_length[10]|max_length[10]');
				//İş Geçmişi
				$this->form_validation->set_rules('job_name', 'İş Yerinin Adı', 'required|min_length[3]|max_length[250]');
				$this->form_validation->set_rules('job_mission', 'Görev', 'required|min_length[3]|max_length[250]');
				$this->form_validation->set_rules('job_start_date', 'Başlangıç', 'required|min_length[10]|max_length[10]');
				$this->form_validation->set_rules('job_end_date', 'Bitiş', 'required|min_length[10]|max_length[10]');
				$this->form_validation->set_rules('job_reason', 'Ayrılma Sebebi', 'required|min_length[3]|max_length[250]');
				//Referans -> 1
				$this->form_validation->set_rules('r1_name_surname', 'Ad Soyad', 'min_length[3]|max_length[250]');
				$this->form_validation->set_rules('r1_job', 'İşyeri', 'min_length[3]|max_length[250]');
				$this->form_validation->set_rules('r1_mission', 'Görevi', 'min_length[3]|max_length[250]');
				$this->form_validation->set_rules('r1_phone', 'Telefonu', 'min_length[3]|max_length[250]');
				//Referans -> 2
				$this->form_validation->set_rules('r2_name_surname', 'Ad Soyad', 'min_length[3]|max_length[250]');
				$this->form_validation->set_rules('r2_job', 'İşyeri', 'min_length[3]|max_length[250]');
				$this->form_validation->set_rules('r2_mission', 'Görevi', 'min_length[3]|max_length[250]');
				$this->form_validation->set_rules('r2_phone', 'Telefonu', 'min_length[3]|max_length[250]');
				//Referans -> 3
				$this->form_validation->set_rules('r3_name_surname', 'Ad Soyad', 'min_length[3]|max_length[250]');
				$this->form_validation->set_rules('r3_job', 'İşyeri', 'min_length[3]|max_length[250]');
				$this->form_validation->set_rules('r3_mission', 'Görevi', 'min_length[3]|max_length[250]');
				$this->form_validation->set_rules('r3_phone', 'Telefonu', 'min_length[3]|max_length[250]');
				//Diğer Bilgiler
				$this->form_validation->set_rules('smoke', 'Sigara Kullanıyor musunuz ?', 'required|min_length[1]|max_length[1]|numeric');
				$this->form_validation->set_rules('driving_licence', 'Ehliyetiniz Var mı ?', 'required|min_length[1]|max_length[1]|numeric');
				$this->form_validation->set_rules('position', 'Çalışmak İstediğiniz Pozisyon', 'required|min_length[1]|max_length[3]|numeric');
				$this->form_validation->set_rules('fee', 'Beklenen Ücret (Net) ?', 'required|min_length[1]|max_length[6]|numeric');
				$this->form_validation->set_rules('message', 'Eklemek İstedikleriniz', 'min_length[5]');
				if (!$this->form_validation->run() == FALSE) {
					$postData = $this->getAllPosts();
					$imageInformations =  $this->upload->data();
					$postData->image = $imageInformations['file_name'];
					if ($this->CM->formAdd($postData)) {
						$this->session->set_flashdata('success',1);
						redirect(site_url('insankaynaklari'));
					} else {
						$this->session->set_flashdata('danger',2);
						redirect(site_url('insankaynaklari'));
					}
				}
			}
		}

		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('corporate_insankaynaklari');
		$this->load->view('footer');
	}

	public function bankdetail()
	{
		$data = new stdClass();
		$data = $this->Global_model->getAllInsert();
		$data->accounts = $this->CM->getBankAccounts();
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('corporate_bank_account');
		$this->load->view('footer');
	}

	public function offerForm()
	{
		$data = new stdClass();
		$data = $this->Global_model->getAllInsert();
		$this->form_validation->set_rules('name_surname', 'Ad Soyad', 'required|min_length[3]|max_length[250]');
		$this->form_validation->set_rules('email', 'E-Posta', 'required|min_length[5]|max_length[250]|valid_email');
		$this->form_validation->set_rules('phone', 'Telefon', 'required|min_length[10]|max_length[14]|numeric');
		$this->form_validation->set_rules('chasis_number', 'Şase No', 'required|min_length[17]|max_length[17]');
		$this->form_validation->set_rules('brand', 'Marka', 'required|min_length[2]|max_length[250]');
		$this->form_validation->set_rules('model', 'Model', 'required|min_length[3]|max_length[250]');
		$this->form_validation->set_rules('body', 'Kasa', 'required|min_length[1]|max_length[250]');
		$this->form_validation->set_rules('year', 'Yıl', 'required|min_length[4]|max_length[4]|numeric');
		$this->form_validation->set_rules('engine_capacity', 'Motor Hacmi', 'required|min_length[1]|max_length[40]');
		$this->form_validation->set_rules('at', 'Beygir', 'required|min_length[1]|max_length[40]');
		$this->form_validation->set_rules('spare_part', 'Yedek Parça Listesi', 'required|min_length[1]');
		$this->form_validation->set_rules('content', 'Eklemek İstedikleriniz', 'min_length[3]');
		if (!$this->form_validation->run() == FALSE) {
			$postData = $this->getAllPosts();
			if (!empty($_FILES['user_file']['name'])) {
				$config['upload_path'] = './assets/uploads/';
				$config['allowed_types'] = 'bmp|gif|jpeg|jpg|jpe|jp2|png|tiff|tif';
				$config['encrypt_name'] = TRUE;
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('user_file')) {
					$this->session->set_flashdata('image_error',$this->upload->display_errors());
				} else {
					$imageInformations =  $this->upload->data();
					$postData->image = 'assets/uploads/'.$imageInformations['file_name'];
				}
			}
			if ($this->CM->offerFormAdd($postData)) {
				$this->session->set_flashdata('success','Talebiniz Başarıyla Oluşturuldu, İncelenip Geri Dönüş Sağlanacak');
				redirect(site_url('toplu-parca-teklifi'));
			} else {
				$this->session->set_flashdata('danger','Talebinizi Oluşturamıyoruz, Lütfen Daha Sonra Tekrar Deneyin');
				redirect(site_url('toplu-parca-teklifi'));
			}
		}
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('corporate_offerForm');
		$this->load->view('footer');
	}

	public function support()
	{
		$data = new stdClass();
		$this->checkUserLogin();
		$data = $this->Global_model->getAllInsert();
		$data->supportRequests = $this->CM->getSupportRequests();
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('corporate_support');
		$this->load->view('footer');
	}

	public function faq()
	{
		$data = new stdClass();
		$data = $this->Global_model->getAllInsert();
		$data->faqs = $this->CM->getFaqs();
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('corporate_faq');
		$this->load->view('footer');
	}

    public function help($slug = '')
    {
        $data = new stdClass();
        $data = $this->Global_model->getAllInsert();
        $data->helps = $this->CM->getHelps();

        //prex($data->helps);
        $data->content = $this->CM->getHelpPost($slug);

        if ($data->content == false) {
            $this->output->set_status_header('404');
            $this->load->view('head',$data);
            $this->load->view('header');
            $this->load->view('404');
            $this->load->view('footer');
        }else{
            $this->load->view('head',$data);
            $this->load->view('header');
            $this->load->view('corporate_help');
            $this->load->view('footer');
        }
    }
}

