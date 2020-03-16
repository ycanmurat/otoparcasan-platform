<?php
/**
* Author: Muhammet Ateş
*/
class Currency_model extends Core_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function getAllCurrency()
	{
		return $this->db->order_by('status DESC, id ASC')->get('currency')->result();
	}

	public function updateStatusById($id, $new)
	{
		$this->db->where('id', $id);
		$this->db->set('status', $new);
		$this->db->update('currency');
		return true;
	}

	public function updateDovizApi()
	{
		$json = file_get_contents('https://api.doviz.com/list/C');
		$json = json_decode($json);
		$currencies = $json->value;
		//prex($currencies);
		if ($this->db->where('code', $currencies[0]->key)->get('currency')) {
			foreach ($currencies as $key => $val) {
				$data = [
					'name' => $val->adi,
					'code' => $val->key,
					'price' => $val->satis,
					'update_time' => date('Y-m-d h:i:sa')
				];
				$this->db->where('code', $val->key)->update('currency', $data);
			}
			echo "bitti!";
			exit;
		} else {
			redirect(admin_url('Currency'));
			exit;
		}
	}



	public function setDovizApi()
	{
		$json = file_get_contents('https://api.doviz.com/list/C');
		$json = json_decode($json);
		$currencies = $json->value;
		if ($this->db->where('code', $currencies[0]->key)->get('currency')) {
			redirect(admin_url('Currency'));
			exit;
		}
		foreach ($currencies as $key => $val) {
			$data = [
				'name' => $val->adi,
				'code' => $val->key,
				'price' => $val->satis
			];
			$this->db->insert('currency', $data);
		}
		echo "bitti!";
		exit;
	}


}
?>