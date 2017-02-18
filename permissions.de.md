# Permissions

## Allgemein
Jedes Modul definiert eigene Berechtigungen welche in Berechtigungsgruppen zusammengefasst sind und individuell eingesetzt werden können.
Die Berechtigungen werden in der "Permission Base" zusammengefasst und beschrieben. Es können nur Berechtigungen verwenden welche in der Permission Base deklariert sind.

## Wo
Permissions setzt sich aus drei Teilen zusammen:
    1. `Permissions Class` mit der eigentlichen Funktionalität
    2. `Permission Base` mit den verfügbaren Permissions
    3. `Permission Functions` mit den in der Permissions Base deklarierten Funktionen

Berechtigungen können an zwei Orten gesetzt werden:
    1. In den Benutzergruppen (groups)
    2. In den Logins (logins)
    
Dabei werden Berechtigungen von unten nach oben überschrieben. D.h. Berechtigungen von Benutzergruppen werden von den Logins überschrieben.

Bei einloggen werden die Permissions für den jeweiligen User berechnet und in der Session unter `session['auth']['permissions']` abgelegt.
Gleichzeitig werden auch alle erlaubten actions anhand der `Permission Base` ermitelt und unter `session['auth']['actions']` abgelegt.

## Aufbau
Der Aufbau des Feldes "permissions" ist folgender:
[Berechtigungsgruppe]:[Name]:[Scope]:[Value],

Wobei gilt:
[Berechtigungsgruppe] Zugehörigkeit von Berechtigungen zu einer Gruppe. Meist identisch mit einem Kontroller.
[Name] Name welcher die Berechtigung beschreibt
[Scope] Die Werte * (1,true) oder ! (0,false) oder einen beliebig selber definierten Wert annehmen kann. z.B. 'customer'.
[Value] Zusätzliche Werte welche frei definiert werden können. z.B. bei Scope='id' wo die entsprechenden ID's mit Pipe (|) separiert aufgelistet werden könnten. Ansonsten ist Value leer.
Komma nach jeder Linie nicht vergessen!
   
## Aufruf
Abfragen ob der Angemeldete User Berechtigung für eine "Berechtigung" hat.
`$permissions->checkPermission(%Berechtigungsgruppe%,%Name%);`

Abfragen ob der Angemeldete User Berechtigung bei genau diesem Objekt hat.
`$permissions->checkPermission(%Berechtigungsgruppe%,%Name%,%Objekt%);`

Abfragen ob der Angemeldete User Berechtigung zu einer Action hat.
`$permissions->checkActionPermission(%Kontroller%,%Action%);`
