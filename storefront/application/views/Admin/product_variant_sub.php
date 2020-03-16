<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Ürün Varyanları
			</h3>
			<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
				<li class="m-nav__item m-nav__item--home">
					<a href="<?=site_url()?>Admin/" class="m-nav__link m-nav__link--icon">
						<i class="m-nav__link-icon la la-home"></i>
					</a>
				</li>
				<li class="m-nav__separator">
					- 
				</li>
				<li class="m-nav__item">
					<a href="<?=admin_url('Product')?>" class="m-nav__link">
						<span class="m-nav__link-text">
							Ürünler
						</span>
					</a>
				</li>
				<li class="m-nav__separator">
					-
				</li>
				<li class="m-nav__item">
					<?php $ustvaryantid = (int)$_GET['urun']; ?>
					<a href="<?=admin_url('Product/Variant/'.$ustvaryantid)?>" class="m-nav__link">
						<span class="m-nav__link-text">
							Ürünün Varyantları
						</span>
					</a>
				</li>
			</ul>
		</div>
		<div>
			<div>
				<button type="button" class="btn m-btn--air btn-warning" onclick="window.location = '<?=site_url()?>Admin/Product/VariantChildAdd/<?=$product_variant."?urun=".$ustvaryantid?>'">Ekle</button>
			</div>
		</div>
	</div>
</div>

<div class="m-content">
	<div class="row">
		<div class="col-lg-12">
			<div class="m-portlet">
				<form action="<?=site_url('Admin/Product/SetVariantSubSort/'.$product_variant.'/'.$ustvaryantid)?>" method="POST">
					<div class="m-portlet__body">
						<!--begin: Datatable -->
						<div class="m_datatable m-datatable m-datatable--default m-datatable--loaded" id="local_data" style="position: static; zoom: 1;">
						<table class="table m-table m-table--head-bg-primary">
								<thead>
									<tr>
										<th>#</th>
										<th>İsim</th>
										<th>Sıra</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 0;
								 	foreach ($list as $key => $val) { 
									 	$i++; ?>
										<tr>
											<td><?=$i?></td>
											<td><?=$val->name?></td>
											<td><input type="number" class="form-control" style="width: 100%" value="<?=$val->sort?>" name="sort[<?=$val->id?>]"></td>
											<td>
												<a class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" onclick="window.location='<?=site_url("Admin/Product/deleteFromSubVariant/".$val->id."/".$product_variant."?urun=".$ustvaryantid)?>'" title="Delete"><i class="la la-trash"></i></a>
											</td>
										</tr>	
									<?php } ?>
								</tbody>
							</table>
						</div>
						<!--end: Datatable -->
					</div>
					<div class="m-portlet__foot m-portlet__foot--fit">
						<div class="m-form__actions m-form__actions">
							<div class="row">
								<div class="col-lg-2"></div>
								<div class="col-lg-10">
									<button type="submit" class="btn btn-success pull-right" style="margin: 30px;">
										Sırala
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