<div class="row">
    <div class="col-md-6">
        <div class="well">
            <h2>Select a domain</h2>

            <form role="form" method="GET" action="index.php" class="form-inline">
                <input type="hidden" name="action" value="displayDomain"/>

                <div class="form-group">
                    <select name="domain" id="selectDomain" class="form-control">
                        {foreach $DOMAINS as $domain}
                            <option value="{$domain.domain}">{$domain.domain}</option>
                        {/foreach}
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
</div>