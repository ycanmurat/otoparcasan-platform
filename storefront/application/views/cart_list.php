<!-- pageContent -->
<input type="hidden" id="giftCheckId" value="0">
<section class="pageContent Cart_Page basket-bars">
	<div class="container-fluid">
		<div style="height: 500px;" class="yukleninceKapat"></div>

		<div class="row urunYok" style="display: none;">
			<div class="col-12">
				<div class="empty_page">
					<div class="Icon"><img src="<?=site_url('assets/Front/images/Icons/empty_icon.webp')?>" alt=""></div>
					<div class="T">Sepetinizde Ürün Bulunamadı.</div>
					<div class="sT">Sepetinize ürün ekleyip güvenle satın alabilirsiniz.</div>

					<a href="<?=site_url('yedek-parcalar')?>" class="global-btn">Alışverişe Başla</a>
				</div>
			</div>
		</div>
		<div class="row urunVar" style="display: none;">
			<div class="col-12 cargoEksik" style="display: none">
				<div class="alert alert-success" role="alert">
					
				</div>
			</div>
			<div class="col-12"><div class="pageTitle">Sepet <span class="sub">(sepetinizde 3 ürün bulunmaktadır)</span></div></div>
			<div class="col-12">
				<div class="basket-bars-area">
					<div class="basket-bars-box">
						<div class="basket-bars-number">
							<p class="active">
								1
							</p>
						</div>
						<span>
							Sipariş Sepet
						</span>
						<div class="basket-bars-decor">
							<i class="fa fa-angle-right" aria-hidden="true"></i>
						</div>
					</div>
					<div class="basket-bars-box">
						<div class="basket-bars-number">
							<p>
								2
							</p>
						</div>
						<span>
							Teslimat Bilgileri
						</span>
						<div class="basket-bars-decor basket-bars-mobile">
							<i class="fa fa-angle-right" aria-hidden="true"></i>
						</div>
					</div>
					<div class="basket-bars-box">
						<div class="basket-bars-number">
							<p>
								3
							</p>
						</div>
						<span>
							Ödeme Bilgileri
						</span>
						<div class="basket-bars-decor basket-bars-mobile-last">
							<i class="fa fa-angle-right" aria-hidden="true"></i>
						</div>
					</div>
					<div class="basket-bars-box">
						<div class="basket-bars-number">
							<p>
								4
							</p>
						</div>
						<span>
							Sipariş Tamamlandı
						</span>
						<div class="basket-bars-decor-end">

						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-lg">
				<div class="cartArea">
				</div>
				<div class="remove-area"><div class="all-remove-items" onclick="removeAllToCart()"><i class="fa fa-trash-o" aria-hidden="true"></i> Sepeti Boşalt</div></div>
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

						<div class="addition-item addition-last">
							<div class="item">Kargo</div>
							<div class="item kargoPrice">Ücretsiz</div>
						</div>

                    <!--
                      <div class="addition-item">
                          <div class="item">Kampanya İndirimi</div>
                          <div class="item Colored indirimPrice"></div>
                      </div>
                  -->

                  <div class="basket-quantiy-box">

                  </div>
                  <div class="addition-total addition-item addition-last">
                  	<div class="item">toplam</div>
                  	<div class="item totalPrice"></div>
                  </div>
              </div>
              <div class="money-discount">
              	<input type="text" id="giftCheck" name="discount" placeholder="İndirim Kodu ...">
              	<button type="submit">Kullan</button>
              </div>   
              <div class="basket-comment">
              	<textarea rows="4" id="order_note" placeholder="Sipariş notunuz..."></textarea>
              </div>
              <div class="basket-promise">
              	<div class="basket-promise-box">
              		<section title="squaredThree">
              			<div class="squaredThree">
              				<input type="checkbox" value="None" id="hizmet" name="check"/>
              				<label for="hizmet"></label>
              			</div>
              		</section>
              		<p>
              			<button class="basket-promise-modal" type="button" class="btn btn-primary" data-toggle="modal" data-target="#service-modal">
              				Hizmet Sözleşmesi
              			</button>
              		</p>
              	</div>
              	<div class="basket-promise-box">
              		<section title="squaredThree">
              			<div class="squaredThree">
              				<input type="checkbox" value="None" id="iptal" name="check"/>
              				<label for="iptal"></label>
              			</div>
              		</section>
              		<p>
              			<button class="basket-promise-modal" type="button" class="btn btn-primary" data-toggle="modal" data-target="#service-modal-2">
              				İptal, İade Koşulları ve Gizlilik Sözleşmesi
              			</button>
              		</p>
              	</div>
              </div>
              <a href="javascript:void(0)" class="global-btn d-block text-center mt-3" onclick="goToAdress()">Sepeti Onayla</a>
          </div>
      </div>
  </div>
</div>
</section>
<!-- / pageContent -->
<style>
	.red-border{
		border: 1px solid red !important;
		padding: 21px;
	}
</style>
<script>
	$(document).ready(function() {
		getCart();
	});
</script>

<div class="modal fade" id="service-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				...
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="service-modal-2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				...
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>