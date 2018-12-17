<?php 
namespace Controller\Admin;
	class LoginController extends BaseController{
		//登录
		public function loginAction(){
			//登录业务逻辑：
			if (!empty($_POST)) {
				//验证输入的验证码是否正确
				$captcha=new \Lib\Captcha();
				if (!$captcha->checkCode($_POST['passcode'])) {
					$this->error('index.php?p=Admin&c=Login&a=login','验证码输入错误');
				}
				$model=new \Model\UserModel();
				if ($info=$model->isLogin()) {
					$_SESSION['user']=$info;	//将用户信息保存到会话中。
					$model->updateLoginInfo();//更新登录信息
					if (isset($_POST['remember'])) {
						$time=time()+3600*24*7;
						setcookie('username',$_POST['user_name'],$time);
						setcookie('pwd',$_POST['password'],$time);
					}//记住用户名和密码。
					$this->success('index.php?p=Admin&c=Admin&a=admin','登录成功');
				}else{
					$this->error('index.php?p=Admin&c=Login&a=login','登录失败');
				}
			}
			$username=$_COOKIE['username']??'';
			$pwd=$_COOKIE['pwd']??'';
			$this->smarty->assign('username',$username);
			$this->smarty->assign('pwd',$pwd);
			$this->smarty->display('login.html');
		}
		//注册
		public function registerAction(){
			if (!empty($_POST)) {
				$captcha=new \Lib\Captcha();
				if (!$captcha->checkCode($_POST['passcode'])) {
					$this->error('index.php?p=Admin&c=Login&a=register','验证码输入错误');
				}
				$data['user_name']=$_POST['user_name'];	//用户名
				$data['user_pwd']=md5($_POST['password']);//密码
				//判断用户名是否存在：
				$model=new \Core\Model('user');
				if ($model->select(array('user_name'=>$data['user_name']))) {
					$this->error('index.php?p=Admin&c=Login&a=register','此用户名已存在，请重新选择');
				}

				//上传图片：
				$path=$GLOBALS['config']['app']['upload_path'];
				$size=$GLOBALS['config']['app']['upload_size'];
				$type=$GLOBALS['config']['app']['upload_type'];
				$upload=new \Lib\Upload($path,$size,$type);
				if($path=$upload->uploadOne($_FILES['face'])){
					$data['user_face']=$path;
				}else{
					$this->error('index.php?p=Admin&c=Login&a=register',$upload->getError());
				}//文件上传结束
				//将用户信息写进数据库：
				if ($model->insert($data)) {
					$this->success('index.php?p=Admin&c=Login&a=login','注册成功，你可以去登录了');
				}else{
					$this->error('index.php?p=Admin&c=Login&a=register','注册失败，请重新注册');
				}
			}
			$this->smarty->display('register.html');
		}
		public function createCaptchaAction(){
			$captcha=new \Lib\Captcha();
			$captcha->generalCaptcha();
		}
		public function logoutAction(){
			session_destroy();
			header("location:index.php?p=Admin&c=Login&a=login");
		}
	}

