
<!-- cart_header -->
<section class="cart_header">
	<div class="container">
		<div class="row">
			<div class="col">
				<a href="index.php" class="cart_logo"><img src="<?=site_url('assets/Front/images/logofinali.webp')?>" alt=""></a>
			</div>
			<div class="col-auto">
				<div class="security_text">Güvenli Ödeme</div>
			</div>
		</div>
	</div>
</section>
<!-- / cart_header -->

<!-- pageContent -->
<section class="pageContent Cart_Page">
		
	<div class="container">
		<div class="row">
			<div class="col-12 col-lg">
				<div class="Cart_Content">
					<div class="T">Adres Bilgileri</div>
					
					<div class="address-select-area">
						<div class="row">
							<div class="col-lg-6">
								<div class="select-item">
									<input class="select-radio" type="radio" name="addressSelect" id="addressSelect-1" checked>
									<label class="select-square" for="addressSelect-1">
										<div class="address-info">
											<div class="T">Ofis</div>
											<div class="Name">Serdar AŞAN</div>
											<p class="max-75">Cumhuriyet Mh. 89. Sk. Çakır apt. No:8 Kat:1/3 Samsun / ATAKUM - 55200 Cumhuriyet Mh. 89. Sk. Çakır apt. No:8 Kat:1/3 Samsun / ATAKUM - 55200</p>
										</div>
										<div class="address-control">
											<div class="item"><a href="javascript:void(0);" class="Btn Edit" data-toggle="modal" data-target="#editAddressModal">Düzenle</a></div>
											<div class="item"><a href="javascript:void(0);" class="Btn Remove">Sil</a></div>
										</div>
									</label>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="select-item">
									<input class="select-radio" type="radio" name="addressSelect" id="addressSelect-2">
									<label class="select-square" for="addressSelect-2">
										<div class="address-info">
											<div class="T">Ev</div>
											<div class="Name">Serdar AŞAN</div>
											<p class="max-75">Cumhuriyet Mh. 89. Sk. Çakır apt. No:8 Kat:1/3 Samsun / ATAKUM - 55200</p>
										</div>
										<div class="address-control">
											<div class="item"><a href="javascript:void(0);" class="Btn Edit" data-toggle="modal" data-target="#editAddressModal">Düzenle</a></div>
											<div class="item"><a href="javascript:void(0);" class="Btn Remove">Sil</a></div>
										</div>
									</label>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="select-item">
									<input class="select-radio" type="radio" name="addressSelect" id="addressSelect-3">
									<label class="select-square" for="addressSelect-3">
										<div class="address-info">
											<div class="T">Ev</div>
											<div class="Name">Serdar AŞAN</div>
											<p class="max-75">Cumhuriyet Mh. 89. Sk. Çakır apt. No:8 Kat:1/3 Samsun / ATAKUM - 55200</p>
										</div>
										<div class="address-control">
											<div class="item"><a href="javascript:void(0);" class="Btn Edit" data-toggle="modal" data-target="#editAddressModal">Düzenle</a></div>
											<div class="item"><a href="javascript:void(0);" class="Btn Remove">Sil</a></div>
										</div>
									</label>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="select-item">
									<div class="addNewAddress" data-toggle="modal" data-target="#newAddressModal">
										<div class="Icon"><i class="fa fa-plus" aria-hidden="true"></i></div>
										<div class="txt">Yeni Adres Ekle</div>
									</div>
								</div>
							</div>
						</div>
					</div>



					<!-- Yeni Adres Ekle -->
					<div class="modal fade" id="newAddressModal" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Yeni Adres Ekle</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>

								<form action="#">
									<div class="modal-body">
										<div class="AddressModal_Content">
											<div class="container-fluid">
												<div class="row">
													<div class="col-lg-6">
														<div class="FormElements">
															<label for="">Ad *</label>
															<input type="text" id="address_name">
														</div>
													</div>
													<div class="col-lg-6">
														<div class="FormElements">
															<label for="">Soyad *</label>
															<input type="text" id="address_lastname">
														</div>
													</div>
													<div class="col-lg-6">
														<div class="FormElements">
															<label for="">Cep Telefonu *</label>
															<input type="text" id="address_gsm">
														</div>
													</div>
													<div class="col-lg-6">
														<div class="FormElements">
															<label for="">E-Mail Adresi *</label>
															<input type="text" id="address_email">
														</div>
													</div>
													<div class="col-lg-4">
														<div class="FormElements">
															<label for="">İl *</label>
															<select name="address_city" id="">
																<option value="">Seçiniz</option>
																<option value="">Adana</option>
																<option value="">Adana</option>
																<option value="">Adana</option>
																<option value="">Merkez</option>
															</select>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="FormElements">
															<label for="">İlçe *</label>
															<select name="address_town" id="">
																<option value="">Seçiniz</option>
																<option value="">Orası</option>
																<option value="">Burası</option>
																<option value="">Şurası</option>
															</select>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="FormElements">
															<label for="">Posta Kodu</label>
															<input type="text" id="address_post_code">
														</div>
													</div>

													<div class="col-12">
														<div class="FormElements">
															<label for="">Adres *</label>
															<textarea name="address_address" id=""></textarea>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-primary btn-sm">Kaydet ve Devam Et</button>
										<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Vazgeç</button>
									</div>
								</form>

							</div>
						</div>
					</div>

					<!-- Adres Düzenle -->
					<div class="modal fade" id="editAddressModal" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Adres Düzenle</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>

								<form action="#">
									<div class="modal-body">
										<div class="AddressModal_Content">
											<div class="container-fluid">
												<div class="row">
													<div class="col-lg-6">
														<div class="FormElements">
															<label for="">Ad *</label>
															<input type="text" id="addressEdit_name" value="Serdar">
														</div>
													</div>
													<div class="col-lg-6">
														<div class="FormElements">
															<label for="">Soyad *</label>
															<input type="text" id="addressEdit_lastname" value="Aşan">
														</div>
													</div>
													<div class="col-lg-6">
														<div class="FormElements">
															<label for="">Cep Telefonu *</label>
															<input type="text" id="addressEdit_gsm" value="0555 000 00 00">
														</div>
													</div>
													<div class="col-lg-6">
														<div class="FormElements">
															<label for="">E-Mail Adresi *</label>
															<input type="text" id="addressEdit_email" value="demo@example.com">
														</div>
													</div>
													<div class="col-lg-4">
														<div class="FormElements">
															<label for="">İl *</label>
															<select name="addressEdit_city" id="">
																<option value="">Seçiniz</option>
																<option value="">Adana</option>
																<option value="">Adana</option>
																<option value="">Adana</option>
																<option value="">Merkez</option>
																<option value="" selected="">Samsun</option>
															</select>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="FormElements">
															<label for="">İlçe *</label>
															<select name="addressEdit_town" id="">
																<option value="">Seçiniz</option>
																<option value="">Orası</option>
																<option value="">Burası</option>
																<option value="">Şurası</option>
																<option value="" selected="">Atakum</option>
															</select>
														</div>
													</div>
													<div class="col-lg-4">
														<div class="FormElements">
															<label for="">Posta Kodu</label>
															<input type="text" id="addressEdit_post_code" value="55200">
														</div>
													</div>

													<div class="col-12">
														<div class="FormElements">
															<label for="">Adres *</label>
															<textarea name="addressEdit_address" id="">Cumhuriyet Mh. 89. Sk. Çakır apt. No:8 Kat:1/3 Samsun / ATAKUM - 55200</textarea>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-primary btn-sm">Kaydet</button>
										<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Vazgeç</button>
									</div>
								</form>

							</div>
						</div>
					</div>
				</div>

				<div class="remove-area"><a href="cart.php" class="all-remove-items"><i class="fa fa-undo" aria-hidden="true"></i> Sepete Dön</a></div>
			</div>
			<div class="col-12 col-lg-auto">
				<div class="cart-addition">
					<div class="T">Sipariş Özeti</div>

					<div class="addition-item">
						<div class="item">Ara Toplam</div>
						<div class="item">4,999 TL</div>
					</div>

					<div class="addition-item">
						<div class="item">KDV</div>
						<div class="item">200 TL</div>
					</div>

					<div class="addition-item">
						<div class="item">Kargo</div>
						<div class="item">Ücretsiz</div>
					</div>

					<div class="addition-item">
						<div class="item">Kampanya İndirimi</div>
						<div class="item Colored">-1000 TL</div>
					</div>

					<div class="addition-total addition-item">
						<div class="item">toplam</div>
						<div class="item totalPrice">3,999 TL</div>
					</div>
				</div>

				<a href="<?=site_url('Basket/pay')?>" class="global-btn d-block text-center mt-3">Sepeti Onayla</a>
			</div>
		</div>
	</div>
</section>
<!-- / pageContent -->
