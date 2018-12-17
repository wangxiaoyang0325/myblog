<?php
/* Smarty version 3.1.32, created on 2018-09-29 16:22:16
  from 'D:\www\web2\Application\View\Admin\main.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5baf3638dd63e1_41558386',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '23d4e92e1a0e63d9987eb6e21e4c64c6587ff9dd' => 
    array (
      0 => 'D:\\www\\web2\\Application\\View\\Admin\\main.html',
      1 => 1537883598,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5baf3638dd63e1_41558386 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\www\\web2\\Framework\\Core\\Smarty\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>拼图后台管理-后台管理</title>
<link rel="stylesheet" href="./Application/View/Admin/css/pintuer.css">
<link rel="stylesheet" href="./Application/View/Admin/css/admin.css">
</head>

<body>
<div class="admin">
	<div class="line-big">
    	<div class="xm3">
        	<div class="panel border-back">
            	<div class="panel-body text-center">
                	<img src="./Public/Uploads/<?php echo $_SESSION['user']['user_face'];?>
" width="120" class="radius-circle" /><br />
                   <?php echo $_SESSION['user']['user_name'];?>

                </div>
<div class="panel-foot bg-back border-back">
                   <!--  您好，<?php echo $_SESSION['user']['user_name'];?>
，
                    这是您第<?php echo $_SESSION['user']['login_count'];?>
次登录，
                    <?php if (!empty($_SESSION['user']['last_login_time'])) {?>
                    上次登录为<?php echo smarty_modifier_date_format($_SESSION['user']['last_login_time'],'%Y-%m-%d %H:%M:%S');?>
。
                    <?php }?>
                    <?php if (!empty($_SESSION['user']['last_login_time'])) {?>
                    上次登录IP地址为：<?php echo long2ip($_SESSION['user']['last_login_ip']);?>

                    <?php }?> -->
                    <!-- 您好，<?php echo $_SESSION['user']['user_name'];?>
， -->
                    <!-- 这是您第<?php echo $_SESSION['user']['login_count'];?>
次登录， -->
                  <!--   <?php if (!empty($_SESSION['user']['last_login_time'])) {?> -->
                    <!-- 上次登录时间为:<?php echo smarty_modifier_date_format($_SESSION['user']['last_login_time'],'%Y-%m-%d %H:%M:%S');?>
, -->
                   <!--  <?php }?> -->
                    <!-- <?php if (!empty($_SESSION['user']['last_login_ip'])) {?> -->
                    <!-- 上次登录IP地址:<?php echo long2ip($_SESSION['user']['last_login_ip']);?>
 -->
                  <!--   <?php }?> -->
您好，<?php echo $_SESSION['user']['user_name'];?>
，
这是您第<?php echo $_SESSION['user']['login_count'];?>
次登录，
<?php if (!empty($_SESSION['user']['last_login_time'])) {?>
上次登录时间为:<?php echo smarty_modifier_date_format($_SESSION['user']['last_login_time'],'%Y-%m-%d %H:%M:%S');?>
,
<?php }
if (!empty($_SESSION['user']['last_login_ip'])) {?>
上次登录IP地址:<?php echo long2ip($_SESSION['user']['last_login_ip']);?>

<?php }?>
</div>
            </div>
            <br />
        	<div class="panel">
            	<div class="panel-head"><strong>站点统计</strong></div>
                <ul class="list-group">
                  <li><span class="float-right badge bg-main">828</span><span class="icon-file-text"></span> 内容</li>
                </ul>
            </div>
            <br />
        </div>
        <div class="xm9">
          <div class="panel">
       	    <div class="panel-head"><strong>系统信息</strong></div>
                <table class="table">
                	<tr><th colspan="2">服务器信息</th><th colspan="2">系统信息</th></tr>
                    <tr><td width="110" align="right">操作系统：</td><td>Windows 2008</td><td width="90" align="right">系统开发：</td><td><a href="#" target="_blank">王晓阳</a></td></tr>
                    <tr><td align="right">Web服务器：</td><td>Apache</td><td align="right">数据库：</td>
                  <td>MySQL</td></tr>
                    <tr><td align="right">程序语言：</td><td>PHP</td><td align="right">&nbsp;</td><td>&nbsp;</td></tr>
                </table>
            </div>
        </div>
    </div>
    <p class="text-right text-gray">基于<a class="text-gray" target="_blank" href="#">王晓阳</a>构建   <a href="http://www.mycodes.net/" target="_blank"></a></p>
    <br />
</div>
</body>
</html>
<?php }
}
