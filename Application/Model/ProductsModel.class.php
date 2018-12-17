<?php 
	namespace Model;
	// class ProductsModel{
	// 	public function getlist(){
	// 	return $db->fetchAll("select * from products");
	// 	}
	// }
	class ProductsModel extends \Core\Model{
		public function getlist(){
			return $this->db->fetchAll("select * from products");			
		}
		public function del($proid){
			return $this->db->exec("delete from products where proid=$proid");
		}

		//修改：
		public function upd($proid){
			return $this->db->fetchRow("select * from products where proid=$proid");
		}
		public function upd1($proid,$proname,$proguige,$proprice,$proamount){
			return $this->db->exec("update products set proname='{$proname}',proguige='{$proguige}',proprice='{$proprice}',proamount='{$proamount}'where proid='{$proid}'");
		}
		//添加：
		public function add($proname,$proguige,$proprice,$proamount){
			return $this->db->exec("insert into products values (null,'{$proname}','{$proguige}','{$proprice}','{$proamount}',null,null)");
		}
	}
 ?>