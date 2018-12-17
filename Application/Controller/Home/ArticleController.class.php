<?php
namespace Controller\Home;
class ArticleController extends BaseController{
    public function listAction(){
        $art_model=new \Model\ArticleModel();
        $cat_id=(int)$_GET['cat_id'];
        $recordcount=$art_model->getArticleCount(); //获取总记录数:
        $page=new \Lib\Page($recordcount,$GLOBALS['config']['app']['pagesize']);
        $art_list=$art_model->getPageList($page->startno,$GLOBALS['config']['app']['pagesize']);
        $page_str=$page->show();    //获取分页字符串： 
        $art_list=$art_model->getHomeArticleListByCatId($cat_id);
        $cat_model=new \Model\CategoryModel();
        $cat_list=$cat_model->getCategoryTree();
        $link_model=new \Core\Model('link');
        $link_list=$link_model->select();
        $this->smarty->assign('data',array(
           'art_list' => $art_list,
           'cat_list' => $cat_list,
           'link_list' =>$link_list,
           'page_str'   => $page_str
        ));
        $this->smarty->display('list.html');
    }
    //内容页面：
    public function articleAction(){
        $art_id=$_GET['art_id'];
        //执行添加主评论：
        if (!empty($_POST)) {
            //如果没有登录，就先登录：
            if (!isset($_SESSION['user'])) {
                $this->error('index.php?p=Admin&c=Login&a=login','添加回复先前数据');
            }
            //如果登陆了就添加回复的数据：
            $data['art_id']=$art_id;
            $data['user_id']=$_SESSION['user']['user_id'];
            $data['replay_content']=$_POST['txaArticle'];
            $data['replay_time']=time();
            $data['parent_id']=0;
            $replay_model=new \Core\Model('replay');
            if ($replay_model->insert($data)) {
                $this->success('index.php?p=Home&c=Article&a=article&art_id='.$art_id,'评论成功');
            }else{
                $this->error('index.php?p=Home&c=Article&a=article&art_id='.$art_id,'评论失败');
            }
        }
        $model=new \Model\ArticleModel();
        $model->updateArticleReadCount($art_id);
        $info=$model->Find($art_id);
        $replay_model=new \Model\ArticleModel();
        $replay_list=$replay_model->getreplayTree($art_id);
        $this->smarty->assign('data',array(
            'info' => $info,
            'replay_list' => $replay_list
        ));
        $this->smarty->display('article.html');
    }
    //赞、踩：
    public function UpDownAction(){
        $art_id=(int)$_GET['art_id'];
        $flag=(int)$_GET['flag'];   //1:赞，0：踩
        $art_model=new \Model\ArticleModel();
        $msg=$flag?'赞':'踩';
        if ($art_model->setUpDown($art_id,$flag)) {
            $this->success('index.php?p=Home&c=Article&a=article&art_id='.$art_id,'成功');
        }else{
            $this->error('index.php?p=Home&c=Article&a=article&art_id='.$art_id,'失败');
                //上一篇或者下一篇：}
        }
    } 
    public function prveNextArticleAction(){
        $art_id_1=(int)$_GET['art_id'];     //当前文章的id
        $type=(int)$_GET['type'];       //0：上一篇  1：下一篇
        $art_model=new \Model\ArticleModel();
        if ($art_id_2=$art_model->getPrveNextArtId($art_id_1,$type)) {
            header("location:index.php?p=Home&c=Article&a=article&art_id=$art_id_2");   //跳转到文章页面：
         }else{
            $msg=$type?'已经是最后一篇了':'已经是第一篇了';
            $this->error('index.php?p=Home&c=Article&a=article&art_id='.$art_id_1,$msg);
        }
    }
}
