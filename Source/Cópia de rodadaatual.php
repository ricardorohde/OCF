<?php include("sessao.php"); ?>

<tr><td colspan=10 style='font-size:12px;color:green;'><br><b>Rodada Atual </td></tr>
<tr><td colspan=10 align="center">
 <div style="border:solid 1px #a0b0b0;background:#fff;text-align:left">
 <table id=menuadm frame=box  bordercolor="white" border="1px" cellspacing="0"> 
          <tr class="cabec"> <td align="center">Jg</td> <td width="120px"  align="right">Mandante</td><td  width="40px" align="center">X</td><td width="120px">Visitante</td><td align="center">Data/Hora</td> </tr>


<?php 

  $dw = array("Dom","Seg","Ter","Qua","Qui","Sex","Sab"); 

	include ('conectadb.php');

        $sql = sprintf("select r.rodada,r.jogo,r.golsma,r.golsvi,
												tm.nome manda,tv.nome visita,
												addtime(r.data, r.hora) datahora
												from
												cad_times tm,
												cad_times tv,
												cad_rodada r,
													(select campeonato,max(rodada) rodadaatual from cad_rodada
														where
														now()> subtime(addtime(data,hora),'00:15:00')
														group by campeonato) i
												where
												r.campeonato = 1																										
                        						and r.campeonato = i.campeonato
												and r.rodada = i.rodadaatual
												and r.manda = tm.codigo
												and r.visita = tv.codigo");

  		$result = mysql_query($sql)
							or die('\nErro consultando banco de dados: ' . mysql_error()); 

		while ($row = mysql_fetch_assoc($result)) {
		          $linha = sprintf ('<td align="center">%s</td>' .
								'<td align="right">%s</td>'.
				          		'<td  align="center">%s x %s</td> '.
				          		'<td>%s</td> ' .
				          		'<td>%s %s</td> '
				          		,$row['jogo']
				          		,$row['manda']
				          		,$row['golsma']
				          		,$row['golsvi']
				          		,$row['visita']
								,date("d/m/Y H:i",strtotime($row['datahora'])),
								$dw[date("w",strtotime($row['datahora']))]
				          		);

		          echo ('<tr class="dettab">'.$linha.'</tr>')."\n";
				}

	mysql_free_result($result);
	mysql_close($link);

?>
</div>
 </table>
 	</td></tr>
