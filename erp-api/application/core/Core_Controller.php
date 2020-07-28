<?php 
/**
 * 
 */
class Core_Controller extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	public function GetAllPosts()
	{
		$data = new StdClass;
		foreach ($this->input->post() as $key => $val) {
			$data->$key = $this->input->post($key,true);
		}
		return $data;
	}

	public function Set_Cookie($name,$value,$time = 0)
	{
		if ($time == 0) {
			$time = time() + (60*60*30);
		}
		setcookie($name, $value, $time , "/");
		return true;
	}

	public function CookieIsset($name)
	{
		if (isset($_COOKIE[$name])) {
			return true;
		}else{
			return false;
		}
	}

	public function DeleteCookie($name)
	{
	    unset($_COOKIE[$name]);
		setcookie($name, null, -1, '/');
	}

	public function Get_Cookie($name)
	{
		return @$_COOKIE[$name];
	}

	public function uploadImage($data)
	{
		if ((substr($data["name"],-2) != 'js') AND (substr($data["name"],-3) != 'php')){

			$target_dir 	= "assets/uploads/";
			$rand 			= rand(10,999999999999);
			$rand 			= md5(md5($rand).md5(strtotime('now')));
			$target_file 	= $target_dir.$rand.url_seo($data["name"]);
			$newname 		= "";
			$namearr 		= explode('-', $target_file);
			$count 			= count($namearr)-1;
			foreach ($namearr as $key => $val){
				if($key == $count){
					$newname .= ".".$val;
				}elseif ($key == 0){
					$newname .= $val;
				}else{
					$newname .= "-".$val;
				}
			}
			$target_file 	= $newname;
			if (move_uploaded_file($data["tmp_name"], $target_file)){
				return $target_file;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
}
?>