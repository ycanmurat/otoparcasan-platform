<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="tr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Otoparçasan</title></head>
    <body style="margin:0; padding:0; background-color: #f8f8f8; font-family: Verdana, Arial, sans-serif; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;">
        <div class="logo" style="width: 100%;text-align: center;padding: 30px 0px; background: #f8f8f8;">
            <a href="https://otoparcasan.com/" style="display: block; width: 250px;max-width: 250px;margin: 0 auto;">
                <img src='https://otoparcasan.com/assets/Front/images//mail/logo-mail.png' style="text-align: center;width: 250px;margin: 0 auto;max-width: 250px;"></img>
            </a>
        </div>
        <table width="100%" cellpadding="0" cellspacing="0" border="0" align="center" bgcolor="#f8f8f8">
            <tr>
                <td>
                    <table width="740" cellpadding="0" cellspacing="0" border="0" align="center" style="margin: 0 auto; padding: 0 20px">
                        <tr>
                            <td>
                                <table width="100%" cellpadding="0" cellspacing="0" border="0" align="center" style=" background-color: #fff; max-width: 700px;" bgcolor="#fff">
                                    <tr>
                                    </tr>
                                </table>
                                <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-top:1px solid #DE631F;border-right: 1px solid #DE631F; border-bottom: 1px solid #DE631F; border-radius: 12px;border-left: 1px solid #DE631F; background-color: #fff; max-width: 700px; font-family: Verdana, Arial, sans-serif; font-size: 14px;"align="center" bgcolor="#fff">
                                    <tr>
                                        <td style="padding: 30px 20px 30px">
                                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                <tbody><tr>
                                                    <td>
                                                        <p style="font-family: Verdana, Arial, sans-serif; font-weight:bold; font-size: 18px; color: #178ACC; margin-top:0; margin-bottom:30px">Siparişiniz alındı!</p>
                                                        <p style="font-family: Verdana, Arial, sans-serif; font-size: 14px; line-height: 140%; color: #333; margin-bottom:20px;">Merhaba <?=$name?>,</p>
                                                        <p style="font-family: Verdana, Arial, sans-serif; font-size: 14px; line-height: 140%; color: #333; margin-bottom:0;padding-bottom: 10px;">Sitemizden oluşturduğunuz sipariş talebiniz alındı! Sipariş etmiş olduğunuz ürünün özelliklerini ve süreci aşağıdaki verilerden takip edebilirsiniz.</p>
                                                        <div>
                                                            <img src="https://otoparcasan.com/assets/Front/images/mail/order-success.png" style="text-align:center;display:block; border:0;padding-bottom: 20px;margin: 0 auto;padding-top: 20px;"/>
                                                        </div>
                                                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                            <tbody>
                                                                <tr>
                                                                    <td bgcolor="#ffffff">
                                                                        <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%">
                                                                            <tbody><tr>
                                                                                <td style="font-weight:bold;color:#484848;font-family:Arial,Helvetica,sans-serif;border-bottom:1px solid #eeeeee;padding-bottom: 20px;">
                                                                                    Paketinizdeki Ürünler
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%">
                                                                                        <?php foreach ($products as $key => $product) { ?>
                                                                                        <tr>
                                                                                            <td valign="top">
                                                                                                <div style="width:64px;height:60px;margin:0;padding:0">
                                                                                                    <div style="max-height:0;max-width:0;overflow:visible">
                                                                                                        <div style="width:52px;height:52px;margin-left:12px;text-align:center;font-size:9px;padding-top:8px">
                                                                                                            <span style="display:inline-block;border:1px solid #f5f5f5;border-top-color:#ffffff;border-left-color:#f9f9f9;border-right-color:#f9f9f9;width:50px;height:50px;line-height:0;border-radius:2px">
                                                                                                                <img src="<?=site_url('assets/products/'.$product->kod3)?>.png" width="48" height="48" style="width:48px;height:48px;border:1px solid #e5e5e5;border-top-color:#f9f9f9;border-bottom-color:#dddddd;border-radius:2px" class="CToWUd">
                                                                                                            </span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td height="60" style="font-size:13px;font-family:Arial,Helvetica,sans-serif;color:#484848;padding-left:16px;padding-right:8px" valign="middle">
                                                                                                <span style="padding-top:8px;display:block">
                                                                                                    <?=$product->name?> &nbsp;
                                                                                                </span>
                                                                                            </td>
                                                                                            <td>
                                                                                                <a href="<?=$product->url?>"> Ürüne Git</a>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <?php } ?>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody></table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td bgcolor="#ffffff" style="font-family:Arial,Helvetica,sans-serif">
                                                                        <table border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%">
                                                                            <tbody><tr>
                                                                                <td style="font-weight:bold;color:#484848;font-family:Arial,Helvetica,sans-serif;border-bottom:1px solid #eeeeee;padding-top: 20px;padding-bottom: 20px;">
                                                                                    <b>Sipariş Özeti</b>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <table border="0" cellspacing="8" cellpadding="0">
                                                                                        <tbody><tr>
                                                                                            <td>
                                                                                                <table border="0" cellspacing="8" cellpadding="0">
                                                                                                    <tbody><tr>
                                                                                                        <td style="font-family:Arial,Helvetica,sans-serif;font-size:15px;font-family:Arial,Helvetica,sans-serif;font-weight:bold;color:#484848">
                                                                                                        Sipariş No</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td style="font-family:Arial,Helvetica,sans-serif;font-size:13px;color:#646464!important" class="m_8810422543868964000x-gmail-data-detectors"><?=$order_id?>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody></table>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td class="m_8810422543868964000specTable">
                                                                                                <table border="0" cellspacing="8" cellpadding="0">
                                                                                                    <tbody><tr>
                                                                                                        <td style="font-family:Arial,Helvetica,sans-serif;font-size:15px;font-weight:bold;color:#484848">
                                                                                                        Teslimat Adresi</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td style="font-family:Arial,Helvetica,sans-serif;font-size:13px;color:#646464!important" class="m_8810422543868964000x-gmail-data-detectors">
                                                                                                        <?=$address?></td>
                                                                                                    </tr>
                                                                                                </tbody></table>
                                                                                            </td>
                                                                                            <td class="m_8810422543868964000specTable">
                                                                                                <table border="0" cellspacing="8" cellpadding="0">
                                                                                                    <tbody><tr>
                                                                                                        <td style="font-family:Arial,Helvetica,sans-serif;font-size:15px;font-weight:bold;color:#484848">
                                                                                                        Fatura Adresi</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td style="font-family:Arial,Helvetica,sans-serif;font-size:13px;color:#646464!important" class="m_8810422543868964000x-gmail-data-detectors">
                                                                                                        <?=$billing_address?></td>
                                                                                                    </tr>
                                                                                                </tbody></table>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody></table>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody></table>
                                                                    </td>
                                                                </tr>
                                                            </tbody></table>
                                                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                <tbody><tr>
                                                                    <td colspan="2" style="font-size: 0; padding-top: 30px; border-top: 1px solid #e7e6e6">&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                    <td valign="top" width="30" style="padding-top: 3px">
                                                                        <img style="margin-top:-10px;margin-right:10px;" src="https://otoparcasan.com/assets/Front/images/mail/order-little.png">
                                                                    </td>
                                                                    <td valign="top">
                                                                        <p style="font-family: Verdana, Arial, sans-serif; font-size: 14px; line-height: 140%; color: #333; margin-top:0; margin-bottom:30px;"><strong>Şase numarası ile aracınızı bulun!</strong> Araç ruhsatında yazılan şase numarasını girerek karşınıza çıkan uyumlu araçlardan&nbsp;<a href="https://otoparcasan.com/" target="_blank" style="text-decoration:none; color: #003399;padding-left: 5px;">aracınızı hemen seçin.</a></p>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td valign="top" width="30" style="padding-top: 3px">
                                                                        <img style="margin-top:-10px;margin-right:10px;" src="https://otoparcasan.com/assets/Front/images/mail/order-little.png">
                                                                    </td>
                                                                    <td valign="top">
                                                                        <p style="font-family: Verdana, Arial, sans-serif; font-size: 14px; line-height: 140%; color: #333; margin-top:0; margin-bottom:30px;"><strong>Garajım özelliği</strong> ile hesabınıza kaydettiğiniz araç ve araçlara istediğiniz zaman ulaşın! </p>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td valign="top" width="30" style="padding-top: 3px">
                                                                        <img style="margin-top:-10px;margin-right:10px;" src="https://otoparcasan.com/assets/Front/images/mail/order-little.png">
                                                                    </td>
                                                                    <td valign="top">
                                                                        <p style="font-family: Verdana, Arial, sans-serif; font-size: 14px; line-height: 140%; color: #333; margin-top:0; margin-bottom:30px;"><strong>Birden çok markayı aynı anda görme imkanı!</strong> Aradığınız parçaya birebir uyumlu birden çok alternatif markayı görme seçeneğine sahip olun.</p>
                                                                    </tr>
                                                                    <tr>
                                                                        <td valign="top" width="30" style="padding-top: 3px">
                                                                            <img style="margin-top:-10px;margin-right:10px;" src="https://otoparcasan.com/assets/Front/images/mail/order-little.png">
                                                                        </td>
                                                                        <td valign="top">
                                                                            <p style="font-family: Verdana, Arial, sans-serif; font-size: 14px; line-height: 140%; color: #333; margin-top:0; margin-bottom:30px;"><strong style="padding-right: 5px;">Gelişmiş Filtreleme özelliği!</strong>En yakın tedarik süresi ve en hesaplı  yedek parça markalarını aynı ekranda listeleyin. </p>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td valign="top" width="30" style="padding-top: 3px">
                                                                            <img style="margin-top:-10px;margin-right:10px;" src="https://otoparcasan.com/assets/Front/images/mail/order-little.png">
                                                                        </td>
                                                                        <td valign="top">
                                                                            <p style="font-family: Verdana, Arial, sans-serif; font-size: 14px; line-height: 140%; color: #333; margin-top:0; margin-bottom:30px;"><strong>Favorilerime kaydedin!</strong> İlgilendiğiniz yedek parçayı favorilere kaydederek tekrar arama zahmetinden kurtulun.</p>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td valign="top" width="30" style="padding-top: 3px">
                                                                            <img style="margin-top:-10px;margin-right:10px;" src="https://otoparcasan.com/assets/Front/images/mail/order-little.png">
                                                                        </td>
                                                                        <td valign="top">
                                                                            <p style="font-family: Verdana, Arial, sans-serif; font-size: 14px; line-height: 140%; color: #333; margin-top:0; margin-bottom:30px;"><strong>Ürün gelince haber ver özelliği!</strong> Stoklarımızda olmayan ürün stoklara girdiğinde haberiniz olsun.</p>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="2" style="font-size: 0; padding-bottom: 30px; border-bottom: 1px solid #e7e6e6">&nbsp;</td>
                                                                    </tr>
                                                                </tbody></table>
                                                                <p style="font-family: Verdana, Arial, sans-serif; font-weight:bold; font-size: 14px; line-height: 140%; color: #333; margin-top:30px; margin-bottom:30px">Bir sorunla mı karşılaştınız? Her zaman yanınızdayız!</p>
                                                                <p style="font-family: Verdana, Arial, sans-serif; font-size: 14px; line-height: 140%; color: #333; margin-top:0; margin-bottom:10px;">Bir sorunla karşılaşırsanız,0 850 555 55 numaralı Müşteri Hizmetlerine ulaşabilir, bizimle iletişime geçebilirsiniz.</p>
                                                            </td>
                                                        </tr>
                                                    </tbody></table>
                                                </td>
                                            </tr>
                                        </table>
                                        
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0" align="center" style="max-width: 700px">
                                            <tr>
                                                <td>
                                                    <p style="font-family: Verdana, Arial, sans-serif; font-size: 9px; line-height: 140%; text-align: center; color: #666666; margin: 10px 0 10px; padding-top:20px;">
                                                        Daha az e-posta ister misiniz? <a href="https://otoparcasan.com/hesabim" style="text-decoration:none; color: #003399;">Bildirim Ayarları Sayfasına Git</a>
                                                    </p>
                                                    <p style="font-family: Verdana, Arial, sans-serif; font-size: 9px; line-height: 140%; text-align: center; color: #666666; margin: 10px 0 10px;">
                                                        Bilgilendirme e-postalarının “Gelen Kutusu”na düştüğünden emin olmak için <a href="mailto:info@otoparcasan.com" style="text-decoration:none; color: #003399;">info@otoparcasan.com</a> adresini “Adres Defteri”nize ekleyebilirsiniz.
                                                    </p>
                                                    <p style="font-family: Verdana, Arial, sans-serif; font-size: 9px; line-height: 140%; text-align: center; color: #666666; margin: 10px 0 10px;">
                                                        Lütfen bu emaile cevap vermeyiniz. Yardıma mı ihtiyacınız var ?<a href="https://otoparcasan.com/" style="text-decoration:none; color: #003399;padding-left: 5px;">Müşteri desteğini ziyaret edin</a>.
                                                    </p>
                                                    <p style="font-family: Verdana, Arial, sans-serif; font-size: 9px; line-height: 140%; text-align: center; color: #666666; margin: 10px 0 10px;">
                                                        bu e-posta <?=$user_email?> adresine gönderildi.<a href="https://otoparcasan.com/kurumsal/gizlilik-ve-cerez-politikasi" style="text-decoration:none; color: #003399;padding-left: 5px;">Gizlilik Politikası</a>
                                                    </p>
                                                    <p style="font-family: Verdana, Arial, sans-serif; font-size: 9px; line-height: 140%; text-align: center; color: #666666; margin: 10px 0 10px;padding-top: 30px;padding-bottom: 10px;">
                                                        Kirazlık Mahallesi Örnek Sanayi Sitesi, Sahil Cd. No:27/2, 55330 Tekkeköy/Samsun
                                                    </p>
                                                </td>
                                            </tr>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </body>
            </html>