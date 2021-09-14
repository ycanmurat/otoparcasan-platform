<?php 
/**
 * 
 */
class Cron extends Core_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function sendNotification()
    {
        $log = new StdClass;
        $this->load->model('Admin/Order_model');
        $this->load->library('mailgunapi');

        $orders = $this->Order_model->getPreparingOrders();
        $log->preparing = count($orders);
        foreach ($orders as $key => $val) {
            $data = new StdClass;

            $data->name = $val->name.' '.$val->surname;
            $data->order_id         = $val->order_id;
            $data->user_email       = $val->email;

            $html = $this->load->view('mail/order_pre',$data,true);

            $data = array('from'    => 'otoparcasan.com <info@otoparcasan.com>'
                         ,'to'      => $val->email
                         ,'subject' => $val->order_id.' Numaralı Siparişiniz Hazırlanıyor.'
                         ,'html'    => $html);

            $this->mailgunapi->send($data);


            //notification
            $this->db->set(array('user_id' => $val->user_id,'content' => '<p>'.$val->order_id
                .' Numaralı Siparişiniz Onaylanmıştır. Detayları incelemek ve takip etmek için <a href="'
                .site_url('hesabim/siparislerim/'.$val->order_id).'" >Tıklayın</a></p>'));
            $this->db->insert('notifications');

            $this->Order_model->sendedNotification($val->order_id,1);
        }


        $orders = $this->Order_model->getCargoOrders();
        $log->cargo = count($orders);
        foreach ($orders as $key => $val) {                      
            $data = new StdClass;
            $data->name = $val->name.' '.$val->surname;
            $data->products = array();
            
            foreach ($val->products as $key2 => $val2) {
                $data->products[] = (object)array('name'  => $val2->name
                                                 ,'url'   => site_url($val2->url)
                                                 ,'kod3'   => $val2->kod3
                                                 ,'image' => site_url('assets/products/fren-disk-balata.png'));
            }

            $data->order_id         = $val->order_id;
            $data->address          = $val->address;
            $data->billing_address  = $val->billing_address;
            $data->user_email       = $val->email;

            $html = $this->load->view('mail/order_cargo',$data,true);
            $data = array('from'    => 'otoparcasan.com <info@otoparcasan.com>'
                         ,'to'      => $data->user_email
                         ,'subject' => $val->order_id.' Numaralı Siparişiniz Kargoya Verildi.'
                         ,'html'    => $html);

            $this->mailgunapi->send($data);

            //notification
            $this->db->set(array('user_id' => $val->user_id,'content' => '<p>'.$val->order_id
                .' Numaralı Siparişiniz Kargoya Verilmiştir. Kargo firması teslim aldığında takip kodu sms ile bildirilecekdir.'));
            $this->db->insert('notifications');

            $this->Order_model->sendedNotification($val->order_id,2);
        }


        $orders = $this->Order_model->getCancelOrders();
        $log->cancel = count($orders);
        foreach ($orders as $key => $val) {                      
            $data = new StdClass;
            $data->name = $val->name.' '.$val->surname;
            $data->products = array();
            
            foreach ($val->products as $key2 => $val2) {
                $data->products[] = (object)array('name'  => $val2->name
                                                 ,'url'   => site_url($val2->url)
                                                 ,'kod3'   => $val2->kod3
                                                 ,'image' => site_url('assets/products/fren-disk-balata.png'));
            }

            $data->order_id         = $val->order_id;
            $data->address          = $val->address;
            $data->billing_address  = $val->billing_address;
            $data->user_email       = $val->email;

            $html = $this->load->view('mail/order_cancel',$data,true);
            $data = array('from'    => 'otoparcasan.com <info@otoparcasan.com>'
                         ,'to'      => $data->user_email
                         ,'subject' => $val->order_id.' Numaralı İptal Edildi.'
                         ,'html'    => $html);

            $this->mailgunapi->send($data);

            //notification
            $this->db->set(array('user_id' => $val->user_id,'content' => '<p>'.$val->order_id
                .' Numaralı Siparişiniz İptal Edilmiştir. Detayları incelemek ve takip etmek için <a href="'
                .site_url('hesabim/siparislerim/'.$val->order_id).'" >Tıklayın</a></p>'));
            $this->db->insert('notifications');

            $this->Order_model->sendedNotification($val->order_id,5);
        }

        prex($log);
    }
}
?>