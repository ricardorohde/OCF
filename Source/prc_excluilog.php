<?php 

	   require_once ("prc_execsql.php");
	   
	   $sql = sprintf("delete from log_bolao where datahora < subtime(now(),'24:00:00')");

   	   $result = execsql($sql);

       mysql_close($link);

?>
