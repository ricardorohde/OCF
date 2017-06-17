<?php include("sessao.php"); ?>
<?php
	require_once($_SESSION['DOCROOT']."/classes/class.bd.php");

    $db = new BD();

	$sql = sprintf('select email from cad_usuario');
	$db->Query($sql);
	while ($db->Next()) {
		echo ($db->getValue('email').' <br/>')."\n";
	}; 
    $db->Close();
?>
</div>
