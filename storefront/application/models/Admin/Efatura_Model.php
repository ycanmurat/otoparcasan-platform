<?php 
/**
* MUHAMMET ATEŞ
*/
class Efatura_Model extends Core_Model
{

	function __construct()
	{
		parent::__construct();
	}

	public function Connect()
	{
		ini_set("soap.wsdl_cache_enabled", "0");

		$live = true; // false ise testte çalışır, true ise canlıda çalışır(gerçek fatura keser)
		if ($live == false) {
			$wsdl = "http://efinttestws.turkkep.com.tr/EfaturaEntegrasyon2.asmx?WSDL";
			$username = getenv('TURKKEP_TEST_USER');
			$password = getenv('TURKKEP_TEST_PASS');
		} else {
			$wsdl = "https://efintws.turkkep.com.tr/EfaturaEntegrasyon2.asmx?WSDL";
			$username = getenv('TURKKEP_USER');
			$password = getenv('TURKKEP_PASS');
		}

		$ns = "http://tempuri.org/XMLGateResponse";

		$client = new SoapClient($wsdl, array(
		"trace" => 1,
		"exceptions" => 0
		));

		$headerBody = array(
			'kullaniciAdi' => $username,
			'kullaniciSifresi' => $password
		);
		$header = new SoapHeader($ns, 'Ebask', $headerBody,false);

		$client->__setSoapHeaders($header);
		return array($client, $headerBody);
	}

	public function Session($client, $headerBody)
	{
		$res = $client->OturumAc($headerBody);
		return $res->OturumAcResult;
	}

