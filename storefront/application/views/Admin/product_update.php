<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Ürün Düzenle
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
				<form class="m-form m-form--fit m-form--label-align-right" method="POST" action="<?=site_url('Admin/Product/SetUpdate/'.$products[0]->product_id)?>">
					<div class="m-portlet__body">
						<div class="m-form__section m-form__section--first">
							<?php 
								if ($this->session->flashdata('okey') == 1) { ?>
									<div class="alert alert-success alert-dismissible fade show" style="margin-left: 20px;margin-right: 20px" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
										<strong>
											Tebrikler!
										</strong>
										Ürün Güncelleme Başarıyla Tamamlandı.
									</div>
							<?php } ?>
							<?php 
								if ($this->session->flashdata('hata') == 1) { ?>
									<div class="alert alert-danger alert-dismissible fade show" style="margin-left: 20px;margin-right: 20px" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
										<strong>
											Üzügmüm!
										</strong>
										Ürün Güncelleme Sırasında Bir Hata Oluştu.
									</div>
							<?php } 
							?>
							<div class="form-group m-form__group">
								<label for="category_heading">
									Ürün Title
								</label>
								<input type="text" class="form-control m-input" name="title" value="<?=$products[0]->product_title?>" placeholder="Ürün Title">
							</div>
							<div class="form-group m-form__group">
								<label for="category_heading">
									Ürün Tasarım Fiyatı
								</label>
								<input type="number" step="0.01" class="form-control m-input" name="tasarim_price" value="<?=$products[0]->creative_price?>" placeholder="Tasarım Fiyatı" required>
							</div>
							<div class="form-group m-form__group">
								<label for="exampleSelect1">
									Fiyat Tipi
								</label>
								<select class="form-control m-input m-input--square" name="payment_type">
									<option value="0" <?=($products[0]->payment_type==0?'selected':'')?>>Belirlenen Fiyat</option>
									<option value="1" <?=($products[0]->payment_type==1?'selected':'')?>>Teklif Formu</option>
									<option value="2" <?=($products[0]->payment_type==2?'selected':'')?>>Kategoriye Gidecek</option>
									<option value="3" <?=($products[0]->payment_type==3?'selected':'')?>>Sabit Varyant</option>
								</select>
							</div>
							<div class="form-group m-form__group">
								<label for="exampleSelect1">
									Ürün Fotoğrafları
								</label>
								<div class="m-alert m-alert--outline alert alert-info alert-dismissible fade show">
									<div class="row">
									<?php foreach ($images as $key => $val) { ?>
										<div class="col-lg-3 col-md-4 col-sm-6 mb-3 text-center images" id="img_<?=$val->Id?>">
											<div><img src="<?=site_url($val->url)?>" class="w-100 mb-2 img-responsive" width="200" alt=""></div>
												<div>
													<?php if ($val->url != $products[0]->default_image) { ?>
														<a onclick="imgDefault(<?=$val->Id?>)" href="javascript:void(0)" id="default_image_<?=$val->Id?>" class="btn btn-success m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill mainpic"><i class="fa fa-star-o"></i></a>
													<?php } ?>
													<a onclick="imgsil(<?=$val->Id?>)" href="javascript:void(0)" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill"><i class="fa fa-trash"></i></a>
												</div>
										</div>
									<?php } ?>
									</div>
								</div>
							</div>
							<div class="form-group m-form__group">
								<label for="exampleSelect1">
									Yeni Fotoğraflar Ekle
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
								<div class="m-alert m-alert--outline alert alert-info alert-dismissible fade show">
									<div class="row">
									<?php foreach ($theme_img as $key => $val) { ?>
										<?php if ($val->template_id == 4){ ?>
										<div class="col-lg-12 col-md-12 col-sm-12 mb-12 text-center images" id="template_img_<?=$val->Id?>">
											<div><img src="<?=site_url($val->url)?>" class="w-100 mb-2 img-responsive" alt=""></div>
												<div>
													<a onclick="templatesil(<?=$val->Id?>)" href="javascript:void(0)" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill"><i class="fa fa-trash"></i></a>
												</div>
										</div>
										<?php break; } ?>
									<?php } ?>
									</div>
								</div>
							</div>
							<div class="form-group m-form__group">
								<label for="exampleSelect1">
									Banner Görselini Değiştir
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
									Örnek Tasarımlar
								</label>
								<div class="m-alert m-alert--outline alert alert-info alert-dismissible fade show">
									<div class="row">
									<?php foreach ($theme_img as $key => $val) { ?>
										<?php if ($val->template_id != 4): ?>
										<div class="col-lg-3 col-md-4 col-sm-6 mb-3 text-center images" id="template_img_<?=$val->Id?>">
											<div>
												<a href="<?=site_url($val->url)?>" download> İndir </a>
											</div>
											<div>
												<input type="text" class="form-control m-input" value="<?=$val->name?>" name="tepmlate_name[<?=$val->Id?>]">
												<a onclick="templatesil(<?=$val->Id?>)" href="javascript:void(0)" style="margin-top: 10px" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill"><i class="fa fa-trash"></i></a>
											</div>
										</div>
										<?php endif ?>
									<?php } ?>
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
											En fazla 10 Resim Yüklenebilir.
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
											En fazla 10 Resim Yüklenebilir.
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
											En fazla 10 Resim Yüklenebilir.
										</span>
									</div>
								</div>
							</div>

							<?php foreach ($products as $key => $val) { 
								$val->product_prosses_json = json_decode($val->product_prosses_json);
								?>
								<div class="form-group m-form__group">
									<label for="exampleSelect1">
										Ürün Adı - <?=$val->short_code?>
									</label>
									<input type="text" class="form-control m-input" value="<?=$val->product_name?>" name="product_name[<?=$val->lang_id?>]" placeholder="Ürün Adı">
								</div>
								<div class="form-group m-form__group">
									<label for="exampleSelect1">
										Ürün URL - <?=$val->short_code?>
									</label>
									<input type="text" class="form-control m-input" value="<?=$val->product_slug?>" name="product_slug[<?=$val->lang_id?>]" placeholder="Ürün URL">
								</div>
								<div class="form-group m-form__group">
									<label for="exampleSelect1">
										Ürün Uyarıları - <?=$val->short_code?>
									</label>
									<div class="col-lg-9 col-md-9 col-sm-12">
										<div class="md-editor active" id="1511119882347">
											<textarea class="form-control md-input" data-provide="markdown" name="warnings[<?=$val->lang_id?>]" rows="10" style="resize: none;"><?=$val->warnings?></textarea>
											<div class="md-fullscreen-controls">
												<a class="exit-fullscreen" href="javascript:void(0)" title="Exit fullscreen"><span class="fa fa-compress"></span></a>
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
											<textarea class="form-control md-input" data-provide="markdown" name="product_content[<?=$val->lang_id?>]" rows="10" style="resize: none;"><?=$val->product_content?></textarea>
											<div class="md-fullscreen-controls">
												<a class="exit-fullscreen" href="javascript:void(0)" title="Exit fullscreen"><span class="fa fa-compress"></span></a>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group m-form__group">
									<label for="exampleSelect1">
										İndirim Oranı % - <?=$val->short_code?>
									</label>
									<input type="number" class="form-control m-input" value="<?=$val->discount_rate?>" name="discount_rate[<?=$val->lang_id?>]" placeholder="İndirim Oranı">
								</div>


								<div class="form-group m-form__group">
									<label for="exampleSelect1">
										Süreç 1. Kutu - <?=$val->short_code?>
									</label>
									<input type="text" class="form-control m-input" value="<?=$val->product_prosses_json[0]?>" name="k1[<?=$val->lang_id?>]" placeholder="Süreç">
								</div>


								<div class="form-group m-form__group">
									<label for="exampleSelect1">
										Süreç 2. Kutu - <?=$val->short_code?>
									</label>
									<input type="text" class="form-control m-input" value="<?=$val->product_prosses_json[1]?>" name="k2[<?=$val->lang_id?>]" placeholder="Süreç">
								</div>


								<div class="form-group m-form__group">
									<label for="exampleSelect1">
										Süreç 3. Kutu - <?=$val->short_code?>
									</label>
									<input type="text" class="form-control m-input" value="<?=$val->product_prosses_json[2]?>" name="k3[<?=$val->lang_id?>]" placeholder="Süreç">
								</div>
							<?php } ?>
						</div>
					</div>
					<div class="m-portlet__foot m-portlet__foot--fit">
						<div class="m-form__actions m-form__actions">
							<div class="row">
								<div class="col-lg-12">
									<button type="submit" class="btn btn-primary pull-right">
										Kaydet
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

