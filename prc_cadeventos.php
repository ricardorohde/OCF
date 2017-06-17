<?php include("sessao.php"); ?>
<?php include("head.php"); ?>
<?php include("vlogin.php"); ?>
       <span id="titform">
      	    <a href="menu_admin.php">Administra&ccedil;&atilde;o</a> ->
            <a href="lst_cadeventos.php">Cadastro de Eventos</a>
      </span>
<?php include("traco.php"); ?>
<?php include("tophome.php"); ?>

  <table id="menuadm" border="0" cellspacing="0">

<?php 
    require_once($_SESSION['DOCROOT']."/classes/class.evento.php");

     $ID    = $_POST['ID'];
	 $dia   = $_POST['dia'];
	 $mes   = $_POST['mes'];
	 $ano   = $_POST['ano'];
     $local = $_POST['local'];
     $descricao = $_POST['descricao'];

     if ($_POST['Excluir'] == 'Excluir')
          exclui($ID);
     else 
          grava($ID,$dia,$mes,$ano,$local,$descricao);
?>

</table>
 
<?php include ("bothome.php"); ?>
<?php include ("rodape.php"); ?>
<?php 
function exclui($ID) {

    $eve = new Evento($ID);

    $eve->Exclui();
	echo '<tr><td><br></td></tr>'."\n";
	echo "<tr><td>Evento excluído com sucesso !</td></tr>\n";
	echo '<tr><td><br></td></tr>'."\n";
	echo '<tr><td><br></td></tr>'."\n";
	echo '<tr><td><a href="lst_cadeventos.php">OK</a></td></tr>'."\n";
} 

function grava($ID,$dia,$mes,$ano,$local,$descricao) {

     $temerro = 0;
     $x = 0;
     if (empty($local)) {
  		 echo ("<tr><td>Informe o local do evento </td></tr>")."\n";
   	     $temerro = 1;
   	  }
     if (!checkdate($mes,$dia,$ano)) { 
	   	echo ("<tr><td>Data do evento inválida !</td></tr>")."\n";
		$temerro = 1;
	  }
     if (empty($descricao)) {
  		 echo ("<tr><td>Descreva o evento </td></tr>")."\n";
   	     $temerro = 1;
   	  }

      if ($temerro == 1)
            include ("volta.php");
      else {
		     $eve = new Evento($ID);
             $eve->setLocal($local);
             $eve->setDescricao($descricao);
			 $eve->setData($ano."/".$mes."/".$dia);
             $eve->Grava();
			echo '<tr><td><br></td></tr>'."\n";
			echo "<tr><td>Evento gravado com sucesso !</td></tr>\n";
			echo '<tr><td><br></td></tr>'."\n";
			echo '<tr><td><br></td></tr>'."\n";
			echo '<tr><td><a href="lst_cadeventos.php">OK</a></td></tr>'."\n";
           }
 }
?>

