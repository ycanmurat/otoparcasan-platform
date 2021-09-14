<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Ürün Listele
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
							Ürün Listele
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
				<div class="m-portlet__body">
					<!--begin: Search Form -->
					<div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
						<form method="GET" action="<?=admin_url('Product')?>?s=1">
							<div class="row align-items-center">
								<div class="col-xl-8 order-2 order-xl-1">
									<div class="form-group m-form__group row align-items-center">
										<div class="col-md-4">
											<div class="m-form__group m-form__group--inline">
												<div class="m-form__label">
													<label>Durum:</label>
												</div>
												<div class="m-form__control">
													<select class="form-control form-control-sm m-input" name="status">
														<option value="">
															Seçiniz
														</option>
														<option value="1" <?=($this->input->get('status', true)=="1")?'selected':''?>>
															Açık
														</option>
														<option value="0" <?=($this->input->get('status', true)=="0")?'selected':''?>>
															Kapalı
														</option>
													</select>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<input class="form-control form-control-sm m-input" type="text" name="product_name" placeholder="Ürün İsmi" value="<?=$this->input->get('product_name', true)?>"/>
										</div>
										<input type="hidden" name="s" value="1">
										<div class="col-md-2">
											<button type="submit" class="btn m-btn--air btn-info btn-sm"><i class="la la-search"></i>Ara</button>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div><!--end: Search Form -->
					<!--begin: Datatable -->
					<div class="m_datatable m-datatable m-datatable--default m-datatable--loaded">
						<div class="m-datatable__pager m-datatable--paging-loaded clearfix">
							<ul class="m-datatable__pager-nav" style="margin-bottom: 10px;">
								<li><a title="First" class="m-datatable__pager-link m-datatable__pager-link--first m-datatable__pager-link--disabled"><i class="la la-angle-double-left"></i></a></li>
								<li><a title="Previous" class="m-datatable__pager-link m-datatable__pager-link--prev m-datatable__pager-link--disabled"><i class="la la-angle-left"></i></a></li>
								<li style="display: none;"><a title="More pages" class="m-datatable__pager-link m-datatable__pager-link--more-prev"><i class="la la-ellipsis-h"></i></a></li>
								<li style="display: none;">
									<input type="text" class="m-pager-input form-control" title="Page number">
								</li>
								<li style=""><a class="m-datatable__pager-link m-datatable__pager-link-number m-datatable__pager-link--active">1</a></li>
								<li style=""><a class="m-datatable__pager-link m-datatable__pager-link-number">2</a></li>
								<li style="display: none;"><a title="More pages" class="m-datatable__pager-link m-datatable__pager-link--more-next"><i class="la la-ellipsis-h"></i></a></li>
								<li><a title="Next" class="m-datatable__pager-link m-datatable__pager-link--next"><i class="la la-angle-right"></i></a></li>
								<li><a title="Last" class="m-datatable__pager-link m-datatable__pager-link--last"><i class="la la-angle-double-right"></i></a></li>
							</ul>
							<table class="table m-table m-table--head-bg-primary table-responsive">
								<thead>
									<tr>
										<th style="text-align: center">Ürün <br>Resim</th>
										<th style="text-align: center">Stok <br>Kodu</th>
										<th style="text-align: center">Stok <br>Adı</th>
										<th style="text-align: center">Ürün <br>Marka</th>
										<th style="text-align: center">Ürün <br>Kategori</th>
										<th style="text-align: center">Montaj <br>Yeri</th>
										<th style="text-align: center">Kayıt <br>Tarihi</th>
										<th style="text-align: center">Ölçü <br>Birimi</th>
										<th style="text-align: center">Paket <br>Adeti</th>
										<th style="text-align: center">Alış/Satış <br>KDV</th>
										<th style="text-align: center">Satış <br>Durumu</th>
										<th style="text-align: center">İşlem<br>Yap</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td style="text-align: center"><img src="https://fakeimg.pl/50/"></td>
										<td style="text-align: center">KOD12313123123</td>
										<td style="text-align: center">Fren Takımı</td>
										<td style="text-align: center">Ford</td>
										<td style="text-align: center">Fren ve Debriyaj > Fren > Abs Sensörü</td>
										<td style="text-align: center">Ön</td>
										<td style="text-align: center">06/12/2019 - 14:55</td>
										<td style="text-align: center">Adet</td>
										<td style="text-align: center">2</td>
										<td style="text-align: center">18% / 18%</td>
										<td style="text-align: center">Aktif</td>
										<td style="text-align: center">
											<div class="dropdown d-inline">
												<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding: 5px;">
													İşlem
												</button>
												<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="cursor:pointer;">
													<a class="dropdown-item">Düzenle</a>
													<a href="supply-information" class="dropdown-item" data-toggle="modal" data-target="#supply-information">Tedarik Bilgisi</a>
													<a class="dropdown-item">Fiyat Bilgisi</a>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td style="text-align: center"><img src="https://fakeimg.pl/50/"></td>
										<td style="text-align: center">KOD12313123123</td>
										<td style="text-align: center">Fren Takımı</td>
										<td style="text-align: center">Ford</td>
										<td width="1000">Fren ve Debriyaj > Fren > Abs Sensörü</td>
										<td style="text-align: center">Ön</td>
										<td style="text-align: center">06/12/2019 - 14:55</td>
										<td style="text-align: center">Adet</td>
										<td style="text-align: center">2</td>
										<td style="text-align: center">18% / 18%</td>
										<td style="text-align: center">Aktif</td>
										<td style="text-align: center">
											<div class="dropdown d-inline">
												<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding: 5px;">
													İşlem
												</button>
												<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="cursor:pointer;">
													<a class="dropdown-item">Düzenle</a>
													<a href="supply-information" class="dropdown-item" data-toggle="modal" data-target="#supply-information">Tedarik Bilgisi</a>
													<a class="dropdown-item">Fiyat Bilgisi</a>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td style="text-align: center"><img src="https://fakeimg.pl/50/"></td>
										<td style="text-align: center">KOD12313123123</td>
										<td style="text-align: center">Fren Takımı</td>
										<td style="text-align: center">Ford</td>
										<td style="text-align: center" width="1000">Fren ve Debriyaj > Fren > Abs Sensörü</td>
										<td style="text-align: center">Ön</td>
										<td style="text-align: center">06/12/2019 - 14:55</td>
										<td style="text-align: center">Adet</td>
										<td style="text-align: center">2</td>
										<td style="text-align: center">18% / 18%</td>
										<td style="text-align: center">Aktif</td>
										<td style="text-align: center">
											<div class="dropdown d-inline">
												<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding: 5px;">
													İşlem
												</button>
												<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="cursor:pointer;">
													<a class="dropdown-item">Düzenle</a>
													<a href="supply-information" class="dropdown-item" data-toggle="modal" data-target="#supply-information">Tedarik Bilgisi</a>
													<a class="dropdown-item">Fiyat Bilgisi</a>
												</div>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div><!--end: Datatable -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="supply-information" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">
						Tedarik Bilgisi
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">
							&times;
						</span>
					</button>
				</div>
				<div class="modal-body">
					<table class="table table-bordered m-table m-table--border-primary table-responsive">
						<thead>
							<tr>
								<th>
									Tedarikçi<br>Adı
								</th>
								<th>
									Tedarikçi<br>Kodu
								</th>
								<th>
									Satıcı Stok<br>Kodu
								</th>
								<th>
									Satıcı Stok<br>Adı
								</th>
								<th>
									Alış Para<br>Birimi
								</th>
								<th>
									Alış<br>Fiyatı
								</th>
								<th>
									Satış Para<br>Birimi
								</th>
								<th>
									Satış<br>Fiyatı
								</th>
								<th>
									İndirim<br>%
								</th>
								<th>
									Kar Marjı<br>%
								</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th scope="row">
									Başbuğ Otomotiv
								</th>
								<td>
									320.34.0011
								</td>
								<td>
									123.123.543
								</td>
								<td>
									KOD
								</td>
								<td>
									TL
								</td>
								<td>
									145 TL
								</td>
								<td>
									TL
								</td>
								<td>
									245 TL
								</td>
								<td>
									5 %
								</td>
								<td>
									10 %
								</td>
							</tr>
							<tr>
								<th scope="row">
									Başbuğ Otomotiv
								</th>
								<td>
									320.34.0011
								</td>
								<td>
									123.123.543
								</td>
								<td>
									KOD
								</td>
								<td>
									TL
								</td>
								<td>
									145 TL
								</td>
								<td>
									TL
								</td>
								<td>
									245 TL
								</td>
								<td>
									5 %
								</td>
								<td>
									10 %
								</td>
							</tr>
							<tr>
								<th scope="row">
									Başbuğ Otomotiv
								</th>
								<td>
									320.34.0011
								</td>
								<td>
									123.123.543
								</td>
								<td>
									KOD
								</td>
								<td>
									TL
								</td>
								<td>
									145 TL
								</td>
								<td>
									TL
								</td>
								<td>
									245 TL
								</td>
								<td>
									5 %
								</td>
								<td>
									10 %
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">
						Kapat
					</button>
				</div>
			</div>
		</div>
	</div>