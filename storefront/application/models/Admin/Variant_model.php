<?php
/**
* Author: Muhammet Ateş
*/
class Variant_model extends Core_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function addVariant($tag, $lang)
	{
		$data = [
			'variant_title' => $tag
		];
		if ($this->db->insert('variants', $data)) {
			$insertid = $this->db->insert_id();
			$data_insert = array();
			foreach ($lang as $key => $value) {
				$data_insert[] = array(
					'variant_id' => $insertid,
					'lang_id' => $key,
					'name' => $value
				);
			}
			if ($this->db->insert_batch('variant_lang', $data_insert)) {
				return true;
			} else {
				$this->db->where('id', $insertid)->delete('variants');
				return false;
			}
		} else {
			return false;
		}
	}

	public function updateVariant($varid, $tag, $lang, $newlang = false)
	{
		$data = [
			'variant_title' => $tag
		];
		if ($this->db->where('id', $varid)->update('variants', $data)) {
			$data_update = array();
			$data_insert = array();
			foreach ($lang as $key => $value) {
				$data_update = array(
					'name' => $value
				);
				$this->db->where('variant_id', $varid)->where('lang_id', $key)->update('variant_lang', $data_update);
			}
			if ($newlang) {
				foreach ($newlang as $key => $value) {
					$data_insert[] = array(
						'variant_id' => $varid,
						'lang_id' => $key,
						'name' => $value
					);
				}
				$this->db->insert_batch('variant_lang', $data_insert);
			}
			return true;
		} else {
			return false;
		}
	}

	public function GetLangListForVariant()
	{
		$this->db->where(array('deleted' => 0, 'status' => 1));
		$q = $this->db->get('language');
		if ($q->num_rows()>0) {
			return $q->result();
		}
		else{
			return false;
		}
	}

	public function getVariantLangsById($varid)
	{
		return $this->db->query("SELECT l.id newlang_id, l.lang_name, var.* FROM language l LEFT OUTER JOIN (SELECT v.variant_title, vl.* FROM variants v INNER JOIN variant_lang vl ON v.id = vl.variant_id WHERE v.id = $varid AND vl.variant_child_id = 0) var ON var.lang_id = l.id WHERE l.status = 1 AND l.deleted = 0")->result();
	}

	public function getVariantById($varid)
	{
		return $this->db->select('vl.name, v.id')->from('variants v')->join('variant_lang vl', 'vl.variant_id = v.id')->where(array('vl.variant_id' => $varid, 'vl.lang_id' => 1, 'variant_child_id' => 0, 'v.deleted' => 0))->get()->row();

	}

	public function getAllVariants()
	{
		return $this->db->select("v.*, vl.name")->from('variants v')->join('variant_lang vl', 'vl.variant_id = v.id', 'inner')->where('v.deleted', 0)->where('vl.variant_child_id', 0)->group_by("v.id")->get()->result();
	}

	public function getVaryantAll()// Üsttekinden
	{
		$this->db->select('v.id id, vl.name name');
		$this->db->where(array('vl.lang_id' => 1, 'v.deleted' => 0));
		$this->db->join('variant_lang vl', 'v.id = vl.variant_id');
		$this->db->order_by('vl.name');
		$q = $this->db->get('variants v');

		if ($q->num_rows()>0) {
			return $q->result();
		}else{
			return array();
		}
	}

	public function deleteVariantById($id)
	{
		return $this->db->where('id', $id)->set('deleted', 1)->update('variants');
	}

	public function updateStatusById($id, $new)
	{
		$this->db->where('deleted', 0);
		$this->db->where('id', $id);
		$this->db->set('status', $new);
		$this->db->update('variants');
		return true;
	}

	public function getVariantChilds($varid)
	{
		return $this->db->select("vc.*, vl.name")->from('variant_childs vc')->join('variant_lang vl', 'vl.variant_child_id = vc.id', 'inner')->where(array('vc.deleted' => 0, 'vl.lang_id' => 1, 'vc.variant_id' => $varid))->get()->result();

	}

	
	
	public function addVariantChild($varid, $tag, $lang)
	{
		$data = [
			'variant_id' => $varid,
			'child_title' => $tag
		];
		if ($this->db->insert('variant_childs', $data)) {
			$insertid = $this->db->insert_id();
			$data_insert = array();
			foreach ($lang as $key => $value) {
				$data_insert[] = array(
					'variant_id' => 0,
					'variant_child_id' => $insertid,
					'lang_id' => $key,
					'name' => $value
				);
			}
			if ($this->db->insert_batch('variant_lang', $data_insert)) {
				return true;
			} else {
				$this->db->where('id', $insertid)->delete('variant_childs');
				return false;
			}
		} else {
			return false;
		}
	}

	public function updateVariantChild($parentid, $childid, $tag, $lang, $newlang = false)
	{
		$data = [
			'child_title' => $tag
		];
		if ($this->db->where('id', $childid)->update('variant_childs', $data)) {
			$data_update = array();
			$data_insert = array();
			foreach ($lang as $key => $value) {
				$data_update = array(
					'name' => $value
				);
				$this->db->where('variant_child_id', $childid)->where('lang_id', $key)->update('variant_lang', $data_update);
			}
			if ($newlang) {
				foreach ($newlang as $key => $value) {
					$data_insert[] = array(
						'variant_id' => 0,
						'variant_child_id' => $childid,
						'lang_id' => $key,
						'name' => $value
					);
				}
				$this->db->insert_batch('variant_lang', $data_insert);
			}
			return true;
		} else {
			return false;
		}
	}

	public function getVariantChildLangsById($childid)
	{
		return $this->db->query("SELECT l.id newlang_id, l.lang_name, var.* FROM language l LEFT OUTER JOIN (SELECT v.child_title, vl.* FROM variant_childs v INNER JOIN variant_lang vl ON v.id = vl.variant_child_id WHERE v.id = $childid) var ON var.lang_id = l.id WHERE l.deleted = 0 AND l.status = 1")->result();
	}

	public function getVariantId_By_VariantChildId($id)
	{
		$result = $this->db->select('variant_id')->where('id', $id)->get('variant_childs')->row();
		return $result->variant_id;
	}

	public function deleteVariantChildById($id)
	{
		return $this->db->where('id', $id)->set('deleted', 1)->update('variant_childs');
	}

}
?>