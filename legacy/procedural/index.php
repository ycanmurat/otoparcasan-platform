<?php include 'pages/head.php';?>
<?php include 'pages/header.php';?>

<!-- Slider -->
<section class="Slider p-lr">
	<div class="container-fluid pt-1 pb-3">
		<div class="row">
			<div class="col-xl-12 col-md-12 col-12">
				<div class="plateSearch">
					<div class="T">Hızlı Parça Bul</div>
					<form action="#">

						<div class="Area">
							<div class="sT">Plakanızı Giriniz</div>
							<div class="plate-area">
								<input type="text" class="plate-input" placeholder="ŞASE NO"><button class="plateSearchButon"></button>
							</div>

							<div class="or"><span>VEYA </span></div>
							<div id="mobileSelectBtn" class="mobileSelect">Araç Seçin <i class="fa fa-chevron-down" aria-hidden="true"></i></div>
							<div class="FormElements">
								<select class="plate-select2" id="plate-brand">
									<option value="0">- Marka Seçiniz -</option>
									<option value="1">Marka1</option>
									<option value="2">Marka2</option>
								</select>
								<select class="plate-select2" id="plate-model">
									<option value="0">- Model Seçiniz -</option>
									<option value="1">Model1</option>
									<option value="2">Model2</option>
								</select>
							</div>

							<div class="FormElements">
								<div class="row">	
									<div class="col-6 pr-2">	
										<select class="plate-select2" id="plate-year">
											<option value="0">- Yıl -</option>
											<option value="1">2001</option>
											<option value="2">2002</option>
										</select>
									</div>
									<div class="col-6 pl-2">	
										<select class="plate-select2" id="plate-motor">
											<option value="0">- Motor -</option>
											<option value="1">2001</option>
											<option value="2">2002</option>
										</select>
									</div>

									<div class="col-6 pr-2">	
										<select class="plate-select2" id="plate-fuel">
											<option value="0">- Yakıt -</option>
											<option value="1">Benzin</option>
											<option value="2">Dizel</option>
											<option value="2">Dizel & Tüp</option>
										</select>
									</div>
									<div class="col-6 pl-2">	
										<select class="plate-select2" id="plate-case">
											<option value="0">- Kasa -</option>
											<option value="1">Sedan</option>
											<option value="2">pikap</option>
										</select>
									</div>
								</div>
								<div class="row mt-3">
									<div class="col-6 pr-2"><button class="Btn Left">Garajıma Ekle</button></div>
									<div class="col-6 pl-2"><button class="Btn Right">Ara</button></div>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="owl-carousel owl-theme owl-banner">
					<div class="item""><img src="images/bannerone.jpg"></div>
					<div class="item""><img src="images/bannertwo3.jpg"></div>
					<div class="item""><img src="images/bannerx.png"></div>
					<div class="item""><img src="images/bannerx1.png"></div>
					
<!-- 
					<div class="item" style="background-image:url('https://fakeimg.pl/1680x430/') "><img src="images/bannerone.jpg"></div>
					<div class="item" style="background-image:url('https://fakeimg.pl/1680x430/') "><img src="images/bannertwo3.jpg"></div>
					<div class="item" style="background-image:url('https://fakeimg.pl/1680x430/') "><img src="images/bannerx.png"></div>
					<div class="item" style="background-image:url('https://fakeimg.pl/1680x430/') "><img src="images/bannerx1.png"></div>
				-->
			</div>
		</div>
	</div>
</div>
</section>
<!-- / Slider -->


<!-- Features -->
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
<!-- / Features -->


