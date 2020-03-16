<?defined('BASEPATH') OR exit('No direct script access allowed');

class Transfer_model extends Core_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function getIbanInformation()
	{
		$this->db->select('i.*,u.name,u.surname,u.id users_id,u.deleted users_deleted');
		$this->db->from('iban_list i');
		$this->db->join('users u','i.user_id = u.id');
		$this->db->where(array('u.deleted'=>0,'i.deleted'=>0));
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->result();
		} else {
			return array();
		}
	}

	public function deleteIban($id)
	{
		return $this->db->set(array('deleted'=>1))->where(array('id'=>$id))->update('iban_list');
	}

	public function getTransferInformation()
	{
		$this->db->select('r.*,u.name,u.surname,u.id users_id,u.deleted users_deleted');
		$this->db->from('remittance_payment_notice r');
		$this->db->join('users u','r.user_id = u.id');
		$this->db->where(array('u.deleted'=>0,'r.deleted'=>0));
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->result();
		} else {
			return array();
		}
	}

	public function SetStatusTransfer($id,$new)
	{
		return $this->db->set(array('status'=>$new))->where(array('id'=>$id))->update('remittance_payment_notice');
	}

	public function deleteTransfer($id)
	{
		return $this->db->set(array('deleted'=>1))->where(array('id'=>$id))->update('remittance_payment_notice');
	}

}