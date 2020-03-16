<?php 
/**
* Logout Module Build By Uğur Yetkil
*/
class Logout extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->session->sess_destroy();
		redirect(site_url('Admin/Login'));
		
	}
}
?>