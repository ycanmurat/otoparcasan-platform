<?
	class Human_resources_model extends Core_Model
	{
		function __construct()
		{
			parent::__construct();
		}

		public function getApplication()
		{
			$this->db->select('hr.*,lc.CityID,lc.CityName,lco.CountyID,lco.CountyName,p.id position_id,p.name');
			$this->db->from('human_resources hr');
			$this->db->join('location_cities lc','lc.CityID = hr.city_id');
			$this->db->join('location_counties lco','lco.CountyID = hr.town_id');
			$this->db->join('position p','p.id = hr.position');
			$this->db->where(array('hr.deleted'=>0));
			$this->db->order_by('hr.id','DESC');
			$returnQuery = $this->db->get();
			if ($returnQuery->num_rows() > 0) {
				return $returnQuery->result();
			} else {
				return array();
			}
		}
	}

?>