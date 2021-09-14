<!-- Slider -->
<section class="Slider p-lr">
	<div class="container-fluid pt-1 pb-3">
		<div class="row">
			<div class="col-xl-12 col-md-12 col-12">
				<div class="plateSearch">
					<div class="searchLoading"><img src="<?=site_url('assets/Front/images/tenor.gif')?>"></div>
					<div class="soWhat">
						<i class="fa fa-question-circle-o" aria-hidden="true"></i>
						<div class="soWhatOpen">
							<img class="img-fluid" src="<?=site_url('assets/Front/images/vinn.webp')?>">
							<p>ŞASE NO ile arama yapmak size belirlediğiniz araç için parçaları hızlıca bulabilmenizi sağlar. Sadece ŞASE NO'sunu aracını yazın, OTOPARÇASAN size hemen karşılık gelen ilgili üreticiyi, modeli ve varsa motoru gösterecektir.</p>
						</div>
					</div>
					<div class="T">Hızlı Parça Bul</div>
					<button id="clearArea"><i class="fa fa-undo" aria-hidden="true"></i></button>
						<div class="Area">
							<div class="sT">ŞASE NO</div>
                            <div class="plate-area">
                                <input type="text" class="plate-input" maxlength="17" onkeypress="return enterScript(event)" placeholder="ŞASE NO" id="chasisNo">
                                <button type="button" onclick="sasiSearch()" class="plateSearchButon" id="chasisSearch"></button>
                            </div>
                            <!--
                            <div class="or"><span>VEYA </span></div>
                            <div class="plate-area">
                                <input type="text" class="plate-input" maxlength="17" onkeypress="return enterScript(event)" placeholder="Metin ile araç ara" id="chasisNo">
                                <button type="button" onclick="sasiSearch()" class="plateSearchButon" id="chasisSearch"></button>
                            </div>
                        -->
							<script>
								function enterScript(e) {
								    if (e.keyCode == 13) {
								    	sasiSearch();
								    }
								}
							</script>
							<div class="or"><span>VEYA </span></div>
							<div id="mobileSelectBtn" class="mobileSelect">Araç Seçin <i class="fa fa-chevron-down" aria-hidden="true"></i></div>
								<div class="FormElements">
									<select class="custom-select mt-2" id="carType">
										<option value="0">- Araç Türünü Seçiniz </option>
										<?php foreach ($dat->types as $key => $val) { ?>
											<?php if ($val->status == 1) { ?>
												<option data-img="<?=site_url($val->icon)?>" value="<?=$val->key?>"><?=$val->value?></option>
											<?php } ?>
										<?php } ?>
									</select>
									<select class="custom-select mt-2 carAlt" id="carBrands" disabled>
										<option value="0">- Marka -</option>
									</select>
									<select class="custom-select mt-2 carAlt" id="carModels" disabled>
										<option value="0">- Model -</option>
									</select>
									<select class="custom-select mt-2 carAlt" id="carSubModels" disabled>
										<option value="0">- Alt Tip -</option>
									</select>
								</div>
						</div>
					<div class="plateSearch extraArea plateSearch-edit">
						<div class="searchLoading"><img src="<?=site_url('assets/Front/images/tenor.gif')?>"></div>
						<form action="#" method="post">
							<div class="Area">
								<div class="FormElements carSelectDetail">

								</div>

								<div class="FormElements">
									<div class="row mt-2">
                                        <?php if (!(null !==($this->session->userdata('userInfo')))) { ?>
                                            <div class="col-12"><button onclick="SearchPart()" type="button" class="Btn Right">Ara</button></div>
                                        <?php }else{ ?>
                                            <div class="col-6 pr-2"><button onclick="addGarrage()" type="button" class="Btn Left">Garajıma Ekle</button></div>
                                            <div class="col-6 pl-2"><button onclick="SearchPart()" type="button" class="Btn Right">Ara</button></div>
                                        <?php } ?>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>

				<?if ($this->agent->is_mobile()){?>
					<div class="owl-carousel owl-theme owl-banner mobile">
						<?foreach ($mobileSliders as $key => $mobileSliderInfo) {?>
							<div class="item"><img src="<?=site_url($mobileSliderInfo->slider_url)?>"></div>
							<?}?>
						</div>
						<?} else {?>
							<div class="owl-carousel owl-theme owl-banner desktop">
								<?foreach ($sliders as $key => $sliderInfo) {?>
									<div class="item"><img src="<?=site_url($sliderInfo->slider_url)?>"></div>
									<?}?>
								</div>
								<?}?>
							</div>
						</div>
					</div>
				</section>
				<div class="modal fade" id="sendcarinfo" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Aracınızı bulamadınız mı ?</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body p-3">
								<div class="container-fluid">
									<div class="row">
										<div class="col-12">
											<div class="offerform">
												<p class="mt-2 mb-3 small">Lorem ipsum Dolor site amet  Lorem ipsum Dolor site amet Lorem ipsum Dolor site amet Lorem ipsum</p>
												<div class="formArea">
													<form action="#">
														<div class="row">
															<div class="col-sm-12">
																<input type="text" placeholder="Şase No" id="Vin_number">
															</div>
															<div class="col-sm-6">
																<select name="offer_type" id="offer_type">
																	<option value="">Marka</option>
																	<option value="1">Xxxxx</option>
																	<option value="2">Xxxxx</option>
																	<option value="3">Xxxxx</option>
																</select>
															</div>
															<div class="col-sm-6">
																<select name="offer_type2" id="offer_type2">
																	<option value="">Model</option>
																	<option value="1">Xxxxx</option>
																	<option value="2">Xxxxx</option>
																	<option value="3">Xxxxx</option>
																</select>
															</div>
															<div class="col-sm-6">
																<select name="offer_type3" id="offer_type3">
																	<option value="">Kasa</option>
																	<option value="1">Xxxxx</option>
																	<option value="2">Xxxxx</option>
																	<option value="3">Xxxxx</option>
																</select>
															</div>
															<div class="col-sm-6">
																<select name="offer_type4" id="offer_type4">
																	<option value="">Yıl</option>
																	<option value="1">Xxxxx</option>
																	<option value="2">Xxxxx</option>
																	<option value="3">Xxxxx</option>
																</select>
															</div>
															<div class="col-sm-12">
																<input type="email" placeholder="E-Posta" id="e-mail">
															</div>
														</div>
														<div class="row">
															<div class="col-12 text-center mt-4 mb-4">
																<div class="checkItem d-inline">
																	<input class="styled-checkbox" id="styled-checkbox-12" type="checkbox" value="value1">
																	<label for="styled-checkbox-12">
																		<a href="javascript:void(0);" data-toggle="modal" data-target="#secure_contract">Gizlilik Sözleşmesi</a>'ni Okudum. Onaylıyorum.
																	</label>
																</div>
															</div>
															<div class="col-12 text-center">
																<button type="button">Gönder</button>
															</div>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- / Slider -->


