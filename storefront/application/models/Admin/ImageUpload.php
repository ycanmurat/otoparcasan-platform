<?php 
/**
* session yerine cookie ye geçilecek
*/
class ImageUpload extends Core_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function UploadProductImages($is_id)
	{
		if (substr($_FILES['file']['name'],-3) != 'php' AND substr($_FILES['file']['name'],-2) != 'js') {

			$target_dir = "assets/uploads/";
			$rand 		= rand(10,999999999999);
			$rand 		= md5($rand).rand(0,999999);
			$target_file = $target_dir.$rand.url_seo($_FILES['file']["name"]);

// IMAGE FILE

			$newimagename = "";
			$image_file = url_seo($_FILES['file']["name"]);
			$imagenamearr = explode('-', $image_file);
			$count = count($imagenamearr)-1;
			foreach ($imagenamearr as $imagekey => $imageval) {
				if ($imagekey == $count) {
					$newimagename .= ".".$imageval;
				} elseif ($imagekey == 0) {
					$newimagename .= $imageval;
				} else {
					$newimagename .= "-".$imageval;
				}
			}
			$image_file = $newimagename;

// TARGET FILE

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

			if ($this->session->userdata('theme_img')) {
				$theme_img = $this->session->userdata('theme_img');
			}else{
				$theme_img = array();
			}

			if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
				if ($is_id == 1) {//Acrobat
					
					$theme_img[] = array('data' => $target_file, 'name' => $image_file, 'type' => 1 );
					$this->session->set_userdata('theme_img',$theme_img);

				}elseif ($is_id == 2) {//Ilıstrator

					$theme_img[] = array('data' => $target_file, 'name' => $image_file, 'type' => 2 );
					$this->session->set_userdata('theme_img',$theme_img);
					
				}elseif ($is_id == 3) {//PDF

					$theme_img[] = array('data' => $target_file, 'name' => $image_file, 'type' => 3 );
					$this->session->set_userdata('theme_img',$theme_img);

				}elseif ($is_id == 4) {//productImage
					if ($this->session->userdata('productImage')) {
						$productImage = $this->session->userdata('productImage');
					}else{
						$productImage = array();
					}

					$productImage[] = $target_file;
					$this->session->set_userdata('productImage',$productImage);
				}
				return 'true';
			}else{
				return 'false';
			}
		}else{
			return 'false';
		}
	}

	public function UploadPackageImages($lang_id,$type)
	{
		if (substr($_FILES['file']['name'],-3) != 'php' AND substr($_FILES['file']['name'],-2) != 'js') {//gif  eklenecek

			$target_dir = "assets/uploads/";
			$rand 		= rand(10,99999);
			$rand 		= md5($rand).rand(0,99999);
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

			if ($this->session->userdata('theme_img')) {
				$theme_img = $this->session->userdata('theme_img');
			}else{
				$theme_img = array();
			}

			if ($this->session->userdata('theme_img')) {
				$theme_img = $this->session->userdata('theme_img');
			}else{
				$theme_img = array();
			}

			if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
				

				$this->session->set_userdata('banner_img_'.$lang_id.'_'.$type, $target_file);
				return 'true';
			}else{
				return 'false';
			}
		}else{
			return 'false';
		}
	}


}
?>