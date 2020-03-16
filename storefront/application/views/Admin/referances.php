<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Referanslar
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
									<th width="70px">Id</th>
									<th width="70px">Sıra</th>
									<th width="400px">Referans Başlığı</th>
									<th width="400px">Görüntüle</th>
									<th width="100px">Durum</th>
									<th width="1px">Sil</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<?foreach ($list as $key => $info){
									if($info->status == 1){$St = 0;} 
									else{$St = 1;}?>
									<th><?=$info->Id?></th>
									<th width="75"><input type="text" name="" class="form-control" value="<?=$info->in_order?>"></th>
									<th scope="row"><?=$info->referances_title?></th>
									<th><a href="<?=base_url($info->img_url)?>" target="_blank"><img src="<?=base_url($info->img_url)?>" alt="<?=$info->referances_title?>" title="<?=$info->referances_title?>" width="150" height="50"></a></th>
									<th>
										<span class="m-switch m-switch--outline m-switch--icon m-switch--success">
											<label>
												<input type="checkbox" <?=($info->status==1?'checked="checked"':'')?> onclick="window.location='<?=site_url('Admin/Referances/StatusEdit/'.$info->Id.'/'.$St)?>'">
												<span></span>
											</label>
										</span>
									</th>
									<th>
										<button type="button" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" onclick="deleteConfirm('<?=site_url('Admin/Referances/ReferancesDelete/'.$info->Id)?>')"><i class="la la-trash"></i></button>
									</th>
								</tr>
								<?}if(empty($info->Id)){?><tr><th colspan="6">Verilerinizde Eklediğiniz Bir Referans Bulunmuyor</th></tr><?}?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>