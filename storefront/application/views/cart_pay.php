    <div class="MembershipHeader">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="membership-logo" style="cursor:pointer;" onclick="window.location.href = '<?=site_url()?>'">
                        <picture>
                            <img src="<?=site_url('assets/Front/images/logofinali.png')?>" alt="logo">
                        </picture>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="membership-sec">
                        <div class="security_text">Güvenli Ödeme</div>
                    </div>      
                </div>
            </div>
        </div>
    </div>

    <!-- / cart_header -->

    <!-- pageContent -->
    <section class="pageContent Cart_Page">

       <div class="container">
          <div class="row">
            <div class="col-12">
                <div class="basket-bars-area">
                    <div class="basket-bars-box">
                        <div class="basket-bars-number">
                            <p>
                                1
                            </p>
                        </div>
                        <span>
                            Sipariş Sepet
                        </span>
                        <div class="basket-bars-decor">
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="basket-bars-box">
                        <div class="basket-bars-number">
                            <p>
                                2
                            </p>
                        </div>
                        <span>
                            Teslimat Bilgileri
                        </span>
                        <div class="basket-bars-decor basket-bars-mobile">
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="basket-bars-box">
                        <div class="basket-bars-number">
                          <p class="active">
                                3
                            </p>
                        </div>
                        <span>
                            Ödeme Bilgileri
                        </span>
                        <div class="basket-bars-decor basket-bars-mobile-last">
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="basket-bars-box">
                        <div class="basket-bars-number">
                            <p>
                                4
                            </p>
                        </div>
                        <span>
                            Sipariş Tamamlandı
                        </span>
                        <div class="basket-bars-decor-end">

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg">
               <div class="Cart_Content">
                    <div class="T T-edit"><span>Ödeme Bilgileri</span>
                    <div class="remove-area remove-area-edit">
                        <a href="<?=site_url('sepet')?>" class="all-remove-items"><i class="fa fa-undo" aria-hidden="true"></i> Sepete Dön</a></div>
                    </div>
                  <div class="row">
                     <div class="col-12">
                        <div style="width: 100%;margin: 0 auto;display: table;">
                            <script src="https://www.paytr.com/js/iframeResizer.min.js"></script>
                            <iframe src="https://www.paytr.com/odeme/guvenli/<?=$PayTRtoken;?>" id="paytriframe" frameborder="0" scrolling="no" style="width: 100%;"></iframe>
                            <script>iFrameResize({},'#paytriframe');</script>
                        </div>
                    </div>
                </div>
            </div>
            <div class="Cart_Content">
              <div class="T">Ödeme Bilgileri</div>
              <div class="row">
                 <div class="col-12">
                    <style>
                        #paytr_taksit_tablosu{clear: both;font-size: 12px;max-width: 1200px;text-align: center;font-family: Arial, sans-serif;}
                        #paytr_taksit_tablosu::before {display: table;content: " ";}
                        #paytr_taksit_tablosu::after {content: "";clear: both;display: table;}
                        .taksit-tablosu-wrapper{margin: 5px;width: 280px;padding: 12px;cursor: default;text-align: center;display: inline-block;border: 1px solid #e1e1e1;}
                        .taksit-logo img{max-height: 28px;padding-bottom: 10px;}
                        .taksit-tutari-text{float: left;width: 126px;color: #a2a2a2;margin-bottom: 5px;}
                        .taksit-tutar-wrapper{display: inline-block;background-color: #f7f7f7;}
                        .taksit-tutar-wrapper:hover{background-color: #e8e8e8;}
                        .taksit-tutari{float: left;width: 126px;padding: 6px 0;color: #474747;border: 2px solid #ffffff;}
                        .taksit-tutari-bold{font-weight: bold;}
                        @media all and (max-width: 600px) {.taksit-tablosu-wrapper {margin: 5px 0;}}
                    </style>
                    <div id="paytr_taksit_tablosu"></div>
                    <script src="https://www.paytr.com/odeme/taksit-tablosu/v2?token=<?=getenv('PAYTR_INSTALLMENT_TOKEN')?>&merchant_id=151345&amount=<?=$order->price?>&taksit=0&tumu=0"></script>
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
                <div class="item"><?=$orderTable->araToplam?> TL</div>
            </div>

            <div class="addition-item">
                <div class="item">KDV</div>
                <div class="item"><?=$orderTable->kdv?> TL</div>
            </div>

            <div class="addition-item">
                <div class="item">Kargo</div>
                <div class="item"><?=($orderTable->kargo == 0 ? 'Ücretsiz':$orderTable->kargo.' TL')?></div>
            </div>
                    <!--
                        <div class="addition-item">
                            <div class="item">Kampanya İndirimi</div>
                            <div class="item Colored">-1000 TL</div>
                        </div>
                    -->
                    <div class="addition-total addition-item">
                        <div class="item">toplam</div>
                        <div class="item totalPrice"><?=$orderTable->total?> TL</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- / pageContent -->
