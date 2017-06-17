<?php include("sessao.php"); ?>

<head>
  <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
  <META HTTP-EQUIV="control-cache" CONTENT="no-cache">
  <META NAME="author" CONTENT="Alencar Mendes de Oliveira">
  <META NAME="copyright" CONTENT="copyright 2005 Bolao.net">
  <META NAME="robots" CONTENT="all">
  <META NAME="description" CONTENT="Bolão dos campeonatos de futebol">
  <META NAME="keywords" CONTENT="Bolão, bolão do alex,brasileirão,copa bolão">
  <META HTTP-EQUIV="refresh" CONTENT="120">

  <title>Detalhamento da pontuação - http://bolao.sytes.net</title>
  <link rel="stylesheet" type="text/css" media="screen" href="estilos.css" />

 </head>

<body class="padrao">
	<span class="titusr">Detalhamento da Pontuação</span>
    <?php include("traco.php"); ?>

<table cellspacing="0" border="0" cellpadding="0"   style="width:640px;">
<?php
  $org = $_GET['org'];
  if ($org == 0) 
	echo ('<tr><td align="right"><a  href="javascript:history.back()">Volta</a></td></tr>');
?>

<tr> <td>


<?php 

  $camp = $_GET['camp'];
  $usr =  $_GET['usr'];

  $dw = array("Dom","Seg","Ter","Qua","Qui","Sex","Sab"); 

	include ('conectadb.php');

	$sql = sprintf("select username from cad_usuario where userid = %d",$usr);
    $rs = mysql_query($sql)
				or die('\nErro consultando campeonato: ' . mysql_error()); 
  	$rc = mysql_fetch_assoc($rs);
    $username = $rc['username'];

	mysql_free_result($rs);


	$sql = sprintf("select descricao,ano from cad_campeonato where codigo = %d",$camp);
    $rs = mysql_query($sql)
				or die('\nErro consultando campeonato: ' . mysql_error()); 
  	$rc = mysql_fetch_assoc($rs);
    echo ("<tr><td colspan=2 style='text-decoration: underline;color:blue;font-weight:bold;font-size:15px;' align=center>".$rc['descricao']."-".$rc['ano']."</td></tr>\n");                	
    echo ("<tr><td><br></td></tr>");
    echo ("<tr><td colspan=2 style='color:blue;font-size:15px;font-weight:bold;text-decoration: underline;' align=center>".$username."</td></tr>\n");                	

    mysql_free_result($rs);
    echo("<tr><td><br></td></tr>\n");

        $verifica = sprintf("select * from
						(select r.rodada,r.jogo,r.golsma,r.golsvi,
												tm.nome manda,tv.nome visita,
												p.pmanda, p.pvisita,p.pontos,
												addtime(r.data, r.hora) datahora, ifnull(cr.posicao,0) posicao,gols,dataini
												from
												cad_palpite p,
												cad_times tm,
												cad_times tv,
												cad_rodada r,
													(select campeonato,rodada,min(addtime(data, hora)) dataini
    														from cad_rodada
    													group by campeonato,rodada) i
						    					left join
						    					cad_claroda cr
												on
												cr.campeonato = p.campeonato
												and cr.rodada = p.rodada
												and cr.userid = p.userid
												where
												p.campeonato = %d
												and r.campeonato = i.campeonato
												and r.rodada = i.rodada
												and r.campeonato = p.campeonato
												and r.rodada = p.rodada
												and r.jogo = p.jogo
												and r.manda = tm.codigo
												and r.visita = tv.codigo
												and p.userid =%d) usr
						left join
						(select r.rodada adv_rodada,r.jogo adv_jogo,
												p.pmanda adv_pmanda, p.pvisita adv_pvisita,p.pontos adv_pontos,
												ifnull(cr.posicao,0) adv_posicao,gols adv_gols, username adv_username
												from
												cad_palpite p,
												cad_rodada r,
												cad_usuario u,
												(select campeonato,rodada,min(addtime(data, hora)) datahora
						    						from cad_rodada
						    					group by campeonato,rodada) i
						    					left join
						    					cad_claroda cr
												on
												cr.campeonato = p.campeonato
												and cr.rodada = p.rodada
												and cr.userid = p.userid
												where
												p.campeonato = %d
												and r.campeonato = i.campeonato
												and r.rodada = i.rodada
												and r.campeonato = p.campeonato
												and r.rodada = p.rodada
												and r.jogo = p.jogo
												and p.userid = u.userid
												and p.userid =(select userid from cad_rodada_copa
						                             where campeonato = %d
						                                  and rodada = r.rodada
						                                  and userid <> %d
						                                  and jogo = (select jogo from cad_rodada_copa
						                                              where
						                                                  rodada = r.rodada
						                                                and  userid = %d))) adv
						on
						usr.jogo = adv.adv_jogo
						and usr.rodada = adv.adv_rodada order by rodada, jogo",$camp,$usr,$camp,$camp,$usr,$usr);

  		$result = mysql_query($verifica)
							or die('\nErro consultando banco de dados: ' . mysql_error()); 

        $fllin = 0;
        $rodant = 0;
        $pts = 0;	//Pontos do usuário
        $gols = 0;	//Gols do usuário
        $posrod = 0;
        $fllst = 0;
        $golstot = 0;	//Total de Gols do usuário

        $ptsad = 0;	//Pontos do adversário na copa
        $golsad = 0;	//Gols do adversário na copa
        $golstotad = 0;	//Total de Gols do adversário na copa

        $adv_pmanda = " ";
        $adv_pvisita = " ";

        if (mysql_num_rows($result) == 0) {
    		echo ('<tr><td colspan=2> <table frame=box bordercolor="white" border="1px" cellspacing="0" style="width:640px;">')."\n"; 
        	echo ('         <tr class="cabec"> <td align="center">Jg</td> <td width="100px"  align="right">Mandante</td><td  align="center">X</td><td width="100px">Visitante</td> <td align="center">Result</td><td align="center">Palpite</td><td align="center">Pts</td><td align="center">Gols</td><td align="center">Palpite</td><td align="center">Pts</td><td align="center">Gols</td><td align="center">Data/Hora</td> </tr>')."\n";
            $fllst = 1;   
        }

			while ($row = mysql_fetch_assoc($result)) {
                       if ($rodant == 0) {
			               $dtini = mktime(date("H",strtotime($row['dataini'])), //Hora
		               				   date("i",strtotime($row['dataini'])), //Minuto
		               				   0,	//Segundo
		               				   date("m",strtotime($row['dataini'])), //Mes
		               				   date("d",strtotime($row['dataini'])), //Dia
		               				   date("Y",strtotime($row['dataini']))); //Ano 

			               $dif = time() - ($dtini - 900); // Hora atual menos 15 minutos

                           /* 
                            * Se ainda falta mais que 15 minutos para iniciar a rodada e
                            * o usuário logado é diferente do consultado e o
                            * usuário não é administrador não deixa consultar a rodada
                            */
                           if ($dif <= 0 && $_SESSION['userid'] != $usr && $_SESSION['niveluser'] != 999999) 
						   
								break;
							/*	*/
							
                       	   $rodant = $row['rodada'];
                           $lr = sprintf ("<tr><td  colspan=8 style='text-decoration: underline;font-size:11px;'><b>Rodada: %02d </td><td style='font-size:13px;font-weight:bold;background:#cbdcc9;' colspan=3 align=center>%s</td><td></td></tr>"
                           ,$rodant,$row['adv_username']);  
    //                   	   echo ($lr)."\n";
				           echo ('<tr><td colspan=2> <table frame=box bordercolor="white" border="1px" cellspacing="0" style="width:640px;">')."\n"; 
                       	   echo ($lr)."\n";
	      				   echo ('         <tr class="cabec"> <td align="center">Jg</td> <td width="100px"  align="right">Mandante</td><td  align="center">X</td><td width="100px">Visitante</td><td align="center">Result</td> <td align="center">Palpite</td><td align="center">Pts</td><td align="center">Gols</td><td align="center">Palpite</td><td align="center">Pts</td><td align="center">Gols</td><td align="center">Data/Hora</td> </tr>')."\n";
				            $fllst = 1;   
                     	}	
                       if ($rodant != $row['rodada']) {
			               $dtini = mktime(date("H",strtotime($row['dataini'])), //Hora
		               				   date("i",strtotime($row['dataini'])), //Minuto
		               				   0,	//Segundo
		               				   date("m",strtotime($row['dataini'])), //Mes
		               				   date("d",strtotime($row['dataini'])), //Dia
		               				   date("Y",strtotime($row['dataini']))); //Ano 

			               $dif = time() - ($dtini - 900); // Hora atual menos 15 minutos

                           /* 
                            * Se ainda falta mais que 15 minutos para iniciar a rodada e
                            * o usuário logado é diferente do consultado e o
                            * usuário não é administrador não deixa consultar a rodada
                            */
                           if ($dif <= 0 && $_SESSION['userid'] != $usr && $_SESSION['niveluser'] != 999999) 
								break;
							/*	*/
							
					       $lt = sprintf('    <tr class="cabec"> <td colspan=2>Posição: %d </td> <td colspan=4 align="right">Total da Rodada</td><td align="center">%s</td><td align="center">%s</td><td align="center"> </td><td align="center">%s</td><td align="center">%s</td><td></td> </tr>',$posrod,$pts,$gols,$ptsad,$golsad)."\n";
                       	   echo ($lt)."\n";
                       	   echo (' </table> </td></tr>')."\n"; 
                       	   $rodant = $row['rodada'];

                           $lr = sprintf ("<tr><td  colspan=8 style='text-decoration: underline;font-size:11px;'><b>Rodada: %02d </td><td style='font-size:13px;font-weight:bold;background:#cbdcc9;' colspan=3 align=center>%s</td><td></td></tr>"
                           ,$rodant,$row['adv_username']);  
						   echo("<tr><td><br></td></tr>\n");
//                       	   echo ($lr)."\n";
                       	   echo ('<tr><td colspan=2>  <table frame=box  bordercolor="white" border="1px" cellspacing="0" style="width:640px;">')."\n"; 
                       	   echo ($lr)."\n";
					       echo ('         <tr class="cabec"> <td align="center">Jg</td> <td width="100px"  align="right">Mandante</td><td  align="center">X</td><td width="100px">Visitante</td><td align="center">Result</td> <td align="center">Palpite</td><td align="center">Pts</td><td align="center">Gols</td><td align="center">Palpite</td><td align="center">Pts</td><td align="center">Gols</td><td align="center">Data/Hora</td> </tr>')."\n";
					       $pts = 0;
					       $gols = 0;
					       $ptsad = 0;
					       $golsad = 0;
			               $fllst = 1;   
                   		}	
                  if ($dif <= 0 && $_SESSION['niveluser'] != 999999) {
                  	  $adv_pmanda = " ";
                  	  $adv_pvisita= " ";
                  } 
                  else {
                   	  $adv_pmanda = $row['adv_pmanda'];
                  	  $adv_pvisita= $row['adv_pvisita'];
                  }

		          $linha = sprintf ('<td align="center">%s</td>' .
				          		'<td align="right">%s</td>' .
				          		'<td  align="center">X</td> ' .
				          		'<td>%s</td> ' .
				          		'<td align="center">%s x %s</td> ' .
				          		'<td style="background:#ffffa6" align="center">%s x %s</td> ' .
				          		'<td style="background:#ffffa6" align="center">%s</td> '.
				          		'<td style="background:#ffffa6" align="center">%s</td> '.
				          		'<td style="background:#cbdcc9" align="center">%s x %s</td> '.
				          		'<td style="background:#cbdcc9" align="center">%s</td> '.
				          		'<td style="background:#cbdcc9" align="center">%s</td> '.
				          		'<td>%s %s</td> '
				          		,$row['jogo']
				          		,$row['manda']
				          		,$row['visita']
				          		,$row['golsma']
				          		,$row['golsvi']
				          		,$row['pmanda']
				          		,$row['pvisita']
				          		,$row['pontos']
				          		,$row['gols']
				          		,$adv_pmanda
				          		,$adv_pvisita
				          		,$row['adv_pontos']
				          		,$row['adv_gols']
								,date("d/m/Y H:i",strtotime($row['datahora'])),
								$dw[date("w",strtotime($row['datahora']))]
				          		);

		          echo ('<tr class="dettab">'.$linha.'</tr>')."\n";
                  $pts += $row['pontos'];
                  $gols += $row['gols'];
                  $golstot += $row['gols'];
                  $posrod = $row['posicao'];
                  $ptsad += $row['adv_pontos'];
                  $golsad += $row['adv_gols'];
                  $golstotad += $row['adv_gols'];
				}

    if ($fllst == 0) {
     		echo ('<tr><td colspan=2> <table frame=box bordercolor="white" border="1px" cellspacing="0" style="width:640px;">')."\n"; 
        	echo ('         <tr class="cabec"> <td align="center">Jg</td> <td width="100px"  align="right">Mandante</td><td  align="center">X</td><td width="100px">Visitante</td><td align="center">Result</td> <td align="center">Palpite</td><td align="center">Pts</td><td align="center">Gols</td> <td align="center">Palpite</td><td align="center">Pts</td><td align="center">Gols</td><td align="center">Data/Hora</td></tr>')."\n";
    }

    if ($rodant != 0) {
        $lt = sprintf('    <tr class="cabec"> <td colspan=2>Posição: %d </td> <td colspan=4 align="right">Total da Rodada</td><td align="center">%s</td><td align="center">%s</td><td align="center"></td><td align="center">%s</td><td align="center">%s</td> <td></td></tr>',$posrod,$pts,$gols,$ptsad,$golsad)."\n";
    	echo ($lt)."\n";
    }

	$sql = sprintf("select pontos,bonus,bonusrecrod from cad_inscricao where campeonato = %d and userid = %d",$camp,$usr);
    $rs = mysql_query($sql)
				or die('\nErro consultando bonificação: ' . mysql_error()); 
  	$rc = mysql_fetch_assoc($rs);

    echo ('    <tr class="cabec"> <td colspan=12><br></td></tr>')."\n";

    $lt = sprintf('    <tr class="cabec"> <td colspan=6 align="right">Total das Rodadas</td><td align="center">%s</td><td align="center">%s</td><td colspan=2></td><td align="center">%s</td><td></td> </tr>',$rc['pontos'],$golstot,$golstotad)."\n";
    echo ($lt)."\n";
    $lt = sprintf('    <tr class="cabec"> <td colspan=6 align="right">Bônus por Títulos de Rodadas</td><td align="center">%s</td><td align="center"></td> <td colspan=4></td></tr>',$rc['bonus'])."\n";
    echo ($lt)."\n";
    $lt = sprintf('    <tr class="cabec"> <td colspan=6 align="right">(*) Bônus por Recorde de Pontos em uma Rodada</td><td align="center">%s</td><td align="center"></td><td colspan=4></td> </tr>',$rc['bonusrecrod'])."\n";
    echo ($lt)."\n";
    $lt = sprintf('    <tr class="cabec"> <td colspan=6 align="right">Pontuação Total</td><td align="center">%s</td><td align="center"></td> <td colspan=4></td></tr>',($rc['bonus']+$rc['pontos']+$rc['bonusrecrod']))."\n";
    echo ($lt)."\n";
    mysql_free_result($rs);

	mysql_free_result($result);
	mysql_close($link);

?>
	</table> </td></tr>
<!--    <tr><td colspan=5>(*) O bônus por recorde de pontos em uma rodada é provisório até a última rodada.</td></tr> -->
  <tr><td><br></td></tr>

<tr><td><br></td></tr>
<?php
  if ($org == 0) 
	echo ('<tr><td align="right"><a  href="javascript:history.back()">Volta</a></td></tr>');
?>

 </table>

</body>