<?php include("sessao.php"); ?>

<?php include("head.php"); ?>

<?php include("vlogin.php"); ?>

       <span id="titform">
      	    <a href="menu_admin.php">Administra&ccedil;&atilde;o</a> ->
            <a href="lst_cadenquetes.php">Cadastro de Enquetes</a>
      </span>
     
 <?php include("traco.php"); ?>
.
 <?php include("tophome.php"); ?>

  <table id="menuadm" border="0" cellspacing="0">

<?php 
    require_once($_SESSION['DOCROOT']."/classes/class.enquete.php");


     $codigo = $_POST['codigo'];
     $pergunta = $_POST['pergunta'];
	 $dia = $_POST['diafim'];
	 $mes = $_POST['mesfim'];
	 $ano = $_POST['anofim'];
	 if ($_POST['resposta'] == 'unica')
	 	 $resposta = "U";
     else
	 if ($_POST['resposta'] == 'multipla')
	     $resposta = "M";
     else
	 	 $resposta = "";
	 if ($_POST['restrita'] == 'SIM')
	     $restrita = "S";
     else
	 	 $restrita = "N";
		 
		 
     $opcoes = array();

	 for ($x = 1;$x < 11;$x++) {
          $i = sprintf ('op%02d',$x);
//          echo("<tr><td>i=".$i." ".$_POST[$i]."</td></tr>");
//	      if (!empty($_POST[$i])) 
				 array_push($opcoes,$_POST[$i]);
		
		}
		
       if ($_POST['Excluir'] == 'Excluir')
               exclui($codigo);
       else
               grava($codigo,$pergunta,$opcoes,$dia,$mes,$ano,$resposta,$restrita);
 
?>

</table>
 
<?php include ("bothome.php"); ?>

<?php include ("rodape.php"); ?>
 

<?php 
function exclui($codigo) {

    $enq = new Enquete($codigo);

    if ($enq->getVotos("TOTAL") > 0) {
			echo '<tr><td><br></td></tr>'."\n";
			echo "<tr><td>Essa enquete não pode ser excluída, já existem votos registrados, se deseja encerrar a enquete altere a data final !</td></tr>\n";
			echo '<tr><td><br></td></tr>'."\n";
			echo '<tr><td><br></td></tr>'."\n";
			echo '<tr><td><a href="lst_cadenquetes.php">OK</a></td></tr>'."\n";
		}
	else {
	    $enq->Exclui();
		echo "<tr><td><b>".$enq->getPergunta()."</td></tr>\n";
		echo '<tr><td><br></td></tr>'."\n";
		echo "<tr><td>Enquete excluída com sucesso !</td></tr>\n";
		echo '<tr><td><br></td></tr>'."\n";
		echo '<tr><td><br></td></tr>'."\n";
		echo '<tr><td><a href="lst_cadenquetes.php">OK</a></td></tr>'."\n";
		}
} 

function grava($codigo,$pergunta,$opcoes,$dia,$mes,$ano,$resposta,$restrita) {

     $temerro = 0;
     $x = 0;

     if (empty($pergunta)) {
  		 echo ("<tr><td>Informe a pergunta da enquete </td></tr>")."\n";
   	     $temerro = 1;
   	  }
     if (count($opcoes) < 2) {
  		 echo ("<tr><td>Informe pelo menos 2 opções para a enquete </td></tr>")."\n";
   	     $temerro = 1;
   	  }
     if (!checkdate($mes,$dia,$ano)) { 
	   	echo ("<tr><td>Data de encerramento da enquete inválida !</td></tr>")."\n";
		$temerro = 1;
	  }
     if (empty($resposta)) {
  		 echo ("<tr><td>Informe o tipo de resposta da enquete (Unica ou Multipla).</td></tr>")."\n";
   	     $temerro = 1;
   	  }

      if ($temerro == 1)
            include ("volta.php");
      else {
		     $enq = new Enquete($codigo);

             $enq->setPergunta($pergunta);

		     foreach($opcoes as $op) {
			 		 $x++;
			         $enq->setOpcao($x,$op);
					 }
             
			 $enq->setDataFim($ano."/".$mes."/".$dia);
			 $enq->setTipoResposta($resposta);
			 $enq->setRestrita($restrita);
			 
             $enq->Grava();
 
		    echo "<tr><td><b>".$enq->getPergunta()."</td></tr>\n";
			echo '<tr><td><br></td></tr>'."\n";
			echo "<tr><td>Enquete gravada com sucesso !</td></tr>\n";
			echo '<tr><td><br></td></tr>'."\n";
			echo '<tr><td><br></td></tr>'."\n";
			echo '<tr><td><a href="lst_cadenquetes.php">OK</a></td></tr>'."\n";
           }   
 }

?>
 