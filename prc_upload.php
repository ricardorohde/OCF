<?php 
session_cache_limiter('nocache'); 
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
include("sessao.php"); ?>
<?php 
   $pasta = "./uploads/";
   
	
   if ($_FILES['userfile']['size'] > 500000) {
       erroupload("Tamanho do arquivo acima do permitido. Maximo permitido 300Kbytes",$ID);
	   return;
	   }

   if (move_uploaded_file($_FILES['userfile']['tmp_name'],$pasta.$_FILES['userfile']['name']) == false) {
       erroupload("Erro no Upload do arquivo comunique o webmaster");
	   return;
	   }

//	chmod($pasta.$_FILES['userfile']['name'],0744);
	
echo ('<script>window.location = "frm_upload.php";</script>');

function erroupload($mensagem) {

 include("head.php");

 echo('<span class="titusr">Fotos Evento</span>');
      
 include("traco.php");

 echo ('<table class="fotosusr">');
  
 echo ('<tr><td>'.$mensagem.'</td></tr>');

 echo ('<tr><td><a href="frm_upload.php">Volta</a></td></tr>');

 echo ('</table>');
 
 include ("rodape.php");
 
}
?>