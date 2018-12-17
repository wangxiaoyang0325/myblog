<?php 
namespace Controller\Home;
//前台控制器：
	class IndexController extends BaseController{
		public function indexAction(){
			//显示首页：
			$art_model=new \Model\ArticleModel();
			$recordcount=$art_model->getArticleCount();	//获取总记录数:
			// if (isset($_POST['q'])) {
			// 	$art_ArticleList=$art_model->getArticleTitle();
			// }
			// $art_titlelist=$art_model->getArticleTitle($string);
			$page=new \Lib\Page($recordcount,$GLOBALS['config']['app']['pagesize']);
			$art_list=$art_model->getPageList($page->startno,$GLOBALS['config']['app']['pagesize']);
			if (empty($_POST['title'])) {
				$art_list=$art_model->getHomelist();
				$page_str=$page->show();	//获取分页字符串：
				$cat_model=new \Model\CategoryModel();
				$cat_list=$cat_model->getCategoryTree();
				$link_model=new \Core\Model('link');
				$link_list=$link_model->select();
				$this->smarty->assign('data',array(
					'art_list' => $art_list,
					'cat_list' => $cat_list,
					'link_list' => $link_list,
					'page_str'	=> $page_str	
					
				));
				$this->smarty->display('index.html');
			}else{
				$art_list=$art_model->getsearchlist();
				$page_str=$page->show();	//获取分页字符串：
				$cat_model=new \Model\CategoryModel();
				$cat_list=$cat_model->getCategoryTree();
				$link_model=new \Core\Model('link');
				$link_list=$link_model->select();
				$this->smarty->assign('data',array(
					'art_list' => $art_list,
					'cat_list' => $cat_list,
					'link_list' => $link_list,
					'page_str'	=> $page_str
				));
				$this->smarty->display('index.html');
			}
		}
		
		
	}