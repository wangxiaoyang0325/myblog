<?php 
	namespace Controller\Admin;
	class LinkController extends BaseController{
		//显示连接：
		public function listAction(){
			$mode=new \Core\Model('link');
			$list=$mode->select();
			$this->smarty->assign('list',$list);
			$this->smarty->display('link_list.html');
		}
		//显示添加页面：
		public function addAction(){
			if (!empty($_POST)) {
				$data['link_name']=$_POST['link_name'];
				$data['link_url']=$_POST['link_url'];
				$data['link_time']=time();
				$model=new \Core\MOdel('link');
				if ($model->insert($data)) {
				$this->success('index.php?p=Admin&c=Link&a=list','添加成功');
				}else{
				$this->error('index.php?p=Admin&c=Link&a=add','添加失败');
				}
			}
			$this->smarty->display('link_add.html');
			
		}
		//删除友情链接：
		public function delAction(){
			$link_id=(int)$_GET['link_id'];
			$model=new \Model\LinkModel();
			if ($model->del($link_id)) {
				$this->success('index.php?p=Admin&c=Link&a=list','添加成功');
			}
			else{
				$this->error('index.php?p=Admin&c=Link&a=list','添加失败');
			}
			$this->smarty->display('link_list.html');
		}
		//修改友情链接：
		public function updateAction(){
			$link_id=(int)$_GET['link_id'];
			$link_model=new \Core\Model('link');
			//执行修改逻辑
			if (!empty($_POST)) {
				$data['link_name']=$_POST['link_name'];
				$data['link_url']=$_POST['link_url'];
				$data['link_id']=$link_id;
				$rs=$link_model->update($data);
				if ($rs) {
					$this->success('index.php?p=Admin&c=link&a=list','修改成功');
				}
				elseif ($rs===0) {
					$this->error('index.php?p=Admin&c=link&a=update&link_id='.$link_id,'没有数据更新');
				}
				else{
					$this->error('index.php?p=Admin&c=link&a=update&link_id='.$link_id,'修改失败');
				}
			}
			//显示修改页面：
			$link_info=$link_model->Find($link_id);//
			$this->smarty->assign('data',array(
				'link_info' => $link_info
			));
			$this->smarty->display('link_update.html');
		}
	}