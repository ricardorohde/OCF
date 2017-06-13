<?php include("sessao.php"); ?>
<?php include("head.php"); ?>
<?php require_once($_SESSION['DOCROOT']."/classes/class.evento.php"); ?>
<?php
    $ID = $_GET['evento'];
	$PG = $_GET['PG'];

	$eve = new Evento($ID);

	echo ('<span class="titusr">Evento '.$eve->getLocal().' dia '.date("d/m/Y",$eve->getData()).'</span>');
    include("traco.php");
?>
 <table  id="detmembro">
  <tr><td style="border:1px; border-style:solid; border-color:#000099;"><dd><?php echo (str_replace(chr(13).chr(10),"<br><dd>",$eve->getDescricao())); ?></td></tr>
  <tr style="font-weight:bold;"><td colspan=2>Fotos:</td></tr>
  <?php

     $pasta = sprintf ("./eventos/%06d/",$ID);

	 $ini = ($PG * 12) - 12 + 2;

	 $max = $PG * 12 + 2;

// echo ('<tr><td>ini= '.$ini.' max= '.$max.'</td></tr>');
	 
     echo ('  <tr style="font-weight:bold;"><td colspan=2 style="border:1px; border-style:solid; border-color:#000099;"><table>');

	 if (is_dir($pasta)) {
		 $fotos = scandir($pasta);

		 if (count($fotos) < $max)
		     $max = count($fotos);

		 if (count($fotos) < 3) {
			 echo ("Nenhuma foto cadastrada para esse membro.");
			 }
		 else {
			  $l = 0;
			  $x = $y = $ini;
			  while ($x < $max) {
				 if ($fotos[$y] == "." || $fotos[$y] == "..") {
				     $y++;
					 continue;
					 }
				 $arq = $pasta.$fotos[$y];
//             	 echo ('<tr><td>foto= '.$x.' = '.$arq.'</td></tr>');
				 if ($l == 0)
					 echo ("<tr>");
				 $l++;
				 $fn = sprintf("javascript:janela('prc_detfoto.php?arq=%s',50,50,680,510);",$arq);
				 echo ('<td align="center" valign="middle">');
				 echo ('<a href="'.$fn.'"><img src="'.$arq.'"> </a></td>');
				 if ($l == 4) {
					 $l=0;
					 echo ("</tr>");
					}
				$x++;
				$y++;
			  }
		 }
	}
	else
     	 echo ("Nenhuma foto cadastrada para esse membro.");

	echo('	</table></td></tr>');

?>
 <tr><td colspan=2><br /><?php paginas(count($fotos),$ID)?> </td></tr>

 <tr><td colspan=2><br /><br /><a href="index.php">Volta</a></td></tr>
  </table> 
<?php include ("rodape.php"); ?>
<?php

function paginas($qt,$ID) {


	 $resto = ($qt - 2) % 12;

     $pg = ($qt - 2 - $resto) / 12;

	 if ($resto <> 0)
	     $pg += 1;
		 
//	 echo ('<tr><td>qt= '.$qt.' pg= '.$pg.' resto= '.$resto.'</td></tr>');
		  
     for ($x = 1;$x <= $pg;$x++) {
         $ln = sprintf ('<a href="lst_detevento.php?evento=%d&PG=%d">%d</a>    ',$ID,$x,$x);
//     	 echo ('<tr><td>'.$ln.'</td></tr>');
		 echo ($ln);
	 }
}

?>