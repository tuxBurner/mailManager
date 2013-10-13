<?php /* Smarty version Smarty-3.1.15, created on 2013-10-13 23:13:19
         compiled from "templates/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1782855813525a920eed2528-71457277%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '81a0270564c79ee7a1c4f40d2a5e8bcfac7e3570' => 
    array (
      0 => 'templates/login.tpl',
      1 => 1381698485,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1782855813525a920eed2528-71457277',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_525a920eedb379_49996424',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_525a920eedb379_49996424')) {function content_525a920eedb379_49996424($_smarty_tpl) {?><div class="well">
    <form role="form" method="POST" action="index.php">
        <input type="hidden" name="doAction" value="login"/>

        <div class="form-group">
            <label for="inputUsername">Username:</label>
            <input type="text" class="form-control" id="inputUsername" name="userName" placeholder="Username"/>
        </div>
        <div class="form-group">
            <label for="inputPassword">Password</label>
            <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password"/>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div><?php }} ?>
