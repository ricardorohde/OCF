<?php include("sessao.php"); ?>

<?php include("head.php"); ?>

<?php include("vlogin.php"); ?>

      <span id="titform">
      	    <a href="menu_admin.php">Administra&ccedil;&atilde;o</a> ->
            <a href="lst_cadrodada.php">Cadastro de Rodadas</a>
      </span>
      
 <?php include("traco.php"); ?>
 
 <?php include("tophome.php"); ?>

  <table id="menuadm" border="0" cellspacing="0">
      <tr style="a:text-decoration:underline;">
			 <td>  
              <a href="frm_cadrodada.php?camp=0&rod=0&op=I">Inclur Nova Rodada</a>
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

  $dw = array("Dom","Seg","Ter","Qua","Qui","Sex","Sab"); 

   require_once("prc_execsql.php");
   
        $verifica = sprintf("select c.codigo codcamp, c.ano,r.rodada, c.descricao, min(addtime(data, hora)) datahora
															from cad_campeonato c, cad_rodada r
														    where c.codigo = r.campeonato
																 and r.data > '01/01/2000'
																 and c.flandamento = 'S'
															group by c.codigo,r.rodada,c.descricao,c.ano
															order by c.ano desc, c.descricao,r.rodada");

	   $result = execsql($verifica);

/*				$result = mysql_query($verifica)
											or die('\nErro consultando banco de dados: ' . mysql_error());  */

        $fllin = 0;

        echo ('         <tr class="cabec"> <td>Campeonato</td> <td align="center">Rodada</td> <td>Data/Hora Início</td></tr>')."\n";
       if (mysql_num_rows($result) == 0) {
      	   echo("<tr><td colspan=7>Nenhuma rodada cadastrada no momento.</td></tr>");
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
               $descr = sprintf('<a href="frm_cadrodada.php?camp=%s&rod=%s&op=A">%s-%s</a>',$row['codcamp'],
					$row['rodada'],$row['descricao'],$row['ano']);
               $rodada = sprintf('<a href="frm_cadrodada.php?camp=%s&rod=%s&op=A">%02d</a>',$row['codcamp'],
					$row['rodada'],$row['rodada']);
               $dh = sprintf('<a href="frm_cadrodada.php?camp=%s&rod=%s&op=A">%s %s <i>%s</i></a>',$row['codcamp'],
					$row['rodada'],date("d/m/Y",strtotime($row['datahora'])),date("H:i",strtotime($row['datahora'])),$dw[date("w",strtotime($row['datahora']))]);


          $linha = sprintf ('<td>%s</td> <td align="center">%s</td><td>%s</td>', $descr,$rodada,$dh);

          echo ($linha.'</tr>')."\n";
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
              <a href="frm_cadrodada.php?camp=0&rod=0&op=I">Inclur Nova Rodada</a>
         </td> 
				 <td>
              <a href="menu_admin.php">Menu Principal</a>
         </td>
      </tr>

</table>

<?php include ("bothome.php"); ?>


<?php include ("rodape.php"); ?>
