<?php
/**
* 
*/
class Statics_model extends Core_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function GetStaticPagesAll()
	{

		$data = array();


		$q = $this->db->query('SELECT  sl.*,s.page_title, s.page_type, s.status FROM statics s INNER JOIN statics_lang sl ON s.id = sl.static_id WHERE s.deleted = 0 AND sl.lang_id = 1');
		if ($q->num_rows()>0) {
			return $q->result();
		}else{
			return array();
		}

	}

	public function SetStatusById($id,$new)
	{
		$this->db->where('deleted',0);
		$this->db->where('id',$id);
		$this->db->set('status',$new);
		$this->db->update('statics');
		return true;
	}

	public function delete($id)
	{
		
		$this->db->where('id',$id);
		$this->db->set('deleted',1);
		$this->db->update('statics');
		if ($this->db->affected_rows()>0) {
			return true;
		}
		else{
			return false;
		}
	}

	public function Update($id, $title, $data)
	{
		if ($this->input->post()) {
			$this->db->trans_start();

				$this->db->set('page_title',$title);
				$this->db->where('id',$id);
				$this->db->update('statics');

				foreach ($data as $key => $val) {
					$url = url_seo($val['baslik']);
					$this->db->where(array('static_id' => $id,'lang_id' => $key));
				   	$q = $this->db->count_all_results('statics_lang');

					$langdata = array();

					if($q<1) 
					{
						$langdata['static_id'] 		= $id;
						$langdata['lang_id']		= $key;
						$langdata['page_headline']	= $val['baslik'];
						$langdata['page_content']	= $val['content_text'];
						$langdata['page_slug']		= url_seo($val['baslik']);

						$this->db->set($langdata);
						$this->db->insert('statics_lang');
					} else {
						$langdata['page_headline']	= $val['baslik'];
						$langdata['page_content']	= $val['content_text'];
						$langdata['page_slug']		= url_seo($val['baslik']);

						$this->db->set($langdata);
						$this->db->where(array('static_id' => $id,'lang_id' => $key));
						$this->db->update('statics_lang');
					}
				}

			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE){
				return false;
			}else{
				return true;
			}
		}else{
			return false;
		}
	}

	public function GetAllStatics($id)
	{
		$q = $this->db->query('SELECT static.*,l.short_code,l.lang_name FROM language l LEFT JOIN (SELECT sl.*,s.page_title,s.page_type,s.status FROM statics s INNER JOIN statics_lang sl ON s.id = sl.static_id WHERE s.id = '.addslashes($id).' AND s.deleted = 0) static ON l.id = static.lang_id WHERE l.deleted = 0 AND l.status = 1')->result();

		if (!empty($q[0]->page_title)) {
			return $q;
		}
		else{
			return false;
		}
	}

	public function Add($title, $data)
	{
		if ($this->input->post()) {
			$this->db->trans_start();

				$this->db->set('page_title',$title);
				$this->db->insert('statics');
				$static_id = $this->db->insert_id();

				$langdata = array();

				foreach ($data as $key => $val) {
					$url = url_seo($val['baslik']);
					$a = array('lang_id' 		=> $key,
						 	   'page_headline' 	=> $val['baslik'],
						 	   'page_content'  	=> $val['content_text'],
						 	   'static_id'	   	=> $static_id,
						 	   'page_slug'		=> $url
						 	);
					$langdata[] = $a;
				}

				$this->db->insert_batch('statics_lang', $langdata);

			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE){
				return false;
			}else{
				return true;
			}
		}else{
			return false;
		}
	}

	public function getDataByTitle($name)
	{
		$this->db->where(array('sl.page_slug' => $name, 'sl.lang_id' => Lang_id, 'deleted' => 0, 'status' => 1));
		$this->db->join('statics_lang sl','s.id = sl.static_id');
		$q = $this->db->get('statics s');
		if ($q->num_rows() > 0) {
			return $q->row();
		}else{
			return false;
		}
	}

}


?>