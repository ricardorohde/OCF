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
   <a href="lst_cadeventos.php">Cadastro de Eventos</a>
</span>
<?php include("traco.php"); ?>
<?php
   require_once($_SESSION['DOCROOT']."/classes/class.evento.php");
   $ID = $_GET['ID'];
   $eve = new Evento($ID);
 ?>  
 <span class="titusr">Fotos do Evento em <?php echo($eve->getLocal()." dia ".date("d/m/Y",$eve->getData())); ?></span>
      
<table class="fotosusr">
<?php
   $max = 12;

   $pasta = sprintf ("./eventos/%06d/",$ID);

   formulario($eve);

   $qtfotos = mostrafoto($pasta,$eve);

   if ($qtfotos == 0)
       semfoto();

?>
</table> 
<?php include ("rodape.php"); ?>

<?php  
function semfoto() {
	echo ("<tr><td>Não existe foto cadastrada para esse evento</td></tr>");
}

function mostrafoto($pasta,$eve) {	   
   $mostra = 0;
   $x = 0;
   $qt = 0;

   $hd = opendir($pasta);
   
   while (($foto = readdir($hd)) !== false){

   	        if ($foto == "." || $foto == "..")
   	            continue;

            $x++;
     		if ($mostra == 0)
   	    		echo ("<tr>");

		    $mostra++;		
            
			$qt++;
			
   		    echo ('<td align=center><img src="'.$pasta.$foto.'"  width=80 height=100><br><a href="prc_fotoseve.php?opc=E&arq='.$foto.'&ID='.$eve->getID().'">Apagar</a></td>')."\n";
   		    if ($mostra == 3) {
   		        $mostra = 0;
   	    		echo ("</tr>");
   		      }
   }
  return $qt;
}   

function formulario($eve) {
    echo('<tr><td colspan=4>');
	echo('<form enctype="multipart/form-data" action="prc_fotoseve.php?opc=I&ID='.$eve->getID().' "method="post">')."\n";
    echo('<input type="hidden" name="MAX_FILE_SIZE" value="300000" />')."\n";
    echo('Foto: <input name="userfile" type="file" />')."\n";
    echo('<input type="submit" value="Incluir foto" />')."\n";
    echo('</form>')."\n";
	echo('</td></tr>');
}

?>
