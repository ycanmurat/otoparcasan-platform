<?php
	class Campaigns_model extends Core_Model
	{
		function __construct()
		{
			parent::__construct();
		}
		public function CampaignsImageUpload()
		{
			if (substr($_FILES['file']['name'],-3) != 'php' AND substr($_FILES['file']['name'],-2) != 'js') 
			{
				$target_dir = "assets/uploads/";
				$rand = rand(10,999999999999);
				$rand = md5(md5($rand).md5(strtotime('now')))."-CampaignsImage-";
				$target_file = $target_dir.$rand.url_seo($_FILES['file']["name"]);
				$newname = "";
				$namearr = explode('-', $target_file);
				$count = count($namearr)-1;
				foreach ($namearr as $key => $val) 
				{
					if ($key == $count) 
					{
						$newname .= ".".$val;
					} 
					elseif ($key == 0) 
					{
						$newname .= $val;
					} 
					else 
					{
						$newname .= "-".$val;
					}
				}
				$target_file = $newname;
				if (move_uploaded_file($_FILES['file']["tmp_name"], $target_file)) 
				{
					return $target_file;
				} 
				else 
				{
					return false;
				}
			} 
			else 
			{
				return false;
			}
		}
		public function CampaignAdd($dataArray)
		{
			$this->db->set($dataArray);
			if($this->db->insert('campaigns'))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		public function Camp()
		{
			$this->db->select('*');
			$this->db->from('campaigns');
			$this->db->where(array('deleted'=>0));
			$this->db->order_by('Id', 'DESC');
			$allCampaigns = $this->db->get();
			if ($allCampaigns->num_rows()>0) 
			{
				return $allCampaigns->result();
			}
			else
			{
				return false;
			}
		}
		public function StatusEditM($Id, $NowStatus)
		{
			return $this->db->set('status', $NowStatus)->where('Id', $Id)->update('campaigns');
		}
		public function delete($Id)
		{
			return $this->db->set('deleted', 1)->where('Id', $Id)->update('campaigns');
		}
		public function editCampaignResult($Id)
		{
			$this->db->select('Id,campaign_link,campaign_title,campaign_start,campaign_end,campaign_info,campaign_picture');
			$this->db->from('campaigns');
			$this->db->where(array('Id'=>$Id));
			$queryResult = $this->db->get();
			if ($queryResult->num_rows()>0) 
			{
				return $queryResult->row();
			}
			else
			{
				return false;
			}
		}
		public function updateCampaign($Id, $postData)
		{
			$lastQuery = $this->db->set($postData)->where('Id', $Id)->update('campaigns');
			if ($lastQuery) 
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
?>