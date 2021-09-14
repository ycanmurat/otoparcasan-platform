<?defined('BASEPATH') OR exit('No direct script access allowed');

class Core_Controller extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Core_Model');
	}

 	//Yönetici Tarafı Giriş Kontrolü
	public function checkLogin()
	{
		$sess = $this->session->userdata('user');
		if (!isset($sess)) {
			redirect(site_url('Admin/Login'));
		}
	}

	//loginse bilgileri getir
	public function getUserData()
	{
		$sess = $this->session->userdata('userInfo');
		if (isset($sess)) {
			return $sess;
		}else{
			return false;
		}
	}

	//Kullanıcı Tarafı Giriş Kontrolü
	public function checkUserLogin()
	{
        if (null !==($this->input->get('redirect'))) {
            $r = site_url('giris-yap?redirect='.current_url());
        }else{
            $r = site_url('giris-yap');
        }
        $session = $this->session->userdata('userInfo');
        if (!isset($session)) {
            redirect($r);
        }
	}

	//Social Login Kontrolü
	public function checkSocialUserLogin()
	{
		$session = $this->session->userdata('userInfo');
		if (isset($session)) {
			redirect(site_url('giris-yap'));
		}
	}

	//Kullanıcı Çerez Kontrolü
	public function getUserRememberCheck()
	{
		$data = new stdClass();
		$data->userInfo = $this->session->userdata('userInfo');
		if (!empty($data->userInfo) || !empty($this->input->cookie('remember_me'))) {
			$this->Core_Model->getCookieAndSessionInformation($this->input->cookie('remember_me'));
		}
	}

	public function getAllPosts()
	{
		$data = new StdClass;
		foreach ($this->input->post() as $key => $val) {
			$data->$key = $this->input->post($key,true);
		}
		return $data;
	}

	public function uploadImage($data)
	{
		if ((substr($data["name"],-2) != 'js') AND (substr($data["name"],-3) != 'php')){

			$target_dir 	= "assets/uploads/";
			$rand 			= rand(0,999);
			$rand 			= md5(md5($rand).md5(strtotime('now')));
			$target_file 	= $target_dir.$rand.url_seo($data["name"]);
			$newname 		= "";
			$namearr 		= explode('-', $target_file);
			$count 			= count($namearr)-1;
			foreach ($namearr as $key => $val){
				if($key == $count){
					$newname .= ".".$val;
				}elseif ($key == 0){
					$newname .= $val;
				}else{
					$newname .= "-".$val;
				}
			}
			$target_file 	= $newname;
			if (move_uploaded_file($data["tmp_name"], $target_file)){
				return $target_file;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	public function getCarImage($type, $brand, $model)
	{
		$data = array('type' => $type, 'brand' => $brand, 'model' => $model);
		
		$this->db->select('img');
		$this->db->where($data);
		$this->db->order_by('id','DESC');
		$this->db->limit(1);
		$q = $this->db->get('datCarImage');
		if ($q->num_rows()>0) {
			return $q->row()->img;
		}else{
			return false;
		}
	}

    public function sendBildirim($id = 0): void
    {
        $mails = $this->Core_Model->getBildirimMails($id);
        $this->load->library('mailgunapi');
        //$this->sendBildirim(4);
        if ($mails != false) {
            if ($id == 1) {
                $this->mailgunapi->bildirim((object)$mails,(object)array(
                     'baslik' => '1 Yeni ürün sorusu var'
                    ,'buton_link' => 'https://otoparcasan.com/Admin/Comment/questionList'
                    ,'buton_name' => 'Cevaplama sayfasına git'
                    ,'title' => 'Yeni ürün sorunuz var'));
            }else if ($id == 2) {
                $this->mailgunapi->bildirim((object)$mails,(object)array(
                     'baslik' => '1 Yeni ürün yorumu var'
                    ,'buton_link' => 'https://otoparcasan.com/Admin/Comment/commentList'
                    ,'buton_name' => 'Onaylama sayfasına git'
                    ,'title' => 'Yeni ürün yorumu var'));
            }else if ($id == 4) {
                $this->mailgunapi->bildirim((object)$mails,(object)array(
                     'baslik' => '1 Yeni site değerlendirmesi var'
                    ,'buton_link' => 'https://otoparcasan.com/Admin/Comment'
                    ,'buton_name' => 'İnceleme sayfasına git'
                    ,'title' => 'Yeni site değerlendirmesi var'));
            }else if ($id == 3) {
                $this->mailgunapi->bildirim((object)$mails,(object)array(
                     'baslik' => '1 Yeni sipariş var'
                    ,'buton_link' => 'https://otoparcasan.com/Admin/Order?s=1'
                    ,'buton_name' => 'Siparişler sayfasına git'
                    ,'title' => '1 Yeni sipariş var'));
            }
        }
    }
	
	/*public function Set_Cookie($name,$value,$time = 0)
	{
		if ($time == 0) {
			$time = time() + (60*60*30);
		}
		setcookie($name, $value, $time , "/");
		return true;
	}

	public function CookieIsset($name)
	{
		if (isset($_COOKIE[$name])) {
			return true;
		}else{
			return false;
		}
	}

	public function DeleteCookie($name)
	{
	    unset($_COOKIE[$name]);
		setcookie($name, null, -1, '/');
	}

	public function Get_Cookie($name)
	{
		return @$_COOKIE[$name];
	}

	public function IfLogin()
	{
		if ($this->CookieIsset('token')) {
			return true;
		}
		else{
			return false;
		}
	}

	public function makeArray($data)
	{
		if (is_array($data)) {
			return $data;
		}elseif (is_object($data)) {
			return (array)$data;
		}else{
			return array();
		}
	}

	public function GetCurrencyShortTag()
	{
		$cur = $this->GetCurrency();
		$this->db->select('code');
		$this->db->where(array('status' => 1, 'id' => $cur));
		$q = $this->db->get('currency');
		if ($q->num_rows() > 0) {
			return $q->row()->code;
		}
		else{
			return 'TL';
		}
	}

	public function ObjectSubToArray($obj)
	{
		foreach ($obj as $key => $val) {
			if (is_object($val)) {
				$obj[$key] = $val;
			}
		}
	}

	public function countryList()
	{
		return $this->db->get('location_countries')->result();
	}

	public function Show404()
	{
		$data = $this->PageComponent();
   	 	$this->output->set_status_header('404'); 
		$this->load->view('head');
		$this->load->view('header',$data);
		$this->load->view('404');
		$this->load->view('footer',$data);
		$this->load->view('end');
	}

	public function CheckCurrency()
	{
		if ($this->CookieIsset('currency')) {
			return true;
		}else{
			$this->Set_Cookie('currency','0');
			return true;
		}
	}

	public function GetCurrency()
	{
		return $this->Get_Cookie('currency');
	}

	public function CheckLangStatics()
	{
		$a = $this->ConsModel->GetLangStatic();
		return json_decode($a);
	}

	public function PageComponent()
	{
		
		$data = new StdClass();
		$data->langStatics 		= $this->CheckLangStatics();
		
		$data->language 		= $this->ConsModel->GetLangAll();
		$data->currency 		= $this->ConsModel->GetCurrencyAll();
		$data->categoryList 	= $this->ConsModel->ListsCategory();
		$data->getPopup     	= $this->ConsModel->listPopup();
		$data->getPop 			= $this->ConsModel->getPop();
		$data->AllOrderCount	= $this->ConsModel->AllOrderCount();
		return $data;
	}

	public function GetCurrencyPrice($cur)
	{
		$this->db->where(array('id'=>$cur));
		$this->db->select('price');
		$q = $this->db->get('currency');
		if ($q->num_rows()>0) {
			return $q->row()->price;
		}else{
			return 1;
		}
	}
	*/
}