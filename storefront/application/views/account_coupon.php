<!-- pageContent -->
<section class="pageContent AddressPage">
	<div class="container-fluid">
		<div class="row">
            <?php $this->load->view('account_menu'); ?>
			<div class="col-md">
				<div class="pageTitle">Kuponlarım</div>
				<p class="small mt-2 mb-3">Kazandığınız hediye kuponları aşağıda listelenmiştir. Bu hediye kuponlarını geçerlilik tarihleri içinde kullanmadığınızda iptal edilirler. İptal edilen hediye kuponları yeniden aktif edilmezler.</p>
				<div class="FavItem CouponCode">
					<div class="row">
						<div class="col-lg-3">
							<div class="productPrice text-center">
								<div class="productPrice">%10 İndirim</div>
							</div>
						</div>
						<div class="col-lg-7">
							<div class="productDetail CouponDetail">
								<div class="productInfo">
									<p href="#" class="productName">Kupon Kodu : <b>85611-1002-4845</b></p>
									<div>
										<span>Kupon bitişi : <b>12.10.2019 - 22:24</b></span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-2">
							<span class="couponstatus">Kullanıldı</span>
						</div>
					</div>
				</div>

				<div class="empty_page">
					<div class="Icon"><img src="<?=site_url('assets/Front/images/Icons/fav_empty.webp')?>" alt=""></div>
					<div class="T">Kupon Bulunamadı.</div>
					<div class="sT">Daha çok alışveriş yapın. Aldıkça Kazanın</div>

					<a href="index.php" class="global-btn">Alışverişe Başla</a>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- / pageContent -->