<script>
	function imgsil(id) {
		var r = confirm("Resmi Silmek İstediğinize Emin misiniz ?");
		if (r == true) {
			$.ajax({
				type: "POST",
				url:'<?=site_url("Admin/Product/deleteimg/")?>'+id,
				success: function(data){
					if (data == 1) {
							$('#img_'+id).remove();
							//$('.images:first .mainpic').remove();
					}
					/*
					else if(data == 2){
						$('#img_'+id).remove();
					}
					*/
				},
			});
		}
	}

	function templatesil(id) {
		var r = confirm("Resmi Silmek İstediğinize Emin misiniz ?");
		if (r == true) {
			$.ajax({
				type: "POST",
				url:'<?=site_url("Admin/Product/deleteTemplateImg/")?>'+id,
				success: function(data){
					if (data == 1) {
						$('#template_img_'+id).remove();
					}
				},
			});
		}
	}

	function imgDefault(id) {
		var r = confirm("Resmi Ana Resim Olarak Atamak İstediğinize Emin misiniz ?");
		if (r == true) {
			$.ajax({
				type: "POST",
				url:'<?=site_url("Admin/Product/defaultImg/")?>'+id,
				success: function(data){
					if (data == 1) {
						$('#default_image_'+id).remove();
					}
				},
			});
		}
	}


</script>