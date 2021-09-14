<?defined('BASEPATH') OR exit('No direct script access allowed');
    
class Cart_model extends Core_Model
{
    
    function __construct()
    {
        parent::__construct();
    }

    public function getTempOrder($user_id)
    {
        $data = new StdClass;
        $this->db->where(array('user_id' => $user_id));
        $q = $this->db->get('temp_orders');
        if ($q->num_rows()>0) {
            $data->order = $q->row();
            $this->db->where(array('user_id' => $user_id));
            $q = $this->db->get('temp_order_line');
            if ($q->num_rows()>0) {
                $data->lines = $q->result();
                return $data;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function doRealOrder($user_id)
    {
        $data = $this->getTempOrder($user_id);
        if ($data == false) {
            return false;
        }

        unset($data->order->id);
        $this->db->insert('orders',$data->order);
        $order_id = $this->db->insert_id();
        if ($order_id != false && !empty(trim($order_id))) {
            //burda kaldık kaydetip devam edicem
            foreach ($data->lines as $key => $val) {
                $data->lines[$key]->order_id = $order_id;
                unset($data->lines[$key]->id);
            }

            if ($this->db->insert_batch('order_line',$data->lines)) {
                return true;
            }
            return false;
        }
    }

    public function getOrderAddress($id)
    {
        $this->db->where(array('id' => $id));
        $q = $this->db->get('order_addresses');
        if ($q->num_rows()>0) {
            return $q->row();
        }else{
            return false;
        }
    }

    public function doOrderSuccess($order_id,$payment_type,$payment_amount)
    {
        $this->db->where('id',$order_id);
        $this->db->set(array('payment_type'     => payment_types($payment_type)
                            ,'paytrStatus'      => 1
                            ,'pay_price'        => ($payment_amount/100)
                            ,'order_status'     => 1
                            ,'payment_status'   => 2
                            ,'order_status_inside'   => 2
                        ));
        $this->db->update('orders');
        if ($this->db->affected_rows()>0) {
            $this->db->select('u.id,u.name,u.surname,u.phone,u.email
                ,(SELECT SUM(price*count) FROM order_line WHERE order_id = o.id) price
                ,(SELECT CONCAT
                    (content
                    ," "
                    ,(SELECT cityname FROM location_cities WHERE location_cities.cityid = order_addresses.city)
                    ,"/"
                    ,(SELECT countyname FROM location_counties WHERE location_counties.countyid = order_addresses.town)
                ) FROM order_addresses WHERE id = o.address_id) address
                ,(SELECT CONCAT
                    (content
                    ," "
                    ,(SELECT cityname FROM location_cities WHERE location_cities.cityid = order_addresses.city)
                    ,"/"
                    ,(SELECT countyname FROM location_counties WHERE location_counties.countyid = order_addresses.town)
                ) FROM order_addresses WHERE id = o.invoice_address_id) billing_address');
            $this->db->where('o.id',$order_id);
            $this->db->from('orders o');
            $this->db->join('users u','u.id=o.user_id');
            $q = $this->db->get();
            if ($q->num_rows()>0) {
                $user = $q->row();
                $this->db->select('url,stok_id,name,price,count,kod3');
                $this->db->where('order_id',$order_id);
                $q = $this->db->get('order_line');
                    if ($q->num_rows()>0) {
                        $products = $q->result();
                        //mail bildirim
                        $this->load->library('mailgunapi');                        
                        $data = new StdClass;
                        $data->name = $user->name.' '.$user->surname;
                        $data->products = array();
                        
                        foreach ($products as $key => $val) {
                            $data->products[] = (object)array('name'  => $val->name
                                             ,'url'   => site_url($val->url)
                                             ,'kod3'  => $val->kod3
                                             ,'image' => site_url('assets/products/fren-disk-balata.png'));
                        }

                        $data->order_id         = $order_id;
                        $data->address          = $user->address;
                        $data->billing_address  = $user->billing_address;
                        $data->user_email       = $user->email;

                        $html = $this->load->view('mail/order',$data,true);
                        $data = array('from'    => 'otoparcasan.com <info@otoparcasan.com>'
                                     ,'to'      => $data->user_email
                                     ,'subject' => 'Siparişiniz Oluşturuldu'
                                     ,'html'    => $html);

                        $this->mailgunapi->send($data);

                        //notification
                        $this->db->set(array('user_id' => $user->id,'content' => '<p>'.$order_id
                            .' Numaralı siparişiniz alınmışıtr. Detayları incelemek ve takip etmek için <a href="'
                            .site_url('hesabim/siparislerim/'.$order_id).'" >Tıklayın</a></p>'));
                        $this->db->insert('notifications');
                        
                        //sms
                        $smsData = new StdClass;
                        $smsData->receivers = str_replace(' ','',str_replace(')','',str_replace('(','',$user->phone)));
                        $smsData->text = 'Merhaba '.mb_convert_case($user->name.' '.$user->surname, MB_CASE_TITLE, "UTF-8").'\n'.$order_id.' numaralı siparişiniz başarı ile oluşturulmuştur. Bizi tercih ettiğiniz için teşekkürler.';
                        $this->load->library('sms');
                        $this->sms->NetGsmSend($smsData);
                    }
            }

            return true;
        }else{
            return false;
        }
    }

    public function doOrderUnSuccess($order_id,$payment_type,$payment_amount)
    {
        $this->db->where('id',$order_id);
        $this->db->set(array('payment_type'     => payment_types($payment_type)
                            ,'paytrStatus'      => 1
                            ,'pay_price'        => ($payment_amount/100)
                            ,'order_status'     => 4
                            ,'payment_status'   => 3
                            ,'order_status_inside'   => 6
                        ));
        $this->db->update('orders');
        if ($this->db->affected_rows()>0) {
            return true;
        }else{
            return false;
        }
    }

    public function addPayTrLog($data)
    {
        $this->db->insert('paytr_log',$data);
    }

    public function payTR($order,$userInfo)
    {
        ## 1. ADIM için örnek kodlar ##
        ####################### DÜZENLEMESİ ZORUNLU ALANLAR #######################
        #
        ## API Entegrasyon Bilgileri - Mağaza paneline giriş yaparak BİLGİ sayfasından alabilirsiniz.
        $merchant_id    = getenv('PAYTR_MERCHANT_ID');
        $merchant_key   = getenv('PAYTR_MERCHANT_KEY');
        $merchant_salt  = getenv('PAYTR_MERCHANT_SALT');
        #
        ## Müşterinizin sitenizde kayıtlı veya form vasıtasıyla aldığınız eposta adresi
        $email = $userInfo->email;
        #
        ## Tahsil edilecek tutar.
        $payment_amount = ($order->price+$order->order->shipping_price)*100; //9.99 için 9.99 * 100 = 999 gönderilmelidir.
        #
        ## Sipariş numarası: Her işlemde benzersiz olmalıdır!! Bu bilgi bildirim sayfanıza yapılacak bildirimde geri gönderilir.
        $merchant_oid = $order->order->id;
        #
        ## Müşterinizin sitenizde kayıtlı veya form aracılığıyla aldığınız ad ve soyad bilgisi
        $user_name = $userInfo->name.' '.$userInfo->surname;
        #
        ## Müşterinizin sitenizde kayıtlı veya form aracılığıyla aldığınız adres bilgisi
        $user_address = $order->billing_address->content;
        #
        ## Müşterinizin sitenizde kayıtlı veya form aracılığıyla aldığınız telefon bilgisi
        $user_phone = $userInfo->phone;
        #
        ## Başarılı ödeme sonrası müşterinizin yönlendirileceği sayfa
        ## !!! Bu sayfa siparişi onaylayacağınız sayfa değildir! Yalnızca müşterinizi bilgilendireceğiniz sayfadır!
        ## !!! Siparişi onaylayacağız sayfa "Bildirim URL" sayfasıdır (Bakınız: 2.ADIM Klasörü).
        $merchant_ok_url = site_url('sepet/basarili');
        #
        ## Ödeme sürecinde beklenmedik bir hata oluşması durumunda müşterinizin yönlendirileceği sayfa
        ## !!! Bu sayfa siparişi iptal edeceğiniz sayfa değildir! Yalnızca müşterinizi bilgilendireceğiniz sayfadır!
        ## !!! Siparişi iptal edeceğiniz sayfa "Bildirim URL" sayfasıdır (Bakınız: 2.ADIM Klasörü).
        $merchant_fail_url = site_url('sepet/basarisiz');
        #
        ## Müşterinin sepet/sipariş içeriği
        $basket = array();
        foreach ($order->lines as $key => $val) {
           $baket[] = array($val->name, $val->price, $val->count);
        }
        $user_basket = base64_encode(json_encode($basket));
        #
        /* ÖRNEK $user_basket oluşturma - Ürün adedine göre array'leri çoğaltabilirsiniz
        $user_basket = base64_encode(json_encode(array(
            array("Örnek ürün 1", "18.00", 1), // 1. ürün (Ürün Ad - Birim Fiyat - Adet )
            array("Örnek ürün 2", "33.25", 2), // 2. ürün (Ürün Ad - Birim Fiyat - Adet )
            array("Örnek ürün 3", "45.42", 1)  // 3. ürün (Ürün Ad - Birim Fiyat - Adet )
        )));
        */
        ############################################################################################

        ## Kullanıcının IP adresi
        if( isset( $_SERVER["HTTP_CLIENT_IP"] ) ) {
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        } elseif( isset( $_SERVER["HTTP_X_FORWARDED_FOR"] ) ) {
            $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else {
            $ip = $_SERVER["REMOTE_ADDR"];
        }

        ## !!! Eğer bu örnek kodu sunucuda değil local makinanızda çalıştırıyorsanız
        ## buraya dış ip adresinizi (https://www.whatismyip.com/) yazmalısınız. Aksi halde geçersiz paytr_token hatası alırsınız.
        $user_ip=$ip;
        ##

        ## İşlem zaman aşımı süresi - dakika cinsinden
        $timeout_limit = "30";

        ## Hata mesajlarının ekrana basılması için entegrasyon ve test sürecinde 1 olarak bırakın. Daha sonra 0 yapabilirsiniz.
        $debug_on = 1;

        ## Mağaza canlı modda iken test işlem yapmak için 1 olarak gönderilebilir.
        $test_mode = 0;

        $no_installment = 0; // Taksit yapılmasını istemiyorsanız, sadece tek çekim sunacaksanız 1 yapın

        ## Sayfada görüntülenecek taksit adedini sınırlamak istiyorsanız uygun şekilde değiştirin.
        ## Sıfır (0) gönderilmesi durumunda yürürlükteki en fazla izin verilen taksit geçerli olur.
        $max_installment = 0;

        $currency = "TL";
        
        ####### Bu kısımda herhangi bir değişiklik yapmanıza gerek yoktur. #######
        $hash_str = $merchant_id .$user_ip .$merchant_oid .$email .$payment_amount .$user_basket.$no_installment.$max_installment.$currency.$test_mode;
        $paytr_token=base64_encode(hash_hmac('sha256',$hash_str.$merchant_salt,$merchant_key,true));
        $post_vals=array(
                'merchant_id'=>$merchant_id,
                'user_ip'=>$user_ip,
                'merchant_oid'=>$merchant_oid,
                'email'=>$email,
                'payment_amount'=>$payment_amount,
                'paytr_token'=>$paytr_token,
                'user_basket'=>$user_basket,
                'debug_on'=>$debug_on,
                'no_installment'=>$no_installment,
                'max_installment'=>$max_installment,
                'user_name'=>$user_name,
                'user_address'=>$user_address,
                'user_phone'=>$user_phone,
                'merchant_ok_url'=>$merchant_ok_url,
                'merchant_fail_url'=>$merchant_fail_url,
                'timeout_limit'=>$timeout_limit,
                'currency'=>$currency,
                'test_mode'=>$test_mode
            );
        
        $ch=curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://www.paytr.com/odeme/api/get-token");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1) ;
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_vals);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        $result = @curl_exec($ch);

        if(curl_errno($ch))
            die("PAYTR IFRAME connection error. err:".curl_error($ch));

        curl_close($ch);
        $result=json_decode($result,1);
        return $result;
    }

    public function getOrderDetail($user_id)
    {
        $data = new StdClass;
        $this->db->where(array('user_id' => $user_id));
        $this->db->limit(1);
        $this->db->order_by('id','DESC');
        $q = $this->db->get('orders');
        if ($q->num_rows()>0) {
            $data->order = $q->row();
            $data->shiping_address = $this->getOrderAddress($data->order->address_id);
            $data->billing_address = $this->getOrderAddress($data->order->invoice_address_id);
            if ($data->shiping_address == false || $data->billing_address == false) {
                return false;
            }

            $this->db->where(array('user_id' => $user_id,'order_id' =>$data->order->id));
            $q = $this->db->get('order_line');
            if ($q->num_rows()>0) {
                $data->lines = $q->result();
                $data->price = 0;
                foreach ($data->lines as $key => $val) {
                    $data->price += $val->price*$val->count;
                }
                return $data;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}