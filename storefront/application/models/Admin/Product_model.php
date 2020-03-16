<?php 
/**
* 
*/
class Product_model extends Core_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function ReserveAry($Array)
	{
		foreach ($Array as $key => $val) {
			if (is_array($val)) {
				$ary[$key] = $val;
			}
		}

		foreach ($ary as $key => $val) {
			foreach ($val as $key2 => $val2) {
				$langdata[$key2][$key] = $val2;
			}
		}
		
		return $langdata;
	}

	public function getProductName($id)
	{
		$this->db->where('id',$id);
		$this->db->select('product_title');
		return $this->db->get('product')->row()->product_title;
	}

	public function addProduct($data,$langdata)
	{
		$std = new StdClass;
		$images_array 	= array();
		$theme_array 	= array();

		$theme_img 	= $this->session->userdata('theme_img');
		$images 	= $this->session->userdata('productImage');

		if (!empty($images)) {
			$data->default_image = $images[0];
		}


		$this->db->trans_start();
			$this->db->set($data);
			$this->db->insert('product');
			$prid = $this->db->insert_id();

			if (!empty($images)) {
				foreach ($images as $key => $val) {

					$images_array[] = array('product_id' => $prid,
											'url' 		 => $val);
				}
				$this->db->insert_batch('product_image',$images_array);
			}

			if (!empty($theme_img)) {
				foreach ($theme_img as $key => $val) {
					$theme_array[] = array('product_id' 	=> $prid,
											'template_id' 	=> $val['type'],
											'url'			=> $val['data'],
											'name'			=> $val['name'] );
				}
				$this->db->insert_batch('product_template_image', $theme_array);
			}
			if ($prid > 0) {
				foreach ($langdata as $key => $val) {
					$arrays = array($langdata[$key]['k1'],
						  $langdata[$key]['k2'],
						  $langdata[$key]['k3']);
					$langdata[$key]['product_prosses_json'] = json_encode($arrays);
					$langdata[$key]['lang_id'] = $key;
					unset($langdata[$key]['k1']);
					unset($langdata[$key]['k2']);
					unset($langdata[$key]['k3']);
					$langdata[$key]['added_time'] = date('Y-m-d H:i:s');
					$langdata[$key]['product_id'] = $prid;
					$langdata[$key]['product_slug'] = url_seo($val['product_slug']);
				}

				$this->db->insert_batch('product_lang', $langdata);

			$this->db->trans_complete();

			return true;
		}else{
			return false;
		}	
	}

	public function setUpdate($data,$id)
	{
		if ($this->input->post()) {
			$images_array 	= array();
			$theme_img 		= array();
			$themeNames		= array();

			$theme_img 	= $this->makeArray($this->session->userdata('theme_img'));
			$images 	= $this->makeArray($this->session->userdata('productImage'));

			$this->db->trans_start();
				$themeNames = $data->validTemplate;
				$langdata 	= $data->langdata;

				unset($data->langdata);
				unset($data->validTemplate);

				$this->db->set($data);
				$this->db->where(array('id' => $id));
				$this->db->update('product');


				if ($images != array()) {
					foreach ($images as $key => $val) {
						$images_array[] = array('product_id' => $id,
												'url' 		 => $val);
					}

					$this->db->insert_batch('product_image',$images_array);
				}

				if ($theme_img != array()) {
					foreach ($theme_img as $key => $val) {

						$theme_array[] = array('product_id' 	=> $id,
												'template_id' 	=> $val['type'],
												'url'			=> $val['data'],
												'name'			=> $val['name'] );
					}
					$this->db->insert_batch('product_template_image', $theme_array);
				}


				foreach ($langdata as $key => $val) {
					$val['product_prosses_json'] = json_encode(array($val['k1'],$val['k2'],$val['k3']));
					unset($val['k1']);
					unset($val['k2']);
					unset($val['k3']);
					$val['product_slug'] = url_seo($val['product_slug']);

					$this->db->where(array('product_id' => $id,'lang_id' => $key));
				   	$q = $this->db->count_all_results('product_lang');

					if ( $q<1) 
					{
						$val['product_id'] = $id;
						$val['lang_id']	   = $key;
						$this->db->set($val);
						$this->db->insert('product_lang');
					} else {
						$this->db->set($val);
						$this->db->where(array('product_id' => $id,'lang_id' => $key));
						$this->db->update('product_lang');
					}
				}

			$this->db->trans_complete();


			if ($this->db->trans_status() === FALSE){
				return false;
			}else{
				return true;
			}
		}else{
			return false;
		}
	}


	public function getAllFieldById($id)
	{
		$data = array();
		$q = $this->db->query('SELECT l.short_code,l.lang_name,product.* FROM language l LEFT JOIN (SELECT p.product_title,p.default_image,p.payment_type,p.creative_price,pl.* FROM product p INNER JOIN product_lang pl ON p.id = pl.product_id WHERE p.id = '.addslashes($id).' AND deleted = 0) product ON l.id = product.lang_id WHERE l.deleted = 0 AND l.status = 1');
		if ($q->num_rows()>0) {
			$q = $q->result();

			$this->db->where('product_id',$id);
			$images = $this->db->get('product_image')->result();

			$this->db->where('product_id',$id);
			$theme_img = $this->db->get('product_template_image')->result();

			$data['data'] 		= $q;
			$data['images'] 	= $images;
			$data['theme_img'] 	= $theme_img;

			if (!empty($q[0]->update_time)) {
				return $data;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	public function getList($sayfa)
	{
		$data 		= new StdClass;
		$pageBy 	= 20; //sayfada satır sayısı

		if ($sayfa == 0 || $sayfa == 1) {
			$this->db->limit($pageBy, 0);
		} else {
			$sayfa 	= $sayfa - 1;
			$sayfa 	= $sayfa * $pageBy;
			$this->db->limit($pageBy, $sayfa);
		}

		$this->db->select('p.*, pl.product_slug, pl.product_name');
		$this->db->from("product p");
		$this->db->join("product_lang pl", "pl.product_id = p.id", "left");
		$this->db->where(array('p.deleted' => 0, "pl.lang_id" => 1));

		if (count($this->input->get()) > 1) {
			if ($this->input->get("status", true) != "") {
				$this->db->where("p.status", $this->input->get("status", true));
			}

			if ($this->input->get("product_name", true) != "") {
				$this->db->like("pl.product_name", $this->input->get("product_name", true));
			}
		}

		$q = $this->db->get();
		$data->list = $q->result();

		// LİMİTİN OLMADIĞI SORGU - BAŞ

		$this->db->select('COUNT(p.id) c');
		$this->db->from("product p");
		$this->db->join("product_lang pl", "pl.product_id = p.id", "left");
		$this->db->where(array('p.deleted' => 0, "pl.lang_id" => 1));

		if (count($this->input->get()) > 1) {
			if ($this->input->get("status", true) != "") {
				$this->db->where("p.status", $this->input->get("status", true));
			}

			if ($this->input->get("product_name", true) != "") {
				$this->db->like("pl.product_name", $this->input->get("product_name", true));
			}
		}

		$dbCount = $this->db->get()->row();
		// LİMİTİN OLMADIĞI SORGU - SON

		$data->pageCount = $dbCount->c / $pageBy;

		if ($q->num_rows() > 0) {
			return $data;
		} else {
			return false;
		}
	}

	public function SetStatusById($id,$status)
	{
		$this->db->where('deleted',0);
		$this->db->where('id',$id);
		$this->db->set('status',$status);
		$this->db->update('product');
		return true;
	}

	public function delete($id)
	{
		$this->db->where('id',$id);
		$this->db->set('deleted',1);
		$this->db->update('product');
		if ($this->db->affected_rows()>0) {
			return true;
		}
		else{
			return false;
		}
	}

	public function deleteImg($id)
	{
		//default silindiğindeki durum kontrol edilecek

		$this->db->where('id',$id);

		if ($this->db->delete('product_image')) {
			return 1;
		}else{
			return 0;
		}
		
	}


	public function deleteTemplateImg($id)
	{
		$this->db->where('id',$id);
		if ($this->db->delete('product_template_image')) {
			return 1;
		}else{
			return 0;
		}
		
	}

	public function SetDefault($id)
	{
		$this->db->where(array('id' => $id));
		$this->db->select('url,product_id');
		$q = $this->db->get('product_image');
		if ($q->num_rows()>0) {
			$q = $q->row();

			$this->db->where(array('id' => $q->product_id));
			$this->db->set(array('default_image' => $q->url));
			$this->db->update('product');
			return true;
		}
		else{
			return false;
		}
	}

	public function getCategoryByProduct($id)
	{
		$this->db->select('pc.id id,cl.name name');
		$this->db->where(array('pc.product_id '=> $id, 'cl.lang_id' => 1, 'c.deleted' => 0));
		$this->db->join('category c', 'c.id = pc.category_id');
		$this->db->join('category_lang cl', 'cl.category_id = c.id');
		$q = $this->db->get('product_category pc');

		if ($q->num_rows()>0) {
			return $q->result();
		}else{
			return array();
		}
	}

	public function getCategoryByProductGetCategoryId($id)
	{
		$this->db->select('c.id id,cl.name name');
		$this->db->where(array('pc.product_id '=> $id, 'cl.lang_id' => 1, 'c.deleted' => 0));
		$this->db->join('category c', 'c.id = pc.category_id');
		$this->db->join('category_lang cl', 'cl.category_id = c.id');
		$q = $this->db->get('product_category pc');

		if ($q->num_rows()>0) {
			return $q->result();
		}else{
			return array();
		}
	}

	public function deleteFromCategory($id)
	{
		$this->db->where(array('id'=> $id));
		$this->db->delete('product_category');

		return true;
	}

	public function addProductCategory($product_id, $category_id)
	{
		$this->db->set(array('product_id' => $product_id, 'category_id' => $category_id));
		$this->db->insert('product_category');
		return true;
	}

	public function getVaryantByProduct($id)
	{
		$this->db->select('pv.id id, pv.variant_type variant_type, vl.name name, pv.sort');
		$this->db->where(array('pv.product_id '=> $id, 'vl.lang_id' => 1, 'v.deleted' => 0));
		$this->db->join('variants v', 'v.id = pv.variant_id');
		$this->db->join('variant_lang vl', 'v.id = vl.variant_id');
		$this->db->order_by('pv.sort');
		$q = $this->db->get('product_variant pv');

		if ($q->num_rows()>0) {
			return $q->result();
		}else{
			return array();
		}
	}

	public function deleteFromVaryant($id)
	{
		$this->db->where(array('id'=> $id));
		$this->db->delete('product_variant');
		return true;
	}

	public function getVaryantByProductGetVaryantId($id)
	{
		$this->db->select('v.id id, pv.variant_type variant_type, vl.name name');
		$this->db->where(array('pv.product_id '=> $id, 'vl.lang_id' => 1, 'v.deleted' => 0));
		$this->db->join('variants v', 'v.id = pv.variant_id');
		$this->db->join('variant_lang vl', 'v.id = vl.variant_id');
		$q = $this->db->get('product_variant pv');

		if ($q->num_rows()>0) {
			return $q->result();
		}else{
			return array();
		}
	}

	public function addProductVariant($product_id,$variant_id,$type)
	{
		$this->db->set(array('product_id' => $product_id, 'variant_id' => $variant_id, 'variant_type' => $type));
		$this->db->insert('product_variant');
		return true;
	}

	public function getSubVariants($id)
	{
		$this->db->select('pvs.id id, vl.name name, pvs.sort');
		$this->db->where(array('pv.id '=> $id, 'vl.lang_id' => 1, 'vc.deleted' => 0));
		$this->db->join('product_variant pv', 'pv.id = pvs.product_variant_id');
		$this->db->join('variant_lang vl', 'vl.variant_child_id = pvs.variant_child_id');
		$this->db->join('variant_childs vc', 'vc.id = pvs.variant_child_id');
		$this->db->order_by('pvs.sort');
		$q = $this->db->get('product_variant_sub pvs');

		if ($q->num_rows()>0) {
			return $q->result();
		}else{
			return array();
		}
	}

	public function deleteFromSubVariant($id)
	{
		$this->db->where(array('id'=> $id));
		$this->db->delete('product_variant_sub');
		return true;
	}

	public function getVaryantChildAll($id)
	{
		$this->db->select('variant_id');
		$this->db->where('id',$id);
		$q = $this->db->get('product_variant');
		$variant_id = $q->row()->variant_id;

		$this->db->select('vc.id id, vl.name name');
		$this->db->where(array('vl.lang_id' => 1, 'vc.deleted' => 0, 'vc.variant_id' => $variant_id));
		$this->db->join('variant_lang vl', 'vc.id = vl.variant_child_id');
		$q = $this->db->get('variant_childs vc');

		if ($q->num_rows()>0) {
			return $q->result();
		}else{
			return array();
		}
	}

	public function getSubVaryantByProductGetSubVaryantId($id)
	{
		$this->db->select('vc.id id, vl.name name');
		$this->db->where(array('pv.product_variant_id '=> $id, 'vl.lang_id' => 1, 'vc.deleted' => 0));
		$this->db->join('variant_childs vc', 'vc.id = pv.variant_child_id');
		$this->db->join('variant_lang vl', 'pv.variant_child_id = vl.variant_child_id');
		$q = $this->db->get('product_variant_sub pv');

		if ($q->num_rows()>0) {
			return $q->result();
		}else{
			return array();
		}
	}

	public function addSubVariant($id,$subVariantId)
	{
		$this->db->set(array('product_variant_id' => $id, 'variant_child_id' => $subVariantId));
		$this->db->insert('product_variant_sub');
		return true;
	}

	public function GetProductAll()
	{
		$this->db->select('pl.product_id,pl.product_name');
		$this->db->from('product p');
		$this->db->join('product_lang pl','pl.product_id = p.id');
		$this->db->where(array('pl.lang_id' => 1 ,'p.deleted' => 0,'p.status' => 1));
		$q = $this->db->get();

		if ($q->num_rows()>0) {
			return $q->result();
		}else{
			return array();
		}
	}

	public function GetProductVariants($productId)
	{	
		///*
		$this->db->select('pv.product_id product_id,
						   pv.variant_id variant_id,
						   pv.id product_variant_id,
						   vl.name name,
						   pv.sort sort');
		$this->db->where(array('pv.product_id' => $productId, 'vl.lang_id' => 1, 'pv.variant_type' => 1));
		$this->db->from('product_variant pv');
		$this->db->join('variant_lang vl','vl.variant_id = pv.variant_id');
		$this->db->order_by('pv.sort');
		$q = $this->db->get();
		$q = $q->result();

		foreach ($q as $key => $val) {
			$this->db->select('pvs.variant_child_id,pvs.product_variant_id variant_id, vl.name name');
			$this->db->where(array('pvs.product_variant_id' => $val->product_variant_id , 'vl.lang_id' => 1));
			$this->db->from('product_variant_sub pvs');
			$this->db->join('variant_lang vl','vl.variant_child_id = pvs.variant_child_id');
			$this->db->order_by('pvs.sort');
			$s = $this->db->get();
			$q[$key]->childs 	= $s->result();
		}
		return $q;

	}

	public function SetProductPrice($data,$product_id)
	{
		$this->db->where(array('product_id' => $product_id));
		$this->db->delete('product_price');

		$this->db->insert_batch('product_price',$data);
		return true;
	}

	public function GetProductPrice($product_id)
	{
		$this->db->where(array('product_id' => $product_id));
		$q = $this->db->get('product_price');

		if ($q->num_rows()>0) {
			return $q->result();
		}else{
			return array();
		}
	}

	public function SetVariantSort($data)
	{
		foreach ($data as $key => $val) {
			$this->db->where(array('id' => $key));
			$this->db->set(array('sort' => $val));
			$this->db->update('product_variant');
		}
		return true;
	}

	public function SetVariantSubSort($data)
	{
		foreach ($data as $key => $val) {
			$this->db->where(array('id' => $key));
			$this->db->set(array('sort' => $val));
			$this->db->update('product_variant_sub');
		}
		return true;
	}
}
?>