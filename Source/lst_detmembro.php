<?php include("sessao.php"); ?>
<?php include("head.php"); ?>
<?php require_once($_SESSION['DOCROOT']."/classes/class.usuario.php"); ?>
<?php
    $u = $_GET['usr'];
	
	$usr = new Usuario($u);

	echo ('<span class="titusr">Membro: '.$usr->getNome().'</span>');
    include("traco.php");
?>
  <table  id="detmembro">
  <tr style="font-weight:bold;"><td width="100px">E-mail:</td><td width="350px"><?php echo ($usr->getEmail()); ?> </td></tr>
  <tr style="font-weight:bold;"><td>Cidade:</td><td> <?php echo ($usr->getCidade()."/".$usr->getEstado()); ?></td></tr>
  <tr style="font-weight:bold;"><td>Ano:</td><td> <?php echo ($usr->getAnoOpala()); ?></td></tr>
  <tr style="font-weight:bold;"><td colspan=2>Descrição:</td></tr>
  <tr style="font-weight:bold;"><td colspan=2 style="border:1px; border-style:solid; border-color:#000099;"><?php echo($usr->getDescricao()); ?></td></tr>
  <tr style="font-weight:bold;"><td colspan=2>Fotos:</td></tr>
  <?php
     $pasta = sprintf ("./pics/U%06d/",$u);
	 
     echo ('  <tr style="font-weight:bold;"><td colspan=2 style="border:1px; border-style:solid; border-color:#000099;"><table>');

	 if (is_dir($pasta)) {
		 $fotos = scandir($pasta);
		 if (count($fotos) < 3) {
			 echo ("Nenhuma foto cadastrada para esse membro.");
			 }
		 else {
			  $l = 0;
			  foreach($fotos as $f) {
				 if ($f == "." || $f == "..")
					 continue;
				 $arq = $pasta.$f;		 
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
			  }
		 }
	}
	else
     	 echo ("Nenhuma foto cadastrada para esse membro.");

	echo('	</table></td></tr>');

?>
 <tr><td colspan=2><br /><br />	<a  href="javascript:history.back()">Volta</a>
</td></tr>
  </table>
<?php include ("rodape.php"); ?>
