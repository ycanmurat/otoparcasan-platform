<?defined('BASEPATH') OR exit('No direct script access allowed');
class Product extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->getUserRememberCheck();
		$this->load->model('Product_model','PM');
		$this->load->model('Api_model','Api');
		$this->load->model('Category_model','CM');
		$this->load->model('Dat_model','dat');
        $this->load->model('Service_model','SM');
        /*
        if (is_null($this->session->userdata('userInfo')) || is_null(@get_cookie('selectedCar'))) {
            $this->output->cache(10);
        }
        */
	}

	public function details($slug = "")
	{
		$data = new stdClass();
		$data = $this->Global_model->getAllInsert();
        $data->dat = new StdClass;

        $data->dat->types = $this->SM->getCarTypes();
        $data->faq =  $this->PM->getFaqs();
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

			$data->carName = $data->carDetail->Vehicle->ManufacturerName.' '.carNameExplode($data->carDetail->Vehicle->BaseModelName) ?? '';
		}else{
			$data->selectedCar = false;
			$data->carName = '';
		}

        $data->faborite = 0;

		$data->userData = $this->getUserData();
        if ($data->userData != false) {
            $data->garagge = $this->CM->getUserGarrage($data->userData->id);

            if ($data->garagge != false) {
                usort($data->garagge, function($a, $b) {
                    return $a->detail <=> $b->detail;
                });
            }else{
                $data->garagge = array();
            }
        }
        //seçili araç garajdamı
        $data->garrageUnVisible = 0;
        if ((null !== ($this->input->cookie('selectedCar'))) && $data->userData != false) {
            $carInGarrrage = 0;
            foreach ($data->garagge as $key => $val) {
                if ($val->car_id == $selectedCar->carId && $val->construction_time == $selectedCar->consTime) {
                    $carInGarrrage++;
                }
            }
            if ($carInGarrrage>0) {
                $data->garrageUnVisible = 1;
            }
        }

        $data->cargo = $this->CM->getCargoPrice();
        if ($this->input->get('o') == 'f') {
            $data->product = $this->Api_model->getProductsDetailByKodCargoTime($slug);
        }else{
            $data->product = $this->Api_model->getProductsDetailByKod($slug);
        }

        if ($data->product == false) {
            $this->output->set_status_header('404');
            $this->load->view('head',$data);
            $this->load->view('header');
            $this->load->view('404');
            $this->load->view('footer');
        }else{
    		$data->categories = $this->CM->getCategoryByKod($data->product->KOD_1,$data->product->KOD_3);
    		foreach ($data->categories as $key => $val) {
    			if ($val->category_id == $data->product->KOD_1) {
    				$data->otherCategori = (object)array_merge((array)$val,(array)$this->Api->getTopCategoriDetailById($val->category_id));
    			}else{
    				$data->selectedCategori = (object)array_merge((array)$val,(array)$this->Api->getSubCategoriDetailById($val->category_id));
    			}
    		}
    		if ($data->product == array()) {
    			prex(404);
    		}else{
    			$marka = [];
    			$tedarik = [];

    			$marka[] = $data->product->GRUP_KODU;
    			$tedarik[] = $data->product->CARI_KOD;

    			$markaTedarik = $this->CM->getMarkaTedarik($marka,$tedarik);

    			foreach ($markaTedarik->marka as $key3 => $val3) {
    				if ($data->product->GRUP_KODU == $val3->grup_kod) {
    					$data->product->yerli = $val3->yerli;
    					$data->product->markaImage = $val3->image;
    				}
    			}
    			foreach ($markaTedarik->tedarikci as $key3 => $val3) {
    				if ($data->product->CARI_KOD == $val3->cari_kod) {
    					$data->product->kar_orani = $val3->oran;
    				}
    			}

    			$komisyonlu = (($data->product->fiyatTL/100*$data->product->kar_orani)+$data->product->fiyatTL);
    			$data->product->fiyatTL = (($komisyonlu/100*$data->product->KDV_ORANI)+$komisyonlu);

    			if (empty($data->product->KULL2S)) {
                    $data->product->teslimatGun = 99;
                    $teslimat = 99;
                }else{
                    if ($data->product->KULL2S == $data->product->hKULL1S) {
                        $data->product->teslimatGun = (int)$data->product->hKULL1N;
                        $teslimat = (int)$data->product->hKULL1N;
                    }elseif ($data->product->KULL2S == $data->product->hKULL2S) {
                        $data->product->teslimatGun = (int)$data->product->hKULL2N;
                        $teslimat = (int)$data->product->hKULL2N;
                    }elseif ($data->product->KULL2S == $data->product->hKULL3S) {
                        $data->product->teslimatGun = (int)$data->product->hKULL3N;
                        $teslimat = (int)$data->product->hKULL3N;
                    }elseif ($data->product->KULL2S == $data->product->hKULL4S) {
                        $data->product->teslimatGun = (int)$data->product->hKULL4N;
                        $teslimat = (int)$data->product->hKULL4N;
                    }elseif ($data->product->KULL2S == $data->product->hKULL5S) {
                        $data->product->teslimatGun = (int)$data->product->hKULL5N;
                        $teslimat = (int)$data->product->hKULL5N;
                    }elseif ($data->product->KULL2S == $data->product->hKULL6S) {
                        $data->product->teslimatGun = (int)$data->product->hKULL6N;
                        $teslimat = (int)$data->product->hKULL6N;
                    }elseif ($data->product->KULL2S == $data->product->hKULL7S) {
                        $data->product->teslimatGun = (int)$data->product->hKULL7N;
                        $teslimat = (int)$data->product->hKULL7N;
                    }elseif ($data->product->KULL2S == $data->product->hKULL8S) {
                        $data->product->teslimatGun = (int)$data->product->hKULL8N;
                        $teslimat = (int)$data->product->hKULL8N;
                    }else{
                        $data->product->teslimatGun = 5;
                        $teslimat = 99;
                    }
                }
                
                if (date('H')+3 >= 14) {
                    $teslimat++;
                }
                
                $data->product->kargoGunu = $this->CM->getTelimatDate($teslimat);

    			//adet takım
    			if ($data->product->OLCU_BR1 == 'AD') {
    				$data->product->birimAdet = (int)$data->product->PAYDA_1;
    			}elseif ($data->product->OLCU_BR1 == 'TK') {
    				$data->product->birimAdet = (int)$data->product->PAY_1;
    			}elseif ($data->product->OLCU_BR1 == 'ad') {
    				$data->product->birimAdet = (int)$data->product->PAYDA_1;
    			}elseif ($data->product->OLCU_BR1 == 'tk') {
    				$data->product->birimAdet = (int)$data->product->PAY_1;
    			}

    			if (date('H')+3 >= 14) {
    				$teslimat++;
    			}
                
    			$data->product->kargoGunu = $this->CM->getTelimatDate($teslimat);
    			
    			$data->title = mb_ucwords(replaceStringProblemsReverse($data->product->STOK_ADI),'UTF-8').' | Otoparçasan.com';

    			$data->detail = $this->PM->getKod3Detail($data->product->KOD_3);

    			$data->product->discount =  $this->CM->getDiscountByProduct(array('marka'=>$data->product->GRUP_KODU,'cari'=>$data->product->CARI_KOD,'ustKategori'=>$data->product->KOD_1,'anaKategori'=>$data->product->KOD_2,'altKategori'=>$data->product->KOD_3));
    			$data->comments = $this->PM->getComments($data->product->url);

    			$questions = $this->PM->getQuestions($data->product->url);
    			$answers = $this->PM->getAnswers($data->product->url);
    			$questionArray = [];
    			foreach ($questions as $key => $qVal) {
    				$questionArray[$key]['question'] = $qVal->question;
    				$questionArray[$key]['name_surname'] = $qVal->name_surname;
    				$questionArray[$key]['added_time'] = $qVal->added_time;
    				foreach ($answers as $key_ => $aVal) {
    					if ($aVal->question_id == $qVal->id) {
    						$questionArray[$key]['answers'][$key_]['answer'] = $aVal->answer;
    						$questionArray[$key]['answers'][$key_]['added_time'] = $aVal->added_time;
    					}
    				}
    			}

                $data->favorite = 0;
                if ($data->userData != false) {
                    $data->favorite = $this->PM->isFavorite($data->product->url,$data->userData->id);
                }

                $data->reminding = 0;
                if ($data->userData != false) {
                    $data->reminding = $this->PM->isReminding($data->product->url,$data->userData->id);
                }

                /*
                if (isset($data->carDetail)) {
                    $data->carPartMatch = $this->CM->getOemFromCar($data->product->KOD_3,$data->carDetail->Vehicle->DatECode,$data->carDetail->Vehicle->ConstructionTime,$data->product->oems);
                }else{
                    $data->carPartMatch = 0;
                }
                */

                //prex($data->product);
                $oems = explode('|', $data->product->oems);
                $data->oems = implode(', ', $oems);

    			$data->allQuestionAndAnswers = array_to_object($questionArray);
    			$this->load->view('head',$data);
    			$this->load->view('header');
    			$this->load->view('product-detail');
    			$this->load->view('footer');
    		}    
        }
	}	
}