<?php

$messages = [

    // examples
    "hi"      => "Hello",
    "bye"     => "Good Bye",
    "hi-name" => "Hello %name%",
    "song"    => "This song is %song%",

    // Controllerbase
    "controllerbase_object_not_found" => "Object not found!",
    "controllerbase_no_permission_to_this_object" => "No permissions to this object!",
    
    // access
    "access_login_panelheader" => "Login",
    "access_loginname" => "loginname",
    "access_password" => "password",
    "access_forgott_password" => "Forgott password?",
    "access_login_button" => "Login",
    
    // index
    "index_dashboard" => "Dashboard",
    "index_welcome" => "Welcome to the World of OVZ Control Panel.",
    "index_inventory" => "Inventory",
    "index_inventory_teaser" =>"Looking for VirtualServers on connected PhysicalServers to collect those and save them in OVZ Control Panel.",
    
    // Customers
    "customers_customers" => "customers",
    "customers_all_customers" => "All Customers",
    "customers_at_least_lastname_or_company_must_be_set" => "At least lastname or company must be set.",
    "customers_correct_mail" => "Please enter a correct mail adress",
    "customers_correct_domain" => "Please enter a correct domain",
    "customers_correct_active" => "Active must be a digit",
    "customers_admin_cant_delete" => "The customer with the ID=1 can't be deleted. (Administrator)",
    // CustomersForm
    "customers_form_firstname" => "Firstname",
    "customers_form_lastname" => "Lastname",
    "customers_form_company" => "Company",
    "customers_form_companyadd" => "Company add",
    "customers_form_street" => "Street",
    "customers_form_pobox" => "P.O. Box",
    "customers_form_zip" => "ZIP Code",
    "customers_form_city" => "City",
    "customers_form_phone" => "Phone",
    "customers_form_email" => "E-Mail",
    "customers_form_website" => "Website",
    "customers_form_comment" => "Comment",
    "customers_form_active" => "Active",
    
    // Partners
    "partners_customer" => "Customer",
    "partners_customer_required" => "Customer is required",
    "partners_customer_digit" => "Customer id must be a digit",
    "partners_partner_required" => "Partner is required",
    "partners_partner_digit" => "Partner id muste be a digit",
    "partners_partner_same_customer" => "Partner can't be identical to customer",
    "partners_partner_already_exists" => "Partner has already been assigned to this customer",
    "partners_customer_empty" => "Please select a valid customer",
    "partners_partner_empty" => "Please select a valid partner",
    "partners_uuid_required" => "UUID of the partner is required",
    "partners_uuid_not_exists" => "UUID does not exist",
    "partners_added_successfully" => "Partner was added successfully",
    // PartnersForm
    "partners_form_customer" => "Customer",
    "partners_form_choose_customer" => "Please choose a customer...",
    "partners_form_partner" => "Partner",
    "partners_form_choose_partner" => "Please choose a partner...",
    // View
    "partners_save" => "Save",
    "partners_cancel" => "Cancel",
    
    // Colocations
    "colocation_all_colocations" => "All Colocations",
    "colocations_invalid_level" => "invalid level!",
    "colocations_choose_customer" => "Please, choose a customer...",
    "colocations_customer" => "customer",
    "colocations_name" => "name",
    "colocations_colocationname" => "My colocation name",
    "colocations_description" => "Description",
    "colocations_description_info" => "some additional information to this colocation...",
    "colocations_location" => "location",
    "colocations_location_info" => "My location",
    "colocations_activ_date" => "activation date",
    "colocations_name_required" => "name required",
    "colocations_namemax" => "name is to long",
    "colocations_namemin" => "name is to short",
    "colocations_name_valid" => "Name must be alphanumeric and may contain the characters \, -, _ and space.",
    "colocations_customer_required" => "customer required",
    "colocations_location_max" => "location is to long",
    "colocations_location_max" => "location is to short",
    "colocations_locaton_valid" => "location must be alphanumeric and may contain the characters \, -, _ and space.",
    //View
    "colocations_title" => " Colocations",
    "colocations_view_physicalserver" => "Physical Servers",
    "colocations_view_nophysicalserver" => "No physical server found...",
    "colocations_view_ipobjects" => "IP Objects",
    "colocations_view_newipobject" => "Add new IP object",
    "colocations_view_noipobjects" => "No IP objects found...",
    "colocations_view_editipobject" => "Edit IP object",
    "colocations_view_delmessage" => "Are you sure you want to delete this item ?",
    "colocations_view_delete" => "Delete IP object",
    "colocations_generalinfo" => "General Information",
    "colocations_editovz" => "Edit OVZ settings",
    "colocations_delcolocation" => "Delete colocation",
    "colocations_view_customer" => "Customer",
    "colocations_view_activdate" => "Activation date",
    "colocations_view_description" => "Description",
    "colocations_title" => " Colocations",
    "colocations_save" => "Save",
    "colocations_cancel" => "Cancel",
    "colocations_genpdf" => "Generate IP objects PDF",
    "colocations_ipobjects" => "IP objects", 
     
    // IP Objects
    "ipobjects_address_is_now_main" => "IP Address %address% is now main.",
    "ipobjects_item_not_found" => "item was not found!",
    "ipobjects_item_not_exist" => "item does not exist!",
    "ipobjects_ip_success" => "IP Adress was updated successfully",
    "ipobjects_ip_not_found" => "IP object was not found !",
    "ipobjects_ip_conf_failed" => "Configure IP on virtual server failed: ",
    "ipobjects_ip_delete_success" => "IP Object was deleted successfully",
    "ipobjects_ip_adress" => "IP object must be an adress",
    "ipobjects_ip_assigned" => "IP Object must be assigned",
    "ipobjects_ip_update_failed" => "Update IP Object failed!",
    "ipobjects_ip" => "IP adress",
    "ipobjects_ip_addition" => "Additional IP Value",
    "ipobjects_ip_additioninfo" => "Empty | Subnetmask if IP Address | End IP Address if Range | Prefix if Subnet",
    "ipobjects_allocated" => "Allocated",
    "ipobjects_ismain" => "Is main",
    "ipobjects_isnotmain" => "Is not main",
    "ipobjects_ip_main" => "Main IP",
    "ipobjects_comment" => "comment",
    "ipobjects_commentinfo" => "Some additional information to IP Object",
    "ipobjects_dco_submit" => "No DCO submitted.",
    "ipobjects_ip_not_valid" => "Not a valid IP Address",
    "ipobjects_secont_value_valid" => "Not a valid second value",
    "ipobjects_assigned_ip" => "Assigned IPs can't be range or net",
    "ipobjects_no_reservation" => "No reservations found.",
    "ipobjects_ip_notpart_reservation" => "IP is not part of an existing reservation.",
    "ipobjects_ip_already_exists" => "IP already exists.",
    "ipobjects_ip_required" => "IP adress is required",
    "ipobjects_ip_valid" => "Wrong characters in IP Address.",
    "ipobjects_second-value_check" => "Wrong characters in second Value.",
    "ipobjects_main" => "Main can only be 0 or 1.",
    "ipobjects_allocated_value" => "Please choose a correct Allocated Value.",
    "ipobjects_comment_length" => "Comment is too long (max. 50 characters)",
    "ipobjects_unexpected_type" => "Unexpected Type!",
    //View
    "ipobjects_edit_title" => "IP Objects",
    "ipobjects_reservations" => "Reservations",
    "ipobjects_edit_cancel" => "Cancel",
    "ipobjects_edit_save" => "Save",
      
    // Physical Servers
    "physicalserver_all_physicalservers" => "All Physical Servers",
    "physicalserver_does_not_exist" => "Physical Server does not exist: ",
    "physicalserver_not_ovz_enabled" => "Server ist not OVZ enabled!",
    "physicalserver_job_failed" => "Executing the following job failed: ",
    "physicalserver_update_failed" => "Updating the server failed: ",
    "physicalserver_update_success" => "Settings successfully updated",
    "physicalserver_remove_server_first" => "Please remove virtual server first !",
    "physicalserver_not_found" => "Physical server not found !",
    "physicalserver_connection_prepare_title" => "Prepare instructions",
    "physicalserver_connection_prepare_instructions" => "Before connecting to the OpenVZ-Server there must be executed several commands. With this commands the system is updated and some needed software packages will be installed.",
    "physicalserver_connection_success" => "Connection successfully established to: ",
    "physicalserver_connection_restart" => "It's strongly recommended to restart the server after connecting!",
    "physicalserver_connection_failed" => "Connection to OVZ failed: ",
    "physicalserver_name" => "Name",
    "physicalserver_myserver" => "My Server",
    "physicalserver_fqdn" => "FQDN",
    "physicalserver_hostdomaintld" => "host.domain.tld",
    "physicalserver_choose_customer" => "Please, choose a customer...",
    "physicalserver_customer" => "Customer",
    "physicalserver_choose_colocation" => "Please, choose the colocation...",
    "physicalserver_colocation" => "Colocation",
    "physicalserver_cores" => "Cores",
    "physicalserver_cores_available" => "available cores  (e.g. 4)",
    "physicalserver_memory" => "Memory",
    "physicalserver_memory_available" => "Available memory in MB (e.g. 2048)",
    "physicalserver_space" => "Space",
    "physicalserver_space_available" => "available space in MB (e.g. 102400)",
    "physicalserver_activ_date" => "Activation date",
    "physicalserver_discription" => "Description",
    "physicalserver_discription_info" => "some additional information to this server...",
    "physicalserver_name_required" => "name is required",
    "physicalserver_messagemax" => "name too long",
    "physicalserver_messagemax" => "name too short",
    "physicalserver_name_valid" => "Name must be alphanumeric and may contain the characters \, -, _ and space.",
    "physicalserver_fqdn_required" => "FQDN is required",
    "physicalserver_fqdn_valid" => "must be a String separated by points",
    "physicalserver_core_required" => "core is required",
    "physicalserver_memory_required" => "memory is required",
    "physicalserver_space_required" => "space is required",
    "physicalserver_username" => "username",
    "physicalserver_root" => "root",
    "physicalserver_username_required" => "username is required",
    "physicalserver_password" => "password",
    "physicalserver_password_required" => "password is required",
    "physicalserver_permission" => "Not allowed for this Physical Server",
    "physicalserver_not_ovz_integrated" => "Physical Server is not OVZ integrated.",
    "physicalserver_job_create_failed" => "Creating Physical Server failed: ",
    "physicalserver_filter_all_customers" => "All Customers",
    "physicalserver_filter_all_colocations" => "All Colocations",
    // View 
    "physicalserver_connect_title" => "Physical Servers OVZ Connector",
    "physicalserver_connect_connectbutton" => "Connect",
    "physicalserver_title" => "Physical Server",
    "physicalserver_ip_notfound" => "No IP Objects found...",
    "physicalserver_save" => "Save",
    "physicalserver_cancel" => "Cancel",    
    "physicalserver_general_title" => "General Information",
    "physicalserver_general_editsettings" => "Edit settings",
    "physicalserver_general_updatesettings" => "Update OVZ settings",
    "physicalserver_general_updatestatistics" => "Update statistics of the host (hardware usage)",
    "physicalserver_general_connectovz" => "Connect OVZ",
    "physicalserver_confirm_removeserver" => "Are you sure you want to delete this Item",
    "physicalserver_tooltip_removeserver" => "Remove this server",
    "physicalserver_general_customer" => "Customer:",
    "physicalserver_general_hosttype" => "Hosttype:",
    "physicalserver_general_colocation" => "Colocation:",
    "physicalserver_general_activdate" => "Activation date:",
    "physicalserver_general_description" => "Description:",
    "physicalserver_general_fqdn" => "FQDN:",
    "physicalserver_hw_title" => "HW Specifications",
    "physicalserver_hw_cores" => "CPU-Cores:",
    "physicalserver_hw_ram" => "Memory (RAM):",
    "physicalserver_hw_space" => "Space:",
    "physicalserver_ip_title" => "IP Objects",
    "physicalserver_ip_addobject" => "Add new IP-objects",
    "physicalserver_ip_editobject" => "Edit IP object",
    "physicalserver_ip_deleteconf" => "Are you sure you want to delete this IP object ?",
    "physicalserver_ip_delete" => "Delete IP object",
    "physicalserver_ip_primary" => "Make IP object to primary",
    "physicalserver_slide_title" => "Physical Servers",
 
    // Virtual Server
    "virtualserver_all_virtualservers" => "All Virtual Servers",
    "virtualserver_does_not_exist" => "Virtual server does not exist: ",
    "virtualserver_not_ovz_integrated" => "Virtual server is not OVZ integrated",
    "virtualserver_job_failed" => "Job (ovz_modify_vs) executions failed! Error: ",
    "virtualserver_update_failed" => "Updating the virual server failed: .",
    "virtualserver_invalid_level" => "invalid level!",
    "virtualserver_server_not_ovz_enabled" => "Server is not OVZ enabled!",
    "virtualserver_job_infolist_failed" => "Job (ovz_list_info) executions failed: ",
    "virtualserver_info_success" => "Informations successfully updated",
    "virtualserver_job_create_failed" => "Create virtual server failed.",
    "virtualserver_job_start_failed" => "Job (ovz_start_vs) executions failed: ",
    "virtualserver_job_start" => "Started virtual server successfully",
    "virtualserver_job_stop_failed" => "Job (ovz_stop_vs) executions failed: ",
    "virtualserver_job_stop" => "Stopped virtual server successfully",
    "virtualserver_job_restart_failed" => "Job (ovz_restart_vs) executions failed: ",
    "virtualserver_job_restart" => "Restarted virtual server successfully",
    "virtualserver_not_found" => "Virtual server not found.",
    "virtualserver_job_destroy_failed" => "Deleting/ Destroying Virtual server failed: ",
    "virtualserver_job_destroy" => "Virtual server deleted/ destroyed sucessfully.",
    "virtualserver_job_ostemplates_failed" => "Job (ovz_get_ostemplates) executions failed!",
    "virtualserver_job_listsnapshots_failed" => "Job (ovz_list_snapshots) executions failed!",
    "virtualserver_snapshot_update" => "Snapshotlist successfully updated",
    "virtualserver_job_switchsnapshotexec_failed" => "Job (ovz_switch_snapshot) executions failed!",
    "virtualserver_job_switchsnapshot_failed" => "Switching snapshot on server failed: ",
    "virtualserver_job_createsnapshotexec_failed" => "Job (ovz_create_snapshot) executions failed!",
    "virtualserver_job_createsnapshot_failed" => "Create snapshot on server failed: ",
    "virtualserver_job_deletesnapshotexec_failed" => "Job (ovz_delete_snapshot) executions failed!",
    "virtualserver_job_createsnapshot_failed" => "Deleting snapshot on server failed: ",
    "virtualserver_IP_not_valid" => " is not a valid IP address",
    "virtualserver_min_core" => "minimum core is 1",
    "virtualserver_max_core" => "Virtual server can not have more cores than the host (host cores: ",
    "virtualserver_ram_numeric" => "RAM is nor numeric",
    "virtualserver_min_ram" => "Minimum RAM is 512 MB",
    "virtualserver_max_ram" => "Virtual Server can not have more memory than the host (host memory: ",
    "virtualserver_space_numeric" => "Space is not numeric",
    "virtualserver_min_space" => "Minimum space is 20 GB",
    "virtualserver_max_space" => "Virtual Server can not use more space than the host (host space: ",
    "virtualserver_job_modifysnapshotexec_failed" => "Job (ovz_modify_vs) executions failed: ",
    "virtualserver_job_modifyvs" => "Modifying virtual server successfully",
    "virtualserver_name" => "Name",
    "virtualserver_myserver" => "My Server",
    "virtualserver_choose_customer" => "Please choose a customer...",
    "virtualserver_customer" => "customer",
    "virtualserver_choose_physicalserver" => "Please choose a physical server...",
    "virtualserver_physicalserver" => "Physical servers",
    "virtualserver_cores" => "Cores",
    "virtualserver_cores_example" => "available cores  (e.g. 4)",
    "virtualserver_memory" => "Memory",
    "virtualserver_memory_example" => "available memory in MB (e.g. 2048)",
    "virtualserver_space" => "Space",
    "virtualserver_space_example" => "available space in MB (e.g. 102400)",
    "virtualserver_activdate" => "Activation date",
    "virtualserver_description" => "description",
    "virtualserver_description_info" => "some additional information to this server...",
    "virtualserver_rootpassword" => "Root password",
    "virtualserver_choose_ostemplate" => "Please choose a OS template",
    "virtualserver_name_required" => "name is required",
    "virtualserver_namemax" => "name is to long",
    "virtualserver_namemin" => "name is to short",
    "virtualserver_name_valid" => "Name must be alphanumeric and may contain the characters \, -, _ and space.",
    "virtualserver_fqdn_valid" => "must be a String separated by points",
    "virtualserver_customer_required" => "customer is required",
    "virtualserver_physicalserver_required" => "Physical server is required",
    "virtualserver_core_required" => "core is required",
    "virtualserver_memory_required" => "memory is required",
    "virtualserver_space_required" => "space is required",
    "virtualserver_password_required" => "password required",
    "virtualserver_passwordmin" => "Password is too short. Minumum 8 characters",
    "virtualserver_passwordmax" => "Password is too long. Maximum 12 characters",
    "virtualserver_passwordregex" => "Password may only contain numbers, characters and -_.",
    "virtualserver_ostemplate_required" => "OS Template required",
    "virtualserver_hostname" => "hostname",
    "virtualserver_hostname_valid" => "must be a string separated by points",
    "virtualserver_memory_specify" => "please specify if it is either GB or MB",
    "virtualserver_discspace" => "discspace",
    "virtualserver_discspace_example" => "available space in GB  (e.g. 100)",
    "virtualserver_discspace_required" => "Diskspace is required",
    "virtualserver_discspace_specify" => "please specify if it is either TB,GB or MB",
    "virtualserver_dnsserver" => "DNS-Server",
    "virtualserver_startonboot" => "Start on boot",
    "virtualserver_startonboot_info" => "Start on boot can either be 0 or 1",
    "virtualserver_snapshotname" => "Snapshotname",
    "virtualserver_snapshotname_replica" => "Name must not contain replica.",
    "virtualserver_snapshotname_required" => "Name must be alphanumeric and may contain the characters -_().!? and space.",
    "virtualserver_description_valid" => "Description mus not longer be than 250 characters",
    "virtualserver_modify_job_failed" => "Modifying virtual server failed: ",
    "virtualserver_change_root_password" => "Change root password",
    "virtualserver_root_password" => "New password",
    "virtualserver_confirm_root_password" => "Confirm password",
    "virtualserver_password_confirm_match" => "The passwords do not match",
    "virtualserver_change_root_password_successful" => "The root password has successfully been changed",
    "virtualserver_change_root_password_failed" => "The root password could not be changed: ",
    //View
    "virtualserver_title" => "Virtual Servers",
    "virtualserver_view_new" => "New",
    "virtualserver_view_independentsys" => "Independent System",
    "virtualserver_view_container" => "Container (CT)",
    "virtualserver_view_vm" => "Virtual Machine (VM)",
    "virtualserver_view_vm_beta" => "(will not work in Beta!)",
    "virtualserver_snapshot" => "Snapshots",
    "virtualserver_save" => "Save",
    "virtualserver_cancel" => "Cancel",
    "virtualserver_snapshot_refresh" => "Refresh Snapshots",
    "virtualserver_snapshot_create" => "Create a new Snapshot",
    "virtualserver_snapshot_created" => "Snapshot successfully created",
    "virtualserver_snapshot_run" => "Current run",
    "virtualserver_snapshot_switchinfo" => "Are you sure you want to switch to this Snapshot ?",
    "virtualserver_snapshot_switch" => "Switch to this Snapshot",
    "virtualserver_snapshot_switched" => "Successfully switched to Snapshot",
    "virtualserver_snapshot_deleteinfo" => "Are you sure you want to delete this snapshot?",
    "virtualserver_snapshot_delete" => "Delete Snapshot",
    "virtualserver_snapshot_deleted" => "Snapshot successfully deleted",
    "virtualserver_snapshot_new" => "Create new Snapshot",
    "virtualserver_ipobject" => "IP Objects",
    "virtualserver_ip_newobject" => "Add new IP object",
    "virtualserver_noipobject" => "No IP objects found...",
    "virtualserver_ip_edit" => "Edit IP object",
    "virtualserver_ip_deleteinfo" => "Are you sure you want to delete this IP object ?",
    "virtualserver_ip_delete" => "Delete IP object",
    "virtualserver_ip_primary" => "Make IP object to primary",
    "virtualserver_hwspec" => "HW Specifications",
    "virtualserver_hwspec_cpu" => "CPU-Cores: ",
    "virtualserver_hwspec_memory" => "Memory (RAM): ",
    "virtualserver_hwspec_space" => "Space",
    "virtualserver_generalinfo" => "General Information",
    "virtualserver_general_start" => "Start",
    "virtualserver_general_stop" => "Stop",
    "virtualserver_general_restart" => "Restart",
    "virtualserver_general_editovz" => "Edit OVZ settings",
    "virtualserver_general_updateovz" => "Update OVZ informations",
    "virtualserver_general_updatestats" => "Update OVZ statistics",
    "virtualserver_general_setpwd" => "Set new password",
    "virtualserver_general_deleteinfo" => "Are you sure you want to delete this item",
    "virtualserver_general_delete" => "Delete virtual server",
    "virtualserver_general_customer" => "Customer: ",
    "virtualserver_general_fqdn" => "FQDN: ",
    "virtualserver_general_physicalserver" => "Physical server: ",
    "virtualserver_general_activdate" => "Activation date: ",
    "virtualserver_general_state" => "State: ",
    "virtualserver_general_description" => "Description",
    "virtualserver_filter_all_customers" => "All customers",
    "virtualserver_filter_all_physical_servers" => "All physical servers",
    "virtualserver_no_physicalserver_found" => "No Physical Server found, CTs can't be created",
    "virtualserver_save_replica_slave_failed" => "Saving repica slave failed",
    "virtualserver_job_sync_replica_failed" => "Synchronisation of replicas failed",
    "virtualserver_update_replica_master_failed" => "Updating replica master failed",
    "virtualserver_replica_sync_run_in_background" => "Replica synchronisation is running in background",
    "virtualserver_isnot_replica_master" => "Virtual server is not replica master",
    "virtualserver_replica_running_in_background" => "Replica is running in background",
    "virtualserver_replica_master_not_stopped" => "Replica master is not stopped",
    "virtualserver_replica_slave_not_stopped" => "Replica slave is not stopped",
    'virtualserver_replica_failover_success' => "Replica failover successfull",
    "virtualserver_server_not_replica_master" => "Server is not replica master",
    "virtualserver_server_not_replica_slave" => "Server is not replica slave",
    "virtualserver_replica_master_update_failed" => "Failed to update the replica master",
    "virtualserver_replica_slave_update_failed" => "Failed to update the replica slave",
    "virtualserver_replica_switched_off" => "Replica got switched off",

    // Push
    "push_parameter_pending_is_not_a_string_or_an_array" => "Parameter pending is not a string or an array.",
    "push_entity_is_pending" => "The representative entity is pending. Cannot execute job directly now.",
    "push_execute_job_failed" => "Execute Job failed: ",
    "push_insert_job_failed" => "Job insert failed: ",
    "push_update_job_failed" => "Job update failed: ",
    "push_problems_while_job_execution" => "Problems occured while executing jobs: ",
    "push_dependency_not_set" => "Dependency has to be set and must be bigger than 0", 
    "push_dependency_parent_failed" => "Job cannot be executed and has failed because the parent Job failed.",
    "push_dependency_parent_running" => "Job cannot be executed because parent Job hasn't finished successfully yet.",
    "push_pending_entity_not_implements_interface" => "The created pending entity does not implement the needed interface.",
    "push_key_id_not_in_response" => "Key id does not exist in job response.",
    "push_key_executed_not_in_response" => "Key executed does not exist in job response.",
    "push_key_done_not_in_response" => "Key done does not exist in job response.",
    "push_key_error_not_in_response" => "Key error does not exist in job response.",
    "push_key_warning_not_in_response" => "Key warning does not exist in job response.",
    "push_key_retval_not_in_response" => "Key retval does not exist in job response.",
    
    // LoginControllerBase
    "logins_genpdf_title" => "Datasheet Hostingadministration",
    "logins_genpdf_contactperson" => "Contact Person",
    "logins_genpdf_confidentialdata" => "Confidential data will only be passed to this contact person.",
    "logins_genpdf_logindata" => "Logindata",
    "logins_genpdf_checkdata" => "Please check your logindata and change your password.",
    "logins_genpdf_name" => "Name: ",
    "logins_genpdf_email" => "Email: ",
    "logins_genpdf_url" => "URL: ",
    "logins_genpdf_loginname" => "Loginname: ",
    "logins_genpdf_pwd" => "Password: ",
    "logins_genpdf_misc" => "Miscellaneous",
    "logins_genpdf_ending" => "With this Logindata you can change your Hostingconfigurtaion by your own. \nIf you detect any inconsistencies, please contact us!",
    "logins_themenotexist" => "Selected theme does not exist.",
    "logins_login_not_exist" => "Login does not exist",
    "logins_login_not_found" => "Login was not found",
    "logins_login_updated_successfull" => "Login was updated successfully",
    "logins_pwd_update" => "Password was updated successfully",
    "logins_loginobject_error" => "PDF could not be created. Login with this ID does not exist.",
    "logins_pdf_not_exist" => "Requested PDF does not exist.",
    "logins_mail_not_send" => "Email cannot be sent, login doesn't exist",
    "logins_mail_send" => "Mail has been sent",
    "logins_mr_dear" => "Dear Mr. ",
    "logins_mrs_dear" => "Dear Mrs. ",
    "logins_oldpwd_incorrect" => "Old password is incorrect",
    "logins_group_not_exist" => "Selected Group does not exist: ",
    "logins_loginname_required" => "Loginname is required",
    "logins_loginname_valid" => "loginname may only contain letters, numbers and must be between 3 and 32 characters.",
    "logins_loginname_exists" => "Loginname is already in use",
    "logins_password_required" => "Password is required",
    "logins_password_valid" => "Password must be alphanumeric and may contain the characters ._- <br /> Minimum 8 characters, Maximum 12 characters at least 1 Letter and 1 Number",
    "logins_password_confirm" => "Please confirm the password",
    "logins_password_notmatch" => "Passwords do not match",
    "logins_customer_required" => "Customer is required",
    "logins_admin_digit" => "Admin must be a digit",
    "logins_admin_number" => "Admin can only be 1 or 0",
    "logins_main_digit" => "Main must be a digit",
    "logins_main_number" => "Main can only be 1 or 0",
    "logins_title_required" => "Title is required",
    "logins_title_valid" => "Title must only contain letters",
    "logins_lastname_required" => "Lastname is required",
    "logins_lastname_valid" => "Lastname must only contain letters",
    "logins_firstname_required" => "Firstname is required",
    "logins_firstname_valid" => "Firstname must only contain letters",
    "logins_email_required" => "E-Mail is required",
    "logins_email_valid" => "E-Mail is not valid",
    "logins_phone_valid" => "phone can begin with a plus and may only contain numbers",
    "logins_language_valid" => "Language can either be German or English",
    "logins_active_digit" => "Active must be a digit",
    "logins_active_number" => "active can only be one or zero",
    "logins_newsletter_digit" => "Newsletter must be a digit",
    "logins_newsletter_number" => "Newsletter can only be 1 or 0",
    "logins_profile_title" => "Title",
    "logins_profile_lastname" => "Lastname",
    "logins_profile_firstname" => "Firstname",
    "logins_profile_phone" => "Phone",
    "logins_profile_language" => "Language",
    "logins_profile_newsletter" => "Newsletter",
    "logins_pwreset_old" => "Old password",
    "logins_pwreset_new" => "New password",
    "logins_pwreset_old_required" => "Old password required",
    "logins_pwreset_new_required" => "New password required",
    "logins_pwreset_new_valid" => "Password must be alphanumeric and may contain the characters ._- <br />Minimum 8 characters, Maximum 12 characters at least 1 Letter and 1 Number",
    "logins_pwreset_confirm" => "Confirm password",
    "logins_pwreset_confirm_required" => "It is required to confirm your password",
    "logins_pwreset_confirm_match" => "The passwords do not match",
    // LoginsForm
    "logins_form_loginname" => "Loginame",
    "logins_form_password" => "Password",
    "logins_form_confirmpassword" => "Confirm password",
    "logins_form_choose_customer" => "Please choose a customer...",
    "logins_form_customer" => "Customer",
    "logins_form_admin" => "Admin",
    "logins_form_main" => "Main",
    "logins_form_email" => "E-Mail",
    "logins_form_groups" => "Groups",
    "logins_form_comment" => "Comment",
    "logins_form_active" => "Active",
    "logins_form_title" => "Title",
    "logins_form_lastname" => "Lastname",
    "logins_form_firstname" => "Firstname",
    "logins_form_phone" => "Phone",
    "logins_form_language" => "Language",
    "logins_form_newsletter" => "Newsletter",
    
    // AccessControllerBase
    "access_mr_dear" => "Dear Mr. ",
    "access_mrs_dear" => "Dear Mrs. ",
    "access_reset_mail_send" => "Please check your email for instructions on resetting your password.",
    "access_confirm_mail_send" => "Your password has been changed. You can now log in with your new password.",
    "access_build_permission" => "Building permission failed!",
    "access_wrong_login" => "Wrong loginname or password",
    "access_forgot_pw" => "Forgot password",
    "access_forgot_pw_hash" => "Failed to save user forgot password hash",
    "access_forgot_pw_process" => "Sorry, we could not initiate forgot password process. Please try again.",
    "access_notfound_adress" => "Sorry, we could not find a user with that address. Please try again.",
    "access_reset_pw" => "Reset password",
    "access_invalid_resetlink" => "Invalid reset link",
    "access_expired_resetlink" => "Your password reset link has expired. Try send the reset request again.",
    "access_failed_pwreset" => "Failed to reset user's password",
    "access_failed_reset" => "Sorry, we could not reset your password. Please try again.",
    "access_pw_match" => "Both passwords should match",
    "access_both_pw" => "Please enter both passwords",    
    
    // AdministrationControllerBase
    "administration_ovz_notdescribed" => "This job is not described yet!",
    "administration_jobs_overview" => "Jobs overview",
    "administration_customer_created" => " was created successfully",
    
    // Monitoring
    "monitoring_mon_behavior_not_implements_interface" => "MonBehavior does not implement MonBehaviorInterface.",
    "monitoring_mon_server_not_implements_interface" => "MonServer does not implement MonServerInterface.",
    "monitoring_parent_cannot_execute_jobs" => "The parent Server of this MonServer cannot execute Jobs.",
    "monitoring_healjob_failed" => "The execution of the healjob failed.",
    "monitoring_healjob_not_executed_error" => "Automatic healjob could not be sent. Maybe the host is not available. MonHealing set the job to failed so that it wont be executed later.",
    "monitoring_healing_executed" => "Healing was executed.",
    "monitoring_monuptimesgenerator_computefailed" => "Compute uptime failed: ",
    "monitoring_monlocaldailylogsgenerator_computefailed" => "Compute average failed: ",
    "monitoring_monlocaldailylogsgenerator_delete_old_daily_log" => "Had to delete MonLocalDailyLog because it will be new generated: ",
    "monitoring_monlocaljobs_no_valid_unit" => "The passed unit argument is no valid unit.",
    "monitoring_monlocaljobs_end_before_start" => "End date cannot be before start date.",
    
    // JobsControllerBase und Jobs (model)
    "jobs_search_not_found" => "The search did not find any jobs",
    "jobs_item_not_found" => "Item was not found",
    "jobs_notdelete_run_jobs" => "You can't delete running jobs Dude !",
    "jobs_item_deleted" => "Item was deleted successfully",
    
    // TableSlide
    "tableslide_no_items_found" => "No items found !",
    "tableslide_item_not_found" => "Item was not found !",
    "tableslide_generating_failed" => "Generating of slides failed: ",
    "tableslide_item_not_exist" => "Item does not exist",
    "tableslide_item_update_success" => "Item was updated successfully",
    "tableslide_item_delete_success" => "Item was deleted successfully",
    
    // ModelBase
    "modelbase_object_not_found" => "Object was not found",   
    
    // ControllerBase
    "controllerbase_no_permission_to_this_object" => "No permsission on this object",
];
