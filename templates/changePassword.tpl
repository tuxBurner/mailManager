<div class="well">
    <h1>Change password for <strong>{$smarty.get.mail}</strong></h1>

    <form role="form" method="POST" action="?domain={$smarty.get.domain}">
        <input type="hidden" name="doAction" value="changePassword"/>
        <input type="hidden" name="mail" value="{$smarty.get.mail}"/>
        <div class="form-group">
            <label for="inputPassword">Password</label>
            <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password"/>
        </div>
        <div class="form-group">
            <label for="inputRePassword">Retype password</label>
            <input type="password" class="form-control" id="inputRePassword" name="rePassword"
                   placeholder="Retype password"/>
        </div>
        <a href="?domain={$smarty.get.domain}" class="btn btn-default">Cancel</a>
        <button type="submit" class="btn btn-primary">Change</button>
    </form>
</div>