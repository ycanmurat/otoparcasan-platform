<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Yardım İçerikleri
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
				<form action="<?=admin_url('Help/sortPost')?>" method="post">
				<div class="m-section">
					<div class="m-section__content">
						<div class="table-responsive">
							<table class="table m-table m-table--head-bg-success">
								<thead>
									<tr>
										<th>#</th>
										<th>Menü Adı</th>
										<th style="min-width:100px;" width="150px">Sıra</th>
										<th style="text-align: center;">İçerik</th>
										<th style="text-align: center;">Durum</th>
										<th style="text-align: right;">İşlem</th>
									</tr>
								</thead>
								<tbody>
									<?foreach ($helps as $key => $helpInfo) {if($helpInfo->status==1){$new=0;}else{$new=1;}?>
									<tr>
										<th><?=$helpInfo->id?></th>
										<th><?=$helpInfo->menu?></th>
										<td><input type="text" name="sort[<?=$helpInfo->id?>]" class="form-control sliderSortInput" value="<?=$helpInfo->sort?>"></td>
										<td style="text-align: center;">
			                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#m_modal_<?=$helpInfo->id?>">
			                                    İçeriği Gör
			                                </button>
			                           </td>
			                           <div class="modal fade" id="m_modal_<?=$helpInfo->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			                                <div class="modal-dialog" role="document">
			                                    <div class="modal-content">
			                                        <div class="modal-header">
			                                            <h5 class="modal-title" id="exampleModalLabel">
			                                                <?=$helpInfo->title?>
			                                            </h5>
			                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                                                <span aria-hidden="true">
			                                                    &times;
			                                                </span>
			                                            </button>
			                                        </div>
			                                        <div class="modal-body">
			                                            <p><?=$helpInfo->content?></p>
			                                        </div>
			                                        <div class="modal-footer">
			                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
			                                                Geri Çık
			                                            </button>
			                                        </div>
			                                    </div>
			                                </div>
			                            </div>
										<td style="text-align: center;">
											<span class="m-switch m-switch--outline m-switch--icon m-switch--success">
												<label>
													<input type="checkbox" <?=($helpInfo->status==1?'checked="checked"':'')?> onclick="window.location='<?=admin_url('Help/SetStatus/'.$helpInfo->id.'/'.$new)?>'">
													<span></span>
												</label>
											</span>
										</td>
										<td style="text-align: right;">
											<div class="dropdown">
												<button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													İşlem Yap
												</button>
												<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
													<a href="<?=admin_url('Help/edit/'.$helpInfo->id)?>" class="dropdown-item btn-sm text-black">Düzenle</a>
													<a href="javascript:void(0);" class="dropdown-item bg-danger text-white" onclick="deleteConfirm('<?=admin_url('Help/delete/'.$helpInfo->id)?>')">Sil</a>
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
                  <button type="submit" class="btn btn-outline-primary m-btn m-btn--icon m-btn--outline-2x">
                     <span>
                        <i class="fa flaticon-list-1"></i>
                           <span>
                              İçerik Sırasını Düzenle
                           </span>
                     </span>
                  </button>
               </div>
			</div>
		</div>
	</div>
</div>