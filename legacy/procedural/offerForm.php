<?php include 'pages/head.php';?>
<?php include 'pages/header.php';?>


	<!-- pageContent -->
	<section class="pageContent">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="offerform">
						<div class="pageTitle">Teklif Formu</div>

						<div class="formArea">
							<form action="#">
								<div class="row">
									<div class="col-sm-4"><input type="text" placeholder="Ad Soyad" id="offer_name"></div>
									<div class="col-sm-4"><input type="email" placeholder="E-Posta" id="offer_email"></div>
									<div class="col-sm-4"><input type="tel" placeholder="Telefon" id="offer_phone"></div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<select name="offer_type" id="">
											<option value="">Teklif Tipi</option>
											<option value="1">Xxxxx</option>
											<option value="2">Xxxxx</option>
											<option value="3">Xxxxx</option>
										</select>
									</div>
									<div class="col-sm-6">
										<input type="text" placeholder="Teklif İstenen Ürün" id="offer_product">
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<input type="text" placeholder="Adet" id="offer_piece">
									</div>
									<div class="col-sm-6">
										<input type="text" placeholder="Bilgi" id="offer_info">
									</div>
									<div class="col-12">
										<textarea name="offer_note" id="offer_note" placeholder="Eklemek İstedikleriniz"></textarea>
									</div>
									<div class="col-12">
										<label class="file">
												<i class="fa fa-cloud-upload" aria-hidden="true"></i>
												<input type="file" multiple>
										</label>
									</div>
									<div class="col-12 text-center mt-4 mb-4">
										<div class="checkItem d-inline-block">
											<input class="styled-checkbox" id="styled-checkbox-1" type="checkbox" value="value1">
    										<label for="styled-checkbox-1">
    											<a href="javascript:void(0);" data-toggle="modal" data-target="#offer_contract">Teklif Sözleşmesi</a>'ni ve 
    											<a href="javascript:void(0);" data-toggle="modal" data-target="#secure_contract">Gizlilik Sözleşmesi</a>'ni Okudum. Onaylıyorum.
    										</label>
										</div>
									</div>
									<div class="col-12 text-center">
										<button type="button">Hemen Gönder</button>
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


	<!-- Modal -->
	<div class="modal fade" id="offer_contract" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Teklif Sözleşmesi</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        Teklif Sözleşmesi <br>
	        Teklif Sözleşmesi <br>
	        Teklif Sözleşmesi <br>
	        Teklif Sözleşmesi <br>
	        Teklif Sözleşmesi <br>
	        Teklif Sözleşmesi <br>
	        Teklif Sözleşmesi <br>
	        Teklif Sözleşmesi <br>
	        Teklif Sözleşmesi <br>
	        Teklif Sözleşmesi <br>
	        Teklif Sözleşmesi <br>
	        Teklif Sözleşmesi <br>
	        Teklif Sözleşmesi <br>
	        Teklif Sözleşmesi <br>
	        Teklif Sözleşmesi <br>
	        Teklif Sözleşmesi <br>
	        Teklif Sözleşmesi <br>
	        Teklif Sözleşmesi <br>
	      </div>
	    </div>
	  </div>
	</div>


	<!-- Modal -->
	<div class="modal fade" id="secure_contract" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Gizlilik Sözleşmesi</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        Gizlilik Sözleşmesi <br>
	        Gizlilik Sözleşmesi <br>
	        Gizlilik Sözleşmesi <br>
	        Gizlilik Sözleşmesi <br>
	        Gizlilik Sözleşmesi <br>
	        Gizlilik Sözleşmesi <br>
	        Gizlilik Sözleşmesi <br>
	        Gizlilik Sözleşmesi <br>
	        Gizlilik Sözleşmesi <br>
	        Gizlilik Sözleşmesi <br>
	        Gizlilik Sözleşmesi <br>
	        Gizlilik Sözleşmesi <br>
	        Gizlilik Sözleşmesi <br>
	        Gizlilik Sözleşmesi <br>
	        Gizlilik Sözleşmesi <br>
	        Gizlilik Sözleşmesi <br>
	        Gizlilik Sözleşmesi <br>
	        Gizlilik Sözleşmesi <br>
	      </div>
	    </div>
	  </div>
	</div>



<?php include 'pages/footer.php';?>