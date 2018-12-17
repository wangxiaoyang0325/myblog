<?php
/* Smarty version 3.1.32, created on 2018-10-08 13:55:23
  from 'D:\www\web2\Application\View\Admin\link_update.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5bbaf14ba9ff72_83567542',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '84f82711ccd9b40a8320a9f89b7af550511298e0' => 
    array (
      0 => 'D:\\www\\web2\\Application\\View\\Admin\\link_update.html',
      1 => 1538978119,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5bbaf14ba9ff72_83567542 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form method="post" action="">
		<table cellspacing="0" cellpadding="0" bgcolor="#e6f2fb" border="1" align="center" width="500" style="line-height: 30px;">
			<caption><h2>修改链接</h2></caption>
			<tr align="center">
				<th>连接序号</th>
				<th>链接名</th>
				<th>链接地址</th>
			</tr>
			<tr align="center">
				<td><?php echo $_smarty_tpl->tpl_vars['data']->value['link_info']['link_id'];?>
</td>
				<td><input type="text" name="link_name" style="line-height:28px;" width="200" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['link_info']['link_name'];?>
"></td>
				<td><input type="text" name="link_url"  style="line-height:28px;" width="200" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['link_info']['link_url'];?>
"></td>
			</tr>
			<tr align="center">
				<td colspan="3"><button class="button bg-main" type="submit" name="">修改</button></td>
			</tr>
		</table>
	</form>
</body>
</html><?php }
}
