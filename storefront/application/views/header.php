<!-- Load Animation -->
<div class="otoparcasan-loading">
    <div class="loading">
        <img src="<?=site_url('assets/Front/images/loadlogo.png')?>" alt="">
        <div class="animation-area">
            <img src="<?=site_url('assets/Front/images/animatecursor.png')?>" alt="">
        </div>
        <p>Yükleniyor..</p>
        <div class="loader-area">
            <div class="loader-box">
                <div class="loader">
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function pageLoadingAnimateOn () {
        $('.otoparcasan-loading').fadeIn(500);
        $('.otoparcasan-loading').css("display", "flex");
    }
    function pageLoadingAnimateOff () {
        $('.otoparcasan-loading').fadeOut(500);
    }
</script>
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
                        <?php if($stars->star < 2){ ?>
                            <i class="fa fa-star OK"></i>
                        <?php }elseif($stars->star < 3){ ?>
                            <i class="fa fa-star OK"></i>
                            <i class="fa fa-star OK"></i>
                        <?php }elseif($stars->star < 4){ ?>
                            <i class="fa fa-star OK"></i>
                            <i class="fa fa-star OK"></i>
                            <i class="fa fa-star OK"></i>
                        <?php }elseif($stars->star < 5){ ?>
                            <i class="fa fa-star OK"></i>
                            <i class="fa fa-star OK"></i>
                            <i class="fa fa-star OK"></i>
                            <i class="fa fa-star OK"></i>
                        <?php }else{ ?>
                            <i class="fa fa-star OK"></i>
                            <i class="fa fa-star OK"></i>
                            <i class="fa fa-star OK"></i>
                            <i class="fa fa-star OK"></i>
                            <i class="fa fa-star OK"></i>
                        <?php } ?>
                        <a href="<?=site_url('yorumlar')?>"><?=number_format($stars->star,1)?> / 5 &nbsp&nbsp ( <?=$countReviews?> - Geri Bildirim )</a>
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
                                <?php if (empty($this->session->userdata('userInfo'))) { ?>
                                <li class="Item Login">
                                    <a href="<?=site_url('giris-yap?redirect='.current_url())?>" class="Item">
                                        <div class="Icon"><img src="<?=site_url('assets/Front/images/Icons/h-member.webp')?>" alt=""></div>
                                        <span>Giriş Yap</span>
                                    </a>
                                </li>
                                <?php }else{ ?>
                                <li id="dropdownUserOpen" class="Item Login">
                                    <a href="<?=site_url('hesabim')?>" class="Item">
                                        <div class="Icon"><img src="<?=site_url('assets/Front/images/Icons/h-member.webp')?>" alt=""></div>
                                        <span class="d-block user-name"><?$writeName=explode(" ", $userInfo->name);echo $writeName[0];?></span>
                                    </a>
                                    <div class="dropdownUserMenu">
                                        <div class="accountPanel">
                                            <div class="panel-content">
                                                <a href="<?=site_url('hesabim')?>" class="panel-link">
                                                    <div class="Icon">
                                                        <i class="fa fa-user" aria-hidden="true"></i>
                                                        <p>Üyelik Bilgilerim</p></div>
                                                    </a>
                                                    <a href="<?=site_url('hesabim/siparislerim')?>" class="panel-link">
                                                        <div class="Icon">
                                                            <i class="fa fa-cube" aria-hidden="true"></i>
                                                            <p>Siparişlerim<span class="Count"><?=$orderCount?></span></p>
                                                        </div>
                                                    </a>
                                                    <a href="<?=site_url('hesabim/iadelerim')?>" class="panel-link ">
                                                        <div class="Icon">
                                                            <i class="fa fa-reply" aria-hidden="true"></i>
                                                            <p>İadelerim<span class="Count">3</span></p>
                                                        </div>
                                                    </a>
                                                    <a href="<?=site_url('hesabim/urun-sorularim')?>" class="panel-link ">
                                                        <div class="Icon">
                                                            <i class="fa fa-question-circle" aria-hidden="true"></i>
                                                            <p>Ürün Sorularım<span class="Count">3</span></p>
                                                        </div>
                                                    </a>
                                                    <a href="<?=site_url('hesabim/adreslerim')?>" class="panel-link ">
                                                        <div class="Icon">
                                                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                            <p>Adreslerim</p>
                                                        </div>
                                                    </a>
                                                    <a href="<?=site_url('hesabim/garajim')?>" class="panel-link ">
                                                        <div class="Icon">
                                                            <i class="fa fa-car" aria-hidden="true"></i>
                                                            <p>Garajım</p>
                                                        </div>
                                                    </a>
                                                    <a href="<?=site_url('cikis-yap')?>" class="panel-link">
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
                                        <a href="<?=site_url('hesabim/bildirimler')?>" class="Item">
                                            <div class="Icon">
                                                <img src="<?=site_url('assets/Front/images/Icons/h-notif.webp')?>" alt="">
                                                
                                                <?php if ($userNotification > 0) { ?> 
                                                    <?php if ($userNotification>5) { ?>
                                                       <span class="dataNum" id="notificationSpan">5+</span>
                                                    <?php }else{ ?>
                                                        <span class="dataNum" id="notificationSpan"><?=$userNotification?></span>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>
                                            <span>Bildirim</span>
                                        </a>
                                    </li>
                                    <li class="Item Fav">
                                        <a href="<?=site_url('hesabim/favorilerim')?>" class="Item">
                                            <div class="Icon">
                                                <img src="<?=site_url('assets/Front/images/Icons/h-fav.webp')?>" alt="">
                                                <?php if ($favProduct > 0) { ?>
                                                    <?php if ($favProduct > 5) { ?>
                                                        <span style="right: 1px !important;" class="dataNum" id="favNum">0</span>
                                                    <?php }else{ ?>
                                                        <span style="right: 1px !important;" class="dataNum" id="favNum"><?=$favProduct?></span>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>
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
                                        <a href="<?=site_url('sepet')?>" class="Item">
                                            <div class="Icon">
                                                <img src="<?=site_url('assets/Front/images/Icons/h-cart.webp')?>" alt="">
                                                <span class="dataNum" id="cartNum">0</span>
                                            </div>
                                            <span>Sepet</span>
                                        </a>
                                        <div class="Dropdown CartDropdown">
                                            <!--Sepet Ayrıntıları -->
                                            <div class="DropdownContent CartPreview SepetDolu">
                                                <ul class="List ChartProducts">
                                                </ul>
                                                <div class="DropdownFooter">
                                                    <div class="Left">
                                                        <div class="TotalPrice">
                                                            <div class="Text">Toplam (KDV Dahil)</div>
                                                            <div class="Total TotalPriceCur"></div>
                                                        </div>
                                                    </div>
                                                    <div class="Right">
                                                        <a href="<?=site_url('sepet')?>" class="Btn Green-d">
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
                            <form action="<?=site_url('arama-sonucu')?>" method="get">
                                <div class="SearchBox">
                                    <div class="topTelephone">
                                        Tüm yedek parçalar bir yerde - 500.000 adet parça arasından aradığınızı bulun.
                                    </div>
                                    <input type="search" class="searchInput" placeholder="Parça No, Parça İsmi veya Marka Adı Giriniz.." name="s" autocomplete="off">
                                    <button class="searchBtn"><img src="<?=site_url('assets/Front/images/Icons/search-icon.webp')?>"></button>
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
                <a href="<?=site_url('yorumlar')?>" class="AppLink"><i class="fa fa-comments" aria-hidden="true"></i> Yorumlar</a>
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
                <a href="<?=site_url('giris-yap?redirect='.current_url())?>" class="Link">Giriş Yap</a> <span class="Or">veya</span> <a href="<?=site_url('kayit-ol')?>" class="Link">Kayıt Ol</a>
            </div>
            <?}else{?>
            <!-- Giriş Yaptıysa -->
            <div class="T">Merhaba, <?$writeName=explode(" ", $userInfo->name);echo $writeName[0];?></div>
            <div class="Control">
                <a href="<?=site_url('hesabim')?>" class="Link">Hesabım</a><br>
                <a href="<?=site_url('hesabim/siparislerim')?>" class="Link">Siparişlerim</a><br>
                <a href="<?=site_url('cikis-yap')?>" class="Link">Çıkış</a>
            </div>
            <?}?>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <ul class="menu">
                        <li id="menufirstlink"><a href="<?=site_url('yedek-parcalar')?>" onclick="loader()"><i class="fa fa-bars" aria-hidden="true"></i>YEDEK PARÇALAR</a></li>
                        <?php foreach ($menus as $key => $val) { ?>
                        <li class="altlinks">
                            <h3><a href="<?=site_url(isset($val->detail)?'yedek-parcalar/'.$val->detail->slug:'#')?>"> <?=($val->GRUP_ISIM)?> <i class="fa fa-chevron-right" aria-hidden="true"></i></a></h3>
                            <div class="nav-dropdown" >
                                <?php foreach ($val->sub as $key2 => $val2) { ?>
                                <div class="item">
                                    <div class="T">
                                        <p class="t-item"><?=($val2->GRUP_ISIM)?></p>
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
                                        <a onclick="loader()" href="<?=site_url((isset($val->detail)?'yedek-parcalar/'.$val->detail->slug:'#').'/'.(isset($val3->detail)?$val3->detail->slug:'#'))?>" class="Link"><?=($val3->GRUP_ISIM)?></a>
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
                            <a href="<?=site_url('bakim-robotu')?>">
                                <img src="<?=site_url('assets/Front/images/Icons/1.webp')?>">
                                Bakım Robotu
                            </a>
                        </li>
                        <li class="Menu4">
                            <a href="<?=site_url('oto-bakim-ve-yaglar')?>">
                                <img src="<?=site_url('assets/Front/images/Icons/2.webp')?>">
                                Oto Bakım & Yağlar
                            </a>
                        </li>
                        <!--
                        <li class="Menu4">
                            <a href="<?=site_url('Listing')?>">
                                <img src="<?=site_url('assets/Front/images/Icons/ampul.webp')?>">
                                Ampuller
                            </a>
                        </li>
                        -->
                        <li class="Menu5" style="display: none;">
                            <a href="<?=site_url('Listing_accessory')?>">
                                <img src="<?=site_url('assets/Front/images/Icons/3.webp')?>">
                                Aksesuarlar
                            </a>
                        </li>
                        <li class="Menu6">
                            <a href="<?=site_url('yedek-parcalar/kaporta-ve-trim/silecek-supurgesi')?>">
                                <img src="<?=site_url('assets/Front/images/Icons/4.webp')?>">
                                Silecekler
                            </a>
                        </li>
                        <li class="Menu7">
                            <a href="<?=site_url('hesabim/garajim?redirect='.current_url())?>">
                                <img src="<?=site_url('assets/Front/images/Icons/5.webp')?>">
                                Garajım
                            </a>
                        </li>
                        <li class="MenuK">
                            <a href="<?=site_url('toplu-parca-teklifi')?>" style="font-size:13px;">
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