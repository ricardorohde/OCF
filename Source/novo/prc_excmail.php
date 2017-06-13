<?php include("sessao.php"); ?>
<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/classes/class.bd.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/classes/class.usuario.php");
  
  
	$userid = $_GET['usr'];
	$id = trim($_GET['id']);
    $usr = new Usuario($userid); 
  
  $cnf = md5(trim( trim($usr->getUsername())."lstmailexc".trim( $usr->getEMail() ) ) ); 

    if ($id == $cnf) {
		$db = new BD();
		$sql = sprintf("update cad_usuario
								set recmail = 'N'
								where
								userid = %d",$userid);

	    $db->Exec($sql);
		$db->Close();
		}
	
    echo "<script> window.location = 'index.php'; </script>"; 
	
?>
