<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Dil Ekle
			</h3>
			<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
				<li class="m-nav__item m-nav__item--home">
					<a href=<?=site_url()?>/Admin/" class="m-nav__link m-nav__link--icon">
						<i class="m-nav__link-icon la la-home"></i>
					</a>
				</li>
				<li class="m-nav__separator">
					-
				</li>
				<li class="m-nav__item">
					<a href="<?=admin_url('Language')?>" class="m-nav__link">
						<span class="m-nav__link-text">
							Diller
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
				<form class="m-form m-form--fit m-form--label-align-right" method="POST" action="<?=site_url('Admin/Language/SetAdd')?>">
					<div class="m-portlet__body">
						<div class="m-form__section m-form__section--first">

							<?php 
								if ($this->session->flashdata('okey') == 1) { ?>
									<div class="alert alert-success alert-dismissible fade show" style="margin-left: 20px;margin-right: 20px" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
										<strong>
											Tebrikler!
										</strong>
										Dil Kaydı Başarıyla Tamamlandı.
									</div>
							<?php } ?>
							<?php 
								if ($this->session->flashdata('hata') == 1) { ?>
									<div class="alert alert-danger alert-dismissible fade show" style="margin-left: 20px;margin-right: 20px" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
										<strong>
											Üzügmüm!
										</strong>
										Dil Açılırken Bir Hata Oluştu.
									</div>
							<?php } ?>

							<div class="form-group m-form__group">
								<label for="category_heading">
									Kısa Kod
								</label>
								<input type="text" class="form-control m-input" name="kisa_kod" placeholder="Kısa Kod" required="">
							</div>
							<div class="form-group m-form__group">
								<label for="category_heading">
									Dil Adı
								</label>
								<input type="text" class="form-control m-input" name="lang_name" placeholder="Dil Adı" required="">
							</div>
							<div class="form-group m-form__group">
								<label for="category_heading">
									Bayrak Class
								</label>
								<input type="text" class="form-control m-input" name="lang_class" placeholder="Class Adı" required="">
							</div>
						</div>
					</div>
					<div class="m-portlet__foot m-portlet__foot--fit">
						<div class="m-form__actions m-form__actions">
							<div class="row">
								<div class="col-lg-2"></div>
								<div class="col-lg-10">
									<button type="submit" class="btn btn-primary pull-right">
										Gönder
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