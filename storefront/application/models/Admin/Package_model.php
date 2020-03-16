<?php 
/**
* 
*/
class Package_model extends Core_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function GetPackageAll()
	{
		$this->db->select('p.*,pl.name name');
		$this->db->where(array('p.deleted' => 0, 'pl.lang_id' => 1));
		$this->db->join('package_lang pl','p.Id = pl.package_id');
		$q = $this->db->get('package p');
		if ($q->num_rows() > 0) {
			return $q->result();
		}else{
			return array();
		}
	}

	public function SetStatus($id,$status)
	{
		$this->db->where('id',$id);
		$this->db->set('status',$status);
		$this->db->update('package');
		return true;
	}

	public function delete($id)
	{
		$this->db->where('id',$id);
		$this->db->set('deleted',1);
		$this->db->update('package');

		if ($this->db->affected_rows()>0) {
			return true;
		}
		else{
			return false;
		}
	}

	public function SetAddPackage($data,$lang)
	{
		//prex($lang);
		$this->db->trans_start();

		$this->db->set($data);
		$this->db->insert('package');
		$pac_id = $this->db->insert_id();

		if ($pac_id > 0) {
			foreach ($lang as $key => $val) {
				$val['lang_id'] = $key;
				$val['package_id'] = $pac_id;
				$a[] = $val;
			}

			//prex($a);
			$this->db->insert_batch('package_lang', $a);

			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE){
				return false;
			}else{
				return true;
			}
		}
	}

	public function GetFullPackage($id)
	{
		//$q = $this->db->query('SELECT l.short_code,l.lang_name,package.*  FROM language l LEFT JOIN (SELECT p.standart_price,p.super_price,p.dev_price,p.title,pl.*	FROM package p INNER JOIN package_lang pl ON p.id = pl.package_id WHERE	p.id = '.addslashes($id).' AND deleted = 0) package ON l.id = package.lang_id WHERE l.deleted = 0 AND l.status = 1');
		
		$this->db->where(array('p.deleted' => 0,'p.status' => 1,'p.id' => $id));
		$this->db->from('package p');
		$this->db->join('package_lang pl','p.id = pl.package_id');
		$this->db->join('language l','l.id = pl.lang_id');
		$q = $this->db->get();

		if($q->num_rows()>0){
			$q = $q->result();
			return $q;
		}else{
			return false;
		}
	}

	public function UpdatePackage($data,$lang,$id)
	{
		if ($this->input->post()) {
			$this->db->trans_start();

				$this->db->set($data);
				$this->db->where(array('id' => $id));
				$this->db->update('package');

				foreach ($lang as $key => $val) {

					$this->db->where(array('package_id' => $id,'lang_id' => $key));
					$q = $this->db->count_all_results('package_lang');
					
					//dil yoksa o dili eklemek için kullanılan alan
					if ($q<1) {
						$val['package_id'] = $id;
						$val['lang_id'] = $key;
						$this->db->set($val);
						$this->db->insert('package_lang');
					} else {
						if (empty($val['square_image'])) {
							unset($val['square_image']);
						}
						$this->db->set($val);
						$this->db->where(array('package_id' => $id,'lang_id' => $key));
						$this->db->update('package_lang');
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

	public function GetPackageProductsAll($id)
	{
		$this->db->select('pp.*,pl.product_name name');
		$this->db->where(array('pp.package_sub_id' => $id,'pl.lang_id' => 1));
		$this->db->from('package_product pp');
		$this->db->join('product_lang pl','pl.product_id = pp.product_id');
		$q = $this->db->get();
		
		if ($q->num_rows()>0) {
			return $q->result();
		}
		else{
			return array();
		}
	}

	public function Productdelete($package_product_id)
	{
		$this->db->where(array('id'=>$package_product_id));
		$this->db->delete('package_product');
		return true;
	}

	public function PackageProductAdd($id,$variants,$product_id)
	{
		$variants = json_encode($variants);
		$data = array('package_sub_id' 	=> $id,
					  'product_id' 		=> $product_id,
					  'variants'	  	=> $variants);
		$this->db->set($data);
		$this->db->insert('package_product');

		return true;
	}

	public function PackageSizeControl($id)
	{
		$returntext = array();
		$standart = $this->db->where(array('size' => 0, 'package_id' => $id))->get('package_product')->num_rows();
		$super = $this->db->where(array('size' => 1, 'package_id' => $id))->get('package_product')->num_rows();
		$dev = $this->db->where(array('size' => 2, 'package_id' => $id))->get('package_product')->num_rows();
		if ($standart > 0 && $super > 0 && $dev > 0) {
			return true;
		} else {
			if ($standart == 0) {
				$returntext[] = "Standart";
			}
			if ($super == 0) {
				$returntext[] = "Süper";
			}
			if ($dev == 0) {
				$returntext[] = "Dev";
			}
			$this->session->set_flashdata('paketsonuc','<b>#'.$id.'</b> nolu paketi aktif edebilmek için <b>"'.implode(', ', $returntext).'"</b> boyutlarına ürün eklemelisiniz.');
			return false;
		}
	}

	public function PackageSlugControl($slug)
	{
		$q = $this->db->where('package_slug', $slug)->get('package_lang');
		if ($q->num_rows() > 0) {
			return false;
		} else {
			return true;
		}
	}

	public function GetPackageSubs($id)
	{
		$this->db->where(array('ps.package_id' => $id));
		$this->db->from('package_sub ps');
		$this->db->join('package_sub_lang psl','ps.id = psl.package_sub_id');
		$q = $this->db->get();

		if ($q->num_rows() > 0) {
			$q = $q->result();
			return $q;
		} else {
			return array();
		}
	}

	public function SetAddSubPackage($data,$lang)
	{
		$this->db->trans_start();

		$this->db->set($data);
		$this->db->insert('package_sub');
		$pac_id = $this->db->insert_id();

		if ($pac_id > 0) {
			foreach ($lang as $key => $val) {
				$val['lang_id'] = $key;
				$val['package_sub_id'] = $pac_id;
				$a[] = $val;
			}

			//prex($a);
			$this->db->insert_batch('package_sub_lang', $a);

			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE){
				return false;
			}else{
				return true;
			}
		}
	}

	public function subDelete($id)
	{
		$this->db->trans_start();

		$this->db->where('id',$id);
		$this->db->delete('package_sub');

		$this->db->where('package_sub_id',$id);
		$this->db->delete('package_sub_lang');


		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE){
			return false;
		}else{
			return true;
		}
	}

	public function GetSubPackageById($id)
	{
		$this->db->where(array('ps.id' => $id));
		$this->db->join('package_sub_lang psl','ps.Id = psl.package_sub_id');
		$this->db->join('language l','l.id = psl.lang_id');
		$q = $this->db->get('package_sub ps');
		if ($q->num_rows() > 0) {
			return $q->result();
		}else{
			return array();
		}
	}

	public function UpdateSubPackage($main,$lang,$id)
	{
		if ($this->input->post()) {
			$this->db->trans_start();

				$this->db->set($main);
				$this->db->where(array('id' => $id));
				$this->db->update('package_sub');

				foreach ($lang as $key => $val) {

					$this->db->where(array('package_sub_id' => $id,'lang_id' => $key));
					$q = $this->db->count_all_results('package_sub_lang');
					
					//dil yoksa o dili eklemek için kullanılan alan
					if ($q<1) {
						$val['package_sub_id'] = $id;
						$val['lang_id'] = $key;
						$this->db->set($val);
						$this->db->insert('package_sub_lang');
					} else {
						if (empty($val['banner'])) {
							unset($val['banner']);
						}
						if (empty($val['mainImage'])) {
							unset($val['mainImage']);
						}
						$this->db->set($val);
						$this->db->where(array('package_sub_id' => $id,'lang_id' => $key));
						$this->db->update('package_sub_lang');
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

}
?>