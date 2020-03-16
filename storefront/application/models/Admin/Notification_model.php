<?
class Notification_model extends Core_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function getNotification()
	{
		$this->db->from('notifications');
		$this->db->where(array('user_id'=>0));
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->result();
		} else {
			return array();
		}
	}

	public function addNotification($getAllPosts)
	{
		return $this->db->insert('notifications',$getAllPosts);
	}

	public function StatusEdit($id,$status)
	{
		return $this->db->set(array('status'=>$status))->where(array('id'=>$id))->update('notifications');
	}

	public function deleteNotification($id)
	{
		return $this->db->delete('notifications',array('id'=>$id));
	}

	public function updateNotification($getAllPosts,$id)
	{
		return $this->db->set($getAllPosts)->where(array('id'=>$id))->update('notifications');
	}

	public function getNotificationById($id)
	{
		$this->db->from('notifications');
		$this->db->where(array('user_id'=>0,'id'=>$id));
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->row();
		} else {
			return array();
		}
	}
}