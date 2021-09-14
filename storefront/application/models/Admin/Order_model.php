<?php
/**
* Author: Muhammet Ateş
*/
class Order_model extends Core_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function getList($sayfa,$pageBy,$filter = '')
	{
		$data 		= new StdClass;

        $this->db->select('o.*,u.name,u.surname,(SELECT SUM(count) FROM order_line WHERE order_id = o.id AND status_inside != 7) count,(SELECT SUM(price*count) FROM order_line WHERE order_id = o.id AND status_inside != 7) totalPrice');
        
        if ($filter != '') {
            //prex($filter);
            if (!empty(($filter->key))) {
                $this->db->group_start();
                    $this->db->or_like('o.id',$filter->key);
                    $this->db->or_like('u.name',$filter->key);
                    $this->db->or_like('u.surname',$filter->key);
                    $this->db->or_like('u.phone',$filter->key);
                    $this->db->or_like('u.email',$filter->key);
                    $this->db->or_like('a.name',$filter->key);
                    $this->db->or_like('a.gsm',$filter->key);
                    $this->db->or_like('i.name',$filter->key);
                    $this->db->or_like('a.gsm',$filter->key);
                $this->db->group_end();
            }
            if ($filter->order_status != '') {
                $this->db->where('o.order_status_inside',$filter->order_status);
            }

            if ($filter->payment_status != '') {
                $this->db->where('o.payment_status',$filter->payment_status);
            }
        }

        $this->db->where('o.order_status > 0');

		if ($sayfa == 1){
			$start = 0;
		}else{
			$start = ($sayfa-1)*$pageBy;
		}
        
        $this->db->join('order_addresses a','a.id = o.address_id');
        $this->db->join('order_addresses i','i.id = o.invoice_address_id');
        $this->db->limit($pageBy,$start);
        $this->db->order_by('o.id','DESC');
        $this->db->join('users u','u.id = o.user_id');
        $q = $this->db->get('orders o');
        //prex($this->db->last_query());
        if ($q->num_rows()>0) {
            return $q->result();
        }else{
            return array();
        }
	}

    public function orderCancel($id)
    {
        $this->db->where('id',$id);
        $this->db->set(array('order_status' => 4,'order_status_inside' => 7));
        $this->db->update('orders');
    }

    public function missingProductSuccess($id)
    {
        $this->db->where(array('order_id' => $id,'status_inside' => 8));
        $this->db->set(array('status_inside' => 7));
        $this->db->update('order_line');
        $this->db->query('CALL orderStatusChange();');
        return true;
    }

    public function getAllCount($filter = '')
    {
        if ($filter != '') {
            if (!empty(($filter->key))) {
                $this->db->group_start();
                    $this->db->or_like('o.id',$filter->key);
                    $this->db->or_like('u.name',$filter->key);
                    $this->db->or_like('u.surname',$filter->key);
                    $this->db->or_like('u.phone',$filter->key);
                    $this->db->or_like('u.email',$filter->key);
                    $this->db->or_like('a.name',$filter->key);
                    $this->db->or_like('a.gsm',$filter->key);
                    $this->db->or_like('i.name',$filter->key);
                    $this->db->or_like('a.gsm',$filter->key);
                $this->db->group_end();
            }
            if (!empty(trim($filter->order_status))) {
                $this->db->where('o.order_status_inside',$filter->order_status);
            }

            if (!empty(($filter->payment_type))) {
                $this->db->where('o.payment_type',$filter->payment_type);
            }
        }
        $this->db->where('o.order_status > 0');
        $this->db->join('order_addresses a','a.id = o.address_id');
        $this->db->join('order_addresses i','i.id = o.invoice_address_id');
        $this->db->join('users u','u.id = o.user_id');

        return $this->db->count_all_results('orders o');
    }

    public function getOrderId($id)
    {
        $this->db->select('*,(SELECT SUM(price*count) FROM order_line WHERE order_id = orders.id AND status_inside != 7) product_price,(SELECT SUM(count) FROM order_line WHERE order_id = orders.id AND status_inside != 7) count');
        $this->db->where(array('id' => $id));
        $q = $this->db->get('orders');
        if ($q->num_rows()>0) {
            $order = $q->row();
            $q = $this->db->get_where('users',array('id' => $order->user_id));
            if ($q->num_rows()>0) {
                $order->user = $q->row();
            }

            $order->address = false;
            $order->invoice_address = false;
            if ($order->address_id == $order->invoice_address_id) {
                $this->db->select('o.*
                                ,(SELECT CityName city FROM location_cities WHERE cityid = o.city) city_name
                                ,(SELECT CountyName FROM location_counties WHERE countyid = o.town) town_name');
                $this->db->where('o.id',$order->address_id);
                $q = $this->db->get('order_addresses o');
                if ($q->num_rows()>0) {
                    $address = $q->row();
                    $order->address = $address;
                    $order->invoice_address = $address;
                }
            }else{
                $this->db->select('o.*
                                ,(SELECT CityName city FROM location_cities WHERE cityid = o.city) city_name
                                ,(SELECT CountyName FROM location_counties WHERE countyid = o.town) town_name');
                $this->db->where('o.id',$order->address_id);
                $q = $this->db->get('order_addresses o');
                if ($q->num_rows()>0) {
                    $address = $q->row();
                    $order->address = $address;
                }
                $this->db->select('o.*
                                ,(SELECT CityName city FROM location_cities WHERE cityid = o.city) city_name
                                ,(SELECT CountyName FROM location_counties WHERE countyid = o.town) town_name');
                $this->db->where('o.id',$order->invoice_address_id);
                $q = $this->db->get('order_addresses o');
                if ($q->num_rows()>0) {
                    $address = $q->row();
                    $order->invoice_address = $address;
                }
            }

            $this->db->where(array('order_id' => $order->id));
            $q = $this->db->get('order_line');
            if ($q->num_rows()>0) {
                $order->lines = $q->result();
            }else{
                $order->lines = array();
            }
            return $order;
        }else{
            return false;
        }
    }

	public function SetOrderStatus($id, $new)
	{
		return $this->db->where('id', $id)->set('order_status', $new)->update('orders');
	}

	public function SetPaymentStatus($id, $new)
	{
		return $this->db->where('id', $id)->set('payment_status', $new)->update('orders');
	}

	public function ChangeStatus($id, $status, $new)
	{
		$this->db->set($status."_status", $new)->where('id', $id)->update('orders');
	}

	public function UpdateAddress($id, $newArr)
	{
		return $this->db->where('id', $id)->update('order_addresses', $newArr);
	}

    public function getOrdersByPaymentStatus()
    {
        $data       = new StdClass;

        $this->db->select('o.*,u.name,u.surname,(SELECT SUM(count) FROM order_line WHERE order_id = o.id) count,(SELECT SUM(price*count) FROM order_line WHERE order_id = o.id) totalPrice');

        $this->db->where('o.order_status > 0');

        $this->db->where('payment_status',1);
        $this->db->where('order_status_inside',1);

        $this->db->order_by('o.id','ASC');
        $this->db->join('users u','u.id = o.user_id');
        $q = $this->db->get('orders o');
        if ($q->num_rows()>0) {
            return $q->result();
        }else{
            return array();
        }
    }

    public function getCurrentOrdersSublyCheck()
    {
        $data       = new StdClass;

        $this->db->select('ol.name,ol.stok_id,ol.cari_id,ol.url,SUM(ol.count) count,ol.price');
        //$this->db->select('*');

        $this->db->where('o.payment_status',2);
        $this->db->where('o.order_status_inside',2);
        $this->db->where('ol.status_inside',2);

        $this->db->join('order_line ol','ol.order_id = o.id');
        $this->db->group_by(array('ol.stok_id','ol.cari_id','ol.price'));
        $q = $this->db->get('orders o');
        //prex($this->db->last_query());
        if ($q->num_rows()>0) {
            //prex($q->result());
            return $q->result();
        }else{
            return array();
        }
    }

    public function getIncomingProducts()
    {
        $data       = new StdClass;

        $this->db->select('ol.name,ol.stok_id,ol.cari_id,ol.url,SUM(ol.count) count,ol.price');
        $this->db->group_start();
            $this->db->or_where('o.order_status_inside',2);
            $this->db->or_where('o.order_status_inside',3);
        $this->db->group_end();

        $this->db->group_start();
            $this->db->where('o.payment_status',2);
            $this->db->where('ol.status_inside',3);
        $this->db->group_end();

        $this->db->join('order_line ol','ol.order_id = o.id');
        $this->db->group_by(array('ol.stok_id','ol.cari_id','ol.price'));
        $q = $this->db->get('orders o');
        //prex($this->db->last_query());
        if ($q->num_rows()>0) {
            //prex($q->result());
            return $q->result();
        }else{
            return array();
        }
    }

    public function getOutgoingProducts()
    {
        $data       = new StdClass;

        $this->db->select('ol.name,ol.stok_id,ol.cari_id,ol.url,SUM(ol.count) count,ol.price');
        $this->db->group_start();
            $this->db->or_where('o.order_status_inside',2);
            $this->db->or_where('o.order_status_inside',3);
            $this->db->or_where('o.order_status_inside',4);
        $this->db->group_end();

        $this->db->group_start();
            $this->db->where('o.payment_status',2);
            $this->db->where('ol.status_inside',4);
        $this->db->group_end();

        $this->db->join('order_line ol','ol.order_id = o.id');
        $this->db->group_by(array('ol.stok_id','ol.cari_id','ol.price'));
        $q = $this->db->get('orders o');
        //prex($this->db->last_query());
        if ($q->num_rows()>0) {
            //prex($q->result());
            return $q->result();
        }else{
            return array();
        }
    }

    public function getMissinProducts()
    {
        $data       = new StdClass;

        $this->db->select('o.*,u.name,u.surname,(SELECT SUM(count) FROM order_line WHERE order_id = o.id AND status_inside != 7) count,(SELECT SUM(price*count) FROM order_line WHERE order_id = o.id AND status_inside != 7) totalPrice');
        $this->db->where('o.order_status_inside != 7');
        $this->db->where('o.payment_status',2);
        $this->db->where('ol.status_inside',8);
        $this->db->join('order_line ol','ol.order_id = o.id');
        $this->db->join('users u','o.user_id = u.id');
        $this->db->group_by('o.id');
        $q = $this->db->get('orders o');
        if ($q->num_rows()>0) {
            return $q->result();
        }else{
            return array();
        }
    }

    public function getgoingCargoCheck()
    {
        $data       = new StdClass;

        $this->db->select('o.*,u.name,u.surname,(SELECT SUM(count) FROM order_line WHERE order_id = o.id AND status_inside != 7) count,(SELECT SUM(price*count) FROM order_line WHERE order_id = o.id AND status_inside != 7) totalPrice');
        $this->db->where('o.order_status_inside',5);
        $this->db->where('o.payment_status',2);
        $this->db->join('order_line ol','ol.order_id = o.id');
        $this->db->join('users u','o.user_id = u.id');
        $this->db->group_by('o.id');
        $q = $this->db->get('orders o');
        if ($q->num_rows()>0) {
            return $q->result();
        }else{
            return array();
        }
    }

    public function cancelOrderRefoundSuccess($id)
    {
        $this->db->where('id',$id);
        $this->db->set('payment_status',4);
        $this->db->update('orders');
        return true;
    }

    public function getcancelOrderRefound()
    {
        $data       = new StdClass;

        $this->db->select('o.*,u.name,u.surname,(SELECT SUM(count) FROM order_line WHERE order_id = o.id) count,(SELECT SUM(price*count) FROM order_line WHERE order_id = o.id) totalPrice');
        $this->db->where('o.order_status_inside',7);
        $this->db->where('o.payment_status',2);
        $this->db->where('o.payment_type',1);
        $this->db->join('order_line ol','ol.order_id = o.id');
        $this->db->join('users u','o.user_id = u.id');
        $this->db->group_by('o.id');
        $q = $this->db->get('orders o');
        if ($q->num_rows()>0) {
            return $q->result();
        }else{
            return array();
        }
    }

    public function goingCargoSuccess($id)
    {
        $this->db->where(array('order_id' => $id
                              ,'status_inside' => 5
                          ));
        $this->db->set('status_inside',6);
        $this->db->update('order_line');

        $this->db->query('Update orders
                            SET
                                order_status_inside = 6, order_status = 3
                            WHERE id IN (
                                SELECT
                                    a.order_id
                                FROM
                                    (SELECT order_id,SUM(count) count FROM order_line WHERE status_inside != 7 GROUP BY order_id) a
                                INNER JOIN
                                    (SELECT order_id,SUM(count) count FROM order_line WHERE status_inside = 6 GROUP BY order_id) g
                                ON
                                    a.order_id = g.order_id
                                WHERE
                                    a.count = g.count
                            ) AND order_status != 4  AND order_status != 3;');
    }

    public function paymentSuccess($id)
    {
        $this->db->where(array('id' => $id,'payment_status' => 1,'order_status_inside' => 1));
        $this->db->set(array('payment_status' => 2
                            ,'order_status_inside' => 2));
        $this->db->update('orders');
        //prex($this->db->last_query());
    }

    public function paymentError($id)
    {
        $this->db->where(array('id' => $id,'payment_status' => 1,'order_status_inside' => 1));
        $this->db->set(array('payment_status' => 3
                            ,'order_status_inside' => 8));
        $this->db->update('orders');
    }

    public function supplySuccess($cari,$stok)
    {
        $this->db->select('id');
        $this->db->where(array('order_status_inside' => 2
                         ,'payment_status' => 2));
        $q = $this->db->get('orders');
        if ($q->num_rows()>0) {
            $orders = $q->result();
            $a = array();
            foreach ($orders as $key => $val) {
                $a[] = $val->id;
            }
            $orders = $a;

            $this->db->where(array('cari_id' => urldecode($cari)
                              ,'stok_id' => urldecode($stok)
                              ,'status_inside' => 2
                            ));
            $this->db->where_in('order_id',$orders);
            $this->db->set(array('status_inside' => 3));
            $this->db->update('order_line');
            if ($this->db->affected_rows()>0) {
                $this->db->query('Update orders
                                    SET
                                        order_status = 2, order_status_inside = 3
                                    WHERE id IN (
                                        SELECT a.order_id FROM
                                            (SELECT order_id,SUM(count) count FROM order_line WHERE status_inside != 7 GROUP BY order_id) a
                                        INNER JOIN
                                            (SELECT order_id,SUM(count) count FROM order_line WHERE status_inside = 3 GROUP BY order_id) g
                                        ON
                                            a.order_id = g.order_id
                                        WHERE
                                            a.count = g.count
                                    ) AND order_status != 4  AND order_status != 3 ;');
                return true;
            }
        }
        
        return false;
    }

    public function incomingSuccess($cari,$stok)
    {
        $this->db->select('id');

        $this->db->group_start();
            $this->db->or_where('order_status_inside', 2);
            $this->db->or_where('order_status_inside', 3);
        $this->db->group_end();
        $this->db->where(array('payment_status' => 2));
        $q = $this->db->get('orders');
        if ($q->num_rows()>0) {
            $orders = $q->result();
            $a = array();
            foreach ($orders as $key => $val) {
                $a[] = $val->id;
            }
            $orders = $a;

            $this->db->where(array('cari_id' => urldecode($cari)
                              ,'stok_id' => urldecode($stok)
                              ,'status_inside' => 3
                          ));
            $this->db->where_in('order_id',$orders);
            $this->db->set(array('status_inside' => 4));
            $this->db->update('order_line');
            if ($this->db->affected_rows()>0) {
                return true;
            }
        }
        
        return false;
    }

    public function outGoingSuccess($cari,$stok)
    {
        $this->db->select('id');

        $this->db->group_start();
            $this->db->or_where('order_status_inside', 2);
            $this->db->or_where('order_status_inside', 3);
            $this->db->or_where('order_status_inside', 4);
        $this->db->group_end();
        $this->db->where(array('payment_status' => 2));
        $q = $this->db->get('orders');
        if ($q->num_rows()>0) {
            $orders = $q->result();
            $a = array();
            foreach ($orders as $key => $val) {
                $a[] = $val->id;
            }
            $orders = $a;

            $this->db->where(array('cari_id' => urldecode($cari)
                              ,'stok_id' => urldecode($stok)
                              ,'status_inside' => 4
                          ));
            $this->db->where_in('order_id',$orders);
            $this->db->set(array('status_inside' => 5));
            $this->db->update('order_line');
            if ($this->db->affected_rows()>0) {
                $this->db->query('Update orders
                                    SET
                                        order_status_inside = 5
                                    WHERE id IN (
                                        SELECT
                                            a.order_id
                                        FROM
                                            (SELECT order_id,SUM(count) count FROM order_line WHERE status_inside != 7 GROUP BY order_id) a
                                        INNER JOIN
                                            (SELECT order_id,SUM(count) count FROM order_line WHERE status_inside = 5 GROUP BY order_id) g
                                        ON
                                            a.order_id = g.order_id
                                        WHERE
                                            a.count = g.count
                                    ) AND order_status != 4  AND order_status != 3;');
                return true;
            }
        }
        return false;
    }

    public function outGoingError($cari,$stok)
    {
        $this->db->select('id');

        $this->db->group_start();
            $this->db->or_where('order_status_inside', 2);
            $this->db->or_where('order_status_inside', 3);
            $this->db->or_where('order_status_inside', 4);
        $this->db->group_end();
        $this->db->where(array('payment_status' => 2));
        $q = $this->db->get('orders');
        if ($q->num_rows()>0) {
            $orders = $q->result();
            $a = array();
            foreach ($orders as $key => $val) {
                $a[] = $val->id;
            }
            $orders = $a;

            $this->db->where(array('cari_id' => urldecode($cari)
                              ,'stok_id' => urldecode($stok)
                              ,'status_inside' => 4
                          ));
            $this->db->where_in('order_id',$orders);
            $this->db->set(array('status_inside' => 8));
            $this->db->update('order_line');
            if ($this->db->affected_rows()>0) {
                return true;
            }
        }
        return false;
    }

    public function incomingError($cari,$stok)
    {
        $this->db->select('id');

        $this->db->group_start();
            $this->db->or_where('order_status_inside', 2);
            $this->db->or_where('order_status_inside', 3);
        $this->db->group_end();
        $this->db->where(array('payment_status' => 2));
        $q = $this->db->get('orders');
        if ($q->num_rows()>0) {
            $orders = $q->result();
            $a = array();
            foreach ($orders as $key => $val) {
                $a[] = $val->id;
            }
            $orders = $a;

            $this->db->where(array('cari_id' => urldecode($cari)
                              ,'stok_id' => urldecode($stok)
                              ,'status_inside' => 3
                          ));
            $this->db->where_in('order_id',$orders);
            $this->db->set(array('status_inside' => 8));
            $this->db->update('order_line');
            if ($this->db->affected_rows()>0) {
                return true;
            }
        }
        
        return false;
    }
    
    public function supplyError($cari,$stok)
    {
        $this->db->select('id');
        $this->db->where(array('order_status_inside' => 2
                              ,'payment_status' => 2));
        $q = $this->db->get('orders');
        if ($q->num_rows()>0) {
            $orders = $q->result();
            $a = array();
            foreach ($orders as $key => $val) {
                $a[] = $val->id;
            }
            $orders = $a;

            $this->db->where(
                array('cari_id' => urldecode($cari)
                      ,'stok_id' => urldecode($stok)
                      ,'status_inside' => 2
                )
            );
            $this->db->where_in('order_id',$orders);
            $this->db->set(array('status_inside' => 8));
            $this->db->update('order_line');
            if ($this->db->affected_rows()>0) {
                return true;
            }
        }
        return false;
    }

    public function getPreparingOrders()
    {

        $this->db->select('u.id user_id,o.id order_id,u.name,u.surname,u.phone,u.email');
        $this->db->where(array('o.order_status' => 2, 'o.notification' => 0));
        $this->db->from('orders o');
        $this->db->join('users u','u.id=o.user_id');
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            return $q->result();
        }else{
            return array();
        }
    }

    public function getCargoOrders()
    {  
        $this->db->select('u.id user_id,o.id order_id,u.name,u.surname,u.phone,u.email
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
        $this->db->where(array('o.order_status' => 3));
        $this->db->where('o.notification <',2);
        $this->db->from('orders o');
        $this->db->join('users u','u.id=o.user_id');
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            $data = $q->result();
            foreach ($data as $key => $val) {
                $this->db->select('url,stok_id,name,price,count,kod3');
                $this->db->where('order_id',$val->order_id);
                $this->db->where('status_inside <',7);
                $q = $this->db->get('order_line');
                if ($q->num_rows()>0) {
                    $data[$key]->products = $q->result();
                }else{
                    $data[$key]->products = array();
                }
            }

            return $data;
        }else{
            return array();
        }
    }

    public function getCancelOrders()
    {
        $this->db->select('u.id user_id,o.id order_id,u.name,u.surname,u.phone,u.email
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
        $this->db->where(array('o.order_status' => 4));
        $this->db->where('o.notification <>',5);
        $this->db->from('orders o');
        $this->db->join('users u','u.id=o.user_id');
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            $data = $q->result();
            foreach ($data as $key => $val) {
                $this->db->select('url,stok_id,name,price,count,kod3');
                $this->db->where('order_id',$val->order_id);
                $q = $this->db->get('order_line');
                if ($q->num_rows()>0) {
                    $data[$key]->products = $q->result();
                }else{
                    $data[$key]->products = array();
                }
            }

            return $data;
        }else{
            return array();
        }
    }

    public function sendedNotification($order_id,$type)
    {
        $this->db->where(array('id' => $order_id));
        $this->db->set(array('notification' => $type));
        $this->db->update('orders');
    }
}
?>