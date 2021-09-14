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
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js">
        </script>
        <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous">
        </script>
        <script>
        WebFont.load({
        google: {
        "families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]}
        ,
        active: function() {
        sessionStorage.fonts = true;
        }
        }
        );
        </script>
        <!--end::Web font -->
        <!--begin::Base Styles -->
        <link href="<?=base_url('assets/theme/')?>assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url('assets/theme/')?>assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url('assets/theme/')?>assets/css/custom.css" rel="stylesheet" type="text/css" />
        <!--end::Base Styles -->
        <link rel="icon" href="<?=site_url()?>/assets/Front/images/admin_favicon.png" type="image/x-icon" />
        <script src="https://cdn.ckeditor.com/4.11.3/standard/ckeditor.js">
        </script>
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
                                        <img alt="" width="185" src="<?=site_url('assets/Front/images/logofinali.webp')?>"/>
                                    </a>
                                </div>
                                <div class="m-stack__item m-stack__item--middle m-brand__tools">
                                    <!-- BEGIN: Left Aside Minimize Toggle -->
                                    <a href="javascript:;" id="m_aside_left_minimize_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block">
                                        <span>
                                        </span>
                                    </a>
                                    <!-- END -->
                                    <!-- BEGIN: Responsive Aside Left Menu Toggler -->
                                    <a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
                                        <span>
                                        </span>
                                    </a>
                                    <!-- END -->
                                    <!-- BEGIN: Responsive Header Menu Toggler -->
                                    <a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
                                        <span>
                                        </span>
                                    </a>
                                    <!-- END -->
                                    <!-- BEGIN: Topbar Toggler -->
                                    <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                                        <i class="flaticon-more">
                                        </i>
                                    </a>
                                    <!-- BEGIN: Topbar Toggler -->
                                </div>
                            </div>
                        </div>
                        <!-- END: Brand -->
                        <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
                            <div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-dark m-aside-header-menu-mobile--submenu-skin-dark">
                                <ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
                                    <li class="m-menu__item m-menu__item--submenu m-menu__item--rel m-menu__item--open-dropdown" data-menu-submenu-toggle="click" aria-haspopup="true">
                                        <a href="javascript:void(0);" class="m-menu__link m-menu__toggle">
                                            <i class="m-menu__link-icon flaticon-users">
                                            </i>
                                            <span class="m-menu__link-text">
                                                <?=$this->session->userdata('user')->user_name?>
                                                <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                <span>
                                                </span>
                                                </i>
                                                <font size="2">
                                                <?=$this->session->userdata('user')->user_mail?>
                                                </font>
                                            </span>
                                        </a>
                                        <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left" style="">
                                            <span class="m-menu__arrow m-menu__arrow--adjust" style="left: 73px;">
                                            </span>
                                            <ul class="m-menu__subnav">
                                                <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                                    <a href="#" class="m-menu__link ">
                                                        <i class="m-menu__link-icon flaticon-users">
                                                        </i>
                                                        <span class="m-menu__link-text">
                                                            Profil Bilgilerim
                                                        </span>
                                                    </a>
                                                </li>
                                                <li class="m-menu__item m-menu__item--submenu" data-menu-submenu-toggle="hover" aria-haspopup="true">
                                                    <a href="<?=admin_url('Logout')?>" class="m-menu__link">
                                                        <i class="m-menu__link-icon flaticon-up-arrow">
                                                        </i>
                                                        <span class="m-menu__link-text">
                                                            Çıkış Yap
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="m-menu__item m-menu__item--submenu m-menu__item--rel m-menu__item--open-dropdown" data-menu-submenu-toggle="hover" aria-haspopup="true">
                                        <a href="#" class="m-menu__link m-menu__toggle">
                                            <i class="m-menu__link-icon flaticon-line-graph">
                                            </i>
                                            <span class="m-menu__link-text">
                                                Hızlı Bakış
                                            </span>
                                            <i class="m-menu__hor-arrow la la-angle-down">
                                            </i>
                                            <i class="m-menu__ver-arrow la la-angle-right">
                                            </i>
                                        </a>
                                        <div class="m-menu__submenu  m-menu__submenu--fixed m-menu__submenu--left" style="width:710px">
                                            <span class="m-menu__arrow m-menu__arrow--adjust" style="left: 73.5px;">
                                            </span>
                                            <div class="m-menu__subnav">
                                                <ul class="m-menu__content">
                                                    <li class="m-menu__item">
                                                        <h3 class="m-menu__heading m-menu__toggle">
                                                        <span class="m-menu__link-text">
                                                            Finance Reports
                                                        </span>
                                                        <i class="m-menu__ver-arrow la la-angle-right">
                                                        </i>
                                                        </h3>
                                                        <ul class="m-menu__inner">
                                                            <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                                                <a href="header/actions.html" class="m-menu__link ">
                                                                    <i class="m-menu__link-icon flaticon-map">
                                                                    </i>
                                                                    <span class="m-menu__link-text">
                                                                        Annual Reports
                                                                    </span>
                                                                </a>
                                                            </li>
                                                            <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                                                <a href="header/actions.html" class="m-menu__link ">
                                                                    <i class="m-menu__link-icon flaticon-user">
                                                                    </i>
                                                                    <span class="m-menu__link-text">
                                                                        HR Reports
                                                                    </span>
                                                                </a>
                                                            </li>
                                                            <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                                                <a href="header/actions.html" class="m-menu__link ">
                                                                    <i class="m-menu__link-icon flaticon-clipboard">
                                                                    </i>
                                                                    <span class="m-menu__link-text">
                                                                        IPO Reports
                                                                    </span>
                                                                </a>
                                                            </li>
                                                            <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                                                <a href="header/actions.html" class="m-menu__link ">
                                                                    <i class="m-menu__link-icon flaticon-graphic-1">
                                                                    </i>
                                                                    <span class="m-menu__link-text">
                                                                        Finance Margins
                                                                    </span>
                                                                </a>
                                                            </li>
                                                            <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                                                <a href="header/actions.html" class="m-menu__link ">
                                                                    <i class="m-menu__link-icon flaticon-graphic-2">
                                                                    </i>
                                                                    <span class="m-menu__link-text">
                                                                        Revenue Reports
                                                                    </span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="m-menu__item">
                                                        <h3 class="m-menu__heading m-menu__toggle">
                                                        <span class="m-menu__link-text">
                                                            Sipariş Durumu
                                                        </span>
                                                        <i class="m-menu__ver-arrow la la-angle-right">
                                                        </i>
                                                        </h3>
                                                        <ul class="m-menu__inner">
                                                            <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                                                <a href="header/actions.html" class="m-menu__link ">
                                                                    <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                    <span>
                                                                    </span>
                                                                    </i>
                                                                    <span class="m-menu__link-text">
                                                                        Ödeme Bekleyen
                                                                        <span class="m-badge m-badge--brand m-badge--wide">
                                                                            123
                                                                        </span>
                                                                    </span>
                                                                </a>
                                                            </li>
                                                            <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                                                <a href="header/actions.html" class="m-menu__link ">
                                                                    <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                    <span>
                                                                    </span>
                                                                    </i>
                                                                    <span class="m-menu__link-text">
                                                                        Tedarik Sürecinde
                                                                        <span class="m-badge m-badge--brand m-badge--wide">
                                                                            1
                                                                        </span>
                                                                    </span>
                                                                </a>
                                                            </li>
                                                            <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                                                <a href="header/actions.html" class="m-menu__link ">
                                                                    <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                    <span>
                                                                    </span>
                                                                    </i>
                                                                    <span class="m-menu__link-text">
                                                                        Hazırlanan
                                                                        <span class="m-badge m-badge--brand m-badge--wide">
                                                                            432
                                                                        </span>
                                                                    </span>
                                                                </a>
                                                            </li>
                                                            <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                                                <a href="header/actions.html" class="m-menu__link ">
                                                                    <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                    <span>
                                                                    </span>
                                                                    </i>
                                                                    <span class="m-menu__link-text">
                                                                        Fatura Edilecek
                                                                        <span class="m-badge m-badge--brand m-badge--wide">
                                                                            5656
                                                                        </span>
                                                                    </span>
                                                                </a>
                                                            </li>
                                                            <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                                                <a href="header/actions.html" class="m-menu__link ">
                                                                    <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                    <span>
                                                                    </span>
                                                                    </i>
                                                                    <span class="m-menu__link-text">
                                                                        Tamamlanan
                                                                        <span class="m-badge m-badge--brand m-badge--wide">
                                                                            768
                                                                        </span>
                                                                    </span>
                                                                </a>
                                                            </li>
                                                            <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                                                <a href="header/actions.html" class="m-menu__link ">
                                                                    <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                    <span>
                                                                    </span>
                                                                    </i>
                                                                    <span class="m-menu__link-text" style="color:#f4516c;">
                                                                        Geciken
                                                                        <span class="m-badge m-badge--danger m-badge--wide">
                                                                            4
                                                                        </span>
                                                                    </span>
                                                                </a>
                                                            </li>
                                                            <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                                                <a href="header/actions.html" class="m-menu__link ">
                                                                    <i class="m-menu__link-bullet m-menu__link-bullet--line">
                                                                    <span>
                                                                    </span>
                                                                    </i>
                                                                    <span class="m-menu__link-text" style="color:#f4516c;">
                                                                        İptal Edilen
                                                                        <span class="m-badge m-badge--danger m-badge--wide">
                                                                            1
                                                                        </span>
                                                                    </span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="m-menu__item">
                                                        <h3 class="m-menu__heading m-menu__toggle">
                                                        <span class="m-menu__link-text">
                                                            HR Reports
                                                        </span>
                                                        <i class="m-menu__ver-arrow la la-angle-right">
                                                        </i>
                                                        </h3>
                                                        <ul class="m-menu__inner">
                                                            <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                                                <a href="header/actions.html" class="m-menu__link ">
                                                                    <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                                    <span>
                                                                    </span>
                                                                    </i>
                                                                    <span class="m-menu__link-text">
                                                                        Staff Directory
                                                                    </span>
                                                                </a>
                                                            </li>
                                                            <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                                                <a href="header/actions.html" class="m-menu__link ">
                                                                    <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                                    <span>
                                                                    </span>
                                                                    </i>
                                                                    <span class="m-menu__link-text">
                                                                        Client Directory
                                                                    </span>
                                                                </a>
                                                            </li>
                                                            <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                                                <a href="header/actions.html" class="m-menu__link ">
                                                                    <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                                    <span>
                                                                    </span>
                                                                    </i>
                                                                    <span class="m-menu__link-text">
                                                                        Salary Reports
                                                                    </span>
                                                                </a>
                                                            </li>
                                                            <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                                                <a href="header/actions.html" class="m-menu__link ">
                                                                    <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                                    <span>
                                                                    </span>
                                                                    </i>
                                                                    <span class="m-menu__link-text">
                                                                        Staff Payslips
                                                                    </span>
                                                                </a>
                                                            </li>
                                                            <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                                                <a href="header/actions.html" class="m-menu__link ">
                                                                    <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                                    <span>
                                                                    </span>
                                                                    </i>
                                                                    <span class="m-menu__link-text">
                                                                        Corporate Expenses
                                                                    </span>
                                                                </a>
                                                            </li>
                                                            <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                                                <a href="header/actions.html" class="m-menu__link ">
                                                                    <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                                    <span>
                                                                    </span>
                                                                    </i>
                                                                    <span class="m-menu__link-text">
                                                                        Project Expenses
                                                                    </span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li style="float:right;" class="m-menu__item m-menu__item--submenu m-menu__item--rel m-menu__item--open-dropdown" data-menu-submenu-toggle="click" aria-haspopup="true">
                                        <a href="<?=site_url()?>" class="m-menu__link" target="_blank">
                                            <i class="m-menu__link-icon flaticon-paper-plane">
                                            </i>
                                            <span class="m-menu__link-title">
                                                <span class="m-menu__link-wrap">
                                                    <span class="m-menu__link-text">
                                                        Siteye Git
                                                    </span>
                                                    <span class="m-menu__link-badge">
                                                    </span>
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
                                <div class="m-stack__item m-topbar__nav-wrapper">
                                    <ul class="m-topbar__nav m-nav m-nav--inline">
                                        <li class="
                                            m-nav__item m-dropdown m-dropdown--large m-dropdown--arrow m-dropdown--align-center m-dropdown--mobile-full-width m-dropdown--skin-light    m-list-search m-list-search--skin-light" data-dropdown-toggle="click" data-dropdown-persistent="true" id="m_quicksearch" data-search-type="dropdown">
                                            <a href="#" class="m-nav__link m-dropdown__toggle">
                                                <span class="m-topbar__userpic">
                                                    <img src="<?=site_url('assets/Front/images/pp.webp')?>" class="m--img-rounded m--marginless m--img-centered" alt="" onclick='window.location.href="<?=current_url()?>"'/>
                                                </span>
                                                <span class="m-topbar__username m--hide">
                                                    <?=$this->session->userdata('user')->user_name?>
                                                </span>
                                            </a>
                                        </li>
                                        <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" data-dropdown-toggle="click">
                                            <a href="#" class="m-nav__link m-dropdown__toggle">
                                                <span class="m-topbar__userpic">
                                                    <img src="assets/app/media/img/users/user4.jpg" class="m--img-rounded m--marginless m--img-centered" alt="">
                                                </span>
                                                <span class="m-topbar__username m--hide">
                                                    Nick
                                                </span>
                                            </a>
                                            <div class="m-dropdown__wrapper">
                                                <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust">
                                                </span>
                                                <div class="m-dropdown__inner">
                                                    <div class="m-dropdown__header m--align-center" style="background: url(assets/app/media/img/misc/user_profile_bg.jpg); background-size: cover;">
                                                        <div class="m-card-user m-card-user--skin-dark">
                                                            <div class="m-card-user__pic">
                                                                <img src="assets/app/media/img/users/user4.jpg" class="m--img-rounded m--marginless" alt="">
                                                            </div>
                                                            <div class="m-card-user__details">
                                                                <span class="m-card-user__name m--font-weight-500">
                                                                    Mark Andre
                                                                </span>
                                                                <a href="" class="m-card-user__email m--font-weight-300 m-link">
                                                                    demo@example.com
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="m-dropdown__body">
                                                        <div class="m-dropdown__content">
                                                            <ul class="m-nav m-nav--skin-light">
                                                                <li class="m-nav__section m--hide">
                                                                    <span class="m-nav__section-text">
                                                                        Section
                                                                    </span>
                                                                </li>
                                                                <li class="m-nav__item">
                                                                    <a href="header/profile.html" class="m-nav__link">
                                                                        <i class="m-nav__link-icon flaticon-profile-1">
                                                                        </i>
                                                                        <span class="m-nav__link-title">
                                                                            <span class="m-nav__link-wrap">
                                                                                <span class="m-nav__link-text">
                                                                                    My Profile
                                                                                </span>
                                                                                <span class="m-nav__link-badge">
                                                                                    <span class="m-badge m-badge--success">
                                                                                        2
                                                                                    </span>
                                                                                </span>
                                                                            </span>
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li class="m-nav__item">
                                                                    <a href="header/profile.html" class="m-nav__link">
                                                                        <i class="m-nav__link-icon flaticon-share">
                                                                        </i>
                                                                        <span class="m-nav__link-text">
                                                                            Activity
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li class="m-nav__item">
                                                                    <a href="header/profile.html" class="m-nav__link">
                                                                        <i class="m-nav__link-icon flaticon-chat-1">
                                                                        </i>
                                                                        <span class="m-nav__link-text">
                                                                            Messages
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li class="m-nav__separator m-nav__separator--fit">
                                                                </li>
                                                                <li class="m-nav__item">
                                                                    <a href="header/profile.html" class="m-nav__link">
                                                                        <i class="m-nav__link-icon flaticon-info">
                                                                        </i>
                                                                        <span class="m-nav__link-text">
                                                                            FAQ
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li class="m-nav__item">
                                                                    <a href="header/profile.html" class="m-nav__link">
                                                                        <i class="m-nav__link-icon flaticon-lifebuoy">
                                                                        </i>
                                                                        <span class="m-nav__link-text">
                                                                            Support
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li class="m-nav__separator m-nav__separator--fit">
                                                                </li>
                                                                <li class="m-nav__item">
                                                                    <a href="snippets/pages/user/login-1.html" class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">
                                                                        Logout
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
                        </div>
                    </div>
                </div>
            </header>
            <!-- END: Header -->
            <!-- begin::Body -->
            <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
                <!-- BEGIN: Left Aside -->
                <div id="m_aside_left" class="m-grid__item  m-aside-left  m-aside-left--skin-dark ">
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
                                    <i class="m-menu__link-icon flaticon-line-graph">
                                    </i>
                                    <span class="m-menu__link-title">
                                        <span class="m-menu__link-wrap">
                                            <span class="m-menu__link-text">
                                                Anasayfa
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <?if($this->session->userdata('user')->auth == 0){?>
                            <li class="m-menu__item  m-menu__item--submenu <?=($mainMenu=='Order'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" id="m_variant" data-menu-submenu-toggle="hover">
                                <a  href="#" class="m-menu__link m-menu__toggle">
                                    <i class="m-menu__link-icon flaticon-file">
                                    </i>
                                    <span class="m-menu__link-text">
                                        Sipariş Yönetimi
                                    </span>
                                    <i class="m-menu__ver-arrow la la-angle-right">
                                    </i>
                                </a>
                                <div class="m-menu__submenu">
                                    <span class="m-menu__arrow">
                                    </span>
                                    <ul class="m-menu__subnav">
                                        <li class="m-menu__item <?=($subMenu=='OrderList'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                            <a  href="<?=site_url('Admin/Order')?>" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Sipariş Listele
                                                </span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item <?=($subMenu=='OdemeOnay'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                            <a  href="<?=site_url('Admin/Order/paymentStatusCheck')?>" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Ödeme Onayı Bekleyenler
                                                </span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item <?=($subMenu=='TedarikOnay'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                            <a  href="<?=site_url('Admin/Order/supplyCheck')?>" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Tedarik Onayı Bekleyenler
                                                </span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item <?=($subMenu=='GelenOnay'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                            <a  href="<?=site_url('Admin/Order/IncomingProductCheck')?>" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Gelen Ürün Onay
                                                </span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item <?=($subMenu=='GidenOnay'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                            <a  href="<?=site_url('Admin/Order/outGoingCheck')?>" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Giden Ürün Onay
                                                </span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item <?=($subMenu=='KargoOnay'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                            <a  href="<?=site_url('Admin/Order/goingCargoCheck')?>" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Kargoya Verilecekler
                                                </span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item <?=($subMenu=='SiparisIade'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                            <a  href="<?=site_url('Admin/Order/cancelOrderRefound')?>" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    İptal Sipariş İadeleri
                                                </span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item <?=($subMenu=='EksikUrun'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                            <a  href="<?=site_url('Admin/Order/missingProguctCheck')?>" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Eksik Ürünlü Siparişler
                                                </span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item <?=($subMenu=='OrderList1'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                            <a  href="<?=site_url('Admin/Order')?>" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    İade İşlemleri
                                                </span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item <?=($subMenu=='offerFormGet'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                            <a  href="<?php echo admin_url('Order/orderForm'); ?>" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Toplu Parça Teklifleri
                                                </span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item <?=($subMenu=='OrderList1'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                            <a  href="<?=site_url('Admin/Order')?>" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Sepetler
                                                </span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item <?=($subMenu=='OrderList1'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                            <a  href="<?=site_url('Admin/Order')?>" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Alarm Listesi
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <?}?>
                            <?if($this->session->userdata('user')->auth == 3 || $this->session->userdata('user')->auth == 0 || $this->session->userdata('user')->auth == 2){?>
                            <li class="m-menu__item  m-menu__item--submenu <?=($mainMenu=='Product'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" id="m_variant" data-menu-submenu-toggle="hover">
                                <a  href="#" class="m-menu__link m-menu__toggle">
                                    <i class="m-menu__link-icon flaticon-bag">
                                    </i>
                                    <span class="m-menu__link-text">
                                        Ürün Yönetimi
                                    </span>
                                    <i class="m-menu__ver-arrow la la-angle-right">
                                    </i>
                                </a>
                                <div class="m-menu__submenu">
                                    <span class="m-menu__arrow">
                                    </span>
                                    <ul class="m-menu__subnav">
                                        <li class="m-menu__item <?=($subMenu=='ProductList'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                            <a  href="<?=site_url('Admin/Product')?>" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Ürün Listele
                                                </span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item <?=($subMenu=='commentList'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                            <a  href="<?=site_url('Admin/Comment/commentList')?>" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Ürün Yorumları
                                                </span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item <?=($subMenu=='questionList'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                            <a  href="<?=site_url('Admin/Comment/questionList')?>" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Ürün Soruları
                                                </span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item <?=($subMenu=='ServiceProblem'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                            <a href="<?=admin_url('ServiceProblem/')?>" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Ürün Kontrol
                                                </span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item <?=($subMenu=='MarkaTedarikci'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                            <a href="<?=site_url('Admin/MarkaTedarikci')?>" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Ürün Marka Yönetimi
                                                </span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item <?=($subMenu=='CatList'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                            <a  href="<?=site_url('Admin/Category')?>" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Ürün Kategori Yönetimi
                                                </span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item <?=($subMenu=='favList'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                            <a  href="<?=site_url('Admin/Category/favoritesProduct')?>" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Fırsat Ürünü Seç
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <?}?>
                            <?if($this->session->userdata('user')->auth == 0){?>
                            <li class="m-menu__item  m-menu__item--submenu <?=($mainMenu=='User'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" id="m_variant" data-menu-submenu-toggle="hover">
                                <a  href="#" class="m-menu__link m-menu__toggle">
                                    <i class="m-menu__link-icon flaticon-user-settings">
                                    </i>
                                    <span class="m-menu__link-text">
                                        Üyeler
                                    </span>
                                    <i class="m-menu__ver-arrow la la-angle-right">
                                    </i>
                                </a>
                                <div class="m-menu__submenu">
                                    <span class="m-menu__arrow">
                                    </span>
                                    <ul class="m-menu__subnav">
                                        <li class="m-menu__item <?=($subMenu=='UserList'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                            <a  href="<?=site_url('Admin/User')?>" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Üyeleri Listele
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <?}?>
                            <?if($this->session->userdata('user')->auth == 0){?>
                            <li class="m-menu__item  m-menu__item--submenu <?=($mainMenu=='Slider'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" id="m_variant" data-menu-submenu-toggle="hover">
                                <a  href="#" class="m-menu__link m-menu__toggle">
                                    <i class="m-menu__link-icon flaticon-share">
                                    </i>
                                    <span class="m-menu__link-text">
                                        Reklam İşlemleri
                                    </span>
                                    <i class="m-menu__ver-arrow la la-angle-right">
                                    </i>
                                </a>
                                <div class="m-menu__submenu">
                                    <span class="m-menu__arrow">
                                    </span>
                                    <ul class="m-menu__subnav">
                                        <li class="m-menu__item <?=($subMenu=='SliderList'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                            <a  href="<?=site_url('Admin/Slider')?>" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Slider İşlemleri
                                                </span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item <?=($subMenu=='sliderImage'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                            <a  href="<?=site_url('Admin/Slider/sliderImage')?>" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Mobil Slider İşlemleri
                                                </span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item <?=($subMenu=='SliderProduct'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                            <a  href="<?=site_url('Admin/Slider/ProductSlider')?>" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Banner Güncelle
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <?}?>
                            <?if($this->session->userdata('user')->auth == 0){?>
                            <li class="m-menu__item  m-menu__item--submenu <?=($mainMenu=='Aracagaci'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" id="m_variant" data-menu-submenu-toggle="hover">
                                <a  href="#" class="m-menu__link m-menu__toggle">
                                    <i class="m-menu__link-icon flaticon-transport">
                                    </i>
                                    <span class="m-menu__link-text">
                                        Araç Yönetimi
                                    </span>
                                    <i class="m-menu__ver-arrow la la-angle-right">
                                    </i>
                                </a>
                                <div class="m-menu__submenu">
                                    <span class="m-menu__arrow">
                                    </span>
                                    <ul class="m-menu__subnav">
                                        <li class="m-menu__item <?=($subMenu=='aracagaci'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                            <a  href="<?=site_url('Admin/Aracagaci')?>" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Araç Ağacı Düzenleme
                                                </span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item <?=($subMenu=='aracYagAgaci'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                            <a  href="<?=site_url('Admin/Aracagaci/yagagaci')?>" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Araç Ağacı Yağ Bilgisi Ekle
                                                </span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item <?=($subMenu=='brandList'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                            <a  href="<?=site_url('Admin/Brand')?>" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Araç Marka Yönetimi
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <?}?>
                            <?if($this->session->userdata('user')->auth == 0){?>
                            <li class="m-menu__item  m-menu__item--submenu <?=($mainMenu=='Tedarikci'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" id="m_variant" data-menu-submenu-toggle="hover">
                                <a  href="#" class="m-menu__link m-menu__toggle">
                                    <i class="m-menu__link-icon flaticon-folder-4">
                                    </i>
                                    <span class="m-menu__link-text">
                                        Tedarikçi Yönetimi
                                    </span>
                                    <i class="m-menu__ver-arrow la la-angle-right">
                                    </i>
                                </a>
                                <div class="m-menu__submenu">
                                    <span class="m-menu__arrow">
                                    </span>
                                    <ul class="m-menu__subnav">
                                        <li class="m-menu__item <?=($subMenu=='Tedarikci'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                            <a  href="<?=site_url('Admin/MarkaTedarikci/tedarikci')?>" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Tedarikçi
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <?}?>
                            <?if($this->session->userdata('user')->auth == 0){?>
                            <li class="m-menu__item  m-menu__item--submenu  <?=($mainMenu=='Indirim'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" id="m_category" data-menu-submenu-toggle="hover">
                                <a  href="#" class="m-menu__link m-menu__toggle">
                                    <i class="m-menu__link-icon flaticon-interface-1">
                                    </i>
                                    <span class="m-menu__link-text">
                                        İskonto Yönetimi
                                    </span>
                                    <i class="m-menu__ver-arrow la la-angle-right">
                                    </i>
                                </a>
                                <div class="m-menu__submenu">
                                    <span class="m-menu__arrow">
                                    </span>
                                    <ul class="m-menu__subnav">
                                        <li class="m-menu__item <?=($subMenu=='IndirimList'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                            <a  href="<?=site_url('Admin/Indirim')?>" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    İskonto Listele
                                                </span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item <?=($subMenu=='GiftList'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                            <a  href="<?=site_url('Admin/Giftcheck')?>" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Hediye Çeki Listele
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <?}?>
                            <?if($this->session->userdata('user')->auth == 0){?>
                            <li class="m-menu__item  m-menu__item--submenu  <?=($mainMenu=='Notification'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" id="m_category" data-menu-submenu-toggle="hover">
                                <a  href="#" class="m-menu__link m-menu__toggle">
                                    <i class="m-menu__link-icon flaticon-bell">
                                    </i>
                                    <span class="m-menu__link-text">
                                        Bildirim Yönetimi
                                    </span>
                                    <i class="m-menu__ver-arrow la la-angle-right">
                                    </i>
                                </a>
                                <div class="m-menu__submenu">
                                    <span class="m-menu__arrow">
                                    </span>
                                    <ul class="m-menu__subnav">
                                        <li class="m-menu__item <?=($subMenu=='notificationList'?'m-menu__item--active':'')?>" aria-haspopup="true" >
                                            <a href="<?=site_url('Admin/Notification')?>" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Bildirim Listele
                                                </span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item <?=($subMenu=='bulletinList'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                            <a  href="<?=admin_url('Form/bulletin')?>" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    E-Bülten Listesi
                                                </span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item <?=($subMenu=='sms'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                            <a  href="<?=admin_url('Notification/sms')?>" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Toplu SMS Gönder
                                                </span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item <?=($subMenu=='email'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                            <a  href="<?=admin_url('Notification/email')?>" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Toplu E-Posta
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <?}?>
                            <?if($this->session->userdata('user')->auth == 0){?>
                            <li class="m-menu__item  m-menu__item--submenu  <?=($mainMenu=='Kargo'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" id="m_category" data-menu-submenu-toggle="hover">
                                <a  href="#" class="m-menu__link m-menu__toggle">
                                    <i class="m-menu__link-icon flaticon-open-box">
                                    </i>
                                    <span class="m-menu__link-text">
                                        Kargo Yönetimi
                                    </span>
                                    <i class="m-menu__ver-arrow la la-angle-right">
                                    </i>
                                </a>
                                <div class="m-menu__submenu">
                                    <span class="m-menu__arrow">
                                    </span>
                                    <ul class="m-menu__subnav">
                                        <li class="m-menu__item <?=($subMenu=='Kargo'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                            <a  href="<?=admin_url('Kargo/')?>" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Kargo Fiyatları
                                                </span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item <?=($subMenu==''?'m-menu__item--active':'')?>" aria-haspopup="true">
                                            <a  href="" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Kargo Firmaları Listele
                                                </span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item <?=($subMenu=='TatilList'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                            <a  href="<?=admin_url('Tatil/')?>" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Tatil Günleri
                                                </span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item <?=($subMenu==''?'m-menu__item--active':'')?>" aria-haspopup="true">
                                            <a  href="" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Adres Etiketi Düzenle
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <?}?>
                            <?if($this->session->userdata('user')->auth == 0){?>
                            <li class="m-menu__item  m-menu__item--submenu  <?=($mainMenu=='AdminEdit'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" id="m_variant" data-menu-submenu-toggle="hover">
                                <a  href="#" class="m-menu__link m-menu__toggle">
                                    <i class="m-menu__link-icon flaticon-user-ok">
                                    </i>
                                    <span class="m-menu__link-text">
                                        Yöneticiler
                                    </span>
                                    <i class="m-menu__ver-arrow la la-angle-right">
                                    </i>
                                </a>
                                <div class="m-menu__submenu">
                                    <span class="m-menu__arrow">
                                    </span>
                                    <ul class="m-menu__subnav">
                                        <li class="m-menu__item <?=($subMenu=='AdminUserEdit'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                            <a  href="<?=site_url('Admin/AdminUserEdit')?>" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Yöneticileri Listele
                                                </span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item <?=($subMenu=='YoneticiMail'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                            <a  href="<?=site_url('Admin/AdminUserEdit/mail')?>" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    İşlem Mail Adresleri
                                                </span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item <?=($subMenu==''?'m-menu__item--active':'')?>" aria-haspopup="true">
                                            <a  href="" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    İş Akış Onay
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <?}?>
                            <?if($this->session->userdata('user')->auth == 0){?>
                            <li class="m-menu__item  m-menu__item--submenu  <?=($mainMenu=='Istatistik'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" id="m_variant" data-menu-submenu-toggle="hover">
                                <a  href="#" class="m-menu__link m-menu__toggle">
                                    <i class="m-menu__link-icon flaticon-diagram">
                                    </i>
                                    <span class="m-menu__link-text">
                                        İstatistik Yönetimi
                                    </span>
                                    <i class="m-menu__ver-arrow la la-angle-right">
                                    </i>
                                </a>
                                <div class="m-menu__submenu">
                                    <span class="m-menu__arrow">
                                    </span>
                                    <ul class="m-menu__subnav">
                                    </ul>
                                </div>
                            </li>
                            <?}?>
                            <?if($this->session->userdata('user')->auth == 0){?>
                            <li class="m-menu__item  m-menu__item--submenu  <?=($mainMenu=='FeedBack'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" id="m_variant" data-menu-submenu-toggle="hover">
                                <a  href="#" class="m-menu__link m-menu__toggle">
                                    <i class="m-menu__link-icon flaticon-profile-1">
                                    </i>
                                    <span class="m-menu__link-text">
                                        Geri Bildirim Yönetimi
                                    </span>
                                    <i class="m-menu__ver-arrow la la-angle-right">
                                    </i>
                                </a>
                                <div class="m-menu__submenu">
                                    <span class="m-menu__arrow">
                                    </span>
                                    <ul class="m-menu__subnav">
                                        <li class="m-menu__item <?=($subMenu=='reviewList'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                            <a  href="<?=site_url('Admin/Comment')?>" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Değerlendirmeleri Listele
                                                </span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item <?=($subMenu=='answerList'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                            <a  href="<?=site_url('Admin/Comment/answerList')?>" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Hazır Yanıt Yönetimi
                                                </span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item <?=($subMenu=='reviewListRe'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                            <a  href="<?=site_url('Admin/Review')?>" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Anket Yönetimi
                                                </span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item <?=($subMenu=='formList'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                            <a  href="<?=admin_url('Form')?>" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    İletişim Talepleri
                                                </span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item m-menu__item--submenu <?=(isset($lowerMenu) && $lowerMenu == 'supportAndHelp')?'m-menu__item--open':''?>" aria-haspopup="true" data-menu-submenu-toggle="hover">
                                            <a href="#" class="m-menu__link m-menu__toggle">
                                                <i class="m-menu__link-bullet fa fa-chevron-right" style="font-size: 9px;">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Destek ve Yardım
                                                </span>
                                                <i class="m-menu__ver-arrow la la-angle-right">
                                                </i>
                                            </a>
                                            <div class="m-menu__submenu">
                                                <span class="m-menu__arrow">
                                                </span>
                                                <ul class="m-menu__subnav">
                                                    <li class="m-menu__item <?=($subMenu=='supportSectionList'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                                        <a  href="<?=admin_url('Support')?>" class="m-menu__link ">
                                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                            <span>
                                                            </span>
                                                            </i>
                                                            <span class="m-menu__link-text">
                                                                Destek Bölümlerini Listele
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="m-menu__item <?=($subMenu=='supportRequests'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                                        <a  href="<?=admin_url('Support/support_requests')?>" class="m-menu__link ">
                                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                            <span>
                                                            </span>
                                                            </i>
                                                            <span class="m-menu__link-text">
                                                                Destek Talepleri
                                                            </span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="m-menu__item m-menu__item--submenu <?=(isset($lowerMenu) && $lowerMenu == 'Human_resources')?'m-menu__item--open':''?>" aria-haspopup="true" data-menu-submenu-toggle="hover">
                                            <a href="#" class="m-menu__link m-menu__toggle">
                                                <i class="m-menu__link-bullet fa fa-chevron-right" style="font-size: 9px;">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    İnsan Kaynakları
                                                </span>
                                                <i class="m-menu__ver-arrow la la-angle-right">
                                                </i>
                                            </a>
                                            <div class="m-menu__submenu" style="">
                                                <span class="m-menu__arrow">
                                                </span>
                                                <ul class="m-menu__subnav">
                                                    <li class="m-menu__item <?=($subMenu=='list'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                                        <a  href="<?=admin_url('Human_resources')?>" class="m-menu__link ">
                                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                            <span>
                                                            </span>
                                                            </i>
                                                            <span class="m-menu__link-text">
                                                                Başvuruları Görüntüle
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="m-menu__item <?=($subMenu=='positionList'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                                        <a  href="<?=site_url('Admin/Form/positionList')?>" class="m-menu__link ">
                                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                            <span>
                                                            </span>
                                                            </i>
                                                            <span class="m-menu__link-text">
                                                                Pozisyonlar
                                                            </span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <?}?>
                            <?if($this->session->userdata('user')->auth == 0){?>
                            <li class="m-menu__item m-menu__item--submenu <?=($mainMenu=='Content'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" data-menu-submenu-toggle="hover">
                                <a href="#" class="m-menu__link m-menu__toggle">
                                    <i class="m-menu__link-icon flaticon-book">
                                    </i>
                                    <span class="m-menu__link-text">
                                        Site İçerik Yönetimi
                                    </span>
                                    <i class="m-menu__ver-arrow la la-angle-right">
                                    </i>
                                </a>
                                <div class="m-menu__submenu" style="">
                                    <span class="m-menu__arrow">
                                    </span>
                                    <ul class="m-menu__subnav">
                                        <li class="m-menu__item m-menu__item--submenu <?=(isset($lowerMenu) && $lowerMenu == 'HomePageContent')?'m-menu__item--open':''?>" aria-haspopup="true" data-menu-submenu-toggle="hover">
                                            <a href="#" class="m-menu__link m-menu__toggle">
                                                <i class="m-menu__link-bullet fa fa-chevron-right" style="font-size: 9px;">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Anasayfa
                                                </span>
                                                <i class="m-menu__ver-arrow la la-angle-right">
                                                </i>
                                            </a>
                                            <div class="m-menu__submenu" style="">
                                                <span class="m-menu__arrow">
                                                </span>
                                                <ul class="m-menu__subnav">
                                                    <li class="m-menu__item <?=($subMenu=='sellerList'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                                        <a href="<?=site_url('Admin/Sellers')?>" class="m-menu__link ">
                                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                            <span>
                                                            </span>
                                                            </i>
                                                            <span class="m-menu__link-text">
                                                                Çok Satılanları Listele
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="m-menu__item <?=($subMenu=='videoEdit'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                                        <a href="<?=site_url('Admin/Corporate')?>" class="m-menu__link ">
                                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                            <span>
                                                            </span>
                                                            </i>
                                                            <span class="m-menu__link-text">
                                                                Video Düzenle
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="m-menu__item <?=($subMenu=='aboutEdit'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                                        <a href="<?=site_url('Admin/Content')?>" class="m-menu__link ">
                                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                            <span>
                                                            </span>
                                                            </i>
                                                            <span class="m-menu__link-text">
                                                                Açıklama Düzenle
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="m-menu__item <?=($subMenu=='biyografiEdit'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                                        <a href="<?=site_url('Admin/Content/contentOtoparcasan')?>" class="m-menu__link ">
                                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                            <span>
                                                            </span>
                                                            </i>
                                                            <span class="m-menu__link-text">
                                                                Biyografi Düzenle
                                                            </span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="m-menu__item m-menu__item--submenu <?=(isset($lowerMenu) && $lowerMenu == 'CorporateContent')?'m-menu__item--open':''?>" aria-haspopup="true" data-menu-submenu-toggle="hover">
                                            <a href="#" class="m-menu__link m-menu__toggle">
                                                <i class="m-menu__link-bullet fa fa-chevron-right" style="font-size: 9px;">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Kurumsal
                                                </span>
                                                <i class="m-menu__ver-arrow la la-angle-right">
                                                </i>
                                            </a>
                                            <div class="m-menu__submenu" style="">
                                                <span class="m-menu__arrow">
                                                </span>
                                                <ul class="m-menu__subnav">
                                                    <li class="m-menu__item <?=($subMenu=='faqList'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                                        <a href="<?=site_url('Admin/Faq')?>" class="m-menu__link ">
                                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                            <span>
                                                            </span>
                                                            </i>
                                                            <span class="m-menu__link-text">
                                                                Sıkça Sorulan Sorular
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="m-menu__item <?=($subMenu=='servicesList'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                                        <a  href="<?=admin_url('Contracted_services/list')?>" class="m-menu__link ">
                                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                            <span>
                                                            </span>
                                                            </i>
                                                            <span class="m-menu__link-text">
                                                                Anlaşmalı Servisler
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="m-menu__item <?=($subMenu=='StaticsList'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                                        <a  href="<?=site_url('Admin/Statics')?>" class="m-menu__link ">
                                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                            <span>
                                                            </span>
                                                            </i>
                                                            <span class="m-menu__link-text">
                                                                Sabit Sayfalar
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="m-menu__item <?=($subMenu=='bankList'?'m-menu__item--active':'')?>" aria-haspopup="true">
                                                        <a  href="<?=admin_url('Bank_account')?>" class="m-menu__link ">
                                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                            <span>
                                                            </span>
                                                            </i>
                                                            <span class="m-menu__link-text">
                                                                Hesap Numaralarımız
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="m-menu__item <?=($subMenu==''?'m-menu__item--active':'')?>" aria-haspopup="true">
                                                        <a  href="<?=admin_url('')?>" class="m-menu__link ">
                                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                            <span>
                                                            </span>
                                                            </i>
                                                            <span class="m-menu__link-text">
                                                                Sosyal Medya Hesapları
                                                            </span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <?}?>
                            <?if($this->session->userdata('user')->auth == 0){?>
                            <li class="m-menu__item  m-menu__item--submenu <?=($subMenu==''?'m-menu__item--active':'')?> <?=($mainMenu=='Slider'?'m-menu__item--open m-menu__item--expanded':'')?>" aria-haspopup="true" id="m_slider" data-menu-submenu-toggle="hover">
                                <a  href="#" class="m-menu__link m-menu__toggle">
                                    <i class="m-menu__link-icon flaticon-cogwheel-2">
                                    </i>
                                    <span class="m-menu__link-text">
                                        Teknik İşlemler
                                    </span>
                                    <i class="m-menu__ver-arrow la la-angle-right">
                                    </i>
                                </a>
                                <div class="m-menu__submenu">
                                    <span class="m-menu__arrow">
                                    </span>
                                    <ul class="m-menu__subnav">
                                        <li class="m-menu__item <?=($subMenu==''?'m-menu__item--active':'')?>" aria-haspopup="true">
                                            <a  href="" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Bakım Modu
                                                </span>
                                            </a>
                                        </li>
                                        <li class="m-menu__item <?=($subMenu==''?'m-menu__item--active':'')?>" aria-haspopup="true">
                                            <a  href="https://analytics.google.com/analytics/web/#/report-home/a156465685w220392755p209709421" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span>
                                                </span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Google Analytics
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <?}?>
                        </ul>
                    </div>
                    <!-- END: Aside Menu -->
                </div>
                <!-- END: Left Aside -->
                <div class="m-grid__item m-grid__item--fluid m-wrapper">