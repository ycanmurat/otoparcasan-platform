<!-- pageContent -->
<section class="pageContent product_Detail">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-5">
				<div class="product-gallery">
					<div id="sync1" class="owl-carousel owl-theme">
						<div class="item"><div class="Img"><img src="<?=site_url('assets/products/'.$product->STOK_KODU.'/1.jpg')?>" alt=""></div></div>
					</div>

					<div id="sync2" class="owl-carousel owl-theme">
						<div class="item"><div class="Img"><img src="<?=site_url('assets/products/'.$product->STOK_KODU.'/1.jpg')?>" alt=""></div></div>
					</div>
				</div>
				<div class="share-Social">
					<a class="facebook" href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
					<a class="twitter" href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
					<a class="pinterest" href="#"><i class="fa fa-pinterest-square" aria-hidden="true"></i></a>
					
					<a class="mail" href="#"><i class="fa fa-envelope-square" aria-hidden="true"></i></a>
					<a class="whatsapp" href="#"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
					<a class="instagram" href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
					<a class="linkedin" href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
				</div>
			</div>
			<div class="col-lg-7">
				<div class="product-content">
					<div class="product-head">
						<h1 class="ProductName"><?=replaceStringProblemsReverse($product->STOK_ADI)?></h1>
						<div class="infos">
							<div class="item">Marka : Ford</div>
							<div class="item">Stok Kodu : <?=$product->STOK_KODU?></div>
							<div class="item">Menşei : Türkiye</div>
						</div>
					</div>

					<div class="supplier">
						<div class="row">
							<div class="col-6">
								<img src="<?=site_url('assets/Front/images/carbrand/marka7.webp')?>">
								<p>Üretici No : GDB1583</p>
								<p class="stok OK"><i class="fa fa-archive" aria-hidden="true"></i> Stokta Var</p>
							</div>
							<div class="col-6">
								<div class="product-Star">
									<b>4.2 / <span>5</span></b>
									<i class="fa fa-star OK" aria-hidden="true"></i>
									<i class="fa fa-star OK" aria-hidden="true"></i>
									<i class="fa fa-star OK" aria-hidden="true"></i>
									<i class="fa fa-star OK" aria-hidden="true"></i>
									<i class="fa fa-star " aria-hidden="true"></i>
									<p>( 16 Geri Bildirim )</p>
								</div>
							</div>
						</div>
					</div>
					<div class="product-price">
						<div class="row">
							<div class="col-4">
								<div class="discount">
									<p>-<?=floor((($product->SATIS_FIAT2 / $product->SATIS_FIAT1)-1)*100)?>%</p>
									<p>Kazancınız <?=number_format($product->SATIS_FIAT2-$product->SATIS_FIAT1,2)?> ₺</p>
								</div>
							</div>
							<div class="col-8">
								<p class="old-Price"><?=number_format($product->SATIS_FIAT2,2)?> ₺</p>
								<div class="Price-block">
									<p class="Price"><?=number_format($product->SATIS_FIAT1,2)?> ₺</p>
								</div>
								<p class="kdv">100 ₺ Üzeri Alışverişlerde Kargo Ücretsiz !</p>
							</div>
						</div>
					</div>
					<div class="product-cart">
						<div class="row">
							<div class="col-sm-auto">
								<div class="quantity-area">
									<div class="value-button" id="decrease" onclick="decreaseValue()" value="Decrease Value">-</div>
									<input type="number" id="number" value="1" />
									<div class="value-button" id="increase" onclick="increaseValue()" value="Increase Value">+</div>
								</div>
							</div>
							<div class="col-sm text-sm-right">
								<div class="actionBox">
									<div class="global-btn AddButton">Sepete Ekle</div>
									<div class="global-btn FavButton addFav">Favorilerime Ekle</div>
								</div>
							</div>
						</div>
					</div>
					<!--
					<div class="product-explanation">
						<div class="T">Parça Uyumluluk Testi</div>
						<div class="test-generator">

							<select class="custom-select w-auto">
								<option> -Araç Seçiniz- </option>
								<option> BMW X5 BROADWAY 2.0i</option>
								<option> BMW X5 BROADWAY 2.0iBROADWAY 2.0i BROADWAY 2.0i</option>
								<option> BMW X5 BROADWAY 2.0i</option>
							</select>
							<p class="generator-display OK"><i class="fa fa-check-circle" aria-hidden="true"></i> Aracınız bu parça ile uyumludur. </p>
							<p class="generator-display NOT d-none"><i class="fa fa-times-circle" aria-hidden="true"></i> Bu parça aracınıza uyumlu değildir. </p>
						</div>
					</div>
				-->
				
					<div class="badges-box">
						<div class="row">
							<div class="col-4">
								<div class="detail-badge"><img src="<?=site_url('assets/Front/images/Icons/ucretsizkargo.webp')?>"><span>Ücretsiz</span><span>Kargo</span></div>
							</div>
							<div class="col-4">
								<div class="detail-badge"><img src="<?=site_url('assets/Front/images/Icons/orginal.webp')?>"><span>Orjinal</span><span>Ürün</span></div>
							</div>
							<div class="col-4">
								<div class="detail-badge"><img src="<?=site_url('assets/Front/images/Icons/taksit.webp')?>"><span>9 Taksit</span><span>Fırsatı</span></div>
							</div>
							<div class="col-4">
								<div class="detail-badge"><img src="<?=site_url('assets/Front/images/Icons/kapidaodeme.webp')?>"><span>Kapıda</span><span>Ödeme</span></div>
							</div>
							<div class="col-4">
								<div class="detail-badge"><img src="<?=site_url('assets/Front/images/Icons/return.webp')?>"><span>Kolay</span><span>İade</span></div>
							</div>
							<div class="col-4">
								<div class="detail-badge"><img src="<?=site_url('assets/Front/images/Icons/delivery.webp')?>"><span>Teslimat Süresi</span><span>3 Gün</span></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		<div class="product-tabs">
			<div class="row">
				<div class="col-12">
					<ul class="tabs">
						<li class="active" rel="product-tab-1">Açıklama</li>
						<!--<li rel="product-tab-2">Uyumlu Araçlar</li>
						<li rel="product-tab-3">Oem Numaraları</li>
						<li rel="product-tab-4">Ürün Özellikleri</li>-->
						<li rel="product-tab-5">İade ve Teslimat Koşulları</li>
						<li rel="product-tab-6">Yorumlar</li>
						<li rel="product-tab-7">Soru ve Cevap</li>
						
					</ul>
					<div class="tab_container">
						<div id="product-tab-1" class="tab_content">
							<div class="product-info">
								<div class="T">TRIPLE QX Tam Sentetik Motor Yağı 5W-40 - 5Ltr</div>
								<div class="sT">Açıklama :</div>
								<div class="EditorBox">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit fugiat ab dolorum vitae, aliquam, laborum eaque praesentium possimus modi natus vel repudiandae esse, neque expedita rem totam. Quos, tenetur, numquam? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit dolore ut repellendus ducimus recusandae perspiciatis labore consectetur fuga, doloremque praesentium qui itaque assumenda eveniet aliquam ad ea iure cumque eaque!</p>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit fugiat ab dolorum vitae, aliquam, laborum eaque praesentium possimus modi natus vel repudiandae esse, neque expedita rem totam. Quos, tenetur, numquam?</p>
								</div>
							</div>
						</div>
						<!--
						<div id="product-tab-2" class="tab_content">
							<div class="product-info">
								<div class="table-responsive">
									<table class="table tabs-table table-bordered">
										<tbody>
											<tr><th>RENAULT MEGANE</th><td>1.5 DCI</td><td>Dizel</td><td>MANUEL</td></tr>
											<tr><th>DACIA DUSTER</th><td>1.5 DCI</td><td>Dizel</td><td>MANUEL</td></tr>
											<tr><th>RENAULT KANGOO</th><td>1.6</td><td>Benzin</td><td>MANUEL</td></tr>
											<tr><th>DACIA LODGY</th><td>1.5 DCI</td><td>Dizel</td><td>MANUEL</td></tr>
											<tr><th>RENAULT CLIO</th><td>1.2</td><td>Benzin</td><td>MANUEL</td></tr>
											<tr><th>RENAULT CAPTUR</th><td>1.5 DCI</td><td>Dizel</td><td>JR5=147=5 VITES MANUEL</td></tr>
											<tr><th>DACIA SANDERO</th><td>1.5 DCI</td><td>Dizel</td><td>JR5=346=5 VITES MANUEL</td></tr>
											<tr><th>DACIA LODGY</th><td>1.5 DCI</td><td>Dizel</td><td>JR5=351=5 VITES MANUEL</td></tr>
											<tr><th>DACIA LOGAN</th><td>1.5 DCI</td><td>Dizel</td><td>MANUEL</td></tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div id="product-tab-3" class="tab_content">
							<div class="conditions">
								<div class="product-info">
									<div class="table-responsive">
										<table class="table tabs-table table-bordered">
											<tbody>
												<tr><th>Araç Adı</th><td>Motor</td><td>Oem 1</td><td>Oem 2</td></tr>
												<tr><th>DACIA DUSTER</th><td>1.5 DCI</td><td>Dizel</td><td>MANUEL</td></tr>
												<tr><th>RENAULT KANGOO</th><td>1.6</td><td>Benzin</td><td>MANUEL</td></tr>
												<tr><th>DACIA LODGY</th><td>1.5 DCI</td><td>Dizel</td><td>MANUEL</td></tr>
												<tr><th>RENAULT CLIO</th><td>1.2</td><td>Benzin</td><td>MANUEL</td></tr>
												<tr><th>RENAULT CAPTUR</th><td>1.5 DCI</td><td>Dizel</td><td>JR5=147=5 VITES MANUEL</td></tr>
												<tr><th>DACIA SANDERO</th><td>1.5 DCI</td><td>Dizel</td><td>JR5=346=5 VITES MANUEL</td></tr>
												<tr><th>DACIA LODGY</th><td>1.5 DCI</td><td>Dizel</td><td>JR5=351=5 VITES MANUEL</td></tr>
												<tr><th>DACIA LOGAN</th><td>1.5 DCI</td><td>Dizel</td><td>MANUEL</td></tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div id="product-tab-4" class="tab_content">
							<div class="conditions">
								<div class="table-responsive">
									<table class="table tabs-table table-bordered">
										<tbody>
											<tr><th>Versiyon</th><td>Export Model</td></tr>
											<tr><th>Diş Çapı (mm)</th><td>75</td></tr>
											<tr><th>Emme (mm)</th><td>8</td></tr>
											<tr><th>Egzos</th><td>8</td></tr>
											<tr><th>Yükselik (mm)</th><td>187</td></tr>
											<tr><th>Uzunluk (mm)</th><td>113</td></tr>
											<tr><th>Genişlik (mm)</th><td>95</td></tr>
											<tr><th>Garanti Süresi (Ay)</th><td>12</td></tr>
											<tr><th>Yurt Dışı Satış</th><td>Yok</td></tr>
											<tr><th>Stok Kodu</th><td>194999842</td></tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					-->
						<div id="product-tab-5" class="tab_content">
							<div class="conditions">
								<p>İncelediğiniz ürün, doğrudan parcafilosu.com tarafından size kargoyla gönderilecektir. Kargo takip numarası email ve SMS ile iletilecektir.</p>

								<p>Ürünün adresinize teslim tarihinden itibaren 14 gün içinde iade şartları doğrultusunda iade yapabilirsiniz.</p>

								<p>İadelerinizi anlaşmalı olduğumuz kargo firmaları ile göndermeniz gerekmektedir. İadenizin kabul edilmesi için, ürünün hasar görmemiş ve kullanılmamış olması gerekmektedir.</p>

								<p>İade etmek istediğiniz ürün, tarafımızdan üretici/ithalatçı firmaya ulaştırılacak ve iade işlemleriniz Parcafilosu.com tarafından takip edilecektir.</p>

								<p>Daha detaylı bilgi için Kolay İade sayfasını ziyaret edebilirsiniz.</p>

								<p>* Bedel İadesi: İade işlemi sonuçlandıktan sonra bedel ödemesi kredi kartınıza/banka hesabınıza 24 saat içinde yapılmaktadır. Ödeme işlemlerinin hesabınıza yansıma süresi bankanıza göre değişkenlik gösterebilir.</p>
							</div>
						</div>
						
						<div id="product-tab-6" class="tab_content">
							<div class="Comments">
								<div class="Comment-item">
									<div class="Comment-head">
										<div class="item">
											<div class="Name">Serdar A.</div>
										</div>
										<div class="item">
											<div class="Stars">
												<i class="fa fa-star OK" aria-hidden="true"></i>
												<i class="fa fa-star OK" aria-hidden="true"></i>
												<i class="fa fa-star OK" aria-hidden="true"></i>
												<i class="fa fa-star OK" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
											</div>
											<div class="Date">03.11.2018 - Cumartesi</div>
										</div>
									</div>
									<div class="Comment-content">
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate beatae reprehenderit, nemo recusandae neque eum! Numquam assumenda, laudantium tempora qui debitis quaerat. Eaque quia velit amet, error repellat nostrum nihil!</p>
									</div>
								</div>

								<div class="Comment-item">
									<div class="Comment-head">
										<div class="item">
											<div class="Name">Serdar A.</div>
										</div>
										<div class="item">
											<div class="Stars">
												<i class="fa fa-star OK" aria-hidden="true"></i>
												<i class="fa fa-star OK" aria-hidden="true"></i>
												<i class="fa fa-star OK" aria-hidden="true"></i>
												<i class="fa fa-star OK" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
											</div>
											<div class="Date">03.11.2018 - Cumartesi</div>
										</div>
									</div>
									<div class="Comment-content">
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate beatae reprehenderit, nemo recusandae neque eum! Numquam assumenda, laudantium tempora qui debitis quaerat. Eaque quia velit amet, error repellat nostrum nihil!</p>
									</div>
								</div>

								<div class="Comment-item">
									<div class="Comment-head">
										<div class="item">
											<div class="Name">Serdar A.</div>
										</div>
										<div class="item">
											<div class="Stars">
												<i class="fa fa-star OK" aria-hidden="true"></i>
												<i class="fa fa-star OK" aria-hidden="true"></i>
												<i class="fa fa-star OK" aria-hidden="true"></i>
												<i class="fa fa-star OK" aria-hidden="true"></i>
												<i class="fa fa-star" aria-hidden="true"></i>
											</div>
											<div class="Date">03.11.2018 - Cumartesi</div>
										</div>
									</div>
									<div class="Comment-content">
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate beatae reprehenderit, nemo recusandae neque eum! Numquam assumenda, laudantium tempora qui debitis quaerat. Eaque quia velit amet, error repellat nostrum nihil!</p>
									</div>
								</div>
							</div>
						</div>
						<div id="product-tab-7" class="tab_content">
							<button class="sendQuestion">Soru Sor</button>
							<hr>
							<div class="CustomerReviewsArea">
								<div class="customer-comment">
									<h5>Murat Can</h5>
									<p class="comment-line">Ben şimdi bu ürünü aldım ? neden aldım ? niçin aldım ? nasıl aldım bilmiyorum ama aldım. Sonuç olarak aldığım üründen memnunmuyum ? memnunsam neden memnunum ?</p>
									<b>12.10.2018 - 20:35</b>
								</div>

								<div class="co-comment">
									<h5>Otoparcasan.com</h5>
									<p class="comment-line">Sevgili murat can az iç çok çalış god blessing you !</p>
									<b>12.10.2018 - 22:10</b>
								</div>
								<hr>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

