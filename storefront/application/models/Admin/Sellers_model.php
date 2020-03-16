<?defined('BASEPATH') OR exit('No direct script access allowed');

class Sellers_model extends Core_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function addSeller($allPost)
	{
		return $this->db->insert('very_sellers',$allPost);
	}

	public function getSellers()
	{
		$this->db->from('very_sellers');
		$this->db->where(array('deleted'=>0));
		$this->db->order_by('sort','ASC');
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
		 	return $returnQuery->result();
		} else {
			return array();
		}
	}

	public function getSellersById($id)
	{
		$this->db->from('very_sellers');
		$this->db->where(array('id'=>$id));
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
		 	return $returnQuery->row();
		} else {
			return array();
		}
	}

	public function updateSeller($allPost,$id)
	{
		return $this->db->set($allPost)->where(array('id'=>$id))->update('very_sellers');
	}

	public function deleteSellers($id)
	{
		return $this->db->set(array('deleted'=>1))->where(array('id'=>$id))->update('very_sellers');
	}

	public function SetVariantSort($data)
	{
		foreach ($data as $key => $val) 
		{
			$this->db->where(array('id' => $key));
			$this->db->set(array('sort' => $val));
			$this->db->update('very_sellers');
		}
		return true;
	}

	public function statusUpdate($id,$status)
	{
		return $this->db->set(array('status'=>$status))->where(array('id'=>$id))->update('very_sellers');
	}

	public function ImageUpload()
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
}