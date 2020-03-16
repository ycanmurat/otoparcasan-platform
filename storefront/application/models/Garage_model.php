<?defined('BASEPATH') OR exit('No direct script access allowed');

class Garage_model extends Core_Model
{	
	function __construct()
	{
		parent::__construct();
	}

	public function addGarrage($data)
	{
		if ($this->session->userdata('userInfo')) {
			$postData = array('user_id' => $this->session->userdata('userInfo')->id, 'car_id' => $data->carId, 'construction_time' => $data->consTime);
			$this->db->where($postData);
			if ($this->db->count_all_results('user_garage')>0) {
				return false;
			}else{
				$this->db->set($postData);
				$this->db->insert('user_garage');
				return true;
			}
		}else{
			return false;
		}
	}

	public function getGarageCars()
	{
		$this->load->model('Dat_model','dat');
		$user_id = $this->session->userdata('userInfo')->id;

		$this->db->where(array('user_id' => $user_id));
		$q = $this->db->get('user_garage');
		if ($q->num_rows() > 0) {
			$q = $q->result();

			foreach ($q as $key => $val) {
				$postdata = new StdClass;
				$postdata->carId = $val->car_id;
				$postdata->consTime = $val->construction_time;

				$q[$key]->detail = $this->dat->getCarDetail($postdata);
			}

			return $q;
		}else{
			return false;
		}
	}

	public function getCarImage($type, $brand, $model)
	{
		$data = array('type' => $type, 'brand' => $brand, 'model' => $model);
		
		$this->db->select('img');
		$this->db->where($data);
		$this->db->order_by('id','DESC');
		$this->db->limit(1);
		$q = $this->db->get('datCarImage');
		if ($q->num_rows()>0) {
			return $q->row()->img;
		}else{
			return false;
		}
	}

	public function deleteGarageCar($id)
	{
		$data = New StdClass;
		$data->id = $id;
		if ($this->session->userdata('userInfo')->id) {
			$data->user_id = $this->session->userdata('userInfo')->id;
			$this->db->where((array)$data);
			$this->db->delete('user_garage');
			if ($this->db->affected_rows()) {
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
}