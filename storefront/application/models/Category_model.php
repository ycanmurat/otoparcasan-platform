<?php
/**
 * 
 */
class Category_model extends Core_Model
{
	function __construct()
	{
		parent::__construct();
	}

	

	public function getCategoryBySlug($slug='',$detail)
	{
		$this->db->where(array('slug' => $slug));
		$q = $this->db->get('category_information');
		if ($q->num_rows()>0) {
			$category = $q->row();
		}else{
			return false;
		}

		//prex($category);

		$data = $this->Api_model->getCategoriesById($category->category_id);
		$data->topDetail = $category;
		//prex($data);

		foreach ($data->subGruop as $key => $val) {
			foreach ($detail as $key2 => $val2) {
				if ($val2->category_id == $val->KOD_3) {
					$data->subGruop[$key]->detail = $val2;
					break;
				}
			}
		}

		foreach ($data->mainGroup as $key => $val) {
			$data->mainGroup[$key]->sub = array();
			foreach ($data->subGruop as $key2 => $val2) {
				if ($val->GRUP_KOD == $val2->KOD_2) {
					$data->mainGroup[$key]->sub[] = $val2;
				}
			}
		}

		unset($data->subGruop);


		return $data;
	}

	public function getProductByCategories($subCategory,$datCarId,$consTime)
	{

		$this->db->where(array('slug' => $subCategory,'car_id'=>$datCarId,'cons_time'=>$consTime));
		$this->db->where('added_time < NOW() + INTERVAL 1 DAY');
		$this->db->order_by('id','desc');
		$this->db->limit(1);
		$q = $this->db->get('dat_oem');
		if ($q->num_rows() > 0) {
			//prex(2);
			return json_decode($q->row()->detail ?? json_encode(array()));
		}
		
		$this->load->model('Dat_model','dat');

		$this->db->select('d.dvn');
		$this->db->where(array('c.slug' => $subCategory));
		$this->db->from('category_information c');
		$this->db->join('datDvnKod3 d','d.kod3 = c.category_id');
		$q = $this->db->get();
		//prex($q->num_rows());

		if ($q->num_rows()>0) {
			$ary = [];
			$q = $q->result();
			foreach ($q as $key => $val) {
				$ary[] = $val->dvn;
			}

			$q = $this->dat->getOem($ary,$datCarId,$consTime);
			if ($q != false) {
				$oems = array();

				if (is_array($q->Dossiers->Dossier->SparePartPositions->SparePartPosition)) {
					foreach ($q->Dossiers->Dossier->SparePartPositions->SparePartPosition as $key => $val) {
						$oems[] = $val->PartNumber;
					}
				}else{
					$oems[] = $q->Dossiers->Dossier->SparePartPositions->SparePartPosition->PartNumber;
				}


				$this->db->set(array('slug' => $subCategory,'car_id'=>$datCarId,'cons_time'=>$consTime,'detail'=>json_encode($oems)));
				$this->db->insert('dat_oem');
				return $oems;
				pre($q);
				prex($oems);
			}else{
				return array();
			}
		}
		else{
			return array();
		}
	}

	public function getCategoryName($val1,$val2)
	{
		$this->db->select('id,category_id,slug,desc');
		$this->db->where('slug',$val1);
		$this->db->or_where('slug',$val2);

		$data = $this->db->get('category_information');

		//prex($this->db->last_query());

		if ($data->num_rows()>1) {
			return $data->result();
		}else{
			return array();
		}
	}
}
?>