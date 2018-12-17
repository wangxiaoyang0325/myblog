<?php 
	namespace Lib;
	class Upload{
	private $error;		//保存错误信息：
	private $path;		//上传的路径
	private $size;		//上传的大小
	private $type;		//上传类型
	public function __construct($path,$size,$type){
		$this->path=$path;
		$this->size=$size;
		$this->type=$type;
	}
	//显示错误：
	public function getError(){
		return $this->error;
	}
	//文件上传的方法：$files array $_FILES[]
	public function uploadOne($files){
		if ($files['error']!=0) {
			switch ($files['error']) {
				case 1:
					$this->error='超过文件配置的大小'.int_get('upload_max_filesize');
					break;
				case 2:
					$this->error='超过了表单允许的最大值。';
					break;
				case 3:
					$this->error='只有部分文件上传。';
					break;
				case 4:
					$this->error='没有上传文件';
					break;
				case 6:
					$this->error='找不到临时文件';
					break;
				case 7:
					$this->error='文件写入失败';
					break;
				default:
					$this->error='未知错误';
					break;
			}
			return false;
		}
		//验证格式：
		$finfo=finfo_open(FILEINFO_MIME_TYPE);
		$info=finfo_file($finfo, $files['tmp_name']);
		if (!in_array($info,$this->type)) {
			$this->error='文件类型错误，允许的类型有：'.implode(',', $this->type);
			return false;
		}
		//验证大小：
		if ($files['size']>$this->size) {
			$this->error='文件不能超过'.number_format($this->size/1024,2).'K';
			return false;
		}
		//验证是否是HTTP上传：
		if (!is_uploaded_file($files['tmp_name'])) {
			$this->error='文件必须是HTTP上传';
			return false;
		}
		//创建文件夹：
		$foldername=date('Y-m-d');	//文件夹名称
		$folderpath=$this->path.$foldername;	//文件夹路径
		if (!file_exists($folderpath)) {
			mkdir($folderpath);
		}
		//文件上传：
		$filename=uniqid().strrchr($files['name'], '.');
		$filepath=$folderpath.'/'.$filename;
		if (move_uploaded_file($files['tmp_name'], $filepath)) {
			return "{$foldername}/{$filename}";
		}else{
			$this->error='文件上传失败';
			return false;
		}
	}
	}

 ?>