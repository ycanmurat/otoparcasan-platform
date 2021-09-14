<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends Core_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Dat_model','dat');
        $this->load->model('Api_model','Api');
        $this->load->model('Category_model','CM');
        /*
        if (is_null($this->session->userdata('userInfo'))) {
            $this->output->cache(10);
        }*/
    }

    public function index()
    {
        $data = new StdClass;
        $data = $this->Global_model->getAllInsert();
        $data->cargo = $this->CM->getCargoPrice();

            $data->filterData = new StdClass;
            $data->filterData->o = 'p';
            $data->filterData->y = array();
            $data->filterData->m = array();
            $data->filterData->k = array();
            $data->filterData->p = 1;

            if ($this->input->get('o')) {
                $data->filterData = new StdClass;
                $data->filterData->o = $this->input->get('o',true);
                $data->filterData->y = $this->input->get('y',true);
                $data->filterData->m = $this->input->get('m',true);
                $data->filterData->k = $this->input->get('k',true);
                $data->filterData->p = $this->input->get('p',true);

                if (empty($data->filterData->y)) {
                    $data->filterData->y = array();
                }
                if (empty($data->filterData->m)) {
                    $data->filterData->m = array();
                }

                if (empty($data->filterData->k)) {
                    $data->filterData->k = array();
                }
            }

            
            $data->filterData->s = trim($this->input->get('s',true) ?? '');

            //kategori seçimi yönlendirme
            foreach ($data->menus as $key => $val) {
                if (mb_strtolower($val->GRUP_ISIM, 'UTF-8') == mb_strtolower(trim($data->filterData->s), 'UTF-8')) {
                    redirect(site_url('yedek-parcalar/'.$val->detail->slug));
                }
                foreach ($val->sub as $key2 => $val2) {
                    foreach ($val2->sub as $key3 => $val3) {
                        if (mb_strtolower($val3->GRUP_ISIM, 'UTF-8') == mb_strtolower(trim($data->filterData->s), 'UTF-8')) {
                            redirect(site_url('yedek-parcalar/'.$val->detail->slug.'/'.$val3->detail->slug));
                        }
                    }
                }
            }

            $data->products = array();
            
            $data->userData = $this->getUserData();
            if ($data->userData != false) {
                $data->garagge = $this->CM->getUserGarrage($data->userData->id);
                if ($data->garagge != false) {
                    usort($data->garagge, function($a, $b) {
                        return $a->detail <=> $b->detail;
                    });
                }else{
                    $data->garagge == array();
                }
            }

            $data->products = $this->Api->getProductsSearch($data->filterData);

            $markaMontaj = $this->Api->searchFilter($data->filterData->s,$data->filterData);
            
            $markaMontaj = array_optimize($markaMontaj);

            $markaMontaj->montaj    = (array)$markaMontaj->montaj;
            $markaMontaj->marka     = (array)$markaMontaj->marka;
            $markaMontaj->kategori  = (array)$markaMontaj->kategori;


            usort($markaMontaj->montaj, function($a, $b) {
                return $a->GRUP_ISIM <=> $b->GRUP_ISIM;
            });

            usort($markaMontaj->marka, function($a, $b) {
                return $a->GRUP_ISIM <=> $b->GRUP_ISIM;
            });

            usort($markaMontaj->kategori, function($a, $b) {
                return $a->GRUP_ISIM <=> $b->GRUP_ISIM;
            });

            //prex($markaMontaj);
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

                foreach ($data->products as $key => $val) {
                    if (trim($val->STOK_KODU) == trim($data->filterData->s)) {
                        $tempArray = $val;
                        unset($data->products[$key]);
                        array_unshift($data->products,$tempArray);
                    }
                }
            }else{
                $data->products = array();
            }

            $data->brands = $markaMontaj->marka;
            $data->montaj = $markaMontaj->montaj;
            $data->kategori = $markaMontaj->kategori;

            $data->markaCount = count($data->brands);
            $data->productCount = 0;
            $data->categoryCount = count($data->kategori);
            foreach ($data->brands as $key => $val) {
                $data->productCount += $val->count;
            }
            
            $data->title = 'Arama Sonuçları | Otoparçasan.com';
            $data->desc = 'Arama Sonuçları';
            
            $data->products = array_values($data->products);

            //prex($data->products);

            $this->load->view('head',$data);
            $this->load->view('header');
            $this->load->view('listing_search');
            $this->load->view('footer');
    }
}
?>