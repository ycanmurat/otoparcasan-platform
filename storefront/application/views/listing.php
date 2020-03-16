
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
<section class="pageContent ListingPage">
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
										<img src="<?=site_url('assets/Front/')?>images/garage-item.webp">
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
			<div class="col-md-auto Filter-column">
				<div class="FilterColumn-Title">
					<div class="item"><div class="T">Filtrele</div></div>
					<div class="item"><div class="closeFilter"><i class="fa fa-times" aria-hidden="true"></i></div></div>
				</div>
				<div class="listing-filter">

					<div class="Filter-Area SelectedList">
						<div class="filter-column">
							<div class="filter-title">Seçimleriniz</div>
							<div class="filter-list">
								<div class="ListGroup">
									<div class="SelectedItem"><span class="removeSelect"></span> Vette</div>
									<div class="SelectedItem"><span class="removeSelect"></span> RBW</div>
									<div class="SelectedItem"><span class="removeSelect"></span> 2016</div>
									<div class="SelectedItem"><span class="removeSelect"></span> 100 - 250 TL</div>
								</div>
							</div>
						</div>
					</div>

					<div class="Filter-Area">
						<div class="filter-column">
							<div class="filter-title">Kategori</div>
							<div class="filter-list">
								<div class="ListGroup">
									<a href="#" class="Category-List">Oto Aksesuar Ürünleri</a>
									<a href="#" class="Category-List">Oto Ses Ve Görüntü Sistemleri</a>
									<a href="#" class="Category-List">Oto Lastikler</a>
									<a href="#" class="Category-List">Oto Yedek Parça</a>
									<a href="#" class="Category-List">Tuning</a>
									<a href="#" class="Category-List">Motosiklet Aksesuarları</a>
									<a href="#" class="Category-List">Motosiklet</a>
								</div>
							</div>
						</div>
					</div>

					<div class="Filter-Area">
						<div class="filter-column">
							<div class="filter-title">Marka</div>
							<div class="filter-list">
								<div class="FilterSearch">
									<input type="text" class="jquery_filter" data-search-items-wrapper-id="#filter-marka" data-search-item-class=".Item" data-search-classes="label" autocomplete="off">
								</div>
								<div id="filter-marka" class="ListGroup">
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="marka1" type="checkbox">
										<label class="Checkbox__Label" for="marka1">Vette <span class="Count">(1562)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="marka2" type="checkbox">
										<label class="Checkbox__Label" for="marka2">Inwells <span class="Count">(1347)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="marka3" type="checkbox">
										<label class="Checkbox__Label" for="marka3">Bosch <span class="Count">(1079)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="marka4" type="checkbox">
										<label class="Checkbox__Label" for="marka4">RBW <span class="Count">(1060)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="marka5" type="checkbox">
										<label class="Checkbox__Label" for="marka5">Autoen <span class="Count">(1015)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="marka6" type="checkbox">
										<label class="Checkbox__Label" for="marka6">ByLizard <span class="Count">(404)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="marka7" type="checkbox">
										<label class="Checkbox__Label" for="marka7">Vette <span class="Count">(1562)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="marka8" type="checkbox">
										<label class="Checkbox__Label" for="marka8">Inwells <span class="Count">(1347)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="marka9" type="checkbox">
										<label class="Checkbox__Label" for="marka9">Bosch <span class="Count">(1079)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="marka10" type="checkbox">
										<label class="Checkbox__Label" for="marka10">RBW <span class="Count">(1060)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="marka11" type="checkbox">
										<label class="Checkbox__Label" for="marka11">Autoen <span class="Count">(1015)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="marka12" type="checkbox">
										<label class="Checkbox__Label" for="marka12">ByLizard <span class="Count">(404)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="marka14" type="checkbox">
										<label class="Checkbox__Label" for="marka14">Vette <span class="Count">(1562)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="marka15" type="checkbox">
										<label class="Checkbox__Label" for="marka15">Inwells <span class="Count">(1347)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="marka16" type="checkbox">
										<label class="Checkbox__Label" for="marka16">Bosch <span class="Count">(1079)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="marka17" type="checkbox">
										<label class="Checkbox__Label" for="marka17">RBW <span class="Count">(1060)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="marka18" type="checkbox">
										<label class="Checkbox__Label" for="marka18">Autoen <span class="Count">(1015)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="marka19" type="checkbox">
										<label class="Checkbox__Label" for="marka19">ByLizard <span class="Count">(404)</span></label>
									</div>
								</div>
							</div>
						</div>

						<div class="filter-column">
							<div class="filter-title">Araç Modeli</div>
							<div class="filter-list">
								<div class="FilterSearch">
									<input type="text" class="jquery_filter" data-search-items-wrapper-id="#arac-modeli" data-search-item-class=".Item" data-search-classes="label" autocomplete="off">
								</div>
								<div id="arac-modeli" class="ListGroup">
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="model1" type="checkbox">
										<label class="Checkbox__Label" for="model1">1 Serisi <span class="Count">(28)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="model2" type="checkbox">
										<label class="Checkbox__Label" for="model2">100 <span class="Count">(20)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="model3" type="checkbox">
										<label class="Checkbox__Label" for="model3">106 <span class="Count">(13)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="model4" type="checkbox">
										<label class="Checkbox__Label" for="model4">107 <span class="Count">(7)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="model5" type="checkbox">
										<label class="Checkbox__Label" for="model5">108 <span class="Count">(3)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="model6" type="checkbox">
										<label class="Checkbox__Label" for="model6">116 <span class="Count">(1)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="model7" type="checkbox">
										<label class="Checkbox__Label" for="model7">121 <span class="Count">(1)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="model8" type="checkbox">
										<label class="Checkbox__Label" for="model8">145 <span class="Count">(13)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="model9" type="checkbox">
										<label class="Checkbox__Label" for="model9">146 <span class="Count">(9)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="model10" type="checkbox">
										<label class="Checkbox__Label" for="model10">147 <span class="Count">(20)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="model11" type="checkbox">
										<label class="Checkbox__Label" for="model11">155 <span class="Count">(2)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="model12" type="checkbox">
										<label class="Checkbox__Label" for="model12">156 <span class="Count">(12)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="model13" type="checkbox">
										<label class="Checkbox__Label" for="model13">159 <span class="Count">(8)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="model14" type="checkbox">
										<label class="Checkbox__Label" for="model14">166 <span class="Count">(9)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="model15" type="checkbox">
										<label class="Checkbox__Label" for="model15">19 <span class="Count">(1)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="model16" type="checkbox">
										<label class="Checkbox__Label" for="model16">190 <span class="Count">(1)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="model17" type="checkbox">
										<label class="Checkbox__Label" for="model17">2 <span class="Count">(19)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="model18" type="checkbox">
										<label class="Checkbox__Label" for="model18">2 Serisi <span class="Count">(1)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="model19" type="checkbox">
										<label class="Checkbox__Label" for="model19">200 <span class="Count">(10)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="model20" type="checkbox">
										<label class="Checkbox__Label" for="model20">2004 <span class="Count">(1)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="model21" type="checkbox">
										<label class="Checkbox__Label" for="model21">2006 <span class="Count">(1)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="model22" type="checkbox">
										<label class="Checkbox__Label" for="model22">2007 <span class="Count">(1)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="model23" type="checkbox">
										<label class="Checkbox__Label" for="model23">2008 <span class="Count">(18)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="model24" type="checkbox">
										<label class="Checkbox__Label" for="model24">200Sx <span class="Count">(4)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="model25" type="checkbox">
										<label class="Checkbox__Label" for="model25">205 <span class="Count">(4)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="model26" type="checkbox">
										<label class="Checkbox__Label" for="model26">206 <span class="Count">(49)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="model27" type="checkbox">
										<label class="Checkbox__Label" for="model27">207 <span class="Count">(26)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="model28" type="checkbox">
										<label class="Checkbox__Label" for="model28">208 <span class="Count">(13)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="model29" type="checkbox">
										<label class="Checkbox__Label" for="model29">220 <span class="Count">(1)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="model30" type="checkbox">
										<label class="Checkbox__Label" for="model30">25 <span class="Count">(2)</span></label>
									</div>
								</div>
							</div>
						</div>

						<div class="filter-column">
							<div class="filter-title">Fiyat Aralıgı</div>
							<div class="filter-list">
								<div id="fiyat-araligi" class="ListGroup">
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="fiyat1" name="fiyat-radio" type="radio">
										<label class="Checkbox__Label" for="fiyat1">0 - 25 TL <span class="Count">(540)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="fiyat2" name="fiyat-radio" type="radio">
										<label class="Checkbox__Label" for="fiyat2">25 - 50 TL <span class="Count">(5872)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="fiyat3" name="fiyat-radio" type="radio">
										<label class="Checkbox__Label" for="fiyat3">50 - 100 TL <span class="Count">(3235)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="fiyat4" name="fiyat-radio" type="radio">
										<label class="Checkbox__Label" for="fiyat4">100 - 250 TL <span class="Count">(564)</span></label>
									</div>
									<div class="Item">
										<input class="Checkbox__Input FilterItemTab" id="fiyat5" name="fiyat-radio" type="radio">
										<label class="Checkbox__Label" for="fiyat5">250 - 500 TL <span class="Count">(6)</span></label>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="filter-control">
						<div class="global-btn filter-now d-block">Uygula</div>
					</div>

				</div>
			</div>
			<div class="col-md">
				<div class="Item-Display">
					<div class="row">
						<div class="col-xl-9 col-md-12 ">
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
															<a href="<?=site_url('Product/details')?>" class="img-link"><img src="<?=site_url('assets/Front/')?>images/Detail/detail-img.webp" alt=""></a>
														</div>
													</div>
													<div class="col-sm-8 p-0">
														<div class="list-content">
															<div class="row">
																<div class="col-12">
																	<div class="product-head">
																		<a href="<?=site_url('Product/details')?>" class="ProductName">EUROCRAFT Tam Sentetik Motor Yağı 5W-40 - 5Ltr</a>
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
																			<img src="<?=site_url('assets/Front/')?>images/yerliuretim.webp">
																		</div>
																		<p class="productInfo">Stok Kodu : <b>12345786</b></p>
																	</div>
																</div>
																<div class="col-7">
																	<div class="product-list-badges">
																		<div class="com-item"><i class="fa fa-truck" aria-hidden="true"></i><p> Ücretsiz Kargo</p></div>
																		<div class="com-item"><i class="fa fa-reply" aria-hidden="true"></i><p> Kolay İade</p></div>
																		<div class="com-item"><i class="fa fa-clock-o" aria-hidden="true"></i><p> Teslimat Süresi <br><b>31.01.2019 'da Kargoda</b></p></div>
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
															<a href="<?=site_url('Product/details')?>" class="img-link"><img src="<?=site_url('assets/Front/')?>images/Detail/detail-img.webp" alt=""></a>
														</div>
													</div>
													<div class="col-sm-8 p-0">
														<div class="list-content">
															<div class="row">
																<div class="col-12">
																	<div class="product-head">
																		<a href="<?=site_url('Product/details')?>" class="ProductName">DJPARTS QX Tam Sentetik Motor Yağı 5W-40 - 5Ltr</a>
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
																			<img src="<?=site_url('assets/Front/')?>images/yerliuretim.webp">
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
															<a href="<?=site_url('Product/details')?>" class="img-link"><img src="<?=site_url('assets/Front/')?>images/Detail/detail-img.webp" alt=""></a>
														</div>
													</div>
													<div class="col-sm-8 p-0">
														<div class="list-content">
															<div class="row">
																<div class="col-12">
																	<div class="product-head">
																		<a href="<?=site_url('Product/details')?>" class="ProductName">DJPARTS QX Tam Sentetik Motor Yağı 5W-40 - 5Ltr</a>
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
																			<img src="<?=site_url('assets/Front/')?>images/yerliuretim.webp">
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
										<div class="image-item"><img class="img-fluid" src="<?=site_url('assets/Front/')?>images/markers/eurocraft_d4.webp"></div>
										<p>1159.99 <i class="fa fa-try" aria-hidden="true"></i></p>
									</a>
									<a class="nav-link" id="product-two-tab" data-toggle="pill" href="#product-two" role="tab" aria-controls="product-two" aria-selected="false">
										<div class="image-item"><img class="img-fluid" src="<?=site_url('assets/Front/')?>images/markers/valeo_d4.webp"></div>
										<p>7179.99 <i class="fa fa-try" aria-hidden="true"></i></p>
									</a>
									<a class="nav-link" id="product-three-tab" data-toggle="pill" href="#product-three" role="tab" aria-controls="product-three" aria-selected="false">
										<div class="image-item"><img class="img-fluid" src="<?=site_url('assets/Front/')?>images/markers/bosch_d4.webp"></div>
										<p>4179.99 <i class="fa fa-try" aria-hidden="true"></i></p>
									</a>
									<a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
										<div class="image-item"><img class="img-fluid" src="<?=site_url('assets/Front/')?>images/markers/dj_d4.webp"></div>
										<p>179.99 <i class="fa fa-try" aria-hidden="true"></i></p>
									</a>
									<a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
										<div class="image-item"><img class="img-fluid" src="<?=site_url('assets/Front/')?>images/markers/luk_d4.webp"></div>
										<p>79.99 <i class="fa fa-try" aria-hidden="true"></i></p>
									</a>
									<a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
										<div class="image-item"><img class="img-fluid" src="<?=site_url('assets/Front/')?>images/carbrand/marka7.webp"></div>
										<p>179.99 <i class="fa fa-try" aria-hidden="true"></i></p>
									</a>

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
