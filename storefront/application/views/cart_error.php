<?php include 'pages/head.php';?>

	<!-- cart_header -->
	<section class="cart_header">
		<div class="container">
			<div class="row">
				<div class="col">
					<a href="index.php" class="cart_logo"><img src="images/logo.png" alt=""></a>
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
				<div class="col-12">
					<div class="cart_result result_error">
						<div class="result_head">
							<div class="Icon"><img src="images/Icons/check-no.png" alt=""></div>
							<div class="head_t">BİR SORUN OLUŞTU</div>

							<p class="error_code">Hata Kodu : 955B23AA2</p>

							<p>Ödeme sırasında bir sorun oluştu. Biraz sonra tekrar deneyin veya bankanız ile iletişime geçin.</p>
						</div>
					</div>

					<div class="mt-4 text-center"><a href="cart_pay.php" class="global-btn">Tekrar Dene</a></div>
				</div>
			</div>
		</div>

	</section>
	<!-- / pageContent -->


<?php include 'pages/footer.php';?>