<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Araç Ağacı
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
					<a href="<?=admin_url()?>" class="m-nav__link">
						<span class="m-nav__link-text">
							Anasayfa
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
				<form class="m-form m-form--fit m-form--label-align-right" action="<?=admin_url('Aracagaci/add')?>" method="POST">
					<div class="m-portlet__body">
						<div class="m-form__section m-form__section--first">
							<div class="row" style="color:red">
								<div class="col-md-1"></div>
								<div class="col-md-7">İsim</div>
								<div class="col-md-2">Durum</div>

								<?php if (isset($brand)) { ?>
									<div class="col-md-2">Popüler</div>
								<?php } ?>
							</div>
							<div class="form-group m-form__group">
								<?php foreach ($selects as $key => $val) { ?>
									<input type="hidden" name="<?=$key?>" value="<?=$val?>">
								<?php } ?>
								<?php foreach ($list as $key => $val) { ?>
									<div class="row">
										<div class="col-md-12">
											<label for=""><?=($first ? $val['value'] : $val->name)?></label>
										</div>
										<div class="col-md-8">
											<input type="text" class="form-control" id="list_<?=$key?>" name="list[<?=($first ? $val['key'] : $val->key)?>]" value="<?=($first ? $val['value'] : $val->name)?>"/>
										</div>
										<div class="col-md-2">
											<span class="m-switch m-switch--outline m-switch--icon m-switch--success">
												<label>
													<input type="checkbox" <?=($first ? 'checked="checked"' : ($val->status == 1 ? 'checked="checked"':'') )?>  name="status[<?=($first?$val['key']:$val->key)?>]">
													<span></span>
												</label>
											</span>
										</div>
										<?php if (isset($brand)) { ?>
											<div class="col-md-2">
												<span class="m-switch m-switch--outline m-switch--icon m-switch--success">
													<label>
														<input type="checkbox" <?=(!$first ? ($val->popilar == 1 ? 'checked="checked"':'') : '')?>  name="popilar[<?=($first?$val['key']:$val->key)?>]">
														<span></span>
													</label>
												</span>
											</div>
										<?php } ?>
										<?php if (isset($image)) { ?>
											<div class="col-6 m--padding-left-30 m--padding-right-30">
												<label for="">Yüklü Fotoğraf</label> <br>
												<?php foreach ($images as $key2 => $val2) { ?>
													<?php if ($val2->model == ($first?$val['key']:$val->key)) {  ?>
														<img width="250" src="<?=site_url($val2->img)?>" alt="">
													<?php 	break;
													} ?>
												<?php } ?>
											</div>
											<div class="col-6 m--padding-left-30 m--padding-right-30">
												<div class="m-dropzone dropzone m-dropzone--primary dz-clickable" action="<?=admin_url('Aracagaci/image/'.$selects->carType.'/'.$selects->carBrands.'/'.($first?$val['key']:$val->key))?>" id="m-dropzone-one">
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
										<?php } ?>
									</div>
									<br>
									<hr>
									<br>
								<?php } ?>
							</div>

						</div>
					</div>
					<div class="m-portlet__foot m-portlet__foot--fit">
						<div class="m-form__actions m-form__actions">
							<div class="row">
								<div class="col-lg-6"></div>
								<div class="col-lg-6 text-right">
									<button type="submit" class="btn btn-primary">
										Listele
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