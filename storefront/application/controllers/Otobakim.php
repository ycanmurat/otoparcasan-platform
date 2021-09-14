<?php 
/**
 * 
 */
class Otobakim extends Core_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Dat_model','dat');
        $this->load->model('Category_model','CM');
        $this->load->model('Service_model','SM');
        $this->load->model('Api_model','api');
    }

    public function index($url = '')
    {
        $data = $this->Global_model->getAllInsert();
        $data->garrageUnVisible = 0;
        $data->cargo = $this->CM->getCargoPrice();
        $data->title = 'Oto Bakım ve Yağlar | Otoparçasan.com';
        $data->desc = 'Oto Bakım ve Yağlar';


        $data->filterData = new StdClass;
        $data->filterData->o = 'p';
        $data->filterData->m = array();
        $data->filterData->y = array();
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
        
        if ($url == '') {
            $data->kod3 = '9203';
        }else{//buraya else if getirilebilir veya kod 3 direk sorgulanabilir eğer boş dönerse 404 basılacak
            prex(1);
            //burada url yi kod3 e çevircez
        }


        if ($this->input->get()) { //filtre data
            $data->filterData = new StdClass;
            $data->filterData->o = $this->input->get('o',true);
            $data->filterData->y = $this->input->get('y',true);
            $data->filterData->m = $this->input->get('m',true);

            if (empty($data->filterData->y)) {
                $data->filterData->y = array();
            }
            if (empty($data->filterData->m)) {
                $data->filterData->m = array();
            }
        }

        if (null !== ($this->input->cookie('selectedCar'))) { // seçili araç varmı
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
        }else{
            $data->selectedCar = false;
        }

        $data->userData = $this->getUserData();
        if ($data->userData != false) { // garaj sırlama
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

        $data->bakim_menus = $this->api->getOtoBakimVeYaglar();
        $data->bakim_menus = $this->Global_model->getCategoryDetail($data->bakim_menus,$data->categoryDetails)[0] ?? array();

        if ($data->selectedCar != false) { //araç seçiliyse
            $data->products = array();
            $products = $this->api->getProductsByKod3($data->kod3,$data->filterData);// Araç Eşleştirmeli getirilecek

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
            }

            $brands = array();
            $montaj = array();
            foreach ($data->products as $key => $val) {
                foreach ($val as $key2 => $val2) {

                    //marka tedarikçi
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
                    //marka tedarikçi Sonu

                    //teslimat günü
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
                    $montaj[] = $val2->KOD_4;

                    //fiyat
                    $komisyonlu = (($val2->fiyatTL/100*$val2->kar_orani)+$val2->fiyatTL);
                    $data->products[$key][$key2]->fiyatTL = (($komisyonlu/100*$val2->KDV_ORANI)+$komisyonlu);
                }
            }

            //filtreleme
            if ($data->products != array()) {
                $data->brands = array_unique($brands);
                $data->montaj = array_unique($montaj);

                $data->brands = $this->CM->getBrandsNames($data->brands);
                $data->montaj = $this->CM->getMontajNames($data->montaj);

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

            if ($data->filterData->o == 'p') { //sıralama fiyatsa
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
                        return $a->fiyatTL <=> $b->fiyatTL;
                    });
                    usort($yok, function($a, $b) {
                        return $a->fiyatTL <=> $b->fiyatTL;
                    });

                    $data->products[$key] = array_merge($var,$yok);
                }
            }else{ // sıralama öncelikse
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
                            return $a->fiyatTL <=> $b->fiyatTL;
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
                        return $a->fiyatTL <=> $b->fiyatTL;
                    });

                    $data->products[$key] = array_merge($aryNew,$yok);
                }
            }

            //filtreleme marka
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

            $data->products = array_values($data->products);

            $this->load->view('head',$data);
            $this->load->view('header');
            $this->load->view('listing_otobakim_car_selected');
            $this->load->view('footer');
        }else{ // araç seçili değilse
            $data->products = $this->api->getProductsByKod3Filter($data->kod3,$data->filterData);
            //prex($data->products);
            $markaMontaj = $this->api->kod3Filter($data->kod3,$data->filterData);
            
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
                }

                //fiyat
                foreach ($data->products as $key => $val) {
                    $komisyonlu = (($val->fiyatTL/100*$val->kar_orani)+$val->fiyatTL);
                    $data->products[$key]->fiyatTL = (($komisyonlu/100*$val->KDV_ORANI)+$komisyonlu);
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
                        return $a->fiyatTL <=> $b->fiyatTL;
                    });
                    usort($yok, function($a, $b) {
                        return $a->fiyatTL <=> $b->fiyatTL;
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
                            return $a->fiyatTL <=> $b->fiyatTL;
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
                        return $a->fiyatTL <=> $b->fiyatTL;
                    });

                    $data->products = array_merge($aryNew,$yok);
                }
                
                //prex($data->products);
            }else{
                $data->products = array();
            }

            $data->products = array_values($data->products);

            $this->load->view('head',$data);
            $this->load->view('header');
            $this->load->view('listing_otobakim_all');
            $this->load->view('footer');
        }
    }
}
?>