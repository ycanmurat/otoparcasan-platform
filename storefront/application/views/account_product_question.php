<!-- pageContent -->
<section class="pageContent AddressPage">
	<div class="container-fluid">
		<div class="row">
            <?php $this->load->view('account_menu'); ?>
			<div class="col-md">
				<div class="pageTitle">Ürün Sorularım</div>
                <?php if ($questions == false) { ?>
                    <div class="empty_page">
                        <div class="Icon"><img src="<?=site_url('assets/Front/images/Icons/fav_empty.webp')?>" alt=""></div>
                        <div class="T">Daha Önce Hiçbir Ürüne Soru Sormadınız</div>
                        <div class="sT">Sorularınızı cevaplamak için hazırda bekliyoruz.</div>

                        <a href="<?=site_url()?>" class="global-btn">Alışverişe Başla</a>
                    </div>
                <?php }else{ ?>
                    <?php foreach ($questions as $key => $val) { ?>
        				<div class="FavItem">
        					<div class="row">
        						<div class=" col-xl-6 col-lg-6 col-sm-8 col-8">
        							<div class="productDetail">
        								<div class="Img"><img src="<?=site_url('assets/Front/images/cart-item.webp')?>" alt=""></div>
        								<div class="productInfo">
        									<a href="<?=site_url('Product/details')?>" class="productName">TRIPLE QX Tam Sentetik Motor Yağı - 5W-40 - 5 Litre</a>
        									<div>
        										<span>Ürün Kodu : 2151552</span>
        									</div>
        								</div>
        							</div>
        						</div>
        						<div class=" col-xl-2 col-lg-3 col-sm-4 col-4">
        							<div class="productPrice">
        								Cevaplandı
        							</div>
        						</div>
        						<div class=" col-xl-4 col-lg-3 col-sm-12 col-12">
        							<div class="favControl">
        								<a href="<?=site_url('Product/details')?>" class="global-btn">Cevaba Git</a>
        							</div>
        						</div>
        					</div>
        				</div>
                    <?php } ?>
                <?php } ?>
			</div>
		</div>
	</div>
</section>
<!-- / pageContent -->