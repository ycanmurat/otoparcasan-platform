<?

class Agac_Model extends Core_Model
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

    public function addEditData($data)
    {
        //$this->db->order_by('id','DESC');
        $this->db->insert('datList',$data);
        return true;
    }

    public function get($data,$key = 0)
    {
        //prex($data);
        if ($key == 0) {
            return array();
        }

        $this->db->select('list');
        $this->db->where((array)$data);
        $this->db->order_by('id','DESC');
        $q = $this->db->get('datList');
        if ($q->num_rows()>0) {
            $q = $q->row();
            $q = json_decode($q->list);
            return $q;
        }else{
            return array();
        }
    }

    public function getCarImagesByBrand($type,$brand)
    {
        /*
        pre($type);
        prex($brand);
        */
        $sql = 'SELECT * FROM datCarImage WHERE id IN(SELECT MAX(id) FROM datCarImage WHERE brand = '.$this->db->escape($brand).' AND type = '.$this->db->escape($type).' GROUP BY model)';
        $q = $this->db->query($sql);
        if ($q->num_rows()>0) {
            return $q->result();
        }else{
            return array();
        }
    }

    public function getCarImagesById($type,$brand,$model)
    {
        /*
        pre($type);
        prex($brand);
        */
        $sql = 'SELECT * FROM datCarImage WHERE id IN(SELECT MAX(id) FROM datCarImage WHERE brand = '.$this->db->escape($brand).' AND type = '.$this->db->escape($type).' AND model = '.$this->db->escape($model).' GROUP BY model)';
        $q = $this->db->query($sql);
        if ($q->num_rows()>0) {
            return $q->row();
        }else{
            return false;
        }
    }

    public function addImage($data)
    {
        $this->db->set($data);
        return $this->db->insert('datCarImage');
    }

    public function getOils($keys)
    {
        $this->db->where_in('engine',$keys);
        $q = $this->db->get('engine_oil');
        if ($q->num_rows()>0) {
            return $q->result();
        }else{
            return array();
        }
    }

    public function addOil($post)
    {
        $engine = array();
        foreach ($post as $key => $val) {
            $engine[] = $val['engine'];
        }

        $this->db->where_in('engine',$engine);
        $this->db->delete('engine_oil');

        $this->db->insert_batch('engine_oil',$post);
        return true;
    }
}
