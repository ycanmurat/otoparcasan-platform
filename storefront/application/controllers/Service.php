<?php 
/**
 * 
 */
class Service extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Dat_model','dat');
        $this->load->model('Category_model','cat');
		$this->load->model('Service_model','SM');
	}

    public function addCarData()
    {
        $carSelectDetail = $this->getAllPosts();

        $this->db->insert('carDetail',$carSelectDetail);
        echo 'OK';
    }

	public function getTypes()
	{
        $data->list = array_optimize($this->dat->getCarMarks());
        $data->dbList = $this->SM->getCarTypes();

        $newAry = array();
        foreach ($data->list as $key => $val) {
            $i = 0;
            foreach ($data->dbList as $key2 => $val2) {
                if ($val->key == $val2->key) {
                    $i++;
                    $newAry[] = $val2;
                }
            }
            if ($i == 0) {
                $val->status    = 1;
                $val->popular   = 0;
                $val->icon      = '';
                $newAry[] = $val;
            }
        }
		echo json_encode($newAry);
	}

	public function getBrands($type = '',$year = '')
	{
		if ($type>0 AND $type<6) {
            $data = new StdClass;
            $data->list = array_optimize($this->dat->getBrands($type));
            $data->dbList = $this->SM->getCarBrands($type);

            $newAry = array();
            foreach ($data->list as $key => $val) {
                $i = 0;
                foreach ($data->dbList as $key2 => $val2) {
                    if ($val->key == $val2->key) {
                        $i++;
                        $newAry[] = $val2;
                    }
                }
                if ($i == 0) {
                    $val->status    = 1;
                    $val->popular   = 0;
                    $val->icon      = '';
                    $newAry[] = $val;
                }
            }
			echo json_encode($newAry);
		}else{
			echo 'error';
		}
	}

	public function getModels($type = '',$brand = '',$year = '')
	{
		if ($type>0 AND $type<6) {
            $data = new StdClass;
            $data->list = array_optimize($this->dat->getModels($type,$brand));
            $data->dbList = $this->SM->getCarModels($type,$brand);

            $newAry = array();
            foreach ($data->list as $key => $val) {
                $i = 0;
                foreach ($data->dbList as $key2 => $val2) {
                    if ($val->key == $val2->key) {
                        $i++;
                        $newAry[] = $val2;
                    }
                }
                if ($i == 0) {
                    $val->status    = 1;
                    $val->popular   = 0;
                    $val->icon      = '';
                    $newAry[] = $val;
                }
            }
            usort($newAry, function($a, $b) {
                return $a->value <=> $b->value;
            });
            echo json_encode($newAry);
		}else{
			echo 'error';
		}
	}

	public function getSubModels($type = '',$brand = '',$model = '',$year ='')
	{
		if ($type>0 AND $type<6 AND $brand != '' AND $model != '') {
            $data = new StdClass;
            $data->list = array_optimize($this->dat->getSubModels($type,$brand,$model));
            $data->dbList = $this->SM->getCarSubModels($type,$brand,$model);

            $newAry = array();
            foreach ($data->list as $key => $val) {
                $i = 0;
                foreach ($data->dbList as $key2 => $val2) {
                    if ($val->key == $val2->key) {
                        $i++;
                        $newAry[] = $val2;
                    }
                }
                if ($i == 0) {
                    $val->status    = 1;
                    $val->popular   = 0;
                    $val->icon      = '';
                    $newAry[] = $val;
                }
            }
            usort($newAry, function($a, $b) {
                return $a->value <=> $b->value;
            });
            echo json_encode($newAry);
		}else{
			echo 'error';
		}
	}

	public function getEngine($type = '',$brand = '',$model = '',$subModel = '')
	{
		if ($type>0 AND $type<6 AND $brand != '' AND $model != '') {
			$this->dat->getEngine($type,$brand,$model,$subModel);
		}else{
			echo 'error';
		}
	}

	public function getOptions($type,$brand,$model,$subModel,$year = '')
	{
		$data = $this->dat->getOptions($type,$brand,$model,$subModel,$year);
		echo json_encode($data);
	}

	public function getCarId()
	{
		if ($this->input->post()) {
			$data = $this->getAllPosts();
			$data = $this->dat->getCarId($data);
			echo json_encode($data);
		}
	}

	public function getConsTime($carId)
	{
		$data = $this->dat->getConsTime($carId);
		echo json_encode($data);
	}

	public function getChangedOptions()
	{
		$posts = $this->getAllPosts();

		$data = $this->dat->getChangedOptions($posts);
		echo json_encode($data);
	}

	public function addGarrage()
	{
		$posts = $this->getAllPosts();
		$this->load->model('Garage_model');

        $result = $this->Garage_model->addGarrage($posts);
		if ($result == 1) {
            $this->session->set_flashdata('addingGarrage',1);
			echo 'OK';
		}elseif ($result == 2) {
            echo 'Usr';
        }else{
			echo 'Err';
		}
	}

	public function deleteGarageCar($id = '')
	{
		$this->load->model('Garage_model');
		if ($id == '') {
			echo 'ERR';
		}else{
			if ($this->Garage_model->deleteGarageCar($id)) {
				echo 'OK';
			}else{
				echo 'ERR';
			}
		}
	}

	public function getVinSearch($vin)
	{
		$this->load->model('Garage_model');

		$data = $this->dat->getVinRequest($vin);
        //prex($data);
        if ($data['status'] == 'true') {
            if (is_array($data['data']->result[0])) {
                $data['data']->image    =  $this->Garage_model->getCarImage($data['data']->result[0]['VehicleType'],$data['data']->result[0]['Manufacturer'],$data['data']->result[0]['BaseModel']);
            }else{
                $data['data']->image    =  $this->Garage_model->getCarImage($data['data']->result[0]->VehicleType,$data['data']->result[0]->Manufacturer,$data['data']->result[0]->BaseModel);
            }
        }
		echo json_encode($data);
	}
}
?>