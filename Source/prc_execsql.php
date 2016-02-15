<?php
function execsql ($strsql) {

     require 'conectadb.php';

     gravalogsql($strsql);
	 
     $result = mysql_query($strsql)
	 				or die('\nErro executando string sql no banco de dados: ' . mysql_error()); 


     return $result;

}

function gravalogsql($strsql) {

     require 'conectadb.php';

       $sqllog = sprintf ('insert into log_bolao
	   						(datahora,userid,strsql,programa)
							values ("%s",%d,"%s","%s")',date("Y-m-d H-i-s"),$_SESSION['userid'],		$strsql,$_SERVER['SCRIPT_NAME']);
	
//	   echo ($sqllog);
	   
       $result = mysql_query($sqllog)
	 				or die('\nErro incluindo registro no log: ' . mysql_error()); 
	      
}


?>