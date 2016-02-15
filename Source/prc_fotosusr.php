<?php include("sessao.php"); ?>
<?php 
   $usrid = $_SESSION['userid'];
   $pasta = sprintf ("./pics/U%06d/",$usrid);
   $opc = $_GET['opc'];
   $arq = $_GET['arq'];
   $tipos = array("gif","jpg","png","jpeg","pjpeg");
   $tiposn = array("gif","jpg","png","jpg","jpg");
   
//   	chmod($pasta,0777);
   if ($opc == 'E') {
       unlink($pasta.$arq);
       echo ('<script>window.location = "frm_fotosusr.php";</script>');
	   return;
	   }
	
   if ($_FILES['userfile']['size'] > 500000) {
       erroupload("Tamanho do arquivo acima do permitido. Maximo permitido 150Kbytes");
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

   $msg = sprintf ("Tipo do arquivo inválido. Permitido somente .gif .jpg .jpeg .png  %s",$_FILES['userfile']['type']);

   if ($tipok == false) {
       erroupload($msg);
	   return;
	   }

   $nro = 1;
   while (is_file($pasta.sprintf ("foto%d.%s",$nro,$ext)) == true)
          $nro++;

   $nomearq = sprintf ("foto%d.%s",$nro,$ext);

   if (move_uploaded_file($_FILES['userfile']['tmp_name'],$pasta.$nomearq) == false) {
       echo($_FILES['userfile']['tmp_name']);
       echo($pasta.$nomearq);
       erroupload("Erro no Upload do arquivo comunique o webmaster");
	   return;
	   }
	   
//	chmod($pasta.$_FILES['userfile']['name'],0744);
	
echo ('<script language="javascript">window.location = "frm_fotosusr.php";</script>');
return;

function erroupload($mensagem) {

 include("head.php");

 echo('<span class="titusr">Minhas Fotos</span>');
      
 include("traco.php");

 echo ('<table class="fotosusr">');
  
 echo ('<tr><td>'.$mensagem.'</td></tr>');

 echo ('<tr><td><a href="frm_fotosusr.php">Volta</a></td></tr>');

 echo ('</table>');
 
 include ("rodape.php");
 
}
?>