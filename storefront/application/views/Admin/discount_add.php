<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				İndirimli Ürün Ekle
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
					<a href="<?=admin_url('discount')?>" class="m-nav__link">
						<span class="m-nav__link-text">
							İndirimli Ürünleri Listele
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
				<form class="m-form m-form--fit m-form--label-align-right" method="POST" action="<?=site_url('Admin/Discount/Add')?>">
					<div class="m-portlet__body">
						<div class="m-form__section m-form__section--first">
							<?if ($this->session->flashdata('true') == 1){?>
								<div class="alert alert-success alert-dismissible fade show" style="margin-left: 20px;margin-right: 20px" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
									<strong>
									Tebrikler!
									</strong>
									İndirimli Ürün Başarıyla Eklendi.
								</div>
							<?}?>
							<div class="form-group m-form__group">
								<label>
									İndirimli Ürün Açıklaması
								</label>
								<input type="text" class="form-control m-input" name="discount_title" placeholder="İndirimli Ürün Açıklaması" required="true">
							</div>
							<div class="form-group m-form__group">
								<label for="category_heading">
									Ürünü seçin
								</label>
								<select class="form-control m-input m-input--square" id="exampleSelect1" name="product_id">
									<?foreach ($product_status as $key => $product_info){?>
										<option value="<?=$product_info->Id?>"><?=$product_info->product_name?></option>
									<?}?>
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
										İndirim Uygula
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