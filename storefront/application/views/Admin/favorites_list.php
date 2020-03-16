<div class="m-subheader ">
	<div class="d-flex align-items-center">
		<div class="mr-auto">
			<h3 class="m-subheader__title m-subheader__title--separator">
				Kategoriler
			</h3>
			<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
				<li class="m-nav__item m-nav__item--home">
					<a href="<?=admin_url()?>" class="m-nav__link m-nav__link--icon">
						<i class="m-nav__link-icon la la-home"></i>
					</a>
				</li>
			</ul>
		</div>
	</div>
</div>
<div class="m-content">
	<div class="row">
		<div class="col-lg-12">
			<?if($this->session->flashdata('onay')==1){?>
	         	<div class="alert alert-success alert-dismissible fade show" role="alert">
		            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
		            <strong>
		               Başarılı
		            </strong>
		               Yorum Başarıyla Eklendi
	         	</div>
	        <?}elseif($this->session->flashdata('hata')==1){?>
	         	<div class="alert alert-danger alert-dismissible fade show" role="alert">
	            	<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
	            	<strong>
	               		Başarısız
	            	</strong>
	               		Yorum Eklenemiyor Lütfen Geliştiricinizden Yardım İsteyin
	         	</div>
	        <?}elseif($this->session->flashdata('uyari')==1){?>
	        	<div class="alert alert-warning alert-dismissible fade show" role="alert">
	            	<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
	            	<strong>
	               		Uyarı
	            	</strong>
	               		En Fazla 8 Adet Ürün Seçebilirsiniz
	         	</div>
	        <?}?>
			<div class="m-portlet">
				<form action="<?=admin_url('Category/favoritesProduct')?>" method="post">
					<div class="m-section">
						<div class="m-section__content">
							<table class="table m-table m-table--head-bg-success">
								<thead>
									<tr>
										<th>#</th>
										<th>Kategori İsmi</th>
										<th style="text-align: right;">Seç</th>
										<th style="text-align: right;">İşlem</th>
									</tr>
								</thead>
								<tbody>
									<?foreach ($categories as $key => $categoryInfo) {?>
										<tr>
											<td><?=$categoryInfo->GRUP_KOD?></td>
											<td><?=replaceStringProblemsReverse($categoryInfo->GRUP_ISIM)?></td>
											<td style="text-align: right;">
												<label class="m-checkbox m-checkbox--solid m-checkbox--state-brand">
												<input type="checkbox" name="product_id[]" value="<?=$categoryInfo->GRUP_KOD?>">
												<span></span>
												</label>
											</td>
											<td style="text-align: right;">
												<button type="button" class="btn btn-primary" onclick="window.location.href='<?=admin_url('Category/editCategory/'.$categoryInfo->GRUP_KOD)?>'">
	                                 			Kategoriyi Düzenle
	                             				</button>
	                             			</td>
										</tr>
										<?foreach ($categoryInfo->sub as $key => $lowerCategoryInfo) {?>
										<tr>
											<td><?=$lowerCategoryInfo->GRUP_KOD?></td>
											<td><?=replaceStringProblemsReverse($lowerCategoryInfo->GRUP_ISIM)?></td>
											<td style="text-align: right;">
												<label class="m-checkbox m-checkbox--solid m-checkbox--state-brand">
												<input type="checkbox" name="product_id[]" value="<?=$lowerCategoryInfo->GRUP_KOD?>">
												<span></span>
												</label>
											</td>
											<td style="text-align: right;">
												<button type="button" class="btn btn-primary" onclick="window.location.href='<?=admin_url('Category/editCategory/'.$lowerCategoryInfo->GRUP_KOD)?>'">
	                                 			Kategoriyi Düzenle
	                             				</button>
	                             			</td>
										</tr>
										<?foreach ($lowerCategoryInfo->sub as $key => $contentInfo) {?>
										<tr>
											<td><?=$contentInfo->GRUP_KOD?></td>
											<td><?=replaceStringProblemsReverse($contentInfo->GRUP_ISIM)?></td>
											<td style="text-align: right;">
												<label class="m-checkbox m-checkbox--solid m-checkbox--state-brand">
												<input type="checkbox" name="product_id[]" value="<?=$contentInfo->GRUP_KOD?>">
												<span></span>
												</label>
											</td>
											<td style="text-align: right;">
												<button type="button" class="btn btn-primary" onclick="window.location.href='<?=admin_url('Category/editCategory/'.$contentInfo->GRUP_KOD)?>'">
	                                 			Kategoriyi Düzenle
	                             				</button>
	                             			</td>
										</tr>
									<?}}}?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="text-right" style="padding:15px;">
	                	<button type="submit" style="" class="btn btn-outline-primary m-btn m-btn--icon m-btn--outline-2x">
	                    	<span>
	                        	<i class="fa flaticon-list-1"></i>
	                           	<span>
	                            	Favori Ürünleri Düzenle
	                           	</span>
	                     	</span>
	                  	</button>
	               	</div>
				</form>
			</div>
		</div>
	</div>
</div>