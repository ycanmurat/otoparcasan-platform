<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Mobil Slider İşlemleri
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
					<a href="<?=admin_url('Slider')?>" class="m-nav__link">
						<span class="m-nav__link-text">
							Slider
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
				<form class="m-form m-form--fit m-form--label-align-right" action="<?=admin_url('Slider/sliderImage')?>" method="POST">
					<div class="m-portlet__body">
						<div class="m-form__section m-form__section--first">
						<? 
						if ($this->session->flashdata('onay') == 1){?>
							<div class="alert alert-success alert-dismissible fade show" style="margin-left: 20px;margin-right: 20px" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
							<strong>
								Tebrikler!
							</strong>
								Mobil Slider Eklendi
							</div>
						<?}elseif($this->session->flashdata('hata')==1){?>
							<div class="alert alert-danger alert-dismissible fade show" style="margin-left: 20px;margin-right: 20px" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
							<strong>
								Sorun
							</strong>
								Mobil Slider Eklenemedi
							</div>
						<?}?>
							<div class="form-group m-form__group">
								<label>
									Sıra
								</label>
								<input type="number" class="form-control m-input" name="sort" placeholder="Sıra" required="true">
							</div>
							<div class="form-group m-form__group">
								<label>
									Link
								</label>
								<input type="text" class="form-control m-input" name="slider_redirect" placeholder="Link" required="true">
							</div>
							<div class="form-group m-form__group">
								<label>
									Dil
								</label>
								<select class="form-control" name="lang_id">
									<?php foreach ($langs as $val): ?>
									<option value="<?=$val->id?>"><?=$val->lang_name?></option>
									<?php endforeach ?>
								</select>
							</div>
							<div class="col-12 m--padding-left-30 m--padding-right-30">
								<label>
									Resim
								</label>
								<div class="m-dropzone dropzone m-dropzone--primary dz-clickable" action="<?=site_url('Admin/Slider/ImageUpload/')?>" id="m-dropzone-one">
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
								<div class="col-lg-6"></div>
								<div class="col-lg-6 text-right">
									<button type="submit" class="btn btn-primary">
										Ekle
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
<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Mobil Sliderlar
			</h3>
		</div>
	</div>
</div>
<div class="m-content">
	<div class="row">
		<div class="col-lg-12">
			<div class="m-portlet">
				<div class="m-section">
					<div class="m-section__content">
						<div class="table-responsive">
							<form method="post" action="<?=admin_url('Slider/MobileimageMust')?>">
							<table class="table m-table m-table--head-bg-success">
								<thead>
									<tr>
										<th>ID</th>
										<th>Dil</th>
										<th align="left">Resim</th>
										<th width="" align="right">Durum</th>
										<th width="" align="right">Sıra</th>
										<th width="" align="right">Link</th>
										<th width="" align="right">İşlem</th>

									</tr>
								</thead>
								<tbody>
									<?foreach ($Rimage as $key => $val){if($val->status==1){$new=0;}else{$new=1;}?>
								<tr>
									<td><?=$val->Id?></td>
									<td><?=$val->lang_name?></td>
									<td><img src="<?=site_url($val->slider_url)?>" width="300" height="100"></td>
									<td>
										<span class="m-switch m-switch--outline m-switch--icon m-switch--success">
											<label>
												<input type="checkbox" <?=($val->status==1?'checked="checked"':'')?> onclick="window.location='<?=site_url('Admin/Slider/SetStatusImg/'.$val->Id.'/'.$new)?>'">
												<span></span>
											</label>
										</span>
									</td>
									<td><input type="number" value="<?=$val->sort?>" name="sort[<?=$val->Id?>]" class="form-control" style="width: 100%"></td>
									<td><a href="<?=$val->slider_redirect?>" target="_blank">Sayfayı Görüntüle</a></td>
									<td>
										<div class="dropdown">
											<button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												İşlem Yap
											</button>
											<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
												<a href="<?=admin_url('Slider/editMobileSlider/'.$val->Id)?>" class="dropdown-item btn-sm text-black">Düzenle</a>
												<a href="javascript:void(0);" class="dropdown-item bg-danger text-white" onclick="deleteConfirm('<?=site_url('Admin/Slider/DeleteImg/'.$val->Id)?>')">Sil</a>
											</div>
										</div>
									</td>
								</tr>
								<?}?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="text-right" style="padding:15px;">
                  <button type="submit" style="" class="btn btn-outline-primary m-btn m-btn--icon m-btn--outline-2x">
                     <span>
                        <i class="fa flaticon-list-1"></i>
                           <span>
                              Slider Sırasını Düzenle
                           </span>
                     </span>
                  </button>
               </div>
				<form>
			</div>
		</div>
	</div>
</div>