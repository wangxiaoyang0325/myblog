<?php 
	namespace Model;
	class ArticleModel extends \Core\Model{
		private $tree=array();
		//获取用户自己的文章：
		public function getlist(){
			$sql='select a.*,c.cat_name from article a inner join category c using(cat_id) where is_recycle=0 and user_id='.$_SESSION['user']['user_id'];
				return $this->db->fetchAll($sql);
		}
		//软删除：
		public function softDel($art_id){
			$sql="update article set is_recycle=1 where art_id in ($art_id)";
			return $this->db->exec($sql);
		}
		//后台搜索：
		public function searchList(){
		    $sql='select a.*,c.cat_name from article a inner join category c using(cat_id) where is_recycle=0 and user_id='. $_SESSION['user']['user_id'];
		    if($_POST['cat_id']!=''){
		        $cat_model=new CategoryModel();
		        $sub_cat_list=$cat_model->getCategoryTree($_POST['cat_id']);    //找出cat_id的子级
		        $sub_cat_ids[0]=$_POST['cat_id'];
		        foreach($sub_cat_list as $rows){
		            $sub_cat_ids[]=$rows['cat_id'];
		        }
		        $ids= implode(',', $sub_cat_ids);       //自己和子级的cat_id数组
		        $sql.=" and cat_id in ({$ids})";
		    }
		    if($_POST['title']!=='')
		        $sql.=" and art_title like '%{$_POST['title']}%'";
		    if($_POST['content']!=='')
		        $sql.=" and art_content like '%{$_POST['content']}%'";
		    if($_POST['is_public']!=='')
		        $sql.=" and is_public={$_POST['is_public']}";
		    if($_POST['is_top']!=='')
		        $sql.=" and is_top={$_POST['is_top']}";
		    return $this->db->fetchAll($sql);            
		}
		//获取所有公开的，不在回收站的文章：
		public function getHomelist(){
			$sql='select a.*,c.cat_name,u.user_name from article a inner join category c using(cat_id) inner join user u using(user_id) where is_public=1 and is_recycle=0 order by is_top desc';
			return $this->db->fetchAll($sql);
		}
        public function getHomeArticleListByCatId($cat_id){
            $cat_model=new CategoryModel();
            $cat_list=$cat_model->getCategoryTree($cat_id);
            $ids[]=$cat_id;     //$ids数组保存自己和子级的cat_id
            foreach($cat_list as $rows){
                $ids[]=$rows['cat_id'];
            }
            $ids= implode(',', $ids);
            $sql="select a.*,c.cat_name,u.user_name from article a inner join category c using(cat_id) inner join user u using (user_id) where is_recycle=0 and is_public=1 and cat_id in ($ids) order by is_top desc";
            return $this->db->fetchAll($sql);
        }
        //阅读数加一：
        public function updateArticleReadCount($art_id){
        //art_1表示编号是1的文章：
        	if (isset($_SESSION['art_'.$art_id])) {
        		return;
        	}
        	//表示编号是$art_id的文章已经读过了，防止灌水。
        	$_SESSION['art_'.$art_id]=1;	
        	$sql="update article set art_read=art_read+1 where art_id=$art_id";
        	return $this->db->exec($sql);
        }
        //踩和赞
        //@param $art_id int 文章编号：
        //@param $flag int 0:踩 1：赞；
        public function setUpDown($art_id,$flag){
        	if(isset($_SESSION['updown_'.$art_id]))//代表已经踩过或者赞过：
        		return false;
        	if($flag){
        		$sql="update article set art_up=art_up+1 where art_id=$art_id";
        	}else{
        		$sql="update article set art_down=art_down+1 where art_id=$art_id";
        	}
        	$_SESSION['updown_'.$art_id]=1;		//表示已经踩过或者赞过
        	return $this->db->exec($sql);
        }
        //上一篇和下一篇：
        //@param $art_id int 当前文章的id；
        //@param $type int 0:上一篇   1：下一篇：
        //@return  int 返回上一篇和下一篇的编号：
        public function getPrveNextArtId($art_id,$type){
        	if($type){
        		$sql="select art_id from article where art_id>$art_id and is_recycle=0 and is_public=1 order by art_id desc limit 1";
        	}else{
        		$sql="select art_id from article where art_id<$art_id and is_recycle=0 and is_public=1 order by art_id desc limit 1";
        	}
        	return $this->db->fetchColumn($sql);
        }
        //获取回复树：
        public function getreplayTree($art_id){
        	$sql="select r.*,u.user_name,u.user_face from replay r natural join user u where art_id=$art_id";
        	$list=$this->db->fetchAll($sql);
        	$this->createTree($list);
        	return $this->tree;
        }
        //创建树形结构：
        private function createTree($list,$parent_id=0,$deep=0){
        	foreach($list as $rows){
        		if($rows['parent_id']==$parent_id){
        			$rows['deep']=$deep;
        			$this->tree[]=$rows;
        			$this->createTree($list,$rows['replay_id'],$deep+1);
        		}
        	}
        }
        //获取Article分页：
        //@param $startno int 起始位置：
        //@param $pagesize int 页面大小：
        //@return array 当前页面的记录：
        public function getPageList($startno,$pagesize){
        	$sql="select a.*,c.cat_name,u.user_name from article a inner join category c using(cat_id) inner join user u using (user_id) where is_recycle=0 and is_public=1 order by is_top desc";
        	$sql.="limit $startno,$pagesize";
        }
        public function getArticleCount(){
        	$sql="select count(*) from article where is_public=1 and is_recycle=0";
        	return $this->db->fetchColumn($sql);
        }
        //显示回收站的文章：
        public function recyclelist(){
            $sql='select a.*,c.cat_name from article a inner join category c using(cat_id) where is_recycle=1 and user_id='.$_SESSION['user']['user_id'];
                return $this->db->fetchAll($sql);
        }
        //恢复回收站内文章：
        public function rec($art_id){
            $sql="update article set is_recycle=0 where art_id in ($art_id)";
            return $this->db->exec($sql);
        }
        //删除回收站内文章：
        public function realdelete($art_id){
            $sql="delete from article where art_id=$art_id";
            return $this->db->exec($sql);
        }
        //搜索内容：
        public function getsearchlist(){
            $sql="select a.*,c.cat_name,u.user_name from article a inner join category c using(cat_id) inner join user u using(user_id) where is_public=1 and is_recycle=0 and art_title like '%{$_POST['title']}%'";
             return $this->db->fetchAll($sql);
        }
	}