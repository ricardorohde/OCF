CREATE TABLE `cad_inscricao` (
  `campeonato` int(6) unsigned NOT NULL default '0' COMMENT 'Codigo do campeonato inscrito',
  `userid` int(8) unsigned NOT NULL default '0' COMMENT 'Codigo do usuario inscrito',
  `datainscricao` date NOT NULL default '0000-00-00' COMMENT 'Data de inscriçao',
  `flpago` char(2) NOT NULL default 'N' COMMENT 'S=Pago, N=Em aberto',
  `datapgto` date NOT NULL default '0000-00-00' COMMENT 'Data do pagamento',
  `useridpgto` int(8) unsigned NOT NULL default '0' COMMENT 'Codigo do usuario que confirmou pagto',
  `status` int(10) unsigned NOT NULL default '1' COMMENT '1=Ativo 9=Cancelada',
  `bonus` int(6) unsigned NOT NULL default '0' COMMENT 'Bonus por titulo de rodadas',
  `posicao` int(6) unsigned NOT NULL default '0' COMMENT 'Classificaçao no bolao',
  `pontos` int(6) unsigned NOT NULL default '0' COMMENT 'Pontos de rodadas no bolao',
  `bonusrecrod` int(6) unsigned NOT NULL default '0' COMMENT 'Bonus por recorde de rodadas',
  `titulosrod` int(6) unsigned NOT NULL default '0' COMMENT 'Numero de titulos diretos de rodada',
  `maiorpont` int(6) unsigned NOT NULL default '0' COMMENT 'Maior pontuaçao numa rodada',
  PRIMARY KEY  (`campeonato`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Cadastro de Usuário inscritos nos campeonatos'