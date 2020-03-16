<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Varyantlar
			</h3>
			<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
				<li class="m-nav__item m-nav__item--home">
					<a href="<?=admin_url()?>" class="m-nav__link m-nav__link--icon">
						<i class="m-nav__link-icon la la-home"></i>
					</a>
				</li>
			</ul>
		</div>
		<div>
			<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover" aria-expanded="true">
				<a href="#" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
					<i class="la la-plus m--hide"></i>
					<i class="la la-ellipsis-h"></i>
				</a>
				<div class="m-dropdown__wrapper">
					<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
					<div class="m-dropdown__inner">
						<div class="m-dropdown__body">
							<div class="m-dropdown__content">
								<ul class="m-nav">
									<li class="m-nav__section m-nav__section--first m--hide">
										<span class="m-nav__section-text">
											Düzenle
										</span>
									</li>
									<li class="m-nav__item">
										<a href="" class="m-nav__link">
											<i class="m-nav__link-icon flaticon-share"></i>
											<span class="m-nav__link-text">
												Sil
											</span>
										</a>
									</li>
									<li class="m-nav__item">
										<a href="" class="m-nav__link">
											<i class="m-nav__link-icon flaticon-chat-1"></i>
											<span class="m-nav__link-text">
												Sırala
											</span>
										</a>
									</li>
									<li class="m-nav__separator m-nav__separator--fit"></li>
									<li class="m-nav__item">
										<a href="#" class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">
											Submit
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
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
									<th width="100px">Durum</th>
									<th width="100px">Alt Varyantlar</th>
									<th width="1px">Düzenle</th>
									<th width="1px">Sil</th>
								</tr>
							</thead>
							<tbody>
							<?php if (@$variants != ""): ?>
								<?php foreach ($variants as $val): ?>
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
									<td><?=$val->variant_title?></td>
									<td>
										<span class="m-switch m-switch--outline m-switch--icon m-switch--success">
											<label>
												<input type="checkbox" <?=($val->status==1?'checked="checked"':'')?> onclick="window.location='<?=site_url('Admin/Variant/SetStatus/'.$val->Id.'/'.$new)?>'">
												<span></span>
											</label>
										</span>
									</td>
									<td>
										<button type="button" class="btn m-btn--pill m-btn--air btn-warning" onclick="window.location = '<?=site_url('Admin/Variant/VariantChilds/'.$val->Id)?>'">Alt Varyantlar</button>
									</td>
									<td>
										<button type="button" class="btn m-btn--pill m-btn--air btn-brand" onclick="window.location = '<?=site_url('Admin/Variant/Update/'.$val->Id)?>'">Düzenle</button>
									</td>
									<td>
										<button type="button" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" onclick="deleteConfirm('<?=site_url('Admin/Variant/Delete/'.$val->Id)?>')"><i class="la la-trash"></i></button>
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