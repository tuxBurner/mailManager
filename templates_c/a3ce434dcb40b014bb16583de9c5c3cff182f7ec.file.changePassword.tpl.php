<?php /* Smarty version Smarty-3.1.15, created on 2013-10-13 23:10:24
         compiled from "templates/changePassword.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1795846253525b0bcdb49eb3-13447788%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a3ce434dcb40b014bb16583de9c5c3cff182f7ec' => 
    array (
      0 => 'templates/changePassword.tpl',
      1 => 1381698618,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1795846253525b0bcdb49eb3-13447788',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_525b0bcdb75b47_14422495',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_525b0bcdb75b47_14422495')) {function content_525b0bcdb75b47_14422495($_smarty_tpl) {?><div class="well">
    <h1>Change password for <strong><?php echo $_GET['mail'];?>
</strong></h1>

    <form role="form" method="POST" action="?domain=<?php echo $_GET['domain'];?>
">
        <input type="hidden" name="doAction" value="changePassword"/>
        <input type="hidden" name="mail" value="<?php echo $_GET['mail'];?>
"/>
        <div class="form-group">
            <label for="inputPassword">Password</label>
            <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password"/>
        </div>
        <div class="form-group">
            <label for="inputRePassword">Retype password</label>
            <input type="password" class="form-control" id="inputRePassword" name="rePassword"
                   placeholder="Retype password"/>
        </div>
        <a href="?domain=<?php echo $_GET['domain'];?>
" class="btn btn-default">Cancel</a>
        <button type="submit" class="btn btn-primary">Change</button>
    </form>
</div><?php }} ?>
