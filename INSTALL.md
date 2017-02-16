# OVZ Control Panel installation

*serial 2017021601*

---
## System requirements
OVZ Control Panel builds up on following components:
- OpenVZ 7 Linux
- Phalcon Framework 3.0
- Debian Stretch, Nginx/Apache Webserver, PHP 7.0, MariaDB 10.0 alias LEMP (https://lemp.io/)

## Preparation
So that you can install the Panel, you need to have the LEMP system ready. Generaly its going to be possible to install the panel with other configurations, buts its not implemented at the moment.
                                                                                                        

Because we are working with the virtualization software OpenVZ7, it is very welcoming to create a vitual Debian Stretch system for the Panel. An installation manual for OpenVZ 7 with an virtual Debian Stretch system is explained in this File [INSTALL-OVZ7LEMP.md](INSTALL-OVZ7LEMP.md)

The further documentation requires a running LEMP system including Phalcon.

## Get OVZCP
You can get the OVZCP via GitHub
```
apt-get install git
cd /var/www/html/
git clone https://github.com/RNT-Forest/OVZCP.git
```

## Installing dependency via Composer
You can install all the dependent components via Composer
```
apt-get install composer
cd /var/www/html/OVZCP
composer install --no-dev
chown -R www-data:www-data /var/www/html/OVZCP 
```

## Create database
**ATTENTION:** choose safe password! 
```
echo "CREATE DATABASE OVZCP;" | mysql
echo "CREATE USER 'ovzcp'@'localhost' IDENTIFIED BY 'password';" | mysql
echo "GRANT ALL PRIVILEGES ON OVZCP.* TO 'ovzcp'@'localhost';" | mysql
echo "FLUSH PRIVILEGES;" | mysql
```

## Execute the install script
You can execute the install script via `http://<adress>/OVZCP/install`.
The script creates the correct OVZ Web-Panel configuration file. If you press "continue" right after the installation you will see an Error. Therefor you need to edit the webroot first.

## Edit Webroot
Now the Webroot should be moved into the public-folder of the project. Therefor you need to adjust the root-path in the V-Host-configuration file:
```
root /var/www/html/OVZCP/public
```
Restart of the webserver is necessary:
```
service nginx restart
```

## Access
You are now able to connet with the IP adress of your virtual system.  
Loginname: admin  
Password: defined in the installation.

## Continue with Getting Started
Further steps in the OVZCP application are explained in this file [GETTING-STARTED.md](GETTING-STARTED.md).