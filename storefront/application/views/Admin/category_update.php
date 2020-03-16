					<div class="m-subheader ">
						<div class="d-flex align-items-center">
							<div class="mr-auto">
								<h3 class="m-subheader__title m-subheader__title--separator">
									Kategori Düzenle
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
										<a href="<?=admin_url('category')?>" class="m-nav__link">
											<span class="m-nav__link-text">
												Kategoriler
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
									<form class="m-form m-form--fit m-form--label-align-right" action="<?=admin_url('Category/update/'.$categories[0]->category_id)?>" method="POST">
										<div class="m-portlet__body">
											<div class="m-form__section m-form__section--first">
												<?php if (@$sonuc[0] != ""): ?>
													<div class="alert alert-<?=$sonuc[1]?> alert-dismissible fade show" style="margin-left: 20px;margin-right: 20px" role="alert">
														<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
														<?=$sonuc[0]?>
													</div>
												<?php endif ?>
												<div class="form-group m-form__group">
													<label for="category_heading">
														Etiket
													</label>
													<input type="text" class="form-control m-input" name="tag" id="category_heading" placeholder="Etiket" value="<?=$categories[0]->category_title?>" required="true">
												</div>
												<div class="form-group m-form__group">
													<label for="category_heading">
														Sıra
													</label>
													<input type="text" class="form-control m-input" name="sort" id="category_heading" placeholder="Sıra" value="<?=$categories[0]->sort?>" required="true">
												</div>
												<div class="m-form__group form-group">
													<label for="">
														Menüde
													</label>
													<div class="m-radio-list">
														<label class="m-radio">
															<input type="radio" name="menu" value="1" <?=($categories[0]->menu == 1)?'checked="true"':''?>>
																Var
															<span></span>
														</label>
														<label class="m-radio">
															<input type="radio" name="menu" value="0" <?=($categories[0]->menu == 0)?'checked="true"':''?>>
																Yok
															<span></span>
														</label>
													</div>
												</div>
												<div class="m-form__group form-group">
													<label for="">
														Keşfette
													</label>
													<div class="m-radio-list">
														<label class="m-radio">
															<input type="radio" name="exp" value="1" <?=($categories[0]->explore == 1)?'checked="true"':''?>>
																Var
															<span></span>
														</label>
														<label class="m-radio">
															<input type="radio" name="exp" value="0" <?=($categories[0]->explore == 0)?'checked="true"':''?>>
																Yok, Olmasın
															<span></span>
														</label>
													</div>
												</div>
												<?php foreach ($categories as $val): ?>
													<div class="form-group m-form__group">
														<label for="category_heading_<?=$val->Id?>">
															Ürün Adı <?=$val->lang_name?>
														</label>
														<?php
														if ($val->lang_id) {
															$langname = "lang";
															$val->lang_id = $val->lang_id;
														} else {
															$langname = "newlang";
															$val->lang_id = $val->newlang_id;
														}
														?>
														<input type="text" class="form-control m-input" name="<?=$langname?>[<?=$val->lang_id?>]" id="category_heading_<?=$val->lang_id?>" value="<?=$val->name?>" placeholder="Başlık" required="true">
													</div>
													<div class="form-group m-form__group">
														<label for="category_heading_<?=$val->Id?>">
															Url <?=$val->lang_name?>
														</label>
														<input type="text" class="form-control m-input" name="category_slug[<?=$val->lang_id?>]" id="category_slug_<?=$val->Id?>" value="<?=$val->category_slug?>" placeholder="Başlık" required="true">
													</div>
												<?php endforeach ?>
											</div>
										</div>
										<div class="m-portlet__foot m-portlet__foot--fit">
											<div class="m-form__actions m-form__actions">
												<div class="row">
													<div class="col-lg-6"></div>
													<div class="col-lg-6 text-right">
														<button type="submit" class="btn btn-primary">
															Düzenle
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