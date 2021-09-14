<?defined('BASEPATH') OR exit('No direct script access allowed');
	
class User_model extends Core_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function getPasswordInformation($remember_key)
	{
		$this->db->select('name,email,remember_key,remember_added,deleted');
		$this->db->from('users');
		$this->db->where(array('remember_key'=>$remember_key,'deleted'=>0));
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->row();
		} else {
			return false;
		}
	}
}