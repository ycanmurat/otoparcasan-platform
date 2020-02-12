<?php include 'pages/head.php';?>
<?php include 'pages/header.php';?>



<!-- pageContent -->
<section class="pageContent">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-auto">
				<div class="accountPanel">
					<div class="panel-head">
						<div class="Welcome">Merhaba <span>Emre</span></div>
						<div class="user-mail">demo@example.com</div>
					</div>
					<div class="panel-content">
						<a href="account.php" class="panel-link "><div class="Icon"><i class="fa fa-user" aria-hidden="true"></i></div>Hesabım</a>
						<a href="orders.php" class="panel-link"><div class="Icon"><i class="fa fa-cube" aria-hidden="true"></i></div>Siparişlerim<span class="Count">122</span></a>
						<a href="returns.php" class="panel-link"><div class="Icon"><i class="fa fa-reply" aria-hidden="true"></i></div>İadelerim<span class="Count">3</span></a>
						<a href="product_question.php" class="panel-link"><div class="Icon"><i class="fa fa-question-circle" aria-hidden="true"></i></div>Ürün Sorularım<span class="Count">3</span></a>
						<a href="address.php" class="panel-link "><div class="Icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>Adreslerim</a>
						<a href="favorites.php" class="panel-link "><div class="Icon"><i class="fa fa-heart" aria-hidden="true"></i></div>Favorilerim</a>
						<a href="garage.php" class="panel-link Active"><div class="Icon"><i class="fa fa-car" aria-hidden="true"></i></div>Garajım</a>
						<a href="#" class="panel-link"><div class="Icon"><i class="fa fa-sign-out" aria-hidden="true"></i></div>Çıkış Yap</a>
					</div>
				</div>
			</div>
			<div class="col-md">
				<div class="pageTitle">Garajım</div>

				<div class="addNewCar" data-toggle="modal" data-target="#addNewCarModal">
					<div class="addBtn">Yeni Araç Ekle</div>
				</div>

				<div class="garage_item">
					<div class="garage-img" style="background-image: url('images/garage-item.jpg');"></div>
					<div class="garage-content">
						<div class="contentHead">
							<h3 class="Title">BMW X5 XCROSS 2.0</h3>
							<div class="removeGarage"><i class="fa fa-trash-o" aria-hidden="true"></i></div>
						</div>
						<div class="contentBody">
							<div class="row">
								<div class="col-12">
									<div class="row">
										<div class="col-4">
											<div class="garage-item-feature feature1">
												<div class="feature-title">Marka</div>
												<div class="feature-info">Mercedes</div>
											</div>
											<div class="garage-item-feature feature2">
												<div class="feature-title">Model</div>
												<div class="feature-info">CLA200</div>
											</div>
										</div>
										<div class="col-4">
											<div class="garage-item-feature feature3">
												<div class="feature-title">Yıl</div>
												<div class="feature-info">2018</div>
											</div>
											<div class="garage-item-feature feature4">
												<div class="feature-title">Yakıt</div>
												<div class="feature-info">Benzin</div>
											</div>
										</div>
										<div class="col-4">
											<div class="garage-item-feature feature3">
												<div class="feature-title">Motor</div>
												<div class="feature-info">2.0 Turbo</div>
											</div>
											<div class="garage-item-feature feature4">
												<div class="feature-title">Kasa</div>
												<div class="feature-info">Stationwagon</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-12">
									<div class="garage-action">
										<div class="Btn Btn1">Yedek Parçalar</div>
										<div class="Btn Btn2">Bakım Ürünleri</div>
										<div class="Btn Btn3">Aksesuarlar</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				
				<div class="garage_item">
					<div class="garage-img" style="background-image: url('images/garage-item.jpg');"></div>
					<div class="garage-content">
						<div class="contentHead">
							<h3 class="Title">BMW X5 XCROSS 2.0</h3>
							<div class="removeGarage"><i class="fa fa-trash-o" aria-hidden="true"></i></div>
						</div>
						<div class="contentBody">
							<div class="row">
								<div class="col-12">
									<div class="row">
										<div class="col-4">
											<div class="garage-item-feature feature1">
												<div class="feature-title">Marka</div>
												<div class="feature-info">Mercedes</div>
											</div>
											<div class="garage-item-feature feature2">
												<div class="feature-title">Model</div>
												<div class="feature-info">CLA200</div>
											</div>
										</div>
										<div class="col-4">
											<div class="garage-item-feature feature3">
												<div class="feature-title">Yıl</div>
												<div class="feature-info">2018</div>
											</div>
											<div class="garage-item-feature feature4">
												<div class="feature-title">Yakıt</div>
												<div class="feature-info">Benzin</div>
											</div>
										</div>
										<div class="col-4">
											<div class="garage-item-feature feature3">
												<div class="feature-title">Motor</div>
												<div class="feature-info">2.0 Turbo</div>
											</div>
											<div class="garage-item-feature feature4">
												<div class="feature-title">Kasa</div>
												<div class="feature-info">Stationwagon</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-12">
									<div class="garage-action">
										<div class="Btn Btn1">Yedek Parçalar</div>
										<div class="Btn Btn2">Bakım Ürünleri</div>
										<div class="Btn Btn3">Aksesuarlar</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="garage_item">
					<div class="garage-img" style="background-image: url('images/garage-item.jpg');"></div>
					<div class="garage-content">
						<div class="contentHead">
							<h3 class="Title">BMW X5 XCROSS 2.0</h3>
							<div class="removeGarage"><i class="fa fa-trash-o" aria-hidden="true"></i></div>
						</div>
						<div class="contentBody">
							<div class="row">
								<div class="col-12">
									<div class="row">
										<div class="col-4">
											<div class="garage-item-feature feature1">
												<div class="feature-title">Marka</div>
												<div class="feature-info">Mercedes</div>
											</div>
											<div class="garage-item-feature feature2">
												<div class="feature-title">Model</div>
												<div class="feature-info">CLA200</div>
											</div>
										</div>
										<div class="col-4">
											<div class="garage-item-feature feature3">
												<div class="feature-title">Yıl</div>
												<div class="feature-info">2018</div>
											</div>
											<div class="garage-item-feature feature4">
												<div class="feature-title">Yakıt</div>
												<div class="feature-info">Benzin</div>
											</div>
										</div>
										<div class="col-4">
											<div class="garage-item-feature feature3">
												<div class="feature-title">Motor</div>
												<div class="feature-info">2.0 Turbo</div>
											</div>
											<div class="garage-item-feature feature4">
												<div class="feature-title">Kasa</div>
												<div class="feature-info">Stationwagon</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-12">
									<div class="garage-action">
										<div class="Btn Btn1">Yedek Parçalar</div>
										<div class="Btn Btn2">Bakım Ürünleri</div>
										<div class="Btn Btn3">Aksesuarlar</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="empty_page">
					<div class="Icon"><img src="images/Icons/garage_empty.png?v=1.1" alt=""></div>
					<div class="T">Garajınızda Araç Bulunamadı..</div>
					<div class="sT">Hemen sizde aracınız ekleyin, aracınıza göre parçaları listeleyin.</div>

					<a href="index.php" class="global-btn">Araç Ekle</a>
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
