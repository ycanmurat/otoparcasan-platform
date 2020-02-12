<?php include 'pages/head.php';?>
<?php include 'pages/header.php';?>

<div class="breadcrumb-area p-lr">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Anasayfa</a></li>
						<li class="breadcrumb-item active" aria-current="page">Jantlar</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>




<!-- pageContent -->
<section class="pageContent ListingPage ListingFull">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="list-head">
					<div class="col-auto">
						<div class="filter-Btn">Filtrele</div>
					</div>
					<ul class="nav nav-pills justify-content-end" id="pills-tab" role="tablist">
						<li class="nav-item">
							<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Şase Ara</a>
						</li>
						<li class="nav-item">
							<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Garajım</a>
						</li>
					</ul>
					<div class="tab-content" id="pills-tabContent">
						<div class="tab-pane fade show active " id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
							<div class="mySelectedcar">
								<div class="row">
									<div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 d-sm-block d-none">
										<img src="images/garage-item.jpg">
									</div>
									<div class="col-xl-6 col-lg-5 col-md-8 col-sm-8 col-12">
										<table class="table-sm h-100 m-auto">
											<tr>
												<td class="align-middle">
													<p>Marka<b>Mercedes</b></p>
													<p>Model<b>CLA200</b></p>
												</td>
												<td class="align-middle">
													<p>Yıl<b>2018</b></p>
													<p>Yakıt<b>Benzin</b></p>
												</td>
												<td class="align-middle">
													<p>Motor<b>2.0 Turbo</b></p>
													<p>Kasa<b>Stationwagon</b></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="col-xl-3 col-lg-4 col-md-12 ">
										<table class="selectarea">
											<tr>
												<td>
													<select class="custom-select">
														<option value="1">BMW X5 XCROSS 2.0</option>
														<option value="2">BMW 520i LUXURY CONFORT</option>
													</select>
													<a href="javascript:void(0);" data-toggle="modal" data-target="#addNewCarModal">Araç Ekle</a>
												</td>
											</tr>
										</table>
									</div>
									<div class="col-xl-1 col-lg-1 col-md-12">
										<button class="mySelectCarBtn">Ara <i class="fa fa-search" aria-hidden="true"></i></button>

									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
							<div class="plateSearch Listing">
								<form action="#">
									<div class="row">
										<div class="col-md-4 col-sm-12 m-auto">
											<div class="T">Hızlı Parça Bul</div>
											<div class="Area">
												<div class="plate-area">
													<input type="text" class="plate-input" placeholder="ŞASE NO"><button class="plateSearchButon"></button>
												</div>
											</div>
										</div>
										<div class="col-md-8 col-sm-12 ">
											<div class="Area">
												<div class="FormElements">
													<div class="row">
														<div class="col-lg-3 col-6">
															<select class="plate-select2" id="plate-brand">
																<option value="0">- Marka Seçiniz -</option>
																<option value="1">Marka1</option>
																<option value="2">Marka2</option>
															</select>
														</div>
														<div class="col-lg-3 col-6">
															<select class="plate-select2" id="plate-model">
																<option value="0">- Model Seçiniz -</option>
																<option value="1">Model1</option>
																<option value="2">Model2</option>
															</select>
														</div>
														<div class="col-lg-3 col-6 ">	
															<select class="plate-select2" id="plate-year">
																<option value="0">- Yıl -</option>
																<option value="1">2001</option>
																<option value="2">2002</option>
															</select>
														</div>
														<div class="col-lg-3 col-6 add-order m-auto"><button class="Btn Left">Garajıma Ekle</button></div>
														<div class="col-lg-3 col-6">	
															<select class="plate-select2" id="plate-motor">
																<option value="0">- Motor -</option>
																<option value="1">2001</option>
																<option value="2">2002</option>
															</select>
														</div>

														<div class="col-lg-3 col-6 ">	
															<select class="plate-select2" id="plate-fuel">
																<option value="0">- Yakıt -</option>
																<option value="1">Benzin</option>
																<option value="2">Dizel</option>
																<option value="2">Dizel & Tüp</option>
															</select>
														</div>
														<div class="col-lg-3 col-6">	
															<select class="plate-select2" id="plate-case">
																<option value="0">- Kasa -</option>
																<option value="1">Sedan</option>
																<option value="2">pikap</option>
															</select>
														</div>

														<div class="col-lg-3 col-6 m-auto"><button class="Btn Right">Ara</button></div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 p-xl-3 p-0">
				<div class="Item-Display">
					<div class="col-xl-9 col-md-12">
						<div class="tab-content" id="v-pills-tabContent">
							<div class="tab-pane fade show active" id="product-one" role="tabpanel" aria-labelledby="product-one-tab">
								<div class="product-lists">
									<div class="row list-row">
										<div class="product-Item list-item">
											<div class="row">
												<div class="col-sm-4 mr-auto ml-auto">
													<div class="list-img">
														<span class="ribbon Stok OK"><span>Stokta Var</span></span>
														<span class="ribbon"><span>Fırsat</span></span>
														<a href="product-detail.php" class="img-link"><img src="images/Detail/detail-img.jpg" alt=""></a>
													</div>
												</div>
												<div class="col-sm-8 p-0">
													<div class="list-content">
														<div class="row">
															<div class="col-12">
																<div class="product-head">
																	<a href="product-detail.php" class="ProductName">DJPARTS QX Tam Sentetik Motor Yağı 5W-40 - 5Ltr</a>
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
																	<div class="yerli-uretim">
																		<img src="images/yerliuretim.png">
																	</div>
																	<p class="productInfo">Stok Kodu : <b>12345786</b></p>
																</div>
															</div>
															<div class="col-7">
																<div class="product-list-badges">
																	<div class="com-item"><i class="fa fa-truck" aria-hidden="true"></i><p> Ücretsiz Kargo</p></div>
																	<div class="com-item"><i class="fa fa-reply" aria-hidden="true"></i><p> Kolay İade</p></div>
																	<div class="com-item"><i class="fa fa-clock-o" aria-hidden="true"></i><p> Teslimat Süresi <br><b>3 Gün</b></p></div>
																</div>
															</div>
															<div class="col-5">

																<div class="product-Price">
																	<div class="old-price">399.99 ₺</div>
																	<div class="price">159.99 ₺</div>
																	<p class="kargo-price">100 ₺ Üzeri Alışverişlerde Kargo Bedava.</p>
																</div>

															</div>
															<div class="col-12">
																<div class="row">
																	<div class="col-4 p-0">
																		<div class="list-interaction-btn addBasket">
																			<i class="fa fa-shopping-basket" aria-hidden="true"></i>
																			Sepete Ekle
																		</div>
																	</div>
																	<div class="col-4 p-0">
																		<div class="list-interaction-btn addFav">
																			<i class="fa fa-star" aria-hidden="true"></i>
																			Favorilere Ekle
																		</div>
																	</div>

																	<div class="col-4 p-0 pr-2">
																		<div class="list-interaction-btn Share">
																			<i class="fa fa-info" aria-hidden="true"></i>
																			Ürün Detay
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
							<div class="tab-pane fade" id="product-two" role="tabpanel" aria-labelledby="product-two-tab">
								<div class="product-lists">
									<div class="row list-row">
										<div class="product-Item list-item">
											<div class="row">
												<div class="col-4 mr-auto ml-auto">
													<div class="list-img">
														<span class="ribbon Stok OK"><span>Stokta Var</span></span>
														<span class="ribbon"><span>Fırsat</span></span>
														<a href="product-detail.php" class="img-link"><img src="images/Detail/detail-img.jpg" alt=""></a>
													</div>
												</div>
												<div class="col-8 p-0">
													<div class="list-content">
														<div class="row">
															<div class="col-12">
																<div class="product-head">
																	<a href="product-detail.php" class="ProductName">DJPARTS QX Tam Sentetik Motor Yağı 5W-40 - 5Ltr</a>
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
																	<div class="yerli-uretim">
																		<img src="images/yerliuretim.png">
																	</div>
																	<p class="productInfo">Stok Kodu : <b>12345786</b></p>
																</div>
															</div>
															<div class="col-7">
																<div class="product-list-badges">
																	<div class="com-item"><i class="fa fa-truck" aria-hidden="true"></i><p> Ücretsiz Kargo</p></div>
																	<div class="com-item"><i class="fa fa-reply" aria-hidden="true"></i><p> Kolay İade</p></div>
																	<div class="com-item"><i class="fa fa-clock-o" aria-hidden="true"></i><p> Teslimat Süresi <br><b>3 Gün</b></p></div>
																</div>
															</div>
															<div class="col-5">

																<div class="product-Price">
																	<div class="old-price">399.99 ₺</div>
																	<div class="price">159.99 ₺</div>
																	<p class="kargo-price">100 ₺ Üzeri Alışverişlerde Kargo Bedava.</p>
																</div>

															</div>
															<div class="col-12">
																<div class="row">
																	<div class="col-4 p-0">
																		<div class="list-interaction-btn addBasket">
																			<i class="fa fa-shopping-basket" aria-hidden="true"></i>
																			Sepete Ekle
																		</div>
																	</div>
																	<div class="col-4 p-0">
																		<div class="list-interaction-btn addFav">
																			<i class="fa fa-star" aria-hidden="true"></i>
																			Favorilere Ekle
																		</div>
																	</div>

																	<div class="col-4 p-0 pr-2">
																		<div class="list-interaction-btn Share">
																			<i class="fa fa-info" aria-hidden="true"></i>
																			Ürün Detay
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
							<div class="tab-pane fade" id="product-three" role="tabpanel" aria-labelledby="product-three-tab">
								<div class="product-lists">
									<div class="row list-row">
										<div class="product-Item list-item">
											<div class="row">
												<div class="col-4 mr-auto ml-auto">
													<div class="list-img">
														<span class="ribbon Stok OK"><span>Stokta Var</span></span>
														<span class="ribbon"><span>Fırsat</span></span>
														<a href="product-detail.php" class="img-link"><img src="images/Detail/detail-img.jpg" alt=""></a>
													</div>
												</div>
												<div class="col-8 p-0">
													<div class="list-content">
														<div class="row">
															<div class="col-12">
																<div class="product-head">
																	<a href="product-detail.php" class="ProductName">DJPARTS QX Tam Sentetik Motor Yağı 5W-40 - 5Ltr</a>
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
																	<div class="yerli-uretim">
																		<img src="images/yerliuretim.png">
																	</div>
																	<p class="productInfo">Stok Kodu : <b>12345786</b></p>
																</div>
															</div>
															<div class="col-7">
																<div class="product-list-badges">
																	<div class="com-item"><i class="fa fa-truck" aria-hidden="true"></i><p> Ücretsiz Kargo</p></div>
																	<div class="com-item"><i class="fa fa-reply" aria-hidden="true"></i><p> Kolay İade</p></div>
																	<div class="com-item"><i class="fa fa-clock-o" aria-hidden="true"></i><p> Teslimat Süresi <br><b>3 Gün</b></p></div>
																</div>
															</div>
															<div class="col-5">

																<div class="product-Price">
																	<div class="old-price">399.99 ₺</div>
																	<div class="price">159.99 ₺</div>
																	<p class="kargo-price">100 ₺ Üzeri Alışverişlerde Kargo Bedava.</p>
																</div>

															</div>
															<div class="col-12">
																<div class="row">
																	<div class="col-4 p-0">
																		<div class="list-interaction-btn addBasket">
																			<i class="fa fa-shopping-basket" aria-hidden="true"></i>
																			Sepete Ekle
																		</div>
																	</div>
																	<div class="col-4 p-0">
																		<div class="list-interaction-btn addFav">
																			<i class="fa fa-star" aria-hidden="true"></i>
																			Favorilere Ekle
																		</div>
																	</div>

																	<div class="col-4 p-0 pr-2">
																		<div class="list-interaction-btn Share">
																			<i class="fa fa-info" aria-hidden="true"></i>
																			Ürün Detay
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
					<div class="col-xl-3 col-md-12">
						<div class="Product-tab-bg">
							<div class="nav flex-column nav-pills product-tab-menu " id="v-pills-tab" role="tablist" aria-orientation="vertical">
								<a class="nav-link active" id="product-one-tab" data-toggle="pill" href="#product-one" role="tab" aria-controls="product-one" aria-selected="true">
									<div class="image-item"><img class="img-fluid" src="images/markers/eurocraft_d4.png"></div>
									<p>1159.99 <i class="fa fa-try" aria-hidden="true"></i></p>
								</a>
								<a class="nav-link" id="product-two-tab" data-toggle="pill" href="#product-two" role="tab" aria-controls="product-two" aria-selected="false">
									<div class="image-item"><img class="img-fluid" src="images/markers/valeo_d4.png"></div>
									<p>7179.99 <i class="fa fa-try" aria-hidden="true"></i></p>
								</a>
								<a class="nav-link" id="product-three-tab" data-toggle="pill" href="#product-three" role="tab" aria-controls="product-three" aria-selected="false">
									<div class="image-item"><img class="img-fluid" src="images/markers/bosch_d4.png"></div>
									<p>4179.99 <i class="fa fa-try" aria-hidden="true"></i></p>
								</a>
								<a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
									<div class="image-item"><img class="img-fluid" src="images/markers/dj_d4.png"></div>
									<p>179.99 <i class="fa fa-try" aria-hidden="true"></i></p>
								</a>
								<a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
									<div class="image-item"><img class="img-fluid" src="images/markers/luk_d4.png"></div>
									<p>79.99 <i class="fa fa-try" aria-hidden="true"></i></p>
								</a>
								<a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
									<div class="image-item"><img class="img-fluid" src="images/carbrand/marka7.png"></div>
									<p>179.99 <i class="fa fa-try" aria-hidden="true"></i></p>
								</a>

							</div>
						</div>
					</div>
				</div>
				<div class="Item-Display">
					<div class="col-xl-9 col-md-12">
						<div class="tab-content" id="v-pills-tabContent">
							<div class="tab-pane fade show active" id="product-one" role="tabpanel" aria-labelledby="product-one-tab">
								<div class="product-lists">
									<div class="row list-row">
										<div class="product-Item list-item">
											<div class="row">
												<div class="col-sm-4 mr-auto ml-auto">
													<div class="list-img">
														<span class="ribbon Stok OK"><span>Stokta Var</span></span>
														<span class="ribbon"><span>Fırsat</span></span>
														<a href="product-detail.php" class="img-link"><img src="images/Detail/detail-img.jpg" alt=""></a>
													</div>
												</div>
												<div class="col-sm-8 p-0">
													<div class="list-content">
														<div class="row">
															<div class="col-12">
																<div class="product-head">
																	<a href="product-detail.php" class="ProductName">DJPARTS QX Tam Sentetik Motor Yağı 5W-40 - 5Ltr</a>
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
																	<div class="yerli-uretim">
																		<img src="images/yerliuretim.png">
																	</div>
																	<p class="productInfo">Stok Kodu : <b>12345786</b></p>
																</div>
															</div>
															<div class="col-7">
																<div class="product-list-badges">
																	<div class="com-item"><i class="fa fa-truck" aria-hidden="true"></i><p> Ücretsiz Kargo</p></div>
																	<div class="com-item"><i class="fa fa-reply" aria-hidden="true"></i><p> Kolay İade</p></div>
																	<div class="com-item"><i class="fa fa-clock-o" aria-hidden="true"></i><p> Teslimat Süresi <br><b>3 Gün</b></p></div>
																</div>
															</div>
															<div class="col-5">

																<div class="product-Price">
																	<div class="old-price">399.99 ₺</div>
																	<div class="price">159.99 ₺</div>
																	<p class="kargo-price">100 ₺ Üzeri Alışverişlerde Kargo Bedava.</p>
																</div>

															</div>
															<div class="col-12">
																<div class="row">
																	<div class="col-4 p-0">
																		<div class="list-interaction-btn addBasket">
																			<i class="fa fa-shopping-basket" aria-hidden="true"></i>
																			Sepete Ekle
																		</div>
																	</div>
																	<div class="col-4 p-0">
																		<div class="list-interaction-btn addFav">
																			<i class="fa fa-star" aria-hidden="true"></i>
																			Favorilere Ekle
																		</div>
																	</div>

																	<div class="col-4 p-0 pr-2">
																		<div class="list-interaction-btn Share">
																			<i class="fa fa-info" aria-hidden="true"></i>
																			Ürün Detay
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
							<div class="tab-pane fade" id="product-two" role="tabpanel" aria-labelledby="product-two-tab">
								<div class="product-lists">
									<div class="row list-row">
										<div class="product-Item list-item">
											<div class="row">
												<div class="col-sm-4 mr-auto ml-auto">
													<div class="list-img">
														<span class="ribbon Stok OK"><span>Stokta Var</span></span>
														<span class="ribbon"><span>Fırsat</span></span>
														<a href="product-detail.php" class="img-link"><img src="images/Detail/detail-img.jpg" alt=""></a>
													</div>
												</div>
												<div class="col-sm-8 p-0">
													<div class="list-content">
														<div class="row">
															<div class="col-12">
																<div class="product-head">
																	<a href="product-detail.php" class="ProductName">DJPARTS QX Tam Sentetik Motor Yağı 5W-40 - 5Ltr</a>
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
																	<div class="yerli-uretim">
																		<img src="images/yerliuretim.png">
																	</div>
																	<p class="productInfo">Stok Kodu : <b>12345786</b></p>
																</div>
															</div>
															<div class="col-7">
																<div class="product-list-badges">
																	<div class="com-item"><i class="fa fa-truck" aria-hidden="true"></i><p> Ücretsiz Kargo</p></div>
																	<div class="com-item"><i class="fa fa-reply" aria-hidden="true"></i><p> Kolay İade</p></div>
																	<div class="com-item"><i class="fa fa-clock-o" aria-hidden="true"></i><p> Teslimat Süresi <br><b>3 Gün</b></p></div>
																</div>
															</div>
															<div class="col-5">

																<div class="product-Price">
																	<div class="old-price">399.99 ₺</div>
																	<div class="price">159.99 ₺</div>
																	<p class="kargo-price">100 ₺ Üzeri Alışverişlerde Kargo Bedava.</p>
																</div>

															</div>
															<div class="col-12">
																<div class="row">
																	<div class="col-4 p-0">
																		<div class="list-interaction-btn addBasket">
																			<i class="fa fa-shopping-basket" aria-hidden="true"></i>
																			Sepete Ekle
																		</div>
																	</div>
																	<div class="col-4 p-0">
																		<div class="list-interaction-btn addFav">
																			<i class="fa fa-star" aria-hidden="true"></i>
																			Favorilere Ekle
																		</div>
																	</div>

																	<div class="col-4 p-0 pr-2">
																		<div class="list-interaction-btn Share">
																			<i class="fa fa-info" aria-hidden="true"></i>
																			Ürün Detay
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
							<div class="tab-pane fade" id="product-three" role="tabpanel" aria-labelledby="product-three-tab">
								<div class="product-lists">
									<div class="row list-row">
										<div class="product-Item list-item">
											<div class="row">
												<div class="col-sm-4 mr-auto ml-auto">
													<div class="list-img">
														<span class="ribbon Stok OK"><span>Stokta Var</span></span>
														<span class="ribbon"><span>Fırsat</span></span>
														<a href="product-detail.php" class="img-link"><img src="images/Detail/detail-img.jpg" alt=""></a>
													</div>
												</div>
												<div class="col-sm-8 p-0">
													<div class="list-content">
														<div class="row">
															<div class="col-12">
																<div class="product-head">
																	<a href="product-detail.php" class="ProductName">DJPARTS QX Tam Sentetik Motor Yağı 5W-40 - 5Ltr</a>
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
																	<div class="yerli-uretim">
																		<img src="images/yerliuretim.png">
																	</div>
																	<p class="productInfo">Stok Kodu : <b>12345786</b></p>
																</div>
															</div>
															<div class="col-7">
																<div class="product-list-badges">
																	<div class="com-item"><i class="fa fa-truck" aria-hidden="true"></i><p> Ücretsiz Kargo</p></div>
																	<div class="com-item"><i class="fa fa-reply" aria-hidden="true"></i><p> Kolay İade</p></div>
																	<div class="com-item"><i class="fa fa-clock-o" aria-hidden="true"></i><p> Teslimat Süresi <br><b>3 Gün</b></p></div>
																</div>
															</div>
															<div class="col-5">

																<div class="product-Price">
																	<div class="old-price">399.99 ₺</div>
																	<div class="price">159.99 ₺</div>
																	<p class="kargo-price">100 ₺ Üzeri Alışverişlerde Kargo Bedava.</p>
																</div>

															</div>
															<div class="col-12">
																<div class="row">
																	<div class="col-4 p-0">
																		<div class="list-interaction-btn addBasket">
																			<i class="fa fa-shopping-basket" aria-hidden="true"></i>
																			Sepete Ekle
																		</div>
																	</div>
																	<div class="col-4 p-0">
																		<div class="list-interaction-btn addFav">
																			<i class="fa fa-star" aria-hidden="true"></i>
																			Favorilere Ekle
																		</div>
																	</div>

																	<div class="col-4 p-0 pr-2">
																		<div class="list-interaction-btn Share">
																			<i class="fa fa-info" aria-hidden="true"></i>
																			Ürün Detay
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
					<div class="col-xl-3 col-md-12">
						<div class="Product-tab-bg">
							<div class="nav flex-column nav-pills product-tab-menu " id="v-pills-tab" role="tablist" aria-orientation="vertical">
								<a class="nav-link active" id="product-one-tab" data-toggle="pill" href="#product-one" role="tab" aria-controls="product-one" aria-selected="true">
									<div class="image-item"><img class="img-fluid" src="images/markers/eurocraft_d4.png"></div>
									<p>1159.99 <i class="fa fa-try" aria-hidden="true"></i></p>
								</a>
								<a class="nav-link" id="product-two-tab" data-toggle="pill" href="#product-two" role="tab" aria-controls="product-two" aria-selected="false">
									<div class="image-item"><img class="img-fluid" src="images/markers/valeo_d4.png"></div>
									<p>7179.99 <i class="fa fa-try" aria-hidden="true"></i></p>
								</a>
								<a class="nav-link" id="product-three-tab" data-toggle="pill" href="#product-three" role="tab" aria-controls="product-three" aria-selected="false">
									<div class="image-item"><img class="img-fluid" src="images/markers/bosch_d4.png"></div>
									<p>4179.99 <i class="fa fa-try" aria-hidden="true"></i></p>
								</a>
								<a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
									<div class="image-item"><img class="img-fluid" src="images/markers/dj_d4.png"></div>
									<p>179.99 <i class="fa fa-try" aria-hidden="true"></i></p>
								</a>
								<a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
									<div class="image-item"><img class="img-fluid" src="images/markers/luk_d4.png"></div>
									<p>79.99 <i class="fa fa-try" aria-hidden="true"></i></p>
								</a>
								<a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
									<div class="image-item"><img class="img-fluid" src="images/carbrand/marka7.png"></div>
									<p>179.99 <i class="fa fa-try" aria-hidden="true"></i></p>
								</a>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- / pageContent -->

<?php include 'pages/footer.php';?>