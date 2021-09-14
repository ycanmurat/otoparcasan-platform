<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Sipariş Detay
			</h3>
			<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
				<li class="m-nav__item m-nav__item--home">
					<a href="<?=admin_url()?>" class="m-nav__link m-nav__link--icon">
						<i class="m-nav__link-icon la la-home"></i>
					</a>
				</li>
				<li class="m-nav__separator">
					>
				</li>
				<li class="m-nav__item">
					<a href="<?=admin_url('Order?s=1')?>" class="m-nav__link">
						<span class="m-nav__link-text">
							Sipariş Listele
						</span>
					</a>
				</li>
				<li class="m-nav__separator">
					>
				</li>
				<li class="m-nav__item">
					<a href="<?=$this->agent->referrer()?>" class="m-nav__link">
						<span class="m-nav__link-text">
							Geri Dön
						</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
</div>
<div class="m-content">
	<div class="row">
		<div class="col-lg-12">
			<div class="m-portlet">
				<div class="m-portlet__head">
					<div class="m-portlet__head-caption">
						<div class="m-portlet__head-title">
							<h3 class="m-portlet__head-text">
								Sipariş Detayı <small>Sipariş Numarası: <b><?=$order->id?></b></small>
							</h3>
						</div>
					</div>
				</div>
				<div class="m-portlet__body">
					<!--begin: Search Form -->
					<div class="m-form m-form--label-align-right m--margin-bottom-10">
						<form action="<?=admin_url('Order')?>?s=1" method="GET">
							<div class="order_detail">
								<div class="row order_row">
									<div class="col-4">
										<h6>Sipariş Durumu</h6>
										<div class="alert alert-<?=admin_order_status_color($order->order_status_inside)?>" role="alert">
											<?=admin_order_status($order->order_status_inside)?>
										</div>
									</div>
									<div class="col-4">
										<h6>Ödeme Durumu</h6>
										<div class="alert alert-<?=payment_status_color($order->payment_status)?>" role="alert">
											<?=payment_status($order->payment_status)?>
										</div>
									</div>
                                    <div class="col-2">
                                        <?php if ($missingProduct>0 && $order->order_status != 4) { ?>
                                            <a href="<?=site_url('Admin/Order/missingProductSuccess/'.$order->id)?>" class="btn btn-outline-success" >Eksik Ürünleri Onaylandı</a>
                                        <?php } ?>
                                    </div>
                                    <div class="col-2">
                                        <?php if ($order->order_status_inside < 5) { ?>
                                            <a href="<?=site_url('Admin/Order/orderCancel/'.$order->id)?>" class="btn btn-outline-danger">Siparişi İptal Et</a>
                                        <?php } ?>
                                    </div>
								</div>
								<div class="row order_row">
									<h5 class="w-100 pt-3">Genel Bilgi</h5>
									<div class="row w-100 text-right">
                                        <div class="col-md-2 col-lg-2 col-sm-6 mb-2 order-box">
                                            <h6>Sipariş Tarihi</h6>
                                            <h5><?=dateparse($order->added_time)?></h5>
                                        </div>
                                        <div class="col-md-2 col-lg-2 col-sm-6 mb-2 order-box">
                                            <h6>Sipariş Veren</h6>
                                            <h5><?=$order->user->name.' '.$order->user->surname?></h5>
                                        </div>
                                        <div class="col-md-2 col-lg-2 col-sm-6 mb-2 order-box">
                                            <h6>Üye GSM</h6>
                                            <h5><?=$order->user->phone?></h5>
                                        </div>
										<div class="col-md-2 col-lg-2 col-sm-6 mb-2 order-box">
											<h6>Toplam Tutar</h6>
											<h5 class="text-danger"><b><?=number_format($order->product_price, 2, ',', '.')?> TL</b></h5>
										</div>
										<div class="col-md-2 col-lg-2 col-sm-6 mb-2 order-box">
											<h6>Toplam Ürün Adedi</h6>
											<h5 class="text-warning"><?=(int)$order->count?></h5>
										</div>
                                        <div class="col-md-2 col-lg-2 col-sm-2 mb-2 order-box">
                                            <h6>Kargo Fiyatı</h6>
                                            <h5 class="text-danger"><?=$order->shipping_price==0?'Ücretsiz':number_format($order->shipping_price, 2, ',', '.').' TL'?></h5>
                                        </div>
									</div>
								</div>
								<div class="row order_row">
									<h5 class="w-100 pt-3">Ürünler</h5>
									<?php foreach ($order->lines as $key => $val){ ?>
    									<div class="row w-100 text-right mt-4 product-box">
                                            <div class="col-md-2 col-lg-2 col-sm-2 col-2 order-box">
                                                <h6>Ürün Durumu</h6>
                                                <span class="m-badge m-badge--<?=admin_order_status_color($val->status_inside)?> m-badge--wide" role="alert">
                                                    <?=admin_order_status($val->status_inside)?>
                                                </span>
                                            </div>
    										<div class="col-md-2 col-lg-2 col-sm-2 col-2 order-box">
    											<h6>Ürün Adı</h6>
    											<h5><?=$val->name?></h5>
    										</div>
    										<div class="col-md-2 col-lg-2 col-sm-2 col-2 order-box">
    											<h6>Satış Tutarı Tutar (Adet)</h6>
    											<h5 class="text-danger"><?=number_format($val->price,2,',','.')?> TL</h5>
    										</div>
                                            <div class="col-md-2 col-lg-2 col-sm-2 col-2 order-box">
                                                <h6>Ürün Adedi</h6>
                                                <h5 style="color:green"><?=(int)$val->count?></h5>
                                            </div>
                                            <div class="col-md-2 col-lg-2 col-sm-2 col-2 order-box">
                                                <h6>Stok Kodu</h6>
                                                <h5><?=$val->stok_id?></h5>
                                            </div>
                                            <div class="col-md-2 col-lg-2 col-sm-2 col-2 order-box">
                                                <h6>Tedarikçi</h6>
                                                <h5><?=$val->cari_id?></h5>
                                            </div>
    									</div>
									<?php } ?>
								</div>
								<div class="row order_row mt-3">
									<h5 class="w-100 pt-3">Kargo ve Adres</h5>
									<div class="row w-100 text-left">
										<p class="col-12">
											<span class="m-badge m-badge--success m-badge--wide">
												Teslimat Adresi
											</span>
										</p>
										<div class="col-md-6 col-lg-6 col-sm-6 mb-3 order-box">
											<h5>Adres Kimlik Bilgileri</h5>
                                            <hr>
											<h6><span class="m--font-bold">Tip:</span> <?=($order->address->corporate == 1 ? "Kurumsal":"Bireysel")?></h6>
											<h6><span class="m--font-bold">Ad Soyad:</span> <?=$order->address->name?></h6>
											<h6><span class="m--font-bold">Telefon:</span> <?=$order->address->gsm?></h6>
											<?php if ($order->address->corporate){ ?>
    											<h6><span class="m--font-bold">Firma Adı:</span> <?=$order->address->firm_name?></h6>
    											<h6><span class="m--font-bold">Vergi Numarası:</span> <?=$order->address->tax_no?></h6>
    											<h6><span class="m--font-bold">Vergi Dairesi:</span> <?=$order->address->tax_admin?></h6>
											<?php }else{ ?>
                                                <h6><span class="m--font-bold">TC Kimlik No:</span> <?=$order->address->identity_number?></h6>
                                            <?php } ?>
										</div>
										<div class="col-md-6 col-lg-6 col-sm-6 mb-3 order-box">
											<h5>Adres Bilgileri</h5>
                                            <hr>
											<h6><span class="m--font-bold">İl / İlçe:</span> <?=$order->address->city_name?> / <?=$order->address->town_name?></h6>
											<h6><span class="m--font-bold">Posta Kodu:</span> <?=$order->address->post_code?></h6>
											<h6><span class="m--font-bold">Adres:</span> <?=$order->address->content?></h6>
										</div>
										<p class="col-12">
                                            <span class="m-badge m-badge--warning m-badge--wide">
												Fatura Adresi
											</span>
										</p>
										<div class="col-md-6 col-lg-6 col-sm-6 mb-3 order-box">
                                            <h5>Adres Kimlik Bilgileri</h5>
                                            <hr>
											<h6><span class="m--font-bold">Tip:</span> <?=($order->invoice_address->corporate == 1 ? "Kurumsal":"Bireysel")?></h6>
											<h6><span class="m--font-bold">Ad Soyad:</span> <?=$order->invoice_address->name?></h6> 
											<h6><span class="m--font-bold">Telefon:</span> <?=$order->invoice_address->gsm?></h6>
											<h6><span class="m--font-bold">TC Kimlik No:</span> <?=$order->invoice_address->identity_number?></h6>
											<?php if ($order->invoice_address->corporate == 1){ ?>
    											<h6><span class="m--font-bold">Firma Adı:</span> <?=$order->invoice_address->firm_name?></h6>
    											<h6><span class="m--font-bold">Vergi Numarası:</span> <?=$order->invoice_address->tax_no?></h6>
    											<h6><span class="m--font-bold">Vergi Dairesi:</span> <?=$order->invoice_address->tax_admin?></h6>
											<?php }else{ ?>
                                                <h6><span class="m--font-bold">TC Kimlik No:</span> <?=$order->invoice_address->identity_number?></h6>
                                            <?php } ?>
										</div>
										<div class="col-md-6 col-lg-6 col-sm-6 mb-3 order-box">
                                            <h5>Adres Bilgileri</h5>
                                            <hr>
											<h6><span class="m--font-bold">İl / İlçe:</span> <?=$order->invoice_address->city_name?> / <?=$order->invoice_address->town_name?></h6> 
											<h6><span class="m--font-bold">Posta Kodu:</span> <?=$order->invoice_address->post_code?></h6> 
											<h6><span class="m--font-bold">Adres:</span> <?=$order->invoice_address->content?></h6>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div><!--end: Search Form -->
				</div>
			</div>
		</div>
	</div>
</div>