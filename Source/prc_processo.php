<?php include("sessao.php"); ?>
<?php include("head.php"); ?>
<?php include("vlogin.php"); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT']."/classes/class.Processo.php"); ?>

<span id="titform">
   <a href="menu_admin.php">Administra&ccedil;&atilde;o</a> -> 
<?php 
   $prc = new Processo($_POST['prc']);
   $lnk = sprintf ('<a href="lst_processo.php?prc=%d">%s</a>',$prc->getID(),$prc->getNome()); 
   echo ($lnk);
  ?>
</span>

<table id="menuadm" border="0" cellspacing="0">

<?php 
     $ID    = $_POST['ID'];
     $descricao = $_POST['CatDescricao'];

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
    $classe = "CLACategoria";
    $eve = new $classe($ID);

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

