<?php 
session_cache_limiter('nocache'); 
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
include("sessao.php"); ?>
<?php 
   $ID = $_GET['ID'];
   $pasta = sprintf ("./eventos/%06d/",$ID);
   $opc = $_GET['opc'];
   $arq = $_GET['arq'];
   $tipos = array("gif","jpg","png","jpeg","pjpeg");
   $tiposn = array("gif","jpg","png","jpg","jpg");
   
   if ($opc == 'E') {
       unlink($pasta.$arq);
       echo ('<script>window.location = "frm_fotoseve.php?ID='.$ID.'";</script>');
	   return;
	   }
	
   if ($_FILES['userfile']['size'] > 500000) {
       erroupload("Tamanho do arquivo acima do permitido. Maximo permitido 300Kbytes",$ID);
	   return;
	   }

   $tipok = false;
   $x = 0;
   foreach ($tipos as $tp) {
       if ($_FILES['userfile']['type'] == 'image/'.$tp) {
	       $tipok = true;
		   $ext = $tiposn[$x];
		   break;
		   }
		   $x++;
		 }

   if ($tipok == false) {
       erroupload("Tipo do arquivo inválido. Permitido somente .gif .jpg .jpeg .png  ".$_FILES['userfile']['type'],$ID);
	   return;
	   }
   $nro = 1;
   while (is_file($pasta.sprintf ("foto%d.%s",$nro,$ext)) == true)
          $nro++;

   $nomearq = sprintf ("foto%d.%s",$nro,$ext);

   if (move_uploaded_file($_FILES['userfile']['tmp_name'],$pasta.$nomearq) == false) {
       erroupload("Erro no Upload do arquivo comunique o webmaster",$ID);
	   return;
	   }

//	chmod($pasta.$_FILES['userfile']['name'],0744);
	
echo ('<script>window.location = "frm_fotoseve.php?ID='.$ID.'";</script>');
return;

function erroupload($mensagem,$ID) {

 include("head.php");

 echo('<span class="titusr">Fotos Evento</span>');
      
 include("traco.php");

 echo ('<table class="fotosusr">');
  
 echo ('<tr><td>'.$mensagem.'</td></tr>');

 echo ('<tr><td><a href="frm_fotoseve.php?ID='.$ID.'">Volta</a></td></tr>');

 echo ('</table>');
 
 include ("rodape.php");
 
}
?>