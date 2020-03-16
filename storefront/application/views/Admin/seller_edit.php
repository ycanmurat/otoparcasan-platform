<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Düzenle
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
					<a href="<?=admin_url('Sellers')?>" class="m-nav__link">
						<span class="m-nav__link-text">
							Çok Satan Ürünleri Listele
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
				<form class="m-form m-form--fit m-form--label-align-right" method="POST" action="<?=site_url('Admin/Sellers/editSellers/'.$sellerInfo->id)?>">
					<div class="m-portlet__body">
						<div class="m-form__section m-form__section--first">
							<?if ($this->session->flashdata('onay') == 1){?>
								<div class="alert alert-success alert-dismissible fade show" style="margin-left: 20px;margin-right: 20px" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
									<strong>
									Başarılı
									</strong>
									Ürün Güncellendi.
								</div>
							<?}elseif($this->session->flashdata('hata') == 1){?>
								<div class="alert alert-danger alert-dismissible fade show" style="margin-left: 20px;margin-right: 20px" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
									<strong>
									Sorun
									</strong>
									Ürün Güncellenemedi Lütfen Geliştiricinize Başvurun.
								</div>
							<?}?>
							<div class="form-group m-form__group">
								<label>
									Başlık
								</label>
								<input type="text" class="form-control m-input" name="title" value="<?=$sellerInfo->title?>" required="true">
							</div>
							<div class="form-group m-form__group">
								<label>
									İçerik
								</label>
								<input type="text" class="form-control m-input" name="content" value="<?=$sellerInfo->content?>" required="true">
							</div>
							<div class="form-group m-form__group">
								<label>
									Link
								</label>
								<input type="text" class="form-control m-input" name="link" value="<?=$sellerInfo->link?>" required="true">
							</div>
							<div class="form-group m-form__group">
		                        <label for="exampleSelect1">
		                           Güncel Kategori Fotoğrafı
		                        </label>
		                           	<div class="m-alert m-alert--outline alert alert-info alert-dismissible fade show">
		                               	<div class="row">
		                                   	<div class="col-lg-3 col-md-4 col-sm-6 mb-3 text-center images" id="img_1">
		                                    	<div>
		                                       		<center>
		                                          		<a href="<?=site_url($sellerInfo->image)?>" target="_blank">
		                                             		<img src="<?=site_url($sellerInfo->image)?>" class="w-100 mb-2 img-responsive" style="width:50%;">
		                                          		</a>
		                                       		</center>
		                                    	</div>
		                                   	</div>
		                               	</div>
		                          	</div>
		                    </div>
							<div class="col-12 m--padding-left-30 m--padding-right-30">
								<label>
									Resim
								</label>
								<div class="m-dropzone dropzone m-dropzone--primary dz-clickable" action="<?=site_url('Admin/Sellers/ImageUpload')?>" id="m-dropzone-one">
									<div class="m-dropzone__msg dz-message needsclick">
										<h3 class="m-dropzone__msg-title">
											Resim Yükle
										</h3>
										<span class="m-dropzone__msg-desc">
											<i class="fa fa-picture-o"></i>
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
										Güncelle
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