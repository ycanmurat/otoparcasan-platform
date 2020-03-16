<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Ürün Fiyatlama
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
					<span class="m-nav__link-text">
						<strong><?=$productName?></strong>
					</span>
				</li>
				<li>
				</li>
			</ul>
		</div>
	</div>
</div>
<div class="m-content">
	<div class="row">
		<div class="col-lg-12">
			<div class="m-portlet">
				<form action="<?=site_url('Admin/Product/fiyatlamaKaydet/'.$product_id)?>" method="POST">
					<div class="m-portlet__body">
						<table class="table table-striped">
							<?php $i=0; foreach ($list as $key => $val) { 
								$i++; 
								$name = array();
								?>
								<tr>
									<td><?=$i?></td>
									<?php foreach ($val as $key2 => $val2) { 
										$name[] = $val2->variant_child_id;
									?>
											<td><?=$val2->name?></td>
									<?php } 

									$name = json_encode($name);
									$c = 0;
									foreach ($validatePrice as $key3 => $valid) {
										if (array_diff(json_decode($name),json_decode($valid->key)) == array()) {
											$validPrice = $valid->price;
											$c++;
											break;
										}
									}
									if ($c == 0) {
										$validPrice = '';
									}
									?>
									<td>
										<input type="number" value="<?=$validPrice?>" step="0.01" key="<?=$key?>" class="form-control price" placeholder="0.00">
										<input type="hidden" value='<?=($name)?>' class="keyId" key="<?=$key?>">
										<input type="hidden" value='<?=$product_id?>' key="<?=$key?>" class="product_id">
									</td>
								</tr>
							<?php } ?>
						</table>
					</div>
					<div class="m-portlet__foot m-portlet__foot--fit">
						<div class="m-form__actions m-form__actions">
							<div class="row">
								<div class="col-lg-2"></div>
								<div class="col-lg-10">
									<button type="button" onclick="submitFiyat()" class="btn btn-primary pull-right">
										Gönder
									</button>
								</div>
							</div>
						</div>
					</div>
				</form>
				<form id="ProductPricePostForm" action="<?=site_url('Admin/Product/fiyatlamaKaydet/'.$product_id)?>" method="POST">
					<input type="hidden" id="jsondata" name="jsondata">
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	function submitFiyat() {
		ResponseData = [];
		var price = [];
		var keyId = [];
		var product_id = [];
		// price : {},key : {},product_id:{}
		$.each($('.price'),function(key,val) {
			var priceKey = $(val).attr('key');
			var priceVal = $(val).val();
			price.push({[priceKey]:priceVal});
		});

		$.each($('.keyId'),function(key,val) {
			var priceKey = $(val).attr('key');
			var priceVal = $(val).val();
			keyId.push({[priceKey]:priceVal});
		});

		$.each($('.product_id'),function(key,val) {
			var priceKey = $(val).attr('key');
			var priceVal = $(val).val();
			product_id.push({[priceKey]:priceVal});
		});

		ResponseData = [price,keyId,product_id];
		ResponseData = JSON.stringify(ResponseData);
		$('#jsondata').val(ResponseData);
		$('#ProductPricePostForm').submit();
	}
</script>