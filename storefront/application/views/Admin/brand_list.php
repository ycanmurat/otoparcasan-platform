<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Markalar
			</h3>
			<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
				<li class="m-nav__item m-nav__item--home">
					<a href="<?=admin_url()?>" class="m-nav__link m-nav__link--icon">
						<i class="m-nav__link-icon la la-home"></i>
					</a>
				</li>
			</ul>
		</div>
		<div style="margin-right:10px;">
			<div>
				<button type="button" class="btn m-btn--air btn-warning" onclick="window.location = '<?=site_url('Admin/Brand/add')?>'">Ekle</button>
			</div>
		</div>
	</div>
</div>
<div class="m-content">
	<div class="row">
		<div class="col-lg-12">
			<div class="m-portlet">
				<form action="<?=admin_url('Brand/imageMust')?>" method="post">
				<div class="m-section">
					<div class="m-section__content">
						<div class="table-responsive">
							<table class="table m-table m-table--head-bg-success">
								<thead>
									<tr>
										<th>#</th>
										<th>Başlık</th>
										<th>Kategori</th>
										<th style="min-width:100px;" width="100px">Sıra</th>
										<th style="text-align:right;">Resim</th>
										<th style="text-align:right;">Durum</th>
										<th style="text-align:right;">İşlem</th>
									</tr>
								</thead>
								<tbody>
								<?foreach ($brands as $key => $val) {if($val->status==0){$new=1;}else{$new=0;}?>
									<tr>
										<th><?=$val->id?></th>
										<th><?=$val->title?></th>
										<th><?=($val->category==1)?'Araba':'Tedarikçi'?></th>
										<td><input type="text" name="sort[<?=$val->id?>]" class="form-control sliderSortInput" value="<?=$val->sort?>"></td>
										<td style="text-align:right;">
			                              	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#m_modal_<?=$val->id?>">
			                                 Markayı Gör
			                              	</button>
			                           	</td>
			                           	<div class="modal fade" id="m_modal_<?=$val->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			                              	<div class="modal-dialog" role="document">
			                                 	<div class="modal-content">
				                                    <div class="modal-header">
				                                       	<h5 class="modal-title" id="exampleModalLabel">
				                                        	<?=$val->title?>
				                                       	</h5>
				                                       	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				                                          	<span aria-hidden="true">
				                                            	&times;
				                                          	</span>
				                                       	</button>
				                                    </div>
				                                    <div class="modal-body">
				                                    	<p><center><img src="<?=site_url($val->image)?>"></center></p>
				                                    </div>
				                                    <div class="modal-footer">
				                                       	<button type="button" class="btn btn-secondary" data-dismiss="modal">
				                                        	Geri Çık
				                                       	</button>
			                                    	</div>
			                                	</div>
			                              	</div>
			                           	</div>
										<td style="text-align:right;">
											<span class="m-switch m-switch--outline m-switch--icon m-switch--success">
												<label>
													<input type="checkbox" <?=($val->status==1?'checked="checked"':'')?> onclick="window.location='<?=admin_url('Brand/SetStatus/'.$val->id.'/'.$new)?>'">
													<span></span>
												</label>
											</span>
										</td>
										<td style="text-align:right;">
											<div class="dropdown">
												<button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													İşlem Yap
												</button>
												<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
													<a href="javascript:void(0);" class="dropdown-item bg-danger text-white" onclick="deleteConfirm('<?=admin_url('Brand/delete/'.$val->id)?>')">Sil</a>
													<a class="dropdown-item" href="<?=admin_url('Brand/edit/'.$val->id)?>">Düzenle</a>
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
				<div class="text-right" style="padding:15px;">
                  <button type="submit" style="" class="btn btn-outline-primary m-btn m-btn--icon m-btn--outline-2x">
                     <span>
                        <i class="fa flaticon-list-1"></i>
                           <span>
                              Marka Sırasını Düzenle
                           </span>
                     </span>
                  </button>
               </div>
			</div>
		</div>
	</div>
</div>