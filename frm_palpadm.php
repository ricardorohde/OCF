<?php include("sessao.php"); ?>

<?php include("head.php"); ?>

 <span class="titusr">Registre seu palpite</span>
      
 <?php include("traco.php"); ?>

 <div id="formu" name="toph"  style="width:530px">
    <span class="ftop">
			<span class="f1"></span>
			<span class="f2"></span>
			<span class="f3"></span>
			<span class="f4"></span>
		</span>
      

 <form method="post" action="prc_palpadm.php" name="frm_palpadm">
  <table id="tabform"  border="0" cellspacing="0">

	<?php
     $camp = $_GET['camp'];
     $rod = $_GET['rod'];
     $usr = $_GET['usr'];

	 echo ("     <tr>")."\n";
     campeonato($camp);
     rodada($rod);
	 echo ("     </tr>")."\n";

     echo ('<tr> <td colspan=10>');
     include("traco.php");
	 echo ('</td></tr>')."\n";

     echo ('<tr style="font-weight:bold;"><td>Jogo</td> <td align="right">Mandante</td><td></td><td align="center">X</td> <td></td><td align="left">Visitante</td> <td>Data/Hora Início</td></tr>')."\n";
     
     listajogos($camp, $rod, $usr);

     echo('<input type=hidden name="camp"  value="'.$camp.'">')."\n";
     echo('<input type=hidden name="rodada"  value="'.$rod.'">')."\n";
     echo('<input type=hidden name="usr"  value="'.$usr.'">')."\n";
 ?>
  
  </table>
 </form>
<?php

function listajogos($camp, $rod, $usr) {
     	
  $dw = array("Dom","Seg","Ter","Qua","Qui","Sex","Sab"); 

     echo ("<tr>")."\n";
     
     include ('conectadb.php');

     $sql = sprintf("select grupo,count(*) qtde from cad_grupo
						where campeonato = %d
							group by grupo" .
									" order by grupo",$camp);
	 $rs1 = mysql_query($sql)
				or die('\nErro consultando banco de dados: ' . mysql_error()); 
	
	 $qtgrp = mysql_num_rows($rs1);

     $sql = sprintf("select r.jogo,p.pmanda,p.pvisita,tm.nome mandante,tv.nome visitante,r.data,r.hora,r.grupo
						from
						cad_rodada r,
						cad_times tm,
						cad_times tv
						left join
						cad_palpite p
						on
						r.campeonato = p.campeonato
						and r.rodada = p.rodada
						and r.jogo = p.jogo
						and p.userid = %d
						where
						r.campeonato = %d
						and r.rodada = %d
						and r.manda = tm.codigo
						and r.visita = tv.codigo",
     					$usr,$camp,$rod);

	 $rs1 = mysql_query($sql)
				or die('\nErro consultando banco de dados: ' . mysql_error()); 
	
     $grpant = " ";
     while ($row = mysql_fetch_assoc($rs1)) {
             if ($qtgrp > 1 && $grpant != $row['grupo']) {
             	$grpant = $row['grupo']; 
             	echo ('<tr><td colspan=2 style="font-weight:bold;">Grupo '.$row['grupo'].'</tr></td>')."\n";
             }
             	
             echo ('<tr><td align="right" style="font-weight:bold;">'.$row['jogo'].'</td>')."\n"; // Numero do Jogo

             echo ('<td align="right">')."\n";
             echo ($row['mandante']); 
             echo ("</td>")."\n";
             $golsma = sprintf('     <input type="text" style="width:20px;" width="20px" maxlength="2" name="M%02d" value="%s">',$row['jogo'],$row['pmanda']);
             echo ("<td>");
             echo ($golsma); // input dos gols do mandante
             echo ("</td>");


             echo ("<td align='center'>X</td>")."\n";

             $golsvi = sprintf('     <input type="text" style="width:20px;" width="20px" maxlength="2" name="V%02d" value="%s">',$row['jogo'],$row['pvisita']);
             echo ("<td>");
             echo ($golsvi); // input dos gols do visitante
             echo ("</td>");

             echo ("<td align='left'>")."\n";
             echo ($row['visitante']);
             echo ("</td>")."\n";

             $dataj = sprintf('%s %s <i>%s</i>',date("d/m/Y",strtotime($row['data'])),date("H:i",strtotime($row['hora'])),$dw[date("w",strtotime($row['data']))]);

             echo ("<td>");
             echo ($dataj)."\n";
             echo ("</td>");
     	
			}
     echo ('<tr> <td colspan=10><br>* Os resultados não informados serão considerados zero</td></tr>')."\n";

     echo ('<tr> <td colspan=10>');
     include("traco.php");
	 echo ('</td></tr>')."\n";
	 echo ('	 <tr> <td colspan="2"> <div style="float:left;"> <input tabindex="3" name="gravar" value="Gravar" type="submit"> ')."\n";

     echo('<input type=hidden name="jogos"  value="'.mysql_num_rows($rs1).'">')."\n";

     mysql_free_result($result);
     mysql_free_result($rs1);
  	 mysql_close($link);

	
}

function campeonato($camp) {

     include ('conectadb.php');
     $sql = sprintf("Select codigo,descricao,ano from cad_campeonato where codigo = %d order by descricao",$camp);
	 $result = mysql_query($sql)
			or die('\nErro consultando banco de dados: ' . mysql_error()); 

     $row = mysql_fetch_assoc($result);

     echo ('<td colspan=3> <b>Campeonato : <span style="color:blue;">'.$row['descricao'].'-'.$row['ano'].'</span></td>')."\n";

     mysql_free_result($result);
   	 mysql_close($link);
}

function rodada($rod) {

     echo ('	<td> </td>')."\n";
     echo ('	<td> </td>')."\n";
     $rodada = sprintf("%02d",$rod);
     echo ('	<td colspan=3> <b>Rodada : <span style="color:blue;">'.$rodada.'</span></td>')."\n";
     
}

?>

<?php include ("bothome.php"); ?>

<?php include ("rodape.php"); ?>
