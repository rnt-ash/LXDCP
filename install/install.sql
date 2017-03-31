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

CREATE TABLE IF NOT EXISTS `ip_objects` (
  `id` int(11) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `server_class` varchar(100) NOT NULL,
  `server_id` int(11) unsigned NOT NULL,
  `version` tinyint(1) unsigned NOT NULL DEFAULT '4' COMMENT 'IP version 4 or 6',
  `type` tinyint(1) unsigned NOT NULL COMMENT '1:IpAddress, 2:IpRange, 3:IpNet',
  `value1` varchar(39) NOT NULL COMMENT 'IpAddress or start-IpAddress if IpRange',
  `value2` varchar(39) DEFAULT NULL COMMENT 'netmask(IpAddress), end-IpAddress(IpRange) or IpNet prefix(IpNet)',
  `allocated` tinyint(1) NOT NULL COMMENT '1:reserved IP, 2:allocated IP, 3:allocated IP automatic',
  `main` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Main IP (for monitoring)',
  `comment` varchar(50) DEFAULT NULL
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
  `space` int(11) unsigned NOT NULL DEFAULT '100' COMMENT 'Speicherplatz in GB',
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
  `space` int(11) unsigned NOT NULL DEFAULT '100' COMMENT 'Speicherplatz in GB',
  `activation_date` date NOT NULL,
  `pending` text,
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `mon_local_jobs` (
  `id` int(11) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `server_id` int(11) NOT NULL,
  `server_class` varchar(100) NOT NULL,
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
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `mon_remote_jobs` (
  `id` int(11) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `server_id` int(11) NOT NULL,
  `server_class` varchar(100) NOT NULL,
  `main_ip` varchar(39),
  `mon_behavior_class` varchar(100) NOT NULL,
  `period` int(11) NOT NULL DEFAULT 5,
  `status` varchar(16) DEFAULT 'nostate',
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
(1, 'employees',
    'index:general:*,\r\n'
    'administration:general:*,\r\n'
    'colocations:general:*,\r\n'
    'customers:general:*,\r\n'
    'partners:general:*,\r\n'
    'partners:new:*,\r\n'
    'partners:edit:*,\r\n'
    'ip_objects:general:*,\r\n'
    'jobs:general:*,\r\n'
    'logins:general:*,\r\n'
    'physical_servers:general:*,\r\n'
    'physical_servers:filter_customers:*,\r\n'
    'physical_servers:filter_colocations:*,\r\n'
    'virtual_servers:general:*,\r\n'
    'virtual_servers:filter_customers:*,\r\n'
    'virtual_servers:filter_physical_servers:*,\r\n'
    'virtual_servers:new:*,\r\n'
    'virtual_servers:delete:*,\r\n'
    'virtual_servers:edit:*,\r\n'
    'virtual_servers:configure:*,\r\n'
    'virtual_servers:modify:*,\r\n'
    'virtual_servers:save:*,\r\n'
    'virtual_servers:changestate:*,\r\n'
    'virtual_servers:snapshots:*,\r\n'
    'virtual_servers:change_root_password:*,\r\n'
    'virtual_servers:replicas:*,\r\n'),
(5, 'partners',
    'index:general:*,\r\n'
    'partners:general:partners,\r\n'
    'colocations:general:partners,\r\n'
    'physical_servers:general:partners,\r\n'
    'physical_servers:filter_customers:partners,\r\n'
    'physical_servers:filter_colocations:partners,\r\n'
    'virtual_servers:general:partners,\r\n'
    'virtual_servers:filter_customers:partners,\r\n'
    'virtual_servers:filter_physical_servers:partners,\r\n'
    'virtual_servers:new:partners,\r\n'
    'virtual_servers:delete:partners,\r\n'
    'virtual_servers:edit:partners,\r\n'
    'virtual_servers:configure:partners,\r\n'
    'virtual_servers:configure:partners,\r\n'
    'virtual_servers:save:partners,\r\n'
    'virtual_servers:changestate:partners,\r\n'
    'virtual_servers:snapshots:partners,\r\n'
    'virtual_servers:change_root_password:partners,\r\n'
    'virtual_servers:replicas:partners,\r\n'
    'jobs:general:partners,'),
(10,'customers',
    'index:general:*,\r\n'
    'partners:general:customers,\r\n'
    'colocations:general:customers,\r\n'
    'physical_servers:general:customers,\r\n'
    'physical_servers:filter_colocations:customers,\r\n'
    'virtual_servers:general:customers,\r\n'
    'virtual_servers:filter_physical_servers:customers,\r\n'
    'virtual_servers:new:customers,\r\n'
    'virtual_servers:delete:customers,\r\n'
    'virtual_servers:edit:customers,\r\n'
    'virtual_servers:configure:customers,\r\n'
    'virtual_servers:modify:customers,\r\n'
    'virtual_servers:save:customers,\r\n'
    'virtual_servers:changestate:customers,\r\n'
    'virtual_servers:snapshots:customers,\r\n'
    'virtual_servers:change_root_password:customers,\r\n'
    'virtual_servers:replicas:customers,\r\n'
    'jobs:general:customers,\r\n');

/* this commands must be executed but are normally done in the installer (install.php) */
/*
INSERT INTO `customers` (`id`, `lastname`, `firstname`, `company`, `company_add`, `street`, `po_box`, `zip`, `city`, `phone`, `email`, `website`, `comment`, `active`) VALUES
(1, 'Istrator', 'Admin', 'MyCompany', '', '', '', '', '', '', '', '', 'Just a placeholder', 1);

INSERT INTO `logins` (`id`, `loginname`, `password`, `hashtoken`, `hashtoken_reset`, `hashtoken_expire`, `customers_id`, `admin`, `title`, `lastname`, `firstname`, `phone`, `comment`, `email`, `active`) VALUES
(1, 'admin', 'hashwithsalt....', NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, 'admin@mycompany.com', 1);
*/
