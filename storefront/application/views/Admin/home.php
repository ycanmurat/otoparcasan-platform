
<div class="m-grid__item m-grid__item--fluid m-wrapper">
	<!-- BEGIN: Subheader -->
	<div class="m-subheader ">
		<div class="d-flex align-items-center">
			<div class="mr-auto">
				<h3 class="m-subheader__title m-subheader__title--separator">
					Bilgi Paneli
				</h3>
				<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
					<li class="m-nav__item m-nav__item--home">
						<a href="#" class="m-nav__link m-nav__link--icon">
							<i class="m-nav__link-icon la la-home"></i>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- END: Subheader -->
	<div class="m-content">
		<div class="m-portlet">
			<div class="m-portlet__body  m-portlet__body--no-padding">
				<div class="row m-row--no-padding m-row--col-separator-xl">
					<div class="col-md-12 col-lg-6 col-xl-3">
						<!--begin::Total Profit-->
						<div class="m-widget24">
							<div class="m-widget24__item">
								<h4 class="m-widget24__title">
									Toplu Parça Teklifi
								</h4>
								<br>
								<span class="m-widget24__desc">
									Görülmemiş Toplu Parça Teklifi
								</span>
								<br><br>
								<span class="m-widget24__stats m--font-brand">
									<?php echo $bulk_part_offer; ?>
								</span>
								<br><br>
							</div>
						</div>
						<!--end::Total Profit-->
					</div>
					<div class="col-md-12 col-lg-6 col-xl-3">
						<!--begin::New Feedbacks-->
						<div class="m-widget24">
							<div class="m-widget24__item">
								<h4 class="m-widget24__title">
									Genel Değerlendirme
								</h4>
								<br>
								<span class="m-widget24__desc">
									Bekleyen Site Değerlendirmesi
								</span>
								<br><br>
								<span class="m-widget24__stats m--font-info">
									<?php echo $web_site_reviews; ?>
								</span>
								<br><br>
							</div>
						</div>
						<!--end::New Feedbacks-->
					</div>
					<div class="col-md-12 col-lg-6 col-xl-3">
						<!--begin::New Orders-->
						<div class="m-widget24">
							<div class="m-widget24__item">
								<h4 class="m-widget24__title">
									Ürün Soruları
								</h4>
								<br>
								<span class="m-widget24__desc">
									Cevap Bekleyen Ürün Soruları
								</span>
								<br><br>
								<span class="m-widget24__stats m--font-danger">
									<?php echo $product_questions; ?>
								</span>
								<br><br>
							</div>
						</div>
						<!--end::New Orders-->
					</div>
					<div class="col-md-12 col-lg-6 col-xl-3">
						<!--begin::New Users-->
						<div class="m-widget24">
							<div class="m-widget24__item">
								<h4 class="m-widget24__title">
									Ürün Yorumları
								</h4>
								<br>
								<span class="m-widget24__desc">
									Bekleyen Ürün Yorumları
								</span>
								<br><br>
								<span class="m-widget24__stats m--font-success">
									<?php echo $questions_comments; ?>
								</span>
								<br><br>
							</div>
						</div>
						<!--end::New Users-->
					</div>
				</div>
			</div>
		</div>
		<div class="m-portlet">
			<div class="m-portlet__body m-portlet__body--no-padding">
				<div class="row m-row--no-padding m-row--col-separator-xl">
					<div class="col-md-12 col-lg-12 col-xl-6">
						<div class="m-widget1">
							<div class="m-widget1__item">
								<div class="row m-row--no-padding align-items-center">
									<div class="col">
										<h3 class="m-widget1__title">
											Ürün Kalitesi
										</h3>
									</div>
									<div class="col m--align-right">
										<span class="m-widget1__number m--font-brand">
											<span class="m-badge m-badge--success" style="padding: 15px;border-radius: 30px;"><i class="fa fa-hand-o-up"></i> <?php echo $product_quality_like; ?></span>
									<span class="m-badge m-badge--danger" style="padding: 15px;border-radius: 30px;"><i class="fa fa-hand-o-down"></i> <?php echo $product_quality_dislike; ?></span>
										</span>
									</div>
								</div>
							</div>
							<div class="m-widget1__item">
								<div class="row m-row--no-padding align-items-center">
									<div class="col">
										<h3 class="m-widget1__title">
											Kullanım Kolaylığı
										</h3>
									</div>
									<div class="col m--align-right">
										<span class="m-widget1__number m--font-danger">
											<span class="m-badge m-badge--success" style="padding: 15px;border-radius: 30px;"><i class="fa fa-hand-o-up"></i> <?php echo $ease_of_use_like; ?></span>
									<span class="m-badge m-badge--danger" style="padding: 15px;border-radius: 30px;"><i class="fa fa-hand-o-down"></i> <?php echo $ease_of_use_dislike; ?></span>
										</span>
									</div>
								</div>
							</div>
							<div class="m-widget1__item">
								<div class="row m-row--no-padding align-items-center">
									<div class="col">
										<h3 class="m-widget1__title">
											Hızlı Kargo
										</h3>
									</div>
									<div class="col m--align-right">
										<span class="m-widget1__number m--font-success">
											<span class="m-badge m-badge--success" style="padding: 15px;border-radius: 30px;"><i class="fa fa-hand-o-up"></i> <?php echo $fast_shipping_like; ?></span>
											<span class="m-badge m-badge--danger" style="padding: 15px;border-radius: 30px;"><i class="fa fa-hand-o-down"></i> <?php echo $fast_shipping_dislike; ?></span>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12 col-lg-12 col-xl-6">
						<div class="m-widget1">
							<div class="m-widget1__item">
								<div class="row m-row--no-padding align-items-center">
									<div class="col">
										<h3 class="m-widget1__title">
											Fiyat Aralığı
										</h3>
									</div>
									<div class="col m--align-right">
										<span class="m-widget1__number m--font-accent">
											<span class="m-badge m-badge--success" style="padding: 15px;border-radius: 30px;"><i class="fa fa-hand-o-up"></i> <?php echo $price_range_like; ?></span>
									<span class="m-badge m-badge--danger" style="padding: 15px;border-radius: 30px;"><i class="fa fa-hand-o-down"></i> <?php echo $price_range_dislike; ?></span>
										</span>
									</div>
								</div>
							</div>
							<div class="m-widget1__item">
								<div class="row m-row--no-padding align-items-center">
									<div class="col">
										<h3 class="m-widget1__title">
											Ürün Paketleme
										</h3>
									</div>
									<div class="col m--align-right">
										<span class="m-widget1__number m--font-info">
											<span class="m-badge m-badge--success" style="padding: 15px;border-radius: 30px;"><i class="fa fa-hand-o-up"></i> <?php echo $product_packaging_like; ?></span>
									<span class="m-badge m-badge--danger" style="padding: 15px;border-radius: 30px;"><i class="fa fa-hand-o-down"></i> <?php echo $product_packaging_dislike; ?></span>
										</span>
									</div>
								</div>
							</div>
							<div class="m-widget1__item">
								<div class="row m-row--no-padding align-items-center">
									<div class="col">
										<h3 class="m-widget1__title">
											Geri Bildirim
										</h3>
										<span class="m-widget1__desc">
											Toplam Geri Bildirim : <?php echo $getCountReviews; ?>
										</span>
									</div>
									<div class="col m--align-right">
										<span class="m-widget1__number m--font-warning">
											<p style="font-size:27px;color:#63add5;"><?php echo number_format($getStar->star,1); ?> / 5</p>
											<?if($getStar->star == 2){?>
												<i class="fa fa-star" aria-hidden="true"></i>
											<?}elseif($getStar->star < 3){?>
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
											<?}elseif($getStar->star < 4){?>
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
											<?}elseif($getStar->star < 5){?>
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
											<?}else{?>
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
											<?}?>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<div class="m-portlet">
					<div class="m-portlet__head">
						<div class="m-portlet__head-caption">
							<div class="m-portlet__head-title">
								<h3 class="m-portlet__head-text">
									Web Servis Aktivitesi
								</h3>
							</div>
						</div>
					</div>
					<div class="m-portlet__body">
						<div class="m-section">
							<h3 class="m-section__heading">
								Servis Bilgileri
							</h3>
							<div class="m-section__content">
								<div class="m-demo m-scrollable" data-code-preview="true" data-code-html="true" data-code-js="false" data-scrollbar-shown="true" data-scrollable="true" data-max-height="440">
									<div class="m-demo__preview">
										<div class="m-list-timeline">
											<div class="m-list-timeline__items">
												<div class="m-list-timeline__item">
													<span class="m-list-timeline__badge"></span>
													<span class="m-list-timeline__text">
														Başbuğ Otomotiv Servis Güncellendi

													</span>
													<span class="m-list-timeline__time">
														<button type="button" style="padding: 3px;" class="btn btn-success" data-toggle="m-tooltip" title="" data-html="true" data-content="And here's some amazing <b>HTML</b> content. It's very <code>engaging</code>. Right?" data-original-title="5/12/2019 - 13:30 | 14:00 <br> <span class='m-badge m-badge--success m-badge--wide'>
															5350 Başarılı
														</span>" aria-describedby="tooltip978839">
														<i class="flaticon-information"></i>
													</button>
												</span>
											</div>
											<div class="m-list-timeline__item">
												<span class="m-list-timeline__badge"></span>
												<span class="m-list-timeline__text">
													Okutgen Otomotiv Servis Güncellendi
												</span>
												<span class="m-list-timeline__time">
													<button type="button" style="padding: 3px;" class="btn btn-danger" data-toggle="m-tooltip" title="" data-html="true" data-content="And here's some amazing <b>HTML</b> content. It's very <code>engaging</code>. Right?" data-original-title="5/12/2019 - 13:30 | 14:00 <br> <span class='m-badge m-badge--success m-badge--wide'>5350 Başarılı
													</span><br><span style='margin-top:5px;' class='m-badge m-badge--danger m-badge--wide'>
														20 Başarısız
													</span>" aria-describedby="tooltip978839">
													<i class="flaticon-information"></i>
												</button>
											</span>
										</div>
										<div class="m-list-timeline__item">
											<span class="m-list-timeline__badge"></span>
											<span class="m-list-timeline__text">
												Martaş Otomotiv Servis Güncellendi
											</span>
											<span class="m-list-timeline__time">
												<button type="button" style="padding: 3px;" class="btn btn-danger" data-toggle="m-tooltip" title="" data-html="true" data-content="And here's some amazing <b>HTML</b> content. It's very <code>engaging</code>. Right?" data-original-title="5/12/2019 - 13:30 | 14:00 <br> <span class='m-badge m-badge--success m-badge--wide'>5350 Başarılı
												</span><br><span class='m-badge m-badge--danger m-badge--wide'>
													20 Başarısız
												</span>" aria-describedby="tooltip978839">
												<i class="flaticon-information"></i>
											</button>
										</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge"></span>
										<span class="m-list-timeline__text">
											Başbuğ Otomotiv Servis Güncellendi
										</span>
										<span class="m-list-timeline__time">
											<button type="button" style="padding: 3px;" class="btn btn-success" data-toggle="m-tooltip" title="" data-html="true" data-content="And here's some amazing <b>HTML</b> content. It's very <code>engaging</code>. Right?" data-original-title="5/12/2019 - 13:30 | 14:00 <br> <span class='m-badge m-badge--success m-badge--wide'>
												5350 Başarılı
											</span>" aria-describedby="tooltip978839">
											<i class="flaticon-information"></i>
										</button>
									</span>
								</div>
								<div class="m-list-timeline__item">
									<span class="m-list-timeline__badge"></span>
									<span class="m-list-timeline__text">
										Okutgen Otomotiv Servis Güncellendi
									</span>
									<span class="m-list-timeline__time">
										<button type="button" style="padding: 3px;" class="btn btn-success" data-toggle="m-tooltip" title="" data-html="true" data-content="And here's some amazing <b>HTML</b> content. It's very <code>engaging</code>. Right?" data-original-title="5/12/2019 - 13:30 | 14:00 <br> <span class='m-badge m-badge--success m-badge--wide'>
											5350 Başarılı
										</span>" aria-describedby="tooltip978839">
										<i class="flaticon-information"></i>
									</button>
								</span>
							</div>
							<div class="m-list-timeline__item">
								<span class="m-list-timeline__badge"></span>
								<span class="m-list-timeline__text">
									Martaş Otomotiv Servis Güncellendi
								</span>
								<span class="m-list-timeline__time">
									<button type="button" style="padding: 3px;" class="btn btn-danger" data-toggle="m-tooltip" title="" data-html="true" data-content="And here's some amazing <b>HTML</b> content. It's very <code>engaging</code>. Right?" data-original-title="5/12/2019 - 13:30 | 14:00 <br> <span class='m-badge m-badge--success m-badge--wide'>5350 Başarılı
									</span><br><span class='m-badge m-badge--danger m-badge--wide'>
										20 Başarısız
									</span>" aria-describedby="tooltip978839">
									<i class="flaticon-information"></i>
								</button>
							</span>
						</div>
						<div class="m-list-timeline__item">
							<span class="m-list-timeline__badge"></span>
							<span class="m-list-timeline__text">
								Okutgen Otomotiv Servis Güncellendi
							</span>
							<span class="m-list-timeline__time">
								<button type="button" style="padding: 3px;" class="btn btn-success" data-toggle="m-tooltip" title="" data-html="true" data-content="And here's some amazing <b>HTML</b> content. It's very <code>engaging</code>. Right?" data-original-title="5/12/2019 - 13:30 | 14:00 <br> <span class='m-badge m-badge--success m-badge--wide'>
									5350 Başarılı
								</span>" aria-describedby="tooltip978839">
								<i class="flaticon-information"></i>
							</button>
						</span>
					</div>
					<div class="m-list-timeline__item">
						<span class="m-list-timeline__badge"></span>
						<span class="m-list-timeline__text">
							Martaş Otomotiv Servis Güncellendi
						</span>
						<span class="m-list-timeline__time">
							<button type="button" style="padding: 3px;" class="btn btn-danger" data-toggle="m-tooltip" title="" data-html="true" data-content="And here's some amazing <b>HTML</b> content. It's very <code>engaging</code>. Right?" data-original-title="5/12/2019 - 13:30 | 14:00 <br> <span class='m-badge m-badge--success m-badge--wide'>5350 Başarılı
							</span><br><span class='m-badge m-badge--danger m-badge--wide'>
								20 Başarısız
							</span>" aria-describedby="tooltip978839">
							<i class="flaticon-information"></i>
						</button>
					</span>
				</div>
				<div class="m-list-timeline__item">
					<span class="m-list-timeline__badge"></span>
					<span class="m-list-timeline__text">
						Okutgen Otomotiv Servis Güncellendi
					</span>
					<span class="m-list-timeline__time">
						<button type="button" style="padding: 3px;" class="btn btn-success" data-toggle="m-tooltip" title="" data-html="true" data-content="And here's some amazing <b>HTML</b> content. It's very <code>engaging</code>. Right?" data-original-title="5/12/2019 - 13:30 | 14:00 <br> <span class='m-badge m-badge--success m-badge--wide'>
							5350 Başarılı
						</span>" aria-describedby="tooltip978839">
						<i class="flaticon-information"></i>
					</button>
				</span>
			</div>
			<div class="m-list-timeline__item">
				<span class="m-list-timeline__badge"></span>
				<span class="m-list-timeline__text">
					Martaş Otomotiv Servis Güncellendi
				</span>
				<span class="m-list-timeline__time">
					<button type="button" style="padding: 3px;" class="btn btn-danger" data-toggle="m-tooltip" title="" data-html="true" data-content="And here's some amazing <b>HTML</b> content. It's very <code>engaging</code>. Right?" data-original-title="5/12/2019 - 13:30 | 14:00 <br> <span class='m-badge m-badge--success m-badge--wide'>5350 Başarılı
					</span><br><span class='m-badge m-badge--danger m-badge--wide'>
						20 Başarısız
					</span>" aria-describedby="tooltip978839">
					<i class="flaticon-information"></i>
				</button>
			</span>
		</div>
	</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="col-lg-6">
	<div class="m-portlet">
		<div class="m-portlet__head">
			<div class="m-portlet__head-caption">
				<div class="m-portlet__head-title">
					<h3 class="m-portlet__head-text">
						Müşteri Aktivitesi	
					</h3>
				</div>
			</div>
		</div>
		<div class="m-portlet__body">
			<div class="m-section m-section--last">
				<h3 class="m-section__heading">
					Üyelikler
				</h3>
				<div class="m-section__content">
					<div class="m-demo m-scrollable" data-scrollbar-shown="true" data-scrollable="true" data-max-height="460" data-code-preview="true" data-code-html="true" data-code-js="false">
						<div class="m-demo__preview" style="padding: 44px !important;">
							<div class="m-list-search">
								<div class="m-list-search__results">
									<a href="#" class="m-list-search__result-item">
										<span class="m-list-search__result-item-icon">
											<i class="flaticon-users m--font-warning"></i>
										</span>
										<span class="m-list-search__result-item-text">
											Bugün Kayıt Olan Müşteri Sayısı
											<span class="m-badge m-badge--success m-badge--wide" style="margin-left:10px;">
												<?php echo $get_day_of_users; ?>
											</span>
										</span>
									</a>
									<a href="#" class="m-list-search__result-item">
										<span class="m-list-search__result-item-icon">
											<i class="flaticon-users m--font-warning"></i>
										</span>
										<span class="m-list-search__result-item-text">
											Bu Hafta Kayıt Olan Müşteri Sayısı
											<span class="m-badge m-badge--success m-badge--wide" style="margin-left:10px;">
												<?php echo $get_week_of_users; ?>
											</span>
										</span>
									</a>
									<a href="#" class="m-list-search__result-item">
										<span class="m-list-search__result-item-icon">
											<i class="flaticon-users m--font-warning"></i>
										</span>
										<span class="m-list-search__result-item-text">
											Bu Ay Kayıt Olan Müşteri Sayısı
											<span class="m-badge m-badge--success m-badge--wide" style="margin-left:10px;">
												<?php echo $mount_of_users; ?>
											</span>
										</span>
									</a>
									<span class="m-list-search__result-category">
										Son Kayıt Olan Müşteriler
									</span>
									<?php foreach ($get_last_users as $key => $val) { ?>
										<a href="javascript:void(0);" class="m-list-search__result-item">
											<span class="m-list-search__result-item-icon">
												<i class="flaticon-users m--font-<?php echo $val->gender=='Erkek'?'primary':'danger'; ?>"></i>
											</span>
											<span class="m-list-search__result-item-text">
												<?php echo $val->name; ?>
												<span class="m-badge m-badge--success m-badge--wide" style="font-size: 9px;">
													<?php if (!empty($val->CityName)) { ?>
														<?php echo $val->CityName . ' / ' . $val->CountyName . ' - ' . $val->added_time; ?>
													<?php } else { ?>
														<?php echo $val->added_time; ?>
													<?php }?>
												</span>
											</span>
										</a>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<!--begin:: Widgets/Stats-->
<!--end:: Widgets/Stats-->
<!--Begin::Main Portlet-->
<div class="row">
	<div class="col-xl-6">
		<!--begin:: Widgets/New Users-->
		<div class="m-portlet m-portlet--full-height">
			<div class="m-portlet__head">
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<h3 class="m-portlet__head-text">
							Yeni Üyeler
						</h3>
					</div>
				</div>
			</div>
			<div class="m-portlet__body">
				<div class="tab-content">
					<div class="tab-pane active" id="m_widget4_tab1_content">
						<!--begin::Widget 14-->
						<div class="m-widget4">
							<!--begin::Widget 14 Item-->
							<?foreach ($getUserInfoPermission as $key => $val){?>
								<div class="m-widget4__item">
									<div class="m-widget4__img m-widget4__img--pic">
										<i class="fa fa-check" style="color:green;"></i>
									</div>
									<div class="m-widget4__info">
										<span class="m-widget4__title">
											<?=$val->name?>
										</span>
										<br>
										<span class="m-widget4__sub">
											Email : <font color="green"><?=$val->email?></font><br>
											Telefon : <font color="green"><?=$val->phone?></font><br>
											Kayıt Tarihi : <font color="green"><?=$val->added_time?></font><br> 
										</span>
									</div>
								</div>
								<?}?>
								<!--end::Widget 14 Item-->
							</div>
							<!--end::Widget 14-->
						</div>
					</div>
					<div class="m-widget6__action m--align-right">
						<button type="button" onclick="window.location.href='<?=admin_url('User?s=1')?>'" class="btn m-btn--pill btn-secondary m-btn m-btn--hover-brand m-btn--custom">
							Hepsini Gör
						</button>
					</div>
				</div>
			</div>
			<!--end:: Widgets/New Users-->
		</div>
		<div class="col-xl-6">
			<!--begin:: Widgets/Support Tickets -->
			<div class="m-portlet m-portlet--full-height">
				<div class="m-portlet__head">
					<div class="m-portlet__head-caption">
						<div class="m-portlet__head-title">
							<h3 class="m-portlet__head-text">
								İletişim Kutusu
							</h3>
						</div>
					</div>
				</div>
				<div class="m-portlet__body">
					<div class="m-widget3">
						<?foreach ($getContactInfo as $key => $cInfo){?>
							<div class="m-widget3__item">
								<div class="m-widget3__header">
									<div class="m-widget3__info">
										<span class="m-widget3__username">
											<?=$cInfo->name_surname?>
										</span>
										<br>
										<span class="m-widget3__time">
											<?=$cInfo->phone?>
										</span>
									</div>
									<span class="m-widget3__status m--font-info">
										<a href="mailto:<?=$cInfo->email?>">İletişim</a>
									</span>
								</div>
								<div class="m-widget3__body">
									<p class="m-widget3__text">
										<font color="green">Konu :</font> <?=$cInfo->message?> <font color="red">...</font>
									</p>
									<p class="m-widget3__text" style="margin-top:-10px;">
										<font color="green">Mesaj :</font> <?=mb_substr($cInfo->message,0,100,'UTF-8')?> <font color="red">...</font>
									</p>
								</div>
							</div>
							<?}?>
						</div>
					</div>
				</div>
				<!--end:: Widgets/Support Tickets -->
			</div>
		</div>
		<!--End::Main Portlet-->
		<!--Begin::Main Portlet-->
		<div class="row">
			<div class="col-xl-4">
				<!--begin:: Widgets/Sales States-->
				<div class="m-portlet m-portlet--full-height">
					<div class="m-portlet__head">
						<div class="m-portlet__head-caption">
							<div class="m-portlet__head-title">
								<h3 class="m-portlet__head-text">
									Son Satışlar
								</h3>
							</div>
						</div>
					</div>
					<div class="m-portlet__body">
						<div class="m-widget6">
							<div class="m-widget6__head">
								<div class="m-widget6__item">
									<span class="m-widget6__caption">
										Id
									</span>
									<span class="m-widget6__caption">
										Tarih
									</span>
									<span class="m-widget6__caption m--align-right">
										Tutar
									</span>
								</div>
							</div>
							<div class="m-widget6__body">
								<?foreach ($getLastOrders as $key => $val){?>
									<div class="m-widget6__item">
										<span class="m-widget6__text">
											<?=$val->id?>
										</span>
										<span class="m-widget6__text">
											<?=$val->added_time?>
										</span>
										<span class="m-widget6__text m--align-right m--font-boldest m--font-brand">
											₺ <?=$val->totapPrice?>
										</span>
									</div>
									<?}?>
								</div>
							</div>
						</div>
					</div>
					<!--end:: Widgets/Sales States-->
				</div>
				<div class="col-xl-8">
					<!--begin:: Widgets/Best Sellers-->
					<div class="m-portlet m-portlet--full-height">
						<div class="m-portlet__head">
							<div class="m-portlet__head-caption">
								<div class="m-portlet__head-title">
									<h3 class="m-portlet__head-text">
										Son Kampanyalar
									</h3>
								</div>
							</div>
						</div>
						<div class="m-portlet__body">
							<!--begin::Content-->
							<div class="tab-content">
								<div class="tab-pane active" id="m_widget5_tab1_content" aria-expanded="true">
									<!--begin::m-widget5-->
									<div class="m-widget5">
										<?foreach ($getCampaigns as $key => $val){?>
											<div class="m-widget5__item">
												<div class="m-widget5__pic">
													<img class="m-widget7__img" src="<?=site_url($val->campaign_picture)?>" alt="">
												</div>
												<div class="m-widget5__content">
													<h4 class="m-widget5__title">
														<?=$val->campaign_title?>
													</h4>
													<span class="m-widget5__desc">
														<?=mb_substr($val->campaign_info,0,70,'UTF-8')?> ...
													</span>
													<div class="m-widget5__info">
														<span class="m-widget5__author">
															Başlangıç : 
														</span>
														<span class="m-widget5__info-date m--font-info">
															<?=$val->campaign_start?>
														</span> 
														<span class="m-widget5__info-author-name">
															<b>|</b> Bitiş :
														</span>
														<span class="m-widget5__info-date m--font-info">
															<?=$val->campaign_end?>
														</span>
													</div>
												</div>
											</div>
											<?}?>
										</div>
										<!--end::m-widget5-->
									</div>
								</div>
								<!--end::Content-->
							</div>
						</div>
						<!--end:: Widgets/Best Sellers-->
					</div>
				</div>
				<!--End::Main Portlet-->
				<!--Begin::Main Portlet-->
				<div class="row">
					<div class="col-xl-6">
						<!--begin:: Widgets/Product Sales-->
						<div class="m-portlet m-portlet--bordered-semi m-portlet--space m-portlet--full-height">
							<div class="m-portlet__head">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<h3 class="m-portlet__head-text">
											Toplam Satış
											<span class="m-portlet__head-desc">
												Siparişler Toplamı
											</span>
										</h3>
									</div>
								</div>
							</div>
							<div class="m-portlet__body">
								<div class="m-widget25">
									<span class="m-widget25__price m--font-brand">
										₺ <?=$getAllPrice->Allprice?>
									</span>
									<br><br>
									<span class="m-widget25__desc">
										Bügüne Kadar Alınan Tüm Siparişlerin Toplam Ücreti
									</span>
								</div>
							</div>
						</div>
						<!--end:: Widgets/Product Sales-->
					</div>
					<div class="col-xl-6">
						<!--begin:: Widgets/Company Summary-->
						<div class="m-portlet m-portlet--full-height">
							<div class="m-portlet__head">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<h3 class="m-portlet__head-text">
											Şirket Özeti
										</h3>
									</div>
								</div>
							</div>
							<div class="m-portlet__body">
								<div class="m-widget13">
									<div class="m-widget13__item">
										<span class="m-widget13__desc m--align-right">
											Şirket Adı
										</span>
										<span class="m-widget13__text m-widget13__text-bolder">
											Sesli Dijital
										</span>
									</div>
									<div class="m-widget13__item">
										<span class="m-widget13__desc m--align-right">
											Şirket Açıklaması:
										</span>
										<span class="m-widget13__text">
											<b>Mükemmel Yedek Parçalar</b>
										</span>
									</div>
									<div class="m-widget13__item">
										<span class="m-widget13__desc m--align-right">
											Telefon:
										</span>
										<span class="m-widget13__text m-widget13__number-bolder m--font-brand">
											0 (362) 266 59 73 - 74 
										</span>
									</div>
								</div>
							</div>
						</div>
						<!--end:: Widgets/Company Summary-->
					</div>
				</div>
				<!--End::Main Portlet-->
			</div>
		</div>
	</div>
			<!-- end:: Body -->