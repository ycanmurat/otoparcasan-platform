<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				"<?=$category_info->category_title?>" İçindeki Ürünlerin Sırasını Düzenleyin
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
				<form method="POST" action="<?=site_url('Admin/Category/SetVariantSort/'.$backId)?>">
				<div class="m-section">
					<div class="m-section__content">
						<table class="table m-table m-table--head-bg-success">
							<thead>
								<tr>
									<th width="1px">Id</th>
									<th width="200">Sıra</th>
									<th width="200">Ürün İsmi</th>
									<th width="200">Resim</th>
								</tr>
							</thead>
							<?foreach($product_info as $key => $val){?>
							<tbody>
									<td><?=$val->Id?></td>
									<td><input type="number" value="<?=$val->sort?>" name="sort[<?=$val->Id?>]" class="form-control" style="width: 100%"></td>
									<td><?=$val->product_name?></td>
									<td><img src="<?=site_url($val->default_image)?>" width="200" height="125"></td>
							</tbody>
							<?}?>
						</table>
					</div>
				</div>
				<div class="m-portlet__foot m-portlet__foot--fit">
						<div class="m-form__actions m-form__actions">
							<div class="row">
								<div class="col-lg-2"></div>
								<div class="col-lg-10">
									<button type="submit" class="btn btn-success pull-right" style="margin: 30px;">
										Sırayı Düzenle
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