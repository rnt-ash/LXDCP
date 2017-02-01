{# Reset password form #}

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


<div class="well">
    <h2>Reset password</h2>
</div>
<div class="well">
    {{ form("logins/resetPassword", 'role': 'form') }}

    {{ form.get('login_id').render() }}
    {% if form.hasMessagesFor('login_id') %}
        <div class="alert alert-danger" role="alert">{{form.getMessagesFor('id')[0]}}</div>  
    {% endif %}

    {{ renderElement('old_password',form) }}
    {{ renderElement('password',form) }}
    {{ renderElement('confirm_password',form) }}

    {{ submit_button("Save", "class": "btn btn-primary") }}
    {{ link_to('/logins/profile', 'Cancel', 'class': 'btn btn-default pull-right') }}
            
    </form>
</div>
<div class="well well-sm">
    Reset Password Footer
</div>