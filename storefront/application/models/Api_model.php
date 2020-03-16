<?php 
/**
 * 
 */
class Api_model extends Core_model
{
	function __construct()
	{
		parent::__construct();
	}

	public function getCategories()
	{
		$ch = curl_init();
		$curlConfig = array(
		    CURLOPT_URL            => "https://otoparcasan.kodakil.com/api/Service/getCategories",
		    CURLOPT_POST           => true,
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_POSTFIELDS     => array(
		        'field1' => 'some date',
		        'field2' => 'some other data',
		    )
		);

		curl_setopt_array($ch, $curlConfig);
		$result = curl_exec($ch);
		curl_close($ch);
		return json_decode($result);

	}

	public function getCategoriesById($id = '')
	{
		$ch = curl_init();
		$curlConfig = array(
		    CURLOPT_URL            => "https://otoparcasan.kodakil.com/api/Service/getCategoryById/".$id,
		    CURLOPT_POST           => true,
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_POSTFIELDS     => array(
		        'field1' => 'some date',
		        'field2' => 'some other data',
		    )
		);

		curl_setopt_array($ch, $curlConfig);
		$result = curl_exec($ch);
		curl_close($ch);
		return json_decode($result);
	}

	public function getSubCategoriDetailById($id = '')
	{
		$ch = curl_init();
		$curlConfig = array(
		    CURLOPT_URL            => "https://otoparcasan.kodakil.com/api/Service/getSubCategoriDetailById/".$id,
		    CURLOPT_POST           => true,
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_POSTFIELDS     => array(
		        'field1' => 'some date',
		        'field2' => 'some other data',
		    )
		);

		curl_setopt_array($ch, $curlConfig);
		$result = curl_exec($ch);
		curl_close($ch);
		return json_decode($result);
	}

	public function getProductsByOem($oems = [])
	{
		$ch = curl_init();
		$curlConfig = array(
		    CURLOPT_URL            => "https://otoparcasan.kodakil.com/api/Service/getProductsByOem/",
		    CURLOPT_POST           => true,
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_POSTFIELDS     => $oems
		);

		curl_setopt_array($ch, $curlConfig);
		$result = curl_exec($ch);
		curl_close($ch);
		return json_decode($result);
	}

	public function getProductsDetailByKod($stokKodu='')
	{
		$ch = curl_init();
		$curlConfig = array(
		    CURLOPT_URL            => "https://otoparcasan.kodakil.com/api/Service/getProductsDetailByKod/",
		    CURLOPT_POST           => true,
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_POSTFIELDS     => array('stokKodu' => $stokKodu)
		);

		curl_setopt_array($ch, $curlConfig);
		$result = curl_exec($ch);
		curl_close($ch);
		return json_decode($result);
	}

	public function getTopCategoriDetailById($id = '')
	{
		$ch = curl_init();
		$curlConfig = array(
		    CURLOPT_URL            => "https://otoparcasan.kodakil.com/api/Service/getTopCategoriDetailById/".$id,
		    CURLOPT_POST           => true,
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_POSTFIELDS     => array(
		        'field1' => 'some date',
		        'field2' => 'some other data',
		    )
		);

		curl_setopt_array($ch, $curlConfig);
		$result = curl_exec($ch);
		curl_close($ch);
		return json_decode($result);
	}
}
?>