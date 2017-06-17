CREATE TABLE `cad_grupo` (
  `campeonato` int(6) unsigned NOT NULL auto_increment COMMENT 'Codigo do campeonato',
  `grupo` char(2) NOT NULL default '' COMMENT 'Grupo',
  `time` int(8) unsigned NOT NULL default '0' COMMENT 'Codigo do time',
  PRIMARY KEY  (`campeonato`,`grupo`,`time`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1