<?defined('BASEPATH') OR exit('No direct script access allowed');

class Statics_model extends Core_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getStatikBySlug($slug)
    {
        $this->db->where(array('l.page_slug'=>$slug,'s.deleted'=>0,'s.status' => 1));
        $this->db->join('statics_lang l','s.id = l.static_id');
        $q = $this->db->get('statics s');
        if ($q->num_rows() > 0) {
            return $q->row();
        } else {
            return false;
        }
    }
}