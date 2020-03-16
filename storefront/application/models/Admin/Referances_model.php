<?php 
class Referances_model extends Core_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function ListsReferances()
	{
		$status = $this->db->get('referances');
		if ($status->num_rows()>0) 
		{
			return $status->result();
		}
		else
		{
			return false;
		}
	}
	public function AddReferances($info)
	{
		$this->db->set($info);
		if ($this->db->insert('referances')) 
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function ReferancesImageUpload()
	{
		if (substr($_FILES['file']['name'],-3) != 'php' AND substr($_FILES['file']['name'],-2) != 'js'){
			$target_dir = "assets/uploads/";
			$rand = rand(10,999999999999);
			$rand = md5(md5($rand).md5(strtotime('now')))."ReferancesImage";
			$target_file = $target_dir.$rand.basename($_FILES['file']["name"]);
			if (move_uploaded_file($_FILES['file']["tmp_name"], $target_dir.$rand.$_FILES['file']['name'])) 
			{
				return $target_file;
			} 
			else 
			{
				return false;
			}
		} 
		else{
			return false;
		}
	}
	public function ReferancesDelete($Id)
	{
		$deleteQuery = $this->db->delete('referances', array('Id' => $Id));
		if ($deleteQuery == true) 
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function StatusEditModel($Id, $St)
	{
		return $this->db->set('status', $St)->where('Id', $Id)->update('referances');
	}

}
?>