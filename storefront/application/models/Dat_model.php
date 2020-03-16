<?php
ini_set("soap.wsdl_cache_enabled", "0"); 
class Dat_model extends Core_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Admin/Agac_model');
	}

	public function getToken()
	{
		
		if (!($this->session->userdata('datToken')) || $this->session->userdata('datToken') == '') {
			$client = new SoapClient(
			    null,
			    array(
			        'location' => 'http://www.dat.de/SparePartRequest/services/Authentication?wsdl',
			        'uri' => 'http://www.dat.de/SparePartRequest/services/Authentication?wsdl',
			        'trace' => 1,
			        'use' => SOAP_LITERAL,
			    )
			);

			$params = new \SoapVar("
			<request>
				<customerLogin>".getenv('DAT_CUSTOMER_LOGIN')."</customerLogin>
				<customerNumber>".getenv('DAT_CUSTOMER_NUMBER')."</customerNumber>
				<customerSignature>".getenv('DAT_CUSTOMER_SIGNATURE')."</customerSignature>
				<interfacePartnerNumber>".getenv('DAT_PARTNER_NUMBER')."</interfacePartnerNumber>
				<interfacePartnerSignature>".getenv('DAT_PARTNER_SIGNATURE')."</interfacePartnerSignature>
				<productVariant></productVariant>
			</request>
			", XSD_ANYXML);
			$result = $client->doLogin($params);

			$this->session->set_userdata('datToken',$result);
			return $result;
		}
		else{
			//prex($this->session->userdata('datToken'));
			return $this->session->userdata('datToken');
		}
	}

	public function getLoginData()
	{
		return '<customerLogin>'.getenv('DAT_CUSTOMER_LOGIN').'</customerLogin>
				<customerNumber>'.getenv('DAT_CUSTOMER_NUMBER').'</customerNumber>
	            <customerSignature>'.getenv('DAT_CUSTOMER_SIGNATURE').'</customerSignature>
	            <interfacePartnerNumber>'.getenv('DAT_PARTNER_NUMBER').'</interfacePartnerNumber>
	            <interfacePartnerSignature>'.getenv('DAT_PARTNER_SIGNATURE').'</interfacePartnerSignature>';
	}

	public function getCarMarks()
	{
		$ary = array('carType' => 0);
		$q = $this->Agac_model->get($ary,1);

		$datToken = $this->getToken();
		$loginData = $this->getLoginData();

		//prex($datToken);
		
		$client = new SoapClient(
		    null,
		    array(
		        'location' => 'https://www.dat.de/DATECodeSelection/services/VehicleSelectionService?wsdl',
		        'uri' => 'https://www.dat.de/DATECodeSelection/services/VehicleSelectionService?wsdl',
		        'trace' => 1,
		        'use' => SOAP_LITERAL,
		    )
		);

		// Soap Header Begin
    	$headerParam = new SoapVar($loginData, XSD_ANYXML, NULL, NULL, NULL, NULL);

    	$header = new SoapHeader( 'http://sphinx.dat.de/services/VehicleSelectionService', 'Header', $headerParam );
   		$client->__setSoapHeaders($header);
		// Soap Header End

   		//Soap Body Begin
		$params = new \SoapVar('
		<request>
            <locale country="tr" datCountryIndicator="tr" language="tr"/>
            <sessionID>'.$datToken.'</sessionID>
            <restriction>ALL</restriction>
		</request>
		', XSD_ANYXML);
		//Soap Body End


		//Soap Method Call
		$client->getVehicleTypes($params);
		$response 	= $client->__getLastResponse();

		$response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $response);
		$xml = new SimpleXMLElement($response);
		$body = $xml->xpath('//SBody')[0];
		$lastResult = json_decode(json_encode((array)$body), TRUE); 

		$result = array();
		foreach ($lastResult as $key => $val) {
			foreach ($val as $key2 => $val2) {
				foreach ($val2 as $key3 => $val3) {
					$result[] = ($val3['@attributes']);
				}
			}
		}


		if ($q != false) {
			$newArray = [];
			foreach ($q as $key => $val) {
				if (array_key_exists($key,$result)) {
					$newArray[] = $val;
				}
			}

			return $newArray;
		}else{
			return $result;
		}
	}

	public function getBrands($type,$year= '')
	{
		$ary = array('carType' => $type,'carBrands' => '');
		$q = $this->Agac_model->get($ary,1);
		$datToken = $this->getToken();
		$loginData = $this->getLoginData();

		$client = new SoapClient(
		    null,
		    array(
		        'location' => 'https://www.dat.de/DATECodeSelection/services/VehicleSelectionService?wsdl',
		        'uri' => 'https://www.dat.de/DATECodeSelection/services/VehicleSelectionService?wsdl',
		        'trace' => 1,
		        'use' => SOAP_LITERAL,
		    )
		);

		// Soap Header Begin
    	$headerParam = new SoapVar($loginData, XSD_ANYXML, NULL, NULL, NULL, NULL);

    	$header = new SoapHeader( 'http://sphinx.dat.de/services/VehicleSelectionService', 'Header', $headerParam );
   		$client->__setSoapHeaders($header);
		// Soap Header End

   		//Soap Body Begin
   		$soapVar = '
		<request>
            <locale country="tr" datCountryIndicator="tr" language="tr"/>
            <sessionID>'.$datToken.'</sessionID>
            <restriction>ALL</restriction>
            <vehicleType>'.$type.'</vehicleType>';
        if ($year != '') {
        	$year = (($year-1970)*120)+10;
        	$soapVar .= '<constructionTimeFrom>'.$year.'</constructionTimeFrom>
            			 	<constructionTimeTo>'.($year+120).'</constructionTimeTo>';
        }

		$soapVar .= '</request>';
		$params = new \SoapVar($soapVar, XSD_ANYXML);
		//Soap Body End


		//Soap Method Call
		$client->getManufacturers($params);
		$response 	= $client->__getLastResponse();
		//prex($client->__getLastRequest());

		$response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $response);
		$xml = new SimpleXMLElement($response);
		$body = $xml->xpath('//SBody')[0];
		$lastResult = json_decode(json_encode((array)$body), TRUE); 

		$result = array();
		foreach ($lastResult as $key => $val) {
			foreach ($val as $key2 => $val2) {
				foreach ($val2 as $key3 => $val3) {
					$result[] = ($val3['@attributes']);
				}
			}
		}


		if ($q != false) {
			$newArray = [];
			foreach ($q as $key => $val) {
				if (array_key_exists($key,$result)) {
					$newArray[] = $val;
				}
			}

			return $newArray;
		}else{
			return $result;
		}
	}

	public function getModels($type,$brand,$year= '')
	{
		$ary = array('carType' => $type,'carBrands' => $brand ,'carModels' => '');
		$q = $this->Agac_model->get($ary,1);
		//prex($q);

		$datToken = $this->getToken();
		$loginData = $this->getLoginData();

		$client = new SoapClient(
		    null,
		    array(
		        'location' => 'https://www.dat.de/DATECodeSelection/services/VehicleSelectionService?wsdl',
		        'uri' => 'https://www.dat.de/DATECodeSelection/services/VehicleSelectionService?wsdl',
		        'trace' => 1,
		        'use' => SOAP_LITERAL,
		    )
		);

		// Soap Header Begin
    	$headerParam = new SoapVar($loginData, XSD_ANYXML, NULL, NULL, NULL, NULL);

    	$header = new SoapHeader( 'http://sphinx.dat.de/services/VehicleSelectionService', 'Header', $headerParam );
   		$client->__setSoapHeaders($header);
		// Soap Header End

   		$soapVar = '<request>
            <locale country="tr" datCountryIndicator="tr" language="tr"/>
            <sessionID>'.$datToken.'</sessionID>
            <restriction>ALL</restriction>
            <vehicleType>'.$type.'</vehicleType>
            <manufacturer>'.$brand.'</manufacturer>';

   		if ($year != '') {
        	$year = (($year-1970)*120)+10;
        	$soapVar .= '<constructionTimeFrom>'.$year.'</constructionTimeFrom>
        			 	 <constructionTimeTo>'.($year+120).'</constructionTimeTo>';
        }

        $soapVar .= '</request>';

   		//Soap Body Begin
		$params = new \SoapVar($soapVar, XSD_ANYXML);
		//Soap Body End

		//prex($params);

		//Soap Method Call
		$client->getBaseModels($params);
		$response 	= $client->__getLastResponse();
		//prex($client->__getLastRequest());

		$response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $response);
		$xml = new SimpleXMLElement($response);
		$body = $xml->xpath('//SBody')[0];
		$lastResult = json_decode(json_encode((array)$body), TRUE); 

		$result = array();
		foreach ($lastResult as $key => $val) {
			foreach ($val as $key2 => $val2) {
				foreach ($val2 as $key3 => $val3) {
					$result[] = ($val3['@attributes']);
				}
			}
		}

		

		if ($q != false) {
			$newArray = [];
			foreach ($q as $key => $val) {
				foreach ($result as $key2 => $val2) {
					if ($val->key == $val2['key']) {
						$newArray[] = $val;
					}
				}
			}

			usort($newArray, function($a, $b) {
			    return $a->name <=> $b->name;
			});
			return $newArray;
		}else{

			usort($result, function($a, $b) {
			    return $a['value'] <=> $b['value'];
			});
			return $result;
		}
	}


	public function getSubModels($type,$brand,$model,$year = '')
	{
		$ary = array('carType' => $type,'carBrands' => $brand ,'carModels' => $model);
		$q = $this->Agac_model->get($ary,1);

		$datToken = $this->getToken();
		$loginData = $this->getLoginData();
		//prex($datToken);


		$client = new SoapClient(
		    null,
		    array(
		        'location' => 'https://www.dat.de/DATECodeSelection/services/VehicleSelectionService?wsdl',
		        'uri' => 'https://www.dat.de/DATECodeSelection/services/VehicleSelectionService?wsdl',
		        'trace' => 1,
		        'use' => SOAP_LITERAL,
		    )
		);

		// Soap Header Begin
    	$headerParam = new SoapVar($loginData, XSD_ANYXML, NULL, NULL, NULL, NULL);

    	$header = new SoapHeader( 'http://sphinx.dat.de/services/VehicleSelectionService', 'Header', $headerParam );
   		$client->__setSoapHeaders($header);
		// Soap Header End

   		//Soap Body Begin
   		$soapVar = '
		<request>
            <locale country="tr" datCountryIndicator="tr" language="tr"/>
            <sessionID>'.$datToken.'</sessionID>
            <restriction>ALL</restriction>
            <vehicleType>'.$type.'</vehicleType>
            <manufacturer>'.$brand.'</manufacturer>
            <baseModel>'.$model.'</baseModel>';

     	if ($year != '') {
        	$year = (($year-1970)*120)+10;
        	$soapVar .= '<constructionTimeFrom>'.$year.'</constructionTimeFrom>
            			 	<constructionTimeTo>'.($year+120).'</constructionTimeTo>';
        }

        $soapVar .= '</request>';
		$params = new \SoapVar($soapVar, XSD_ANYXML);
		//Soap Body End


		//Soap Method Call
		$client->getSubModels($params);
		$response 	= $client->__getLastResponse();

		$response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $response);
		$xml = new SimpleXMLElement($response);
		$body = $xml->xpath('//SBody')[0];
		$lastResult = json_decode(json_encode((array)$body), TRUE); 
		$result = array();
		foreach ($lastResult as $key => $val) {
			foreach ($val as $key2 => $val2) {
				if (count($val2) == 1) {
					$result[] = $val2['@attributes'];
				}else{
					foreach ($val2 as $key3 => $val3) {
						$result[] = ($val3['@attributes']);
					}
				}
			}
		}


		if ($q != false) {
			$newArray = [];
			foreach ($q as $key => $val) {
				foreach ($result as $key2 => $val2) {
					if ($val['key'] == $val2['key']) {
						$newArray[] = $val;
					}
				}
			}

			usort($newArray, function($a, $b) {
			    return $a['value'] <=> $b['value'];
			});
			return $newArray;
		}else{
			
			usort($result, function($a, $b) {
			    return $a['value'] <=> $b['value'];
			});
			return $result;
		}
	}

	public function getOptions($type,$brand,$model,$subModel,$year='')
	{
		$data = new StdClass;
		$data->engine 	= $this->getEngine($type,$brand,$model,$subModel,'',$year);
		$data->gear 	= $this->getGear($type,$brand,$model,$subModel,'',$year);
		$data->body 	= $this->getCarBody($type,$brand,$model,$subModel,'',$year);
		try {
			$data->equipment = $this->getCarEquipment($type,$brand,$model,$subModel,'',$year);
		}
		catch (exception $e) {
		    //code to handle the exception
		}

		return $data;
	}

	public function getEngine($type,$brand,$model,$subModel,$id = '',$year = '')
	{
		$datToken = $this->getToken();
		$loginData = $this->getLoginData();
		//prex($datToken);


		$client = new SoapClient(
		    null,
		    array(
		        'location' => 'https://www.dat.de/DATECodeSelection/services/VehicleSelectionService?wsdl',
		        'uri' => 'https://www.dat.de/DATECodeSelection/services/VehicleSelectionService?wsdl',
		        'trace' => 1,
		        'use' => SOAP_LITERAL,
		    )
		);

		// Soap Header Begin
    	$headerParam = new SoapVar($loginData, XSD_ANYXML, NULL, NULL, NULL, NULL);

    	$header = new SoapHeader( 'http://sphinx.dat.de/services/VehicleSelectionService', 'Header', $headerParam );
   		$client->__setSoapHeaders($header);
		// Soap Header End

   		//Soap Body Begin
   		$soapVar = '
		<request>
            <locale country="tr" datCountryIndicator="tr" language="tr"/>
            <sessionID>'.$datToken.'</sessionID>
            <restriction>ALL</restriction>
            <vehicleType>'.$type.'</vehicleType>
            <manufacturer>'.$brand.'</manufacturer>
            <baseModel>'.$model.'</baseModel>
            <subModel>'.$subModel.'</subModel>';

		if ($year != '') {
        	$year = (($year-1970)*120)+10;
        	$soapVar .= '<constructionTimeFrom>'.$year.'</constructionTimeFrom>
            			 	<constructionTimeTo>'.($year+120).'</constructionTimeTo>';
        }

        if ($id != '') {
        	$soapVar .= '<availableOptions>'.$id.'</availableOptions>';
        }

		$soapVar .= '</request>';

		$params = new \SoapVar($soapVar, XSD_ANYXML);
		//Soap Body End


		//Soap Method Call
		$client->getEngineOptions($params);
		$response 	= $client->__getLastResponse();
		//prex($client->__getLastRequest());

		$response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $response);
		$xml = new SimpleXMLElement($response);
		$body = $xml->xpath('//SBody')[0];
		$lastResult = json_decode(json_encode((array)$body), TRUE); 

		$result = array();
		foreach ($lastResult as $key => $val) {
			foreach ($val as $key2 => $val2) {
				if (count($val2) == 1) {
					$result[] = $val2['@attributes'];
				}else{
					foreach ($val2 as $key3 => $val3) {
						$result[] = ($val3['@attributes']);
					}
				}
			}
		}

		return $result;
	}

	public function getGear($type,$brand,$model,$subModel,$id = '',$year = '')
	{
		$datToken = $this->getToken();
		$loginData = $this->getLoginData();
		//prex($datToken);


		$client = new SoapClient(
		    null,
		    array(
		        'location' => 'https://www.dat.de/DATECodeSelection/services/VehicleSelectionService?wsdl',
		        'uri' => 'https://www.dat.de/DATECodeSelection/services/VehicleSelectionService?wsdl',
		        'trace' => 1,
		        'use' => SOAP_LITERAL,
		    )
		);

		// Soap Header Begin
    	$headerParam = new SoapVar($loginData, XSD_ANYXML, NULL, NULL, NULL, NULL);

    	$header = new SoapHeader( 'http://sphinx.dat.de/services/VehicleSelectionService', 'Header', $headerParam );
   		$client->__setSoapHeaders($header);
		// Soap Header End

   		//Soap Body Begin
   		$soapVar = '
		<request>
            <locale country="tr" datCountryIndicator="tr" language="tr"/>
            <sessionID>'.$datToken.'</sessionID>
            <restriction>ALL</restriction>
            <vehicleType>'.$type.'</vehicleType>
            <manufacturer>'.$brand.'</manufacturer>
            <baseModel>'.$model.'</baseModel>
            <subModel>'.$subModel.'</subModel>';

        if ($year != '') {
        	$year = (($year-1970)*120)+10;
        	$soapVar .= '<constructionTimeFrom>'.$year.'</constructionTimeFrom>
            			 	<constructionTimeTo>'.($year+120).'</constructionTimeTo>';
        }

        if ($id != '') {
        	$soapVar .= '<availableOptions>'.$id.'</availableOptions>';
        }

		$soapVar .= '</request>';

		$params = new \SoapVar($soapVar, XSD_ANYXML);
		//Soap Body End


		//Soap Method Call
		$client->getGearingOptions($params);
		$response 	= $client->__getLastResponse();
		//prex($client->__getLastRequest());


		$response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $response);
		$xml = new SimpleXMLElement($response);
		$body = $xml->xpath('//SBody')[0];
		$lastResult = json_decode(json_encode((array)$body), TRUE); 

		$result = array();
		foreach ($lastResult as $key => $val) {
			foreach ($val as $key2 => $val2) {
				if (count($val2) == 1) {
					$result[] = $val2['@attributes'];
				}else{
					foreach ($val2 as $key3 => $val3) {
						$result[] = ($val3['@attributes']);
					}
				}
			}
		}

		return $result;
	}

	public function getCarBody($type,$brand,$model,$subModel,$id = '',$year = '')
	{
		$datToken = $this->getToken();
		$loginData = $this->getLoginData();
		//prex($datToken);


		$client = new SoapClient(
		    null,
		    array(
		        'location' => 'https://www.dat.de/DATECodeSelection/services/VehicleSelectionService?wsdl',
		        'uri' => 'https://www.dat.de/DATECodeSelection/services/VehicleSelectionService?wsdl',
		        'trace' => 1,
		        'use' => SOAP_LITERAL,
		    )
		);

		// Soap Header Begin
    	$headerParam = new SoapVar($loginData, XSD_ANYXML, NULL, NULL, NULL, NULL);

    	$header = new SoapHeader( 'http://sphinx.dat.de/services/VehicleSelectionService', 'Header', $headerParam );
   		$client->__setSoapHeaders($header);
		// Soap Header End

   		//Soap Body Begin
   		$soapVar = '
		<request>
            <locale country="tr" datCountryIndicator="tr" language="tr"/>
            <sessionID>'.$datToken.'</sessionID>
            <restriction>ALL</restriction>
            <vehicleType>'.$type.'</vehicleType>
            <manufacturer>'.$brand.'</manufacturer>
            <baseModel>'.$model.'</baseModel>
            <subModel>'.$subModel.'</subModel>';

    	if ($year != '') {
        	$year = (($year-1970)*120)+10;
        	$soapVar .= '<constructionTimeFrom>'.$year.'</constructionTimeFrom>
            			 	<constructionTimeTo>'.($year+120).'</constructionTimeTo>';
        }
        if ($id != '') {
        	foreach ($id as $key => $val) {
        		$soapVar .= '<availableOptions>'.$val.'</availableOptions>';
        	}
        }

		$soapVar .= '</request>';

		$params = new \SoapVar($soapVar, XSD_ANYXML);
		//Soap Body End


		//Soap Method Call
		$client->getCarBodyOptions($params);
		$response 	= $client->__getLastResponse();
		//prex($client->__getLastRequest());

		$response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $response);
		$xml = new SimpleXMLElement($response);
		$body = $xml->xpath('//SBody')[0];
		$lastResult = json_decode(json_encode((array)$body), TRUE); 

		$result = array();
		foreach ($lastResult as $key => $val) {
			foreach ($val as $key2 => $val2) {
				if (count($val2) == 1) {
					$result[] = $val2['@attributes'];
				}else{
					foreach ($val2 as $key3 => $val3) {
						$result[] = ($val3['@attributes']);
					}
				}
			}
		}

		return $result;
	}


	public function getCarEquipment($type,$brand,$model,$subModel,$id = '',$year = '')
	{
		$datToken = $this->getToken();
		$loginData = $this->getLoginData();
		//prex($datToken);


		$client = new SoapClient(
		    null,
		    array(
		        'location' => 'https://www.dat.de/DATECodeSelection/services/VehicleSelectionService?wsdl',
		        'uri' => 'https://www.dat.de/DATECodeSelection/services/VehicleSelectionService?wsdl',
		        'trace' => 1,
		        'use' => SOAP_LITERAL,
		    )
		);

		// Soap Header Begin
    	$headerParam = new SoapVar($loginData, XSD_ANYXML, NULL, NULL, NULL, NULL);

    	$header = new SoapHeader( 'http://sphinx.dat.de/services/VehicleSelectionService', 'Header', $headerParam );
   		$client->__setSoapHeaders($header);
		// Soap Header End

   		//Soap Body Begin
   		$soapVar = '
		<request>
            <locale country="tr" datCountryIndicator="tr" language="tr"/>
            <sessionID>'.$datToken.'</sessionID>
            <restriction>ALL</restriction>
            <vehicleType>'.$type.'</vehicleType>
            <manufacturer>'.$brand.'</manufacturer>
            <baseModel>'.$model.'</baseModel>
            <subModel>'.$subModel.'</subModel>';
		
		if ($year != '') {
        	$year = (($year-1970)*120)+10;
        	$soapVar .= '<constructionTimeFrom>'.$year.'</constructionTimeFrom>
            			 	<constructionTimeTo>'.($year+120).'</constructionTimeTo>';
        }
       
        if ($id != '') {
        	foreach ($id as $key => $val) {
        		$soapVar .= '<availableOptions>'.$val.'</availableOptions>';
        	}
        }

		$soapVar .= '</request>';

		$params = new \SoapVar($soapVar, XSD_ANYXML);
		//Soap Body End


		/*
		pre($headerParam);
		prex($params);
		*/

		//Soap Method Call
		$client->getEquipmentLineOptions($params);
		$response 	= $client->__getLastResponse();
		//prex($client->__getLastRequest());

		$response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $response);
		$xml = new SimpleXMLElement($response);
		$body = $xml->xpath('//SBody')[0];
		$lastResult = json_decode(json_encode((array)$body), TRUE); 

		$result = array();
		foreach ($lastResult as $key => $val) {
			foreach ($val as $key2 => $val2) {
				if (count($val2) == 1) {
					$result[] = $val2['@attributes'];
				}else{
					foreach ($val2 as $key3 => $val3) {
						$result[] = ($val3['@attributes']);
					}
				}
			}
		}

		return $result;
	}

	public function getChangedOptions($postData)
	{
		//prex($postData);
		$data = new StdClass;
		if (!isset($postData->year)) {
			$postData->year = '';
		}

		if ($postData->name == 'car_engine') {
			$data->gear 	= $this->getGear($postData->type,$postData->brand,$postData->model,$postData->subModel,$postData->selected,$postData->year);

			/*
			try {
				$data->equipment = $this->getCarEquipment($type,$brand,$model,$subModel,$id);
			}
			catch (exception $e) {
			    //code to handle the exception
			}
			*/
		}else if ($postData->name == 'car_gear') {
			$selectedOptions = array($postData->selected);
			if ($postData->engine_selected != 0) {
				$selectedOptions[] = $postData->engine_selected;
			}
			$data->body 	= $this->getCarBody($postData->type,$postData->brand,$postData->model,$postData->subModel,$selectedOptions,$postData->year);
			
			/*
			try {
				$data->equipment = $this->getCarEquipment($type,$brand,$model,$subModel,$id);
			}
			catch (exception $e) {
			    //code to handle the exception
			}
			*/
		}else if ($postData->name == 'car_body') {
				$selectedOptions = array($postData->selected);
				if ($postData->engine_selected != 0) {
					$selectedOptions[] = $postData->engine_selected;
				}
				if ($postData->gear_selected != 0) {
					$selectedOptions[] = $postData->gear_selected;
				}
				$data->equipment = $this->getCarEquipment($postData->type,$postData->brand,$postData->model,$postData->subModel,$selectedOptions,$postData->year);
			
			/*
			try {
				$data->equipment = $this->getCarEquipment($type,$brand,$model,$subModel,$id);
			}
			catch (exception $e) {
			    //code to handle the exception
			}
			*/
		}else{

		}
		

		return $data;
	}

	public function getCarId($data)
	{
		$datToken = $this->getToken();
		$loginData = $this->getLoginData();
		//prex($datToken);

		if (!isset($data->year)) {
			$data->year = '';
		}


		$client = new SoapClient(
		    null,
		    array(
		        'location' => 'https://www.dat.de/DATECodeSelection/services/VehicleSelectionService?wsdl',
		        'uri' => 'https://www.dat.de/DATECodeSelection/services/VehicleSelectionService?wsdl',
		        'trace' => 1,
		        'use' => SOAP_LITERAL,
		    )
		);

		// Soap Header Begin
    	$headerParam = new SoapVar($loginData, XSD_ANYXML, NULL, NULL, NULL, NULL);

    	$header = new SoapHeader( 'http://sphinx.dat.de/services/VehicleSelectionService', 'Header', $headerParam );
   		$client->__setSoapHeaders($header);
		// Soap Header End

   		//Soap Body Begin
   		$xmlParams = '<request>
            <locale country="tr" datCountryIndicator="tr" language="tr"/>
            <sessionID>'.$datToken.'</sessionID>
            <restriction>ALL</restriction>
            <vehicleType>'.$data->type.'</vehicleType>
            <manufacturer>'.$data->brand.'</manufacturer>
            <baseModel>'.$data->model.'</baseModel>
            <subModel>'.$data->subModel.'</subModel>';

        if (isset($data->engine)) {
            $xmlParams .= '<selectedOptions>'.$data->engine.'</selectedOptions>';
        }
        if (isset($data->gear)) {
            $xmlParams .= '<selectedOptions>'.$data->gear.'</selectedOptions>';
        }
        if (isset($data->body)) {
            $xmlParams .= '<selectedOptions>'.$data->body.'</selectedOptions>';
        }
        if (isset($data->equipment)) {
            $xmlParams .= '<selectedOptions>'.$data->equipment.'</selectedOptions>';
        }
        $xmlParams .= '</request>';
        
        //prex($loginData);
		$params = new \SoapVar($xmlParams, XSD_ANYXML);
		//prex($params);
		//Soap Body End

		//Soap Method Call
		$response = $client->compileDatECode($params);
		$lst = $this->getConsTime($response,$data->year);
		
		/*
		$first = current($lst);
		$last = end($lst);

		$lst[0]['name'] = explodeDatTime($this->changeConsTime($first['value']));
		$lst[key($lst)-1]['name'] = explodeDatTime($this->changeConsTime($last['value']));
		*/
		
		return array('carId' => $response, 'ConsTime' => $lst);
	}

	public function getConsTime($carId,$year)
	{
		$datToken = $this->getToken();
		$loginData = $this->getLoginData();
		//prex($datToken);


		$client = new SoapClient(
		    null,
		    array(
		        'location' => 'https://www.dat.de/DATECodeSelection/services/VehicleSelectionService?wsdl',
		        'uri' => 'https://www.dat.de/DATECodeSelection/services/VehicleSelectionService?wsdl',
		        'trace' => 1,
		        'use' => SOAP_LITERAL,
		    )
		);

		// Soap Header Begin
    	$headerParam = new SoapVar($loginData, XSD_ANYXML, NULL, NULL, NULL, NULL);

    	$header = new SoapHeader( 'http://sphinx.dat.de/services/VehicleSelectionService', 'Header', $headerParam );
   		$client->__setSoapHeaders($header);
		// Soap Header End

   		//Soap Body Begin
   		$soapVar = '<request>
			            <locale country="tr" datCountryIndicator="tr" language="tr"/>
			            <sessionID>'.$datToken.'</sessionID>
			            <restriction>ALL</restriction>
			            <datECode>'.$carId.'</datECode>';

			if ($year != '') {
	        	$year = (($year-1970)*120)+10;
	        	$soapVar .= '<constructionTimeFrom>'.$year.'</constructionTimeFrom>
	            		<constructionTimeTo>'.($year+120).'</constructionTimeTo>';
	        }
			$soapVar .= '</request>';
		$params = new \SoapVar($soapVar, XSD_ANYXML);
		//Soap Body End

		//Soap Method Call
		$client->getConstructionPeriodsN($params);
		$response = $client->__getLastResponse();
		//prex($client->__getLastRequest());

		$response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $response);
		$xml = new SimpleXMLElement($response);
		$body = $xml->xpath('//SBody')[0];
		$lastResult = json_decode(json_encode((array)$body), TRUE); 

		$result = array();
		foreach ($lastResult as $key => $val) {
			foreach ($val as $key2 => $val2) { 	
				foreach ($val2['constructionTimes'] as $key3 => $val3) {
					foreach ($val3 as $key4 => $val4) {
						foreach ($val4 as $key5 => $val5) {
							if (isset($val5['@attributes'])) {
								$result[] = ($val5['@attributes']);
							}else{
								$result[] = ($val5);
							}
						}
					}
				}
			}
		}

		//tarihi hesaplayıp düzgün şekilde yazıyorum
		$ary = [];
		$result = array_reverse($result);
		foreach ($result as $key => $val) {
			$next = $key + 1;
			if (isset($result[$next])) {
				$ary[] = array('name' => getConsTime($val['value']).' ile '.getConsTime($result[$next]['value']).' arası', 'value' => $val['value']);
			}else{
				$ary[] = array('name' => getConsTime($val['value']).' Sonrası ', 'value' => $val['value']);
			}
		}

		return $ary;
	}

	public function changeConsTime($time)
	{
		$datToken = $this->getToken();
		$loginData = $this->getLoginData();
		//prex($datToken);


		$client = new SoapClient(
		    null,
		    array(
		        'location' => 'http://www.dat.de/DATECodeSelection/services/ConversionFunctionsService?wsdl',
		        'uri' => 'http://www.dat.de/DATECodeSelection/services/ConversionFunctionsService?wsdl',
		        'trace' => 1,
		        'use' => SOAP_LITERAL,
		    )
		);

		// Soap Header Begin
    	$headerParam = new SoapVar($loginData, XSD_ANYXML, NULL, NULL, NULL, NULL);

    	$header = new SoapHeader( 'http://sphinx.dat.de/services/VehicleSelectionService', 'Header', $headerParam );
   		$client->__setSoapHeaders($header);
		// Soap Header End

   		//Soap Body Begin
   		$xmlParams = '<request>
			            <constructionTime>'.$time.'</constructionTime>
			            <sessionID>'.$datToken.'</sessionID>
			         </request>';
		$params = new \SoapVar($xmlParams, XSD_ANYXML);
		//Soap Body End

		//Soap Method Call
		$response = $client->constructionTime2Date($params);

		return $response;

	}

	public function getCarDetail($data)
	{
		$this->db->select('detail');
		$this->db->where((array)$data);
		$q = $this->db->get('datCarDetail');
		
		if ($q->num_rows()>0) {
			return json_decode($q->row()->detail);
		}else{
			$datToken = $this->getToken();
			$loginData = $this->getLoginData();
			//prex($datToken);


			$client = new SoapClient(
			    null,
			    array(
			        'location' => 'https://www.dat.de/DATECodeSelection/services/VehicleSelectionService?wsdl',
			        'uri' => 'https://www.dat.de/DATECodeSelection/services/VehicleSelectionService?wsdl',
			        'trace' => 1,
			        'use' => SOAP_LITERAL,
			    )
			);

			// Soap Header Begin
	    	$headerParam = new SoapVar($loginData, XSD_ANYXML, NULL, NULL, NULL, NULL);

	    	$header = new SoapHeader( 'http://sphinx.dat.de/services/VehicleSelectionService', 'Header', $headerParam );
	   		$client->__setSoapHeaders($header);
			// Soap Header End

	   		//Soap Body Begin
	   		$xmlParams = '<request>
				            <locale country="tr" datCountryIndicator="tr" language="tr"/>
				            <sessionID>'.$datToken.'</sessionID>
				            <restriction>ALL</restriction>
				            <datECode>'.$data->carId.'</datECode>
				            <constructionTime>'.$data->consTime.'</constructionTime>
				         </request>';
			$params = new \SoapVar($xmlParams, XSD_ANYXML);
			//Soap Body End

			//Soap Method Call
			$q = $client->getVehicleData($params);
			$data->detail = json_encode($q);

			$this->db->set($data);
			$this->db->insert('datCarDetail');
			
			return $q;
		}
	}

	public function getAssemblyGroups($type, $brand, $model)
	{
		
		//$datToken = $this->getToken();
		$loginData = $this->getLoginData();
		//prex($datToken);


		$client = new SoapClient(
		    null,
		    array(
		        'location' => 'http://www.dat.de/VehicleRepairOnline/services/VehicleRepairService',
		        'uri' => 'http://www.dat.de/VehicleRepairOnline/services/VehicleRepairService',
		        'trace' => 1,
		        'use' => SOAP_LITERAL,
		    )
		);

		// Soap Header Begin
    	$headerParam = new SoapVar($loginData, XSD_ANYXML, NULL, NULL, NULL, NULL);

    	$header = new SoapHeader( 'http://sphinx.dat.de/services/VehicleRepairService', 'Header', $headerParam );
   		$client->__setSoapHeaders($header);
		// Soap Header End

   		//Soap Body Begin
   		$xmlParams = '<locale country="tr" datCountryIndicator="tr" language="tr"/>
			            <vehicleType>'.$type.'</vehicleType>
			            <manufacturer>'.$brand.'</manufacturer>
			            <mainType>'.$model.'</mainType>';
		$params = new \SoapVar($xmlParams, XSD_ANYXML);
		//Soap Body End

		//Soap Method Call
		
		//pre($params);
		//prex($client);

		$q = $client->getAssemblyGroups($params);
		//prex($client->__getLastRequest());

		//prex($q);

		//$this->db->insert_batch('datAssemblyGroups',$q['AssemblyGroup']);
		//prex($q['AssemblyGroup']);
		return $q['AssemblyGroup'];
		

	}

	public function getDvns($type, $brand, $model,$assembly)
	{
		
		//$datToken = $this->getToken();
		$loginData = $this->getLoginData();
		//prex($datToken);


		$client = new SoapClient(
		    null,
		    array(
		        'location' => 'http://www.dat.de/VehicleRepairOnline/services/VehicleRepairService',
		        'uri' => 'http://www.dat.de/VehicleRepairOnline/services/VehicleRepairService',
		        'trace' => 1,
		        'use' => SOAP_LITERAL,
		        'stream_context' => stream_context_create(
		            array(
		                'http' => array(
		                    'protocol_version' => 1.0,
		                ),
		            )
		        ),
		    )
		);

		// Soap Header Begin
    	$headerParam = new SoapVar($loginData, XSD_ANYXML, NULL, NULL, NULL, NULL);

    	$header = new SoapHeader( 'http://sphinx.dat.de/services/VehicleRepairService', 'Header', $headerParam );
   		$client->__setSoapHeaders($header);
		// Soap Header End

   		//Soap Body Begin
   		$xmlParams = '<locale country="tr" datCountryIndicator="tr" language="tr"/>
			            <vehicleType>'.$type.'</vehicleType>
			            <manufacturer>'.$brand.'</manufacturer>
			            <assemblyGroupId>'.$assembly.'</assemblyGroupId>
			            <mainType>'.$model.'</mainType>';
		$params = new \SoapVar($xmlParams, XSD_ANYXML);
		//Soap Body End

		//Soap Method Call
		
		/*
		pre($params);
		prex($client);
		*/

		$q = $client->getAssemblyGroupGraphic($params);
		$q = explode('<metadata>', $q);

		$ary = [];
		foreach ($q as $key => $val) {
			$ary[] = explode('</metadata>', $val);
		}
		//prex($ary);

		$result = [];
		foreach ($ary as $key => $val) {
			if ($key != 0) {
				$result[] = '<metadata>'.$val[0].'</metadata>' ;
			}
		}

		//prex($client->__getLastRequest());
		//$q = simplexml_load_string($q);
		$ary = [];
		foreach ($result as $key => $val) {
			if ($val) {
				# code...
			}
			//pre($val);
			$dvnData = new StdClass;
			$val = str_replace('dat:', '', $val);
			$test = @simplexml_load_string($val)->objectInfo;
			if ($test) {
				//pre($test);
				$name = (array)$test->title->langs->lang;
				$name = end($name);
				//prex($name);
				//pre('--------------------------------------------------------------');
				$dvnData->name = $name;
				$dvnData->rdvn = ((array)$test->dvnRight->dvn)[0] ?? '';
				$dvnData->ldvn = ((array)@$test->dvnLeft->dvn)[0] ?? '';
				$dvnData->model = $model;
				if (trim($dvnData->name) != '') {
					$ary[] = (array)$dvnData;
				}
			}
		}

		if (!empty($ary)) {
			$this->db->insert_batch('datDvns',$ary);
		}

		return $ary;
	}

	public function getOem($dvns,$datCarId,$consTime)
	{
		
		
		$datToken = $this->getToken();
		$loginData = $this->getLoginData();
		//prex($datToken);


		$client = new SoapClient(
		    null,
		    array(
		        'location' => 'http://www.dat.de/PartsInfo/services/SpareParts',
		        'uri' => 'http://www.dat.de/PartsInfo/services/SpareParts',
		        'trace' => 1,
		        'use' => SOAP_LITERAL,
		    )
		);

		// Soap Header Begin
    	$headerParam = new SoapVar($loginData, XSD_ANYXML, NULL, NULL, NULL, NULL);

    	$header = new SoapHeader( 'http://sphinx.dat.de/services/SpareParts', 'Header', $headerParam );
   		$client->__setSoapHeaders($header);
		// Soap Header End

   		//Soap Body Begin
   		$xmlParams = '<request>
   						<locale country="tr" datCountryIndicator="tr" language="tr"/>
   						<coverage>SIMPLE</coverage>
   						<datECode>'.$datCarId.'</datECode>
   						<contructionTime>'.$consTime.'</contructionTime>
			            <sessionID>'.$datToken.'</sessionID>';

		foreach ($dvns as $key => $val) {
			$xmlParams .= '<intPartNo>'.$val.'</intPartNo>';
		}

		$xmlParams .= '</request>';


		$params = new \SoapVar($xmlParams, XSD_ANYXML);
		//Soap Body End

		//Soap Method Call
		/*
			pre($params);
			prex($client);
		*/
			try {
				$q = $client->getExtPartNoInfoByFullVehicleAndIntPartNo($params);
			} catch (Exception $e) {
				return false;
			}
		//prex($client->__getLastRequest());

		return $q;
	}

	public function getVinRequest($vin = '')
	{
		if (strlen(trim($vin)) != 17) {
			return false;
		}

		$newVin = substr($vin, 0,9);

		$this->db->where(array('vin' => $newVin));
		$q = $this->db->get('vin_cache');
		if ($q->num_rows() > 0) {
			$q = $q->row();
			return json_decode($q->detail);
		}



		$datToken = $this->getToken();
		$loginData = $this->getLoginData();

		$client = new SoapClient(
		    null,
		    array(
		        'location' => 'https://www.dat.de/DATECodeSelection/services/VehicleIdentificationService?wsdl',
		        'uri' => 'https://www.dat.de/DATECodeSelection/services/VehicleIdentificationService?wsdl',
		        'trace' => 1,
		        'use' => SOAP_LITERAL,
		        'stream_context' => stream_context_create(
	            array(
	                	'http' => array(
		                    'protocol_version' => 1.0,
		                )
    				)
		   	 	)
		    )
		);

		// Soap Header Begin
    	$headerParam = new SoapVar($loginData, XSD_ANYXML, NULL, NULL, NULL, NULL);

    	$header = new SoapHeader( 'http://sphinx.dat.de/services/VehicleIdentificationService', 'Header', $headerParam );
   		$client->__setSoapHeaders($header);
		// Soap Header End

   		//Soap Body Begin
   		$soapVar = '
		<request>
            <locale country="tr" datCountryIndicator="tr" language="tr"/>
            <sessionID>'.$datToken.'</sessionID>
			<coverage>ALL</coverage>
            <restriction>ALL</restriction>
            <vin>'.$vin.'</vin>';
		$soapVar .= '</request>';
		$params = new \SoapVar($soapVar, XSD_ANYXML);
		//Soap Body End

		//pre($headerParam);
		//prex($soapVar);


		//Soap Method Call
		$client->getVehicleIdentificationByVin($params);
		$response 	= $client->__getLastResponse();
		//prex($client->__getLastRequest());


		$response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $response);
		$xml = new SimpleXMLElement($response);
		$body = $xml->xpath('//SBody')[0];
		$lastResult = json_decode(json_encode((array)$body), TRUE); 

		//prex(($lastResult));

		$result = array();
		foreach ($lastResult as $key => $val) {
			foreach ($val as $key2 => $val2) {
				foreach ($val2 as $key3 => $val3) {
					foreach ($val3 as $key4 => $val4) {
						
						$result[] = array('ns1DatECode' => $val4['ns1Vehicle']['ns1DatECode'] ?? '' , 
										  'ns1ConstructionTimeFrom' => $val4['ns1Vehicle']['ns1ConstructionTimeFrom'] ?? '' ,
										  'ns1ConstructionTimeTo' => $val4['ns1Vehicle']['ns1ConstructionTimeTo'] ?? '' ,
										  'ns1ManufacturerName' => $val4['ns1Vehicle']['ns1ManufacturerName'] ?? '' ,
										  'ns1ContainerName' => $val4['ns1Vehicle']['ns1ContainerName'] ?? '' ,
										  'ns1BaseModelName' => $val4['ns1Vehicle']['ns1BaseModelName'] ?? '' ,
										  'ns1SubModelName' => $val4['ns1Vehicle']['ns1SubModelName'] ?? '' ,
										  'ns1VehicleType' => $val4['ns1Vehicle']['ns1VehicleType'] ?? '' ,
										  'ns1Manufacturer' => $val4['ns1Vehicle']['ns1Manufacturer'] ?? '' ,
										  'ns1BaseModel' => $val4['ns1Vehicle']['ns1BaseModel'] ?? '' ,
										  'ns1SubModel' => $val4['ns1Vehicle']['ns1SubModel'] ?? '' ,
										  'equipment' => $val4['ns1Vehicle']['ns1DATECodeEquipment']['ns1EquipmentPosition'] ?? '' ,
										);

						//$result[] = $val4;
					}
				}
			}
		}

		$hasResult = (object)array('motor' => array(), 'govde' => array(), 'sanziman' => array(),'model' => array(), 'altModel' => array(),'marka' => array(),'aks' => array(),'tahrik' => array(), 'dizayn' => array());
		//prex($result);

		$rs = array();
		foreach ($result as $key => $val) {
			if ($val['ns1ConstructionTimeFrom'] != '') {
				$rs[] = $val;
			}
		}
		$result = $rs;

		foreach ($result as $key => $val) {
			//prex($val);
			if ($hasResult->motor == array()) {
				foreach ($val['equipment'] as $key5 => $val5) {
					if ($val5['ns1EquipmentClass'] == 1) {
						$hasResult->motor[] = $val5;
					}
				}
			}else{
				$i = 0;
				foreach ($hasResult->motor as $key2 => $val2) {
					foreach ($val['equipment'] as $key5 => $val5) {
						if ($val5['ns1EquipmentClass'] == 1) {
							if ($val5['ns1DatEquipmentId'] == $val2['ns1DatEquipmentId']) {
								$i++;
							}
						}
					}
				}
				if ($i == 0) {
					foreach ($val['equipment'] as $key5 => $val5) {
						if ($val5['ns1EquipmentClass'] == 1) {
							$hasResult->motor[] = $val5;
						}
					}
				}
			}


			if ($hasResult->govde == array()) {
				foreach ($val['equipment'] as $key5 => $val5) {
					if ($val5['ns1EquipmentClass'] == 2) {
						$hasResult->govde[] = $val5;
					}
				}
			}else{
				$i = 0;
				foreach ($hasResult->govde as $key2 => $val2) {
					foreach ($val['equipment'] as $key5 => $val5) {
						if ($val5['ns1EquipmentClass'] == 2) {
							if ($val5['ns1DatEquipmentId'] == $val2['ns1DatEquipmentId']) {
								$i++;
							}
						}
					}
				}
				if ($i == 0) {
					foreach ($val['equipment'] as $key5 => $val5) {
						if ($val5['ns1EquipmentClass'] == 2) {
							$hasResult->govde[] = $val5;
						}
					}
				}
			}


			if ($hasResult->sanziman == array()) {
				foreach ($val['equipment'] as $key5 => $val5) {
					if ($val5['ns1EquipmentClass'] == 11) {
						$hasResult->sanziman[] = $val5;
					}
				};
			}else{
				$i = 0;
				foreach ($hasResult->sanziman as $key2 => $val2) {
					foreach ($val['equipment'] as $key5 => $val5) {
						if ($val5['ns1EquipmentClass'] == 11) {
							if ($val5['ns1DatEquipmentId'] == $val2['ns1DatEquipmentId']) {
								$i++;
							}
						}
					}
				}
				if ($i == 0) {
					foreach ($val['equipment'] as $key5 => $val5) {
						if ($val5['ns1EquipmentClass'] == 11) {
							$hasResult->sanziman[] = $val5;
						}
					}
				}
			}

			if ($hasResult->aks == array()) {
				foreach ($val['equipment'] as $key5 => $val5) {
					if ($val5['ns1EquipmentClass'] == 3) {
						$hasResult->aks[] = $val5;
					}
				};
			}else{
				$i = 0;
				foreach ($hasResult->aks as $key2 => $val2) {
					foreach ($val['equipment'] as $key5 => $val5) {
						if ($val5['ns1EquipmentClass'] == 3) {
							if ($val5['ns1DatEquipmentId'] == $val2['ns1DatEquipmentId']) {
								$i++;
							}
						}
					}
				}
				if ($i == 0) {
					foreach ($val['equipment'] as $key5 => $val5) {
						if ($val5['ns1EquipmentClass'] == 3) {
							$hasResult->aks[] = $val5;
						}
					}
				}
			}


			if ($hasResult->tahrik == array()) {
				foreach ($val['equipment'] as $key5 => $val5) {
					if ($val5['ns1EquipmentClass'] == 4) {
						$hasResult->tahrik[] = $val5;
					}
				};
			}else{
				$i = 0;
				foreach ($hasResult->tahrik as $key2 => $val2) {
					foreach ($val['equipment'] as $key5 => $val5) {
						if ($val5['ns1EquipmentClass'] == 4) {
							if ($val5['ns1DatEquipmentId'] == $val2['ns1DatEquipmentId']) {
								$i++;
							}
						}
					}
				}
				if ($i == 0) {
					foreach ($val['equipment'] as $key5 => $val5) {
						if ($val5['ns1EquipmentClass'] == 4) {
							$hasResult->tahrik[] = $val5;
						}
					}
				}
			}

			if ($hasResult->dizayn == array()) {
				foreach ($val['equipment'] as $key5 => $val5) {
					if ($val5['ns1EquipmentClass'] == 10) {
						$hasResult->dizayn[] = $val5;
					}
				};
			}else{
				$i = 0;
				foreach ($hasResult->dizayn as $key2 => $val2) {
					foreach ($val['equipment'] as $key5 => $val5) {
						if ($val5['ns1EquipmentClass'] == 10) {
							if ($val5['ns1DatEquipmentId'] == $val2['ns1DatEquipmentId']) {
								$i++;
							}
						}
					}
				}
				if ($i == 0) {
					foreach ($val['equipment'] as $key5 => $val5) {
						if ($val5['ns1EquipmentClass'] == 10) {
							$hasResult->dizayn[] = $val5;
						}
					}
				}
			}



			if ($hasResult->model == array()) {
				$hasResult->model[] = array('id' => $val['ns1BaseModel'], 'name' => $val['ns1BaseModelName']);
			}else{
				$i = 0;
				foreach ($hasResult->model as $key2 => $val2) {
					if ($val['ns1BaseModel'] == $val2['id']) {
						$i++;
					}
				}
				if ($i == 0) {
					$hasResult->model[] = array('id' => $val['ns1BaseModel'], 'name' => $val['ns1BaseModelName']);
				}
			}


			if ($hasResult->altModel == array()) {
				$hasResult->altModel[] = array('id' => $val['ns1SubModel'], 'name' => $val['ns1SubModelName']);
			}else{
				$i = 0;
				foreach ($hasResult->altModel as $key2 => $val2) {
					if ($val['ns1SubModel'] == $val2['id']) {
						$i++;
					}
				}
				if ($i == 0) {
					$hasResult->altModel[] = array('id' => $val['ns1SubModel'], 'name' => $val['ns1SubModelName']);
				}
			}

			if ($hasResult->marka == array()) {
				$hasResult->marka[] = array('id' => $val['ns1Manufacturer'], 'name' => $val['ns1ManufacturerName']);
			}else{
				$i = 0;
				foreach ($hasResult->marka as $key2 => $val2) {
					if ($val['ns1Manufacturer'] == $val2['id']) {
						$i++;
					}
				}
				if ($i == 0) {
					$hasResult->marka[] = array('id' => $val['ns1Manufacturer'], 'name' => $val['ns1ManufacturerName']);
				}
			}
		}

		//prex($hasResult);
		$res = new StdClass;
		$res 			= $hasResult;
		$res->result 	= $result;

		usort($res->motor, function($a, $b) {
		    return $a['ns1Description'] <=> $b['ns1Description'];
		});

		usort($res->govde, function($a, $b) {
		    return $a['ns1Description'] <=> $b['ns1Description'];
		});

		usort($res->sanziman, function($a, $b) {
		    return $a['ns1Description'] <=> $b['ns1Description'];
		});

		usort($res->model, function($a, $b) {
		    return $a['name'] <=> $b['name'];
		});
		usort($res->altModel, function($a, $b) {
		    return $a['name'] <=> $b['name'];
		});
		usort($res->marka, function($a, $b) {
		    return $a['name'] <=> $b['name'];
		});
		usort($res->aks, function($a, $b) {
		    return $a['ns1Description'] <=> $b['ns1Description'];
		});
		usort($res->tahrik, function($a, $b) {
		    return $a['ns1Description'] <=> $b['ns1Description'];
		});
		usort($res->dizayn, function($a, $b) {
		    return $a['ns1Description'] <=> $b['ns1Description'];
		});


		$this->db->set(array('vin' => $newVin, 'detail' => json_encode($res)));
		$this->db->insert('vin_cache');
		return $res;
	}

}?>