CREATE TABLE `tb_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'pk',
  `Reuniao_data` date DEFAULT NULL COMMENT 'Data Próxima reunião',
  `Reuniao_hora` time DEFAULT NULL COMMENT 'Hora da próxima reuniao',
  `Reuniao_local` varchar(50) DEFAULT NULL COMMENT 'Local próxima reunião',
  `Usuario_ultimo` int(11) DEFAULT NULL COMMENT 'Ultimo usuário cadastrado',
  `Usuario_qtde` int(11) DEFAULT NULL COMMENT 'total de membros cadastrados',
  `Usuario_socios_qtde` int(11) DEFAULT NULL COMMENT 'Qtde de associados',
  `Usuario_opaleiros_qtde` int(11) DEFAULT NULL COMMENT 'Qtde de opaleiros cadastrados',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='Tabula com informações diversas do siste';