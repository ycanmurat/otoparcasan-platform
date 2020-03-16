<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Hediye Çeki Ekle
			</h3>
			<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
				<li class="m-nav__item m-nav__item--home">
					<a href="<?=admin_url()?>" class="m-nav__link m-nav__link--icon">
						<i class="m-nav__link-icon la la-home"></i>
					</a>
				</li>
			</ul>
		</div>
		<div>
		</div>
	</div>
</div>
<div class="m-content">
	<div class="row">
		<div class="col-lg-12">
			<div class="m-portlet">
				<form class="m-form m-form--fit m-form--label-align-right" action="<?=admin_url('Giftcheck/GiftAdd')?>" method="POST">
					<div class="m-portlet__body">
						<div class="m-form__section m-form__section--first">
							
							<?php 
								if ($this->session->flashdata('okey') == 1) { ?>
									<div class="alert alert-success alert-dismissible fade show" style="margin-left: 20px;margin-right: 20px" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
										<strong>
											Tebrikler!
										</strong>
										Dil Kaydı Başarıyla Tamamlandı.
									</div>
							<?php } ?>
							<?php 
								if ($this->session->flashdata('hata') == 1) { ?>
									<div class="alert alert-danger alert-dismissible fade show" style="margin-left: 20px;margin-right: 20px" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
										<strong>
											Üzügmüm!
										</strong>
										Dil Açılırken Bir Hata Oluştu.
									</div>
							<?php } ?>
							<div class="form-group m-form__group">
								<label for="category_heading">
									Kime
								</label>
								<select class="form-control m-input m-input--square" id="exampleSelect1" name="type">
									<option value="0">Herkez</option>
									<option value="1">Üyeye Özel</option>
								</select>
							</div>
							<div class="form-group m-form__group">
								<label for="category_heading">
									Üye ID
								</label>
								<input type="number" name="user_id" class="form-control" placeholder="36255">
							</div>
							<div class="form-group m-form__group">
								<label for="category_heading">
									Kod
								</label>
								<div class="input-group">
									<span class="input-group-btn">
										<button onclick="randCode();" class="btn btn-brand" type="button">
											<i class="fa fa-refresh"></i>
										</button>
									</span>
									<input type="text" class="form-control" id="code" name="kod" maxlength="6" placeholder="">
								</div>
							</div>
							<div class="form-group m-form__group">
								<label for="category_heading">
									Kod Durumu
								</label>
								<select class="form-control m-input m-input--square" name="check_type" id="exampleSelect1">
									<option value="0">Kod Zorunlu</option>
									<option value="1">Sepette Kod Gerektirmeden</option>
								</select>
							</div>
							<div class="form-group m-form__group">
								<label for="category_heading">
									Başlangıç Tutarı
								</label>
								<input type="number" class="form-control m-input" name="min_price" placeholder="100.00">
							</div>
							<div class="form-group m-form__group">
								<label for="category_heading">
									Bitiş Tutarı
								</label>
								<input type="number" class="form-control m-input" name="max_price" placeholder="150.00">
							</div>
							<div class="form-group m-form__group">
								<label for="category_heading">
									İndirim Tipi
								</label>
								<select class="form-control m-input m-input--square" name="discount_type" id="exampleSelect1">
									<option value="1">Tutar Üzerinden</option>
									<option value="2">Yüzde</option>
								</select>
							</div>
							<div class="form-group m-form__group">
								<label for="category_heading">
									İndirim Oran/Tutar
								</label>
								<input type="number" class="form-control m-input" name="discount" placeholder="50">
							</div>
							<div class="form-group m-form__group">
								<label for="category_heading">
									Son Kullanma Tarihi
								</label>
								<input type="date" class="form-control m-input" name="validity" placeholder="50">
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
	function randCode(){
		$('#code').val(makeid());
	}

	function makeid() {
		var text = "";
		var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

		for (var i = 0; i < 6; i++)
			text += possible.charAt(Math.floor(Math.random() * possible.length));

		return text;
	}
</script>