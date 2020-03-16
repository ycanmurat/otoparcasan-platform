<div class="big-searchLoading gizle"><img src="<?=site_url('assets/Front/images/tenor.gif')?>"></div>
<!-- pageContent -->
<section class="pageContent Cart_Page">
	<div class="container-fluid">
		<div class="row urunYok">
			<div class="col-12">
				<div class="empty_page">
					<div class="Icon"><img src="<?=site_url('assets/Front/images/Icons/empty_icon.webp')?>" alt=""></div>
					<div class="T">Sepetinizde Ürün Bulunamadı.</div>
					<div class="sT">Sepetinize ürün ekleyip güvenle satın alabilirsiniz.</div>

					<a href="<?=site_url('Category')?>" class="global-btn">Alışverişe Başla</a>
				</div>
			</div>
		</div>
		<div class="row urunVar" style="display: none;">
			<div class="col-12"><div class="pageTitle">Sepet <span class="sub">(sepetinizde 3 ürün bulunmaktadır)</span></div></div>
			<div class="col-12 col-lg">
				<div class="cartArea">

				</div>
				<div class="remove-area"><div class="all-remove-items"><i class="fa fa-trash-o" aria-hidden="true"></i> Sepeti Boşalt</div></div>
			</div>
			<div class="col-12 col-lg-auto">
                <div class="adition-area">
                    <div class="cart-addition">
                       <div class="T">Sipariş Özeti</div>

                       <div class="addition-item">
                          <div class="item">Ara Toplam</div>
                          <div class="item araToplamPrice"></div>
                      </div>

                      <div class="addition-item">
                          <div class="item">KDV</div>
                          <div class="item kdvPrice"></div>
                      </div>

                      <div class="addition-item">
                          <div class="item">Kargo</div>
                          <div class="item kargoPrice">Ücretsiz</div>
                      </div>

                      <div class="addition-item">
                          <div class="item">Kampanya İndirimi</div>
                          <div class="item Colored indirimPrice"></div>
                      </div>

                      <div class="addition-total addition-item">
                          <div class="item">toplam</div>
                          <div class="item totalPrice"></div>
                      </div>
                  </div>

                  <a href="<?=site_url('Basket/address')?>" class="global-btn d-block text-center mt-3">Sepeti Onayla</a>
                  <a href="<?=site_url('Basket/address')?>" class="global-btn d-block update text-center mt-3">Sepeti Güncelle</a>
              </div>
          </div>
      </div>
  </div>
</section>
<!-- / pageContent -->

<script>
    $(document).ready(function() {
        var total = 0;
        $('.big-searchLoading').removeClass('gizle');
        var localProducts = localStorage.getItem('ops-products');
        if (localProducts) {
            localProducts = JSON.parse(localProducts);
            if (localProducts.count != 0) {
                $('.sub').text('(sepetinizde '+localProducts.count+' adet ürün bulunmaktadır)');
                $.ajax({
                    url: site_url+'Ajax/getToCart/',
                    method:'POST',
                    dataType : 'JSON',
                    data : {data:localProducts},
                    success: function(result){
                        if (result.status == 1) {
                            var dataTxt = '';
                            console.log(localProducts.products);
                            console.log(result);
                            $.each(localProducts.products, function( key, val ) {
                                $.each(result.data, function(key2, val2) {
                                    if (val.stok_kodu == val2.STOK_KODU) {
                                        total += val.price;
                                        dataTxt += '<div class="cartProductItem">\
                                        <div class="row">\
                                        <div class="col-md-6 col-sm-8">\
                                        <div class="cart_product_info">\
                                        <div class="productImg"><img src="https://fakeimg.pl/500x500/" alt=""></div>\
                                        <div class="productInfo">\
                                        <a href="<?=site_url("Product/details/")?>'+val.url+'" class="product-link">'+val.name+'</a>\
                                        <p>Adet : '+val.count+'</p>\
                                        <p>Ürün Kodu : '+val.stok_kodu+'</p>\
                                        </div>\
                                        </div>\
                                        </div>\
                                        <div class="col-md-6 col-sm-4">\
                                        <div class="row">\
                                        <div class="col-md-6 col-sm-12 col-auto">\
                                        </div> \
                                        <div class="col-md-6 col-sm-12 col-auto">\
                                        <div class="priceInfo">\
                                        <div class="price">'+currencyFormatDE(val.price)+' TL<span class="old">'+currencyFormatDE(val.oldPrice)+'TL</span></div>\
                                        </div>\
                                        </div>\
                                        </div>\
                                        </div>\
                                        </div>\
                                        <div class="removeCart" onclick="cartProductDelCartPage('+key+')"><i class="fa fa-trash-o" aria-hidden="true"></i></div>\
                                        </div>';
                                    }
                                });
                            });

                            $('.cartArea').html(dataTxt);
                            $('.araToplamPrice').text(currencyFormatDE(total)+' TL')
                            $('.urunVar').css('display','flex');
                            $('.urunYok').css('display','none');
                        }

                        $('.big-searchLoading').addClass('gizle');
                    },error:function(result) {
                        $('.big-searchLoading').addClass('gizle');
                        Swal.fire({type: 'error', title: 'Hata !', html: 'Üzgünüz Teknik Bir Sorun İle Karşı Karşıyayız', animation: false, customClass: 'animated tada'});
                    }
                });
            }else{
                $('.big-searchLoading').addClass('gizle');
            }
        }
    });
</script>