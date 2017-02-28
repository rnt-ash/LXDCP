<div class="page-header">
    <h2><i class="fa fa-cog" aria-hidden="true"></i> Administration</h2>
</div>

<div class="well well">
    <h2>{{_("index_inventory")}}</h2>
    <p>{{_("index_inventory_teaser")}}</p>
    {{ link_to("administration/scanAllVS/",'Start','class': 'btn btn-primary') }}
</div>

{{ partial("partials/core/administration/index") }}