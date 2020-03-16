<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Paket Güncelle
			</h3>
			<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
				<li class="m-nav__item m-nav__item--home">
					<a href="<?=site_url()?>Admin/" class="m-nav__link m-nav__link--icon">
						<i class="m-nav__link-icon la la-home"></i>
					</a>
				</li>
				<li class="m-nav__separator">
					-
				</li>
			</ul>
		</div>
	</div>
</div>
<div class="m-content">
	<div class="row">
		<div class="col-lg-12">
			<div class="m-portlet">
				<form class="m-form m-form--fit m-form--label-align-right" method="POST" action="<?=site_url('Admin/Package/SetUpdate/'.$values[0]->package_id)?>">
					<div class="m-portlet__body">
						<div class="m-form__section m-form__section--first">
							<?php 
								if ($this->session->flashdata('okey') == 1) { ?>
									<div class="alert alert-success alert-dismissible fade show" style="margin-left: 20px;margin-right: 20px" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
										<strong>
											Tebrikler!
										</strong>
										Paket Başarıyla Güncellendi.
									</div>
							<?php } ?>
							<?php 
								if ($this->session->flashdata('hata') == 1) { ?>
									<div class="alert alert-danger alert-dismissible fade show" style="margin-left: 20px;margin-right: 20px" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
										<strong>
											Üzügmüm!
										</strong>
										Paket Güncelleme Sırasında Bir Hata Oluştu.
									</div>
							<?php } ?>
							<div class="form-group m-form__group">
								<label for="category_heading">
									Paket Title
								</label>
								<input type="text" class="form-control m-input" value="<?=$values[0]->title?>" name="title" placeholder="Paket Title">
							</div>
							<?php foreach ($values as $key => $val) { ?>
								<div class="form-group m-form__group">
									<label for="exampleSelect1">
										Paket Adı - <?=$val->short_code?>
									</label>
									<input type="text" class="form-control m-input" value="<?=$val->name?>" name="name[<?=$val->lang_id?>]" placeholder="Paket Adı">
								</div>
							<hr>
								<div class="form-group m-form__group">
									<label for="exampleSelect1">
										Ana Kare Resim
									</label>
									<?php if ($val->square_image != ""): ?>
										<div class="text-center"><img src="<?=site_url($val->square_image)?>" style="max-width: 100%;max-height: 200px;margin-bottom: 20px;"></div>
									<?php endif ?>
									<div class="m-dropzone dropzone m-dropzone--primary dz-clickable" style="margin-left:50px;margin-right: 50px" action="<?=site_url('Admin/Package/UploadPackageImages/'.$val->lang_id.'/2')?>" id="m-dropzone-two">
										<div class="m-dropzone__msg dz-message needsclick">
											<h3 class="m-dropzone__msg-title">
												Yüklenecek Dosyaları Buraya Taşıyabilirsiniz.
											</h3>
											<span class="m-dropzone__msg-desc">
												En fazla 1 ürün Yüklenebilir.
											</span>
										</div>
									</div>
								</div>
							<hr>
							<?php } ?>
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