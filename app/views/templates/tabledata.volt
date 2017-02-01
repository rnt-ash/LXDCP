{# Template for TableData View #}

{% set controller = dataInfo['controller'] %}
{% set contaction = controller~"/"~dataInfo['action'] %}
{% set orderdir = dataInfo['orderdir']=='asc'?'desc':'asc' %}

{% block header %}{% endblock %}

<div class="panel panel-default">
    <div class="panel-heading">
        <form id="toolbar" action="" method="get">
            <div class="row">
                <div class="col-sm-2">        
                    {{ select_static('limit',['10':'10 rows','25':'25 rows','50':'50 rows','100':'100 rows'],'size':'1','class':'form-control','onchange':'javascript: this.form.submit();') }}
                </div>
                <div class="col-sm-5">        
                </div>
                <div class="col-sm-5">        
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-search" onclick="$('form#toolbar').submit();"></i></span>
                        {{ text_field("filterAll",'class':'form-control','placeholder':'Filter') }}
                        <span class="input-group-addon"><i class="fa fa-times" onclick="$('#filterAll').val('');$('form#toolbar').submit();"></i></span>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-condensed">
                <thead >
                    <th>{{ link_to(controller~"/new",'<i class="fa fa-plus"></i>','class': 'btn btn-default btn-xs') }}</th>
                    {% for index,column in dataInfo['columns'] %}
                    <th>{{link_to(contaction~"?order="~index~"&orderdir="~orderdir ,column['title'])}}</th>
                    {% endfor %}
                </thead>

                <tbody>
                    {% if page.items is defined %}
                    {% for item in page.items %}
                    <tr>
                        <td>
                            {# Actions abholen #}
                            {{ link_to(controller~"/edit/"~item['id'],'<i class="fa fa-pencil"></i>','class': 'btn btn-default btn-xs' ) }}
                            <a href='#' link="{{"/"~controller~"/delete/"~item['id']}}" text="Are you sure to delete this item?"
                                class='btn btn-default btn-xs delete-tableslide-item'><i class="fa fa-trash-o"></i></a>
                        </td>
                        {% for index,column in dataInfo['columns'] %}
                        <td>{{ item[index] }}</td>
                        {% endfor %}
                    </tr>
                    {% endfor %}
                    {% endif %}
                </tbody>
            </table>
        </div>
    </div>
    <div class="panel-footer">
        <div class="text-center">
            {# Paginator #}
            {{ partial("partials/paginator") }}
        </div>
    </div>
</div>

{% block footer %}{% endblock %}
