<!-- Topo da pagina -->
<?php include("sessao.php"); ?>
<?php include("validausr.php"); ?>
<div class="Topo" style="height:235px;">
<div><?php include ("usuario.php"); ?></div>
<div><?php include("menu.php"); ?> </div>
<span class="DataTitulo">
        <?php
        $dw = Array(
        	"Domingo",
        	"Segunda-feira",
        	"Ter�a-feira",
        	"Quarta-feira",
        	"Quinta-feira",
        	"Sexta-feira",
        	"S�bado");

        $m = Array(
        	"Janeiro",
        	"Fevereiro",
        	"Mar�o",
        	"Abril",
        	"Maio",
        	"Junho",
        	"Julho",
        	"Agosto",
        	"Setembro",
        	"Outubro",
        	"Novembro",
        	"Dezembro");
			
            echo($dw[date("w")].", ".date("d")." de ".$m[date("m") - 1]." de ".date("Y")/*." ".date("H:i:s",strtotime('NOW') + 3600)*/)."\n";  
?></span>
</div>
