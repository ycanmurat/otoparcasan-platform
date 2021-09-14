<?
	class Form_model extends Core_Model
	{
		function __construct()
		{
			parent::__construct();
		}

		public function getContacts()
		{
			$this->db->from('contact');
			$this->db->where(array('deleted'=>0));
			$returnQuery = $this->db->get();
			if ($returnQuery->num_rows() > 0) {
				return $returnQuery->result();
			} else {
				return array();
			}
		}

		public function seenStatus($id,$seen)
		{
			return $this->db->set(array('status'=>$seen))->where(array('id'=>$id))->update('contact');
		}

		public function delete($id)
		{
			return $this->db->set(array('deleted'=>1))->where(array('id'=>$id))->update('contact');
		}

		public function getBulletin()
		{
			$this->db->from('bulletin');
			$this->db->where(array('deleted'=>0));
			$returnQuery = $this->db->get();
			if ($returnQuery->num_rows() > 0) {
				return $returnQuery->result();
			} else {
				return array();
			}
		}

		public function seenStatusBulletin($id,$seen)
		{
			return $this->db->set(array('status'=>$seen))->where(array('id'=>$id))->update('bulletin');
		}

		public function deleteBulletin($id)
		{
			return $this->db->set(array('deleted'=>1))->where(array('id'=>$id))->update('bulletin');
		}
		
		public function addPosition($postData)
		{
			return $this->db->insert('position',$postData);
		}

		public function getPositions()
		{
			$this->db->from('position');
			$this->db->where(array('deleted'=>0));
			$returnQuery = $this->db->get();
			if ($returnQuery->num_rows() > 0) {
				return $returnQuery->result();
			} else {
				return array();
			}
		}

		public function positionStatusUpdate($id,$newInfo)
		{
			return $this->db->set(array('status'=>$newInfo))->where(array('id'=>$id))->update('position');
		}

		public function deletePosition($id)
		{
			return $this->db->set(array('deleted'=>1))->where(array('id'=>$id))->update('position');
		}
	}

?>