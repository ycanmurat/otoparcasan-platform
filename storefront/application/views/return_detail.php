<?php include 'pages/head.php';?>
<?php include 'pages/header.php';?>


<!-- pageContent -->
<section class="pageContent">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-auto">
				<div class="accountPanel">
					<div class="panel-head">
						<div class="Welcome">Merhaba <span>Emre</span></div>
						<div class="user-mail">demo@example.com</div>
					</div>
					<div class="panel-content">
						<a href="account.php" class="panel-link "><div class="Icon"><i class="fa fa-user" aria-hidden="true"></i></div>Hesabım</a>
						<a href="orders.php" class="panel-link "><div class="Icon"><i class="fa fa-cube" aria-hidden="true"></i></div>Siparişlerim<span class="Count">122</span></a>
						<a href="returns.php" class="panel-link Active"><div class="Icon"><i class="fa fa-reply" aria-hidden="true"></i></div>İadelerim<span class="Count">3</span></a>
						<a href="product_question.php" class="panel-link"><div class="Icon"><i class="fa fa-question-circle" aria-hidden="true"></i></div>Ürün Sorularım<span class="Count">3</span></a>
						<a href="address.php" class="panel-link "><div class="Icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>Adreslerim</a>
						<a href="favorites.php" class="panel-link "><div class="Icon"><i class="fa fa-heart" aria-hidden="true"></i></div>Favorilerim</a>
						<a href="garage.php" class="panel-link"><div class="Icon"><i class="fa fa-car" aria-hidden="true"></i></div>Garajım</a>
						<a href="#" class="panel-link"><div class="Icon"><i class="fa fa-sign-out" aria-hidden="true"></i></div>Çıkış Yap</a>
					</div>
				</div>
			</div>
			<div class="col-md">
				<div class="pageTitle">İade Detay (#2151555)</div>
				<div class="accountArea orderDetailArea">
					<div class="order-detail-info">
						<div class="row">
							<div class="col-lg-6">
								<div class="Left-Area">
									<div class="detail-title">Adres Bilgileri</div>

									<div class="Order-Address">
										<div class="T">Teslimat Adresi</div>

										<p>Cumhuriyet Mahallesi, 89. Sokak, Çakır Apartmanı No : 8 Daire : 3 55200</p>
										<p>Atakum / Samsun</p>
										<p><strong>Serdar AŞAN - 546*****89</strong></p>
									</div>

									<div class="Order-Address">
										<div class="T">Fatura Adresi</div>

										<p>Cumhuriyet Mahallesi, 89. Sokak, Çakır Apartmanı No : 8 Daire : 3 55200</p>
										<p>Atakum / Samsun</p>
										<p><strong>Serdar AŞAN - 546*****89</strong></p>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="Right-Area">
									<div class="detail-title">Ödeme Bilgileri</div>

									<div class="payInfo">
										4987 49** **** 7635 (Peşin - Iyzico)
									</div>

									<div class="payAddition">
										<div class="column">
											<div class="item">Ürün Toplamı :</div>
											<div class="item">159,99 TL</div>
										</div>
										<div class="column">
											<div class="item">İndirim Tutarı :</div>
											<div class="item">-59,00 TL</div>
										</div>
										<div class="column">
											<div class="item">Kargo Ücreti :</div>
											<div class="item">Ücretsiz</div>
										</div>
										<div class="column Total">
											<div class="item">Toplam :</div>
											<div class="item">100,99 TL</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="orderDetailControl">
					<a href="#" class="control-item">Fatura Görüntüle</a>
					<a href="#" class="control-item">Kargom Nerede ?</a>
					<a href="javascript:void(0);" class="control-item" data-toggle="modal" data-target="#kolayIade">Kolay İade</a>
				</div>


				<div class="pageTitle">Siparişinizdeki Ürünler</div>
				<div class="accountArea orderDetailArea">
					<div class="cart-product-list">
						<div class="cart-product-item">
							<div class="row">
								<div class="col-lg">
									<div class="productDetail">
										<div class="Img"><img src="images/cart-item.png" alt=""></div>
										<div class="productInfo">
											<a href="#" class="productName">TRIPLE QX Tam Sentetik Motor Yağı - 5W-40 - 5 Litre</a>
											<div>
												<span>Ürün Kodu : 2151552</span>
												<span>Ürün Adedi : 2 Adet</span>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-auto">
									<div class="productPrice">
										<div>199,23 TL</div>
									</div>
								</div>
							</div>
						</div>
						<div class="cart-product-item">
							<div class="row">
								<div class="col-lg">
									<div class="productDetail">
										<div class="Img"><img src="images/cart-item.png" alt=""></div>
										<div class="productInfo">
											<a href="#" class="productName">TRIPLE QX Tam Sentetik Motor Yağı - 5W-40 - 5 Litre</a>
											<div>
												<span>Ürün Kodu : 2151552</span>
												<span>Ürün Adedi : 2 Adet</span>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-auto">
									<div class="productPrice">
										<div>199,23 TL</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- / pageContent -->


<!-- Modal -->
<div class="modal return-product-modal fade" id="kolayIade" tabindex="-1" role="dialog" aria-labelledby="kolayIadeLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="kolayIadeLabel">İade (#452555533)</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="ReturnModal">
					<div class="container-fluid">
						<div class="row">
							<div class="col-12">
								<div class="return-info">Siparişinize ait ürünler aşağıda listelenmektedir. İadeye uygun ürünleri seçip iade işlemini tamamlayabilirsiniz.</div>
							</div>
							<div class="col-12">
								<div class="return-order">
									<span>Sipariş No : 634441123</span>
									<span>Sipariş Tarihi : 23.11.2018 19:48</span>
								</div>
							</div>
						</div>
						<div class="return-list">
							<div class="return-item">
								<div class="row">
									<div class="col-sm-7">
										<div class="product_info">
											<div class="productImg"><img src="images/cart-item.png" alt=""></div>
											<div class="productInfo">
												<a href="#" class="product-link">TRIPLE QX Tam Sentetik Motor Yağı 5W-40 - 5Ltr</a>
												<p>Ürün Kodu : 123441155</p>
											</div>
										</div>
									</div>
									<div class="col-sm-5">
										<div class="return_operation">
											<div class="operation-title">İşlem ;</div>

											<div class="select-list">
												<select class="" name="">
													<option value="0">Adet</option>
													<option value="0">1</option>
													<option value="0">2</option>
													<option value="0">3</option>
													<option value="0">4</option>
													<option value="0">5</option>
												</select>
												<select class="" name="">
													<option value="0">İade Sebebi</option>
													<option value="0">Ürünü İade Etmek İstiyorum</option>
													<option value="0">Ürün hasarlı geldi, tutanak ve servis raporum var</option>
													<option value="0">Faturadaki ürün ile bana gelen ürün farklı</option>
													<option value="0">Ürünün aparatı / aksesuarı eksik</option>
													<option value="0">Siparişimde Eksik Ürün Var</option>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="return-item">
								<div class="row">
									<div class="col-sm-7">
										<div class="product_info">
											<div class="productImg"><img src="images/cart-item.png" alt=""></div>
											<div class="productInfo">
												<a href="#" class="product-link">TRIPLE QX Tam Sentetik Motor Yağı 5W-40 - 5Ltr</a>
												<p>Ürün Kodu : 123441155</p>
											</div>
										</div>
									</div>
									<div class="col-sm-5">
										<div class="return_operation">
											<div class="operation-title">İşlem ;</div>
											<div class="operation-alert"><p>Bu ürün iade için uygun değildir.</p> <div class="Link">İade Koşulları</div></div>
										</div>
									</div>
								</div>
							</div>

							<div class="return-item">
								<div class="row">
									<div class="col-sm-7">
										<div class="product_info">
											<div class="productImg"><img src="images/cart-item.png" alt=""></div>
											<div class="productInfo">
												<a href="#" class="product-link">TRIPLE QX Tam Sentetik Motor Yağı 5W-40 - 5Ltr</a>
												<p>Ürün Kodu : 123441155</p>
											</div>
										</div>
									</div>
									<div class="col-sm-5">
										<div class="return_operation">
											<div class="operation-title">İşlem ;</div>

											<div class="select-list">
												<select class="" name="">
													<option value="0">Adet</option>
													<option value="0">1</option>
													<option value="0">2</option>
													<option value="0">3</option>
													<option value="0">4</option>
													<option value="0">5</option>
												</select>
												<select class="" name="">
													<option value="0">İade Sebebi</option>
													<option value="0">Ürünü İade Etmek İstiyorum</option>
													<option value="0">Ürün hasarlı geldi, tutanak ve servis raporum var</option>
													<option value="0">Faturadaki ürün ile bana gelen ürün farklı</option>
													<option value="0">Ürünün aparatı / aksesuarı eksik</option>
													<option value="0">Siparişimde Eksik Ürün Var</option>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-12">
								<div class="return-contract">
									<input type="checkbox" class="contract_input" id="return_contract">
									<label class="contract_label" for="return_contract">
										<a href="javascript:void(0);" data-toggle="modal" data-target="#return-contact">İade ve Geri Gönderim Şartları</a>'nı okudum, kabul ediyorum.
									</label>
								</div>
							</div>
							<div class="col-12 text-center mt-3">
								<a href="return_success.php" class="global-btn">İadeyi Onayla</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- Modal -->
<div class="modal fade" id="return-contact" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">İade ve Geri Gönderim Şartları</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
				İade ve Geri Gönderim Şartları <br>
			</div>
		</div>
	</div>
</div>



<?php include 'pages/footer.php';?>