	public function SendInvoice($orderid = 0)
	{
		if ($orderid == 0) {
			return false;
		}
		$orderinfo = $this->OrderInfo($orderid);
		if ($orderinfo == false) {
			return false;
		}
		$order = $orderinfo->order;
		$adres = $orderinfo->adres;

		$name = explode(" ", $adres->name);
		if (count($name)>1) {
			$last_name = $name[count($name)-1];
			array_pop($name);
			$name = implode(' ', $name);
		}else{
			$last_name = $name[0];
			$name = $name[0];
		}

		$connectArr = $this->Connect();
		$token = $this->Session($connectArr[0], $connectArr[1]);
		$client = $connectArr[0];
		$party = array();
		$party['BuildingName'] = "";
		$party['RoomNo'] = "";
		$party['BuildingNo'] = "";
		$party['PartyType'] = "Ozel";
		$party['Zipcode'] = $adres->post_code;
		$party['PersonName'] = $name;
		$party['PersonSurname'] = $last_name;
		$party['Street'] = $adres->content;
		$party['Email'] = "info@ebask.com";
		$party['PhoneNumber'] = $adres->gsm;

		// EARŞİV EFATURA Kontrolü
		$xslt_name = "generalearsiv.xslt";
		$delivery_type = "A";
		$profile = "EARSIVFATURA";
		// EARŞİV EFATURA Kontrolü

		$thisuser = $this->UserInfo($order->user_id);
		if ($thisuser != false) {
			$party['Email'] = $thisuser->email;
		}

		if ($adres->country == 212) {
			$party['City'] = $adres->CityName;
			$party['Country'] = "Türkiye";
			$party['CitySubDivision'] = $adres->CountyName;
		} else {
			$ulke = $this->db->get_where('location_countries', array('CountryID' => $adres->country));
			$party['City'] = $adres->city;
			$party['Country'] = $ulke->CountryName;
			$party['CitySubDivision'] = $adres->town;
		}
		if ($adres->corporate == 1) {
			$party['IsPerson'] = false;
			$party['CompanyName'] = $adres->firm_name;
			if (count((string)$adres->tax_no) == 10 && (int)$adres->tax_no > 0) {
				$party['TaxOrIdNo'] = (string)$adres->tax_no;
			} else {
				$party['TaxOrIdNo'] = "1111111111";
			}
			$etiketgetirsonuc = $this->EtiketGetir($adres->tax_no);
			if ($etiketgetirsonuc == true) {
				$xslt_name = "general.xslt";
				$delivery_type = "F";
				$profile = "TEMELFATURA";
			}

		} else {
			$party['IsPerson'] = true;
			$party['CompanyName'] = "";
			if (count((string)$adres->identity_number) == 11 && (int)$adres->identity_number > 0) {
				$party['TaxOrIdNo'] = (string)$adres->identity_number;
			} else {
				$party['TaxOrIdNo'] = "11111111111";
			}
		}

		$getproducts = $this->getproducts($orderid);
		$urunler = array();
		$hizmetSayi = 0;
		$kdvli_toplam = 0;
		$kdvsiz_toplam = 0;
		$kdvtutar_toplam = 0;
		$urunsirano = 0;
		$gift_type = "";
		$gift_reason = "";
		$gift_rate = 0;
		$gift_amount = 0;
		$gift_discount = 0;
		if ($order->check_id != 0) {
			$promosyon = $this->GetPromosyon($order->check_id);

			$gift_type = "N"; // indirim N - artırım Y
			$gift_reason = "Promosyon";
			if ($promosyon->discount == 1) {
				$gift_rate = 0;
				$gift_amount = $promosyon->discount;
			} else {
				$gift_amount = 0;
				$gift_rate = $promosyon->discount;
			}
			$gift_discount = 0;
		}
		$urunlertoplami = 0;
		if ($getproducts != false) {
			foreach ($getproducts as $key => $fiyat) {
				$urunlertoplami += $fiyat->price;
			}
			foreach ($getproducts as $key => $val) {
				$urunsirano++;
				$urunnot = "";
				if ($val->design == 0) {
					$hizmetSayi++;
					$urunnot .= "Tasarım hizmeti var.";
				}
				$variants = json_decode($val->selected_variants);
				if ($val->product_id == 151) {
					//pre($val);
					$packageid = $variants[0];
					$packagesize = $variants[1];
					$packageprice = $variants[1]."_price";
					if ($packagesize == "dev") {
						$packagenameek = " - Dev Boy";
						$packagenumber = 2;
					} elseif ($packagesize == "super") {
						$packagenameek = " - Süper Boy";
						$packagenumber = 1;
					} else {
						$packagenameek = " - Mini Boy";
						$packagenumber = 0;
					}
					$this->db->select("*");
					$this->db->from("package_lang pl");
					$this->db->where(array('id' => $packageid, 'lang_id' => 1));
					$getpackage = $this->db->get();
					$packageresult = $getpackage->row();
					$val->product_name = $packageresult->name.$packagenameek;
					$this->db->select("pl.product_name");
					$this->db->from("package_product pp");
					$this->db->join("product_lang pl", "pl.product_id = pp.product_id AND pl.lang_id = 1");
					$this->db->where(array("pp.package_id" => $packageid, "pp.size" => $packagenumber, "pp.status" => 1));
					$getpackageproduct = $this->db->get();
					$get_variants = $getpackageproduct->result();
					$urunnot .= "Paketteki ürünler: ";
					$vqcount = $getpackageproduct->num_rows();
					if ($vqcount > 0) {
						foreach ($get_variants as $keyx => $valx) {
							$urunnot .= $valx->product_name;
							if ($vqcount != $keyx+1) {
								$urunnot .= ", ";
							}
						}
						$urunnot .= ".";
					}
				} else {
					if (count($variants) > 0) {
						$this->db->select("vcl.name child_name, vl.name variant_name");
						$this->db->from("variant_childs vc");
						$this->db->join("variant_lang vcl", "vcl.variant_child_id = vc.id AND vcl.lang_id = 1");
						$this->db->join("variant_lang vl", "vl.variant_id = vc.variant_id AND vl.lang_id = 1");
						$this->db->where_in("vc.id", $variants);
						$vq = $this->db->get();
						$vqcount = $vq->num_rows();
						if ($vqcount > 0) {
							$get_variants = $vq->result();
							$urunnot .= "Seçili varyantlar: ";
							foreach ($get_variants as $keyx => $valx) {
								$urunnot .= $valx->variant_name."(".$valx->child_name.")";
								if ($vqcount != $keyx+1) {
									$urunnot .= ", ";
								}
							}
							$urunnot .= ".";
						}
					}
				}

				if ($order->check_id != 0) {
					//prex($promosyon);
					//$yeniurunfiyati = "Urunfiyati-urunfiyati*100/(100*indirimfiyatı/toplamfiyat)";
					
					if ($promosyon->discount_type == 1) {
						if ($promosyon->discount >= $urunlertoplami) {
							$formul = 100;
						} else {
							$formul = 100*$promosyon->discount/$urunlertoplami;
						}
					} else {
						$formul = $promosyon->discount;
					}
					$gift_discount += $val->price/100*($formul);
					$yeniurunfiyati = $val->price-$gift_discount;
					$val->price = $yeniurunfiyati;
				}

				$kdvli = (float)$val->price;
				$kdvsiz = (float)$this->kdvsiz($val->price);
				$kdvtutar = (float)$this->kdvtutar($val->price);

				$kdvli_toplam += (float)$val->price;
				$kdvsiz_toplam += (float)$this->kdvsiz($val->price);
				$kdvtutar_toplam += (float)$this->kdvtutar($val->price);

				$gift_rate = (float)$gift_rate;
				$gift_amount = (float)$gift_amount;
				$gift_discount = (float)$gift_discount;

				/*
				prex(array(
					'kdvli' => $kdvli,
					'kdvsiz' => $kdvsiz,
					'kdvtutar' => $kdvtutar,
					'kdvli_toplam' => $kdvli_toplam,
					'kdvsiz_toplam' => $kdvsiz_toplam,
					'kdvtutar_toplam' => $kdvtutar_toplam
				));
				*/

				$urundetay = array(
						'LineOrderNo' => $urunsirano,
						'ItemName' => $val->product_name,
						'ItemPrice' => $kdvsiz,
						'Note' => $urunnot,
						'QuantityType' => "Adet",
						'InvoicedQuantity' => 1,
						'ItemCurrency' => "TurkishLira",
						'AllowanceChagreMultiplierFactor' => 0,
						'AllowanceChargeAmount' => 0,
						'TaxSubtotals' => array(
							'TaxSubtotal' => array(
								'TaxableAmount' => $kdvsiz,
								'TaxAmount' => $kdvtutar,
								'TaxPercent' => 18,
								'TaxType' => "KDVGercek",
								'CalculationSequenceNo' => 0
							)
						)
				);
				$urunler[] = $urundetay;
			}
		} else {
			return false;
		}
		$faturaArr = array(
			'InvoiceId' => $order->Id,
			'CustomerParty' => $party,
			'PenaltyAmount' => 0,
			'NoteList' => array(),
			'DocumentCurrency' => "TurkishLira",
			'InvoiceType' => "SATIS",
			'Profile' => $profile, // "TEMELFATURA" // EARSIVFATURA
			'IssueDate' => date('Y-m-d')."T".date("h:i:s"),
			'DeliveryType' => $delivery_type, // "A" // "F"
			'SendMethod' => "ELEKTRONIK",
			'Lines' => $urunler,
			'CopyIndicator' => true,
			'PeriodDuration' => "None",
			'AllowanceChargeIndicator' => $gift_type,
			'AllowanceChargeMultiplierFactor' => $gift_rate,
			'TotalAllowanceChargeAmount' => $gift_amount,
			'AllowanceChargeBaseAmount' => 0,
			'AllowanceChargeReason' => $gift_reason,
			'TotalLineExtensionAmount' => $kdvsiz_toplam,
			'TotalTaxAmount' => $kdvtutar_toplam,
			'TotalTaxExlusiveAmount' => $kdvsiz_toplam,
			'TotalTaxInclusiveAmount' => $kdvli_toplam,
			'AllowanceTotalAmount' => $gift_discount,
			'ChargeTotalAmount' => $kdvli_toplam,
			'TotalPayableRoundingAmount' => 0,
			'TotalPayableAmount' => $kdvli_toplam,
			'PostboxAlias' => "",
			'ERPInvoiceNo' => "",
			'Archived' => true,
			'Status' => 1,
			'EnvelopeDate' => date('Y-m-d')."T".date("h:i:s"),
			'InvoiceCount' => 1,
			'FreeExport' => false,
			'NotificationSend' => false,
			'XSLTName' => $xslt_name //"generalearsiv.xslt" // general.xslt
		);

		// $xslt_name = "generalearsiv.xslt";
		// $delivery_type = "A";
		// $profile = "EARSIVFATURA";

		//dumpx($faturaArr);
		//prex($faturaArr);
		$gonderArr = array('token' => $token, 'isDraft' => false, 'invoice' => $faturaArr);

		//prex($gonderArr);

		$invoiceResult = $client->FaturaGonder($gonderArr);

		//prex($invoiceResult);

		$sonucarr = array('faturaid' => "yok", 'faturahtml' => "yok");

		if (isset($invoiceResult->FaturaGonderResult)) {
			$sonucarr['faturaid'] = $invoiceResult->FaturaGonderResult;
		} else {
			return false;
		}

		$invoicehtml = $this->TakeHtml($sonucarr['faturaid']);
		$sonucarr['faturahtml'] = $invoicehtml['icerik'];

		$insertarr = array(
			'order_id' => $orderid,
			'invoice_id' => $sonucarr['faturaid'],
			'html' => $sonucarr['faturahtml']
		);

		/* KAPALI
		$this->db->insert('efatura', $insertarr);
		if ($this->db->affected_rows() > 0) {
			return $sonucarr['faturaid'];
		} else {
			return true;
		}
		KAPALI */

		$this->db->insert('efatura', $insertarr);
		return $sonucarr['faturaid'];


	}

