<?php include("sessao.php"); ?>

<?php include("head.php"); ?>

<?php include("vlogin.php"); ?>

 <span class="titusr">Registre seu palpite</span>
      
 <?php include("traco.php"); ?>

 <div id="formu" name="toph">
    <span class="ftop">
			<span class="f1"></span>
			<span class="f2"></span>
			<span class="f3"></span>
			<span class="f4"></span>
		</span>
      

 <form method="post" action="prc_cadpalpite.php" name="frm_cadpalpite">
  <table id="tabform"  border="0" cellspacing="0" cellpadding="0" width="500px" style="width:500px">

	<?php
	  require_once($_SESSION['DOCROOT']."/classes/class.time.php");

     $camp = $_GET['camp'];
     $rod = $_GET['rod'];
     $chv = $_GET['key'];

	 echo ("     <tr>")."\n";
     campeonato($camp);
     rodada($rod);
	 echo ("     </tr>")."\n";

     echo ('<tr> <td colspan=10>');
     include("traco.php");
	 echo ('</td></tr>')."\n";

     echo ('<tr class="cabec"><td>Jogo</td> <td align="right">Mandante</td><td align="center">X</td> <td align="left">Visitante</td> <td>Data/Hora Início</td></tr>')."\n";
     
     listajogos($camp, $rod);

     echo('<input type=hidden name="camp"  value="'.$camp.'">')."\n";
     echo('<input type=hidden name="rodada"  value="'.$rod.'">')."\n";
     echo('<input type=hidden name="key"  value="'.$chv.'">')."\n";
 ?>
  
  </table>
 </form>
<?php

function listajogos($camp, $rod) {
     	
  $maiorjg = 0;
  
  $bloq = " ";
  
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

     $sql = sprintf("select r.jogo,p.pmanda,p.pvisita,r.manda cmanda,r.visita cvisita,tm.nome mandante,tv.nome visitante,r.data,r.hora,r.grupo,subtime(addtime(r.data,r.hora),'00:15:00') limite
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
     					$_SESSION['userid'],$camp,$rod);

	 $rs1 = mysql_query($sql)
				or die('\nErro consultando banco de dados: ' . mysql_error()); 
	
     $grpant = " ";
     while ($row = mysql_fetch_assoc($rs1)) {
             if ($qtgrp > 1 && $grpant != $row['grupo']) {
			    echo('<tr><td><br></td></tr>');
             	echo ('<tr><td colspan=2 style="font-weight:bold;">Grupo '.$row['grupo'].'</tr></td>')."\n";
				echo ('<tr><td colspan=3><b>1º Classificado</td><td colspan=3><b>2º Classificado</td></tr>');
             	echo ('<tr>')."\n";
                selclas($camp,$row['grupo'],1);
                selclas($camp,$row['grupo'],2);
             	$grpant = $row['grupo']; 
             	echo ('</tr>')."\n";
             }
             
			 if ((strtotime('NOW') + 3600) > strtotime($row['limite']))
			     $bloq = "disabled";
			 else
			 	 $bloq = " ";
			 	
             $tm = new Time($row['cmanda']);
             $tv = new Time($row['cvisita']);

             echo ('<tr id=menuadm><td align="center" style="font-weight:bold;">'.$row['jogo'].'</td>')."\n"; // Numero do Jogo

             echo ('<td align="right">')."\n";
             echo ($tm->getLink()); 
//             echo ("</td>")."\n";
             $golsma = sprintf('     <input type="text" style="width:20px;" width="20px" maxlength="2" name="M%02d" value="%s" %s>',$row['jogo'],$row['pmanda'],$bloq);
//             echo ("<td>");
             echo ($golsma); // input dos gols do mandante
             echo ("</td>");


             echo ("<td align='center'>X</td>")."\n";

             $golsvi = sprintf('     <input type="text" style="width:20px;" width="20px" maxlength="2" name="V%02d" value="%s" %s>',$row['jogo'],$row['pvisita'],$bloq);
             echo ("<td align='left'>");
             echo ($golsvi); // input dos gols do visitante
//             echo ("</td>");

//             echo ("<td align='left'>")."\n";
             echo ($tv->getLink());
             echo ("</td>")."\n";

             $dataj = sprintf('%s %s <i>%s</i>',date("d/m/Y",strtotime($row['data'])),date("H:i",strtotime($row['hora'])),$dw[date("w",strtotime($row['data']))]);

             echo ("<td>");
             echo ($dataj)."\n";
             echo ("</td>");

             if  ($row['jogo'] > $maiorjg)
			 	$maiorjg = $row['jogo'];

			}
//     echo ('<tr> <td colspan=10><br>* Os resultados não informados serão considerados zero</td></tr>')."\n";

     echo ('<tr> <td colspan=10>');
     include("traco.php");
	 echo ('</td></tr>')."\n";
	 echo ('	 <tr> <td colspan="2"> <div style="float:left;"> <input tabindex="3" name="gravar" value="Gravar" type="submit"> ')."\n";

     echo('<input type=hidden name="jogos"  value="'.$maiorjg.'">')."\n";

//     mysql_free_result($result);
//     mysql_free_result($rs1);
  	 mysql_close($link);

	
}

function campeonato($camp) {

     include ('conectadb.php');
     $sql = sprintf("Select codigo,descricao,ano from cad_campeonato where codigo = %d order by descricao",$camp);
	 $result = mysql_query($sql)
			or die('\nErro consultando banco de dados: ' . mysql_error()); 

     $row = mysql_fetch_assoc($result);

     echo ('<td colspan=4> <b>Campeonato : <span style="color:blue;">'.$row['descricao'].'-'.$row['ano'].'</span></td>')."\n";

//     mysql_free_result($result);
   	 mysql_close($link);
}

function rodada($rod) {

     $rodada = sprintf("%02d",$rod);
     echo ('	<td colspan=2> <b>Rodada : <span style="color:blue;">'.$rodada.'</span></td>')."\n";
     
}

function selclas($camp,$grupo,$pos) {

     $sql = sprintf("select t.codigo codigo, t.nome,pg.seleciona
					from
					cad_grupo g,
					cad_times t
					left join
					(select grupo,posicao,'S' seleciona,time from cad_palpite_grupo
							where campeonato = %d
							 and grupo = '%s'
							 and userid = %d
							 and posicao = %d) pg
					 on
					 g.grupo = pg.grupo
					 and g.time = pg.time
					 where
					 g.campeonato = %d
					 and g.grupo = '%s'
					 and t.codigo = g.time"
					 ,$camp,$grupo,$_SESSION['userid'],$pos
					 ,$camp,$grupo);

	 $rs2 = mysql_query($sql)
			or die('\nErro consultando banco de dados: ' . mysql_error()); 

     $strOpt = "      	      <option value='0'> </option>\n"; 	

     while ($rw = mysql_fetch_assoc($rs2)) {
            if ($rw['seleciona'] == 'S')
                $sel = "selected";
            else
                $sel = " ";

   		    $strOpt = $strOpt.'			<option value="'.$rw['codigo'].'" '.$sel.' >'.$rw['nome'].'</option>'."\n";

	 }

     $sel = sprintf("	<select name=CL%02d%s width='170px' style='width:170px;'>\n",$pos,$grupo);
	 echo ('<td colspan=3>')."\n";
	 echo ($sel);  // abre o select
	 echo ($strOpt); // Opções do select
	 echo ("</select>")."\n"; // fecha select
	 echo ("</td>")."\n";
}

?>

<?php include ("bothome.php"); ?>

<?php include ("rodape.php"); ?>
