<!-- pageContent -->
<section class="pageContent ListingPage ListingFull">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
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
                                        <?=replaceStringProblemsReverse($otherCategori->GRUP_ISIM)?>
                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-list-item active">
                                    <a class="breadcrumb-list-link mobil-bread-link" href="<?=site_url('yedek-parcalar/'.$otherCategori->slug)?>">
                                        <i class="fa fa-angle-left mobil-bread-icon" aria-hidden="true"></i>
                                        <?=replaceStringProblemsReverse($selectedCategori->GRUP_ISIM)?>
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
                                            <img src="<?=site_url('assets/Front/images/Icons/close.svg')?>">
                                        </div>
                                        <?php if ($garrageUnVisible == 0) { ?>
                                            <div class="garage-add">
                                                <button onclick="addGaraggeFromSelected()"> Garajıma Ekle <img src="<?=site_url('assets/Front/images/Icons/plus-white.svg')?>"> </button>
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
    <div class="col-xl-12 col-md-12">
        <?php foreach ($oems as $key => $val) { ?>
            <?php if (isset($oemProducts[$val])) { ?>
                <h6><?=$val?>&nbsp;&nbsp;(<?=$oemDesc[$val] ?? ''?>) -> <?=($oemProducts[$val] ?? '')?></h6>
            <?php }else{ ?> 
                <h6><?=$val?> -> Ürün Yok</h6>
            <?php } ?>
        <?php } ?>
    </div>
    <br>
    <div class="row">
        <?php if ($products == array()) { ?>
            <div class="col-md">
                <div class="product-notfounded">
                    <img src="<?=site_url('assets/Front/')?>images/Icons/negative-button.svg" src="svg.png">
                    <h2>Ürün Bulunamadı !</h2>
                    <a class="error-button" href="<?=site_url()?>">
                        ANASAYFA
                    </a>
                </div>
            </div>
        <?php }else{ ?>
            <div class="col-md-auto Filter-column">
                <div class="FilterColumn-Title">
                    <div class="item"><div class="T">Filtrele</div></div>
                    <div class="item"><div class="closeFilter"><i class="fa fa-times" aria-hidden="true"></i></div></div>
                </div>
                <form action="<?=current_url()?>" method="GET" id="category-filter">
                    <div class="listing-filter">
                        <div class="Filter-Area">
                            <div class="filter-column">
                                <div class="filter-title">Kategori</div>
                                <div class="filter-list">
                                    <div class="ListGroup">
                                        <?php foreach ($menus as $key => $val) { ?>
                                            <div class="wrapper">
                                                <div class="main-nav"><?=replaceStringProblemsReverse($val->GRUP_ISIM)?>
                                                <span class="filter-span"></span>
                                            </div>
                                            <ul class="dropdownops" style="display: none;">
                                                <li>
                                                    <?php foreach ($val->sub as $key2 => $val2) { ?>
                                                        <div class="wrapper-alt">
                                                            <div class="main-nav main-nav-alt"><?=replaceStringProblemsReverse($val2->GRUP_ISIM)?>  <span class="filter-span"></span></div>
                                                            <ul class="dropdownops" style="display: none;padding-left: 10px;">
                                                                <li>
                                                                    <?php foreach ($val2->sub as $key3 => $val3) { ?>
                                                                        <a class="main-nav-link" onclick="loader()" href="<?=site_url('yedek-parcalar/'.$val->detail->slug.'/'.(isset($val3->detail)?$val3->detail->slug:'#'))?>"><?=replaceStringProblemsReverse($val3->GRUP_ISIM)?>  <span class="filter-span <?=$val3->detail->slug == $menu2?'filter-span-dot':''?>"></span></a>
                                                                    <?php } ?>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    <?php } ?>
                                                </li>
                                            </ul>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="Filter-Area">
                        <div class="filter-column">
                            <div class="filter-title">Sıralama Tipi</div>
                            <div class="filter-list">
                                <div id="filter-oncelik" class="ListGroup">
                                    <div class="Item">
                                        <input class="Checkbox__Input FilterItemTab" onclick="filterDoit()" <?=$filterData->o=='p'?'checked':''?> id="price" value="p" name="o" type="radio">
                                        <label class="Checkbox__Label" for="price">Fiyat Öncelikli</label>
                                    </div>
                                    <div class="Item">
                                        <input class="Checkbox__Input FilterItemTab" id="shiping" onclick="filterDoit()" <?=$filterData->o=='f'?'checked':''?> value="f" name="o" type="radio">
                                        <label class="Checkbox__Label" for="shiping">Kargo Süresi Öncelikli</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if (!empty($montaj)) { ?>
                        <div class="Filter-Area">
                            <div class="filter-column">
                                <div class="filter-title">Montaj Yeri</div>
                                <div class="filter-list">
                                    <div class="FilterSearch">
                                        <input type="text" class="jquery_filter" data-search-items-wrapper-id="#filter-montaj" data-search-item-class=".Item" data-search-classes="label" autocomplete="off">
                                    </div>
                                    <div id="filter-montaj" class="ListGroup">
                                        <?php foreach ($montaj as $key => $val) { ?>
                                            <?php if (in_array($val->GRUP_KOD,$filterData->y)) { ?>
                                                <div class="Item">
                                                    <input class="Checkbox__Input FilterItemMontaj" onclick="filterDoit()" id="montaj_<?=$val->GRUP_KOD?>" checked value="<?=$val->GRUP_KOD?>" name="y[]" type="checkbox">
                                                    <label class="Checkbox__Label" for="montaj_<?=$val->GRUP_KOD?>"><?=replaceStringProblemsReverse($val->GRUP_ISIM)?> <span class="Count">(<?=$val->count?>)</span></label>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php foreach ($montaj as $key => $val) { ?>
                                            <?php if (!(in_array($val->GRUP_KOD,$filterData->y))) { ?>
                                                <div class="Item">
                                                    <input class="Checkbox__Input FilterItemMontaj" onclick="filterDoit()" id="montaj_<?=$val->GRUP_KOD?>" value="<?=$val->GRUP_KOD?>" name="y[]" type="checkbox">
                                                    <label class="Checkbox__Label" for="montaj_<?=$val->GRUP_KOD?>"><?=replaceStringProblemsReverse($val->GRUP_ISIM)?> <span class="Count">(<?=$val->count?>)</span></label>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if (!empty($brands)) { ?>
                        <div class="Filter-Area">
                            <div class="filter-column">
                                <div class="filter-title">Marka</div>
                                <div class="filter-list">
                                    <div class="FilterSearch">
                                        <input type="text" class="jquery_filter" data-search-items-wrapper-id="#filter-marka" data-search-item-class=".Item" data-search-classes="label" autocomplete="off">
                                    </div>
                                    <div id="filter-marka" class="ListGroup">
                                        <?php foreach ($brands as $key => $val) { ?>
                                            <?php if (in_array($val->GRUP_KOD,$filterData->m)) { ?>
                                                <div class="Item">
                                                    <input class="Checkbox__Input FilterItemMarka" onclick="filterDoit()" id="marka_<?=$val->GRUP_KOD?>" checked value="<?=$val->GRUP_KOD?>" name="m[]" type="checkbox">
                                                    <label class="Checkbox__Label" for="marka_<?=$val->GRUP_KOD?>"><?=replaceStringProblemsReverse($val->GRUP_ISIM)?> <span class="Count">(<?=$val->count?>)</span></label>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php foreach ($brands as $key => $val) { ?>
                                            <?php if (!(in_array($val->GRUP_KOD,$filterData->m))) { ?>
                                                <div class="Item">
                                                    <input class="Checkbox__Input FilterItemMarka" onclick="filterDoit()" id="marka_<?=$val->GRUP_KOD?>" value="<?=$val->GRUP_KOD?>" name="m[]" type="checkbox">
                                                    <label class="Checkbox__Label" for="marka_<?=$val->GRUP_KOD?>"><?=replaceStringProblemsReverse($val->GRUP_ISIM)?> <span class="Count">(<?=$val->count?>)</span></label>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </form>
        </div>
        <div class="col-md">
            <div class="Item-Display">
                <div class="">
                    <?php foreach ($products as $key => $productGroup) { ?>
                        <div class="col-xl-12 col-md-12 nopad-r nopad-l">
                            <div class="listing-block">
                              <div class="tab-content" id="v-pills-tabContent" style="overflow: hidden;">
                                <?php foreach ($productGroup as $key2 => $product) { ?>
                                    <input type="hidden" value="<?=$product->CARI_KOD?>" id="cariKod">
                                    <div class="tab-pane <?=$key2 == 0?'fade show active':''?>" id="product-<?=$key?>-<?=$key2?>" role="tabpanel" aria-labelledby="product-<?=$key?>-<?=$key2?>-tab">
                                        <div class="product-lists">
                                            <div class="">
                                                <div class="product-Item list-item">
                                                    <div class="row">
                                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-4 mr-auto ml-auto nopad-r">

                                                            <div class="list-img listing-page-img">
                                                                <a href="<?=site_url('assets/products/'.$selectedCategori->slug.'.png')?>" data-lightbox="Lightbox-galeri-<?=$key2?>" data-title="<?=$product->STOK_KODU?> - <?=$product->marka.' '.mb_ucwords(replaceStringProblemsReverse($product->STOK_ADI),'UTF-8').' '.mb_ucwords(replaceStringProblemsReverse($product->montaj),'UTF-8')?>" class="img-link"><img src="<?=site_url('assets/products/'.$selectedCategori->slug.'.png')?>" onerror="this.onerror=null;this.src='https://otoparcasan.com/assets/products/urun-gorseli-hazirlanmaktadir.png';" alt=""></a>
                                                            </div>
                                                            <?php if ($product->KULL2N > 0 && $product->KULL1S < 1) { ?>
                                                                <div class="stok-web">
                                                                    <div class="com-item com-stok">
                                                                        <div>
                                                                            <svg class="listing-page-stok">
                                                                                <image xlink:href="<?=site_url('assets/Front/')?>images/Icons/stok-mobil.svg" src="svg.png" width="25" height="25" />
                                                                                </svg>
                                                                                <p> STOKTA VAR</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php }else{ ?>
                                                                    <div class="stok-web stoktayok">
                                                                        <div class="com-item com-stok">
                                                                            <div>
                                                                                <svg width="25" height="25">
                                                                                    <image xlink:href="<?=site_url('assets/Front/')?>images/Icons/stoktayok.svg" src="svg.png" width="25" height="25" />
                                                                                    </svg>
                                                                                    <p> STOKTA YOK</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <?php } ?>
                                                                </div>
                                                                <div class="col-xl-9 col-lg-9 col-md-9 col-sm-8 col-8 nopad-l">
                                                                    <div class="list-content">
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <div class="product-head">
                                                                                    <a href="<?=site_url($product->url.($filterData->o=='f'?'?o=f':''))?>" class="ProductName"><?=$product->marka.' '.mb_ucwords(replaceStringProblemsReverse($product->STOK_ADI),'UTF-8').' '.mb_ucwords(replaceStringProblemsReverse($product->montaj),'UTF-8')?></a>
                                                                                    <p><?=$product->lKULL1S?><?=$product->lKULL2S?><?=$product->lKULL3S?></p>
                                                                                    <div class="product-stars">
                                                                                        <div class="item">
                                                                                            <?php for ($i=0; $i < 5; $i++) { ?>
                                                                                                <?php if (floor($product->comments->star) > $i) { ?>
                                                                                                    <i class="fa fa-star OK" aria-hidden="true"></i>
                                                                                                <?php }else{ ?>
                                                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                                                <?php } ?>
                                                                                            <?php } ?>
                                                                                        </div>
                                                                                        <div class="item">
                                                                                            <p class="comment">(<?=$product->comments->comment?> Yorum)</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <span class="product-compatible-status"><i class="fa fa-check" aria-hidden="true"></i>Aracınıza %100 Uyumludur</span>
                                                                                    <p class="productInfo productInfo-little"><?=$product->lKULL1S?><?=$product->lKULL2S?><?=$product->lKULL3S?></p>
                                                                                    <?php if ($carDetail !== null) { ?>
                                                                                        <p class="productInfo"><?=$carDetail->Vehicle->ManufacturerName?> <?=$carDetail->Vehicle->BaseModelName?></p>
                                                                                    <?php } ?>
                                                                                    <p class="productInfo">Stok Kodu : <b><?=$product->STOK_KODU?></b></p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-7">
                                                                                <div class="product-list-badges">
                                                                                    <div class="com-item">
                                                                                        <div class="com-block">
                                                                                            <svg width="28" height="28">
                                                                                                <image xlink:href="<?=site_url('assets/Front/')?>images/Icons/truck.svg" src="svg.png" width="28" height="28" />
                                                                                                </svg>
                                                                                            </div>
                                                                                            <p><?=(int)$cargo?> TL ve Üzeri Alışverişlerde Kargo Bedava</p>
                                                                                        </div>
                                                                                        <div class="com-item" style="margin-top: -1px;">
                                                                                            <div class="com-block">
                                                                                                <svg width="23" height="23">
                                                                                                    <image xlink:href="<?=site_url('assets/Front/')?>images/Icons/iade.svg" src="svg.png" width="23" height="23" />
                                                                                                    </svg>
                                                                                                </div>
                                                                                                <p>Kolay iade</p>
                                                                                            </div>
                                                                                            <?php if ($product->stok > 0 && $product->kargoGunu != 'YOK') { ?>
                                                                                                <div class="com-item">
                                                                                                    <div class="com-block">
                                                                                                        <svg width="24" height="24">
                                                                                                            <image xlink:href="<?=site_url('assets/Front/')?>images/Icons/time.svg" src="svg.png" width="24" height="24" />
                                                                                                            </svg>
                                                                                                        </div>
                                                                                                        <p>En Geç <?=$product->kargoGunu?> Kargoda</p>
                                                                                                    </div>
                                                                                                <?php } ?>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-5">
                                                                                            <div class="price-block listing-page-price-block">
                                                                                                <?php if ($product->discount > 0) { ?>
                                                                                                    <div class="product-discount listing-page-discount">
                                                                                                        <h6>KAZANCINIZ</h6>
                                                                                                        <div>
                                                                                                            <p>% <?=(int)$product->discount?></p>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                <?php } ?>
                                                                                                <div class="product-Price listing-page-price">
                                                                                                    <?php if ($product->discount > 0) { ?>
                                                                                                        <div class="old-price"><?=number_format($product->fiyatTL,2)?> TL</div>
                                                                                                        <!-- Üstü Çizili fiyatla ilgili ne yapılacağı konuşulacak -->
                                                                                                        <div class="price"><?=number_format($product->fiyatTL-($product->fiyatTL*$product->discount/100),2)?> TL</div>
                                                                                                    <?php }else{ ?>
                                                                                                        <div class="price"><?=number_format($product->fiyatTL,2)?> TL</div>
                                                                                                    <?php } ?>
                                                                                                </div>
                                                                                                <div class="quantity-area-box listing-page-quantity">
                                                                                                    <div class="quantity-area">
                                                                                                        <div class="value-button" id="decrease" onclick="decreaseValue(<?=$product->birimAdet ?? 1?>,'<?=$product->STOK_KODU?>')" value="Decrease Value">-</div>
                                                                                                        <input type="number" name="number_<?=$product->STOK_KODU?>" id="number" value="<?=$product->birimAdet ?? 1?>">
                                                                                                        <div class="value-button" id="increase" onclick="increaseValue(<?=$product->birimAdet ?? 1?>,'<?=$product->STOK_KODU?>')" value="Increase Value">+</div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 nopad-l nopad-r mobile-pad">
                                                                                            <div class="row">
                                                                                                <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                                                                                    <div class="list-interaction-btn p-detail listing-button">
                                                                                                        <a href="<?=site_url($product->url.($filterData->o=='f'?'?o=f':''))?>">
                                                                                                            Ürün Detay <span></span>
                                                                                                        </a>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                                                                                    <div class="list-interaction-btn car-checked listing-button">
                                                                                                        <button type="button">
                                                                                                         <i class="fa fa-check" aria-hidden="true"></i>Aracınıza %100 Uyumludur
                                                                                                     </button>
                                                                                                 </div>
                                                                                             </div>
                                                                                             <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                                                                                <div class="list-interaction-btn add-bask listing-button" onclick="addToCartListingFull('<?=$product->STOK_KODU?>','<?=$product->CARI_KOD?>')">
                                                                                                    <button type="button">
                                                                                                     Sepete Ekle <span></span>
                                                                                                 </button>
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
                                                                <div>
                                                                    <svg width="25" height="25" class="listing-page-stok">
                                                                        <image xlink:href="<?=site_url('assets/Front/')?>images/Icons/stok-mobil.svg" src="svg.png" width="25" height="25" />
                                                                        </svg>
                                                                        <p> STOKTA VAR</p>
                                                                    </div>
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
                                                                    <div class="mobile-listing-buttons">
                                                                        <div class="col-6">
                                                                            <div class="list-interaction-btn p-detail listing-button">
                                                                                <a href="<?=site_url($product->url.($filterData->o=='f'?'?o=f':''))?>">
                                                                                    Ürün Detay <span></span>
                                                                                </a>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-6">
                                                                            <div class="list-interaction-btn add-bask listing-button" onclick="addToCartListingFull('<?=$product->STOK_KODU?>','<?=$product->CARI_KOD?>')">
                                                                                <button type="button" class="listing-page-basket-button">
                                                                                    Sepete Ekle <span></span>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="Product-tab-bg">
                                                        <div class="nav flex-column nav-pills product-tab-menu " id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                            <?php foreach ($productGroup as $key2 => $product) { ?>
                                                                <?php if ($product->KULL2N > 0 && $product->KULL1S < 1) { ?>
                                                                    <a class="nav-link <?=$key2 == 0?'active':''?>" id="product-<?=$key?>-<?=$key2?>-tab" data-toggle="pill" href="#product-<?=$key?>-<?=$key2?>" role="tab" aria-controls="product-<?=$key?>-<?=$key2?>" aria-selected="true">

                                                                        <div class="image-item">
                                                                            <img class="img-fluid" src="<?=site_url($product->markaImage)?>" onError="this.onerror=null;this.src='https://fakeimg.pl/200x120/';" >
                                                                        </div>

                                                                        <?php if ($product->discount > 0) { ?>
                                                                            <?php if ($product->yerli == 1) { ?>
                                                                                <p><?=number_format($product->fiyatTL-($product->fiyatTL*$product->discount/100),2)?> <i class="fa fa-try" aria-hidden="true"></i>
                                                                                    <div class="listing-popular">
                                                                                        <span>Popüler</span>
                                                                                    </div>
                                                                                </p>
                                                                            <?php }else{ ?>
                                                                                <p class="not-popular"><?=number_format($product->fiyatTL-($product->fiyatTL*$product->discount/100),2)?> <i class="fa fa-try" aria-hidden="true"></i></p>
                                                                            <?php } ?>
                                                                        <?php }else{ ?>
                                                                            <p><?=number_format($product->fiyatTL,2)?> <i class="fa fa-try" aria-hidden="true"></i></p>
                                                                        <?php } ?>
                                                                    </a>
                                                                <?php }else{ ?>
                                                                    <a class="nav-link stoktayok-border <?=$key2 == 0?'active':''?>" id="product-<?=$key?>-<?=$key2?>-tab" data-toggle="pill" href="#product-<?=$key?>-<?=$key2?>" role="tab" aria-controls="product-<?=$key?>-<?=$key2?>" aria-selected="true">

                                                                        <div class="image-item"><img class="img-fluid" src="<?=site_url($product->markaImage)?>" onError="this.onerror=null;this.src='https://fakeimg.pl/200x120/';" ></div>

                                                                        <?php if ($product->discount > 0) { ?>
                                                                            <p class="stoktayok-nav not-popular"><?=number_format($product->fiyatTL-($product->fiyatTL*$product->discount/100),2)?> <i class="fa fa-try" aria-hidden="true"></i></p>
                                                                        <?php }else{ ?>
                                                                            <p class="stoktayok-nav"><?=number_format($product->fiyatTL,2)?> <i class="fa fa-try" aria-hidden="true"></i></p>
                                                                        <?php } ?>
                                                                    </a>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</section>
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
                    <button onclick="sasiAra('<?=current_url()?>')">Ara</button>
                <?php }else{ ?>
                    <button onclick="sasiGarajaEkle()">Garajıma Ekle</button>
                    <button onclick="sasiAra('<?=current_url()?>')">Ara</button>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<div id="carDetail" style="display: none;"><?=json_encode($carDetail ?? '')?></div>
<?php if ($products != array()) { ?>
<div class="filtershow">
    <p>
        FİLTRELE
    </p>
</div>
<?php } ?> 