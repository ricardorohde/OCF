<?php include("sessao.php"); ?>

<?php

  include 'conectadb.php';

$tempo_valido = 30; // numero de minutos que a sess�o 
                   // ficara v�lida sem que o usu�rio 
                   // continue navegando pelo site 

$unixtime_valido = (strtotime('NOW') + 3600) - ($tempo_valido * 60); 

$deleta = sprintf("DELETE FROM usr_online WHERE datetime < '%s'",$unixtime_valido);
$result = mysqli_query($deleta) 
	 		or die('\nErro validando sessão 1: ' . mysqli_error()); 

$sql = sprintf("SELECT * FROM usr_online WHERE sessao='%s' AND datetime > '%s'",$_ID,$unixtime_valido);
$result = mysqli_query($sql)
	 		or die('\nErro validando sessão 3: ' . mysqli_error()); 
if (mysqli_num_rows($result) > 0) { 
   $row = mysqli_fetch_array($result); 
   $_SESSION['logado'] = "SIM";
   $_SESSION['userid'] = $row['userid'];
   $unixtime = (strtotime('NOW') + 3600); 
   $sql = sprintf("UPDATE usr_online SET datetime='%s' WHERE sessao='%s'",$unixtime,$_ID); 
   $result = mysqli_query($sql)
	 		or die('\nErro validando sessão 2: ' . mysqli_error()); 
//   mysqli_free_result($result);
} else { 
   $_SESSION['logado'] = "NAO";
} 

   mysqli_close($link);

?>