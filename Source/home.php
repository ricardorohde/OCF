<?php include("sessao.php"); ?>
<a  style="margin-top:5px;" target="_blank" href="./forum"> <img style="margin-top:5px;" border="1px" src="./imagens/forum.gif"/></a><img style="margin-top:5px;margin-left:20px;" border="1px" src="./imagens/anuncieaquihome.gif"/>
<!--	<tr align=center><td><?php include("entrevistames.php"); ?></td></tr>-->
<div>
<?php 
include("lst_galeria.php");
if ($_SESSION['aprovado'] == 'S' && $_SESSION['logado'] == 'SIM') include("lst_mural.php");
include("lst_forum.php"); 
if ($_SESSION['aprovado'] == 'S' && $_SESSION['logado'] == 'SIM') include("lst_msgcontato.php");
include("lst_eventos.php");
include("lst_mundoauto.php"); 
?>
<div> <center style="font-size:13px";color:#0f0f0f">www.opalaclubefranca.com.br - Franca/SP (Fundado em 28/11/2006)</center></div>
</div>