	public function TakeHtml($invoiceid = "yok")
	{
		if ($invoiceid == false || $invoiceid == "yok") {
			return array('sonuc' => false, 'icerik' => $invoiceid);
		} else {
			$connectArr = $this->Connect();
			$token = $this->Session($connectArr[0], $connectArr[1]);
			$client = $connectArr[0];
			
			$par = array('token' => $token, 'faturaNo' => $invoiceid);
			
			$htmlresult = $client->GidenFaturaHtmlAl($par);
			if (isset($htmlresult->GidenFaturaHtmlAlResult)) {
				return array('sonuc' => true, 'icerik' => $htmlresult->GidenFaturaHtmlAlResult);
			} else {
				return array('sonuc' => false, 'icerik' => json_encode($htmlresult));
			}
		}
	}

	public function EtiketGetir($kimlik)
	{
		$connectArr = $this->Connect();
		$token = $this->Session($connectArr[0], $connectArr[1]);
		$client = $connectArr[0];
		
		$par = array('token' => $token, 'kimlikNo' => $kimlik);
		
		$htmlresult = $client->EtiketGetir($par);
		$sonuc = $htmlresult->EtiketGetirResult;
		$sonuc = count((array)$sonuc);
		if ($sonuc == 1) {
			return true;
		} else {
			return false;
		}
	}

