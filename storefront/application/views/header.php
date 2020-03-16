<!-- Header -->
<div class="topBanner">
	<div class="container-fluid p-lr">
		<div class="row">
			<div class="col-12">
				<div class="area">
					<h6>ARABANIZI TEKRAR YENİ HİSSETTİRİN <b>%50</b>'YE VARAN YAZ İNDİRİMLERİNİ KAÇIRMAYIN</h6>
					
					<div class="countdown">
						<p class="remaining">KAMPANYA BİTİŞİNE SON :</p>
						<span id="clock"></span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?=(!empty($banner)?'<a href="'.$banner->link.'" class="topbar-link" title="'.$banner->title.'" style="background-image: url('.site_url($banner->banner_url).');"></a>':'')?>
</div>
<header>
	<div class="container-fluid">
		<div class="headTop">
			<div class="row">
				
				<div class="col-9 text-center">
					
				</div>
				
				<div class="col-3">
					<div class="item Stars">
						<?if($stars->star < 2){?>
							<i class="fa fa-star OK"></i>
							<?}elseif($stars->star < 3){?>
								<i class="fa fa-star OK"></i>
								<i class="fa fa-star OK"></i>
								<?}elseif($stars->star < 4){?>
									<i class="fa fa-star OK"></i>
									<i class="fa fa-star OK"></i>
									<i class="fa fa-star OK"></i>
									<?}elseif($stars->star < 5){?>
										<i class="fa fa-star OK"></i>
										<i class="fa fa-star OK"></i>
										<i class="fa fa-star OK"></i>
										<i class="fa fa-star OK"></i>
										<?}else{?>
											<i class="fa fa-star OK"></i>
											<i class="fa fa-star OK"></i>
											<i class="fa fa-star OK"></i>
											<i class="fa fa-star OK"></i>
											<i class="fa fa-star OK"></i>
											<?}?>
											<a href="<?=site_url('Reviews')?>"><?=number_format($stars->star,1)?> / 5 &nbsp&nbsp ( <?=$countReviews?> - Geri Bildirim )</a>
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
													<?if (empty($this->session->userdata('userInfo'))) {?>
														<li class="Item Login">
															<a href="<?=site_url('User')?>" class="Item">
																<div class="Icon"><img src="<?=site_url('assets/Front/images/Icons/h-member.webp')?>" alt=""></div>
																<span>Giriş Yap</span>
															</a>
														</li>
														<?}else{?>
															<li id="dropdownUserOpen" class="Item Login">
																<a href="<?=site_url('Account')?>" class="Item">
																	<div class="Icon"><img src="<?=site_url('assets/Front/images/Icons/h-member.webp')?>" alt=""></div>
																	<span><?$writeName=explode(" ", $userInfo->name);echo $writeName[0];?></span>
																</a>
																<div class="dropdownUserMenu">
																	<div class="accountPanel">
																		<div class="panel-content">
																			<a href="<?=site_url('Account')?>" class="panel-link">
																				<div class="Icon">
																					<i class="fa fa-user" aria-hidden="true"></i>
																					<p>Üyelik Bilgilerim</p></div>
																				</a>
																				<a href="<?=site_url('Account/orders')?>" class="panel-link">
																					<div class="Icon">
																						<i class="fa fa-cube" aria-hidden="true"></i>
																						<p>Siparişlerim<span class="Count">122</span></p>
																					</div>
																				</a>
																				<a href="<?=site_url('Account/returns')?>" class="panel-link ">
																					<div class="Icon">
																						<i class="fa fa-reply" aria-hidden="true"></i>
																						<p>İadelerim<span class="Count">3</span></p>
																					</div>
																				</a>
																				<a href="<?=site_url('Account/questions')?>" class="panel-link ">
																					<div class="Icon">
																						<i class="fa fa-question-circle" aria-hidden="true"></i>
																						<p>Ürün Sorularım<span class="Count">3</span></p>
																					</div>
																				</a>
																				<a href="<?=site_url('Account/address')?>" class="panel-link ">
																					<div class="Icon">
																						<i class="fa fa-map-marker" aria-hidden="true"></i>
																						<p>Adreslerim</p>
																					</div>
																				</a>
																				<a href="<?=site_url('Account/garage')?>" class="panel-link ">
																					<div class="Icon">
																						<i class="fa fa-car" aria-hidden="true"></i>
																						<p>Garajım</p>
																					</div>
																				</a>
																				<a href="<?=site_url('User/logout')?>" class="panel-link">
																					<div class="Icon">
																						<i class="fa fa-sign-out" aria-hidden="true"></i>
																						<p>Çıkış Yap</p>
																					</div>
																				</a>
																			</div>
																		</div>
																	</div>
																</li>
																<li class="Item Notification">
																	<a href="<?=site_url('Notifications')?>" class="Item">
																		<div class="Icon">
																			<img src="<?=site_url('assets/Front/images/Icons/h-notif.webp')?>" alt="">
																			<?=
																			($userNotification!=0)?
																			($userNotification>5)?
																			'<span class="dataNum" id="notificationSpan">5+</span>':
																			'<span class="dataNum" id="notificationSpan">'.$userNotification.'</span>':
																			''?>
																		</div>
																		<span>Bildirim</span>
																	</a>
																</li>
																<li class="Item Fav">
																	<a href="<?=site_url('Account/favorite')?>" class="Item">
																		<div class="Icon"><img src="<?=site_url('assets/Front/images/Icons/h-fav.webp')?>" alt=""></div>
																		<span>Favoriler</span>
																	</a>
																</li>
																<?}?>
																<li class="Item mobileHamburger">
																	<a href="javascript:void(0)" class="Item">
																		<div class="Icon"><img src="<?=site_url('assets/Front/images/Icons/h-menu.webp')?>" alt=""></div>
																		<span>Menü</span>
																	</a>
																</li>
																<li class="Item Cart">
																	<a href="<?=site_url('Basket')?>" class="Item">
																		<div class="Icon">
																			<img src="<?=site_url('assets/Front/images/Icons/h-cart.webp')?>" alt="">
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
																							<img width="76" src="<?=site_url('assets/Front/images/product.webp')?>" alt="">
																						</div>
																						<div class="productInfo">
																							<a href="<?=site_url('Product/details')?>" class="ProductName">Triple QX Tam Sentetik Motor Yağı</a>
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
																					<a href="<?=site_url('Basket')?>" class="Btn Green-d">
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
													<a class="navbar-brand" href="<?=site_url()?>"><img class="HeaderLogo" src="<?=site_url('assets/Front/images/logofinali.webp')?>"></a>

													<div class="Search col-lg col-12 order-lg-2 order-sm-3">
														<form action="#" method="get">
															<div class="SearchBox">
																<div class="topTelephone">
																	Tüm yedek parçalar bir yerde - 500.000 adet parça arasından aradığınızı bulun. <span id="exmSearch">Örnek Arama</span>
																</div>
																<input type="text" class="searchInput" placeholder="Parça No, Parça İsmi veya Marka Adı Giriniz.." name="search">
																<button class="searchBtn"><img src="<?=site_url('assets/Front/images/Icons/search-icon.webp')?>"></button>
																<div id="exSearchArea">
																	<p>Site aramasını kullanarak aracınıza uygun yedek parçayı hemen bulun.</p>
																	<table class="table">
																		<thead>
																			<tr>
																				<th>Arama Tipi</th>
																				<th>Örnek</th>
																			</tr>
																		</thead>
																		<tbody>
																			<tr>
																				<td>Parça</td>
																				<td>Motor Yağı</td>
																			</tr>
																			<tr>
																				<td>Parça + Marka(Üretici)</td>
																				<td>Motor Yağı Eurocraft</td>
																			</tr>
																			<tr>
																				<td>Parça + Araç Marka</td>
																				<td>Engine Oil FORD CONNECT</td>
																			</tr>
																			<tr>
																				<td>Parça + Ürün Numara</td>
																				<td>Motor Yağı V60-0055</td>
																			</tr>
																			<tr>
																				<td>Ürün Numara</td>
																				<td>14F7FD</td>
																			</tr>
																			<tr>
																				<td>Ürün Numara + Ürün Marka</td>
																				<td>1535B5 CASTROL</td>
																			</tr>
																			<tr>
																				<td>OEM</td>
																				<td>0009898701</td>
																			</tr>
																			<tr>
																				<td>OEM + Ürün Marka</td>
																				<td>2365945 ARAL</td>
																			</tr>
																		</tbody>
																	</table>
																	<span id="exSearchClose">Çıkış</span>
																</div>
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
											<a href="<?=site_url('Reviews')?>" class="AppLink"><i class="fa fa-comments" aria-hidden="true"></i> Yorumlar</a>
										</div>
										<div class="item">
											<div id="LangSelectm" class="LanguageSelect">
												<img src="<?=site_url('assets/Front/images/tr.webp')?>" alt="">
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
										<?if (empty($this->session->userdata('userInfo'))) {?>
											<div class="T">Merhaba, <!-- <span>Serdar A.</span>  // Giriş Yapınca Gözükcek --></div>
											<div class="sT">Siparişinizi kontrol etmek için giriş yapın veya kayıt olun.</div> <!-- Giriş Yapınca Gizlencek -->
											<div class="Control">
												<!-- Giriş Yapmadıysa -->
												<a href="<?=site_url('User')?>" class="Link">Giriş Yap</a> <span class="Or">veya</span> <a href="<?=site_url('User/register')?>" class="Link">Kayıt Ol</a>
											</div>
											<?}else{?>
												<!-- Giriş Yaptıysa -->
												<div class="T">Merhaba, <?$writeName=explode(" ", $userInfo->name);echo $writeName[0];?></div>
												<div class="Control">
													<a href="<?=site_url('Account')?>" class="Link">Hesabım</a><br>
													<a href="<?=site_url('Account/orders')?>" class="Link">Siparişlerim</a><br>
													<a href="<?=site_url('User/logout')?>" class="Link">Çıkış</a>
												</div>
												<?}?>
											</div>
											<div class="container-fluid">
												<div class="row">
													<div class="col-12">
														<ul class="menu">
															<li id="menufirstlink"><a href="<?=site_url('Category')?>"><i class="fa fa-bars" aria-hidden="true"></i>YEDEK PARÇALAR</a></li>
															<?php foreach ($menus as $key => $val) { ?>
																<li class="altlinks">
																	<h3><a href="<?=site_url(isset($val->detail)?'Category/'.$val->detail->slug:'#')?>"> <?=replaceStringProblemsReverse($val->GRUP_ISIM)?> <i class="fa fa-chevron-right" aria-hidden="true"></i></a></h3>
																	<div class="nav-dropdown" >
																		<?php foreach ($val->sub as $key2 => $val2) { ?>
																			<div class="item">
																				<div class="T">
																					<p class="t-item"><?=replaceStringProblemsReverse($val2->GRUP_ISIM)?></p>
																					<img class="t-item" src="<?=site_url($val2->detail->image ?? '')?>">
																				</div>
																				<?php 
																				if (count($val->sub)>2) {
																					$i = 6;
																				}else{
																					$i = 0;
																				} ?>
																				<div class="link-items">
																					<?php foreach ($val2->sub as $key3 => $val3) {
																						$i++;
																						?>
																						<a  href="<?=site_url((isset($val->detail)?'Category/'.$val->detail->slug:'#').'/'.(isset($val3->detail)?$val3->detail->slug:'#'))?>" class="Link"><?=replaceStringProblemsReverse($val3->GRUP_ISIM)?></a>
																					<?php } ?>
																				</div>
																			</div>
																		<?php } ?>
																	</div>
																</li>
															<?php } ?>

														</ul>
														<ul class="temp">
															<li class="Menu1">
																<a href="<?=site_url('Maintenance_robot')?>">
																	<img src="<?=site_url('assets/Front/images/Icons/1.webp')?>"> 
																	Bakım Robotu
																</a>
															</li>
															<li class="Menu4">
																<a href="<?=site_url('Listing')?>">
																	<img src="<?=site_url('assets/Front/images/Icons/2.webp')?>">
																	Madeni Yağ
																</a>
															</li>
															<li class="Menu5">
																<a href="<?=site_url('Listing_accessory')?>">
																	<img src="<?=site_url('assets/Front/images/Icons/3.webp')?>">
																	Aksesuarlar
																</a>
															</li>
															<li class="Menu6">
																<a href="<?=site_url('Listing')?>">
																	<img src="<?=site_url('assets/Front/images/Icons/4.webp')?>">
																	Silecekler
																</a>
															</li>
															<li class="Menu7">
																<a href="<?=site_url('Account/garage')?>">
																	<img src="<?=site_url('assets/Front/images/Icons/5.webp')?>">
																	Garajım
																</a>
															</li>
															<li class="MenuK">
																<a href="<?=site_url('Corporate/offerForm')?>" style="font-size:13px;">
																	<!--<img src="<?=site_url('assets/Front/images/Icons/Discount.webp')?>">-->
																	Toplu Parça Teklifi
																</a>
															</li>
														</ul>
													</div>
												</div>
											</div>
										</nav>
										<!-- / Header -->
										<!-- Sayfa Genel Geri Bildirim-->
										<?if($reviewModal==0 && !empty(isset($userInfo))){?>
											<div class="generalRate">
												<div data-toggle="modal" data-target="#generalRateModal" class="gRate-Button"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Bizi Değerlendirin</div>
											</div>
											<?}?>

											<div class="modal fade" id="generalRateModal" tabindex="-1" role="dialog" aria-labelledby="generalRateModalLongTitle" aria-hidden="true">
												<div class="modal-dialog modal-lg" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title" id="exampleModalLongTitle">Bizi Değerlendirin</h5>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close" id="modalReviewClose">
																<span aria-hidden="true">&times;</span>
															</button>
														</div>
														<div class="modal-body">
															<div class="offerform">
																<div class="formArea">
																	<form action="#" method="post">
																		<div class="row">
																			<div class="col-12"><p class="quest">Websitemizi hangi cihaz aracılığı ile deneyimlediniz ?</p></div>
																			<div class="col-lg-4 text-left mt-2 mb-2">
																				<div class="checkItem d-inline">
																					<input class="styled-checkbox" id="styled-checkbox-1" name="deviceType" type="radio" value="1">
																					<label for="styled-checkbox-1">
																						Masaüstü veya Dizüstü
																					</label>
																				</div>
																			</div>
																			<div class="col-lg-4 text-left mt-2 mb-2">
																				<div class="checkItem d-inline">
																					<input class="styled-checkbox" id="styled-checkbox-2" name="deviceType" type="radio" value="2">
																					<label for="styled-checkbox-2">
																						Tablet veya Netbook
																					</label>
																				</div>
																			</div>
																			<div class="col-lg-4 text-left mt-2 mb-2">
																				<div class="checkItem d-inline">
																					<input class="styled-checkbox" id="styled-checkbox-3" name="deviceType" type="radio" value="3">
																					<label for="styled-checkbox-3">
																						Mobil Telefon
																					</label>
																				</div>
																			</div>
																			<div class="col-12 mt-2"><p class="quest">Otoparçasan deneyimi hakkında genel olarak ne düşünüyorsunuz ?</p></div>
																			<div class="col-12 mb-3">
																				<div class="checkItem d-block">
																					<input class="styled-checkbox" id="styled-checkbox-vgood" name="generalpageRate" type="radio" value="5">
																					<label for="styled-checkbox-vgood">
																						Çok iyi
																					</label>
																				</div>
																				<div class="checkItem d-block">
																					<input class="styled-checkbox" id="styled-checkbox-good" name="generalpageRate" type="radio" value="4">
																					<label for="styled-checkbox-good">
																						İyi
																					</label>
																				</div>
																				<div class="checkItem d-block">
																					<input class="styled-checkbox" id="styled-checkbox-notbad" name="generalpageRate" type="radio" value="3">
																					<label for="styled-checkbox-notbad">
																						Fena değil
																					</label>
																				</div>
																				<div class="checkItem d-block">
																					<input class="styled-checkbox" id="styled-checkbox-bad" name="generalpageRate" type="radio" value="2">
																					<label for="styled-checkbox-bad">
																						Kötü
																					</label>
																				</div>
																				<div class="checkItem d-block">
																					<input class="styled-checkbox" id="styled-checkbox-vbad" name="generalpageRate" type="radio" value="1">
																					<label for="styled-checkbox-vbad">
																						Çok kötü
																					</label>
																				</div>
																			</div>
																			<div class="col-12 mt-2"><p class="quest">Düşünceleriniz bizim için çok değerli. Kendimizi geliştirmek için yorum yapmaktan çekinme.</p></div>
																		</div>
																		<div class="row">
																			<div class="col-12">
																				<textarea name="offer_note" id="modalReviewMessage" placeholder="Mesajınız"></textarea>
																			</div>

																			<div class="col-12 text-center">
																				<button type="button" id="modalReviewSend">Gönder</button>
																			</div>
																		</div>
																	</form>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>