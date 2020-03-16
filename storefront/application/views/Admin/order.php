<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Siparişler
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
				<button type="button" class="btn m-btn--air btn-success" onclick="window.location = '<?=get_url('Admin/Order/ExportExcel')?>'"><i class="fa fa-file-excel-o"></i></button>
			</div>
		</div>
	</div>
</div>
<div class="m-content">
	<div class="row">
		<?php $sonuc = array($this->session->flashdata('order_result1'), $this->session->flashdata('order_result2')); ?>
		<?php if (@$sonuc[0] != ""): ?>
			<div class="alert alert-<?=$sonuc[0]?> alert-dismissible fade show w-100" style="margin-left: 20px;margin-right: 20px" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
				<?=$sonuc[0]?>
			</div>
		<?php endif ?>
		<?php if (@$efaturasonuc[0] != ""): ?>
			<div class="alert alert-<?=$efaturasonuc[1]?> alert-dismissible fade show w-100" style="margin-left: 20px;margin-right: 20px" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
				<?php
				if ($efaturasonuc[0] == "danger") {
					echo $efaturasonuc[1];
				} else { ?>
				<p>Fatura Kesildi!</p>
				<a href="<?=site_url("Admin/Efatura/View/".$efaturasonuc[1])?>" target="_blank"><b>Faturayı Görüntüle</b></a>
				<?php } ?>
			</div>
		<?php endif ?>
		<div class="col-lg-12">
			<div class="m-portlet">
				<div class="m-portlet__body">
					<!--begin: Search Form -->
					<div class="m-form m-form--label-align-right m--margin-bottom-30">
						<form action="<?=admin_url('Order')?>?s=1" method="GET">
							<div><h6>Filtrele</h6></div>
							<div class="form-group m-form__group row align-items-center">
								<div class="col-2">
									<select class="form-control form-control-sm m-input" name="order_status" placeholder="Sipariş Durumu">
										<option value="">Sipariş Durumu</option>
										<?php foreach ($orderstatus as $oskey => $osval): ?>
											<option value="<?=$oskey?>" <?=($this->input->get('order_status', true) == $oskey) ? 'selected' : '' ?>><?=$osval['text']?></option>
										<?php endforeach ?>
									</select>
								</div>
								<div class="col-2">
									<select class="form-control form-control-sm m-input" name="payment_status" placeholder="Ödeme Durumu">
										<option value="">Ödeme Durumu</option>
										<option value="0" <?=($this->input->get('payment_status', true) == "0") ? 'selected' : '' ?>>Ödeme bekleniyor</option>
										<option value="1" <?=($this->input->get('payment_status', true) == "1") ? 'selected' : '' ?>>Ödeme yapıldı</option>
									</select>
								</div>
								<div class="col-2">
									<select class="form-control form-control-sm m-input" name="payment_type" placeholder="Ödeme Türü">
										<option value="">Ödeme Türü</option>
										<?php foreach ($paymenttype as $pskey => $psval): ?>
											<option value="<?=$pskey?>" <?=($this->input->get('payment_type', true) == $pskey) ? 'selected' : '' ?>><?=$psval?></option>
										<?php endforeach ?>
									</select>
								</div>
								<div class="col-4">
									<input class="form-control form-control-sm m-input" type="text" value="<?=$this->input->get('name', true)?>" name="name" placeholder="Üye Adı" />
								</div>
								<div class="col-2">
									<input type="hidden" name="s" value="1">
									<?php if ($this->input->get('user_id')): ?>
									<input type="hidden" name="user_id" value="<?=$this->input->get('user_id')?>">
									<?php endif ?>
									<button type="submit" class="btn m-btn--air btn-info btn-sm"><i class="la la-search"></i> Ara</button>
								</div>
							</div>
						</form>
						<form action="<?=admin_url('Order')?>?s=1" method="GET" class="mt-2">
							<div class="form-group m-form__group row align-items-center">
								<div class="col-3">
									<input class="form-control form-control-sm m-input" type="text" value="<?=$this->input->get('siparisno', true)?>" name="siparisno" placeholder="Sipariş No" />
								</div>
								<div class="col-6">
									<input type="hidden" name="s" value="1">
									<button type="submit" class="btn m-btn--air btn-info btn-sm"><i class="la la-search"></i> Sipariş No ile Ara</button>
								</div>
							</div>
						</form>
					</div><!--end: Search Form -->
					<!--begin: Datatable -->
					<div class="m_datatable m-datatable m-datatable--default m-datatable--loaded table-responsive" id="local_data" style="position: static; zoom: 1;">
						<table class="table m-table m-table--head-bg-metal table-detail">
							<thead>
								<tr>
									<th width="150px">Sipariş No</th>
									<th width="200px">Sipariş Durumu</th>
									<th width="200px">Ödeme Durumu</th>
									<th width="200px">Ödeme Türü</th>
									<th width="400px">Üye Adı</th>
									<th width="300px">Sipariş Tarihi</th>
									<th width="300px">Toplam Adet</th>
									<th width="300px">Toplam Tutar</th>
									<th width="1px">Düzenle</th>
								</tr>
							</thead>
							<tbody>
							<?php if (@$list != ""): ?>
								<?php foreach ($list as $val): ?>
								<?php
								if ($val->payment_status == 0) { $newpayment = 1; } else { $newpayment = 0; }
								if ($val->user_id == 0) { $val->username = $val->person_name; }
								?>
								<tr>
									<th><?=$val->Id?></th>
									<td>
										<span class="m-badge m-badge--<?=$orderstatus[$val->order_status]['color']?> m-badge--wide"><?=$orderstatus[$val->order_status]['text']?></span>
									</td>
									<td>
										<?php
										if ($val->payment_status == 0) { ?>

											<?php
											if ($val->order_status == 3) {
												?> <span class="m-badge m-badge--metal m-badge--wide">Ödeme yapılmadı</span> <?php
											} else { ?>
											<span class="m-switch m-switch--outline m-switch--icon m-switch--success">
												<label>
													<input type="checkbox" <?=($val->payment_status==1?'checked="checked"':'')?> onclick="switchConfirm('<?=site_url('Admin/Order/PaymentStatus/'.$val->Id.'/'.$newpayment)?>')">
													<span></span>
												</label>
											</span>
										<?php
											}
										} else {
											?> <span class="m-badge m-badge--success m-badge--wide">Ödeme yapıldı</span> <?php
										}
										?>
									</td>
									<td>
										<?=$paymenttype[$val->payment_type]?>
									</td>
									<td><?=$val->username?></td>
									<td><?=dateparse($val->added_time)?></td>
									<td><?=$val->adet?></td>
									<td><?=$val->toplam." ".$val->moneycode?></td>
									<td>
										<div class="dropdown">
											<button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												İşlemler
											</button>
											<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
												<a class="dropdown-item btn-sm" onclick="return confirm('Faturayı kesmek istediğinizden emin misiniz?')" href="<?=site_url('Admin/Efatura/Send/'.$val->Id)?>">Faturayı Kes</a>
												<a class="dropdown-item btn-sm" href="<?=site_url('Admin/Order/View/'.$val->Id)?>">Göster</a>
												<?php if ($val->user_id != 0): ?>
												<a class="dropdown-item btn-sm" href="<?=site_url('Admin/User/Update/'.$val->user_id)?>">Kullanıcıya Git</a>
												<?php endif ?>

												<a class="dropdown-item btn-sm" href="javascript:void(0)" data-toggle="modal" data-target="#modal_address_<?=$val->Id?>">Adres</a>
												<a class="dropdown-item btn-sm" href="javascript:void(0)" data-toggle="modal" data-target="#modal_order_<?=$val->Id?>">Sipariş Durumu</a>
												<a class="dropdown-item btn-sm" href="javascript:void(0)" data-toggle="modal" data-target="#modal_payment_<?=$val->Id?>">Ödeme Durumu</a>
												<a href="javascript:void(0);" class="dropdown-item btn-sm bg-danger text-white" onclick="nextConfirm('<?=site_url('Admin/Order/OrderStatus/'.$val->Id.'/3')?>')">İptal Et</a>
											</div>
										</div>
										<!--begin::Modal___ORDER-->
										<div class="modal fade" id="modal_order_<?=$val->Id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<form action="<?=admin_url('Order/ChangeStatus')?>" method="GET">
														<div class="modal-header">
															<h5 class="modal-title" id="exampleModalLabel">
																<?=$val->Id?> nolu siparişin "Sipariş Durumu" 
															</h5>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">
																	&times;
																</span>
															</button>
														</div>
														<div class="modal-body">
																<select class="form-control form-control-sm m-input" name="new">
																	<?php foreach ($orderstatus as $oskey => $osval): ?>
																		<option value="<?=$oskey?>" <?=($val->order_status == $oskey) ? 'selected' : '' ?>><?=$osval['text']?></option>
																	<?php endforeach ?>
																</select>
																<input type="hidden" name="status" value="order">
																<input type="hidden" name="id" value="<?=$val->Id?>">
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-secondary" data-dismiss="modal">
																İptal
															</button>
															<button type="submit" class="btn btn-primary">
																Kaydet
															</button>
														</div>
													</form>
												</div>
											</div>
										</div>
										<!--end::Modal___ORDER-->
										<!--begin::Modal___PAYMENT-->
										<div class="modal fade" id="modal_payment_<?=$val->Id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<form action="<?=admin_url('Order/ChangeStatus')?>" method="GET">
														<div class="modal-header">
															<h5 class="modal-title" id="exampleModalLabel">
																<?=$val->Id?> nolu siparişin "Sipariş Durumu" 
															</h5>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">
																	&times;
																</span>
															</button>
														</div>
														<div class="modal-body">
																<select class="form-control form-control-sm m-input" name="new">
																	<option value="0" <?=($val->payment_status == 0) ? 'selected' : '' ?>>Ödeme bekleniyor</option>
																	<option value="1" <?=($val->payment_status == 1) ? 'selected' : '' ?>>Ödeme yapıldı</option>
																</select>
																<input type="hidden" name="status" value="payment">
																<input type="hidden" name="id" value="<?=$val->Id?>">
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-secondary" data-dismiss="modal">
																İptal
															</button>
															<button type="submit" class="btn btn-primary">
																Kaydet
															</button>
														</div>
													</form>
												</div>
											</div>
										</div>
										<!--end::Modal___PAYMENT-->
										<!--begin::Modal___ADDRESS-->
										<div class="modal fade" id="modal_address_<?=$val->Id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog" role="document">

												<form action="<?=admin_url('Order/UpdateAddress/'.$val->address_id)?>" method="POST">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title" id="exampleModalLabel">
																<?=$val->Id?> nolu siparişin adresi 
															</h5>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">
																	&times;
																</span>
															</button>
														</div>
														<div class="modal-body">
																<div class="form-group">
																	<label class="form-control-label">
																		Adres Adı:
																	</label>
																	<input type="text" class="form-control" name="definition" value="<?=$val->definition?>">
																</div>
																<div class="form-group">
																	<label class="form-control-label">
																		Sipariş Veren:
																	</label>
																	<input type="text" class="form-control" name="name" value="<?=$val->person_name?>">
																</div>
																<div class="form-group">
																	<label class="form-control-label">
																		Ülke:
																	</label>
																	<select class="form-control" name="country">
																		<option value="1" <?=($val->country == 1) ? 'selected':'' ?>>Türkiye</option>
																		<option value="2" <?=($val->country == 2) ? 'selected':'' ?>>Irak</option>
																		<option value="3" <?=($val->country == 3) ? 'selected':'' ?>>Almanya</option>
																	</select>
																</div>
																<div class="form-group">
																	<label class="form-control-label">
																		Şehir:
																	</label>
																	<select class="form-control" name="city">
																		<option value="55" <?=($val->city == 55) ? 'selected':'' ?>>Samsun</option>
																		<option value="34" <?=($val->city == 34) ? 'selected':'' ?>>İstanbul</option>
																		<option value="6" <?=($val->city == 06) ? 'selected':'' ?>>Ankara</option>
																	</select>
																</div>
																<div class="form-group">
																	<label class="form-control-label">
																		İlçe:
																	</label>
																	<input type="text" class="form-control" name="town" value="<?=$val->town?>">
																</div>
																<div class="form-group">
																	<label class="form-control-label">
																		Posta Kodu:
																	</label>
																	<input type="text" class="form-control" name="post_code" value="<?=$val->post_code?>">
																</div>
																<div class="form-group">
																	<label class="form-control-label">
																		Telefon:
																	</label>
																	<input type="text" class="form-control" name="gsm" value="<?=$val->gsm?>">
																</div>
																<div class="form-group">
																	<label class="form-control-label">
																		Adres:
																	</label>
																	<textarea class="form-control" name="content"><?=$val->content?></textarea>
																</div>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-secondary" data-dismiss="modal">
																İptal
															</button>
															<button type="submit" class="btn btn-primary">
																Kaydet
															</button>
														</div>
													</div>
												</form>

											</div>
										</div>
										<!--end::Modal___ADDRESS-->
									</td>
								</tr>
								<?php endforeach ?>
							<?php endif ?>
							</tbody>
						</table>
						<?php if (@$prevPage): ?>
						<!--Sayfalama-->
						<div class="m-datatable__pager m-datatable--paging-loaded clearfix">
							<ul class="m-datatable__pager-nav">
								<li>
									<a href="<?=get_url('Admin/Order')?>s=1" class="m-datatable__pager-link m-datatable__pager-link--first m-datatable__pager-link--disabled" title="First"><i class="la la-angle-double-left"></i></a>
								</li>
								<li>
									<a href="<?=get_url('Admin/Order')?>s=<?=$prevPage?>" class="m-datatable__pager-link m-datatable__pager-link--prev m-datatable__pager-link--disabled" title="Previous"><i class="la la-angle-left"></i></a>
								</li>
								<?php for ($i=1; $i < $pageCount+1 ; $i++) { ?>
									<li style="">
										<a href="<?=get_url('Admin/Order')?>s=<?=$i?>" class="m-datatable__pager-link m-datatable__pager-link-number <?=($selectedPage==$i)?'m-datatable__pager-link--active':''?>"><?=$i?></a>
									</li>
								<?php } ?>
									<li>
										<a href="<?=get_url('Admin/Order')?>s=<?=$nextPage?>" class="m-datatable__pager-link m-datatable__pager-link--next" title="Next"><i class="la la-angle-right"></i></a>
									</li>
									<li>
										<a href="<?=get_url('Admin/Order')?>s=<?=ceil($pageCount)?>" class="m-datatable__pager-link m-datatable__pager-link--last" title="Last"><i class="la la-angle-double-right"></i></a>
									</li>
							</ul>
						</div>
						<!--Sayfalama-->
						<?php endif ?>
					</div><!--end: Datatable -->
				</div>
			</div>
		</div>
	</div>
</div>