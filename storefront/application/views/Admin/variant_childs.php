<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Alt Varyantlar
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
				<li class="m-nav__item">
					<a href="<?=admin_url('Variant')?>" class="m-nav__link">
						<span class="m-nav__link-text">
							Varyantlar
						</span>
					</a>
				</li>
				<li class="m-nav__separator">
					-
				</li>
				<li class="m-nav__item">
					<a href="<?=admin_url('Variant/VariantChilds/'.$variant->id)?>" class="m-nav__link">
						<span class="m-nav__link-text font-weight-bold">
							<strong><?=$variant->name?></strong>
						</span>
					</a>
				</li>
			</ul>
		</div>
		<div>
			<div>
				<button type="button" class="btn m-btn--air btn-warning" onclick="window.location = '<?=site_url('Admin/Variant/ChildAdd/'.$variant->id)?>'">Ekle</button>
			</div>
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
									<th width="400px">Başlık</th>
									<th width="400px">Etiket</th>
									<th width="1px">Düzenle</th>
									<th width="1px">Sil</th>
								</tr>
							</thead>
							<tbody>
							<?php if (@$childs != ""): ?>
								<?php foreach ($childs as $val): ?>
								<tr>
									<th><?=$val->Id?></th>
									<td><?=$val->name?></td>
									<td><?=$val->child_title?></td>
									<td>
										<button type="button" class="btn m-btn--pill m-btn--air btn-brand" onclick="window.location = '<?=site_url('Admin/Variant/ChildUpdate/'.$val->Id)?>'">Düzenle</button>
									</td>
									<td>
										<button type="button" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" onclick="deleteConfirm('<?=site_url('Admin/Variant/ChildDelete/'.$val->Id)?>')"><i class="la la-trash"></i></button>
									</td>
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