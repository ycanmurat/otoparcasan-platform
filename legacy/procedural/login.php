<?php include 'pages/head.php';?>

	<div class="MembershipHeader">
		<a href="index.php" class="Logo d-inline-block"><img src="images/logofinali.png" alt=""></a>
	</div>

	<div class="MembershipContent">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="memberCard">
						<div class="cardHead">Giriş Yap</div>

						<div class="cardContent">
							<form action="#">
								<div class="formElements">
									<label for="">E-Posta</label>
									<input type="email" id="login_email">
								</div>
								<div class="formElements">
									<label for="">Şifre</label>
									<div class="passShowHide">
										<input type="password" id="login_email">
									</div>
								</div>

								<div class="formControls">
									<div class="row">
										<div class="col">
											<div class="checkItem">
												<input class="styled-checkbox" id="styled-checkbox-1" type="checkbox" value="value1">
	    										<label for="styled-checkbox-1">Beni Hatırla</label>
											</div>
										</div>
										<div class="col text-right">
											<a href="forgot.php" class="forgotLink">Şifremi Unuttum</a>
										</div>
									</div>
								</div>

								<button type="button">Giriş Yap</button>
							</form>
							<button id="f-login" type="button"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook ile Giriş Yap</button>
							<button id="g-login" type="button"><i class="fa fa-google" aria-hidden="true"></i> Google ile Giriş Yap</button>
							<div class="oR"><span>Henüz üye değil misiniz ?</span></div>

							<div class="text-center">
								<a href="register.php" class="orLink">Hemen Kayıt Ol</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="MembershipFooter">
		<div class="footerNav">
			<a href="about.php" class="Link">Hakkımızda</a>
			<a href="editorPage.php" class="Link">İade</a>
			<a href="faq.php" class="Link">Yardım</a>
		</div>
		<p>2018 hizliparcabul.com Tüm Hakları Saklıdır.</p>
	</div>
</body>
</html>