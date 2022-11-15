DROP TABLE IF EXISTS `Serial`;
CREATE TABLE `Serial` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) DEFAULT '00-00-00',
  `etat` varchar(255) DEFAULT 'non-active',
  `dateActivation` varchar(255) DEFAULT '01/01/2000',
  `adressIP` varchar(255) DEFAULT '127.0.0.1',
  `geolocalisation` varchar(255) DEFAULT 'internet',
  `icon` varchar(255) DEFAULT 'i/incorrect.png',
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1058 DEFAULT CHARSET=utf8;
