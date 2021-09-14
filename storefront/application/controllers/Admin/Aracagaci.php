<?php 
/**
 * 
 */
class Aracagaci extends Core_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Dat_model','dat');
        $this->load->model('Admin/Agac_model');
    }

    public function index()
    {
        $data = new StdClass;
        $data->mainMenu = 'Aracagaci';
        $data->subMenu = 'aracagaci';

        $data->types = $this->dat->getCarMarks();

        //prex($data->types);
        $ifdata = $data->types;
        $ifdata = (array)$ifdata[0];
        //prex($ifdata);
        if (count($ifdata) == 2) {
            $data->first = true;
        }else{
            $data->first = false;
        }

        $this->load->view('Admin/header', $data);
        $this->load->view('Admin/aracagaci');
        $this->load->view('Admin/footer');
    }

    public function list()
    {
        $data = new StdClass;
        $data->mainMenu = 'Aracagaci';
        $data->subMenu = 'aracagaci';
        $postData = $this->getAllPosts();


        if (isset($postData->carType) && $postData->carType == 0) {
            $data->list = array_optimize($this->dat->getCarMarks());
            $data->dbList = $this->Agac_model->getCarTypes();
        }elseif (isset($postData->carBrands) && $postData->carBrands == 0) {
            $data->brand = 1;
            $data->list = array_optimize($this->dat->getBrands($postData->carType));
            $data->dbList = $this->Agac_model->getCarBrands($postData->carType);
        }elseif (isset($postData->carModels) && $postData->carModels == 0) {
            $data->image = 1;
            $data->noneIcon = 1;
            $data->images = $this->Agac_model->getCarImagesByBrand($postData->carType,$postData->carBrands);
            foreach ($data->images as $key => $val) {
                $data->images[$key]->img = json_decode($val->img,true);
                ksort($data->images[$key]->img);
            }
            $data->list = array_optimize($this->dat->getModels($postData->carType,$postData->carBrands));
            $data->dbList = $this->Agac_model->getCarModels($postData->carType,$postData->carBrands);
        }else{
            $data->noneIcon = 1;
            $data->list = array_optimize($this->dat->getSubModels($postData->carType,$postData->carBrands,$postData->carModels));
            $data->dbList = $this->Agac_model->getCarSubModels($postData->carType,$postData->carBrands,$postData->carModels);
        }

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
        $data->list = $newAry;
        

        $data->selects = $postData;

        //prex($data);

        $this->load->view('Admin/header', $data);
        $this->load->view('Admin/aracagaciEdit');
        $this->load->view('Admin/footer');
    }

    
    public function image($type = '',$brand = '',$model = '',$sort = '')
    {
        $data = new StdClass;
        $data->type     = $type;
        $data->brand    = $brand;
        $data->model    = $model;

        $img = $this->Agac_model->getCarImagesById($type,$brand,$model);
        $image = array();
        if ($img != false) {
            $image = json_decode($img->img,true);
        }
        if ($type != '' && $brand != '' && $model != '') {
            $data->img = $this->uploadImage($_FILES['file']);
            if ($data->img == false) {
                $this->output->set_status_header('404'); 
                echo 'Fotoğraf Yüklenemedi Sorun Dosya Tipinizde veya Boyutunuzda';
            }else{
                $image[$sort] = $data->img;
                $data->img = json_encode($image);
                if ($this->Agac_model->addImage($data)) {
                    echo 'Yükleme Tamamlandı';
                }else{
                    $this->output->set_status_header('404'); 
                    echo 'Fotoğraf Yüklenemedi';
                }
            }
        }else{
            $this->output->set_status_header('404'); 
                echo 'Fotoğraf Yüklenemedi';
        }
    }
    

    public function add()
    {
        $data = new StdClass;
        $data->mainMenu = 'Aracagaci';
        $data->subMenu = 'aracagaci';
        $postData = $this->getAllPosts();

        $file = array();
        if (isset($_FILES['file'])) {
            $file = $_FILES['file'];
        }
        $file = reverseArray($file);

        $pfile = array();
        foreach ($file as $key => $val) {
            $asd = $this->uploadImage($val);
            if ($asd != false) {
                $pfile[$key] = $asd;
            }
        }
        if ($postData->carType == 0) {
            $reverseData = array('value' => $postData->list,'key' =>$postData->key,'status' => $postData->status,'icon' => $pfile);
        }elseif ($postData->carBrands == 0) {
            $reverseData = array('value' => $postData->list,'key' =>$postData->key,'status' => $postData->status,'icon' => $pfile,'popular' => $postData->popular);
        }elseif ($postData->carModels == 0) {
            $reverseData = array('value' => $postData->list,'key' =>$postData->key,'status' => $postData->status);
        }else{
            $reverseData = array('value' => $postData->list,'key' =>$postData->key,'status' => $postData->status);
        }



        $rarray = array_optimize(reverseArray($reverseData));
        $ary = array();
        foreach ($rarray as $key => $val) {
            if (!isset($val->icon)) {
                $val->icon = $postData->icon[$key] ?? '';
            }
            if (isset($val->status)) {
                $val->status = 1;
            }else{
                $val->status = 0;
            }

            if (isset($val->popular)) {
                $val->popular = 1;
            }else{
                $val->popular = 0;
            }
            $ary[] = $val;
        }

        unset($postData->list);
        unset($postData->popular);
        unset($postData->status);
        unset($postData->icon);
        unset($postData->key);
        unset($postData->popular);

        //prex($postData);

        $postData->list = json_encode($ary);
        $this->Agac_model->addEditData($postData);

        redirect(admin_url('Aracagaci'));
    }

    public function yagagaci()
    {
        $data = new StdClass;
        $data->mainMenu = 'Aracagaci';
        $data->subMenu = 'aracYagAgaci';

        $data->types = $this->dat->getCarMarks();

        //prex($data->types);
        $ifdata = $data->types;
        $ifdata = (array)$ifdata[0];
        //prex($ifdata);
        if (count($ifdata) == 2) {
            $data->first = true;
        }else{
            $data->first = false;
        }


        $this->load->view('Admin/header', $data);
        $this->load->view('Admin/aracYagAgaci');
        $this->load->view('Admin/footer');
    }

    public function yagEkle($type = 0,$brand = 0,$model = 0,$subModel = 0)
    {
        $data = new StdClass;
        $data->mainMenu = 'Aracagaci';
        $data->subMenu = 'aracYagAgaci';

        if ($type == 0 || $brand == 0 || $model == 0 || $subModel == 0) {
            redirect(admin_url('Aracagaci/yagagaci'));
        }

        $data->carType      = $type;
        $data->carBrand     = $brand;
        $data->carModel     = $model;
        $data->carSubModel  = $subModel;


        $data->result   = array_optimize($this->dat->getEngine($type,$brand,$model,$subModel));

        $engineKeys = array();
        foreach ($data->result as $key => $val) {
            $engineKeys[] = $val->key;
        }

        $data->ekli     = array_optimize($this->Agac_model->getOils($engineKeys));

        foreach ($data->result as $key => $val) {
            $i = 0;
            foreach ($data->ekli as $key2 => $val2) {
                if ($val->key == $val2->engine) {
                    $data->result[$key]->added = $val2;
                    $i++;
                }
            }
            if ($i == 0) {
                $data->result[$key]->added = false;
            }
        }

        //prex($data->result);

        $this->load->view('Admin/header', $data);
        $this->load->view('Admin/aracYagAgaciEdit');
        $this->load->view('Admin/footer');
    }

    public function yagAdd()
    {
        $data = new StdClass;

        $data->post = $this->getAllPosts();

        $data->post = reverseArray($data->post);

        $this->Agac_model->addOil($data->post);
        redirect($this->agent->referrer());
    }
}
?>