<?php 
class Discount_model extends Core_Model
{
	function __construct()
	{
		parent::__construct();
	}
	public function productInfo()
	{
		$this->db->select('p.Id, p.status, p.deleted, pl.product_name, pl.product_id');
		$this->db->from('product p');
		$this->db->join('product_lang pl', 'p.Id = pl.product_id');
		$this->db->where(array('p.status' => 1, 'p.deleted' => 0, 'pl.lang_id' => 1));
		$list_query = $this->db->get();
		if ($list_query->num_rows() > 0)
		{
			return $list_query->result();
		}	
		else
		{
			return false;
		}
	}
	public function discountAddQuery($discountInfo)
	{
		$this->db->set($discountInfo);
		if ($this->db->insert('discount_product')) 
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function discountList()
	{
		$list_query = $this->db->get('discount_product');
		if ($list_query->num_rows() > 0) 
		{
			return $list_query->result();
		}
		else
		{
			return false;
		}
	}
	public function discountDelete($Id)
	{
		$delete_query = $this->db->delete('discount_product', array('Id'=> $Id));
		if ($delete_query == true) 
		{
			return true;
		}
		else
		{
			return false;
		}
	}

}
?>