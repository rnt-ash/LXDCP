# OVZ Control Panel installation
*serial 2017022401*

## System requirements
OVZ Control Panel builds up on following components:
- OpenVZ 7 Linux
- Phalcon Framework 3.0
- Debian Stretch, Nginx/Apache Webserver, PHP 7.0, MariaDB 10.0 alias LEMP (https://lemp.io/)

## Preparation
So that you can install the Panel, you need to have the LEMP system ready. Generaly its going to be possible to install the panel with other configurations, buts its not implemented at the moment.
                                                                                                        
Because we are working with the virtualization software OpenVZ7, it is very welcoming to create a vitual Debian Stretch system for the Panel. An installation manual for OpenVZ 7 with an virtual Debian Stretch system is explained in this File [INSTALL-OVZ7LEMP.md](INSTALL-OVZ7LEMP.md)

The further documentation requires a running LEMP system including Phalcon.

## Install OVZCP via composer
(you can only install the developer version at the moment)
```
composer create-project rnt-forest/ovzcp /var/www/html/ --no-dev
```

You can install the newest developer version with this command.  
**Be aware:** The developer version is not completly functional or tested, so you should not use the developer version for productiv purpose! 

```
composer create-project rnt-forest/ovzcp:dev-develop /var/www/html/ --no-dev
  ```
  
After the installation you need to pay attention that all the files have the correct owner-rights. In that way you guarantee that the webserver has acces to those files.
```
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
