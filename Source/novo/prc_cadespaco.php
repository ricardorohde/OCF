<?php include("sessao.php"); ?>

<?php include("head.php"); ?>

<?php include("vlogin.php"); ?>

 <span class="titusr">Comunique-se com a comunidade opaleira</span>

 <?php include("traco.php"); ?>
 <?php include("tophome.php"); ?>

 <?php require_once($_SESSION['DOCROOT']."/classes/class.usuario.php"); ?>

  <table id="menuadm" border="0" cellspacing="0">

<?php 
//	include('envmail.php');

     $msg = $_POST['recado'];

     include 'conectadb.php';

     grava($msg);

	mysql_close($link);
 
 
?>

</table>
 
<?php include ("bothome.php"); ?>

<?php include ("rodape.php"); ?>
 

<?php 
function grava($msg) {

     $temerro = 0;

     if (empty($msg)) {
  		 echo ("<tr><td>Digite a mensagem que deseja postar </td></tr>")."\n";
   	     $temerro = 1;
   	  }
      if ($temerro == 1)
            include ("volta.php");
      else {
		
			   $sql = sprintf("insert into cad_espaco_opaleiro (mensagem,userid,datahora) " .
				   		"values('%s',%d,'%s')",$msg,$_SESSION['userid'],date("Y/m/d H:i"));

		   	   $result = mysql_query($sql)
			 				or die('\nErro incluindo Mensagem no Espaço do Opaleiro: ' . mysql_error()); 
  				
				echo '<tr><td><br></td></tr>'."\n";
				echo "<tr><td>Sua mensagem foi enviada a comunidade opaleira !</td></tr>\n";
				echo '<tr><td><br></td></tr>'."\n";
				echo '<tr><td><br></td></tr>'."\n";
				echo '<tr><td><a href="index.php">OK</a></td></tr>'."\n";
      }
	
}

?>
 