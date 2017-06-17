<?php include("head.php"); ?>

 <span class="titusr">Fotos</span>
      
 <?php include("traco.php"); ?>
  <table class="fotosusr">
<?php
	$op = $_GET['seq'] + 2;
	$max = $op + 12;
	$foto = " ";
	$x = 1;
	$l = 0;
	
	$fotos = scandir("./fotos/Eventos/");

	$total = count($fotos) - 2;

    if ($max > $total)
	    $max = $total + 2;

	$pg = round($total / 12,0);
 //   echo ("pg=".$pg)."\n";
	
	if (($total - ($pg * 12)) > 0) {
	    $pg++;
	    }
    
//	echo ("total=".$total)."\n";
//    echo ("op=".$op)."\n";
//	echo ("max=".$max)."\n";
   if (count($fotos) != 2) {
		   for ($x = $op;$x < $max;$x++) {
				 $foto = sprintf("./fotos/Eventos/%s",$fotos[$x]);
//				 echo ("foto=".$foto);
//				 echo ("x=".$x);
				 if (file_exists($foto)) {
					 if ($l == 0)
						 echo ("<tr>");
					 $l++;
					 $fn = sprintf("javascript:janela('prc_detfoto.php?arq=%s',50,50,680,510);",$foto);
					 echo ('<td align="center" valign="middle">');
					 echo ('<a href="'.$fn.'"><img src="'.$foto.'" width=80 height=100> </a></td>');
					 if ($l == 4) {
						 $l=0;
						 echo ("</tr>");
						}
					}
				 }
			if ($l > 0)
				echo ("</tr>");
		}
	?>
  <tr><td colspan=4>
  <?php 
     for ($x = 0;$x < $pg;$x++) {
         $ln = sprintf ('<a href="lst_fotos.php?seq=%d">%d</a>    ',($x * 12),$x + 1);
		 echo ($ln);
	 }
	 ?>
	</td></tr>
  </table>
<?php include ("rodape.php"); ?>
