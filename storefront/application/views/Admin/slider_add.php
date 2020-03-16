					<div class="m-subheader ">
						<div class="d-flex align-items-center">
							<div class="mr-auto">
								<h3 class="m-subheader__title m-subheader__title--separator">
									Slider Ekle
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
										<a href="<?=admin_url('Slider')?>" class="m-nav__link">
											<span class="m-nav__link-text">
												Slider
											</span>
										</a>
									</li>
								</ul>
							</div>
							<div>
								<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover" aria-expanded="true">
									<a href="#" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
										<i class="la la-plus m--hide"></i>
										<i class="la la-ellipsis-h"></i>
									</a>
									<div class="m-dropdown__wrapper">
										<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
										<div class="m-dropdown__inner">
											<div class="m-dropdown__body">
												<div class="m-dropdown__content">
													<ul class="m-nav">
														<li class="m-nav__section m-nav__section--first m--hide">
															<span class="m-nav__section-text">
																Örnek
															</span>
														</li>
														<li class="m-nav__separator m-nav__separator--fit"></li>
														<li class="m-nav__item">
															<a href="#" class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">
																Submit
															</a>
														</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="m-content">
						<div class="row">
							<div class="col-lg-12">
								<div class="m-portlet">
									<form class="m-form m-form--fit m-form--label-align-right" action="<?=admin_url('Slider/Add')?>" method="POST">
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
														Sıra
													</label>
													<input type="number" class="form-control m-input" name="sort" placeholder="Sıra" required="true">
												</div>
												<div class="form-group m-form__group">
													<label>
														Link
													</label>
													<input type="text" class="form-control m-input" name="link" placeholder="Link" required="true">
												</div>
												<div class="form-group m-form__group">
													<label>
														Dil
													</label>
													<select class="form-control" name="lang">
														<?php foreach ($langs as $val): ?>
														<option value="<?=$val->id?>"><?=$val->lang_name?></option>
														<?php endforeach ?>
													</select>
												</div>
												<div class="col-12 m--padding-left-30 m--padding-right-30">
													<label>
														Resim
													</label>
													<div class="m-dropzone dropzone m-dropzone--primary dz-clickable" action="<?=site_url('Admin/Slider/ImageUpload/')?>" id="m-dropzone-one">
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
										</div>
										<div class="m-portlet__foot m-portlet__foot--fit">
											<div class="m-form__actions m-form__actions">
												<div class="row">
													<div class="col-lg-6"></div>
													<div class="col-lg-6 text-right">
														<button type="submit" class="btn btn-primary">
															Ekle
														</button>
														<button type="reset" class="btn btn-secondary">
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