<?php 
	namespace Controller\Admin;
	class CategoryController extends BaseController{
		//显示类别：
		public function listAction(){
			$model=new \Model\CategoryModel();
			$list=$model->getCategoryTree();
			$this->smarty->assign('list',$list);
			$this->smarty->display('cat_list.html');
		}
		//添加类别：
		public function addAction(){
			$model=new \Model\CategoryModel();
			if (!empty($_POST)){
				if ($model->insert($_POST))
					$this->success('index.php?p=Admin&c=Category&a=list','插入成功');
				else
					$this->error('index.php?p=Admin&c=Category&a=add','插入失败');
			}
			$cat_list=$model->getCategoryTree();
			$this->smarty->assign('cat_list',$cat_list);
			$this->smarty->display('cat_add.html');
		}
		//更改类别：
		public function editAction(){
			$cat_id=(int)$_GET['cat_id'];	//修改的类别编号；
			$model=new \Model\CategoryModel();
			if (!empty($_POST)) {
				//指定的父级不能是自己：
				if ($_POST['parent_id']==$cat_id) {
					$this->error('index.php?$p=Admin&c=Category&a=edit&cat_id='.$cat_id,'指定的父级不能是自己');
				}
				//指定的父级不能是自己的后代：
				$sub_list=$model->getCategoryTree($cat_id);//获取$cat_id的子代
				foreach ($sub_list as $rows) {
					if ($rows['cat_id']==$_POST['parent_id']) {
						$this->error('index.php?$p=Admin&c=Category&a=edit&cat_id='.$cat_id,'指定的父级不能是自己的子级');
					}
				}
				//执行更改逻辑：
				$_POST['cat_id']=$cat_id;
				if ($model->update($_POST)) {
					$this->success('index.php?p=Admin&c=Category&a=list','修改成功');
				}else{
					$this->error('index.php?p=Admin&c=Category&a=edit&cat_id='.$cat_id,'修改失败');
				}
			}
			$cat_list=$model->getCategoryTree();//获取类别列表；
				$info=$model->find($cat_id);	//需要修改的类别
				$this->smarty->assign('data',array(
					'cat_list' => $cat_list,
					'info' => $info
				));
			$this->smarty->display('cat_edit.html');
		}
		//删除类别：
		public function delAction(){
			$cat_id=(int)$_GET['cat_id'];
			$model=new \Model\CategoryModel();
			if ($model->isLeaf($cat_id)) {
				if ($model->delete($cat_id)) {
					$this->success('index.php?p=Admin&c=Category&a=list','删除成功');
				}else{
					$this->error('index.php?p=Admin&c=Category&a=del&cat_id='.$cat_id,'删除失败');
				}
			}else{
				$this->error('index.php?p=Admin&c=Category&a=list','删除的节点有子节点，不允许删除');
			}

		}
	}

 ?>