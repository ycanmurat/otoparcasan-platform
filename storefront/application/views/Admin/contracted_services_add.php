<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Anlaşmalı Servis Ekle
			</h3>
			<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
				<li class="m-nav__item m-nav__item--home">
					<a href="<?=admin_url()?>" class="m-nav__link m-nav__link--icon">
						<i class="m-nav__link-icon la la-home"></i>
					</a>
				</li>
				<li class="m-nav__separator">
					-
				</li>
				<li class="m-nav__item">
					<a href="<?=admin_url('Contracted_services')?>" class="m-nav__link">
						<span class="m-nav__link-text">
							Kampanyalar
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
				<form class="m-form m-form--fit m-form--label-align-right" method="POST" action="<?=admin_url('Contracted_services')?>">
					<div class="m-portlet__body">
						<div class="m-form__section m-form__section--first">
							<?if ($this->session->flashdata('onay') == 1){?>
								<div class="alert alert-success alert-dismissible fade show" style="margin-left: 20px;margin-right: 20px" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
									<strong>
									Tebrikler!
									</strong>
									Anlaşmalı Servis Eklendi !
								</div>
							<?}elseif($this->session->flashdata('red') == 1){?>
								<div class="alert alert-danger alert-dismissible fade show" style="margin-left: 20px;margin-right: 20px" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
									<strong>
									Hata!
									</strong>
									Anlaşmalı Servis Eklenemiyor !
								</div>
							<?}?>
							<div class="form-group m-form__group">
								<label>
									Servis Adı
								</label>
								<input type="text" class="form-control m-input" name="name" maxlength="254" placeholder="Servis Adı" required="true">
							</div>
							<div class="form-group m-form__group">
								<label for="category_heading">
									Adres
								</label>
								<input type="text" class="form-control m-input" name="address" maxlength="254" placeholder="Adres" required>
							</div>
							<div class="form-group m-form__group">
								<label for="category_heading">
									Servis Tipi
								</label>
								<input type="text" class="form-control m-input" name="type" maxlength="254" placeholder="Servis Tipi" required>
							</div>
							<div class="form-group m-form__group">
								<label for="category_heading">
									Telefon
								</label>
								<input type="text" class="form-control m-input" name="phone" maxlength="254" placeholder="Telefon" required>
							</div>
							<div class="form-group m-form__group">
								<label for="category_heading">
									E-Posta
								</label>
								<input type="text" class="form-control m-input" name="email" maxlength="254" placeholder="E-Posta">
							</div>
							<div class="form-group m-form__group">
								<label for="category_heading">
									İl
								</label>
								<input type="text" class="form-control m-input" name="city" maxlength="254" placeholder="İl" required>
							</div>
							<div class="form-group m-form__group">
								<label for="category_heading">
									İlçe
								</label>
								<input type="text" class="form-control m-input" name="counties" maxlength="254" placeholder="İlçe" required>
							</div>
						</div>
					</div>
					<div class="m-portlet__foot m-portlet__foot--fit">
						<div class="m-form__actions m-form__actions">
							<div class="row">
								<div class="col-lg-2"></div>
								<div class="col-lg-10">
									<button type="submit" class="btn btn-primary pull-right">
										Ekle
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