# Installation of OpenVZ 7 including Debian Stretch virtual system

*serial 20170030201*

In this manuel the following topics are explained:
 - Main installaton of OpenVZ 7 PhysicalServer
 - Main installation of Debian Stretch as VirtualServer
 - Configuration Debian Stretch as LEMP-Hostingserver for the Phalcon App

## Main installation OpenVZ 7
First of all you need to install OpenVZ 7. You can find the official installation manual/ guide here: https://docs.openvz.org/ 

If you want to do the installation with a physical medium, you will find the needed ISOs here: https://download.openvz.org/virtuozzo/releases/7.0/x86_64/iso/ 

Its recommended to choose the correct timezone and keyboard layout while doing the installation.
Additinaly you need to assign a free IP adress to your server. Its recommended to define a IP range for the entire installation, because the virtual server will need correct IP settings as well.

After the installation the server will be addressed via FQDN. Therefore you need to create the DNS entrys before installing the Panel. In alternative you can work directly with IP adresses.

Now you are able to connect to your System via SSH-Client (Putty)

In some cases the ISOs can be out of date, therefore you need to update your system before going on to the settings:
```
yum -y update
```

When the installation wizard of the OpenVZ is done, you need to adjust some Setting on the Server.
First of all you need a correct Private/ Public Keypair:
```
# generating OpenSSH Key
ssh-keygen -b 2048 -t rsa -f /root/.ssh/id_rsa -q -N ""
# installation of tools needed in addition
yum -y install mc ntp wget mailx nano php-cli php-pdo
```

## Main installation Debian Stretch
At the moment there is no OS-Template available for the Debian 9 (Stretch), so for now you need to use Debian 8 (Jessie).
```
prlctl create OVZCP --vmtype ct --ostemplate debian-8.0-x86_64-minimal
```

With `prlctl list -a` you can check if the virtual system was correctly installed.

The new virtual system needs a IP adress. You can use the next IP from the predefined IP pool and assign it to the virtual system:
```
prlctl set OVZCP --ipadd <addr>
prlctl set OVZCP --nameserver <addr>
```

In addition the virtual system needs a new root-password:
```
prlctl set OVZCP --userpasswd root:<password>
```

Now you can restart the virtual system:
```
prlctl start OVZCP
```

Now you are able to connect to your virtual system with an SSH-Client (Putty).

First of all you need to update from Debian Jessie to Debian Stretch. Therefore you can edit Debians source-list.
We recommend the installation of the Midnight Commander, which allowes faster and easier interactions with files/ folders on the server. As well as the nano-editor where you can copy/paste from Windows while connected with Putty. Further we install rsyslog so syslog-files will be written.
```
apt-get update
apt-get install mc nano cron rsyslog
```

With mcedit you can edit the source-list:
```
mcedit /etc/apt/sources.list
```


Replace the keyword Jessie with Stretch in the following sources:
```
deb http://ftp.debian.org/debian stretch main contrib non-free
deb http://ftp.debian.org/debian stretch-updates main contrib non-free
deb http://security.debian.org stretch/updates main contrib non-free
```

Now you can collect the new repository and update to debian stretch.
```
apt-get update
apt-get upgrade
apt-get dist-upgrade
```

The upgrade should be done really quick, because it is a minimal installation. You can check the version now with this command:
```
cat /etc/debian_version
```

Next you need to check if the language and timezone are correct. For correct settings for Switzerland are de.CH.UTF-8 and Europe/ Zurich.
For easier handling of the selection, we install a dialog first:
```
apt-get install dialog
dpkg-reconfigure locales
dpkg-reconfigure tzdata
```

To make sure that all the setting are active, you should restart the virtual system at this point:
```
reboot
```

## Installation LEMP Komponenten
LEMP means Linux-Nginx-MariaDB-PHP. So you need to install the components in the correct order:
```
apt-get install nginx mariadb-server php7.0-fpm php7.0-mysql
```

MariaDB should be backuped here:
```
mysql_secure_installation
```

### Optional: phpmyadmin
If you want to access the DB with phpmyadmin, you need to create an additional user.
By default the user root has "Unix sockt authentification" in MariaDB. But you need "Native MySQL-authentification" for the access with phpmyadmin.
```
mysql
CREATE USER 'admin'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON *.* TO 'admin'@'localhost' with grant option;
```

Installing the postfix MTA, so you can send E-Mails:
```
apt-get install postfix
```

## Installation Phalcon
Phalcon has its own repository, which is available under the following command:
```
apt-get install curl
curl -s https://packagecloud.io/install/repositories/phalcon/stable/script.deb.sh | os=debian dist=stretch bash
```

### Preparation of Nginx for PHP7 and Phalcon
In /etc/nginx/sites-available/default you can find the configuration of the virtual webserver. You need to customize the setting in the following way:

**Important:** The webroot later needs to be directet to the public folder of the Phalcon project! 
The ``baseUri`` in the project needs to be adjusted as well to the directory. You can find this in the config.php-file and you need to adjust it to ``baseUri="\"``.
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

Now you can install Phalcon:
```
apt-get install php7.0-phalcon
phpenmod phalcon
service php7.0-fpm restart
service nginx restart
```

At this point you need to check the functionality of phalcon via phpinfo(). Therefor you can create a PHP-File in the www-root::
```
touch /var/www/html/info.php
echo "<?php phpinfo() ?>" > /var/www/html/info.php
```
If you open the created file in a browser, you will see all the configuration information under the Phalcon title.

OVZCP needs some additional libraries which you have to install now:
```
apt-get install php7.0-gmp php7.0-curl php-ssh2
```

Finished! :-)
