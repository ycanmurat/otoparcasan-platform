	<div class="MembershipHeader">
		<a href="<?=site_url()?>" class="Logo d-inline-block"><img src="<?=site_url('assets/Front/images/logofinali.webp')?>" alt=""></a>
	</div>

	<div class="MembershipContent">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="memberCard">
						<div class="cardHead">Şifremi Unuttum</div>

						<div class="cardContent">
							<form action="#" method="post">
								<div class="formElements">
									<label for="">E-Posta</label>
									<input type="email" id="forgot_email" name="forgot_email">
								</div>
								
								<button type="button" id="renew_password">Şifremi Sıfırla</button>
							</form>
							<div class="oR"><span>Henüz üye değil misiniz ?</span></div>

							<div class="text-center">
								<a href="<?=site_url('User/register')?>" class="orLink">Hemen Kayıt Ol</a>
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