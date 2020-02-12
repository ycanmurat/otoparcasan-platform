<?php include 'pages/head.php';?>

	<script>
		/* Cart Format */
		$(window).load(function() {
		    $('.card__number').text("**** **** **** ****");
		    $('.card__name').text("AD SOYAD");
		    $('.card__date').text("AA / YY");
		    $('.card__cvv').text("***");
		});
		$(document).ready(function(){

		    $("#card_number").keyup(function () {
		        var card_number = $(this).val();
		        $(".card__number").text(card_number);
		    }).keyup();
		    $("#card_name").keyup(function () {
		        var card_name = $(this).val();
		        $(".card__name").text(card_name);
		    }).keyup();
		    $("#card_date").keyup(function () {
		        var card_date = $(this).val();
		        $(".card__date").text(card_date);
		    }).keyup();
		    $("#card_cvv").keyup(function () {
		        var card_cvv = $(this).val();
		        $(".card__cvv").text(card_cvv);
		    }).keyup();


		    $('#card_cvv').focus(function(){
		        $('.card').addClass('BackPreview');
		    });

		    $('#card_cvv').blur(function(){ 
		        $('.card').removeClass('BackPreview');
		    });


		    $("#card_number").inputmask({"mask": "9999 9999 9999 9999"});
		    $("#card_date").inputmask({"mask": "99 / 99"});
		    $("#card_cvv").inputmask({"mask": "999"});


		    $('#card_name').bind('keyup blur',function(){ 
		        var node = $(this);
		        node.val(node.val().replace(/[^a-z,A-Z ŞşİiÖöÇçĞğİıÜü]/g,'') ); }
		    );
		});
	</script>

	<!-- cart_header -->
	<section class="cart_header">
		<div class="container">
			<div class="row">
				<div class="col">
					<a href="index.php" class="cart_logo"><img src="images/logofinali.png" alt=""></a>
				</div>
				<div class="col-auto">
					<div class="security_text">Güvenli Ödeme</div>
				</div>
			</div>
		</div>
	</section>
	<!-- / cart_header -->

	<!-- pageContent -->
	<section class="pageContent Cart_Page">
			
		<div class="container">
			<div class="row">
				<div class="col-12 col-lg">
						<div class="Cart_Content">
							<div class="T">Ödeme Bilgileri</div>

							<div class="row">
								<div class="col-12 col-lg-6">
									<div class="row">
										<div class="col-12">
											<div class="FormElements">
												<label for="">Kart Numarası *</label>
												<input type="text" id="card_number" data-inputmask="'mask': '9999 9999 9999 9999'">
											</div>
										</div>
										<div class="col-12">
											<div class="FormElements">
												<label for="">Kart Üzerindek Ad Soyad *</label>
												<input type="text" id="card_name">
											</div>
										</div>
										<div class="col-6">
											<div class="FormElements">
												<label for="">Tarih *</label>
												<input type="text" id="card_date" placeholder="AA / YY">
											</div>
										</div>
										<div class="col-6">
											<div class="FormElements">
												<label for="">CVV *</label>
												<input type="text" id="card_cvv" placeholder="XXX">
											</div>
										</div>
									</div>
								</div>
								<div class="col-12 col-lg-6 d-none d-lg-block">
									<div class="card">
									    <div class="card__front card__part">
									        <img class="card__square" src="images/Icons/card_icon.png">
									        <p class="card__number">**** **** **** ****</p>
									        <div class="card__space-75">
									            <span class="card__label">Kart Sahibi</span>
									            <p class="card__info card__name">AD SOYAD</p>
									        </div>
									        <div class="card__space-25">
									            <span class="card__label">AA/YY</span>
									            <p class="card__info card__date">AA / YY</p>
									        </div>
									    </div>
									    <div class="card__back card__part">
									        <div class="card__black-line"></div>
									        <div class="card__back-content">
									            <div class="card__secret">
									                <p class="card__cvv">***</p>
									            </div>
									        </div>
									    </div>
									</div>
								</div>
							</div>
						</div>
						<div class="Cart_Content">
							<div class="T">Ödeme Bilgileri</div>

							<div class="row">
								<div class="col-12">
									<div class="OptionAlert">Taksit Seçenekleri görebilmek için kredi kartı bilgilerinizi girmelisiniz.</div>
									<table class="OptionList" cellspacing="0" cellpadding="0" style="">
									    <tbody>
									        <tr>
									            <th>Taksit Sayısı</th>
									            <th>Aylık Ödeme</th>
									            <th>Toplam</th>
									        </tr>
									        <tr>
									            <td>
									                <div class="OptionRadio">
									                    <input name="taksit_sayisi" id="Pesin" type="radio" checked="checked">
									                    <label for="Pesin" class="radio-label">Peşin</label>
									                </div>
									            </td>
									            <td>14.000 TL</td>
									            <td>14,000 TL</td>
									        </tr>
									        <tr>
									            <td>
									                <div class="OptionRadio">
									                    <input name="taksit_sayisi" id="taksit_3" type="radio">
									                    <label for="taksit_3" class="radio-label">3 Taksit</label>
									                </div>
									            </td>
									            <td>4666 TL</td>
									            <td>14,000 TL</td>
									        </tr>
									        <tr>
									            <td>
									                <div class="OptionRadio">
									                    <input name="taksit_sayisi" id="taksit_6" type="radio">
									                    <label for="taksit_6" class="radio-label">6 Taksit</label>
									                </div>
									            </td>
									            <td>2333 TL</td>
									            <td>14,000 TL</td>
									        </tr>
									        <tr>
									            <td>
									                <div class="OptionRadio">
									                    <input name="taksit_sayisi" id="taksit_9" type="radio">
									                    <label for="taksit_9" class="radio-label">9 Taksit</label>
									                </div>
									            </td>
									            <td>1555 TL</td>
									            <td>14,000 TL</td>
									        </tr>
									        <tr>
									            <td>
									                <div class="OptionRadio">
									                    <input name="taksit_sayisi" id="taksit_12" type="radio">
									                    <label for="taksit_12" class="radio-label">12 Taksit</label>
									                </div>
									            </td>
									            <td>1166 TL</td>
									            <td>39,90 TL</td>
									        </tr>
									    </tbody>
									</table>
								</div>
							</div>
						</div>

					<div class="remove-area"><a href="cart.php" class="all-remove-items"><i class="fa fa-undo" aria-hidden="true"></i> Sepete Dön</a></div>
				</div>
				<div class="col-12 col-lg-auto">
					<div class="cart-addition">
						<div class="T">Sipariş Özeti</div>

						<div class="addition-item">
							<div class="item">Ara Toplam</div>
							<div class="item">4,999 TL</div>
						</div>

						<div class="addition-item">
							<div class="item">KDV</div>
							<div class="item">200 TL</div>
						</div>

						<div class="addition-item">
							<div class="item">Kargo</div>
							<div class="item">Ücretsiz</div>
						</div>

						<div class="addition-item">
							<div class="item">Kampanya İndirimi</div>
							<div class="item Colored">-1000 TL</div>
						</div>

						<div class="addition-total addition-item">
							<div class="item">toplam</div>
							<div class="item totalPrice">3,999 TL</div>
						</div>
					</div>

					<div class="cart-contract">
						<input type="checkbox" class="contract_input" id="cart_contract">
    					<label class="contract_label" for="cart_contract">
							<a href="javascript:void(0);" data-toggle="modal" data-target="#contract-1">Ön Bilgilendirme Koşulları</a>'nı ve <a href="javascript:void(0);" data-toggle="modal" data-target="#contract-2">Mesafeli Satış Sözleşmesi</a>'ni Okudum. Onaylıyorum.
    					</label>
					</div>

					<div class="cart-contract contract-error">
						<input type="checkbox" class="contract_input" id="cart_contract">
    					<label class="contract_label" for="cart_contract">
							<a href="javascript:void(0);">Ön Bilgilendirme Koşulları</a>'nı ve <a href="javascript:void(0);">Mesafeli Satış Sözleşmesi</a>'ni Okudum. Onaylıyorum.
    					</label>
					</div>

					<a href="cart_success.php" class="global-btn d-block text-center mt-3">Siparişi Tamamla</a>
				</div>
			</div>
		</div>
	</section>
	<!-- / pageContent -->


<?php include 'pages/footer.php';?>