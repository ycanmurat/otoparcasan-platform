<?

class ServiceProblem_model extends Core_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getCarTypes()
    {
        $this->db->group_by('oem');
        $this->db->order_by('id','DESC');
        $q = $this->db->get('oemFault');
        if ($q->num_rows()>0) {
            return $q->result();
        }else{
            return array();
        }
    }

    public function oemFaultDelete($oem)
    {
        $this->db->where(array('oem' => $oem));
        $this->db->delete('oemFault');
        return true;
    }
}