<!-- 
<section class="Features p-lr">
	<div class="container-fluid">
		<div class="row">
			<div class="col">
				<div class="features-owl owl-carousel">
					<div class="item">
						<div class="feature-item item-1">
							Sitede aktif 193,732 adet<br>ürün bulunmaktadır.
						</div>
					</div>
					<div class="item">
						<div class="feature-item item-2">
							14 Gün içinde<br>Koşulsuz İade
						</div>
					</div>
					<div class="item">
						<div class="feature-item item-3">
							Tüm Kartlara<br>Taksit İmkanı
						</div>
					</div>
					<div class="item">
						<div class="feature-item item-4">
							Garanti Belgeli<br>Orjinal Ürünler
						</div>
					</div>
					<div class="item">
						<div class="feature-item item-5">
							Türkiye'nin Her Yerine<br>Kargo 9.50 TL
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
Features -->


<!-- / Banners -->
<section class="Banners p-lr">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="site-title"><span>Çok Satılanlar</span></div>
			</div>

			<?foreach ($verySellers as $key => $sellerInformation) {?>
				<div class="col-xl-6 col-md-6">
					<div class="item item1" style="background-image: url(<?=site_url($sellerInformation->image)?>);">
						<h3><?=$sellerInformation->title?></h3>
						<span><?=$sellerInformation->content?></span>
						<a href="<?=site_url($sellerInformation->link)?>" class="Link">İNCELE <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
					</div>
				</div>
				<?}?>
			</div>
		</div>
	</section>
	<!-- / Banners -->


	<!--videoArea -->
	<section class="videoArea" style="background-image: url('<?=site_url($video->image)?>');">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="videoTitle"><?=$video->title?></div>
					<div class="sT"><?=$video->content?></div>
                    
                    <a href="https://www.youtube.com/watch?v=<?=$video->video_link?>" target="_blank">
    					<div class="videoIcon">
    						<div class="circle pulse"></div>
    						<div class="circle">
                                <svg xmlns="https://www.w3.org/2000/svg" viewBox="0 0 100 100">
                                    <polygon points="40,30 65,50 40,70"></polygon>
                                </svg>
    						</div>
    					</div>
                    </a>
				</div>
			</div>
		</div>
	</section>
	<!-- / videoArea -->




	<!--HomeList -->
	<section class="HomeList p-lr">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="site-title"><span>Vitrin Ürünleri</span></div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="column">
						<div class="row">
							<div class="col-xl-12 col-md-12 col-sm-12">
								<div class="list-wrapper">
									<div class="HomeList-owl owl-carousel">
										<div class="item">
											<div class="list-item Small home-list-item">
												<div class="list-img">
													<a href="<?=site_url('Product/details')?>" class="img-link"><img src="<?=site_url('assets/Front/images/Detail/detail-img.webp')?>" alt=""></a>
												</div>
												<div class="list-content home-list-content">
													<div class="product-head">
														<a href="#" class="ProductName">Özel Jantlar</a>
														<p class="productInfo">Marka:Ford <br>Stok Kodu:12345648</p>
													</div>
													<div class="product-control home-vitrin">
														<div class="product-stars">
															<div class="item">
																<i class="fa fa-star OK" aria-hidden="true"></i>
																<i class="fa fa-star OK" aria-hidden="true"></i>
																<i class="fa fa-star OK" aria-hidden="true"></i>
																<i class="fa fa-star OK" aria-hidden="true"></i>
																<i class="fa fa-star" aria-hidden="true"></i>
															</div>
															<div class="item">
																<p class="comment">(7 Yorum)</p>
															</div>
														</div>
														<div class="product-Price">
															<div class="price">159.99 TL</div>
															<div class="old-price">399.99 TL</div>
															<div class="addBasket">Hemen Al <i class="fa fa-chevron-right" aria-hidden="true"></i></div>
														</div>
														<div class="product-interaction">
															<div class="item mix">
																<div class="Icon"><i class="fa fa-random" aria-hidden="true"></i></div>
																<div class="txt">Karşılaştır</div>
															</div>
															<div class="item addFav">
																<div class="Icon"><i class="fa fa-heart" aria-hidden="true"></i></div>
																<div class="txt">Favori<span>lere Ekle</span></div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="item">
											<div class="list-item Small home-list-item">
												<div class="list-img">
													<a href="<?=site_url('Product/details')?>" class="img-link"><img src="<?=site_url('assets/Front/images/Detail/detail-img-thumb.webp')?>" alt=""></a>
												</div>
												<div class="list-content">
													<div class="product-head">
														<a href="#" class="ProductName">Özel Jantlar</a>
														<p class="productInfo">Marka:Ford <br>Stok Kodu:12345648</p>
													</div>
													<div class="product-control home-vitrin">
														<div class="product-stars">
															<div class="item">
																<i class="fa fa-star OK" aria-hidden="true"></i>
																<i class="fa fa-star OK" aria-hidden="true"></i>
																<i class="fa fa-star OK" aria-hidden="true"></i>
																<i class="fa fa-star OK" aria-hidden="true"></i>
																<i class="fa fa-star" aria-hidden="true"></i>
															</div>
															<div class="item">
																<p class="comment">(7 Yorum)</p>
															</div>
														</div>
														<div class="product-Price">
															<div class="price">159.99 TL</div>
															<div class="old-price">399.99 TL</div>
															<div class="addBasket">Hemen Al <i class="fa fa-chevron-right" aria-hidden="true"></i></div>
														</div>
														<div class="product-interaction">
															<div class="item mix">
																<div class="Icon"><i class="fa fa-random" aria-hidden="true"></i></div>
																<div class="txt">Karşılaştır</div>
															</div>
															<div class="item addFav">
																<div class="Icon"><i class="fa fa-heart" aria-hidden="true"></i></div>
																<div class="txt">Favori<span>lere Ekle</span></div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="item">
											<div class="list-item Small home-list-item">
												<div class="list-img">
													<a href="<?=site_url('Product/details')?>" class="img-link"><img src="<?=site_url('assets/Front/images/Detail/detail-img2.webp')?>" alt=""></a>
												</div>
												<div class="list-content">
													<div class="product-head">
														<a href="#" class="ProductName">Özel Jantlar</a>
														<p class="productInfo">Marka:Ford <br>Stok Kodu:12345648</p>
													</div>
													<div class="product-control home-vitrin">
														<div class="product-stars">
															<div class="item">
																<i class="fa fa-star OK" aria-hidden="true"></i>
																<i class="fa fa-star OK" aria-hidden="true"></i>
																<i class="fa fa-star OK" aria-hidden="true"></i>
																<i class="fa fa-star OK" aria-hidden="true"></i>
																<i class="fa fa-star" aria-hidden="true"></i>
															</div>
															<div class="item">
																<p class="comment">(7 Yorum)</p>
															</div>
														</div>
														<div class="product-Price">
															<div class="price">159.99 TL</div>
															<div class="old-price">399.99 TL</div>
															<div class="addBasket">Hemen Al <i class="fa fa-chevron-right" aria-hidden="true"></i></div>
														</div>
														<div class="product-interaction">
															<div class="item mix">
																<div class="Icon"><i class="fa fa-random" aria-hidden="true"></i></div>
																<div class="txt">Karşılaştır</div>
															</div>
															<div class="item addFav">
																<div class="Icon"><i class="fa fa-heart" aria-hidden="true"></i></div>
																<div class="txt">Favori<span>lere Ekle</span></div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="item">
											<div class="list-item Small home-list-item">
												<div class="list-img">
													<a href="<?=site_url('Product/details')?>" class="img-link"><img src="<?=site_url('assets/Front/images/Detail/detail-img-thumb3.webp')?>" alt=""></a>
												</div>
												<div class="list-content">
													<div class="product-head">
														<a href="#" class="ProductName">Özel Jantlar</a>
														<p class="productInfo">Marka:Ford <br>Stok Kodu:12345648</p>
													</div>
													<div class="product-control home-vitrin">
														<div class="product-stars">
															<div class="item">
																<i class="fa fa-star OK" aria-hidden="true"></i>
																<i class="fa fa-star OK" aria-hidden="true"></i>
																<i class="fa fa-star OK" aria-hidden="true"></i>
																<i class="fa fa-star OK" aria-hidden="true"></i>
																<i class="fa fa-star" aria-hidden="true"></i>
															</div>
															<div class="item">
																<p class="comment">(7 Yorum)</p>
															</div>
														</div>
														<div class="product-Price">
															<div class="price">159.99 TL</div>
															<div class="old-price">399.99 TL</div>
															<div class="addBasket">Hemen Al <i class="fa fa-chevron-right" aria-hidden="true"></i></div>
														</div>
														<div class="product-interaction">
															<div class="item mix">
																<div class="Icon"><i class="fa fa-random" aria-hidden="true"></i></div>
																<div class="txt">Karşılaştır</div>
															</div>
															<div class="item addFav">
																<div class="Icon"><i class="fa fa-heart" aria-hidden="true"></i></div>
																<div class="txt">Favori<span>lere Ekle</span></div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="item">
											<div class="list-item Small home-list-item">
												<div class="list-img">
													<a href="<?=site_url('Product/details')?>" class="img-link"><img src="<?=site_url('assets/Front/images/Detail/detail-img3.webp')?>" alt=""></a>
												</div>
												<div class="list-content">
													<div class="product-head">
														<a href="#" class="ProductName">Özel Jantlar</a>
														<p class="productInfo">Marka:Ford <br>Stok Kodu:12345648</p>
													</div>
													<div class="product-control home-vitrin">
														<div class="product-stars">
															<div class="item">
																<i class="fa fa-star OK" aria-hidden="true"></i>
																<i class="fa fa-star OK" aria-hidden="true"></i>
																<i class="fa fa-star OK" aria-hidden="true"></i>
																<i class="fa fa-star OK" aria-hidden="true"></i>
																<i class="fa fa-star" aria-hidden="true"></i>
															</div>
															<div class="item">
																<p class="comment">(7 Yorum)</p>
															</div>
														</div>
														<div class="product-Price">
															<div class="price">159.99 TL</div>
															<div class="old-price">399.99 TL</div>
															<div class="addBasket">Hemen Al <i class="fa fa-chevron-right" aria-hidden="true"></i></div>
														</div>
														<div class="product-interaction">
															<div class="item mix">
																<div class="Icon"><i class="fa fa-random" aria-hidden="true"></i></div>
																<div class="txt">Karşılaştır</div>
															</div>
															<div class="item addFav">
																<div class="Icon"><i class="fa fa-heart" aria-hidden="true"></i></div>
																<div class="txt">Favori<span>lere Ekle</span></div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="item">
											<div class="list-item Small home-list-item">
												<div class="list-img">
													<a href="<?=site_url('Product/details')?>" class="img-link"><img src="<?=site_url('assets/Front/images/Detail/detail-img.webp')?>" alt=""></a>
												</div>
												<div class="list-content">
													<div class="product-head">
														<a href="#" class="ProductName">Özel Jantlar</a>
														<p class="productInfo">Marka:Ford <br>Stok Kodu:12345648</p>
													</div>
													<div class="product-control home-vitrin">
														<div class="product-stars">
															<div class="item">
																<i class="fa fa-star OK" aria-hidden="true"></i>
																<i class="fa fa-star OK" aria-hidden="true"></i>
																<i class="fa fa-star OK" aria-hidden="true"></i>
																<i class="fa fa-star OK" aria-hidden="true"></i>
																<i class="fa fa-star" aria-hidden="true"></i>
															</div>
															<div class="item">
																<p class="comment">(7 Yorum)</p>
															</div>
														</div>
														<div class="product-Price">
															<div class="price">159.99 TL</div>
															<div class="old-price">399.99 TL</div>
															<div class="addBasket">Hemen Al <i class="fa fa-chevron-right" aria-hidden="true"></i></div>
														</div>
														<div class="product-interaction">
															<div class="item mix">
																<div class="Icon"><i class="fa fa-random" aria-hidden="true"></i></div>
																<div class="txt">Karşılaştır</div>
															</div>
															<div class="item addFav">
																<div class="Icon"><i class="fa fa-heart" aria-hidden="true"></i></div>
																<div class="txt">Favori<span>lere Ekle</span></div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="item">
											<div class="list-item Small home-list-item">
												<div class="list-img">
													<a href="<?=site_url('Product/details')?>" class="img-link"><img src="<?=site_url('assets/Front/images/Detail/detail-img.webp')?>" alt=""></a>
												</div>
												<div class="list-content">
													<div class="product-head">
														<a href="#" class="ProductName">Özel Jantlar</a>
														<p class="productInfo">Marka:Ford <br>Stok Kodu:12345648</p>
													</div>
													<div class="product-control home-vitrin">
														<div class="product-stars">
															<div class="item">
																<i class="fa fa-star OK" aria-hidden="true"></i>
																<i class="fa fa-star OK" aria-hidden="true"></i>
																<i class="fa fa-star OK" aria-hidden="true"></i>
																<i class="fa fa-star OK" aria-hidden="true"></i>
																<i class="fa fa-star" aria-hidden="true"></i>
															</div>
															<div class="item">
																<p class="comment">(7 Yorum)</p>
															</div>
														</div>
														<div class="product-Price">
															<div class="price">159.99 TL</div>
															<div class="old-price">399.99 TL</div>
															<div class="addBasket">Hemen Al <i class="fa fa-chevron-right" aria-hidden="true"></i></div>
														</div>
														<div class="product-interaction">
															<div class="item mix">
																<div class="Icon"><i class="fa fa-random" aria-hidden="true"></i></div>
																<div class="txt">Karşılaştır</div>
															</div>
															<div class="item addFav">
																<div class="Icon"><i class="fa fa-heart" aria-hidden="true"></i></div>
																<div class="txt">Favori<span>lere Ekle</span></div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="item">
											<div class="list-item Small home-list-item">
												<div class="list-img">
													<a href="<?=site_url('Product/details')?>" class="img-link"><img src="<?=site_url('assets/Front/images/Detail/detail-img.webp')?>" alt=""></a>
												</div>
												<div class="list-content">
													<div class="product-head">
														<a href="#" class="ProductName">Özel Jantlar</a>
														<p class="productInfo">Marka:Ford <br>Stok Kodu:12345648</p>
													</div>
													<div class="product-control home-vitrin">
														<div class="product-stars">
															<div class="item">
																<i class="fa fa-star OK" aria-hidden="true"></i>
																<i class="fa fa-star OK" aria-hidden="true"></i>
																<i class="fa fa-star OK" aria-hidden="true"></i>
																<i class="fa fa-star OK" aria-hidden="true"></i>
																<i class="fa fa-star" aria-hidden="true"></i>
															</div>
															<div class="item">
																<p class="comment">(7 Yorum)</p>
															</div>
														</div>
														<div class="product-Price">
															<div class="price">159.99 TL</div>
															<div class="old-price">399.99 TL</div>
															<div class="addBasket">Hemen Al <i class="fa fa-chevron-right" aria-hidden="true"></i></div>
														</div>
														<div class="product-interaction">
															<div class="item mix">
																<div class="Icon"><i class="fa fa-random" aria-hidden="true"></i></div>
																<div class="txt">Karşılaştır</div>
															</div>
															<div class="item addFav">
																<div class="Icon"><i class="fa fa-heart" aria-hidden="true"></i></div>
																<div class="txt">Favori<span>lere Ekle</span></div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="item">
											<div class="list-item Small home-list-item">
												<div class="list-img">
													<a href="<?=site_url('Product/details')?>" class="img-link"><img src="<?=site_url('assets/Front/images/Detail/detail-img.webp')?>" alt=""></a>
												</div>
												<div class="list-content">
													<div class="product-head">
														<a href="#" class="ProductName">Özel Jantlar</a>
														<p class="productInfo">Marka:Ford <br>Stok Kodu:12345648</p>
													</div>
													<div class="product-control home-vitrin">
														<div class="product-stars">
															<div class="item">
																<i class="fa fa-star OK" aria-hidden="true"></i>
																<i class="fa fa-star OK" aria-hidden="true"></i>
																<i class="fa fa-star OK" aria-hidden="true"></i>
																<i class="fa fa-star OK" aria-hidden="true"></i>
																<i class="fa fa-star" aria-hidden="true"></i>
															</div>
															<div class="item">
																<p class="comment">(7 Yorum)</p>
															</div>
														</div>
														<div class="product-Price">
															<div class="price">159.99 TL</div>
															<div class="old-price">399.99 TL</div>
															<div class="addBasket">Hemen Al <i class="fa fa-chevron-right" aria-hidden="true"></i></div>
														</div>
														<div class="product-interaction">
															<div class="item mix">
																<div class="Icon"><i class="fa fa-random" aria-hidden="true"></i></div>
																<div class="txt">Karşılaştır</div>
															</div>
															<div class="item addFav">
																<div class="Icon"><i class="fa fa-heart" aria-hidden="true"></i></div>
																<div class="txt">Favori<span>lere Ekle</span></div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="item">
											<div class="list-item Small home-list-item">
												<div class="list-img">
													<a href="<?=site_url('Product/details')?>" class="img-link"><img src="<?=site_url('assets/Front/images/Detail/detail-img.webp')?>" alt=""></a>
												</div>
												<div class="list-content">
													<div class="product-head">
														<a href="#" class="ProductName">Özel Jantlar</a>
														<p class="productInfo">Marka:Ford <br>Stok Kodu:12345648</p>
													</div>
													<div class="product-control home-vitrin">
														<div class="product-stars">
															<div class="item">
																<i class="fa fa-star OK" aria-hidden="true"></i>
																<i class="fa fa-star OK" aria-hidden="true"></i>
																<i class="fa fa-star OK" aria-hidden="true"></i>
																<i class="fa fa-star OK" aria-hidden="true"></i>
																<i class="fa fa-star" aria-hidden="true"></i>
															</div>
															<div class="item">
																<p class="comment">(7 Yorum)</p>
															</div>
														</div>
														<div class="product-Price">
															<div class="price">159.99 TL</div>
															<div class="old-price">399.99 TL</div>
															<div class="addBasket">Hemen Al <i class="fa fa-chevron-right" aria-hidden="true"></i></div>
														</div>
														<div class="product-interaction">
															<div class="item mix">
																<div class="Icon"><i class="fa fa-random" aria-hidden="true"></i></div>
																<div class="txt">Karşılaştır</div>
															</div>
															<div class="item addFav">
																<div class="Icon"><i class="fa fa-heart" aria-hidden="true"></i></div>
																<div class="txt">Favori<span>lere Ekle</span></div>
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
					</div>

				</div>
			</div>
		</div>
	</section>
	<!-- / HomeList -->

	<!-- Car Brands  --  Bu alan Backend e Dahil Değildir-->
	<div class="p-lr">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="carBrandsMarque">
						<div class="owl-carousel owl-theme owl-carBrands">
							<?foreach ($carBrands as $key => $carInfo) {?>
								<div class="item">
									<img alt="<?=$carInfo->title?>" title="<?=$carInfo->title?>" src="<?=site_url($carInfo->image)?>">
								</div>
								<?}?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Car Brands -->


		<!-- SeoText -->
		<section class="seoText p-lr">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<div class="Wrapper">
							<div class="Img">
								<img src="<?=site_url($content->image)?>" alt="<?=$content->first_title?>" title="<?=$content->first_title?>">
							</div>
							<div class="Area">
								<div class="item">
									<h2><?=$content->first_title?></h2>
									<p><?=$content->first_content?></p>
								</div>
								<div class="item">
									<h2><?=$content->second_title?></h2>
									<p><?=$content->second_content?></p>
								</div>

								<div class="item">
									<h2><?=$content->third_title?></h2>
									<p><?=$content->third_content?></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- / SeoText -->

		<!-- Car Brands  --  Bu alan Backend e Dahil Değildir-->
		<div class="p-lr">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<div class="carBrandsMarque">
							<div class="owl-carousel owl-theme owl-carBrands">
								<?foreach ($pieceBrands as $key => $pieceInfo) {?>
									<div class="item">
										<img alt="Marka" title="Marka" src="<?=site_url($pieceInfo->image)?>">
									</div>
									<?}?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Car Brands -->


			<!-- Testimonial -->
			<section class="Testimonial p-lr">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12">
							<div class="site-title site-title-edit"><span>Müşterilerimiz Ne Düşünüyor ?</span></div>
						</div>
						<div class="col-12">
							<div class="testimonial-wrapper">
								<div class="testimonial-owl owl-carousel">
									<?foreach ($commentsAndReviews as $key => $commentInfo) {?>
										<div class="item">
											<div class="testimonial-item">
												<div class="testimonial-head">
													<div class="item Name user-name user-name-edit"><?=$commentInfo->name.' '.$commentInfo->surname?></div>
													<div class="item Stars">
														<?if($commentInfo->star == 1){?>
															<i class="fa fa-star OK"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<?}elseif($commentInfo->star== 2){?>
																<i class="fa fa-star OK"></i>
																<i class="fa fa-star OK"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<?}elseif($commentInfo->star < 4){?>
																	<i class="fa fa-star OK"></i>
																	<i class="fa fa-star OK"></i>
																	<i class="fa fa-star OK"></i>
																	<i class="fa fa-star"></i>
																	<i class="fa fa-star"></i>
																	<?}elseif($commentInfo->star < 5){?>
																		<i class="fa fa-star OK"></i>
																		<i class="fa fa-star OK"></i>
																		<i class="fa fa-star OK"></i>
																		<i class="fa fa-star OK"></i>
																		<i class="fa fa-star"></i>
																		<?}else{?>
																			<i class="fa fa-star OK"></i>
																			<i class="fa fa-star OK"></i>
																			<i class="fa fa-star OK"></i>
																			<i class="fa fa-star OK"></i>
																			<i class="fa fa-star OK"></i>
																			<?}?>
																		</div>
																	</div>
																	<div class="testimonial-content">
																		<?if(strlen($commentInfo->message) > 190){?>
																			<?=mb_substr($commentInfo->message, 0, 190, "UTF-8")?> ...
																			<?} else {?>
																				<?=$commentInfo->message?>
																				<?}?>
																			</div>
																			<div class="testimonial-date"><?=time_ago($commentInfo->comment_time)?></div>
																		</div>
																	</div>
																	<?}?>
																</div>
															</div>
														</div>
													</div>
												</div>
											</section>
											<!-- / Testimonial -->
											<!-- Seo Text 2 -->
											<section class="pageContent seo-text">
												<div class="container-fluid">
													<div class="row">
														<div class="col-12">
															<div class="area-white" id="seo-white">
																<div class="EditorText Seo">
																	<?$find = array('<p><strong>','</strong></p>','<h3>','</h3>');
																	$replace = array('<div class="pageTitle">','</div>','<div class="pageTitleCat">','</div>');
																	echo str_replace($find, $replace, $otoparcasan->content);?>
																</div>
																<button id="seo-text-show"><p class="acik">Devamını Göster</p><p class="kapali">Gizle</p></button>
															</div>
														</div>
													</div>
												</div>
											</section>
											<!--/ Seo Text 2 -->

