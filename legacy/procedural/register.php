<?php include 'pages/head.php';?>

	<div class="MembershipHeader">
		<a href="index.php" class="Logo d-inline-block"><img src="images/logo.png" alt=""></a>
	</div>

	<div class="MembershipContent">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="memberCard">
						<div class="cardHead">Kayıt Ol</div>

						<div class="cardContent">
							<form action="#">
								<div class="row">
									<div class="col-sm-6">
										<div class="formElements">
											<label for="">Ad</label>
											<input type="text" id="register-name">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="formElements">
											<label for="">Soyad</label>
											<input type="text" id="register-Lname">
										</div>
									</div>
								</div>
								<div class="formElements">
									<label for="">E-Posta</label>
									<input type="email" id="register_email">
								</div>
								<div class="formElements">
									<label for="">GSM</label>
									<input type="text" id="register_phone">
								</div>
								<div class="formElements">
									<label for="">Şifre</label>
									<div class="passShowHide">
										<input type="password" id="register_pass">
									</div>
								</div>
								<div class="formElements">
									<label for="">Şifre Telrar</label>
									<div class="passShowHide">
										<input type="password" id="register_pass2">
									</div>
								</div>

								<div class="formControls">
									<div class="checkItem mb-3">
										<input class="styled-checkbox" id="contract-1" type="checkbox">
										<label for="contract-1"><a href="javascript:void(0);" data-toggle="modal" data-target="#contractModal">Üyelik Sözleşmesi</a>'ni okudum. Onaylıyorum.</label>
									</div>
									<div class="checkItem mb-4">
										<input class="styled-checkbox" id="contract-1" type="checkbox" checked="">
										<label for="contract-1">Kampanyalardan Haberdar Olmak İstiyorum.</label>
									</div>
								</div>

								<button type="button">Hesap Oluştur</button>
							</form>
							<div class="oR"><span>Hesabınız Var mı?</span></div>

							<div class="text-center">
								<a href="login.php" class="orLink">Giriş Yap</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="contractModal" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Üyelik Sözleşmesi</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        Üyelik Sözleşmesi <br>
	        Üyelik Sözleşmesi <br>
	        Üyelik Sözleşmesi <br>
	        Üyelik Sözleşmesi <br>
	        Üyelik Sözleşmesi <br>
	        Üyelik Sözleşmesi <br>
	        Üyelik Sözleşmesi <br>
	        Üyelik Sözleşmesi <br>
	        Üyelik Sözleşmesi <br>
	        Üyelik Sözleşmesi <br>
	        Üyelik Sözleşmesi <br>
	        Üyelik Sözleşmesi <br>
	        Üyelik Sözleşmesi <br>
	        Üyelik Sözleşmesi <br>
	        Üyelik Sözleşmesi <br>
	        Üyelik Sözleşmesi <br>
	        Üyelik Sözleşmesi <br>
	        Üyelik Sözleşmesi <br>
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