<?php 
/**
* 
*/
class Conversation_model extends Core_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function getList($sayfa)
	{
		$data = new StdClass;

		$pageBy = 20;//sayfada satır sayısı
		$totalCount = $this->db->count_all_results('conversation');
		$pageCount = $totalCount/$pageBy;

		if ($sayfa == 0 || $sayfa == 1) {
			$this->db->limit($pageBy,0);
			//$this->db->limit(2,0); 2 adet 0 dan itibaren
		}else{
			$sayfa = $sayfa-1;
			$sayfa = $sayfa*$pageBy;
			$this->db->limit($pageBy,$sayfa);
		}

		$this->db->select('c.*, u.name, pl.product_name');
		$this->db->from('conversation c');
		$this->db->join('users u', 'u.id = c.user_id', 'left');
		$this->db->join('order_line ol', 'ol.id = c.order_line_id', 'left');
		$this->db->join('product_lang pl', 'pl.product_id = ol.product_id', 'left');
		$this->db->where(array('pl.lang_id' => 1));
		$this->db->order_by('c.confirm_status ASC, c.id DESC');
		$q = $this->db->get();

		//$q = $this->db->query("SELECT c.*, u.name, pl.product_name FROM conversation c LEFT JOIN users u ON u.id = c.user_id LEFT JOIN order_line ol ON ol.id = c.order_line_id LEFT JOIN product_lang pl ON pl.lang_id = ol.product_id WHERE pl.lang_id = 1 GROUP BY c.id ORDER BY confirm_status ASC, id DESC");

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

	public function SetStatusById($id)
	{
		return $this->db->where('id', $id)->set('confirm_status', 1)->update('conversation');
	}

	public function ConversationImageUpload()
	{
		if (substr($_FILES['file']['name'],-3) != 'php' AND substr($_FILES['file']['name'],-2) != 'js') {

			$target_dir = "assets/uploads/";
			$rand 		= rand(10,999999999999);
			$rand 		= md5(md5($rand).md5(strtotime('now')))."deneme";
			$target_file = $target_dir . $rand.basename($_FILES['file']["name"]);
			if (move_uploaded_file($_FILES['file']["tmp_name"], $target_dir.$rand.$_FILES['file']['name'])) {
				return $target_file;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function AddLine($id, $text, $file)
	{
		$data = [
			'conversation_id' => $id,
			'text' => $text,
			'file' => $file,
			'admin_user_id' => $this->session->userdata('user')->id
		];
		if ($this->db->insert('conversation_line', $data)) {
			$this->db->set('last_design', 0)->where('id', $id)->update('conversation');
			return true;
		} else {
			return false;
		}
	}

	public function getConversationById($id)
	{

		$this->db->select('c.*, u.name, u.email, pl.product_name');
		$this->db->from('users u');
		
		$this->db->join('conversation c','u.id = c.user_id');
		$this->db->join('order_line ol','ol.id = c.order_line_id');
		$this->db->join('product_lang pl','pl.product_id = ol.product_id');
		

		$this->db->where(array('pl.lang_id'=>1,'c.id'=>$id));
		$this->db->order_by('confirm_status ASC');
		$q = $this->db->get();
		return $q->row();
		/*
		return $this->db->query("SELECT c.*, u.name, pl.product_name FROM conversation c LEFT JOIN users u ON u.id = c.user_id LEFT JOIN order_line ol ON ol.id = c.order_line_id LEFT JOIN product_lang pl ON pl.lang_id = ol.product_id WHERE pl.lang_id = 1 AND c.id = $id GROUP BY c.id ORDER BY confirm_status ASC, id DESC")->row();
		*/
	}

	public function getLinesByConversationId($id)
	{
		$this->db->where(array('conversation_id' => $id));
		$q = $this->db->get('conversation_line');

		if ($q->num_rows()>0) {
			return $q->result();
		}else{
			return array();
		}
	}

	public function getUserInfoByConversationId($id)
	{
		$this->db->select("u.name, u.email, c.order_line_id");
		$this->db->from("conversation c");
		$this->db->join("users u", "u.id = c.user_id", "left");
		$this->db->where(array("c.id" => $id, "deleted" => 0));
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			return $q->row();
		} else {
			return false;
		}
	}
	public function getEmail($Id){
		$this->db->select('Id, template');
		$this->db->from('email_template');
		$this->db->where(array('Id'=>$Id));
		$getQuery = $this->db->get();
		if($getQuery->num_rows()>0){
			return $getQuery->row();
		}else{
			return false;
		}
	}

}
?>