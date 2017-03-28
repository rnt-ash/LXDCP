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
  `uuid` varchar(50) NOT NULL UNIQUE KEY,
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

CREATE TABLE IF NOT EXISTS `customers_partners` (
  `id` int(11) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `customers_id` int(11) unsigned NOT NULL,
  `partners_id` int(11) unsigned NOT NULL,
  KEY `customers_id` (`customers_id`),
  KEY `partners_id` (`partners_id`)
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

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `permissions` text
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `jobs` (
  `id` int(11) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `server_class` varchar(100) NOT NULL,
  `server_id` int(11) unsigned NOT NULL,
  `logins_id` int(11) unsigned NOT NULL,
  `type` varchar(30) NOT NULL,
  `params` text,
  `created` datetime NOT NULL  DEFAULT '0000-00-00 00:00:00',
  `dependency` int(11) unsigned COMMENT 'FK jobs',
  `pending` text,
  `sent` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `done` tinyint(1) NOT NULL DEFAULT '0' COMMENT '-1: running, 0: created, 1: success, 2: error',
  `executed` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `error` text,
  `warning` text,
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
  `main` tinyint(1) DEFAULT NULL,
  `groups` text,
  `title` varchar(25) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `firstname` varchar(20) DEFAULT NULL,
  `phone` text,
  `comment` text,
  `email` varchar(128) NOT NULL,
  `active` tinyint(1) DEFAULT '1',
  `locale` varchar(20),
  `permissions` text,
  `settings` text,
  `newsletter` tinyint(1) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `physical_servers` (
  `id` int(11) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(40) NOT NULL COMMENT 'Beschreibender Name',
  `description` text DEFAULT NULL,
  `customers_id` int(11) unsigned NOT NULL,
  `colocations_id` int(11) unsigned NOT NULL,
  `root_public_key` text DEFAULT NULL,
  `job_public_key` text DEFAULT NULL,
  `ovz` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'ist OpenVZ-Host',
  `ovz_settings` text DEFAULT NULL,
  `ovz_statistics` text DEFAULT NULL,
  `fqdn` varchar(50) NOT NULL COMMENT 'Funktionaler FQDN',
  `core` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `memory` int(11) unsigned NOT NULL DEFAULT '1024' COMMENT 'Arbeitsspeicher in MB',
  `space` int(11) unsigned NOT NULL DEFAULT '100' COMMENT 'Speicherplatz in MB',
  `activation_date` date NOT NULL,
  `pending` text,
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `virtual_servers` (
  `id` int(11) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(40) NOT NULL COMMENT 'Beschreibender Name, früher FQDN!',
  `description` text,
  `customers_id` int(11) unsigned NOT NULL,
  `physical_servers_id` int(11) NOT NULL,
  `job_public_key` text DEFAULT NULL,
  `ovz` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'ist OpenVZ-Guest',
  `ovz_uuid` varchar(50),
  `ovz_vstype` varchar(2),
  `ovz_settings` text,
  `ovz_statistics` text,
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
  `space` int(11) unsigned NOT NULL DEFAULT '100' COMMENT 'Speicherplatz in MB',
  `activation_date` date NOT NULL,
  `pending` text,
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `mon_local_jobs` (
  `id` int(11) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `servers_id` int(11) NOT NULL,
  `servers_class` varchar(100) NOT NULL,
  `mon_behavior_class` varchar(100) NOT NULL,
  `period` int(11) NOT NULL DEFAULT 5,
  `status` varchar(16) DEFAULT 'normal',
  `last_status_change` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `warning_value` varchar(32) NOT NULL,
  `maximal_value` varchar(32) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `alarm` tinyint(1) NOT NULL DEFAULT 1,
  `alarmed` tinyint(1) NOT NULL DEFAULT 0,
  `muted` tinyint(1) NOT NULL DEFAULT 0,
  `last_alarm` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `alarm_period` int(11) NOT NULL DEFAULT 15,
  `mon_contacts_message` text NOT NULL COMMENT 'FK logins, comma separated value',
  `mon_contacts_alarm` text NOT NULL COMMENT 'FK logins, comma separated value',
  `last_run` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_rrd_run` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `mon_remote_jobs` (
  `id` int(11) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `servers_id` int(11) NOT NULL,
  `servers_class` varchar(100) NOT NULL,
  `main_ip` varchar(39),
  `mon_behavior_class` varchar(100) NOT NULL,
  `period` int(11) NOT NULL DEFAULT 5,
  `status` varchar(16) DEFAULT 'normal',
  `last_status_change` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `uptime` text,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `healing` tinyint(1) NOT NULL DEFAULT 0,
  `alarm` tinyint(1) NOT NULL DEFAULT 1,
  `alarmed` tinyint(1) NOT NULL DEFAULT 0,
  `muted` tinyint(1) NOT NULL DEFAULT 0,
  `last_alarm` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `alarm_period` int(11) NOT NULL DEFAULT 15,
  `mon_contacts_message` text NOT NULL COMMENT 'FK logins, comma separated value',
  `mon_contacts_alarm` text NOT NULL COMMENT 'FK logins, comma separated value',
  `last_run` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `mon_local_logs` (
  `id` int(11) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `mon_local_jobs_id` int(11) NOT NULL COMMENT 'FK mon_local_jobs',
  `value` text NOT NULL,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `mon_local_jobs_id` (`mon_local_jobs_id`),
  KEY `modified` (`modified`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `mon_remote_logs` (
  `id` int(11) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `mon_remote_jobs_id` int(11) NOT NULL COMMENT 'FK mon_remote_jobs',
  `value` text NOT NULL,
  `heal_job` int(11) DEFAULT NULL COMMENT 'FK jobs',
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `mon_remote_jobs_id` (`mon_remote_jobs_id`),
  KEY `modified` (`modified`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `mon_uptimes` (
  `id` int(11) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `mon_remote_jobs_id` int(11) NOT NULL COMMENT 'FK mon_remote_jobs_id',
  `year_month` char(6) NOT NULL COMMENT 'YYYYMM',
  `max_seconds` int(11) NOT NULL,
  `up_seconds` int(11) NOT NULL,
  `up_percentage` decimal(9,8) NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `mon_remote_jobs_id` (`mon_remote_jobs_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `mon_local_daily_logs` (
  `id` int(11) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `mon_local_jobs_id` int(11) NOT NULL COMMENT 'FK mon_local_jobs_id',
  `day` date NOT NULL,
  `value` text NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `mon_local_jobs_id` (`mon_local_jobs_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `groups` (`id`, `name`, `permissions`) VALUES
(1, 'employees', 'index:general:*,\r\nadministration:general:*,\r\ncolocations:general:*,\r\ncustomers:general:*,\r\npartners:general:*,\r\npartners:new:*,\r\npartners:edit:*,\r\ndcoipobjects:general:*,\r\njobs:general:*,\r\nlogins:general:*,\r\nphysical_servers:general:*,\r\nphysical_servers:filter_customers:*,\r\nphysical_servers:filter_colocations:*,\r\nvirtual_servers:general:*,\r\nvirtual_servers:filter_customers:*,\r\nvirtual_servers:filter_physical_servers:*,\r\nvirtual_servers:new:*,\r\nvirtual_servers:delete:*,\r\nvirtual_servers:edit:*,\r\nvirtual_servers:configure:*,\r\nvirtual_servers:modify:*,\r\nvirtual_servers:save:*,\r\nvirtual_servers:changestate:*,\r\nvirtual_servers:snapshots:*,\r\nvirtual_servers:change_root_password:*,\r\nvirtual_servers:replicas:*,\r\n'),
(5, 'partners', 'index:general:*,\r\npartners:general:partners,\r\ncolocations:general:partners,\r\nphysical_servers:general:partners,\r\nphysical_servers:filter_customers:partners,\r\nphysical_servers:filter_colocations:partners,\r\nvirtual_servers:general:partners,\r\nvirtual_servers:filter_customers:partners,\r\nvirtual_servers:filter_physical_servers:partners,\r\nvirtual_servers:new:partners,\r\nvirtual_servers:delete:partners,\r\nvirtual_servers:edit:partners,\r\nvirtual_servers:configure:partners,\r\nvirtual_servers:configure:partners,\r\nvirtual_servers:save:partners,\r\nvirtual_servers:changestate:partners,\r\nvirtual_servers:snapshots:partners,\r\nvirtual_servers:change_root_password:partners,\r\nvirtual_servers:replicas:partners,\r\njobs:general:partners,'),
(10, 'customers', 'index:general:*,\r\npartners:general:customers,\r\ncolocations:general:customers,\r\nphysical_servers:general:customers,\r\nphysical_servers:filter_colocations:customers,\r\nvirtual_servers:general:customers,\r\nvirtual_servers:filter_physical_servers:customers,\r\nvirtual_servers:new:customers,\r\nvirtual_servers:delete:customers,\r\nvirtual_servers:edit:customers,\r\nvirtual_servers:configure:customers,\r\nvirtual_servers:modify:customers,\r\nvirtual_servers:save:customers,\r\nvirtual_servers:changestate:customers,\r\nvirtual_servers:snapshots:customers,\r\nvirtual_servers:change_root_password:customers,\r\nvirtual_servers:replicas:customers,\r\njobs:general:customers,\r\n');

/* this commands must be executed but are normally done in the installer (install.php) */
/*
INSERT INTO `customers` (`id`, `lastname`, `firstname`, `company`, `company_add`, `street`, `po_box`, `zip`, `city`, `phone`, `email`, `website`, `comment`, `active`) VALUES
(1, 'Istrator', 'Admin', 'MyCompany', '', '', '', '', '', '', '', '', 'Just a placeholder', 1);

INSERT INTO `logins` (`id`, `loginname`, `password`, `hashtoken`, `hashtoken_reset`, `hashtoken_expire`, `customers_id`, `admin`, `title`, `lastname`, `firstname`, `phone`, `comment`, `email`, `active`) VALUES
(1, 'admin', 'hashwithsalt....', NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, 'admin@mycompany.com', 1);
*/
