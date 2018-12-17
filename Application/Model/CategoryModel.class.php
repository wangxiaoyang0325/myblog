<?php 
	namespace Model;
	class CategoryModel extends \Core\Model{
		private $tree=array();
		//获取类别树；
		public function getCategoryTree($parent_id=0){
			$list=$this->select();
			$this->createTree($list,$parent_id);
			return $this->tree;
		}
		/*
		创建树形结构，
		@param $list 二维数组；
		@param $parent_id int 父级id，指定从哪个父级找子集。
		@param $deep int 缩进的深度。
		 */
		private function createTree($list,$parent_id=0,$deep=0){
			foreach ($list as $rows) {
				if ($rows['parent_id']==$parent_id) {
					$rows['deep']=$deep;
					$this->tree[]=$rows;
					$this->createTree($list,$rows['cat_id'],$deep+1);
				}
			}
		}
		//判断节点是不是叶子节点：
		public function isLeaf($cat_id){
			$sql="select count(*) from category where parent_id=$cat_id";
			//$sql="select count(*) from category where parent_id=$cat_id";
			return !$this->db->fetchColumn($sql);
		}
		
	}

 ?>