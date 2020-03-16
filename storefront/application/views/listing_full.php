<div class="big-searchLoading gizle"><img src="<?=site_url('assets/Front/images/tenor.gif')?>"><p>Şase arama işleminiz başladı. Aracınızın türüne göre sorgu süresi değişiklik gösterebilir. <br>Anlayışınız için teşekkür ederiz</p></div>
<!-- pageContent -->
<section class="pageContent ListingPage ListingFull">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="list-head">
					<div class="breadcrumb-area">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?=site_url()?>">Anasayfa</a></li>
								<li class="breadcrumb-item" aria-current="page"><a href="<?=site_url('Category/')?>">Oto Yedek Parçalar</a></li>
								<li class="breadcrumb-item" aria-current="page"><a href="<?=site_url('Category/'.$menu1)?>"><?=replaceStringProblemsReverse($otherCategori->GRUP_ISIM)?></a></li>
								<li class="breadcrumb-item active" aria-current="page"><a href="<?=site_url('Category/'.$menu1.'/'.$menu2)?>"><?=replaceStringProblemsReverse($selectedCategori->GRUP_ISIM)?></a></li>
							</ol>
						</nav>
					</div>
					<ul class="nav nav-pills justify-content-end" id="pills-tab" role="tablist">
						<li class="nav-item">
							<a class="nav-link <?=($selectedCar == false?'selected active':'')?>" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Şase Ara</a>
						</li>
						<li class="nav-item">
							<a class="nav-link <?=($selectedCar != false?'selected active':'')?>" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Garajım</a>
						</li>
					</ul>
					<div class="tab-content" id="pills-tabContent">
						<div class="tab-pane fade <?=($selectedCar != false?'show active':'')?>" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
							<div class="mySelectedcar">
								<div class="row">
									<div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 d-sm-block d-none">
										<img src="<?=$carImage ? site_url($carImage) : 'https://fakeimg.pl/400x250/'?>">
									</div>
									<div class="col-xl-10 col-lg-10 col-md-12 col-sm-12 col-12">
										<?php if (isset($carDetail)) { ?>
											<div class="ListingCarDetail">
												<div class="item"><p>Marka<b><?=$carDetail->Vehicle->ManufacturerName?></b></p></div>
												<div class="item"><p>Model Yıl<b><?=$carDetail->Vehicle->BaseModelName?></b></p></div>
												<div class="item"><p>Alt Model<b><?=$carDetail->Vehicle->SubModelName?></b></p></div>
												<div class="item"><p>Şanzıman<b><?=$carDetail->Vehicle->TechInfo->GearboxType?></b></p></div>
												<div class="item"><p>Motor Hacmi<b><?=$carDetail->Vehicle->TechInfo->Capacity?></b></p></div>
												<div class="item"><p>Yakıt<b><?=$carDetail->Vehicle->TechInfo->FuelMethod?></b></p></div>
											</div>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane fade <?=($selectedCar == false?'show active':'')?>" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
							<div class="plateSearch Listing">
								<form action="#">
									<div class="row">
										<div class="col-md-4 col-sm-12 m-auto">
											<div class="T">Hızlı Parça Bul</div>
											<div class="Area">
												<div class="plate-area">
													<input type="text" class="plate-input" onkeypress="return enterScript(event)" placeholder="ŞASE NO" id="chasisNo">
													<button type="button" onclick="sasiSearch()" class="plateSearchButon" id="chasisSearch"></button>
												</div>
											</div>
										</div>
										<div class="col-md-8 col-sm-12 ">
											<div class="mySelectedcar">
												<table class="selectarea">
													<tr>
														<td>
															<select class="custom-select" name="garaggeCars">
																<?php if ($userData == false) { ?>
																	<option value="0" selected disabled>Üye Girişi Yapmalısınız</option>
																<?php }elseif ($garagge == false) { ?>
																	<option value="0" selected disabled>Üye Girişi Yapmalısınız</option>
																<?php }else{ ?>
																		<option value="0">Garajınızdan Seçin</option>
																	<?php foreach ($garagge as $key => $val) { ?>
																			<option value="<?=$val->car_id?>" cons_time="<?=$val->consTime?>"><?=$val->detail?></option>
																	<?php } ?>
																<?php } ?>
															</select>
															<a href="javascript:void(0);" data-toggle="modal" data-target="#addNewCarModal">Bu aracıma parça bul</a>
														</td>
													</tr>
												</table>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 p-xl-3 p-0">
				<center>
					<?php foreach ($oems as $key => $val) { ?>
						<h4><?=$val?></h4>
					<?php } ?>
				</center>
			</div>
			<div class="col-md-12 p-xl-3 p-0">

				<?php if ($products == array()) { ?>
					<h2>Ürün Bulunamadı !</h2>
				<?php } ?>

				<?php foreach ($products as $key => $productGroup) { ?>
					<div class="Item-Display">
						<div class="col-xl-9 col-md-12">
							<div class="tab-content" id="v-pills-tabContent">

								<?php foreach ($productGroup as $key2 => $product) { ?> 
									<div class="tab-pane <?=$key2 == 0?'fade show active':''?>" id="product-<?=$key?>-<?=$key2?>" role="tabpanel" aria-labelledby="product-<?=$key?>-<?=$key2?>-tab">
										<div class="product-lists">
											<div class="row list-row">
												<div class="product-Item list-item">
													<div class="row">
														<div class="col-sm-4 mr-auto ml-auto">
															<div class="list-img">
																<span class="ribbon Stok OK"><span>Stokta Var</span></span>
																<!--<span class="ribbon"><span>Fırsat</span></span>-->
																<a href="#" class="img-link"><img src="<?=site_url('assets/products/'.$product->STOK_KODU.'/1.jpg')?>" alt=""></a>
															</div>
														</div>
														<div class="col-sm-8 p-0">
															<div class="list-content">
																<div class="row">
																	<div class="col-12">
																		<div class="product-head">
																			<a href="<?=site_url('Product/details/'.$product->STOK_KODU)?>" class="ProductName"><?=replaceStringProblemsReverse($product->STOK_ADI)?></a>
																			<div class="product-stars">
																				<div class="item">
																					<i class="fa fa-star OK" aria-hidden="true"></i>
																					<i class="fa fa-star OK" aria-hidden="true"></i>
																					<i class="fa fa-star OK" aria-hidden="true"></i>
																					<i class="fa fa-star OK" aria-hidden="true"></i>
																					<i class="fa fa-star" aria-hidden="true"></i>
																				</div>
																				<div class="item">
																					<p class="comment">(7 Yorum)</p>
																				</div>
																			</div>
																			<?php if ($product->GRUP_ISIM == 'Eurocraft') { ?>
																				<div class="yerli-uretim">
																					<img src="<?=site_url('assets/Front/')?>images/yerliuretim.webp">
																				</div>
																			<?php } ?>
																			<p class="productInfo">Stok Kodu : <b><?=$product->STOK_KODU?></b></p>
																		</div>
																	</div>
																	<div class="col-7">
																		<div class="product-list-badges">
																			<?php if (number_format($product->SATIS_FIAT1,2)>100) { ?>
																				<div class="com-item"><i class="fa fa-truck" aria-hidden="true"></i><p> Ücretsiz Kargo</p></div>
																			<?php } ?>
																			<div class="com-item"><i class="fa fa-reply" aria-hidden="true"></i><p> Kolay İade</p></div>
																			<div class="com-item"><i class="fa fa-clock-o" aria-hidden="true"></i><p> Teslimat Süresi <br><b>3 Gün</b></p></div>
																		</div>
																	</div>
																	<div class="col-5">

																		<div class="product-Price">
																			<div class="old-price"><?=number_format($product->SATIS_FIAT2,2)?> ₺</div>
																			<div class="price"><?=number_format($product->SATIS_FIAT1,2)?> ₺</div>
																			<?php if (number_format($product->SATIS_FIAT1,2)>100) { ?>
																				<p class="kargo-price">100 ₺ Üzeri Alışverişlerde Kargo Bedava.</p>
																			<?php } ?>
																		</div>

																	</div>
																	<div class="col-12">
																		<div class="row">
																			<div class="col-4 p-0">
																				<div class="list-interaction-btn addBasket">
																					<i class="fa fa-shopping-basket" aria-hidden="true"></i>
																					Sepete Ekle
																				</div>
																			</div>
																			<div class="col-4 p-0">
																				<div class="list-interaction-btn addFav">
																					<i class="fa fa-star" aria-hidden="true"></i>
																					Favorilere Ekle
																				</div>
																			</div>

																			<div class="col-4 p-0 pr-2">
																				<div class="list-interaction-btn Share">
																					<i class="fa fa-info" aria-hidden="true"></i>
																					Ürün Detay
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								<?php } ?>

							</div>
						</div>
						<div class="col-xl-3 col-md-12">
							<div class="Product-tab-bg">
								<div class="nav flex-column nav-pills product-tab-menu " id="v-pills-tab" role="tablist" aria-orientation="vertical">

									<?php foreach ($productGroup as $key2 => $product) { ?> 
										<a class="nav-link <?=$key2 == 0?'active':''?>" id="product-<?=$key?>-<?=$key2?>-tab" data-toggle="pill" href="#product-<?=$key?>-<?=$key2?>" role="tab" aria-controls="product-<?=$key?>-<?=$key2?>" aria-selected="true">
											<div class="image-item"><img class="img-fluid" src="<?=site_url('assets/brands/'.$product->GRUP_ISIM.'.png')?>"></div>
											<p><?=number_format($product->SATIS_FIAT2,2)?> <i class="fa fa-try" aria-hidden="true"></i></p>
										</a>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>

			</div>
		</div>
	</div>
</section>
<!-- / pageContent -->

<!-- Modal -->
<div class="modal fade" id="sasiModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
    		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      <div class="modal-body">
      	<div class="row">
      		<div class="col-md-12">
      			<div class="carSasiDetail">
      				<img src="" id="carImageSasi">
      				<div class="sasiSecililer"></div>
      				<div class="sasiText"><p>
      					<b class="sasiSearchSasiNumber">KPACA1ETSCP129883</b> şase numarasına ait aracın, aşağıdaki tabloda gösterilen Alt Model, Motor Tipi, Kaporta vb. araca ve şase numarasına göre değişiklik gösterecek donanımlarını da eksiksiz şekilde seçerek aracınızın seçim işlemini bitirmeniz gerekmektedir. Aksi takdirde aradığınız doğru parçaya ulaşamayabilirsiniz.
      				</p></div>
      			</div>
      		</div>
      		<div class="col-12"><div style="color:red;font-weight: bold;" class="gizle" id="sasiSearchErrorText"><center>Lütfen tüm alanlarda bir seçim yapın.</center><br></div></div>
      		<div class="col-12">
      		<div class="select-items allBaslik d-none">
      			
      		</div>
      		<div class="select-items allSelect">
      			
      		</div>
      	</div>
      </div>
      </div>
      <div class="modal-footer">
      	<button onclick="sasiGarajaEkle()">Garajıma Ekle</button>
      	<button onclick="sasiAra('<?=current_url()?>')">Ara</button>
      </div>
    </div>
  </div>
</div>