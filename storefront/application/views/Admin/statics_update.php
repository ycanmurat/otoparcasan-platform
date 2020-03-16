<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Statik Sayfa Oluştur
			</h3>
			<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
				<li class="m-nav__item m-nav__item--home">
					<a href="<?=site_url()?>Admin/" class="m-nav__link m-nav__link--icon">
						<i class="m-nav__link-icon la la-home"></i>
					</a>
				</li>
				<li class="m-nav__separator">
					-
				</li>
				<li class="m-nav__item">
					<a href="<?=admin_url('Statics')?>" class="m-nav__link">
						<span class="m-nav__link-text">
							Statik Sayfalar
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
				<form class="m-form m-form--fit m-form--label-align-right" method="POST" action="<?=site_url('Admin/Statics/SetUpdate/'.$id)?>">
					<div class="m-portlet__body">
						<div class="m-form__section m-form__section--first">
							<?php 
								if ($this->session->flashdata('okey') == 1) { ?>
									<div class="alert alert-success alert-dismissible fade show" style="margin-left: 20px;margin-right: 20px" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
										<strong>
											Tebrikler!
										</strong>
										Statik Sayfa Güncellendi.
									</div>
							<?php } ?>
							<?php 
								if ($this->session->flashdata('hata') == 1) { ?>
									<div class="alert alert-danger alert-dismissible fade show" style="margin-left: 20px;margin-right: 20px" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
										<strong>
											Üzügmüm!
										</strong>
										Statik Sayfa Güncellenirken Bir Hata Oluştu.
									</div>
							<?php } ?>

							<div class="form-group m-form__group">
								<label for="category_heading">
									Sayfa Etiketi (Takma Ad Görüntülenmeyecek)
								</label>
								<input type="text" value="<?=$List[0]->page_title?>" class="form-control m-input" name="title" placeholder="Sayfa Etiketi">
							</div>

							<?php foreach ($List as $key => $val) { ?>
								<div class="form-group m-form__group">
									<label for="exampleSelect1">
										Sayfa Başlığı - <?=$val->short_code?>
									</label>
									<input type="text" value="<?=$val->page_headline?>" class="form-control m-input" name="baslik[<?=$val->lang_id?>]" placeholder="Başlık">
								</div>

								<div class="form-group m-form__group">
									<label for="exampleSelect1">
										Sayfa İçeriği - <?=$val->short_code?>
									</label>
									<div class="md-editor active">
										<textarea class="form-control md-input" data-provide="markdown" name="content_text[<?=$val->lang_id?>]" rows="10" style="resize: none;"><?=$val->page_content?></textarea>
										<div class="md-fullscreen-controls">
											<a class="exit-fullscreen" href="#" title="Exit fullscreen"><span class="fa fa-compress"></span></a>
										</div>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
					<div class="m-portlet__foot m-portlet__foot--fit">
						<div class="m-form__actions m-form__actions">
							<div class="row">
								<div class="col-lg-2"></div>
								<div class="col-lg-10">
									<button type="submit" class="btn btn-primary pull-right">
										Gönder
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