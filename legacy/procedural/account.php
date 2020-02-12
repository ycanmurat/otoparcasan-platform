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
						<a href="account.php" class="panel-link Active"><div class="Icon"><i class="fa fa-user" aria-hidden="true"></i></div>Hesabım</a>
						<a href="orders.php" class="panel-link"><div class="Icon"><i class="fa fa-cube" aria-hidden="true"></i></div>Siparişlerim<span class="Count">122</span></a>
						<a href="returns.php" class="panel-link"><div class="Icon"><i class="fa fa-reply" aria-hidden="true"></i></div>İadelerim<span class="Count">3</span></a>
						<a href="product_question.php" class="panel-link"><div class="Icon"><i class="fa fa-question-circle" aria-hidden="true"></i></div>Ürün Sorularım<span class="Count">3</span></a>
						<a href="address.php" class="panel-link"><div class="Icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>Adreslerim</a>
						<a href="favorites.php" class="panel-link "><div class="Icon"><i class="fa fa-heart" aria-hidden="true"></i></div>Favorilerim</a>
						<a href="garage.php" class="panel-link"><div class="Icon"><i class="fa fa-car" aria-hidden="true"></i></div>Garajım</a>
						<a href="#" class="panel-link"><div class="Icon"><i class="fa fa-sign-out" aria-hidden="true"></i></div>Çıkış Yap</a>
					</div>
				</div>
			</div>
			<div class="col-md">
				<div class="pageTitle">Hesap Bilgileri</div>
				<div class="accountArea">
					<form action="#">
						<div class="row">
							<div class="col-sm-6">
								<div class="formElements">
									<label for="#">Ad Soyad</label>
									<input type="text" value="Emre Sesli">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="formElements">
									<label for="#">Cep Telefonu</label>
									<input type="tel" value="0555 000 00 00">
								</div>
							</div>
							<div class="col-lg-4">
								<div class="formElements">
									<label for="#">E-Mail Adresi</label>
									<input type="tel" value="demo@example.com">
								</div>
							</div>
							<div class="col-lg-4 col-md-6">
								<div class="formElements">
									<label for="#">Ülke</label>
									<select name="" id="">
										<option value=""></option>
										<option value="1">Türkiye</option>
										<option value="2">Kavak</option>
									</select>
								</div>
							</div>
							<div class="col-lg-4 col-md-6">
								<div class="formElements">
									<label for="#">Meslek</label>
									<select name="" id="">
										<option value=""></option>
										<option value="1">Tornacı</option>
										<option value="2">Torbacı</option>
									</select>
								</div>
							</div>

							<div class="col-12">
								<div class="formElements mb-0 mt-3 text-right">
									<button type="submit">Güncelle</button>
								</div>
							</div>
						</div>
					</form>
				</div>


				<div class="pageTitle">Şifrenizi Güncelleyin</div>
				<div class="accountArea">
					<form action="#">
						<div class="row">
							<div class="col-lg-4 col-sm-6">
								<div class="formElements">
									<label for="#">Mevcut Şifre</label>
									<input type="password" value="">
								</div>
							</div>
							<div class="col-lg-4 col-sm-6">
								<div class="formElements">
									<label for="#">Yeni Şifre</label>
									<input type="password" value="">
								</div>
							</div>
							<div class="col-lg-4">
								<div class="formElements">
									<label for="#">Yeni Şifre Tekrar</label>
									<input type="password" value="">
								</div>
							</div>

							<div class="col-12">
								<div class="formElements text-right">
									<button type="submit">Güncelle</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- / pageContent -->



<?php include 'pages/footer.php';?>