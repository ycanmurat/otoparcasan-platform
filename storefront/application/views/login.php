	<div class="MembershipHeader">
		<a href="<?=site_url()?>" class="Logo d-inline-block"><img src="<?=site_url('assets/Front/images/logofinali.webp')?>" alt=""></a>
	</div>
	<div class="MembershipContent">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="memberCard">
						<div class="cardHead">Üye Girişi</div>

						<div class="cardContent">
							<form action="#" method="post">
								<div class="formElements">
									<label for="">E-Posta</label>
									<input type="email" id="login_email" value="<?=(isset($cache_password_refresh_email)&&!empty($cache_password_refresh_email))?$cache_password_refresh_email:''?>">
								</div>
								<div class="formElements">
									<label for="">Şifre</label>
									<div class="passShowHide">
										<input type="password" id="login_password">
									</div>
								</div>

								<div class="formControls">
									<div class="row">
										<div class="col">
											<div class="checkItem">
												<input class="styled-checkbox" id="remember_me" type="checkbox">
												<label for="remember_me">Beni Hatırla</label>
											</div>
										</div>
										<div class="col text-right">
											<a href="<?=site_url('User/forgot_password')?>" class="forgotLink">Şifremi Unuttum</a>
										</div>
									</div>
								</div>

								<button type="button" id="login"><span>Giriş Yap</span></button>
							</form>
							<button id="f-login" type="button" onclick="window.location.href='<?=site_url('Facebook_login')?>';"><i class="fa fa-facebook-official" aria-hidden="true"></i><span> Facebook ile Giriş Yap</span></button>
							<button id="g-login" type="button" onclick="window.location.href='<?=site_url('Social/login/google')?>';"><i class="fa fa-google" aria-hidden="true"></i> <span>Google ile Giriş Yap</span></button>
							<?if(!empty($this->session->flashdata('social_error'))){?>
							<div class="alert alert-warning" role="alert" style="margin-top:20px;">
								<?=$this->session->flashdata('social_error')?>
							</div>
							<?}?>
							<div class="d-block d-md-none">
								<div class="oR"><span>Henüz üye değil misiniz ?</span></div>
								<div class="text-center">
									<a href="<?=site_url('User/register')?>" class="orLink">Hemen Kayıt Ol</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 d-none d-md-block">
					<div class="memberCard">
						<div class="cardHead">Üye Değil misiniz ?</div>
						<div class="cardContent">
							<div class="oR"><span>Hemen üye olun, indirimli alışverişin keyfini çıkarın</span></div>
						</div>
						<div class="cardContent">
							
							<div class="row">
								<div class="col-md-12">
									<div class="f-kb">
										<img src="<?=site_url('assets/Front/images/Icons/fbg2.webp')?>"><p>Garanti Belgeli Orjinal Ürünler</p>
									</div>
								</div>
								<div class="col-md-12">
									<div class="f-kb">
										<img src="<?=site_url('assets/Front/images/Icons/fbg1.webp')?>"><p>14 Gün İçinde Koşulsuz İade</p>
									</div>
								</div>
								<div class="col-md-12">
									<div class="f-kb">
										<img src="<?=site_url('assets/Front/images/Icons/fbg3.webp')?>"><p>İnternette Güvenli Alışveriş</p>
									</div>
								</div>
								<div class="col-md-12">
									<div class="f-kb">
										<img src="<?=site_url('assets/Front/images/Icons/fbg4.webp')?>"><p>Ödeme Koruma Sistemi</p>
									</div>
								</div>
							</div>
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
		<p>2018 otoparcasan.com Tüm Hakları Saklıdır.</p>
	</div>
</body>
</html>
