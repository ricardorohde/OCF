<?php include("sessao.php"); ?>

<?php include("head.php"); ?>

<?php include("vlogin.php"); ?>

      <span id="titform">
      	    <a href="menu_admin.php">Administra&ccedil;&atilde;o</a> -> 
            <a href="lst_cadtimes.php">Cadastro de Times</a>
      </span>
      
 <?php include("traco.php"); ?>
 
 <?php include("tophome.php"); ?>

  <table id="menuadm" border="0" cellspacing="0">
      <tr style="a:text-decoration:underline;">
			 <td>  
              <a href="frm_cadtimes.php?codigo=0">Inclur Novo Time</a>
         </td> 
	 			<td>
              <a href="menu_admin.php">Menu Principal</a>
         </td>
      </tr>
      <tr>
	 <td>
		<br>
         </td>
      </tr>

<?php 

	include ('conectadb.php');

  $verifica = sprintf("Select codigo,nome,tipo from cad_times order by tipo,nome");


	$result = mysql_query($verifica)
		or die('\nErro consultando banco de dados: ' . mysql_error()); 

        $fllin = 0;
        $flclube = 'N';
        $flselec = 'N'; 
        
    if (mysql_num_rows($result) == 0) {
        echo ('         <tr class="cabec"><td>'."Clubes".'</td><td> </td></tr>');
        echo ('<tr> <td>Nenhum time cadastrado no momento.</td> </tr>')."\n";
    }
    else {
		while ($row = mysql_fetch_assoc($result)) {
	               if ($row['tipo'] == 'C' && $flclube <> 'S') {
	                    echo ('         <tr class="cabec"><td>'."Clubes".'</td><td> </td></tr>');
			    echo "\n";
	                    $flclube = 'S';
	                   }
	               if ($row['tipo'] == 'S' && $flselec <> 'S') {
	                    echo ('<tr> <td> <br> </td> </tr>')."\n";
	                    echo ('         <tr class="cabec"><td>'."Sele&ccedil;&otilde;es".'</td><td> </td></tr>');
			    echo "\n";
	                    $flselec = 'S';
		            $fllin = 0;
	                   }
	               if ($fllin == 0) {
	                   $fllin = 1;
	                   echo ('        <tr class="rel1"'.'>');
	                   }
	               else
	                   {
	                   $fllin = 0;
	                   echo ('        <tr class="rel2"'.'>');
	                   }  
	               echo ('<td> <a href="frm_cadtimes.php?codigo='.$row['codigo'].'"'.'>'
	                      .$row	['nome'].'</a> </td>');
	               echo ('<td> </td></tr>');
	    	    echo "\n";
		}
    }        
	mysql_free_result($result);
	mysql_close($link);
?>
      <tr>
	 <td>
		<br>
         </td>
      </tr>
      <tr>
	 <td>  
              <a href="frm_cadtimes.php?codigo=0">Inclur Novo Time</a>
         </td> 
	 <td>
              <a href="menu_admin.php">Menu Principal</a>
         </td>
      </tr>

</table>

<?php include ("bothome.php"); ?>


<?php include ("rodape.php"); ?>
