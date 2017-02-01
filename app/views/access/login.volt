{% extends "layouts/nonsecure-base.volt" %}

{% block main %}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4" style="margin: 0 auto; float: none;">
        <div class="panel panel-default">
            <div class="panel-heading">
                Login
            </div>
            <form method="post" action="/login" id="login-form">
            <div class="panel-body">
                <fieldset>

                    {# Flash Message #}
                    <?php $this->flashSession->output(); ?>

                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input class="form-control" placeholder="loginname" type="text" name="loginname" autofocus>
                    </div>                    
                    
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <input class="form-control" placeholder="password" type="password" name="password">
                    </div>                    
                    
                    <div class="note">
                        <a href="/forgot-password">Forgot password?</a>
                    </div>
                </fieldset>
            </div>
            <div class="panel-footer">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
            </form>
        </div>
    </div>
</div>
{% endblock %}