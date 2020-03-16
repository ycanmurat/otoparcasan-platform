<?php
/**
* Author: Muhammet Ateş
*/
class Order_model extends Core_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function getList($sayfa)
	{
		$data 		= new StdClass;
		$pageBy 	= 10;//sayfada satır sayısı

		if ($sayfa == 0 || $sayfa == 1) 
		{
			$this->db->limit($pageBy,0);
			//$this->db->limit(2,0); 2 adet 0 dan itibaren
		}
		else
		{
			$sayfa 	= $sayfa-1;
			$sayfa 	= $sayfa*$pageBy;
			$this->db->limit($pageBy,$sayfa);
		}

		$this->db->select("o.*, ol.adet, ol.toplam, u.name username, cur.code moneycode, a.definition, a.name person_name, a.content, a.country, a.city, a.town, a.post_code, a.identity_number, a.corporate, a.firm_name, a.tax_no, a.tax_admin, a.gsm, ia.definition idefinition, ia.name iperson_name, ia.content icontent, ia.country icountry, ia.city icity, ia.town itown, ia.post_code ipost_code, ia.identity_number iidentity_number, ia.corporate icorporate, ia.firm_name ifirm_name, ia.tax_no itax_no, ia.tax_admin itax_admin, ia.gsm igsm");
		$this->db->from('orders o');
		$this->db->join('(SELECT order_id, COUNT(*) adet, SUM(price) toplam FROM order_line GROUP BY order_id) ol', 'ol.order_id = o.id', 'left');
		//$this->db->join('shipping_firm sf', 'sf.id = o.shipping_firm', 'left');
		$this->db->join('users u', 'u.id = o.user_id', 'left');
		$this->db->join('order_addresses a', 'a.id = o.address_id', 'left');
		$this->db->join('order_addresses ia', 'ia.id = o.invoice_address_id', 'left');
		$this->db->join('currency cur', 'cur.id = o.currency_id', 'left');
		if ((int)$this->input->get('siparisno') > 0) {
			$this->db->where('o.id', (int)$this->input->get('siparisno'));
		} elseif (count($this->input->get()) > 1) {
			if ($this->input->get('name', true) != "") 
			{
				$this->db->like('LOWER(u.name)', strtolower($this->input->get('name', true)), 'both');
			}
			if ($this->input->get('order_status', true)) 
			{
				$this->db->where('o.order_status', $this->input->get('order_status', true));
			}
			if ($this->input->get('payment_status', true)) 
			{
				$this->db->where('o.payment_status', $this->input->get('payment_status', true));
			}
			if ($this->input->get('delivery_status', true)) 
			{
				$this->db->where('o.delivery_status', $this->input->get('delivery_status', true));
			}
			if ($this->input->get('payment_type', true)) 
			{
				$this->db->where('o.payment_type', $this->input->get('payment_type', true));
			}
			if ($this->input->get('user_id', true)) 
			{
				$this->db->where('o.user_id', $this->input->get('user_id', true));
			}
		}
		
		$this->db->where('o.payment_type !=', 0);

		$this->db->order_by('o.id DESC');
		$q 			= $this->db->get();
		$data->list = $q->result();
		// A12U957 - Sorgu sonucunda dönen toplam satır sayısı (Limitin dahil olmadığı)
		$this->db->select("COUNT(o.id) c");
		$this->db->from('orders o');
		$this->db->join('(SELECT order_id, COUNT(*) adet, SUM(price) toplam FROM order_line GROUP BY order_id) ol', 'ol.order_id = o.id');
		//$this->db->join('shipping_firm sf', 'sf.id = o.shipping_firm');
		$this->db->join('users u', 'u.id = o.user_id', 'left');
		$this->db->join('currency cur', 'cur.id = o.currency_id', 'left');
		$this->db->where('o.payment_status !=', 0);
		if ((int)$this->input->get('siparisno') > 0) {
			$this->db->where('o.id', (int)$this->input->get('siparisno'));
		} elseif (count($this->input->get()) > 1) 
		{
			if ($this->input->get('name', true) != "") 
			{
				$this->db->like('LOWER(u.name)', strtolower($this->input->get('name', true)), 'both');
			}
			if ($this->input->get('order_status', true)) 
			{
				$this->db->where('o.order_status', $this->input->get('order_status', true));
			}
			if ($this->input->get('payment_status', true)) 
			{
				$this->db->where('o.payment_status', $this->input->get('payment_status', true));
			}
			if ($this->input->get('delivery_status', true)) 
			{
				$this->db->where('o.delivery_status', $this->input->get('delivery_status', true));
			}
			if ($this->input->get('payment_type', true)) 
			{
				$this->db->where('o.payment_type', $this->input->get('payment_type', true));
			}
			if ($this->input->get('user_id', true)) 
			{
				$this->db->where('o.user_id', $this->input->get('user_id', true));
			}
		}
		$dbcount = $this->db->get()->row();
		// A12U957 - SON
		$data->pageCount 	= $dbcount->c/$pageBy;
		if ($q->num_rows() > 0)
		{
			return $data;
		}
		else 
		{
			return false;
		}
	}

	public function GetOrderById($id)
	{
		$this->db->select('o.*, u.name username, ol.toplam, ol.adet, a.definition, a.name address_person, a.content, a.country, a.city, a.town, a.post_code, a.identity_number, a.corporate, a.firm_name, a.tax_no, a.tax_admin, a.gsm, cur.code moneycode, ia.definition idefinition, ia.name iperson_name, ia.content icontent, ia.country icountry, ia.city icity, ia.town itown, ia.post_code ipost_code, ia.identity_number iidentity_number, ia.corporate icorporate, ia.firm_name ifirm_name, ia.tax_no itax_no, ia.tax_admin itax_admin, ia.gsm igsm');
		$this->db->from('orders o');
		$this->db->join('(SELECT order_id, COUNT(*) adet, SUM(price) toplam FROM order_line GROUP BY order_id) ol', 'ol.order_id = o.id', 'left');
		//$this->db->join('shipping_firm sf', 'sf.id = o.shipping_firm');
		$this->db->join('currency cur', 'cur.id = o.currency_id', 'left');
		$this->db->join('users u', 'u.id = o.user_id', 'left');
		$this->db->join('order_addresses a', 'a.id = o.address_id', 'left');
		$this->db->join('order_addresses ia', 'ia.id = o.invoice_address_id', 'left');
		$this->db->where('o.id', $id);
		$q = $this->db->get();
		$result = $q->row();
		return $result;
	}

	public function GetCityName($cityid)
	{
		$this->db->select("CityName");
		$q = $this->db->get_where("location_cities", array("CityID" => $cityid));
		if ($q->num_rows() > 0) {
			$q = $q->row();
			return $q->CityName;
		} else {
			return "";
		}
	}

	public function GetCountryName($countryid)
	{
		$this->db->select("CountryName");
		$q = $this->db->get_where("location_countries", array("CountryID" => $countryid));
		if ($q->num_rows() > 0) {
			$q = $q->row();
			return $q->CountryName;
		} else {
			return "";
		}
	}

	public function GetTownName($countyid)
	{
		$this->db->select("CountyName");
		$q = $this->db->get_where("location_counties", array("CountyID" => $countyid));
		if ($q->num_rows() > 0) {
			$q = $q->row();
			return $q->CountyName;
		} else {
			return "";
		}
	}

	public function GetOrderLineByOrderId($id)
	{
		$this->db->select('ol.*, p.product_name, cur.code moneycode');
		$this->db->from('order_line ol');
		$this->db->join('product_lang p', 'p.product_id = ol.product_id');
		$this->db->join('currency cur', 'cur.id = ol.currency_id');
		$this->db->where(array('ol.order_id' => $id, 'p.lang_id' => '1'));
		$q = $this->db->get();

		if ($q->num_rows()>0) {
			$q = $q->result();
			foreach ($q as $key => $val) {
				$variants = json_decode($val->selected_variants);
				if ($val->product_id != 151) {
					$this->db->select('v.id variant_id, vc.id variant_child_id, vl.name variant_child_name, vvl.name variant_name');
					$this->db->where('vl.lang_id',1);
					$this->db->where('vvl.lang_id',1);
					$this->db->where_in('vc.id',$variants);
					$this->db->from('variant_childs vc');
					$this->db->join('variant_lang vl','vl.variant_child_id = vc.id');
					$this->db->join('variants v','v.id = vc.variant_id');
					$this->db->join('variant_lang vvl','v.id = vvl.variant_id');
					$qq = $this->db->get();
					if ($qq->num_rows()>0) {
						$q[$key]->selected_variants = $qq->result();
					}
				}else{
					$this->db->select('name');
					$this->db->where(array('lang_id'=>1,'package_id'=> addslashes($variants[0]) ));
					$qq = $this->db->get('package_lang');

					if ($qq->num_rows()>0) {
						$q[$key]->product_name = $qq->row()->name.' - '.UcWords($variants[1]).' Boy';
					}else{
						$q[$key]->product_name = "";
					}

					$packagetype = $this->PackageSizeConverter($variants[1]);


					$this->db->select('pl.product_name');
					$this->db->from('package_product pp');
					$this->db->join('product_lang pl','pl.product_id = pp.product_id');
					$this->db->where(array('pl.Lang_id'		=> Lang_id,
										   'pp.size' 		=> $packagetype,
										   'pp.package_id' 	=> addslashes($variants[0])
											));
					$qq = $this->db->get();
					if ($qq->num_rows()>0) {
						$a = array();
						foreach ($qq->result() as $key2 => $val2) {
							$a[] = (object)array('variant_id' => 0,
										 'variant_child_id' => 0,
										 'variant_child_name' => $val2->product_name,
										 'variant_name' => 'Ürün'
										 );
						}
						$q[$key]->selected_variants = $a;
					}else{
						$q[$key]->selected_variants = array();
					}
				}

			}
		}

		return $q;
	}

	public function SetOrderStatus($id, $new)
	{
		return $this->db->where('id', $id)->set('order_status', $new)->update('orders');
	}

	public function SetPaymentStatus($id, $new)
	{
		return $this->db->where('id', $id)->set('payment_status', $new)->update('orders');
	}

	public $orderStatusArr = array(
		0 => array('text' => 'Ödeme Aşamasında', 'color' => ',info'),
		1 => array('text' => 'Kargo fiyatı bekliyor', 'color' => 'metal'),
		2 => array('text' => 'Onay bekliyor', 'color' => 'warning'),
		3 => array('text' => 'İptal edildi', 'color' => 'danger'),
		4 => array('text' => 'Tasarım sürecinde', 'color' => 'brand'),
		5 => array('text' => 'Onaylandı', 'color' => 'success'),
		6 => array('text' => 'Kargoya teslim edildi', 'color' => 'success'),
		7 => array('text' => 'Teslim edildi', 'color' => 'Completed'),
		8 => array('text' => 'Üretimde', 'color' => 'Waiting')
	);

	public $paymentTypeArr = array(
		0 => 'Belirlenmedi',
		1 => 'Kredi kartı',
		2 => 'Havale / EFT',
		3 => 'Western Union'
	);

	public function paymentStatusText($pay,$order)
	{
		if ($pay == 0 && $order == 3) {
			return "Ödeme yapılmadı";
		}
		if ($pay == 0) {
			return "Ödeme yapılmadı";
		}
		return "Ödeme yapıldı";
	}

	public function ChangeStatus($id, $status, $new)
	{
		$this->db->set($status."_status", $new)->where('id', $id)->update('orders');
	}

	public function UpdateAddress($id, $newArr)
	{
		return $this->db->where('id', $id)->update('order_addresses', $newArr);
	}


	public function exportExcelData($records)
	{
		$heading = false;
		if (!empty($records))
			foreach ($records as $row) {
				if (!$heading) {
				// display field/column names as a first row
				echo implode("\t", array_keys($row)) . "\n";
				$heading = true;
			}
			echo implode("\t", ($row)) . "\n";
		}
	}

	public function fetchDataFromTable()
	{
		$query =$this->db->get('orders'); // fetch Data from table


		$this->db->select("o.*, ol.adet, ol.toplam, u.name username, cur.code moneycode, a.definition, a.name person_name, a.content, a.country, a.city, a.town, a.post_code, a.identity_number, a.gsm, ia.definition idefinition, ia.name iperson_name, ia.content icontent, ia.country icountry, ia.city icity, ia.town itown, ia.post_code ipost_code, ia.identity_number iidentity_number, ia.gsm igsm");
		$this->db->from('orders o');
		$this->db->join('(SELECT order_id, COUNT(*) adet, SUM(price) toplam FROM order_line GROUP BY order_id) ol', 'ol.order_id = o.id');
		//$this->db->join('shipping_firm sf', 'sf.id = o.shipping_firm');
		$this->db->join('users u', 'u.id = o.user_id');
		$this->db->join('order_addresses a', 'a.id = o.address_id');
		$this->db->join('order_addresses ia', 'ia.id = o.invoice_address_id');
		$this->db->join('currency cur', 'cur.id = o.currency_id');

		if (count($this->input->get()) > 1) {
			if ($this->input->get('name', true) != "") {
				$this->db->like('LOWER(u.name)', strtolower($this->input->get('name', true)), 'both');
			}
			if ($this->input->get('order_status', true)) {
				$this->db->where('o.order_status', $this->input->get('order_status', true));
			}
			if ($this->input->get('payment_status', true)) {
				$this->db->where('o.payment_status', $this->input->get('payment_status', true));
			}
			if ($this->input->get('delivery_status', true)) {
				$this->db->where('o.delivery_status', $this->input->get('delivery_status', true));
			}
			if ($this->input->get('payment_type', true)) {
				$this->db->where('o.payment_type', $this->input->get('payment_type', true));
			}
			if ($this->input->get('user_id', true)) {
				$this->db->where('o.user_id', $this->input->get('user_id', true));
			}
		}

		$this->db->order_by('id DESC');
		$query = $this->db->get();



		$allData = $query->result_array();  // this will return all data into array
		$dataToExports = [];
		foreach ($allData as $data) {
			$arrangeData['Şipariş No'] = $data['Id'];
			$arrangeData['Sipariş Durumu'] = $this->orderStatusArr[$data['order_status']]['text'];
			$arrangeData['Ödeme Durumu'] = $this->paymentStatusText($data['payment_status'], $data['order_status']);
			$arrangeData['Ödeme Tipi'] = $this->paymentTypeArr[$data['payment_type']];
			//$arrangeData['Kargo Firması'] = $data['kargoad'];
			$arrangeData['Alıcı Adı'] = $data['username'];
			$arrangeData['Sipariş Tarihi'] = dateparse($data['added_time']);
			$arrangeData['Toplam Adet'] = $data['adet'];
			$arrangeData['Toplam Tutar'] = $data['toplam'];
			$dataToExports[] = $arrangeData;
		}
		// set header
		$filename = "dataToExport.xls";
		//$this->exportExcelData($dataToExports);
		require "Excel_XML.php";
		$xls = new Excel_XML;
		$xls->addWorksheet('Sipariş Tablosu', $dataToExports);
		$xls->sendWorkbook('data.xls');
	}

	public function KargoDateUpdate($order_line_id,$date)
	{
		$this->db->where(array('Id'=> $order_line_id));
		$this->db->set(array('tahmini_kargo' => $date));
		$this->db->update('order_line');
		return true;
	}
	public function ProductUpdate($order_line_id,$product_status)
	{
		$this->db->where(array('Id'=> $order_line_id));
		$this->db->set(array('product_status' => $product_status));
		$this->db->update('order_line');
		return true;
	}
}
?>