	public function UserInfo($userid)
	{
		$this->db->where(array('id' => $userid));
		$this->db->select('*');
		$q = $this->db->get('users');
		if ($q->num_rows() > 0) {
			return $q->row();
		}
		else{
			return false;
		}
	}

	public function OrderInfo($orderid = 0)
	{
		$orderinfo = new stdClass();
		if ($orderid == 0) {
			return false;
		}
		$this->db->select("o.*");
		$this->db->from("orders o");
		$this->db->where(array("o.id" => $orderid));
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			$order = $q->row();
			$adres = $this->GetAddress($order->invoice_address_id);
		} else {
			return false;
		}
		$orderinfo->order = $order;
		$orderinfo->adres = $adres;
		return $orderinfo;
	}

	public function GetAddress($addressid = 0)
	{
		if ($addressid != 0) {
			$this->db->select("a.*, lco.CountryName");
			$this->db->from("order_addresses a");
			$this->db->join('location_countries lco', 'lco.CountryID = a.country');
			$this->db->where('id', $addressid);
			$q = $this->db->get();
			if ($q->num_rows() > 0) {
				$address = $q->row();
			} else {
				return false;
			}
			if ($address->country == 212) {
				$this->db->select('CityName');
				$this->db->where('CityID', $address->city);
				$cityq = $this->db->get("location_cities");
				$city = $cityq->row();
				$address->CityName = $city->CityName;
				$this->db->select('CountyName');
				$this->db->where('CountyID', $address->town);
				$countyq = $this->db->get("location_counties");
				$county = $countyq->row();
				$address->CountyName = $county->CountyName;
			}
			return $address;
		} else {
			return false;
		}
	}

	public function kdvsiz($value){
		return number_format(floatval($value)/1.18, 8, ".", "");
	}

	public function kdvtutar($value){
		return number_format(floatval($value)-floatval($value)/1.18, 2, ".", "");
	}

	public function getproducts($orderid)
	{
		$this->db->select("ol.*, pl.product_name");
		$this->db->from("order_line ol");
		$this->db->join("product_lang pl", "pl.product_id = ol.product_id AND pl.lang_id = 1");
		$this->db->where("ol.order_id", $orderid);
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			return $q->result();
		} else {
			return false;
		}
	}

	public function SiparisKontrol($siparisid)
	{
		//return true;
		$this->db->select("id");
		$this->db->from("orders");
		$this->db->where(array("id" => $siparisid));
		$this->db->where_in("order_status", array(5,6,7));
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			return false;
		} else {
			return true;
		}
	}

	public function GetPromosyon($cid)
	{
		$sonuc = $this->db->get_where('gift_check', array("id" => $cid));
		if ($sonuc->num_rows() > 0) {
			return $sonuc->row();
		} else {
			return false;
		}
	}

	public function EfaturaKontrol($siparisid)
	{
		//return true;
		$this->db->select("id");
		$this->db->from("efatura");
		$this->db->where(array("order_id" => $siparisid));
		$q = $this->db->get();
		if ($q->num_rows() > 0) {
			return false;
		} else {
			return true;
		}
	}

	public function GetEfaturaById($id)
	{
		$q = $this->db->get_where("efatura", array('invoice_id' => $id));
		if ($q->num_rows()) {
			return $q->row();
		} else {
			return false;
		}
	}

	public function getList($sayfa)
	{
		$data = new StdClass;

		$pageBy = 20;//sayfada satır sayısı
		$totalCount = $this->db->count_all_results('efatura');
		$pageCount = $totalCount/$pageBy;

		if ($sayfa == 0 || $sayfa == 1) {
			$this->db->limit($pageBy,0);
			//$this->db->limit(2,0); 2 adet 0 dan itibaren
		}else{
			$sayfa = $sayfa-1;
			$sayfa = $sayfa*$pageBy;
			$this->db->limit($pageBy,$sayfa);
		}

		$this->db->order_by("Id DESC");
		$q = $this->db->get("efatura");

		$data->list = $q->result();
		$data->pageCount 	= $pageCount;
		$data->totalCount 	= $totalCount;

		if ($q->num_rows()>0) {
			return $data;
		}
		else{
			return false;
		}
	}


}

?>