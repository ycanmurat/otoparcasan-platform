<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Alt Paket Listesi
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
		<button type="button" class="btn m-btn--air btn-warning" onclick="window.location = 'https://ebask.com/Admin/Package/SubAdd/<?=$package_id?>'">Ekle</button>
	</div>
</div>
<div class="m-content">
	<div class="row">
		<div class="col-lg-12">
			<div class="m-portlet">
				<div class="m-section">
					<div class="m-section__content">
						<table class="table m-table m-table--head-bg-success">
							<thead>
								<tr>
									<th>#</th>
									<th>Alt Paket Adı</th>
									<th>Eski Fiyat</th>
									<th>Satış Fiyatı</th>
									<th></th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php $i=0; foreach ($list as $key => $val) { $i++; ?>
									<tr>
										<td><?=$i?></td>
										<td><?=$val->name?></td>
										<td><?=$val->old_price?></td>
										<td><?=$val->price?></td>
										<td>
											<a class="btn btn-info" href="<?=site_url("/Admin/Package/Product/".$val->package_sub_id)?>">Ürünler</a>
										</td>
										<td>
											<a class="btn m-btn--pill m-btn--air btn-brand" href="<?=site_url("/Admin/Package/SubUpdate/".$val->package_sub_id)?>">Düzenle</a>
										</td>
										<td>
											<button type="button" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" onclick="deleteConfirm('<?=site_url('Admin/Package/SubDelete/'.$val->package_sub_id.'/'.$package_id)?>')"><i class="la la-trash"></i></button>
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