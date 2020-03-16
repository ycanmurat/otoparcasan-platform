					<div class="m-subheader ">
						<div class="d-flex align-items-center">
							<div class="mr-auto">
								<h3 class="m-subheader__title m-subheader__title--separator">
									Adres Ekle
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
									<li class="m-nav__item">
										<a href="<?=admin_url('User/Address/'.$user->Id)?>" class="m-nav__link">
											<span class="m-nav__link-text">
												Üye
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
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text">
													<?=$user->name?>
												</h3>
											</div>
										</div>
									</div>
									<form class="m-form m-form--fit m-form--label-align-right" action="<?=admin_url('User/AddAddress/'.$user->Id)?>" method="POST">
										<div class="m-portlet__body">
											<div class="m-form__section m-form__section--first">
												<?php if (@$sonuc[0] != ""): ?>
													<div class="alert alert-<?=$sonuc[1]?> alert-dismissible fade show" style="margin-left: 20px;margin-right: 20px" role="alert">
														<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
														<?=$sonuc[0]?>
													</div>
												<?php endif ?>
												<div class="form-group m-form__group">
													<label>
														Adres Adı
													</label>
													<input type="text" class="form-control m-input" name="definition" placeholder="Adres Adı">
												</div>
												<div class="form-group m-form__group">
													<label>
														Ad Soyad
													</label>
													<input type="text" class="form-control m-input" name="name" placeholder="Ad Soyad">
												</div>
												<div class="form-group m-form__group">
													<label>
														Adres
													</label>
													<textarea class="form-control m-input" name="content" placeholder="Adres" rows="4"></textarea>
												</div>
												<div class="form-group m-form__group">
													<label>
														Ülke
													</label>
													<select class="form-control m-input" name="country">
														<option value="">Ülke Seçiniz</option>
														<option value="4">Türkiye</option>
														<option value="3">Almanya</option>
													</select>
												</div>
												<div class="form-group m-form__group">
													<label>
														Şehir
													</label>
													<select class="form-control m-input" name="city">
														<option value="">Şehir Seçiniz</option>
														<option value="34">İstanbul</option>
														<option value="55">Samsun</option>
													</select>
												</div>
												<div class="form-group m-form__group">
													<label>
														İlçe
													</label>
													<input type="text" class="form-control m-input" name="town" placeholder="İlçe">
												</div>
												<div class="form-group m-form__group">
													<label>
														Posta Kodu
													</label>
													<input type="text" class="form-control m-input" name="post_code" placeholder="Posta Kodu">
												</div>
												<div class="form-group m-form__group">
													<label>
														Telefon
													</label>
													<input type="text" class="form-control m-input" name="gsm" placeholder="Telefon">
												</div>
											</div>
										</div>
										<div class="m-portlet__foot m-portlet__foot--fit">
											<div class="m-form__actions m-form__actions">
												<div class="row">
													<div class="col-lg-6"></div>
													<div class="col-lg-6 text-right">
														<button type="submit" class="btn btn-primary">
															Kaydet
														</button>
														<button type="button" class="btn btn-secondary" onclick="window.location = '<?=admin_url('User/Address/'.$user->Id)?>'">
															İptal
														</button>
													</div>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>