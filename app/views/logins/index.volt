<div class="page-header">
    <h1>
        Search logins
    </h1>
    <p>
        {{ link_to("logins/new", "Create logins") }}
    </p>
</div>

{{ content() }}

{{ form("logins/search", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

<div class="form-group">
    <label for="fieldId" class="col-sm-2 control-label">Id</label>
    <div class="col-sm-10">
        {{ text_field("id", "type" : "numeric", "class" : "form-control", "id" : "fieldId") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldLoginname" class="col-sm-2 control-label">Loginname</label>
    <div class="col-sm-10">
        {{ text_field("loginname", "size" : 30, "class" : "form-control", "id" : "fieldLoginname") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldPassword" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
        {{ text_field("password", "size" : 30, "class" : "form-control", "id" : "fieldPassword") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldCustomersId" class="col-sm-2 control-label">Customers</label>
    <div class="col-sm-10">
        {{ text_field("customers_id", "type" : "numeric", "class" : "form-control", "id" : "fieldCustomersId") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldAdmin" class="col-sm-2 control-label">Admin</label>
    <div class="col-sm-10">
        {{ text_field("admin", "type" : "numeric", "class" : "form-control", "id" : "fieldAdmin") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldTitle" class="col-sm-2 control-label">Title</label>
    <div class="col-sm-10">
        {{ text_field("title", "size" : 30, "class" : "form-control", "id" : "fieldTitle") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldLastname" class="col-sm-2 control-label">Lastname</label>
    <div class="col-sm-10">
        {{ text_field("lastname", "size" : 30, "class" : "form-control", "id" : "fieldLastname") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldFirstname" class="col-sm-2 control-label">Firstname</label>
    <div class="col-sm-10">
        {{ text_field("firstname", "size" : 30, "class" : "form-control", "id" : "fieldFirstname") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldPhone" class="col-sm-2 control-label">Phone</label>
    <div class="col-sm-10">
        {{ text_area("phone", "cols": "30", "rows": "4", "class" : "form-control", "id" : "fieldPhone") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldComment" class="col-sm-2 control-label">Comment</label>
    <div class="col-sm-10">
        {{ text_area("comment", "cols": "30", "rows": "4", "class" : "form-control", "id" : "fieldComment") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldEmail" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
        {{ text_field("email", "size" : 30, "class" : "form-control", "id" : "fieldEmail") }}
    </div>
</div>

<div class="form-group">
    <label for="fieldActive" class="col-sm-2 control-label">Active</label>
    <div class="col-sm-10">
        {{ text_field("active", "type" : "numeric", "class" : "form-control", "id" : "fieldActive") }}
    </div>
</div>


<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {{ submit_button('Search', 'class': 'btn btn-default') }}
    </div>
</div>

</form>
