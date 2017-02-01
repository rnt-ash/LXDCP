<div class="page-header">
    <h2><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</h2>
</div>


<div class="jumbotron">
    <p>Welcome to the World of OVZ Control Panel.</p>
</div>

<div class="well well">
    <h2>Inventory</h2>
    <p>Looking for VirtualServers on connected PhysicalServers and collect those VirtualServers and save them in OVZ Control Panel.</p>
    {{ link_to("index/scanAllVS/",'Start','class': 'btn btn-primary') }}
</div>

{% if config.application.mode == 'debug' %}
<div class="well">
    <h2>Faker</h2>
    <p>Fillup database with data from the faker class.<br />
    With a click on Start there will be created ten rows in each table (except logins and jobs)<p>
    {{ link_to('index/faker', 'Start', 'class': 'btn btn-primary') }}</p>
</div>
{% endif %}
