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

    //private $link = 'https://api.otoparcasan.com/Service/';
    private $link = 'http://b2b.otosesli.com/api/index.php/Service/';
    //private $link = $this->link.'';

	public function getCategories()
	{
		$ch = curl_init();
		$curlConfig = array(
            CURLOPT_URL            => $this->link."getCategories",
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
		    CURLOPT_URL            => $this->link."getCategoryById/".$id,
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
		    CURLOPT_URL            => $this->link."getSubCategoriDetailById/".$id,
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
		    CURLOPT_URL            => $this->link."getProductsByOem/",
		    CURLOPT_POST           => true,
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_POSTFIELDS     => $oems
		);

		curl_setopt_array($ch, $curlConfig);
		$result = curl_exec($ch);
		curl_close($ch);
		//prex($result);
		return json_decode($result);
	}

    public function getProductsByOemFilter($oems='')
    {
        $ch = curl_init();
        $curlConfig = array(
            CURLOPT_URL            => $this->link."getProductsByOemFilter/",
            CURLOPT_POST           => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS     => $oems
        );

        curl_setopt_array($ch, $curlConfig);
        $result = curl_exec($ch);
        curl_close($ch);
        //prex($result);
        return json_decode($result);
    }

    public function getProductsByKod3Filter($kod3,$filter)
    {
        $ch = curl_init();
        $curlConfig = array(
            CURLOPT_URL            => $this->link."getProductsByKod3Filter/",
            CURLOPT_POST           => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS     => array('kod3' => $kod3,'filter' => json_encode($filter))
        );

        curl_setopt_array($ch, $curlConfig);
        $result = curl_exec($ch);
        curl_close($ch);
        //prex($result);
        return json_decode($result);
    }

    public function getProductsDetailByKod($url='')
    {
        $ch = curl_init();
        $curlConfig = array(
            CURLOPT_URL            => $this->link."getProductsDetailByKod/",
            CURLOPT_POST           => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS     => array('url' => $url)
        );

        curl_setopt_array($ch, $curlConfig);
        $result = curl_exec($ch);
        curl_close($ch);
        //prex($result);
        return json_decode($result);
    }

    public function getProductsDetailByKodCargoTime($url='')
    {
        $ch = curl_init();
        $curlConfig = array(
            CURLOPT_URL            => $this->link."getProductsDetailByKodCargoTime/",
            CURLOPT_POST           => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS     => array('url' => $url)
        );

        curl_setopt_array($ch, $curlConfig);
        $result = curl_exec($ch);
        curl_close($ch);
        //prex($result);
        return json_decode($result);
    }

	public function getTopCategoriDetailById($id = '')
	{
		$ch = curl_init();
		$curlConfig = array(
		    CURLOPT_URL            => $this->link."getTopCategoriDetailById/".$id,
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

    public function getBrands()
    {
        $ch = curl_init();
        $curlConfig = array(
            CURLOPT_URL            => $this->link."getBrands/",
            CURLOPT_POST           => false,
            CURLOPT_RETURNTRANSFER => true
        );

        curl_setopt_array($ch, $curlConfig);
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result);
        
    }

	public function getBrandsById($id)
	{
		$ch = curl_init();
		$curlConfig = array(
		    CURLOPT_URL            => $this->link."getBrandsById/".$id,
		    CURLOPT_POST           => false,
		    CURLOPT_RETURNTRANSFER => true
		);

		curl_setopt_array($ch, $curlConfig);
		$result = curl_exec($ch);
		curl_close($ch);
		return json_decode($result);
	}

	public function getTedarikci()
	{
		$ch = curl_init();
		$curlConfig = array(
		    CURLOPT_URL            => $this->link."getTedarikci/",
		    CURLOPT_POST           => false,
		    CURLOPT_RETURNTRANSFER => true
		);

		curl_setopt_array($ch, $curlConfig);
		$result = curl_exec($ch);
		curl_close($ch);
		return json_decode($result);
	}

	public function getTimes($id)
	{
		$ch = curl_init();
		$curlConfig = array(
		    CURLOPT_URL            => $this->link."getKargoTimes/".$id,
		    CURLOPT_POST           => false,
		    CURLOPT_RETURNTRANSFER => true
		);

		curl_setopt_array($ch, $curlConfig);
		$result = curl_exec($ch);
		curl_close($ch);
		return json_decode($result);
	}

	public function addKargoTime($data,$id)
	{
		$ch = curl_init();
		$curlConfig = array(
		    CURLOPT_URL            => $this->link."addKargoTime/",
		    CURLOPT_POST           => true,
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_POSTFIELDS     => array(
		        'data' 	=> json_encode($data),
		        'id' 	=> $id
		    )
		);

		curl_setopt_array($ch, $curlConfig);
		$result = curl_exec($ch);
		curl_close($ch);

		//prex($result);
		return json_decode($result);
	}

	public function getAllCampainData()
	{
		$ch = curl_init();
		$curlConfig = array(
		    CURLOPT_URL            => $this->link."getAllCampainData/",
		    CURLOPT_POST           => false,
		    CURLOPT_RETURNTRANSFER => true
		);

		curl_setopt_array($ch, $curlConfig);
		$result = curl_exec($ch);
		curl_close($ch);
		return json_decode($result);
	}

	public function getServiceProblemProduct()
	{
		$ch = curl_init();
		$curlConfig = array(
		    CURLOPT_URL            => $this->link."getServiceProblemProduct/",
		    CURLOPT_POST           => false,
		    CURLOPT_RETURNTRANSFER => true
		);

		curl_setopt_array($ch, $curlConfig);
		$result = curl_exec($ch);
		curl_close($ch);
		return json_decode($result);
	}

    public function issetProduduct($data)
    {
        $ch = curl_init();
        $curlConfig = array(
            CURLOPT_URL            => $this->link."issetProduduct/",
            CURLOPT_POST           => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS     => array(
                'data'  => json_encode($data)
            )
        );

        curl_setopt_array($ch, $curlConfig);
        $result = curl_exec($ch);
        curl_close($ch);

        //prex($result);
        return json_decode($result);
    }

    public function refreshCart($data)
    { 
        $ch = curl_init();
        $curlConfig = array(
            CURLOPT_URL            => $this->link."refreshCart/",
            CURLOPT_POST           => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS     => array(
                'data'  => json_encode($data)
            )
        );

        curl_setopt_array($ch, $curlConfig);
        $result = curl_exec($ch);
        curl_close($ch);

        //prex($result);
        return json_decode($result);
    }

    public function getProductsSearch($filter)
    {
        $ch = curl_init();
        $curlConfig = array(
            CURLOPT_URL            => $this->link."getProductsSearch/",
            CURLOPT_POST           => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS     => array(
                'filter' => json_encode($filter)
            )
        );

        curl_setopt_array($ch, $curlConfig);
        $result = curl_exec($ch);
        curl_close($ch);
        //prex($result);
        return json_decode($result);
    }

    public function kod3Filter($kod3,$filter)
    {
        $ch = curl_init();
        $curlConfig = array(
            CURLOPT_URL            => $this->link."kod3Filter/",
            CURLOPT_POST           => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS     => array('kod3' => $kod3,'filter' => json_encode($filter))
        );

        curl_setopt_array($ch, $curlConfig);
        $result = curl_exec($ch);
        curl_close($ch);
        //prex($result);
        return json_decode($result);
    }

    public function searchFilter($key,$filter)
    {
        $ch = curl_init();
        $curlConfig = array(
            CURLOPT_URL            => $this->link."searchFilter/",
            CURLOPT_POST           => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS     => array(
                'key'  => json_encode($key),
                'filter' => json_encode($filter)
            )
        );

        curl_setopt_array($ch, $curlConfig);
        $result = curl_exec($ch);
        curl_close($ch);
        //prex($result);
        return json_decode($result);
    }

    public function getProductsSearchByFilter($key)
    {
        $ch = curl_init();
        $curlConfig = array(
            CURLOPT_URL            => $this->link."getProductsSearch/",
            CURLOPT_POST           => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS     => array(
                'key'  => json_encode($key)
            )
        );

        curl_setopt_array($ch, $curlConfig);
        $result = curl_exec($ch);
        curl_close($ch);
        //prex($result);
        return json_decode($result);
    }

    public function getBrandsByIds($data)
    {
        $ch = curl_init();
        $curlConfig = array(
            CURLOPT_URL            => $this->link."getBrandsByIds/",
            CURLOPT_POST           => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS     => array('key' => json_encode($data))
        );

        curl_setopt_array($ch, $curlConfig);
        $result = curl_exec($ch);
        //prex($result);
        curl_close($ch);
        return json_decode($result);
        
    }

    public function getMontajNames($key)
    {
        $ch = curl_init();
        $curlConfig = array(
            CURLOPT_URL            => $this->link."getMontajNames/",
            CURLOPT_POST           => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS     => array(
                'key'  => json_encode($key)
            )
        );

        curl_setopt_array($ch, $curlConfig);
        $result = curl_exec($ch);
        curl_close($ch);
        //prex($result);
        return json_decode($result);
    }

    public function getOtoBakimVeYaglar()
    {
        $ch = curl_init();
        $curlConfig = array(
            CURLOPT_URL            => $this->link."getOtoBakimVeYaglar/",
            CURLOPT_POST           => false,
            CURLOPT_RETURNTRANSFER => true
        );

        curl_setopt_array($ch, $curlConfig);
        $result = curl_exec($ch);
        curl_close($ch);
        //prex($result);
        return json_decode($result);
    }

    public function getProductsByKod3($kod3,$filter)
    {
        $ch = curl_init();
        $curlConfig = array(
            CURLOPT_URL            => $this->link."getProductsByKod3/".$kod3,
            CURLOPT_POST           => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS     => array(
                'filter'  => json_encode($filter)
            )
        );

        curl_setopt_array($ch, $curlConfig);
        $result = curl_exec($ch);
        curl_close($ch);
        //prex($result);
        return json_decode($result);
    }
}
?>