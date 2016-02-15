CREATE TABLE `usr_online` (
  `ID` bigint(20) unsigned NOT NULL auto_increment,
  `sessao` varchar(50) NOT NULL default '' COMMENT 'Session id',
  `userid` int(8) unsigned NOT NULL default '0' COMMENT 'Codigo de usuario',
  `datetime` bigint(20) unsigned NOT NULL default '0' COMMENT 'Data e hora do ultimo acesso',
  PRIMARY KEY  (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Usuários online'