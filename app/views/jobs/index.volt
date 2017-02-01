{# Job index view #}

{% set contaction = "/jobs/index" %}

<div class="page-header">
    <h2><i class="fa fa-tasks" aria-hidden="true"></i> Jobs</h2>
</div>

<div class="well">
    {{link_to("/jobs/updateJobs",'<i class="fa fa-refresh"></i> update Jobs','class': 'btn btn-primary') }}
</div>

<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th>Server</th>
                <th>Jobtype</th>
                <th>Created</th>
                <th>Sent</th>
                <th>Executed</th>
                <th>Done</th>
            </tr>
        </thead>
        <tbody>
            {% if page.items is defined %}
                {% for job in page.items %}
                    <tr>
                        <td>
                            {% if config.application.mode == 'debug' %}
                                {{link_to("/jobs/delete/"~job.id,'<i class="fa fa-trash"></i>','class': 'btn btn-primary btn-xs') }}
                            {% endif %}
                            {{ job.getServer().name }}
                        </td>
                        <td>{{ job.type }}</td>
                        <td>{{ job.created }}</td>
                        <td>{{ job.sent }}</td>
                        <td>{{ job.executed }}</td>
                        <td>
                            {% if job.done == -1 %}
                              <i class="fa fa-play text-primary"></i>  
                            {% elseif job.done == 0 %}
                              <i class="fa fa-pause text-primary"></i>  
                            {% elseif job.done == 1 %}
                              <i class="fa fa-check text-success"></i>  
                            {% elseif job.done == 2 %}                            
                              <i class="fa fa-exclamation text-danger"></i>  
                            {% endif %}
                        </td>
                    </tr>
                    {% if config.application.mode == 'debug' %}
                        <tr>
                            <td colspan="6">Params: {{job.params}}<br>Retval :{{job.retval}}<br>Error :{{job.error|nl2br}}</td>
                        </tr>
                    {% endif %}
                {% endfor %}
            {% endif %}
        </tbody>
    </table>
</div>

<div class="text-center">
    {# Paginator #}
    {{ partial("partials/paginator") }}
</div>
