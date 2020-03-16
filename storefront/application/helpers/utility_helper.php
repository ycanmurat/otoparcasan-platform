<?defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('admin_url'))
{
	function admin_url($val = "") {
		return site_url('Admin/'.$val);
	}
}

if (!function_exists('pre'))
{
	function pre($val) {
		echo "<pre>";
		print_r($val);
		echo "</pre>";
	}
}

if (!function_exists('prex'))
{
	function prex($val) {
		echo "<pre>";
		print_r($val);
		echo "</pre>";
		exit;
	}
}

if (!function_exists('dump'))
{
	function dump($val) {
		echo "<pre>";
		var_dump($val);
		echo "</pre>";
	}
}

if (!function_exists('dumpx'))
{
	function dumpx($val) {
		echo "<pre>";
		var_dump($val);
		echo "</pre>";
		exit;
	}
}

if (!function_exists('create_random_key'))
{
	function create_random_key($length) 
	{
    	$characters = 'ibrahimugureyupserdarmuhammetotoparcasanotosesliemreseyfettin260220191139';
    	$charactersLength = strlen($characters);
    	$randomString = '';
    	for ($i = 0; $i < $length; $i++) 
    	{
        	$randomString .= $characters[rand(0, $charactersLength - 1)];
    	}
    	return $randomString;
	}
}

if (!function_exists('clearfilepath'))
{
	function clearfilepath($val) {
		if ($val == "") {
			return "";
		}
		//prex($val);
		$exp = explode('ploads/', $val);
		//prex($exp);
		return $exp[1];
	}
}

if (!function_exists('reverseArray'))
{
	function reverseArray($Array)
	{
		foreach ($Array as $key => $val) {
			if (is_array($val)) {
				$ary[$key] = $val;
			}
		}

		foreach ($ary as $key => $val) {
			foreach ($val as $key2 => $val2) {
				$langdata[$key2][$key] = $val2;
			}
		}
		
		return $langdata;
	}
}

if (!function_exists('dateparse'))
{
	function dateparse($date)
	{
		return date("d.m.Y H:i", strtotime($date));
	}
}

if (!function_exists('getdmy'))
{
	function getdmy($date)
	{
		return date("d.m.Y", strtotime($date));
	}
}

if (!function_exists('get_url'))
{
	function get_url($value)
	{
		$value = site_url($value)."?";
		if (count($_GET) > 1) {
			foreach ($_GET as $key => $val) {
				if ($key != 's') {
					$value .= $key."=".$val."&";
				}
			}
		}
		return $value;
	}
}

if (!function_exists('get_firstname'))
{
	function get_firstname($value)
	{
		$value = explode(' ', $value);
		$value = $value[0];
		return $value;
	}
}


if (!function_exists('url_seo'))
{
	function url_seo($str, $options = array()){
	 
	    $str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
	 
	 
	    $defaults = array(
	        'delimiter' => '-',
	        'limit' => null,
	        'lowercase' => true,
	        'transliterate' => true,
	    );
	 
	    $options = array_merge($defaults, $options);
	    $dmr = $defaults["delimiter"];
	    $char_map = array(
	        // Latin
	        'À' => 'A', 'Á' => 'A', ' ' => $dmr, 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C', 
	        'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 
	        'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O', 
	        'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH', 
	        'ß' => 'ss', 
	        'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c', 
	        'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 
	        'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o', 
	        'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th', 
	        'ÿ' => 'y',
	 
	        // Latin symbols
	        '©' => '(c)',
	 
	        // Greek
	        'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
	        'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
	        'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
	        'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
	        'Ϋ' => 'Y',
	        'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
	        'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
	        'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
	        'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
	        'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',
	 
	        // Turkish
	        'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
	        'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g', 
	 
	        // Russian
	        'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
	        'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
	        'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
	        'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
	        'Я' => 'Ya',
	        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
	        'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
	        'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
	        'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
	        'я' => 'ya',
	 
	        // Ukrainian
	        'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
	        'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',
	 
	        // Czech
	        'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U', 
	        'Ž' => 'Z', 
	        'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
	        'ž' => 'z', 
	 
	        // Polish
	        'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z', 
	        'Ż' => 'Z', 
	        'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
	        'ż' => 'z',
	 
	        // Latvian
	        'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N', 
	        'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
	        'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
	        'š' => 's', 'ū' => 'u', 'ž' => 'z'
	    );
	 
	 
	    if ($options['transliterate']) {
	        $str = str_replace(array_keys($char_map), $char_map, $str);
	    }
	    $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
	    $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
	    $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
	    $str = trim($str, $options['delimiter']);
	    return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
	}
}

