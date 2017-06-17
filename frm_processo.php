<?php include("sessao.php"); ?>
<?php include("head.php"); ?>
<?php include("vlogin.php"); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT']."/classes/class.Processo.php"); ?>
<span id="titform">
   <a href="menu_admin.php">Administra&ccedil;&atilde;o</a> -> 
<?php 
   $prc = new Processo($_GET['prc']);
   $lnk = sprintf ('<a href="lst_processo.php?prc=%d">%s</a>',$prc->getID(),$prc->getNome()); 
   echo ($lnk);
  ?>
</span>
<?php include("traco.php"); ?>
<?php include("tophome.php"); ?>
<?php

    $classe = "FRM".$prc->getClassePrincipal();
    require_once($_SERVER['DOCUMENT_ROOT']."/".$prc->getPath()."/class.".$classe.".php");	
    $numero = $_GET['ID'];
    $Obj = new $classe($numero,$prc);
    $Obj->getForm();
?>
<?php include ("bothome.php"); ?>
<?php include ("rodape.php"); ?>
