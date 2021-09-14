<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Ürün Marka Yönetimi
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
                    <a href="<?=admin_url('Product?s=1')?>" class="m-nav__link">
                        <span class="m-nav__link-text">
                        Ürünler
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
				<button type="button" class="btn m-btn--air btn-warning" onclick="window.location = '<?=site_url('Admin/Brand/add')?>'">Ürün Marka Ekle</button>
			</div>
		</div>
	</div>
</div>
<div class="m-content">
	<div class="row">
		<div class="col-lg-12">
			<div class="m-portlet">
				<form action="<?=admin_url('MarkaTedarikci/imageMust')?>" method="post">
				<div class="m-section">
					<div class="m-section__content">
						<div class="table-responsive">
							<table class="table m-table m-table--head-bg-success">
								<thead>
									<tr>
										<th>#</th>
										<th>Başlık</th>
										<th style="min-width:100px;" width="100px">Sıra</th>
										<th style="text-align:right;">Resim</th>
										<th style="text-align:right;">Durum</th>
										<th style="text-align:right;">İşlem</th>
									</tr>
								</thead>
								<tbody>
								<?foreach ($brands as $key => $val) {
									if (isset($val->status)) {
										if($val->status==0){
											$new=1;
										}else{
											$new=0;
										}
									}
								?>
									<tr>
										<th><?=$val->GRUP_KOD?></th>
										<th><?=replaceStringProblemsReverse($val->GRUP_ISIM)?></th>
										<?php 
											if (isset($val->status)) { 
										?>
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
						                                        	<?=replaceStringProblemsReverse($val->GRUP_ISIM)?>
						                                       	</h5>
						                                       	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						                                          	<span aria-hidden="true">
						                                            	&times;
						                                          	</span>
						                                       	</button>
						                                    </div>
						                                    <div class="modal-body">
						                                    	<p><center><img src="<?=site_url($val->image)?>" style="max-width: 100%;"></center></p>
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
														<input type="checkbox" <?=($val->status==1?'checked="checked"':'')?> onclick="window.location='<?=admin_url('MarkaTedarikci/SetStatus/'.$val->id.'/'.$new)?>'">
														<span></span>
													</label>
												</span>
											</td>
										<?php }else{ ?>
											<td></td>
											<td></td>
											<td></td>
										<?php } ?>
										<td style="text-align:right;">
											<a class="btn btn-danger" href="<?=admin_url('MarkaTedarikci/marka_duzenle/'.$val->GRUP_KOD)?>">Düzenle</a>
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