<?php include("sessao.php"); ?>
<div class="PainelCentral">
<div class="LeftPainel"></div>
<div class="TitBox">.:: Galeria de Fotos ::.</div>
<div class="RightPainel"></div>
<div class="LinkPainel"><a href="./album" target="_blank">Publique suas fotos</a> </div>
<div class="BarraTit"></div>
<div class="Caixa220">
<table class="PainelCentral_table" width="100%" cellpadding="0" cellspacing="0" height="100%" >
<?php
	require_once($_SESSION['DOCROOT']."/classes/class.bd2.php");

    $db = new BD2("opalaclubefran02");
$sql = sprintf('select pid,usr.user_name owner_name,concat("./album/albums/",filepath,"thumb_",filename) foto '.
 					"from cpg14x_pictures pic, ".
 					"cpg14x_users usr ".
 					"where usr.user_id = pic.owner_id ".
					"order by rand() limit 12");
    $db->Query($sql);
    echo ('<tr style="margin-top:10px;border:0;">');
 	$db->Next(); 
	echo(sprintf('<td style="padding:5px;"><a target="_blank" href="album/displayimage.php?album=random&cat=0&pos=-%d"> <img src="%s" border="0" /> </a></td>',$db->getValue('pid'),$db->getValue('foto')));
 	$db->Next(); 
	echo(sprintf('<td style="padding:5px;"><a target="_blank" href="album/displayimage.php?album=random&cat=0&pos=-%d"> <img src="%s" border="0" /> </a></td>',$db->getValue('pid'),$db->getValue('foto')));
 	$db->Next(); 
	echo(sprintf('<td style="padding:5px;"><a target="_blank" href="album/displayimage.php?album=random&cat=0&pos=-%d"> <img src="%s" border="0" /> </a></td>',$db->getValue('pid'),$db->getValue('foto')));
 	$db->Next(); 
	echo(sprintf('<td style="padding:5px;"><a target="_blank" href="album/displayimage.php?album=random&cat=0&pos=-%d"> <img src="%s" border="0" /> </a></td>',$db->getValue('pid'),$db->getValue('foto')));
        $db->Next();
        echo(sprintf('<td style="padding:5px;"><a target="_blank" href="album/displayimage.php?album=random&cat=0&pos=-%d"> <img src="%s" border="0" /> </a></td>',$db->getValue('pid'),$db->getValue('foto')));
        $db->Next();
        echo(sprintf('<td style="padding:5px;"><a target="_blank" href="album/displayimage.php?album=random&cat=0&pos=-%d"> <img src="%s" border="0" /> </a></td>',$db->getValue('pid'),$db->getValue('foto')));


    echo("</tr>");
    echo('<tr style="margin-top:10px;border:0;">');

 	$db->Next(); 
	echo(sprintf('<td style="padding:5px;"><a target="_blank" href="album/displayimage.php?album=random&cat=0&pos=-%d"> <img src="%s" border="0" /> </a></td>',$db->getValue('pid'),$db->getValue('foto')));
 	$db->Next(); 
	echo(sprintf('<td style="padding:5px;"><a target="_blank" href="album/displayimage.php?album=random&cat=0&pos=-%d"> <img src="%s" border="0" /> </a></td>',$db->getValue('pid'),$db->getValue('foto')));
 	$db->Next(); 
	echo(sprintf('<td style="padding:5px;"><a target="_blank" href="album/displayimage.php?album=random&cat=0&pos=-%d"> <img src="%s" border="0" /> </a></td>',$db->getValue('pid'),$db->getValue('foto')));
 	$db->Next(); 
	echo(sprintf('<td style="padding:5px;"><a target="_blank" href="album/displayimage.php?album=random&cat=0&pos=-%d"> <img src="%s" border="0" /> </a></td>',$db->getValue('pid'),$db->getValue('foto')));
        $db->Next();
        echo(sprintf('<td style="padding:5px;"><a target="_blank" href="album/displayimage.php?album=random&cat=0&pos=-%d"> <img src="%s" border="0" /> </a></td>',$db->getValue('pid'),$db->getValue('foto')));
        $db->Next();
        echo(sprintf('<td style="padding:5px;"><a target="_blank" href="album/displayimage.php?album=random&cat=0&pos=-%d"> <img src="%s" border="0" /> </a></td>',$db->getValue('pid'),$db->getValue('foto')));
    echo("</tr>");

?>
  </table>
</div>
</div>
