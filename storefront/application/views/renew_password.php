	<div class="MembershipHeader">
		<a href="index.php" class="Logo d-inline-block"><img src="<?=site_url('assets/Front/images/logofinali.webp')?>" alt=""></a>
	</div>

	<div class="MembershipContent">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="memberCard">
						<div class="cardHead">Şifrenizi Yenileyin</div>
						<div class="cardContent">
							<form action="#" method="post">
								<div class="formElements">
									<label for="">E-Posta</label>
									<input type="email" value="<?=$passwordInformation->email?>" disabled="true" name="refresh_email" id="refresh_email">
								</div>
								<div class="formElements">
									<label for="">Yeni Şifre</label>
									<input type="password" name="refresh_password" id="refresh_password" value="">
								</div>
								<div class="formElements">
									<label for="">Yeni Şifre Tekrar</label>
									<input type="password" name="refresh_password_repeat" id="refresh_password_repeat" value="">
								</div>
								<input type="hidden" name="refresh_key" id="refresh_key" value="<?=$passwordInformation->remember_key?>">
								<button type="button" id="password_save">Şifremi Yenile</button>
							</form>
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