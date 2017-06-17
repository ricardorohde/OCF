<?php require_once($_SERVER['DOCUMENT_ROOT']."/classes/class.bd.php"); ?>
<?php
	global $link;

   $db_geral = new BD();
   $link = $db_geral->Link;

?>
