					
					<!-- BAŞLIK -->
					<div class="m-subheader ">
						<div class="d-flex align-items-center">
							<div class="mr-auto">
								<h3 class="m-subheader__title m-subheader__title--separator">
									Adresler
								</h3>
								<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
									<li class="m-nav__item m-nav__item--home">
										<a href="#" class="m-nav__link m-nav__link--icon">
											<i class="m-nav__link-icon la la-home"></i>
										</a>
									</li>
									<li class="m-nav__separator">
										-
									</li>
									<li class="m-nav__item">
										<a href="<?=admin_url('User')?>" class="m-nav__link">
											<span class="m-nav__link-text">
												Kullanıcılar
											</span>
										</a>
									</li>
								</ul>
							</div>
							<div>
								<div>
									<button type="button" class="btn m-btn--air btn-warning" onclick="window.location = '<?=site_url('Admin/User/AddAddress/'.$user->Id)?>'">Ekle</button>
								</div>
							</div>
						</div>
					</div>
					<!-- BAŞLIK SON -->


					<!-- BURAYA İÇERİK GELECEK (YANİ DİĞER SAYFALARDAN ÇEKECEKLERİN - .m-content class'ının içeriğini alacaksın) -->
					<div class="m-content">
						<?php if (@$sonuc[0] != ""): ?>	
						<div class="row p-0">
							<div class="col-lg-12">
								<div class="m-portlet">
									<div class="m-section">
										<div class="m-section__content">
											<div class="alert alert-<?=$sonuc[1]?> alert-dismissible fade show m-0" style="margin-left: 20px;margin-right: 20px" role="alert">
												<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
												<?=$sonuc[0]?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php endif ?>
						<div class="row">
							<div class="col-lg-12">
								<div class="m-portlet">
									<div class="m-portlet__body">
										<!--begin: Search Form -->
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
										</div><!--end: Search Form -->
										<!--begin: Datatable -->
										<div class="m_datatable m-datatable m-datatable--default m-datatable--loaded" id="local_data" style="position: static; zoom: 1;">
										<table class="table m-table m-table--head-bg-primary">
												<thead>
													<tr>
														<th>#</th>
														<th>Adres Adı</th>
														<th>Adres</th>
														<th>Ad Soyad</th>
														<th>Ülke</th>
														<th>Şehir</th>
														<th>İlçe</th>
														<th>Posta Kodu</th>
														<th>Telefon</th>
														<th colspan="2">İşlevler</th>
													</tr>
												</thead>
												<tbody>
													<?php if (@$address): ?>
														<?php foreach ($address as $key => $val) { ?>
															<tr>
																<td><?=$val->Id?></td>
																<td><?=$val->definition?></td>
																<td><?=$val->content?></td>
																<td><?=$val->name?></td>
																<td><?=$val->country?></td>
																<td><?=$val->city?></td>
																<td><?=$val->town?></td>
																<td><?=$val->post_code?></td>
																<td><?=$val->gsm?></td>
																<td>
																	<button type="button" class="btn m-btn--pill m-btn--air btn-brand" onclick="window.location = '<?=site_url('Admin/User/UpdateAddress/'.$user->Id.'/'.$val->Id)?>'">Düzenle</button></td>
																<td>
																	<button type="button" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" onclick="deleteConfirm('<?=site_url('Admin/User/DeleteAddress/'.$user->Id.'/'.$val->Id)?>')"><i class="la la-trash"></i></button>
																</td>
															</tr>	
														<?php } ?>
													<?php endif ?>
												</tbody>
											</table>
										</div><!--end: Datatable -->
									</div>
								</div>
							</div>
						</div>


					</div>