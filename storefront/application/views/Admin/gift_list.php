<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Hediye Çeki Ve Kampanyalar
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
		<div class="col-lg-12">
			<div class="m-portlet">
				<div class="m-section">
					<div class="m-section__content">
						<table class="table m-table m-table--head-bg-success">
							<thead>
								<tr>
									<th>#</th>
									<th>Kod</th>
									<th>Kapsam</th>
									<th>Şart</th>
									<th>Türü</th>
									<th>İndirim</th>
									<th>User ID</th>
									<th>Durum</th>
									<th>Sil</th>
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
										<td><?=$val->kod?></td>
										<td><span class="m-badge m-badge--<?=getGiftTypeColor($val->type)?> m-badge--wide"><?=getGiftType($val->type)?></span></td>
										<td><?=$val->min_price?> - <?=$val->max_price?></td>
										<td><span class="m-badge m-badge--<?=getDiscountTypeColor($val->discount_type)?> m-badge--wide"><?=getDiscountType($val->discount_type)?></span></td>
										<td><?=$val->discount?></td>
										<td><?=$val->user_id?></td>
										<td>
											<span class="m-switch m-switch--outline m-switch--icon m-switch--success">
												<label>
													<input type="checkbox" <?=($val->status==1?'checked="checked"':'')?> onclick="window.location='<?=site_url('Admin/Giftcheck/SetStatus/'.$val->Id.'/'.$new)?>'">
													<span></span>
												</label>
											</span>
										</td>
										<td>
											<button type="button" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" onclick="deleteConfirm('<?=site_url('Admin/Giftcheck/Delete/'.$val->Id)?>')"><i class="la la-trash"></i></button>
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