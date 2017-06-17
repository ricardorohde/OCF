<?php include("head.php"); ?>

 <span class="titusr">Minhas Fotos</span>
      
 <?php include("traco.php"); ?>

<table class="fotosusr">
<?php
   $usrid = $_SESSION['userid'];
   $max = 12;
   $pasta = sprintf ("./pics/U%06d/",$usrid);
   
   if (is_dir($pasta) == false) {
   		mkdir($pasta,0777) or die("erro criando diretorio");
//		chmod($pasta,0777);
	}

   $qtfotos = mostrafoto($pasta);

   if ($qtfotos == 0)
       semfoto();

   if ($qtfotos >= 12)
       echo ("<tr><td colspan=4>Você já inseriu o máximo de fotos permitido.</td></tr>");
   else
       formulario();
?>
</table> 
<?php include ("rodape.php"); ?>

<?php  
function semfoto() {
	echo ("<tr><td>Você ainda não possui nenhuma foto</td></tr>");
}

function mostrafoto($pasta) {	   
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
			
   		    echo ('<td align=center><img src="'.$pasta.$foto.'"  width=80 height=100><br><a href="prc_fotosusr.php?opc=E&arq='.$foto.'">Apagar</a></td>')."\n";
   		    if ($mostra == 3) {
   		        $mostra = 0;
   	    		echo ("</tr>");
   		      }
   }
  return $qt;
}   

function formulario() {
    echo('<tr><td colspan=4>');
	echo('<form enctype="multipart/form-data" action="prc_fotosusr.php?opc=I" method="post">')."\n";
    echo('<input type="hidden" name="MAX_FILE_SIZE" value="500000" />')."\n";
    echo('Foto: <input name="userfile" type="file" />')."\n";
    echo('<input type="submit" value="Incluir foto" />')."\n";
    echo('</form>')."\n";
	echo('</td></tr>');
    echo('<tr valign=top><td colspan=4>O Tamanho da foto não pode ser superior a 200 KBytes, salve a foto no formato VGA (640 x 480)</td></tr>'); 
    echo('<tr valign=top><td colspan=4>Caso tenha alguma dificuldade em inserir suas fotos entre em contato com o webmaster na opção Fale Conosco do menu.</td></tr>'); 
}

?>
