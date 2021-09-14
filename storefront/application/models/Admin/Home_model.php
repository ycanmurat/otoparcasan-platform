<?defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends Core_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function bulk_part_offer()
	{
		$this->db->where(['seen' => 0]);
		return $this->db->count_all_results('offer_form');
	}

	public function web_site_reviews()
	{
		$this->db->where(['seen' => 0]);
		return $this->db->count_all_results('reviews');
	}

	public function product_questions()
	{
		$this->db->where(['seen' => 0]);
		return $this->db->count_all_results('questions');
	}

	public function questions_comments()
	{
		$this->db->where(['seen' => 0]);
		return $this->db->count_all_results('comments');
	}

	public function get_last_users()
	{
		$this->db->select('u.id, CONCAT(u.name, " ",u.surname) as name, u.gender, u.deleted, u.added_time, lc.CityID, lc.CityName, lco.CountyID, lco.CountyName');
		$this->db->from('users u');
		$this->db->join('location_cities lc', 'u.city = lc.CityID', 'left');
		$this->db->join('location_counties lco', 'u.town = lco.CountyID', 'left');
		$this->db->where(['u.deleted' => 0]);
		$this->db->order_by('u.id', 'DESC');
		$this->db->limit(100);
		$return_query = $this->db->get();
		if ($return_query->num_rows() > 0) {
			return $return_query->result();
		} else {
			return [];
		}
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

	public function get_mounth_of_users()
	{
		$this->db->where('month(added_time)', date('m'));
		return $this->db->count_all_results('users');
	}

	public function get_week_of_users()
	{
		$query = $this->db->query("SELECT added_time FROM users WHERE added_time > DATE_SUB(NOW(), INTERVAL 1 WEEK)");
		$result = $query->result();
		return count($result);
	}

	public function get_day_of_users()
	{
		$query = $this->db->query("SELECT added_time FROM users WHERE added_time > DATE_SUB(NOW(), INTERVAL 1 DAY)");
		$result = $query->result();
		return count($result);
	}

	public function getStar()
	{
		$this->db->select_avg('star');
		$result = $this->db->get('reviews')->row();  
		return $result;
	}

	public function getCountReviews()
	{
		$this->db->select('id');
		$this->db->from('reviews');
		$returnQuery = $this->db->get();
		return $returnQuery->num_rows();
	}
}