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

	public function getAllComments()
	{
		$this->db->select('c.*, u.id u_id, u.name, u.surname, CONCAT(u.name, " ", u.surname) AS name_surname', FALSE);
		$this->db->from('comments c');
		$this->db->join('users u', 'c.user_id = u.id');
		$this->db->where(['c.deleted' => 0]);
		$this->db->order_by('c.id', 'DESC');
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->result();
		} else {
			return [];
		}
	}

	public function CommentseenStatus($id,$seen)
	{
		return $this->db->set(array('seen'=>$seen))->where(array('id'=>$id))->update('comments');
	}

	public function CommentSetStatus($id,$new)
	{
		return $this->db->set(array('status'=>$new))->where(array('id'=>$id))->update('comments');
	}

	public function commentDelete($id)
	{
		return $this->db->set(array('deleted'=>1))->where(array('id'=>$id))->update('comments');
	}

	public function getQuestions()
	{
		$this->db->select('q.*, u.id u_id, u.name, u.surname, CONCAT(u.name, " ", u.surname) AS name_surname', FALSE);
		$this->db->from('questions q');
		$this->db->join('users u', 'q.user_id = u.id');
		$this->db->where(['q.deleted' => 0]);
		$this->db->order_by('q.id', 'DESC');
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->result();
		} else {
			return [];
		}
	}

	public function SetQuestionStatus($id,$new)
	{
		return $this->db->set(array('status'=>$new))->where(array('id'=>$id))->update('questions');
	}

	public function seenStatusQuestion($id,$seen)
	{
		return $this->db->set(array('seen'=>$seen))->where(array('id'=>$id))->update('questions');
	}

	public function deleteQuestion($id)
	{
		return $this->db->set(array('deleted'=>1))->where(array('id'=>$id))->update('questions');
	}

	public function getIdByQuestion($id)
	{
		$this->db->select('q.*, u.id u_id, u.name, u.surname, CONCAT (u.name, " ", u.surname) as name_surname', FALSE);
		$this->db->from('questions q');
		$this->db->join('users u', 'q.user_id = u.id');
		$this->db->where(['q.id' => $id]);
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->row();
		} else {
			return [];
		}
	}

	public function addAnswer($dataPost)
	{
		return $this->db->insert('answers', $dataPost);
	}

	public function getIdByAnswers($id)
	{
		$this->db->from('answers');
		$this->db->where(['question_id' => $id]);
		$this->db->order_by('id','ASC');
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->result();
		} else {
			return [];
		}
	}

	public function deleteAnswer($id)
	{
		return $this->db->delete('answers', array('id' => $id));
	}

	public function addQuestion($name)
	{
		$this->db->set(['name' => $name])->insert('product_question_category');
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function getProductQuestionList()
	{
		$this->db->from('product_question_category');
		$this->db->where(['deleted' => 0]);
		$this->db->order_by('id','DESC');
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->result();
		} else {
			return [];
		}
	}

	public function getProductQuestionCategoryName($id)
	{
		$this->db->from('product_question_category');
		$this->db->where(['id' => $id]);
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->row();
		} else {
			return [];
		}
	}

	public function updateQuestion($name, $id)
	{
		$this->db->set(['name' => $name])->where(['id' => $id])->update('product_question_category');
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function deleteProductQuestionCategory($id)
	{
		$this->db->set(['deleted' => 1])->where(['id' => $id])->update('product_question_category');
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function editProductQuestionStatus($id, $new_status)
	{
		$this->db->set(['status' => $new_status])->where(['id' => $id])->update('product_question_category');
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function readyTemplateAdd($template)
	{
		$this->db->set(['template' => $template])->insert('product_question_ready_template');
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function productQuestionReadyTemplateList()
	{
		$this->db->from('product_question_ready_template');
		$this->db->where(['deleted' => 0]);
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->result();
		} else {
			return [];
		}
	}

	public function editproductQuestionReadyTemplate($id)
	{
		$this->db->from('product_question_ready_template');
		$this->db->where(['id' => $id]);
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->row();
		} else {
			return [];
		}
	}

	public function updateReadyTemplate($template, $id)
	{
		$this->db->set(['template' => $template])->where(['id' => $id])->update('product_question_ready_template');
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function deleteproductQuestionReadyTemplate($id)
	{
		$this->db->set(['deleted' => 1])->where(['id' => $id])->update('product_question_ready_template');
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function editProductReadyTemplateStatus($id, $new_status)
	{
		$this->db->set(['status' => $new_status])->where(['id' => $id])->update('product_question_ready_template');
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
}