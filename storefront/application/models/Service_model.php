<?defined('BASEPATH') OR exit('No direct script access allowed');

class Service_model extends Core_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    public function getCarTypes()
    {
        $this->db->select('list');
        $this->db->where(array('carType' => 0));
        $this->db->order_by('id','DESC');
        $this->db->limit(1);
        $q = $this->db->get('datList');
        if ($q->num_rows()>0) {
            //prex($q->result());
            $q = $q->row();
            $q = json_decode($q->list);
            return $q;
        }else{
            return array();
        }
    }

    public function getCarBrands($type)
    {
        $this->db->select('list');
        $this->db->where(array('carType' => $type,'carBrands' => 0));
        $this->db->order_by('id','DESC');
        $this->db->limit(1);
        $q = $this->db->get('datList');
        if ($q->num_rows()>0) {
            //prex($q->result());
            $q = $q->row();
            $q = json_decode($q->list);
            return $q;
        }else{
            return array();
        }
    }

    public function getCarModels($type,$brand)
    {
        $this->db->select('list');
        $this->db->where(array('carType' => $type,'carBrands' => $brand,'carModels' => 0));
        $this->db->order_by('id','DESC');
        $this->db->limit(1);
        $q = $this->db->get('datList');
        if ($q->num_rows()>0) {
            //prex($q->result());
            $q = $q->row();
            $q = json_decode($q->list);
            return $q;
        }else{
            return array();
        }
    }

    public function getCarSubModels($type,$brand,$model)
    {

        $this->db->select('list');
        $this->db->where(array('carType' => $type,'carBrands' => $brand,'carModels' => $model));
        $this->db->order_by('id','DESC');
        $this->db->limit(1);
        $q = $this->db->get('datList');
        if ($q->num_rows()>0) {
            //prex($q->result());
            $q = $q->row();
            $q = json_decode($q->list);
            return $q;
        }else{
            return array();
        }
    }
}