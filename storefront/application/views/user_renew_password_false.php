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
						<div class="cardHead">Uyarı</div>
						<div class="cardContent">
							<div class="formElements">
								<label for="" style="text-align: center;">Şifre sıfırlama linkinizin süresi dolmuş ya da geçersiz bir bağlantıya tıkladınız. Lütfen yeniden şifrenizi alttaki buton aracılığı ile sıfırlayın.</label>
							</div>
							<button type="button" onclick="window.location.href='<?=site_url('sifremi-unuttum')?>';">Tekrar Sıfırla</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>