					<div class="m-subheader ">
						<div class="d-flex align-items-center">
							<div class="mr-auto">
								<h3 class="m-subheader__title m-subheader__title--separator">
									Üye Bilgilerini Düzenle
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
										<a href="<?=admin_url('User')?>" class="m-nav__link">
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
									<form class="m-form m-form--fit m-form--label-align-right" action="<?=admin_url('User/Update/'.$user->Id)?>" method="POST">
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
														Ad ve Soyad
													</label>
													<input type="text" class="form-control m-input" name="name" placeholder="Ad" value="<?=$user->name?>">
												</div>
												<div class="form-group m-form__group">
													<label>
														Cinsiyet
													</label>
													<select class="form-control m-input" name="gender">
														<option value="">Cinsiyet Seçiniz</option>
														<option value="male" <?=($user->gender == "male" ? "selected='true'" : "") ?>>Erkek</option>
														<option value="female" <?=($user->gender == "female" ? "selected='true'" : "") ?>>Kadın</option>
													</select>
												</div>
												<div class="form-group m-form__group">
													<label>
														E-Posta
													</label>
													<input type="text" class="form-control m-input" name="email" placeholder="E-Posta" value="<?=$user->email?>">
												</div>
												<div class="form-group m-form__group">
													<label>
														Telefon
													</label>
													<input type="text" class="form-control m-input" name="phone" placeholder="Telefon" value="<?=$user->phone?>">
												</div>
												<div class="form-group m-form__group">
													<label>
														Şifre
													</label>
													<input type="hidden" class="form-control m-input" name="oldpass" placeholder="Şifre" value="<?=$user->pass?>">
													<input type="text" class="form-control m-input" name="pass" placeholder="Yeni Şifre">
												</div>
												<div class="form-group m-form__group">
													<label>
														Sektör
													</label>
													<input type="text" class="form-control m-input" name="sector" placeholder="Sektör" value="<?=$user->sector?>">
												</div>
												<div class="form-group m-form__group">
													<label>
														E-Posta İzni
													</label>
													<div class="row">
														<div class="col-12">
															<span class="m-switch m-switch--outline m-switch--icon m-switch--success">
																<label>
																	<input type="checkbox" 
																	<?=($user->email_permission==1?'checked="checked"':'')?> name="email_permission">
																	<span></span>
																</label>
															</span>
														</div>
													</div>
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
														<button type="button" class="btn btn-secondary" onclick="window.location = '<?=admin_url('User')?>'">
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