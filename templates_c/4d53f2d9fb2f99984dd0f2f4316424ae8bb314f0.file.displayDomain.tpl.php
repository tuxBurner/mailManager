<?php /* Smarty version Smarty-3.1.15, created on 2013-10-24 09:41:42
         compiled from "templates/displayDomain.tpl" */ ?>
<?php /*%%SmartyHeaderCode:43701810525aa351a68119-12854243%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4d53f2d9fb2f99984dd0f2f4316424ae8bb314f0' => 
    array (
      0 => 'templates/displayDomain.tpl',
      1 => 1382607698,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '43701810525aa351a68119-12854243',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_525aa351a75375_83458731',
  'variables' => 
  array (
    'DOMAIN_PATH_EXISTS' => 0,
    'DOMAIN_PATH' => 0,
    'MAILS' => 0,
    'mail' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_525aa351a75375_83458731')) {function content_525aa351a75375_83458731($_smarty_tpl) {?><h1>
    Domain: <?php echo $_GET['domain'];?>

    <a class="btn btn-danger" href="?doAction=deleteDomain&domain=<?php echo $_GET['domain'];?>
"
       onclick="return confirm('Delete domain: <?php echo $_GET['domain'];?>
 ?');">Delete</a>
</h1>

<?php if ($_smarty_tpl->tpl_vars['DOMAIN_PATH_EXISTS']->value==false) {?>
    <div class="alert alert-danger">Domainpath: <strong><?php echo $_smarty_tpl->tpl_vars['DOMAIN_PATH']->value;?>
</strong> does not exists. Will be created by cronjob.</div>
<?php }?>

<div class="well">
    <h2>Add new mail</h2>

    <form role="form" method="POST" action="?domain=<?php echo $_GET['domain'];?>
" class="form-inline">
        <input type="hidden" name="doAction" value="addMail"/>

        <div class="form-group">
            <label class="sr-only" for="inputUsername">Username</label>
            <input type="text" class="form-control" id="inputUsername" name="userName" placeholder="Username"/>
        </div>
        <div class="form-group">
            <label class="sr-only" for="inputPassword">Password</label>
            <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password"/>
        </div>
        <div class="form-group">
            <label class="sr-only" for="inputRePassword">Retype password</label>
            <input type="password" class="form-control" id="inputRePassword" name="rePassword"
                   placeholder="Retype password"/>
        </div>
        <button type="submit" class="btn btn-primary">Add</button>
    </form>
</div>


<?php if (count($_smarty_tpl->tpl_vars['MAILS']->value)==0) {?>
    <div class="alert alert-danger">No mails found for <strong><?php echo $_GET['domain'];?>
</strong></div>
<?php } else { ?>
    <div class="well">
        <h2>Found <strong><?php echo count($_smarty_tpl->tpl_vars['MAILS']->value);?>
</strong> mails</h2>
        <table class="table">
            <thead>
            <tr>
                <th>Mail</th>
                <th>Path</th>
                <th>Ready</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbod>
                <?php  $_smarty_tpl->tpl_vars['mail'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['mail']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['MAILS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['mail']->key => $_smarty_tpl->tpl_vars['mail']->value) {
$_smarty_tpl->tpl_vars['mail']->_loop = true;
?>
                    <tr>
                        <td><?php echo $_smarty_tpl->tpl_vars['mail']->value['username'];?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['mail']->value['DIR'];?>
</td>
                        <td>
                            <?php if ($_smarty_tpl->tpl_vars['mail']->value['DIR_EXISTS']==false) {?>
                              <span class="label label-danger"><i class="glyphicon glyphicon-unchecked"></i></span>
                            <?php } else { ?>
                              <span class="label label-success"><i class="glyphicon glyphicon-check"></i></span>
                            <?php }?>
                        </td>
                        <td>
                            <a class="btn btn-danger"
                               href="?doAction=deleteMailAddr&domain=<?php echo $_GET['domain'];?>
&mail=<?php echo $_smarty_tpl->tpl_vars['mail']->value['username'];?>
"
                               onclick="return confirm('Delete mail: <?php echo $_smarty_tpl->tpl_vars['mail']->value['username'];?>
 ?');">Delete</a>
                            <a class="btn btn-primary"
                               href="?action=passwordMailAddr&domain=<?php echo $_GET['domain'];?>
&mail=<?php echo $_smarty_tpl->tpl_vars['mail']->value['username'];?>
">Password</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbod>

        </table>
    </div>
<?php }?>
<?php }} ?>
