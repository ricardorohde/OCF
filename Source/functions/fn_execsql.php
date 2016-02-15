<?php
/*
	Funcуo: execsql
	Descriчуo: Executa comandos sql no banco de dados retornando o resultset
	Desenvolvido: Alencar
	Data: 28/01/2006
*/
function execsql ($strsql) {

     require ($_SERVER['DOCUMENT_ROOT'].'/conectadb.php');

//     gravalogsql($strsql);
	 
     $result = mysql_query($strsql)
	 				or die('\nErro executando string sql no banco de dados: ' . mysql_error()); 


     return $result;

}

/*
	Funcуo: gravalogsql
	Descriчуo: Gera log dos comandos sql executados no banco
	Desenvolvido: Alencar
	Data: 28/01/2006
*/

function gravalogsql($strsql) {

     require ($_SERVER['DOCUMENT_ROOT'].'/conectadb.php');

       $sqllog = sprintf ('insert into log_bolao
	   						(datahora,userid,strsql,programa)
							values ("%s",%d,"%s","%s")',date("Y-m-d H-i-s"),$_SESSION['userid'],		$strsql,$_SERVER['SCRIPT_NAME']);
	
//	   echo ($sqllog);
	   
       $result = mysql_query($sqllog)
	 				or die('\nErro incluindo registro no log: ' . mysql_error()); 

       mysql_free_result($result);
	      
}


?>