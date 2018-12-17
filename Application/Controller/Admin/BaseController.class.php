<?php
	namespace Controller\Admin;
	class BaseController extends \Core\Controller{
		public function __construct(){
			parent::__construct();
			$this->checkLogin();
		}
		private function checkLogin(){
			if (CONTROLLER_NAME=='Login') {
				return;
			}
			if (empty($_SESSION['user'])) {
				$this->error('index.php?p=Admin&c=Login&a=login');
			}
		}
	}

 ?>