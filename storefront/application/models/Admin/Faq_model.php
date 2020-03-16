<?if(!defined('BASEPATH'))exit('No direct script access allowed');

class Faq_model extends Core_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function insertQuestion($getAllPosts)
	{
		if ($this->db->insert('faq',$getAllPosts)) {
			return true;
		}else{
			return false;
		}
	}

	public function getFaq()
	{
		$this->db->select('*');
		$this->db->from('faq');
		$this->db->where(array('deleted'=>0));
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows()>0) {
			return $returnQuery->result();
		}else{
			return false;
		}
	}

	public function faqStatusUpdate($id,$newInfo)
	{
		return $this->db->set('status',$newInfo)->where(array('id'=>$id))->update('faq');
	}

	public function deleteFaq($id)
	{
		return $this->db->set(array('deleted'=>1))->where(array('id'=>$id))->update('faq');
	}

	public function SetSort($sort)
	{
		foreach ($sort as $key => $val) {
			$this->db->where(array('id' => $key));
			$this->db->set(array('sort' => $val));
			$this->db->update('faq');
			}
		return true;
	}

	public function getQuery($id)
	{
		$this->db->select('*');
		$this->db->from('faq');
		$this->db->where(array('id'=>$id));
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows()>0) {
			return $returnQuery->row();
		}else{
			return false;
		}
	}

	public function updateQuestion($id,$getAllPosts){
		return $this->db->set($getAllPosts)->where(array('id'=>$id))->update('faq');
	}
}
?>