<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Açıklama Düzenle
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
                    <a href="<?=admin_url('Sellers')?>" class="m-nav__link">
                        <span class="m-nav__link-text">
                        Site İçerik Yönetimi
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
			<?if ($this->session->flashdata('onay') == 1){?>
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
					<strong>
					Başarılı
					</strong>
					İçerik Güncellendi
				</div>
			<?}elseif($this->session->flashdata('hata') == 1){?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
					<strong>
					Sorun
					</strong>
					İçerik Güncellenemedi Lütfen Geliştiricinize Başvurun.
				</div>
			<?}?>
			<div class="m-portlet">
				<form class="m-form m-form--fit m-form--label-align-right" action="<?=admin_url('Content')?>" method="POST">
					<div class="m-portlet__body">
						<div class="m-form__section m-form__section--first">
							<div class="form-group m-form__group">
								<label for="category_heading">
									Birinci Başlık
								</label>
								<input type="text" class="form-control m-input" name="first_title" value="<?=$content->first_title?>" required="true">
							</div>
							<div class="form-group m-form__group">
								<label for="category_heading">
									Birinci İçerik
								</label>
								<textarea class="ckeditor" name="first_content"><?=$content->first_content?></textarea>
							</div>
							<div class="form-group m-form__group">
								<label for="category_heading">
									İkinci Başlık
								</label>
								<input type="text" class="form-control m-input" name="second_title" value="<?=$content->second_title?>" required="true">
							</div>
							<div class="form-group m-form__group">
								<label for="category_heading">
									İkinci İçerik
								</label>
								<textarea class="ckeditor" name="second_content"><?=$content->second_content?></textarea>
							</div>
							<div class="form-group m-form__group">
								<label for="category_heading">
									Üçüncü Başlık
								</label>
								<input type="text" class="form-control m-input" name="third_title" value="<?=$content->third_title?>" required="true">
							</div>
							<div class="form-group m-form__group">
								<label for="category_heading">
									Üçüncü İçerik
								</label>
								<textarea class="ckeditor" name="third_content"><?=$content->third_content?></textarea>
							</div>
							<div class="form-group m-form__group">
		                        <label for="exampleSelect1">
		                           Güncel İçerik Fotoğrafı
		                        </label>
	                           	<div class="m-alert m-alert--outline alert alert-info alert-dismissible fade show">
	                               	<div class="row">
	                                   	<div class="col-lg-3 col-md-4 col-sm-6 mb-3 text-center images" id="img_1">
	                                    	<div>
	                                       		<center>
	                                          		<a href="<?=(!empty($content->image))?site_url($content->image):''?>" target="_blank">
	                                             		<img src="<?=(!empty($content->image))?site_url($content->image):''?>" style="width:50%;">
	                                          		</a>
	                                       		</center>
	                                    	</div>
	                                   	</div>
	                               	</div>
	                          	</div>
		                    </div>
		                    <div class="form-group m-form__group">
								<label for="exampleSelect1">
									İçerik Fotoğrafı Yükleyin
								</label>
								<div class="m-dropzone dropzone m-dropzone--primary dz-clickable" action="<?=admin_url('Content/imageUpload')?>" id="m-dropzone-two">
									<div class="m-dropzone__msg dz-message needsclick">
										<h3 class="m-dropzone__msg-title">
											Yüklenecek İçerik Fotoğrafını Buraya Taşıyabilirsiniz.
										</h3>
										<span class="m-dropzone__msg-desc">
											Sadece 1 Fotoğraf
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="m-portlet__foot m-portlet__foot--fit">
						<div class="m-form__actions m-form__actions">
							<div class="row">
								<div class="col-lg-6"></div>
								<div class="col-lg-6 text-right">
									<button type="submit" class="btn btn-primary">
										Güncelle
									</button>
									<button type="reset" class="btn btn-secondary">
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