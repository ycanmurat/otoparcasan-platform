<?php 
/**
* 
*/
class Language_model extends Core_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function addLang($data)
	{
		$this->db->set($data);
		if ($this->db->insert('language')) {
			return true;
		}
		else{
			return false;
		}
	}

	public function GetLangById($lang_id)
	{
		$this->db->where('id',$lang_id);
		$this->db->where('deleted',0);
		$q = $this->db->get('language');
		if ($q->num_rows()>0) {
			return $q->row();
		}
		else{
			return false;
		}
	}

	public function GetLangList()
	{
		$this->db->where('deleted',0);
		$q = $this->db->get('language');
		if ($q->num_rows()>0) {
			return $q->result();
		}
		else{
			return false;
		}
	}

	public function GetLangListShortId()
	{
		$this->db->select('id,lang_name,short_code');
		$this->db->where('deleted',0);
		$this->db->where('status',1);
		$q = $this->db->get('language');
		if ($q->num_rows()>0) {
			return $q->result();
		}
		else{
			return false;
		}
	}

	public function Update($data,$lang_id)
	{
		
		$this->db->where('deleted',0);
		$this->db->where('id',$lang_id);
		$this->db->set($data);

		$q = $this->db->update('language');
		if ($this->db->affected_rows()>0) {
			return true;
		}
		else{
			return false;
		}
	}

	public function SetStatusById($id,$new)
	{
		$this->db->where('deleted',0);
		$this->db->where('id',$id);
		$this->db->set('status',$new);
		$this->db->update('language');
		return true;
	}

	public function GetStaticsById($lang_id)
	{
		$this->db->select('lang_json');
		$this->db->where('deleted',0);
		$this->db->where('id',$lang_id);
		$q = $this->db->get('language');
		if ($q->num_rows()>0) {
			return $q->row()->lang_json;
		}
		else{
			return false;
		}
	}

	public function delete($id)
	{
		
		$this->db->where('id',$id);
		$this->db->set('deleted',1);
		$this->db->update('language');
		if ($this->db->affected_rows()>0) {
			return true;
		}
		else{
			return false;
		}
	}

	public function GetLangNameById($id)
	{
		$this->db->where('id',$id);
		$this->db->where('deleted',0);
		$this->db->select('lang_name');
		$q = $this->db->get('language');
		if ($q->num_rows()>0) {
			return $q->row()->lang_name;
		}
		else{
			return false;
		}
	}

	public function StaticsUpdate($dil_id,$json)
	{
		$this->db->set('lang_json',$json);
		$this->db->where('id',$dil_id);
		$this->db->update('language');
		if ($this->db->affected_rows()>0) {
			return true;
		}
		else{
			return false;
		}
	}

	public function GetLangListStatus()
	{
		$this->db->select('id, lang_name');
		$this->db->where(array('deleted' => 0, 'status' => 1));
		$q = $this->db->get('language');
		if ($q->num_rows()>0) {
			return $q->result();
		}
		else{
			return false;
		}
	}

	public function AllLangFileUpdate()
	{
		$this->db->where(array('status' => 1,'deleted' => 0));
		$this->db->select('id,lang_json');
		$q = $this->db->get('language');

		if ($q->num_rows()>0) {
			$q = $q->result();
			foreach ($q as $key => $val) {
				$fname = 'assets/lang/'.$val->id.'.json';
				$file = fopen($fname,"w");
				fwrite($file, $val->lang_json);

			}
		}
	}
}
?>