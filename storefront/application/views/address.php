<!-- pageContent -->
<section class="pageContent AddressPage">
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
				<div class="pageTitle">Adres Bilgileri</div>
				
				<div class="addNewAddress" data-toggle="modal" data-target="#addAddressModal">
					<div class="addBtn">Yeni Adres Ekle</div>
				</div>

				<?foreach ($address as $key => $addressInformation) {?>
					<div class="accountArea">
						<div class="row">
							<div class="col-12">
								<div class="address-title"><?=$addressInformation->definition?></div>
							</div>
							<div class="col-12">
								<div class="row">
									<div class="col-lg-3">
										<p class="address-info"><b>Ad Soyad :</b> <?=$addressInformation->name?></p>
										<p class="address-info"><b>Posta Kodu :</b> <?=$addressInformation->post_code?></p>
										<p class="address-info"><b>İl/İlçe :</b> <?=$addressInformation->CityName?>, <?=$addressInformation->CountyName?></p>
									</div>
									<div class="col-lg-9">
										<p class="address-info"><b>Açık Adres :</b> <?=$addressInformation->content?></p>
										<p class="address-info"><b>Telefon :</b> <?=$addressInformation->gsm?></p>
										<!--<p class="address-info"><strong>Fatura Türü :</strong> Bireysel</p>-->
									</div>
								</div>
							</div>
							<div class="col-12">
								<div class="address-control">
									<?=($addressInformation->default==1)?'<div class="item Available">Geçerli Adresiniz</div>':'<div class="item Edit" data-toggle="modal" data-target=""><a href="'.site_url('Account/addDefaultAddress/'.$addressInformation->Id).'">Geçerli Adres Yap</a></div>'?>
									<div class="item Edit" data-toggle="modal" data-target="#editAddressModal-<?=md5($addressInformation->Id)?>">Düzenle</div>
									<div class="item Remove"><a href="<?=site_url('Account/deleteAddress/'.$addressInformation->Id)?>">Sil</a></div>
								</div>
							</div>
						</div>
					</div>
					<?}?>
				</div>
			</div>
		</div>
	</section>
	<!-- / pageContent -->


	<!-- Modal -->
	<div class="modal fade" id="addAddressModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<form action="#" method="post">
					<div class="modal-header">
						<h5 class="modal-title">Adres Bilgileri</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="formArea">
							<div class="row m-0">
								<div class="col-12"><input type="text" placeholder="Başlık" name="definition" id="definition"></div>
								<div class="col-12"><input type="text" placeholder="Ad Soyad" name="name" id="name"></div>
								<div class="col-sm-6"><input type="tel" placeholder="Cep Telefonu" name="gsm" id="gsm"></div>
								<div class="col-sm-6"><input type="tel" placeholder="Posta Kodu" name="post_code" id="post_code"></div>
								<div class="col-sm-6">
									<select name="country" id="country">
										<option value="">Lütfen Seçin</option>
										<?foreach ($country as $key => $countryInfo) {?>
											<option value="<?=$countryInfo->CountryID?>"><?=$countryInfo->CountryName?></option>
											<?}?>
										</select>
									</div>
									<div class="col-sm-6">
										<select name="city" id="city">
											<option value="">Lütfen Seçin</option>
										</select>
									</div>
									<div class="col-sm-6">
										<select name="town" id="town">
											<option value="">Lütfen Seçin</option>
										</select>
									</div>
									<div class="col-sm-6">
										<input type="text" placeholder="Tc Kimlik No (isteğe bağlı)" id="identity_number" name="identity_number">
									</div>
									<div class="col-12">
										<textarea name="content" id="content" placeholder="Adres Bilgileri"></textarea>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal" id="modalSecondary">Vazgeç</button>
							<button type="button" class="btn btn-primary" id="addAddress">Ekle</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<?foreach ($address as $key => $addressInformation) {?>
			<div class="modal fade" id="editAddressModal-<?=md5($addressInformation->Id)?>" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<form action="#" method="post">
							<div class="modal-header">
								<h5 class="modal-title">Adres Güncelle</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="formArea">
									<div class="row m-0">
										<div class="col-12"><input type="text" placeholder="Başlık" name="definition" id="definition-<?=$addressInformation->Id?>" value="<?=$addressInformation->definition?>"></div>
										<div class="col-12"><input type="text" placeholder="Ad Soyad" name="name" id="name-<?=$addressInformation->Id?>" value="<?=$addressInformation->name?>"></div>
										<div class="col-sm-6"><input type="tel" placeholder="Cep Telefonu" name="gsm" id="gsm-<?=$addressInformation->Id?>" value="<?=$addressInformation->gsm?>"></div>
										<div class="col-sm-6"><input type="tel" placeholder="Posta Kodu" name="post_code" id="post_code-<?=$addressInformation->Id?>" value="<?=$addressInformation->post_code?>"></div>
										<div class="col-sm-6">
											<select name="country" id="country-<?=$addressInformation->Id?>">
												<option value="">Lütfen Seçin</option>
												<?foreach ($country as $key => $countryInfo) {?>
													<option value="<?=$countryInfo->CountryID?>" <?=($countryInfo->CountryID == $addressInformation->country)?'selected':''?>><?=$countryInfo->CountryName?></option>
													<?}?>
												</select>
											</div>
											<div class="col-sm-6">
												<select name="city" id="city-<?=$addressInformation->Id?>">
													<?foreach ($cities as $key => $citiesInfo) {?>
														<option value="<?=$citiesInfo->CityID?>" <?=($citiesInfo->CityID==$addressInformation->city)?'selected':''?>><?=$citiesInfo->CityName?></option>
														<?}?>
													</select>
												</div>
												<div class="col-sm-6">
													<select name="town" id="town-<?=$addressInformation->Id?>">
														<?foreach ($counties as $key => $countiesInfo) {?>
															<?if($countiesInfo->CityID == $addressInformation->city){?>
																<option value="<?=$countiesInfo->CountyID?>" <?=($countiesInfo->CountyID == $addressInformation->town)?'selected':''?>>
																	<?=$countiesInfo->CountyName?>
																</option>
																<?}?>
																<?}?>
															</select>
														</div>
														<div class="col-sm-6">
															<input type="text" placeholder="Tc Kimlik No (isteğe bağlı)" id="identity_number-<?=$addressInformation->Id?>" name="identity_number" value="<?=$addressInformation->identity_number?>">
														</div>
														<div class="col-12">
															<textarea name="content" id="content-<?=$addressInformation->Id?>" placeholder="Adres Bilgileri"><?=$addressInformation->content?></textarea>
														</div>
													</div>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal" id="modalSecondary">Vazgeç</button>
												<button type="button" class="btn btn-primary" id="editAndUpdateAddress-<?=$addressInformation->Id?>">Güncelle</button>
											</div>
										</form>
									</div>
								</div>
							</div>
							<?}?>