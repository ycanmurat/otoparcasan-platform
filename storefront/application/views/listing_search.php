<!-- pageContent -->
<section class="pageContent ListingPage ListingFull">
    <div class="container-fluid">
        <div class="row">
            <?php if ($products == array()) { ?>
                <div class="col-md">
                    <div class="product-notfounded">
                        <img src="<?=site_url('assets/Front/')?>images/Icons/negative-button.svg" src="svg.png">
                        <h2>Ürün Bulunamadı !</h2>
                        <a class="error-button" href="index.php">
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
                        <input type="hidden" value="<?=$filterData->s?>" name="s">
                        <input type="hidden" value="<?=$filterData->p?>" name="p">
                        <div class="listing-filter">
                            <div class="Filter-Area">
                                <div class="filter-column">
                                    <div class="filter-title">Sıralama Tipi</div>
                                    <div class="filter-list">
                                        <div id="filter-oncelik" class="ListGroup">
                                            <div class="Item">
                                                <input class="Checkbox__Input FilterItemTab" onclick="filterDoit()" <?=$filterData->o=='p'?'checked':''?> id="price" value="p" name="o" type="radio">
                                                <label class="Checkbox__Label" for="price">Fiyata Öncelikli</label>
                                            </div>
                                            <div class="Item">
                                                <input class="Checkbox__Input FilterItemTab" onclick="filterDoit()" id="shiping" <?=$filterData->o=='f'?'checked':''?> value="f" name="o" type="radio">
                                                <label class="Checkbox__Label" for="shiping">Kargo Süresi Öncelikli</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if (!empty($kategori)) { ?>
                            <div class="Filter-Area">
                                <div class="filter-column">
                                    <div class="filter-title">Kategori</div>
                                    <div class="filter-list">
                                        <div class="FilterSearch">
                                            <input type="text" class="jquery_filter" data-search-items-wrapper-id="#filter-kategori" data-search-item-class=".Item" data-search-classes="label" autocomplete="off">
                                        </div>
                                        <div id="filter-kategori" class="ListGroup">
                                            <?php foreach ($kategori as $key => $val) { ?>
                                                <div class="Item">
                                                    <input class="Checkbox__Input FilterItemMontaj" onclick="filterDoit()" id="montaj_<?=$val->GRUP_KOD?>" <?=in_array($val->GRUP_KOD,$filterData->k)?'checked':''?> value="<?=$val->GRUP_KOD?>" name="k[]" type="checkbox">
                                                    <label class="Checkbox__Label" for="montaj_<?=$val->GRUP_KOD?>"><?=replaceStringProblemsReverse($val->GRUP_ISIM)?> <span class="Count">(<?=$val->count?>)</span></label>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
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
                                                    <div class="Item">
                                                        <input class="Checkbox__Input FilterItemMontaj" onclick="filterDoit()" id="montaj_<?=$val->GRUP_KOD?>" <?=in_array($val->GRUP_KOD,$filterData->y)?'checked':''?> value="<?=$val->GRUP_KOD?>" name="y[]" type="checkbox">
                                                        <label class="Checkbox__Label" for="montaj_<?=$val->GRUP_KOD?>"><?=replaceStringProblemsReverse($val->GRUP_ISIM)?> <span class="Count">(<?=$val->count?>)</span></label>
                                                    </div>
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
                                                <div class="Item">
                                                    <input class="Checkbox__Input FilterItemMarka" id="marka_<?=$val->GRUP_KOD?>" <?=in_array($val->GRUP_KOD,$filterData->m)?'checked':''?> value="<?=$val->GRUP_KOD?>" name="m[]" type="checkbox">
                                                    <label class="Checkbox__Label" for="marka_<?=$val->GRUP_KOD?>"><?=replaceStringProblemsReverse($val->GRUP_ISIM)?> <span class="Count">(<?=$val->count?>)</span></label>
                                                </div>
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
                            <div class="row addProduct">
                                <div class="col-12" style="margin-bottom: 15px">
                                    <p>"<b><?=$filterData->s?></b>" kelimesi aramanızda <b><?=$markaCount?></b> Markadan <b><?=$categoryCount?></b> Kategoride <b><?=$productCount?></b> Ürün Bulundu.</p>
                                </div>
                                <?php foreach ($products as $key => $product) { ?>
                                    <div class="item col-lg-edit-3 col-md-edit-4 col-md-6 col-sm-6 col-6">
                                        <div class="list-item Small">
                                            <div class="search-area-img">
                                                <img src="<?=site_url($product->markaImage) ?? ''?>">
                                            </div>
                                            <div class="list-img">
                                                <!--<span class="ribbon new"><span>Yeni</span></span>-->
                                                <a href="<?=site_url($product->url)?>" class="img-link"><img src="<?=site_url('assets/products/'.$product->KOD_3.'.png')?>" onerror="this.onerror=null;this.src='https://otoparcasan.com/assets/products/urun-gorseli-hazirlanmaktadir.png';" alt=""></a>
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
                                                    <a href="<?=site_url($product->url)?>" class="ProductName search-ProductName"><?=$product->marka.' '.mb_ucwords(replaceStringProblemsReverse($product->STOK_ADI),'UTF-8').' '.mb_ucwords(replaceStringProblemsReverse($product->montaj),'UTF-8')?></a>
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
                                                    <?php } else { ?>
                                                        <div class="com-item listing-search-item" style="opacity: 0;">
                                                            <div class="com-block">
                                                                <svg width="20" height="20">
                                                                    <image xlink:href="<?=site_url('assets/Front/')?>images/Icons/time.svg" src="svg.png" width="20" height="20" />
                                                                </svg>
                                                            </div>
                                                            <p></p>
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
    <p>
        FİLTRELE
    </p>
</div>
<?php } ?> 

<script>
    var scrollLast = 3400;
    var limit = 1;

    $(window).scroll(function () {
        var scroll = $(window).scrollTop();
        if (scroll >= scrollLast) {
            console.log('gelecek');
            scrollLast = scrollLast + 3400;
            limit++;
            getData(limit);
        }
    });

    function getData(l) {
        var filter = <?=json_encode($filterData)?>;
        console.log(filter);
        $.ajax({url: 'Ajax/getSearchPage/'+l,
            method:'POST',
            dataType : 'JSON',
            data:filter,
            success: function(result){
                var addProduct = '';
                console.log(result);
                if (result.status == true) {
                    var addProduct = '';
                    $.each(result.data,function(key,val) {
                        addProduct += '\
                                <div class="item col-lg-edit-3 col-md-edit-4 col-md-6 col-sm-6 col-6">\
                                    <div class="list-item Small">\
                                        <div class="search-area-img">\
                                            <img src="'+val.markaImage+'">\
                                        </div>\
                                        <div class="list-img">\
                                            <!--<span class="ribbon new"><span>Yeni</span></span>-->\
                                            <a href="'+site_url+val.url+'" class="img-link"><img src="'+site_url+'assets/products/'+val.KOD_3+'.png" alt="" onerror="this.onerror=null;this.src=\'https://otoparcasan.com/assets/products/urun-gorseli-hazirlanmaktadir.png\';"></a>\
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