<div class="page-header">
    <h1>Profile</h1>
</div>
<div class="col-lg-8">
    <table class="table">
        <thead>
            <tr>
                <th colspan="2">
                    <h5 class="panel-title pull-left">General informations</h5>
                    {{ link_to("logins/edit/"~login.id,'<i class="fa fa-pencil-square fa-2x"></i>','class':'pull-right') }}
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="col-lg-3">Title</td><td>{{ login.title }}</td>
            </tr>
            <tr>
                <td>Lastname</td><td>{{ login.lastname }}</td>
            </tr>
            <tr>
                <td>Firstname</td><td>{{ login.firstname }}</td>
            </tr>
            <tr>
                <td>Customer</td><td>{{ login.customer }}</td>
            </tr>    
            <tr>
                <td>E-Mail</td><td>{{ login.email }}</td>
            </tr>
            <tr>
                <td>Phone</td><td>{{ login.phone }}</td>
            </tr>
            <tr>
                <td>Comment</td><td>{{ login.comment }}</td>
            </tr>
        </tbody>
    </table>
</div>
<div class="col-xs-12">
    <table class="table" id="changeTheme">
        <thead>
            <tr>
                <th colspan="2">
                    <h5 class="panel-title pull-left">Theme</h5>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div>
                        Click on your prefered image to change the theme or go back to the <b><a href="#/" id="defaultTheme">default</a></b> Bootstrap layout. <br />
                        Currently selected theme: 
                        <b><span id="currentTheme">
                            {% if login.bootswatchTheme is not empty %} 
                                {{ login.bootswatchTheme }}
                            {% else %}
                                default
                            {% endif %}   
                        </span></b>
                    </div>
                    <div id="{{ login.settings['bootswatchTheme'] }}" class="selectTheme clearfix"></div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
{{ javascript_include("/js/bootswatch.js") }}