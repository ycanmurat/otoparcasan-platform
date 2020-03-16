<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Statik Sayfalar
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
	<div class="row">
		<div class="col-lg-12">
			<div class="m-portlet">
				<div class="m-section">
					<div class="m-section__content">
						<table class="table m-table m-table--head-bg-success">
							<thead>
								<tr>
									<th>#</th>
									<th>Sayfa Title</th>
									<th>Sayfa Başlığı</th>
									<th>Durum</th>
									<th>Url</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($list as $key => $val) { 
									if ($val->status == 1) {
										$new = 0;
									}else{
										$new = 1;
									}
									?>

									<tr>
										<td><?=$val->static_id?></td>
										<td><?=$val->page_title?></td>
										<td><?=$val->page_headline?></td>
										<td>
											<span class="m-switch m-switch--outline m-switch--icon m-switch--success">
												<label>
													<input type="checkbox" <?=($val->status==1?'checked="checked"':'')?> onclick="window.location='<?=site_url('Admin/Statics/SetStatus/'.$val->Id.'/'.$new)?>'">
													<span></span>
												</label>
											</span>
										</td>
										<td><a target="_blank" href="<?=site_url('S/'.$val->page_slug)?>"><?=site_url('S/'.$val->page_slug)?></a></td>
										<td><button type="button" class="btn m-btn--pill m-btn--air btn-brand" onclick="window.location = '<?=site_url('Admin/Statics/Update/'.$val->Id)?>'">Düzenle</button></td>
										<td><a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" onclick="window.location = '<?=site_url('Admin/Statics/delete/'.$val->Id)?>'" title="Delete"><i class="la la-trash"></i></a>
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