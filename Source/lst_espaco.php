<?php include("sessao.php"); ?>
<?php require_once($_SESSION['DOCROOT']."/classes/class.usuario.php"); ?>
<div class="PainelCentral">
<div class="LeftPainel"> </div>
<div class="TitBox">.:: Nosso Forum ::.</div>
<div class="RightPainel"> </div>
<div class="LinkPainel"><a href="frm_cadespaco.php">Clique aqui e deixe sua mensagem</a></div>
<div class="BarraTit"</div>
<div class="Caixa150" >
<table width="100%" cellpadding="0" cellspacing="0" height="100%">
<?php

   include 'conectadb.php';

   $sql = sprintf("select codigo,datahora,mensagem,m.userid,username " .
   		"from " .
   		"cad_espaco_opaleiro m, " .
   		"cad_usuario u " .
   		"where " .
   		"m.userid = u.userid " .
   		"order by " .
   		"m.datahora desc " .
   		"limit 12");

      $result = mysql_query($sql)
	 				or die('\nErro consultando recados do espaço ' . mysql_error()); 
      while ($row = mysql_fetch_assoc($result)) {
              $usr = new Usuario($row['userid']); 
             
              $ln = sprintf("<b>%s</b> <i><span style='font-size:9px;'>%s %s</span></i>: %s"
             		,$usr->getLinkUsuario(),date("d/m/Y",strtotime($row['datahora'])),date("H:i",strtotime($row['datahora'])),$row['mensagem']);      	
             echo ("<tr><td>".$ln."</td></tr>\n");       	
      }

	mysql_free_result($result);
	mysql_close($link);

?>
</table>
</div> 
</div>