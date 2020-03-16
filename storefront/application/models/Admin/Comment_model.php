<?defined('BASEPATH') OR exit('No direct script access allowed');

class Comment_model extends Core_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function getReviews()
	{
		$this->db->select('r.id review_id,r.user_id,r.message,r.star,r.status,r.seen,r.added_time,u.id user_id,u.name,u.surname');
		$this->db->from('reviews r');
		$this->db->join('users u','r.user_id = u.id');
		$this->db->where('r.message is NOT NULL', NULL, FALSE);
		$this->db->order_by('r.id','DESC');
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->result();
		} else {
			return array();
		}
	}

	public function deleteComment($id)
	{
		return $this->db->delete('reviews',array('id'=>$id));
	}

	public function getReviewsById($id)
	{
		$this->db->select('id,message');
		$this->db->from('reviews');
		$this->db->where(array('id'=>$id));
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->row();
		} else {
			return array();
		}
	}

	public function addComment($getAllPosts)
	{
		return $this->db->insert('reply',$getAllPosts);
	}

	public function clearComment($id)
	{
		return $this->db->delete('reply',array('review_id'=>$id));
	}

	public function SetStatus($id,$new)
	{
		return $this->db->set(array('status'=>$new))->where(array('id'=>$id))->update('reviews');
	}

	public function seenStatus($id,$seen)
	{
		return $this->db->set(array('seen'=>$seen))->where(array('id'=>$id))->update('reviews');
	}

	public function getQuickReply()
	{
		$this->db->from('quick_reply');
		$this->db->where(array('deleted'=>0));
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->result();
		} else {
			return array();
		}
	}

	public function addReply($dataPost)
	{
		return $this->db->insert('quick_reply',$dataPost);
	}

	public function deleteReply($id)
	{
		return $this->db->set(array('deleted'=>1))->where(array('id'=>$id))->update('quick_reply');
	}

	public function SetStatusReply($id,$new)
	{
		return $this->db->set(array('status'=>$new))->where(array('id'=>$id))->update('quick_reply');
	}

	public function getReplyById($id)
	{
		$this->db->from('quick_reply');
		$this->db->where(array('id'=>$id));
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->row();
		} else {
			return array();
		}
	}

	public function updateReply($dataPost,$id)
	{
		return $this->db->set($dataPost)->where(array('id'=>$id))->update('quick_reply');
	}

	public function getReplys()
	{
		$this->db->from('quick_reply');
		$this->db->where(array('deleted'=>0,'status'=>1));
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->result();
		} else {
			return array();
		}
	}
}