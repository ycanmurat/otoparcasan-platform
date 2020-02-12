<!-- Header -->
<div class="topBanner">
	<a href="index.php" class="topbar-link" style="background-image: url(images/topbar-ads.jpg);"></a>
</div>
<header>
	<div class="container-fluid">
		<div class="headTop">
			<div class="row">
				
				<div class="col-9 text-center">
					<div class="topTelephone">
						<i class="fa fa-phone" aria-hidden="true"></i>
						0555 000 00 00 
						<i class="fa fa-envelope" aria-hidden="true"></i> info@otoparcasan.com 
					</div>
				</div>
				
				<div class="col-3">
					<div class="item Stars">
						<i class="fa fa-star OK"></i>
						<i class="fa fa-star OK"></i>
						<i class="fa fa-star OK"></i>
						<i class="fa fa-star OK"></i>
						<i class="fa fa-star OK"></i>
						<a href="reviews.php">4.89 / 5 &nbsp&nbsp( 1162342 - Geri Bildirim )</a>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="Nav navbar navbar-inverse">



					<div class="nav navbar-nav navbar-right order-lg-3 order-sm-2">
						<div class="UserNav">
							<ul class="List">
								<li class="Item Login">
									<a href="login.php" class="Item">
										<div class="Icon"><img src="images/Icons/h-member.png" alt=""></div>
										<span>Giriş</span>
									</a>
								</li>
								<li class="Item Notification">
									<a href="notifications.php" class="Item">
										<div class="Icon">
											<img src="images/Icons/h-notif.png" alt="">
											<span class="dataNum">1</span>
										</div>
										<span>Bildirim</span>
									</a>
								</li>

								<li class="Item Fav">
									<a href="favorites.php" class="Item">
										<div class="Icon"><img src="images/Icons/h-fav.png" alt=""></div>
										<span>Favoriler</span>
									</a>
								</li>
								<li class="Item mobileHamburger">
									<a href="javascript:void(0)" class="Item">
										<div class="Icon"><img src="images/Icons/h-menu.png" alt=""></div>
										<span>Menü</span>
									</a>
								</li>
								<li class="Item Cart">
									<a href="cart.php" class="Item">
										<div class="Icon">
											<img src="images/Icons/h-cart.png" alt="">
											<span class="dataNum">3</span>
										</div>
										<span>Sepet</span>
									</a>

									<div class="Dropdown CartDropdown">
										<!--Sepet Ayrıntıları -->
										<div class="DropdownContent CartPreview SepetDolu">
											<ul class="List ChartProducts">
												<li class="Item">
													<div class="Left">
														<div class="Img">
															<img width="76" src="images/product.png" alt="">
														</div>
														<div class="productInfo">
															<a href="product-detail.php" class="ProductName">Triple QX Tam Sentetik Motor Yağı</a>
															<span class="Features">Güç : 5W-40 - 5Ltr</span>
															<span class="Features">Ürün Kodu : 1266842</span>
														</div>
													</div>
													<div class="Right">
														<div class="Price">219.5 TL</div>
													</div>
													<div class="DeleteItem" onclick="ChartProductRemove(0)">
														<i class="fa fa-times" aria-hidden="true"></i>
													</div>
												</li>
											</ul>

											<div class="DropdownFooter">
												<div class="Left">
													<div class="TotalPrice">
														<div class="Text">Toplam (KDV Dahil)</div>
														<div class="Total TotalPriceCur">219.5 TL</div>
													</div>
												</div>
												<div class="Right">
													<a href="cart.php" class="Btn Green-d">
														Sipariş Ver <i class="fa fa-angle-right" aria-hidden="true"></i>
													</a>
												</div>
											</div>
										</div>
										<div class="DropdownContent Empty SepetBos" style="display: none;">
											<p><span>Sepetinizde Ürün</span>Bulunmamaktadır</p>
										</div>
									</div>
								</li>


							</ul>
						</div>
					</div>
					<a class="navbar-brand" href="index.php"><img class="HeaderLogo" src="images/logofinali.png"></a>

					<div class="Search col-lg col-12 order-lg-2 order-sm-3">
						<form action="#" method="get">
							<div class="SearchBox">
								<input type="text" class="searchInput" placeholder="Parça No, Şase No, Oem No'ya Göre Ara" name="search">
								<button class="searchBtn"><img src="images/Icons/search-icon.png"></button>
							</div>
						</form>
					</div>


				</div>
			</div>
		</div>
	</div>
