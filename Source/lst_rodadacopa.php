<?php include("sessao.php"); ?>

<?php include("head.php"); ?>

<span class="titusr">Rodadas da Copa Telê Santana</span>
       
 <?php include("traco.php"); ?>
 
 <?php include("tophome.php"); ?>

<table id="menuadm" border="0" cellspacing="0">
<?php 
   require_once($_SESSION['DOCROOT']."/classes/class.usuario.php");
   
  $dw = array("Dom","Seg","Ter","Qua","Qui","Sex","Sab"); 

	include ('conectadb.php');

    echo("<tr><td><br></td></tr>\n");

        $verifica = sprintf("select rm.campeonato,rm.rodada,rm.jogo,rm.grupo,datahora,
									ma.username manda,rm.golsp golsma,
									vi.username visita,rv.golsp golsvi,g.fase,ma.userid idmanda,vi.userid idvisita
									from
									cad_usuario ma,
									cad_usuario vi,
									cad_campeonato c,
									(select userid,campeonato,rodada,jogo,grupo,golsp,pontos from cad_rodada_copa where tipo = 'M') rm,
									(select userid,campeonato,rodada,jogo,grupo,golsp,pontos from cad_rodada_copa where tipo = 'V') rv,
  									(select campeonato,grupo,max(fase) fase  from cad_grupo_copa group by campeonato,grupo) g
  									left join
									(select campeonato,rodada,min(addtime(data,hora)) datahora from cad_rodada group by campeonato,rodada) r									
                                    on
									rm.campeonato = r.campeonato
									and rm.rodada = r.rodada
                                    where
									ma.userid = rm.userid
									and vi.userid = rv.userid
									and rm.campeonato = rv.campeonato
									and rm.rodada = rv.rodada
									and rm.jogo = rv.jogo
									and rm.campeonato = g.campeonato
									and rm.grupo = g.grupo
									and c.codigo = g.campeonato
									and c.flandamento = 'S'
									order by campeonato,rodada,grupo,jogo");

  		$result = mysql_query($verifica)
							or die('\nErro consultando Tabela da Copa: ' . mysql_error()); 

        $fllin = 0;
        $rodant = 0;
        $fllst = 0;
        $grpant = "";
        if (mysql_num_rows($result) == 0) {
    		echo ('<tr><td colspan=2> <table id="menuadm" bordercolor="white" border="1px" cellspacing="0">')."\n"; 
        	echo ('         <tr class="cabec"> <td align="center">Jg</td> <td  align="right"></td><td  align="center">Resultados</td><td></td></tr>')."\n";
            $fllst = 1;   
        }

			while ($row = mysql_fetch_assoc($result)) {
                       if ($rodant == 0) {
                           if (!empty($row['datahora'])) {
							   $dhini = sprintf ("Data/Hora Inicio: %s %s <i>%s</i>"
							   ,date("d/m/Y",strtotime($row['datahora'])),date("H:i",strtotime($row['datahora'])),$dw[date("w",strtotime($row['datahora']))]);  
							   }
							else {
									$dhini = " ";
								}
						
                       	   $rodant = $row['rodada'];
                           $lr = sprintf ("<tr><td style='text-decoration: underline;font-size:11px;'><b>Rodada: %02d </td><td style='font-size:11px;' align=right>%s</td></tr>"
                           ,$rodant,$dhini);  
                       	   echo ($lr)."\n";
				           echo ('<tr><td colspan=2> <table id="menuadm" bordercolor="white" border="1px" cellspacing="0">')."\n"; 
				        	echo ('         <tr class="cabec"> <td align="center">Jg</td> <td  align="right"></td><td  align="center">Resultados</td><td></td></tr>')."\n";
				            $fllst = 1;   
                     	}	
                       if ($rodant != $row['rodada']) {
                       	   echo (' </table> </td></tr>')."\n"; 
                       	   $rodant = $row['rodada'];
                           if (!empty($row['datahora'])) {
							   $dhini = sprintf ("Data/Hora Inicio: %s %s <i>%s</i>"
							   ,date("d/m/Y",strtotime($row['datahora'])),date("H:i",strtotime($row['datahora'])),$dw[date("w",strtotime($row['datahora']))]);  
							   }
							else {
									$dhini = " ";
								}

                           $lr = sprintf ("<tr><td style='text-decoration: underline;font-size:11px;'><b>Rodada: %02d </td><td style='font-size:11px;' align=right>%s</td></tr>"
                           ,$rodant,$dhini);  
						   echo("<tr><td><br></td></tr>\n");
                       	   echo ($lr)."\n";
                       	   echo ('<tr><td colspan=2>  <table id="menuadm" bordercolor="white" border="1px" cellspacing="0">')."\n"; 
				        	echo ('         <tr class="cabec"> <td align="center">Jg</td> <td  align="right"></td><td  align="center">Resultados</td><td></td></tr>')."\n";
					       $pts = 0;
					       $gols = 0;
			               $fllst = 1;   
					       $grpant = "";

                   		}	
/*                  if (empty($grpant))
                  	$grpant = $row['grupo']; */
    
                  if ($grpant != $row['grupo']) {
  	               	$grpant = $row['grupo'];
	                  if ($row['fase'] == 8)
						   echo('<tr><td style="background:rgb(255, 229, 203);" colspan=10><b>Oitavas de Final</td></tr>')."\n";
	                  else
	                  if ($row['fase'] == 4)
						   echo('<tr><td style="background:rgb(255, 229, 203);" colspan=10><b>Quartas de Final</td></tr>')."\n";
	                  else
	                  if ($row['fase'] == 2)
						   echo('<tr><td style="background:rgb(255, 229, 203);" colspan=10><b>Semi-finais</td></tr>')."\n";
	                  else
	                  if ($row['fase'] == 1)
						   echo('<tr><td style="background:rgb(255, 229, 203);" colspan=10><b>Final</td></tr>')."\n";
					  else	
					       echo('<tr><td style="background:rgb(255, 229, 203);" colspan=10><b>Grupo: '.$row['grupo'].'</td></tr>')."\n";
                  }
                  	
				  $usrma = new Usuario($row['idmanda']);
				  $usrvi = new Usuario($row['idvisita']);
		          $linha = sprintf ('<td align="center">%s</td>' .
	//			          		'<td align="center">%s</td>' .
				          		'<td align="right">%s</td>' .
				          		'<td align="center">%s X %s</td>' .
				          		'<td>%s</td> '
				          		,$row['jogo']
//				          		,$row['grupo']
				          		,$usrma->getLinkUsuario()
				          		,$row['golsma']
				          		,$row['golsvi']
				          		,$usrvi->getLinkUsuario());

		          echo ('<tr class="dettab">'.$linha.'</tr>')."\n";
				}

    if ($fllst == 0) {
     		echo ('<tr><td colspan=2> <table id="menuadm" bordercolor="white" border="1px" cellspacing="0">')."\n"; 
        	echo ('         <tr class="cabec"> <td align="center">Jg</td> <td  align="right"></td><td  align="center">Resultados</td><td></td></tr>')."\n";
    }

	mysql_free_result($result);
	mysql_close($link);

?>
	</table> </td></tr>

    <tr><td><br></td></tr>

</table>

<?php include ("bothome.php"); ?>
<?php include ("rodape.php"); ?>
