CREATE TABLE `tmp_class` (
  `useridpro` int(8) unsigned NOT NULL default '0' COMMENT 'Campeonato',
  `campeonato` int(6) unsigned NOT NULL default '0' COMMENT 'Rodada',
  `rodada` int(3) unsigned NOT NULL default '0' COMMENT 'Posicao do usuario na rodada',
  `posicao` int(8) unsigned NOT NULL default '0' COMMENT 'Codigo do usuario',
  `userid` int(8) unsigned NOT NULL default '0' COMMENT 'Usuario da posiçao',
  `pontos` int(6) unsigned NOT NULL default '0' COMMENT 'pontos na rodada',
  PRIMARY KEY  (`campeonato`,`rodada`,`useridpro`,`posicao`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1