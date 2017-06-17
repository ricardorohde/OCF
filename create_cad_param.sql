CREATE TABLE `cad_param` (
  `codigo` int(10) unsigned NOT NULL auto_increment COMMENT 'Codigo do registro',
  `emailadm` varchar(90) default NULL COMMENT 'Email do administrador do site',
  `emailwbm` varchar(90) default NULL COMMENT 'Email do webmaster',
  PRIMARY KEY  (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Cadastro de parâmetros'