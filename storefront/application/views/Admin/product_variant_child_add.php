<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Ürüne Alt Varyant Ekle
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
				<li class="m-nav__separator">
					-
				</li>
				<li class="m-nav__item">
					<?php $ustvaryantid = (int)$_GET['urun']; ?>
					<a href="<?=admin_url('Product/Variant/'.$ustvaryantid)?>" class="m-nav__link">
						<span class="m-nav__link-text">
							Ürünün Varyantları
						</span>
					</a>
				</li>
				<li class="m-nav__separator">
					-
				</li>
				<li class="m-nav__item">
					<a href="<?=admin_url('Product/VariantChilds/'.$product_id.'?urun='.$ustvaryantid)?>" class="m-nav__link">
						<span class="m-nav__link-text">
							Üst Varyant
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
				<form class="m-form m-form--fit m-form--label-align-right" method="POST" action="<?=site_url('Admin/Product/SetVariantChildEkle/'.$product_id.'?urun='.$ustvaryantid)?>">
					<div class="m-portlet__body">
						<div class="m-form__section m-form__section--first">
							<div class="form-group m-form__group">
								<label for="exampleSelect1">
									Alt Varyant
								</label>
								<select class="form-control m-input m-input--square" name="altvaryant">
									<?php foreach ($SubVariant as $key => $val) {
										echo $val;
									} ?>
								</select>
							</div>
						</div>
					</div>
					<div class="m-portlet__foot m-portlet__foot--fit">
						<div class="m-form__actions m-form__actions">
							<div class="row">
								<div class="col-lg-2"></div>
								<div class="col-lg-10">
									<button type="submit" class="btn btn-primary pull-right">
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