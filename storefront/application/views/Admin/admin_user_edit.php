<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Yönetici Kullanıcıları Düzenle
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
			<div>
				<button type="button" class="btn m-btn--air btn-warning" onclick="window.location = '<?=site_url('Admin/AdminUserEdit/newAdminAdd')?>'">Yeni Yönetici Kullanıcı Ekle</button>
			</div>
		</div>
	</div>
</div>
<div class="m-content">
	<div class="row">
		<div class="col-lg-12">
			<div class="m-portlet">
				<div class="m-portlet__body">
					<?if ($this->session->flashdata('true') == 1){?>
						<div class="alert alert-success alert-dismissible fade show" style="margin-left: 20px;margin-right: 20px" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							</button>
							<strong>
							İşlem Başarılı !
							</strong>
							Kullanıcı Yetkisi Başarıyla Atandı
						</div>
					<?}elseif($this->session->flashdata('delete') == 1){?>
						<div class="alert alert-success alert-dismissible fade show" style="margin-left: 20px;margin-right: 20px" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							</button>
							<strong>
							İşlem Başarılı !
							</strong>
							Kullanıcı Başarıyla Silindi
						</div>
					<?}?>
					<!--begin: Datatable -->
					<div class="m_datatable m-datatable m-datatable--default m-datatable--loaded table-responsive" id="local_data" style="position: static; zoom: 1;">
						<table class="table m-table m-table--head-bg-metal table-detail">
							<thead>
								<tr>
									<th>#</th>
									<th>Yetki Düzenle</th>
									<th>Kullanıcı Adı</th>
									<th>E-Posta</th>
									<th>Durum</th>
									<th>Telefon</th>
									<th>İşlem</th>
								</tr>
							</thead>
							<?if($all_user_info == 0){?>
							<tbody>
								<tr>
									<td style="padding: 15px;">
										Henüz Bir Kullanıcı Bulunmuyor
									</td>
								</tr>
							</tbody>
							<?}else{foreach($all_user_info as $key => $user_info){if($user_info->status == 1){$NowStatus=0;}else{$NowStatus=1;}?>
								<tbody>
									<tr>
										<td style="padding: 15px;">
											<?=$user_info->Id?>
										</td>
										<td>
										<div class="dropdown">
											<button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<?if($user_info->auth==0){echo "Tüm Yetkilere Sahip";}
											if($user_info->auth==2){echo "Dil ve Çeviri Yetkisinde";}if($user_info->auth==3){echo "Ürün ve Sipariş Yetkisinde";}?>
											</button>
											<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
												<a href="javascript:void(0);" class="dropdown-item btn-sm text-black" onclick="nextConfirm('<?=site_url('Admin/AdminUserEdit/AuthEdit/0/'.$user_info->Id)?>')">Tüm Yetkilere Ekle</a>
												<a href="javascript:void(0);" class="dropdown-item btn-sm text-black" onclick="nextConfirm('<?=site_url('Admin/AdminUserEdit/AuthEdit/2/'.$user_info->Id)?>')">Dil ve Çeviri Yetkisine Ekle</a>
												<a href="javascript:void(0);" class="dropdown-item btn-sm text-black" onclick="nextConfirm('<?=site_url('Admin/AdminUserEdit/AuthEdit/3/'.$user_info->Id)?>')">Ürün ve Sipariş Yetkisine Ekle</a>
											</div>
										</div>
									</td>
									<td style="padding: 15px;">
										<?=$user_info->user_name?>
									</td>
									<td style="padding: 15px;">
										<?=$user_info->user_mail?>
									</td>
									<td>
										<span class="m-switch m-switch--outline m-switch--icon m-switch--success">
											<label>
												<input type="checkbox" <?=($user_info->status==1?'checked="checked"':'')?> onclick="window.location='<?=site_url('Admin/AdminUserEdit/StatusEdit/'.$user_info->Id.'/'.$NowStatus)?>'">
												<span></span>
											</label>
										</span>
									</td>
									<td style="padding: 15px;">
										<?=$user_info->user_gsm?>
									</td>
									<td style="padding: 15px;">
										<div class="dropdown">
											<button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												İşlem Yap
											</button>
											<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
												<a href="AdminUserEdit/UpdateUser/<?=$user_info->Id?>" class="dropdown-item btn-sm text-black">Düzenle</a>
												<a href="javascript:void(0);" class="dropdown-item bg-danger text-white" onclick="deleteConfirm('AdminUserEdit/DeleteUser/<?=$user_info->Id?>')">Sil</a>
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