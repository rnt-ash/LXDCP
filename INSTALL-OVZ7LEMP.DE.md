# Installation OpenVZ 7 inkl. Debian Stretch Gastsystem

*serial 2017021601*

In dieser Anleitung werden folgende Themen behandelt:
 - Grundinstallation OpenVZ 7 PhysicalServer
 - Grundinstallation Debian Stretch als VirtualServer
 - Konfiguration Debian Stretch als LEMP-Hostingserver für die Phalcon App

## Grundinstallation OpenVZ 7
Als erstes muss OpenVZ 7 installiert werden. Die offizielle Installationsanleitung finden man hier: https://docs.openvz.org/ 

Möchte man die Installation via Datenträger machen, so sind hier die entsprechenden ISOs zu finden: https://download.openvz.org/virtuozzo/releases/7.0/x86_64/iso/ 

Es ist zu empfehlen bei der Installation die korrekte Zeitzone und das korrekte Tastaturlayout auszuwählen.
Desweitern muss dem Server eine freie IP Adresse zugeteilt werden. Es empfiehlt sich gleich einen Range für die Installation vorzusehen, da die Gastsysteme ja dann auch eine korrekte IP Konfiguration brauchen.

Der Server wird nachher via FQDN angesprochen. Die entsprechenden DNS Einträge müssen vor der Installation des Panels bereit stehen. Alternativ kann direkt mit IP-Adressen gearbeitet werden.

via SSH-Client (Putty) kann nun auf das System verbunden werden.

Die ISOs können unter Umständen schon recht veraltet sein, daher unbeding als erstes ein Update durführen:
```
yum -y update
```

Nachdem der Installer von OpenVZ durchgelaufen ist, müssen noch ein paar Einstellungen auf dem neuen Server vorgenommen werden.
So wird ein korrektes Private/Public Schlüsselpaar benötigt:
```
# OpenSSH Key erzeugen
ssh-keygen -b 2048 -t rsa -f /root/.ssh/id_rsa -q -N ""
# Zusätzlich benötigte Tools installieren
yum -y install mc ntp wget mailx nano php-cli php-pdo
```

## Grundinstallation Debian Stretch
Aktuell sind noch keine OS-Templates für Debian 9 (Stretch) verfügbar, also muss vorerst über Debian 8 (Jessie) gegangen werden.
```
prlctl create OVZCP --vmtype ct --ostemplate debian-8.0-x86_64-minimal
```

Mit `prlctl list -a` kann kontrolliert werden ob das Gastsystem korrekt installiert wurde.

Das neue Gastssystem benötigt auch eine IP Adresse. Dazu kann nun eine weitere IP aus dem vorhin bereitgestelltun Pool verwendet werden:
```
prlctl set OVZCP --ipadd <addr>
prlctl set OVZCP --nameserver <addr>
```

Desweitern benötigt das Gastsystem ein neues Root-Passwort:
```
prlctl set OVZCP --userpasswd root:<password>
```

Das Gastsystem kann nun gestartet werden:
```
prlctl start OVZCP
```

Nun kann man sich mit der neuen virtuellen Maschine über SSH verbinden.

Als erstes wird ein Update von Debian Jessie auf Debian Stretch durchgeführt. Dazu passt man die Sources List von Debian an.
Um etwas zügiger mit dem System arbeiten zu können empfehlen wir die Installatione des Midnight Commanders (mc), welcher sehr hilfreich bei Dateioperationen ist. Sowie den Nano-Editor mit welchem Copy/Paste aus Windows über Putty möglich ist.
```
apt-get update
apt-get install mc nano cron
```

Mit mcedit kann nun die Sources bearbeitet werden:
```
mcedit /etc/apt/sources.list
```


Hier kann nun in den aufgeführten Sources das Schlüsselwort Jessie durch Stretch ersetzt werden:
```
deb http://ftp.debian.org/debian stretch main contrib non-free
deb http://ftp.debian.org/debian stretch-updates main contrib non-free
deb http://security.debian.org stretch/updates main contrib non-free
```

Nun kann das neue Repository abgeholt werden und auf ein Update auf debian Stretch gemacht werden:
```
apt-get update
apt-get upgrade
apt-get dist-upgrade
```

Das Upgrade sollte sehr shnell durgeführt sein, da es sich ja nur um eine Minimal-Installation handelt. Die Version kann jetzt mit folgendenm Befehl überprüft werden:
```
cat /etc/debian_version
```

Jetzt sollte noch überprüft werden, ob die richtige Sprache und Zeitzone eingestellt wurde. Für die Schweiz sollte de.CH.UTF-8 sowie Europe/Zurich korrekt sein.
Für die einfachere Auswahl wird zuerst noch einen Dialog installiert:
```
apt-get install dialog
dpkg-reconfigure locales
dpkg-reconfigure tzdata
```

Am Besten man führt nach diesen Änderungen ein Neustart des Systems durch.
```
reboot
```

## Installation LEMP Komponenten
LEMP steht für Linux-Nginx-MariaDB-PHP. Also installieren wir die Komponenten der Reihe nach:
```
apt-get install nginx mariadb-server php7.0-fpm php7.0-mysql
```

MariaDB sollte noch gesichert werden
```
mysql_secure_installation
```

### Optional: phpmyadmin
Damit mit phpmyadmin auf die DB zugegriffen werden kann, muss noch ein weiterer User erstellt werden.
Standardmässig hat bei MariaDB der User root "Unix Sockt Authentifizierung". Für den Zugriff mit phpmyadmin wird aber "Native MySQL-Authentifizierung" benötigt.
```
mysql
CREATE USER 'admin'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON *.* TO 'admin'@'localhost' with grant option;
```

Damit auch Mails versendet werden können, wird der Postfix MTA installiert:
```
apt-get install postfix
```

## Installation Phalcon
Für Phalcon steht ein eigenes Repository bereit. Dies kann mit folgerndem Befehl genützt werden:
```
apt-get install curl
curl -s https://packagecloud.io/install/repositories/phalcon/stable/script.deb.sh | os=debian dist=stretch bash
```

### Nginx für PHP7 und Phalcon vorbereiten
Unter /etc/nginx/sites-available/default findet man die Konfiguration des Virtuellen Webservers. Diese muss folgendermassen angepasst werden:

**Wichtig:** Das Webroot muss später in den Public Ordner des Phalcon Projektes zeigen! 
Auch muss die ``baseUri`` im Projekt an den entsprechenden Pfad angepasst werden. Diese findet man meist im config.php-File und sollte in diesem Fall auf ``baseUri="\"`` angepasst sein
```
server {
    listen 80 default_server;
    root /var/www/html/;
    index index.php index.html index.htm index.nginx-debian.html;
    server_name _;

    location / {
        try_files $uri $uri/ /index.php?_url=$uri&$args;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php7.0-fpm.sock;
    }
}
```

Nun kann Phalcon installiert werden:
```
apt-get install php7.0-phalcon
phpenmod phalcon
service php7.0-fpm restart
service nginx restart
```

Nun sollte die Funktionalität via phpinfo() überprüft werden. Dazu erstellt man WWW-Root eine PHP-Datei:
```
touch /var/www/html/info.php
echo "<?php phpinfo() ?>" > /var/www/html/info.php
```
Unter dem Titel phalcon sollte nun die Phalcon-Konfiguration aufgelistet sein.

OVZCP verwendet noch weitere Bibliotheken welche auch installiert werden müssen.
```
apt-get install php7.0-gmp php7.0-curl php-ssh2
```

Fertig! :-)
