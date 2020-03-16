<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Teklifler
			</h3>
			<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
				<li class="m-nav__item m-nav__item--home">
					<a href="<?=admin_url()?>" class="m-nav__link m-nav__link--icon">
						<i class="m-nav__link-icon la la-home"></i>
					</a>
				</li>
				<li class="m-nav__separator">
					-
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
					<!--begin: Search Form -->
							<!--
					<div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
						<div class="row align-items-center">
							<div class="col-xl-8 order-2 order-xl-1">
								<div class="form-group m-form__group row align-items-center">
									<div class="col-md-4">
										<div class="m-form__group m-form__group--inline">
											<div class="m-form__label">
												<label>Status:</label>
											</div>
											<div class="m-form__control">
												<div class="btn-group bootstrap-select form-control m-bootstrap-select m-bootstrap-select--solid">
													<button class="btn dropdown-toggle bs-placeholder btn-default" data-id="m_form_status" data-toggle="dropdown" role="button" title="All" type="button"><span class="filter-option pull-left">All</span> &nbsp;<span class="bs-caret"><span class="caret"></span></span></button>
													<div class="dropdown-menu open" role="combobox">
														<ul aria-expanded="false" class="dropdown-menu inner" role="listbox">
															<li class="selected" data-original-index="0">
																<a aria-disabled="false" aria-selected="true" class="" data-tokens="null" role="option" tabindex="0"><span class="text">All</span> <span class="glyphicon glyphicon-ok check-mark"></span></a>
															</li>
															<li data-original-index="1">
																<a aria-disabled="false" aria-selected="false" class="" data-tokens="null" role="option" tabindex="0"><span class="text">Pending</span> <span class="glyphicon glyphicon-ok check-mark"></span></a>
															</li>
															<li data-original-index="2">
																<a aria-disabled="false" aria-selected="false" class="" data-tokens="null" role="option" tabindex="0"><span class="text">Delivered</span> <span class="glyphicon glyphicon-ok check-mark"></span></a>
															</li>
															<li data-original-index="3">
																<a aria-disabled="false" aria-selected="false" class="" data-tokens="null" role="option" tabindex="0"><span class="text">Canceled</span> <span class="glyphicon glyphicon-ok check-mark"></span></a>
															</li>
														</ul>
													</div><select class="form-control m-bootstrap-select m-bootstrap-select--solid" id="m_form_status" tabindex="-98">
														<option value="">
															All
														</option>
														<option value="1">
															Pending
														</option>
														<option value="2">
															Delivered
														</option>
														<option value="3">
															Canceled
														</option>
													</select>
												</div>
											</div>
										</div>
										<div class="d-md-none m--margin-bottom-10"></div>
									</div>
									<div class="col-md-4">
										<div class="m-form__group m-form__group--inline">
											<div class="m-form__label">
												<label class="m-label m-label--single">Type:</label>
											</div>
											<div class="m-form__control">
												<div class="btn-group bootstrap-select form-control m-bootstrap-select m-bootstrap-select--solid">
													<button class="btn dropdown-toggle bs-placeholder btn-default" data-id="m_form_type" data-toggle="dropdown" role="button" title="All" type="button"><span class="filter-option pull-left">All</span> &nbsp;<span class="bs-caret"><span class="caret"></span></span></button>
													<div class="dropdown-menu open" role="combobox">
														<ul aria-expanded="false" class="dropdown-menu inner" role="listbox">
															<li class="selected" data-original-index="0">
																<a aria-disabled="false" aria-selected="true" class="" data-tokens="null" role="option" tabindex="0"><span class="text">All</span> <span class="glyphicon glyphicon-ok check-mark"></span></a>
															</li>
															<li data-original-index="1">
																<a aria-disabled="false" aria-selected="false" class="" data-tokens="null" role="option" tabindex="0"><span class="text">Online</span> <span class="glyphicon glyphicon-ok check-mark"></span></a>
															</li>
															<li data-original-index="2">
																<a aria-disabled="false" aria-selected="false" class="" data-tokens="null" role="option" tabindex="0"><span class="text">Retail</span> <span class="glyphicon glyphicon-ok check-mark"></span></a>
															</li>
															<li data-original-index="3">
																<a aria-disabled="false" aria-selected="false" class="" data-tokens="null" role="option" tabindex="0"><span class="text">Direct</span> <span class="glyphicon glyphicon-ok check-mark"></span></a>
															</li>
														</ul>
													</div><select class="form-control m-bootstrap-select m-bootstrap-select--solid" id="m_form_type" tabindex="-98">
														<option value="">
															All
														</option>
														<option value="1">
															Online
														</option>
														<option value="2">
															Retail
														</option>
														<option value="3">
															Direct
														</option>
													</select>
												</div>
											</div>
										</div>
										<div class="d-md-none m--margin-bottom-10"></div>
									</div>
									<div class="col-md-4">
										<div class="m-input-icon m-input-icon--left">
											<input class="form-control m-input m-input--solid" id="m_form_search" placeholder="Search..." type="text"> <span class="m-input-icon__icon m-input-icon__icon--left"><span><i class="la la-search"></i></span></span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-4 order-1 order-xl-2 m--align-left">
								<a href="#" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
									<span><i class="la la-search"></i><span>Ara</span></span>
								</a>
								<div class="m-separator m-separator--dashed d-xl-none"></div>
							</div>
						</div>
					</div>
							-->
					<!--end: Search Form -->
					<!--begin: Datatable -->
					<div class="m_datatable m-datatable m-datatable--default m-datatable--loaded" id="local_data" style="position: static; zoom: 1;">
						<table class="table m-table m-table--head-bg-primary">
							<thead>
								<tr>
									<th>#</th>
									<th>Ürün</th>
									<th>Dil</th>
									<th>Ad Soyad</th>
									<th>Tel</th>
									<th>Durum</th>
									<th>Tarih</th>
									<th>Ayrıntılar</th>
									<th>Yanıtla</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($list as $key => $val) { ?>
									<tr>
										<td><?=$val->Id?></td>
										<td><?=$val->product_id?></td>
										<td><?=$val->lang_name?></td>
										<td><?=$val->user_name?></td>
										<td><?=$val->user_gsm?></td>
										<td>
											<?php if ($val->offer_status == 0) { ?>
												<span><span class="m-badge m-badge--danger m-badge--wide">Teklif Bekliyor</span></span>
											<?php } else{ ?>
												<span><span class="m-badge m-badge--success m-badge--wide">Teklif Gönderildi</span></span>
											<?php } ?>
										</td>	
										<td><?=dateparse($val->offer_time)?></td>
										<td>
											<button type="button" class="btn m-btn--pill m-btn--air btn-warning" data-toggle="modal" data-target="#ayrıntı_modal_<?=$val->Id?>">Ayrıntılar</button>
										</td>
										<td>
											<?php if ($val->offer_status == 0) { ?>
												<button type="button" class="btn m-btn--pill m-btn--air btn-success" data-toggle="modal" data-target="#fiyat_modal<?=$val->Id?>">Teklife Cevap Ver</button>
											<?php } ?>
										</td>
									</tr>

									<!-- Modal -->
									<div class="modal fade" id="fiyat_modal<?=$val->Id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
										<div class="modal-dialog modal-md" role="document">
											<form action="<?=site_url('Admin/Offer/OfferReturn/'.$val->Id)?>" method="POST">
												<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title" id="exampleModalLabel">
																Teklif Cevapla - Teklif No : <?=$val->Id?>
															</h5>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">
																	×
																</span>
															</button>
														</div>
														<div class="modal-body">
															<div class="form-group">
																<label for="recipient-name" class="form-control-label">
																	Teklif Tutarı
																</label>
																<input type="number" step="0.01" class="form-control" name="offerTutar">
																<input type="hidden" name="user_name" value="<?=$val->user_name?>">
																<input type="hidden" name="user_mail" value="<?=$val->user_mail?>">
															</div>
															<div class="form-group">
																<label for="message-text" class="form-control-label">
																	Mesaj :
																</label>
																<textarea class="form-control" name="offerMsg"></textarea>
															</div>
															<div class="col-12 m--padding-left-30 m--padding-right-30">
															<label>
																Resim
															</label>
															<div class="m-dropzone dropzone m-dropzone--primary dz-clickable" action="<?=site_url('Admin/Offer/ImageUpload/')?>" id="m-dropzone-one">
																<div class="m-dropzone__msg dz-message needsclick">
																	<h3 class="m-dropzone__msg-title">
																	Resim Yükle
																	</h3>
																	<span class="m-dropzone__msg-desc">
																		<i class="fa fa-picture-o"></i>
																	</span>
															</div>
															</div>
														</div>
														</div>
														<div class="modal-footer">
															<input type="submit" class="btn btn-primary m-btn--air" value="Teklifi Gönder">
														</div>
												</div>
											</form>
										</div>
									</div>

									<div class="modal fade" id="ayrıntı_modal_<?=$val->Id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
										<div class="modal-dialog modal-lg" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">
														Ayrıntılar - Teklif No : <?=$val->Id?>
													</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">
															×
														</span>
													</button>
												</div>
												<div class="modal-body">
													<form>
														<div class="form-group">
															<?php if ($val->offer_status == 0) { ?>
																<span><span class="m-badge m-badge--danger m-badge--wide">Teklif Bekliyor</span></span>
															<?php } else{ ?>
																<span><span class="m-badge m-badge--success m-badge--wide">Teklif Gönderildi</span></span>
															<?php } ?>
														</div>
														<div class="form-group">
															<label for="recipient-name" class="form-control-label">
																Dil :
															</label>
															<input type="text" class="form-control" value="<?=$val->lang_name?>" disabled>
														</div>
														<div class="form-group">
															<label for="recipient-name" class="form-control-label">
																E-Posta :
															</label>
															<input type="text" class="form-control" value="<?=$val->user_mail?>" disabled>
														</div>
														<div class="form-group">
															<label for="recipient-name" class="form-control-label">
																Ürün No :
															</label>
															<input type="text" class="form-control" value="<?=$val->product_id?>" disabled>
														</div>
														<div class="form-group">
															<label for="recipient-name" class="form-control-label">
																Ürün Adı :
															</label>
															<input type="text" class="form-control" value="<?=$val->product_title?>" disabled>
														</div>
														<div class="form-group">
															<label for="recipient-name" class="form-control-label">
																Teklif Tipi :
															</label>
															<input type="text" class="form-control" value="<?=$val->user_offer_type?>" disabled>
														</div>
														<div class="form-group">
															<label for="recipient-name" class="form-control-label">
																Ad Soyad :
															</label>
															<input type="text" class="form-control" value="<?=$val->user_name?>" disabled>
														</div>
														<div class="form-group">
															<label for="recipient-name" class="form-control-label">
																Tel
															</label>
															<input type="text" class="form-control" value="<?=$val->user_gsm?>" disabled>
														</div>
														<div class="form-group">
															<label for="recipient-name" class="form-control-label">
																Teklif Mesajı
															</label>
															<textarea disabled class="form-control" cols="30" rows="10"><?=$val->user_offer_text?></textarea>
														</div>
														<div class="form-group">
															<label for="recipient-name" class="form-control-label">
																Yön
															</label>
															<input type="text" class="form-control" value="<?=$val->user_direction?>" disabled>
														</div>
														<div class="form-group">
															<label for="recipient-name" class="form-control-label">
																Adet
															</label>
															<input type="text" class="form-control" value="<?=$val->user_count?>" disabled>
														</div>
														<div class="form-group">
															<label for="recipient-name" class="form-control-label">
																Ek Dosya  :
															</label>
															<div style="margin-left: 10px;">
																<?php
																$i =0;
																if ($val->user_file) {
																 	foreach (json_decode($val->user_file) as $key2 => $val2) {
																		$i++;
																		?>
																		<a download="<?=site_url($val2)?>" href="<?=site_url($val2);?>" title="ImageName">
																			İndir Parça <?=$i?>
																		</a> , 
																	<?php }
																} ?> 
															</div>
														</div>
														<div class="form-group">
															<label for="recipient-name" class="form-control-label">
																Teklif Tarihi
															</label>
															<input type="text" class="form-control" value="<?=dateparse($val->offer_time)?>" disabled>
														</div>
														<div class="form-group">
															<label for="recipient-name" class="form-control-label">
																Cevaplanan Zaman
															</label>
															<input type="text" class="form-control" value="<?=$val->status_time?>" disabled>
														</div>
														<div class="form-group">
															<label for="recipient-name" class="form-control-label">
																Teklif Edilen Fiyat
															</label>
															<input type="text" class="form-control" value="<?=$val->offer_price?>" disabled>
														</div>
													</form>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">
														Kapat
													</button>
													<?php if ($val->offer_status == 0) { ?>
														<button type="button" class="btn btn-success" data-dismiss="modal" data-toggle="modal" data-target="#fiyat_modal<?=$val->Id?>">
															Teklifi Cevapla
														</button>
													<?php } ?>
												</div>
											</div>
										</div>
									</div>
									<!-- Modal -->
								<?php } ?>
							</tbody>
						</table>
						<!--Sayfalama-->
						<div class="m-datatable__pager m-datatable--paging-loaded clearfix">
							<ul class="m-datatable__pager-nav">
								<li>
									<a href="?s=1" class="m-datatable__pager-link m-datatable__pager-link--first m-datatable__pager-link--disabled" title="First"><i class="la la-angle-double-left"></i></a>
								</li>
								<li>
									<a href="<?=site_url('Admin/Product'.'?s='.$prevPage)?>" class="m-datatable__pager-link m-datatable__pager-link--prev m-datatable__pager-link--disabled" title="Previous"><i class="la la-angle-left"></i></a>
								</li>
								<?php for ($i=1; $i < $pageCount+1 ; $i++) { ?>
									<li style="">
										<a href="?s=<?=$i?>" class="m-datatable__pager-link m-datatable__pager-link-number <?=($selectedPage==$i)?'m-datatable__pager-link--active':''?>"><?=$i?></a>
									</li>
								<?php } ?>
									<li>
										<a href="<?=site_url('Admin/Product'.'?s='.$nextPage)?>" class="m-datatable__pager-link m-datatable__pager-link--next" title="Next"><i class="la la-angle-right"></i></a>
									</li>
									<li>
										<a href="<?=site_url('Admin/Product'.'?s='.ceil($pageCount))?>" class="m-datatable__pager-link m-datatable__pager-link--last" title="Last"><i class="la la-angle-double-right"></i></a>
									</li>
							</ul>
						</div>
						<!--Sayfalama-->
					</div><!--end: Datatable -->
				</div>
			</div>
		</div>
	</div>
</div>
