<?php include 'pages/head.php';?>
<?php include 'pages/header.php';?>

<div class="breadcrumb-area p-lr">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
						<li class="breadcrumb-item active" aria-current="page">Fren ve Debriyaj</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>





<!-- / pageContent -->
<!-- pageContent -->
<section class="pageContent">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
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
				<h3 class="font-weight-bold pageTitle">FREN VE DEBRİYAJ</h3>
				<p class="altTitle mt-2">
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in sapien in lacus efficitur fringilla vitae eu ipsum. Cras cursus dui nisi. Cras dapibus turpis nec erat aliquet fringilla. Quisque porta justo vitae dolor egestas, egestas varius erat fringilla. Quisque scelerisque sed ipsum sit amet semper. Etiam porta ipsum mollis, convallis dolor at, pellentesque ex. Etiam luctus eros id sollicitudin luctus. Fusce tincidunt libero quis tempor consequat.</p>
				<div class="pageTitle">Fren</div>

			</div>
			<div class="col-12">
				<div class="altyedekPart">
					<div class="row">
						<div class="col-lg-3 col-md-3  col-6">
							<a href="listing_full.php" class="altPart-Item">
								<div class="alt-item-img">
									<img src="images/app1.png">
								</div>
								<p class="Title">ABS Sensörleri</p>
							</a>
						</div>
						<div class="col-lg-3 col-md-3  col-6">
							<a href="#" class="altPart-Item">
								<div class="alt-item-img">
									<img src="images/app1.png">
								</div>
								<p class="Title">Product Test Item</p>
							</a>
						</div>
						<div class="col-lg-3 col-md-3  col-6">
							<a href="#" class="altPart-Item">
								<div class="alt-item-img">
									<img src="images/app1.png">
								</div>
								<p class="Title">Product Test Item</p>
							</a>
						</div>
						<div class="col-lg-3 col-md-3  col-6">
							<a href="#" class="altPart-Item">
								<div class="alt-item-img">
									<img src="images/app1.png">
								</div>
								<p class="Title">Product Test Item</p>
							</a>
						</div>
						<div class="col-lg-3 col-md-3  col-6">
							<a href="#" class="altPart-Item">
								<div class="alt-item-img">
									<img src="images/app1.png">
								</div>
								<p class="Title">Product Test Item</p>
							</a>
						</div>
						<div class="col-lg-3 col-md-3  col-6">
							<a href="#" class="altPart-Item">
								<div class="alt-item-img">
									<img src="images/app1.png">
								</div>
								<p class="Title">Product Test Item</p>
							</a>
						</div>
						<div class="col-lg-3 col-md-3  col-6">
							<a href="#" class="altPart-Item">
								<div class="alt-item-img">
									<img src="images/app1.png">
								</div>
								<p class="Title">Product Test Item</p>
							</a>
						</div>
						<div class="col-lg-3 col-md-3  col-6">
							<a href="#" class="altPart-Item">
								<div class="alt-item-img">
									<img src="images/app1.png">
								</div>
								<p class="Title">Product Test Item</p>
							</a>
						</div>
					</div>
				</div>
			</div>

			<div class="col-12">
				<hr>
				<div class="pageTitle">Balata</div>
			</div>
			<div class="col-12">
				<div class="altyedekPart">
					<div class="row">
						<div class="col-lg-3 col-md-3 col-6">
							<a href="#" class="altPart-Item">
								<div class="alt-item-img">
									<img src="images/app2.png">
								</div>
								<p class="Title">Product Test Item</p>
							</a>
						</div>
						<div class="col-lg-3 col-md-3 col-6">
							<a href="#" class="altPart-Item">
								<div class="alt-item-img">
									<img src="images/app2.png">
								</div>
								<p class="Title">Product Test Item</p>
							</a>
						</div>
						<div class="col-lg-3 col-md-3 col-6">
							<a href="#" class="altPart-Item">
								<div class="alt-item-img">
									<img src="images/app2.png">
								</div>
								<p class="Title">Product Test Item</p>
							</a>
						</div>
						<div class="col-lg-3 col-md-3 col-6">
							<a href="#" class="altPart-Item">
								<div class="alt-item-img">
									<img src="images/app2.png">
								</div>
								<p class="Title">Product Test Item</p>
							</a>
						</div>
						<div class="col-lg-3 col-md-3 col-6">
							<a href="#" class="altPart-Item">
								<div class="alt-item-img">
									<img src="images/app2.png">
								</div>
								<p class="Title">Product Test Item</p>
							</a>
						</div>
						<div class="col-lg-3 col-md-3 col-6">
							<a href="#" class="altPart-Item">
								<div class="alt-item-img">
									<img src="images/app2.png">
								</div>
								<p class="Title">Product Test Item</p>
							</a>
						</div>
						<div class="col-lg-3 col-md-3 col-6">
							<a href="#" class="altPart-Item">
								<div class="alt-item-img">
									<img src="images/app2.png">
								</div>
								<p class="Title">Product Test Item</p>
							</a>
						</div>
						<div class="col-lg-3 col-md-3 col-6">
							<a href="#" class="altPart-Item">
								<div class="alt-item-img">
									<img src="images/app2.png">
								</div>
								<p class="Title">Product Test Item</p>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12">
				<div class="pageTitle">Oto Parça Kategorileri Hakkında</div>
				<p class="pageText">
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean aliquet molestie cursus. Duis tincidunt sit amet odio vel euismod. Donec congue orci vel pulvinar volutpat. Donec lorem ante, interdum a finibus in, placerat quis nunc. Nullam luctus sodales leo, quis luctus elit venenatis vitae. Fusce felis odio, bibendum vel bibendum in, gravida convallis justo. Proin sollicitudin urna erat, vitae ornare ante pretium in. Vivamus elementum arcu ut metus facilisis, eu vulputate eros ultricies. Fusce luctus tortor eros, quis maximus erat faucibus eget. Nulla ut viverra est. Maecenas eleifend diam sed ligula bibendum dignissim. Mauris elementum laoreet finibus. Nullam tortor nibh, luctus id quam vel, vehicula gravida dui.
				</p>
			</div>
		</div>
	</div>
</section>
<!-- / pageContent -->




<?php include 'pages/footer.php';?>