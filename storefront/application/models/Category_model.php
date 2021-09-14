<?php
/**
 * 
 */
class Category_model extends Core_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function getCategoryBySlug($slug='',$detail)
	{
		$this->db->where(array('slug' => $slug));
		$q = $this->db->get('category_information');
		if ($q->num_rows()>0) {
			$category = $q->row();
		}else{
			return false;
		}

		//prex($category);

		$data = $this->Api_model->getCategoriesById($category->category_id);
		$data->topDetail = $category;

		foreach ($data->subGruop as $key => $val) {
			foreach ($detail as $key2 => $val2) {
				if ($val2->category_id == $val->KOD_3) {
					$data->subGruop[$key]->detail = $val2;
					break;
				}
			}
		}

		foreach ($data->mainGroup as $key => $val) {
			$data->mainGroup[$key]->sub = array();
			foreach ($data->subGruop as $key2 => $val2) {
				if ($val->GRUP_KOD == $val2->KOD_2) {
					$data->mainGroup[$key]->sub[] = $val2;
				}
			}
            foreach ($detail as $key2 => $val2) {
                if ($val2->category_id == $val->GRUP_KOD) {
                    $data->mainGroup[$key]->detail = $val2;
                    break;
                }
            }
		}


        usort($data->mainGroup, function($a, $b) {
            return $a->detail->sort <=> $b->detail->sort;
        });

        foreach ($data->mainGroup as $key => $val) {
            //pre($val->sub);
            foreach ($val->sub as $key2 => $val2) {
                if (!isset($val2->detail)) {
                    unset($data->mainGroup[$key]->sub[$key2]);
                }
            }
            
            usort($val->sub, function($a, $b) {
                return $a->detail->sort <=> $b->detail->sort;
            });
            $data->mainGroup[$key]->sub = $val->sub;
        }
        //prex($data->mainGroup);

		unset($data->subGruop);
		return $data;
	}

	public function getProductByCategories($subCategory,$datCarId,$consTime)
	{
		$this->load->model('Dat_model','dat');

		$this->db->select('d.dvn');
		$this->db->where(array('c.slug' => $subCategory));
		$this->db->from('category_information c');
		$this->db->join('datDvnKod3 d','d.kod3 = c.category_id');
		$q = $this->db->get();

        $oems = array();
        $aciklama = array();

		if ($q->num_rows()>0) {
			$ary = [];
			$q = $q->result();
			foreach ($q as $key => $val) {
                if (!empty($val->dvn)) {
                    $ary[] = $val->dvn;
                }
			}

            //prex($ary);

			$q = $this->dat->getOem($ary,$datCarId,$consTime);
            //prex($q);
            if ($q != false) {

                if (is_array($q->Dossiers->Dossier)) {
                    foreach ($q->Dossiers->Dossier as $key => $val) {
                        if (is_array($val->SparePartPositions->SparePartPosition)) {
                            foreach ($val->SparePartPositions->SparePartPosition as $key2 => $val2) {
                                $oems[] = trim($val2->PartNumber);
                                $aciklama[trim($val2->PartNumber)] = $val2->Description;
                            }
                        }else{
                            $oems[] = trim($val->SparePartPositions->SparePartPosition->PartNumber);
                            $aciklama[trim($val->SparePartPositions->SparePartPosition->PartNumber)] = $val->SparePartPositions->SparePartPosition->Description;
                        }
                    }
                }else{
                    if (is_array($q->Dossiers->Dossier->SparePartPositions->SparePartPosition)) {
                        foreach ($q->Dossiers->Dossier->SparePartPositions->SparePartPosition as $key => $val) {
                            $oems[] = trim($val->PartNumber);
                            $aciklama[trim($val->PartNumber)] = $val->Description;
                        }
                    }else{
                        $oems[] = trim($q->Dossiers->Dossier->SparePartPositions->SparePartPosition->PartNumber);
                        $aciklama[trim($q->Dossiers->Dossier->SparePartPositions->SparePartPosition->PartNumber)] = $q->Dossiers->Dossier->SparePartPositions->SparePartPosition->Description;
                    }
                }

                function del0($val)
                {
                    if ($val[0] == '0') {
                        $val = ltrim($val, '0');
                        return $val;
                    }else{
                        return $val;
                    }
                }
                
                foreach ($oems as $key => $val) {
                    $val = str_replace(' ','',str_replace('.','',str_replace('-','',str_replace(',','', trim($val)))));
                    $oems[$key] = del0($val);
                }

                $ack = array();
                foreach ($aciklama as $key => $val) {
                    $key = str_replace(' ','',str_replace('.','',str_replace('-','',str_replace(',','', trim($key)))));
                    $key =  del0($key);
                    $ack[$key] = $val;
                }

                $aciklama = $ack;
                $oems = array_unique($oems);
			}
		}

        return (object)array('oems' => $oems,'aciklama' => $aciklama);
	}

	public function getCategoryName($val1,$val2)
	{
		$this->db->select('id,category_id,slug,desc');
		$this->db->where('slug',$val1);
		$this->db->or_where('slug',$val2);

		$data = $this->db->get('category_information');

		if ($data->num_rows()>1) {
			return $data->result();
		}else{
			return array();
		}
	}

	public function getCategoryByKod($kod,$kod2)
	{
		$this->db->select('id,category_id,slug,desc');
		$this->db->where('category_id',$kod);
		$this->db->or_where('category_id',$kod2);

		$data = $this->db->get('category_information');

		if ($data->num_rows()>1) {
			return $data->result();
		}else{
			return array();
		}
	}

	public function getMarkaTedarik($marka,$tedarik)
	{
		$data = new StdClass;
		$this->db->where_in('grup_kod',$marka);
		$q = $this->db->get('manufacturerBrand');

		if ($q->num_rows()>0) {
			$data->marka = $q->result();
		}else{
			$data->marka = array();
		}

		$this->db->where_in('cari_kod',$tedarik);
		$q = $this->db->get('tedarikci');

		if ($q->num_rows()>0) {
			$data->tedarikci = $q->result();
		}else{
			$data->tedarikci = array();
		}

		return $data;
	}

	public function getTelimatDate($date)
	{
        if ($date == 0) {
            return 'Bugün Gün';
        }elseif ($date == 1){
            return 'Yarın';
        }elseif ($date == 99 || $date == 100) {
            return 'YOK';
        }

		$this->db->where('break_day >=', date('Y-m-d'));
		$this->db->where('break_day <=', date('Y-m-d', strtotime('15 day')));
		$q = $this->db->get('break_days');
		if ($q->num_rows()) {
			$days = $q->result();
		}else{
			$days = array();
		}

		$i = -1;
		$r = 0;
		$returnDate = '';
		while ($i < $date) {
			$tmpDate =  date('Y-m-d', strtotime($r.' day'));
			$r++;
			if (teslimatGun($tmpDate) !=6 && teslimatGun($tmpDate) != 0) {
				if (empty($days)) {
					$i++;
				}else{
					$ir = 0;
					foreach ($days as $key => $val) {
						if ($val->break_day == $tmpDate) {
							$ir ++;
						}
					}

					if ($ir == 0) {
						$i++;
					}
				}
			}
		}

		return teslimatGunTxt($tmpDate);
	}

	public function getDiscountByProduct($data)
	{
		$q = $this->db->query('SELECT *
							FROM `indirim`
							WHERE (`status` = 1 AND `deleted` = 0) AND
							(`marka` = "'.$data['marka'].'"
							OR `cari` = "'.$data['cari'].'"
							OR `ustKategori` = "'.$data['ustKategori'].'"
							OR `anaKategori` = "'.$data['anaKategori'].'"
							OR `altKategori` = "'.$data['altKategori'].'")');
        
		if ($q->num_rows()>0) {
			$q = $q->result();
			$max 	= 0;
			foreach ($q as $key => $val) {
				if ($val->marka == $data['marka'] || $val->marka == 0) {
					if ($val->cari == $data['cari'] || $val->cari == 0) {
						if ($val->ustKategori == $data['ustKategori'] || $val->ustKategori == 0) {
							if ($val->anaKategori == $data['anaKategori'] || $val->anaKategori == 0) {
								if ($val->altKategori == $data['altKategori'] || $val->altKategori == 0) {
									if ($max < $val->discount) {
										$max = $val->discount;
									}
								}
							}
						}
					}
				}
			}
			return $max;
		}else{
			return 0;
		}
	}

    public function getCargoPrice()
    {
        $this->db->where('id',1);
        $q = $this->db->get('cargo');
        if ($q->num_rows()>0) {
            return $q->row()->min_price;
        }else{
            return 0;
        }
    }

    public function getBrandsNames($data)
    {
        $this->load->model('Api_model','Api');
        $data = $this->Api->getBrandsByIds($data);
        //prex($data);
        return $data;
    }


    public function getMontajNames($data)
    {
        $this->load->model('Api_model','Api');
        $data = $this->Api->getMontajNames($data);
        return $data;
    }

    public function addOemFault($oems)
    {
        if ($oems != array()) {
            $this->db->insert_batch('oemFault',$oems);
        }
    }

    public function getStars($url)
    {
        $this->db->select('COUNT(*) comment,AVG(star) star');
        $this->db->where(array('slug' => $url,'status' => 1, 'deleted' => 0));
        $q = $this->db->get('comments');
        if ($q->num_rows()>0) {
            $data = $q->row();
            if ($data->star == null) {
                $data->comment = 0;
                $data->star = 0;
            }
            return $data;
        }else{
            $data = new StdClass;
            $data->comment = 0;
            $data->star = 0;
            return $data;
        }

    }
}
?>