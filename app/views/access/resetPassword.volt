{% extends "layouts/nonsecure-base.volt" %}
{% block main %}

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4" style="margin: 0 auto; float: none;">
        <div class="panel panel-default">
            <div class="panel-heading">
                Login
            </div>
            <form method="post" action="/reset-password/{{ resetHashToken }}" id="reset-form">
            <div class="panel-body">
                <fieldset>

                    {# Flash Message #}
                    <?php $this->flashSession->output(); ?>

                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <input class="form-control" placeholder="New Password" type="password" name="new_password">
                    </div>                    
                    
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="fa fa-check"></i></span>
                        <input class="form-control" placeholder="Confirm New Password" type="password" name="confirm_password">
                    </div>                    

                </fieldset>
            </div>
            <div class="panel-footer">
                <a href="/login" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-primary">Change Password</button>
            </div>
            </form>
        </div>
    </div>
</div>

{% endblock %}