<nav class="navbar navbar-default navbar-fixed-top">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="true" aria-controls="navbar">
                <span class="sr-only">Navigation ein-/ausblenden</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>            
            {{ link_to('index', appTitle, 'class': 'navbar-brand') }}
            <a id="menu-toggle" class="btn btn-primary pull-right" title="Navigation ein-/ausblenden"><i class="fa fa-navicon"></i></a><br />
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="headerNavText">{{ link_to('index/index', '<i class="fa fa-tachometer fa-fw" aria-hidden="true"></i>&nbsp; Dashboard') }}</li>
                <li class="headerNavText">{{ link_to('customers/tabledata', '<i class="fa fa-users fa-fw" aria-hidden="true"></i>&nbsp; Customers') }}</li>
                <li class="headerNavText">{{ link_to('colocations/slidedata', '<i class="fa fa-globe fa-fw" aria-hidden="true"></i>&nbsp; Colocations') }}</li>
                <li class="headerNavText">{{ link_to('physical_servers/slidedata', '<i class="fa fa-server fa-fw" aria-hidden="true"></i>&nbsp; Physical Servers') }}</li>
                <li class="headerNavText">{{ link_to('virtual_servers/slidedata', '<i class="fa fa-cube fa-fw" aria-hidden="true"></i>&nbsp; Virtual Servers')}}</li>
                <li class="headerNavText">{{ link_to('jobs/index', '<i class="fa fa-tasks fa-fw" aria-hidden="true"></i>&nbsp; Jobs') }}</li>
                <li id="account">
                    <a href="#" class="navbar-link dropdown-toggle" data-toggle="dropdown">
                        <span class="fa fa-user-circle fa-fw"></span>&nbsp;{{ sessionLoginname }}
                    </a>
                    <ul class="dropdown-menu list-group col-sm-12" role="menu">
                        <li>{{ link_to('logins/profile', '<span class="fa fa-home"></span> Profile') }}</li>
                        <li>{{ link_to('logins/resetPasswordForm/'~sessionLoginId, '<span class="fa fa-key"></span> Reset password') }}</li>
                        <hr>
                        <li>{{ link_to('access/logout', '<span class="fa fa-sign-out"></span> Logout') }}</li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>