<!--
		<div class="Suggested">
			<div class="row">
				<div class="col-12">
					<div class="pageTitle">DİĞER REFERANSLAR</div>
				</div>
				<div class="col-12">
					<div class="ref-item-area">
						<table class="table  ref-items">
							<tbody>
								<tr onclick="window.location='google.com'" style="cursor: pointer;">
									<td scope="row" class="logo"><img src="<?=site_url('assets/Front/images/carbrand/marka8.webp')?>"></td>
									<td class="stok-no">TRIPLE QX Tam Sentetik Motor Yağı 5W-40 - 5Ltr</td>
									<td class="stok-no">Stok Kodu : 301649</td>
									<td class="price"><p>9.99 ₺</p></td>
									<td class="star">
										<p>
											<i class="fa fa-star OK" aria-hidden="true"></i>
											<i class="fa fa-star OK" aria-hidden="true"></i>
											<i class="fa fa-star OK" aria-hidden="true"></i>
											<i class="fa fa-star OK" aria-hidden="true"></i>
											<i class="fa fa-star" aria-hidden="true"></i>
										</p>
										<p>4.89<b>/ 5</b></p>
									</td>

									<td><a href="#"> <i class="fa fa-chevron-right" aria-hidden="true"></i></a></td>
								</tr>
								<tr  onclick="window.location='google.com'" style="cursor: pointer;">
									<td scope="row" class="logo"><img src="<?=site_url('assets/Front/images/carbrand/marka7.webp')?>"></td>
									<td class="stok-no">TRIPLE QX Tam Sentetik Motor Yağı 5W-40 - 5Ltr</td>
									<td class="stok-no">Stok Kodu : 301649</td>
									<td class="price"><p>4169.99 ₺</p></td>
									<td class="star">
										<p>
											<i class="fa fa-star OK" aria-hidden="true"></i>
											<i class="fa fa-star OK" aria-hidden="true"></i>
											<i class="fa fa-star OK" aria-hidden="true"></i>
											<i class="fa fa-star OK" aria-hidden="true"></i>
											<i class="fa fa-star" aria-hidden="true"></i>
										</p>
										<p>4.89<b>/ 5</b></p>
									</td>

									<td><a href="#"> <i class="fa fa-chevron-right" aria-hidden="true"></i></a></td>
								</tr>
								<tr  onclick="window.location='google.com'" style="cursor: pointer;">
									<td scope="row" class="logo"><img src="<?=site_url('assets/Front/images/carbrand/marka6.webp')?>"></td>
									<td class="stok-no">TRIPLE QX Tam Sentetik Motor Yağı 5W-40 - 5Ltr</td>
									<td class="stok-no">Stok Kodu : 301649</td>
									<td class="price"><p>69.99 ₺</p></td>
									<td class="star">
										<p>
											<i class="fa fa-star OK" aria-hidden="true"></i>
											<i class="fa fa-star OK" aria-hidden="true"></i>
											<i class="fa fa-star OK" aria-hidden="true"></i>
											<i class="fa fa-star OK" aria-hidden="true"></i>
											<i class="fa fa-star" aria-hidden="true"></i>
										</p>
										<p>4.89<b>/ 5</b></p>
									</td>

									<td><a href="#"> <i class="fa fa-chevron-right" aria-hidden="true"></i></a></td>
								</tr>
								<tr  onclick="window.location='google.com'" style="cursor: pointer;">
									<td scope="row" class="logo"><img src="<?=site_url('assets/Front/images/carbrand/marka5.webp')?>"></td>
									<td class="stok-no">TRIPLE QX Tam Sentetik Motor Yağı 5W-40 - 5Ltr</td>
									<td class="stok-no">Stok Kodu : 301649</td>
									<td class="price"><p>2169.99 ₺</p></td>
									<td class="star">
										<p>
											<i class="fa fa-star OK" aria-hidden="true"></i>
											<i class="fa fa-star OK" aria-hidden="true"></i>
											<i class="fa fa-star OK" aria-hidden="true"></i>
											<i class="fa fa-star OK" aria-hidden="true"></i>
											<i class="fa fa-star" aria-hidden="true"></i>
										</p>
										<p>4.89<b>/ 5</b></p>
									</td>

									<td><a href="#"> <i class="fa fa-chevron-right" aria-hidden="true"></i></a></td>
								</tr>
								<tr  onclick="window.location='google.com'" style="cursor: pointer;">
									<td scope="row" class="logo"><img src="<?=site_url('assets/Front/images/carbrand/marka4.webp')?>"></td>
									<td class="stok-no">TRIPLE QX Tam Sentetik Motor Yağı 5W-40 - 5Ltr</td>
									<td class="stok-no">Stok Kodu : 301649</td>
									<td class="price"><p>169.99 ₺</p></td>
									<td class="star">
										<p>
											<i class="fa fa-star OK" aria-hidden="true"></i>
											<i class="fa fa-star OK" aria-hidden="true"></i>
											<i class="fa fa-star OK" aria-hidden="true"></i>
											<i class="fa fa-star OK" aria-hidden="true"></i>
											<i class="fa fa-star" aria-hidden="true"></i>
										</p>
										<p>4.89<b>/ 5</b></p>
									</td>

									<td><a href="#"> <i class="fa fa-chevron-right" aria-hidden="true"></i></a></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	-->
		<div class="Suggested">
			<div class="row">
				<div class="col-12">
					<div class="pageTitle">BU ÜRÜNLER DE İLGİNİZİ ÇEKEBİLİR</div>
				</div>
				<div class="col-12">
					<div class="Onerlen-owl owl-carousel">
						<div class="item">
							<div class="list-item Small">
								<div class="list-img">
									<span class="ribbon"><span>Fırsat</span></span>
									<a href="#" class="img-link"><img src="<?=site_url('assets/Front/images/Detail/detail-img.webp')?>" alt=""></a>
								</div>
								<div class="list-content">
									<div class="product-head">
										<a href="#" class="ProductName">Özel Jantlar</a>
										<p class="productInfo">Mükemmel Titanyum Jant Kaapağı (14,16,18 in.)</p>
									</div>
									<div class="product-control">
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
										<div class="product-Price">
											<div class="price">159.99 TL</div>
											<div class="old-price">399.99 TL</div>
											<div class="addBasket">Hemen Al <i class="fa fa-chevron-right" aria-hidden="true"></i></div>

										</div>
										<div class="product-interaction">
											<div class="item mix">
												<div class="Icon"><i class="fa fa-random" aria-hidden="true"></i></div>
												<div class="txt">Karşılaştır</div>
											</div>
											<div class="item addFav">
												<div class="Icon"><i class="fa fa-heart" aria-hidden="true"></i></div>
												<div class="txt">Favori<span>lere Ekle</span></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="list-item Small">
								<div class="list-img">
									<span class="ribbon"><span>Fırsat</span></span>
									<a href="#" class="img-link"><img src="<?=site_url('assets/Front/images/Detail/detail-img.webp')?>" alt=""></a>
								</div>
								<div class="list-content">
									<div class="product-head">
										<a href="#" class="ProductName">Özel Jantlar</a>
										<p class="productInfo">Mükemmel Titanyum Jant Kaapağı (14,16,18 in.)</p>
									</div>
									<div class="product-control">
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
										<div class="product-Price">
											<div class="price">159.99 TL</div>
											<div class="old-price">399.99 TL</div>
											<div class="addBasket">Hemen Al <i class="fa fa-chevron-right" aria-hidden="true"></i></div>
										</div>
										<div class="product-interaction">
											<div class="item mix">
												<div class="Icon"><i class="fa fa-random" aria-hidden="true"></i></div>
												<div class="txt">Karşılaştır</div>
											</div>
											<div class="item addFav">
												<div class="Icon"><i class="fa fa-heart" aria-hidden="true"></i></div>
												<div class="txt">Favori<span>lere Ekle</span></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="list-item Small">
								<div class="list-img">
									<span class="ribbon"><span>Fırsat</span></span>
									<a href="#" class="img-link"><img src="<?=site_url('assets/Front/images/Detail/detail-img.webp')?>" alt=""></a>
								</div>
								<div class="list-content">
									<div class="product-head">
										<a href="#" class="ProductName">Özel Jantlar</a>
										<p class="productInfo">Mükemmel Titanyum Jant Kaapağı (14,16,18 in.)</p>
									</div>
									<div class="product-control">
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
										<div class="product-Price">
											<div class="price">159.99 TL</div>
											<div class="old-price">399.99 TL</div>
											<div class="addBasket">Hemen Al <i class="fa fa-chevron-right" aria-hidden="true"></i></div>
										</div>
										<div class="product-interaction">
											<div class="item mix">
												<div class="Icon"><i class="fa fa-random" aria-hidden="true"></i></div>
												<div class="txt">Karşılaştır</div>
											</div>
											<div class="item addFav">
												<div class="Icon"><i class="fa fa-heart" aria-hidden="true"></i></div>
												<div class="txt">Favori<span>lere Ekle</span></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="list-item Small">
								<div class="list-img">
									<span class="ribbon"><span>Fırsat</span></span>
									<a href="#" class="img-link"><img src="<?=site_url('assets/Front/images/Detail/detail-img.webp')?>" alt=""></a>
								</div>
								<div class="list-content">
									<div class="product-head">
										<a href="#" class="ProductName">Özel Jantlar</a>
										<p class="productInfo">Mükemmel Titanyum Jant Kaapağı (14,16,18 in.)</p>
									</div>
									<div class="product-control">
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
										<div class="product-Price">
											<div class="price">159.99 TL</div>
											<div class="old-price">399.99 TL</div>
											<div class="addBasket">Hemen Al <i class="fa fa-chevron-right" aria-hidden="true"></i></div>
										</div>
										<div class="product-interaction">
											<div class="item mix">
												<div class="Icon"><i class="fa fa-random" aria-hidden="true"></i></div>
												<div class="txt">Karşılaştır</div>
											</div>
											<div class="item addFav">
												<div class="Icon"><i class="fa fa-heart" aria-hidden="true"></i></div>
												<div class="txt">Favori<span>lere Ekle</span></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="list-item Small">
								<div class="list-img">
									<span class="ribbon"><span>Fırsat</span></span>
									<a href="#" class="img-link"><img src="<?=site_url('assets/Front/images/Detail/detail-img.webp')?>" alt=""></a>
								</div>
								<div class="list-content">
									<div class="product-head">
										<a href="#" class="ProductName">Özel Jantlar</a>
										<p class="productInfo">Mükemmel Titanyum Jant Kaapağı (14,16,18 in.)</p>
									</div>
									<div class="product-control">
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
										<div class="product-Price">
											<div class="price">159.99 TL</div>
											<div class="old-price">399.99 TL</div>
											<div class="addBasket">Hemen Al <i class="fa fa-chevron-right" aria-hidden="true"></i></div>
										</div>
										<div class="product-interaction">
											<div class="item mix">
												<div class="Icon"><i class="fa fa-random" aria-hidden="true"></i></div>
												<div class="txt">Karşılaştır</div>
											</div>
											<div class="item addFav">
												<div class="Icon"><i class="fa fa-heart" aria-hidden="true"></i></div>
												<div class="txt">Favori<span>lere Ekle</span></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="list-item Small">
								<div class="list-img">
									<span class="ribbon"><span>Fırsat</span></span>
									<a href="#" class="img-link"><img src="<?=site_url('assets/Front/images/Detail/detail-img.webp')?>" alt=""></a>
								</div>
								<div class="list-content">
									<div class="product-head">
										<a href="#" class="ProductName">Özel Jantlar</a>
										<p class="productInfo">Mükemmel Titanyum Jant Kaapağı (14,16,18 in.)</p>
									</div>
									<div class="product-control">
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
										<div class="product-Price">
											<div class="price">159.99 TL</div>
											<div class="old-price">399.99 TL</div>
											<div class="addBasket">Hemen Al <i class="fa fa-chevron-right" aria-hidden="true"></i></div>
										</div>
										<div class="product-interaction">
											<div class="item mix">
												<div class="Icon"><i class="fa fa-random" aria-hidden="true"></i></div>
												<div class="txt">Karşılaştır</div>
											</div>
											<div class="item addFav">
												<div class="Icon"><i class="fa fa-heart" aria-hidden="true"></i></div>
												<div class="txt">Favori<span>lere Ekle</span></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="list-item Small">
								<div class="list-img">
									<span class="ribbon"><span>Fırsat</span></span>
									<a href="#" class="img-link"><img src="<?=site_url('assets/Front/images/Detail/detail-img.webp')?>" alt=""></a>
								</div>
								<div class="list-content">
									<div class="product-head">
										<a href="#" class="ProductName">Özel Jantlar</a>
										<p class="productInfo">Mükemmel Titanyum Jant Kaapağı (14,16,18 in.)</p>
									</div>
									<div class="product-control">
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
										<div class="product-Price">
											<div class="price">159.99 TL</div>
											<div class="old-price">399.99 TL</div>
											<div class="addBasket">Hemen Al <i class="fa fa-chevron-right" aria-hidden="true"></i></div>
										</div>
										<div class="product-interaction">
											<div class="item mix">
												<div class="Icon"><i class="fa fa-random" aria-hidden="true"></i></div>
												<div class="txt">Karşılaştır</div>
											</div>
											<div class="item addFav">
												<div class="Icon"><i class="fa fa-heart" aria-hidden="true"></i></div>
												<div class="txt">Favori<span>lere Ekle</span></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="list-item Small">
								<div class="list-img">
									<span class="ribbon"><span>Fırsat</span></span>
									<a href="#" class="img-link"><img src="<?=site_url('assets/Front/images/Detail/detail-img.webp')?>" alt=""></a>
								</div>
								<div class="list-content">
									<div class="product-head">
										<a href="#" class="ProductName">Özel Jantlar</a>
										<p class="productInfo">Mükemmel Titanyum Jant Kaapağı (14,16,18 in.)</p>
									</div>
									<div class="product-control">
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
										<div class="product-Price">
											<div class="price">159.99 TL</div>
											<div class="old-price">399.99 TL</div>
											<div class="addBasket">Hemen Al <i class="fa fa-chevron-right" aria-hidden="true"></i></div>
										</div>
										<div class="product-interaction">
											<div class="item mix">
												<div class="Icon"><i class="fa fa-random" aria-hidden="true"></i></div>
												<div class="txt">Karşılaştır</div>
											</div>
											<div class="item addFav">
												<div class="Icon"><i class="fa fa-heart" aria-hidden="true"></i></div>
												<div class="txt">Favori<span>lere Ekle</span></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="list-item Small">
								<div class="list-img">
									<span class="ribbon"><span>Fırsat</span></span>
									<a href="#" class="img-link"><img src="<?=site_url('assets/Front/images/Detail/detail-img.webp')?>" alt=""></a>
								</div>
								<div class="list-content">
									<div class="product-head">
										<a href="#" class="ProductName">Özel Jantlar</a>
										<p class="productInfo">Mükemmel Titanyum Jant Kaapağı (14,16,18 in.)</p>
									</div>
									<div class="product-control">
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
										<div class="product-Price">
											<div class="price">159.99 TL</div>
											<div class="old-price">399.99 TL</div>
											<div class="addBasket">Hemen Al <i class="fa fa-chevron-right" aria-hidden="true"></i></div>
										</div>
										<div class="product-interaction">
											<div class="item mix">
												<div class="Icon"><i class="fa fa-random" aria-hidden="true"></i></div>
												<div class="txt">Karşılaştır</div>
											</div>
											<div class="item addFav">
												<div class="Icon"><i class="fa fa-heart" aria-hidden="true"></i></div>
												<div class="txt">Favori<span>lere Ekle</span></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="list-item Small">
								<div class="list-img">
									<span class="ribbon"><span>Fırsat</span></span>
									<a href="#" class="img-link"><img src="<?=site_url('assets/Front/images/Detail/detail-img.webp')?>" alt=""></a>
								</div>
								<div class="list-content">
									<div class="product-head">
										<a href="#" class="ProductName">Özel Jantlar</a>
										<p class="productInfo">Mükemmel Titanyum Jant Kaapağı (14,16,18 in.)</p>
									</div>
									<div class="product-control">
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
										<div class="product-Price">
											<div class="price">159.99 TL</div>
											<div class="old-price">399.99 TL</div>
											<div class="addBasket">Hemen Al <i class="fa fa-chevron-right" aria-hidden="true"></i></div>
										</div>
										<div class="product-interaction">
											<div class="item mix">
												<div class="Icon"><i class="fa fa-random" aria-hidden="true"></i></div>
												<div class="txt">Karşılaştır</div>
											</div>
											<div class="item addFav">
												<div class="Icon"><i class="fa fa-heart" aria-hidden="true"></i></div>
												<div class="txt">Favori<span>lere Ekle</span></div>
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
</section>
<!-- / pageContent -->