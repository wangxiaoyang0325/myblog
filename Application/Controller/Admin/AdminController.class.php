<?php 
	namespace Controller\Admin;
	class AdminController extends BaseController{
		public function adminAction(){
			$this->smarty->display('admin.html');
		}
		public function topAction(){
			$this->smarty->display('top.html');
		}
		public function menuAction(){
			$this->smarty->display('menu.html');
		}
		public function mainAction(){
			$this->smarty->display('main.html');
		}
	}
 ?>