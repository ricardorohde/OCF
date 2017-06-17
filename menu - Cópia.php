<?php include_once("scpbolao.php"); ?>
<!-- Menu -->

<div id="menubv">
<fieldset>
<ul>
  <li> <a href="index.php">» Home</a> </li>
  <li> <a href="frm_cadusuario.php">» Cadastre-se</a></li>
  <li> <a href="lst_membros.php">» Sócios</a></li>
  <li> <a href='lst_cadastro.php'>» Opaleiros</a></li>
  <li> <a href="entrevistas.php">» Entrevistas</a></li>
  <li> <a href="./album" target="_blank"><b>» Galeria de Fotos</b></a></li>
  <li> <a href="./forum" target="_blank"><b>» Forum</b></a></li> 
  <li> <a target="_blank" href="estatuto.doc">» Estatuto</a></li>
  <li> <a href="frm_oclube.php">» O Clube</a></li>
  <li> <a href="frm_diretoria.php">» Diretoria</a></li>
  <li> <a href="frm_contato.php">» Fale Conosco</a></li>


  <?php 
       if ($_SESSION['logado'] == "SIM" && $_SESSION['niveluser'] == 999999) {
             echo ("<li> <a href='menu_admin.php'>» Administra&ccedil;&atilde;o</a> </li>")."\n";
          }
       if ($_SESSION['logado'] == "SIM" && $_SESSION['aprovado'] == 'S') {
             echo ("<li> <a target='_blank' href='caixa.xls'>» Caixa</a> </li>")."\n";
          }
   ?>
</ul>
</fieldset>
</div>