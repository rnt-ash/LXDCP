<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>
            {% block title %}{{ appTitle }}
                {% if pageTitle is defined %}
                    &bull; {{ pageTitle }}
                {% endif %}
            {% endblock %}
        </title>
        <meta name="apple-mobile-web-app-title" content="{{ appTitle }}">
        <meta name="description" content="">
        <meta name="author" content="">                         

        <!-- Bootstrap https://www.bootstrapcdn.com/ -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link href="{% if sessionBootwatchTheme is defined %}https://bootswatch.com/{{ sessionBootwatchTheme }}/bootstrap.css{% endif %}" rel="stylesheet" name="bootswatch">
        
        {% block head %}
            {# css includes #}
            {{ stylesheet_link("/css/navbar.css") }}
            {{ stylesheet_link("/css/style.css") }}
            {{ stylesheet_link("/css/bootcomplete.css") }}
        {% endblock %}
        
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
        
        <!-- Bootstrap Select -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
        
        <!-- Fixed Top Menue -->
        <style>body { padding-top: 70px;}</style>        
        
        <!-- FAVICONS -->
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
                                                                      
    </head>
    <body>
        <div id="pageWrapper" {% if sidebarToggled=="true" %}class="toggled"{% endif %}>
            {# Header #}
            {% include "layouts/navbar.volt" %}
        
            {# Left navigation #}
            {% include "layouts/sidebar.volt" %}

            <div class="col-lg-12 col-md-12 col-xs-12 container page-content-wrapper">
                {# Flash Message #}
                {{ flashSession.output() }}
                {{ flash.output() }}

                {% block content %}{% endblock %}
            </div>

            {# javascript includes #}
            {{ javascript_include("/js/navbar.js") }}
            {{ javascript_include("/js/tableslidedata.js") }}
            {{ javascript_include("/js/loadingScreen.js") }}
            {{ javascript_include("/js/genPassword.js") }}
            {{ javascript_include("/js/jquery.bootcomplete.js") }}
            {% block jsfooter %}{% endblock %}
        </div>
    </body>
</html>