<?php include("sessao.php"); ?>

<?php

  include 'conectadb.php';

$tempo_valido = 30; // numero de minutos que a sess�o 
                   // ficara v�lida sem que o usu�rio 
                   // continue navegando pelo site 

$unixtime_valido = (strtotime('NOW') + 3600) - ($tempo_valido * 60); 

$deleta = sprintf("DELETE FROM usr_online WHERE datetime < '%s'",$unixtime_valido);
$result = mysql_query($deleta) 
	 		or die('\nErro validando sessão 1: ' . mysql_error()); 

$sql = sprintf("SELECT * FROM usr_online WHERE sessao='%s' AND datetime > '%s'",$_ID,$unixtime_valido);
$result = mysql_query($sql)
	 		or die('\nErro validando sessão 3: ' . mysql_error()); 
if (mysql_num_rows($result) > 0) { 
   $row = mysql_fetch_array($result); 
   $_SESSION['logado'] = "SIM";
   $_SESSION['userid'] = $row['userid'];
   $unixtime = (strtotime('NOW') + 3600); 
   $sql = sprintf("UPDATE usr_online SET datetime='%s' WHERE sessao='%s'",$unixtime,$_ID); 
   $result = mysql_query($sql)
	 		or die('\nErro validando sessão 2: ' . mysql_error()); 
//   mysql_free_result($result);
} else { 
   $_SESSION['logado'] = "NAO";
} 

   mysql_close($link);

?>