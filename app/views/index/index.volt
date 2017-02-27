<div class="page-header">
    <h2><i class="fa fa-tachometer" aria-hidden="true"></i> {{ _("index_dashboard") }}</h2>
</div>


<div class="jumbotron">
    <p>{{ _("index_welcome") }}</p>
</div>

<div class="well well">
    <h2>{{_("index_inventory")}}</h2>
    <p>{{_("index_inventory_teaser")}}</p>
    {{ link_to("index/scanAllVS/",'Start','class': 'btn btn-primary') }}
</div>

<div class="well well">
    <h2>Permissions</h2>
    {{ link_to("index/genPermissionsPDF/",'generate Permissions PDF','class': 'btn btn-primary', 'target': '_blank') }}
</div>

<div class="well well">
    <h2>OVZ Jobs</h2>
    {{ link_to("index/genOVZJobsPDF/",'generate OVZ-Jobs PDF','class': 'btn btn-primary', 'target': '_blank') }}
</div>

<div class="well well">
    <h2>Actions</h2>
    {{ link_to("index/genActionsPDF/",'generate Actions PDF','class': 'btn btn-primary', 'target': '_blank') }}
</div>
