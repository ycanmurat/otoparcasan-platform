<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['default_controller'] = 'Home';
$route['translate_uri_dashes'] = FALSE;

$route['Help/(:any)']   = 'Help/detail/$1';

//Kategori
$route['yedek-parcalar']                = 'Category';
$route['yedek-parcalar/(:any)']         = 'Category/index/$1';
$route['yedek-parcalar/(:any)/(:any)']  = 'Category/index/$1/$2';
$route['oto-bakim-ve-yaglar']           = 'Otobakim';

//Hesabim
$route['hesabim']                   = 'Account';
$route['hesabim/sifre']             = 'Account/password';
$route['hesabim/siparislerim']      = 'Account/orders';
$route['hesabim/iadelerim']         = 'Account/returns';
$route['hesabim/iban-bilgilerim']   = 'Account/iban';
$route['hesabim/kuponlarim']        = 'Account/coupon';
$route['hesabim/havale-bildirimi']  = 'Account/transfer';
$route['hesabim/urun-sorularim']    = 'Account/questions';
$route['hesabim/adreslerim']        = 'Account/address';
$route['hesabim/favorilerim']       = 'Account/favorite';
$route['hesabim/garajim']           = 'Account/garage';
$route['hesabim/bildirimler']       = 'Account/notifications';
$route['hesabim/siparislerim/(:any)']       = 'Account/order_detail/$1';

//Corporate - Kurumsal
$route['hakkimizda']                = 'Corporate';
$route['toplu-parca-teklifi']       = 'Corporate/offerForm';
$route['insankaynaklari']           = 'Corporate/insankaynaklari';
$route['anlasmali-servisler']       = 'Corporate/contracted';
$route['banka-fatura-bilgileri']    = 'Corporate/bankdetail';
$route['iletisim']                  = 'Corporate/contact';
$route['sss']                       = 'Corporate/faq';
$route['kurumsal/destek-talebi']    = 'Corporate/support';
$route['kurumsal/yardim']           = 'Corporate/help';
$route['kurumsal/yardim/(:any)']    = 'Corporate/help/$1';

//User
$route['giris-yap']                 = 'User/index';
$route['kayit-ol']                  = 'User/register';
$route['sifremi-unuttum']           = 'User/forgot_password';
$route['sifre-yenileme/(:any)']       = 'User/password_refresh/$1';

//Statik Sayfalar
$route['kurumsal/(:any)']    = 'Statics/index/$1';

//Bakim Robotu
$route['bakim-robotu']      = 'Maintenance_robot';

//Yorum
$route['yorumlar']          = 'Reviews';

//Search
$route['arama-sonucu']      = 'search';

//Sepet
$route['sepet']             = 'Cart/index';
$route['sepet/adres']       = 'Cart/address';
$route['sepet/odeme']       = 'Cart/pay';
$route['sepet/basarili']    = 'Cart/success';
$route['sepet/basarisiz']   = 'Cart/error';
$route['Basket/paytr_98423']   = 'Cart/paytr_98423';

// genel
$route['cikis-yap'] = 'User/logout';
$route['Admin'] = 'Admin/Home';
$route['admin'] = 'Admin/Home';

//
$route['Sociallogin'] = 'Sociallogin';
$route['Sociallogin/callback'] = 'Sociallogin/callback';
$route['Sociallogin/(:any)'] = 'Sociallogin/index/$1';

//ürün
$route['(:any)']    = 'Product/details/$1';

$route['404_override'] = 'Home/my_404';