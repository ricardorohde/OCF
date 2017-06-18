<?php include("sessao.php"); ?>
<!-- Header da pagina -->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
  <META HTTP-EQUIV="control-cache" CONTENT="no-cache">
  <META NAME="author" CONTENT="Alencar Mendes de Oliveira">
  <META NAME="copyright" CONTENT="copyright 2005 Opala Clube Franca">
  <META NAME="robots" CONTENT="all">
  <META NAME="description" CONTENT="Opala Clube Franca">
  <META NAME="keywords" CONTENT="Clube do opala de Franca Opaleiros www.opalaclubefranca.com.br">
<?php
   if ($_SERVER['PHP_SELF'] == "/index.php")
       echo ('	<META HTTP-EQUIV="refresh" CONTENT="600">');
?>
  <title>Opala Clube Franca - Seja um opaleiro de cora��o, participe desse clube</title>
  <link rel="stylesheet" type="text/css" media="screen" href="estilos.css" />
  <link rel="icon" type="image/gif" href="/imagens/escudinho.gif" />

  <script type="text/javascript" src="jquery.js"></script>

<script>
// Javascript originally by Patrick Griffiths and Dan Webb.
// http://htmldog.com/articles/suckerfish/dropdowns/
sfHover = function() {
   var sfEls = document.getElementById("menu").getElementsByTagName("li");
   for (var i=0; i<sfEls.length; i++) {
      sfEls[i].onmouseover=function() {
         this.className+=" hover";
      }
      sfEls[i].onmouseout=function() {
         this.className=this.className.replace(new RegExp(" hover\\b"), "");
      }
   }
}
if (window.attachEvent) window.attachEvent("onload", sfHover);
</script>
 </head>
 <body class="padrao" bgcolor="#bdbfc2" >
 <div align="center">
	<div class="Principal">
<?php include("titulo.php");?>
<table cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
  <tr>
    <td bgcolor="f5f7f5" valign="top" align="center" width="170px"> <!-- barra esquerda -->
	 <?php include("esquerda.php"); ?> </td>
    <td valign="top" width="684px" bgcolor="ffffff"> <!-- barra central -->
