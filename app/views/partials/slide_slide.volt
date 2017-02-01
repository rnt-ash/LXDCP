{# Partial für die Detailanzeige bei Slides #}

<div id="slide_{{slideid}}" class="panel panel-default">
    <div class="panel-heading">
        <span role="button" data-toggle="collapse" data-target="#slide_detail_{{slideid}}" aria-expanded="false" aria-controls="slide_detail_{{slideid}}" onclick="{{onclick}}">
            <h4 class="panel-title">{{slideheader}}
                <div class="pull-left">
                    <i id="slide_detail_icon_{{slideid}}" class="{%if state=="show" %}fa fa-chevron-down{% else %}fa fa-chevron-right{% endif %} pull-left"></i>
                </div>
            </h4>
        </span>
    </div>
    <div id="slide_detail_{{slideid}}" class="panel-wrapper collapse {%if state=="show" %}in{% endif %}">
        <div id=slide_detail_body_{{slideid}} class="panel-body">
            {% if slidedetail is defined %}{{slidedetail}}{% endif %}
        </div>
    </div>
</div>

