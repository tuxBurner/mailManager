<h1>
    Domain: {$smarty.get.domain}
    <a class="btn btn-danger" href="?doAction=deleteDomain&domain={$smarty.get.domain}"
       onclick="return confirm('Delete domain: {$smarty.get.domain} ?');">Delete</a>
</h1>

{if $DOMAIN_PATH_EXISTS == false}
    <div class="alert alert-danger">Domainpath: <strong>{$DOMAIN_PATH}</strong> does not exists. Will be created by cronjob.</div>
{/if}

<div class="well">
    <h2>Add new mail</h2>

    <form role="form" method="POST" action="?domain={$smarty.get.domain}" class="form-inline">
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


{if count($MAILS) == 0}
    <div class="alert alert-danger">No mails found for <strong>{$smarty.get.domain}</strong></div>
{else}
    <div class="well">
        <h2>Found <strong>{count($MAILS)}</strong> mails</h2>
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
                {foreach $MAILS as $mail}
                    <tr>
                        <td>{$mail.username}</td>
                        <td>{$mail.DIR}</td>
                        <td>
                            {if $mail.DIR_EXISTS == false}
                              <span class="label label-danger"><i class="glyphicon glyphicon-unchecked"></i></span>
                            {else}
                              <span class="label label-success"><i class="glyphicon glyphicon-check"></i></span>
                            {/if}
                        </td>
                        <td>
                            <a class="btn btn-danger"
                               href="?doAction=deleteMailAddr&domain={$smarty.get.domain}&mail={$mail.username}"
                               onclick="return confirm('Delete mail: {$mail.username} ?');">Delete</a>
                            <a class="btn btn-primary"
                               href="?action=passwordMailAddr&domain={$smarty.get.domain}&mail={$mail.username}">Password</a>
                        </td>
                    </tr>
                {/foreach}
            </tbod>

        </table>
    </div>
{/if}
