<?php include("sessao.php"); ?>

<?php include("head.php"); ?>

<?php include("vlogin.php"); ?>

      <span id="titform">
          <a href="menu_admin.php">Administra&ccedil;&atilde;o</a> -> 
          <a href="lst_cadtimes.php">Cadastro de Times</a> 
      </span>
      
 <?php include("traco.php"); ?>

 <?php include("tophome.php"); ?>

 <form method="post" action="prc_cadtimes.php" name="CadTimes">
  <table id="tabform"   border="0" cellspacing="0" width="440px">

<?php
         echo ('      <tr> <td> <input type="hidden" name="codigo" value="'.$_GET['codigo'].'"> </td> </tr>')."\n"; 
     
     if ($_GET['codigo'] == 0) {
         echo ('      <tr> <td style="font-weight:bold;"> Time </td> </tr> <tr><td> <input size="60" tabindex="0" name="nometime"></td> </tr>')."\n"; 
         echo ('  <tr><td><br></td></tr> <tr><td style="font-weight:bold;"><input checked="checked" tabindex="1" name="tipo" value="Clube" type="radio">Clube')."\n";
         echo ('              <input tabindex="2" name="tipo" value="Selecao"	 type="radio"> Sele&ccedil;&atilde;o </td></tr>')."\n";

         include ("botincluir.php");

          }
     else {
            include('conectadb.php');

            $consulta = sprintf("select nome,tipo from cad_times where codigo = %s",$_GET['codigo']);
            $result = mysql_query($consulta)
			or die('\nErro consultando cadastro de times: ' . mysql_error()); 
            $row = mysql_fetch_assoc($result); 

            echo ('      <tr> <td style="font-weight:bold;"> Time </td> </tr> <tr><td> <input size="60" tabindex="0" name="nometime" value="'.$row['nome'].'"> </td></tr>')."\n"; 

            $chkc = ' ';
            $chks = ' ';
            if ($row['tipo'] == 'C') {
                $chkc = 'checked="checked"';
                $chks = ' ';
               }
            else {
                  $chks = 'checked="checked"';
                  $chkc = ' ';
               }                    

            echo ('          <tr><td><br></td></tr> <tr><td style="font-weight:bold;"> <input '.$chkc.' tabindex="1" name="tipo" value="Clube" type="radio">Clube')."\n";
            echo ('              <input '.$chks.' tabindex="2" name="tipo" value="Selecao"	 type="radio">Sele&ccedil;&atilde;o  </td></tr>')."\n";

            include("botaltexc.php");

          }
 
?>
  </table>
 </form>

<?php include ("bothome.php"); ?>


<?php include ("rodape.php"); ?>