if (!function_exists('TimbThumb'))
{
	function TimbThumb($url, $size)
	{
		//return $url;
		return site_url("thumb.php?src=").$url.'&size='.$size.'&zoom=0&crop=0&trim=0';
	}
}


if (!function_exists('CookieIsset'))
{
	function CookieIsset($name)
	{
		if (isset($_COOKIE[$name])) {
			return true;
		}else{
			return false;
		}
	}
}

if (!function_exists('Get_Cookie'))
{
	function Get_Cookie($name)
	{
		if ($name == 'currency') {
			if(!isset($_COOKIE[$name])) {
				return 0;
			}
		}
		return $_COOKIE[$name];
	}
}

if (!function_exists('generate_combinations'))
{
	function generate_combinations(array $data, array &$all = array(), array $group = array(), $value = null, $i = 0)
	{
	    $keys = array_keys($data);
	    if (isset($value) === true) {
	        array_push($group, $value);
	    }

	    if ($i >= count($data)) {
	        array_push($all, $group);
	    } else {
	        $currentKey     = $keys[$i];
	        $currentElement = $data[$currentKey];
	        foreach ($currentElement as $val) {
	            generate_combinations($data, $all, $group, $val, $i + 1);
	        }
	    }

	    return $all;
	}
}

if (!function_exists('keytoid'))
{
	function keytoid(array $data)
	{
		$newarr = array();
	    foreach ($data as $key => $value) {
	    	$newarr[$value['id']] = $value['name'];
	    }

	    return $newarr;
	}
}

if (!function_exists('isJSON'))
{
	function isJSON($string){
	   return is_string($string) && is_array(json_decode($string, true)) ? true : false;
	}
}

//
if (!function_exists('getFunctionTime'))
{
	function getFunctionTime($postTime,$day) {
		$resetTime = strtotime($postTime); 
		$threeDay = (60*60*24)*$day;
		$nowDate = strtotime(date('d.m.Y H:i:s'));
		$totalTime = $resetTime + $threeDay;
		$endTime = $threeDay + $nowDate;
		$total = $endTime - $totalTime;
		if ($total < $threeDay) {
			return true;
		} else {
			return false;
		}
	}
}

if (!function_exists('replaceStringProblemsReverse')) {
	function replaceStringProblemsReverse($string)
	{
		return str_replace(
			['Ý', 'Þ', 'Ð', 'ð', 'ý','þ'], 
			['İ', 'Ş', 'Ğ', 'ğ', 'ı','ş'], 
			$string
		); 
	}
}

if (!function_exists('time_ago')) {
	function time_ago ( $zaman )
	{
		$zaman =  strtotime($zaman);
		$zaman_farki = time() - $zaman;
		$saniye = $zaman_farki;
		$dakika = round($zaman_farki/60);
		$saat = round($zaman_farki/3600);
		$gun = round($zaman_farki/86400);
		$hafta = round($zaman_farki/604800);
		$ay = round($zaman_farki/2419200);
		$yil = round($zaman_farki/29030400);
		if( $saniye < 60 ){
			if ($saniye == 0 || $saniye < 0){
				return "Kısa Bir Zaman Önce";
			} else {
				return $saniye .' Saniye Önce';
			}
		} else if ( $dakika < 60 ){
			return $dakika .' Dakika Önce';
		} else if ( $saat < 24 ){
			return $saat.' Saat Önce';
		} else if ( $gun < 7 ){
			return $gun .' Gün Önce';
		} else if ( $hafta < 4 ){
			return $hafta.' Hafta Önce';
		} else if ( $ay < 12 ){
			return $ay .' Ay Önce';
		} else {
			return $yil.' Yıl Önce';
		}
	}
}

if (!function_exists('clear_empty')) {
	function clear_empty ( $string )
	{
		$string = str_replace("/s+/","",$string);
		$string = str_replace(" ","",$string);
		$string = str_replace(" ","",$string);
		$string = str_replace(" ","",$string);
		$string = str_replace("/s/g","",$string);
		$string = str_replace("/s+/g","",$string);		
		$string = trim($string);
		return $string; 
	}
}

