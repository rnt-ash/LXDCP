<div class="page-header">
    <h2><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</h2>
</div>


<div class="jumbotron">
    <p>{{ _("index_welcome") }}</p>
</div>

<div class="well well">
    <h2>{{_("index_inventory")}}</h2>
    <p>{{_("index_inventory_teaser")}}</p>
    {{ link_to("index/scanAllVS/",'Start','class': 'btn btn-primary') }}
</div>
