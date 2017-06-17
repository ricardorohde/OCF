<?php include("sessao.php"); ?>

<?php include("head.php"); ?>

<?php include("vlogin.php"); ?>

 <span class="titusr">Deixe Seu Recado no Mural</span>

 <?php include("traco.php"); ?>
 <?php include("tophome.php"); ?>

 <?php require_once($_SESSION['DOCROOT']."/classes/class.usuario.php"); ?>

  <table id="menuadm" border="0" cellspacing="0">

<?php 
	include('envmail.php');

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
  		 echo ("<tr><td>Digite a mensagem que deseja postar no mural</td></tr>")."\n";
   	     $temerro = 1;
   	  }
      if ($temerro == 1)
            include ("volta.php");
      else {
		
			   $sql = sprintf("insert into cad_mural (mensagem,userid,datahora) " .
				   		"values('%s',%d,'%s')",$msg,$_SESSION['userid'],date("Y/m/d H:i"));

		   	   $result = mysql_query($sql)
			 				or die('\nErro incluindo Recado no Mural: ' . mysql_error()); 
  				
                $lst = Usuario::getUsuarios();
                
				$lstmail = array();
                
				foreach($lst as $l) {
						array_push($lstmail,$l['email']);
				}
				$msg .= "<br><br><br>"."Mensagem enviada por: <b>".$_SESSION['username'];
				$msg .= "<br>"."Opala Clube Franca";

                envmail($lstmail,"Recado Opala Clube Franca",$msg,"admin@opalaclubefranca.com.br");

				echo '<tr><td><br></td></tr>'."\n";
				echo "<tr><td>Seu recado foi postado no mural !</td></tr>\n";
				echo '<tr><td><br></td></tr>'."\n";
				echo '<tr><td><br></td></tr>'."\n";
				echo '<tr><td><a href="index.php">OK</a></td></tr>'."\n";
      }
	
}

?>
 