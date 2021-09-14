<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Tatil Günleri
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
                    <a href="<?=admin_url('Kargo')?>" class="m-nav__link">
                        <span class="m-nav__link-text">
                        Kargo Yönetimi
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
		<div style="margin-right:10px;">
			<div>
				<button type="button" class="btn m-btn--air btn-warning" onclick="window.location = '<?=site_url('Admin/Tatil/add')?>'">Tatil Günü Ekle</button>
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
						<div class="table-responsive">
							<table class="table m-table m-table--head-bg-success">
								<thead>
									<tr>
										<th>#</th>
										<th>Tatil Günü</th>
										<th>Sebep</th>
										<th style="text-align: right;">Sil</th>
									</tr>
								</thead>
								<tbody>
									<?foreach ($breaks as $key => $val) { ?>
									<tr>
										<td ><?=$val->id?></td>
										<td><?=$val->break_day?></td>
										<td><?=$val->break_reason?></td>
										<td style="text-align: right;">
											<button class="btn btn-danger" onclick="confirmBtn(<?=$val->id?>)">Sil</button>
										</td>
									</tr>
									<?}?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
function confirmBtn(id) {
	var r = confirm("Silmek İstediğinizden Emin Misiniz");

	if (r == true) {
		window.location.href = '<?=admin_url('Tatil/deleted/')?>' + id;
	}
}
</script>