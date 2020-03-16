<div class="big-searchLoading gizle"><img src="<?=site_url('assets/Front/images/tenor.gif')?>"><p>Şase arama işleminiz başladı. Aracınızın türüne göre sorgu süresi değişiklik gösterebilir. <br>Anlayışınız için teşekkür ederiz</p></div>
<!-- pageContent -->
<section class="pageContent">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="list-head">
					<div class="breadcrumb-area">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?=site_url()?>">Anasayfa</a></li>
								<li class="breadcrumb-item" aria-current="page"><a href="<?=site_url('Category/')?>">Oto Yedek Parçalar</a></li>
								<li class="breadcrumb-item active" aria-current="page"><?=replaceStringProblemsReverse($detail->topGroup->GRUP_ISIM)?></li>
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
				<h3 class="font-weight-bold pageTitle"><?=replaceStringProblemsReverse($detail->topGroup->GRUP_ISIM)?></h3>
				<p class="altTitle mt-2">
					<?=($detail->topDetail->content)?>
				</p>

			</div>
			<div class="col-12">
				<?php foreach ($detail->mainGroup as $key => $val) { ?>
					<div class="pageTitle"><?=replaceStringProblemsReverse($val->GRUP_ISIM)?></div>
					<div class="altyedekPart">
						<div class="row">
							<?php foreach ($val->sub as $key2 => $val2) { ?>
								<?php if (isset($val2->detail)) { ?>
									<div class="col-lg-3 col-md-3  col-6">
										<a href="<?=current_url().'/'.$val2->detail->slug ?? ''?>" class="altPart-Item">
											<div class="alt-item-img">
												<img src="<?=((isset($val2->detail)?site_url($val2->detail->image):'https://fakeimg.pl/100x75/'))?>">
											</div>
											<p class="Title"><?=replaceStringProblemsReverse($val2->GRUP_ISIM)?></p>
										</a>
									</div>
								<?php } ?>
							<?php } ?>

						</div>
					</div>
					<hr>
				<?php } ?>
			</div>

			<div class="col-12">
				<div class="pageTitle">Oto Parça Kategorileri Hakkında</div>
				<p class="pageText">
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean aliquet molestie cursus. Duis tincidunt sit amet odio vel euismod. Donec congue orci vel pulvinar volutpat. Donec lorem ante, interdum a finibus in, placerat quis nunc. Nullam luctus sodales leo, quis luctus elit venenatis vitae. Fusce felis odio, bibendum vel bibendum in, gravida convallis justo. Proin sollicitudin urna erat, vitae ornare ante pretium in. Vivamus elementum arcu ut metus facilisis, eu vulputate eros ultricies. Fusce luctus tortor eros, quis maximus erat faucibus eget. Nulla ut viverra est. Maecenas eleifend diam sed ligula bibendum dignissim. Mauris elementum laoreet finibus. Nullam tortor nibh, luctus id quam vel, vehicula gravida dui.
				</p>
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