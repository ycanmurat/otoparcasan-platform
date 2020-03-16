					<div class="m-subheader ">
						<div class="d-flex align-items-center">
							<div class="mr-auto">
								<h3 class="m-subheader__title m-subheader__title--separator">
									Yeni Yönetici Kullanıcı Ekleyin
								</h3>
								<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
									<li class="m-nav__item m-nav__item--home">
										<a href="<?=admin_url()?>" class="m-nav__link m-nav__link--icon">
											<i class="m-nav__link-icon la la-home"></i>
										</a>
									</li>
									<li class="m-nav__separator">
									</li>
									<li class="m-nav__item">
										<a href="<?=admin_url('AdminUserEdit')?>" class="m-nav__link">
											<span class="m-nav__link-text">
												Yönetici Kullanıcılar
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
													Bilgileri Eksiksiz Doldurup Yeni Yönetici Ekleyin 
												</h3>
											</div>
										</div>
									</div>
									<form class="m-form m-form--fit m-form--label-align-right" action="<?=admin_url('AdminUserEdit/newAdminAdd')?>" method="POST">
										<div class="m-portlet__body">
											<div class="m-form__section m-form__section--first">
												<?if($is_there == 0){?>
												<div class="alert alert-danger alert-dismissible fade show   m-alert m-alert--air" role="alert" style="margin-left: 20px;margin-right: 20px">
													<button type="button" class="close" data-dismiss="alert" aria-label="Kapat"></button>
													<strong>
														Başarısız : 
													</strong>
													Bu Mail Adresiyle Kayıtlı Başka Bir Yönetici Var
												</div>
												<?}elseif($admin_add_true == 1){?>
												<div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-left: 20px;margin-right: 20px">
													<button type="button" class="close" data-dismiss="alert" aria-label="Kapat"></button>
													<strong>
														Başarılı :
													</strong>
														Yeni Yönetim Kullanıcısı Başarıyla Eklendi
												</div>
												<?}elseif($admin_add_true == 0){?>
												<div class="alert alert-danger alert-dismissible fade show   m-alert m-alert--air" role="alert" style="margin-left: 20px;margin-right: 20px">
													<button type="button" class="close" data-dismiss="alert" aria-label="Kapat"></button>
													<strong>
														Başarısız : 
													</strong>
														Şuanda Yönetim Kullanıcı Eklenemiyor Lütfen Geliştiricinize Başvurun
												</div>
												<?}?>
												<div class="form-group m-form__group">
													<label>
														Kullanıcı Adı
													</label>
													<input type="text" class="form-control m-input" name="user_name" placeholder="Kullanıcı Adı" required="">
												</div>
												<div class="form-group m-form__group">
													<label>
														E-Posta
													</label>
													<input type="email" class="form-control m-input" name="user_mail" placeholder="E-Posta" required="">
												</div>
												<div class="form-group m-form__group">
													<label>
														Şifre
													</label>
													<input type="password" class="form-control m-input" name="pass" placeholder="Şifre" required="">
												</div>
												<div class="form-group m-form__group">
													<label>
														Telefon Numarası
													</label>
													<input type="number" class="form-control m-input" name="user_gsm" placeholder="Telefon Numarası" required="">
												</div>
												<div class="form-group m-form__group">
													<label>
														Yetki
													</label>
													<select class="form-control m-input" name="auth" required="">
														<option value="">Yönetici Yetkisini Seçin</option>
														<option value="0">Tüm Yetkiler</option>
														<option value="2">Dil ve Çeviri Yetkisi</option>
														<option value="3">Ürün ve Sipariş Yetkisi</option>
													</select>
												</div>
												
											</div>
										</div>
										<div class="m-portlet__foot m-portlet__foot--fit">
											<div class="m-form__actions m-form__actions">
												<div class="row">
													<div class="col-lg-6"></div>
													<div class="col-lg-6 text-right">
														<button type="submit" class="btn btn-primary">
															Yönetici Ekle
														</button>
														<button type="button" class="btn btn-secondary" onclick="window.location = '<?=admin_url('AdminUserEdit')?>'">
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