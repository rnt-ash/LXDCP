{# Template für SlideData Ansicht #}

{% block header %}{% endblock %}

<div class="well well-sm">
    {{ partial("partials/tableslide_header") }}
</div>

{# Flash Message #}
{{ flashSession.output() }}
{{ flash.output() }}

<div class="panel-group" role="tablist">
    {% if slides is defined %}
    {{ slides }}
    {% endif %}
</div>

<div class="well well-sm">
    <div class="text-center">
        {# Paginator #}
        {{ partial("partials/paginator") }}
    </div>
</div>

{% block footer %}{% endblock %}