<!-- Modal -->
<div class="modal fade" id="sasiModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
    		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      <div class="modal-body">
      	<div class="row">
      		<div class="col-md-12">
      			<div class="carSasiDetail">
      				<img src="" id="carImageSasi">
      				<div class="sasiSecililer"></div>
      				<div class="sasiText"><p>
      					<b class="sasiSearchSasiNumber">KPACA1ETSCP129883</b> şase numarasına ait aracın, aşağıdaki tabloda gösterilen Alt Model, Motor Tipi, Kaporta vb. araca ve şase numarasına göre değişiklik gösterecek donanımlarını da eksiksiz şekilde seçerek aracınızın seçim işlemini bitirmeniz gerekmektedir. Aksi takdirde aradığınız doğru parçaya ulaşamayabilirsiniz.
      				</p></div>
      			</div>
      		</div>
      		<div class="col-12"><div style="color:red;font-weight: bold;" class="gizle" id="sasiSearchErrorText"><center>Lütfen tüm alanlarda bir seçim yapın.</center><br></div></div>
      		<div class="col-12">
      		<div class="select-items allBaslik d-none">
      			
      		</div>
      		<div class="select-items allSelect">
      			
      		</div>
      	</div>
      </div>
      </div>
      <div class="modal-footer">
        <?php if (!(null !==($this->session->userdata('userInfo')))) { ?>
            <button onclick="sasiAra('<?=site_url('yedek-parcalar/')?>')">Ara</button>
        <?php }else{ ?>
            <button onclick="sasiGarajaEkle()">Garajıma Ekle</button>
            <button onclick="sasiAra('<?=site_url('yedek-parcalar/')?>')">Ara</button>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
<div id="carDetail" style="display: none;"><?=json_encode($carDetail ?? '')?></div>
	
<div class="cookie">
	<p>
		<div class="cookie-info">
			<i class="fa fa-info" aria-hidden="true"></i>
		</div>
	Çerezler (cookie), otoparcasan.com web sitesini ve hizmetlerimizi daha etkin bir şekilde sunmamızı sağlamaktadır. Detaylı bilgi için
	<a href="https://otoparcasan.kodakil.com/Corporate/editorPage"> Kişisel Verilerin Korunması</a> ile <a href="https://otoparcasan.kodakil.com/Corporate/editorPage"> Gizlilik ve Çerez Politikası</a>'nı inceleyebilirsiniz.
	<button>
		<i class="fa fa-times cookie-close" aria-hidden="true"></i>
	</button>
	</p>
</div>

<?php if ($this->session->flashdata('social_error')) { ?>
    <script>
        $(document).ready(function () {
            Swal.fire({type: 'error', title: 'Hata !', html: '<center>'.<?=$this->session->flashdata('social_error')?>.'</center>', animation: false, customClass: 'animated tada'});
        });
    </script>
<?php } ?>