<!-- / Banners -->
<section class="Banners p-lr">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="site-title"><span>Çok Satılanlar</span></div>
			</div>
			<div class="col-xl-4 col-md-6">
				<div class="item item1">
					<h3>Ampuller</h3>
					<span>Daima Aydınlık Yollar</span>
					<a href="listing.php" class="Link">İNCELE <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
				</div>
			</div>
			<div class="col-xl-4 col-md-6">
				<div class="item item2">
					<h3>Elektronik</h3>
					<span>Devreleri Yakmayın</span>
					<a href="listing.php" class="Link">İNCELE <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
				</div>
			</div>
			<div class="col-xl-4 col-md-6">
				<div class="item item3">
					<h3>Modifiye</h3>
					<span>Gösterişli Olma Zamanı</span>
					<a href="listing.php" class="Link">İNCELE <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
				</div>
			</div>
			<div class="col-xl-4 col-md-6">
				<div class="item item4">
					<h3>Aydınlatma</h3>
					<span>Gece Gözünüz</span>
					<a href="listing.php" class="Link">İNCELE <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
				</div>
			</div>
			<div class="col-xl-4 col-md-6">
				<div class="item item5">
					<h3>Oto Bakımı</h3>
					<span>Temizlik İmandan Gelir</span>
					<a href="listing.php" class="Link">İNCELE <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
				</div>
			</div>
			<div class="col-xl-4 col-md-6">
				<div class="item item6">
					<h3>Motor Yağları</h3>
					<span>Aracınızın Kalp Besini</span>
					<a href="listing.php" class="Link">İNCELE <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- / Banners -->


