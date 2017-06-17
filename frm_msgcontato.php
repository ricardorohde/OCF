<!-- Header da pagina -->
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
  <META HTTP-EQUIV="control-cache" CONTENT="no-cache">
  <META NAME="author" CONTENT="Alencar Mendes de Oliveira">
  <META NAME="copyright" CONTENT="copyright 2005 Opala Clube Franca">
  <META NAME="robots" CONTENT="all">
  <META NAME="description" CONTENT="Opala Clube Franca">
  <META NAME="keywords" CONTENT="Clube do opala de Franca Opaleiros www.opalaclubefranca.com.br">
      
<?php

   $id = $_GET['id'];
   
   include 'conectadb.php';

   $sql = sprintf("select id,nome,email,assunto,mensagem,datahora " .
   		"from " .
   		"tb_msgcontato " .
		"where ".
		"id = %d",$id);

      $result = mysql_query($sql)
	 				or die('\nErro consultando Mensagens: ' . mysql_error()); 

	  $row = mysql_fetch_assoc($result);

	echo '<link rel="stylesheet" type="text/css" media="screen" href="bolao.css" />';
    echo "<TITLE>Mensagem: ".$row['assunto']."</title>\n";
    echo '
     </head>
		<body style="float:left;align:left;" align="left">
			<table style="width:400px;" width="400px" border=0 cellspacing=0>
			  <caption align=left>  <span style="color:black;font-size:13px;font-weight:bold;"><br>'. $row['assunto'].'</span></caption>';
	echo '		<tr><td>';
	include ("traco.php");
	echo '		</td></tr>'."\n";

	echo '   	<tr><td>'.$row['mensagem'].'</td></tr>';

	echo '<tr><td>';
	include ("traco.php");
	echo '</td></tr>'."\n";
	
    echo '<tr><td><i><span  style="font-size:12px;"> Mensagem enviada por: </span><span style="font-weight:bold;font-size:12px;">'.$row['nome'].'</span></i></td></tr>';
    echo '<tr><td><i><span  style="font-size:12px;"> E-mail: </span><span style="font-weight:bold;font-size:12px;">'.$row['email'].'</span></i></td></tr>';
    echo '<tr><td><i><span  style="font-size:12px;">'.date("d/m/Y H:i",strtotime($row['datahora'])).'</span></i></td></tr>';
	echo ' </table>';
	mysql_free_result($result);
	mysql_close($link);

?>
</body>
</html>