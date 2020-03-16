<?php

class Dvn_model extends Core_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function getAllDvns()
	{
		$this->db->select('ldvn dvn, name');
		$this->db->group_by('ldvn');
		$q = $this->db->get('datDvns');

		$dvns = $q->result();

		$this->db->select('rdvn dvn , name');
		$this->db->group_by('rdvn');
		$q = $this->db->get('datDvns');

		$dvns = array_merge($dvns,$q->result());

		$kod3 = $this->db->get('datDvnKod3')->result();


		foreach ($dvns as $key => $val) {
			foreach ($kod3 as $key2 => $val2) {
				if ($val2->dvn == $val->dvn) {
					$dvns[$key]->kod3 = $val2->kod3;
				}
			}
		}

		usort($dvns, function($a, $b) {
		    return $a->dvn <=> $b->dvn;
		});

		foreach ($dvns as $key => $val) {
			if ($val->dvn == @$dvns[$key+1]->dvn) {
				unset($dvns[$key]);
			}
		}

		return $dvns;
	}

	public function addDvn($dvn,$value)
	{
		$data = array();

		$data['dvn'] = $dvn;
		$data['kod3'] = $value;

		$this->db->where(array('dvn'=>$dvn));
		$c = $this->db->count_all_results('datDvnKod3');
		if ($value != 0) {
			if ($c==0) {
				$this->db->set($data);
				$this->db->insert('datDvnKod3');
			}else{
				$this->db->set(array('kod3' => $value));
				$this->db->where(array('dvn' => $dvn));
				$this->db->update('datDvnKod3');
			}

			return true;
		}else{
			return false;
		}
	}


}
?>