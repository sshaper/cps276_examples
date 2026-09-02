DROP TABLE IF EXISTS `miniapp`;
CREATE TABLE `miniapp` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `note` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `miniapp` (`note`) VALUES
('Buy milk'),
('Finish CPS276 lab');
