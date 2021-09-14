<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Kategoriler
			</h3>
			<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
				<li class="m-nav__item m-nav__item--home">
					<a href="<?=admin_url()?>" class="m-nav__link m-nav__link--icon">
						<i class="m-nav__link-icon la la-home"></i>
					</a>
				</li>
			</ul>
		</div>
	</div>
</div>
<div class="m-content">
	<?php if (@$sonuc[0] != ""): ?>	
	<div class="row p-0">
		<div class="col-lg-12">
			<div class="m-portlet">
				<div class="m-section">
					<div class="m-section__content">
						<div class="alert alert-<?=$sonuc[1]?> alert-dismissible fade show m-0" style="margin-left: 20px;margin-right: 20px" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
							<?=$sonuc[0]?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php endif ?>
	<div class="row">
		<div class="col-lg-12">
			<div class="m-portlet">
				<div class="m-section">
					<div class="m-section__content">
						<table class="table m-table m-table--head-bg-success">
							<thead>
								<tr>
									<th width="1px">ID</th>
									<th width="400px">Adı</th>
									<th width="100px">Sembol</th>
									<th width="200px">Değeri</th>
									<th width="80px">Durum</th>
									<th width="250px">Son Güncellenme Tarihi</th>
								</tr>
							</thead>
							<tbody>
							<?php if (@$currency != ""): ?>
								<?php foreach ($currency as $val): ?>
								<?php
								if ($val->status == 1) {
									$new = 0;
								} else {
									$new = 1;
								}
								?>
								<tr>
									<th><?=$val->Id?></th>
									<td><?=$val->name?></td>
									<td><?=$val->code?></td>
									<td><?=$val->price?> <i class="fa fa-turkish-lira"></i></td>
									<td>
										<span class="m-switch m-switch--outline m-switch--icon m-switch--success">
											<label>
												<input type="checkbox" <?=($val->status==1?'checked="checked"':'')?> onclick="window.location='<?=site_url('Admin/Currency/SetStatus/'.$val->Id.'/'.$new)?>'">
												<span></span>
											</label>
										</span>
									</td>
									<td><?=$val->update_time?></td>
								</tr>
								<?php endforeach ?>
							<?php endif ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>