<!--videoArea -->
<section class="videoArea" style="background-image: url('images/video-bg.jpeg');">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="videoTitle">Otoparçasan Kimdir ?</div>
				<div class="sT">41 farklı otomobil markasına ait yedek parçaları bünyesinde barındıran otoparçasan'ı yakından tanıyın !</div>

				<div class="videoIcon" data-toggle="modal" data-target="#CompanyVideo">
					<div class="circle pulse"></div>
					<div class="circle">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
							<polygon points="40,30 65,50 40,70"></polygon>
						</svg>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="CompanyVideo" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Kurumsal Video</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body p-0">
					<iframe width="100%" height="500" class="d-block" src="https://www.youtube.com/embed/mDgJkJdRfjk" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				</div>
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
						<div class="col-xl-3 col-md-3 d-sm-none d-md-block d-none">
							<a href="#" class="list-title" style="background-image: url('images/yenibg.png');">
								<div class="T">Yeni Gelenler</div>
							</a>
						</div>
						<div class="col-xl-9 col-md-9 col-sm-12">
							<div class="list-wrapper">
								<div class="HomeList-owl owl-carousel">
									<div class="item">
										<div class="list-item Small">
											<div class="list-img">
												<span class="ribbon new"><span>Yeni</span></span>
												<a href="product-detail.php" class="img-link"><img src="images/Detail/detail-img.jpg" alt=""></a>
											</div>
											<div class="list-content">
												<div class="product-head">
													<a href="#" class="ProductName">Özel Jantlar</a>
													<p class="productInfo">Marka:Ford <br>Stok Kodu:12345648</p>
												</div>
												<div class="product-control">
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
										<div class="list-item Small">
											<div class="list-img">
												<span class="ribbon new"><span>Yeni</span></span>
												<a href="product-detail.php" class="img-link"><img src="images/Detail/detail-img-thumb.jpg" alt=""></a>
											</div>
											<div class="list-content">
												<div class="product-head">
													<a href="#" class="ProductName">Özel Jantlar</a>
													<p class="productInfo">Marka:Ford <br>Stok Kodu:12345648</p>
												</div>
												<div class="product-control">
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
										<div class="list-item Small">
											<div class="list-img">
												<span class="ribbon new"><span>Yeni</span></span>
												<a href="product-detail.php" class="img-link"><img src="images/Detail/detail-img2.jpg" alt=""></a>
											</div>
											<div class="list-content">
												<div class="product-head">
													<a href="#" class="ProductName">Özel Jantlar</a>
													<p class="productInfo">Marka:Ford <br>Stok Kodu:12345648</p>
												</div>
												<div class="product-control">
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
										<div class="list-item Small">
											<div class="list-img">
												<span class="ribbon new"><span>Yeni</span></span>
												<a href="product-detail.php" class="img-link"><img src="images/Detail/detail-img-thumb3.jpg" alt=""></a>
											</div>
											<div class="list-content">
												<div class="product-head">
													<a href="#" class="ProductName">Özel Jantlar</a>
													<p class="productInfo">Marka:Ford <br>Stok Kodu:12345648</p>
												</div>
												<div class="product-control">
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
										<div class="list-item Small">
											<div class="list-img">
												<span class="ribbon new"><span>Yeni</span></span>
												<a href="product-detail.php" class="img-link"><img src="images/Detail/detail-img3.jpg" alt=""></a>
											</div>
											<div class="list-content">
												<div class="product-head">
													<a href="#" class="ProductName">Özel Jantlar</a>
													<p class="productInfo">Marka:Ford <br>Stok Kodu:12345648</p>
												</div>
												<div class="product-control">
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
										<div class="list-item Small">
											<div class="list-img">
												<span class="ribbon new"><span>Yeni</span></span>
												<a href="product-detail.php" class="img-link"><img src="images/Detail/detail-img.jpg" alt=""></a>
											</div>
											<div class="list-content">
												<div class="product-head">
													<a href="#" class="ProductName">Özel Jantlar</a>
													<p class="productInfo">Marka:Ford <br>Stok Kodu:12345648</p>
												</div>
												<div class="product-control">
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
										<div class="list-item Small">
											<div class="list-img">
												<span class="ribbon new"><span>Yeni</span></span>
												<a href="product-detail.php" class="img-link"><img src="images/Detail/detail-img.jpg" alt=""></a>
											</div>
											<div class="list-content">
												<div class="product-head">
													<a href="#" class="ProductName">Özel Jantlar</a>
													<p class="productInfo">Marka:Ford <br>Stok Kodu:12345648</p>
												</div>
												<div class="product-control">
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
										<div class="list-item Small">
											<div class="list-img">
												<span class="ribbon new"><span>Yeni</span></span>
												<a href="product-detail.php" class="img-link"><img src="images/Detail/detail-img.jpg" alt=""></a>
											</div>
											<div class="list-content">
												<div class="product-head">
													<a href="#" class="ProductName">Özel Jantlar</a>
													<p class="productInfo">Marka:Ford <br>Stok Kodu:12345648</p>
												</div>
												<div class="product-control">
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
										<div class="list-item Small">
											<div class="list-img">
												<span class="ribbon new"><span>Yeni</span></span>
												<a href="product-detail.php" class="img-link"><img src="images/Detail/detail-img.jpg" alt=""></a>
											</div>
											<div class="list-content">
												<div class="product-head">
													<a href="#" class="ProductName">Özel Jantlar</a>
													<p class="productInfo">Marka:Ford <br>Stok Kodu:12345648</p>
												</div>
												<div class="product-control">
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
										<div class="list-item Small">
											<div class="list-img">
												<span class="ribbon new"Yeni>Fırsat</span></span>
												<a href="product-detail.php" class="img-link"><img src="images/Detail/detail-img.jpg" alt=""></a>
											</div>
											<div class="list-content">
												<div class="product-head">
													<a href="#" class="ProductName">Özel Jantlar</a>
													<p class="productInfo">Marka:Ford <br>Stok Kodu:12345648</p>
												</div>
												<div class="product-control">
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
				<div class="column">
					<div class="row">
						<div class="col-xl-3 col-md-3 d-sm-none d-md-block d-none">
							<a href="#" class="list-title" style="background-image: url('images/firsatbg.png');">
								<div class="T">Fırsat Ürünleri</div>
							</a>
						</div>
						<div class="col-xl-9 col-md-9 col-sm-12">
							<div class="list-wrapper">
								<div class="HomeList-owl owl-carousel">
									<div class="item">
										<div class="list-item Small">
											<div class="list-img">
												<span class="ribbon"><span>Fırsat</span></span>
												<a href="product-detail.php" class="img-link"><img src="images/Detail/detail-img.jpg" alt=""></a>
											</div>
											<div class="list-content">
												<div class="product-head">
													<a href="#" class="ProductName">Özel Jantlar</a>
													<p class="productInfo">Marka:Ford <br>Stok Kodu:12345648</p>
												</div>
												<div class="product-control">
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
										<div class="list-item Small">
											<div class="list-img">
												<span class="ribbon"><span>Fırsat</span></span>
												<a href="product-detail.php" class="img-link"><img src="images/Detail/detail-img.jpg" alt=""></a>
											</div>
											<div class="list-content">
												<div class="product-head">
													<a href="#" class="ProductName">Özel Jantlar</a>
													<p class="productInfo">Marka:Ford <br>Stok Kodu:12345648</p>
												</div>
												<div class="product-control">
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
										<div class="list-item Small">
											<div class="list-img">
												<span class="ribbon"><span>Fırsat</span></span>
												<a href="product-detail.php" class="img-link"><img src="images/Detail/detail-img.jpg" alt=""></a>
											</div>
											<div class="list-content">
												<div class="product-head">
													<a href="#" class="ProductName">Özel Jantlar</a>
													<p class="productInfo">Marka:Ford <br>Stok Kodu:12345648</p>
												</div>
												<div class="product-control">
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
										<div class="list-item Small">
											<div class="list-img">
												<span class="ribbon"><span>Fırsat</span></span>
												<a href="product-detail.php" class="img-link"><img src="images/Detail/detail-img.jpg" alt=""></a>
											</div>
											<div class="list-content">
												<div class="product-head">
													<a href="#" class="ProductName">Özel Jantlar</a>
													<p class="productInfo">Marka:Ford <br>Stok Kodu:12345648</p>
												</div>
												<div class="product-control">
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
										<div class="list-item Small">
											<div class="list-img">
												<span class="ribbon"><span>Fırsat</span></span>
												<a href="product-detail.php" class="img-link"><img src="images/Detail/detail-img.jpg" alt=""></a>
											</div>
											<div class="list-content">
												<div class="product-head">
													<a href="#" class="ProductName">Özel Jantlar</a>
													<p class="productInfo">Marka:Ford <br>Stok Kodu:12345648</p>
												</div>
												<div class="product-control">
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
										<div class="list-item Small">
											<div class="list-img">
												<span class="ribbon"><span>Fırsat</span></span>
												<a href="product-detail.php" class="img-link"><img src="images/Detail/detail-img.jpg" alt=""></a>
											</div>
											<div class="list-content">
												<div class="product-head">
													<a href="#" class="ProductName">Özel Jantlar</a>
													<p class="productInfo">Marka:Ford <br>Stok Kodu:12345648</p>
												</div>
												<div class="product-control">
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
										<div class="list-item Small">
											<div class="list-img">
												<span class="ribbon"><span>Fırsat</span></span>
												<a href="product-detail.php" class="img-link"><img src="images/Detail/detail-img.jpg" alt=""></a>
											</div>
											<div class="list-content">
												<div class="product-head">
													<a href="#" class="ProductName">Özel Jantlar</a>
													<p class="productInfo">Marka:Ford <br>Stok Kodu:12345648</p>
												</div>
												<div class="product-control">
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
										<div class="list-item Small">
											<div class="list-img">
												<span class="ribbon"><span>Fırsat</span></span>
												<a href="product-detail.php" class="img-link"><img src="images/Detail/detail-img.jpg" alt=""></a>
											</div>
											<div class="list-content">
												<div class="product-head">
													<a href="#" class="ProductName">Özel Jantlar</a>
													<p class="productInfo">Marka:Ford <br>Stok Kodu:12345648</p>
												</div>
												<div class="product-control">
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
										<div class="list-item Small">
											<div class="list-img">
												<span class="ribbon"><span>Fırsat</span></span>
												<a href="product-detail.php" class="img-link"><img src="images/Detail/detail-img.jpg" alt=""></a>
											</div>
											<div class="list-content">
												<div class="product-head">
													<a href="#" class="ProductName">Özel Jantlar</a>
													<p class="productInfo">Marka:Ford <br>Stok Kodu:12345648</p>
												</div>
												<div class="product-control">
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
										<div class="list-item Small">
											<div class="list-img">
												<span class="ribbon"><span>Fırsat</span></span>
												<a href="product-detail.php" class="img-link"><img src="images/Detail/detail-img.jpg" alt=""></a>
											</div>
											<div class="list-content">
												<div class="product-head">
													<a href="#" class="ProductName">Özel Jantlar</a>
													<p class="productInfo">Marka:Ford <br>Stok Kodu:12345648</p>
												</div>
												<div class="product-control">
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
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="carBrandsMarque">
				<div class="owl-carousel owl-theme owl-carBrands">
					<div class="item"><img alt="ford" title="ford" src="images/carbrand/carlogo1.png"></div>
					<div class="item"><img src="images/carbrand/carlogo2.png"></div>
					<div class="item"><img src="images/carbrand/carlogo3.png"></div>
					<div class="item"><img src="images/carbrand/carlogo4.png"></div>
					<div class="item"><img src="images/carbrand/carlogo5.png"></div>
					<div class="item"><img src="images/carbrand/carlogo6.png"></div>
					<div class="item"><img src="images/carbrand/carlogo7.png"></div>
					<div class="item"><img src="images/carbrand/carlogo8.png"></div>
					<div class="item"><img src="images/carbrand/carlogo9.png"></div>
					<div class="item"><img src="images/carbrand/carlogo10.png"></div>
					<div class="item"><img src="images/carbrand/carlogo11.png"></div>
					<div class="item"><img src="images/carbrand/carlogo12.png"></div>
					<div class="item"><img src="images/carbrand/carlogo13.png"></div>
					<div class="item"><img src="images/carbrand/carlogo14.png"></div>
					<div class="item"><img src="images/carbrand/carlogo15.png"></div>
					<div class="item"><img src="images/carbrand/carlogo16.png"></div>
					<div class="item"><img src="images/carbrand/carlogo17.png"></div>
					<div class="item"><img src="images/carbrand/carlogo18.png"></div>
					<div class="item"><img src="images/carbrand/carlogo19.png"></div>
					<div class="item"><img src="images/carbrand/carlogo20.png"></div>
					<div class="item"><img src="images/carbrand/carlogo21.png"></div>
					<div class="item"><img src="images/carbrand/carlogo22.png"></div>
					<div class="item"><img src="images/carbrand/carlogo23.png"></div>
					<div class="item"><img src="images/carbrand/carlogo24.png"></div>
					<div class="item"><img src="images/carbrand/carlogo25.png"></div>
					<div class="item"><img src="images/carbrand/carlogo26.png"></div>
					<div class="item"><img src="images/carbrand/carlogo27.png"></div>
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
						<img src="images/guard-img.png" alt="">
						<div class="guard-text">
							<h3>Hızlı <span>Teslim</span></h3>
							<p>Öğemiz şu anda depomuzda.<br>Bu statüye sahip ürünler sipariş<br>ödemesinden itibaren 4-5 gün<br>içinde gönderilir.</p>
						</div>
					</div>
					<div class="Area">
						<div class="item">
							<h2>Araba Parçaları</h2>
							<p>Araba parçaları hizliparcabul.com uzun vadeli bir deneyim ve binlerce memnun müşteri nedeniyle önde gelen otomobil parçaları online mağazalarından biridir. Mükemmel fiyat tekliflerinin yanı sıra servisimizden de emin olun.</p>
						</div>
						<div class="item">
							<h2>Yüksek kaliteli marka otomobil parçaları</h2>
							<p>Çok çeşitli üreticler ve yüksek kaliteli otomobil parçaları, aracınızın hareketliliğini ve yollarda güvenliğini garanti eder. Güvenilir otomobil parçaları tedarikçisi olarak markalı otomobil yedeklerine ve Hizliparcabul.com'a güvenin.</p>
						</div>

						<div class="item">
							<h2>Orjinal Parça Kalitesi</h2>
							<p>Serifikalı ve güvenilir tedarikçiler için tüm otomobil parçaları yelpazesini sağlar. Hizliparcabul.com tarafından en iyi marka yedek parçaları alırsınız. Destek ekibimizin yetkili personelini her zaman arayabilir yardım alabilirsiniz.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- / SeoText -->

