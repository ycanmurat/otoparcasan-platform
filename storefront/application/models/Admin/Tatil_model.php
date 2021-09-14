<?

class Tatil_model extends Core_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function getBreakDays()
	{
		$q = $this->db->get('break_days');
		if ($q->num_rows()>0) {
			return $q->result();
		}else{
			return array();
		}
	}

	public function add($data)
	{
		$this->db->set($data);
		$this->db->insert('break_days');
		return true;
	}

	public function deleted($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('break_days');
		return true;
	}

}
