<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Tasarım Sohbeti
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
					<a href="<?=admin_url('Conversation?s=1')?>" class="m-nav__link">
						<span class="m-nav__link-text">
							Tasarım Sohbetleri
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
											Quick Actions
										</span>
									</li>
									<li class="m-nav__item">
										<a href="" class="m-nav__link">
											<i class="m-nav__link-icon flaticon-share"></i>
											<span class="m-nav__link-text">
												Activity
											</span>
										</a>
									</li>
									<li class="m-nav__item">
										<a href="" class="m-nav__link">
											<i class="m-nav__link-icon flaticon-chat-1"></i>
											<span class="m-nav__link-text">
												Messages
											</span>
										</a>
									</li>
									<li class="m-nav__item">
										<a href="" class="m-nav__link">
											<i class="m-nav__link-icon flaticon-info"></i>
											<span class="m-nav__link-text">
												FAQ
											</span>
										</a>
									</li>
									<li class="m-nav__item">
										<a href="" class="m-nav__link">
											<i class="m-nav__link-icon flaticon-lifebuoy"></i>
											<span class="m-nav__link-text">
												Support
											</span>
										</a>
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
	<div class="m-portlet">
		<div class="m-portlet__head">
			<div class="m-portlet__head-caption">
				<div class="m-portlet__head-title">
					<span class="m-portlet__head-icon">
						<i class="fa fa-commenting-o"></i>
					</span>
					<h3 class="m-portlet__head-text">
						<?=$conversation->name?>
						<small>
							<?=$conversation->product_name?>
						</small>
					</h3>
				</div>
			</div>
			<div class="m-portlet__head-tools">
				<ul class="m-portlet__nav">
					<li class="m-portlet__nav-item">
						<?php if ($conversation->confirm_status == 0){ ?>
							<button type="button" class="m-portlet__nav-link btn btn-success m-btn m-btn--pill m-btn--air" onclick="nextConfirm('<?=site_url('Admin/Conversation/ConfirmStatus/'.$conversation_id)?>')">
								<i class="fa fa-check"></i> Tasarımı Onayla
							</button>
						<?php } else { ?>
							<p class="alert alert-warning p-2 m-2">
								<strong class="text-dark">Tasarım onaylandı</strong>
							</p>
						<?php } ?>
					</li>
				</ul>
			</div>
		</div>
		<div class="m-portlet__body">
			<div class="m-messenger m-messenger--message-arrow m-messenger--skin-light">
				<div class="m-messenger__messages">
				<?php foreach ($lines as $key => $val): ?>
					<div class="m-messenger__datetime">
						<?=$val->added_time?>
					</div>
					<?php if ($val->user_id > 0) { 
						$messageplace = "in";
					} else {
						$messageplace = "out";
					}
					?>
					<div class="m-messenger__message m-messenger__message--<?=$messageplace?>">
						<div class="m-messenger__message-body">
							<div class="m-messenger__message-arrow"></div>
							<div class="m-messenger__message-content">
								<div class="m-messenger__message-text my_messenger_text">
									<?php if ($val->text != ""): ?>
										<div><?=$val->text?></div>
									<?php endif ?>
									<?php if ($val->file != ""): ?>
										<button type="button" class="btn p-0 m-0 border-0 ">
											<?php
												if (isJSON($val->file)){
													$i = 0;
														$images = json_decode($val->file);
														foreach ($images as $key => $value) { 
														$i++; ?>
															<a style="background-color: none;" href="<?=base_url($value)?>" download>İndir Parça <?=$i?></a><br>
														<?php } 
												}else{ ?>
													<a style="background-color: none;" href="<?=base_url($val->file)?>" download>İndir</a>
												<?php } ?>
										</button>
									<?php endif ?>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach ?>
				</div>
				<div class="m-messenger__seperator"></div>
				<?php if ($conversation->confirm_status == 0) { ?>
				<form action="<?=admin_url('Conversation/AddLine/'.$conversation_id)?>" method="POST">
					<div class="row">
						<div class="col-7">
							<div class="m-messenger__form-controls">
								<textarea class="form-control m-input m-input--solid" name="text" placeholder="Açıklama yaz..." rows="8"></textarea>
							</div>
						</div>
						<div class="col-5">
							<div class="m-dropzone dropzone" action="<?=site_url('Admin/Conversation/ImageUpload/'.$conversation_id)?>" id="m-dropzone-one">
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
						<div class="col-12 mt-2"><button type="submit" class="btn btn-primary">Gönder</button></div>
					</div>
				</form>
				<?php } else { /*div class="alert alert-warning" role="alert"><strong style="font-weight: 600;">Bu sohbet sonlandırılmıştır.</strong></div> */
				} ?>
			</div>
		</div>
		<div class="m-portlet__foot m--hide">
			<div class="row">
				<div class="col-lg-6">
					Portlet footer:
				</div>
				<div class="col-lg-6">
					<button type="submit" class="btn btn-primary">
						Submit
					</button>
					<span class="m--margin-left-10">
						or
						<a href="#" class="m-link m--font-bold">
							Cancel
						</a>
					</span>
				</div>
			</div>
		</div>
	</div>
</div>