<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Paket Listesi
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
			</ul>
		</div>
	</div>
</div>
<div class="m-content">
	<div class="row">
		<?php if (@$paketsonuc != ""): ?>
			<div class="alert alert-danger alert-dismissible fade show w-100" style="margin-left: 15px;margin-right: 15px;padding-bottom: 4px;" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
				<?=$paketsonuc?>
			</div>
		<?php endif ?>
		<div class="col-lg-12">
			<div class="m-portlet">
				<div class="m-section">
					<div class="m-section__content">
						<table class="table m-table m-table--head-bg-success">
							<thead>
								<tr>
									<th>#</th>
									<th width="250px">Paket Adı</th>
									<th>Durum</th>
									<th colspan="3" class="text-center">Boyutlar</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($list as $key => $val) { 
									if ($val->status == 1) {
										$new = 0;
									} else {
										$new = 1;
									}
									?>
									<tr>
										<td><?=$val->Id?></td>
										<td><?=$val->name?></td>
										<td>
											<span class="m-switch m-switch--outline m-switch--icon m-switch--success">
												<label>
													<input type="checkbox" <?=($val->status==1?'checked="checked"':'')?> onclick="window.location='<?=site_url('Admin/Package/SetStatus/'.$val->Id.'/'.$new)?>'">
													<span></span>
												</label>
											</span>
										</td>
										<td>
											<a class="btn btn-info" href="<?=site_url("/Admin/Package/Sub/".$val->Id)?>">Alt Paketler</a>
										</td>
										<td>
											<a class="btn m-btn--pill m-btn--air btn-brand" href="<?=site_url("/Admin/Package/Update/".$val->Id)?>">Düzenle</a>
										</td>
										<td>
											<button type="button" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" onclick="deleteConfirm('<?=site_url('Admin/Package/Delete/'.$val->Id)?>')"><i class="la la-trash"></i></button>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>