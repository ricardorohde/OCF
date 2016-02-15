<?php
/*
 * Função para montagem da string chave para alteração de rodada
 */
function  chaverod($camp,$rod) {
   $ln = sprintf("%06d" . // Código do campeonato
   		"%03d" . //Número da rodada
   		"%03d" . //Número da rodada + 123
   		"%s" . // Data invertida
   		"%08d" // Userid
   		,$camp,$rod,$rod+123,date("Ymd"),$_SESSION['userid']);

//   echo ('         <tr> <td>'.$ln.'</td> </tr>')."\n";
   
   return md5($ln); 
	
}

?>