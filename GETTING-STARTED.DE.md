# Getting Started im OVZCP

*serial 2017021601*

## Login und Dashboard
Nach der Installation von OVZCP (siehe [INSTALL.DE.md](INSTALL.DE.md)) sollte man sich nun im OVZCP einloggen können.
Dafür wird als User 'admin' und als Passwort das im Installer gesetzte Passwort genommen.

Nach dem Login erscheint das Dashboard mit den wichtigsten Informationen. Hier könnte auch die Inventarisierung der 
VirtualServers, welche sich auf den eingebundenen (connected) PhysicalServers befinden, vorgenommen werden. Dafür muss 
jedoch zuerste ein solcher PhysicalServer im OVZCP erfasst und eingebunden werden. 

## Erstellen einer Colocation und eines PhysicalServer
In OVZCP gibt es DCO-Typen (DataCenterObject) VirtualServers, PhysicalServers und Colocations (siehe [Was ist ein DCO?](#was-ist-ein-dco)). Die Notwendigkeit der Typen VirtualServers und 
PhysicalServers sollte klar sein. Die Colocations beschreiben logische Gruppen, denen PhysicalServers zugeteilt werden 
können (siehe [Warum Colocations?](#warum-colocations)) 
Es ist also für die Erstkonfiguration notwendig, dass eine Colocation erstellt wird. Dafür kann in der Navigation zur Ansicht
'Colocations' gewechselt werden und mit dem + Button eine neue erstellt werden.

Um die Features vom OVZCP nutzen zu können, muss nun ein PhysicalServer erfasst werden. Erfassen Sie dazu Ihre schon
installierten OpenVZ 7 PhysicalServer als Datensätze. Wechseln Sie also in der Navigation zur Ansicht 'Physical Servers' und 
verwenden Sie wiederum das + Symbol zum Hinzufügen. Dabei ist essentiell, dass der richtige
FQDN angegeben wird, da dieser später für die Kommunikation zwischen OVZCP App und PhysicalServer verwendet wird. Wählen 
Sie hier auch die vorher erstellte Colocation aus. 
Auch sollten die korrekte Daten zu Cores, Memory und Space angegeben werden, um später die VirtualServer optimal 
verwalten zu können.

## Verbinden des PhysicalServers mit dem OVCZP
Der gerade erfasste PhysicalServer ist bislang nur in der Datenbank vorhanden. Um nun den realen PhysicalServer mit OVZCP 
zu verbinden, existiert in der OVZCP App ein Connector (Voraussetzung siehe [Grundinstallation OpenVZ 7](INSTALL-OVZ7LEMP.DE.md)).   
Dafür kann man beim gerade erfassten PhysicalServer mit dem [CONNECTORSYMBOL] den Connector Dialog öffnen. 
Dabei wird nach Benutzername und Passwort eines Benutzer mit Root-Berechtigung gefragt. Wird dies korrekt eingegeben, 
so kann dann der Connector per SSH über das Netzwerk die entsprechenden Konfigurationen vornehmen.    
Das Passwort wird NICHT gespeichert, dient also nur zur Verbindungsaufnahme während der Ausführung des Connectors. 
Sobald der PhysicalServer verbunden wurde, steht bei 'Host Type' nun OpenVZ und es erscheint ein weiteres Aktionssymbol
[REFRESHSYMBOL], mit welchem die aktuellen Informationen des PhysicalServers abgeholt werden können.   
Wiederholen Sie diesen Connector für jeden PhysicalServer, den Sie verbinden wollen.
Der Connector-Vorgang schickt im Wesentlichen die notwendigen PHP-Skripte auf den Server in das Verzeichnis '/srv/ovzhost' 
und erstellt einen systemd-Service 'ovzcp.service'. Es werden keine Änderungen an schon bestehendenden virtuellen Systemen
vorgenommen. Die Änderungen des Connectors können manuell rückgängig gemacht werden (Anleitung folgt).

Der Connector-Vorgang kann beliebig oft wiederholt werden.

## Inventarisieren
Um die bereits vorhandenen VirtualServers auf den verbundenen PhysicalServers in OVZCP aufzunehmen, existiert auf dem
Dashboard ein Button für die Inventarisierung. Wechseln Sie also mit der Navigation zur Ansicht 'Dashboard' und führen Sie diese Aktion
durch und es wird auf allen verbundenen PhysicalServers nach VirtualServers gesucht und diese werden in OVZCP automatisch erfasst.

## Neuer VirtualServer erstellen
Wechseln Sie nun über die Navigation zur Ansicht 'Virtual Servers' und erstellen Sie mit dem Button 'New' ein virtuelles Container
System (siehe [Typen von virtuellen Systemen](#typen-von-virtuellen-systemen)). Bei dem Formular ist insbesondere darauf zu achten,
dass der korrekte PhysicalServers ausgewählt wird.  
Der VirtualServer wird danach im Hintergrund erstellt. Dies kann ein paar Minuten dauern, vorallem wenn zuerst noch das OS-Template
heruntergeladen werden muss. Die Ausführung des Jobs kann in der Ansicht 'Jobs' überprüft werden. Das [PLAYSYMBOL] zeigt an, dass der 
Job in Ausführung ist. Ein [HÄCKCHENSYMBOL] heisst, dass der Job erfolgreich abgeschlossen wurde. Die Jobs werden automatisch durch
einen Cronjob aktualisiert, der während dem Install-Prozess eingerichtet wurde. Sobald der Job abgeschlossen wurde, kann der gerade 
erstellte VirtualServer in der Ansicht 'Virtual Servers' gestartet werden.

## Zuteilung von IP-Adressen
Natürlich macht es Sinn einem VirtualServer auch eine IP-Adresse zuzuteilen. Damit nicht willkürlich beliebige IP-Adressen zugeteilt
werden können, arbeitet OVZCP nach einem eigenen Konzept mit Reservierungen und Zuteilungen (siehe [Was ist ein IPO?](#was-ist-ein-ipo)).
Wechseln Sie dazu zur Ansicht 'Colocations', klappen Sie die gewünschte Colocation auf und verwenden Sie das + Symbol im Bereich
'IP Objects' um einen neuen Range/Subnet vom Allocated-Typ 'Reserved' hinzuzufügen. Nehmen Sie dafür als Beispiel bei 'IP Address'
"192.168.1.0" und bei 'Subnet, IP Address or Prefix' die "24". Somit könnte man nun der Colocation und seinen Childs 
(Physical und Virtual Servers) IP-Adressen aus diesem reservierten Bereich zuteilen. Natürlich geben Sie dazu der Colocation Ihre
realen IP-Adressen als reservierte IP/Subnets/Ranges an.  
Wechseln Sie nun zur Ansicht 'Physical Servers' und teilen Sie die entsprechenden IP-Adressen den PhysicalServers Datensätzen zu. 
Hier sollte nun der Allocated-Typ 'Assigned' ausgewählt werden.
Danach wechseln Sie zur Ansicht 'Virtual Servers' und konfigurieren Sie dem VirtualServers Objekt auch eine IP-Adresse ein. Dabei wird
nun die IP-Adresse auch wirklich beim realen Virtual-Server Objekt gesetzt.

### Grund für Typ Reserved bei Servers und Typ Assigned bei Colocations
Warum könnte man nun bei Colocations auch IP-Objekte vom Typ 'Assigned' oder bei Physical und Virtual Server vom Typ 'Reserved' 
hinzufügen? Der Gedanke dahinter ist, dass man auch z.B. pro PhysicalServer gewisse Sub-Ranges reservieren könnte und somit diesen 
Bereich vor der versehentlichen Verwendung durch Systemen, die nicht auf diesem Server sind zu schützen. Auf der anderen Seite kann man 
auf Stufe Colocations eine IP-Adresse für ein Netzwerkgerät wie z.B. ein Switch zuteilen und dies im Kommentar vermerken. Damit diese
IP-Adresse nicht von anderen Systemen verwendet werden kann.

## Hintergrundinformationen
### Typen von virtuellen Systemen
In OVZCP können drei verschiedene Typen von virtuellen Systemen verwaltet werden
- Independent System: Ein reiner Datensatz mit keiner Verlinkung zu einem realen virtuellen Server (z.B. virtuelle Systeme auf nicht verbundenen PhysicalServers)
- Container (CT): containerbasiertes virtuelles System (OS-Virtualisierung, gleicher Kernel wie PhysicalServer)
- Virtual Machine (VM): virtuelles System (Hypervisor basiert auf KVM) 

### Was ist ein DCO?
DCO bedeutet DataCenterObject. Colocations, PhysicalServers und VirtualServers sind DCOs. Ein VirtualServer hat als 
Parent ein PhysicalServer, welcher wiederum als Parent eine Colocation hat. Eine Colocation beschreibt eine Gruppierung
von Servern, welche in einem Datacenter (bzw. Teil davon) sind und logisch zusammengehören, da diese z.B. Dinge wie 
Netzanbindung und somit auch IP-Address-Ranges teilen.

### Warum Colocations?
Der weitere Typ Colocations wurde eingeführt, um PhysicalServer an verschiedenen Standorten logisch zu trennen zu 
können. Haben sie z.B. Server inhouse und andere ausserhalb in einem Datacenter, so müssten dafür zwei Colocations 
erstellt werden. Die Colocations sind einerseits logische Gruppen von PhysicalServers und andererseits auch dafür da
die reservierten IP-Bereiche verwalten zu können (siehe Informationen zu IPO [Was ist ein IPO?](#was-ist-ein-ipo)) .

### Was ist ein IPO?
IPO bedeutet IPObject. Jeder PhysicalServer und jeder VirtualServer wird mit einer IP-Adresse konfiguriert sein (oder mehrere).
Damit diese IP-Adressen nicht doppelt verwendet werden können bzw. für ein DCO (und seine Childs) definiert werden kann, 
welche IP-Adressen erlaubt sind, wurde das IPO eingeführt. 
Es gibt folgende IPO Typen:
- reserved: IP dürfen diesem DCO oder Childs davon allocated oder assigned werden (Ranges und Subnets möglich, Einsatzzweck hauptsächlich Colocations)
- assigned: IP ist dem DCO zugeteilt (logische Zuteilung in der DB, Einsatzzweck hauptsächlich für PhysicalServers aber auch für "wilde" Geräte wie Switches oder Router auf Stufe Colocations)
- auto-assigned: IP ist dem DCO zugewiesen (effektive Zuweisung und Konfiguration der IP über das OVZCP, nur für VirtualServers möglich)

Will man also eine IPO assignen, so muss diese auf dieser oder höherer Stufe reserved sein.
Dadurch kann also ein VirtualServer lediglich IP-Adressen aus dem Pool der reservierten Bereiche seines PhysicalServers 
bzw. seiner Colocation verwenden.
