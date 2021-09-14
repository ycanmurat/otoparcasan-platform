<?defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
        $this->load->model('Cart_model','CM');
		$this->getUserRememberCheck();
	}

	public function index()
	{
		$data = new stdClass();
		$data = $this->Global_model->getAllInsert();
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('cart_list');
		$this->load->view('footer');
	}
	
	public function address()
	{
        $this->load->model('Account_model','AM');
		$data = new stdClass();
		$data = $this->Global_model->getAllInsert();

        if (!$data->userInfo) {
            redirect(site_url('sepet'));
        }

        $data->country  = $this->AM->getCountries();
        $data->address  = $this->AM->getUserByAddress($data->userInfo->id);
        $data->cities   = $this->AM->getCities();
        $data->counties = $this->AM->getCounties();
        $data->order    = $this->CM->getTempOrder($data->userInfo->id);

        if (!$data->order) {
            redirect(site_url('sepet'));
        }else{
            $data->orderTable = new stdClass;
            $data->orderTable->total = 0;
            $data->orderTable->kargo = $data->order->order->shipping_price;

            foreach ($data->order->lines as $key => $val) {
                $data->orderTable->total += $val->price*$val->count;
            }

            $data->orderTable->araToplam    = number_format(($data->orderTable->total/1.18),2,',','.');
            $data->orderTable->kdv          = number_format(($data->orderTable->total-$data->orderTable->total/1.18),2,',','.');
            $data->orderTable->total        += $data->orderTable->kargo;
            $data->orderTable->kargo        = number_format(($data->orderTable->kargo),2,',','.');
            $data->orderTable->total        = number_format(($data->orderTable->total),2,',','.');
        }

		$this->load->view('head',$data);
		$this->load->view('cart_address');
		$this->load->view('footer');
	}

	public function pay()
	{
		$data = new stdClass();
        $data = $this->Global_model->getAllInsert();
        if (!$data->userInfo) {
            redirect(site_url('sepet'));
        }

		$data->order = $this->CM->getOrderDetail($data->userInfo->id);
        $this->session->set_userdata('order',$data->order);
        if (!$data->order) {
            redirect(site_url('sepet'));
        }else{
            $data->orderTable = new stdClass;
            $data->orderTable->total = 0;
            $data->orderTable->kargo = $data->order->order->shipping_price;

            foreach ($data->order->lines as $key => $val) {
                $data->orderTable->total += $val->price*$val->count;
            }

            $data->orderTable->araToplam    = number_format(($data->orderTable->total/1.18),2,',','.');
            $data->orderTable->kdv          = number_format(($data->orderTable->total-$data->orderTable->total/1.18),2,',','.');
            $data->orderTable->total        += $data->orderTable->kargo;
            $data->orderTable->kargo        = number_format(($data->orderTable->kargo),2,',','.');
            $data->orderTable->total        = number_format(($data->orderTable->total),2,',','.');
        }

        $data->PayTRtoken = $this->CM->payTR($data->order,$data->userInfo);
        if ($data->PayTRtoken['status'] == 'success') {
            $data->PayTRtoken = $data->PayTRtoken['token'];
        }else{
            prex($data->PayTRtoken);
        }

		$this->load->view('head',$data);
		$this->load->view('cart_pay');
		$this->load->view('footer');
	}

    public function paytr_98423()
    {
        $post = $this->getAllPosts();

        $merchant_key   = getenv('PAYTR_MERCHANT_KEY');
        $merchant_salt  = getenv('PAYTR_MERCHANT_SALT');

        $hash = base64_encode(hash_hmac('sha256', $post->merchant_oid.$merchant_salt.$post->status.$post->total_amount, $merchant_key, true));

        if($hash != $post->hash){
            die('PAYTR notification failed: bad hash');
        }

        if (isset($post->failed_reason_code)) {
            if ($post->failed_reason_code != 6) {
                $this->CM->addPayTrLog($post);
            }
        }else{
            $this->CM->addPayTrLog($post);
            if($post->status == 'success') { ## Ödemeye Onaylandı
                $this->CM->doOrderSuccess($post->merchant_oid,$post->payment_type,($post->payment_amount));
                $this->sendBildirim(3);
            }else{ ## Ödemeye Onay Verilmedi
                $this->CM->doOrderUnSuccess($post->merchant_oid,$post->payment_type,($post->payment_amount));
            }
        }
        echo 'OK';
    }

    public function paytrTest()
    {
        $post = (object)array('hash' => 'y7zw71h0r+Ru2KsSzOGbyySNPatb/lAnNigGk4oQRLU='
                     ,'merchant_oid' => 112
                     ,'status' => 'success'
                     ,'total_amount' => 31412
                     ,'payment_type' => 'card'
                     ,'payment_amount' => 31412
                     ,'currency' => 'TL'
                     ,'installment_count' => 1
                     ,'merchant_id' => 151345
                     ,'test_mode' => 1);

        //$this->CM->addPayTrLog($post);
        if($post->status == 'success') { ## Ödemeye Onaylandı
            $this->CM->doOrderSuccess($post->merchant_oid,$post->payment_type,($post->payment_amount));
            //$this->sendBildirim(3);
        }else{ ## Ödemeye Onay Verilmedi
            $this->CM->doOrderUnSuccess($post->merchant_oid,$post->payment_type,($post->payment_amount));
        }
    }

    public function success()
    {
        $data = new stdClass();
        $data = $this->Global_model->getAllInsert();
        $data->order = $this->session->userdata('order');

        if (empty($data->order)) {
            redirect(site_url());
        }

        $this->load->view('head',$data);
        $this->load->view('cart_success');
        $this->load->view('footer');
    }

    public function error()
    {
        $data = new stdClass();
        $data = $this->Global_model->getAllInsert();
        $this->load->view('head',$data);
        $this->load->view('cart_error');
        $this->load->view('footer');
    }
}