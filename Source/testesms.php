<?php include("sessao.php"); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
</head>
<body>

<?php
require_once($_SERVER['DOCUMENT_ROOT']."/classes/class.sms.php");

require_once($_SERVER['DOCUMENT_ROOT']."/classes/class.bd.php");

/*		$db = new BD();
        $sql = sprintf("select username,dddcel,celular
								from cad_usuario c
								where aprovado='S' and ifnull(celular,0) <> 0");

		$db->Query($sql);        
      while ($db->Next()) {
				$fone = $db->getvalue('dddcel').$db->getvalue('celular');
				$msg = 'Prezado opaleiro, nosso encontro hoje será no posto caixa dagua na Av. Brasil, agua não vai faltar, contamos com sua presença.';
      			echo "<p>".$db->getvalue('username')."   Fone: ".$fone."  Msg: ".$msg."</p>";
				SMS::Envia($fone,$msg);
      }

$db->Close();
	*/	

	$fone = '1693301412';
	$msg = 'Prezado opaleiro, nosso encontro hoje será no posto caixa dagua na Av. Brasil, agua não vai faltar, contamos com sua presença.';

SMS::Envia($fone,$msg);


?>
</body>
</html>