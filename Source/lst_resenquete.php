<?php include("sessao.php"); ?>

<?php include("head.php"); ?>

 <span class="titusr">Resultado Parcial da Enquete</span>

 <?php include("traco.php"); ?>

<?php include("tophome.php"); ?>

  <table id="menuadm" border="0" cellspacing="0">

<?php 
      require_once($_SESSION['DOCROOT']."/classes/class.enquete.php");

      $numero = $_GET['enq'];
      $Enq = new Enquete($numero);

       include('lst_enqresult.php');

	   echo ('<tr><td colspan=3><b>'.$Enq->getPergunta().'<br><br></td></tr>')."\n";

	   ResultEnquete($numero);


?>
 </table>
 
<?php include ("bothome.php"); ?>

<?php include ("rodape.php"); ?>
