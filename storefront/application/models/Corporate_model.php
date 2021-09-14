<?defined('BASEPATH') OR exit('No direct script access allowed');

class Corporate_model extends Core_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function getFaqs()
	{
		$this->db->from('faq');
		$this->db->where(array('status'=>1,'deleted'=>0));
		$this->db->order_by('sort','ASC');
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->result();
		} else {
			return array();
		}
	}

	public function getCity()
	{
		$this->db->select('CityID,CityName');
		$this->db->from('location_cities');
		$this->db->order_by('CityID','DESC');
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->result();
		} else {
			return array();
		}
	}

	public function formAdd($postData)
	{
		return $this->db->insert('human_resources',$postData);
	}

	public function getContractedServices()
	{
		$this->db->from('contracted_services');
		$this->db->where(array('deleted'=>0,'status'=>1));
		$this->db->order_by('id','DESC');
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->result();
		} else {
			return array();
		}
	}

	public function getBankAccounts()
	{
		$this->db->from('bank_accounts');
		$this->db->where(array('deleted'=>0,'status'=>1));
		$this->db->order_by('id','DESC');
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->result();
		} else {
			return array();
		}
	}

	public function getSupportRequests()
	{
		$this->db->from('support_sections');
		$this->db->where(array('deleted'=>0,'status'=>1));
		$this->db->order_by('id','DESC');
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->result();
		} else {
			return array();
		}
	}

	public function getPositions()
	{
		$this->db->from('position');
		$this->db->where(array('deleted'=>0,'status'=>1));
		$this->db->order_by('id','DESC');
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->result();
		} else {
			return array();
		}
	}

	public function offerFormAdd($postData)
	{
		$this->db->set($postData)->insert('offer_form');
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

    public function getHelps()
    {
        $this->db->select('id,menu,slug');
        $this->db->where(array('status' => 1,'deleted' => 0));
        $this->db->order_by('sort','ASC');
        $q = $this->db->get('help');
        if ($q->num_rows()>0) {
            return $q->result();
        }else{
            return array();
        }
    }

    public function getHelpPost($slug = '')
    {
        if ($slug == '') {
            $this->db->order_by('sort','ASC');
            $this->db->limit(1);
        }else{
            $this->db->where(array('slug' => $slug));
        }
        $this->db->where(array('deleted' => 0,'status' => 1));
        $q = $this->db->get('help');
        if ($q->num_rows()>0) {
            return $q->row();
        }else{
            return false;
        }
    }
}