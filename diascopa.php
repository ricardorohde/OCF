<!-- Topo da pagina -->
       <span style="color:#006633;font-weight:bold;font-size:12px;">
        <?php
            $dataatual = mktime(0,0,0,date("m"),date("d"),date("Y"));
            $dataini = strtotime("06/09/2006 00:00:00");
            $diascopa = ($dataini - $dataatual) / 86400;
            $ln = sprintf("Já Começou");
            echo($ln)."\n";  
		?>
	</span>
