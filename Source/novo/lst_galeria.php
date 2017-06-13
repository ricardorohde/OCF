<?php include("sessao.php");?>
<div class="PainelCentral">
<div class="LeftPainel"></div>
<div class="TitBox">.:: Galeria de Fotos ::.</div>
<div class="RightPainel"></div>
<div class="LinkPainel"><a href="./album" target="_blank">Acesse nossa galeria...</a></div>
<div class="BarraTit"></div>
<div class="Caixa180">
<table id="thumbnail" width="100%" cellpadding="0" cellspacing="0" height="100%">
<?php
	require_once($_SESSION['DOCROOT']."/classes/class.bdcpg.php");

    $db = new BDCPG();

	$sql = sprintf('select pid,owner_name,concat("./album/albums/",filepath,"thumb_",filename) foto from cpg14x_pictures order by rand() limit 10
');
	$db->Query($sql);
    echo ('<tr>');
 	$db->Next(); 
	echo(sprintf('<td width=100px><a target="_blank" href="album/displayimage.php?album=random&cat=0&pos=-%d"> <img src="%s" border="0" /> </a><br/>%s</td>',$db->getValue('pid'),$db->getValue('foto'),$db->getValue('owner_name')));
 	$db->Next(); 
	echo(sprintf('<td width=100px><a target="_blank" href="album/displayimage.php?album=random&cat=0&pos=-%d"> <img src="%s" border="0" /> </a><br/>%s</td>',$db->getValue('pid'),$db->getValue('foto'),$db->getValue('owner_name')));
 	$db->Next(); 
	echo(sprintf('<td width=100px><a target="_blank" href="album/displayimage.php?album=random&cat=0&pos=-%d"> <img src="%s" border="0" /> </a><br/>%s</td>',$db->getValue('pid'),$db->getValue('foto'),$db->getValue('owner_name')));
 	$db->Next(); 
	echo(sprintf('<td width=100px><a target="_blank" href="album/displayimage.php?album=random&cat=0&pos=-%d"> <img src="%s" border="0" /> </a><br/>%s</td>',$db->getValue('pid'),$db->getValue('foto'),$db->getValue('owner_name')));
 	$db->Next(); 
	echo(sprintf('<td width=100px><a target="_blank" href="album/displayimage.php?album=random&cat=0&pos=-%d"> <img src="%s" border="0" /> </a><br/>%s</td>',$db->getValue('pid'),$db->getValue('foto'),$db->getValue('owner_name')));
	echo("</tr>\n");

    echo ('<tr>');
 	$db->Next(); 
	echo(sprintf('<td width=100px><a target="_blank" href="album/displayimage.php?album=random&cat=0&pos=-%d"> <img src="%s" border="0" /> </a><br/>%s</td>',$db->getValue('pid'),$db->getValue('foto'),$db->getValue('owner_name')));
 	$db->Next(); 
	echo(sprintf('<td width=100px><a target="_blank" href="album/displayimage.php?album=random&cat=0&pos=-%d"> <img src="%s" border="0" /> </a><br/>%s</td>',$db->getValue('pid'),$db->getValue('foto'),$db->getValue('owner_name')));
 	$db->Next(); 
	echo(sprintf('<td width=100px><a target="_blank" href="album/displayimage.php?album=random&cat=0&pos=-%d"> <img src="%s" border="0" /> </a><br/>%s</td>',$db->getValue('pid'),$db->getValue('foto'),$db->getValue('owner_name')));
 	$db->Next(); 
	echo(sprintf('<td width=100px><a target="_blank" href="album/displayimage.php?album=random&cat=0&pos=-%d"> <img src="%s" border="0" /> </a><br/>%s</td>',$db->getValue('pid'),$db->getValue('foto'),$db->getValue('owner_name')));
 	$db->Next(); 
	echo(sprintf('<td width=100px><a target="_blank" href="album/displayimage.php?album=random&cat=0&pos=-%d"> <img src="%s" border="0" /> </a><br/>%s</td>',$db->getValue('pid'),$db->getValue('foto'),$db->getValue('owner_name')));
	echo("</tr>\n");

?>
  <tr> <td colspan=6> <a href="./album" target="_blank">Clique aqui e publique as fotos do seu opala em nossa galeria</a> </td></tr>	
 </table>
</div>
</div>