<!-- Car Brands  --  Bu alan Backend e Dahil Değildir-->
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="carBrandsMarque">
				<div class="owl-carousel owl-theme owl-carBrands">
					<div class="item"><img alt="eurocraft" title="eurocraft" src="images/carbrand/marka1.png"></div>
					<div class="item"><img src="images/carbrand/marka2.png"></div>
					<div class="item"><img src="images/carbrand/marka3.png"></div>
					<div class="item"><img src="images/carbrand/marka4.png"></div>
					<div class="item"><img src="images/carbrand/marka5.png"></div>
					<div class="item"><img src="images/carbrand/marka6.png"></div>
					<div class="item"><img src="images/carbrand/marka7.png"></div>
					<div class="item"><img src="images/carbrand/marka8.png"></div>
					<div class="item"><img src="images/carbrand/marka9.png"></div>
					<div class="item"><img src="images/carbrand/marka10.png"></div>
					<div class="item"><img src="images/carbrand/marka11.png"></div>
					<div class="item"><img src="images/carbrand/marka12.png"></div>
					<div class="item"><img src="images/carbrand/marka13.png"></div>
					<div class="item"><img src="images/carbrand/marka14.png"></div>
					<div class="item"><img src="images/carbrand/marka15.png"></div>
					<div class="item"><img src="images/carbrand/marka16.png"></div>
					<div class="item"><img src="images/carbrand/marka17.png"></div>
					<div class="item"><img src="images/carbrand/marka18.png"></div>
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
				<div class="site-title"><span>Müşterilerimiz Ne Düşünüyor ?</span></div>
			</div>
			<div class="col-12">
				<div class="testimonial-wrapper">
					<div class="testimonial-owl owl-carousel">
						<div class="item">
							<div class="testimonial-item">
								<div class="testimonial-head">
									<div class="item Name">Serdar AŞAN</div>
									<div class="item Stars">
										<i class="fa fa-star OK"></i>
										<i class="fa fa-star OK"></i>
										<i class="fa fa-star OK"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
									</div>
								</div>
								<div class="testimonial-content">
									Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat labore rem eius repellat nisi. Voluptas molestiae, tenetur, nam sit natus placeat error nihil facere optio quibusdam obcaecati, illo atque magnam?
								</div>
								<div class="testimonial-date">8 dakika önce yayınlandı</div>
							</div>
						</div>
						<div class="item">
							<div class="testimonial-item">
								<div class="testimonial-head">
									<div class="item Name">Serdar AŞAN</div>
									<div class="item Stars">
										<i class="fa fa-star OK"></i>
										<i class="fa fa-star OK"></i>
										<i class="fa fa-star OK"></i>
										<i class="fa fa-star OK"></i>
										<i class="fa fa-star OK"></i>
									</div>
								</div>
								<div class="testimonial-content">
									Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat labore rem eius repellat nisi. Voluptas molestiae, tenetur, nam sit natus placeat error nihil facere optio quibusdam obcaecati, illo atque magnam?
								</div>
								<div class="testimonial-date">8 dakika önce yayınlandı</div>
							</div>
						</div>
						<div class="item">
							<div class="testimonial-item">
								<div class="testimonial-head">
									<div class="item Name">Serdar AŞAN</div>
									<div class="item Stars">
										<i class="fa fa-star OK"></i>
										<i class="fa fa-star OK"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
									</div>
								</div>
								<div class="testimonial-content">
									Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat labore rem eius repellat nisi. Voluptas molestiae, tenetur, nam sit natus placeat error nihil facere optio quibusdam obcaecati, illo atque magnam?
								</div>
								<div class="testimonial-date">8 dakika önce yayınlandı</div>
							</div>
						</div>
						<div class="item">
							<div class="testimonial-item">
								<div class="testimonial-head">
									<div class="item Name">Serdar AŞAN</div>
									<div class="item Stars">
										<i class="fa fa-star OK"></i>
										<i class="fa fa-star OK"></i>
										<i class="fa fa-star OK"></i>
										<i class="fa fa-star OK"></i>
										<i class="fa fa-star OK"></i>
									</div>
								</div>
								<div class="testimonial-content">
									Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat labore rem eius repellat nisi. Voluptas molestiae, tenetur, nam sit natus placeat error nihil facere optio quibusdam obcaecati, illo atque magnam?
								</div>
								<div class="testimonial-date">8 dakika önce yayınlandı</div>
							</div>
						</div>
						<div class="item">
							<div class="testimonial-item">
								<div class="testimonial-head">
									<div class="item Name">Serdar AŞAN</div>
									<div class="item Stars">
										<i class="fa fa-star OK"></i>
										<i class="fa fa-star OK"></i>
										<i class="fa fa-star OK"></i>
										<i class="fa fa-star OK"></i>
										<i class="fa fa-star"></i>
									</div>
								</div>
								<div class="testimonial-content">
									Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat labore rem eius repellat nisi. Voluptas molestiae, tenetur, nam sit natus placeat error nihil facere optio quibusdam obcaecati, illo atque magnam?
								</div>
								<div class="testimonial-date">8 dakika önce yayınlandı</div>
							</div>
						</div>
						<div class="item">
							<div class="testimonial-item">
								<div class="testimonial-head">
									<div class="item Name">Serdar AŞAN</div>
									<div class="item Stars">
										<i class="fa fa-star OK"></i>
										<i class="fa fa-star OK"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
									</div>
								</div>
								<div class="testimonial-content">
									Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat labore rem eius repellat nisi. Voluptas molestiae, tenetur, nam sit natus placeat error nihil facere optio quibusdam obcaecati, illo atque magnam?
								</div>
								<div class="testimonial-date">8 dakika önce yayınlandı</div>
							</div>
						</div>
						<div class="item">
							<div class="testimonial-item">
								<div class="testimonial-head">
									<div class="item Name">Serdar AŞAN</div>
									<div class="item Stars">
										<i class="fa fa-star OK"></i>
										<i class="fa fa-star OK"></i>
										<i class="fa fa-star OK"></i>
										<i class="fa fa-star OK"></i>
										<i class="fa fa-star"></i>
									</div>
								</div>
								<div class="testimonial-content">
									Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat labore rem eius repellat nisi. Voluptas molestiae, tenetur, nam sit natus placeat error nihil facere optio quibusdam obcaecati, illo atque magnam?
								</div>
								<div class="testimonial-date">8 dakika önce yayınlandı</div>
							</div>
						</div>
						<div class="item">
							<div class="testimonial-item">
								<div class="testimonial-head">
									<div class="item Name">Serdar AŞAN</div>
									<div class="item Stars">
										<i class="fa fa-star OK"></i>
										<i class="fa fa-star OK"></i>
										<i class="fa fa-star OK"></i>
										<i class="fa fa-star OK"></i>
										<i class="fa fa-star"></i>
									</div>
								</div>
								<div class="testimonial-content">
									Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat labore rem eius repellat nisi. Voluptas molestiae, tenetur, nam sit natus placeat error nihil facere optio quibusdam obcaecati, illo atque magnam?
								</div>
								<div class="testimonial-date">8 dakika önce yayınlandı</div>
							</div>
						</div>
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
					<div class="pageTitle">En Başarılı Oto Parça Sitesi - Otoparçasan</div>
					<div class="EditorText Seo">
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem quas, incidunt saepe eaque optio ab, quibusdam voluptatibus quia itaque molestiae mollitia deleniti officiis porro et sequi architecto reiciendis repellat. Necessitatibus. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint dicta, mollitia quia vitae assumenda debitis eos blanditiis in. Aperiam dolore illum quasi voluptates sit ipsa perferendis a debitis, aliquid distinctio.</p>

						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi quibusdam, asperiores, ex mollitia nesciunt ipsum aspernatur dolorem nam atque voluptate. Praesentium perferendis debitis velit alias, deleniti non ex ducimus consequatur.</p>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem quas, incidunt saepe eaque optio ab, quibusdam voluptatibus quia itaque molestiae mollitia deleniti officiis porro et sequi architecto reiciendis repellat. Necessitatibus. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint dicta, mollitia quia vitae assumenda debitis eos blanditiis in. Aperiam dolore illum quasi voluptates sit ipsa perferendis a debitis, aliquid distinctio.</p>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi quibusdam, asperiores, ex mollitia nesciunt ipsum aspernatur dolorem nam atque voluptate. Praesentium perferendis debitis velit alias, deleniti non ex ducimus consequatur.</p>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem quas, incidunt saepe eaque optio ab, quibusdam voluptatibus quia itaque molestiae mollitia deleniti officiis porro et sequi architecto reiciendis repellat. Necessitatibus. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint dicta, mollitia quia vitae assumenda debitis eos blanditiis in. Aperiam dolore illum quasi voluptates sit ipsa perferendis a debitis, aliquid distinctio.</p>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi quibusdam, asperiores, ex mollitia nesciunt ipsum aspernatur dolorem nam atque voluptate. Praesentium perferendis debitis velit alias, deleniti non ex ducimus consequatur.</p>
					</div>
					<div class="pageTitle">En Başarılı Oto Parça Sitesi - Otoparçasan</div>
					<div class="EditorText Seo">
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem quas, incidunt saepe eaque optio ab, quibusdam voluptatibus quia itaque molestiae mollitia deleniti officiis porro et sequi architecto reiciendis repellat. Necessitatibus. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint dicta, mollitia quia vitae assumenda debitis eos blanditiis in. Aperiam dolore illum quasi voluptates sit ipsa perferendis a debitis, aliquid distinctio.</p>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi quibusdam, asperiores, ex mollitia nesciunt ipsum aspernatur dolorem nam atque voluptate. Praesentium perferendis debitis velit alias, deleniti non ex ducimus consequatur.</p>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem quas, incidunt saepe eaque optio ab, quibusdam voluptatibus quia itaque molestiae mollitia deleniti officiis porro et sequi architecto reiciendis repellat. Necessitatibus. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint dicta, mollitia quia vitae assumenda debitis eos blanditiis in. Aperiam dolore illum quasi voluptates sit ipsa perferendis a debitis, aliquid distinctio.</p>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi quibusdam, asperiores, ex mollitia nesciunt ipsum aspernatur dolorem nam atque voluptate. Praesentium perferendis debitis velit alias, deleniti non ex ducimus consequatur.</p>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem quas, incidunt saepe eaque optio ab, quibusdam voluptatibus quia itaque molestiae mollitia deleniti officiis porro et sequi architecto reiciendis repellat. Necessitatibus. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint dicta, mollitia quia vitae assumenda debitis eos blanditiis in. Aperiam dolore illum quasi voluptates sit ipsa perferendis a debitis, aliquid distinctio.</p>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi quibusdam, asperiores, ex mollitia nesciunt ipsum aspernatur dolorem nam atque voluptate. Praesentium perferendis debitis velit alias, deleniti non ex ducimus consequatur.</p>
					</div>
					<button id="seo-text-show"><p class="acik">Devamını Göster</p><p class="kapali">Gizle</p></button>
				</div>
			</div>
		</div>
	</div>
</section>
<!--/ Seo Text 2 -->


<?php include 'pages/footer.php';?>