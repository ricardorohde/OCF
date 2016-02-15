<?php include("sessao.php"); ?>
<div class="PainelCentral">
<div class="LeftPainel"> </div>
<div class="TitBox">.:: Eventos e Fotos ::.</div>
<div class="RightPainel"> </div>
<div class="BarraTit"></div>
<div class="Caixa220" >
<table  width="100%" cellpadding="0" cellspacing="0" height="100%">
    <?php
	require_once($_SESSION['DOCROOT']."/classes/class.evento_cpg.php");	
    $lst = Evento_CPG::getEventos();
	$conta = 0;
    if (count($lst) <> 0) {
		foreach($lst as $e) {
			 $eve = new Evento_CPG($e['aid']);
			 $ln = sprintf('<a href="http://www.opalaclubefranca.com.br/album/thumbnails.php?album=%d" target="_blank"> »%s</a>'
			   ,$eve->getID(),$eve->getTitulo());

			   $conta=$conta + 1;
			 
			   if ($conta <= 12) {
			 	echo ('<tr><td>'.$ln."</td></tr>\n");
			 }
//http://www.opalaclubefranca.com.br/album/thumbnails.php?album=62		
		}
	}				  

?>
  </table>
</div>
</div>