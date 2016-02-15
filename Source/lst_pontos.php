<?php include("sessao.php"); ?>
<?php include("head.php"); ?>

<?php require_once($_SESSION['DOCROOT']."/classes/class.usuario.php"); ?>

 <span class="titusr">Prêmio Opaleiro do Ano</span>

<?php include("traco.php"); ?>
<?php
	$usr = new Usuario($_GET['usr']);
	$crt = $_GET['crt'];
?>	
<span class="titusr">Pontos <?php echo ($usr->getNome()); ?></span>

  <table  id="tabform" style="width:100%;">
  <tr  class="cabec"><td>Critério</td><td align="center">Pontos</td></tr>
  <?php
    $lst = $usr->getPontos(0);
    if (count($lst) == 0)
		return;

    $cor = 0;

    foreach($lst as $u) {
			 
	     $i = sprintf ('<a href="lst_extrato_pontos.php?usr=%d&crt=%d">',$usr->getUserid(),$u['id']);
         $linha = sprintf ("<td>%s%s</a></td><td align=center>%s%d</a></td>",
		          $i,$u['descricao'],$i,$u['pontos']);		
				  
		 if ($cor == 0) {
		     $cor = 1;		  
             echo('<tr class="rel1">'.$linha.'</tr>')."\n"; 
			 }
	     else {
		     $cor = 0;
             echo('<tr class="rel2">'.$linha.'</tr>')."\n"; 
		    }
	}

?>
<tr><td colspan=2><a  href="lst_concurso.php">Volta</a></td></tr>
  </table>

<?php include ("rodape.php"); ?>
