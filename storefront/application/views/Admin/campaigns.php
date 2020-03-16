<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Kampanyaları Düzenle
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
					<!--begin: Datatable -->
					<div class="m_datatable m-datatable m-datatable--default m-datatable--loaded table-responsive" id="local_data" style="position: static; zoom: 1;">
						<table class="table m-table m-table--head-bg-metal table-detail">
							<thead>
								<tr>
									<th>#</th>
									<th>Kampanya Linki</th>
									<th>Başlangıç</th>
									<th>Bitiş</th>
									<th>Durum</th>
									<th>İşlem</th>
								</tr>
							</thead>
								<?if($campaigns_info == 0){?>
							<tbody>
								<tr>
									<td style="padding: 15px;">
										Henüz Bir Kampanya Bulunmuyor
									</td>
								</tr>
							</tbody>
							<?}else{foreach ($campaigns_info as $key => $val){if($val->status == 1){$NowStatus=0;}else{$NowStatus=1;}?>
									<tbody>
									<tr>
										<td style="padding: 15px;">
											<?=$val->Id?>
										</td>
										<td>
											<?=$val->campaign_link?>
										</td>
									<td style="padding: 15px;">
										<?=$val->campaign_start?>
									</td>
									<td style="padding: 15px;">
										<?=$val->campaign_end?>
									</td>
									<td>
										<span class="m-switch m-switch--outline m-switch--icon m-switch--success">
											<label>
												<input type="checkbox" <?=($val->status==1?'checked="checked"':'')?> onclick="window.location='<?=site_url('Admin/Campaign/StatusEdit/'.$val->Id.'/'.$NowStatus)?>'">
												<span></span>
											</label>
										</span>
									</td>
									<td style="padding: 15px;">
										<div class="dropdown">
											<button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												İşlem Yap
											</button>
											<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
												<a href="Campaign/editCampaign/<?=$val->Id?>" class="dropdown-item btn-sm text-black">Düzenle</a>
												<a href="javascript:void(0);" class="dropdown-item bg-danger text-white" onclick="deleteConfirm('Campaign/deleteCampaign/<?=$val->Id?>')">Sil</a>
											</div>
										</div>
									</td>
									</tr>
									</tbody>
								<?}}?>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>