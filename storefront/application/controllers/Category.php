<?php 
/**
 * 
 */
class Category extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Category_model','CM');
		$this->load->model('Dat_model','dat');
        $this->load->model('Api_model','Api');
        $this->load->model('Service_model','SM');
        /*
        if (is_null($this->session->userdata('userInfo')) || is_null(@get_cookie('selectedCar'))) {
            $this->output->cache(10);
        }
        */
	}

	public function index($slug = '',$slug2 = '') // ilk aşama
	{
		$data = $this->Global_model->getAllInsert();
        $data->garrageUnVisible = 0;

        $data->dat = new StdClass;
        $data->dat->types = $this->SM->getCarTypes();

		if ($slug == '' AND $slug2 == '') {

            //araç seçiliyse araç detayları
            if (null !== ($this->input->cookie('selectedCar'))) {
				$data->selectedCar = true;
				$selectedCar = json_decode($this->input->cookie('selectedCar'));
                $data->carDetail = $this->dat->getCarDetail($selectedCar);
				$data->carDetailDb = $this->CM->getCarDetail($selectedCar);
			}else{
				$data->selectedCar = false;
			}

            //garajımdaki araçlar
			$data->userData = $this->getUserData();
			if ($data->userData != false) {
				$data->garagge = $this->CM->getUserGarrage($data->userData->id);

                if ($data->garagge != false) {
                    usort($data->garagge, function($a, $b) {
                        return $a->detail <=> $b->detail;
                    });
                }
			}

            //seçili araç garajdamı
            if ((null !== ($this->input->cookie('selectedCar'))) && $data->userData != false) {
                $carInGarrrage = 0;
                if ($data->garagge != false) {
                    foreach ($data->garagge as $key => $val) {
                        if ($val->car_id == $selectedCar->carId && $val->construction_time == $selectedCar->consTime) {
                            $carInGarrrage++;
                        }
                    }
                    if ($carInGarrrage>0) {
                        $data->garrageUnVisible = 1;
                    }
                }
            }

			$data->title = 'Yedek Parçalar | Otoparçasan.com';
			$data->desc = 'Yedek Parçalar';

			$this->load->view('head',$data);
			$this->load->view('header');
			$this->load->view('category_main_list');
			$this->load->view('footer');

		}elseif($slug2 == '' AND $slug != ''){// 2. aşama

            //araç seçiliyse araç detayları
			if (null !== ($this->input->cookie('selectedCar'))) {
				$data->selectedCar = true;
				$selectedCar = json_decode($this->input->cookie('selectedCar'));
				$data->carDetail = $this->dat->getCarDetail($selectedCar);
                $data->carDetailDb = $this->CM->getCarDetail($selectedCar);
			}else{
				$data->selectedCar = false;
			}

            //garajımdaki araçlar
			$data->userData = $this->getUserData();
            if ($data->userData != false) {
                $data->garagge = $this->CM->getUserGarrage($data->userData->id);

                if ($data->garagge != false) {
                    usort($data->garagge, function($a, $b) {
                        return $a->detail <=> $b->detail;
                    });
                }
            }

            //seçili araç garajdamı
            if ((null !== ($this->input->cookie('selectedCar'))) && $data->userData != false) {
                $carInGarrrage = 0;
                if ($data->garagge != false) {
                    foreach ($data->garagge as $key => $val) {
                        if ($val->car_id == $selectedCar->carId && $val->construction_time == $selectedCar->consTime) {
                            $carInGarrrage++;
                        }
                    }
                    if ($carInGarrrage>0) {
                        $data->garrageUnVisible = 1;
                    }
                }
            }

			$data->detail = $this->CM->getCategoryBySlug($slug,$data->categoryDetails);
            if ($data->detail == false) {
                $this->output->set_status_header('404');
                $this->load->view('head',$data);
                $this->load->view('header');
                $this->load->view('404');
                $this->load->view('footer');
            }else{
                $data->title = replaceStringProblemsReverse($data->detail->topGroup->GRUP_ISIM).' | Otoparçasan.com';
                $data->desc = $data->detail->topDetail->desc;
                //prex($data->detail);

                $this->load->view('head',$data);
                $this->load->view('header');
                $this->load->view('category_alt_list');
                $this->load->view('footer');
            }


		}else{// 3. aşama
            
            $data->filterData = new StdClass;
            $data->filterData->o = 'p';
            $data->filterData->y = array();
            $data->filterData->m = array();
            $data->filterData->p = 1;
            if ($this->input->get('o')) {
                $data->filterData = new StdClass;
                $data->filterData->o = $this->input->get('o',true);
                $data->filterData->y = $this->input->get('y',true);
                $data->filterData->m = $this->input->get('m',true);
                $data->filterData->p = $this->input->get('p',true);

                if (empty($data->filterData->y)) {
                    $data->filterData->y = array();
                }
                if (empty($data->filterData->m)) {
                    $data->filterData->m = array();
                }
            }

			$data->categories = $this->CM->getCategoryName($slug,$slug2);
            if (empty($data->categories)) {
                $this->output->set_status_header('404');
                $this->load->view('head',$data);
                $this->load->view('header');
                $this->load->view('404');
                $this->load->view('footer');
            }else{
    			if (null !== ($this->input->cookie('selectedCar'))) {
    				$data->selectedCar = true;
    				$selectedCar = json_decode($this->input->cookie('selectedCar'));
    				$data->carDetail = $this->dat->getCarDetail($selectedCar);
                    $data->carDetailDb = $this->CM->getCarDetail($selectedCar);
    				$data->carImage = $this->getCarImage($data->carDetail->Vehicle->VehicleType,$data->carDetail->Vehicle->Manufacturer,$data->carDetail->Vehicle->BaseModel);
                    $data->carImage = json_decode($data->carImage,true);
                    if ($data->carImage == '') {
                        $data->carImage = array('','','');
                    }else{
                        ksort($data->carImage);
                    }
    				$data->carName = $data->carDetail->Vehicle->ManufacturerName.' '.carNameExplode($data->carDetail->Vehicle->BaseModelName).' ' ?? '';
    			}else{
    				$data->selectedCar = false;
    				$data->carName = '';
    			}
    			
    			$data->userData = $this->getUserData();
                if ($data->userData != false) {
                    $data->garagge = $this->CM->getUserGarrage($data->userData->id);

                    if ($data->garagge != false) {
                        usort($data->garagge, function($a, $b) {
                            return $a->detail <=> $b->detail;
                        });
                    }
                }

                if ((null !== ($this->input->cookie('selectedCar'))) && $data->userData != false) {
                    $carInGarrrage = 0;
                    if ($data->garagge != false) {
                        foreach ($data->garagge as $key => $val) {
                            if ($val->car_id == $selectedCar->carId && $val->construction_time == $selectedCar->consTime) {
                                $carInGarrrage++;
                            }
                        }
                        if ($carInGarrrage>0) {
                            $data->garrageUnVisible = 1;
                        }
                    }
                }

                $data->menu1 = $slug;
                $data->menu2 = $slug2;
                $data->cargo = $this->CM->getCargoPrice();

                //breadcramp
                foreach ($data->categories as $key => $val) {
                    if ($val->slug == $slug2) {
                        $data->selectedCategori = (object)array_merge((array)$val,(array)$this->Api->getSubCategoriDetailById($val->category_id));
                    }else{
                        $data->otherCategori = (object)array_merge((array)$val,(array)$this->Api->getTopCategoriDetailById($val->category_id));
                    }
                }

                $data->title = replaceStringProblemsReverse($data->selectedCategori->GRUP_ISIM).' | Otoparçasan.com';
                $data->desc = $data->selectedCategori->desc;
                
                if ($data->selectedCar != false) {//araç seçiliyse
                    $oemData = $this->CM->getProductByCategories($slug2,$selectedCar->carId,$selectedCar->consTime);
                    $data->oems = (object)$oemData->oems;
                    $data->oemDesc = $oemData->aciklama;

                    $data->products = array();

                    if ($data->oems != false) {
                        $urunyok = array();
                        $oemler = (array)$data->oems;
                        foreach ($oemler as $key => $val) {
                            if (!isset($data->oemProducts[$val])) {
                                if (isset($data->oemDesc[$val])) {
                                    $urunyok[] = array('oem' => $val,'name' => $data->oemDesc[$val]);
                                }else{
                                    $urunyok[] = array('oem' => $val);
                                }
                            }
                        }
                        $this->CM->addOemFault($urunyok);

                        if ($data->filterData->o == 'p') {
                            $products = $this->Api->getProductsByOem((array)$data->oems);
                        }else{
                            $products = $this->Api->getProductsByOemFilter((array)$data->oems);
                        }

                        $data->oemProducts = array();
                        
                        foreach ($data->oems as $key => $val) {
                            foreach ($products as $key2 => $val2) {
                                if (!empty($val2)) {
                                    if (strstr($val2->oems, $val)) {
                                        if (!isset($data->oemProducts[$val])) {
                                            $data->oemProducts[$val] = '';
                                        }
                                        $data->oemProducts[$val] .= $val2->STOK_KODU.' , ';
                                    }
                                }
                            }
                        }

                        foreach ($products as $key2 => $val2) {
                            if (!empty($val2)) {
                                $data->products[$val2->KOD_3.'-'.$val2->KOD_4][] = $val2;
                            }
                        }

                        $marka = [];
                        $tedarik = [];
                        foreach ($data->products as $key => $val) {
                            foreach ($val as $key2 => $val2) {
                                $marka[] = $val2->GRUP_KODU;
                                $tedarik[] = $val2->CARI_KOD;
                            }
                        }

                        if ($marka != array() AND $tedarik != array()) {
                            $markaTedarik = $this->CM->getMarkaTedarik(array_unique($marka),array_unique($tedarik));

                            foreach ($data->products as $key => $val) {
                                foreach ($val as $key2 => $val2) {
                                    $i = 0;
                                    foreach ($markaTedarik->marka as $key3 => $val3) {
                                        if ($val2->GRUP_KODU == $val3->grup_kod) {
                                            $data->products[$key][$key2]->yerli = $val3->yerli;
                                            $data->products[$key][$key2]->markaImage = $val3->image;
                                            $i++;
                                        }
                                    }
                                    if ($i == 0) {
                                            $data->products[$key][$key2]->yerli = 0;
                                            $data->products[$key][$key2]->markaImage = '';
                                    }
                                    $i = 0;
                                    foreach ($markaTedarik->tedarikci as $key3 => $val3) {
                                        if ($val2->CARI_KOD == $val3->cari_kod) {
                                            $data->products[$key][$key2]->kar_orani = $val3->oran;
                                            $i++;
                                        }
                                    }
                                    if ($i == 0) {
                                        $data->products[$key][$key2]->kar_orani = 50;
                                    }
                                }
                            }
                        }

                        $brands = array();
                        $montaj = array();
                        foreach ($data->products as $key => $val) {
                            foreach ($val as $key2 => $val2) {
                                if (empty($val2->KULL2S)) {
                                    $data->products[$key][$key2]->teslimatGun = 99;
                                    $teslimat = 99;
                                }else{
                                    if ($val2->KULL2S == $val2->hKULL1S) {
                                        $data->products[$key][$key2]->teslimatGun = (int)$val2->hKULL1N;
                                        $teslimat = (int)$val2->hKULL1N;
                                    }elseif ($val2->KULL2S == $val2->hKULL2S) {
                                        $data->products[$key][$key2]->teslimatGun = (int)$val2->hKULL2N;
                                        $teslimat = (int)$val2->hKULL2N;
                                    }elseif ($val2->KULL2S == $val2->hKULL3S) {
                                        $data->products[$key][$key2]->teslimatGun = (int)$val2->hKULL3N;
                                        $teslimat = (int)$val2->hKULL3N;
                                    }elseif ($val2->KULL2S == $val2->hKULL4S) {
                                        $data->products[$key][$key2]->teslimatGun = (int)$val2->hKULL4N;
                                        $teslimat = (int)$val2->hKULL4N;
                                    }elseif ($val2->KULL2S == $val2->hKULL5S) {
                                        $data->products[$key][$key2]->teslimatGun = (int)$val2->hKULL5N;
                                        $teslimat = (int)$val2->hKULL5N;
                                    }elseif ($val2->KULL2S == $val2->hKULL6S) {
                                        $data->products[$key][$key2]->teslimatGun = (int)$val2->hKULL6N;
                                        $teslimat = (int)$val2->hKULL6N;
                                    }elseif ($val2->KULL2S == $val2->hKULL7S) {
                                        $data->products[$key][$key2]->teslimatGun = (int)$val2->hKULL7N;
                                        $teslimat = (int)$val2->hKULL7N;
                                    }elseif ($val2->KULL2S == $val2->hKULL8S) {
                                        $data->products[$key][$key2]->teslimatGun = (int)$val2->hKULL8N;
                                        $teslimat = (int)$val2->hKULL8N;
                                    }else{
                                        $data->products[$key][$key2]->teslimatGun = 5;
                                        $teslimat = 99;
                                    }
                                }
                                
                                if (date('H')+3 >= 14) {
                                    $teslimat++;
                                }
                                
                                $data->products[$key][$key2]->kargoGunu = $this->CM->getTelimatDate($teslimat);

                                //adet takım
                                if ($val2->OLCU_BR1 == 'AD') {
                                    $data->products[$key][$key2]->birimAdet = (int)$val2->PAYDA_1;
                                }elseif ($val2->OLCU_BR1 == 'TK') {
                                    $data->products[$key][$key2]->birimAdet = (int)$val2->PAY_1;
                                }elseif ($val2->OLCU_BR1 == 'ad') {
                                    $data->products[$key][$key2]->birimAdet = (int)$val2->PAYDA_1;
                                }elseif ($val2->OLCU_BR1 == 'tk') {
                                    $data->products[$key][$key2]->birimAdet = (int)$val2->PAY_1;
                                }

                                //indirim
                                $data->products[$key][$key2]->discount =  $this->CM->getDiscountByProduct(array('marka'=>$val2->GRUP_KODU,'cari'=>$val2->CARI_KOD,'ustKategori'=>$val2->KOD_1,'anaKategori'=>$val2->KOD_2,'altKategori'=>$val2->KOD_3));

                                //filrtreleme için verileri say
                                $brands[] = $val2->GRUP_KODU;
                                if (!empty(trim($val2->KOD_4)) && $val2->KOD_4 != 0) {
                                    $montaj[] = $val2->KOD_4;
                                }

                                $data->products[$key][$key2]->comments = $this->CM->getStars($val2->url);
                            }
                        }


                        //fiyat
                        foreach ($data->products as $key => $val) {
                            foreach ($val as $key2 => $val2) {
                                $komisyonlu = (($val2->fiyatTL/100*$val2->kar_orani)+$val2->fiyatTL);
                                $data->products[$key][$key2]->fiyatTL = (($komisyonlu/100*$val2->KDV_ORANI)+$komisyonlu);

                                if ($data->products[$key][$key2]->discount > 0) {
                                    $data->products[$key][$key2]->satisFiyati = $data->products[$key][$key2]->fiyatTL - ($data->products[$key][$key2]->fiyatTL*$data->products[$key][$key2]->discount/100);
                                }else{
                                    $data->products[$key][$key2]->satisFiyati = $data->products[$key][$key2]->fiyatTL;
                                }
                            }
                        }

                        if ($data->products != array()) {
                            $data->brands = array_unique($brands);
                            $data->montaj = array_unique($montaj);

                            $data->brands = $this->CM->getBrandsNames($data->brands);
                            if ($data->montaj != array()) {
                                $data->montaj = $this->CM->getMontajNames($data->montaj);
                            }

                            foreach ($data->brands as $key => $val) {
                                $i = 0;
                                foreach ($brands as $key2 => $val2) {
                                    if ($val->GRUP_KOD == $val2) {
                                        $i++;
                                    }
                                }
                                $data->brands[$key]->count = $i;
                            }

                            foreach ($data->montaj as $key => $val) {
                                $i = 0;
                                foreach ($montaj as $key2 => $val2) {
                                    if ($val->GRUP_KOD == $val2) {
                                        $i++;
                                    }
                                }
                                $data->montaj[$key]->count = $i;
                            }
                        }else{
                            $data->brands = array();
                            $data->montaj = array();
                        }

                        if ($data->filterData->o == 'p') {
                            foreach ($data->products as $key => $val) {
                                $var = array();
                                $yok = array();
                                foreach ($val as $key2 => $val2) {
                                    if ($val2->KULL2N != 1 OR $val2->KULL1S != 0) {
                                        $yok[] = $val2;
                                    }else{
                                        $var[] = $val2;
                                    }
                                }

                                usort($var, function($a, $b) {
                                    return $a->satisFiyati <=> $b->satisFiyati;
                                });
                                usort($yok, function($a, $b) {
                                    return $a->satisFiyati <=> $b->satisFiyati;
                                });

                                $data->products[$key] = array_merge($var,$yok);
                            }
                        }else{
                            foreach ($data->products as $key => $val) {
                                $var = array();
                                $yok = array();
                                foreach ($val as $key2 => $val2) {
                                    if ($val2->stok == 1) {
                                        $var[$val2->teslimatGun][] = $val2;
                                    }else{
                                        $yok[] = $val2;
                                    }
                                }
                                ksort($var);

                                foreach ($var as $key2 => $val2) {
                                    usort($val2, function($a, $b) {
                                        return $a->satisFiyati <=> $b->satisFiyati;
                                    });
                                    $var[$key2] = $val2;
                                }

                                $aryNew = array();
                                foreach ($var as $key2 => $val2) {
                                    foreach ($val2 as $key3 => $val3) {
                                        $aryNew[] = $val3;
                                    }
                                }

                                usort($yok, function($a, $b) {
                                    return $a->satisFiyati <=> $b->satisFiyati;
                                });

                                $data->products[$key] = array_merge($aryNew,$yok);
                            }
                        }

                        //filtreleme
                        if ($data->filterData->y != array()) {
                            $newProduct = array();
                            foreach ($data->products as $key => $val) {
                                foreach ($val as $key2 => $val2) {
                                    foreach ($data->filterData->y as $key3 => $val3) {
                                        if ($val3 == $val2->KOD_4) {
                                            $newProduct[$key][$key2] = $val2;
                                        }
                                    }
                                }
                            }
                            $data->products = $newProduct;
                        }

                        if ($data->filterData->m != array()) {
                            $newProduct = array();
                            foreach ($data->products as $key => $val) {
                                foreach ($val as $key2 => $val2) {
                                    foreach ($data->filterData->m as $key3 => $val3) {
                                        if ($val3 == $val2->GRUP_KODU) {
                                            $newProduct[$key][$key2] = $val2;
                                        }
                                    }
                                }
                            }
                            $data->products = $newProduct;
                        }

                        foreach ($data->products as $key => $productGroup) {
                            $data->products[$key] = array_values($productGroup);
                        }
                    }else{
                        $data->oems = array();
                        $data->products = array();
                    }

                    $data->products = array_values($data->products);

                    usort($data->brands, function($a, $b) {
                        return $a->GRUP_ISIM <=> $b->GRUP_ISIM;
                    });
                    usort($data->montaj, function($a, $b) {
                        return $a->GRUP_ISIM <=> $b->GRUP_ISIM;
                    });

                    $this->load->view('head',$data);
                    $this->load->view('header');
                    $this->load->view('listing_car_selected');
                    $this->load->view('footer');

                }else{ // araç seçili değilse
                    $data->kod3 = $data->selectedCategori->category_id;
                    $data->products = $this->Api->getProductsByKod3Filter($data->kod3,$data->filterData);
                    $markaMontaj = $this->Api->kod3Filter($data->kod3,$data->filterData);
                    $data->montaj = $markaMontaj->montaj;
                    $data->brands = $markaMontaj->marka;
                    $marka = [];
                    $tedarik = [];
                    foreach ($data->products as $key => $val) {
                        $marka[] = $val->GRUP_KODU;
                        $tedarik[] = $val->CARI_KOD;
                    }

                    if ($marka != array() AND $tedarik != array()) {
                        $markaTedarik = $this->CM->getMarkaTedarik(array_unique($marka),array_unique($tedarik));

                        foreach ($data->products as $key => $val) {
                            $i = 0;
                            foreach ($markaTedarik->marka as $key3 => $val3) {
                                if ($val->GRUP_KODU == $val3->grup_kod) {
                                    $data->products[$key]->yerli = $val3->yerli;
                                    $data->products[$key]->markaImage = $val3->image;
                                    $i++;
                                }
                            }
                            if ($i == 0) {
                                    $data->products[$key]->yerli = 0;
                                    $data->products[$key]->markaImage = '';
                            }
                            $i = 0;
                            foreach ($markaTedarik->tedarikci as $key3 => $val3) {
                                if ($val->CARI_KOD == $val3->cari_kod) {
                                    $data->products[$key]->kar_orani = $val3->oran;
                                    $i++;
                                }
                            }
                            if ($i == 0) {
                                $data->products[$key]->kar_orani = 50;
                            }
                        }


                        foreach ($data->products as $key => $val) {
                            if (empty($val->KULL2S)) {
                                $data->products[$key]->teslimatGun = 5;
                                $teslimat = 5;
                            }else{
                                if ($val->KULL2S == $val->hKULL1S) {
                                    $data->products[$key]->teslimatGun = (int)$val->hKULL1N;
                                    $teslimat = (int)$val->hKULL1N;
                                }elseif ($val->KULL2S == $val->hKULL2S) {
                                    $data->products[$key]->teslimatGun = (int)$val->hKULL2N;
                                    $teslimat = (int)$val->hKULL2N;
                                }elseif ($val->KULL2S == $val->hKULL3S) {
                                    $data->products[$key]->teslimatGun = (int)$val->hKULL3N;
                                    $teslimat = (int)$val->hKULL3N;
                                }elseif ($val->KULL2S == $val->hKULL4S) {
                                    $data->products[$key]->teslimatGun = (int)$val->hKULL4N;
                                    $teslimat = (int)$val->hKULL4N;
                                }elseif ($val->KULL2S == $val->hKULL5S) {
                                    $data->products[$key]->teslimatGun = (int)$val->hKULL5N;
                                    $teslimat = (int)$val->hKULL5N;
                                }elseif ($val->KULL2S == $val->hKULL6S) {
                                    $data->products[$key]->teslimatGun = (int)$val->hKULL6N;
                                    $teslimat = (int)$val->hKULL6N;
                                }elseif ($val->KULL2S == $val->hKULL7S) {
                                    $data->products[$key]->teslimatGun = (int)$val->hKULL7N;
                                    $teslimat = (int)$val->hKULL7N;
                                }elseif ($val->KULL2S == $val->hKULL8S) {
                                    $data->products[$key]->teslimatGun = (int)$val->hKULL8N;
                                    $teslimat = (int)$val->hKULL8N;
                                }else{
                                    $data->products[$key]->teslimatGun = 5;
                                    $teslimat = 99;
                                }
                            }
                            
                            if (date('H')+3 >= 14) {
                                $teslimat++;
                            }
                            
                            $data->products[$key]->kargoGunu = $this->CM->getTelimatDate($teslimat);

                            //adet takım
                            if ($val->OLCU_BR1 == 'AD') {
                                $data->products[$key]->birimAdet = (int)$val->PAYDA_1;
                            }elseif ($val->OLCU_BR1 == 'TK') {
                                $data->products[$key]->birimAdet = (int)$val->PAY_1;
                            }elseif ($val->OLCU_BR1 == 'ad') {
                                $data->products[$key]->birimAdet = (int)$val->PAYDA_1;
                            }elseif ($val->OLCU_BR1 == 'tk') {
                                $data->products[$key]->birimAdet = (int)$val->PAY_1;
                            }

                            //indirim
                            $data->products[$key]->discount =  $this->CM->getDiscountByProduct(array('marka'=>$val->GRUP_KODU,'cari'=>$val->CARI_KOD,'ustKategori'=>$val->KOD_1,'anaKategori'=>$val->KOD_2,'altKategori'=>$val->KOD_3));

                            //yorum yıldız
                            $data->products[$key]->comments = $this->CM->getStars($val->url);
                        }

                        //fiyat
                        foreach ($data->products as $key => $val) {
                            $komisyonlu = (($val->fiyatTL/100*$val->kar_orani)+$val->fiyatTL);
                            $data->products[$key]->fiyatTL = (($komisyonlu/100*$val->KDV_ORANI)+$komisyonlu);

                            if ($data->products[$key]->discount > 0) {
                                $data->products[$key]->satisFiyati = $data->products[$key]->fiyatTL - ($data->products[$key]->fiyatTL*$data->products[$key]->discount/100);
                            }else{
                                $data->products[$key]->satisFiyati = $data->products[$key]->fiyatTL;
                            }
                        }

                        if ($data->filterData->o == 'p') {
                            $var = array();
                            $yok = array();
                            foreach ($data->products as $key => $val) {
                                if ($val->stok > 0) {
                                    $var[] = $val;
                                }else{
                                    $yok[] = $val;
                                }
                            }

                            usort($var, function($a, $b) {
                                return $a->satisFiyati <=> $b->satisFiyati;
                            });
                            usort($yok, function($a, $b) {
                                return $a->satisFiyati <=> $b->satisFiyati;
                            });

                            $data->products = array_merge($var,$yok);
                        }else{
                            $var = array();
                            $yok = array();

                            foreach ($data->products as $key => $val) {
                                if ($val->stok == 1) {
                                    $var[$val->teslimatGun][] = $val;
                                }else{
                                    $yok[] = $val;
                                }
                            }
                            ksort($var);

                            foreach ($var as $key2 => $val2) {
                                usort($val2, function($a, $b) {
                                    return $a->satisFiyati <=> $b->satisFiyati;
                                });
                                $var[$key2] = $val2;
                            }

                            $aryNew = array();
                            foreach ($var as $key2 => $val2) {
                                foreach ($val2 as $key3 => $val3) {
                                    $aryNew[] = $val3;
                                }
                            }

                            usort($yok, function($a, $b) {
                                return $a->satisFiyati <=> $b->satisFiyati;
                            });

                            $data->products = array_merge($aryNew,$yok);
                        }
                        
                        usort($data->brands, function($a, $b) {
                            return $a->GRUP_ISIM <=> $b->GRUP_ISIM;
                        });
                        
                        usort($data->montaj, function($a, $b) {
                            return $a->GRUP_ISIM <=> $b->GRUP_ISIM;
                        });
                    }else{
                        $data->products = array();
                    }

                    $data->products = array_values($data->products);

                    //prex($data->products);

                    $this->load->view('head',$data);
                    $this->load->view('header');
                    $this->load->view('listing_all');
                    $this->load->view('footer');
                }
    		}
        }
	}
}
?>