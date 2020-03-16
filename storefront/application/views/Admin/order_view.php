<?php
if ($order->user_id == 0) { $order->username = $order->iperson_name; }
?>
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
								Sipariş Detayı <small>Sipariş Numarası: <b><?=$orderno?></b></small>
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
										<div class="alert alert-<?=$orderstatus[$order->order_status]['color']?>" role="alert">
											<?=$orderstatus[$order->order_status]['text']?>
										</div>
									</div>
									<div class="col-4">
										<h6>Ödeme Durumu</h6>
										<?php if ($order->payment_status == 0) { ?>
											<div class="alert alert-danger" role="alert">
												Ödeme yapılmadı
											</div>
										<?php } else { ?>
											<div class="alert alert-success" role="alert">
												Ödeme yapıldı
											</div>
										<?php } ?>
									</div>
									<div class="col-4">
										<h6>Teslimat Durumu</h6>
										<?php if ($order->delivery_status == 0) { ?>
											<div class="alert alert-warning" role="alert">
												Teslim edilmeyi bekliyor
											</div>
										<?php } else { ?>
											<div class="alert alert-success" role="alert">
												Teslim edildi
											</div>
										<?php } ?>
									</div>
								</div>
								<div class="row order_row">
									<h5 class="w-100 pt-3">Genel Bilgi</h5>
									<div class="row w-100 text-right">
										<div class="col-md-3 col-lg-3 col-sm-6 mb-3 order-box">
											<h6>Sipariş Veren</h6>
											<h5><?=$order->username?></h5>
										</div>
										<div class="col-md-3 col-lg-3 col-sm-6 mb-3 order-box">
											<h6>Toplam Tutar</h6>
											<h5 class="text-danger"><?=number_format($order->toplam, 2, '.', ',')?> <?=$order->moneycode?></h5>
										</div>
										<div class="col-md-3 col-lg-3 col-sm-6 mb-3 order-box">
											<h6>Toplam Ürün Adedi</h6>
											<h5 class="text-warning"><?=$order->adet?></h5>
										</div>
									</div>
								</div>
								<div class="row order_row">
									<h5 class="w-100 pt-3">Ürünler</h5>
									<?php foreach ($products as $key => $val): ?>
									<div class="row w-100 text-right mt-4 product-box">
										<div class="col-md-4 col-lg-4 col-sm-4 col-4 order-box">
											<h6>Ürün Adı</h6>
											<h5><?=$val->product_name?></h5>
										</div>
										<div class="col-md-4 col-lg-4 col-sm-4 col-4 order-box">
											<h6>Toplam Tutar</h6>
											<h5 class="text-danger"><?=$val->price." ".$order->moneycode?></h5>
										</div>
										<div class="col-md-4 col-lg-4 col-sm-4 col-4 order-box">
											<h6>Döküman</h6>
											<?php if ($val->document == ""){ ?>
												<strong>-</strong>
											<?php } else {
												if (strlen($val->document)>5) {
													$document = json_decode($val->document);
													$i = 0;
													foreach ($document as $keyDocument => $valDocument) { 
														$i++; ?>
														<a href="<?=site_url($valDocument)?>" class="m-widget4__icon m--font-boldest" download>İndir <?=$i?><i class="la la-download"></i></a>
										<?php 		}
												}
											?>
											<?php } ?>
										</div>
										<div class="col-md-6 col-lg-6 col-sm-12 order-box">
											<h6>Varyantlar</h6>
											<?php
											 foreach ($val->selected_variants as $key2 => $val2) { ?>
												<h6><span class="m--font-bold"><?=$val2->variant_name?>:</span> <?=$val2->variant_child_name?></h6> 
											<?php } ?>
											<?=$val->design==1?'<h6>Tasarım : <font color="#34bfa3">Yapılacak</font></h6>':'<h6>Tasarım : <font color="#f4516c">Yapılmayacak</font></h6>'?>
										</div>
										<div class="col-md-6 col-lg-6 col-sm-12 order-box">
											<div style="height: 35%;margin-top: 10px;">
												<div class="row">
													<div class="col-md-3">
														Tahmini Kargo
													</div>
													<div class="col-md-6">
														<input type="date" class="form-control" id="TahminiKargo" value="<?=$val->tahmini_kargo?>">
													</div>
													<div class="col-md-3">
														<input type="button" onclick="KargoDateUpdate(<?=$val->Id?>,$('#TahminiKargo').val())" value="Güncelle" class="btn btn-success">
													</div>
												</div>
												<div class="row">
													<div class="col-md-3">
														Ürün Durumu
													</div>
													<div class="col-md-6">
														<input type="text" class="form-control" id="UrunDurumu_<?=$val->Id?>" value="<?=$val->product_status?>">
													</div>
													<div class="col-md-3">
														<input type="button" onclick="ProductUpdate(<?=$val->Id?>,$('#UrunDurumu_<?=$val->Id?>').val())" value="Güncelle" class="btn btn-success">
													</div>
												</div>
											</div>
											<br><br><br>
											<h6>Açıklama</h6>
											<h6><?=$val->description?></h6>
										</div>
									</div>
									<?php endforeach ?>
								</div>
								<div class="row order_row mt-3">
									<h5 class="w-100 pt-3">Kargo ve Adres</h5>
									<div class="row w-100 text-right">
										<div class="col-md-6 col-lg-6 col-sm-6 mb-3 order-box">
											<h6>Kargo Fiyatı</h6>
											<h5 class="text-danger"><?=number_format($order->shipping_price, 2, '.', ',')?> <?=$order->moneycode?></h5>
										</div>
										<p class="col-12">
											<span class="text-right m-badge m-badge--metal m-badge--wide">
												Teslimat Adresi
											</span>
										</p>
										<div class="col-md-6 col-lg-6 col-sm-6 mb-3 order-box">
											<h6>Adres Kimlik Bilgileri</h6>
											<h6><span class="m--font-bold">Tip:</span> <?=($order->corporate == 1 ? "Kurumsal":"Bireysel")?></h6>
											<h6><span class="m--font-bold">Ad Soyad:</span> <?=$order->address_person?></h6>
											<h6><span class="m--font-bold">Telefon:</span> <?=$order->gsm?></h6>
											<h6><span class="m--font-bold">TC Kimlik No:</span> <?=$order->identity_number?></h6>
											<?php if ($order->corporate): ?>
											<h6><span class="m--font-bold">Firma Adı:</span> <?=$order->firm_name?></h6>
											<h6><span class="m--font-bold">Vergi Numarası:</span> <?=$order->tax_no?></h6>
											<h6><span class="m--font-bold">Vergi Dairesi:</span> <?=$order->tax_admin?></h6>
											<?php endif ?>
										</div>
										<div class="col-md-6 col-lg-6 col-sm-6 mb-3 order-box">
											<h6>Adres Bilgileri</h6>
											<h6><span class="m--font-bold">Ülke:</span> <?=$order->country?></h6>
											<h6><span class="m--font-bold">İl / İlçe:</span> <?=$order->city?> / <?=$order->town?></h6>
											<h6><span class="m--font-bold">Posta Kodu:</span> <?=$order->post_code?></h6>
											<h6><span class="m--font-bold">Adres:</span> <?=$order->content?></h6>
										</div>
										<p class="col-12">
											<span class="text-right m-badge m-badge--metal m-badge--wide">
												Fatura Adresi
											</span>
										</p>
										<div class="col-md-6 col-lg-6 col-sm-6 mb-3 order-box">
											<h6>Adres Kimlik Bilgileri</h6>
											<h6><span class="m--font-bold">Tip:</span> <?=($order->icorporate == 1 ? "Kurumsal":"Bireysel")?></h6>
											<h6><span class="m--font-bold">Ad Soyad:</span> <?=$order->iperson_name?></h6> 
											<h6><span class="m--font-bold">Telefon:</span> <?=$order->igsm?></h6>
											<h6><span class="m--font-bold">TC Kimlik No:</span> <?=$order->iidentity_number?></h6>
											<?php if ($order->icorporate == 1): ?>
											<h6><span class="m--font-bold">Firma Adı:</span> <?=$order->ifirm_name?></h6>
											<h6><span class="m--font-bold">Vergi Numarası:</span> <?=$order->itax_no?></h6>
											<h6><span class="m--font-bold">Vergi Dairesi:</span> <?=$order->itax_admin?></h6>
											<?php endif ?>
										</div>
										<div class="col-md-6 col-lg-6 col-sm-6 mb-3 order-box">
											<h6>Adres Bilgileri</h6>
											<h6><span class="m--font-bold">Ülke:</span> <?=$order->icountry?></h6> 
											<h6><span class="m--font-bold">İl / İlçe:</span> <?=$order->icity?> / <?=$order->itown?></h6> 
											<h6><span class="m--font-bold">Posta Kodu:</span> <?=$order->ipost_code?></h6> 
											<h6><span class="m--font-bold">Adres:</span> <?=$order->icontent?></h6>
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