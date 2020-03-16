<?
class Contracted_services_model extends Core_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function addServices($postData)
	{
		return $this->db->insert('contracted_services',$postData);
	}

	public function getServices()
	{
		$this->db->from('contracted_services');
		$this->db->where(array('deleted'=>0));
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows()> 0) {
			return $returnQuery->result();
		} else {
			return array();
		}
	}

	public function setStatus($id,$status)
	{
		return $this->db->set(array('status'=>$status))->where(array('id'=>$id))->update('contracted_services');
	}

	public function delete($id)
	{
		return $this->db->set(array('deleted'=>1))->where(array('id'=>$id))->update('contracted_services');
	}

	public function getServicesById($id)
	{
		$this->db->from('contracted_services');
		$this->db->where(array('id'=>$id));
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->row();
		} else {
			return array();
		}
	}

	public function updateServices($postData,$id)
	{
		return $this->db->set($postData)->where(array('id'=>$id))->update('contracted_services');
	}
}
