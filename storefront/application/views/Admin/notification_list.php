<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Bildirimler
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
						<table class="table m-table m-table--head-bg-primary table-responsive">
							<thead>
								<tr>
									<th>#</th>
									<th>Bildirim İçeriği</th>
									<th>Bildirim Tarihi</th>
									<th>Durum</th>
									<th style="text-align: right;">İşlem</th>
								</tr>
							</thead>
							<?if($notifications == 0){?>
								<tbody><tr><td style="padding: 15px;">Henüz Bir Bildirim Bulunmuyor</td></tr></tbody>
							<?}else{foreach ($notifications as $key => $val){if($val->status == 1){$NowStatus=0;}else{$NowStatus=1;}?>
								<tbody>
								<tr>
									<td style="padding: 15px;">
										<?=$val->id?>
									</td>
									<td>
										<?=$val->content?>
									</td>
								<td style="padding: 15px;">
									<?=$val->added_time?>
								</td>
								<td>
									<span class="m-switch m-switch--outline m-switch--icon m-switch--success">
										<label>
											<input type="checkbox" <?=($val->status==1?'checked="checked"':'')?> onclick="window.location='<?=admin_url('Notification/StatusEdit/'.$val->id.'/'.$NowStatus)?>'">
											<span></span>
										</label>
									</span>
								</td>
								<td style="padding: 15px;text-align: right;">
									<div class="dropdown">
										<button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											İşlem Yap
										</button>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
											<a href="Notification/editNotification/<?=$val->id?>" class="dropdown-item btn-sm text-black">Düzenle</a>
											<a href="javascript:void(0);" class="dropdown-item bg-danger text-white" onclick="deleteConfirm('Notification/deleteNotification/<?=$val->id?>')">Sil</a>
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