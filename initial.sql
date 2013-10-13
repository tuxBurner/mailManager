CREATE TABLE `mail_virtual` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL DEFAULT '',
  `destination` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_2` (`email`),
  KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1

CREATE TABLE `panel_domains` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `domain` varchar(255) NOT NULL DEFAULT '',
  `isemaildomain` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `domain_2` (`domain`),
  KEY `domain` (`domain`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1

CREATE TABLE `mail_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL DEFAULT '',
  `username` varchar(255) NOT NULL DEFAULT '',
  `password_enc` varchar(128) NOT NULL DEFAULT '',
  `uid` int(11) NOT NULL DEFAULT '2000',
  `gid` int(11) NOT NULL DEFAULT '2000',
  `homedir` varchar(255) NOT NULL DEFAULT '/_data/_mail',
  `maildir` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `email_2` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1