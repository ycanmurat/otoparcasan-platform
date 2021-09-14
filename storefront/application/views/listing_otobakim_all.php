<!-- pageContent -->
<section class="pageContent ListingPage ListingFull">
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
                                <li class="breadcrumb-list-item active">
                                    <a class="breadcrumb-list-link mobil-bread-link" href="#">
                                        <i class="fa fa-angle-left mobil-bread-icon" aria-hidden="true"></i>
                                        Motor Yağları
                                    </a>
                                </li>
                            </ol>
                        </nav>
                    </div>
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
                                                         <button id="clearArea"><i class="fa fa-undo" aria-hidden="true"></i></button>
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
                <br>
            </div>
            <div class="col-md-auto Filter-column">
                <div class="FilterColumn-Title">
                    <div class="item"><div class="T">Filtrele</div></div>
                    <div class="item"><div class="closeFilter"><i class="fa fa-times" aria-hidden="true"></i></div></div>
                </div>
                <form action="<?=current_url()?>" method="GET">
                    <input type="hidden" value="<?=$filterData->p?>" name="p">
                    <div class="listing-filter">

                        <div class="filter-control filter-control-top">
                            <button type="submit" class="global-btn filter-now d-block" onclick="loader()">Uygula</button>
                        </div>
                        <div class="Filter-Area">
                            <div class="filter-column">
                                <div class="filter-title">Sıralama Tipi</div>
                                <div class="filter-list">
                                    <div id="filter-oncelik" class="ListGroup">
                                        <div class="Item">
                                            <input class="Checkbox__Input FilterItemTab" <?=$filterData->o=='p'?'checked':''?> id="price" value="p" name="o" type="radio">
                                            <label class="Checkbox__Label" for="price">Fiyata Öncelikli</label>
                                        </div>
                                        <div class="Item">
                                            <input class="Checkbox__Input FilterItemTab" id="shiping" <?=$filterData->o=='f'?'checked':''?> value="f" name="o" type="radio">
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
                                                    <input class="Checkbox__Input FilterItemMontaj" id="montaj_<?=$val->GRUP_KOD?>" checked value="<?=$val->GRUP_KOD?>" name="y[]" type="checkbox">
                                                    <label class="Checkbox__Label" for="montaj_<?=$val->GRUP_KOD?>"><?=replaceStringProblemsReverse($val->GRUP_ISIM)?> <span class="Count">(<?=$val->count?>)</span></label>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php foreach ($montaj as $key => $val) { ?>
                                            <?php if (!(in_array($val->GRUP_KOD,$filterData->y))) { ?>
                                                <div class="Item">
                                                    <input class="Checkbox__Input FilterItemMontaj" id="montaj_<?=$val->GRUP_KOD?>" value="<?=$val->GRUP_KOD?>" name="y[]" type="checkbox">
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
                                                    <input class="Checkbox__Input FilterItemMarka" id="marka_<?=$val->GRUP_KOD?>" checked value="<?=$val->GRUP_KOD?>" name="m[]" type="checkbox">
                                                    <label class="Checkbox__Label" for="marka_<?=$val->GRUP_KOD?>"><?=replaceStringProblemsReverse($val->GRUP_ISIM)?> <span class="Count">(<?=$val->count?>)</span></label>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php foreach ($brands as $key => $val) { ?>
                                            <?php if (!(in_array($val->GRUP_KOD,$filterData->m))) { ?>
                                                <div class="Item">
                                                    <input class="Checkbox__Input FilterItemMarka" id="marka_<?=$val->GRUP_KOD?>" value="<?=$val->GRUP_KOD?>" name="m[]" type="checkbox">
                                                    <label class="Checkbox__Label" for="marka_<?=$val->GRUP_KOD?>"><?=replaceStringProblemsReverse($val->GRUP_ISIM)?> <span class="Count">(<?=$val->count?>)</span></label>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="filter-control">
                            <button type="submit" class="global-btn filter-now d-block" onclick="loader()">Uygula</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md">
                <div class="Item-Display">
                    <div class="">
                        <?php if ($products == array()) { ?>
                            <h2>Ürün Bulunamadı !</h2>
                        <?php } ?>
                        <div class="row addProduct">
                            <?php foreach ($products as $key => $product) { ?>
                                <div class="item col-lg-edit-3 col-md-edit-4 col-md-6 col-sm-6 col-6">
                                    <div class="list-item Small">
                                        <div class="search-area-img">
                                            <img src="<?=site_url($product->markaImage) ?? ''?>">
                                        </div>
                                        <div class="list-img">
                                            <!--<span class="ribbon new"><span>Yeni</span></span>-->
                                            <a href="<?=site_url($product->url)?>" class="img-link"><img src="https://otoparcasan.com/assets/Front/images/Detail/detail-img3.webp" alt=""></a>
                                        </div>
                                        <div class="list-content">
                                            <div class="product-stars stars-search-page">
                                                <div class="item">
                                                    <i class="fa fa-star OK" aria-hidden="true"></i>
                                                    <i class="fa fa-star OK" aria-hidden="true"></i>
                                                    <i class="fa fa-star OK" aria-hidden="true"></i>
                                                    <i class="fa fa-star OK" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                </div>
                                                <div class="item">
                                                    <p class="comment">(7 Yorum)</p>
                                                </div>
                                            </div>
                                            <div class="product-head search-product-head">
                                                <a href="<?=site_url($product->url)?>" class="ProductName"><?=$product->marka.' '.mb_ucwords(replaceStringProblemsReverse($product->STOK_ADI),'UTF-8').' '.mb_ucwords(replaceStringProblemsReverse($product->montaj),'UTF-8')?></a>
                                                <!--   Marka : <?=$product->marka?>-->
                                                <p class="productInfo search-productInfo"> <br>Stok Kodu : <?=$product->STOK_KODU?></p>
                                            </div>
                                            <div class="product-control">
                                                <?php if ($product->kargoGunu != 'YOK' && $product->KULL2N > 0 && $product->KULL1S < 1) { ?>
                                                    <div class="com-item listing-search-item">
                                                        <div class="com-block">
                                                            <svg width="20" height="20">
                                                                <image xlink:href="<?=site_url('assets/Front/')?>images/Icons/time.svg" src="svg.png" width="20" height="20" />
                                                                </svg>
                                                            </div>
                                                            <p>En Geç <?=$product->kargoGunu?> Kargoda</p>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="product-Price search-product-price">
                                                        <input type="hidden" name="number_<?=$product->STOK_KODU?>" id="number" value="<?=$product->birimAdet ?? 1?>">
                                                        <div class="search-price-box">
                                                            <?php if ($product->discount > 0) { ?>
                                                                <!-- Üstü Çizili fiyatla ilgili ne yapılacağı konuşulacak -->
                                                                <div class="old-price"><?=number_format($product->fiyatTL,2,',','.')?> TL</div>
                                                                <div class="price <?=$product->stok == 0?'search-stok-yok':'search-stok-var'?>"><?=number_format($product->fiyatTL-($product->fiyatTL*$product->discount/100),2,',','.')?> TL</div>
                                                            <?php }else{ ?>
                                                                <div class="price <?=$product->stok == 0?'search-stok-yok':'search-stok-var'?>"><?=number_format($product->fiyatTL,2,',','.')?> TL</div>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="search-basket-box">
                                                            <div class="addBasket search-addBasket" onclick="addToCartListingFull('<?=$product->STOK_KODU?>','<?=$product->CARI_KOD?>')">Sepete Ekle <i class="fa fa-angle-right" aria-hidden="true"></i></div>
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
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</section>
<div class="filtershow">
    <p>
        FİLTRELE
    </p>
</div>

<script>
    var scrollLast = 2500;
    var page = 1;

    $(window).scroll(function () {
        var scroll = $(window).scrollTop();
        if (scroll >= scrollLast) {
            scrollLast = scrollLast + 3400;
            page++;
            getData(page);
        }
    });

    function getData(l) {
        var data = {};
        data.filter = <?=json_encode($filterData)?>;
        data.kod3   = <?=$kod3?>;
        $.ajax({url: site_url+'Ajax/getListingPage/'+l,
            method:'POST',
            dataType : 'JSON',
            data:data,
            success: function(result){
                var addProduct = '';
                if (result.status == true) {
                    var addProduct = '';
                    $.each(result.data,function(key,val) {
                        addProduct += '\
                                <div class="item col-lg-edit-3 col-md-edit-4 col-md-6 col-sm-6 col-6">\
                                    <div class="list-item Small">\
                                        <div class="search-area-img">\
                                            <img src="'+site_url+val.markaImage+'">\
                                        </div>\
                                        <div class="list-img">\
                                            <!--<span class="ribbon new"><span>Yeni</span></span>-->\
                                            <a href="'+site_url+val.url+'" class="img-link"><img src="https://otoparcasan.com/assets/Front/images/Detail/detail-img3.webp" alt=""></a>\
                                        </div>\
                                        <div class="list-content">\
                                            <div class="product-stars stars-search-page">\
                                                <div class="item">\
                                                    <i class="fa fa-star OK" aria-hidden="true"></i>\
                                                    <i class="fa fa-star OK" aria-hidden="true"></i>\
                                                    <i class="fa fa-star OK" aria-hidden="true"></i>\
                                                    <i class="fa fa-star OK" aria-hidden="true"></i>\
                                                    <i class="fa fa-star" aria-hidden="true"></i>\
                                                </div>\
                                                <div class="item">\
                                                    <p class="comment">(7 Yorum)</p>\
                                                </div>\
                                            </div>\
                                            <div class="product-head search-product-head">\
                                                <a href="'+site_url+val.url+'" class="ProductName">'+val.marka+' '+val.STOK_ADI+' '+val.montaj+'</a>\
                                                <p class="productInfo search-productInfo"><br>Stok Kodu : '+val.STOK_KODU+'</p>\
                                            </div>\
                                            <div class="product-control">';
                                                if (val.kargoGunu != 'YOK' && val.stok == 1) {
                                                    addProduct += '<div class="com-item listing-search-item">\
                                                                        <div class="com-block">\
                                                                            <svg width="20" height="20">\
                                                                                <image xlink:href="<?=site_url('assets/Front/')?>images/Icons/time.svg" src="svg.png" width="20" height="20" />\
                                                                            </svg>\
                                                                        </div>\
                                                                        <p>En Geç <?=$product->kargoGunu?> Kargoda</p>\
                                                                    </div>';
                                                }
                                                    addProduct += '<div class="product-Price search-product-price">\
                                                                        <input type="hidden" name="number_'+val.STOK_KODU+'" id="number" value="'+val.birimAdet+'">\
                                                        <div class="search-price-box">';
                                                            if (val.discount > 0) {
                                                                if (val.stok == 1) {
                                                                    addProduct += '<div class="old-price">'+val.oldPrice+' TL</div>\
                                                                    <div class="price search-stok-var"> '+val.newPrice+' TL</div>';
                                                                }else{
                                                                    addProduct += '<div class="old-price">'+val.oldPrice+' TL</div>\
                                                                    <div class="price search-stok-yok"> '+val.newPrice+' TL</div>';
                                                                }
                                                            }else{
                                                                if (val.stok == 1) {
                                                                    addProduct += '<div class="price search-stok-var">'+val.newPrice+' TL</div>';
                                                                }else{
                                                                    addProduct += '<div class="price search-stok-yok">'+val.newPrice+' TL</div>';
                                                                }
                                                            }
                                                        addProduct += '</div>\
                                                        <div class="search-basket-box">\
                                                            <div class="addBasket search-addBasket" onclick="addToCartListingFull(\''+val.STOK_KODU+'\',\''+val.CARI_KOD+'\')">Sepete Ekle <i class="fa fa-angle-right" aria-hidden="true"></i></div>\
                                                        </div>\
                                                    </div>\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </div>';
                    });
                    $('.addProduct').append(addProduct);
                }
            },
            error:function(){

            }
        }
        );
        
    }
</script>