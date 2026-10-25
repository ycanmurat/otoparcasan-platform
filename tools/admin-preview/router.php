<?php
// Admin preview: renders the real CodeIgniter admin views with fictional demo data — no database or ERP needed.
// Usage (from the repository root):
//   php -d short_open_tag=On -S localhost:8085 -t storefront tools/admin-preview/router.php
//   → http://localhost:8085/?v=home | order | order_supply_check | order_invoming_check | order_go_cargo | order_view | tedarikci_list
// Styling needs a licensed Metronic copy in storefront/assets/theme (see that folder's README).
error_reporting(E_ERROR | E_PARSE);
define('BASEPATH', __DIR__);
define('APP', dirname(__DIR__, 2) . '/storefront/application');

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if ($path !== '/' && is_file($_SERVER['DOCUMENT_ROOT'] . $path)) return false;

function base_url($p = '') { return '/' . ltrim($p, '/'); }
function site_url($p = '') { return '/' . ltrim($p, '/'); }
function admin_url($p = '') { return '/?v=' . urlencode(ltrim($p, '/')); }
function current_url() { return $_SERVER['REQUEST_URI']; }
function set_value($f, $d = '') { return $d; }
function get_url($v) { return site_url($v) . '?'; }
function _l($s) { return $s; }
// The project's own helpers (status labels/colors, date and string formatting).
require APP . '/helpers/utility_helper.php';
require APP . '/helpers/gift_helper.php';

class Stub { function __call($n, $a) { return null; } function __get($n) { return new Stub; } function __toString() { return ''; } }
class Session { function flashdata($k) { return null; } function userdata($k) { return ['name' => 'Demo', 'surname' => 'Admin', 'email' => 'demo@example.com', 'auth' => 1][$k] ?? 'Demo'; } }
class Agent { function referrer() { return '/'; } }
class Input { function get($k = null, $x = false) { return $_GET[$k] ?? null; } function post($k = null) { return null; } }

class Harness {
    public $session, $agent, $input, $db, $uri, $config;
    function __construct() { $this->session = new Session; $this->agent = new Agent; $this->input = new Input; $this->db = $this->uri = $this->config = new Stub; }
    function view($name, $data = []) { extract((array) $data); include APP . "/views/$name.php"; }
}

// ---------- demo data (fictional) ----------
$parts = [
    ['Fren Balatası Ön Takım', 'BRK-20431', 'TDR-014'], ['Yağ Filtresi', 'FLT-11872', 'TDR-003'],
    ['Hava Filtresi', 'FLT-22410', 'TDR-003'], ['Amortisör Ön Sağ', 'SUS-31877', 'TDR-021'],
    ['Debriyaj Seti', 'CLT-40912', 'TDR-008'], ['Triger Seti', 'TMG-55120', 'TDR-014'],
    ['Silecek Süpürgesi 600 mm', 'WPR-60031', 'TDR-005'], ['Buji (4\'lü Set)', 'IGN-71204', 'TDR-008'],
];
$names = [['Ahmet', 'Yılmaz'], ['Elif', 'Kaya'], ['Mehmet', 'Demir'], ['Zeynep', 'Çelik'], ['Can', 'Şahin'], ['Ayşe', 'Arslan'], ['Burak', 'Doğan']];
function line($p, $i) { return (object) ['name' => $p[0], 'stok_id' => $p[1], 'cari_id' => $p[2], 'url' => '#', 'count' => 1 + ($i * 3) % 7, 'price' => number_format(180 + $i * 137.5, 2, '.', ''), 'status_inside' => 2 + $i % 3]; }
function order($i, $st) { global $names; [$n, $s] = $names[$i % count($names)];
    return (object) ['id' => 10421 + $i, 'name' => $n, 'surname' => $s, 'added_time' => date('Y-m-d H:i:s', strtotime('2020-02-10 09:00') + $i * 7300),
        'count' => 1 + $i % 4, 'totalPrice' => 420 + $i * 315.75, 'order_status_inside' => $st, 'payment_status' => $st == 1 ? 1 : 2, 'payment_type' => 1 + $i % 2]; }

$v = preg_replace('/[^A-Za-z_\/]/', '', $_GET['v'] ?? 'home');
$v = strtolower(explode('/', $v)[0]) ?: 'home';
$h = new Harness;
$header = (object) ['mainMenu' => 'Order', 'subMenu' => 'OrderList', 'lowerMenu' => ''];
$data = new stdClass;

