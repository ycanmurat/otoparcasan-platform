<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				İskonto Listele
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
                    <a href="<?=admin_url('Indirim')?>" class="m-nav__link">
                        <span class="m-nav__link-text">
                       	İskonto Yönetimi
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
		<div>
			<div style="margin-right:10px;">
				<div>
					<button type="button" class="btn m-btn--air btn-warning" onclick="window.location = '<?=site_url('Admin/Indirim/Add')?>'">İskonto Ekle</button>
				</div>
			</div>
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
									<th>Marka</th>
									<th>Cari</th>
									<th>Üst Kategori</th>
									<th>Ana Kategori</th>
									<th>Alt Kategori</th>
									<th>İndirim</th>
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
										<td><?=$val->id?></td>
										<td><?=$val->marka?></td>
										<td><?=$val->cari?></td>
										<td><?=$val->ustKategori?></td>
										<td><?=$val->anaKategori?></td>
										<td><?=$val->altKategori?></td>
										<td><?=$val->discount?></td>
										<td>
											<span class="m-switch m-switch--outline m-switch--icon m-switch--success">
												<label>
													<input type="checkbox" <?=($val->status==1?'checked="checked"':'')?> onclick="window.location='<?=site_url('Admin/Indirim/SetStatus/'.$val->id.'/'.$new)?>'">
													<span></span>
												</label>
											</span>
										</td>
										<td>
											<button type="button" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" onclick="deleteConfirm('<?=site_url('Admin/Indirim/Delete/'.$val->id)?>')"><i class="la la-trash"></i></button>
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