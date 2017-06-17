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

  <?php
    $lst = $usr->getPontos($crt);
    if (count($lst) == 0) {
        include ("volta.php");
		echo ("</table>");
        include ("rodape.php");
		return;
		}

    $cor = 0;
    $vez = 0;
    foreach($lst as $u) {
	    	
		 if ($vez == 0) {
            echo (' <tr><td colspan=3>Extrato critério:'.$u['descricao'].'</td></tr>');
			echo (' <tr  class="cabec"><td align="center">Data</td><td align="center">Pontos</td><td>Observação</td></tr>');
			$vez = 1;
		 }	

	     $i = sprintf ('<a href="lst_pontos.php?usr=%d&crt=%d">',$usr->getUserid(),$u['id']);

         $linha = sprintf ('<td align="center">%s</td><td align=center>%d</td><td>%s</td>', date("d/m/Y",strtotime($u['data'])),$u['pontos'],$u['observacao']);
				  
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
<?php include ("volta.php"); ?>
 </table>
<?php include ("rodape.php"); ?>
