<?defined('BASEPATH') OR exit('No direct script access allowed');

class Reviews_model extends Core_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function product_quality_like()
	{
		$this->db->select('product_quality');
		$this->db->from('reviews');
		$this->db->where(array('product_quality'=>1));
		$returnQuery = $this->db->get();
		return $returnQuery->num_rows();
	}

	public function product_quality_dislike()
	{
		$this->db->select('product_quality');
		$this->db->from('reviews');
		$this->db->where(array('product_quality'=>0));
		$returnQuery = $this->db->get();
		return $returnQuery->num_rows();
	}

	public function ease_of_use_like()
	{
		$this->db->select('ease_of_use');
		$this->db->from('reviews');
		$this->db->where(array('ease_of_use'=>1));
		$returnQuery = $this->db->get();
		return $returnQuery->num_rows();
	}

	public function ease_of_use_dislike()
	{
		$this->db->select('ease_of_use');
		$this->db->from('reviews');
		$this->db->where(array('ease_of_use'=>0));
		$returnQuery = $this->db->get();
		return $returnQuery->num_rows();
	}

	public function fast_shipping_like()
	{
		$this->db->select('fast_shipping');
		$this->db->from('reviews');
		$this->db->where(array('fast_shipping'=>1));
		$returnQuery = $this->db->get();
		return $returnQuery->num_rows();
	}

	public function fast_shipping_dislike()
	{
		$this->db->select('fast_shipping');
		$this->db->from('reviews');
		$this->db->where(array('fast_shipping'=>0));
		$returnQuery = $this->db->get();
		return $returnQuery->num_rows();
	}

	public function product_packaging_like()
	{
		$this->db->select('product_packaging');
		$this->db->from('reviews');
		$this->db->where(array('product_packaging'=>1));
		$returnQuery = $this->db->get();
		return $returnQuery->num_rows();
	}

	public function product_packaging_dislike()
	{
		$this->db->select('product_packaging');
		$this->db->from('reviews');
		$this->db->where(array('product_packaging'=>0));
		$returnQuery = $this->db->get();
		return $returnQuery->num_rows();
	}

	public function price_range_like()
	{
		$this->db->select('price_range');
		$this->db->from('reviews');
		$this->db->where(array('price_range'=>1));
		$returnQuery = $this->db->get();
		return $returnQuery->num_rows();
	}

	public function price_range_dislike()
	{
		$this->db->select('price_range');
		$this->db->from('reviews');
		$this->db->where(array('price_range'=>0));
		$returnQuery = $this->db->get();
		return $returnQuery->num_rows();
	}

	public function getCommentsAndReviews()
	{
		$this->db->select('r.id,r.user_id,r.star,r.message,r.added_time comment_time,r.status,rp.id reply_id,rp.review_id,rp.answer,rp.added_time replay_time,u.id user_id,u.name,u.surname,u.deleted');
		$this->db->from('reviews r');
		$this->db->join('reply rp','r.id = rp.review_id','left');
		$this->db->join('users u','r.user_id = u.id');
		$this->db->where(array('u.deleted'=>0,'r.status'=>1));
		$this->db->order_by('r.id','DESC');
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->result();
		} else {
			return false;
		}
	}

	public function getReviewsInformation()
	{
		$userInfo = $this->session->userdata('userInfo');
		if (!empty($userInfo)) {
			$this->db->from('reviews');
			$this->db->where(array('user_id'=>$userInfo->id));
			$returnQuery = $this->db->get();
			if ($returnQuery->num_rows() > 0) {
				return $returnQuery->row();
			} else {
				return array();
			}	
		}
	}
}