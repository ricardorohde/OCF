<?php include("sessao.php"); ?>
<?php include("validausr.php"); ?>
<?php include("vlogin.php"); ?>

<?php 

    $camp = $_GET['camp'];
    $usr = $_GET['usr'];
    $op = $_GET['op'];

	include ('conectadb.php');


  	   $dtpg = date("Y/m/d");
   	   $usrpg = $_SESSION['userid'];
       if ($op == 'I') {
           $fl = 'S';
       }
       else {
       	   $fl = 'N';
       }


        $sql = sprintf(
		"update cad_inscricao " .
		"set flpago='%s', ".
		"datapgto = '%s', ".
		"useridpgto = %d " .
		"where campeonato = %d " .
		"and userid = %d"
		,$fl,$dtpg,$usrpg,$camp,$usr);

		$result = mysql_query($sql)
		or die('\nErro confirmando pagamento: ' . mysql_error()); 

	mysql_close($link);

    echo "<script language='JavaScript'> window.location = 'lst_cadpagto.php'; </script>"; 


?>
