<?php include("sessao.php"); ?>
<a  target="_blank" href="./forum"> <img border="1px" src="./imagens/forum.gif"/></a>
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
</div>