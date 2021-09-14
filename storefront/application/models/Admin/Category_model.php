<?php
class Category_model extends Core_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function getCategoryInfoById($id)
	{
		//prex($id);
		$this->db->from('category_information');
		$this->db->where(array('category_id'=>$id));
		$returnQuery = $this->db->get();
		return $returnQuery->row();
	}

	public function imageUpload()
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

	public function updateCategoryAndId($getAllPosts,$id)
	{
		//prex($getAllPosts);
		$dvns = array();
        //pre($getAllPosts);
        if (isset($getAllPosts->dvn)) {
			if (strpos($getAllPosts->dvn,',')) {
				$dvnParse = explode(',', $getAllPosts->dvn);
				foreach ($dvnParse as $key => $val) {
					$dvns[] = array('dvn' => trim($val),'kod3' => $id);
				}
			}else{
				$dvns[] = array('dvn' => ($getAllPosts->dvn),'kod3' => $id);
			}

			$this->db->where('kod3',$id);
			$this->db->delete('datDvnKod3');
			
			$this->db->insert_batch('datDvnKod3',$dvns);
			//pre($getAllPosts);
			//prex($dvns);
		}




		$this->db->select('category_id');
		$this->db->from('category_information');
		$this->db->where(array('category_id'=>$id));
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $this->db->set($getAllPosts)->where(array('category_id'=>$id))->update('category_information');
		} else {
			$getAllPosts->category_id = $id;
			return $this->db->insert('category_information',$getAllPosts);
		}
	}

	/* Alt Taraf Tamamıyla Eski Sistemin Silinebilir*/
	public function addCategory($sort, $menu, $tag, $lang, $category_slug, $exp)
	{
		$data = [
			'sort' => $sort,
			'menu' => $menu,
			'category_title' => $tag,
			'explore' => $exp
		];
		if ($this->db->insert('category', $data)) {
			$insertid = $this->db->insert_id();
			$data_insert = array();
			$a = array();
			foreach ($category_slug as $key => $val) {
				$a[$key] = url_seo($val);
			}
			$category_slug = $a;
			foreach ($lang as $key => $value) {
				$data_insert[] = array(
					'category_id' => $insertid,
					'lang_id' => $key,
					'name' => $value,
					'category_slug' => $category_slug[$key]
				);
			}
			if ($this->db->insert_batch('category_lang', $data_insert)) {
				return true;
			} else {
				$this->db->where('id', $insertid)->delete('category');
				return false;
			}
		} else {
			return false;
		}
	}

	public function updateCategory($catid, $sort, $menu, $tag, $lang, $category_slug, $newlang = false, $exp)
	{//category slugı parametre olarak aldım yollama işi de tamam sadece url_seo fonksyonuna sokup veritabanına yazdırcan.
		$data = [
			'sort' => $sort,
			'menu' => $menu,
			'category_title' => $tag,
			'explore' => $exp
		];
		if ($this->db->where('id', $catid)->update('category', $data)) {
			$data_update = array();
			$data_insert = array();
			foreach ($lang as $key => $value) {
				$name_slug = url_seo($category_slug[$key]);
				$data_update = array(
					'name' => $value,
					'category_slug' => $name_slug
				);
				$this->db->where('category_id', $catid)->where('lang_id', $key)->update('category_lang', $data_update);
			}
			if ($newlang) {
				foreach ($newlang as $key => $value) {
					$name_slug = url_seo($category_slug[$key]);
					$data_insert[] = array(
						'category_id' => $catid,
						'lang_id' => $key,
						'name' => $value,
						'category_slug' => $name_slug
					);
				}
				$this->db->insert_batch('category_lang', $data_insert);
			}
			return true;
		} else {
			return false;
		}
	}

	public function updateStatusById($id, $new)
	{
		$this->db->where('deleted', 0);
		$this->db->where('id', $id);
		$this->db->set('status', $new);
		$this->db->update('category');
		return true;
	}

	public function getAllCategories()
	{
		return $this->db->select("c.*, cl.name, cl.category_slug")->from('category c')->join('category_lang cl', 'cl.category_id = c.id')->where(array('c.deleted'=> 0,'lang_id' => Lang_id))->get()->result();
	}

	public function getCategoryAll()//üstteki sorgunun daha kolay hali
	{
		$this->db->select('c.id id,cl.name name');
		$this->db->where(array('cl.lang_id' => 1, 'c.deleted' => 0));
		$this->db->join('category_lang cl', 'cl.category_id = c.id');
		$q = $this->db->get('category c');

		if ($q->num_rows()>0) {
			return $q->result();
		}else{
			return array();
		}
	}

	public function getCategoriesById($catid)
	{
		return $this->db->query("SELECT l.id newlang_id, l.lang_name, cat.* FROM language l LEFT JOIN (SELECT c.category_title, c.menu, c.sort,c.explore, cl.* FROM category c INNER JOIN category_lang cl ON c.id = cl.category_id WHERE c.id = $catid) cat ON cat.lang_id = l.id WHERE l.deleted = 0 AND l.status = 1 GROUP BY l.id")->result();
	}

	public function deleteById($id)
	{
		return $this->db->where('id', $id)->set('deleted', 1)->update('category');
	}

	public function GetLangListForCategory()
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
	public function getCat($Id)
	{
		$this->db->select('Id,category_title');
		$this->db->from('category');
		$this->db->where(array('Id'=> $Id));
		$queryResult = $this->db->get();
		return $queryResult->row();
	}
	public function getProduct($Id)
	{
		$this->db->select('p.Id, p.default_image, p.sort, pc.product_id, pc.category_id, pl.lang_id, pl.product_id, pl.product_name');
		$this->db->from('product p');
		$this->db->join('product_category pc', 'p.id = pc.product_id');
		$this->db->join('product_lang pl', 'pl.product_id = p.Id');
		$this->db->where(array('pl.lang_id' =>1, 'pc.category_id' => $Id, 'p.deleted' => 0, 'p.status' => 1));
		$this->db->order_by('p.sort','ASC');
		$queryResult = $this->db->get();
		return $queryResult->result();
	}
	public function SetVariantSort($data)
	{
		foreach ($data as $key => $val) 
		{
			$this->db->where(array('Id' => $key));
			$this->db->set(array('sort' => $val));
			$this->db->update('product');
		}
		return true;
	}
}
?>