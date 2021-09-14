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
								<a href="<?=site_url('kayit-ol')?>" class="orLink">Hemen Kayıt Ol</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>