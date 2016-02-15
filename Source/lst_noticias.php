<div class="tittabela">.:: Notícias ::.</div>
<div class="caixa100">
<table cellspacing="0">
<?php

   include 'conectadb.php';

   $sql = sprintf("select codigo,titulo,noticia,username,datahora " .
   		"from " .
   		"cad_noticias n, " .
   		"cad_usuario u " .
   		"where " .
   		"n.userid = u.userid " .
   		"order by " .
   		"n.datahora desc " .
   		"limit 30");

      $result = mysql_query($sql)
	 				or die('\nErro consultando classificacao: ' . mysql_error()); 
      while ($row = mysql_fetch_assoc($result)) {
             $fn = sprintf ("javascript:janela('frm_noticias.php?noticia=%d',50,50,450,400);",$row['codigo']);
             $ln = sprintf('<a href="%s"> »<i>(%s %s) - %s </i></a>'
             ,$fn,date("d/m/Y",strtotime($row['datahora'])),date("H:i",strtotime($row['datahora'])),$row['titulo']);      	
             echo ('<tr><td>'.$ln."</td></tr>\n");       	
      }

	mysql_free_result($result);
	mysql_close($link);

?>
	</table>
	</div>
