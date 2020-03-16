<?defined('BASEPATH') OR exit('No direct script access allowed');

class Notifications_model extends Core_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function notificationVerify()
	{
		$userInfo = $this->session->userdata('userInfo');
		$this->db->select('*');
		$this->db->from('notifications');
		$this->db->where("(user_id = '0' OR user_id='".$userInfo->id."')");
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			$return = $returnQuery->result();
			$this->db->select('seen_user_id,notification_id');
			$this->db->from('notifications_push');
			$this->db->where(array('seen_user_id'=>$userInfo->id));
			$returnPushQuery = $this->db->get();
			$returnPush = $returnPushQuery->result();
			if (empty($returnPush)) {
				$addArray = array();
				foreach ($return as $key => $returnValue) {
					$addArray[$key]['seen_user_id'] = $userInfo->id;
					$addArray[$key]['notification_id'] = $returnValue->id;
				}
				if ($this->db->insert_batch('notifications_push',$addArray)) {
					return true;
				} else {
					return array();
				}
			} else {
				$addArray = array();
				foreach ($return as $key => $returnValue) {
					$add = true;
					foreach ($returnPush as $key2 => $pushValue) {
						if($returnValue->id == $pushValue->notification_id) {
							$add = false;
						}
					}
					if ($add == true) {
						$addArray[$key]['seen_user_id'] = $userInfo->id;
						$addArray[$key]['notification_id'] = $returnValue->id;
					}
				}
				if (!empty($addArray)) {
					if ($this->db->insert_batch('notifications_push',$addArray)) {
						return true;
					}
				}
			}
		} else {
			return array();
		}
	}

	public function getNotifications()
	{
		$userInfo = $this->session->userdata('userInfo');
		$this->db->select('*');
		$this->db->from('notifications');
		$this->db->where("(user_id = '0' OR user_id='".$userInfo->id."')");
		$this->db->where(array('status'=>1,'added_time >'=>$userInfo->added_time));
		$this->db->order_by('id','DESC');
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->result();
		} else {
			return array();
		}
	}
}