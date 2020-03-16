<?

class Content_model extends Core_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function getContent()
	{
		$this->db->from('home_content');
		$this->db->where(array('id'=>1));
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->row();
		} else {
			return array();
		}
	}

	public function updateContent($getAllPosts)
	{
		return $this->db->set($getAllPosts)->where(array('id'=>1))->update('home_content');
	}

	public function getOtoparcasan()
	{
		$this->db->from('content_otoparcasan');
		$this->db->where(array('id'=>1));
		$returnQuery = $this->db->get();
		if ($returnQuery->num_rows() > 0) {
			return $returnQuery->row();
		} else {
			return array();
		}
	}

	public function updateOtoparcasan($getAllPosts)
	{
		return $this->db->set($getAllPosts)->where(array('id'=>1))->update('content_otoparcasan');
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
