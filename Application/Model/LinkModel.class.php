<?php 
	namespace Model;
	class LinkModel extends \Core\Model{
		//删除链接：
		public function del($link_id){
			$sql="delete from Link where link_id=$link_id";
			return $this->db->exec($sql);
		}
		
	}