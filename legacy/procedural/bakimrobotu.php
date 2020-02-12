<?php include 'pages/head.php';?>
<?php include 'pages/header.php';?>


<!-- pageContent -->
<section class="pageContent">
	<div class="container-fluid">
		<div class="row">

			<div class="col-md-12">
				<div class="pageTitle">Bakım Robotu</div>
				<div class="bakim-robot-zone">
					<div class="row">
						<div class="col-md-2 col-2 pr-1">
							<div class="level carselect OK">
								<span>Araç Seçimi</span>
							</div>
						</div>
						<div class="col-md-2 col-2 pr-1">
							<div class="level air">
								<span>Hava Filtresi</span>
							</div>
						</div>
						<div class="col-md-2 col-2 pr-1">
							<div class="level oil">
								<span>Yağ Filtresi</span>
							</div>
						</div>
						<div class="col-md-2 col-2 pr-1">
							<div class="level pollen">
								<span>Polen Filtresi</span>
							</div>
						</div>
						<div class="col-md-2 col-2 pr-1">
							<div class="level gas">
								<span>Yakıt Filtresi</span>
							</div>
						</div>
						<div class="col-md-2 col-2 pr-1">
							<div class="level motor">
								<span>Motor Yağı</span>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 m-auto">
						<div class="list-head">
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
					<div class="col-md-12">
						<div class="empty_page">
							<div class="Icon"><img src="images/Icons/garage_empty.png?v=1.1" alt=""></div>
							<div class="T">Garajınızda Araç Bulunamadı..</div>
							<div class="sT" id="gecici">Hemen sizde aracınız ekleyin, aracınıza göre parçaları listeleyin.</div>
							<script type="text/javascript">
								$('#gecici').click(function() {
									$('.empty_page').slideToggle(500);
									
								});
							</script>

							<a href="javascript:void(0);" class="global-btn" data-toggle="modal" data-target="#addNewCarModal">Araç Ekle</a>
						</div>
					</div>

					<div class="col-md-12">
						<div class="accountArea bakim-robotu-form">
							<form action="#">
								<div class="row">
									<div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
										<div class="formElements">
											<label for="#">Hava Filtresi</label>
											<select name="" id="">
												<option value="">- Hava Filtreleri -</option>
												<option value="1">3M HAVA FİLTRESİ <b>28,08 TL</b></option>
												<option value="2">WABEN HAVA FİLTRESİ <b>28,08 TL</b></option>
											</select>
										</div>

										<div class="formElements mb-0 mt-3 text-left d-inline">
											<button type="submit" class="robotButonPrev">Geri</button>
										</div>

										<div class="formElements mb-0 mt-3 text-left d-inline">
											<button type="submit" class="robotButonNext">Devam</button>
										</div>
										<div class="formElements mb-0 mt-3 text-left d-inline">
											<button type="submit" class="robotButonNext">Sepete Ekle</button>
										</div>
										<div class="robot-total">
											<table class="table">
												<tr>
													<td>Toplam Tutar:</td>
													<td> 28.08 TL</td>
												</tr>
												<tr>
													<td>Hava Filtresi</td>
													<td class="OK"><i class="fa fa-check-circle-o" aria-hidden="true"></i></td>
												</tr>
												<tr>
													<td>Yağ Filtresi</td>
													<td class="NOT"><i class="fa fa-times-circle-o" aria-hidden="true"></i></td>
												</tr>
												<tr>
													<td>Polen Filtresi</td>
													<td class="NOT"><i class="fa fa-times-circle-o" aria-hidden="true"></i></td>
												</tr>
												<tr>
													<td>Yakıt Filtresi</td>
													<td class="NOT"><i class="fa fa-times-circle-o" aria-hidden="true"></i></td>
												</tr>
												<tr>
													<td>Motor Yağı</td>
													<td class="NOT"><i class="fa fa-times-circle-o" aria-hidden="true"></i></td>
												</tr>
											</table>
										</div>
									</div>
									<div class="col-xl-4 col-md-6 col-sm-12 m-auto">
										<div class="product-lists border">
											<div id="list-col">
												<div class="list-item Small">
													<div class="list-img">
														<a href="product-detail.php" class="img-link"><img class="m-auto" src="images/Detail/detail-img.jpg" alt="" width="169"></a>
													</div>
													<div class="list-content">
														<div class="product-head">
															<a href="product-detail.php" class="ProductName">Waber Hava Filtresi</a>
															<p title="%100 Polen & Toz Filtresi (Ford - Citroen)" class="productInfo">%100 Polen & Toz Filtresi (Ford - Citroen)</p>
														</div>
														<div class="product-control">
															<div class="product-Price">
																<div class="price">49.99 TL</div>
																<div class="old-price">79.99 TL</div>
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
									<div class="col-xl-4 col-md-12 m-auto">
										<div class="robot-product-comment">
											<div class="row">
												<div class="col-md-6"><div class="com-item"><img src="images/return.png"> Ücretsiz Kargo</div></div>
												<div class="col-md-6"><div class="com-item"><img src="images/open-exit-door.png"> 9 Taksit Fırsatı</div></div>
												<div class="col-md-6"><div class="com-item"><img src="images/delivery.png"> Kapıda Ödeme</div></div>
												<div class="col-md-6"><div class="com-item"><img src="images/return.png"> Garantili Ürün</div></div>
												<div class="col-md-6"><div class="com-item"><img src="images/return.png"> Kolay İade</div></div>
												<div class="col-md-6"><div class="com-item"><img src="images/return.png"> Teslimat Süresi 3 Gün</div></div>
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
</section>
<!-- / pageContent -->