</header>

<div class="CloseNav"><i class="fa fa-times" aria-hidden="true"></i></div>
<nav class="NavMenu p-lr">
	<div class="MobileTopBar">
		<div class="item">
			<a href="reviews.php" class="AppLink"><i class="fa fa-comments" aria-hidden="true"></i> Yorumlar</a>
		</div>
		<div class="item">
			<div id="LangSelectm" class="LanguageSelect">
				<img src="images/tr.png" alt="">
				TR
				<div class="LanguageSelectArea m">
					<ul>
						<li><a href="#">EN</a></li>
						<li><a href="#">DE</a></li>
						<li><a href="#">FR</a></li>
						<li><a href="#">中国</a></li>
						<li><a href="#">العربية </a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="MobileMenuBar">
		<div class="T">Merhaba, <!-- <span>Serdar A.</span>  // Giriş Yapınca Gözükcek --></div>
		<div class="sT">Siparişinizi kontrol etmek için giriş yapın veya kayıt olun.</div> <!-- Giriş Yapınca Gizlencek -->
		<div class="Control">
			<!-- Giriş Yapmadıysa -->
			<a href="login.php" class="Link">Giriş Yap</a> <span class="Or">veya</span> <a href="register.php" class="Link">Kayıt Ol</a>

			<!-- Giriş Yaptıysa
				<a href="account.php" class="Link">Hesabım</a> <a href="orders.php" class="Link">Siparişlerim</a>
			-->
		</div>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<ul class="menu">
					<li><a href="yedekpart.php"><i class="fa fa-bars" aria-hidden="true"></i>YEDEK PARÇALAR</a></li>
					<li>
						<h3><a href="altpartpage.php"> Fren ve Debriyaj <i class="fa fa-chevron-right" aria-hidden="true"></i></a></h3>
						<div class="nav-dropdown">
							<div class="item">
								<div class="T">Fren</div>
								<a href="listing_full.php" class="Link">ABS Sensörleri</a>
								<a href="listing.php" class="Link">Harita-Buddy</a>
								<a href="listing.php" class="Link">MIKO</a>
								<a href="listing.php" class="Link">Tom Tom</a>
								<a href="listing.php" class="Link">Özel ışıklar</a>
								<a href="listing.php" class="Link">Racing Tekerler</a>
								<a href="listing.php" class="Link">Otoparçasan Ürünleri</a>
								<a href="listing.php" class="Link">Lorem İpsum</a>
								<a href="listing.php" class="Link">Dolor Sit Amet</a>
								<a href="listing.php" class="Link">Test Test Test Test</a>
								<a href="listing.php" class="Link">Test Test Test Test</a>
								<a href="listing.php" class="Link viewMore">.. Devamını Göster</a>
							</div>
							<div class="item">
								<div class="T">Debriyaj</div>
								<a href="listing.php" class="Link">Motor Takviyeler</a>
								<a href="listing.php" class="Link">Yağlar ve Sıvılar</a>
								<a href="listing.php" class="Link">Yıkama sıvıları</a>
								<a href="listing.php" class="Link">Özel ışıklar</a>
								<a href="listing.php" class="Link">MIKO</a>
							</div>
							<div class="item imageCard pr-0">
								<a href=""><img src="images/menuimage1.png" alt=""></a>
							</div>
						</div>
					</li>
					<li>
						<h3><a href=""> Motor ve Egzoz <i class="fa fa-chevron-right" aria-hidden="true"></i></a></h3>
						<div class="nav-dropdown">
							<div class="item">
								<div class="T">Motor</div>
								<a href="listing.php" class="Link">Hi-Nav</a>
								<a href="listing.php" class="Link">Harita-Buddy</a>
								<a href="listing.php" class="Link">MIKO</a>
								<a href="listing.php" class="Link">Tom Tom</a>
								<a href="listing.php" class="Link">Özel ışıklar</a>
								<a href="listing.php" class="Link">Racing Tekerler</a>
								<a href="listing.php" class="Link">Otoparçasan Ürünleri</a>
								<a href="listing.php" class="Link">Lorem İpsum</a>
								<a href="listing.php" class="Link">Dolor Sit Amet</a>
								<a href="listing.php" class="Link">Test Test Test Test</a>
								<a href="listing.php" class="Link">Test Test Test Test</a>
								<a href="listing.php" class="Link viewMore">.. Devamını Göster</a>
							</div>
							<div class="item">
								<div class="T">Egzoz</div>
								<a href="listing.php" class="Link">Motor Takviyeler</a>
								<a href="listing.php" class="Link">Yağlar ve Sıvılar</a>
								<a href="listing.php" class="Link">Yıkama sıvıları</a>
								<a href="listing.php" class="Link">Özel ışıklar</a>
								<a href="listing.php" class="Link">MIKO</a>
							</div>
							<div class="item imageCard pr-0">
								<a href=""><img src="images/menuimage1.png" alt=""></a>
							</div>
						</div>
					</li>

					<li>
						<h3><a href=""> Süspansiyon ve Direksiyon <i class="fa fa-chevron-right" aria-hidden="true"></i></a></h3>
						<div class="nav-dropdown">
							<div class="item">
								<div class="T">Süspansiyon</div>
								<a href="listing.php" class="Link">Hi-Nav</a>
								<a href="listing.php" class="Link">Harita-Buddy</a>
								<a href="listing.php" class="Link">MIKO</a>
								<a href="listing.php" class="Link">Tom Tom</a>
								<a href="listing.php" class="Link">Özel ışıklar</a>
								<a href="listing.php" class="Link">Racing Tekerler</a>
								<a href="listing.php" class="Link">Otoparçasan Ürünleri</a>
								<a href="listing.php" class="Link">Lorem İpsum</a>
								<a href="listing.php" class="Link">Dolor Sit Amet</a>
								<a href="listing.php" class="Link">Test Test Test Test</a>
								<a href="listing.php" class="Link">Test Test Test Test</a>
								<a href="listing.php" class="Link viewMore">.. Devamını Göster</a>
							</div>
							<div class="item">
								<div class="T">Direksiyon</div>
								<a href="listing.php" class="Link">Motor Takviyeler</a>
								<a href="listing.php" class="Link">Yağlar ve Sıvılar</a>
								<a href="listing.php" class="Link">Yıkama sıvıları</a>
								<a href="listing.php" class="Link">Özel ışıklar</a>
								<a href="listing.php" class="Link">MIKO</a>
							</div>
							<div class="item imageCard pr-0">
								<a href=""><img src="images/menuimage1.png" alt=""></a>
							</div>
						</div>
					</li>
					<li>
						<h3><a href=""> Elektrik ve Aydınlatma <i class="fa fa-chevron-right" aria-hidden="true"></i></a></h3>
						<div class="nav-dropdown">
							<div class="item">
								<div class="T">Elektrik</div>
								<a href="listing.php" class="Link">Hi-Nav</a>
								<a href="listing.php" class="Link">Harita-Buddy</a>
								<a href="listing.php" class="Link">MIKO</a>
								<a href="listing.php" class="Link">Tom Tom</a>
								<a href="listing.php" class="Link">Özel ışıklar</a>
								<a href="listing.php" class="Link">Racing Tekerler</a>
								<a href="listing.php" class="Link">Otoparçasan Ürünleri</a>
								<a href="listing.php" class="Link">Lorem İpsum</a>
								<a href="listing.php" class="Link">Dolor Sit Amet</a>
								<a href="listing.php" class="Link">Test Test Test Test</a>
								<a href="listing.php" class="Link">Test Test Test Test</a>
								<a href="listing.php" class="Link viewMore">.. Devamını Göster</a>
							</div>
							<div class="item">
								<div class="T">Aydınlatma</div>
								<a href="listing.php" class="Link">Motor Takviyeler</a>
								<a href="listing.php" class="Link">Yağlar ve Sıvılar</a>
								<a href="listing.php" class="Link">Yıkama sıvıları</a>
								<a href="listing.php" class="Link">Özel ışıklar</a>
								<a href="listing.php" class="Link">MIKO</a>
							</div>
							<div class="item imageCard pr-0">
								<a href=""><img src="images/menuimage1.png" alt=""></a>
							</div>
						</div>
					</li>
					<li>
						<h3><a href=""> Kaporta ve Trim <i class="fa fa-chevron-right" aria-hidden="true"></i></a></h3>
						<div class="nav-dropdown">
							<div class="item">
								<div class="T">Kaporta</div>
								<a href="listing.php" class="Link">Hi-Nav</a>
								<a href="listing.php" class="Link">Harita-Buddy</a>
								<a href="listing.php" class="Link">MIKO</a>
								<a href="listing.php" class="Link">Tom Tom</a>
								<a href="listing.php" class="Link">Özel ışıklar</a>
								<a href="listing.php" class="Link">Racing Tekerler</a>
								<a href="listing.php" class="Link">Otoparçasan Ürünleri</a>
								<a href="listing.php" class="Link">Lorem İpsum</a>
								<a href="listing.php" class="Link">Dolor Sit Amet</a>
								<a href="listing.php" class="Link">Test Test Test Test</a>
								<a href="listing.php" class="Link">Test Test Test Test</a>
								<a href="listing.php" class="Link viewMore">.. Devamını Göster</a>
							</div>
							<div class="item">
								<div class="T">Trim</div>
								<a href="listing.php" class="Link">Motor Takviyeler</a>
								<a href="listing.php" class="Link">Yağlar ve Sıvılar</a>
								<a href="listing.php" class="Link">Yıkama sıvıları</a>
								<a href="listing.php" class="Link">Özel ışıklar</a>
								<a href="listing.php" class="Link">MIKO</a>
							</div>
							<div class="item imageCard pr-0">
								<a href=""><img src="images/menuimage1.png" alt=""></a>
							</div>
						</div>
					</li>
					<li>
						<h3><a href=""> Şanzıman ve Difransiyel <i class="fa fa-chevron-right" aria-hidden="true"></i></a></h3>
						<div class="nav-dropdown">
							<div class="item">
								<div class="T">Şanzıman</div>
								<a href="listing.php" class="Link">Hi-Nav</a>
								<a href="listing.php" class="Link">Harita-Buddy</a>
								<a href="listing.php" class="Link">MIKO</a>
								<a href="listing.php" class="Link">Tom Tom</a>
								<a href="listing.php" class="Link">Özel ışıklar</a>
								<a href="listing.php" class="Link">Racing Tekerler</a>
								<a href="listing.php" class="Link">Otoparçasan Ürünleri</a>
								<a href="listing.php" class="Link">Lorem İpsum</a>
								<a href="listing.php" class="Link">Dolor Sit Amet</a>
								<a href="listing.php" class="Link">Test Test Test Test</a>
								<a href="listing.php" class="Link">Test Test Test Test</a>
								<a href="listing.php" class="Link viewMore">.. Devamını Göster</a>
							</div>
							<div class="item">
								<div class="T">Difransiyel</div>
								<a href="listing.php" class="Link">Motor Takviyeler</a>
								<a href="listing.php" class="Link">Yağlar ve Sıvılar</a>
								<a href="listing.php" class="Link">Yıkama sıvıları</a>
								<a href="listing.php" class="Link">Özel ışıklar</a>
								<a href="listing.php" class="Link">MIKO</a>
							</div>
							<div class="item imageCard pr-0">
								<a href=""><img src="images/menuimage1.png" alt=""></a>
							</div>
						</div>
					</li>
					<li>
						<h3><a href=""> Soğutma ve Filtreler <i class="fa fa-chevron-right" aria-hidden="true"></i></a></h3>
						<div class="nav-dropdown">
							<div class="item">
								<div class="T">Soğutma</div>
								<a href="listing.php" class="Link">Hi-Nav</a>
								<a href="listing.php" class="Link">Harita-Buddy</a>
								<a href="listing.php" class="Link">MIKO</a>
								<a href="listing.php" class="Link">Tom Tom</a>
								<a href="listing.php" class="Link">Özel ışıklar</a>
								<a href="listing.php" class="Link">Racing Tekerler</a>
								<a href="listing.php" class="Link">Otoparçasan Ürünleri</a>
								<a href="listing.php" class="Link">Lorem İpsum</a>
								<a href="listing.php" class="Link">Dolor Sit Amet</a>
								<a href="listing.php" class="Link">Test Test Test Test</a>
								<a href="listing.php" class="Link">Test Test Test Test</a>
								<a href="listing.php" class="Link viewMore">.. Devamını Göster</a>
							</div>
							<div class="item">
								<div class="T">Filtreler</div>
								<a href="listing.php" class="Link">Motor Takviyeler</a>
								<a href="listing.php" class="Link">Yağlar ve Sıvılar</a>
								<a href="listing.php" class="Link">Yıkama sıvıları</a>
								<a href="listing.php" class="Link">Özel ışıklar</a>
								<a href="listing.php" class="Link">MIKO</a>
							</div>
							<div class="item imageCard pr-0">
								<a href=""><img src="images/menuimage1.png" alt=""></a>
							</div>
						</div>
					</li>
					<li>
						<h3><a href=""> Yakıt ve Enjeksiyon <i class="fa fa-chevron-right" aria-hidden="true"></i></a></h3>
						<div class="nav-dropdown">
							<div class="item">
								<div class="T">Yakıt</div>
								<a href="listing.php" class="Link">Hi-Nav</a>
								<a href="listing.php" class="Link">Harita-Buddy</a>
								<a href="listing.php" class="Link">MIKO</a>
								<a href="listing.php" class="Link">Tom Tom</a>
								<a href="listing.php" class="Link">Özel ışıklar</a>
								<a href="listing.php" class="Link">Racing Tekerler</a>
								<a href="listing.php" class="Link">Otoparçasan Ürünleri</a>
								<a href="listing.php" class="Link">Lorem İpsum</a>
								<a href="listing.php" class="Link">Dolor Sit Amet</a>
								<a href="listing.php" class="Link">Test Test Test Test</a>
								<a href="listing.php" class="Link">Test Test Test Test</a>
								<a href="listing.php" class="Link viewMore">.. Devamını Göster</a>
							</div>
							<div class="item">
								<div class="T">Enjeksiyon</div>
								<a href="listing.php" class="Link">Motor Takviyeler</a>
								<a href="listing.php" class="Link">Yağlar ve Sıvılar</a>
								<a href="listing.php" class="Link">Yıkama sıvıları</a>
								<a href="listing.php" class="Link">Özel ışıklar</a>
								<a href="listing.php" class="Link">MIKO</a>
							</div>
							<div class="item imageCard pr-0">
								<a href=""><img src="images/menuimage1.png" alt=""></a>
							</div>
						</div>
					</li>
					<li>
						<h3><a href=""> Yağlar ve Sıvılar <i class="fa fa-chevron-right" aria-hidden="true"></i></a></h3>
						<div class="nav-dropdown">
							<div class="item">
								<div class="T">Yağlar</div>
								<a href="listing.php" class="Link">Hi-Nav</a>
								<a href="listing.php" class="Link">Harita-Buddy</a>
								<a href="listing.php" class="Link">MIKO</a>
								<a href="listing.php" class="Link">Tom Tom</a>
								<a href="listing.php" class="Link">Özel ışıklar</a>
								<a href="listing.php" class="Link">Racing Tekerler</a>
								<a href="listing.php" class="Link">Otoparçasan Ürünleri</a>
								<a href="listing.php" class="Link">Lorem İpsum</a>
								<a href="listing.php" class="Link">Dolor Sit Amet</a>
								<a href="listing.php" class="Link">Test Test Test Test</a>
								<a href="listing.php" class="Link">Test Test Test Test</a>
								<a href="listing.php" class="Link viewMore">.. Devamını Göster</a>
							</div>
							<div class="item">
								<div class="T">Sıvılar</div>
								<a href="listing.php" class="Link">Motor Takviyeler</a>
								<a href="listing.php" class="Link">Yağlar ve Sıvılar</a>
								<a href="listing.php" class="Link">Yıkama sıvıları</a>
								<a href="listing.php" class="Link">Özel ışıklar</a>
								<a href="listing.php" class="Link">MIKO</a>
							</div>
							<div class="item imageCard pr-0">
								<a href=""><img src="images/menuimage1.png" alt=""></a>
							</div>
						</div>
					</li>
					
				</ul>
				<ul class="temp">
					<li class="Menu1"><a href="bakimrobotu.php"><img src="images/Icons/1.png"> Bakım Robotu</a></li>
					<li class="Menu4"><a href="listing.php"><img src="images/Icons/2.png">Madeni Yağ</a></li>
					<li class="Menu5"><a href="listing_aksesuar.php"><img src="images/Icons/3.png">Aksesuarlar</a></li>
					<li class="Menu6"><a href="listing.php"><img src="images/Icons/4.png">Silecekler</a></li>
					<li class="Menu7"><a href="garage.php"><img src="images/Icons/5.png">Garajım</a></li>
					<li class="MenuK">

						<a href="campaigns.php"><img src="images/Icons/Discount.png"> Kampanyalar</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</nav>
<!-- / Header -->
