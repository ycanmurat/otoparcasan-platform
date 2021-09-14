<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				İskonto Ekle
			</h3>
			<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="<?=admin_url()?>" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-home"></i>
                    </a>
                </li>
                <li class="m-nav__separator">
                    >
                </li>
                <li class="m-nav__item">
                    <a href="<?=admin_url('Indirim')?>" class="m-nav__link">
                        <span class="m-nav__link-text">
                       	İskonto Yönetimi
                        </span>
                    </a>
                </li>
                <li class="m-nav__separator">
                    >
                </li>
                <li class="m-nav__item">
                    <a href="<?=$this->agent->referrer()?>" class="m-nav__link">
                        <span class="m-nav__link-text">
                        Geri Dön
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
				<form class="m-form m-form--fit m-form--label-align-right" action="<?=admin_url('Indirim/Add')?>" method="POST">
					<div class="m-portlet__body">
						<div class="m-form__section m-form__section--first">
							<?php if ($this->session->flashdata('okey') == 1) { ?>
								<div class="alert alert-success alert-dismissible fade show" style="margin-left: 20px;margin-right: 20px" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
									<strong>
										Tebrikler!
									</strong>
									İndirim Kaydı Tamamlandı.
								</div>
							<?php } ?>
							<?php if (validation_errors()) { ?>
								<div class="alert alert-danger alert-dismissible fade show" style="margin-left: 20px;margin-right: 20px" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
									<strong>
										Formda Hata Var !
									</strong>
									<?=validation_errors()?>
								</div>
							<?php } ?>
							<?php if ($this->session->flashdata('hata') == 1) { ?>
								<div class="alert alert-danger alert-dismissible fade show" style="margin-left: 20px;margin-right: 20px" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
									<strong>
										Üzügmüm!
									</strong>
									İndirim Kaydı Tamamlanamadı.
								</div>
							<?php } ?>
							<div class="form-group m-form__group">
								<label class="col-form-label">
									Marka
								</label>
								<select class="form-control m-select2" id="m_select2_1" name="marka">
									<option value="0">Seçilmedi</option>
									<?php foreach ($datas->marka as $key => $val) { ?>
										<option <?=set_select('marka', $val->id)?> value="<?=$val->id?>"><?=replaceStringProblemsReverse($val->name)?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group m-form__group">
								<label class="col-form-label">
									Tedarikçi
								</label>
								<select class="form-control m-select2" id="m_select2_1" name="cari">
									<option value="0">Seçilmedi</option>
									<?php foreach ($datas->cari as $key => $val) { ?>
										<option <?=set_select('cari', $val->id)?> value="<?=$val->id?>"><?=replaceStringProblemsReverse($val->name)?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group m-form__group">
								<label class="col-form-label">
									Üst Kategori
								</label>
								<select class="form-control m-select2" id="m_select2_1" name="ustKategori">
									<option value="0">Seçilmedi</option>
									<?php foreach ($datas->ustKategori as $key => $val) { ?>
										<option <?=set_select('ustKategori', $val->id)?> value="<?=$val->id?>"><?=replaceStringProblemsReverse($val->name)?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group m-form__group">
								<label class="col-form-label">
									Ana Kategori
								</label>
								<select class="form-control m-select2" id="m_select2_1" name="anaKategori">
									<option value="0">Seçilmedi</option>
									<?php foreach ($datas->anaKategori as $key => $val) { ?>
										<option <?=set_select('anaKategori', $val->id)?> value="<?=$val->id?>"><?=replaceStringProblemsReverse($val->name)?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group m-form__group">
								<label class="col-form-label">
									Alt Kategori
								</label>
								<select class="form-control m-select2" id="m_select2_1" name="altKategori">
									<option value="0">Seçilmedi</option>
									<?php foreach ($datas->altKategori as $key => $val) { ?>
										<option <?=set_select('altKategori', $val->id)?> value="<?=$val->id?>"><?=replaceStringProblemsReverse($val->name)?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group m-form__group">
								<label for="category_heading">
									İndirim Oranı (Yüzde)
								</label>
								<input type="number" class="form-control m-input" value="<?=set_value('discount')?>" name="discount" placeholder="50">
							</div>
                            <div class="form-group m-form__group">
                                <label for="category_heading">
                                    Başlangıç Tarihi
                                </label>
                                <input type="date" class="form-control m-input" value="<?=set_value('validity')?>" name="validity" placeholder="50">
                            </div>
                            <div class="form-group m-form__group">
                                <label for="category_heading">
                                    Bitiş Tarihi Tarihi
                                </label>
                                <input type="date" class="form-control m-input" value="<?=set_value('validity2')?>" name="validity" placeholder="50">
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
<script src="<?=site_url('assets/theme')?>/assets/demo/default/custom/components/forms/widgets/select2.js" type="text/javascript"></script>