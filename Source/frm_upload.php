<?php 
session_cache_limiter('nocache'); 
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
include("sessao.php");
?>
<?php include("head.php"); ?>
<?php include("vlogin.php"); ?>

<span id="titform">
   <a href="menu_admin.php">Administra&ccedil;&atilde;o</a> ->
   <a href="frm_upload.php">Upload de Arquivos</a>
</span>
<?php include("traco.php"); ?>

<table class="fotosusr">
<?php
   $pasta = "./uploads/";

   formulario();
?>
</table> 
<table class="fotosusr">
<?php
   mostrapasta($pasta);
?>
</table> 
<?php include ("rodape.php"); ?>

<?php  
function mostrapasta($pasta) {	   
   $mostra = 0;

   $qt = 0;

   $hd = opendir($pasta);

   echo ("<tr><td><b><span style='color:blue;text-decoration:underline;font-size:14px;'>Arquivos na pasta</span></td></tr>");

   while (($arq = readdir($hd)) !== false){

   	        if ($arq == "." || $arq == "..")
   	            continue;

			$qt++;

   		    echo ('<tr><td>'.$arq.'<a href="prc_upload.php?opc=E&arq='.$arq.'">
			<img width="16px" height="16px" src="./imagens/excluir.jpg" /></a> </td></tr>')."\n";

   }

  return $qt;
}   


function formulario($eve) {
    echo('<tr><td colspan=4>');
	echo('<form enctype="multipart/form-data" action="prc_upload.php?opc=I" method="post">')."\n";
    echo('<input type="hidden" name="MAX_FILE_SIZE" value="500000" />')."\n";
    echo('Arquivo: <input name="userfile" type="file" />')."\n";
    echo('<input type="submit" value="Enviar Arquivo" />')."\n";
    echo('</form>')."\n";
	echo('</td></tr>');
}

?>
