<div class="PainelCentral">
<div class="LeftPainel"> </div>
<div class="TitBox">.:: Mensagens Externas ::.</div>
<div class="RightPainel"> </div>
<div class="BarraTit"></div>
<div class="Caixa220" >
<table  width="100%" cellpadding="0" cellspacing="0" height="100%">
<?php

   include 'conectadb.php';

   $sql = sprintf("select id,nome,email,assunto,mensagem,datahora " .
   		"from " .
   		"tb_msgcontato " .
   		"order by " .
   		"datahora desc " .
   		"limit 12");

      $result = mysql_query($sql)
	 				or die('\nErro consultando tb_msgcontato: ' . mysql_error()); 
      while ($row = mysql_fetch_assoc($result)) {
             $fn = sprintf ("javascript:janela('frm_msgcontato.php?id=%d',50,50,450,400);",$row['id']);
             $ln = sprintf('<a href="%s"> <span>(%s %s)</span> - %s </a>'
             ,$fn,date("d/m/Y",strtotime($row['datahora'])),date("H:i",strtotime($row['datahora'])),$row['assunto']);      	
             echo ('<tr><td>'.$ln."</td></tr>\n");       	
      }

	mysql_free_result($result);
	mysql_close($link);

?>
	</table>
	</div>
</div>
