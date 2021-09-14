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
						<div class="cardHead">Kayıt Ol</div>

						<div class="cardContent">
							<form action="#" method="post">
								<div class="row">
									<div class="col-sm-6">
										<div class="formElements">
											<label for="">Ad <span class="rules">*</span></label>
											<input class="large-text" type="text" id="register_name">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="formElements">
											<label for="">Soyad <span class="rules">*</span></label>
											<input class="large-text" type="text" id="register_last_name">
										</div>
									</div>
								</div>
								<div class="formElements">
									<label for="">E-Posta <span class="rules">*</span></label>
									<input type="email" id="register_email">
								</div>
								<div class="formElements">
									<label for="">Cep Telefonu</label>
									<input type="text" id="register_phone">
								</div>
								<div class="formElements">
									<label for="">Şifre <span class="rules">*</span></label>
									<div class="passShowHide">
										<input class="form-control" name="password" type="password" id="register_password">
										<div class="pass-show">
											<span toggle="#register_password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
										</div>
									</div>
								</div>
								<div class="formElements">
									<label for="">Şifre Tekrar <span class="rules">*</span></label>
									<div class="passShowHide">
										<input type="password" id="register_password_again">
									</div>
								</div>

								<div class="formControls">
									<div class="checkItem mb-3">
										<input class="styled-checkbox" id="membership_agreement" type="checkbox">
										<label for="membership_agreement"><a href="javascript:void(0);" data-toggle="modal" data-target="#contractModal">Üyelik Sözleşmesi</a>'ni okudum. Onaylıyorum.</label>
									</div>
									<div class="checkItem mb-4">
										<input class="styled-checkbox" id="campaign_notification" type="checkbox" checked="">
										<label for="campaign_notification">Kampanyalardan Sms ve E-Posta ile Haberdar Olmak İstiyorum.</label>
									</div>
								</div>
								<button class="text-center" type="button" id="register">Hesap Oluştur</button>
							</form>
							<div class="oR"><span>Hesabınız Var mı?</span></div>
							<div class="text-center">
                                <?php if ($this->input->get('redirect')) { ?>
                                    <a href="<?=site_url('giris-yap?redirect='.$this->input->get('redirect',true))?>" class="orLink global-green">Giriş Yap</a>
                                <?php }else{ ?>
                                    <a href="<?=site_url('giris-yap')?>" class="orLink global-green">Giriş Yap</a>
                                <?php } ?>
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