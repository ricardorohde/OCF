CREATE TABLE `cad_times` (
  `codigo` int(8) NOT NULL auto_increment COMMENT 'Código do time',
  `Nome` varchar(30) NOT NULL default '0' COMMENT 'Nome do Time',
  `Tipo` char(1) NOT NULL default '' COMMENT 'C = Clube   S=Seleção',
  PRIMARY KEY  (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1