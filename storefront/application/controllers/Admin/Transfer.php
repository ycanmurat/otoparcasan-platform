<?defined('BASEPATH') OR exit('No direct script access allowed');

class Transfer extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->checkLogin();
		$this->load->model('Admin/Transfer_model','TM');
	}

	public function ibanList()
	{
		$data = new StdClass;
		$data->mainMenu = 'Transfer';
		$data->subMenu = 'ibanList';

		$data->ibanInformation = $this->TM->getIbanInformation();

		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/iban_list', $data);
		$this->load->view('Admin/footer');
	}

	public function deleteIban($id)
	{
		if ($this->TM->deleteIban($id)) {
			redirect(admin_url('Transfer/ibanList'));
		} else {
			redirect(admin_url('Transfer/ibanList'));
		}
	}

	public function transferList()
	{
		$data = new StdClass;
		$data->mainMenu = 'Transfer';
		$data->subMenu = 'transferList';

		$data->transferInformation = $this->TM->getTransferInformation();

		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/transfer_list', $data);
		$this->load->view('Admin/footer');
	}

	public function deleteTransfer($id)
	{
		if ($this->TM->deleteTransfer($id)) {
			redirect(admin_url('Transfer/transferList'));
		} else {
			redirect(admin_url('Transfer/transferList'));
		}
	}

	public function SetStatusTransfer($id,$new)
	{
		if ($this->TM->SetStatusTransfer($id,$new)) {
			redirect(admin_url('Transfer/transferList'));
		} else {
			redirect(admin_url('Transfer/transferList'));
		}
	}

}