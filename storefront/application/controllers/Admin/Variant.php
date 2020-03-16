<?php
/**
* Author: Muhammet Ateş
*/
class Variant extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->checkLogin();
		$this->load->model('Admin/Variant_model');
		if ($this->session->userdata('user')->auth != 0 && $this->session->userdata('user')->auth != 2) 
		{
			redirect(site_url('Admin'));
		}
	}

	public function index()
	{
		$header_data = new StdClass;
		$header_data->mainMenu = 'Variant';
		$header_data->subMenu  = 'VariantList';
		$data['variants'] = $this->Variant_model->getAllVariants();
		$data['sonuc'] = array($this->session->flashdata('variant_result1'), $this->session->flashdata('variant_result2'));

		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/variant', $data);
		$this->load->view('Admin/footer');
	}
	
	public function Add()
	{
		$header_data = new StdClass;
		$header_data->mainMenu = 'Variant';
		$header_data->subMenu  = 'VariantAdd';


		if ($_POST) {
			$tag = $this->input->post('tag', true);
			$lang = $this->input->post('lang', true);
			if ($this->Variant_model->addVariant($tag, $lang)) {
				$this->session->set_flashdata('variant_result1', 'Varyant eklendi.');
				$this->session->set_flashdata('variant_result2', 'success');
				redirect(admin_url('Variant/add'));
			} else {
				$this->session->set_flashdata('variant_result1', 'Bir hata oluştu.');
				$this->session->set_flashdata('variant_result2', 'danger');
			}
		}

		$data['sonuc'] = array($this->session->flashdata('variant_result1'), $this->session->flashdata('variant_result2'));
		$data['langs'] = $this->Variant_model->GetLangListForVariant();

		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/variant_add', $data);
		$this->load->view('Admin/footer');
	}

	public function Update($id = 0)
	{
		$id = (int)$id;
		if ($id == 0) {
			redirect(admin_url('Variant'));
		}
		$header_data = new StdClass;
		$header_data->mainMenu = 'Variant';
		$header_data->subMenu  = 'VariantList';

		$this->load->view('Admin/header', $header_data);
		if ($_POST) {
			$tag = $this->input->post('tag', true);
			$lang = $this->input->post('lang', true);
			$newlang = $this->input->post('newlang', true);
			if ($this->Variant_model->updateVariant($id, $tag, $lang, $newlang)) {
				$this->session->set_flashdata('variant_result1', 'Varyant güncellendi.');
				$this->session->set_flashdata('variant_result2', 'success');
				redirect(admin_url('Variant/Update/'.$id));
			} else {
				$this->session->set_flashdata('variant_result1', 'Bir hata oluştu.');
				$this->session->set_flashdata('variant_result2', 'danger');
			}
		}
		$data['sonuc'] = array($this->session->flashdata('variant_result1'), $this->session->flashdata('variant_result2'));
		$data['variants'] = $this->Variant_model->getVariantLangsById($id);
		$this->load->view('Admin/variant_update', $data);
		$this->load->view('Admin/footer');
	}

	public function SetStatus($id, $new)
	{
		try {
			$this->Variant_model->updateStatusById($id,$new);
			redirect(site_url('Admin/Variant'));
		} catch (Exception $e) {
			redirect(site_url('Admin/Variant'));
		}
	}

	public function Delete($id = 0)
	{
		if ($id == 0) {
			redirect(site_url('Admin/Variant'));
		}
		if ($this->Variant_model->deleteVariantById($id)) {
			$this->session->set_flashdata('variant_result1', 'Variant silindi.');
			$this->session->set_flashdata('variant_result2', 'success');
			redirect(site_url('Admin/Variant'));
		} else {
			$this->session->set_flashdata('variant_result1', 'Bir hata oluştu.');
			$this->session->set_flashdata('variant_result2', 'danger');
			redirect(site_url('Admin/Variant'));
		}
		
	}

	public function VariantChilds($varid = 0)
	{
		if ($varid == 0) {
			redirect(admin_url('Variant'));
		}

		$header_data = new StdClass;
		$header_data->mainMenu = 'Variant';
		$header_data->subMenu  = 'VariantList';

		$data['variant'] = $this->Variant_model->getVariantById($varid);
		if (!$data['variant']) {
			redirect(admin_url('Variant'));
		}
		$data['childs'] = $this->Variant_model->getVariantChilds($varid);
		$data['sonuc'] = array($this->session->flashdata('variant_result1'), $this->session->flashdata('variant_result2'));

		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/variant_childs', $data);
		$this->load->view('Admin/footer');
	}

	public function ChildAdd($varid = 0)
	{
		if ($varid == 0) {
			redirect(admin_url('Variant'));
		}
		$header_data = new StdClass;
		$header_data->mainMenu = 'Variant';
		$header_data->subMenu  = 'VariantList';


		if ($_POST) {
			$tag = $this->input->post('tag', true);
			$lang = $this->input->post('lang', true);
			if ($this->Variant_model->addVariantChild($varid, $tag, $lang)) {
				$this->session->set_flashdata('variant_child_result1', 'Alt Varyant eklendi.');
				$this->session->set_flashdata('variant_child_result2', 'success');
			} else {
				$this->session->set_flashdata('variant_child_result1', 'Bir hata oluştu.');
				$this->session->set_flashdata('variant_child_result2', 'danger');
			}
			redirect(admin_url('Variant/ChildAdd/'.$varid));
		}

		$data['sonuc'] = array($this->session->flashdata('variant_child_result1'), $this->session->flashdata('variant_child_result2'));
		$data['langs'] = $this->Variant_model->GetLangListForVariant();
		$data['variant'] = $this->Variant_model->getVariantById($varid);
		if (!$data['variant']) {
			redirect(admin_url('Variant'));
		}

		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/variant_child_add', $data);
		$this->load->view('Admin/footer');
	}

	public function ChildUpdate($id = 0)
	{
		$id = (int)$id;
		if ($id == 0) {
			redirect(admin_url('Variant'));
		}
		$header_data = new StdClass;
		$header_data->mainMenu = 'Variant';
		$header_data->subMenu  = 'VariantList';

		$parentid = $this->Variant_model->getVariantId_By_VariantChildId($id);
		$data['variant'] = $this->Variant_model->getVariantById($parentid);
		$this->load->view('Admin/header', $header_data);
		if ($_POST) {
			$tag = $this->input->post('tag', true);
			$lang = $this->input->post('lang', true);
			$newlang = $this->input->post('newlang', true);
			if ($this->Variant_model->updateVariantChild($parentid, $id, $tag, $lang, $newlang)) {
				$this->session->set_flashdata('variant_result1', 'Alt varyant güncellendi.');
				$this->session->set_flashdata('variant_result2', 'success');
				redirect(admin_url('Variant/ChildUpdate/'.$id));
			} else {
				$this->session->set_flashdata('variant_result1', 'Bir hata oluştu.');
				$this->session->set_flashdata('variant_result2', 'danger');
			}
		}
		$data['sonuc'] = array($this->session->flashdata('variant_result1'), $this->session->flashdata('variant_result2'));
		$data['childs'] = $this->Variant_model->getVariantChildLangsById($id);
		$this->load->view('Admin/variant_child_update', $data);
		$this->load->view('Admin/footer');
	}

	public function ChildDelete($id = 0)
	{
		if ($id == 0) {
			redirect(site_url('Admin/Variant'));
		}
		$parentid = $this->Variant_model->getVariantId_By_VariantChildId($id);
		if ($this->Variant_model->deleteVariantChildById($id)) {
			$this->session->set_flashdata('variant_result1', 'Variant silindi.');
			$this->session->set_flashdata('variant_result2', 'success');
			redirect(site_url('Admin/Variant/VariantChilds/'.$parentid));
		} else {
			$this->session->set_flashdata('variant_result1', 'Bir hata oluştu.');
			$this->session->set_flashdata('variant_result2', 'danger');
			redirect(site_url('Admin/Variant/VariantChilds/'.$parentid));
		}
		
	}

}
?>