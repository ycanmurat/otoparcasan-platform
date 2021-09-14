<!-- pageContent -->
<section class="pageContent product_Detail">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="list-head">
                    <div class="breadcrumb-box">
                        <nav aria-label="breadcrumb-list">
                            <ol class="breadcrumb-list">
                                <li class="breadcrumb-list-item">
                                    <a onclick="loader()" class="breadcrumb-list-link" href="<?=site_url()?>">
                                        Anasayfa
                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-list-item">
                                    <a onclick="loader()" class="breadcrumb-list-link" href="<?=site_url('yedek-parcalar/')?>">
                                        Yedek Parçalar
                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-list-item">
                                    <a onclick="loader()" class="breadcrumb-list-link" href="<?=site_url('yedek-parcalar/'.$otherCategori->slug)?>">
                                        <?=replaceStringProblemsReverse($otherCategori->GRUP_ISIM ?? '')?>
                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-list-item">
                                    <a onclick="loader()" class="breadcrumb-list-link" href="<?=site_url('yedek-parcalar/'.$otherCategori->slug.'/'.$selectedCategori->slug)?>">
                                        <?=replaceStringProblemsReverse($selectedCategori->GRUP_ISIM ?? '')?>
                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-list-item active">
                                    <a class="breadcrumb-list-link mobil-bread-link" href="<?=site_url('yedek-parcalar/'.$otherCategori->slug.'/'.$selectedCategori->slug)?>">
                                        <i class="fa fa-angle-left mobil-bread-icon" aria-hidden="true"></i>
                                        <?=$product->marka.' '.mb_ucwords(replaceStringProblemsReverse($product->STOK_ADI)).' '.mb_ucwords(replaceStringProblemsReverse($product->montaj))?>
                                    </a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <?php if ($selectedCar == true) { ?>
                        <div class="car-selected">
                            <div class="row">
                                <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12">
                                    <div class="car-selected-info">
                                        <div class="car-detail-list">
                                            <div class="car-detail-block">
                                                <span>
                                                    Araç
                                                </span>
                                                <p>
                                                    <?=$carDetail->Vehicle->ManufacturerName ?? ''?> <?=$carDetail->Vehicle->BaseModelName ?? ''?>
                                                </p>
                                            </div>
                                            <div class="car-detail-block">
                                                <span>
                                                    Model
                                                </span>
                                                <p>
                                                    <?=$carDetail->Vehicle->SubModelName ?? ''?>
                                                </p>
                                            </div>
                                            <div class="car-detail-block">
                                                <span>
                                                    Motor
                                                </span>
                                                <p>
                                                    <?=$carDetail->Vehicle->TechInfo->Capacity ?? ''?> cc - <?=$carDetail->Vehicle->TechInfo->PowerKw ?? ''?> KW - <?=$carDetail->Vehicle->TechInfo->PowerHp ?? ''?> Hp
                                                </p>
                                            </div>
                                            <div class="car-detail-block">
                                                <span>
                                                    Yıl
                                                </span>
                                                <p>
                                                    <?=getConsTime($carDetail->Vehicle->ConstructionTime)?> Sonrası
                                                </p>
                                            </div>
                                            <div class="car-detail-block">
                                                <span>
                                                    Şanzıman
                                                </span>
                                                <p>
                                                    <?=$carDetail->Vehicle->TechInfo->NrOfGears ?? ''?> <?=$carDetail->Vehicle->TechInfo->GearboxType ?? ''?>
                                                </p>
                                            </div>
                                            <div class="car-detail-block">
                                                <span>
                                                    Yakıt
                                                </span>
                                                <p>
                                                    <?=$carDetail->Vehicle->TechInfo->FuelMethod ?? ''?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12">
                                    <div class="car-selected-img">
                                        <div class="nav-garage-img">
                                            <a href="<?=site_url($carDetail->image)?>" data-lightbox="Lightbox-galeri-crumb" data-title="<?=$carDetail->Vehicle->ManufacturerName.' '.carNameExplode($carDetail->Vehicle->BaseModelName)?>" class="img-link">
                                                <img src="<?=site_url($carDetail->image)?>" onerror="this.src='<?=site_url('assets/Front/images/resmi_olmayan_araclar.png')?>';"  alt="">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12">
                                    <div class="car-selected-garage">
                                        <div class="clear"  onclick="removeSelectedCar()">
                                            <span>
                                                Aracı Değiştir
                                            </span>
                                            <img src="https://otoparcasan.com/assets/Front/images/Icons/close.svg">
                                        </div>
                                        <?php if ($garrageUnVisible == 0) { ?>
                                            <div class="garage-add">
                                                <button onclick="addGaraggeFromSelected()"> Garajıma Ekle <img src="https://otoparcasan.com/assets/Front/images/Icons/plus-white.svg"> </button>
                                            </div>
                                        <?php } ?>
                                        <div class="plateSearch Listing">
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 ">
                                                    <div class="mySelectedcar">
                                                        <table class="selectarea">
                                                            <tr>
                                                                <td>
                                                                    <select class="custom-select" name="garaggeCars">
                                                                        <?php if ($userData == false) { ?>
                                                                            <option value="0" selected disabled>Üye Girişi Yapmalısınız</option>
                                                                        <?php }elseif ($garagge == false) { ?>
                                                                            <option value="0" selected disabled>Üye Girişi Yapmalısınız</option>
                                                                        <?php }else{ ?>
                                                                            <option value="0">Garajınızdan Seçin</option>
                                                                            <?php foreach ($garagge as $key => $val) { ?>
                                                                                <option value="<?=$val->car_id?>" cons_time="<?=$val->consTime?>"><?=$val->detail.' - '.$val->name?></option>
                                                                            <?php } ?>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }else{ ?>
                        <div class="car-not-selected">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="plateSearch Listing">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-12 m-auto">
                                                <div class="T">Hızlı Parça Bul</div>
                                                <div class="Area">
                                                    <div class="plate-area">
                                                        <input type="text" class="plate-input" onkeypress="return enterScript(event)" placeholder="ŞASE NO" id="chasisNo">
                                                        <button type="button" onclick="sasiSearch()" class="plateSearchButon" id="chasisSearch"></button>
                                                    </div>
                                                    <div class="bread-tree-box">
                                                        <button class="bread-tree"  data-toggle="modal" data-target="#carTree">
                                                            Araç Ağacından Seçim
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-sm-12 ">
                                                <div class="mySelectedcar">
                                                    <table class="selectarea">
                                                        <tr>
                                                            <td>
                                                                <select class="custom-select" name="garaggeCars">
                                                                    <?php if ($userData == false) { ?>
                                                                        <option value="0" selected disabled>Üye Girişi Yapmalısınız</option>
                                                                    <?php }elseif ($garagge == false) { ?>
                                                                        <option value="0" selected disabled>Üye Girişi Yapmalısınız</option>
                                                                    <?php }else{ ?>
                                                                        <option value="0">Garajınızdan Seçin</option>
                                                                        <?php foreach ($garagge as $key => $val) { ?>
                                                                            <option value="<?=$val->car_id?>" cons_time="<?=$val->consTime?>"><?=$val->detail?></option>
                                                                        <?php } ?>
                                                                    <?php } ?>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-5">
                <div class="product-detail-img">
                    <div class="list-img ">
                        <a href="<?=site_url('assets/products/'.$selectedCategori->slug.'.png')?>" data-lightbox="Lightbox-galeri" data-title="<?=$product->marka.' '.mb_ucwords(replaceStringProblemsReverse($product->STOK_ADI),'UTF-8').' '.mb_ucwords(replaceStringProblemsReverse($product->montaj),'UTF-8')?>" class="img-link">
                            <img src="<?=site_url('assets/products/'.$selectedCategori->slug.'.png')?>" onerror="this.onerror=null;this.src='https://otoparcasan.com/assets/products/urun-gorseli-hazirlanmaktadir.png';" alt="">
                        </a>
                    </div>
                    <div class="share-Social">
                        <a class="facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?=current_url()?>" target="_blank"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
                        <a class="twitter" target="_blank" href="https://twitter.com/intent/tweet?text=<?=$product->marka.' '.mb_ucwords(replaceStringProblemsReverse($product->STOK_ADI),'UTF-8').' '.mb_ucwords(replaceStringProblemsReverse($product->montaj),'UTF-8')?> <?=current_url()?>"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
                        <a class="mail" href="mailto:?subject=<?=$product->marka.' '.mb_ucwords(replaceStringProblemsReverse($product->STOK_ADI),'UTF-8').' '.mb_ucwords(replaceStringProblemsReverse($product->montaj),'UTF-8')?>&body=Ürünü İnceleyin. <?=current_url()?>"><i class="fa fa-envelope-square" aria-hidden="true"></i></a>
                        <a class="whatsapp" href="whatsapp://send?text=<?=$product->marka.' '.mb_ucwords(replaceStringProblemsReverse($product->STOK_ADI),'UTF-8').' '.mb_ucwords(replaceStringProblemsReverse($product->montaj),'UTF-8')?> ürününü İnceleyin. <?=current_url()?>" data-action="share/whatsapp/share"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
                        <a class="linkedin" target="_blank" href=" http://www.linkedin.com/shareArticle?mini=true&url=<?=current_url()?>&title=<?=$product->marka.' '.mb_ucwords(replaceStringProblemsReverse($product->STOK_ADI),'UTF-8').' '.mb_ucwords(replaceStringProblemsReverse($product->montaj),'UTF-8')?>&summary=<?=current_url()?>&title=<?=$product->marka.' '.mb_ucwords(replaceStringProblemsReverse($product->STOK_ADI),'UTF-8').' '.mb_ucwords(replaceStringProblemsReverse($product->montaj),'UTF-8')?>&source=otoparcasan.com"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="product-lists">
                    <div class="row list-row">
                        <div class="product-Item list-item">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="product-brand-img">
                                        <img src="<?=site_url($product->markaImage ?? '')?>">
                                    </div>
                                    <div class="list-content">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="product-head">
                                                    <a href="<?=site_url($product->url)?>" class="ProductName"><?=$product->marka.' '.mb_ucwords(replaceStringProblemsReverse($product->STOK_ADI),'UTF-8').' '.mb_ucwords(replaceStringProblemsReverse($product->montaj),'UTF-8')?></a>
                                                    <p><?=$product->lKULL1S?><?=$product->lKULL2S?><?=$product->lKULL3S?></p>
                                                    <p class="productInfo productInfo-little"><?=$product->lKULL1S.$product->lKULL2S.$product->lKULL3S?></p>
                                                    <p class="productInfo carUyumu"></p>
                                                    <p class="productInfo">Stok Kodu : <b><?=$product->STOK_KODU?></b></p>
                                                </div>
                                                <div class="product-list-badges">
                                                    <div class="com-item">
                                                        <div class="com-block">
                                                            <svg>
                                                                <image xlink:href="<?=site_url('assets/Front/')?>images/Icons/truck.svg" src="svg.png"/>
                                                                </svg>
                                                            </div>
                                                            <p><?=(int)$cargo?> TL ve Üzeri Alışverişlerde Kargo Bedava</p>
                                                        </div>
                                                        <div class="com-item" style="margin-top: -1px;">
                                                            <div class="com-block">
                                                                <svg>
                                                                    <image xlink:href="<?=site_url('assets/Front/')?>images/Icons/iade.svg" src="svg.png"/>
                                                                    </svg>
                                                                </div>
                                                                <p>Kolay İade</p>
                                                            </div>
                                                            <?php if ($product->stok > 0 && $product->kargoGunu != 'YOK') { ?>
                                                                <div class="com-item">
                                                                    <div class="com-block">
                                                                        <svg>
                                                                            <image xlink:href="<?=site_url('assets/Front/')?>images/Icons/time.svg" src="svg.png"/>
                                                                            </svg>
                                                                        </div>
                                                                        <p>En Geç <?=$product->kargoGunu?> Kargoda</p>
                                                                    </div>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="price-block detail-price-block">
                                                                <div class="product-fav">
                                                                    <button type="button" onclick="addReminding('<?=$product->url?>')">
                                                                        <i class="fa fa-bell-o ring-icon <?=($reminding?'fav-active':'')?>" aria-hidden="true"></i>
                                                                    </button>
                                                                    <button type="button" onclick="addFavorite('<?=$product->url?>')">
                                                                        <i class="fa fa-heart-o fav-icon <?=($favorite?'fav-active':'')?>" aria-hidden="true"></i>
                                                                    </button>
                                                                </div>
                                                                <?php if ($product->discount > 0) { ?>
                                                                    <div class="product-discount">
                                                                        <div>
                                                                            <p>% <?=(int)$product->discount?></p>
                                                                        </div>
                                                                    </div>
                                                                <?php } ?>
                                                                <div class="product-Price">
                                                                    <?php if ($product->discount > 0) { ?>
                                                                        <?php $satisFiyati = $product->fiyatTL-($product->fiyatTL*$product->discount/100) ?>
                                                                        <div class="old-price"><?=number_format($product->fiyatTL,2, ',', '.')?> TL</div>
                                                                        <!-- Üstü Çizili fiyatla ilgili ne yapılacağı konuşulacak -->
                                                                        <div class="price"><?=number_format($satisFiyati,2, ',', '.')?> TL</div>
                                                                    <?php }else{ ?>
                                                                        <?php $satisFiyati = $product->fiyatTL ?>
                                                                        <div class="price"><?=number_format($satisFiyati,2, ',', '.')?> TL</div>
                                                                    <?php } ?>
                                                                </div>
                                                                <div class="quantity-area-box">
                                                                    <div class="quantity-area">
                                                                        <div class="value-button" id="decrease" onclick="decreaseValue(<?=$product->birimAdet ?? 1?>,'<?=$product->STOK_KODU?>')" value="Decrease Value">-</div>
                                                                        <input type="number" name="number_<?=$product->STOK_KODU?>" id="number" value="<?=$product->birimAdet ?? 1?>">
                                                                        <div class="value-button" id="increase" onclick="increaseValue(<?=$product->birimAdet ?? 1?>,'<?=$product->STOK_KODU?>')" value="Increase Value">+</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mobile-listing-hidden">
                                        <?php if ($product->stok > 0) { ?>
                                            <div>
                                                <svg width="25" height="25" style="margin-left: 3px;">
                                                    <image xlink:href="<?=site_url('assets/Front/')?>images/Icons/stok-mobil.svg" src="svg.png" width="25" height="25" />
                                                    </svg>
                                                    <p> STOKTA VAR</p>
                                                </div>
                                            <?php }else{ ?>
                                                <div class="stoktayok">
                                                    <svg width="25" height="25" style="margin-left: 3px;">
                                                        <image xlink:href="<?=site_url('assets/Front/')?>images/Icons/stoktayok.svg" src="svg.png" width="25" height="25" />
                                                        </svg>
                                                        <p> STOKTA YOK</p>
                                                    </div>
                                                <?php } ?>
                                                <div>
                                                    <svg width="25" height="25">
                                                        <image xlink:href="<?=site_url('assets/Front/')?>images/Icons/truck.svg" src="svg.png" width="25" height="25" />
                                                        </svg>
                                                        <p><?=(int)$cargo?> TL ve Üzeri Alışverişlerde Kargo Bedava</p>
                                                    </div>
                                                    <?php if ($product->stok > 0 && $product->kargoGunu != 'YOK') { ?>
                                                        <div>
                                                            <svg width="25" height="25" style="margin-left: 3px;">
                                                                <image xlink:href="<?=site_url('assets/Front/')?>images/Icons/time.svg" src="svg.png" width="25" height="25" />
                                                                </svg>
                                                                <p>En Geç <?=$product->kargoGunu?> Kargoda</p>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-detail-buttons">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                                            <?php if ($product->stok > 0) { ?>
                                                                <div class="stok-web">
                                                                    <div class="com-item com-stok">
                                                                        <div>
                                                                            <svg width="28" height="28" style="margin-left: 3px;">
                                                                                <image xlink:href="<?=site_url('assets/Front/')?>images/Icons/stok-mobil.svg" src="svg.png" width="28" height="28" />
                                                                                </svg>
                                                                                <p> STOKTA VAR</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php }else{ ?>
                                                                    <div class="stok-web stoktayok">
                                                                        <div class="com-item com-stok">
                                                                            <div>
                                                                                <svg width="28" height="28" style="margin-left: 3px;">
                                                                                    <image xlink:href="<?=site_url('assets/Front/')?>images/Icons/stoktayok.svg" src="svg.png" width="28" height="28" />
                                                                                    </svg>
                                                                                    <p> STOKTA YOK</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <?php } ?>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                                                    <div class="list-interaction-btn add-bask listing-button">
                                                                        <button type="button"  onclick="addToCartListingFull('<?=$product->STOK_KODU?>','<?=$product->CARI_KOD?>')">
                                                                            Sepete Ekle <span></span>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-tabs">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <ul class="tabs">
                                                            <li class="active" rel="product-tab-1">Açıklama</li>
                                                            <li rel="product-tab-4">Taksit Oranları</li>
                                                            <li rel="product-tab-5">İade ve Teslimat Koşulları</li>
                                                            <li rel="product-tab-6">Yorumlar</li>
                                                            <li rel="product-tab-7">Soru ve Cevap</li>
                                                            <li rel="product-tab-2">Ürüne Ait Oem Numaraları</li>
                                                            <li rel="product-tab-3">Sıkça Sorulan Sorular</li>
                                                        </ul>
                                                        <div class="tab_container">
                                                            <div id="product-tab-1" class="tab_content">
                                                                <div class="product-info">
                                                                    <div class="T"><?=mb_ucwords(replaceStringProblemsReverse($product->STOK_ADI)).' '.mb_ucwords(replaceStringProblemsReverse($product->montaj))?></div>
                                                                    <div class="sT">Açıklama :</div>
                                                                    <div class="EditorBox">
                                                                        <p><?=$detail?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="product-tab-3" class="tab_content">
                                                                <div class="product-info">
                                                                    <div class="EditorBox">
                                                                        <?php foreach ($faq as $key => $val) { ?>
                                                                            <h4><b><?=$val->question?></b></h4>
                                                                            <p><?=$val->answer?></p>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="product-tab-5" class="tab_content">
                                                                <div class="conditions">
                                                                    <p>İncelediğiniz ürün, doğrudan otoparcasan.com tarafından size kargoyla gönderilecektir. Kargo takip numarası email ve SMS ile iletilecektir.</p>
                                                                    <p>Ürünün adresinize teslim tarihinden itibaren 14 gün içinde iade şartları doğrultusunda iade yapabilirsiniz.</p>
                                                                    <p>İadelerinizi anlaşmalı olduğumuz kargo firmaları ile göndermeniz gerekmektedir. İadenizin kabul edilmesi için, ürünün hasar görmemiş ve kullanılmamış olması gerekmektedir.</p>
                                                                    <p>İade etmek istediğiniz ürün, tarafımızdan üretici/ithalatçı firmaya ulaştırılacak ve iade işlemleriniz otoparcasan.com tarafından takip edilecektir.</p>
                                                                    <p>Daha detaylı bilgi için Kolay İade sayfasını ziyaret edebilirsiniz.</p>
                                                                    <p>* Bedel İadesi: İade işlemi sonuçlandıktan sonra bedel ödemesi kredi kartınıza/banka hesabınıza 24 saat içinde yapılmaktadır. Ödeme işlemlerinin hesabınıza yansıma süresi bankanıza göre değişkenlik gösterebilir.</p>
                                                                </div>
                                                            </div>
                                                            <div id="product-tab-4" class="tab_content">
                                                                <style>
                                                                    #paytr_taksit_tablosu{clear: both;font-size: 12px;max-width: 1200px;text-align: center;font-family: Arial, sans-serif;}
                                                                    #paytr_taksit_tablosu::before {display: table;content: " ";}
                                                                    #paytr_taksit_tablosu::after {content: "";clear: both;display: table;}
                                                                    .taksit-tablosu-wrapper{margin: 5px;width: 280px;padding: 12px;cursor: default;text-align: center;display: inline-block;border: 1px solid #e1e1e1;}
                                                                    .taksit-logo img{max-height: 28px;padding-bottom: 10px;}
                                                                    .taksit-tutari-text{float: left;width: 126px;color: #a2a2a2;margin-bottom: 5px;}
                                                                    .taksit-tutar-wrapper{display: inline-block;background-color: #f7f7f7;}
                                                                    .taksit-tutar-wrapper:hover{background-color: #e8e8e8;}
                                                                    .taksit-tutari{float: left;width: 126px;padding: 6px 0;color: #474747;border: 2px solid #ffffff;}
                                                                    .taksit-tutari-bold{font-weight: bold;}
                                                                    @media all and (max-width: 600px) {.taksit-tablosu-wrapper {margin: 5px 0;}}
                                                                </style>
                                                                <div id="paytr_taksit_tablosu" class="text-center taksitWeb"></div>
                                                            </div>
                                                            <div id="product-tab-6" class="tab_content">
                                                                <div class="Comments">
                                                                    <div class="Comment-item">
                                                                        <form id="comment-add" method="post" action="#" onsubmit="return false">
                                                                            <div class="offerform">
                                                                                <div class="formArea">
                                                                                    <form action="#">
                                                                                        <div class="row">
                                                                                            <div class="col-12">
                                                                                                <p>Puanınız : </p>
                                                                                                <div class="RateArea RateArea-edit">
                                                                                                    <div class="rating-stars">
                                                                                                        <ul id="stars">
                                                                                                            <li class="star" title="Kötü" data-value="1">
                                                                                                                <i class="fa fa-star fa-fw"></i>
                                                                                                            </li>
                                                                                                            <li class="star" title="İdare eder" data-value="2">
                                                                                                                <i class="fa fa-star fa-fw"></i>
                                                                                                            </li>
                                                                                                            <li class="star" title="İyi" data-value="3">
                                                                                                                <i class="fa fa-star fa-fw"></i>
                                                                                                            </li>
                                                                                                            <li class="star" title="Mükemmel" data-value="4">
                                                                                                                <i class="fa fa-star fa-fw"></i>
                                                                                                            </li>
                                                                                                            <li class="star" title="Harika" data-value="5">
                                                                                                                <i class="fa fa-star fa-fw"></i>
                                                                                                            </li>
                                                                                                        </ul>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-12">
                                                                                                <p>Yorumunuz : </p>
                                                                                                <textarea style="background:#eee" name="comment" class="product_comment" placeholder="Yorumunuz"></textarea>
                                                                                                <input type="hidden" name="slug" value="<?=$product->url?>">
                                                                                            </div>
                                                                                            <div class="col-12 text-center">
                                                                                                <button type="submit">Yorum Yap !</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    <?foreach ($comments as $key => $val) {?>
                                                                        <div class="Comment-item">
                                                                            <div class="Comment-head">
                                                                                <div class="item">
                                                                                    <div class="Name"><?=$val->name_surname?></div>
                                                                                </div>
                                                                                <div class="item">
                                                                                    <div class="Star">
                                                                                        <div class="RateArea RateArea-edit">
                                                                                            <div class="rating-stars text-center">
                                                                                                <ul id="stars2">
                                                                                                    <?php for ($i=0; $i < 5; $i++) { ?>
                                                                                                        <?php if (floor($val->star) > $i) { ?>
                                                                                                            <li class="star selected" title="Yıldız" data-value="0">
                                                                                                                <i class="fa fa-star fa-fw"></i>
                                                                                                            </li>
                                                                                                        <?php }else{ ?>
                                                                                                            <li class="star" title="Yıldız" data-value="0">
                                                                                                                <i class="fa fa-star fa-fw"></i>
                                                                                                            </li>
                                                                                                        <?php } ?>
                                                                                                    <?php } ?>
                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="Date Date-edit"><?=dateparse($val->added_time)?></div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="Comment-content">
                                                                                <p><?=$val->comment?></p>
                                                                            </div>
                                                                        </div>
                                                                        <?}?>
                                                                    </div>
                                                                </div>
                                                                <div id="product-tab-7" class="tab_content">
                                                                    <div class="Comment-item">
                                                                        <form id="question-add" method="post" action="#" onsubmit="return false;">
                                                                            <div class="offerform">
                                                                                <div class="formArea">
                                                                                    <form action="#">
                                                                                        <div class="row">
                                                                                            <div class="col-12">
                                                                                                Soru Kategorisi :
                                                                                                <select name="question_category" class="question_category">
                                                                                                    <option value="0">Seçiniz</option>
                                                                                                    <option value="1">Ürün Uyumluluğu</option>
                                                                                                    <option value="2">İade</option>
                                                                                                    <option value="3">Ödeme</option>
                                                                                                    <option value="3">Diğer</option>
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="col-12">
                                                                                                Sorunuz :
                                                                                                <textarea name="question" class="product_question" style="background: #eee" placeholder="Sorunuz"></textarea>
                                                                                                <input type="hidden" name="slug" value="<?=$product->url?>">
                                                                                            </div>
                                                                                            <div class="col-12 text-center">
                                                                                                <button type="submit">Soru Sor !</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="CustomerReviewsArea">
                                                                        <?foreach ($allQuestionAndAnswers as $key => $val) {?>
                                                                            <div class="customer-comment">
                                                                                <h5><?=$val->name_surname?></h5>
                                                                                <p class="comment-line"><?=$val->question?></p>
                                                                                <b><?=dateparse($val->added_time)?></b>
                                                                            </div>
                                                                            <?if(isset($val->answers)){foreach ($val->answers as $key => $value) {?>
                                                                                <div class="co-comment">
                                                                                    <h5>Otoparcasan.com</h5>
                                                                                    <p class="comment-line"><?=$value->answer?></p>
                                                                                    <b><?=$value->added_time?></b>
                                                                                </div>
                                                                                <?}}?>
                                                                                <hr>
                                                                                <?}?>
                                                                            </div>
                                                                        </div>
                                                                        <div id="product-tab-2" class="tab_content">
                                                                            <div class="Comment-item">
                                                                                <b>Ürüne Ait Oem Numarları :</b><br><?=$oems?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-tabs-mobile">
                                                            <div class="accordion" id="accordionExample">
                                                                <div class="card">
                                                                    <div class="card-header card-tabs-clicked tab-active" id="headingOne">
                                                                        <h2 class="mb-0">
                                                                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                                Açıklama
                                                                                <span class="product-tabs-icon">

                                                                                </span>
                                                                            </button>
                                                                        </h2>
                                                                    </div>
                                                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                                        <div class="card-body">
                                                                            <h2>
                                                                                Rot Başı Sol
                                                                            </h2>
                                                                            <h4>
                                                                                Açıklama :
                                                                            </h4>
                                                                            <p>
                                                                                Rot başları, rot kolunun ucuna vidalanarak takılan ve direksiyon kutusundan çıkan hareketin, direksiyon rot kolundan, deve boynuna, oradan da direksiyon mafsalına (tekerlere) iletilmesini sağlayan parçadır.
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card">
                                                                    <div class="card-header card-tabs-clicked" id="headingSeven">
                                                                        <h2 class="mb-0">
                                                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                                                                Taksit Oranları
                                                                                <span class="product-tabs-icon">

                                                                                </span>
                                                                            </button>
                                                                        </h2>
                                                                    </div>
                                                                    <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionExample">
                                                                        <div class="card-body">
                                                                            <div id="paytr_taksit_tablosu" class="text-center taksitMobil"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card">
                                                                    <div class="card-header card-tabs-clicked" id="headingTwo">
                                                                        <h2 class="mb-0">
                                                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                                                İade ve Teslimat Koşulları
                                                                                <span class="product-tabs-icon">

                                                                                </span>
                                                                            </button>
                                                                        </h2>
                                                                    </div>
                                                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                                                        <div class="card-body">
                                                                            <p>
                                                                                İncelediğiniz ürün, doğrudan otoparcasan.com tarafından size kargoyla gönderilecektir. Kargo takip numarası email ve SMS ile iletilecektir.
                                                                            </p>
                                                                            <p>
                                                                                Ürünün adresinize teslim tarihinden itibaren 14 gün içinde iade şartları doğrultusunda iade yapabilirsiniz.
                                                                            </p>
                                                                            <p>
                                                                                İadelerinizi anlaşmalı olduğumuz kargo firmaları ile göndermeniz gerekmektedir. İadenizin kabul edilmesi için, ürünün hasar görmemiş ve kullanılmamış olması gerekmektedir.
                                                                            </p>
                                                                            <p>
                                                                                İade etmek istediğiniz ürün, tarafımızdan üretici/ithalatçı firmaya ulaştırılacak ve iade işlemleriniz otoparcasan.com tarafından takip edilecektir.
                                                                            </p>
                                                                            <p>
                                                                                Daha detaylı bilgi için Kolay İade sayfasını ziyaret edebilirsiniz.
                                                                            </p>
                                                                            <p>
                                                                                * Bedel İadesi: İade işlemi sonuçlandıktan sonra bedel ödemesi kredi kartınıza/banka hesabınıza 24 saat içinde yapılmaktadır. Ödeme işlemlerinin hesabınıza yansıma süresi bankanıza göre değişkenlik gösterebilir.
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card">
                                                                    <div class="card-header card-tabs-clicked" id="headingThree">
                                                                        <h2 class="mb-0">
                                                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                                                Yorumlar
                                                                                <span class="product-tabs-icon">

                                                                                </span>
                                                                            </button>
                                                                        </h2>
                                                                    </div>
                                                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                                                        <div class="card-body">
                                                                            <div class="Comments">
                                                                                <div class="Comment-item">
                                                                                    <form id="comment-add" method="post" action="#" onsubmit="return false">
                                                                                        <div class="offerform">
                                                                                            <div class="formArea">
                                                                                                <form action="#">
                                                                                                    <div class="row">
                                                                                                        <div class="col-12">
                                                                                                            <div class="RateArea RateArea-edit">
                                                                                                                <div class="rating-stars">
                                                                                                                    <ul id="stars">
                                                                                                                        <li class="star" title="Kötü" data-value="1">
                                                                                                                            <i class="fa fa-star fa-fw"></i>
                                                                                                                        </li>
                                                                                                                        <li class="star" title="İdare eder" data-value="2">
                                                                                                                            <i class="fa fa-star fa-fw"></i>
                                                                                                                        </li>
                                                                                                                        <li class="star" title="İyi" data-value="3">
                                                                                                                            <i class="fa fa-star fa-fw"></i>
                                                                                                                        </li>
                                                                                                                        <li class="star" title="Mükemmel" data-value="4">
                                                                                                                            <i class="fa fa-star fa-fw"></i>
                                                                                                                        </li>
                                                                                                                        <li class="star" title="Harika" data-value="5">
                                                                                                                            <i class="fa fa-star fa-fw"></i>
                                                                                                                        </li>
                                                                                                                    </ul>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-12">
                                                                                                            <textarea name="comment" class="product_comment" placeholder="Yorumunuz"></textarea>
                                                                                                            <input type="hidden" name="slug" value="<?=$product->url?>">
                                                                                                        </div>
                                                                                                        <div class="col-12 text-center">
                                                                                                            <button type="submit">Yorum Yap !</button>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </form>
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                                <?foreach ($comments as $key => $val) {?>
                                                                                    <div class="Comment-item">
                                                                                        <div class="Comment-head">
                                                                                            <div class="item">
                                                                                                <div class="Star">
                                                                                                    <div class="RateArea RateArea-edit">
                                                                                                        <div class="rating-stars text-center">
                                                                                                            <ul id="stars2">
                                                                                                                <?php for ($i=0; $i < 5; $i++) { ?>
                                                                                                                    <?php if (floor($val->star) > $i) { ?>
                                                                                                                        <li class="star selected" title="Yıldız" data-value="0">
                                                                                                                            <i class="fa fa-star fa-fw"></i>
                                                                                                                        </li>
                                                                                                                    <?php }else{ ?>
                                                                                                                        <li class="star" title="Yıldız" data-value="0">
                                                                                                                            <i class="fa fa-star fa-fw"></i>
                                                                                                                        </li>
                                                                                                                    <?php } ?>
                                                                                                                <?php } ?>
                                                                                                            </ul>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="Date Date-edit"><?=dateparse($val->added_time)?></div>
                                                                                            </div>
                                                                                            <div class="item">
                                                                                                <div class="Name"><?=$val->name_surname?></div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="Comment-content">
                                                                                            <p><?=$val->comment?></p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <?}?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-header card-tabs-clicked" id="headingFour">
                                                                            <h2 class="mb-0">
                                                                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseTwo">
                                                                                    Soru ve Cevap
                                                                                    <span class="product-tabs-icon">
                                                                                    </span>
                                                                                </button>
                                                                            </h2>
                                                                        </div>
                                                                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                                                                            <div class="card-body">
                                                                                <div class="Comment-item">
                                                                                    <form id="question-add" method="post" action="#" onsubmit="return false;">
                                                                                        <div class="offerform">
                                                                                            <div class="formArea">
                                                                                                <form action="#">
                                                                                                    <div class="row">
                                                                                                        <div class="col-12">
                                                                                                            <textarea name="question" class="product_question" placeholder="Sorunuz"></textarea>
                                                                                                            <input type="hidden" name="slug" value="<?=$product->url?>">
                                                                                                        </div>
                                                                                                        <div class="col-12 text-center">
                                                                                                            <button type="submit">Soru Sor !</button>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </form>
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                                <hr>
                                                                                <div class="CustomerReviewsArea">
                                                                                    <?foreach ($allQuestionAndAnswers as $key => $val) {?>
                                                                                        <div class="customer-comment">
                                                                                            <h5><?=$val->name_surname?></h5>
                                                                                            <p class="comment-line"><?=$val->question?></p>
                                                                                            <b><?=dateparse($val->added_time)?></b>
                                                                                        </div>
                                                                                        <?if(isset($val->answers)){foreach ($val->answers as $key => $value) {?>
                                                                                            <div class="co-comment">
                                                                                                <h5>Otoparcasan.com</h5>
                                                                                                <p class="comment-line"><?=$value->answer?></p>
                                                                                                <b><?=$value->added_time?></b>
                                                                                            </div>
                                                                                            <?}}?>
                                                                                            <hr>
                                                                                            <?}?>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="card">
                                                                                <div class="card-header card-tabs-clicked" id="headingFive">
                                                                                    <h2 class="mb-0">
                                                                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                                                                            Ürüne Ait Oem Numaraları
                                                                                            <span class="product-tabs-icon">
                                                                                            </span>
                                                                                        </button>
                                                                                    </h2>
                                                                                </div>
                                                                                <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                                                                                    <div class="card-body">
                                                                                        <div class="col-12">
                                                                                            <b>Ürüne Ait Oem Numarları :</b><br><?=$oems?>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="card">
                                                                                <div class="card-header card-tabs-clicked" id="headingSix">
                                                                                    <h2 class="mb-0">
                                                                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                                                                            Sıkça Sorular Sorular
                                                                                            <span class="product-tabs-icon">
                                                                                            </span>
                                                                                        </button>
                                                                                    </h2>
                                                                                </div>
                                                                                <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                                                                                    <div class="card-body">
                                                                                        <div class="col-12">
                                                                                            <div class="EditorBox">
                                                                                                <?php foreach ($faq as $key => $val) { ?>
                                                                                                    <h4><b><?=$val->question?></b></h4>
                                                                                                    <p><?=$val->answer?></p>
                                                                                                <?php } ?>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>
                                                    <!-- / pageContent -->
                                                    <div class="product-detail-mobile">
                                                        <div class="product-money">
                                                            <div class="price"><?=number_format($product->fiyatTL-($product->fiyatTL*$product->discount/100),2,',','.')?> ₺</div>
                                                        </div>
                                                        <div class="product-add">
                                                            <div class="list-interaction-btn add-bask listing-button">
                                                                <button type="button" onclick="addToCartListingFull('<?=$product->STOK_KODU?>','<?=$product->CARI_KOD?>')">
                                                                    Sepete Ekle <span></span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="sasiModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="carSasiDetail">
                                                                                <img src="" id="carImageSasi">
                                                                                <div class="sasiSecililer"></div>
                                                                                <div class="sasiText"><p>
                                                                                    <b class="sasiSearchSasiNumber">KPACA1ETSCP129883</b> şase numarasına ait aracın, aşağıdaki tabloda gösterilen Alt Model, Motor Tipi, Kaporta vb. araca ve şase numarasına göre değişiklik gösterecek donanımlarını da eksiksiz şekilde seçerek aracınızın seçim işlemini bitirmeniz gerekmektedir. Aksi takdirde aradığınız doğru parçaya ulaşamayabilirsiniz.
                                                                                </p></div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12"><div style="color:red;font-weight: bold;" class="gizle" id="sasiSearchErrorText"><center>Lütfen tüm alanlarda bir seçim yapın.</center><br></div></div>
                                                                        <div class="col-12">
                                                                            <div class="select-items allBaslik d-none">
                                                                            </div>
                                                                            <div class="select-items allSelect">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <?php if (!(null !==($this->session->userdata('userInfo')))) { ?>
                                                                        <button onclick="sasiAra('<?=(current_url())?>')">Ara</button>
                                                                    <?php }else{ ?>
                                                                        <button onclick="sasiGarajaEkle()">Garajıma Ekle</button>
                                                                        <button onclick="sasiAra('<?=(current_url())?>')">Ara</button>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="carDetail" style="display: none;"><?=json_encode($carDetail ?? '')?></div>
                                                    <div class="modal fade modal-content-bread" id="carTree" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Aracınızı bulamadınız mı ?</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body p-3">
                                                                    <div class="container-fluid">
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <div class="offerform">
                                                                                    <div class="formArea">
                                                                                        <form action="#">
                                                                                            <div class="row">
                                                                                                <div class="col-md-6 col-lg-6 col-12">
                                                                                                    <div class="FormElements">
                                                                                                        <div class="row">
                                                                                                            <div class="col-12 col-md-12 col-lg-12" style="margin-bottom: 15px">
                                                                                                                <select class="custom-select mt-2" id="carType">
                                                                                                                    <option value="0">- Araç Türünü Seçiniz </option>
                                                                                                                    <?php foreach ($dat->types as $key => $val) { ?>
                                                                                                                        <?php if ($val->status == 1) { ?>
                                                                                                                            <option data-img="<?=site_url($val->icon)?>" value="<?=$val->key?>"><?=$val->value?></option>
                                                                                                                        <?php } ?>
                                                                                                                    <?php } ?>
                                                                                                                </select>
                                                                                                            </div>
                                                                                                            <div class="col-12 col-md-12 col-lg-12" style="margin-bottom: 15px">
                                                                                                                <select class="custom-select mt-2 carAlt" id="carBrands" disabled>
                                                                                                                    <option value="0">- Marka -</option>
                                                                                                                </select>
                                                                                                            </div>
                                                                                                            <div class="col-12 col-md-12 col-lg-12" style="margin-bottom: 15px">
                                                                                                                <select class="custom-select mt-2 carAlt" id="carModels" disabled>
                                                                                                                    <option value="0">- Model -</option>
                                                                                                                </select>
                                                                                                            </div>
                                                                                                            <div class="col-12 col-md-12 col-lg-12" style="margin-bottom: 15px">
                                                                                                                <select class="custom-select mt-2 carAlt" id="carSubModels" disabled>
                                                                                                                    <option value="0">- Alt Tip -</option>
                                                                                                                </select>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-6 col-lg-6 col-12 carTreeModalSelectAlt">
                                                                                                    <div class="plateSearch extraArea plateSearch-edit" style="display: none;">
                                                                                                        <form action="#" method="post">
                                                                                                            <div class="Area">
                                                                                                                <div class="FormElements carSelectDetail">
                                                                                                                </div>
                                                                                                                <div class="FormElements">
                                                                                                                    <div class="row mt-2">
                                                                                                                        <?php if (!(null !==($this->session->userdata('userInfo')))) { ?>
                                                                                                                            <div class="col-12"><button onclick="SearchPart('<?=current_url()?>')" type="button" class="Btn Right" style="width: 100%">Aracı Seç</button></div>
                                                                                                                        <?php }else{ ?>
                                                                                                                            <div class="col-6 pr-2"><button onclick="addGarrage()" type="button" class="Btn Left" style="width: 100%">Garajıma Ekle</button></div>
                                                                                                                            <div class="col-6 pl-2"><button onclick="SearchPart('<?=current_url()?>')" type="button" class="Btn Right" style="width: 100%">Aracı Seç</button></div>
                                                                                                                        <?php } ?>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </form>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <script>
                                                        $( document ).ready(function() {
                                                            var selectedCar = $.cookie("selectedCar")
                                                            if (selectedCar != undefined && selectedCar != '') {
                                                                selectedCar = JSON.parse(selectedCar);
                                                                var data = {};
                                                                data.category_id    = <?=$product->KOD_3?>;
                                                                data.car_id         = selectedCar.carId;
                                                                data.consTime       = selectedCar.consTime;
                                                                data.oemler         = '<?=$product->oems?>';
                                                                $.ajax({
                                                                    url: site_url+'Ajax/getOemFromCar/',
                                                                    method:'POST',
                                                                    dataType : 'JSON',
                                                                    data : {key:JSON.stringify(data)},
                                                                    success: function(result){
                                                                        if (result.status == 1) {
                                                                            if (result.data == 1) {
                                                                                $('.carUyumu').html('<b>Parça Seçili Aracınız İle % 100 Uyumludur<b>');
                                                                                $('.carUyumu').css('color','green');
                                                                            }else{
                                                                                $('.carUyumu').html('<b>Parça Seçili Aracınız İle Uyumlu Değil<b>');
                                                                                $('.carUyumu').css('color','red');
                                                                                $('.carUyumu').css('text-decoration','underline');
                                                                                $('.carUyumu').after('<p class="productInfo"><br><span>Aracınıza Uyumlu <?=replaceStringProblemsReverse($selectedCategori->GRUP_ISIM ?? '')?> İçin <a href="<?=site_url('yedek-parcalar/'.$otherCategori->slug.'/'.$selectedCategori->slug)?>"><u  style="color:green;"><b>Tıklayın</b></u></a></span></p>');
                                                                            }
                                                                        }
                                                                    },error:function(result) {

                                                                    }
                                                                });
                                                            }

                                                            if ($(window).width() < 575) {
                                                                $('.taksitWeb').next('script').remove();
                                                                $('.taksitWeb').remove();
                                                            }else{
                                                                $('.taksitMobil').next('script').remove();
                                                                $('.taksitMobil').remove();   
                                                            }
                                                            $('<script/>',{type:'text/javascript', src:'https://www.paytr.com/odeme/taksit-tablosu/v2?token=<?=getenv('PAYTR_INSTALLMENT_TOKEN')?>&merchant_id=151345&amount=<?=ceiling($satisFiyati,0.01)?>&taksit=0&tumu=0'}).appendTo('head');
                                                        });
                                                    </script>