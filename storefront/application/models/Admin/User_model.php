<?php
/**
* Author: Muhammet Ateş
*/
class User_model extends Core_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function Update($id)
	{
		if ($this->input->post('email_permission', true) == 'on') {
			$email_permission = 1;
		} else {
			$email_permission = 0;
		}
		if ($this->input->post('pass', true) == '') {
			$pass = $this->input->post('oldpass', true);
		} else {
			$pass = md5($this->input->post('pass', true));
		}
		$data = [
			'name' => $this->input->post('name', true),
			'gender' => $this->input->post('gender', true),
			'email' => $this->input->post('email', true),
			'phone' => $this->input->post('phone', true),
			'pass' => $pass,
			'sector' => $this->input->post('sector', true),
			'email_permission' => $email_permission
		];
		return $this->db->where('id', $id)->update('users', $data);
	}

	public function deleteById($id)
	{
		return $this->db->where('id', $id)->set('deleted', 1)->update('users');
	}
	
	public function getAllUsers()
	{
		return $this->db->order_by('id ASC')->get('users')->result();
	}
	
	public function getUserById($id)
	{
		return $this->db->where('id', $id)->get('users')->row();
	}

	public function getList($sayfa)
	{
		$data = new StdClass;

		$pageBy = 20;//sayfada satır sayısı

		$this->db->where('deleted', 0);
		$totalq = $this->db->get('users');
		$totalCount = $totalq->num_rows();
		$pageCount = $totalCount/$pageBy;

		if ($sayfa == 0 || $sayfa == 1) {
			$this->db->limit($pageBy,0);
			//$this->db->limit(2,0); 2 adet 0 dan itibaren
		}else{
			$sayfa = $sayfa-1;
			$sayfa = $sayfa*$pageBy;
			$this->db->limit($pageBy,$sayfa);
		}

		$this->db->where('deleted', 0);
		$q = $this->db->get('users');

		$data->list = $q->result();
		$data->pageCount 	= $pageCount;
		$data->totalCount 	= $totalCount;

		if ($q->num_rows()>0) {
			return $data;
		}
		else{
			return false;
		}
	}

	public function insertuser()
	{
		exit;
		$file = file_get_contents('https://randomuser.me/api/?results=27&nat=TR');
		$file = json_decode($file);
		$users = $file->results;
		foreach ($users as $key => $val) {
			$data = [
				'gender' => $val->gender,
				'name' => $val->name->first,
				'surname' => $val->name->last,
				'email' => $val->email,
				'pass' => md5($val->login->password),
				'sifre' => $val->login->password,
				'phone' => $val->phone,
				'token' => $val->login->sha1
			];
			$this->db->insert('users', $data);
		}
		//prex($file);
	}

	public function getAddressByUserId($userid)
	{
		return $this->db->where(array('user_id' => $userid, 'deleted' => 0))->get('address')->result();
	}

	public function getAddressId($id)
	{
		return $this->db->where(array('id' => $id, 'deleted' => 0))->get('address')->row();
	}

	public function DeleteAddressById($id)
	{
		return $this->db->where('id', $id)->set('deleted', 1)->update('address');
	}

	public function AddAddress($user_id, $definition, $name, $content, $country, $city, $town, $post_code, $gsm)
	{
		$data = [
			'user_id' => $user_id,
			'definition' => $definition,
			'name' => $name,
			'content' => $content,
			'country' => $country,
			'city' => $city,
			'town' => $town,
			'post_code' => $post_code,
			'gsm' => $gsm
		];
		return $this->db->insert('address', $data);
	}

	public function UpdateAddress($address_id, $definition, $name, $content, $country, $city, $town, $post_code, $gsm)
	{
		$data = [
			'definition' => $definition,
			'name' => $name,
			'content' => $content,
			'country' => $country,
			'city' => $city,
			'town' => $town,
			'post_code' => $post_code,
			'gsm' => $gsm
		];
		return $this->db->where(array('id' => $address_id, 'deleted' => 0))->update('address', $data);
	}

}
?>