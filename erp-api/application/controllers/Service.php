<?php 
/**
 * 
 */
class Service extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		echo 'Documant';
	}

	public function getCategories()
	{
		$this->db->select('GRUP_KOD,GRUP_ISIM');
		$this->db->order_by('GRUP_KOD','ASC');
		$q = $this->db->get('TBLSTOKKOD1');
		$categories = $q->result();

		foreach ($categories as $key => $val) {
			$categories[$key]->sub = array();
		}

		$this->db->select('GRUP_KOD,GRUP_ISIM');
		$this->db->order_by('GRUP_KOD','ASC');
		$q = $this->db->get('TBLSTOKKOD2');
		$data = $q->result();

		$codes = array();

		foreach ($data as $key => $val) {
			foreach ($categories as $key2 => $val2) {
				
				if ($val->GRUP_KOD[0] == $val2->GRUP_KOD) {
					$val->sub = array();
					$categories[$key2]->sub[] = $val;
					$codes[] = $val->GRUP_KOD;
				}
			}
		}

		$this->db->distinct();
		$this->db->select('s.KOD_2,s.KOD_3,k.GRUP_ISIM');
		$this->db->where_in('KOD_2',$codes);
		$this->db->join('TBLSTOKKOD3 k','k.GRUP_KOD = s.KOD_3');
		//$this->db->order_by('k.GRUP_KOD','ASC');
		$q = $this->db->get('TBLSTSABIT s');
		//prex($this->db->last_query());
		$data = $q->result();


		foreach ($categories as $key => $val) {
			foreach ($val->sub as $key2 => $val2) {
				foreach ($data as $key3 => $val3) {
					if ($val2->GRUP_KOD == $val3->KOD_2) {
						$categories[$key]->sub[$key2]->sub[] = array('GRUP_KOD' => $val3->KOD_3, 'GRUP_ISIM' => $val3->GRUP_ISIM);
					}
				}
			}
		}

		echo json_encode($categories);
	}

	public function getCategoryById($id = '')
	{
		$this->db->select('GRUP_KOD,GRUP_ISIM');
		$this->db->where('GRUP_KOD',$id);
		$q = $this->db->get('TBLSTOKKOD1');
		if ($q->num_rows()>0) {
			$data = $q->row();

			$this->db->select('GRUP_KOD,GRUP_ISIM');
			$this->db->order_by('GRUP_KOD','ASC');
			$this->db->where('SUBSTRING(GRUP_KOD, 1,1) = ',$data->GRUP_KOD);
			$q = $this->db->get('TBLSTOKKOD2');
			$data2 = $q->result();

			$codes = array();
			foreach ($data2 as $key => $val) {
				$codes[] = $val->GRUP_KOD;
			}
			

			$this->db->distinct();
			$this->db->select('s.KOD_2,s.KOD_3,k.GRUP_ISIM');
			$this->db->where_in('KOD_2',$codes);
			$this->db->join('TBLSTOKKOD3 k','k.GRUP_KOD = s.KOD_3');
			//$this->db->order_by('k.GRUP_KOD','ASC');
			$q = $this->db->get('TBLSTSABIT s');
			$data3 = $q->result();

			$return = array('topGroup' => $data, 'mainGroup' => $data2, 'subGruop' => $data3);

		}else{
			$return = array('topGroup' => array(), 'mainGroup' => array(), 'subGruop' => array());
		}

		echo json_encode($return);
	}

	public function getProductsByOem()
	{
		if ($this->input->post()) {
			$data = $this->getAllPosts();
			//$data = ['0' => '1855307','1' => '1802623', '2' => 'REP#75250120'];
			
			$this->db->select('s.STOK_KODU,s.STOK_ADI,tg.GRUP_ISIM,s.KOD_1,s.KOD_2,s.KOD_3,s2.KULL1S,s2.KULL2S,s2.KULL3S,s2.KULL4S,s2.KULL5S,s2.KULL6S,s2.KULL7S,s2.KULL8S,SATIS_FIAT1,SATIS_FIAT2');

			foreach ($data as $key => $val) {
				$this->db->or_where_in('s2.KULL1S',trim($val));
				$this->db->or_where_in('s2.KULL2S',trim($val));
				$this->db->or_where_in('s2.KULL3S',trim($val));
				$this->db->or_where_in('s2.KULL4S',trim($val));
				$this->db->or_where_in('s2.KULL5S',trim($val));
				$this->db->or_where_in('s2.KULL6S',trim($val));
				$this->db->or_where_in('s2.KULL7S',trim($val));
				$this->db->or_where_in('s2.KULL8S',trim($val));
			}


			$this->db->join('TBLSTSABITEK s2','s.STOK_KODU = s2.STOK_KODU');
			$this->db->join('TBLSTGRUP tg','s.GRUP_KODU = tg.GRUP_KOD');

			//$this->db->order_by('k.GRUP_KOD','ASC');
			$q = $this->db->get('TBLSTSABIT s');

			$data3 = $q->result();

			echo json_encode($data3);
		}else{
			echo json_encode(array());
		}
	}

	public function getProductsDetailByKod($value='')
	{
		if ($this->input->post()) {
			$data = $this->input->post('stokKodu',true);
			
			$this->db->select('s.STOK_KODU,s.STOK_ADI,tg.GRUP_ISIM,s.KOD_1,s.KOD_2,s.KOD_3,SATIS_FIAT1,SATIS_FIAT2');
			$this->db->where(array('s.STOK_KODU'=>$data));

			$this->db->join('TBLSTSABITEK s2','s.STOK_KODU = s2.STOK_KODU');
			$this->db->join('TBLSTGRUP tg','s.GRUP_KODU = tg.GRUP_KOD');

			//$this->db->order_by('k.GRUP_KOD','ASC');
			$q = $this->db->get('TBLSTSABIT s');

			$data3 = $q->row();
			echo json_encode($data3);

		}else{
			echo json_encode(array());
		}
	}

	public function getSubCategoriDetailById($id = '')
	{
		$this->db->select('GRUP_KOD,GRUP_ISIM');
		$this->db->where('GRUP_KOD',$id);
		$q = $this->db->get('TBLSTOKKOD3');
		$categories = $q->row();
		//prex($categories);
		echo json_encode($categories);
	}

	public function getTopCategoriDetailById($id = '')
	{
		$this->db->select('GRUP_KOD,GRUP_ISIM');
		$this->db->where('GRUP_KOD',$id);
		$q = $this->db->get('TBLSTOKKOD1');
		$categories = $q->row();
		//prex($categories);
		echo json_encode($categories);
	}
}
?>