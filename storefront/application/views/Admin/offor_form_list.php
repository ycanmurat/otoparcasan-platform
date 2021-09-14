<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Toplu Parça Teklifleri
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
                    <a href="<?=admin_url('Order')?>" class="m-nav__link">
                        <span class="m-nav__link-text">
                        Sipariş Yönetimi
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
										<th>Ad Soyad</th>
										<th>E-Posta</th>
										<th>Telefon</th>
										<th>Tüm Bilgiler</th>
										<th>Durum</th>
										<th>İşlem</th>
									</tr>
								</thead>
								<tbody>
								<?foreach ($list as $key => $val) { ?>
									<tr>
										<th><?=$val->id?></th>
										<th><?=$val->name_surname?></th>
										<th><?=$val->email?></th>
										<th><?=$val->phone?></th>
										<th>
											<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#m_modal_<?=$val->id?>">
			                                    Tüm Bilgiler
			                                </button>
										</th>
										<th>
										<?if($val->seen == 0){?>
		                                    <button style="background-color: #FFCE54;border-color:#FCBB42;" type="button" class="btn btn-primary" onclick="window.location.href='<?=admin_url('Order/orderAllSeenUpdate/'.$val->id.'/1')?>'">
		                                        Görülmedi
		                                    </button>
			                            <?}else{?>
		                                    <button style="background-color: #A0D468; border-color: #8CC152" type="button" class="btn btn-primary" onclick="window.location.href='<?=admin_url('Order/orderAllSeenUpdate/'.$val->id.'/0')?>'">
		                                        Görüldü
		                                    </button>
			                           	<?}?>
										</th>
			                           	<div class="modal fade" id="m_modal_<?=$val->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			                              	<div class="modal-dialog" role="document">
			                                 	<div class="modal-content">
				                                    <div class="modal-header">
				                                       	<h5 class="modal-title" id="exampleModalLabel">
				                                        	<?=$val->id?>
				                                       	</h5>
				                                       	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				                                          	<span aria-hidden="true">
				                                            	&times;
				                                          	</span>
				                                       	</button>
				                                    </div>
				                                    <div class="modal-body">
				                                    	<p>İsim Soyisim : <?php echo $val->name_surname; ?></p><br>
				                                    	<p>Email : <?php echo $val->email; ?></p><br>
				                                    	<p>Telefon: <?php echo $val->phone; ?></p><br>
				                                    	<p>Şase Numarası : <?php echo $val->chasis_number; ?></p><br>
				                                    	<p>Marka : <?php echo $val->brand; ?></p><br>
				                                    	<p>Model : <?php echo $val->model; ?></p><br>
				                                    	<p>Kasa : <?php echo $val->body; ?></p><br>
				                                    	<p>Yıl : <?php echo $val->year; ?></p><br>
				                                    	<p>Motor Kapasitesi : <?php echo $val->engine_capacity; ?></p><br>
				                                    	<p>Beygir : <?php echo $val->at; ?></p><br>
				                                    	<p>Yeder Parça Listesi : <?php echo $val->spare_part; ?></p><br>
				                                    	<p>Eklenenler : <?php echo $val->content; ?></p><br>
				                                    	<p>Resim : 
				                                    		<?php if ($val->image) {?>
				                                    			<img src="<?php echo site_url($val->image); ?>" style="max-width: 100%;">
				                                    		<?php } else { ?>
				                                    			Dosya Yüklenmemiş
				                                    		<?php } ?>
				                                    	</p><br>
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
											<div class="dropdown">
												<button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													İşlem Yap
												</button>
												<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
													<a href="javascript:void(0);" class="dropdown-item bg-danger text-white" onclick="deleteConfirm('<?=admin_url('Order/orderAllOrderUpdate/'.$val->id)?>')">Sil</a>
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