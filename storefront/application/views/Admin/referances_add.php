<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Referans Ekle
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
					<a href="<?=admin_url('referances')?>" class="m-nav__link">
						<span class="m-nav__link-text">
							Referanslar
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
				<form class="m-form m-form--fit m-form--label-align-right" method="POST" action="<?=site_url('Admin/Referances/Add')?>">
					<div class="m-portlet__body">
						<div class="m-form__section m-form__section--first">
							<?if ($this->session->flashdata('true') == 1){?>
								<div class="alert alert-success alert-dismissible fade show" style="margin-left: 20px;margin-right: 20px" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
									<strong>
									Tebrikler!
									</strong>
									Referans Başarıyla Eklendi.
								</div>
							<?}?>
							<div class="form-group m-form__group">
								<label>
									Sıra
								</label>
								<input type="number" class="form-control m-input" name="in_order" placeholder="Sıra" required="true">
							</div>
							<div class="form-group m-form__group">
								<label for="category_heading">
									Referans Başlığı
								</label>
								<input type="text" class="form-control m-input" name="referances_title" placeholder="Referans Başlığı" required>
							</div>
							<div class="form-group m-form__group">
								<label for="exampleSelect1">
									Referans Fotoğrafları
								</label>
								<div class="m-dropzone dropzone m-dropzone--primary dz-clickable" style="margin-left:50px;margin-right: 50px" action="<?=site_url('Admin/Referances/ImageUpload/')?>" id="m-dropzone-two">
									<div class="m-dropzone__msg dz-message needsclick">
										<h3 class="m-dropzone__msg-title">
											Yüklenecek Referansı Buraya Taşıyabilirsiniz.
										</h3>
										<span class="m-dropzone__msg-desc">
											Sadece 1 Referans
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="m-portlet__foot m-portlet__foot--fit">
						<div class="m-form__actions m-form__actions">
							<div class="row">
								<div class="col-lg-2"></div>
								<div class="col-lg-10">
									<button type="submit" class="btn btn-primary pull-right">
										Yükle
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