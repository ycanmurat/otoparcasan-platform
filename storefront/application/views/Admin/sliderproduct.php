<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Banner Güncelle
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
                    <a href="<?=admin_url('Slider')?>" class="m-nav__link">
                        <span class="m-nav__link-text">
                        Slider İşlemleri
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
				<form class="m-form m-form--fit m-form--label-align-right" action="<?=admin_url('Slider/ProductSlider')?>" method="POST">
					<div class="m-portlet__body">
						<div class="m-form__section m-form__section--first">
							<?if ($this->session->flashdata('bilgi') == 1){?>
								<div class="alert alert-success alert-dismissible fade show" style="margin-left: 20px;margin-right: 20px" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
								<strong>
								Tebrikler!
								</strong>
								Banner Güncellendi
								</div>
							<?}elseif($this->session->flashdata('bilgi')==2){?>
								<div class="alert alert-danger alert-dismissible fade show" style="margin-left: 20px;margin-right: 20px" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
								<strong>
								Sorun :
								</strong>
								Banner Güncellenemedi.
								</div>
							<?}?>
							<div class="col-12 m--padding-left-30 m--padding-right-30">
								<label>
									Banner
								</label>
								<div class="m-dropzone dropzone m-dropzone--primary dz-clickable" action="<?=site_url('Admin/Slider/ImageUpload/')?>" id="m-dropzone-one">
									<div class="m-dropzone__msg dz-message needsclick">
										<h3 class="m-dropzone__msg-title">
											Sadece 1 Resim
										</h3>
										<span class="m-dropzone__msg-desc">
											<i class="fa fa-picture-o"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="form-group m-form__group">
								<label for="category_heading">
									Başlık
								</label>
								<input type="text" class="form-control m-input" name="title" value="<?=$Banner->title?>">
							</div>
							<div class="form-group m-form__group">
								<label for="category_heading">
									Link
								</label>
								<input type="text" class="form-control m-input" name="link" value="<?=$Banner->link?>">
							</div>
							<div class="form-group m-form__group">
								<label for="category_heading">
									Geçerlilik Süresi /
								</label>
								<label for="category_heading" style="font-size:12px;">
									Yazılacak Tarih Örneği : 4 15, 2019 14:00:00
								</label>
								<input type="text" class="form-control m-input" name="date" value="<?=$Banner->date?>">
							</div>
							<div class="form-group m-form__group">
								<label for="category_heading">
									Durumu /
								</label>
								<label for="category_heading" style="font-size:12px;">
									1 -> Açık / 0 -> Kapalı
								</label>
								<input type="text" class="form-control m-input" name="status" value="<?=$Banner->status?>">
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
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>