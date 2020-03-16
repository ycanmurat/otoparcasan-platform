<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Kullanıcıların Eklediği İbanlar
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
						<div class="table-responsive">
							<table class="table m-table m-table--head-bg-success">
								<thead>
									<tr>
										<th>ID</th>
										<th>Ekleyen Kullanıcı</th>
										<th>IBAN</th>
										<th>İsim Soyisim</th>
										<th>Banka</th>
										<th>İşlem</th>
									</tr>
								</thead>
								<tbody>
									<?foreach ($ibanInformation as $key => $val) {?>
									<tr>
										<td ><?=$val->id?></td>
										<td ><?=$val->name.' '.$val->surname?></td>
										<td ><?=$val->iban?></td>
										<td ><?=$val->name_surname?></td>
										<td ><?=$val->bank?></td>
										<td style="text-align: right;">
											<div class="dropdown">
												<button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													İşlem Yap
												</button>
												<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
													<a href="javascript:void(0);" class="dropdown-item bg-danger text-white" onclick="deleteConfirm('<?=admin_url('Transfer/deleteIban/'.$val->id)?>')">Sil</a>
												</div>
											</div>
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