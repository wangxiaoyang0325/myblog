<?php 
	namespace Core;
	abstract class Controller{
		protected $smarty;
		public function __construct(){
			$this->initSession();
			$this->initSmarty();
		}
		private function initSession(){
			new \Lib\Session();	//实例化session类。
		}
		private function initSmarty(){
			$this->smarty=new \Smarty();
			$this->smarty->setTemplateDir(__VIEW__);	//设置模板目录。
			$this->smarty->setCompileDir(__VIEWC__);	//设置混编目录。
		}
		public function success($url,$info='',$time=1){
			$this->jump($url,$info,$time,'success');
		}
		public function error($url,$info='',$time=1){
			$this->jump($url,$info,$time,'error');
		}
		private function jump($url,$info='',$time=3,$flag='success'){
			if ($info=='') {
				header("location:{$url}");
			}else{
				echo <<<str
				 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<meta http-equiv="refresh" content="{$time};{$url}">
 	<title>Document</title>
 	<style type="text/css">
		body{
			text-align:center;
		}
		#msg{
			font-size:36px;
			margin:20px 0px;
		}
		.success{
			color:#090;
		}
		.error{
			color:#F00;
		}
	</style>
</head>
<body>
	<img src="./Public/images/{$flag}.fw.png" width="83" height="82">
	<div id="msg" class="{$flag}">{$info}</div>
	<div>{$time}秒以后跳转</div>
 </body>
 </html>

str;
	exit;
			}
		}
	}
 ?>
