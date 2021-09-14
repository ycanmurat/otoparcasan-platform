<?php 
/**
* 
*/
class Indirim_model extends Core_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function gegtGifts()
	{
		$this->db->where('deleted',0);
		$q = $this->db->get('indirim');
		if ($q->num_rows() > 0) {
			return $q->result();
		}
		return array();
	}

	public function getCurrencyById($id)
	{
		$this->db->select('code');
		$this->db->where(array('id' => $id));
		return $this->db->get('currency')->row()->code;
	}

	public function getCurrencyAll()
	{	
		$this->db->select('id, code');
		$this->db->where(array('status' => 1));
		return $this->db->get('currency')->result();
	}

	public function SetStatus($id,$status)
	{
		$this->db->where('id',$id);
		$this->db->set('status',$status);
		$this->db->update('indirim');
		return true;
	}

	public function delete($id)
	{
		$this->db->where('id',$id);
		$this->db->set('deleted',1);
		$this->db->update('indirim');

		if ($this->db->affected_rows()>0) {
			return true;
		}
		else{
			return false;
		}
	}

	public function indirimAdd($data)
	{
		$this->db->set($data);
		$this->db->insert('indirim');
		$q = $this->db->insert_id();

		if ($q>0) {
			return true;
		}
		else{
			return false;
		}
	}

}
?>