<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Ürünler
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
					<!--begin: Search Form -->
					<div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
						<form method="GET" action="<?=admin_url('Product')?>?s=1">
						<div class="row align-items-center">
							<div class="col-xl-8 order-2 order-xl-1">
								<div class="form-group m-form__group row align-items-center">
									<div class="col-md-4">
										<div class="m-form__group m-form__group--inline">
											<div class="m-form__label">
												<label>Durum:</label>
											</div>
											<div class="m-form__control">
												<select class="form-control form-control-sm m-input" name="status">
													<option value="">
														Seçiniz
													</option>
													<option value="1" <?=($this->input->get('status', true)=="1")?'selected':''?>>
														Açık
													</option>
													<option value="0" <?=($this->input->get('status', true)=="0")?'selected':''?>>
														Kapalı
													</option>
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<input class="form-control form-control-sm m-input" type="text" name="product_name" placeholder="Ürün İsmi" value="<?=$this->input->get('product_name', true)?>"/>
									</div>
									<input type="hidden" name="s" value="1">
									<div class="col-md-2">
										<button type="submit" class="btn m-btn--air btn-info btn-sm"><i class="la la-search"></i>Ara</button>
									</div>
								</div>
							</div>
						</div>
						</form>
					</div><!--end: Search Form -->
					<!--begin: Datatable -->
					<div class="m_datatable m-datatable m-datatable--default m-datatable--loaded" id="local_data" style="position: static; zoom: 1;">
						

					<table class="table m-table m-table--head-bg-primary">
							<thead>
								<tr>
									<th>#</th>
									<th>Başlık</th>
									<th>Fiyat Tipi</th>
									<th>Tasarım Fiyatı</th>
									<th>Kayıt Tarihi</th>
									<th>Durum</th>
									<th>İşlevler</th>
									<th>Git</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($list as $key => $val) { 
									if ($val->status == 1) {
										$new = 0;
									}else{
										$new = 1;
									} ?>
									<tr>
										<td><?=$val->Id?></td>
										<td><?=$val->product_title?></td>
										<td>
											<span>
												<?php if ($val->payment_type == 0) { ?>
													<span><span class="m-badge m-badge--success m-badge--wide">Belirtilen</span></span>
												<?php } elseif($val->payment_type==1){ ?>
													<span><span class="m-badge m-badge--wawrning m-badge--wide">Teklif Formu</span></span>
												<?php }elseif($val->payment_type==2){?>
												<span><span class="m-badge m-badge--wawrning m-badge--wide">Kategori Ürünü</span></span>
												<?}else{?>
												<span><span class="m-badge m-badge--wawrning m-badge--wide">Sabit Varyant</span></span>
												<?}?>
											</span>
										</td>
										<td><span><?=$val->creative_price?></span></td>
										<td><span><?=$val->added_time?></span></td>
										<td>
											<span class="m-switch m-switch--outline m-switch--icon m-switch--success">
												<label>
													<input type="checkbox" <?=($val->status==1?'checked="checked"':'')?> onclick="window.location='<?=site_url('Admin/Product/SetStatus/'.$val->Id.'/'.$new.'/'.$selectedPage)?>'">
													<span></span>
												</label>
											</span>
										</td>
										<td>

											<div class="dropdown d-inline">
												<button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													Ekle
												</button>
												<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
													<a class="dropdown-item" href="<?=site_url('Admin/Product/kategori/'.$val->Id)?>">Kategoriler</a>
													<a class="dropdown-item" href="<?=site_url('Admin/Product/Variant/'.$val->Id)?>">Varyantlar</a>
													<a class="dropdown-item" href="<?=site_url('Admin/Product/fiyatlama/'.$val->Id)?>">Fiyatlama</a>
												</div>
											</div>
											<button type="button" class="btn m-btn--pill m-btn--air btn-brand" onclick="window.location = '<?=site_url("Admin/Product/Update/".$val->Id)?>/'">Düzenle</button>
											<a class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" onclick="deleteConfirm('<?=site_url("Admin/Product/deleteProduct/".$val->Id)?>')" title="Delete"><i class="la la-trash"></i></a>
										</td>
										<td><a target="_blank" href="<?=site_url($val->product_slug)?>">Ürüne Git</a></td>
									</tr>	
								<?php } ?>
							</tbody>
						</table>
						<!--Sayfalama-->
						<div class="m-datatable__pager m-datatable--paging-loaded clearfix">
							<ul class="m-datatable__pager-nav">
								<li>
									<a href="<?=$data_get_url?>s=1" class="m-datatable__pager-link m-datatable__pager-link--first m-datatable__pager-link--disabled" title="First"><i class="la la-angle-double-left"></i></a>
								</li>
								<li>
									<a href="<?=$data_get_url.'s='.$prevPage?>" class="m-datatable__pager-link m-datatable__pager-link--prev m-datatable__pager-link--disabled" title="Previous"><i class="la la-angle-left"></i></a>
								</li>
								<?php for ($i=1; $i < $pageCount+1 ; $i++) { ?>
									<li style="">
										<a href="<?=$data_get_url?>s=<?=$i?>" class="m-datatable__pager-link m-datatable__pager-link-number <?=($selectedPage==$i)?'m-datatable__pager-link--active':''?>"><?=$i?></a>
									</li>
								<?php } ?>
									<li>
										<a href="<?=$data_get_url.'s='.$nextPage?>" class="m-datatable__pager-link m-datatable__pager-link--next" title="Next"><i class="la la-angle-right"></i></a>
									</li>
									<li>
										<a href="<?=$data_get_url.'s='.ceil($pageCount)?>" class="m-datatable__pager-link m-datatable__pager-link--last" title="Last"><i class="la la-angle-double-right"></i></a>
									</li>
							</ul>
						</div>
						<!--Sayfalama-->
					</div><!--end: Datatable -->
				</div>
			</div>
		</div>
	</div>
</div>