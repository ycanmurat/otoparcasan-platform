<!-- pageContent -->
<section class="pageContent">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-auto">
				<div class="accountPanel">
					<div class="panel-head">
						<div class="Welcome">Merhaba <span><?$writeName=explode(" ", $userInfo->name);echo $writeName[0];?></span></div>
						<div class="user-mail"><?=$userInfo->email?></div>
					</div>
					<div class="panel-content">
						<a href="<?=site_url('Account')?>" class="panel-link <?=($tabPanel=='account')?'Active':''?>">
							<div class="Icon"><i class="fa fa-user" aria-hidden="true"></i></div>
							Üyelik Bilgilerim
						</a>
						<a href="<?=site_url('Account/password')?>" class="panel-link <?=($tabPanel=='password')?'Active':''?>">
							<div class="Icon"><i class="fa fa-key" aria-hidden="true"></i></div>
							Şifre Güncelleme
						</a>
						<a href="<?=site_url('Account/orders')?>" class="panel-link <?=($tabPanel=='orders')?'Active':''?>">
							<div class="Icon"><i class="fa fa-cube" aria-hidden="true"></i></div>
							Siparişlerim<span class="Count">122</span>
						</a>
						<a href="<?=site_url('Account/returns')?>" class="panel-link <?=($tabPanel=='returns')?'Active':''?>">
							<div class="Icon"><i class="fa fa-reply" aria-hidden="true"></i></div>
							İadelerim<span class="Count">3</span>
						</a>
						<a href="<?=site_url('Account/questions')?>" class="panel-link <?=($tabPanel=='questions')?'Active':''?>">
							<div class="Icon"><i class="fa fa-question-circle" aria-hidden="true"></i></div>
							Ürün Sorularım<span class="Count">3</span>
						</a>
						<a href="<?=site_url('Account/address')?>" class="panel-link <?=($tabPanel=='address')?'Active':''?>">
							<div class="Icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
							Adreslerim
						</a>
						<a href="<?=site_url('Account/favorite')?>" class="panel-link <?=($tabPanel=='favorite')?'Active':''?> ">
							<div class="Icon"><i class="fa fa-heart" aria-hidden="true"></i></div>
							Favorilerim
						</a>
						<a href="<?=site_url('Account/garage')?>" class="panel-link <?=($tabPanel=='garage')?'Active':''?>">
							<div class="Icon"><i class="fa fa-car" aria-hidden="true"></i></div>
							Garajım
						</a>
						<a href="<?=site_url('Account/iban')?>" class="panel-link <?=($tabPanel=='iban')?'Active':''?>">
							<div class="Icon"><i class="fa fa-bank" aria-hidden="true"></i></div>
							IBAN Bilgilerim
						</a>
						<a href="<?=site_url('Account/transfer')?>" class="panel-link <?=($tabPanel=='transfer')?'Active':''?>">
							<div class="Icon"><i class="fa fa-exchange" aria-hidden="true"></i></div>
							Havale Ödeme Bildirimi
						</a>
						<a href="<?=site_url('Account/coupon')?>" class="panel-link <?=($tabPanel=='coupon')?'Active':''?>">
							<div class="Icon"><i class="fa fa-money" aria-hidden="true"></i></div>
							Kuponlarım
						</a>
						<a href="<?=site_url('User/logout')?>" class="panel-link">
							<div class="Icon"><i class="fa fa-sign-out" aria-hidden="true"></i></div>
							Çıkış Yap
						</a>
					</div>
				</div>
			</div>
			<div class="col-md">
				<div class="pageTitle">Garajım</div>

				<?php if ($cars != false) { ?>
					<a class="addNewCar" href="<?=site_url()?>" <?php /*data-toggle="modal" data-target="#addNewCarModal" */ ?>>
						<div class="addBtn">Yeni Araç Ekle</div>
					</a>
					<?php foreach ($cars as $key => $val) { //prex($val); ?>
						<div class="garage_item">
							<div class="garage-img" style="background-image: url('<?=$val->image ? site_url($val->image) : 'https://fakeimg.pl/250x250/'?>');"></div>
							<div class="garage-content">
								<div class="contentHead">
									<h3 class="Title"><?=$val->detail->Vehicle->ManufacturerName?> <?=$val->detail->Vehicle->BaseModelName?></h3>
									<div class="removeGarage" onclick="removeCar(<?=$val->Id?>)"><i class="fa fa-trash-o" aria-hidden="true"></i></div>
								</div>
								<div class="contentBody">
									<div class="row">
										<div class="col-12">
											<div class="row">
												<div class="col-4">
													<div class="garage-item-feature feature1">
														<div class="feature-title">Marka</div>
														<div class="feature-info"><?=$val->detail->Vehicle->ManufacturerName??' .'?></div>
													</div>
													<div class="garage-item-feature feature2">
														<div class="feature-title">Model</div>
														<div class="feature-info"><?=$val->detail->Vehicle->BaseModelName??' .'?></div>
													</div>
												</div>
												<div class="col-4">
													<div class="garage-item-feature feature3">
														<div class="feature-title">Şanzıman</div>
														<div class="feature-info"><?=$val->detail->Vehicle->TechInfo->GearboxType??' .'?></div>
													</div>
													<div class="garage-item-feature feature4">
														<div class="feature-title">Yakıt</div>
														<div class="feature-info"><?=$val->detail->Vehicle->TechInfo->FuelMethod??' .'?></div>
													</div>
												</div>
												<div class="col-4">
													<div class="garage-item-feature feature3">
														<div class="feature-title">Motor Hacmi</div>
														<div class="feature-info"><?=$val->detail->Vehicle->TechInfo->Capacity??' .'?></div>
													</div>
													<div class="garage-item-feature feature4">
														<div class="feature-title">Yıl</div>
														<div class="feature-info"><?=getConsTime($val->construction_time)??' .'?> Sonrası</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-12">
											<div class="garage-action">
												<div class="Btn Btn1" onclick="changeSelectedCar('<?=$val->car_id?>','<?=$val->construction_time?>')">Yedek Parçalar</div>
												<div class="Btn Btn2">Bakım Ürünleri</div>
												<div class="Btn Btn3">Aksesuarlar</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>
				<?php }else{ ?>
					<div class="empty_page">
						<div class="Icon"><img src="<?=site_url('assets/Front/images/Icons/garage_empty.webp')?>" alt=""></div>
						<div class="T">Garajınızda Araç Bulunamadı..</div>
						<div class="sT">Hemen sizde aracınız ekleyin, aracınıza göre parçaları listeleyin.</div>

						<a href="<?=site_url()?>" class="global-btn">Araç Ekle</a>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</section>
<!-- / pageContent -->



<!-- Modal 
<div class="modal fade" id="addNewCarModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form action="#">
				<div class="modal-header">
					<h5 class="modal-title">Araç Ekle</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="formArea">
						<div class="row m-0">
							<div class="col-sm-6">
								<select name="add_ulke" id="araba_marka">
									<option value="">Aracınızın Markası</option>
									<option value="1">Audi</option>
									<option value="2">Bmw</option>
									<option value="3">Renault</option>
								</select>
							</div>
							<div class="col-sm-6">
								<select name="add_ulke" id="araba_model">
									<option value="">Aracınızın Modeli</option>
									<option value="1">PASSAT 1.6 TDI</option>
									<option value="2">PASSAT 2.0 TDI</option>
									<option value="3">PASSAT 3.0 TDI</option>
								</select>
							</div>
							<div class="col-sm-6">
								<select name="add_ulke" id="araba_yil">
									<option value="">Aracınızın Yılı</option>
									<option value="1">2010</option>
									<option value="1">2011</option>
									<option value="1">2012</option>
									<option value="1">2013</option>
									<option value="1">2014</option>
								</select>
							</div>
							<div class="col-sm-6">
								<select name="add_ulke" id="araba_vites">
									<option value="">Vites Tipi</option>
									<option value="1">Otomatik</option>
									<option value="2">Yarı Otomatik</option>
									<option value="3">Manuel</option>
								</select>
							</div>
							<div class="col-sm-6">
								<select name="add_il" id="araba_yakit">
									<option value="">Yakıt Türü</option>
									<option value="1">Benzin</option>
									<option value="2">Lpg</option>
									<option value="3">Dizel</option>
									<option value="3">Bengin + LPG</option>
									<option value="3">Hibrit</option>
								</select>
							</div>
							<div class="col-sm-6">
								<select name="add_il" id="araba_beygir">
									<option value="">Beygir</option>
									<option value="1">95 HP</option>
									<option value="2">96 HP</option>
									<option value="3">97 HP</option>
									<option value="3">98 HP</option>
									<option value="3">99 HP</option>
								</select>
							</div>
							<div class="col-12">
								<input id="carPhotoarea" type="file" id="araba_photo">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
					<button type="button" class="btn btn-primary">Ekle</button>
				</div>
			</form>
		</div>
	</div>
</div>
-->
<script>
	function removeCar(id) {
		Swal.fire({
		  title: 'Silme İşlemi',
		  text: "Aracı Garajınızdan silmek istediğinize emin misiniz ?",
		  type: 'danger',
		  showCancelButton: true,
		  confirmButtonColor: '#DD631F',
		  cancelButtonColor: '#1889CB',
		  confirmButtonText: 'Evet Sil',
		  cancelButtonText: 'Vazgeç'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					url: site_url+'Service/deleteGarageCar/'+id,
					method:'POST',
					success: function(result){
						if (result == 'OK') {
							Swal.fire(
							  'Silindi!',
							  'Araç Garajınızdan Başarı ile Silindi.',
							  'success'
							)
							window.location = site_url+'Account/garage';
						}else{
							swalWithBootstrapButtons.fire(
						      'Silinemedi',
						      'Teknik bir hata ile karşılaştık. Lütfen daha sonra tekrar deneyin.',
						      'error'
						    )
						}
					},
					error: function (result) {
						swalWithBootstrapButtons.fire(
					      'Silinemedi',
					      'Teknik bir hata ile karşılaştık. Lütfen daha sonra tekrar deneyin.',
					      'error'
					    )
					}
				});
			}
		})
	}
</script>