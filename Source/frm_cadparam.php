<?php include("sessao.php"); ?>

<?php include("head.php"); ?>

<?php include("vlogin.php"); ?>

      <span id="titform">
          <a href="menu_admin.php">Administra&ccedil;&atilde;o</a> -> 
          <a href="frm_cadparam.php">Cadastro de Parâmetros</a> 
      </span>
      
 <?php include("traco.php"); ?>

 <?php include("tophome.php"); ?>

 <form method="post" action="prc_cadparam.php" name="CadParam">
  <table id="tabform"   border="0" cellspacing="0" width="440px">

<?php
     
	   include 'conectadb.php';

	   $sql = sprintf("select emailadm,emailwbm from cad_param ");

	   $result = mysql_query($sql)
	 				or die('\nErro consultando parametros: ' . mysql_error()); 

	   if($row = mysql_fetch_assoc($result)) {
         echo ('      <tr> <td style="font-weight:bold;"> E-mail Administrador </td> </tr> <tr><td> <input size="60" tabindex="1" name="emailadm" value="'.$row['emailadm'].'"></td> </tr>')."\n"; 
         echo ('      <tr> <td style="font-weight:bold;"> E-mail Webmaster </td> </tr> <tr><td> <input size="60" tabindex="2" name="emailwbm" value="'.$row['emailwbm'].'"></td> </tr>')."\n"; 
	     }
       else { 
         echo ('      <tr> <td style="font-weight:bold;"> E-mail Administrador </td> </tr> <tr><td> <input size="60" tabindex="1" name="emailadm" ></td> </tr>')."\n"; 
         echo ('      <tr> <td style="font-weight:bold;"> E-mail Webmaster </td> </tr> <tr><td> <input size="60" tabindex="2" name="emailwbm" ></td> </tr>')."\n"; 
       } 
  	    echo ('<tr> <td colspan=10>');
        include("traco.php");
     	echo ('</td></tr>')."\n";
	    echo ('	 <tr> <td colspan="2"> <div style="float:left;"> <input tabindex="3" name="gravar" value="Gravar" type="submit"> ')."\n";

     mysql_free_result($result);
   	 mysql_close($link);

?>
  </table>
 </form>

<?php include ("bothome.php"); ?>

<?php include ("rodape.php"); ?>
