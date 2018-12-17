<?php
/* Smarty version 3.1.32, created on 2018-12-12 02:36:16
  from 'E:\www\myblog\Application\View\Admin\link_list.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5c1074201a13b0_92479952',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd482db0f07b62c4d381b78b1a9dc6c2ba642d9d4' => 
    array (
      0 => 'E:\\www\\myblog\\Application\\View\\Admin\\link_list.html',
      1 => 1538977588,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c1074201a13b0_92479952 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style type="text/css">
		
	</style>
</head>
<body>
	<a href="index.php?p=Admin&c=Link&a=add" style="text-decoration: none;color: #f89d10;line-height: 50px;">添加友情链接</a>
	<form method="post" action="">
		<table cellspacing="0" cellpadding="0" bgcolor="#e6f2fb" border="1" width="1125" style="line-height: 30px;">
			<tr>
				<th>编号</th>
				<th>链接名</th>
				<th>链接地址</th>
				<th>修改</th>
				<th>删除</th>
			</tr>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list']->value, 'rows');
$_smarty_tpl->tpl_vars['rows']->iteration = 0;
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['rows']->value) {
$_smarty_tpl->tpl_vars['rows']->iteration++;
$__foreach_rows_0_saved = $_smarty_tpl->tpl_vars['rows'];
?>
			<tr align="center">
				<td><?php echo $_smarty_tpl->tpl_vars['rows']->iteration;?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['rows']->value['link_name'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['rows']->value['link_url'];?>
</td>
				<td><a href="index.php?p=Admin&c=Link&a=del&link_id=<?php echo $_smarty_tpl->tpl_vars['rows']->value['link_id'];?>
" style="text-decoration: none;color: #f89d10;" onclick="{if(confirm('确认删除?')){return true;}return false;}">删除</a></td>
				<td><a href="index.php?p=Admin&c=Link&a=update&link_id=<?php echo $_smarty_tpl->tpl_vars['rows']->value['link_id'];?>
" style="text-decoration: none;color: #f89d10;">修改</a></td>
			</tr>
			<?php
$_smarty_tpl->tpl_vars['rows'] = $__foreach_rows_0_saved;
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		</table>

	</form>
</body>
</html><?php }
}