if (!function_exists('device_info')) {
	function device_info ($device)
	{
		switch ($device) {
		    case "1":
		        return "Masaüstü veya Dizüstü";
		        break;
		    case "2":
		        return "Tablet veya Netbook";
		        break;
		    case "3":
		        return "Mobil Telefon";
		        break;
		    default:
		        return "Herhangi Bir Seçenek Yok, Problem !";
		}
	}
}

if (!function_exists('experience_info')) {
	function experience_info ($experience)
	{
		switch ($experience) {
		    case "1":
		        return "Çok Kötü";
		        break;
		    case "2":
		        return "Kötü";
		        break;
		    case "3":
		        return "Fena Değil";
		        break;
		    case "4":
		        return "İyi";
		        break;
		    case "5":
		        return "Çok iyi";
		        break;
		    default:
		        return "Herhangi Bir Seçenek Yok, Problem !";
		}
	}
}

if (!function_exists('button_info')) {
	function button_info ($seen)
	{
		$return = new stdClass();
		switch ($seen) {
		    case "0":
		        	$return->style = 'background-color:#f4516c !important;border-color:#f53454 !important;';
		        	$return->info = 'Görülmedi';
		        return $return;
		        break;
		    case "1":
		    		$return->style = 'background-color:#FFCE54 !important;border-color:#FCBB42 !important;';
		        	$return->info = 'Görüldü';
		        return $return;
		        break;
		    case "2":
		        	$return->style = 'background-color:#A0D468 !important;border-color:#8CC152 !important;';
		        	$return->info = 'Cevaplandı';
		        return $return;
		        break;
		    case "3":
		        	$return->style = 'background-color:#5867dd !important;border-color:#5867dd !important;';
		        	$return->info = 'Yanıt Bekleniyor';
		        return $return;
		        break;
		    case "4":
		        	$return->style = 'background-color:#000000 !important;border-color:#010313 !important;';
		        	$return->info = 'Sonlandırıldı';
		        return $return;
		        break;
		    default:
		        return "Herhangi Bir Seçenek Yok, Problem !";
		}
	}
}

if (!function_exists('explodeDatTime')) {
	function explodeDatTime($time)
	{
		$data = explode('T', $time);
		return $data[0];
	}
}

if (!function_exists('getConsTime')) {
	function getConsTime($number)
	{
		$year 		= (int)((($number-10)/120)+1970);
		$mounth 	= str_pad(((int)((($number-10)/10)%12))+1, 2, '0', STR_PAD_LEFT);

		/*


		if ($mounth == 1) {
			$mounth = ' Ocak ';
		}elseif ($mounth == 2) {
			$mounth = ' Şubat ';
		}elseif ($mounth == 3) {
			$mounth = ' Mart ';
		}elseif ($mounth == 4) {
			$mounth = ' Nisan ';
		}elseif ($mounth == 5) {
			$mounth = ' Mayıs ';
		}elseif ($mounth == 6) {
			$mounth = ' Haziran ';
		}elseif ($mounth == 7) {
			$mounth = ' Temmuz ';
		}elseif ($mounth == 8) {
			$mounth = ' Ağustos ';
		}elseif ($mounth == 9) {
			$mounth = ' Eylül ';
		}elseif ($mounth == 10) {
			$mounth = ' Ekim ';
		}elseif ($mounth == 11) {
			$mounth = ' Kasım ';
		}elseif ($mounth == 12) {
			$mounth = ' Aralık ';
		}

		*/

		$lastCar = substr($number, -1);
		if ($lastCar == 0) {
			$day = '01';
		}elseif ($lastCar == 1) {
			$day = '04';
		}elseif ($lastCar == 2) {
			$day = '07';
		}elseif ($lastCar == 3) {
			$day = '10';
		}elseif ($lastCar == 4) {
			$day = '13';
		}elseif ($lastCar == 5) {
			$day = '16';
		}elseif ($lastCar == 6) {
			$day = '19';
		}elseif ($lastCar == 7) {
			$day = '22';
		}elseif ($lastCar == 8) {
			$day = '25';
		}elseif ($lastCar == 9) {
			$day = '28';
		}

		$date = $day.'.'.$mounth.'.'.$year;

		return $date;
	}
}


if (!function_exists('arrayExplode')) {
	function arrayExplode($data,$firstKey,$lastKey)
	{
		$ary = array();
		foreach ($data as $key => $val) {
			if ($key >= $firstKey AND $key <= $lastKey) {
				$ary[] = $val;
			}
		}
		return $ary;
	}
}