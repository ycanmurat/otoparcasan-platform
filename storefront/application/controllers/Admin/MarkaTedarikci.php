<?php 
/**
 * 
 */
class MarkaTedarikci extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		//$this->load->model('Dat_model','dat');
		$this->load->model('Admin/Marka_model');
		$this->load->model('Api_model');
	}

	public function tedarikci()
	{
		$data = new StdClass;
		$data->mainMenu 	= 'Tedarikci';
		$data->subMenu  	= 'Tedarikci';

		$tedarikci = $this->Api_model->getTedarikci();
		$dbTedarikci = $this->Marka_model->getTedarikci();

		//prex($tedarikci);
		$data->tedarikci = array();
		foreach ($tedarikci as $key => $val) {
			foreach ($dbTedarikci as $key2 => $val2) {
				if ($val->CARI_KOD == $val2->cari_kod) {
					$data->tedarikci[] = (object)array_merge((array)$val,(array)$val2);
					break;
				}
			}
		}

		foreach ($tedarikci as $key => $val) {
			$i = 0;
			foreach ($data->tedarikci as $key2 => $val2) {
				if ($val->CARI_KOD == $val2->CARI_KOD) {
					$i++;
				}
			}
			if ($i == 0) {
				$data->tedarikci[] = $val;
			}
		}

		//prex($data->tedarikci);


		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/tedarikci_list');
		$this->load->view('Admin/footer');
	}

	public function tedarikciSure($cari = '')
	{
		if ($this->input->post()) {
			$data = $this->getAllPosts();

			//bunu api modele ve servise yazılacak gönderilen postu veritabanına kaydedecek
			$data = (array)$data;
			foreach ($data as $key => $val) {
				if ($val == '') {
					$data[$key] = NULL;
				}
			}
			$return = $this->Api_model->addKargoTime($data,$cari);

			redirect(admin_url('MarkaTedarikci/tedarikciSure/'.$cari));
		}
		$data = new StdClass;
		

		$data->list = $this->Api_model->getTimes($cari);

		if ($data->list == array()) {
			redirect(admin_url('MarkaTedarikci/tedarikci'));
		}
		//prex($data->list);
		$data->id = $cari;
		$data->mainMenu 	= 'Tedarikci';
		$data->subMenu  	= 'Tedarikci';

		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/tedarikci_kargo');
		$this->load->view('Admin/footer');
	}

	public function index()
	{
		$data = new StdClass;
		$data->mainMenu 	= 'Product';
		$data->subMenu  	= 'MarkaTedarikci';

		$brands = $this->Api_model->getBrands();
		$dbBrands = $this->Marka_model->getBrandsAll();


		$data->brands = array();
		foreach ($brands as $key => $val) {
			foreach ($dbBrands as $key2 => $val2) {
				if ($val->GRUP_KOD == $val2->grup_kod) {
					$data->brands[] = (object)array_merge((array)$val,(array)$val2);
					break;
				}
			}
		}

		foreach ($brands as $key => $val) {
			$i = 0;
			foreach ($data->brands as $key2 => $val2) {
				if ($val->GRUP_KOD == $val2->GRUP_KOD) {
					$i++;
				}
			}
			if ($i == 0) {
				$data->brands[] = $val;
			}
		}
		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/marka_list');
		$this->load->view('Admin/footer');
	}

	public function SetStatus($id,$new)
	{
		if ($this->Marka_model->SetStatus($id,$new)) {
			redirect(admin_url('MarkaTedarikci'));
		} else {
			redirect(admin_url('MarkaTedarikci'));
		}
	}


	public function marka_duzenle($id = '')
	{
		$data = new StdClass;
		$data->mainMenu 	= 'Product';
		$data->subMenu  	= 'MarkaTedarikci';

		if ($id == '') {
			# 404
		}else{
			$data->brand = $this->Api_model->getBrandsById($id);

			if ($data->brand == array()) {
				# 404
			}else{
				$data->dbBrand = $this->Marka_model->getBrandsById($id);
				if (!empty($data->dbBrand)) {
					$data->yerli = $data->dbBrand->yerli;
				}else{
					$data->yerli = 0;
				}

				$this->load->view('Admin/header', $data);
				$this->load->view('Admin/marka_edit');
				$this->load->view('Admin/footer');
			}
		}
	}

	public function imageMust()
	{
		if ($this->input->post()){
			$sort = $this->input->post('sort',true);
			$updateArray = [];
			foreach ($sort as $key => $value) {
				$updateArray[$key]['id'] = $key;
				$updateArray[$key]['sort'] = $value;
			}
			if ($this->Marka_model->updateSort($updateArray)) {
				redirect(admin_url('MarkaTedarikci'));
			} else {
				redirect(admin_url('MarkaTedarikci'));
			}
		} else {
			redirect(admin_url('MarkaTedarikci'));
		}
	}

	public function oranChange()
	{
		$data = new StdClass;
		//prex($this->input->post());
		$data->oran = $this->input->post('oran',true);
		$data->cari_kod = $this->input->post('cari_kod',true);
		$this->Marka_model->setOran($data);
		redirect(site_url('Admin/MarkaTedarikci/tedarikci'));
	}

	public function edit($id = '')
	{
		$data = new StdClass;
		if ($this->input->post()) {
			if ($this->input->post('yerli') == 'on') {
				$yerli = 1;
			}else{
				$yerli = 0;
			}

			$image = $this->session->flashdata('image');
			if (null == $image) {
				$image = false;
			}

			if ($id == '') {
				redirect(admin_url('MarkaTedarikci'));
			}else{
				$data->brand = $this->Api_model->getBrandsById($id);

				if ($data->brand == array()) {
					redirect(admin_url('MarkaTedarikci'));
				}else{
					$data->dbBrand = $this->Marka_model->getBrandsById($id);

					if ($data->dbBrand == false) {
						$this->Marka_model->addBrand($id,$yerli,$image);
					}else{
						$this->Marka_model->updateBrand($id,$yerli,$image);
					}
					redirect(admin_url('MarkaTedarikci/marka_duzenle/'.$id));
				}
			}
		}else{
			redirect(admin_url('MarkaTedarikci'));
		}
	}
}
?>