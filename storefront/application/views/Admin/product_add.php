<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Ürün Ekle
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
					<a href="<?=admin_url('Product')?>" class="m-nav__link">
						<span class="m-nav__link-text">
							Ürünler
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
				<form class="m-form m-form--fit m-form--label-align-right" method="POST" action="<?=site_url('Admin/Product/SetAdd')?>">
					<div class="m-portlet__body">
						<div class="m-form__section m-form__section--first">
							<?php 
								if ($this->session->flashdata('okey') == 1) { ?>
									<div class="alert alert-success alert-dismissible fade show" style="margin-left: 20px;margin-right: 20px" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
										<strong>
											Tebrikler!
										</strong>
										Ürün Başarıyla Kaydedildi.
									</div>
							<?php } ?>
							<?php 
								if ($this->session->flashdata('hata') == 1) { ?>
									<div class="alert alert-danger alert-dismissible fade show" style="margin-left: 20px;margin-right: 20px" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
										<strong>
											Üzügmüm!
										</strong>
										Ürün Kaydı Sırasında Bir Hata Oluştu.
									</div>
							<?php } ?>
							<div class="form-group m-form__group">
								<label for="category_heading">
									Ürün Title
								</label>
								<input type="text" class="form-control m-input" name="title" placeholder="Ürün Title">
							</div>
							<div class="form-group m-form__group">
								<label for="category_heading">
									Ürün Tasarım Fiyatı
								</label>
								<input type="number" step="0.01" class="form-control m-input" name="tasarim_price" placeholder="Tasarım Fiyatı">
							</div>
							<div class="form-group m-form__group">
								<label for="exampleSelect1">
									Fiyat Tipi
								</label>
								<select class="form-control m-input m-input--square" name="payment_type">
									<option value="0">Belirlenen Fiyat</option>
									<option value="1">Teklif Formu</option>
									<option value="2">Kategoriye Gidecek</option>
									<option value="3">Sabit Varyant</option>
								</select>
							</div>
							<div class="form-group m-form__group">
								<label for="exampleSelect1">
									Ürün Fotoğrafları
								</label>
								<div class="m-dropzone dropzone m-dropzone--primary dz-clickable" style="margin-left:50px;margin-right: 50px" id="dropzone_4">
									<div class="m-dropzone__msg dz-message needsclick">
										<h3 class="m-dropzone__msg-title">
											Yüklenecek Dosyaları Buraya Taşıyabilirsiniz.
										</h3>
										<span class="m-dropzone__msg-desc">
											En fazla 10 ürün Yüklenebilir.
										</span>
									</div>
								</div>
							</div>
							<div class="form-group m-form__group">
								<label for="exampleSelect1">
									Banner Görseli
								</label>
								<div class="m-dropzone dropzone m-dropzone--primary dz-clickable" style="margin-left:50px;margin-right: 50px" id="dropzone_5">
									<div class="m-dropzone__msg dz-message needsclick">
										<h3 class="m-dropzone__msg-title">
											Yüklenecek Dosyayı Buraya Taşıyabilirsiniz.
										</h3>
										<span class="m-dropzone__msg-desc">
											Sadece 1 Görsel Yüklenebilir.
										</span>
									</div>
								</div>
							</div>
							<div class="form-group m-form__group">
								<label for="exampleSelect1">
									Örnek Acrobat (Pdf)
								</label>
								<div class="m-dropzone dropzone m-dropzone--primary dz-clickable" style="margin-left:50px;margin-right: 50px" id="dropzone_3">
									<div class="m-dropzone__msg dz-message needsclick">
										<h3 class="m-dropzone__msg-title">
											Yüklenecek Dosyaları Buraya Taşıyabilirsiniz.
										</h3>
										<span class="m-dropzone__msg-desc">
											En fazla 10 ürün Yüklenebilir.
										</span>
									</div>
								</div>
							</div>
							<div class="form-group m-form__group">
								<label for="exampleSelect1">
									Örnek Illustrator (Ai)
								</label>
								<div class="m-dropzone dropzone m-dropzone--primary dz-clickable" style="margin-left:50px;margin-right: 50px" id="dropzone_2">
									<div class="m-dropzone__msg dz-message needsclick">
										<h3 class="m-dropzone__msg-title">
											Yüklenecek Dosyaları Buraya Taşıyabilirsiniz.
										</h3>
										<span class="m-dropzone__msg-desc">
											En fazla 10 ürün Yüklenebilir.
										</span>
									</div>
								</div>
							</div>
							<div class="form-group m-form__group">
								<label for="exampleSelect1">
									Photoshop (Psd)
								</label>
								<div class="m-dropzone dropzone m-dropzone--primary dz-clickable" style="margin-left:50px;margin-right: 50px" id="dropzone_1">
									<div class="m-dropzone__msg dz-message needsclick">
										<h3 class="m-dropzone__msg-title">
											Yüklenecek Dosyaları Buraya Taşıyabilirsiniz.
										</h3>
										<span class="m-dropzone__msg-desc">
											En fazla 10 ürün Yüklenebilir.
										</span>
									</div>
								</div>
							</div>

							<?php foreach ($Langs as $key => $val) { ?>
								<div class="form-group m-form__group">
									<label for="exampleSelect1">
										Ürün Adı - <?=$val->short_code?>
									</label>
									<input type="text" class="form-control m-input" name="product_name[<?=$val->id?>]" placeholder="Ürün Adı">
								</div>
								<div class="form-group m-form__group">
									<label for="exampleSelect1">
										Ürün URL - <?=$val->short_code?>
									</label>
									<input type="text" class="form-control m-input" name="product_slug[<?=$val->id?>]" placeholder="Ürün URL">
								</div>
								<div class="form-group m-form__group">
									<label for="exampleSelect1">
										Ürün Uyarıları - <?=$val->short_code?>
									</label>
									<div class="col-lg-9 col-md-9 col-sm-12">
										<div class="md-editor active" id="1511119882347">
											<textarea class="form-control md-input" data-provide="markdown" name="warnings[<?=$val->id?>]" rows="10" style="resize: none;"></textarea>
											<div class="md-fullscreen-controls">
												<a class="exit-fullscreen" href="#" title="Exit fullscreen"><span class="fa fa-compress"></span></a>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group m-form__group">
									<label for="exampleSelect1">
										Ürün Detay - <?=$val->short_code?>
									</label>
									<div class="col-lg-9 col-md-9 col-sm-12">
										<div class="md-editor active" id="1511119882347">
											<textarea class="form-control md-input" data-provide="markdown" name="product_content[<?=$val->id?>]" rows="10" style="resize: none;"></textarea>
											<div class="md-fullscreen-controls">
												<a class="exit-fullscreen" href="#" title="Exit fullscreen"><span class="fa fa-compress"></span></a>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group m-form__group">
									<label for="exampleSelect1">
										İndirim Oranı % - <?=$val->short_code?>
									</label>
									<input type="number" class="form-control m-input" name="discount_rate[<?=$val->id?>]" placeholder="İndirim Oranı">
								</div>


								<div class="form-group m-form__group">
									<label for="exampleSelect1">
										Süreç 1. Kutu - <?=$val->short_code?>
									</label>
									<input type="text" class="form-control m-input" name="k1[<?=$val->id?>]" placeholder="Süreç">
								</div>


								<div class="form-group m-form__group">
									<label for="exampleSelect1">
										Süreç 2. Kutu - <?=$val->short_code?>
									</label>
									<input type="text" class="form-control m-input" name="k2[<?=$val->id?>]" placeholder="Süreç">
								</div>


								<div class="form-group m-form__group">
									<label for="exampleSelect1">
										Süreç 3. Kutu - <?=$val->short_code?>
									</label>
									<input type="text" class="form-control m-input" name="k3[<?=$val->id?>]" placeholder="Süreç">
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
