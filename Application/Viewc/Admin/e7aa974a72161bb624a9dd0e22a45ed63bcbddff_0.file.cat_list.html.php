<?php
/* Smarty version 3.1.32, created on 2018-09-29 17:05:21
  from 'D:\www\web2\Application\View\Admin\cat_list.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5baf4051db66b6_96458531',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e7aa974a72161bb624a9dd0e22a45ed63bcbddff' => 
    array (
      0 => 'D:\\www\\web2\\Application\\View\\Admin\\cat_list.html',
      1 => 1538015703,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5baf4051db66b6_96458531 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title>拼图后台管理-后台管理</title>
    <link rel="stylesheet" href="./Application/View/Admin/css/pintuer.css">
    <link rel="stylesheet" href="./Application/View/Admin/css/admin.css">
</head>

<body>
<div class="admin">
	<form method="post">
    <div class="panel admin-panel">
    	<div class="panel-head"><strong>类别列表</strong></div>
        <div class="padding border-bottom">
          <input type="button" class="button button-small border-green" value="添加类别" onClick="location.href='index.php?p=Admin&c=Category&a=add'" />
        </div>
        <table class="table table-hover">
        	<tr>
        	  <th width="45">编号</th><th width="*">名称</th><th width="100">操作</th></tr>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list']->value, 'rows');
$_smarty_tpl->tpl_vars['rows']->iteration = 0;
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['rows']->value) {
$_smarty_tpl->tpl_vars['rows']->iteration++;
$__foreach_rows_0_saved = $_smarty_tpl->tpl_vars['rows'];
?>  
            <tr>
            <td><?php echo $_smarty_tpl->tpl_vars['rows']->iteration;?>
</td><td><?php echo str_repeat('&nbsp;',($_smarty_tpl->tpl_vars['rows']->value['deep']*8));
echo $_smarty_tpl->tpl_vars['rows']->value['cat_name'];?>
</td><td><a class="button border-blue button-little" href="index.php?p=Admin&c=Category&a=edit&cat_id=<?php echo $_smarty_tpl->tpl_vars['rows']->value['cat_id'];?>
">修改</a> 
                <a class="button border-yellow button-little" href="index.php?p=Admin&c=Category&a=del&cat_id=<?php echo $_smarty_tpl->tpl_vars['rows']->value['cat_id'];?>
" onclick="
            {if(confirm('确认删除?')){return true;}return false;}">删除</a></td></tr>
            <?php
$_smarty_tpl->tpl_vars['rows'] = $__foreach_rows_0_saved;
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </table>
    </div>
    </form>
    <br />
    <p class="text-right text-gray">基于<a class="text-gray" target="_blank" href="#">王晓阳</a>构建</p>
</div>
</body>
</html><?php }
}
