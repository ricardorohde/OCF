CREATE TABLE `cad_rodada` (
  `campeonato` int(6) unsigned NOT NULL default '0' COMMENT 'Codigo do campeonato',
  `rodada` int(3) unsigned NOT NULL default '0' COMMENT 'Numero da rodada',
  `jogo` int(3) unsigned NOT NULL default '0' COMMENT 'Numero do jogo na rodada',
  `grupo` char(2) NOT NULL default '' COMMENT 'Grupo ',
  `manda` int(8) unsigned NOT NULL default '0' COMMENT 'Time mandante do jogo',
  `visita` int(8) unsigned NOT NULL default '0' COMMENT 'Time visitante do jogo',
  `golsma` int(3) unsigned default '0' COMMENT 'Gols do mandante no jogo',
  `golsvi` int(3) unsigned default '0' COMMENT 'Gols do visitante no jogo',
  `data` date default '0000-00-00' COMMENT 'Data do jogo',
  `hora` time default '00:00:00' COMMENT 'Hora do jogo',
  PRIMARY KEY  (`campeonato`,`rodada`,`jogo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Cadastro de Rodadas'