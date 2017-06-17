<?php include("sessao.php"); ?>

<?php include("head.php"); ?>

<?php include("vlogin.php"); ?>

<script language="javascript">

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
            <a href="lst_cadresult.php">Cadastro de Resultados</a>
      </span>
      
 <?php include("traco.php"); ?>

 <div id="formu" name="toph">
    <span class="ftop">
			<span class="f1"></span>
			<span class="f2"></span>
			<span class="f3"></span>
			<span class="f4"></span>
		</span>
      

 <form method="post" action="prc_cadresult.php" name="frm_cadresult" onload="frmload();"
 			onSubmit="return Enviaform()">
  <table id="tabform" bordercolor="white"  border="0" cellspacing="0" width="500px" style="width:500px">

	<?php
     $camp = $_GET['camp'];
     $rod = $_GET['rod'];

	 echo ("     <tr>")."\n";
     campeonato($camp);
     rodada($rod);
	 echo ("     </tr>")."\n";

     echo ('<tr> <td colspan=10>');
     include("traco.php");
	 echo ('</td></tr>')."\n";

     echo ('<tr class="cabec" ><td>Jogo</td> <td align="right">Mandante</td><td align="center">X</td> <td align="left">Visitante</td> <td>Data/Hora Início</td></tr>')."\n";
     
     listajogos($camp, $rod);

     echo('<input type=hidden name="camp"  value="'.$camp.'">')."\n";
     echo('<input type=hidden name="rodada"  value="'.$rod.'">')."\n";
 ?>
  
  </table>
 </form>
<?php

function listajogos($camp, $rod) {
     	
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

     $sql = sprintf("select jogo,manda,visita,data,hora,grupo,tm.nome mandante,tv.nome visitante,golsma,golsvi " .
     		"from " .
     		"cad_rodada r, " .
     		"cad_times tm, " .
     		"cad_times tv " .
     		"where " .
     		"campeonato = %d " .
     		"and rodada = %d " .
     		"and tv.codigo = visita " .
     		"and tm.codigo = manda"
     		,$camp,$rod);

	 $rs1 = mysql_query($sql)
				or die('\nErro consultando banco de dados: ' . mysql_error()); 
	
     $grpant = " ";
     while ($row = mysql_fetch_assoc($rs1)) {
             if ($qtgrp > 1 && $grpant != $row['grupo']) {
             	$grpant = $row['grupo']; 
             	echo ('<tr bordercolor="white"  border="1px"><td colspan=2 style="font-weight:bold;">Grupo '.$row['grupo'].'</tr></td>')."\n";
             }
             	
             echo ('<tr><td align="right" style="font-weight:bold;">'.$row['jogo'].'</td>')."\n"; // Numero do Jogo

             echo ('<td align="right">')."\n";
             echo ($row['mandante']); 
//             echo ("</td>")."\n";
             $golsma = sprintf('     <input type="text" style="width:20px;" width="20px" maxlength="2" name="M%02d" value="%s">',$row['jogo'],$row['golsma']);
//             echo ("<td>");
             echo ($golsma); // input dos gols do mandante
             echo ("</td>");


             echo ("<td align='center'>X</td>")."\n";

             $golsvi = sprintf('     <input type="text" style="width:20px;" width="20px" maxlength="2" name="V%02d" value="%s">',$row['jogo'],$row['golsvi']);
             echo ("<td>");
             echo ($golsvi); // input dos gols do visitante
//             echo ("</td>");

//             echo ("<td align='left'>")."\n";
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

     mysql_free_result($rs1);
  	 mysql_close($link);

	
}

function campeonato($camp) {

     echo ('<td colspan=3> <span  style="font-weight:bold;">Campeonato</span><br>')."\n";

 	  echo ('       <select name="cmbcamp" disabled width=200 style="width:200px" tabindex="1" >')."\n"; 
     	  
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

function rodada($rod) {

     $dis = 'disabled';

     echo ('	<td> </td>')."\n";
     echo ('	<td colspan=3> <span style="font-weight:bold;">Rodada</span><br>
     		    <input type="text" size="4" maxlength="4" name="rod" value="'.$rod.'" '.$dis.' tabindex="1" > </td>')."\n";
     
}

?>

<?php include ("bothome.php"); ?>

<?php include ("rodape.php"); ?>
