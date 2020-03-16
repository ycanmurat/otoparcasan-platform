<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Kategorilerdeki Ürünlerin Sırasını Düzenle
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
									<th width="1px">ID</th>
									<th width="70px">Sıra</th>
									<th width="400px">Başlık</th>
									<th width="1px">Ürün Sırasını Düzenle</th>
								</tr>
							</thead>
							<tbody>
							<?php if (@$categories != ""): ?>
								<?php foreach ($categories as $val):?>
								<tr>
									<th><?=$val->Id?></th>
									<th scope="row"><?=$val->sort?></th>
									<td><?=$val->name?></td>
									<td>
									<button type="button" class="btn m-btn--pill m-btn--air btn-brand" onclick="window.location = '<?=admin_url('Category/productGet/'.$val->Id)?>'">Ürünlerin Sırasını Düzenleyin</button></td>
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