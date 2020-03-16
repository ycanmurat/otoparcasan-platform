<?defined('BASEPATH') OR exit('No direct script access allowed');

class Global_model extends Core_Model
{	
	function __construct()
	{
		parent::__construct();
	}

	public function getBanner()
	{
		$this->db->select('*');
		$this->db->from('product_banner');
		$this->db->where(array('Id'=>1,'status'=>1));
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows()>0) {
			return $returnQuery->row();
		} else {
			return array();
		}
	}

	public function getStar()
	{
		$this->db->select_avg('star');
		$result = $this->db->get('reviews')->row();  
		return $result;
	}

	public function getCountReviews()
	{
		$this->db->select('id');
		$this->db->from('reviews');
		$returnQuery = $this->db->get();
		return $returnQuery->num_rows();
	}

	public function getAllCategoryDetail()
	{
		$q = $this->db->get('category_information');
		return $q->result();
	}

	public function getCategoryDetail($menus,$q)
	{
		foreach ($menus as $key => $val) {
			foreach ($q as $key2 => $val2) {
				if ($val->GRUP_KOD == $val2->category_id) {
					$menus[$key]->detail = $val2;
				}
				foreach ($val->sub as $key3 => $val3) {	
					if ($val3->GRUP_KOD == $val2->category_id) {
						$menus[$key]->sub[$key3]->detail = $val2;
					}
				}
			}
		}
		return $menus;
	}

	public function getNotifications()
	{
		$userInfo = $this->session->userdata('userInfo');
		if (!empty($userInfo)) {
			$this->db->select('n.*,np.id not_id,np.seen_user_id,np.notification_id,np.added_time');
			$this->db->from('notifications n');
			$this->db->join('notifications_push np','n.id = np.notification_id');
			$this->db->where(array('n.status'=>1,'np.seen_user_id'=>$userInfo->id,'n.added_time >'=>$userInfo->added_time));
			$returnQuery = $this->db->get();
			return $returnQuery->num_rows();
		}
	}

	public function getPushNotification()
	{
		$userInfo = $this->session->userdata('userInfo');
		if (!empty($userInfo)) {
			$this->db->select('*');
			$this->db->from('notifications');
			$this->db->where("(user_id = '0' OR user_id='".$userInfo->id."')");
			$this->db->where(array('added_time > ' => $userInfo->added_time));
			$returnQuery = $this->db->get();
			return $returnQuery->num_rows();
		}
	}

	public function getReviewModalInformation()
	{
		$userInfo = $this->session->userdata('userInfo');
		if (!empty($userInfo)) {
			$this->db->select('*');
			$this->db->from('general_evaluation');
			$this->db->where(array('user_id'=>$userInfo->id));
			$returnQuery = $this->db->get();
			if ($returnQuery->num_rows() > 0) {
				return true;
			} else {
				return false;
			}
		}
	}

	public function getAllInsert()
	{
		$data = new stdClass();
		$data->userInfo = $this->session->userdata('userInfo');
		$data->banner = $this->getBanner();
		$data->stars = $this->getStar();
		$data->countReviews = $this->getCountReviews();
		$data->categoryDetails = $this->getAllCategoryDetail();
		//prex($data->categoryDetails);
		$menus = $this->Api_model->getCategories();
		$data->menus = $this->getCategoryDetail($menus,$data->categoryDetails);
		//prex($menus);
		$notificationResult = $this->getNotifications();
		$push = $this->getPushNotification();
		$data->reviewModal = $this->getReviewModalInformation();
		$data->userNotification = $push - $notificationResult;
		return $data;
	}
}