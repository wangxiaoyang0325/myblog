<?php 
	namespace Core;
	//建立基础模型类：
	class Model{
		protected $db;
		private $table;	//操作数据的表名。
		private $pk;	//主键
		//@param $table string 操作的表名
		public function __construct($table=''){
			$this->initDB();
			$this->getTable($table);
			$this->getPrimaryKey();
		}
		//初始化连接数据库：
		private function initDB(){
			$this->db=MyPDO::getinstance($GLOBALS['config']['database']);
		}
		//获取表名：
		private function getTable($table){
			//如果传递了表名就用传递的表名，没有传递表名就从子类的名称中获取表名
			if ($table=='') {
				$class_name=basename(get_class($this));	//获取当前对象所属的类
				$this->table=substr($class_name,0,-5);		//截取类名，从类的倒数第五个开始。
			}else{
				$this->table=$table;
			}
		}
		//获取主键：
		private function getPrimaryKey(){
			$rs=$this->db->fetchAll("desc `$this->table`");		//显示表结构。
			foreach ($rs as $rows) {
				if ($rows['Key']=='PRI') {		
					$this->pk=$rows['Field'];
					return;
				}
			}
		}

		//封装万能的insert语句：
		//@param $data array 插入的数据
		//@return int|false 成功：返回自动增长的编号。失败返回false；
		public function insert($data){
			$keys=array_keys($data);	//获取数组的键
			$keys=array_map(function($key){		//每个key上边加上反引号。
				return "`{$key}`";
			},$keys);
			$fileds=implode(',',$keys);		//将keys中元素用逗号连接起来。
			$values=array_values($data);	//获取数组的值
			$values=array_map(function($value){
				return "'$value'";	//每个值上边加上反引号。
			},$values);
			$values=implode(',',$values);		//用逗号连接values的值
			$sql="insert into `$this->table` ($fileds) values ($values)";//拼接SQL语句。
			if ($this->db->exec($sql)) {
				return $this->db->getInsertid();
			}
				return false;
			
		}
	
		//封装万能的update语句；
		public function update($data){
			//获取所有键：
			$keys=array_keys($data);
			$index=array_search($this->pk,$keys);	//获取主键在数组中的下标。
			unset($keys[$index]);	//删除主键的元素。
			//拼接`键`='值'的格式；
			$fields=array_map(function($key) use($data){
				return "`$key`='$data[$key]'";
			}, $keys);
			$fields=implode(',',$fields);	//将values中的值用逗号连接。
			$sql="update `$this->table` set $fields where `$this->pk`='{$data[$this->pk]}'";
			return $this->db->exec($sql);
		}
		//封装万能的delete模型：
		public function delete($id){
			$sql="delete from `{$this->table}` where `{$this->pk}`='{$id}'";
			return $this->db->exec($sql);
		}
		//疯转万能的select模型：返回二维数组
		//$order_field string 排序字段，默认是主键排序
		//$order_type string 排序方式，默认是正序排序(asc)。
		public function select($condition=array(),$order_field='',$order_type='asc'){
			$sql="select * from `{$this->table}` where 1";
			// foreach ($condition as $key => $value) {
			// 	$sql.=" and `{$key}`='$value'";
			// }
			foreach($condition as $k=>$v){
				$sql.=" and `{$k}`='$v'";
			}
		
        	if($order_field=='')
            $order_field=$this->pk;
        	$sql.=" order by `$order_field` $order_type";
			return $this->db->fetchAll($sql);
    	}
		//封装万能的find，查找一条记录：
		public function find($id){
			$sql="select * from `{$this->table}` where `{$this->pk}`='$id'";
			return $this->db->fetchRow($sql);
		}

	}
 ?>