<?php
/**
* 
*/
class Kargo_model extends Core_Model
{
	function __construct()
	{
		parent::__construct();
	}


	public function getPrice()
	{
		return $this->db->get_where('cargo',array('id' => 1))->row();
	}

	public function update($data)
	{
		$this->db->set($data);
		$this->db->where('id',1);
		return $this->db->update('cargo');
	}
}
?>