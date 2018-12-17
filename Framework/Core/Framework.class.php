<?php 
	namespace Core;
	class Framework{
		//封装run()方法：
		public static function run(){
			self::initConst();
			self::initConfig();
			self::initError();
			self::initRoutes();
			self::initLoadClass();
			self::initDispatch();
		}
		//初始化路径常量：
		private static function initConst(){
			define('DS',DIRECTORY_SEPARATOR);
			define('ROOT_PATH',getcwd().DS);
			define('APP_PATH', ROOT_PATH.'Application'.DS);
			define('FRAMEWORK_PATH', ROOT_PATH.'Framework'.DS);
			define('CONFIG_PATH', APP_PATH.'Config'.DS);
			define('CONTROLLER_PATH', APP_PATH.'Controller'.DS);
			define('MODEL_PATH', APP_PATH.'Model'.DS);
			define('VIEW_PATH', APP_PATH.'View'.DS);
			define('CORE_PATH', FRAMEWORK_PATH.'Core'.DS);
		}
		//导入配置信息：
		private static function initConfig(){
			$GLOBALS['config']=require CONFIG_PATH.'Config.php';
		}
		//确定路由：
		//@param p:平台，c:控制器，a:方法。
		private static function initRoutes(){
			$p=$_GET['p']??$GLOBALS['config']['app']['default_platform'];	//获取平台
			$c=$_GET['c']??$GLOBALS['config']['app']['default_controller'];	//获取控制器
			$a=$_GET['a']??$GLOBALS['config']['app']['default_action'];	//获取方法。
			$p=ucfirst(strtolower($p));		//首字母大写。
			$c=ucfirst(strtolower($c));		//首字母大写。
			$a=strtolower($a);		//小写。
			define('PLATFORM_NAME', $p);
			define('CONTROLLER_NAME',$c);
			define('ACTION_NAME', $a);
			//拼接类名和方法名。
			define('__URL__', CONTROLLER_PATH.$p.DS);//当前请求的控制器路径。
			define('__VIEW__', VIEW_PATH.$p.DS);	//当前请求的视图的路径。
			define('__VIEWC__',APP_PATH.'Viewc'.DS.$p.DS);//定义混编目录地址。
		}
		//自动加载类：
		private static function initLoadClass(){
			spl_autoload_register(function($class_name){
				$namespace=dirname($class_name);	//获取命名空间。
				$class_name=basename($class_name);	//获取类名。
				$map=array(
					'Smarty'=>CORE_PATH.'Smarty'.DS.'Smarty.class.php'
				);
				if (isset($map[$class_name])) {
					$path=$map[$class_name];
				}
				elseif(in_array($namespace, array('Core','Lib'))) {
					$path=FRAMEWORK_PATH.$namespace.DS.$class_name.'.class.php';
				}elseif ($namespace=='Model') {
					$path=MODEL_PATH.$class_name.'.class.php';
				}else{
					$path=__URL__.$class_name.'.class.php';
				}
				if (file_exists($path)) {
					require $path;
				}
			});
		}
		//请求分发：
		private static function initDispatch(){
			$controller_name='Controller\\'.PLATFORM_NAME.'\\'.CONTROLLER_NAME.'Controller';	//拼接类名。
			$action_name=ACTION_NAME.'Action';

			$obj=new $controller_name();
			$obj->$action_name();
		}
		//	错误处理：
		//	error_reporting = E_ALL：报告所有的错误
		//	display_errors = On：将错误显示在浏览器上
		//	1. log_errors = On：将错误记录在日志中
		//	2. error_log=’地址’：错误日志保存的地址
		private static function initError(){
			ini_set('error_reporting', E_ALL);	
			//ini_set:为一个选项配置设置值。 error_reporting = E_ALL：报告所有的错误
			if ($GLOBALS['config']['app']['debug']) {	//开发模式：
				ini_set('display_errors','On');		//将错误显示在浏览器上
				ini_set('log_errors','off');	//关闭日志。
			}else{
				ini_set('display_errors','off');	
				ini_set('log_errors','on');
				$logname=date('Y-m-d').'.log';	//错误日志名
				ini_set('error_log', 'D:\www\web2\log\\'.$logname);
			}
		} 
	}
 ?>