<?php
	namespace Controller\Admin;
	// class UserController extends BaseController{
	// 	//显示普通用户：
	// 	public function listAction(){
	// 		$model=new \Core\Model('user');
	// 		$list=$model->select(array('is_admin'=>0));
	// 		$this->smarty->assign('list',$list);
	// 		$this->smarty->display('user_list.html');
	// 	}
	// }
	class UserController extends BaseController{
	    //显示普通用户列表
	    public function listAction(){
	        $model=new \Core\Model('user');
	        $list=$model->select(array('is_admin'=>0));
	        $this->smarty->assign('list',$list);
	        $this->smarty->display('user_list.html');
	    }
	    //删除用户：
	    public function delAction(){
	    	$user_id=(int)$_GET['user_id'];
	    	$model=new \Core\Model('user');
	    	if ($model->delete($user_id)) {
	    		$this->success('index.php?p=Admin&c=User&a=list','删除成功');
	    	}
	    	else{
	    		$this->error('index.php?p=Admin&c=User&a=list','删除失败');
	    	}
	    }
	    //更改个人信息：
	    public function editAction(){
	    	if (!empty($_POST)) {
	    		$pwd=trim($_POST['password']);
	    		if (!empty($pwd)) {		//更改密码：
	    			$data['user_pwd']=md5($pwd);
	    		}
	    		if ($_FILES['face']['error']!=4) {	//	更改头像
	    			$path=$GLOBALS['config']['app']['upload_path'];
	    			$size=$GLOBALS['config']['app']['upload_size'];
	    			$type=$GLOBALS['config']['app']['upload_type'];
	    			$upload=new \Lib\Upload($path,$size,$type);
	    			if ($path=$upload->uploadOne($_FILES['face'])) {
	    				$data['user_face']=$path;
	    			}
	    			else{
	    				$this->error('index.php?p=Admin&c=User&a=edit',$upload->getError());
	    			}
	    		}
	    		if (!empty($data)) {		//更改用户信息：
	    			$data['user_id']=$_SESSION['user']['user_id'];
	    			$model=new \Core\Model('user');
	    			$result=$model->update($data);
	    			if ($result===0) {
	    				$this->error('index.php?p=Admin&c=User&a=edit','新密码和旧密码一样');
	    			}elseif ($result===false) {
	    				$this->error('index.php?p=Admin&c=User&a=edit','修改失败');
	    			}
	    			else{
	    				session_destroy();
	    				//top关键字表示所有框架的最顶端的窗口。
	    				echo <<<str
<script type="text/javascript">
		alert('修改成功');
		top.location.href='index.php?p=Admin&c=Login&a=login'
</script>    				
str;
	    			}
	    		}
	    	}
	    	$this->smarty->display('user_edit.html');
	    }
	}

