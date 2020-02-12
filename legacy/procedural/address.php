<?php include 'pages/head.php';?>
<?php include 'pages/header.php';?>


<!-- pageContent -->
<section class="pageContent AddressPage">
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
						<a href="address.php" class="panel-link Active"><div class="Icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>Adreslerim</a>
						<a href="favorites.php" class="panel-link "><div class="Icon"><i class="fa fa-heart" aria-hidden="true"></i></div>Favorilerim</a>
						<a href="garage.php" class="panel-link"><div class="Icon"><i class="fa fa-car" aria-hidden="true"></i></div>Garajım</a>
						<a href="#" class="panel-link"><div class="Icon"><i class="fa fa-sign-out" aria-hidden="true"></i></div>Çıkış Yap</a>
					</div>
				</div>
			</div>
			<div class="col-md">
				<div class="pageTitle">Adres Bilgileri</div>
				
				<div class="addNewAddress" data-toggle="modal" data-target="#addAddressModal">
					<div class="addBtn">Yeni Adres Ekle</div>
				</div>

				<div class="accountArea">
					<div class="row">
						<div class="col-12">
							<div class="address-title">Ev Adresim</div>
						</div>
						<div class="col-12">
							<div class="row">
								<div class="col-lg-3">
									<p class="address-info">Serdar AŞAN</p>
									<p class="address-info">55200</p>
									<p class="address-info">Samsun, ATAKUM</p>
								</div>
								<div class="col-lg-9">
									<p class="address-info">Soğuksu Mh. Soguksu Cd. Gazeteci halit ayaroğlu sok. No:3 Kapı:10</p>
									<p class="address-info">0(541) 324 75 55  -  0(599) 654 87 99</p>
									<p class="address-info"><strong>Fatura Türü :</strong> Bireysel</p>
								</div>
							</div>
						</div>
						<div class="col-12">
							<div class="address-control">
								<div class="item Available">Geçerli Adres</div>
								<div class="item Edit" data-toggle="modal" data-target="#editAddressModal">Düzenle</div>
								<div class="item Remove">Sil</div>
							</div>
						</div>
					</div>
				</div>

				<div class="accountArea">
					<div class="row">
						<div class="col-12">
							<div class="address-title">Ev Adresim</div>
						</div>
						<div class="col-12">
							<div class="row">
								<div class="col-lg-3">
									<p class="address-info">Serdar AŞAN</p>
									<p class="address-info">55200</p>
									<p class="address-info">Samsun, ATAKUM</p>
								</div>
								<div class="col-lg-9">
									<p class="address-info">Soğuksu Mh. Soguksu Cd. Gazeteci halit ayaroğlu sok. No:3 Kapı:10</p>
									<p class="address-info">0(541) 324 75 55  -  0(599) 654 87 99</p>
									<p class="address-info"><strong>Fatura Türü :</strong> Bireysel</p>
								</div>
							</div>
						</div>
						<div class="col-12">
							<div class="address-control">
								<div class="item Change">Birincil Yap</div>
								<div class="item Edit" data-toggle="modal" data-target="#editAddressModal">Düzenle</div>
								<div class="item Remove">Sil</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</section>
<!-- / pageContent -->


<!-- Modal -->
<div class="modal fade" id="addAddressModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form action="#">
				<div class="modal-header">
					<h5 class="modal-title">Adres Bilgileri</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="formArea">
						<div class="row m-0">
							<div class="col-12"><input type="text" placeholder="Başlık" id="add_title"></div>
							<div class="col-12"><input type="text" placeholder="Ad Soyad" id="add_name"></div>
							<div class="col-sm-6"><input type="tel" placeholder="Cep Telefonu" id="add_gsm"></div>
							<div class="col-sm-6"><input type="tel" placeholder="Posta Kodu" id="add_code"></div>
							<div class="col-sm-6">
								<select name="add_ulke" id="add_ulke">
									<option value="">Ülke</option>
									<option value="1">Xxxxx</option>
									<option value="2">Xxxxx</option>
									<option value="3">Xxxxx</option>
								</select>
							</div>
							<div class="col-sm-6">
								<select name="add_il" id="add_il">
									<option value="">İl</option>
									<option value="1">Xxxxx</option>
									<option value="2">Xxxxx</option>
									<option value="3">Xxxxx</option>
								</select>
							</div>
							<div class="col-sm-6">
								<select name="add_ilce" id="add_ilce">
									<option value="">İlçe</option>
									<option value="1">Xxxxx</option>
									<option value="2">Xxxxx</option>
									<option value="3">Xxxxx</option>
								</select>
							</div>
							<div class="col-sm-6"><input type="text" placeholder="Tc Kimlik No (isteğe bağlı)" id="add_tc"></div>
							<div class="col-12">
								<textarea name="add_address" id="add_address" placeholder="Adres Bilgileri"></textarea>
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


<!-- Modal -->
<div class="modal fade" id="editAddressModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form action="#">
				<div class="modal-header">
					<h5 class="modal-title">Adres Güncelle</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="formArea">
						<div class="row m-0">
							<div class="col-12"><input type="text" value="Ev Adresim" id="add_title"></div>
							<div class="col-12"><input type="text" value="Serdar AŞAN" id="add_name"></div>
							<div class="col-sm-6"><input type="tel" value="0555 000 00 00" id="add_gsm"></div>
							<div class="col-sm-6"><input type="tel" value="55200" id="add_code"></div>
							<div class="col-sm-6">
								<select name="add_ulke" id="add_ulke">
									<option value="">Ülke</option>
									<option value="1">Xxxxx</option>
									<option value="2">Xxxxx</option>
									<option value="3">Xxxxx</option>
								</select>
							</div>
							<div class="col-sm-6">
								<select name="add_il" id="add_il">
									<option value="">İl</option>
									<option value="1">Xxxxx</option>
									<option value="2">Xxxxx</option>
									<option value="3">Xxxxx</option>
								</select>
							</div>
							<div class="col-sm-6">
								<select name="add_ilce" id="add_ilce">
									<option value="">İlçe</option>
									<option value="1">Xxxxx</option>
									<option value="2">Xxxxx</option>
									<option value="3">Xxxxx</option>
								</select>
							</div>
							<div class="col-sm-6"><input type="text" value="Tc Kimlik No (isteğe bağlı)" id="add_tc"></div>
							<div class="col-12">
								<textarea name="add_address" id="add_address">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam ea, harum quod repudiandae mollitia, quas dolor autem voluptatum.</textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
					<button type="button" class="btn btn-primary">Güncelle</button>
				</div>
			</form>
		</div>
	</div>
</div>



<?php include 'pages/footer.php';?>