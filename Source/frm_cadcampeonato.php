<?php include("sessao.php"); ?>

<?php include("head.php"); ?>

<?php include("vlogin.php"); ?>

      <span id="titform">
          <a href="menu_admin.php">Administra&ccedil;&atilde;o</a> -> 
          <a href="lst_cadcampeonato.php">Cadastro de Campeonatos</a> 
      </span>
      
 <?php include("traco.php"); ?>

 <?php include("tophome.php"); ?>

 <form method="post" action="prc_cadcampeonato.php" name="frm_cadcampeonato">
  <table id="tabform"   border="0" cellspacing="0"  width="440px">

<?php
         echo ('      <tr> <td> <input type="hidden" name="codigo" value="'.$_GET['codigo'].'"> </td> </tr>')."\n"; 
     
     if ($_GET['codigo'] == 0) {
         echo ('      <tr> <td style="font-weight:bold;" width="30%" >Descrição:</td>')."\n"; 
         echo ('           <td width="70%" > <input size="50" maxlength="50" name="descricao"></td> </tr>')."\n"; 

         echo ('      <tr> <td style="font-weight:bold;" width="30%" >Ano:</td>')."\n"; 
         echo ('           <td width="70%" > <input size="4" maxlength="4" name="ano"></td> </tr>')."\n"; 

         echo ('      <tr> <td style="font-weight:bold;" width="30%" >Valor da Inscrição:</td> ')."\n"; 
         echo ('           <td width="70%" > <input size="11" maxlength="11" name="valor"></td> </tr>')."\n"; 

         echo ('      <tr> <td style="font-weight:bold;" width="30%" >Tipo:</td> ')."\n"; 
         echo ('           <td style="font-weight:bold;" width="70%" ><input checked="checked" tabindex="1" name="tipo" value="Clubes" type="radio">Clubes')."\n";
         echo ('              <input tabindex="2" name="tipo" value="Selecoes"	 type="radio"> Seleções</td></tr>')."\n";

         include ("botincluir.php");

          }
     else {
            include('conectadb.php');

            $sql = sprintf("select descricao,ano,valorinscr,tipo from cad_campeonato where codigo = %s",$_GET['codigo']);
            $result = mysql_query($sql)
			                  or die('\nErro consultando cadastro de campeonato: ' . mysql_error()); 
            $row = mysql_fetch_assoc($result); 

            echo ('      <tr> <td style="font-weight:bold;" width="30%" >Descrição:</td>')."\n"; 
            echo ('           <td width="70%" > <input size="50" maxlength="50" name="descricao" value="'.$row['descricao'].'"></td> </tr>')."\n"; 

            echo ('      <tr> <td style="font-weight:bold;" width="30%" >Ano:</td>')."\n"; 
            echo ('           <td width="70%" > <input size="4" maxlength="4" name="ano" value="'.$row['ano'].'"></td> </tr>')."\n"; 
 
            echo ('      <tr> <td style="font-weight:bold;" width="30%" >Valor da Inscrição:</td> ')."\n"; 
            echo ('           <td width="70%" > <input size="11" maxlength="11" name="valor" value="'.trim(number_format($row['valorinscr'],2,",",".")).'"></td> </tr>')."\n"; 

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

            echo ('      <tr> <td style="font-weight:bold;" width="30%" >Tipo:</td> ')."\n"; 
            echo ('           <td style="font-weight:bold;" width="70%" ><input '.$chkc.' tabindex="1" name="tipo" value="Clubes" type="radio">Clubes')."\n";
            echo ('              <input '.$chks.' tabindex="2" name="tipo" value="Selecoes"	 type="radio"> Seleções</td></tr>')."\n";

            include("botaltexc.php");

        }
 
?>
  </table>
 </form>

<?php include ("bothome.php"); ?>


<?php include ("rodape.php"); ?>
