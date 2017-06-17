<?php include("sessao.php"); ?>

<?php include("head.php"); ?>

 <div id="formu" name="toph"  style="width:560px">
    <span class="ftop">
			<span class="f1"></span>
			<span class="f2"></span>
			<span class="f3"></span>
			<span class="f4"></span>
		</span>
      

 <form method="post" action="prc_cadgrupocopa.php" name="frm_cadgrupocopa" onload="frmload();"
 			onSubmit="return Enviaform()">
  <table id="tabform"  border="0" cellspacing="0">

<?php

     $letra = array('A','B','C','D','E');
     $usr = array();
     $grp = array();

	   include 'conectadb.php';


     $sql = sprintf("update cad_grupo_copa ". 
   		"set grupo = 'E' " .
   		"where " .
   		"userid = 18 " .
   		"and campeonato = 1 ");

     $result = mysql_query($sql)
	 				or die('\nErro consultando classificacao 1: ' . mysql_error()); 

     $sql = sprintf("update cad_grupo_copa ". 
   		"set grupo = 'D' " .
   		"where " .
   		"userid = 37 " .
   		"and campeonato = 1 ");

     $result = mysql_query($sql)
	 				or die('\nErro consultando classificacao: ' . mysql_error()); 

     $sql = sprintf("update cad_grupo_copa ". 
   		"set grupo = 'C' " .
   		"where " .
   		"userid = 4 " .
   		"and campeonato = 1 ");

     $result = mysql_query($sql)
	 				or die('\nErro consultando classificacao: ' . mysql_error()); 

     $sql = sprintf("update cad_grupo_copa ". 
   		"set grupo = 'B' " .
   		"where " .
   		"userid = 58 " .
   		"and campeonato = 1 ");
     $result = mysql_query($sql)
	 				or die('\nErro consultando classificacao: ' . mysql_error()); 

     $sql = sprintf("update cad_grupo_copa ". 
   		"set grupo = 'A' " .
   		"where " .
   		"userid = 54 " .
   		"and campeonato = 1 ");
     $result = mysql_query($sql)
	 				or die('\nErro consultando classificacao: ' . mysql_error()); 

     mysql_free_result($result);
  	 mysql_close($link);

 ?>
  
  </table>
 </form>

<?php include ("bothome.php"); ?>

<?php include ("rodape.php"); ?>
