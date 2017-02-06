/* used by installer for createing tables in database */

CREATE TABLE IF NOT EXISTS `colocations` (
  `id` int(11) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `customers_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text,
  `location` varchar(50),
  `activation_date` date NOT NULL,
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `lastname` varchar(50) DEFAULT NULL,
  `firstname` varchar(20) DEFAULT NULL,
  `company` varchar(50) DEFAULT NULL,
  `company_add` text,
  `street` varchar(50) DEFAULT NULL,
  `po_box` varchar(30) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `phone` text,
  `email` varchar(128) DEFAULT NULL,
  `website` varchar(50) DEFAULT NULL,
  `comment` text,
  `active` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `dcoipobjects` (
  `id` int(11) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `version` tinyint(1) unsigned NOT NULL DEFAULT '4' COMMENT 'IP version 4 or 6',
  `type` tinyint(1) unsigned NOT NULL COMMENT '1:IpAddress, 2:IpRange, 3:IpNet',
  `value1` varchar(39) NOT NULL COMMENT 'IpAddress or start-IpAddress if IpRange',
  `value2` varchar(39) COMMENT 'netmask(IpAddress), end-IpAddress(IpRange) oder IpNet prefix(IpNet)',
  `allocated` tinyint(1) NOT NULL COMMENT '1:reservierte IP, 2:zugeteilte IP, 3:zugeteilte IP automatisch',
  `main` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Gebundene Haupt-IP (für Monitoring)',
  `colocations_id` int(11) unsigned,
  `physical_servers_id` int(11) unsigned,
  `virtual_servers_id` int(11) unsigned,
  `comment` varchar(50)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `jobs` (
  `id` int(11) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `physical_servers_id` int(11) unsigned,
  `virtual_servers_id` int(11) unsigned,
  `logins_id` int(11) unsigned NOT NULL,
  `type` varchar(30) NOT NULL,
  `params` text,
  `created` datetime NOT NULL  DEFAULT '0000-00-00 00:00:00',
  `dependency` int(11) unsigned COMMENT 'FK jobs',
  `sent` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `done` tinyint(1) NOT NULL DEFAULT '0' COMMENT '-1: wird ausgeführt, 0: erstellt, 1: erfolgreich, 2: error',
  `executed` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `error` text,
  `retval` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `logins` (
  `id` int(11) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `loginname` varchar(128) NOT NULL UNIQUE,
  `password` varchar(100) NOT NULL DEFAULT '',
  `hashtoken` varchar(100) DEFAULT NULL,
  `hashtoken_reset` varchar(100) DEFAULT NULL,
  `hashtoken_expire` datetime DEFAULT NULL,
  `customers_id` int(11) unsigned NOT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  `title` varchar(25) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `firstname` varchar(20) DEFAULT NULL,
  `phone` text,
  `comment` text,
  `email` varchar(128) NOT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `settings` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `physical_servers` (
  `id` int(11) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(40) NOT NULL COMMENT 'Beschreibender Name',
  `description` text DEFAULT NULL,
  `customers_id` int(11) unsigned NOT NULL,
  `colocations_id` int(11) unsigned NOT NULL,
  `public_key` text DEFAULT NULL,
  `ovz` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'ist OpenVZ-Host',
  `ovz_settings` text DEFAULT NULL,
  `fqdn` varchar(50) NOT NULL COMMENT 'Funktionaler FQDN',
  `core` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `memory` int(11) unsigned NOT NULL DEFAULT '1024' COMMENT 'Arbeitsspeicher in MB',
  `space` int(11) unsigned NOT NULL DEFAULT '100' COMMENT 'Speicherplatz in GB',
  `activation_date` date NOT NULL,
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `virtual_servers` (
  `id` int(11) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(40) NOT NULL COMMENT 'Beschreibender Name, früher FQDN!',
  `description` text,
  `customers_id` int(11) unsigned NOT NULL,
  `physical_servers_id` int(11) NOT NULL,
  `public_key` text,
  `ovz` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'ist OpenVZ-Guest',
  `ovz_uuid` varchar(50),
  `ovz_vstype` varchar(2),
  `ovz_settings` text,
  `ovz_state` varchar(10),
  `ovz_snapshots` text,
  `ovz_replica` tinyint(4) unsigned DEFAULT '0' COMMENT '0:off, 1:master, 2:slave',
  `ovz_replica_id` int(11) unsigned DEFAULT '0' COMMENT 'ID des jeweiligen master oder slave',
  `ovz_replica_host` int(11) unsigned DEFAULT '0' COMMENT 'ID des Replica Hosts',
  `ovz_replica_cron` text COMMENT 'Shedule Daten im Cronjob-Format',
  `ovz_replica_lastrun` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Letzter Start der Replica',
  `ovz_replica_nextrun` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Nächster geplanter Start der Replica',
  `ovz_replica_status` tinyint(4) unsigned DEFAULT '0' COMMENT '0:off, 1:idle, 2:sync, 3:initial, 9:error',
  `fqdn` varchar(50),
  `core` tinyint(2) DEFAULT '1' NOT NULL,
  `memory` int(11) unsigned NOT NULL DEFAULT '1024' COMMENT 'Arbeitsspeicher in MB',
  `space` int(11) unsigned NOT NULL DEFAULT '100' COMMENT 'Speicherplatz in GB',
  `activation_date` date NOT NULL,
  `pending` tinyint(1) unsigned DEFAULT '0',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/* this commands must be executed but are normally done in the installer (install.php) */
/*
INSERT INTO `customers` (`id`, `lastname`, `firstname`, `company`, `company_add`, `street`, `po_box`, `zip`, `city`, `phone`, `email`, `website`, `comment`, `active`) VALUES
(1, 'Istrator', 'Admin', 'MyCompany', '', '', '', '', '', '', '', '', 'Just a placeholder', 1);

INSERT INTO `logins` (`id`, `loginname`, `password`, `hashtoken`, `hashtoken_reset`, `hashtoken_expire`, `customers_id`, `admin`, `title`, `lastname`, `firstname`, `phone`, `comment`, `email`, `active`) VALUES
(1, 'admin', 'hashwithsalt....', NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, 'admin@mycompany.com', 1);
*/
