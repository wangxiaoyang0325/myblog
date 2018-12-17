<?php 
	namespace Model;
	class UserModel extends \Core\Model{
		//判断是否登录成功。
		public function isLogin(){
			$data['user_name']=addslashes($_POST['user_name']);
			$data['user_pwd']=md5($_POST['password']);
			if ($info=$this->select($data)) {
				$info=$info[0];
				unset($info['user_pwd']);
				return $info;
			}
			return false;
		}
		public function updateLoginInfo(){
			//$_SERVER服务器和执行环境信息：REMOTE_ADDR：浏览当前页面的用户的 IP 地址。
			$data['user_id']=$_SESSION['user']['user_id'];
			//$data['last_login_ip']=ip2long($_SERVER['REMOTE_ADDR']); 
			$data['last_login_ip']=ip2long($_SERVER['REMOTE_ADDR']);
			$data['last_login_time']=time();
			$data['login_count']=++$_SESSION['user']['login_count'];
			return $this->update($data);
		}
	}
 ?>