    <div class="MembershipHeader">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="membership-logo" style="cursor:pointer;" onclick="window.location.href = '<?=site_url()?>'">
                        <picture>
                            <img src="<?=site_url('assets/Front/images/logofinali.png')?>" alt="logo">
                        </picture>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="membership-sec">
                        <div class="security_text">Güvenli Ödeme</div>
                    </div>      
                </div>
            </div>
        </div>
    </div>
<!-- / cart_header -->

<!-- pageContent -->
<section class="pageContent Cart_Page">
	<div class="container">
		<div class="row">
                        <div class="col-12">
                <div class="basket-bars-area">
                    <div class="basket-bars-box">
                        <div class="basket-bars-number">
                            <p>
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
                            <p class="active">
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
			<div class="col-12">
				<div class="cart_result">
					<div class="result_head">
						<div class="Icon"><img class="box-success" src="<?=site_url('assets/Front/images/Icons/box-checked.svg')?>" alt="Başarılı"></div>
						<div class="head_t">Her şey yolunda</div>

						<p>Siparişiniz bize ulaştı. Sipariş Numaranız : <b><?=$order->order->id?></b></p>
						<p>Ödemeniz Banka Dökümünüzde PayTR veya Otoparçasan Olarak Görünebilir.</p>
					</div>
					<div class="result_body">
						<div class="result_info">
							<div class="T box-success-title">Sipariş Özeti :</div>
                            
                            <p><strong>Kargo Adresi :</strong> <?=$order->shiping_address->content?></p>
							<p><strong>Fatura Adresi :</strong> <?=$order->billing_address->content?></p>
							<p><strong>Ad Soyad :</strong> <?=$order->shiping_address->name?></p>
							<p><strong>İletişim Tel :</strong> <?=$order->shiping_address->gsm?></p>
							<p><strong>Toplam Sipariş Tutarı :</strong> <?=number_format($order->price,2,',','.')?> TL</p>
						</div>

						<div class="result_info">
							<div class="T">Ürünler :</div>
							<?php foreach ($order->lines as $key => $val) { ?>
    							<div class="result-item">
    								<div class="row">
    									<div class="col-sm">
    										<div class="result-product-info">
    											<div class="Img"><img src="<?=site_url('assets/products/'.$val->kod3)?>.png" alt=""></div>
    											<div class="Text-area">
    												<div class="pName"><?=$val->name?></div>
                                                    <div class="badge">Ürün Kodu : <?=$val->stok_id?></div>
    												<div class="adet">Adet : <?=(int)$val->count?></div>
    											</div>
    										</div>
    									</div>
    									<div class="col-sm-auto">
    										<div class="result-price"><?=number_format($val->price,2,',','.')?> TL</div>
    									</div>
    								</div>
    							</div>
                            <?php } ?>
						</div>
					</div>
				</div>

				<div class="mt-4 text-center"><a href="<?=site_url()?>" class="global-btn">Anasayfa'ya Dön</a></div>
			</div>
		</div>
	</div>
</section>
<script>
    localStorage.removeItem('ops-products');
</script>
<!-- / pageContent -->

