<div class="m-subheader ">
<div class="d-flex align-items-center">
	<div class="mr-auto">
		<h3 class="m-subheader__title m-subheader__title--separator">
			Ürün Soru Kategorileri
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
				<a href="<?=admin_url('Product?s=1')?>" class="m-nav__link">
					<span class="m-nav__link-text">
						Ürün Listele
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
</div>
</div>
<div class="m-content">
<div class="row">
	<div class="col-lg-12">
		<div class="m-portlet">
			<div class="m-portlet__body">
				<!--begin: Datatable -->
				<div class="m_datatable m-datatable m-datatable--default m-datatable--loaded">
					<div class="m-datatable__pager m-datatable--paging-loaded clearfix">
						<table class="table m-table m-table--head-bg-primary table-responsive">
							<thead>
								<tr>
									<th style="text-align: center">Kategori<br>No</th>
									<th style="text-align: center">Kategori<br>Adı</th>
									<th style="text-align: center">Açık<br>Kapalı</th>
									<th style="text-align: center">Eklenme<br>Tarihi</th>
									<th style="text-align: center">İşlem<br>Yap</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($list as $key => $val) { ?>
									<?php $val->status == 1 ? $update_status = 0 : $update_status = 1; ?>
									<tr>
										<td style="text-align: center"><?php echo $val->id; ?></td>
										<td style="text-align: center"><?php echo $val->name; ?></td>
										<td style="text-align: center">
											<span class="m-switch m-switch--outline m-switch--icon m-switch--success">
			                                    <label>
			                                        <input type="checkbox" <?=($val->status==1?'checked="checked"':'')?> onclick="window.location='<?=admin_url('Comment/editProductQuestionStatus/'.$val->id.'/'.$update_status)?>'">
			                                        <span></span>
			                                    </label>
			                                </span>
										</td>
										<td style="text-align: center"><?php echo $val->added_time; ?></td>
										<td style="text-align: center">
											<div class="dropdown d-inline">
												<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding: 5px;">
													İşlem
												</button>
												<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="cursor:pointer;">
													<a href="<?php echo admin_url('Comment/editProductQuestionCategory/' . $val->id); ?>" class="dropdown-item">Düzenle</a>
													<a href="<?php echo admin_url('Comment/deleteProductQuestionCategory/' . $val->id); ?>" class="dropdown-item">Sil</a>
												</div>
											</div>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div><!--end: Datatable -->
				</div>
			</div>
		</div>
	</div>
</div>