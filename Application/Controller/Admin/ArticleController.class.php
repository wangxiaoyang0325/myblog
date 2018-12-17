<?php 
	namespace Controller\Admin;
	class ArticleController extends BaseController{
		//显示文章：
		public function listAction(){
			$art_model=new \Model\ArticleModel();
			if(!empty($_POST)){
				$art_list=$art_model->searchList();
			}else{
				$art_list=$art_model->getlist();
			}
			$cat_model=new \Model\CategoryModel();
			$cat_list=$cat_model->getCategoryTree();
			$this->smarty->assign('data',array(
				'art_list' => $art_list,
				'cat_list' => $cat_list
			));
			$this->smarty->display('article_list.html');
		}
		//添加文章：
		public function addAction(){
			//执行添加逻辑：
			if (!empty($_POST)) {
				$data['art_title']=$_POST['title'];
				$data['art_content']=$_POST['content'];
				$data['art_time']=time();
				$data['cat_id']=$_POST['cat_id'];
				$data['user_id']=$_SESSION['user']['user_id'];
				$data['is_top']=$_POST['is_top'];
				$data['is_public']=$_POST['is_public'];
				$art_model=new \Core\Model('article');
				if ($art_model->insert($data)) {
					$this->success('index.php?p=Admin&c=Article&a=list','添加成功');
				}else{
					$this->error('index.php?p=Admin&c=Article&a=add','添加失败');
				}
			}
			//显示页面：
			$cat_model=new \Model\CategoryModel();
			$cat_list=$cat_model->getCategoryTree();
			$this->smarty->assign('cat_list',$cat_list);
			$this->smarty->display('article_add.html');
		}
		//修改文章：
		public function editAction(){
			$art_id=(int)$_GET['art_id'];
			$art_model=new \Core\Model('article');
			//执行修改逻辑
			if (!empty($_POST)) {
				$data['art_title']=$_POST['title'];
				$data['art_content']=$_POST['content'];
				$data['cat_id']=$_POST['cat_id'];
				$data['is_top']=$_POST['is_top'];
				$data['is_public']=$_POST['is_public'];
				$data['art_id']=$art_id;
				$rs=$art_model->update($data);
				if ($rs) {
					$this->success('index.php?p=Admin&c=Article&a=list','修改成功');
				}
				elseif ($rs===0) {
					$this->error('index.php?p=Admin&c=Article&a=edit&art_id='.$art_id,'没有数据更新');
				}
				else{
					$this->error('index.php?p=Admin&c=Article&a=edit&art_id='.$art_id,'修改失败');
				}
			}
			//显示修改页面：
			$art_info=$art_model->Find($art_id);//修改的文章信息：
			$cat_model=new \Model\CategoryModel();
			$cat_list=$cat_model->getCategoryTree();
			$this->smarty->assign('data',array(
				'cat_list' => $cat_list,
				'art_info' => $art_info
			));

			$this->smarty->display('article_edit.html');
		}
		//删除文章：
		public function DelAction(){
			$art_id=$_GET['art_id'];
			$art_model=new \Model\ArticleModel();
			if ($art_model->softdel($art_id)){
				$this->success('index.php?p=Admin&c=Article&a=list','删除成功');
			}else{
				$this->error('index.php?p=Admin&c=Article&a=list','删除失败');
			}
		}
		//显示回收站内文章：
		public function RecycleAction(){
			$art_model=new \Model\ArticleModel();
			if(!empty($_POST)){
				$art_list=$art_model->searchList();
			}else{
				$art_list=$art_model->recyclelist();
			}
			$cat_model=new \Model\CategoryModel();
			$cat_list=$cat_model->getCategoryTree();
			$this->smarty->assign('data',array(
				'art_list' => $art_list
			));
			$this->smarty->display('article_recycle.html');
		}
		//恢复回收站的文章：
		public function recoverAction(){
			$art_id=$_GET['art_id'];
			$art_model=new \Model\ArticleModel();
			if ($art_model->rec($art_id)){
				$this->success('index.php?p=Admin&c=Article&a=recycle','恢复成功');
			}else{
				$this->error('index.php?p=Admin&c=Article&a=recycle','恢复失败');
			}
		}
		//彻底删除文章：
		public function realdelAction(){
			$art_id=$_GET['art_id'];
			$art_model=new \Model\ArticleModel();
			if ($art_model->realdelete($art_id)){
				$this->success('index.php?p=Admin&c=Article&a=recycle','删除成功');
			}else{
				$this->error('index.php?p=Admin&c=Article&a=recycle','删除失败');
			}
		}
}