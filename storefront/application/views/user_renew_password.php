    <div class="MembershipHeader">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="membership-logo" style="cursor:pointer;" onclick="window.location.href = '<?=site_url()?>'">
                        <picture>
                            <img src="<?=site_url('assets/Front/images/logofinali.png')?>" alt="logo">
                        </picture>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="membership-sec">
                        <div class="security_text">Güvenli Ödeme</div>
                    </div>      
                </div>
            </div>
        </div>
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