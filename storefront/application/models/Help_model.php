<?defined('BASEPATH') OR exit('No direct script access allowed');

class Help_model extends Core_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function getAllHelps()
	{
		$this->db->from('help');
		$this->db->where(array('deleted'=>0,'status'=>1));
		$this->db->order_by('sort','ASC');
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->result();
		} else {
			return array();
		}
	}

	public function getMinumumIdByContent()
	{
		$this->db->from('help');
		$this->db->where(array('deleted'=>0,'status'=>1));
		$this->db->select_min('id');
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			$returnGetContent = $returnQuery->row();
			$this->db->from('help');
			$this->db->where(array('deleted'=>0,'status'=>1,'id'=>$returnGetContent->id));
			$returnContent = $this->db->get();
			if ($returnContent->num_rows() > 0) {
				return $returnContent->row();
			} else {
				return array();
			}
		} else {
			return array();
		}
	}

	public function getSlugByContent($slug)
	{
		$this->db->from('help');
		$this->db->where(array('deleted'=>0,'status'=>1,'slug'=>$slug));
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->row();
		} else {
			return false;
		}
	}
}