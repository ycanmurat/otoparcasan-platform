<!-- pageContent -->
<section class="pageContent AddressPage">
	<div class="container-fluid">
		<div class="row">
            <?php $this->load->view('account_menu'); ?>
			<div class="col-md">
				<div class="pageTitle">Favorilerim</div>
                <?php if ($favorites == false) { ?>
                    <div class="empty_page">
                        <div class="Icon"><img src="<?=site_url('assets/Front/images/Icons/fav_empty.webp')?>" alt=""></div>
                        <div class="T">Favorileriniz Ürün Bulunamadı.</div>
                        <div class="sT">Beğendiğiniz ürünleri daha sonra tekrar incelemek isterseniz favorilerinize ekleyebilirsiniz.</div>

                        <a href="<?=site_url()?>" class="global-btn">Alışverişe Başla</a>
                    </div>
                <?php }else{ ?>
                    <?php foreach ($favorites as $key => $val) { ?>
                        <div class="FavItem">
        					<div class="row">
        						<div class="col-lg">
        							<div class="productDetail">
        								<div class="Img"><img src="<?=site_url('assets/Front/images/cart-item.webp')?>" alt=""></div>
        								<div class="productInfo">
        									<a href="product-detail.php" class="productName">TRIPLE QX Tam Sentetik Motor Yağı - 5W-40 - 5 Litre</a>
        									<div>
        										<span>Ürün Kodu : 2151552</span>
        									</div>
        								</div>
        							</div>
        						</div>
        						<div class="col-sm-auto">
        							<div class="productPrice">
        								<div class="productPrice">199,23 TL</div>
        							</div>
        						</div>
        						<div class="col-sm">
        							<div class="favControl">
        								<a href="product-detail.php" class="global-btn">Ürünü İncele</a>
        								<div class="global-btn Remove"><i class="fa fa-trash-o" aria-hidden="true"></i></div>
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