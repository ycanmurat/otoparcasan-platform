<?

class Marka_model extends Core_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function getBrandsById($id)
	{
		$this->db->where('grup_kod',$id);
		$q = $this->db->get('manufacturerBrand');
		if ($q->num_rows()>0) {
			return $q->row();
		}else{
			return false;
		}
	}

	public function getBrandsAll()
	{
		$q = $this->db->get('manufacturerBrand');
		if ($q->num_rows()>0) {
			return $q->result();
		}else{
			return false;
		}
	}

	public function SetStatus($id,$new)
	{
		return $this->db->set(array('status'=>$new))->where(array('id'=>$id))->update('manufacturerBrand');
	}

	public function addBrand($id,$yerli,$image)
	{
		$this->db->set(array('grup_kod'=>$id,'yerli'=>$yerli));
		if ($image != false) {
			$this->db->set('image',$image);
		}
		$this->db->insert('manufacturerBrand');
		return true;
	}

	public function updateBrand($id,$yerli,$image)
	{
		$this->db->set(array('yerli'=>$yerli));
		if ($image != false) {
			$this->db->set('image',$image);
		}
		$this->db->where('grup_kod',$id);
		$this->db->update('manufacturerBrand');
		//prex($this->db->last_query());
		return true;
	}

	public function getTedarikci()
	{
		$q = $this->db->get('tedarikci');
		//prex($this->db->last_query());
        //prex($q->result());
		if ($q->num_rows()>0) {
			return $q->result();
		}else{
			return false;
		}
	}

	public function setOran($data)
	{
		$data = reverseArray((array)$data);
		foreach ($data as $key => $val) {
			$val = (object)$val;
			$this->db->where('cari_kod',$val->cari_kod);
			$q = $this->db->count_all_results('tedarikci');
			if ($q > 0) {
				$this->db->set('oran', $val->oran);
				$this->db->where('cari_kod', $val->cari_kod);
				$this->db->update('tedarikci');
			}else{
				$this->db->set('oran', $val->oran);
				$this->db->set('cari_kod', $val->cari_kod);
				$this->db->insert('tedarikci');
			}
		}
		return true;
	}

	public function updateSort($updateInformation)
	{
		return $this->db->update_batch('manufacturerBrand',$updateInformation,'id');
	}
}
