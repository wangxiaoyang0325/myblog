<?php 
	namespace Core;
	class MyPDO{
		private $type;
		private $host;
		private $port;
		private $user;
		private $password;
		private $dbname;
		private $charset;
		private $pdo;
		private static $instance;
		private function __construct($param){
			$this->initParam($param);
			$this->initConnect();
			$this->initException();
		}
		private function __clone(){}
		public static function getinstance($param){
			if (!isset(self::$instance)) {
				self::$instance=new self($param);
			}return self::$instance;
		}
		//初始化参数：
		private function initParam($param){
			$this->type=$param['type']??'mysql';
			$this->host=$param['host']??'127.0.0.1';
			$this->port=$param['port']??'3306';
			$this->user=$param['user']??'root';
			$this->password=$param['password']??'aa';
			$this->dbname=$param['dbname']??'php17';
			$this->charset=$param['charset']??'utf8';
		}
		//初始化PDO：
		public function initConnect(){
			try{
				$dsn="{$this->type}:host={$this->host};dbname={$this->dbname};charset={$this->charset}";
				$this->pdo=new \PDO($dsn,$this->user,$this->password);
			}catch(\Exception $e){
				$this->showException($e);
			}
		}
		//初始化异常：
		private function initException(){
			$this->pdo->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
		}
		//封装异常：
		private function showException($e,$sql=''){
			if ($sql!='') {
				echo "SQL语句执行失败。<br>错误SQL语句是：",$sql;
			}
			echo "错误的信息：",$e->getMessage(),'<br>';
			echo "错误的编号：",$e->getCode(),'<br>';
			echo "错误的文件是：",$e->getFile(),'<br>';
			echo "错误的行数：",$e->getLine();
			exit;
		}
		//执行数据操作语句：
		public function exec($sql){
			try{
				return $this->pdo->exec($sql);
			}catch(\Exception $e){
				$this->showException($e,$sql);
			}
		}
		//获取自增长数：
		public function getInsertid(){
			return $this->pdo->lastInsertId();
		}
		//获取PDOStament对象：
		public function getPDOStatement($sql){
			try{
				return $this->pdo->query($sql);
			}
			catch(\Exception $e){
				$this->showException($e,$sql);
			}
		}
		//获取封装类型的方法：
		public function getFetchType($type){
			switch ($type) {
				case 'num':
					return \PDO::FETCH_NUM;
				case 'both':
					return \PDO::FETCH_BOTH;
				default:
					return \PDO::FETCH_ASSOC;
			}
		}
		//匹配所有的数据：
		public function fetchAll($sql,$type='assoc'){
			$stmt=$this->getPDOStatement($sql);
			$type=$this->getFetchType($type);
			return $stmt->fetchAll($type);
		}
		//匹配一行数据：
		public function fetchRow($sql,$type='assoc'){
			$stmt=$this->getPDOStatement($sql);
			$type=$this->getFetchType($type);
			return $stmt->fetch($type);
		}
		//匹配一行一列：
		public function fetchColumn($sql,$n=0){
			$stmt=$this->getPDOStatement($sql);
			return $stmt->fetchColumn($n);
		}
	}
	// $param=array(
	// 	'dbname'=>'test',
	// 	'user'=>'root',
	// 	'password'=>'aa'
	// );
	// $db=MyPDO::getinstance($param);
	// $list=$db->exec("delete from LOL where rank=7");
	// //$list=$db->fetchColumn("select count(*) from LOL");
	// echo "<pre>";
	// var_dump($list);
