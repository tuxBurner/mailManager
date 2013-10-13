<?php /* Smarty version Smarty-3.1.15, created on 2013-10-13 23:26:15
         compiled from "templates/selectDomain.tpl" */ ?>
<?php /*%%SmartyHeaderCode:65267748525a981363c9c9-20729157%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8ce9b23bb7f72320095032a32fc13d44a04aeca6' => 
    array (
      0 => 'templates/selectDomain.tpl',
      1 => 1381699566,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '65267748525a981363c9c9-20729157',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_525a98136519d4_90457977',
  'variables' => 
  array (
    'DOMAINS' => 0,
    'domain' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_525a98136519d4_90457977')) {function content_525a98136519d4_90457977($_smarty_tpl) {?><div class="row">
    <div class="col-md-6">
        <div class="well">
            <h2>Select a domain</h2>

            <form role="form" method="GET" action="index.php" class="form-inline">
                <input type="hidden" name="action" value="displayDomain"/>

                <div class="form-group">
                    <select name="domain" id="selectDomain" class="form-control">
                        <?php  $_smarty_tpl->tpl_vars['domain'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['domain']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['DOMAINS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['domain']->key => $_smarty_tpl->tpl_vars['domain']->value) {
$_smarty_tpl->tpl_vars['domain']->_loop = true;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['domain']->value['domain'];?>
"><?php echo $_smarty_tpl->tpl_vars['domain']->value['domain'];?>
</option>
                        <?php } ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Select</button>
            </form>
        </div>
    </div>

    <div class="col-md-6">
        <div class="well">
            <h2>Add a new domain</h2>

            <form role="form" method="POST" action="index.php" class="form-inline">
                <input type="hidden" name="doAction" value="addDomain"/>

                <div class="form-group">
                    <label class="sr-only" for="inputDomainName">Domain:</label>
                    <input type="text" class="form-control" id="inputDomainName" name="domainName"
                           placeholder="Domainname"/>
                </div>
                <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </div>
    </div>
</div><?php }} ?>
