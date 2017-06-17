CREATE TABLE `cad_palpite` (
  `userid` int(8) unsigned NOT NULL default '0' COMMENT 'Codigo de usuario',
  `campeonato` int(6) unsigned NOT NULL default '0' COMMENT 'Codigo do campeonato',
  `rodada` int(3) unsigned NOT NULL default '0' COMMENT 'Numero da rodada',
  `jogo` int(3) unsigned NOT NULL default '0' COMMENT 'Numero do jogo',
  `pmanda` int(3) unsigned NOT NULL default '0' COMMENT 'Palpite para o mandante',
  `pvisita` int(3) unsigned NOT NULL default '0' COMMENT 'Palpite para o visita',
  `pontos` int(3) unsigned NOT NULL default '0' COMMENT 'Pontos marcados no jogo',
  PRIMARY KEY  (`campeonato`,`userid`,`rodada`,`jogo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Cadastro de Palpites'