<?defined('BASEPATH') OR exit('No direct script access allowed');

class Core_Model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function getCookieAndSessionInformation($value)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where(array('token'=>$value));
		$returnQueryResult = $this->db->get();
		if ($returnQueryResult->num_rows()>0) {
			$this->session->set_userdata('userInfo',$returnQueryResult->row());
		} else {
			return false;
		}
	}

	public function getUserGarrage($id='')
	{
		$this->db->where(array('g.user_id' => $id));
		$this->db->join('datCarDetail cd','cd.carId = g.car_id AND cd.consTime = g.construction_time');
		$q = $this->db->get('user_garage g');
		if ($q->num_rows()>0) {
			$q = $q->result();
			foreach ($q as $key => $val) {
				$detail = json_decode($val->detail);
				$n1 =  $detail->Vehicle->ManufacturerName ?? '';
				$n2 =  $detail->Vehicle->BaseModelName ?? '';
				$n3 =  $detail->Vehicle->SubModelName ?? '';
				$q[$key]->detail = $n1.' '.$n2.' '.$n3;
			}
			return $q;
		}else{
			return false;
		}
	}
	
}