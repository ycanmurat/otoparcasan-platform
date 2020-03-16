<?defined('BASEPATH') OR exit('No direct script access allowed');

	class Home_model extends Core_Model
	{
		function __construct()
		{
			parent::__construct();
		}

		public function getSlider()
		{
			$this->db->select('*');
			$this->db->from('slider');
			$this->db->where(array('status'=>1,'deleted'=>0));
			$this->db->order_by('sort','ASC');
			$returnQuery = $this->db->get();
			if ($returnQuery->num_rows()>0) {
				return $returnQuery->result();
			} else {
				return array();
			}
		}

		public function getMobileSlider()
		{
			$this->db->select('*');
			$this->db->from('slider_image');
			$this->db->where(array('status'=>1,'deleted'=>0));
			$this->db->order_by('sort','ASC');
			$returnQuery = $this->db->get();
			if ($returnQuery->num_rows()>0) {
				return $returnQuery->result();
			} else {
				return array();
			}
		}

		public function getVerySellers()
		{
			$this->db->from('very_sellers');
			$this->db->where(array('deleted'=>0,'status'=>1));
			$this->db->order_by('sort','ASC');
			$returnQuery = $this->db->get();
			if ($returnQuery->num_rows() > 0) {
				return $returnQuery->result();
			} else {
				return array();
			}
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
				return array();
			}
		}

		public function getCorporateVideoAndInformation()
		{
			$this->db->from('home_video');
			$this->db->where(array('id'=>1));
			$returnQuery = $this->db->get();
			if ($returnQuery->num_rows() > 0) {
				return $returnQuery->row();
			} else {
				return array();
			}
		}

		public function getCarBrands()
		{
			$this->db->from('brands');
			$this->db->where(array('status'=>1,'deleted'=>0,'category'=>1));
			$this->db->order_by('sort','ASC');
			$returnQuery = $this->db->get();
			if ($returnQuery->num_rows() > 0) {
				return $returnQuery->result();
			} else {
				return array();
			}
		}

		public function getPieceBrands()
		{
			$this->db->from('brands');
			$this->db->where(array('status'=>1,'deleted'=>0,'category'=>2));
			$this->db->order_by('sort','ASC');
			$returnQuery = $this->db->get();
			if ($returnQuery->num_rows() > 0) {
				return $returnQuery->result();
			} else {
				return array();
			}
		}

		public function getContent()
		{
			$this->db->from('home_content');
			$this->db->where(array('id'=>1));
			$returnQuery = $this->db->get();
			if ($returnQuery->num_rows() > 0) {
				return $returnQuery->row();
			} else {
				return array();
			}
		}
		
		public function getOtoparcasan()
		{
			$this->db->from('content_otoparcasan');
			$this->db->where(array('id'=>1));
			$returnQuery = $this->db->get();
			if ($returnQuery->num_rows() > 0) {
				return $returnQuery->row();
			} else {
				return array();
			}
		}
	}
?>