<?php
	class Try_it extends Core_Controller
	{
		function __construct()
		{
			parent::__construct();
			$this->load->model('Admin/Admin_user_model');
		}

		public function index()
		{
			var_dump(password_hash("05380538asd", PASSWORD_DEFAULT));
		}
	}

?>