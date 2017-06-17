<?php include("sessao.php"); ?>

<?php include("head.php"); ?>

<?php include("vlogin.php"); ?>

<script language="JavaScript">

function selcamp() {

    cmb = document.getElementById("cmbcamp");
    rod = document.getElementById("rod");
    op = document.getElementById("op");

    document.location='frm_cadrodada.php?camp='+cmb.options[cmb.selectedIndex].value+'&rod='+rod.value+'&op='+op.value;

}
      
function Enviaform() { 
var x=0;


      rod = document.getElementById("rod");

      document.getElementById('rodada').setAttribute("value", rod.value); 
      return true; 
  } 

function frmload() { 

     document.getElementById('toph').setAttribute("style", "width:650px;"); 
     document.getElementById('cmbcamp').setfocus(); 
 } 


</script>


      <span id="titform">
          <a href="menu_admin.php">Administra&ccedil;&atilde;o</a> -> 
          <a href="lst_cadrodada.php">Cadastro de Rodadas</a> 
      </span>
      
 <?php include("traco.php"); ?>

 <div id="formu" name="toph"  style="width:560px">
    <span class="ftop">
			<span class="f1"></span>
			<span class="f2"></span>
			<span class="f3"></span>
			<span class="f4"></span>
		</span>
      

 <form method="post" action="prc_cadrodada.php" name="frm_cadrodada" onload="frmload();"
 			onSubmit="return Enviaform()">
  <table id="tabform"  border="0" cellspacing="0"   style="width:560px">

	<?php
     $camp = $_GET['camp'];
     $rod = $_GET['rod'];
     $op = $_GET['op'];

     if (empty($rod))
         $rod = ' ';

	 echo ("     <tr>")."\n";
     campeonato($camp, $op);
     rodada($rod,$op);
	 echo ("     </tr>")."\n";

     echo ('<tr> <td colspan=10>');
     include("traco.php");
	 echo ('</td></tr>')."\n";

     echo ('<tr style="font-weight:bold;"><td>Jogo</td> <td align="right">Mandante</td><td align="center">X</td> <td align="left">Visitante</td> <td>Data</td> <td>Hora</td><td>Ouro</td></tr>')."\n";
     
     if ($op == 'I')
         inclusao($camp);
     else
         alteracao($camp, $rod);

     echo('<input type=hidden name="camp"  value="'.$camp.'">')."\n";
     echo('<input type=hidden name="op"  value="'.$op.'">')."\n";
     echo('<input type=hidden name="rodada"  value="'.$rod.'">')."\n";
 ?>
  
  </table>
 </form>
<?php



