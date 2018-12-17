<?php
/* Smarty version 3.1.32, created on 2018-09-30 09:58:41
  from 'D:\www\web2\Application\View\Home\article.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5bb02dd1a08f73_69725637',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a19e20976ab95b0e6a83042952962fa8a4e26cc0' => 
    array (
      0 => 'D:\\www\\web2\\Application\\View\\Home\\article.html',
      1 => 1538272719,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5bb02dd1a08f73_69725637 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\www\\web2\\Framework\\Core\\Smarty\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN" lang="zh-CN">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="Content-Language" content="zh-CN" />
	<title>www.myblog.com - 数量测试 - Powered by ITCAST</title>
	<link rel="stylesheet"  href="./public/style/default.css" type="text/css" media="all"/>
	<?php echo '<script'; ?>
 src="script/common.js" type="text/javascript"><?php echo '</script'; ?>
>
</head>
<body class="single article">

<!-- top bar -->
<div id="top">
	<div class="center">
    <div class="menu-left">
    <ul>
     <li><a href="javascript:;" onclick="setHomepage('');">设为首页</a></li>
     <li><a href="javascript:;" onclick="addFavorite('','www.myblog.com - Welcome to TQBlog!')">收藏本站</a></li>      
    </ul>
    </div>
	 <div class="menu-right">
    <ul id="info">
	<?php if (isset($_SESSION['user'])) {?>	
        <li>欢迎 <?php echo $_SESSION['user']['user_name'];?>
！</li>
        <?php }?>
        <li><a href="index.php?p=Admin&c=Admin&a=admin" target="_blank">管理</a></li>
        <?php if (isset($_SESSION['user'])) {?>
        <li><a href="index.php?p=Admin&c=Login&a=logout">退出</a></li> 
        <?php }?>
    </ul>
    </div>
   </div>	
</div>
  
<div id="divAll">
	<div id="divPage">
	<div id="divMiddle">
		<div id="divTop">
			<h1 id="BlogTitle"><a href="">www.myblog.com</a></h1>
			<h3 id="BlogSubTitle">Welcome to TQBlog!</h3>
		</div>
		<div id="divNavBar">
			<ul>
				<li id="nvabar-item-index"><a href="">首页</a></li><li id="navbar-page-2"><a href="?id=2">留言本</a></li><li id="navbar-category-2"><a href="?cate=2">旅游</a></li>			</ul>
		</div>

		<div id="divMain">
<div class="post single">
	<h4 class="post-date"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['data']->value['info']['art_time'],'%Y-%m-%d %H:%M:%S');?>
</h4>
	<h2 class="post-title"><?php echo $_smarty_tpl->tpl_vars['data']->value['info']['art_title'];?>
</h2>
	<div class="post-body"><?php echo $_smarty_tpl->tpl_vars['data']->value['info']['art_content'];?>
</div>
	<h5 class="post-tags"></h5>
	<h6 class="post-footer">
		阅读:<?php echo $_smarty_tpl->tpl_vars['data']->value['info']['art_read'];?>
 |
		<a href="index.php?p=Home&c=article&a=UpDown&art_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['info']['art_id'];?>
&flag=1">赞</a>:<?php echo $_smarty_tpl->tpl_vars['data']->value['info']['art_up'];?>
 |
		<a href="index.php?p=Home&c=article&a=UpDown&art_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['info']['art_id'];?>
&flag=0">踩</a><?php echo $_smarty_tpl->tpl_vars['data']->value['info']['art_down'];?>
	</h6>
</div>



<label id="AjaxCommentBegin"></label>
<a href="index.php?p=Home&c=Article&a=prveNextArticle&art_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['info']['art_id'];?>
&type=0">上一篇</a>
<a href="index.php?p=Home&c=Article&a=prveNextArticle&art_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['info']['art_id'];?>
&type=1">下一篇</a>
<!--评论输出-->
<ul class="msg msghead">
	<li class="tbname">评论列表:</li>
</ul>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value['replay_list'], 'rows');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['rows']->value) {
?>
<ul id="cmt1" class="msg" style="margin_left:<?php echo $_smarty_tpl->tpl_vars['rows']->value['deep']*'50px';?>
">
	<li class="msgname"><img width="32" alt="" src="./Public/Uploads<?php echo $_smarty_tpl->tpl_vars['rows']->value['user_face'];?>
" class="avatar">&nbsp;<span class="commentname"><a target="_blank" rel="nofollow" href="index.php?p=Admin&c=Admin&a=admin"><?php echo $_smarty_tpl->tpl_vars['rows']->value['user_name'];?>
</a></span><br><small>发布于&nbsp;<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['rows']->value['replay_time'],'%Y-%m-%d %H:%M:%S');?>
&nbsp;&nbsp;<span class="revertcomment"><a onclick="RevertComment('1')" href="#comment">回复</a></span></small></li>
	<li class="msgarticle"><?php echo $_smarty_tpl->tpl_vars['rows']->value['replay_content'];?>
<label id="AjaxComment1"></label> 
		<label id="cmt2"></label>
		<ul id="cmt2" class="msg">
			
						<li class="msgname"><img width="32" alt="" src="image/admin/0.png" class="avatar">&nbsp;<span class="commentname"><a target="_blank" rel="nofollow" href="">admin</a></span><br><small>发布于&nbsp;2016-04-16 02:30:42&nbsp;&nbsp;<span class="revertcomment"><a onclick="RevertComment('3')" href="#comment">回复</a></span></small></li>
			<li class="msgarticle">fdasfdasdfasdf<label id="AjaxComment1"></label> 
								</ul>	
	</li>
</ul>
<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

<!--评论翻页条输出-->
<div class="pagebar commentpagebar">
</div>
<label id="AjaxCommentEnd"></label>

<!--评论框-->
<div class="post" id="divCommentPost">
	<p class="posttop"><a name="comment">admin发表评论:</a><a rel="nofollow" id="cancel-reply" href="#divCommentPost" style="display:none;"><small>取消回复</small></a></p>
	<form id="frmSumbit" method="post" action="" >	
		<p><label for="txaArticle">正文(*)</label></p>
		<p><textarea name="txaArticle" id="txaArticle" class="text" cols="50" rows="4" ></textarea></p>
		<p><input name="sumbit" type="submit" value="提交"  class="button" /></p>

		<!--增加数据-->
		<input type="hidden" name="a_id" value="2">
		<input type="hidden" name="module" value="Message">
		<input type="hidden" name="action" value="insert">
		<input type="hidden" name="inpRevID" id="inpRevID" value="0">
	</form>
	<p class="postbottom">☆欢迎发表您的看法、交流您的观点。</p>
</div>
		</div>
		<div id="divBottom">
        	<h3 id="BlogCopyRight">
                                            	Copyright © 2008-2028 tqtqtq.com All Rights Reserved            </h3>
			<h4 id="BlogPowerBy">Powered by <a href="http://www.tqtqtq.com/" title="TQBlog" target="_blank">TQBlog V2.0 Release 20140101</a></h4>
		</div><div class="clear"></div>
	</div><div class="clear"></div>
	</div><div class="clear"></div>
</div>
</body>
</html><!--86.655ms--><?php }
}
