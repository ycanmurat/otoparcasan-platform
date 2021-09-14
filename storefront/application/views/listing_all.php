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
                                <li class="breadcrumb-list-item active">
                                    <a class="breadcrumb-list-link mobil-bread-link" href="<?=$this->agent->referrer()?>">
                                        <i class="fa fa-angle-left mobil-bread-icon" aria-hidden="true"></i>
                                        <?=replaceStringProblemsReverse($selectedCategori->GRUP_ISIM ?? '')?>
                                    </a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
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
                <br>
            </div>
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
                    <input type="hidden" value="<?=$filterData->p?>" name="p">
                    <div class="listing-filter">
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
                                            <input class="Checkbox__Input FilterItemMontaj" id="montaj_<?=$val->GRUP_KOD?>" onclick="filterDoit()" checked value="<?=$val->GRUP_KOD?>" name="y[]" type="checkbox">
                                            <label class="Checkbox__Label" for="montaj_<?=$val->GRUP_KOD?>"><?=replaceStringProblemsReverse($val->GRUP_ISIM)?> <span class="Count">(<?=$val->count?>)</span></label>
                                        </div>
                                        <?php } ?>
                                        <?php } ?>
                                        <?php foreach ($montaj as $key => $val) { ?>
                                        <?php if (!(in_array($val->GRUP_KOD,$filterData->y))) { ?>
                                        <div class="Item">
                                            <input class="Checkbox__Input FilterItemMontaj" id="montaj_<?=$val->GRUP_KOD?>" value="<?=$val->GRUP_KOD?>" onclick="filterDoit()" name="y[]" type="checkbox">
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
                                            <input class="Checkbox__Input FilterItemMarka" id="marka_<?=$val->GRUP_KOD?>" onclick="filterDoit()" checked value="<?=$val->GRUP_KOD?>" name="m[]" type="checkbox">
                                            <label class="Checkbox__Label" for="marka_<?=$val->GRUP_KOD?>"><?=replaceStringProblemsReverse($val->GRUP_ISIM)?> <span class="Count">(<?=$val->count?>)</span></label>
                                        </div>
                                        <?php } ?>
                                        <?php } ?>
                                        <?php foreach ($brands as $key => $val) { ?>
                                        <?php if (!(in_array($val->GRUP_KOD,$filterData->m))) { ?>
                                        <div class="Item">
                                            <input class="Checkbox__Input FilterItemMarka" id="marka_<?=$val->GRUP_KOD?>" onclick="filterDoit()" value="<?=$val->GRUP_KOD?>" name="m[]" type="checkbox">
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
                        <div class="row addProduct">
                            <?php foreach ($products as $key => $product) { ?>
                            <div class="item col-lg-edit-3 col-md-edit-4 col-md-6 col-sm-6 col-6">
                                <div class="list-item Small">
                                    <div class="search-area-img">
                                        <img src="<?=site_url($product->markaImage) ?? ''?>">
                                    </div>
                                    <?php if ($product->yerli == 1) { ?>
                                    <div style="position: absolute;top: 20px;z-index: 1;right: 18px;font-weight: bold;color:#188ACC;font-size: 11px;">
                                        <p>Popüler</p>
                                    </div>
                                    <?php } ?>
                                    <div class="list-img">
                                        <a href="<?=site_url($product->url)?>" class="img-link"><img src="<?=site_url('assets/products/'.$selectedCategori->slug.'.png')?>" onerror="this.onerror=null;this.src='https://otoparcasan.com/assets/products/urun-gorseli-hazirlanmaktadir.png';"></a>
                                    </div>
                                    <div class="list-content">
                                        <div class="product-stars stars-search-page">
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
            <?php } ?>
        </div>
    </div>
</div>
</div>
</div>
</section>
<?php if ($products != array()) { ?>
<div class="filtershow">
    <p>FİLTRELE</p>
</div>
<?php } ?>
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
<a href="'+site_url+val.url+'" class="img-link"><img src="<?=site_url('assets/products/'.$selectedCategori->slug.'.png')?>" onerror="this.onerror=null;this.src=\'https://otoparcasan.com/assets/products/urun-gorseli-hazirlanmaktadir.png\';" alt=""></a>\
</div>\
<div class="list-content">\
    <div class="product-stars stars-search-page">\
        <div class="item">';
            for (i = 0; i < 5 ; i++) {
                if (Math.floor(val.comments.star) > i) {
                    addProduct += '<i class="fa fa-star OK" aria-hidden="true"></i>';
                }else{
                    addProduct += '<i class="fa fa-star" aria-hidden="true"></i>';
                }
            }
addProduct += ' </div>\
                    <div class="item"><p class="comment">('+val.comments.comment+' Yorum)</p>\
                </div></div>\
<div class="product-head search-product-head">\
    <a href="'+site_url+val.url+'" class="ProductName">'+val.marka+' '+val.STOK_ADI+' '+val.montaj+'</a>\
    <p class="productInfo search-productInfo"><br>Stok Kodu : '+val.STOK_KODU+'</p>\
</div>\
<div class="product-control">';
    if (val.kargoGunu != 'YOK' && val.stok == 1) {
    addProduct += '<div class="com-item listing-search-item">\
        <div class="com-block">\
            <svg width="20" height="20">\
                <image xlink:href="'+site_url+'assets/Front/images/Icons/time.svg" src="svg.png" width="20" height="20" />\
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