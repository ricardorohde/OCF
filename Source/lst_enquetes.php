<?php include("sessao.php"); ?>
<?php 
    require_once($_SESSION['DOCROOT']."/classes/class.enquete.php");

    $lst = Enquete::getEnquetes("A");
    if (count($lst) == 0)
		return;
?>

<div class="painel">
<div class="LeftCorner"> </div>
<div class="TitPainel">.:: Enquetes ::.</div>
<div class="RightCorner"> </div>
<div class="corpo"> 
<table cellpadding="0" cellspacing="0" frame="box" rules="none">
<?php
    $vez = 0;
    foreach($lst as $e) {
         $enq = new Enquete($e['numero']);
         if ($vez != 0) {
		 	   echo ('<tr> <td colspan=2>')."\n";
			   echo ('<hr style="height: 1px; width: 100%;" align="left">')."\n";
			   echo ('</td></tr>')."\n";
			}
		 
         $nomeform = sprintf ("enq%04d",$enq->getCodigo());
		 echo (' <form method="post" action="prc_votaenq.php" name="'.$nomeform.'">')."\n";
         echo('<input type=hidden name="enquete"  value="'.$enq->getCodigo().'">')."\n";
	     echo ("<tr><td colspan=2>".$enq->getPergunta()."</td></tr>\n");

	     for ($x=1;$x < 11;$x++) {
              if ($enq->getOpcao($x) != NULL) {
				  if ($enq->getTipoResposta() == "U")
			          echo ('<tr><td colspan=2> <input type="radio" tabindex="'.$x.'" name="opcoes" value="'.$x.'">'.$enq->getOpcao($x).'</td></tr>');
				  else
			          echo ('<tr><td colspan=2> <input type="checkbox" tabindex="'.$x.'" name="'.sprintf("op%02d",$x).'" value="S">'.$enq->getOpcao($x).'</td></tr>');
			}
	
			}
		 echo('<tr><td><a href="javascript:document.'.$nomeform.'.submit();"><b>Votar</a></td>');
		 echo('<td align="center"><a href="lst_resenquete.php?enq='.$enq->getCodigo().'"><b>Resultado</a></td></tr>');
         echo('</form>');
		 $vez = 1;
	}
				  
   ?>
  </table>
</div>  