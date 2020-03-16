<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				E-Fatura
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
				<div class="m-portlet__body">

					<!--begin: Datatable -->
					<div class="m_datatable m-datatable m-datatable--default m-datatable--loaded" id="local_data" style="position: static; zoom: 1;">	

						<table class="table m-table m-table--head-bg-primary">
							<thead>
								<tr>
									<th>#</th>
									<th>Sipariş No</th>
									<th>Türkkep Fatura No</th>
									<th>İşlem Tarihi</th>
									<th>İşlevler</th>
								</tr>
							</thead>
							<tbody>
								<?php if (@$list): ?>
									<?php foreach ($list as $key => $val) { ?>
										<tr>
											<th><?=$val->Id?></th>
											<td><?=$val->order_id?></td>
											<td><?=$val->invoice_id?></td>
											<td><span><?=$val->added_time?></span></td>
											<td>
												<button type="button" class="btn m-btn--pill m-btn--air btn-brand" onclick="window.open('<?=site_url()?>Admin/Efatura/View/<?=$val->invoice_id?>', '_blank')">Göster</button>
												<button type="button" class="btn m-btn--pill m-btn--air btn-brand" onclick="window.location = '<?=site_url()?>Admin/Order/View/<?=$val->order_id?>'">Sipariş Detayı</button>
											</td>
										</tr>	
									<?php } ?>
								<?php endif ?>
							</tbody>
						</table>
						<!--Sayfalama-->
						<?php if (@$pageCount): ?>
							<div class="m-datatable__pager m-datatable--paging-loaded clearfix">
								<ul class="m-datatable__pager-nav">
									<li>
										<a href="?s=1" class="m-datatable__pager-link m-datatable__pager-link--first m-datatable__pager-link--disabled" title="First"><i class="la la-angle-double-left"></i></a>
									</li>
									<li>
										<a href="<?=site_url('Admin/Efatura'.'?s='.$prevPage)?>" class="m-datatable__pager-link m-datatable__pager-link--prev m-datatable__pager-link--disabled" title="Previous"><i class="la la-angle-left"></i></a>
									</li>
									<?php for ($i=1; $i < $pageCount+1 ; $i++) { ?>
										<li style="">
											<a href="?s=<?=$i?>" class="m-datatable__pager-link m-datatable__pager-link-number <?=($selectedPage==$i)?'m-datatable__pager-link--active':''?>"><?=$i?></a>
										</li>
									<?php } ?>
									<li>
										<a href="<?=site_url('Admin/Efatura'.'?s='.$nextPage)?>" class="m-datatable__pager-link m-datatable__pager-link--next" title="Next"><i class="la la-angle-right"></i></a>
									</li>
									<li>
										<a href="<?=site_url('Admin/Efatura'.'?s='.ceil($pageCount))?>" class="m-datatable__pager-link m-datatable__pager-link--last" title="Last"><i class="la la-angle-double-right"></i></a>
									</li>
								</ul>
							</div>
						<?php endif ?>
						<!--Sayfalama-->
					</div><!--end: Datatable -->
				</div>
			</div>
		</div>
	</div>
</div>