function inclusao($camp) {
     
     if ($camp == 0)
     	return;
     	
     echo ("<tr>")."\n";
     
     include ('conectadb.php');

     $sql = sprintf("select ano from cad_campeonato
						where codigo = %d",$camp);
	 $rs1 = mysql_query($sql)
				or die('\nErro consultando banco de dados: ' . mysql_error()); 
	
     $row = mysql_fetch_assoc($rs1);

     $anocamp = $row['ano'];
     
     mysql_free_result($rs1);
     
     $sql = sprintf("select grupo,count(*) qtde from cad_grupo
						where campeonato = %d
							group by grupo" .
									" order by grupo",$camp);
	 $rs1 = mysql_query($sql)
				or die('\nErro consultando banco de dados: ' . mysql_error()); 
	
	 $qtgrp = mysql_num_rows($rs1);
    
     $jogo = 0;
     while ($row = mysql_fetch_assoc($rs1)) {
             if ($qtgrp > 1)
             	echo ('<tr><td colspan=2 style="font-weight:bold;">Grupo '.$row['grupo'].'</tr></td>')."\n";

     		 $strOpt = cmbtime($camp,$row['grupo'],0); 

		     $qtdej = $row['qtde'] / 2;
		     
     		 for ($x = 0;$x < $qtdej;$x++) {
                  $jogo++;
                  $sel = sprintf("	<select name=M%02d width='170px' style='width:170px;'>\n",$jogo);
                  echo ('<tr><td align="right" style="font-weight:bold;">'.$jogo.'</td>')."\n"; // Numero do Jogo
                  echo ('<td align="right">')."\n";
                  echo ($sel);  // abre o select do mandante
                  echo ($strOpt); // Opções do select do mandante
                  echo ("</select>")."\n"; // fecha select do mandante     				  
                  echo ("</td>")."\n";
                  echo ("<td align='center'>X</td>")."\n";
                  echo ("<td align='left'>")."\n";
                  $sel = sprintf("	<select name=V%02d width='170px' style='width:170px;'>\n",$jogo);
                  echo ($sel); // abre o select do visitante
                  echo ($strOpt); // opções do select do visitante
                  echo ("</select>")."\n"; // fecha select do visitante     				  
                  echo ("</td>")."\n";
                  $dia = sprintf('     <input type="text" style="width:20px;" width="20px" maxlength="2" name="DIA%02d" value="">',$jogo);
				  $mes = sprintf('     <input type="text" style="width:20px;" width="20px" maxlength="2" name="MES%02d" value="">',$jogo);
				  $ano = sprintf('	   <input type="text" style="width:35px;" width="35px" maxlength="4" name="ANO%02d" value="%04d">',$jogo,$anocamp);

                  echo ("<td>");
                  echo ($dia)."\n";
				  echo ('      <span style="font-weight:bold;">/</span>')."\n";
                  echo ($mes)."\n";
				  echo ('      <span style="font-weight:bold;">/</span>')."\n";
                  echo ($ano)."\n";
                  echo ("</td>");

                  $hh = sprintf('        <input type="text" style="width:20px;" width="20px" maxlength="2" name="HH%02d" value="">',$jogo);
				  $mm = sprintf('	     <input type="text" style="width:20px;" width="20px" maxlength="2" name="MM%02d" value="">',$jogo);
                  echo ("<td>")."\n";
                  echo ($hh)."\n";
				  echo('      <span style="font-weight:bold;">:</span>')."\n";
                  echo ($mm)."\n";
                  echo ("</td>")."\n";
			      
                  $ouro = sprintf('        <input type="checkbox" value="S" name="OU%02d">',$jogo);
                  echo ("<td>")."\n";
                  echo ($ouro)."\n";
                  echo ("</td>")."\n";

			      $grp = sprintf("<input type=hidden name='GRP%02d' value='%s'>",$jogo,$row['grupo']);
			      echo($grp)."\n";

     			}
     	
			}
     echo ('<tr> <td colspan=10>');
     include("traco.php");
	 echo ('</td></tr>')."\n";
	 echo ('	 <tr> <td colspan="2"> <div style="float:left;"> <input tabindex="3" name="gravar" value="Gravar" type="submit"> ')."\n";

     echo('<input type=hidden name="jogos"  value="'.$jogo.'">')."\n";
	      
     mysql_free_result($result);
     mysql_free_result($rs1);
  	 mysql_close($link);

}

function alteracao($camp, $rod) {
     	
     echo ("<tr>")."\n";
     
     include ('conectadb.php');

     $sql = sprintf("select grupo,count(*) qtde from cad_grupo
						where campeonato = %d
							group by grupo" .
									" order by grupo",$camp);
	 $rs1 = mysql_query($sql)
				or die('\nErro consultando banco de dados: ' . mysql_error()); 
	
	 $qtgrp = mysql_num_rows($rs1);

     $sql = sprintf("select jogo,manda,visita,data,hora,grupo,flouro	from 
						cad_rodada 
							where 
							campeonato = %d
							and rodada = %d",$camp,$rod);
	 $rs1 = mysql_query($sql)
				or die('\nErro consultando banco de dados: ' . mysql_error()); 
	
     $grpant = " ";
     while ($row = mysql_fetch_assoc($rs1)) {
             if ($qtgrp > 1 && $grpant != $row['grupo']) {
             	$grpant = $row['grupo']; 
             	echo ('<tr><td colspan=2 style="font-weight:bold;">Grupo '.$row['grupo'].'</tr></td>')."\n";
             }
             	
     		 $strOpt = cmbtime($camp,$row['grupo'],$row['manda']); 
             $sel = sprintf("	<select name=M%02d width='170px' style='width:170px;'>\n",$row['jogo']);
             echo ('<tr><td align="right" style="font-weight:bold;">'.$row['jogo'].'</td>')."\n"; // Numero do Jogo
             echo ('<td align="right">')."\n";
             echo ($sel);  // abre o select do mandante
             echo ($strOpt); // Opções do select do mandante
             echo ("</select>")."\n"; // fecha select do mandante     				  
             echo ("</td>")."\n";
             echo ("<td align='center'>X</td>")."\n";
             echo ("<td align='left'>")."\n";
     		 $strOpt = cmbtime($camp,$row['grupo'],$row['visita']); 
             $sel = sprintf("	<select name=V%02d width='170px' style='width:170px;'>\n",$row['jogo']);
             echo ($sel); // abre o select do visitante
             echo ($strOpt); // opções do select do visitante
             echo ("</select>")."\n"; // fecha select do visitante     				  
             echo ("</td>")."\n";

             if ($row['data'] == "0000-00-00") {
             		$dia = sprintf('     <input type="text" style="width:20px;" width="20px" maxlength="2" name="DIA%02d" value="">',$row['jogo']);
		     		$mes = sprintf('     <input type="text" style="width:20px;" width="20px" maxlength="2" name="MES%02d" value="">',$row['jogo']);
			 		$ano = sprintf('	 <input type="text" style="width:35px;" width="35px" maxlength="4" name="ANO%02d" value="">',$row['jogo']);
             }
             else {
             		$dia = sprintf('     <input type="text" style="width:20px;" width="20px" maxlength="2" name="DIA%02d" value="%02d">',$row['jogo'],date("d",strtotime($row['data'])));
		     		$mes = sprintf('     <input type="text" style="width:20px;" width="20px" maxlength="2" name="MES%02d" value="%02d">',$row['jogo'],date("m",strtotime($row['data'])));
			 		$ano = sprintf('	 <input type="text" style="width:35px;" width="35px" maxlength="4" name="ANO%02d" value="%04d">',$row['jogo'],date("Y",strtotime($row['data'])));
             }
             echo ("<td>");
             echo ($dia)."\n";
			 echo ('      <span style="font-weight:bold;">/</span>')."\n";
             echo ($mes)."\n";
			 echo ('      <span style="font-weight:bold;">/</span>')."\n";
             echo ($ano)."\n";
             echo ("</td>");

             if ($row['hora'] == "00:00:00") {
             		$hh = sprintf('        <input type="text" style="width:20px;" width="20px" maxlength="2" name="HH%02d" value="">',$row['jogo']);
			 		$mm = sprintf('	     <input type="text" style="width:20px;" width="20px" maxlength="2" name="MM%02d" value="">',$row['jogo']);
             }
             else {
             		$hh = sprintf('        <input type="text" style="width:20px;" width="20px" maxlength="2" name="HH%02d" value="%02d">',$row['jogo'],date("H",strtotime($row['hora'])));
			 		$mm = sprintf('	     <input type="text" style="width:20px;" width="20px" maxlength="2" name="MM%02d" value="%02d">',$row['jogo'],date("i",strtotime($row['hora'])));
             }
             echo ("<td>")."\n";
             echo ($hh)."\n";
			 echo('      <span style="font-weight:bold;">:</span>')."\n";
             echo ($mm)."\n";
             echo ("</td>")."\n";

             if ($row['flouro'] == 'S')
                  $ouro = sprintf('        <input type="checkbox" value="S" checked name="OU%02d">',$row['jogo']);
			 else	  
                  $ouro = sprintf('        <input type="checkbox" value="S" name="OU%02d">',$row['jogo']);
				  
             echo ("<td>")."\n";
             echo ($ouro)."\n";
             echo ("</td>")."\n";

		     $grp = sprintf("<input type=hidden name='GRP%02d' value='%s'>",$row['jogo'],$row['grupo']);
		      echo($grp)."\n";
     	
			}
     include('botaltexc.php');

     echo('<input type=hidden name="jogos"  value="'.mysql_num_rows($rs1).'">')."\n";

     mysql_free_result($rs1);
	
}

function cmbtime($camp,$grupo,$time) {

     include ('conectadb.php');

     $sql = sprintf("select grupo,time,nome from cad_grupo g, cad_times t
		         				where g.time = t.codigo
				    			and g.campeonato = %d 
				    			and g.grupo = '%s'
								order by grupo,nome",$camp,$grupo);
	 $result = mysql_query($sql)
					or die('\nErro consultando banco de dados: ' . mysql_error()); 

     $strOpt = "      	      <option value='0'> </option>\n"; 	

     while ($r1 = mysql_fetch_assoc($result)) {
                  if ($r1['time'] == $time)
                      $sel = "selected";
                  else
                      $sel = " ";              

        		    $strOpt = $strOpt.'			<option value="'.$r1['time'].'" '.$sel.' >'.$r1['nome'].'</option>'."\n";
			}

     mysql_free_result($result);
   	 mysql_close($link);
     
     return $strOpt;

}	

function campeonato($camp, $op) {

     echo ('<td colspan=3> <span  style="font-weight:bold;">Campeonato</span><br>')."\n";

     if ($op == "I") {
     	  echo ('       <select name="cmbcamp" width=200 style="width:200px" tabindex="1" onchange="selcamp();" > ')."\n";
     }
     else {
     	  echo ('       <select name="cmbcamp" disabled width=200 style="width:200px" tabindex="1" >')."\n"; 
     }
     	  
     echo ('    	      <option value="0"> </option>')."\n"; 

     include ('conectadb.php');
     $sql = sprintf("Select codigo,descricao,ano from cad_campeonato order by descricao");
	 $result = mysql_query($sql)
			or die('\nErro consultando banco de dados: ' . mysql_error()); 
     
     while ($row = mysql_fetch_assoc($result)) {
             if ($camp == $row['codigo'])
                 $sel = ' selected';
             else
                 $sel = ' ';
  	         echo ('<option value="'.$row['codigo'].'"'.$sel.'>'.$row['descricao'].'-'.$row['ano'].'</option>')."\n";
		}
     mysql_free_result($result);
   	 mysql_close($link);
   	 echo ('    </select> </td>')."\n";
}

function rodada($rod, $op) {

     if ($op == 'I') 
         $dis = ' ';
     else
         $dis = 'disabled';
     

     echo ('	<td> </td>')."\n";
     echo ('	<td colspan=3> <span style="font-weight:bold;">Rodada</span><br>
     		    <input type="text" size="4" maxlength="4" name="rod" value="'.$rod.'" '.$dis.' tabindex="1" > </td>')."\n";
     
}

?>

<?php include ("bothome.php"); ?>

<?php include ("rodape.php"); ?>
