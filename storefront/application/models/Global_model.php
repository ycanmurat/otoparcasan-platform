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

	public function getCategoryDetail($menus = '',$q)
	{
        if (empty($menus) || $menus == false || !isset($menus)) {
            prex('netsis bağlantı hatası');
        }else{
            foreach ($menus as $key => $val) {
                $menus[$key]->GRUP_ISIM = replaceStringProblemsReverse($val->GRUP_ISIM);
                foreach ($q as $key2 => $val2) {
                    if ($val->GRUP_KOD == $val2->category_id) {
                        //prex($val2);
                        $menus[$key]->detail = $val2;
                    }
                    foreach ($val->sub as $key3 => $val3) {
                        $menus[$key]->sub[$key3]->GRUP_ISIM = replaceStringProblemsReverse($val3->GRUP_ISIM);
                        if ($val3->GRUP_KOD == $val2->category_id) {
                            $menus[$key]->sub[$key3]->detail = $val2;
                        }
                        foreach ($val3->sub as $key4 => $val4) {
                            $menus[$key]->sub[$key3]->sub[$key4]->GRUP_ISIM = replaceStringProblemsReverse($val4->GRUP_ISIM);
                            if ($val4->GRUP_KOD == $val2->category_id) {
                                $menus[$key]->sub[$key3]->sub[$key4]->detail = $val2;
                            }
                        }
                    }
                }
            }
        }


        usort($menus, function($a, $b) {
            return $a->detail->sort <=> $b->detail->sort;
        });

        foreach ($menus as $key => $val) {
            usort($val->sub, function($a, $b) {
                return $a->detail->sort <=> $b->detail->sort;
            });
            $menus[$key]->sub = $val->sub;
            foreach ($val->sub as $key2 => $val2) {
                foreach ($val2->sub as $key3 => $val3) {
                    if (!isset($val3->detail)) {
                        unset($val2->sub[$key3]);
                    }
                }
                usort($val2->sub, function($a, $b) {
                    return $a->detail->sort <=> $b->detail->sort;
                });
                $menus[$key]->sub[$key2]->sub = $val2->sub;
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
			$this->db->where(array('n.status'=>1,'np.seen_user_id'=>$userInfo->id,'n.added_time >'=> $userInfo->added_time));

			$q = $this->db->get();
            //prex($q->result());
			return $q->num_rows();
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

    public function orderCount()
    {
        $userInfo = $this->session->userdata('userInfo');
        if (!empty($userInfo)) {
            $this->db->where(array('paytrStatus' => 1,'user_id'=> $this->session->userdata('userInfo')->id));
            return $this->db->count_all_results('orders');
        }
        return 0;
    }

    public function getFavUser()
    {
        $userInfo = $this->session->userdata('userInfo');
        if (!empty($userInfo)) {
            $this->db->where(array('user_id'=> $this->session->userdata('userInfo')->id));
            return $this->db->count_all_results('user_favorite');
        }
        return 0;
    }

	public function getAllInsert()
    {
        $data = new stdClass();
        $data->userInfo = $this->session->userdata('userInfo');
        $data->banner = $this->getBanner();
        $data->stars = $this->getStar();
        $data->countReviews = $this->getCountReviews();
        $data->categoryDetails = $this->getAllCategoryDetail();
        $menus = $this->Api_model->getCategories();
        $data->menus = $this->getCategoryDetail($menus,$data->categoryDetails);
        $data->orderCount = $this->orderCount();
        $data->favProduct = $this->getFavUser();

        //prex($data->menus);
        $notificationResult = $this->getNotifications();
        $push = $this->getPushNotification();
        $data->reviewModal = $this->getReviewModalInformation();
        $data->userNotification = $push - $notificationResult;
        return $data;
    }
}