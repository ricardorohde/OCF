<?php include("sessao.php"); ?>

<?php include("head.php"); ?>

<?php include("vlogin.php"); ?>

      <span id="titform">
      	    <a href="menu_admin.php">Administra&ccedil;&atilde;o</a> -> 
            <a href="lst_cadcampeonato.php">Cadastro de Campeonatos</a>
      </span>
      
 <?php include("traco.php"); ?>
 
 <?php include("tophome.php"); ?>

  <table id="menuadm" border="0" cellspacing="0">
      <tr style="a:text-decoration:underline;">
			 <td>  
              <a href="frm_cadcampeonato.php?codigo=0">Inclur Novo Campeonato</a>
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

        $verifica = sprintf("Select codigo,descricao,ano,valorinscr,tipo from cad_campeonato order by ano,descricao");


	$result = mysql_query($verifica)
		or die('\nErro consultando banco de dados: ' . mysql_error()); 

        $fllin = 0;

        echo ('         <tr class="cabec"> <td>Campeonato</td> <td> Ano </td> <td align="right"> Valor da Inscri&ccedil;&atilde;o</td>     <td align="left"> Tipo </td> </tr>')."\n";
       if (mysql_num_rows($result) == 0) {
      	   echo("<tr><td colspan=7>Nenhum Campeonato cadastrado no momento.</td></tr>");
       }

	while ($row = mysql_fetch_assoc($result)) {
               if ($fllin == 0) {
                   $fllin = 1;
                   echo ('        <tr class="rel1"'.'>');
                   }
               else
                   {
                   $fllin = 0;
                   echo ('        <tr class="rel2"'.'>');
                   }  
               $descr = sprintf('<a href="frm_cadcampeonato.php?codigo=%s">%s</a>',$row['codigo'],
					$row['descricao']);

               if ($row['tipo'] == 'C')
                   $tipo = 'Clubes';
               else
                   $tipo = 'Sele&ccedil;&otilde;es';
               $valor = $row['valorinscr'];              
               $linha = sprintf ('<td>%s</td> <td>%s</td> <td align="right">%s</td> <td align="left">%s</td> ',
                                 $descr, $row['ano'],number_format($valor,2,",","."),$tipo);

               echo ($linha.'</td>')."\n";
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
              <a href="frm_cadcampeonato.php?codigo=0">Inclur Novo Campeonato</a>
         </td> 
	 <td>
              <a href="menu_admin.php">Menu Principal</a>
         </td>
      </tr>

</table>

<?php include ("bothome.php"); ?>


<?php include ("rodape.php"); ?>
