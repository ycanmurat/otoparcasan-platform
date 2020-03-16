<?
class Help_model extends Core_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function addHelp($getAllPosts)
	{
		return $this->db->insert('help',$getAllPosts);
	}

	public function getHelpList()
	{
		$this->db->from('help');
		$this->db->where(array('deleted'=>0));
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->result();
		} else {
			return array();
		}
	}

	public function SetStatus($id,$new)
	{
		return $this->db->set(array('status'=>$new))->where(array('id'=>$id))->update('help');
	}

	public function delete($id)
	{
		return $this->db->set(array('deleted'=>1))->where(array('id'=>$id))->update('help');
	}

	public function sort($sort)
	{
		foreach ($sort as $key => $val) 
		{
			$this->db->where(array('id' => $key));
			$this->db->set(array('sort' => $val));
			$this->db->update('help');
		}
		return true;
	}

	public function getHelpById($id)
	{
		$this->db->from('help');
		$this->db->where(array('id'=>$id));
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->row();
		} else {
			return array();
		}
	}

	public function updateHelp($getAllPosts,$id)
	{
		return $this->db->set($getAllPosts)->where(array('id'=>$id))->update('help');
	}
}
