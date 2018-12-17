<?php 
	namespace Controller\Admin;
	//products控制器：
	//规则：
	//1.一个模块就是对应一控制器：
	//2.控制器以Controller结尾：
	//3.控制器中的方法以Action结尾（目的防止用关键字做方法名）
	class ProductsController extends \Core\Controller{
		//展示商品：
		public function listAction(){
			//调用模型：
			$products=new \Core\Model('products');	
			$list=$products->select();
			//require __VIEW__.'./products_list.html';
			$this->smarty->assign('list',$list);
			$this->smarty->display('products_list.html');
		}
		//删除商品：
		public function delAction(){
				$proid=(int)$_GET['proid'];
				$model=new \Model\ProductsModel;
				if ($model->delete($proid)) {
					$this->success("index.php?p=Admin&c=products&a=list","删除成功");
					//header("location:index.php?c=products&a=list");
				}else{
					$this->error("index.php?p=Admin&c=products&a=list","删除失败");
				}
		}

		//修改商品：
		public function updAction(){
			$proid=$_GET['proid'];
			$model=new \Model\ProductsModel();
			if ($model->upd($proid)) {
				$list=$model->upd($proid);
				require __VIEW__.'./products_upd.html';
			}else{
				echo "修改失败";
				exit;
			}
		}
		public function upd1Action(){
			if (isset($_POST['btn'])) {
				$proid=$_POST['proid'];
				$proname=$_POST['proname'];
				$proguige=$_POST['proguige'];
				$proprice=$_POST['proprice'];
				$proamount=$_POST['proamount'];
				$model=new \Model\ProductsModel();
				if ($model->upd1($proid,$proname,$proguige,$proprice,$proamount)) {
					$this->success("index.php?p=Admin&c=products&a=list","修改成功");
				}
			}else{
				$this->error("index.php?p=Admin&c=products&a=list","修改失败");
			}
		}
		public function addAction(){
			if (isset($_POST['btn'])) {
				$proname=$_POST['proname'];
				$proguige=$_POST['proguige'];
				$proprice=$_POST['proprice'];
				$proamount=$_POST['proamount'];
				$model=new \Model\ProductsModel();
				if($model->add($proname,$proguige,$proprice,$proamount)) {
					$this->success("index.php?p=Admin&c=products&a=list","添加成功");
					//header('location:index.php?c=Products&a=list');
				}
			}else{
				require __VIEW__.'./products_add.html';
				exit;
			}
		}
	}
 ?>