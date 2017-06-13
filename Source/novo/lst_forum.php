<?php include("sessao.php"); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT']."/classes/class.forum.php"); ?>
<div class="PainelCentral">
<div class="LeftPainel"> </div>
<div class="TitBox">.:: Nosso Forum ::.</div>
<div class="RightPainel"> </div>
<div class="LinkPainel"><a href="/forum" target="_blank">Participe...</a></div>
<div class="BarraTit"></div>
<div class="Caixa250" >
<table class="PainelCentral" width="100%" cellpadding="0" cellspacing="0" height="100%">
<?php

    $lst = Forum::Ultimas();
    if (count($lst) == 0)
		return;

	foreach($lst as $u) {

	    $ln = sprintf('<a href="/forum/index.php?topic=%d.msg%d#new">',$u['id_topic'],$u['id_topic']);

        $l1 = sprintf('<td style="width:105px;">'.$ln.'(%s %s)'.'</a></td>',date("d/m/Y",$u['postertime']),date("H:i",$u['postertime']));      	

        $l2 = sprintf('<td>'.$ln.'<b>%s </b></a></td>',$u['postername']);      	

        $l3 = sprintf('<td>'.$ln.'%s: - %s: %s...</a></td>',$u['name'],$u['subject'],$u['body']);      	

        $ln = $l1.$l2.$l3;

         echo ("<tr>".$ln."</tr>\n");       	

	}
?>
</table>
</div> 
</div>