<tr><td colspan=10 align="center">
  <fieldset>
    <legend><span style="color:green;"><b>Final-II Copa Bolão</b></legend>    
      <table id="menuadm" bordercolor="white" border="1px" cellspacing="0"> 
       	 <tr class="cabec"> <td align="center">Jg</td><td align="right"> </td> <td  align="center">x</td> <td align="left"> </td><td  align="center">Final</td></tr>

<?php 

  $dw = array("Dom","Seg","Ter","Qua","Qui","Sex","Sab"); 

	include ('conectadb.php');

        $sql = sprintf("select
								rm1.campeonato,
								rm1.rodada,
								rm1.jogo,
								rm1.grupo,
								ma.username manda,
								vi.username visita,
								ifnull(rm1.golsp,0) golsma1,
								ifnull(rv1.golsp,0) golsvi1,
								g.fase
					from
								cad_usuario ma,
								cad_usuario vi,
								(select userid,campeonato,rodada,jogo,grupo,golsp,pontos from cad_rodada_copa where tipo = 'M' and rodada = 21) rm1,
								(select userid,campeonato,rodada,jogo,grupo,golsp,pontos from cad_rodada_copa where tipo = 'V' and rodada = 21) rv1,
								(select campeonato,grupo,min(fase) fase  from cad_grupo_copa group by campeonato,grupo) g
					where
								ma.userid = rm1.userid
								and vi.userid = rv1.userid
								and rm1.campeonato = rv1.campeonato
								and rm1.rodada = rv1.rodada
								and rm1.jogo = rv1.jogo
								and rm1.campeonato = g.campeonato
								and rm1.grupo = g.grupo
						order by campeonato,rodada,grupo,jogo");

  		$result = mysql_query($sql)
							or die('\nErro consultando Tabela da Copa: ' . mysql_error()); 

		while ($row = mysql_fetch_assoc($result)) {

		          $linha = sprintf ('<td align="center">%s</td>' .
				          		'<td align="right">%s</td>' .
				          		'<td align="center">x</td>' .
				          		'<td align="left">%s</td>' .
				          		'<td align="center">%s x %s</td>'
				          		,$row['jogo']
				          		,$row['manda']
				          		,$row['visita']
				          		,$row['golsma1']
				          		,$row['golsvi1']);

		          echo ('<tr class="dettab">'.$linha.'</tr>')."\n";
				}

	mysql_free_result($result);
	mysql_close($link);

?>
 </table>
	</fieldset>
 		</td></tr>
