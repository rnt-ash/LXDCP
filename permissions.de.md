# Permissions

## Allgemein
Jedes Modul definiert eigene Berechtigungen welche in Berechtigungsgruppen zusammengefasst sind und individuell eingesetzt werden können.
Die Berechtigungen werden in der "Permission Base" zusammengefasst und beschrieben. Es können nur Berechtigungen verwenden welche in der Permission Base deklariert sind.

## Wo
Berechtigungen können an zwei Orten gesetzt werden:
    1. In den Benutzergruppen (groups)
    2. In den Logins (logins)
    
Dabei werden Berechtigungen von unten nach oben überschrieben. D.h. Berechtigungen von Benutzergruppen werden von den Logins überschrieben.

## Aufbau
Der Aufbau des Feldes "permissions" ist folgender:
[Berechtigungsgruppe]:[Name]:[Scope]:[Value],

Wobei gilt:
[Berechtigungsgruppe] Zugehörigkeit von Berechtigungen zu einer Gruppe. Meist identisch mit einem Kontroller.
[Name] Name welcher die Berechtigung beschreibt
[Scope] Die Werte * (1,true) oder ! (0,false) oder einen beliebig selber definierten Wert annehmen kann. z.B. 'customer'.
[Value] Zusätzliche Werte welche frei definiert werden können. z.B. bei Scope='id' wo die entsprechenden ID's mit Pipe (|) separiert aufgelistet werden könnten. Ansonsten ist Value leer.
Komma nach jeder Linie nicht vergessen!
   
## Aufruf (ToDo)
$acl->isAllowed('myRole', $controller, $action."Action")!=Acl::ALLOW)

Abfragen welchen Scope eine Berechtigung bei angemeldeten User hat. 
Returnwert: [Scope], siehe Beschreibung [Scope]
$this->App->checkPermissions($this->ModuleName,'delitem');
If($this->App->checkPermissions($this->ModuleName,'delitem') === 'customer') {}
Achtung! Drei Gleichheitszeichen, damit auch Typ überprüft wird. Ansonsten entspricht true='customer' !!

Abfragen ob ein der Angemeldeter User eine gewisse Berechtigung bei genau diesem Tabellenelement hat.
Returnwert: true (User darf Operation auf diese Tabellenzeile ausführen), false (keine Berechtigung)
$this->App->checkPermissions($this->ModuleName,'delhosting',[id],[tabellenname]);
$this->App->checkPermissions($this->ModuleName,'delhosting',[aktuelle hostingid],'hostings');