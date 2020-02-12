<?php include 'pages/head.php';?>
<?php include 'pages/header.php';?>


	<!-- pageContent -->
	<section class="pageContent">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="offerform">
						<div class="pageTitle">Öneri & Şikayet</div>

						<div class="formArea">
							<form action="#">
								<div class="row">
									<div class="col-sm-6"><input type="text" placeholder="Ad Soyad" id="offer2_name"></div>
									<div class="col-sm-6"><input type="email" placeholder="E-Posta" id="offer2_email"></div>
									<div class="col-sm-6"><input type="tel" placeholder="Telefon" id="offer2_phone"></div>
									<div class="col-sm-6">
										<select name="offer2_type" id="">
											<option value="">Konu</option>
											<option value="1">Öneri</option>
											<option value="2">Şikayet</option>
											<option value="3">İstek</option>
										</select>
									</div>
									<div class="col-12">
										<textarea name="offer2_note" id="offer2_note" placeholder="Açklama"></textarea>
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