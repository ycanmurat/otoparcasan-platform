<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Havale Ödeme Bildirimleri Görüntüle
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
										<th>İsim Soyisim</th>
										<th>Sipariş Numarası</th>
										<th>Tüm Bilgiler</th>
										<th>Durum</th>
										<th>İşlem</th>
									</tr>
								</thead>
								<tbody>
									<?foreach ($transferInformation as $key => $val) {if($val->status==1){$new=0;}else{$new=1;}?>
									<tr>
										<td ><?=$val->id?></td>
										<td ><?=$val->name.' '.$val->surname?></td>
										<td ><?=$val->name_surname?></td>
										<td ><?=$val->order_number?></td>
										<td style="text-align: right;">
			                              	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#m_modal_<?=$val->id?>">
			                                 Tüm Bilgiler
			                              	</button>
				                        </td>
			                           <div class="modal fade" id="m_modal_<?=$val->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			                              <div class="modal-dialog" role="document">
			                                 <div class="modal-content">
			                                    <div class="modal-header">
			                                       <h5 class="modal-title" id="exampleModalLabel">
			                                          <?=$val->order_number?>
			                                       </h5>
			                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                                          <span aria-hidden="true">
			                                             &times;
			                                          </span>
			                                       </button>
			                                    </div>
			                                    <div class="modal-body">
			                                       Ekleyen Kullanıcı : <b><?=$val->name.' '.$val->surname?></b><br><br>
			                                       İsim Soyisim : <b><?=$val->name_surname?></b><br><br>
			                                       E-Mail : <b><?=$val->email?></b><br><br>
			                                       Telefon : <b><?=$val->phone?></b><br><br>
			                                       Sipariş Numarası : <b><?=$val->order_number?></b><br><br>
			                                       Banka İsmi : <b><?=$val->bank_id?></b><br><br>
			                                       Havale-EFT Tutarı : <b><?=$val->amount?></b><br><br>
			                                       Mesaj : <b><?=(!empty($val->message))?$val->message:'Bir Mesaj Bırakılmamış.'?></b>
			                                    </div>
			                                    <div class="modal-footer">
			                                       <button type="button" class="btn btn-secondary" data-dismiss="modal">
			                                          Geri Çık
			                                       </button>
			                                    </div>
			                                 </div>
			                              </div>
			                           </div>
										<td style="text-align: right;">
											<span class="m-switch m-switch--outline m-switch--icon m-switch--success">
												<label>
													<input type="checkbox" <?=($val->status==1?'checked="checked"':'')?> onclick="window.location='<?=admin_url('Transfer/SetStatusTransfer/'.$val->id.'/'.$new)?>'">
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
													<a href="javascript:void(0);" class="dropdown-item bg-danger text-white" onclick="deleteConfirm('<?=admin_url('Transfer/deleteTransfer/'.$val->id)?>')">Sil</a>
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

