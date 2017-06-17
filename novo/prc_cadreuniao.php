<?php include("sessao.php"); ?>
<?php include("head.php"); ?>
<?php include("vlogin.php"); ?>

       <span id="titform">
      	    <a href="menu_admin.php">Administra&ccedil;&atilde;o</a> ->
            <a href="lst_cadreuniao.php">Cadastro de Reunião</a>
      </span>
<?php include("traco.php"); ?>
<?php include("tophome.php"); ?>

  <table id="menuadm" border="0" cellspacing="0">

<?php 
    require_once($_SESSION['DOCROOT']."/classes/class.reuniao.php");

     $ID    = $_POST['ID'];
	 $dia   = $_POST['dia'];
	 $mes   = $_POST['mes'];
	 $ano   = $_POST['ano'];
	 $hh   = $_POST['hh'];
	 $mm   = $_POST['mm'];
     $local = $_POST['local'];

     if ($_POST['Excluir'] == 'Excluir')
          exclui($ID);
     else 
          grava($ID,$dia,$mes,$ano,$hh,$mm,$local);
?>

</table>
 
<?php include ("bothome.php"); ?>
<?php include ("rodape.php"); ?>
<?php 
function exclui($ID) {

    $eve = new Reuniao($ID);

    $eve->Exclui();
	echo '<tr><td><br></td></tr>'."\n";
	echo "<tr><td>Reuniao excluída com sucesso !</td></tr>\n";
	echo '<tr><td><br></td></tr>'."\n";
	echo '<tr><td><br></td></tr>'."\n";
	echo '<tr><td><a href="lst_cadreuniao.php">OK</a></td></tr>'."\n";
} 

function grava($ID,$dia,$mes,$ano,$hh,$mm,$local) {

     $temerro = 0;
     $x = 0;
     if (empty($local)) {
  		 echo ("<tr><td>Informe o local da reunião </td></tr>")."\n";
   	     $temerro = 1;
   	  }
     if (!checkdate($mes,$dia,$ano)) { 
	   	echo ("<tr><td>Data da reunião inválida !</td></tr>")."\n";
		$temerro = 1;
	  }
     if (empty($hh) || empty($mm) || $hh > 23 || $mm > 59) {
	   	echo ("<tr><td>Hora da reunião inválida !</td></tr>")."\n";
		$temerro = 1;
	 	}
      if ($temerro == 1)
            include ("volta.php");
      else {
		     $eve = new Reuniao($ID);
             $eve->setLocal($local);
			 $eve->setHora($hh.":".$mm);
			 $eve->setData($ano."/".$mes."/".$dia);
             $eve->Grava();
			echo '<tr><td><br></td></tr>'."\n";
			echo "<tr><td>Reunião gravado com sucesso !</td></tr>\n";
			echo '<tr><td><br></td></tr>'."\n";
			echo '<tr><td><br></td></tr>'."\n";
			echo '<tr><td><a href="lst_cadreuniao.php">OK</a></td></tr>'."\n";
           }
 }
?>

