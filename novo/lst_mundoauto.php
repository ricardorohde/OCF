<?php include("sessao.php"); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT']."/classes/class.rss.php"); ?>
<div class="PainelCentral">
<div class="LeftPainel"> </div>
<div class="TitBox">.:: Mundo Automotivo ::.</div>
<div class="RightPainel"> </div>
<div class="BarraTit"></div>
<div class="Caixa250" >
<table  width="100%" cellpadding="0" cellspacing="0" height="100%">
<?php
	$rss = new box("http://rss.carros.uol.com.br/ultnot/index.xml"); // Assim chamamos o rss
	echo $rss->show_box(); // Aqui sera exibida a caixa formatada
?>
</table>
</div>
</div>