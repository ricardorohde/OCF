<?php 
   $usrid = $_GET['usr'];
   $pasta = $_GET['pasta'];
	   
	chmod($pasta,0777);
	
	echo ('ok');

?>