<!-- Modal -->
<div class="modal fade" id="addNewCarModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form action="#">
				<div class="modal-header">
					<h5 class="modal-title">Araç Ekle</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="formArea">
						<div class="row m-0">
							<div class="col-sm-6">
								<select name="add_ulke" id="araba_marka">
									<option value="">Aracınızın Markası</option>
									<option value="1">Audi</option>
									<option value="2">Bmw</option>
									<option value="3">Renault</option>
								</select>
							</div>
							<div class="col-sm-6">
								<select name="add_ulke" id="araba_model">
									<option value="">Aracınızın Modeli</option>
									<option value="1">PASSAT 1.6 TDI</option>
									<option value="2">PASSAT 2.0 TDI</option>
									<option value="3">PASSAT 3.0 TDI</option>
								</select>
							</div>
							<div class="col-sm-6">
								<select name="add_ulke" id="araba_yil">
									<option value="">Aracınızın Yılı</option>
									<option value="1">2010</option>
									<option value="1">2011</option>
									<option value="1">2012</option>
									<option value="1">2013</option>
									<option value="1">2014</option>
								</select>
							</div>
							<div class="col-sm-6">
								<select name="add_ulke" id="araba_vites">
									<option value="">Vites Tipi</option>
									<option value="1">Otomatik</option>
									<option value="2">Yarı Otomatik</option>
									<option value="3">Manuel</option>
								</select>
							</div>
							<div class="col-sm-6">
								<select name="add_il" id="araba_yakit">
									<option value="">Yakıt Türü</option>
									<option value="1">Benzin</option>
									<option value="2">Lpg</option>
									<option value="3">Dizel</option>
									<option value="3">Bengin + LPG</option>
									<option value="3">Hibrit</option>
								</select>
							</div>
							<div class="col-sm-6">
								<select name="add_il" id="araba_beygir">
									<option value="">Beygir</option>
									<option value="1">95 HP</option>
									<option value="2">96 HP</option>
									<option value="3">97 HP</option>
									<option value="3">98 HP</option>
									<option value="3">99 HP</option>
								</select>
							</div>
							<div class="col-12">
								<input type="file" id="araba_photo">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
					<button type="button" class="btn btn-primary">Ekle</button>
				</div>
			</form>
		</div>
	</div>
</div>



<?php include 'pages/footer.php';?>