<?php 
/**
* 
*/
class Offer_model extends Core_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function getList($sayfa)
	{
		$data = new StdClass;

		$pageBy = 10;//sayfada satır sayısı
		$this->db->where(array('deleted' => 0));
		$totalCount = $this->db->count_all_results('offer');
		$pageCount = $totalCount/$pageBy;

		if ($sayfa == 0 || $sayfa == 1) {
			$this->db->limit($pageBy,0);
			//$this->db->limit(2,0); 2 adet 0 dan itibaren
		}else{
			$sayfa = $sayfa-1;
			$sayfa = $sayfa*$pageBy;
			$this->db->limit($pageBy,$sayfa);
		}

		$this->db->join('product p','o.product_id = p.Id','left');
		$this->db->where(array('o.deleted' => 0));
		$this->db->order_by('o.offer_status','ASC');
		$this->db->order_by('o.id','DESC');
		$this->db->from('offer o');
		$this->db->select('o.*, p.product_title, (SELECT lang_name FROM language WHERE Id = o.lang_id) lang_name');
		$q = $this->db->get();

		$data->list 		= $q->result();
		$data->pageCount 	= $pageCount;
		$data->totalCount 	= $totalCount;
		
		if ($q->num_rows()>0) {
			return $data;
		}
		else{
			return false;
		}
	}

	public function SetOffer($id,$offer)
	{
		$this->db->where('id',$id);
		$q = $this->db->count_all_results('offer');
		if ($q<1) 
		{
			return false;
		}
		else
		{
			$this->db->set($offer);
			$this->db->where('id',$id);
			$this->db->update('offer');
			return true;
		}
	}
	public function OfferImageUpload()
	{
		if (substr($_FILES['file']['name'],-3) != 'php' AND substr($_FILES['file']['name'],-2) != 'js'){
			$target_dir = "assets/uploads/";
			$rand = rand(10,999999999999);
			$rand = md5(md5($rand).md5(strtotime('now')));
			$target_file = $target_dir.$rand.url_seo($_FILES['file']["name"]);
			$newname = "";
			$namearr = explode('-', $target_file);
			$count = count($namearr)-1;
				foreach ($namearr as $key => $val) 
				{
					if ($key == $count) 
					{
						$newname .= ".".$val;
					} 
					elseif ($key == 0) 
					{
						$newname .= $val;
					} 
					else 
					{
						$newname .= "-".$val;
					}
				}
				$target_file = $newname;
				if (move_uploaded_file($_FILES['file']["tmp_name"], $target_file)) 
				{
					return $target_file;
				} 
				else 
				{
					return false;
				}
			} 
			else 
			{
				return false;
			}
	}
	public function getEmail($Id){
		$this->db->select('Id, template');
		$this->db->from('email_template');
		$this->db->where(array('Id'=>$Id));
		$getQuery = $this->db->get();
		if($getQuery->num_rows()>0){
			return $getQuery->row();
		}else{
			return false;
		}
	}
}

?>