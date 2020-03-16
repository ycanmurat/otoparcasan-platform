<?
	class Bank_account_model extends Core_Model
	{
		function __construct()
		{
			parent::__construct();
		}

		public function addAccount($getAllPosts)
		{
			return $this->db->insert('bank_accounts',$getAllPosts);
		}

		public function getAccounts()
		{
			$this->db->from('bank_accounts');
			$this->db->where(array('deleted'=>0));
			$returnQuery = $this->db->get();
			if ($returnQuery->num_rows() > 0) {
				return $returnQuery->result();
			} else {
				return array();
			}
		}

		public function SetStatus($id,$new)
		{
			return $this->db->set(array('status'=>$new))->where(array('id'=>$id))->update('bank_accounts');
		}

		public function delete($id)
		{
			return $this->db->set(array('deleted'=>1))->where(array('id'=>$id))->update('bank_accounts');
		}

		public function getAccountById($id)
		{
			$this->db->from('bank_accounts');
			$this->db->where(array('id'=>$id));
			$returnQuery = $this->db->get();
			if ($returnQuery->num_rows() > 0) {
				return $returnQuery->row();
			} else {
				return array();
			}
		}

		public function updateAccount($getAllPosts,$id)
		{
			return $this->db->set($getAllPosts)->where(array('id'=>$id))->update('bank_accounts');
		}

		public function imageUpload()
		{
			if (substr($_FILES['file']['name'],-3) != 'php' AND substr($_FILES['file']['name'],-2) != 'js') {
				$target_dir = "assets/uploads/";
				$rand = rand(10,999999999999);
				$rand = md5(md5($rand).md5(strtotime('now')));
				$target_file = $target_dir.$rand.url_seo($_FILES['file']["name"]);
				$newname = "";
				$namearr = explode('-', $target_file);
				$count = count($namearr)-1;
				foreach ($namearr as $key => $val) {
					if ($key == $count) {
						$newname .= ".".$val;
					} elseif ($key == 0) {
						$newname .= $val;
					} else {
						$newname .= "-".$val;
					}
				}
				$target_file = $newname;

				if (move_uploaded_file($_FILES['file']["tmp_name"], $target_file)) {
					return $target_file;
				} else {
					return false;
				}
			} else {
				return false;
			}
		}
	}

?>