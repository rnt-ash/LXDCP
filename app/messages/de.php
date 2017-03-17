<?php

$messages = [

    // examples
    "hi"      => "Hallo",
    "bye"     => "Auf Wiedersehen",
    "hi-name" => "Hallo %name%",
    "song"    => "Dieser Song ist %song%",
    
    // Controllerbasebase
    "controllerbasebase_object_not_found" => "Objekt nicht gefunden!",
    "controllerbasebase_no_permission_to_this_object" => "Zugriff nicht erlaubt auf dieses Objekt!",
    
    // access
    "access_login_panelheader" => "Anmelden",
    "access_loginname" => "Benutzername",
    "access_password" => "Passwort",
    "access_forgott_password" => "Passwort vergessen?",
    "access_login_button" => "Anmelden",

    // index
    "index_dashboard" => "Dashboard",
    "index_welcome" => "Willkommen in der Welt des OVZ Control Panel.",
    "index_inventory" => "Inventar",
    "index_inventory_teaser" =>"Suchen nach virtuellen Gastystemen auf Physical Servern um diese in OVZ Control Panel zu integrieren",
    
    // Customers
    "customers_customers" => "Kunden",    
    "customers_all_customers" => "Alle Kunden",
    "customers_at_least_lastname_or_company_must_be_set" => "Firmenname oder Nachname muss gesetzt sein.",
    "customers_correct_mail" => "Bitte geben Sie eine korrekte Mail Adresse ein",
    "customers_correct_domain" => "Bitte geben Sie eine korrekte Domäne ein",
    "customers_correct_active" => "Active muss nummerisch sein",
    "customers_admin_cant_delete" => "Der Kunde mit der ID=1 kann nicht gelöscht werden. (Administrator)",
    // CustomersForm
    "customers_form_firstname" => "Vorname",
    "customers_form_lastname" => "Nachname",
    "customers_form_company" => "Firma",
    "customers_form_companyadd" => "Firma hinzufügen",
    "customers_form_street" => "Strasse",
    "customers_form_pobox" => "Postfach",
    "customers_form_zip" => "Postleitzahl",
    "customers_form_city" => "Stadt",
    "customers_form_phone" => "Telefon",
    "customers_form_email" => "E-Mail",
    "customers_form_website" => "Webseite",
    "customers_form_comment" => "Kommentar",
    "customers_form_active" => "Aktiv",
    
    // Colocations
    "colocation_all_colocations" => "Alle Colocations",
    "colocations_invalid_level" => "ungültiger Level!",
    "colocations_choose_customer" => " wählen Sie einen Kunden aus.",
    "colocations_customer" => "Kunde",
    "colocations_name" => "Name",
    "colocations_colocationname" => "Mein Colocation Name",
    "colocations_description" => "Beschreibung",
    "colocations_description_info" => "Zusätzliche Informationen zu dieser Colocation",
    "colocations_location" => "Location",
    "colocations_location_info" => "Meine Colocation",
    "colocations_activ_date" => "Aktivierungsdatum",
    "colocations_name_required" => "Benötigt Namen",
    "colocations_namemax" => "Name ist zu lang",
    "colocations_namemin" => "Name ist zu kurz",
    "colocations_name_valid" => "Name muss alphanumeric sein und darf folgende Charakter beinhalten: \, -, _ and space.",
    "colocations_customer_required" => "Benötige Kunden",
    "colocations_location_max" => "Location ist zu lang",
    "colocations_location_max" => "Location ist zu kurz",
    "colocations_locaton_valid" => "Location muss alphanumeric sein und darf folgende Charakter beinhalten: \, -, _ and space.",
    //View
    "colocations_title" => " Colocations",
    "colocations_view_physicalserver" => "Physikalische Server",
    "colocations_view_nophysicalserver" => "Keine physikalische Serve gefunden...",
    "colocations_view_ipobjects" => "IP Objekte",
    "colocations_view_newipobject" => "IP-Objekt hinzufügen",
    "colocations_view_noipobjects" => "Keine IP-Objekte gefunden...",
    "colocations_view_editipobject" => "IP-Objekt bearbeiten",
    "colocations_view_delmessage" => "Sind Sie sicher, dass Sie das Item löschen wollen ?",
    "colocations_view_delete" => "IP-Objekt löschen",
    "colocations_generalinfo" => "Allgemeine Informationen",
    "colocations_editovz" => "OVZ Einstellungen bearbeiten",
    "colocations_delcolocation" => "Colocation löschen",
    "colocations_view_customer" => "Kunde: ",
    "colocations_view_activdate" => "Aktivierungsdatum: ",
    "colocations_view_description" => "Beschreibnung: ",
    "colocations_title" => " Colocations",
    "colocations_save" => "Speichern",
    "colocations_cancel" => "Abbrechen",    
    
    // IP Objects
    "ipobjects_address_is_now_main" => "IP Adresse %address% ist nun die Hauptadresse.",
    "ipobjects_item_not_found" => "Item wurde nicht gefunden!",
    "ipobjects_item_not_exist" => "Das Item existiert nicht!",
    "ipobjects_ip_success" => "IP Adresse wurde erfolgreich geändert",
    "ipobjects_ip_not_found" => "IP-Objekt wurde nicht gefunden !",
    "ipobjects_ip_conf_failed" => "Konfiguration der IP Adresse auf dem virtuellen Server fehlgeschlagen: ",
    "ipobjects_ip_delete_success" => "IP-Objekt wurde erfolgreich gelöscht",
    "ipobjects_ip_adress" => "IP-Objekt muss eine Adresse sein",
    "ipobjects_ip_assigned" => "IP-Objekt muss zugewiesen sein",
    "ipobjects_ip_update_failed" => "Aktualisieren des IP-Objektes fehlgeschlagen!",
    "ipobjects_ip" => "IP Adresse",
    "ipobjects_ip_addition" => "Zusätzlicher IP Wert",
    "ipobjects_ip_additioninfo" => "Leer | Subnetmaske wenn IP Address | End-IP-Address wenn Range | Prefix wenn Subnet",
    "ipobjects_allocated" => "Zugeteilt",
    "ipobjects_ismain" => "Ist Hauptadresse",
    "ipobjects_isnotmain" => "Ist nicht Hauptadresse",
    "ipobjects_ip_main" => "Haupt IP Adresse",
    "ipobjects_comment" => "Kommentar",
    "ipobjects_commentinfo" => "Zusätzliche Information zum IP Objekt",
    "ipobjects_dco_submit" => "Kein DCO eingereicht.",
    "ipobjects_ip_not_valid" => "Keine gültige IP Adresse",
    "ipobjects_secont_value_valid" => "Kein gültiger zweiter Wert",
    "ipobjects_assigned_ip" => "Zugewiesene IPs können keine Range sein",
    "ipobjects_no_reservation" => "Keine Reservation gefunden.",
    "ipobjects_ip_notpart_reservation" => "Die IP ist nicht der Reservation zugewiesen",
    "ipobjects_ip_already_exists" => "IP existiert bereits.",
    "ipobjects_ip_required" => "Benötige IP-Adresse",
    "ipobjects_ip_valid" => "Ungültige Zeichen in der IP Address.",
    "ipobjects_second-value_check" => "Ungültige Zeichen im zweiten Wert.",
    "ipobjects_main" => "Hauptadresse kann nur 0 oder 1 sein.",
    "ipobjects_allocated_value" => "Bitte wählen Sie einen korrekten zugewiesenen Wert",
    "ipobjects_comment_length" => "Kommentar ist zu lang (max. 50 Zeichen)",
    "ipobjects_unexpected_type" => "Unerwarteter Typ!",
    //View
    "ipobjects_edit_title" => "IP Objekte",
    "ipobjects_edit_cancel" => "Abbrechen",
    "ipobjects_edit_save" => "Speichern",
      
    // Physical Servers
    "physicalserver_all_physicalservers" => "Alle Physical Server",
    "physicalserver_does_not_exist" => "Der Physical Server existiert nicht: ",
    "physicalserver_not_ovz_enabled" => "Server ist nicht OVZ aktiviert!",
    "physicalserver_job_failed" => "Ausführen des Jobs nicht erfolgreich: ",
    "physicalserver_update_failed" => "Update des Servers fehlgeschlagen: ",
    "physicalserver_update_success" => "Einstellungen erfolgreich geändert",
    "physicalserver_remove_server_first" => "Bitte löschen Sie zuerst den virtuellen Server !",
    "physicalserver_not_found" => "Physischen Server nicht gefunden !",
    "physicalserver_connection_prepare_title" => "Vorbereitende Schritte",
    "physicalserver_connection_prepare_instructions" => "Bevor die Verbindung mit dem OpenVZ-Server aufgebaut werden kann, müssen auf darauf folgende Befehle ausgeführt werden. Damit wird das System aktualisiert und es werden nötige Software-Pakete installiert.",
    "physicalserver_connection_success" => "Verbindung erfolgreich aufgebaut zu: ",
    "physicalserver_connection_restart" => "Es wird dringenst empfohlen den OpenVZ-Server neuzustarten nachdem die Verbindung aufgebaut wurde!",
    "physicalserver_connection_failed" => "Verbindung zum OpenVZ-Server fehlgeschlagen: ",
    "physicalserver_name" => "Name",
    "physicalserver_myserver" => "Mein Server",
    "physicalserver_fqdn" => "FQDN",
    "physicalserver_hostdomaintld" => "host.domain.tld",
    "physicalserver_choose_customer" => "Bitte wählen Sie einen Kunden aus.",
    "physicalserver_customer" => "Kunde",
    "physicalserver_choose_colocation" => "Bitte wählen Sie eine Colocation aus.",
    "physicalserver_colocation" => "Colocation",
    "physicalserver_cores" => "Kerne",
    "physicalserver_cores_available" => "Verfügbare Kerne  (z.B. 4)",
    "physicalserver_memory" => "Memory",
    "physicalserver_memory_available" => "Verfügbare Memory in MB (z.B. 2048)",
    "physicalserver_space" => "Speicher",
    "physicalserver_space_available" => "Verfügbarer Speicher in MB (z.B. 102400)",
    "physicalserver_activ_date" => "Aktivierungsdatum",
    "physicalserver_discription" => "Beschreibung",
    "physicalserver_discription_info" => "Zusätzliche Beschreibung zu diesem Server",
    "physicalserver_name_required" => "Name benötigt",
    "physicalserver_messagemax" => "Name ist zu lang",
    "physicalserver_messagemax" => "Name ist zu kurz",
    "physicalserver_name_valid" => "Name muss alphanumeric sein und darf folgende Charakter beinhalten: \, -, _ and space.",
    "physicalserver_fqdn_required" => "FQDN benötigt",
    "physicalserver_fqdn_valid" => "Muss ein String sein der mit Punkten getrennt ist",
    "physicalserver_core_required" => "Benötige Kern",
    "physicalserver_memory_required" => "Benötige Memory",
    "physicalserver_space_required" => "Benötige Speicherplatz",
    "physicalserver_username" => "Benutzername",
    "physicalserver_root" => "Administrator",
    "physicalserver_username_required" => "Benötige Benutzernamen",
    "physicalserver_password" => "Passwort",
    "physicalserver_password_required" => "Benötige Passwort",
    "physicalserver_permission" => "Nicht erlaubt für diesen Physical Server",
    "physicalserver_not_ovz_integrated" => "Der Physical Server ist nicht im OVZ integriert",
    "physicalserver_job_create_failed" => "Erstellen der Physical Servers fehlgeschlagen: ",
    "physicalserver_filter_all_customers" => "Alle Kunden",
    "physicalserver_filter_all_colocations" => "Alle Colocations",
    
    // View 
    "physicalserver_connect_title" => "Physical Servers OVZ Connector",
    "physicalserver_connect_connectbutton" => "Verbinden",
    "physicalserver_title" => "Physikalische Server",
    "physicalserver_ip_notfound" => "Keine IP-Objekte gefunden...",
    "physicalserver_save" => "Speichern",
    "physicalserver_cancel" => "Abbrechen",
    "physicalserver_general_title" => "Allgemeine Informationen",
    "physicalserver_general_editsettings" => "Bearbeite Einstellungen",
    "physicalserver_general_updatesettings" => "Aktualisiere OVZ Einstellungen",
    "physicalserver_general_updatestatistics" => "Aktualisiere Host Statistiken (Auslastung)",
    "physicalserver_general_connectovz" => "Verbinde OVZ",
    "physicalserver_confirm_removeserver" => "Sind Sie sicher, dass Sie diesen Physical Server Ilöschen wollen?",
    "physicalserver_tooltip_removeserver" => "Diesen Server entfernen",
    "physicalserver_general_customer" => "Kunde:",
    "physicalserver_general_hosttype" => "Hosttyp:",
    "physicalserver_general_colocation" => "Colocation:",
    "physicalserver_general_activdate" => "Aktivierungsdatum:",
    "physicalserver_general_description" => "Beschreibung:",
    "physicalserver_general_fqdn" => "FQDN:",
    "physicalserver_hw_title" => "HW Spezifikation",
    "physicalserver_hw_cores" => "CPU-Kerne:",
    "physicalserver_hw_ram" => "Memory (RAM):",
    "physicalserver_hw_space" => "Speicher:",
    "physicalserver_ip_title" => "IP Objekte",
    "physicalserver_ip_addobject" => "Neues IP-Objekt hinzufügen",
    "physicalserver_ip_editobject" => "IP-Objekt bearbeiten",
    "physicalserver_ip_deleteconf" => "Sind Sie sicher, dass Sie das IP-Objekt löschen wollen ?",
    "physicalserver_ip_delete" => "IP-Objekt löschen",
    "physicalserver_ip_primary" => "zum Hauptobjekt festlegen",
    "physicalserver_slide_title" => "Physical Servers",
            
    // Virtual Server
    "virtualserver_all_virtualservers" => "Alle Virtual Servers",
    "virtualserver_does_not_exist" => "Der virtuelle Server existiert nicht: ",
    "virtualserver_not_ovz_integrated" => "der virtuelle Server ist nicht im OVZ integriert",
    "virtualserver_job_failed" => "Ausführen des Jobs (ovz_modify_vs) fehlgeschlagen! Fehler: ",
    "virtualserver_update_failed" => "Aktualisieren des virtuellen Servers fehlgeschlagen: .",
    "virtualserver_invalid_level" => "Ungültiger Level!",
    "virtualserver_server_not_ovz_enabled" => "Server ist nicht im OVZ aktiviert",
    "virtualserver_job_infolist_failed" => "Ausführen des Jobs (ovz_list_info) fehlgeschlagen: ",
    "virtualserver_settings_success" => "Einstellungen erfolgreich aktualisiert",
    "virtualserver_job_create_failed" => "Rstellen des virtuellen Servers fehgeschlagen.",
    "virtualserver_job_start_failed" => "Ausführen des Jobs (ovz_start_vs) fehlgeschlagen: ",
    "virtualserver_job_start" => "Virtueller Server wurde erfolgreich gestartet",
    "virtualserver_job_stop_failed" => "Ausführen des Jobs (ovz_stop_vs) fehlgeschlagen: ",
    "virtualserver_job_stop" => "Virtueller Server wurde erfolgreich angehalten",
    "virtualserver_job_restart_failed" => "Ausführen des Jobs (ovz_restart_vs) fehlgeschlagen: ",
    "virtualserver_job_restart" => "Virtueller Server wurde erfolgreich neugestartet",
    "virtualserver_not_found" => "Virtueller Server wurde nicht gefunden.",
    "virtualserver_job_destroy_failed" => "Löschen/ Zerstören des virtuellen Servers fehlgeschlagen: ",
    "virtualserver_job_destroy" => "Virtueller Server wurde erfolgreich gelöscht/ zerstört",
    "virtualserver_job_ostemplates_failed" => "Ausführen des Jobs (ovz_get_ostemplates) fehlgeschlagen!",
    "virtualserver_job_listsnapshots_failed" => "Ausführen des Jobs (ovz_list_snapshots) fehlgeschlagen!",
    "virtualserver_snapshot_update" => "Snapshot wurde erfolgreich aktualisiert",
    "virtualserver_job_switchsnapshotexec_failed" => "Ausführen des Jobs (ovz_switch_snapshot) fehlgeschlagen!",
    "virtualserver_job_switchsnapshot_failed" => "Wechseln des Snapshots auf den Server fehlgeschlagen: ",
    "virtualserver_job_createsnapshotexec_failed" => "Ausführen des Jobs (ovz_create_snapshot) fehlgeschlagen!",
    "virtualserver_job_createsnapshot_failed" => "Erstellen des Snapshots fehlgeschlagen: ",
    "virtualserver_job_deletesnapshotexec_failed" => "Ausführen des Jobs (ovz_delete_snapshot) fehlgeschlagen!",
    "virtualserver_job_createsnapshot_failed" => "Löschen des Snapshots fehlgeschlagen: ",
    "virtualserver_IP_not_valid" => "ist keine gültige IP-Adresse",
    "virtualserver_min_core" => "minimale Anzahl der Kerne ist 1",
    "virtualserver_max_core" => "Der virtuelle Server kann nicht mehr Kerne als der Host haben (Host Kerne: ",
    "virtualserver_ram_numeric" => "RAM ist nicht numerisch",
    "virtualserver_min_ram" => "Minimum RAM ist 512 MB",
    "virtualserver_max_ram" => "Der virtuelle Server kann nicht mehr RAM haben als der Host (Host Memory: ",
    "virtualserver_space_numeric" => "Speicher ist nicht numerisch",
    "virtualserver_min_space" => "Minimum Speicher ist 20 GB",
    "virtualserver_max_space" => "Der virtuelle Server kann nicht mehr Speicher als der Host (Host Speicher: ",
    "virtualserver_job_modifysnapshotexec_failed" => "Ausführen des Jobs (ovz_modify_vs) fehlgeschlagen: ",
    "virtualserver_job_modifyvs" => "Änderung am virtuellen Server erfolgreich",
    "virtualserver_name" => "Name",
    "virtualserver_myserver" => "Mein Server",
    "virtualserver_choose_customer" => "Bitte wählen Sie einen Kunden aus",
    "virtualserver_customer" => "Kunde",
    "virtualserver_choose_physicalserver" => "Bitte wählen Sie einen physischen Server aus",
    "virtualserver_physicalserver" => "Physical Server",
    "virtualserver_cores" => "Kerne",
    "virtualserver_cores_example" => "Verfügbare Kerne  (z.B. 4)",
    "virtualserver_memory" => "Memory",
    "virtualserver_memory_example" => "Verfügbare Memory in MB (z.B. 2048)",
    "virtualserver_space" => "Speicher",
    "virtualserver_space_example" => "Verfügbarer Speicher in MB (e.g. 102400)",
    "virtualserver_activdate" => "Aktivierungsdatum",
    "virtualserver_description" => "Beschreibung",
    "virtualserver_description_info" => "Zusätzliche Informationen zu diesem Server",
    "virtualserver_rootpassword" => "Administrator Passwort",
    "virtualserver_choose_ostemplate" => "Bitte wählen Sie ein OS Template aus",
    "virtualserver_name_required" => "Benötige Namen",
    "virtualserver_namemax" => "Name ist zu lang",
    "virtualserver_namemin" => "Name ist zu kurz",
    "virtualserver_name_valid" => "Name muss numerisch sein und darf folgende Zeichen enthalten \, -, _ and space.",
    "virtualserver_fqdn_valid" => "Muss ein String sein, durch Punkte getrennt",
    "virtualserver_customer_required" => "Benötige Kunden",
    "virtualserver_physicalserver_required" => "Benötige physischen Server",
    "virtualserver_core_required" => "Benötige Kerne",
    "virtualserver_memory_required" => "Benötige Memory",
    "virtualserver_space_required" => "Benötige Speicher",
    "virtualserver_password_required" => "Benötige Passwort",
    "virtualserver_passwordmin" => "Passwort ist zu kurz. Minumum 8 Zeichen",
    "virtualserver_ostemplate_required" => "Benötige OS Template",
    "virtualserver_hostname" => "Hostname",
    "virtualserver_hostname_valid" => "Muss ein String sein, durch Punkte getrennt",
    "virtualserver_memory_specify" => "Bitte deklarieren Sie ob es GB oder MB sind",
    "virtualserver_discspace" => "Discspeicher",
    "virtualserver_discspace_example" => "Verfügbarer Speicher in GB  (e.g. 100)",
    "virtualserver_discspace_required" => "Benötige Diskspeicher",
    "virtualserver_discspace_specify" => "Bitte deklarieren Sie ob es TB,GB or MB sind",
    "virtualserver_dnsserver" => "DNS-Server",
    "virtualserver_startonboot" => "Start on boot",
    "virtualserver_startonboot_info" => "Start on boot kann 0 or 1 sein",
    "virtualserver_snapshotname" => "Snapshotname",
    "virtualserver_snapshotname_replica" => "Der Name darf replica nicht enthalten.",
    "virtualserver_snapshotname_required" => "Name muss numerisch sein und darf folgende Zechen enthalten -_().!? and space.",
    "virtualserver_description_valid" => "Beschreibung darf nicht länder als 250 Zeichen sein",
    "virtualserver_modify_job_failed" => "Modifizieren des Virtuellen Servers fehlgeschlagen: ",
    //View
    "virtualserver_title" => " Virtuelle Server",
    "virtualserver_view_new" => "Neu",
    "virtualserver_view_independentsys" => "Unabhängiges System",
    "virtualserver_view_container" => "Kontainer (CT)",
    "virtualserver_view_vm" => "Virtuelle Maschine (VM)",
    "virtualserver_view_vm_beta" => "(funktioniert nicht in der Beta!)",
    "virtualserver_snapshot" => "Snapshots",
    "virtualserver_save" => "Speichern",
    "virtualserver_cancel" => "Abbrechen",
    "virtualserver_snapshot_refresh" => "Refresh Snapshots",
    "virtualserver_snapshot_create" => "Neuen Snapshot erstellen",
    "virtualserver_snapshot_run" => "jetziger Lauf",
    "virtualserver_snapshot_switchinfo" => "Sind Sie sicher, dass Sie zu diesem Snapshot wechseln wollen ?",
    "virtualserver_snapshot_switch" => "Zu diesem Snapshot wechseln",
    "virtualserver_snapshot_deleteinfo" => "Sind Sie sicher, dass Sie diesen Snapshot löschen wollen?",
    "virtualserver_snapshot_delete" => "Snapshot löschen",
    "virtualserver_snapshot_new" => "Neuen Snapshot erstellen",
    "virtualserver_ipobject" => "IP-Objekte",
    "virtualserver_ip_newobject" => "Neues IP-Objekt hinzufügen",
    "virtualserver_noipobject" => "Keine IP-Objekte gefunden...",
    "virtualserver_ip_edit" => "IP-Objekt bearbeiten",
    "virtualserver_ip_deleteinfo" => "Sind Sie sicher, dass Sie das IP-Objekt löschen wollen ?",
    "virtualserver_ip_delete" => "IP-Objekt löschen",
    "virtualserver_ip_primary" => "IP-Objekt als Hauptadresse setzen",
    "virtualserver_hwspec" => "HW Spezifikation",
    "virtualserver_hwspec_cpu" => "CPU-Kerne: ",
    "virtualserver_hwspec_memory" => "Memory (RAM): ",
    "virtualserver_hwspec_space" => "Speicher",
    "virtualserver_generalinfo" => "Allgemeine Information",
    "virtualserver_general_start" => "Start",
    "virtualserver_general_stop" => "Stop",
    "virtualserver_general_restart" => "Neustart",
    "virtualserver_general_editovz" => "OVZ Einstellungen bearbeiten",
    "virtualserver_general_updateovz" => "OVZ Einstellungen aktualisieren",
    "virtualserver_general_updatestats" => "OVZ Statistik aktialisieren",
    "virtualserver_general_setpwd" => "Neues Passwort setzen",
    "virtualserver_general_deleteinfo" => "Sind Sie sicher, dass Sie das Item löschen wollen ?",
    "virtualserver_general_delete" => "Virtuellen Server löschen",
    "virtualserver_general_customer" => "Kunde: ",
    "virtualserver_general_fqdn" => "FQDN: ",
    "virtualserver_general_physicalserver" => "Physikalischer Server: ",
    "virtualserver_general_activdate" => "Aktivierungsdatum: ",
    "virtualserver_general_state" => "Status: ",
    "virtualserver_general_description" => "Beschreibung: ",
    "virtualserver_filter_all_customers" => "Alle Kunden",
    "virtualserver_filter_all_physical_servers" => "Alle physische Server",
    "virtualserver_no_physicalserver_found" => "Keinen Physikalischen Server gefunden, CTs können nicht erstellt werden",
    
    // Push
    "push_parameter_pending_is_not_a_string_or_an_array" => "Parameter 'Pending' ist kein String oder Array.",
    "push_entity_is_pending" => "Das betreffende Element ist gesperrt. Es können aktuell keine Jobs direkt ausgeführt werden.",
    "push_execute_job_failed" => "Ausführen des Jobs fehlgeschlagen: ",
    "push_insert_job_failed" => "Einfügen des Jobs fehlgeschlagen: ",
    "push_update_job_failed" => "Updaten des Jobs fehlgeschlagen: ",
    "push_problems_while_job_execution" => "Es sind Probleme bei der Ausführung von Jobs aufgetreten: ",
    "push_dependency_not_set" => "Parameter 'Dependency' muss gesetzt, ganzzahlig und grösser als 0 sein.", 
    "push_dependency_parent_failed" => "Job kann nicht ausgeführt werden und schlug fehl, weil sein vorausgehender Job fehlgeschlagen ist.",
    "push_dependency_parent_running" => "Job kann nicht noch nicht ausgeführt werden, da der vorausgehende Job noch nicht erfolgreich abgeschlossen hat.",
    "push_pending_entity_not_implements_interface" => "Die erstellte Pending-Entität implementiert das benötigte PendingInterface nicht.",
    "push_key_id_not_in_response" => "Key id existiert nicht in Job-Response.",
    "push_key_executed_not_in_response" => "Key executed existiert nicht in Job-Response.",
    "push_key_done_not_in_response" => "Key done existiert nicht in Job-Response.",
    "push_key_error_not_in_response" => "Key error existiert nicht in Job-Response.",
    "push_key_warning_not_in_response" => "Key warning existiert nicht in Job-Response.",
    "push_key_retval_not_in_response" => "Key retval existiert nicht in Job-Response.",
    
    // LoginControllerBase
    "logins_genpdf_title" => "Datenblatt Hostingverwaltung",
    "logins_genpdf_contactperson" => "Kontaktperson",
    "logins_genpdf_confidentialdata" => "Vertrauliche Daten werden nur an diese Kontaktperson weitergegeben.",
    "logins_genpdf_logindata" => "Logindaten",
    "logins_genpdf_checkdata" => "Bitte kontrollieren Sie Ihre Logindaten und ändern Sie Ihr Passwort.",
    "logins_genpdf_name" => "Name: ",
    "logins_genpdf_email" => "Email: ",
    "logins_genpdf_url" => "URL: ",
    "logins_genpdf_loginname" => "Username: ",
    "logins_genpdf_pwd" => "Passwort: ",
    "logins_genpdf_misc" => "Sonstiges",
    "logins_genpdf_ending" => "Mit diesen Logindaten können Sie Änderungen an Ihrer Hostinkonfiguration selber vornehmen. \nBei Unstimmigkeiten nehmen Sie mit uns Kontakt auf!",
    "logins_themenotexist" => "Ausgewähltes Theme existiert nicht.",
    "logins_login_not_exist" => "Login existiert nicht",
    "logins_login_not_found" => "Login wurde nicht gefunden",
    "logins_login_updated_successfull" => "Login wurde erfolgreich gespeichert",
    "logins_pwd_update" => "Passwort wurde erfolgreich aktualisiert",
    "logins_loginobject_error" => "PDF konnte nicht erstellt werden. Login mit dieser ID existiert nicht.",
    "logins_pdf_not_exist" => "Angefordertes PDF existiert nicht.",
    "logins_mail_not_send" => "E-Mail konnte nicht gesendet werden, weil das Login nicht existiert",
    "logins_mail_send" => "E-Mail wurde gesendet",
    "logins_mr_dear" => "Sehr geehrter ",
    "logins_mrs_dear" => "Sehr geehrte ",
    "logins_oldpwd_incorrect" => "Altes Passwort ist falsch !",
    "logins_group_not_exist" => "Ausgewählte Gruppe existiert nicht: ",
    "logins_loginname_required" => "Benötige Loginnamen",
    "logins_loginname_valid" => "Loginname darf nur aus Buchstaben und Zahlen bestehen (zwischen 3 und 32 Zeichen).",
    "logins_loginname_exists" => "Loginname wird bereits verwendet",
    "logins_password_required" => "Benötige Passwort",
    "logins_password_valid" => "Passwort muss alphanummerisch sein und darf folgende Zeigen enthalten ._- <br /> Minimal 8 Zeichen und maximal 12. Muss einen Buchstaben und eine Zahl enthalten",
    "logins_password_confirm" => "Bitte Passwort bestätigen",
    "logins_password_notmatch" => "Passwörter stimmen nicht überein",
    "logins_customer_required" => "Benötige Kunden",
    "logins_admin_digit" => "Admin muss eine Zahl sein",
    "logins_admin_number" => "Admin kann nur 1 oder 0 sein",
    "logins_main_digit" => "Haupt muss eine Zahl sein",
    "logins_main_number" => "Haupt kann nur 1 oder 0 sein",
    "logins_title_required" => "Benötige Titel",
    "logins_title_valid" => "Titel dar nur aus Buchstaben bestehen",
    "logins_lastname_required" => "Benötige Nachnamen",
    "logins_lastname_valid" => "Nachname darf nur aus Buchstaben bestehen",
    "logins_firstname_required" => "Benötige Vornamen",
    "logins_firstname_valid" => "Vorname darf nur aus Buchstaben bestehen",
    "logins_email_required" => "Benötige E-Mail",
    "logins_email_valid" => "E-Mail ist nicht gültig",
    "logins_phone_valid" => "Telefonnummer darf nur aus Zahlen und einem + bestehen",
    "logins_language_valid" => "Die Sprache kann nur Deutsch oder Englisch sein",
    "logins_active_digit" => "Aktiv muss eine Zahl sein",
    "logins_active_number" => "Aktiv kann nur 1 oder 0 sein",
    "logins_newsletter_digit" => "Newsletter muss eine Zahl sein",
    "logins_newsletter_number" => "Newsletter kann nur 1 oder 0",
    "logins_profile_title" => "Titel",
    "logins_profile_lastname" => "Nachname",
    "logins_profile_firstname" => "Vorname",
    "logins_profile_phone" => "Telefon",
    "logins_profile_language" => "Sprache",
    "logins_profile_newsletter" => "Newsletter",
    "logins_pwreset_old" => "Altes Passwort",
    "logins_pwreset_new" => "Neues passwort",
    "logins_pwreset_old_required" => "Benötige altes Passwort",
    "logins_pwreset_new_required" => "Benötige neues Passwort",
    "logins_pwreset_new_valid" => "Passwort muss alphanummerisch sein und darf folgende Zeigen enthalten ._- <br /> Minimal 8 Zeichen und maximal 12. Muss einen Buchstaben und eine Zahl enthalten",
    "logins_pwreset_confirm" => "Passwort bitte bestätigen",
    "logins_pwreset_confirm_required" => "Passwort muss bestätigt werden",
    "logins_pwreset_confirm_match" => "Die Passwörter stimmen nicht überein",
    // LoginsForm
    "logins_form_loginname" => "Login Name",
    "logins_form_password" => "Passwort",
    "logins_form_confirmpassword" => "Passwort bestätigen",
    "logins_form_choose_customer" => "Bitte wählen Sie einen Kunden aus...",
    "logins_form_customer" => "Kunde",
    "logins_form_admin" => "Admin",
    "logins_form_main" => "Haupt",
    "logins_form_email" => "E-Mail",
    "logins_form_groups" => "Gruppen",
    "logins_form_comment" => "Kommentar",
    "logins_form_active" => "Aktiv",
    "logins_form_title" => "Titel",
    "logins_form_lastname" => "Nachname",
    "logins_form_firstname" => "Vorname",
    "logins_form_phone" => "Telefon",
    "logins_form_language" => "Sprache",
    "logins_form_newsletter" => "Newsletter",
    
    // AccessControllerBase
    "access_mr_dear" => "Sehr geehrter ",
    "access_mrs_dear" => "Sehr geehrte ",
    "access_reset_mail_send" => "Bitte überprüfen Sie Ihr E-Mail Postfach für Anweisungen um Ihr Password zurückzusetzen.",
    "access_confirm_mail_send" => "Ihr Passwort wurde geändert. Sie können sich nun mit dem neuen Passwort anmelden.",
    "access_build_permission" => "Erstellen der Permissions fehlgeschlagen!",
    "access_wrong_login" => "Falscher Loginname oder Passwort",
    "access_forgot_pw" => "Passwort vergessen",
    "access_forgot_pw_hash" => "Speichern des Hashwertes fehlgeschlagen",
    "access_forgot_pw_process" => "Passwort-Vergessen Prozess konnte nicht initialisiert werden. Bitte versuchen Sie es noch einmal",
    "access_notfound_adress" => "Kein User mit dieser Adresse gefunden. Bitte versuchen Sie es noch einmal",
    "access_reset_pw" => "Passwort zurücksetzen",
    "access_invalid_resetlink" => "Ungültiger Link zum Zurücksetzen",
    "access_expired_resetlink" => "Des Link zum Zurücksetzen ist abgelaufen. Versuchen Sie die Anfrage nochmals zu senden.",
    "access_failed_pwreset" => "Zurücksetzen des Passworts fehlgeschlagen",
    "access_failed_reset" => "Zurücksetzen des Passworts nicht erfolgreich. Bitte versuchen Sie es noch einmal.",
    "access_pw_match" => "Passwörter müssen ubereinstimmen",
    "access_both_pw" => "Bitte geben Sie beide Passwörter ein",
    
    // AdministrationControllerBase
    "administration_ovz_notdescribed" => "Job ist noch nicht beschrieben!",
    "administration_jobs_overview" => "Jobs Überblick",
    "administration_customer_created" => " wurde erfolgreich erstellt",
    
    // Monitoring
    "monitoring_mon_behavior_not_implements_interface" => "MonBehavior implementiert nicht das MonBehaviorInterface.",
    "monitoring_mon_server_not_implements_interface" => "MonServer implementiert nicht das MonServerInterface.",
    "monitoring_parent_cannot_execute_jobs" => "Auf dem Parent-Object ist es nicht möglich Jobs auszuführen.",
    "monitoring_healjob_failed" => "Ausführung des Healjobs fehlgeschlagen.",
    "monitoring_healjob_not_executed_error" => "Automatischer Healjob konnte nicht unverzüglich gesendet werden. Kann passieren, wenn der Host nicht erreichbar ist. Wird vom HealingSystem deaktiviert, damit er nicht später versehentlich unnötig ausgeführt wird.",
    "monitoring_healing_executed" => "Heilungsmassnahmen wurden ausgeführt.",
    
    // JobsControllerBase und Jobs (model)
    "jobs_search_not_found" => "Die Suche hat keinen Job gefunden",
    "jobs_item_not_found" => "Objekt wurde nicht gefunden",
    "jobs_notdelete_run_jobs" => "Sie können keinen laufenden Job löschen",
    "jobs_item_deleted" => "Objekt wurde erfolgreich gelöscht",
    
    // TableSlide
    "tableslide_no_items_found" => "Keine Items gefunden !",
    "tableslide_item_not_found" => "Item wurde nicht gefunden !",
    "tableslide_generating_failed" => "Generieren der Slides fehlgeschlagen: ",
    "tableslide_item_not_exist" => "Item existiert nicht",
    "tableslide_item_update_success" => "Item wurde erfolgreich aktualisiert",
    "tableslide_item_delete_success" => "Item wurde erfolgreich gelöscht",
];
