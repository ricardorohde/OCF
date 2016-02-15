<?php include("sessao.php"); ?>
<?php include("head.php"); ?>

<?php require_once($_SESSION['DOCROOT']."/classes/class.usuario.php"); ?>

 <span class="titusr">Prêmio Opaleiro do Ano</span>

 <?php include("traco.php"); ?>

<div id="menuadm">
<a href="opaleirodoano.php" target="_blank"><b>»»REGULAMENTO</b></a>
</div>

  <table  id="tabform" style="width:100%;">
  <tr> <td colspan="2" align="center"><b>>> C L A S S I F I C A Ç Ã O <<</b></td></tr>
  <tr  class="cabec"><td>Membro</td><td align="center">Pontos</td></tr>
  <?php
    $lst = Usuario::getRanking();
    if (count($lst) == 0)
		return;

    $cor = 0;
    $pos = 0;
    foreach($lst as $u) {

         $usr = new Usuario($u['userid']);
 	     $i = sprintf ('<a href="lst_pontos.php?usr=%d&crt=0">',$u['userid']);
         $pos++;
         $linha = sprintf ("<td>%dº-%s%s</a></td><td align=center>%s%d</a></td>",
		          $pos,$i,$usr->getNome(),$i,$u['pontos']);		
				  
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
  </table>
<?php include ("rodape.php"); ?>
