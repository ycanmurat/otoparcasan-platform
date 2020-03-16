<?

class Agac_Model extends Core_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function addEditData($data)
	{
		//$this->db->order_by('id','DESC');
		$this->db->insert('datList',$data);
		return true;
	}

	public function get($data,$key = 0)
	{
		//prex($data);
		if ($key == 0) {
			return false;
		}

		$this->db->select('list');
		$this->db->where((array)$data);
		$this->db->order_by('id','DESC');
		$q = $this->db->get('datList');
		if ($q->num_rows()>0) {
			$q = $q->row();
			$q = json_decode($q->list);
			return $q;
		}else{
			return false;
		}
	}

	public function getCarImagesByBrand($type,$brand)
	{
		/*
		pre($type);
		prex($brand);
		*/
		$sql = 'SELECT * FROM datCarImage WHERE id IN(SELECT MAX(id) FROM datCarImage WHERE brand = '.$this->db->escape($brand).' AND type = '.$this->db->escape($type).' GROUP BY model)';
		$q = $this->db->query($sql);
		if ($q->num_rows()>0) {
			return $q->result();
		}else{
			return array();
		}
	}

	public function addImage($data)
	{
		$this->db->set($data);
		return $this->db->insert('datCarImage');
	}
}
