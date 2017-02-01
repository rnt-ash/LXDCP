<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("logins/index", "Go Back") }}</li>
            <li class="next">{{ link_to("logins/new", "Create ") }}</li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>Search result</h1>
</div>

{{ content() }}

<div class="row">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Id</th>
            <th>Loginname</th>
            <th>Password</th>
            <th>Customers</th>
            <th>Admin</th>
            <th>Title</th>
            <th>Lastname</th>
            <th>Firstname</th>
            <th>Phone</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Active</th>

                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        {% if page.items is defined %}
        {% for login in page.items %}
            <tr>
                <td>{{ login.getId() }}</td>
            <td>{{ login.getLoginname() }}</td>
            <td>{{ login.getPassword() }}</td>
            <td>{{ login.getCustomersId() }}</td>
            <td>{{ login.getAdmin() }}</td>
            <td>{{ login.getTitle() }}</td>
            <td>{{ login.getLastname() }}</td>
            <td>{{ login.getFirstname() }}</td>
            <td>{{ login.getPhone() }}</td>
            <td>{{ login.getComment() }}</td>
            <td>{{ login.getEmail() }}</td>
            <td>{{ login.getActive() }}</td>

                <td>{{ link_to("logins/edit/"~login.getId(), "Edit") }}</td>
                <td>{{ link_to("logins/delete/"~login.getId(), "Delete") }}</td>
            </tr>
        {% endfor %}
        {% endif %}
        </tbody>
    </table>
</div>

<div class="row">
    <div class="col-sm-1">
        <p class="pagination" style="line-height: 1.42857;padding: 6px 12px;">
            {{ page.current~"/"~page.total_pages }}
        </p>
    </div>
    <div class="col-sm-11">
        <nav>
            <ul class="pagination">
                <li>{{ link_to("logins/search", "First") }}</li>
                <li>{{ link_to("logins/search?page="~page.before, "Previous") }}</li>
                <li>{{ link_to("logins/search?page="~page.next, "Next") }}</li>
                <li>{{ link_to("logins/search?page="~page.last, "Last") }}</li>
            </ul>
        </nav>
    </div>
</div>
