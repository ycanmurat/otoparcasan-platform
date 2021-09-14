<?
	class Support_model extends Core_Model
	{
		function __construct()
		{
			parent::__construct();
		}

		public function addSupportSection($getAllPosts)
		{
			return $this->db->insert('support_sections',$getAllPosts);
		}

		public function getSupportSections()
		{
			$this->db->from('support_sections');
			$this->db->where(array('deleted'=>0));
			$returnQuery = $this->db->get();
			if ($returnQuery->num_rows() > 0) {
				return $returnQuery->result();
			} else {
				return array();
			}
		}

		public function supportStatusEdit($id,$new)
		{
			return $this->db->set(array('status'=>$new))->where(array('id'=>$id))->update('support_sections');
		}

		public function deleteSection($id)
		{
			return $this->db->set(array('deleted'=>1))->where(array('id'=>$id))->update('support_sections');
		}

		public function getSectionById($id)
		{
			$this->db->from('support_sections');
			$this->db->where(array('id'=>$id));
			$returnQuery = $this->db->get();
			if ($returnQuery->num_rows() > 0) {
				return $returnQuery->row();
			} else {
				return array();
			}
		}

		public function updateSection($getAllPosts,$id)
		{
			return $this->db->set($getAllPosts)->where(array('id'=>$id))->update('support_sections');
		}

		public function getsupportRequests()
		{
			$this->db->select('u.id uid,u.name uname,u.surname usurname,u.email uemail,sc.id scid,sc.title,sc.status scstatus, sc.deleted scdeleted,sr.*');
			$this->db->from('users u');
			$this->db->join('support_requests sr','sr.user_id = u.id','left');
			$this->db->join('support_sections sc','sr.section_id = sc.id','left');
			$this->db->where(array('sc.deleted'=>0,'sc.status'=>1,'sr.status'=>1,'sr.deleted'=>0));
			$this->db->order_by('sr.id','DESC');
			$returnQuery = $this->db->get();
			if ($returnQuery->num_rows() > 0) {
				return $returnQuery->result();
			} else {
				return array();
			}
		}

		public function deleteRequest($id)
		{
			return $this->db->set(array('deleted'=>1))->where(array('id'=>$id))->update('support_requests');
		}
	}

?>