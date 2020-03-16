<?php
/**
* Author: Muhammet Ateş
*/
class Slider_model extends Core_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
// ((SELECT * FROM slider WHERE deleted = 0 AND status = 0 ORDER BY status DESC, lang_id ASC, sort ASC) union (SELECT * FROM slider WHERE deleted = 0 AND status = 1 ORDER BY id DESC)) s

	public function getList($sayfa)
	{
		$data = new StdClass;

		$pageBy = 20;//sayfada satır sayısı

		if ($sayfa == 0 || $sayfa == 1) {
			$this->db->limit($pageBy,0);
			//$this->db->limit(2,0); 2 adet 0 dan itibaren
		}else{
			$sayfa = $sayfa-1;
			$sayfa = $sayfa*$pageBy;
			$this->db->limit($pageBy,$sayfa);
		}

		$this->db->select("s.*, l.lang_name");
		$this->db->from('slider s');
		$this->db->join('language l', 'l.id = s.lang_id');
		$this->db->where('s.deleted', 0);
		$this->db->order_by('s.status DESC, s.lang_id ASC, s.sort ASC');
		$q = $this->db->get();
		$data->list = $q->result();

		$this->db->get_where('slider', array('deleted' => 0));
		$dbcount = $this->db->count_all_results();
		$data->pageCount 	= $dbcount/$pageBy;
		$data->totalCount 	= $dbcount;

		if ($q->num_rows() > 0) {
			return $data;
		} else {
			return false;
		}

	}
	
	public function AddSlider($lang, $sort, $link, $file)
	{
		$data = [
			'lang_id' => $lang,
			'sort' => $sort,
			'status' => 0,
			'deleted' => 0,
			'slider_url' => $file,
			'slider_redirect' => $link
		];
		if ($this->db->insert('slider', $data)) {
			return true;
		} else {
			return false;
		}
	}

	public function SliderImageUpload()
	{
		if (substr($_FILES['file']['name'],-3) != 'php' AND substr($_FILES['file']['name'],-2) != 'js') {
			$target_dir = "assets/uploads/";
			$rand = rand(10,999999999999);
			$rand = md5(md5($rand).md5(strtotime('now')));
			$target_file = $target_dir.$rand.url_seo($_FILES['file']["name"]);
			$newname = "";
			$namearr = explode('-', $target_file);
			$count = count($namearr)-1;
			foreach ($namearr as $key => $val) {
				if ($key == $count) {
					$newname .= ".".$val;
				} elseif ($key == 0) {
					$newname .= $val;
				} else {
					$newname .= "-".$val;
				}
			}
			$target_file = $newname;

			if (move_uploaded_file($_FILES['file']["tmp_name"], $target_file)) {
				return $target_file;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function DeleteSlider($id)
	{
		return $this->db->set('deleted', 1)->where('id', $id)->update('slider');
	}

	public function SetStatus($id, $new)
	{
		return $this->db->set('status', $new)->where('id', $id)->update('slider');
	}
	public function uploadPopUp($postInfo)
	{
		return $this->db->set('link',$postInfo->link)->set('picture',$postInfo->picture)->where('Id',1)->update('pop_up');
	}
	public function pop()
	{
		$this->db->select('*');
		$this->db->from('pop_up');
		$pop_ret = $this->db->get();
		return $pop_ret->result();
	}
	public function pStatus($Id, $new)
	{
		return $this->db->set('status', $new)->where('Id', $Id)->update('product_banner');
	}

	public function productStatus($Id, $new)
	{
		return $this->db->set('status', $new)->where('Id', $Id)->update('product_banner');
	}

	public function productBanner()
	{
		$this->db->from('product_banner');
		$pop_ret = $this->db->get();
		return $pop_ret->row();
	}
	public function imgUpload($getAllPost)
	{
		return $this->db->insert('slider_image',$getAllPost);
	}
	public function getPic()
	{
		$this->db->select('s.*,l.Id language_id,l.lang_name');
		$this->db->from('slider_image s');
		$this->db->join('language l','l.Id = s.lang_id');
		$this->db->where(array('s.deleted'=>0));
		$this->db->order_by('sort','ASC');
		$rImage = $this->db->get();
		if ($rImage->num_rows()>0) {
			return $rImage->result();
		} else {
			return array();
		}
	}
	
	public function addStatus($Id, $st)
	{
		return $this->db->set('status', $st)->where('Id', $Id)->update('slider_image');
	}

	public function SetVariantSort($data)
	{
		foreach ($data as $key => $val) 
		{
			$this->db->where(array('Id' => $key));
			$this->db->set(array('sort' => $val));
			$this->db->update('slider');
		}
		return true;
	}

	public function MobileSetVariantSort($data)
	{
		foreach ($data as $key => $val) 
		{
			$this->db->where(array('Id' => $key));
			$this->db->set(array('sort' => $val));
			$this->db->update('slider_image');
		}
		return true;
	}

	public function dImage($Id)
	{
		return $this->db->set(array('deleted'=>1))->where(array('Id'=>$Id))->update('slider_image');
	}

	public function getSliderInfo($Id)
	{
		$this->db->select('s.*,l.Id language_id,l.lang_name,l.status,l.deleted');
		$this->db->from('slider s');
		$this->db->join('language l','s.lang_id = l.Id');
		$this->db->where(array('l.deleted'=>0,'s.deleted'=>0,'s.Id'=>$Id));
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->row();
		} else {
			return false;
		}
	}

	public function updateSlider($Id,$getAllPost)
	{
		return $this->db->set($getAllPost)->where(array('Id'=>$Id))->update('slider');
	}

	public function updateHomeBanner($getAllPost)
	{
		return $this->db->set($getAllPost)->where(array('Id'=>1))->update('product_banner');
	}

	public function getMobileSliderInfo($Id)
	{
		$this->db->select('s.*,l.Id language_id,l.lang_name');
		$this->db->from('slider_image s');
		$this->db->join('language l','s.lang_id = l.Id');
		$this->db->where(array('s.deleted'=>0,'l.deleted'=>0,'s.Id'=>$Id));
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows()>0) {
			return $returnQuery->row();
		} else {
			return false;
		}
	}

	public function updateMobileSlider($Id,$getAllPost)
	{
		return $this->db->set($getAllPost)->where(array('Id'=>$Id))->update('slider_image');
	}
}
?>