<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Kampanya Düzenle
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
					<a href="<?=admin_url('Campaign')?>" class="m-nav__link">
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
				<form class="m-form m-form--fit m-form--label-align-right" method="POST" action="<?=site_url('Admin/Campaign/editCampaign/'.$editCampaignAllData->Id)?>">
					<div class="m-portlet__body">
						<div class="m-form__section m-form__section--first">
							<?if ($this->session->flashdata('true') == 1){?>
								<div class="alert alert-success alert-dismissible fade show" style="margin-left: 20px;margin-right: 20px" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
									<strong>
									Tebrikler!
									</strong>
									Kampanya Düzenlendi !
								</div>
							<?}elseif($this->session->flashdata('false') == 1){?>
								<div class="alert alert-danger alert-dismissible fade show" style="margin-left: 20px;margin-right: 20px" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
									<strong>
									Hata!
									</strong>
									Kampanya Düzenlenemiyor !
								</div>
							<?}?>
							<div class="form-group m-form__group">
								<label>
									Kampanya Linki <?=$h?>
								</label>
								<input type="text" class="form-control m-input" name="campaign_link" maxlength="254" placeholder="Kampanya Linki" required="true" value="<?=$editCampaignAllData->campaign_link?>">
							</div>
							<div class="form-group m-form__group">
								<label for="category_heading">
									Kampanya Başlığı
								</label>
								<input type="text" class="form-control m-input" name="campaign_title" maxlength="254" placeholder="Kampanya Başlığı" required="true" value="<?=$editCampaignAllData->campaign_title?>">
							</div>
							<div class="form-group m-form__group">
								<label for="category_heading">
									Başlangıç Tarihi
								</label>
								<input type="date" class="form-control m-input" name="campaign_start" required="true" value="<?=$editCampaignAllData->campaign_start?>">
							</div>
							<div class="form-group m-form__group">
								<label for="category_heading">
									Bitiş Tarihi
								</label>
								<input type="date" class="form-control m-input" name="campaign_end" required="true" value="<?=$editCampaignAllData->campaign_end?>">
							</div>
							<div class="form-group m-form__group">
								<label for="category_heading">
									Kampanya Kısa Bilgi
								</label>
								<textarea class="form-control m-input" rows="3" style="margin-top: 0px; margin-bottom: 0px; height: 103px;" name="campaign_info" maxlength="1000" required="true"><?=$editCampaignAllData->campaign_info?></textarea>
							</div>
							<div class="form-group m-form__group">
								<label for="exampleSelect1">
									Kampanya Fotoğrafı
								</label>
								<div class="m-dropzone dropzone m-dropzone--primary dz-clickable" style="margin-left:50px;margin-right: 50px" action="<?=site_url('Admin/Campaign/ImageUpload/')?>" id="m-dropzone-two">
									<div class="m-dropzone__msg dz-message needsclick">
										<h3 class="m-dropzone__msg-title">
											Güncellenecek Kampanya Resmini Buraya Taşıyabilirsiniz.
										</h3>
										<span class="m-dropzone__msg-desc">
											Sadece 1 Kampanya Resmi
										</span>
									</div>
								</div>
							</div>
							<input type="hidden" name="Id" value="<?=$editCampaignAllData->Id?>">
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