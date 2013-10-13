<div class="well">
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
</div>