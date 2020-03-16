<script src="<?=site_url('assets/Front/js/dat_panel_dvn.js?v='.md5(date('Y-m-d H:i:s')))?>"></script>
<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Dvn Havuzu Genişlet
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
				<form class="m-form m-form--fit m-form--label-align-right" action="<?=admin_url('Aracagaci/list')?>" method="POST">
					<div class="m-portlet__body">
						<div class="m-form__section m-form__section--first">
							<div class="form-group m-form__group">
								<label>
									Araç Seçin
								</label>

								<div class="FormElements">
									<select class="form-control mt-2" id="carType">
										<option value="0">- Araç Türünü Seçiniz </option>
										<?php foreach ($types as $key => $val) { ?>
											<option value="<?=$val['key']?>"><?=$val['value']?></option>
										<?php } ?>
									</select>
									<select class="form-control mt-2 carAlt" id="carBrands" disabled>
										<option value="0">- Marka -</option>
									</select>
									<select class="form-control mt-2 carAlt" id="year" disabled>
										<option value="0">- Yıl Seçin -</option>
										<?php for ($i=2019; $i > 1950; $i--) {  ?>
											<option value="<?=$i?>"><?=$i?></option>
										<?php } ?>
									</select>
									<select class="form-control mt-2 carAlt" id="carModels" disabled>
										<option value="0">- Model -</option>
									</select>
									<select class="form-control mt-2 carAlt" id="carSubModels" disabled>
										<option value="0">- Alt Model -</option>
									</select>
								</div>
								<div class="FormElements">
									<div class="row mt-2">
										<div class="col-12"><button onclick="CarDetails()" type="button" class="btn btn-primary pull-right mt-2">Ara</button></div>
									</div>
								</div>
								<div class="extraArea" style="display: none">
									<div class="carSelectDetail">
										
									</div>
									<div class="FormElements">
										<div class="row mt-2">
											<div class="col-12"><button onclick="SearchPart()" type="button" class="btn btn-primary pull-right mt-2">Seçimi Tamamla</button></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>