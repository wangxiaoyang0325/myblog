<?php
/* Smarty version 3.1.32, created on 2018-09-29 16:46:36
  from 'D:\www\web2\Application\View\Admin\link_add.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5baf3bec4eaf04_72471842',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0d5d33e10a0ca77c856a5903abfcfff5bb69c20c' => 
    array (
      0 => 'D:\\www\\web2\\Application\\View\\Admin\\link_add.html',
      1 => 1538210792,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5baf3bec4eaf04_72471842 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form method="post" action="">
		<table cellspacing="0" cellpadding="0" bgcolor="#e6f2fb" border="1" align="center" width="500" style="line-height: 30px;">
			<caption><h2>添加链接</h2></caption>
			<tr align="center">
				<th>链接名</th>
				<th>链接地址</th>
			</tr>
			<tr align="center">
				<td><input type="text" name="link_name" style="line-height:28px;" width="200" ></td>
				<td><input type="text" name="link_url"  style="line-height:28px;" width="200" ></td>
			</tr>
			<tr align="center">
				<td colspan="2"><input type="submit" name="" value="添加"></td>
			</tr>
		</table>
	</form>
</body>
</html><?php }
}
