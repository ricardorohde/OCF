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


     $sql = sprintf("delete from cad_grupo_copa"); 

     $result = mysql_query($sql)
	 				or die('\nErro inicializando grupos da copa: ' . mysql_error()); 


     $sql = sprintf("select campeonato,i.userid,u.username,posefetiva ". 
   		"from " .
   		"cad_inscricao i," .
   		"cad_usuario u " .
   		"where " .
   		"i.userid = u.userid " .
   		"and campeonato = 1 " .
   		"order by " .
   		"posefetiva");

     $result = mysql_query($sql)
	 				or die('\nErro consultando classificacao: ' . mysql_error()); 

    $qtu = mysql_num_rows($result) / $qtgrp;
    $x = 0;
    $i = 1;
     while ($row = mysql_fetch_assoc($result)) {
		     $sql = sprintf("insert into cad_grupo_copa ". 
		   		"(campeonato,grupo,userid) " .
		   		"values(%d,'%s',%d) "
		   		,$row['campeonato'],$letra[$x],$row['userid']);

 //          echo ("<tr><td>".$sql."</td></tr>");

		     $rs = mysql_query($sql)
			 				or die('\nErro Inserindo grupo: ' . mysql_error()); 

            echo ("<tr><td>".$letra[$x]."</td><td>".$row['username']."</td><td>".$row['posefetiva']."</td></tr>");
            $x += $i; 
            if ($x == 5 || $x == -1) {
            	$i *= -1;
	            $x += $i; 
            }        	
     }

     mysql_free_result($result);
     mysql_free_result($rs);
  	 mysql_close($link);

 ?>
  
  </table>
 </form>

<?php include ("bothome.php"); ?>

<?php include ("rodape.php"); ?>
