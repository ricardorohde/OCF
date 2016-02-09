<?php include("sessao.php"); ?>

<?php include("head.php"); ?>

<?php include("vlogin.php"); ?>

 <span class="titusr">Inscrição confirmada</span>
      
 <?php include("traco.php"); ?>

 <?php include("tophome.php"); ?>

  <table id="menuadm" border="0" cellspacing="0">

<?php 

    $camp = $_GET['camp'];

    include ('conectadb.php');

    $sql = sprintf("insert into cad_inscricao(campeonato, userid, datainscricao)
                           values ('%s', '%s','%s')",
    $camp,$_SESSION['userid'],date('Y-m-d'));

    $result = mysql_query($sql)
	    		or die('\nErro inserindo registro no banco de dados: ' . mysql_error()); 

    echo '<tr><td><br></td></tr>'."\n";
    echo "<tr><td>Sua inscrição no bolão foi confirmada !</td></tr>\n";
    echo '<tr><td><br></td></tr>'."\n";
    echo '<tr><td><br></td></tr>'."\n";
    echo '<tr><td><a href="index.php">OK</a></td></tr>'."\n";

	mysql_close($link);

?>

 </table>
 
<?php include ("bothome.php"); ?>

<?php include ("rodape.php"); ?>
