{# Edit customer form #}

{%- macro renderElement(element, form) %}
    {% if form.hasMessagesFor(element) %}{% set error = 'has-error has-feedback' %}{% else %}{% set error = '' %}{% endif %}
    <div class="form-group {{error}} ">
        {{ form.get(element).label(['class': 'control-label']) }}
        {{ form.get(element).render(['class': 'form-control']) }}
        {% if form.hasMessagesFor(element) %}
            <span class="form-control-feedback"><i class="fa fa-exclamation-triangle"></i></span>
            <span class="help-block">{{form.getMessagesFor(element)[0]}}</span>
        {% endif %}
    </div>
{%- endmacro %}    

<div class="page-header">
    <h2><i class="fa fa-users" aria-hidden="true"></i> Customers</h2>
</div>

<div class="well">
    {{ form("customers/save", 'role': 'form') }}
    {{ form.get('id').render() }}

    {% if form.hasMessagesFor('id') %}
        <div class="alert alert-danger" role="alert">{{form.getMessagesFor('id')[0]}}</div>  
    {% endif %}

    
    {{ renderElement('firstname',form) }}
    {{ renderElement('lastname',form) }}
    {{ renderElement('company',form) }}
    {{ renderElement('company_add',form) }}
    {{ renderElement('street',form) }}
    {{ renderElement('po_box',form) }}
    {{ renderElement('zip',form) }}
    {{ renderElement('city',form) }}
    {{ renderElement('phone',form) }}
    {{ renderElement('email',form) }}
    {{ renderElement('website',form) }}
    {{ renderElement('comment',form) }}
    {{ renderElement('active',form) }}

    {{ submit_button("Save", "class": "btn btn-primary") }}
    {{ link_to('/customers/tabledata', 'Cancel', 'class': 'btn btn-default pull-right') }}
            
    </form>
</div>
