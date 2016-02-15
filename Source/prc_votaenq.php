<?php include("sessao.php"); ?>
<?php
      require_once($_SESSION['DOCROOT']."/classes/class.enquete.php");

      $numero = $_POST['enquete'];
      $Enq = new Enquete($numero);
	  $temerro = 0;
	  $javotou = FALSE;
	  
	  if ($Enq->getTipoResposta() == 'U') {
	      if ($_POST['opcoes'] == NULL)
		  	  $temerro = 1;
		  }
	  else {
	        $temerro = 1;
	  		for ($x = 1;$x < 11;$x++) {
			    $op = sprintf("op%02d",$x);
				if ($_POST[$op] == 'S')
					$temerro = 0;
			}
	  }
	  
	  if ($Enq->getRestrita() == 'S' && $_SESSION['logado'] != 'SIM')
	      $temerro = 2;

	  if ($temerro == 0) {
	      if ($Enq->ValidaVoto() == TRUE) {
		  	  $javotou = FALSE;
			  if ($Enq->getTipoResposta() == 'U') {
				  $Enq->RegistraVoto($_POST['opcoes']);
				  }
			  else {
					for ($x = 1;$x < 11;$x++) {
						$op = sprintf("op%02d",$x);
						if ($_POST[$op] == 'S')
							$Enq->RegistraVoto($x);
						}
			  		}
			}
			else
				$javotou = TRUE;
		}

?>

<?php include("head.php"); ?>

 <span class="titusr">Enquete</span>

 <?php include("traco.php"); ?>

<?php include("tophome.php"); ?>

  <table id="menuadm" border="0" cellspacing="0">

<?php 
       include('lst_enqresult.php');

	   echo ('<tr><td colspan=3><b>'.$Enq->getPergunta().'<br><br></td></tr>')."\n";

		if ($temerro == 1)
			$msg = "Selecione uma opção para o voto";
		else
		if ($temerro == 2)
			$msg = "Essa enquete é restrita a sócios do clube !!! <br>Se você for um sócio entre com seu usuário e senha p/ votar !!!";
		else
		if ($javotou == FALSE)
			$msg = "Seu voto foi registrato";
		else
		    $msg = "Você já votou nessa enquete !!!<br>É permitido somente 1 voto por usuário.";

	   echo ('<tr><td colspan=3><br></td></tr>')."\n";

	   echo ('<tr align=center style="color:red;"><td colspan=3><b>'.$msg.'<br><br></td></tr>')."\n";
	   ResultEnquete($numero);


?>
 </table>
 
<?php include ("bothome.php"); ?>

<?php include ("rodape.php"); ?>
