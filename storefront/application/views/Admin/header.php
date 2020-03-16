<!DOCTYPE html>
<html lang="en" >
<!-- begin::Head -->
<head>
	<meta charset="utf-8" />
	<title>
		Otoparçasan - Admin Paneli
	</title>
	<meta name="description" content="General widget examples">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="robots" content="noindex">
	<!--begin::Web font -->
	<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
	<script>
		WebFont.load({
			google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
	<!--end::Web font -->
	<!--begin::Base Styles -->
	<link href="<?=base_url('assets/theme/')?>assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url('assets/theme/')?>assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url('assets/theme/')?>assets/css/custom.css" rel="stylesheet" type="text/css" />
	<!--end::Base Styles -->
	<link rel="icon" href="<?=site_url()?>/assets/Front/images/favicon_ops.webp" type="image/x-icon" />
	<script src="https://cdn.ckeditor.com/4.11.3/standard/ckeditor.js"></script>
</head>
<!-- end::Head -->
<!-- end::Body -->
<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
	<!-- begin:: Page -->
	<div class="m-grid m-grid--hor m-grid--root m-page">
		<!-- BEGIN: Header -->
		<header class="m-grid__item m-header"  data-minimize-mobile="hide" data-minimize-offset="200" data-minimize-mobile-offset="200" data-minimize="minimize" >
			<div class="m-container m-container--fluid m-container--full-height">
				<div class="m-stack m-stack--ver m-stack--desktop">
					<!-- BEGIN: Brand -->
					<div class="m-stack__item m-brand  m-brand--skin-dark ">
						<div class="m-stack m-stack--ver m-stack--general">
							<div class="m-stack__item m-stack__item--middle m-brand__logo">
								<a href="<?=site_url('Admin')?>" class="m-brand__logo-wrapper">
									<img alt="" width="185" src="<?=site_url('assets/Front/images/logo-white.webp')?>"/>
								</a>
							</div>
							<div class="m-stack__item m-stack__item--middle m-brand__tools">
								<!-- BEGIN: Left Aside Minimize Toggle -->
								<a href="javascript:;" id="m_aside_left_minimize_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block">
									<span></span>
								</a>
								<!-- END -->
								<!-- BEGIN: Responsive Aside Left Menu Toggler -->
								<a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
									<span></span>
								</a>
								<!-- END -->
								<!-- BEGIN: Responsive Header Menu Toggler -->
								<a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
									<span></span>
								</a>
								<!-- END -->
								<!-- BEGIN: Topbar Toggler -->
								<a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
									<i class="flaticon-more"></i>
								</a>
								<!-- BEGIN: Topbar Toggler -->
							</div>
						</div>
					</div>
					<!-- END: Brand -->
					<!-- END: Brand -->
					<div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
						<div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-dark m-aside-header-menu-mobile--submenu-skin-dark ">
							<ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
								<li class="m-menu__item  m-menu__item--submenu m-menu__item--rel" data-menu-submenu-toggle="click" aria-haspopup="true">
									<a href="javascript:void(0);" class="m-menu__link m-menu__toggle">
										<i class="m-menu__link-icon flaticon-users"></i>
										<span class="m-menu__link-text">
											<?=$this->session->userdata('user')->user_name?>  <i class="m-menu__link-bullet m-menu__link-bullet--line"> <span></span> </i><font size="2"><?=$this->session->userdata('user')->user_mail?></font>
										</span>
									</a>
								</li>
							</ul>
						</div>
						<!-- BEGIN: Topbar -->
						<div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
							<div class="m-stack__item m-topbar__nav-wrapper">
								<ul class="m-topbar__nav m-nav m-nav--inline">
									<li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" data-dropdown-toggle="click">
										<a href="#" class="m-nav__link m-dropdown__toggle">
											<span class="m-topbar__userpic">
												<img src="<?=site_url('assets/Front/images/pp.webp')?>" class="m--img-rounded m--marginless m--img-centered" alt=""/>
											</span>
											<span class="m-topbar__username m--hide">
												<?=$this->session->userdata('user')->user_name?>
											</span>
										</a>
										<div class="m-dropdown__wrapper">
											<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
											<div class="m-dropdown__inner">
												<div class="m-dropdown__header m--align-center" style="background: url(<?=base_url('assets/theme/')?>assets/app/media/img/misc/user_profile_bg.jpg); background-size: cover;">
													<div class="m-card-user m-card-user--skin-dark">

														<div class="m-card-user__details">
															<span class="m-card-user__name m--font-weight-500">
																<?=$this->session->userdata('user')->user_name?>
															</span>
															<a href="" class="m-card-user__email m--font-weight-300 m-link">
																<?=$this->session->userdata('user')->user_mail?>
															</a>
														</div>
													</div>
												</div>
												<div class="m-dropdown__body">
													<div class="m-dropdown__content">
														<ul class="m-nav m-nav--skin-light">
															<li class="m-nav__item">
																<a href="<?=base_url('Admin/Logout/')?>" class="btn m-btn--pill  btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">
																	Çıkış
																</a>
															</li>
														</ul>
													</div>
												</div>
											</div>
										</div>
									</li>

								</ul>
							</div>
						</div>
						<!-- END: Topbar -->
					</div>
				</div>
			</div>
		</header>
		<!-- END: Header -->
		<!-- begin::Body -->
		<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
			<!-- BEGIN: Left Aside -->
			<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
				<!-- BEGIN: Aside Menu -->
				<div 
				id="m_ver_menu" 
				class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " 
				data-menu-vertical="true"
				data-menu-scrollable="false" data-menu-dropdown-timeout="500"  
				>
				<ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow">
					<li class="m-menu__item <?=($mainMenu=='Home'?'m-menu__item--open m-menu__item--expanded m-menu__item--active':'')?>" aria-haspopup="true" >
						<a href="<?=site_url('Admin');?>" class="m-menu__link ">
							<i class="m-menu__link-icon flaticon-line-graph"></i>
							<span class="m-menu__link-title">
								<span class="m-menu__link-wrap">
									<span class="m-menu__link-text">
										Anasayfa
									</span>
                                            <!--
											    <span class="m-menu__link-badge">
												    <span class="m-badge m-badge--danger">
													    3
												    </span>
											    </span>
											-->
										</span>
									</span>
								</a>
							</li>
							<?if($this->session->userdata('user')->auth == 0){?>
								<!--Slider  Menü -->
								<li class="m-menu__item  m-menu__item--submenu <?=($subMenu=='SliderList'?'m-menu__item--active':'')?> <?=($mainMenu=='Slider'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" id="m_slider" data-menu-submenu-toggle="hover">
									<a  href="#" class="m-menu__link m-menu__toggle">
										<i class="m-menu__link-icon fa fa-picture-o"></i>
										<span class="m-menu__link-text">
											Slider İşlemleri
										</span>
										<i class="m-menu__ver-arrow la la-angle-right"></i>
									</a>
									<div class="m-menu__submenu">
										<span class="m-menu__arrow"></span>
										<ul class="m-menu__subnav">
											<li class="m-menu__item <?=($subMenu=='SliderAdd'?'m-menu__item--active':'')?>" aria-haspopup="true">
												<a  href="<?=site_url('Admin/Slider/Add')?>" class="m-menu__link ">
													<i class="m-menu__link-bullet m-menu__link-bullet--dot">
														<span></span>
													</i>
													<span class="m-menu__link-text">
														Slider Ekle
													</span>
												</a>
											</li>
											<li class="m-menu__item <?=($subMenu=='SliderList'?'m-menu__item--active':'')?>" aria-haspopup="true">
												<a  href="<?=site_url('Admin/Slider')?>" class="m-menu__link ">
													<i class="m-menu__link-bullet m-menu__link-bullet--dot">
														<span></span>
													</i>
													<span class="m-menu__link-text">
														Slider İşlemleri
													</span>
												</a>
											</li>
											<li class="m-menu__item <?=($subMenu=='sliderImage'?'m-menu__item--active':'')?>" aria-haspopup="true">
												<a  href="<?=site_url('Admin/Slider/sliderImage')?>" class="m-menu__link ">
													<i class="m-menu__link-bullet m-menu__link-bullet--dot">
														<span></span>
													</i>
													<span class="m-menu__link-text">
														Mobil Slider İşlemleri
													</span>
												</a>
											</li>
											<li class="m-menu__item <?=($subMenu=='SliderProduct'?'m-menu__item--active':'')?>" aria-haspopup="true">
												<a  href="<?=site_url('Admin/Slider/ProductSlider')?>" class="m-menu__link ">
													<i class="m-menu__link-bullet m-menu__link-bullet--dot">
														<span></span>
													</i>
													<span class="m-menu__link-text">
														Banner Güncelle
													</span>
												</a>
											</li>
										</ul>
									</div>
								</li>
								<!-- Slider Menü -->
								<?}?>

								<li class="m-menu__item  m-menu__item--submenu  <?=($mainMenu=='Aracagaci'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" id="m_variant" data-menu-submenu-toggle="hover">
									<a  href="#" class="m-menu__link m-menu__toggle">
										<i class="m-menu__link-icon fa 	fa-sitemap"></i>
										<span class="m-menu__link-text">
											Araç Listesi
										</span>
										<i class="m-menu__ver-arrow la la-angle-right"></i>
									</a>
									<div class="m-menu__submenu">
										<span class="m-menu__arrow"></span>
										<ul class="m-menu__subnav">
											<li class="m-menu__item <?=($subMenu=='aracagaci'?'m-menu__item--active':'')?>" aria-haspopup="true">
												<a  href="<?=site_url('Admin/Aracagaci')?>" class="m-menu__link ">
													<i class="m-menu__link-bullet m-menu__link-bullet--dot">
														<span></span>
													</i>
													<span class="m-menu__link-text">
														Araç Ağacı Düzenleme
													</span>
												</a>
											</li>
										</ul>
									</div>
								</li>

								<li class="m-menu__item  m-menu__item--submenu  <?=($mainMenu=='Dvnlist'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" id="m_variant" data-menu-submenu-toggle="hover">
									<a  href="#" class="m-menu__link m-menu__toggle">
										<i class="m-menu__link-icon fa 	fa-sitemap"></i>
										<span class="m-menu__link-text">
											Dvn Eşleştir
										</span>
										<i class="m-menu__ver-arrow la la-angle-right"></i>
									</a>
									<div class="m-menu__submenu">
										<span class="m-menu__arrow"></span>
										<ul class="m-menu__subnav">
											<li class="m-menu__item <?=($subMenu=='havuz'?'m-menu__item--active':'')?>" aria-haspopup="true">
												<a  href="<?=site_url('Admin/Dvnlist')?>" class="m-menu__link ">
													<i class="m-menu__link-bullet m-menu__link-bullet--dot">
														<span></span>
													</i>
													<span class="m-menu__link-text">
														Dvn Havuzunu Genişlet
													</span>
												</a>
											</li>
											<li class="m-menu__item <?=($subMenu=='dvn'?'m-menu__item--active':'')?>" aria-haspopup="true">
												<a  href="<?=site_url('Admin/Dvnlist/dvnAdd')?>" class="m-menu__link ">
													<i class="m-menu__link-bullet m-menu__link-bullet--dot">
														<span></span>
													</i>
													<span class="m-menu__link-text">
														Dvn Eşleştir
													</span>
												</a>
											</li>
										</ul>
									</div>
								</li>
								<?if($this->session->userdata('user')->auth == 0){?>
									<!-- Yönetici Kullanıcıları Düzenleme -->
									<li class="m-menu__item  m-menu__item--submenu  <?=($mainMenu=='AdminEdit'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" id="m_variant" data-menu-submenu-toggle="hover">
										<a  href="#" class="m-menu__link m-menu__toggle">
											<i class="m-menu__link-icon fa 	fa-user"></i>
											<span class="m-menu__link-text">
												Yönetim Kullanıcıları
											</span>
											<i class="m-menu__ver-arrow la la-angle-right"></i>
										</a>
										<div class="m-menu__submenu">
											<span class="m-menu__arrow"></span>
											<ul class="m-menu__subnav">
												<li class="m-menu__item <?=($subMenu=='AdminUserEdit'?'m-menu__item--active':'')?>" aria-haspopup="true">
													<a  href="<?=site_url('Admin/AdminUserEdit')?>" class="m-menu__link ">
														<i class="m-menu__link-bullet m-menu__link-bullet--dot">
															<span></span>
														</i>
														<span class="m-menu__link-text">
															Yönetim Ekibini Düzenle
														</span>
													</a>
												</li>
												<li class="m-menu__item <?=($subMenu=='newAdminAdd'?'m-menu__item--active':'')?>" aria-haspopup="true">
													<a  href="<?=site_url('Admin/AdminUserEdit/newAdminAdd')?>" class="m-menu__link ">
														<i class="m-menu__link-bullet m-menu__link-bullet--dot">
															<span></span>
														</i>
														<span class="m-menu__link-text">
															Yeni Yönetici Kullanıcı Ekle
														</span>
													</a>
												</li>
											</ul>
										</div>
									</li>
									<!-- Kampanya Yönetimi -->
									<?}?>
									<?if($this->session->userdata('user')->auth == 0){?>
										<li class="m-menu__item  m-menu__item--submenu  <?=($mainMenu=='Sellers'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" id="m_variant" data-menu-submenu-toggle="hover">
											<a  href="#" class="m-menu__link m-menu__toggle">
												<i class="m-menu__link-icon fa 	fa-suitcase"></i>
												<span class="m-menu__link-text">
													Çok Satılanlar Yönetimi
												</span>
												<i class="m-menu__ver-arrow la la-angle-right"></i>
											</a>
											<div class="m-menu__submenu">
												<span class="m-menu__arrow"></span>
												<ul class="m-menu__subnav">
													<li class="m-menu__item <?=($subMenu=='sellerList'?'m-menu__item--active':'')?>" aria-haspopup="true">
														<a  href="<?=site_url('Admin/Sellers')?>" class="m-menu__link ">
															<i class="m-menu__link-bullet m-menu__link-bullet--dot">
																<span></span>
															</i>
															<span class="m-menu__link-text">
																Listele
															</span>
														</a>
													</li>
													<li class="m-menu__item <?=($subMenu=='sellerAdd'?'m-menu__item--active':'')?>" aria-haspopup="true" >
														<a href="<?=site_url('Admin/Sellers/add')?>" class="m-menu__link ">
															<i class="m-menu__link-bullet m-menu__link-bullet--dot">
																<span></span>
															</i>
															<span class="m-menu__link-text">
																Ekle
															</span>
														</a>
													</li>
												</ul>
											</div>
										</li>
										<?}?>
										<?if($this->session->userdata('user')->auth == 0){?>
											<li class="m-menu__item  m-menu__item--submenu  <?=($mainMenu=='Comment'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" id="m_variant" data-menu-submenu-toggle="hover">
												<a  href="#" class="m-menu__link m-menu__toggle">
													<i class="m-menu__link-icon fa fa-comments"></i>
													<span class="m-menu__link-text">
														Değerlendirme Yönetimi
													</span>
													<i class="m-menu__ver-arrow la la-angle-right"></i>
												</a>
												<div class="m-menu__submenu">
													<span class="m-menu__arrow"></span>
													<ul class="m-menu__subnav">
														<li class="m-menu__item <?=($subMenu=='reviewList'?'m-menu__item--active':'')?>" aria-haspopup="true">
															<a  href="<?=site_url('Admin/Comment')?>" class="m-menu__link ">
																<i class="m-menu__link-bullet m-menu__link-bullet--dot">
																	<span></span>
																</i>
																<span class="m-menu__link-text">
																	Listele
																</span>
															</a>
														</li>
														<li class="m-menu__item <?=($subMenu=='answerList'?'m-menu__item--active':'')?>" aria-haspopup="true">
															<a  href="<?=site_url('Admin/Comment/answerList')?>" class="m-menu__link ">
																<i class="m-menu__link-bullet m-menu__link-bullet--dot">
																	<span></span>
																</i>
																<span class="m-menu__link-text">
																	Hazır Yanıt Yönetimi
																</span>
															</a>
														</li>
													</ul>
												</div>
											</li>
											<?}?>
											<?if($this->session->userdata('user')->auth == 0){?>
												<li class="m-menu__item  m-menu__item--submenu  <?=($mainMenu=='Faq'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" id="m_variant" data-menu-submenu-toggle="hover">
													<a  href="#" class="m-menu__link m-menu__toggle">
														<i class="m-menu__link-icon fa fa-question"></i>
														<span class="m-menu__link-text">
															Sıkça Sorulan Sorular
														</span>
														<i class="m-menu__ver-arrow la la-angle-right"></i>
													</a>
													<div class="m-menu__submenu">
														<span class="m-menu__arrow"></span>
														<ul class="m-menu__subnav">
															<li class="m-menu__item <?=($subMenu=='faqList'?'m-menu__item--active':'')?>" aria-haspopup="true">
																<a  href="<?=site_url('Admin/Faq')?>" class="m-menu__link ">
																	<i class="m-menu__link-bullet m-menu__link-bullet--dot">
																		<span></span>
																	</i>
																	<span class="m-menu__link-text">
																		Listele
																	</span>
																</a>
															</li>
															<li class="m-menu__item <?=($subMenu=='faqAdd'?'m-menu__item--active':'')?>" aria-haspopup="true">
																<a  href="<?=site_url('Admin/Faq/add')?>" class="m-menu__link ">
																	<i class="m-menu__link-bullet m-menu__link-bullet--dot">
																		<span></span>
																	</i>
																	<span class="m-menu__link-text">
																		Ekle
																	</span>
																</a>
															</li>
														</ul>
													</div>
												</li>
												<?}?>

												<!-- Kargo Menü -->
												<li class="m-menu__item  m-menu__item--submenu <?=($subMenu == 'Kargo' ? 'm-menu__item--active' : '')?> <?=($mainMenu == 'Kargo' ? 'm-menu__item--open m-menu__item--expanded' : '')?>" aria-haspopup="true" id="m_conversation" data-menu-submenu-toggle="hover">
													<a  href="<?=admin_url('Kargo/')?>" class="m-menu__link m-menu__toggle">
														<i class="m-menu__link-icon fa fa-comments"></i>
														<span class="m-menu__link-text">
															Kargo Fiyatları
														</span>
													</a>
												</li>
												<!-- Kargo Menü -->
												<?if($this->session->userdata('user')->auth == 0 || $this->session->userdata('user')->auth == 2){?>
													<!-- Kategori Menü -->
													<li class="m-menu__item  m-menu__item--submenu  <?=($mainMenu=='Category'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" id="m_category" data-menu-submenu-toggle="hover">
														<a  href="#" class="m-menu__link m-menu__toggle">
															<i class="m-menu__link-icon fa 	fa-list"></i>
															<span class="m-menu__link-text">
																Kategori Yönetimi
															</span>
															<i class="m-menu__ver-arrow la la-angle-right"></i>
														</a>
														<div class="m-menu__submenu">
															<span class="m-menu__arrow"></span>
															<ul class="m-menu__subnav">
																<li class="m-menu__item <?=($subMenu=='CatList'?'m-menu__item--active':'')?>" aria-haspopup="true">
																	<a  href="<?=site_url('Admin/Category')?>" class="m-menu__link ">
																		<i class="m-menu__link-bullet m-menu__link-bullet--dot">
																			<span></span>
																		</i>
																		<span class="m-menu__link-text">
																			Kategori Listele
																		</span>
																	</a>
																</li>
																<li class="m-menu__item <?=($subMenu=='favList'?'m-menu__item--active':'')?>" aria-haspopup="true">
																	<a  href="<?=site_url('Admin/Category/favoritesProduct')?>" class="m-menu__link ">
																		<i class="m-menu__link-bullet m-menu__link-bullet--dot">
																			<span></span>
																		</i>
																		<span class="m-menu__link-text">
																			Fırsat Ürünü Seç
																		</span>
																	</a>
																</li>
										<!--<li class="m-menu__item <?=($subMenu=='CatAdd'?'m-menu__item--active':'')?>" aria-haspopup="true" >
											<a href="<?=site_url('Admin/Category/add')?>" class="m-menu__link ">
												<i class="m-menu__link-bullet m-menu__link-bullet--dot">
													<span></span>
												</i>
												<span class="m-menu__link-text">
													Kategori Ekle
												</span>
											</a>
										</li>
										<li class="m-menu__item <?=($subMenu=='productMust'?'m-menu__item--active':'')?>" aria-haspopup="true" >
											<a href="<?=site_url('Admin/Category/productMust')?>" class="m-menu__link ">
												<i class="m-menu__link-bullet m-menu__link-bullet--dot">
													<span></span>
												</i>
												<span class="m-menu__link-text">
													Ürün Sıralarını Düzenleyin
												</span>
											</a>
										</li>-->
									</ul>
								</div>
							</li>
							<?}?>
							<!-- Kategori Menü -->
							<?if($this->session->userdata('user')->auth == 0 || $this->session->userdata('user')->auth == 2){?>
								<!-- Kategori Menü -->
								<li class="m-menu__item  m-menu__item--submenu  <?=($mainMenu=='homeVideo'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" id="m_category" data-menu-submenu-toggle="hover">
									<a  href="#" class="m-menu__link m-menu__toggle">
										<i class="m-menu__link-icon fa fa-video-camera"></i>
										<span class="m-menu__link-text">
											Anasayfa Video Yönetimi
										</span>
										<i class="m-menu__ver-arrow la la-angle-right"></i>
									</a>
									<div class="m-menu__submenu">
										<span class="m-menu__arrow"></span>
										<ul class="m-menu__subnav">
											<li class="m-menu__item <?=($subMenu=='videoEdit'?'m-menu__item--active':'')?>" aria-haspopup="true">
												<a  href="<?=site_url('Admin/Corporate')?>" class="m-menu__link ">
													<i class="m-menu__link-bullet m-menu__link-bullet--dot">
														<span></span>
													</i>
													<span class="m-menu__link-text">
														Düzenle
													</span>
												</a>
											</li>
										</ul>
									</div>
								</li>
								<?}?>
								<!-- Kategori Menü -->
								<?if($this->session->userdata('user')->auth == 0 || $this->session->userdata('user')->auth == 2){?>
									<!-- Kategori Menü -->
									<li class="m-menu__item  m-menu__item--submenu  <?=($mainMenu=='Brand'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" id="m_category" data-menu-submenu-toggle="hover">
										<a  href="#" class="m-menu__link m-menu__toggle">
											<i class="m-menu__link-icon fa fa-grav"></i>
											<span class="m-menu__link-text">
												Marka Yönetimi
											</span>
											<i class="m-menu__ver-arrow la la-angle-right"></i>
										</a>
										<div class="m-menu__submenu">
											<span class="m-menu__arrow"></span>
											<ul class="m-menu__subnav">
												<li class="m-menu__item <?=($subMenu=='brandList'?'m-menu__item--active':'')?>" aria-haspopup="true">
													<a  href="<?=site_url('Admin/Brand')?>" class="m-menu__link ">
														<i class="m-menu__link-bullet m-menu__link-bullet--dot">
															<span></span>
														</i>
														<span class="m-menu__link-text">
															Listele
														</span>
													</a>
												</li>
												<li class="m-menu__item <?=($subMenu=='brandAdd'?'m-menu__item--active':'')?>" aria-haspopup="true" >
													<a href="<?=site_url('Admin/Brand/add')?>" class="m-menu__link ">
														<i class="m-menu__link-bullet m-menu__link-bullet--dot">
															<span></span>
														</i>
														<span class="m-menu__link-text">
															Ekle
														</span>
													</a>
												</li>
										<!--<li class="m-menu__item <?=($subMenu=='productMust'?'m-menu__item--active':'')?>" aria-haspopup="true" >
											<a href="<?=site_url('Admin/Category/productMust')?>" class="m-menu__link ">
												<i class="m-menu__link-bullet m-menu__link-bullet--dot">
													<span></span>
												</i>
												<span class="m-menu__link-text">
													Ürün Sıralarını Düzenleyin
												</span>
											</a>
										</li>-->
									</ul>
								</div>
							</li>
							<?}?>
							<?if($this->session->userdata('user')->auth == 0 || $this->session->userdata('user')->auth == 2){?>
								<!-- Kategori Menü -->
								<li class="m-menu__item  m-menu__item--submenu  <?=($mainMenu=='Content'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" id="m_category" data-menu-submenu-toggle="hover">
									<a  href="#" class="m-menu__link m-menu__toggle">
										<i class="m-menu__link-icon fa fa-connectdevelop"></i>
										<span class="m-menu__link-text">
											Anasayfa İçerik Yönetimi
										</span>
										<i class="m-menu__ver-arrow la la-angle-right"></i>
									</a>
									<div class="m-menu__submenu">
										<span class="m-menu__arrow"></span>
										<ul class="m-menu__subnav">
											<li class="m-menu__item <?=($subMenu=='contentEdit'?'m-menu__item--active':'')?>" aria-haspopup="true">
												<a  href="<?=site_url('Admin/Content')?>" class="m-menu__link ">
													<i class="m-menu__link-bullet m-menu__link-bullet--dot">
														<span></span>
													</i>
													<span class="m-menu__link-text">
														Açıklama Düzenle
													</span>
												</a>
											</li>
											<li class="m-menu__item <?=($subMenu=='contentAdd'?'m-menu__item--active':'')?>" aria-haspopup="true" >
												<a href="<?=site_url('Admin/Content/contentOtoparcasan')?>" class="m-menu__link ">
													<i class="m-menu__link-bullet m-menu__link-bullet--dot">
														<span></span>
													</i>
													<span class="m-menu__link-text">
														Otoparçasan Düzenle
													</span>
												</a>
											</li>
										</ul>
									</div>
								</li>
								<?}?>
								<?if($this->session->userdata('user')->auth == 0 || $this->session->userdata('user')->auth == 2){?>
									<!-- Kategori Menü -->
									<li class="m-menu__item  m-menu__item--submenu  <?=($mainMenu=='Notification'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" id="m_category" data-menu-submenu-toggle="hover">
										<a  href="#" class="m-menu__link m-menu__toggle">
											<i class="m-menu__link-icon fa fa-bell"></i>
											<span class="m-menu__link-text">
												Bildirim Yönetimi
											</span>
											<i class="m-menu__ver-arrow la la-angle-right"></i>
										</a>
										<div class="m-menu__submenu">
											<span class="m-menu__arrow"></span>
											<ul class="m-menu__subnav">
												<li class="m-menu__item <?=($subMenu=='NotificationAdd'?'m-menu__item--active':'')?>" aria-haspopup="true">
													<a  href="<?=site_url('Admin/Notification/add')?>" class="m-menu__link ">
														<i class="m-menu__link-bullet m-menu__link-bullet--dot">
															<span></span>
														</i>
														<span class="m-menu__link-text">
															Bildirim Yayınla
														</span>
													</a>
												</li>
												<li class="m-menu__item <?=($subMenu=='notificationList'?'m-menu__item--active':'')?>" aria-haspopup="true" >
													<a href="<?=site_url('Admin/Notification')?>" class="m-menu__link ">
														<i class="m-menu__link-bullet m-menu__link-bullet--dot">
															<span></span>
														</i>
														<span class="m-menu__link-text">
															Bildirimler
														</span>
													</a>
												</li>
											</ul>
										</div>
									</li>
									<?}?>
									<?if($this->session->userdata('user')->auth == 0 || $this->session->userdata('user')->auth == 2){?>
										<!-- Kategori Menü -->
										<li class="m-menu__item  m-menu__item--submenu  <?=($mainMenu=='Transfer'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" id="m_category" data-menu-submenu-toggle="hover">
											<a  href="#" class="m-menu__link m-menu__toggle">
												<i class="m-menu__link-icon flaticon-interface"></i>
												<span class="m-menu__link-text">
													Geri Ödeme Yönetimi
												</span>
												<i class="m-menu__ver-arrow la la-angle-right"></i>
											</a>
											<div class="m-menu__submenu">
												<span class="m-menu__arrow"></span>
												<ul class="m-menu__subnav">
													<li class="m-menu__item <?=($subMenu=='ibanList'?'m-menu__item--active':'')?>" aria-haspopup="true">
														<a  href="<?=site_url('Admin/Transfer/ibanList')?>" class="m-menu__link ">
															<i class="m-menu__link-bullet m-menu__link-bullet--dot">
																<span></span>
															</i>
															<span class="m-menu__link-text">
																IBAN Bilgileri Görüntüle
															</span>
														</a>
													</li>
													<li class="m-menu__item <?=($subMenu=='transferList'?'m-menu__item--active':'')?>" aria-haspopup="true" >
														<a href="<?=site_url('Admin/Transfer/transferList')?>" class="m-menu__link ">
															<i class="m-menu__link-bullet m-menu__link-bullet--dot">
																<span></span>
															</i>
															<span class="m-menu__link-text">
																Havale Ödeme Yönetimi
															</span>
														</a>
													</li>
												</ul>
											</div>
										</li>
										<?}?>
										<?if($this->session->userdata('user')->auth == 0 || $this->session->userdata('user')->auth == 2){?>
											<!-- Kategori Menü -->
											<li class="m-menu__item  m-menu__item--submenu  <?=($mainMenu=='Review'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" id="m_category" data-menu-submenu-toggle="hover">
												<a  href="#" class="m-menu__link m-menu__toggle">
													<i class="m-menu__link-icon flaticon-list-1"></i>
													<span class="m-menu__link-text">
														Genel Değerlendirme Yönetimi
													</span>
													<i class="m-menu__ver-arrow la la-angle-right"></i>
												</a>
												<div class="m-menu__submenu">
													<span class="m-menu__arrow"></span>
													<ul class="m-menu__subnav">
														<li class="m-menu__item <?=($subMenu=='reviewList'?'m-menu__item--active':'')?>" aria-haspopup="true">
															<a  href="<?=site_url('Admin/Review')?>" class="m-menu__link ">
																<i class="m-menu__link-bullet m-menu__link-bullet--dot">
																	<span></span>
																</i>
																<span class="m-menu__link-text">
																	Genel Değerlendirmeleri Görüntüle
																</span>
															</a>
														</li>
													</ul>
												</div>
											</li>
											<?}?>
											<?if($this->session->userdata('user')->auth == 0 || $this->session->userdata('user')->auth == 2){?>
												<!-- Kategori Menü -->
												<li class="m-menu__item  m-menu__item--submenu  <?=($mainMenu=='Human_resources'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" id="m_category" data-menu-submenu-toggle="hover">
													<a  href="#" class="m-menu__link m-menu__toggle">
														<i class="m-menu__link-icon flaticon-user-ok"></i>
														<span class="m-menu__link-text">
															İnsan Kaynakları
														</span>
														<i class="m-menu__ver-arrow la la-angle-right"></i>
													</a>
													<div class="m-menu__submenu">
														<span class="m-menu__arrow"></span>
														<ul class="m-menu__subnav">
															<li class="m-menu__item <?=($subMenu=='list'?'m-menu__item--active':'')?>" aria-haspopup="true">
																<a  href="<?=admin_url('Human_resources')?>" class="m-menu__link ">
																	<i class="m-menu__link-bullet m-menu__link-bullet--dot">
																		<span></span>
																	</i>
																	<span class="m-menu__link-text">
																		Başvuruları Görüntüle
																	</span>
																</a>
															</li>
															<li class="m-menu__item <?=($subMenu=='formPositionAdd'?'m-menu__item--active':'')?>" aria-haspopup="true">
																<a  href="<?=site_url('Admin/Form/formPositionAdd')?>" class="m-menu__link ">
																	<i class="m-menu__link-bullet m-menu__link-bullet--dot">
																		<span></span>
																	</i>
																	<span class="m-menu__link-text">
																		Pozisyon Ekle
																	</span>
																</a>
															</li>
															<li class="m-menu__item <?=($subMenu=='positionList'?'m-menu__item--active':'')?>" aria-haspopup="true">
																<a  href="<?=site_url('Admin/Form/positionList')?>" class="m-menu__link ">
																	<i class="m-menu__link-bullet m-menu__link-bullet--dot">
																		<span></span>
																	</i>
																	<span class="m-menu__link-text">
																		Pozisyonlar
																	</span>
																</a>
															</li>
														</ul>
													</div>
												</li>
												<?}?>
												<?if($this->session->userdata('user')->auth == 0 || $this->session->userdata('user')->auth == 2){?>
													<!-- Kategori Menü -->
													<li class="m-menu__item  m-menu__item--submenu  <?=($mainMenu=='Contracted_services'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" id="m_category" data-menu-submenu-toggle="hover">
														<a  href="#" class="m-menu__link m-menu__toggle">
															<i class="m-menu__link-icon flaticon-placeholder"></i>
															<span class="m-menu__link-text">
																Anlaşmalı Servisler
															</span>
															<i class="m-menu__ver-arrow la la-angle-right"></i>
														</a>
														<div class="m-menu__submenu">
															<span class="m-menu__arrow"></span>
															<ul class="m-menu__subnav">
																<li class="m-menu__item <?=($subMenu=='servicesAdd'?'m-menu__item--active':'')?>" aria-haspopup="true">
																	<a  href="<?=admin_url('Contracted_services')?>" class="m-menu__link ">
																		<i class="m-menu__link-bullet m-menu__link-bullet--dot">
																			<span></span>
																		</i>
																		<span class="m-menu__link-text">
																			Anlaşmalı Servis Ekle
																		</span>
																	</a>
																</li>
																<li class="m-menu__item <?=($subMenu=='servicesList'?'m-menu__item--active':'')?>" aria-haspopup="true">
																	<a  href="<?=admin_url('Contracted_services/list')?>" class="m-menu__link ">
																		<i class="m-menu__link-bullet m-menu__link-bullet--dot">
																			<span></span>
																		</i>
																		<span class="m-menu__link-text">
																			Anlaşmalı Servisleri Görüntüle
																		</span>
																	</a>
																</li>
															</ul>
														</div>
													</li>
													<?}?>
													<?if($this->session->userdata('user')->auth == 0 || $this->session->userdata('user')->auth == 2){?>
														<!-- Kategori Menü -->
														<li class="m-menu__item  m-menu__item--submenu  <?=($mainMenu=='Bank'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" id="m_category" data-menu-submenu-toggle="hover">
															<a  href="#" class="m-menu__link m-menu__toggle">
																<i class="m-menu__link-icon flaticon-coins"></i>
																<span class="m-menu__link-text">
																	Banka Hesapları
																</span>
																<i class="m-menu__ver-arrow la la-angle-right"></i>
															</a>
															<div class="m-menu__submenu">
																<span class="m-menu__arrow"></span>
																<ul class="m-menu__subnav">
																	<li class="m-menu__item <?=($subMenu=='bankAdd'?'m-menu__item--active':'')?>" aria-haspopup="true">
																		<a  href="<?=admin_url('Bank_account/add')?>" class="m-menu__link ">
																			<i class="m-menu__link-bullet m-menu__link-bullet--dot">
																				<span></span>
																			</i>
																			<span class="m-menu__link-text">
																				Banka Hesabı Ekle
																			</span>
																		</a>
																	</li>
																	<li class="m-menu__item <?=($subMenu=='bankList'?'m-menu__item--active':'')?>" aria-haspopup="true">
																		<a  href="<?=admin_url('Bank_account')?>" class="m-menu__link ">
																			<i class="m-menu__link-bullet m-menu__link-bullet--dot">
																				<span></span>
																			</i>
																			<span class="m-menu__link-text">
																				Banka Hesaplarını Görüntüle
																			</span>
																		</a>
																	</li>
																</ul>
															</div>
														</li>
														<?}?>
														<?if($this->session->userdata('user')->auth == 0 || $this->session->userdata('user')->auth == 2){?>
															<!-- Kategori Menü -->
															<li class="m-menu__item  m-menu__item--submenu  <?=($mainMenu=='Form'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" id="m_category" data-menu-submenu-toggle="hover">
																<a  href="#" class="m-menu__link m-menu__toggle">
																	<i class="m-menu__link-icon flaticon-chat-1"></i>
																	<span class="m-menu__link-text">
																		Form Yönetimi
																	</span>
																	<i class="m-menu__ver-arrow la la-angle-right"></i>
																</a>
																<div class="m-menu__submenu">
																	<span class="m-menu__arrow"></span>
																	<ul class="m-menu__subnav">
																		<li class="m-menu__item <?=($subMenu=='formList'?'m-menu__item--active':'')?>" aria-haspopup="true">
																			<a  href="<?=admin_url('Form')?>" class="m-menu__link ">
																				<i class="m-menu__link-bullet m-menu__link-bullet--dot">
																					<span></span>
																				</i>
																				<span class="m-menu__link-text">
																					İletişim Talepleri
																				</span>
																			</a>
																		</li>
																		<li class="m-menu__item <?=($subMenu=='bulletinList'?'m-menu__item--active':'')?>" aria-haspopup="true">
																			<a  href="<?=admin_url('Form/bulletin')?>" class="m-menu__link ">
																				<i class="m-menu__link-bullet m-menu__link-bullet--dot">
																					<span></span>
																				</i>
																				<span class="m-menu__link-text">
																					E-Bültan Listesi
																				</span>
																			</a>
																		</li>
																	</ul>
																</div>
															</li>
															<?}?>
															<?if($this->session->userdata('user')->auth == 0 || $this->session->userdata('user')->auth == 2){?>
																<!-- Kategori Menü -->
																<li class="m-menu__item  m-menu__item--submenu  <?=($mainMenu=='Help'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" id="m_category" data-menu-submenu-toggle="hover">
																	<a  href="#" class="m-menu__link m-menu__toggle">
																		<i class="m-menu__link-icon flaticon-location"></i>
																		<span class="m-menu__link-text">
																			Yardım
																		</span>
																		<i class="m-menu__ver-arrow la la-angle-right"></i>
																	</a>
																	<div class="m-menu__submenu">
																		<span class="m-menu__arrow"></span>
																		<ul class="m-menu__subnav">
																			<li class="m-menu__item <?=($subMenu=='helpList'?'m-menu__item--active':'')?>" aria-haspopup="true">
																				<a  href="<?=admin_url('Help')?>" class="m-menu__link ">
																					<i class="m-menu__link-bullet m-menu__link-bullet--dot">
																						<span></span>
																					</i>
																					<span class="m-menu__link-text">
																						İçerikleri Listele
																					</span>
																				</a>
																			</li>
																			<li class="m-menu__item <?=($subMenu=='helpAdd'?'m-menu__item--active':'')?>" aria-haspopup="true">
																				<a  href="<?=admin_url('Help/add')?>" class="m-menu__link ">
																					<i class="m-menu__link-bullet m-menu__link-bullet--dot">
																						<span></span>
																					</i>
																					<span class="m-menu__link-text">
																						İçerik Ekle
																					</span>
																				</a>
																			</li>
																		</ul>
																	</div>
																</li>
																<?}?>
																<?if($this->session->userdata('user')->auth == 0 || $this->session->userdata('user')->auth == 2){?>
																	<!-- Kategori Menü -->
																	<li class="m-menu__item  m-menu__item--submenu  <?=($mainMenu=='Support'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" id="m_category" data-menu-submenu-toggle="hover">
																		<a  href="#" class="m-menu__link m-menu__toggle">
																			<i class="m-menu__link-icon flaticon-map"></i>
																			<span class="m-menu__link-text">
																				Destek
																			</span>
																			<i class="m-menu__ver-arrow la la-angle-right"></i>
																		</a>
																		<div class="m-menu__submenu">
																			<span class="m-menu__arrow"></span>
																			<ul class="m-menu__subnav">
																				<li class="m-menu__item <?=($subMenu=='supportSectionList'?'m-menu__item--active':'')?>" aria-haspopup="true">
																					<a  href="<?=admin_url('Support')?>" class="m-menu__link ">
																						<i class="m-menu__link-bullet m-menu__link-bullet--dot">
																							<span></span>
																						</i>
																						<span class="m-menu__link-text">
																							Destek Bölümlerini Listele
																						</span>
																					</a>
																				</li>
																				<li class="m-menu__item <?=($subMenu=='supporSectionAdd'?'m-menu__item--active':'')?>" aria-haspopup="true">
																					<a  href="<?=admin_url('Support/add')?>" class="m-menu__link ">
																						<i class="m-menu__link-bullet m-menu__link-bullet--dot">
																							<span></span>
																						</i>
																						<span class="m-menu__link-text">
																							Destek Bölümü Ekle
																						</span>
																					</a>
																				</li>
																				<li class="m-menu__item <?=($subMenu=='supportRequests'?'m-menu__item--active':'')?>" aria-haspopup="true">
																					<a  href="<?=admin_url('Support/support_requests')?>" class="m-menu__link ">
																						<i class="m-menu__link-bullet m-menu__link-bullet--dot">
																							<span></span>
																						</i>
																						<span class="m-menu__link-text">
																							Destek Talepleri
																						</span>
																					</a>
																				</li>
																			</ul>
																		</div>
																	</li>
																	<?}?>
																	<!-- Kategori Menü -->
																	<br><br><br>
																	<!-- Ürün Menü -->
																	<?if($this->session->userdata('user')->auth == 3 || $this->session->userdata('user')->auth == 0 || $this->session->userdata('user')->auth == 2){?>
																		<li class="m-menu__item  m-menu__item--submenu  <?=($mainMenu=='Product'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" id="m_variant" data-menu-submenu-toggle="hover">
																			<a  href="#" class="m-menu__link m-menu__toggle">
																				<i class="m-menu__link-icon fa 	fa-suitcase"></i>
																				<span class="m-menu__link-text">
																					Ürün Yönetimi
																				</span>
																				<i class="m-menu__ver-arrow la la-angle-right"></i>
																			</a>
																			<div class="m-menu__submenu">
																				<span class="m-menu__arrow"></span>
																				<ul class="m-menu__subnav">
																					<li class="m-menu__item <?=($subMenu=='ProductList'?'m-menu__item--active':'')?>" aria-haspopup="true">
																						<a  href="<?=site_url('Admin/Product')?>" class="m-menu__link ">
																							<i class="m-menu__link-bullet m-menu__link-bullet--dot">
																								<span></span>
																							</i>
																							<span class="m-menu__link-text">
																								Ürün Listele
																							</span>
																						</a>
																					</li>
																					<li class="m-menu__item <?=($subMenu=='ProductAdd'?'m-menu__item--active':'')?>" aria-haspopup="true" >
																						<a href="<?=site_url('Admin/Product/add')?>" class="m-menu__link ">
																							<i class="m-menu__link-bullet m-menu__link-bullet--dot">
																								<span></span>
																							</i>
																							<span class="m-menu__link-text">
																								Ürün Ekle
																							</span>
																						</a>
																					</li>
																				</ul>
																			</div>
																		</li>
																		<?}?>
																		<!-- Ürün Menü -->
																		<?if($this->session->userdata('user')->auth == 3 || $this->session->userdata('user')->auth == 0){?>
																			<!-- Sipariş Menü -->
																			<li class="m-menu__item  m-menu__item--submenu  <?=($mainMenu=='Order'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" id="m_variant" data-menu-submenu-toggle="hover">
																				<a  href="#" class="m-menu__link m-menu__toggle">
																					<i class="m-menu__link-icon fa fa-file-text-o"></i>
																					<span class="m-menu__link-text">
																						Sipariş Yönetimi
																					</span>
																					<i class="m-menu__ver-arrow la la-angle-right"></i>
																				</a>
																				<div class="m-menu__submenu">
																					<span class="m-menu__arrow"></span>
																					<ul class="m-menu__subnav">
																						<li class="m-menu__item <?=($subMenu=='OrderList'?'m-menu__item--active':'')?>" aria-haspopup="true">
																							<a  href="<?=site_url('Admin/Order')?>" class="m-menu__link ">
																								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
																									<span></span>
																								</i>
																								<span class="m-menu__link-text">
																									Sipariş Listele
																								</span>
																							</a>
																						</li>
																					</ul>
																				</div>
																			</li>
																			<!-- Sipariş Menü -->
																			<?}?>
							<?php /* 
							<?if($this->session->userdata('user')->auth == 0 || $this->session->userdata('user')->auth == 2){?>
                            <!-- E-Fatura Menü 
                            <li class="m-menu__item  m-menu__item--submenu <?=($subMenu=='EfaturaList'?'m-menu__item--active':'')?> <?=($mainMenu=='Efatura'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" id="m_conversation" data-menu-submenu-toggle="hover">
								<a  href="<?=admin_url('Efatura/')?>" class="m-menu__link m-menu__toggle">
									<i class="m-menu__link-icon flaticon-interface-5"></i>
									<span class="m-menu__link-text">
										E-Fatura
									</span>
								</a>
							</li>
                             E-Fatura Menü -->
                            <?}?>

                            */?>

                            <!-- Dil Menü -->
                            <?if($this->session->userdata('user')->auth == 0 || $this->session->userdata('user')->auth == 2){?>
                            	<li class="m-menu__item  m-menu__item--submenu  <?=($mainMenu=='Language'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" id="m_category" data-menu-submenu-toggle="hover">
                            		<a  href="#" class="m-menu__link m-menu__toggle">
                            			<i class="m-menu__link-icon fa 	fa-language"></i>
                            			<span class="m-menu__link-text">
                            				Dil Yönetimi
                            			</span>
                            			<i class="m-menu__ver-arrow la la-angle-right"></i>
                            		</a>
                            		<div class="m-menu__submenu">
                            			<span class="m-menu__arrow"></span>
                            			<ul class="m-menu__subnav">
                            				<li class="m-menu__item <?=($subMenu=='LangList'?'m-menu__item--active':'')?>" aria-haspopup="true">
                            					<a  href="<?=site_url('Admin/Language')?>" class="m-menu__link ">
                            						<i class="m-menu__link-bullet m-menu__link-bullet--dot">
                            							<span></span>
                            						</i>
                            						<span class="m-menu__link-text">
                            							Dil Listele
                            						</span>
                            					</a>
                            				</li>
                            				<li class="m-menu__item <?=($subMenu=='LangAdd'?'m-menu__item--active':'')?>" aria-haspopup="true" >
                            					<a href="<?=site_url('Admin/Language/add')?>" class="m-menu__link ">
                            						<i class="m-menu__link-bullet m-menu__link-bullet--dot">
                            							<span></span>
                            						</i>
                            						<span class="m-menu__link-text">
                            							Dil Ekle
                            						</span>
                            					</a>
                            				</li>
                            			</ul>
                            		</div>
                            	</li>
                            	<!-- Dil Menü -->
                            	<?}?>
                            	<!-- Varyant Menü -->
                            	<?if($this->session->userdata('user')->auth == 0 || $this->session->userdata('user')->auth == 2){?>
                            		<li class="m-menu__item  m-menu__item--submenu  <?=($mainMenu=='Variant'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" id="m_variant" data-menu-submenu-toggle="hover">
                            			<a  href="#" class="m-menu__link m-menu__toggle">
                            				<i class="m-menu__link-icon fa 	fa-sitemap"></i>
                            				<span class="m-menu__link-text">
                            					Varyant Yönetimi
                            				</span>
                            				<i class="m-menu__ver-arrow la la-angle-right"></i>
                            			</a>
                            			<div class="m-menu__submenu">
                            				<span class="m-menu__arrow"></span>
                            				<ul class="m-menu__subnav">
                            					<li class="m-menu__item <?=($subMenu=='VariantList'?'m-menu__item--active':'')?>" aria-haspopup="true">
                            						<a  href="<?=site_url('Admin/Variant')?>" class="m-menu__link ">
                            							<i class="m-menu__link-bullet m-menu__link-bullet--dot">
                            								<span></span>
                            							</i>
                            							<span class="m-menu__link-text">
                            								Varyant Listele
                            							</span>
                            						</a>
                            					</li>
                            					<li class="m-menu__item <?=($subMenu=='VariantAdd'?'m-menu__item--active':'')?>" aria-haspopup="true" >
                            						<a href="<?=site_url('Admin/Variant/add')?>" class="m-menu__link ">
                            							<i class="m-menu__link-bullet m-menu__link-bullet--dot">
                            								<span></span>
                            							</i>
                            							<span class="m-menu__link-text">
                            								Varyant Ekle
                            							</span>
                            						</a>
                            					</li>
                            				</ul>
                            			</div>
                            		</li>
                            		<?}?>
                            		<!-- Varyant Menü -->
                            		<?if($this->session->userdata('user')->auth == 0){?>
                            			<!-- Paket Menü -->
                            			<li class="m-menu__item  m-menu__item--submenu  <?=($mainMenu=='Package'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" id="m_variant" data-menu-submenu-toggle="hover">
                            				<a  href="#" class="m-menu__link m-menu__toggle">
                            					<i class="m-menu__link-icon fa fa-th"></i>
                            					<span class="m-menu__link-text">
                            						Paket Yönetimi
                            					</span>
                            					<i class="m-menu__ver-arrow la la-angle-right"></i>
                            				</a>
                            				<div class="m-menu__submenu">
                            					<span class="m-menu__arrow"></span>
                            					<ul class="m-menu__subnav">
                            						<li class="m-menu__item <?=($subMenu=='PackageList'?'m-menu__item--active':'')?>" aria-haspopup="true">
                            							<a  href="<?=site_url('Admin/Package')?>" class="m-menu__link ">
                            								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
                            									<span></span>
                            								</i>
                            								<span class="m-menu__link-text">
                            									Paket Listele
                            								</span>
                            							</a>
                            						</li>
                            						<li class="m-menu__item <?=($subMenu=='PackageAdd'?'m-menu__item--active':'')?>" aria-haspopup="true" >
                            							<a href="<?=site_url('Admin/Package/add')?>" class="m-menu__link ">
                            								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
                            									<span></span>
                            								</i>
                            								<span class="m-menu__link-text">
                            									Paket Ekle
                            								</span>
                            							</a>
                            						</li>
                            					</ul>
                            				</div>
                            			</li>
                            			<!-- Paket Menü -->
                            			<?}?>
                            			<!-- Kullanıcı Menü -->
                            			<?if($this->session->userdata('user')->auth == 0){?>
                            				<li class="m-menu__item  m-menu__item--submenu  <?=($mainMenu=='User'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" id="m_variant" data-menu-submenu-toggle="hover">
                            					<a  href="#" class="m-menu__link m-menu__toggle">
                            						<i class="m-menu__link-icon fa fa-users"></i>
                            						<span class="m-menu__link-text">
                            							Kullanıcı Yönetimi
                            						</span>
                            						<i class="m-menu__ver-arrow la la-angle-right"></i>
                            					</a>
                            					<div class="m-menu__submenu">
                            						<span class="m-menu__arrow"></span>
                            						<ul class="m-menu__subnav">
                            							<li class="m-menu__item <?=($subMenu=='UserList'?'m-menu__item--active':'')?>" aria-haspopup="true">
                            								<a  href="<?=site_url('Admin/User')?>" class="m-menu__link ">
                            									<i class="m-menu__link-bullet m-menu__link-bullet--dot">
                            										<span></span>
                            									</i>
                            									<span class="m-menu__link-text">
                            										Kullanıcı Listele
                            									</span>
                            								</a>
                            							</li>
                            						</ul>
                            					</div>
                            				</li>
                            				<!-- Kullanıcı Menü -->
                            				<?}?>
                            				<!-- Kampanya Hediye Çeki Menü -->
                            				<?if($this->session->userdata('user')->auth == 0){?>
                            					<li class="m-menu__item  m-menu__item--submenu  <?=($mainMenu=='Gift'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" id="m_variant" data-menu-submenu-toggle="hover">
                            						<a  href="#" class="m-menu__link m-menu__toggle">
                            							<i class="m-menu__link-icon fa fa-gift"></i>
                            							<span class="m-menu__link-text">
                            								Kampanyalar
                            							</span>
                            							<i class="m-menu__ver-arrow la la-angle-right"></i>
                            						</a>
                            						<div class="m-menu__submenu">
                            							<span class="m-menu__arrow"></span>
                            							<ul class="m-menu__subnav">
                            								<li class="m-menu__item <?=($subMenu=='GiftList'?'m-menu__item--active':'')?>" aria-haspopup="true">
                            									<a  href="<?=site_url('Admin/Giftcheck')?>" class="m-menu__link ">
                            										<i class="m-menu__link-bullet m-menu__link-bullet--dot">
                            											<span></span>
                            										</i>
                            										<span class="m-menu__link-text">
                            											Kampanya-Hediye Çeki Listesi
                            										</span>
                            									</a>
                            								</li>
                            								<li class="m-menu__item <?=($subMenu=='GiftAdd'?'m-menu__item--active':'')?>" aria-haspopup="true">
                            									<a  href="<?=site_url('Admin/Giftcheck/Add')?>" class="m-menu__link ">
                            										<i class="m-menu__link-bullet m-menu__link-bullet--dot">
                            											<span></span>
                            										</i>
                            										<span class="m-menu__link-text">
                            											Kampanya-Hediye Çeki Oluştur
                            										</span>
                            									</a>
                            								</li>
                            							</ul>
                            						</div>
                            					</li>
                            					<!-- Kampanya Hediye Çeki Menü -->
                            					<?}?>
                            					<!-- Statik Sayfa Menü -->
                            					<?if($this->session->userdata('user')->auth == 0 || $this->session->userdata('user')->auth == 2){?>
                            						<li class="m-menu__item  m-menu__item--submenu  <?=($mainMenu=='Statics'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" id="m_variant" data-menu-submenu-toggle="hover">
                            							<a  href="#" class="m-menu__link m-menu__toggle">
                            								<i class="m-menu__link-icon fa fa-gift"></i>
                            								<span class="m-menu__link-text">
                            									Sabit Sayfalar
                            								</span>
                            								<i class="m-menu__ver-arrow la la-angle-right"></i>
                            							</a>
                            							<div class="m-menu__submenu">
                            								<span class="m-menu__arrow"></span>
                            								<ul class="m-menu__subnav">
                            									<li class="m-menu__item <?=($subMenu=='StaticsList'?'m-menu__item--active':'')?>" aria-haspopup="true">
                            										<a  href="<?=site_url('Admin/Statics')?>" class="m-menu__link ">
                            											<i class="m-menu__link-bullet m-menu__link-bullet--dot">
                            												<span></span>
                            											</i>
                            											<span class="m-menu__link-text">
                            												Sayfa Listesi
                            											</span>
                            										</a>
                            									</li>
                            									<li class="m-menu__item <?=($subMenu=='StaticsAdd'?'m-menu__item--active':'')?>" aria-haspopup="true">
                            										<a  href="<?=site_url('Admin/Statics/Add')?>" class="m-menu__link ">
                            											<i class="m-menu__link-bullet m-menu__link-bullet--dot">
                            												<span></span>
                            											</i>
                            											<span class="m-menu__link-text">
                            												Sayfa Oluştur
                            											</span>
                            										</a>
                            									</li>
                            								</ul>
                            							</div>
                            						</li>
                            						<!-- Statik Sayfa Menü -->
                            						<?}?>
                            						<?if($this->session->userdata('user')->auth == 0){?>
                            <!-- Parabirimi Menü 
                            <li class="m-menu__item  m-menu__item--submenu <?=($subMenu=='CurrencyList'?'m-menu__item--active':'')?> <?=($mainMenu=='Currency'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" id="m_currency" data-menu-submenu-toggle="hover">
								<a  href="<?=admin_url('Currency/')?>" class="m-menu__link m-menu__toggle">
									<i class="m-menu__link-icon fa fa-money"></i>
									<span class="m-menu__link-text">
										Para Birimi Yönetimi
									</span>
								</a>
							</li>
							<?}?>
							Parabirimi Menü -->
							<?if($this->session->userdata('user')->auth == 0 || $this->session->userdata('user')->auth == 2){?>
								<!-- Tasarım Sohbeti Menü -->
								<li class="m-menu__item  m-menu__item--submenu <?=($subMenu=='ConversationList'?'m-menu__item--active':'')?> <?=($mainMenu=='Conversation'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" id="m_conversation" data-menu-submenu-toggle="hover">
									<a  href="<?=admin_url('Conversation/')?>" class="m-menu__link m-menu__toggle">
										<i class="m-menu__link-icon fa fa-comments"></i>
										<span class="m-menu__link-text">
											Tasarım Sohbeti
										</span>
									</a>
								</li>
								<?}?>
								<?if($this->session->userdata('user')->auth == 0 || $this->session->userdata('user')->auth == 2){?>
									<!-- Teklif Cevap Menü -->
									<li class="m-menu__item  m-menu__item--submenu <?=($subMenu=='OfferList'?'m-menu__item--active':'')?> <?=($mainMenu=='Offer'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" id="m_conversation" data-menu-submenu-toggle="hover">
										<a  href="<?=admin_url('Offer/')?>" class="m-menu__link m-menu__toggle">
											<i class="m-menu__link-icon fa fa-comments"></i>
											<span class="m-menu__link-text">
												Teklif Cevap
											</span>
										</a>
									</li>
									<!-- Teklif Cevap Menü -->
									<?}?>
									<?if($this->session->userdata('user')->auth == 0){?>
                            <!-- Referans Menü 
                            <li class="m-menu__item  m-menu__item--submenu  <?=($mainMenu=='Referances'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" id="m_variant" data-menu-submenu-toggle="hover">
								<a  href="#" class="m-menu__link m-menu__toggle">
									<i class="m-menu__link-icon fa 	fa-sitemap"></i>
									<span class="m-menu__link-text">
										Referans Yönetimi
									</span>
									<i class="m-menu__ver-arrow la la-angle-right"></i>
								</a>
								<div class="m-menu__submenu">
									<span class="m-menu__arrow"></span>
									<ul class="m-menu__subnav">
										<li class="m-menu__item <?=($subMenu=='ReferancesList'?'m-menu__item--active':'')?>" aria-haspopup="true">
											<a  href="<?=site_url('Admin/Referances')?>" class="m-menu__link ">
												<i class="m-menu__link-bullet m-menu__link-bullet--dot">
													<span></span>
												</i>
												<span class="m-menu__link-text">
													Referans Listele
												</span>
											</a>
										</li>
										<li class="m-menu__item <?=($subMenu=='ReferancesAdd'?'m-menu__item--active':'')?>" aria-haspopup="true" >
											<a href="<?=site_url('Admin/Referances/add')?>" class="m-menu__link ">
												<i class="m-menu__link-bullet m-menu__link-bullet--dot">
													<span></span>
												</i>
												<span class="m-menu__link-text">
													Referans Ekle
												</span>
											</a>
										</li>
									</ul>
								</div>
							</li>
							Referans Menü -->
							<?}?>
							<?if($this->session->userdata('user')->auth == 0){?>
                            <!-- İndirim Menü 
                            <li class="m-menu__item  m-menu__item--submenu  <?=($mainMenu=='Discount'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" id="m_variant" data-menu-submenu-toggle="hover">
								<a  href="#" class="m-menu__link m-menu__toggle">
									<i class="m-menu__link-icon fa 	fa-sitemap"></i>
									<span class="m-menu__link-text">
										İndirim Yönetimi
									</span>
									<i class="m-menu__ver-arrow la la-angle-right"></i>
								</a>
								<div class="m-menu__submenu">
									<span class="m-menu__arrow"></span>
									<ul class="m-menu__subnav">
										<li class="m-menu__item <?=($subMenu=='DiscountList'?'m-menu__item--active':'')?>" aria-haspopup="true">
											<a  href="<?=site_url('Admin/Discount')?>" class="m-menu__link ">
												<i class="m-menu__link-bullet m-menu__link-bullet--dot">
													<span></span>
												</i>
												<span class="m-menu__link-text">
													İndirimli Ürünleri Listele
												</span>
											</a>
										</li>
										<li class="m-menu__item <?=($subMenu=='DiscountAdd'?'m-menu__item--active':'')?>" aria-haspopup="true" >
											<a href="<?=site_url('Admin/Discount/add')?>" class="m-menu__link ">
												<i class="m-menu__link-bullet m-menu__link-bullet--dot">
													<span></span>
												</i>
												<span class="m-menu__link-text">
													İndirimli Ürün Ekle
												</span>
											</a>
										</li>
									</ul>
								</div>
							</li>
							İndirim Menü -->
							<?}?>
							<?if($this->session->userdata('user')->auth == 0){?>
                            <!-- Çok Satanlar Menü 
                            <li class="m-menu__item  m-menu__item--submenu  <?=($mainMenu=='Seller'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" id="m_variant" data-menu-submenu-toggle="hover">
								<a  href="#" class="m-menu__link m-menu__toggle">
									<i class="m-menu__link-icon fa 	fa-sitemap"></i>
									<span class="m-menu__link-text">
										Çok Satılanlar Yönetimi
									</span>
									<i class="m-menu__ver-arrow la la-angle-right"></i>
								</a>
								<div class="m-menu__submenu">
									<span class="m-menu__arrow"></span>
									<ul class="m-menu__subnav">
										<li class="m-menu__item <?=($subMenu=='SellerList'?'m-menu__item--active':'')?>" aria-haspopup="true">
											<a  href="<?=site_url('Admin/Seller')?>" class="m-menu__link ">
												<i class="m-menu__link-bullet m-menu__link-bullet--dot">
													<span></span>
												</i>
												<span class="m-menu__link-text">
													Çok Satanları Listele
												</span>
											</a>
										</li>
										<li class="m-menu__item <?=($subMenu=='SellerAdd'?'m-menu__item--active':'')?>" aria-haspopup="true" >
											<a href="<?=site_url('Admin/Seller/add')?>" class="m-menu__link ">
												<i class="m-menu__link-bullet m-menu__link-bullet--dot">
													<span></span>
												</i>
												<span class="m-menu__link-text">
													Çok Satanlara Ekleme Yap
												</span>
											</a>
										</li>
									</ul>
								</div>
							</li>
							Çok Satanlar Menü -->
							<?}?>
							<?if($this->session->userdata('user')->auth == 0){?>
								<!-- Yönetici Kullanıcıları Düzenleme -->
								<li class="m-menu__item  m-menu__item--submenu  <?=($mainMenu=='Campaign'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" id="m_variant" data-menu-submenu-toggle="hover">
									<a  href="#" class="m-menu__link m-menu__toggle">
										<i class="m-menu__link-icon fa 	fa-user"></i>
										<span class="m-menu__link-text">
											Kampanya Yönetimi
										</span>
										<i class="m-menu__ver-arrow la la-angle-right"></i>
									</a>
									<div class="m-menu__submenu">
										<span class="m-menu__arrow"></span>
										<ul class="m-menu__subnav">
											<li class="m-menu__item <?=($subMenu=='campaignList'?'m-menu__item--active':'')?>" aria-haspopup="true">
												<a  href="<?=site_url('Admin/Campaign')?>" class="m-menu__link ">
													<i class="m-menu__link-bullet m-menu__link-bullet--dot">
														<span></span>
													</i>
													<span class="m-menu__link-text">
														Kampanyaları Düzenle
													</span>
												</a>
											</li>
											<li class="m-menu__item <?=($subMenu=='campaignAdd'?'m-menu__item--active':'')?>" aria-haspopup="true">
												<a  href="<?=site_url('Admin/Campaign/campaignAdd')?>" class="m-menu__link ">
													<i class="m-menu__link-bullet m-menu__link-bullet--dot">
														<span></span>
													</i>
													<span class="m-menu__link-text">
														Yeni Kampanya Ekle
													</span>
												</a>
											</li>
										</ul>
									</div>
								</li>
								<!-- Kampanya Yönetimi-->
								<?}?>
							</ul>
						</div>
						<!-- END: Aside Menu -->
					</div>
					<!-- END: Left Aside -->
					<div class="m-grid__item m-grid__item--fluid m-wrapper">