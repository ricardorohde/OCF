<!-- Header da pagina -->
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
  <META HTTP-EQUIV="control-cache" CONTENT="no-cache">
  <META NAME="author" CONTENT="Alencar Mendes de Oliveira">
  <META NAME="copyright" CONTENT="copyright 2005 Bolao.net">
  <META NAME="robots" CONTENT="all">
  <META NAME="description" CONTENT="Bolão dos campeonatos de futebol">
  <META NAME="keywords" CONTENT="Bolão, bolão do alex,brasileirão,copa bolão">
      
<?php

   $noticia = $_GET['noticia'];
   
   include 'conectadb.php';

   $sql = sprintf("select codigo,titulo,noticia,username,datahora " .
   		"from " .
   		"cad_noticias n, " .
   		"cad_usuario u " .
   		"where " .
   		"n.userid = u.userid " .
        "and codigo = %d"
   		,$noticia);

      $result = mysql_query($sql)
	 				or die('\nErro consultando classificacao: ' . mysql_error()); 

	  $row = mysql_fetch_assoc($result);

	echo '<link rel="stylesheet" type="text/css" media="screen" href="bolao.css" />';
    echo "<TITLE>".$row['titulo']."</title>\n";
    echo '
     </head>
		<body style="float:left;align:left;" align="left">
			<table style="width:400px;" width="400px" border=0 cellspacing=0>
			  <caption align=left><span style="color:black;font-size:13px;font-weight:bold;"><br>'.$row['titulo'].'</span></caption>';
	echo '		<tr><td>';
	include ("traco.php");
	echo '		</td></tr>'."\n";

	echo '   	<tr><td>'.$row['noticia'].'</td></tr>';

	echo '<tr><td>';
	include ("traco.php");
	echo '</td></tr>'."\n";
	
    echo '<tr><td><i><span  style="font-size:12px;">'.date("d/m/Y H:i",strtotime($row['datahora'])).' por </span><span style="font-weight:bold;font-size:12px;">'.$row['username'].'</span></i></td></tr>';
	echo ' </table>';
	mysql_free_result($result);
	mysql_close($link);

?>
</body>
</html>