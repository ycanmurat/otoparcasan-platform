<?php
/**
 * 
 */
class Product_model extends Core_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function getKod3Detail($id)
	{
		$this->db->select('content');
		$this->db->where('category_id',$id);
		$q = $this->db->get('category_information');
		if ($q->num_rows()>0) {
			return $q->row()->content;
		}else{
			return '';
		}
	}

	public function getComments($url)
	{
		$this->db->select('c.*, u.id u_id, u.name, u.surname, CONCAT(u.name, " ", u.surname) AS name_surname', FALSE);
		$this->db->from('comments c');
		$this->db->join('users u', 'c.user_id = u.id');
		$this->db->where(['c.deleted' => 0, 'c.slug' => $url, 'c.status' => 1]);
		$this->db->order_by('c.id', 'DESC');
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->result();
		} else {
			return [];
		}
	}

	public function getQuestions($slug)
	{
		$this->db->select('q.*, u.id u_id, u.name, u.surname, CONCAT(u.name, " ", u.surname) AS name_surname', FALSE);
		$this->db->from('questions q');
		$this->db->join('users u', 'q.user_id = u.id');
		$this->db->where(['q.deleted' => 0, 'q.slug' => $slug, 'q.status' => 1]);
		$this->db->order_by('q.id', 'DESC');
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->result();
		} else {
			return [];
		}
	}

	public function getAnswers($slug)
	{
		$this->db->from('answers');
		$this->db->where(['slug' => $slug]);
		$this->db->order_by('id','DESC');
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows()>0) {
			return $returnQuery->result();
		}else{
			return [];
		}
	}

    public function isFavorite($product,$user_id)
    {
        $this->db->where(array('product_slug' => $product
                              ,'user_id' => $user_id));
        return $this->db->count_all_results('user_favorite')>0;
    }

    public function isReminding($product,$user_id)
    {
        $this->db->where(array('product_slug' => $product
                              ,'user_id' => $user_id));
        return $this->db->count_all_results('user_reminding')>0;
    }

    public function getFaqs()
    {
        $this->db->from('faq');
        $this->db->where(array('status'=>1,'deleted'=>0));
        $this->db->order_by('sort','ASC');
        $returnQuery = $this->db->get();
        if ($returnQuery->num_rows() > 0) {
            return $returnQuery->result();
        } else {
            return array();
        }
    }

}
?>