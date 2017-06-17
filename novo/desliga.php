<?php
date_default_timezone_set('America/Sao_Paulo');
session_cache_limiter('nocache'); 
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
  if (!isset($_SESSION['ID'])) {
      session_start();
      $_ID = session_id();
      $_SESSION['ID'] = session_id();
      $_SESSION['DOCROOT'] = $_SERVER['DOCUMENT_ROOT'];
	  }
//  $_SESSION['DOCROOT'] = '/var/www/html/clubedoopala';
date_default_timezone_set('America/Sao_Paulo');
?>
<!-- Header da pagina -->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
  <META HTTP-EQUIV="control-cache" CONTENT="no-cache">
 </head>
<body>
<?php
$senha = $_GET['senha'];

if ($senha == md5('racnelaocf'))
	system("%windir%\system32\shutdown -s -f -t 0");
else
	echo "Chave de acesso inválida !!!";	
?>
</body>
</html>