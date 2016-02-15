CREATE TABLE `cad_campeonato` (
  `codigo` int(6) NOT NULL auto_increment,
  `descricao` varchar(50) NOT NULL default '',
  `ano` int(4) NOT NULL default '0',
  `valorinscr` decimal(10,2) default NULL,
  `tipo` char(1) NOT NULL default '',
  PRIMARY KEY  (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1