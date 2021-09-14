<?php
/**
* Author: Muhammet Ateş
*/
class Order extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->checkLogin();
		$this->load->model('Admin/Order_model');
		if ($this->session->userdata('user')->auth != 0 && $this->session->userdata('user')->auth != 3){
			redirect(site_url('Admin'));
		}
	}

	public function index()
	{
		$header_data = new StdClass;
		$data = new StdClass;
		$header_data->mainMenu = 'Order';
		$header_data->subMenu  = 'OrderList';
        $data->selectedPage = $this->input->get('s', true);
        $data->prevPage = $data->selectedPage-1;
        $data->nextPage = $data->selectedPage+1;

        $data->filter = (object)array('order_status' => $this->input->get('order_status',true) ?? ''
                                   ,'key' => $this->input->get('key',true) ?? ''
                                   ,'payment_status' => $this->input->get('payment_status',true) ?? '');

        if ($data->filter->key != '' ||  $data->filter->payment_status != '' || $data->filter->order_status != '') {
            $allCount = $this->Order_model->getAllCount($data->filter);
        }else{
            $allCount = $this->Order_model->getAllCount();
        }

        $pageCount = 5;
        if ($allCount == 0) {
            $data->lastPage = 1;
        }else{
            $data->lastPage = ceil($allCount/$pageCount);
        }
		
        if ($data->selectedPage == "" || $data->selectedPage < 1 || $data->selectedPage > $data->lastPage) {
			redirect(get_url('Admin/Order').'s=1');
		}

        if ($data->filter->key != '' ||  $data->filter->payment_status != '' || $data->filter->order_status != '') {
            $data->orders = $this->Order_model->getList($data->selectedPage,$pageCount,$data->filter);
        }else{
            $data->orders = $this->Order_model->getList($data->selectedPage,$pageCount);
        }

        $data->orderStatus = get_admin_order_status();
        $data->paymentStatus = get_payment_status();

		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/order', $data);
		$this->load->view('Admin/footer');
	}

	public function detail($id = 0)
	{
		if ($id == 0) {
			redirect(admin_url('Order'));
		}

		$data = new StdClass;
		$data->mainMenu = 'Order';
		$data->subMenu  = 'OrderList';

        $data->missingProduct = 0;
		$data->order = $this->Order_model->getOrderId($id);

        if ($data->order == false) {
            redirect(admin_url('Order'));
        }

        foreach ($data->order->lines as $key => $val) {
            if ($val->status_inside == 8) {
                $data->missingProduct++;
            }
        }

        //prex($data->order);

		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/order_view');
		$this->load->view('Admin/footer');
	}

    public function missingProductSuccess($id)
    {
        $this->load->library('mailgunapi');
        $this->Order_model->missingProductSuccess($id);
        $order = $this->Order_model->getOrderId($id);

        $data = new StdClass;
        $data->name = $order->user->name.' '.$order->user->surname;
        $data->products = array();
        
        foreach ($order->lines as $key => $val) {
            if ($val->status_inside < 7) {
                $data->products[] = (object)array('name'  => $val->name
                                             ,'url'   => site_url($val->url)
                                             ,'kod3'  => $val->kod3
                                             ,'image' => site_url('assets/products/fren-disk-balata.png'));
            }
        }

        $data->order_id         = $order->id;
        $data->address          = $order->address->content.' '.$order->address->town_name.' / '.$order->address->city_name;
        $data->billing_address  = $order->invoice_address->content.' '.$order->invoice_address->town_name.' / '.$order->invoice_address->city_name;
        $data->user_email       = $order->user->email;

        $html = $this->load->view('mail/order_eksik_confirm',$data,true);
        $data = array('from'    => 'otoparcasan.com <info@otoparcasan.com>'
                     ,'to'      => $data->user_email
                     ,'subject' => $val->order_id.' Numaralı Siparişiniz Güncellendi.'
                     ,'html'    => $html);

        $this->mailgunapi->send($data);
        $this->Order_model->sendedNotification($val->order_id,1);

        redirect($this->agent->referrer());
    }

    public function paymentStatusCheck() // Ödeme Onaylama Listesi
    {
        $data = new StdClass;
        $data->mainMenu = 'Order';
        $data->subMenu  = 'OdemeOnay';

        $data->orders = $this->Order_model->getOrdersByPaymentStatus();

        $this->load->view('Admin/header', $data);
        $this->load->view('Admin/order_payment_check');
        $this->load->view('Admin/footer');
    }

    public function changePaymentStatus($id,$type)
    {
        if ($type == 1) {
            $this->Order_model->paymentSuccess($id);
        }else{
            $this->Order_model->paymentError($id);
        }

        redirect($this->agent->referrer());
    }

    public function supplyCheck() // Tedarik Onaylama Listesi
    {
        $data = new StdClass;
        $data->mainMenu = 'Order';
        $data->subMenu  = 'TedarikOnay';

        $data->orderLines = $this->Order_model->getCurrentOrdersSublyCheck();

        $this->load->view('Admin/header', $data);
        $this->load->view('Admin/order_supply_check');
        $this->load->view('Admin/footer');
    }

    public function changeSupplyCheck($cari,$stok,$type)
    {
        if ($type == 1) {
            $this->Order_model->supplySuccess($cari,$stok);
        }else{
            $this->Order_model->supplyError($cari,$stok);
        }

        redirect($this->agent->referrer());
    }

    public function cancelOrderRefound()
    {
        $data = new StdClass;
        $data->mainMenu = 'Order';
        $data->subMenu  = 'SiparisIade';

        $data->orders = $this->Order_model->getcancelOrderRefound();

        $this->load->view('Admin/header', $data);
        $this->load->view('Admin/order_refound');
        $this->load->view('Admin/footer');
    }

    public function cancelOrderRefoundSuccess($id = '')
    {
        $this->Order_model->cancelOrderRefoundSuccess($id);
        
        redirect($this->agent->referrer());
    }

    public function changeIncomingCheck($cari,$stok,$type)
    {
        if ($type == 1) {
            $this->Order_model->incomingSuccess($cari,$stok);
        }else{
            $this->Order_model->incomingError($cari,$stok);
        }

        redirect($this->agent->referrer());
    }

    public function changeOutgoingCheck($cari,$stok,$type)
    {
        if ($type == 1) {
            $this->Order_model->outGoingSuccess($cari,$stok);
        }else{
            $this->Order_model->outGoingError($cari,$stok);
        }

        redirect($this->agent->referrer());
    }

    public function IncomingProductCheck() // Gelen Ürün Onaylama Listesi
    {
        $data = new StdClass;
        $data->mainMenu = 'Order';
        $data->subMenu  = 'GelenOnay';

        $data->orderLines = $this->Order_model->getIncomingProducts();

        $this->load->view('Admin/header', $data);
        $this->load->view('Admin/order_invoming_check');
        $this->load->view('Admin/footer');
    }

    public function missingProguctCheck() // Eksik Ürün Onaylama Listesi
    {
        $data = new StdClass;
        $data->mainMenu = 'Order';
        $data->subMenu  = 'EksikUrun';

        $data->orders = $this->Order_model->getMissinProducts();

        $this->load->view('Admin/header', $data);
        $this->load->view('Admin/missing_products_order');
        $this->load->view('Admin/footer');
    }

    public function goingCargoCheck()
    {
        $data = new StdClass;
        $data->mainMenu = 'Order';
        $data->subMenu  = 'KargoOnay';

        $data->orders = $this->Order_model->getgoingCargoCheck();

        $this->load->view('Admin/header', $data);
        $this->load->view('Admin/order_go_cargo');
        $this->load->view('Admin/footer');
    }

    public function goingCargoSuccess($id)
    {
        $this->Order_model->goingCargoSuccess($id);

        redirect($this->agent->referrer());
    }

    public function outGoingCheck() // Giden Ürün Onaylama Listesi
    {
        $data = new StdClass;
        $data->mainMenu = 'Order';
        $data->subMenu  = 'GidenOnay';

        $data->orderLines = $this->Order_model->getOutgoingProducts();

        $this->load->view('Admin/header', $data);
        $this->load->view('Admin/order_outgoing_check');
        $this->load->view('Admin/footer');
    }

    public function orderCancel($id = '')
    {
        $this->Order_model->orderCancel($id);
        redirect($this->agent->referrer());
    }
}
?>