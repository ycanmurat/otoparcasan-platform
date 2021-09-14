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

    public function getCarDetail($data)
    {
        $this->db->where('carId',$data->carId);
        $this->db->order_by('id','DESC');
        $this->db->limit(1);
        $q = $this->db->get('carDetail');
        if ($q->num_rows()>0) {
            return $q->row();
        }else{
            return array();
        }
    }

    public function getBildirimMails($id)
    {
        $this->db->where(array('id' => $id,'status' => 1));
        $q = $this->db->get('bildirim_mail');
        if ($q->num_rows() > 0) {
            $mails = $q->row()->mails;
            if (strstr($mails,',')) {
                $mails = explode(',', $mails);
            }else{
                $mails = array($mails);
            }

            foreach ($mails as $key => $val) {
                if (!filter_var($val, FILTER_VALIDATE_EMAIL)) {
                    unset($mails[$key]);
                }
            }
            
            if (count($mails)>0) {
                return $mails;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
	
}