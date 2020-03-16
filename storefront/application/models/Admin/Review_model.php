<?defined('BASEPATH') OR exit('No direct script access allowed');

class Review_model extends Core_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function getModalReview()
	{
		$this->db->select('g.*,u.id users_id,u.name,u.surname,u.email,u.deleted users_deleted');
		$this->db->from('general_evaluation g');
		$this->db->join('users u','g.user_id = u.id');
		$this->db->where(array('g.deleted'=>0,'u.deleted'=>0));
		$this->db->order_by('g.id','DESC');
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->result();
		} else {
			return array();
		}
	}

}