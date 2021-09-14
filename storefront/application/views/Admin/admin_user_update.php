<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				"<?=$UserInfo->user_name?>" Yöneticisinin Bilgilerini Düzenliyorsunuz
			</h3>
			<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="<?=admin_url()?>" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-home"></i>
                    </a>
                </li>
                <li class="m-nav__separator">
                    >
                </li>
                <li class="m-nav__item">
                    <a href="<?=admin_url('AdminUserEdit')?>" class="m-nav__link">
                        <span class="m-nav__link-text">
                        Yöneticiler
                        </span>
                    </a>
                </li>
                <li class="m-nav__separator">
                    >
                </li>
                <li class="m-nav__item">
                    <a href="<?=$this->agent->referrer()?>" class="m-nav__link">
                        <span class="m-nav__link-text">
                        Geri Dön
                        </span>
                    </a>
                </li>
            </ul>
		</div>
	</div>
</div>
<div class="m-content">
	<div class="row">
		<div class="col-lg-12">
			<div class="m-portlet">
				<div class="m-portlet__head">
					<div class="m-portlet__head-caption">
						<div class="m-portlet__head-title">
							<h3 class="m-portlet__head-text">
								Eksiksiz Değerlerle Kullanıcı Bilgilerini Güncelleyebilirsiniz 
							</h3>
						</div>
					</div>
				</div>
				<form class="m-form m-form--fit m-form--label-align-right" action="<?=admin_url('AdminUserEdit/UpdateUser/'.$UserInfo->Id)?>" method="POST">
					<div class="m-portlet__body">
						<div class="m-form__section m-form__section--first">
							<?if(!empty($this->session->flashdata('baslik'))){?>	
							<div class="row p-0">
								<div class="col-lg-12">
									<div class="m-portlet">
										<div class="m-section">
											<div class="m-section__content">
												<div class="alert alert-<?=$this->session->flashdata('kutu')?> alert-dismissible fade show m-0" style="margin-left: 20px !important;margin-right: 20px !important;" role="alert">
													<button type="button" class="close" data-dismiss="alert" aria-label="Kapat"></button>
													<?=$this->session->flashdata('baslik')?> : <?=$this->session->flashdata('icerik')?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?}?>
							<div class="form-group m-form__group">
								<label>
									Kullanıcı Adı
								</label>
								<input type="text" class="form-control m-input" name="user_name" placeholder="<?=$UserInfo->user_name?>" value="<?=$UserInfo->user_name?>">
							</div>
							<div class="form-group m-form__group">
								<label>
									E-Posta
								</label>
								<input type="email" class="form-control m-input" name="user_mail" placeholder="<?=$UserInfo->user_mail?>" value="<?=$UserInfo->user_mail?>">
							</div>
							<div class="form-group m-form__group">
								<label>
									Eski Şifre
								</label>
								<input type="password" class="form-control m-input" name="old_password" placeholder="Eski Şifre">
							</div>
							<div class="form-group m-form__group">
								<label>
									Yeni Şifre
								</label>
								<input type="password" class="form-control m-input" name="password" placeholder="Yeni Şifre">
							</div>
							<div class="form-group m-form__group">
								<label>
									Telefon Numarası
								</label>
								<input type="number" class="form-control m-input" name="user_gsm" placeholder="<?=$UserInfo->user_gsm?>" value="<?=$UserInfo->user_gsm?>">
							</div>												
						</div>
					</div>
					<div class="m-portlet__foot m-portlet__foot--fit">
						<div class="m-form__actions m-form__actions">
							<div class="row">
								<div class="col-lg-6"></div>
								<div class="col-lg-6 text-right">
									<button type="submit" class="btn btn-primary">
										Kaydet
									</button>
									<button type="button" class="btn btn-secondary" onclick="window.location = '<?=admin_url('AdminUserEdit')?>'">
										İptal
									</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>