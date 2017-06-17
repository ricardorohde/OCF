<?php include("sessao.php"); ?>

<?php include("head.php"); ?>

<?php include("vlogin.php"); ?>

      <span id="titform">
      	    <a href="menu_admin.php">Administra&ccedil;&atilde;o</a> ->
            <a href="lst_cadgrupo.php">Cadastro de Grupos</a>
      </span>
      
 <?php include("traco.php"); ?>
 
 <?php include("tophome.php"); ?>

  <table id="menuadm" border="0" cellspacing="0">
      <tr style="a:text-decoration:underline;">
			 <td>  
              <a href="frm_cadgrupo.php?camp=0&grp=0">Inclur Novo Grupo</a>
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

        $verifica = sprintf(
        						"Select c.codigo codcamp,c.descricao descricao,g.grupo, t.nome, c.ano
from cad_campeonato c, cad_grupo g, cad_times t
where c.codigo = g.campeonato
and g.time = t.codigo
order by c.ano desc, c.descricao,g.grupo,t.nome");

				$result = mysql_query($verifica)
											or die('\nErro consultando banco de dados: ' . mysql_error()); 

        $fllin = 0;

        echo ('         <tr class="cabec"> <td>Campeonato</td> <td>Grupo </td> 
        <td>Time</td></tr>')."\n";

       if (mysql_num_rows($result) == 0) {
      	   echo("<tr><td colspan=7>Nenhum grupo cadastrado no momento.</td></tr>");
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
               $descr = sprintf('<a href="frm_cadgrupo.php?camp=%s&grp=%s">%s-%s</a>',$row['codcamp'],
					$row['grupo'],$row['descricao'],$row['ano']);
               $grp = sprintf('<a href="frm_cadgrupo.php?camp=%s&grp=%s">%s</a>',$row['codcamp'],
					$row['grupo'],$row['grupo']);


          $linha = sprintf ('<td>%s</td> <td>%s</td><td>%s</td>', $descr,$grp, $row['nome']);

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
              <a href="frm_cadgrupo.php?camp=0&grp=0">Inclur Novo Grupo</a>
         </td> 
				 <td>
              <a href="menu_admin.php">Menu Principal</a>
         </td>
      </tr>

</table>

<?php include ("bothome.php"); ?>


<?php include ("rodape.php"); ?>
