<?php
/*
 * Fun��o para montagem da string chave para altera��o de rodada
 */
function  chaverod($camp,$rod) {
   $ln = sprintf("%06d" . // C�digo do campeonato
   		"%03d" . //N�mero da rodada
   		"%03d" . //N�mero da rodada + 123
   		"%s" . // Data invertida
   		"%08d" // Userid
   		,$camp,$rod,$rod+123,date("Ymd"),$_SESSION['userid']);

//   echo ('         <tr> <td>'.$ln.'</td> </tr>')."\n";
   
   return md5($ln); 
	
}

?>