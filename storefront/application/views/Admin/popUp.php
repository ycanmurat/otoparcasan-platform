					<div class="m-subheader ">
						<div class="d-flex align-items-center">
							<div class="mr-auto">
								<h3 class="m-subheader__title m-subheader__title--separator">
									Pop-up Ekle
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
									<form class="m-form m-form--fit m-form--label-align-right" action="<?=admin_url('Slider/popUpAdd')?>" method="POST">
										<div class="m-portlet__body">
											<div class="m-form__section m-form__section--first">
												<?if ($this->session->flashdata('bilgi') == 1){?>
													<div class="alert alert-success alert-dismissible fade show" style="margin-left: 20px;margin-right: 20px" role="alert">
													<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
													<strong>
													Tebrikler!
													</strong>
													Pop-up Güncellendi
													</div>
												<?}elseif($this->session->flashdata('bilgi')==2){?>
													<div class="alert alert-danger alert-dismissible fade show" style="margin-left: 20px;margin-right: 20px" role="alert">
													<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
													<strong>
													Sorun :
													</strong>
													Pop-up Güncellenemedi.
													</div>
												<?}?>
												<div class="form-group m-form__group">
													<label>
														Link
													</label>
													<input type="text" class="form-control m-input" name="link" placeholder="Link" required="true">
												</div>
												<div class="col-12 m--padding-left-30 m--padding-right-30">
													<label>
														Pop-up Resmi
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
									Şuandaki Pop-up
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
							<table class="table m-table m-table--head-bg-success">
								<thead>
									<tr>
										<th align="left">Resim</th>
										<th width="20px" align="right">Durum</th>
									</tr>
								</thead>
								<?foreach ($popQuery as $key => $val){
									if ($val->status == 1) 
									{
										$new = 0;
									} 
									else 
									{
										$new = 1;
									}?>
								<tbody>
									<tr>
										<th><img src="<?=site_url($val->picture)?>" height="200" width="200"></th>
										<td>
											<span class="m-switch m-switch--outline m-switch--icon m-switch--success">
												<label>
													<input type="checkbox" <?=($val->status==1?'checked="checked"':'')?> onclick="window.location='<?=site_url('Admin/Slider/popStatus/'.$val->Id.'/'.$new)?>'">
													<span></span>
												</label>
											</span>
										</td>
									</tr>
								</tbody>
								<?}?>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>