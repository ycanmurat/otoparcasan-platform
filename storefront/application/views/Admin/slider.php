<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Slider İşlemleri
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
		<div style="margin-right:10px;">
			<div>
				<button type="button" class="btn m-btn--air btn-warning" onclick="window.location = '<?=site_url('Admin/Slider/Add')?>'">Slider Ekle</button>
			</div>
		</div>
		<div>
			<div>
				<button type="button" class="btn m-btn--air btn-warning" onclick="window.location = '<?=site_url('Admin/Slider/popUpAdd')?>'">Pop-up Ekle</button>
			</div>
		</div>
	</div>
</div>
<div class="m-content">
	<div class="row">
		<?php $sonuc = array($this->session->flashdata('order_result1'), $this->session->flashdata('order_result2')); ?>
		<?php if (@$sonuc[0] != ""): ?>
			<div class="alert alert-<?=$sonuc[1]?> alert-dismissible fade show w-100" style="margin-left: 20px;margin-right: 20px" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
				<?=$sonuc[0]?>
			</div>
		<?php endif ?>
		<div class="col-lg-12">
			<div class="m-portlet">
				<form action="<?=admin_url('Slider/imageMust')?>" method="post">
				<div class="m-section">
					<div class="m-section__content">
						<div class="table-responsive">
							<table class="table m-table m-table--head-bg-success">
								<thead>
									<tr>
										<th>ID</th>
										<th>Dil</th>
										<th style="min-width:100px;" width="100px">Sıra</th>
										<th>Resim</th>
										<th>Link</th>
										<th>Durum</th>
										<th>İşlem</th>
									</tr>
								</thead>
								<tbody>
								<?php if (@$list != ""): ?>
									<?php foreach ($list as $val): ?>
									<?php
									if ($val->status == 1) {
										$new = 0;
									} else {
										$new = 1;
									}
									?>
									<tr>
										<th><?=$val->Id?></th>
										<th><?=$val->lang_name?></th>
										<td><input type="text" name="sort[<?=$val->Id?>]" class="form-control sliderSortInput" value="<?=$val->sort?>"></td>
										<td><img src="<?=site_url($val->slider_url)?>" class="sliderListImage" style="max-width: 200px; max-height:100px;"></td>
										<td><a href="<?=$val->slider_redirect?>" target="_blank">Sayfayı Görüntüle</a></td>
										<td>
											<span class="m-switch m-switch--outline m-switch--icon m-switch--success">
												<label>
													<input type="checkbox" <?=($val->status==1?'checked="checked"':'')?> onclick="window.location='<?=site_url('Admin/Slider/SetStatus/'.$val->Id.'/'.$new)?>'">
													<span></span>
												</label>
											</span>
										</td>
										<td>
											<div class="dropdown">
												<button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													İşlem Yap
												</button>
												<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
													<a href="<?=admin_url('Slider/editSlider/'.$val->Id)?>" class="dropdown-item btn-sm text-black">Düzenle</a>
													<a href="javascript:void(0);" class="dropdown-item bg-danger text-white" onclick="deleteConfirm('<?=site_url('Admin/Slider/Delete/'.$val->Id)?>')">Sil</a>
												</div>
											</div>
										</td>
									</tr>
									<?php endforeach ?>
								<?php endif ?>
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
			</div>
		</div>
	</div>
</div>