<!-- pageContent -->
<section class="pageContent">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="list-head">
					<div class="breadcrumb-box">
						<nav aria-label="breadcrumb-list">
							<ol class="breadcrumb-list">
								<li class="breadcrumb-list-item">
									<a onclick="loader()" class="breadcrumb-list-link" href="<?=site_url()?>">
										Anasayfa
										<i class="fa fa-angle-right" aria-hidden="true"></i>
									</a>
								</li>
								<li class="breadcrumb-list-item active">
									<a class="breadcrumb-list-link mobil-bread-link" href="#">
										<i class="fa fa-angle-left mobil-bread-icon" aria-hidden="true"></i>
										Yedek Parçalar
									</a>
								</li>
							</ol>
						</nav>
					</div>

					<?php if ($selectedCar == true) { ?>
						<div class="car-selected">
							<div class="row">
								<div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12">
									<div class="car-selected-info">
										<div class="car-detail-list">
											<div class="car-detail-block">
												<span>
													Araç
												</span>
												<p>
													<?=$carDetail->Vehicle->ManufacturerName ?? ''?> <?=$carDetail->Vehicle->BaseModelName ?? ''?>
												</p>
											</div>
											<div class="car-detail-block">
												<span>
													Model
												</span>
												<p>
													<?=$carDetail->Vehicle->SubModelName ?? ''?>
												</p>
											</div>
											<div class="car-detail-block">
												<span>
													Motor
												</span>
												<p>
													<?=$carDetail->Vehicle->TechInfo->Capacity ?? ''?> cc - <?=$carDetail->Vehicle->TechInfo->PowerKw ?? ''?> KW - <?=$carDetail->Vehicle->TechInfo->PowerHp ?? ''?> Hp
												</p>
											</div>
											<div class="car-detail-block">
												<span>
													Yıl
												</span>
												<p>
													<?=getConsTime($carDetail->Vehicle->ConstructionTime)?> Sonrası
												</p>
											</div>
											<div class="car-detail-block">
												<span>
													Şanzıman
												</span>
												<p>
													<?=$carDetail->Vehicle->TechInfo->NrOfGears ?? ''?> <?=$carDetail->Vehicle->TechInfo->GearboxType ?? ''?>
												</p>
											</div>
											<div class="car-detail-block">
												<span>
													Yakıt
												</span>
												<p>
													<?=$carDetail->Vehicle->TechInfo->FuelMethod ?? ''?>
												</p>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12">
									<div class="car-selected-img">

										<div class="nav-garage-img">
											<?php foreach ($carImage as $key => $val) { 
												if ($key == 2) {
													break;
												} ?>
												<div>
													<img src="<?=$val ? site_url($val) : 'https://fakeimg.pl/400x250/'?>">
												</div>
											<?php } ?>
										</div>
									</div>
								</div>
								<div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12">
									<div class="car-selected-garage">
										<div class="clear"  onclick="removeSelectedCar()">
											<span>
												Aracı Değiştir
											</span>
											<img src="https://otoparcasan.com/assets/Front/images/Icons/close.svg">
										</div>
										<?php if ($garrageUnVisible == 0) { ?>
											<div class="garage-add">
												<button onclick="addGaraggeFromSelected()"> Garajıma Ekle <img src="https://otoparcasan.com/assets/Front/images/Icons/plus-white.svg"> </button>
											</div>
										<?php } ?>
										<div class="plateSearch Listing">
											<div class="row">
												<div class="col-md-12 col-sm-12 ">
													<div class="mySelectedcar">
														<table class="selectarea">
															<tr>
																<td>
																	<select class="custom-select" name="garaggeCars">
																		<?php if ($userData == false) { ?>
																			<option value="0" selected disabled>Üye Girişi Yapmalısınız</option>
																		<?php }elseif ($garagge == false) { ?>
																			<option value="0" selected disabled>Üye Girişi Yapmalısınız</option>
																		<?php }else{ ?>
																			<option value="0">Garajınızdan Seçin</option>
																			<?php foreach ($garagge as $key => $val) { ?>
																				<option value="<?=$val->car_id?>" cons_time="<?=$val->consTime?>"><?=$val->detail.' - '.$val->name?></option>
																			<?php } ?>
																		<?php } ?>
																	</select>
																</td>
															</tr>
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php }else{ ?>
						<div class="car-not-selected">
							<div class="row">
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
									<div class="plateSearch Listing">
										<div class="row">
											<div class="col-md-4 col-sm-12 m-auto">
												<div class="T">Hızlı Parça Bul</div>
												<div class="Area">
													<div class="plate-area">
														<input type="text" class="plate-input" onkeypress="return enterScript(event)" placeholder="ŞASE NO" id="chasisNo">
														<button type="button" onclick="sasiSearch()" class="plateSearchButon" id="chasisSearch"></button>
													</div>
													<div class="bread-tree-box">
														<button class="bread-tree"  data-toggle="modal" data-target="#carTree">
															Araç Ağacından Seçim
														</button>
													</div>
												</div>

											</div>
											<div class="col-md-8 col-sm-12 ">
												<div class="mySelectedcar">
													<table class="selectarea">
														<tr>
															<td>
																<select class="custom-select" name="garaggeCars">
																	<?php if ($userData == false) { ?>
																		<option value="0" selected disabled>Üye Girişi Yapmalısınız</option>
																	<?php }elseif ($garagge == false) { ?>
																		<option value="0" selected disabled>Üye Girişi Yapmalısınız</option>
																	<?php }else{ ?>
																		<option value="0">Garajınızdan Seçin</option>
																		<?php foreach ($garagge as $key => $val) { ?>
																			<option value="<?=$val->car_id?>" cons_time="<?=$val->consTime?>"><?=$val->detail?></option>
																		<?php } ?>
																	<?php } ?>
																</select>
															</td>
														</tr>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
			<div class="col-md-12">
				<div class="bakim-robot-zone">
					<div class="row">
						<div class="bakim-robot-zone-box">
							<div class="level air">
								<span>Hava Filitresi</span>
							</div>
						</div>
						<div class="bakim-robot-zone-box">
							<div class="level oil">
								<span>Yağ Filitresi</span>
							</div>
						</div>
						<div class="bakim-robot-zone-box">
							<div class="level pollen">
								<span>Polen Filitresi</span>
							</div>
						</div>
						<div class="bakim-robot-zone-box">
							<div class="level gas">
								<span>Yakıt Filitresi</span>
							</div>
						</div>
						<div class="bakim-robot-zone-box">
							<div class="level motor">
								<span>Motor Yağı</span>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="empty_page">
							<div class="Icon"><img src="<?=site_url('assets/Front/images/Icons/garage_empty.webp')?>" alt=""></div>
							<div class="T">Garajınızda Araç Bulunamadı..</div>
							<div class="sT" id="gecici">Hemen sizde aracınız ekleyin, aracınıza göre parçaları listeleyin.</div>
							<script type="text/javascript">
								$('#gecici').click(function() {
									$('.empty_page').slideToggle(500);
									
								});
							</script>
						</div>
					</div>

					<div class="col-lg-4 col-md-4 col-sm-12 col-12">
						<div class="accountArea bakim-robotu-form">
							<form action="#">
								<div class="row">
									<div class="formElements formElements-select">
										<h2>
											Hava Filitresi
										</h2>
									</div>
									<div class="formElements-buttons">
										<div class="formElements formEl-right">
											<button type="submit" class="robotButonPrev">Geri</button>
										</div>
										<div class="formElements formEl-left ">
											<button type="submit" class="robotButonNext">Devam</button>
										</div>
									</div>
									<div class="robot-total">
										<table class="table">
											<tr>
												<td>Hava Filitresi</td>
												<td class="OK td-right">
													<img src="https://otoparcasan.com/assets/Front/images/Icons/tick-circle.svg">
												</td>
											</tr>
											<tr>
												<td>Yağ Filtresi</td>
												<td class="NOT td-right">
													<img src="https://otoparcasan.com/assets/Front/images/Icons/close-circle.svg">
												</td>
											</tr>
											<tr>
												<td>Polen Filtresi</td>
												<td class="NOT td-right">
													<img src="https://otoparcasan.com/assets/Front/images/Icons/close-circle.svg">
												</td>
											</tr>
											<tr>
												<td>Yakıt Filtresi</td>
												<td class="NOT td-right">
													<img src="https://otoparcasan.com/assets/Front/images/Icons/close-circle.svg">
												</td>
											</tr>
											<tr>
												<td>Motor Yağı</td>
												<td class="NOT td-right">
													<img src="https://otoparcasan.com/assets/Front/images/Icons/close-circle.svg">
												</td>
											</tr>
											<tr class="total-tutar-bakim">
												<td>Toplam Tutar:</td>
												<td class="td-right"> 28.08 TL</td>
											</tr>
										</table>
									</div>
									<div class="formElements robot-total-button td-right">
										<button type="submit" class="robotButonNext">Sepete Ekle</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="col-lg-8 col-md-8 col-sm-12 col-12">
						<div class="row">
							<div class="col-6">
								<div class="list-item Small robot-list-item">
									<div class="search-area-img">
										<img src="https://otoparcasan.com/assets/uploads/0d00a5856e04c9c8b34dc5d16c4b4c85febi-200x100.png">
									</div>
									<div class="list-img">
										<a href="#" class="img-link"><img src="https://otoparcasan.com/assets/Front/images/Detail/detail-img3.webp" alt=""></a>
									</div>
									<div class="list-content">
										<div class="product-stars stars-search-page">
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
										<div class="product-head search-product-head">
											<a href="" class="ProductName search-ProductName">Ürün Adı</a>
											<p class="productInfo search-productInfo"> <br>Stok Kodu : 1231231</p>
										</div>
										<div class="product-control">
											<div class="com-item listing-search-item">
												<div class="com-block">
													<svg width="20" height="20">
														<image xlink:href="<?=site_url('assets/Front/')?>images/Icons/time.svg" src="svg.png" width="20" height="20" />
														</svg>
													</div>
													<p>En Geç Kargoda</p>
												</div>
												<div class="product-Price search-product-price">
													<input type="hidden" name="" id="number" value="">
													<div class="search-price-box">
														<!-- Üstü Çizili fiyatla ilgili ne yapılacağı konuşulacak -->
														<div class="old-price">232.00 TL</div>
														<div class="price"> 222.00 TL</div>

													</div>
													<div class="search-basket-box">
														<div class="addBasket search-addBasket">Ürünü Seç<i class="fa fa-angle-right" aria-hidden="true"></i></div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-6">
									<div class="list-item Small robot-list-item">
										<div class="search-area-img">
											<img src="https://otoparcasan.com/assets/uploads/0d00a5856e04c9c8b34dc5d16c4b4c85febi-200x100.png">
										</div>
										<div class="list-img">
											<!--<span class="ribbon new"><span>Yeni</span></span>-->
											<a href="#" class="img-link"><img src="https://otoparcasan.com/assets/Front/images/Detail/detail-img3.webp" alt=""></a>
										</div>
										<div class="list-content">
											<div class="product-stars stars-search-page">
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
											<div class="product-head search-product-head">
												<a href="" class="ProductName search-ProductName">Ürün Adı</a>
												<p class="productInfo search-productInfo"> <br>Stok Kodu : 1231231</p>
											</div>
											<div class="product-control">
												<div class="com-item listing-search-item">
													<div class="com-block">
														<svg width="20" height="20">
															<image xlink:href="<?=site_url('assets/Front/')?>images/Icons/time.svg" src="svg.png" width="20" height="20" />
															</svg>
														</div>
														<p>En Geç Kargoda</p>
													</div>
													<div class="product-Price search-product-price">
														<input type="hidden" name="" id="number" value="">
														<div class="search-price-box">
															<!-- Üstü Çizili fiyatla ilgili ne yapılacağı konuşulacak -->
															<div class="old-price">232.00 TL</div>
															<div class="price"> 222.00 TL</div>

														</div>
														<div class="search-basket-box">
															<div class="addBasket search-addBasket">Ürünü Seç<i class="fa fa-angle-right" aria-hidden="true"></i></div>
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
		<!-- / pageContent -->