switch ($v) {
    case 'order_supply_check':
    case 'order_invoming_check':
    case 'order_outgoing_check':
        $header->subMenu = ['order_supply_check' => 'TedarikOnay', 'order_invoming_check' => 'GelenOnay', 'order_outgoing_check' => 'GidenOnay'][$v];
        $data->orderLines = array_map('line', $parts, array_keys($parts));
        break;
    case 'order_go_cargo':
        $header->subMenu = 'KargoOnay';
        $data->orders = array_map(fn($i) => order($i, 5), range(0, 5));
        break;
    case 'order_view':
        $o = order(3, 3);
        $o->lines = array_map('line', array_slice($parts, 0, 4), [0, 1, 2, 3]);
        $o->product_price = 1840.50; $o->shipping_price = 0; $o->order_status = 2;
        $o->user = (object) ['name' => 'Zeynep', 'surname' => 'Çelik', 'email' => 'demo@example.com', 'phone' => '0555 000 00 00'];
        $o->address = (object) ['corporate' => 0, 'name' => 'Zeynep Çelik', 'gsm' => '0555 000 00 00', 'identity_number' => '•••••••••••', 'city_name' => 'Samsun', 'town_name' => 'Atakum', 'post_code' => '55200', 'content' => 'Örnek Mah. Demo Sok. No:1'];
        $o->invoice_address = $o->address;
        $data->order = $o; $data->missingProduct = [];
        break;
    case 'tedarikci_list':
        $header->mainMenu = 'Product'; $header->subMenu = 'Tedarikci';
        $data->tedarikci = array_map(fn($i) => (object) ['CARI_KOD' => sprintf('TDR-%03d', [3, 5, 8, 14, 21, 27][$i]), 'CARI_ISIM' => ['Anadolu Oto Parça A.Ş.', 'Karadeniz Yedek Parça', 'Marmara Otomotiv Ltd.', 'Ege Filtre San.', 'Delta Süspansiyon', 'Kuzey Aksesuar'][$i], 'oran' => [18, 22, 15, 25, 20, 30][$i]], range(0, 5));
        break;
    case 'order':
        $data->orders = array_map(fn($i) => order($i, [1, 2, 3, 4, 5, 6, 2, 8][$i]), range(0, 7));
        $data->orderStatus = get_admin_order_status(); $data->paymentStatus = get_payment_status();
        $data->filter = (object) ['order_status' => '', 'key' => '', 'payment_status' => ''];
        $data->selectedPage = 1; $data->prevPage = 0; $data->nextPage = 2; $data->lastPage = 12;
        break;
    default:
        $v = 'home'; $header->mainMenu = 'Home'; $header->subMenu = '';
        $data->getAllPrice = (object) ['Allprice' => 1284530.75];
        $data->getStar = (object) ['star' => 4.6];
        $data->getCountReviews = 1287; $data->bulk_part_offer = 64; $data->product_questions = 212; $data->questions_comments = 538; $data->web_site_reviews = 319;
        $data->get_day_of_users = 37; $data->get_week_of_users = 241; $data->mount_of_users = 1032;
        foreach (['ease_of_use' => [88, 12], 'fast_shipping' => [91, 9], 'price_range' => [76, 24], 'product_packaging' => [93, 7], 'product_quality' => [89, 11]] as $k => [$l, $d]) { $data->{$k . '_like'} = $l; $data->{$k . '_dislike'} = $d; }
        $data->getLastOrders = array_map(fn($i) => (object) ['id' => 10431 + $i, 'name' => $names[$i][0], 'totapPrice' => 250 + $i * 410, 'added_time' => '2020-02-1' . $i . ' 1' . $i . ':20:00', 'CityName' => ['Samsun', 'İstanbul', 'Ankara', 'İzmir', 'Bursa'][$i], 'CountyName' => ['Atakum', 'Kadıköy', 'Çankaya', 'Bornova', 'Nilüfer'][$i]], range(0, 4));
        $data->get_last_users = array_map(fn($i) => (object) ['name' => $names[$i][0] . ' ' . $names[$i][1], 'email' => 'user' . $i . '@example.com', 'phone' => '0555 000 00 0' . $i, 'gender' => $i % 2, 'added_time' => '2020-02-12'], range(0, 4));
        $data->getCampaigns = [(object) ['id' => 1, 'campaign_title' => 'Fren Disk Aynalarında %20', 'campaign_info' => 'Açılışa özel indirim', 'campaign_picture' => '', 'campaign_start' => '2020-02-01', 'campaign_end' => '2020-02-29']];
        $data->getContactInfo = [(object) ['name_surname' => 'Demo Kullanıcı', 'email' => 'demo@example.com', 'phone' => '0555 000 00 00', 'message' => 'Toplu parça teklifi hakkında bilgi almak istiyorum.']];
        $data->getUserInfoPermission = 1;
}

$h->view('Admin/header', $header);
$h->view('Admin/' . $v, $data);
$h->view('Admin/footer', (object) ['price' => 0]);
