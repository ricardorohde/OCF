<?php include("sessao.php"); ?>
<?php require_once($_SESSION['DOCROOT']."/classes/class.usuario.php"); ?>
<div class="PainelCentral">
<div class="LeftPainel"></div>
<div class="TitBox">.:: Mural do Sócio ::.</div>
<div class="RightPainel"></div>
<div class="LinkPainel"><a href="frm_cadmural.php">Deixe seu recado...</a></div>
<div class="BarraTit"/>
<div class="Caixa220">
<table class="PainelCentral_table" width="100%" cellpadding="0" cellspacing="0" height="100%" >
<?php

   include 'conectadb.php';

   $sql = sprintf("select codigo,datahora,mensagem,m.userid,username " .
   		"from " .
   		"cad_mural m, " .
   		"cad_usuario u " .
   		"where " .
   		"m.userid = u.userid " .
   		"order by " .
   		"m.datahora desc " .
   		"limit 15");

      $result = mysql_query($sql)
	 				or die('\nErro consultando recados do mural: ' . mysql_error()); 
      while ($row = mysql_fetch_assoc($result)) {
              $usr = new Usuario($row['userid']); 
             
              $ln = sprintf('<td style="width:105px;">(%s %s)</td><td><b>%s </b></td><td>%s</td>'
             		,date("d/m/Y",strtotime($row['datahora'])),date("H:i",strtotime($row['datahora'])),$usr->getLinkUsuario(),$row['mensagem']);      	
             echo ("<tr>".$ln."</tr>\n");       	
      }

	mysql_free_result($result);
	mysql_close($link);

?>
</table>
</div> 
</div>