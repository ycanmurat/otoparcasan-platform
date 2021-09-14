<!-- BAŞLIK -->
<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Üyeler
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
									<th>Ad Soyad</th>
									<th>E-Posta</th>
									<th>Telefon</th>
									<th>Kayıt Tarihi</th>
									<th>İşlevler</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($users as $key => $val) { ?>
									<tr>
										<td><?=$val->id?></td>
										<td><?=$val->name?></td>
										<td><?=$val->email?></td>
										<td><?=$val->phone?></td>
										<td><span><?=$val->added_time?></span></td>
										<td>
											<div class="dropdown">
												<button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													İşlemler
												</button>
												<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
													<a class="dropdown-item" href="<?=site_url('Admin/User/Address/'.$val->id)?>">Adresler</a>
													<a class="dropdown-item" href="<?=site_url('Admin/User/Update/'.$val->id)?>">Düzenle</a>
													<a class="dropdown-item" href="<?=site_url('Admin/Transfer/ibanList')?>">IBAN Bilgileri</a>
													<a class="dropdown-item" href="<?=site_url('Admin/Transfer/transferList')?>">Havale Ödeme Yönetimi</a>
													<a href="javascript:void(0);" class="dropdown-item bg-danger text-white" onclick="deleteConfirm('<?=site_url('Admin/User/Delete/'.$val->id.'?s='.$selectedPage)?>')">Sil</a>
												</div>
											</div>
										</td>
									</tr>	
								<?php } ?>
							</tbody>
						</table>
						<!--Sayfalama-->
						<div class="m-datatable__pager m-datatable--paging-loaded clearfix">
							<ul class="m-datatable__pager-nav">
								<li>
									<a href="<?=site_url('Admin/User'.'?s=1')?>" class="m-datatable__pager-link m-datatable__pager-link--first m-datatable__pager-link--disabled" title="First"><i class="la la-angle-double-left"></i></a>
								</li>
								<li>
									<a href="<?=site_url('Admin/User'.'?s='.$prevPage)?>" class="m-datatable__pager-link m-datatable__pager-link--prev m-datatable__pager-link--disabled" title="Previous"><i class="la la-angle-left"></i></a>
								</li>
								<?php for ($i=1; $i < $pageCount+1 ; $i++) { ?>
									<li style="">
										<a href="?s=<?=$i?>" class="m-datatable__pager-link m-datatable__pager-link-number <?=($selectedPage==$i)?'m-datatable__pager-link--active':''?>"><?=$i?></a>
									</li>
								<?php } ?>
								<li>
									<a href="<?=site_url('Admin/User'.'?s='.$nextPage)?>" class="m-datatable__pager-link m-datatable__pager-link--next" title="Next"><i class="la la-angle-right"></i></a>
								</li>
								<li>
									<a href="<?=site_url('Admin/User'.'?s='.ceil($pageCount))?>" class="m-datatable__pager-link m-datatable__pager-link--last" title="Last"><i class="la la-angle-double-right"></i></a>
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