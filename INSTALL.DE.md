# OVZ Control Panel Installation
*serial 2017030101*

## Systemvoraussetzungen
OVZ Control Panel baut auf foldenden Komponenten auf:
- OpenVZ 7 Linux
- Phalcon Framework 3.0
- Debian Stretch, Nginx/Apache Webserver, PHP 7.0, MariaDB 10.0 alias LEMP (https://lemp.io/)

## Vorbereitung
Damit das Panel installiert werden kann muss ein LEMP System bereitstehen. Es soll grundsätzlich auch möglich sein das Panel unter anderen Konfigurationen zu installieren, was aber aktuell nicht unterstützt wird.

Da wir mit der Virtualisierungssoftware OpenVZ 7 arbeiten, bietet es sich an, für das Panel ein eigenes Gastsystem mit Debian Stretch zu erstellen. Eine Installationsanleitung für OpenVZ 7 mit einem Debian Stretch Gastsystem wird in der Datei [INSTALL-OVZ7LEMP.DE.md](INSTALL-OVZ7LEMP.DE.md) beschrieben.

Die weitere Dokumentation geht davon aus, dass ein funktioniererndes LEMP System inkl. Phalcon bereit steht.

## OVZCP mit Composer installieren
Bevor der Composer verwendet werden kann, muss er zuerst installiert werden.
```
apt-get install composer
```

(aktuell kann nur die Entwicklerversion installiert werden!)
```
composer create-project rnt-forest/ovzcp /var/www/html/OVZCP --no-dev
```

Möchte man die aktuellste Entwicklerversion installieren, so kann dies mit folgendem Befehl geschehen.  
**ACHTUNG:** Die Entwicklerversion ist nicht komplett lauffähig bzw. getestet und sollte nicht für produktive Zwecke eingesetzt werden! 
```
composer create-project rnt-forest/ovzcp:dev-develop /var/www/html/OVZCP --no-dev
```

Nach der Installation sollten noch darauf geachtet werden, dass die Dateien die korrekten Besitzer erhalten. So ist gewährleistet, das der Webserver auf die Datein zugreiffen kann.
```
chown -R www-data:www-data /var/www/html/OVZCP 
```

## Datenbank erstellen. 
**ACHTUNG:** sicheres Passwort benützen! 
```
echo "CREATE DATABASE OVZCP;" | mysql
echo "CREATE USER 'ovzcp'@'localhost' IDENTIFIED BY 'password';" | mysql
echo "GRANT ALL PRIVILEGES ON OVZCP.* TO 'ovzcp'@'localhost';" | mysql
echo "FLUSH PRIVILEGES;" | mysql
```

## Install Script ausführen
Via `http://<Adresse>/OVZCP/install` kann das Install Script ausgeführt werden.
Damit wird im OVZ Web Panel die korrekte Konfigurations-Datei erzeugt. Falls danach gleich auf 'Continue' geklickt wird
erscheint ein Fehler. Passen Sie dazu zuerst den Webroot an.

## Webroot anpassen
Das Webroot soll jetzt in den Public-Ordner des Projektes verschoben werden. Dazu wird im VHost-Konfigurationsfile des Webservers der Root-Pfad angepasst:
```
root /var/www/html/OVZCP/public
```
Ein Neustart des Webserver ist erforderlich:
```
service nginx restart
```

## Zugriff
Der Zugriff über die IP des Gastsystemes ist nun möglich.  
Loginname: admin  
Passwort: wurde im Install-Script gesetzt.

## Weiter mit Getting Started
Der weitere Ablauf innerhalb der OVZCP App wird im [GETTING-STARTED.DE.md](GETTING-STARTED.DE.md) erklärt.
