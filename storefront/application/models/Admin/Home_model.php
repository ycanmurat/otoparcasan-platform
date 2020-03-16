<?defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends Core_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function getUserPermission()
	{
		$this->db->select('name, email, phone, added_time, email_permission, deleted');
		$this->db->from('users');
		$this->db->where(array('deleted' => 0));
		$this->db->limit(10);
		$this->db->order_by('Id','DESC');
		$getUserInfo = $this->db->get();
		if ($getUserInfo->num_rows()>0) {
			return $getUserInfo->result();
		} else {
			return array();
		}
	}

	public function getUsers()
	{
		$this->db->select('Id');
		$this->db->from('users');
		$this->db->where(array('email_permission' => 1, 'deleted' => 0));
		$getQuery = $this->db->get();
		return $getQuery->num_rows();
	}

	public function getAllOrders()
	{
		$this->db->select('Id');
		$this->db->from('orders');
		$getQuery = $this->db->get();
		return $getQuery->num_rows();
	}

	public function getOrders()
	{
		$this->db->select('o.id, o.added_time, (select sum(price) from order_line where order_id = o.id) as totapPrice');
		$this->db->from('orders o');
		$this->db->order_by('id','DESC');
		$this->db->limit(5);
		$getOrdersInfo = $this->db->get();
		if ($getOrdersInfo->num_rows()>0) 
		{
			return $getOrdersInfo->result();
		}
		else
		{
			return false;
		}
	}

	public function getWaitOrders()
	{
		$this->db->select('order_status');
		$this->db->from('orders');
		$this->db->where(array('order_status' => 2));
		$getQuery = $this->db->get();
		return $getQuery->result();
	}

	public function getAllCampaings()
	{
		$this->db->select('Id,campaign_title,campaign_start,campaign_end,campaign_info,campaign_picture');
		$this->db->from('campaigns');
		$this->db->where(array('status' => 1, 'deleted' => 0));
		$this->db->limit(4);
		$this->db->order_by('Id','DESC');
		$getUserInfo = $this->db->get();
		if ($getUserInfo->num_rows()>0) 
		{
			return $getUserInfo->result();
		}
		else
		{
			return false;
		}
	}

	public function getPriceAll()
	{
		//$this->db->select('SUM(ol.price)-(SELECT SUM(discount_price) FROM orders WHERE order_status != 3 AND order_status != 2 AND order_status != 1) as totalprice');
		$this->db->select('SUM(ol.price)-(SELECT SUM(discount_price) FROM orders WHERE order_status != 3 AND order_status != 2 AND order_status != 1) as Allprice');
		$this->db->from('orders o');
		$this->db->join('order_line ol','ol.order_id = o.id');
		//$this->db->join('order_line ol ON ol.order_id = o.id');
		$this->db->where('o.order_status != 3');
		$this->db->where('o.order_status != 2');
		$this->db->where('o.order_status != 1');
		$getQuery = $this->db->get();
		//return $getQuery->row;
		return $getQuery->row();
		/*SELECT SUM(ol.price)-(SELECT sum(discount_price) from orders 
			WHERE order_status != 3 AND order_status != 2 AND order_status != 1) as totalprice 
		From orders o INNER JOIN order_line ol ON ol.order_id = o.id 
			WHERE o.order_status != 3 AND o.order_status != 2 AND o.order_status != 1

			$this->db->select('(SELECT SUM(payments.amount) FROM payments WHERE payments.invoice_id=4) AS amount_paid', FALSE);*/
	}

	public function getContactInfo()
	{
		$this->db->select('*');
		$this->db->from('contact');
		$this->db->where(array('deleted'=>0));
		$this->db->limit(10);
		$this->db->order_by('Id','DESC');
		$getQuery = $this->db->get();
		if($getQuery->num_rows()>0){
			return $getQuery->result();
		}else{
			return false;
		}
	}
	
	public function getOfferInfo(){
		$this->db->select('offer_status,deleted');
		$this->db->from('offer');
		$this->db->where(array('offer_status' => 0,'deleted'=>0));
		$getQuery = $this->db->get();
		return $getQuery->num_rows();
	}
}