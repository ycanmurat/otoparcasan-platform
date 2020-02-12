<?php include 'pages/head.php';?>
<?php include 'pages/header.php';?>


	<!-- pageContent -->
	<section class="pageContent">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="offerform">
						<div class="pageTitle">Bayilik Başvurusu</div>

						<div class="formArea">
							<form action="#">
								<div class="row">
									<div class="col-sm-6"><input type="text" placeholder="Ad Soyad" id="dearlership_name"></div>
									<div class="col-sm-6"><input type="text" placeholder="Firma Ünvanı" id="dearlership_Cname"></div>
									<div class="col-sm-6"><input type="email" placeholder="E-Posta" id="dearlership_email"></div>
									<div class="col-sm-6"><input type="tel" placeholder="Telefon" id="dearlership_phone"></div>
									<div class="col-sm-4">
										<select name="dearlership_il" id="">
											<option value="">İl</option>
											<option value="1">Samsun</option>
											<option value="1">Samsun</option>
											<option value="1">Samsun</option>
											<option value="1">Samsun</option>
										</select>
									</div>
									<div class="col-sm-4">
										<select name="dearlership_ilce" id="">
											<option value="">İlçe</option>
											<option value="1">Samsun</option>
											<option value="1">Samsun</option>
											<option value="1">Samsun</option>
											<option value="1">Samsun</option>
										</select>
									</div>
									<div class="col-sm-4"><input type="text" placeholder="Posta Kodu" id="dearlership_code"></div>
									<div class="col-12">
										<textarea name="dearlership_note" id="dearlership_note" placeholder="Eklemek İstedikleriniz"></textarea>
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
	</section>
	<!-- / pageContent -->



<?php include 'pages/footer.php';?>