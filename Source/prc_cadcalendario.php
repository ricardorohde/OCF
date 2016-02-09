<?php include("sessao.php"); ?>
<?php include("head.php"); ?>
<?php include("vlogin.php"); ?>

       <span id="titform">
      	    <a href="menu_admin.php">Administra&ccedil;&atilde;o</a> ->
            <a href="lst_cadcalendario.php">Cadastro de Calendário</a>
      </span>
<?php include("traco.php"); ?>
<?php include("tophome.php"); ?>

  <table id="menuadm" border="0" cellspacing="0">

<?php 
    require_once($_SESSION['DOCROOT']."/classes/class.calendario.php");

     $ID    = $_POST['ID'];
	 $dia   = $_POST['dia'];
	 $mes   = $_POST['mes'];
	 $ano   = $_POST['ano'];
	 $titulo= $_POST['titulo'];
     $descricao = $_POST['descricao'];
     $local = $_POST['local'];
     $realizacao = $_POST['realizacao'];

     if ($_POST['Excluir'] == 'Excluir')
          exclui($ID);
     else 
          grava($ID,$dia,$mes,$ano,$titulo,$descricao,$local,$realizacao);
?>

</table>
 
<?php include ("bothome.php"); ?>
<?php include ("rodape.php"); ?>
<?php 
function exclui($ID) {

    $eve = new Calendario($ID);

    $eve->Exclui();
	echo '<tr><td><br></td></tr>'."\n";
	echo "<tr><td>Evento excluído com sucesso do calendário!</td></tr>\n";
	echo '<tr><td><br></td></tr>'."\n";
	echo '<tr><td><br></td></tr>'."\n";
	echo '<tr><td><a href="lst_cadcalendario.php">OK</a></td></tr>'."\n";
} 

function grava($ID,$dia,$mes,$ano,$titulo,$descricao,$local,$realizacao) {

     $temerro = 0;
     $x = 0;
     if (!checkdate($mes,$dia,$ano)) { 
	   	echo ("<tr><td>Data do evento inválida !</td></tr>")."\n";
		$temerro = 1;
	  }
     if (empty($titulo)) {
	   	echo ("<tr><td>Titulo do evento inválido !</td></tr>")."\n";
		$temerro = 1;
	 	}
     if (empty($local)) {
	   	echo ("<tr><td>Local do evento inválido !</td></tr>")."\n";
		$temerro = 1;
	 	}
     if (empty($realizacao)) {
	   	echo ("<tr><td>Realizacao do evento inválido !</td></tr>")."\n";
		$temerro = 1;
	 	}
      if ($temerro == 1)
            include ("volta.php");
      else {
		     $eve = new Calendario($ID);
             $eve->setTitulo($titulo);
			 $eve->setLocal($local);
			 $eve->setRealizacao($realizacao);
			 $eve->setDescricao($descricao);
			 $eve->setData($ano."/".$mes."/".$dia);
             $eve->Grava();
			echo '<tr><td><br></td></tr>'."\n";
			echo "<tr><td>Evento gravado com sucesso no calendário!</td></tr>\n";
			echo '<tr><td><br></td></tr>'."\n";
			echo '<tr><td><br></td></tr>'."\n";
			echo '<tr><td><a href="lst_cadcalendario.php">OK</a></td></tr>'."\n";
           }
 }
?>

